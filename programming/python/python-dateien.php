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
                        <?php renderPythonNavigation('python-dateien'); ?>
                        <div class="d-flex justify-content-between align-items-center pt-3 pb-2 mb-3 border-bottom">
                            <h1 class="h2"><i class="bi bi-file-text text-primary me-2"></i>Python File I/O</h1>
                        </div>

                        <div class="row">
                            <div class="col-12">
                    
                    <div class="content-section">
                        <h2>Dateien in Python</h2>
                        <p><strong>File Input/Output (I/O)</strong> ermöglicht es, Daten aus Dateien zu lesen und in Dateien zu schreiben. Python bietet umfangreiche Funktionen für die Arbeit mit verschiedenen Dateiformaten.</p>
                        
                        <div class="file-basics">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="concept-card">
                                        <i class="bi bi-folder-open text-primary"></i>
                                        <h5>Dateien öffnen</h5>
                                        <p><code>open()</code> Funktion mit verschiedenen Modi</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="concept-card">
                                        <i class="bi bi-arrow-right text-success"></i>
                                        <h5>Lesen/Schreiben</h5>
                                        <p>Methoden wie <code>read()</code>, <code>write()</code>, <code>readline()</code></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="concept-card">
                                        <i class="bi bi-x-circle text-danger"></i>
                                        <h5>Dateien schließen</h5>
                                        <p><code>close()</code> oder <code>with</code>-Statement</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="concept-card">
                                        <i class="bi bi-shield-check text-warning"></i>
                                        <h5>Fehlerbehandlung</h5>
                                        <p>Exception Handling für File-Operationen</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="file-modes">
                            <h4>File-Modi</h4>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Modus</th>
                                            <th>Beschreibung</th>
                                            <th>Lesen</th>
                                            <th>Schreiben</th>
                                            <th>Datei existiert</th>
                                            <th>Datei existiert nicht</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><code>'r'</code></td>
                                            <td>Nur Lesen</td>
                                            <td>✅</td>
                                            <td>❌</td>
                                            <td>Öffnen</td>
                                            <td>Fehler</td>
                                        </tr>
                                        <tr>
                                            <td><code>'w'</code></td>
                                            <td>Nur Schreiben</td>
                                            <td>❌</td>
                                            <td>✅</td>
                                            <td>Überschreiben</td>
                                            <td>Erstellen</td>
                                        </tr>
                                        <tr>
                                            <td><code>'a'</code></td>
                                            <td>Anhängen</td>
                                            <td>❌</td>
                                            <td>✅</td>
                                            <td>Am Ende anhängen</td>
                                            <td>Erstellen</td>
                                        </tr>
                                        <tr>
                                            <td><code>'r+'</code></td>
                                            <td>Lesen und Schreiben</td>
                                            <td>✅</td>
                                            <td>✅</td>
                                            <td>Öffnen</td>
                                            <td>Fehler</td>
                                        </tr>
                                        <tr>
                                            <td><code>'w+'</code></td>
                                            <td>Lesen und Schreiben</td>
                                            <td>✅</td>
                                            <td>✅</td>
                                            <td>Überschreiben</td>
                                            <td>Erstellen</td>
                                        </tr>
                                        <tr>
                                            <td><code>'a+'</code></td>
                                            <td>Lesen und Anhängen</td>
                                            <td>✅</td>
                                            <td>✅</td>
                                            <td>Öffnen, Schreiben am Ende</td>
                                            <td>Erstellen</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <p><strong>Zusätzliche Modi:</strong> Füge <code>'b'</code> für binäre Dateien hinzu (z.B. <code>'rb'</code>, <code>'wb'</code>) oder <code>'t'</code> für Text (Standard).</p>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Dateien öffnen und schließen</h2>
                        <p>Die grundlegenden Operationen zum Arbeiten mit Dateien:</p>
                        
                        <div class="file-operations">
                            <div class="basic-file-ops">
                                <h4>Grundlegende File-Operationen</h4>
                                <div class="code-block">
<pre><code class="language-python"># 1. Datei öffnen und manuell schließen
print("=== MANUELLES ÖFFNEN UND SCHLIEßEN ===")

# Datei zum Schreiben öffnen
file = open("example.txt", "w", encoding="utf-8")
file.write("Hallo Welt!\n")
file.write("Das ist eine Testdatei.\n")
file.close()  # Wichtig: Datei schließen!

print("Datei 'example.txt' erstellt")

# Datei zum Lesen öffnen
file = open("example.txt", "r", encoding="utf-8")
content = file.read()
print(f"Dateiinhalt:\n{content}")
file.close()

# 2. Mit try-finally für sicheres Schließen
print("\n=== MIT TRY-FINALLY ===")

try:
    file = open("example.txt", "r", encoding="utf-8")
    content = file.read()
    print(f"Inhalt gelesen: {len(content)} Zeichen")
finally:
    if 'file' in locals() and not file.closed:
        file.close()
        print("Datei sicher geschlossen")

# 3. Mit with-Statement (EMPFOHLEN!)
print("\n=== MIT WITH-STATEMENT (EMPFOHLEN) ===")

# Automatisches Schließen der Datei
with open("example.txt", "r", encoding="utf-8") as file:
    content = file.read()
    print(f"Mit with-Statement: {content.strip()}")
# Datei wird automatisch geschlossen, auch bei Fehlern!

# Mehrere Dateien gleichzeitig
print("\n=== MEHRERE DATEIEN ===")

with open("input.txt", "w", encoding="utf-8") as input_file, \
     open("output.txt", "w", encoding="utf-8") as output_file:
    
    input_file.write("Original Text\n")
    output_file.write("Verarbeiteter Text\n")
    print("Beide Dateien geschrieben")

# 4. Dateimodi demonstrieren
print("\n=== VERSCHIEDENE MODI ===")

# Write-Modus (überschreibt)
with open("test_modes.txt", "w") as f:
    f.write("Erste Zeile\n")

# Append-Modus (hängt an)
with open("test_modes.txt", "a") as f:
    f.write("Zweite Zeile\n")
    f.write("Dritte Zeile\n")

# Lesen und Inhalt anzeigen
with open("test_modes.txt", "r") as f:
    lines = f.readlines()
    print(f"Datei hat {len(lines)} Zeilen:")
    for i, line in enumerate(lines, 1):
        print(f"  {i}: {line.strip()}")

# 5. Read/Write Modus
print("\n=== READ/WRITE MODUS ===")

# r+ : Lesen und Schreiben (Datei muss existieren)
with open("test_modes.txt", "r+") as f:
    content = f.read()
    print(f"Original Inhalt: {repr(content)}")
    
    # Am Ende hinzufügen
    f.write("Vierte Zeile\n")
    
    # Zum Anfang zurück für erneutes Lesen
    f.seek(0)
    new_content = f.read()
    print(f"Neuer Inhalt: {repr(new_content)}")

# 6. Encoding demonstrieren
print("\n=== ENCODING ===")

# UTF-8 mit Umlauten
german_text = "Hällö Wörld! Schöne Grüße aus München! 🇩🇪"

with open("german.txt", "w", encoding="utf-8") as f:
    f.write(german_text)

# Lesen mit verschiedenen Encodings
with open("german.txt", "r", encoding="utf-8") as f:
    content_utf8 = f.read()
    print(f"UTF-8: {content_utf8}")

# Was passiert ohne richtiges Encoding?
try:
    with open("german.txt", "r", encoding="ascii") as f:
        content_ascii = f.read()
except UnicodeDecodeError as e:
    print(f"ASCII Fehler: {e}")

# 7. Binäre Dateien
print("\n=== BINÄRE DATEIEN ===")

# Binäre Daten schreiben
binary_data = b'\x48\x65\x6c\x6c\x6f\x00\x57\x6f\x72\x6c\x64'  # "Hello\0World"

with open("binary.bin", "wb") as f:
    f.write(binary_data)
    print(f"Binäre Daten geschrieben: {len(binary_data)} bytes")

# Binäre Daten lesen
with open("binary.bin", "rb") as f:
    read_data = f.read()
    print(f"Binäre Daten gelesen: {read_data}")
    print(f"Als Text interpretiert: {read_data.decode('ascii', errors='replace')}")

# 8. Dateigröße und -informationen
print("\n=== DATEI-INFORMATIONEN ===")

import os
import stat
from datetime import datetime

def get_file_info(filename):
    """Gibt Datei-Informationen zurück"""
    try:
        file_stat = os.stat(filename)
        return {
            "size": file_stat.st_size,
            "created": datetime.fromtimestamp(file_stat.st_ctime),
            "modified": datetime.fromtimestamp(file_stat.st_mtime),
            "permissions": stat.filemode(file_stat.st_mode)
        }
    except FileNotFoundError:
        return None

# Informationen über unsere Testdateien
for filename in ["example.txt", "test_modes.txt", "binary.bin"]:
    info = get_file_info(filename)
    if info:
        print(f"{filename}:")
        print(f"  Größe: {info['size']} bytes")
        print(f"  Erstellt: {info['created']}")
        print(f"  Geändert: {info['modified']}")
        print(f"  Rechte: {info['permissions']}")

# 9. Fehlerbehandlung
print("\n=== FEHLERBEHANDLUNG ===")

def safe_file_operation(filename, mode="r"):
    """Sichere Dateioperationen mit Fehlerbehandlung"""
    try:
        with open(filename, mode, encoding="utf-8") as f:
            if "r" in mode:
                content = f.read()
                return f"Erfolgreich gelesen: {len(content)} Zeichen"
            else:
                f.write("Test content\n")
                return f"Erfolgreich geschrieben in {filename}"
                
    except FileNotFoundError:
        return f"Fehler: Datei '{filename}' nicht gefunden"
    except PermissionError:
        return f"Fehler: Keine Berechtigung für '{filename}'"
    except UnicodeDecodeError as e:
        return f"Fehler: Encoding-Problem - {e}"
    except Exception as e:
        return f"Unerwarteter Fehler: {e}"

# Tests
print(safe_file_operation("example.txt", "r"))           # OK
print(safe_file_operation("nonexistent.txt", "r"))       # FileNotFoundError
print(safe_file_operation("new_file.txt", "w"))          # OK

# 10. Context Manager für komplexere Operationen
print("\n=== CUSTOM CONTEXT MANAGER ===")

class FileManager:
    """Custom Context Manager für Dateien mit Logging"""
    
    def __init__(self, filename, mode="r", encoding="utf-8"):
        self.filename = filename
        self.mode = mode
        self.encoding = encoding
        self.file = None
    
    def __enter__(self):
        print(f"Öffne {self.filename} im Modus '{self.mode}'")
        try:
            self.file = open(self.filename, self.mode, encoding=self.encoding)
            return self.file
        except Exception as e:
            print(f"Fehler beim Öffnen: {e}")
            raise
    
    def __exit__(self, exc_type, exc_val, exc_tb):
        if self.file:
            print(f"Schließe {self.filename}")
            self.file.close()
        
        if exc_type:
            print(f"Exception aufgetreten: {exc_type.__name__}: {exc_val}")
        
        return False  # Exception nicht unterdrücken

# Verwendung des Custom Context Managers
with FileManager("example.txt", "r") as f:
    content = f.read()
    print(f"Content: {content[:50]}...")

# Cleanup - Testdateien löschen
print("\n=== CLEANUP ===")
test_files = ["example.txt", "input.txt", "output.txt", "test_modes.txt", 
             "german.txt", "binary.bin", "new_file.txt"]

for filename in test_files:
    try:
        os.remove(filename)
        print(f"Gelöscht: {filename}")
    except FileNotFoundError:
        pass
    except Exception as e:
        print(f"Fehler beim Löschen von {filename}: {e}")</code></pre>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Dateien lesen</h2>
                        <p>Verschiedene Methoden zum Lesen von Dateiinhalten:</p>
                        
                        <div class="reading-methods">
                            <div class="read-operations">
                                <h4>Read-Methoden</h4>
                                <div class="code-block">
<pre><code class="language-python"># Testdatei erstellen
sample_content = """Python File I/O Tutorial
======================

Zeile 1: Erste Datenzeile
Zeile 2: Zweite Datenzeile  
Zeile 3: Dritte Datenzeile

Diese Datei enthält verschiedene
Arten von Inhalten zur Demonstration
der verschiedenen Lesemethoden.

Zahlen: 1, 2, 3, 4, 5
Ende der Datei."""

with open("sample.txt", "w", encoding="utf-8") as f:
    f.write(sample_content)

print("=== VERSCHIEDENE LESEMETHODEN ===")

# 1. read() - komplette Datei lesen
print("\n1. KOMPLETTE DATEI LESEN")
with open("sample.txt", "r", encoding="utf-8") as f:
    content = f.read()
    print(f"Gesamter Inhalt ({len(content)} Zeichen):")
    print(content[:100] + "..." if len(content) > 100 else content)

# 2. read(size) - bestimmte Anzahl Zeichen lesen
print("\n2. TEILWEISE LESEN")
with open("sample.txt", "r", encoding="utf-8") as f:
    first_50 = f.read(50)
    next_30 = f.read(30)
    print(f"Erste 50 Zeichen: {repr(first_50)}")
    print(f"Nächste 30 Zeichen: {repr(next_30)}")

# 3. readline() - eine Zeile lesen
print("\n3. ZEILENWEISE LESEN")
with open("sample.txt", "r", encoding="utf-8") as f:
    line1 = f.readline()
    line2 = f.readline()
    line3 = f.readline()
    
    print(f"Zeile 1: {repr(line1)}")
    print(f"Zeile 2: {repr(line2)}")  
    print(f"Zeile 3: {repr(line3)}")

# 4. readlines() - alle Zeilen als Liste
print("\n4. ALLE ZEILEN ALS LISTE")
with open("sample.txt", "r", encoding="utf-8") as f:
    lines = f.readlines()
    print(f"Anzahl Zeilen: {len(lines)}")
    
    for i, line in enumerate(lines[:5], 1):  # Erste 5 Zeilen
        print(f"  {i:2d}: {repr(line)}")

# 5. Iteration über Datei (speicherschonend)
print("\n5. ITERATION ÜBER DATEI")
with open("sample.txt", "r", encoding="utf-8") as f:
    print("Zeilen mit 'Zeile' im Text:")
    for line_num, line in enumerate(f, 1):
        if "Zeile" in line:
            print(f"  {line_num}: {line.strip()}")

# 6. File-Position kontrollieren
print("\n6. FILE-POSITION KONTROLLIEREN")
with open("sample.txt", "r", encoding="utf-8") as f:
    print(f"Start-Position: {f.tell()}")
    
    first_line = f.readline()
    print(f"Nach erster Zeile: Position {f.tell()}")
    print(f"Erste Zeile war: {repr(first_line)}")
    
    # Zum Anfang zurückspringen
    f.seek(0)
    print(f"Nach seek(0): Position {f.tell()}")
    
    # Zu bestimmter Position springen
    f.seek(50)
    print(f"Nach seek(50): Position {f.tell()}")
    rest = f.read(20)
    print(f"20 Zeichen ab Position 50: {repr(rest)}")
    
    # Zum Ende springen
    f.seek(0, 2)  # 2 = Ende der Datei
    print(f"Dateigröße: {f.tell()} Zeichen")

# 7. Große Dateien effizient lesen
print("\n7. GROSSE DATEIEN (CHUNKED READING)")

def read_in_chunks(filename, chunk_size=1024):
    """Liest Datei in Chunks (für große Dateien)"""
    chunks = []
    with open(filename, "r", encoding="utf-8") as f:
        while True:
            chunk = f.read(chunk_size)
            if not chunk:  # Ende der Datei erreicht
                break
            chunks.append(chunk)
    return chunks

chunks = read_in_chunks("sample.txt", chunk_size=50)
print(f"Datei in {len(chunks)} Chunks gelesen:")
for i, chunk in enumerate(chunks):
    print(f"  Chunk {i+1}: {repr(chunk[:30])}{'...' if len(chunk) > 30 else ''}")

# 8. CSV-ähnliche Daten lesen
print("\n8. STRUKTURIERTE DATEN LESEN")

# CSV-Testdatei erstellen
csv_content = """Name,Age,City,Salary
Alice Johnson,28,Berlin,75000
Bob Smith,34,Munich,82000
Charlie Brown,25,Hamburg,58000
Diana Prince,31,Cologne,70000
Eve Wilson,29,Frankfurt,76000"""

with open("employees.csv", "w", encoding="utf-8") as f:
    f.write(csv_content)

# CSV manuell parsen
with open("employees.csv", "r", encoding="utf-8") as f:
    header = f.readline().strip().split(",")
    print(f"Header: {header}")
    
    employees = []
    for line_num, line in enumerate(f, 2):  # Ab Zeile 2
        if line.strip():  # Nicht-leere Zeilen
            values = line.strip().split(",")
            employee = dict(zip(header, values))
            employees.append(employee)
    
    print(f"\nMitarbeiter ({len(employees)} Datensätze):")
    for emp in employees:
        print(f"  {emp['Name']}: {emp['Age']} Jahre, {emp['City']}, ${emp['Salary']}")

# 9. JSON-Datei lesen
print("\n9. JSON-DATEI LESEN")
import json

# JSON-Testdatei erstellen
data = {
    "company": "TechCorp",
    "employees": [
        {"name": "Alice", "department": "Engineering", "skills": ["Python", "JavaScript"]},
        {"name": "Bob", "department": "Marketing", "skills": ["SEO", "Content"]}
    ],
    "founded": 2020
}

with open("company.json", "w", encoding="utf-8") as f:
    json.dump(data, f, indent=2)

# JSON lesen und parsen
with open("company.json", "r", encoding="utf-8") as f:
    company_data = json.load(f)

print(f"Firma: {company_data['company']}")
print(f"Gegründet: {company_data['founded']}")
print("Mitarbeiter:")
for emp in company_data['employees']:
    skills = ", ".join(emp['skills'])
    print(f"  {emp['name']} ({emp['department']}): {skills}")

# 10. Fehlerbehandlung beim Lesen
print("\n10. FEHLERBEHANDLUNG BEIM LESEN")

def safe_read_file(filename, encoding="utf-8"):
    """Sichere Datei-Lese-Funktion mit umfassendem Error Handling"""
    try:
        with open(filename, "r", encoding=encoding) as f:
            content = f.read()
            return {
                "success": True,
                "content": content,
                "size": len(content),
                "lines": content.count('\n') + 1 if content else 0
            }
    
    except FileNotFoundError:
        return {"success": False, "error": f"Datei '{filename}' nicht gefunden"}
    
    except PermissionError:
        return {"success": False, "error": f"Keine Leseberechtigung für '{filename}'"}
    
    except UnicodeDecodeError as e:
        return {"success": False, "error": f"Encoding-Fehler: {e}"}
    
    except MemoryError:
        return {"success": False, "error": f"Datei '{filename}' zu groß für Speicher"}
    
    except Exception as e:
        return {"success": False, "error": f"Unerwarteter Fehler: {e}"}

# Tests der sicheren Lese-Funktion
test_files = ["sample.txt", "nonexistent.txt", "employees.csv"]

for filename in test_files:
    result = safe_read_file(filename)
    if result["success"]:
        print(f"✅ {filename}: {result['size']} Zeichen, {result['lines']} Zeilen")
    else:
        print(f"❌ {filename}: {result['error']}")

# 11. Spezielle Zeichen und Encodings
print("\n11. ENCODING-PROBLEME")

# Datei mit verschiedenen Encodings erstellen
special_text = "Café naïve résumé 北京 москва العربية 🌍🚀"

# Als UTF-8 speichern
with open("utf8.txt", "w", encoding="utf-8") as f:
    f.write(special_text)

# Als Latin-1 speichern (nur ASCII-kompatible Teile)
ascii_text = "Cafe naive resume"
with open("latin1.txt", "w", encoding="latin-1") as f:
    f.write(ascii_text)

# Verschiedene Encodings beim Lesen testen
encodings = ["utf-8", "latin-1", "ascii"]

for filename in ["utf8.txt", "latin1.txt"]:
    print(f"\nLese {filename} mit verschiedenen Encodings:")
    
    for enc in encodings:
        try:
            with open(filename, "r", encoding=enc) as f:
                content = f.read()
                print(f"  {enc:8}: {content}")
        except UnicodeDecodeError as e:
            print(f"  {enc:8}: ❌ {e}")
        except Exception as e:
            print(f"  {enc:8}: ❌ {e}")

# Cleanup
import os
test_files = ["sample.txt", "employees.csv", "company.json", "utf8.txt", "latin1.txt"]
for filename in test_files:
    try:
        os.remove(filename)
    except FileNotFoundError:
        pass</code></pre>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Dateien schreiben</h2>
                        <p>Verschiedene Methoden zum Schreiben in Dateien:</p>
                        
                        <div class="writing-methods">
                            <div class="write-operations">
                                <h4>Write-Methoden</h4>
                                <div class="code-block">
<pre><code class="language-python">import os
from datetime import datetime

print("=== VERSCHIEDENE SCHREIBMETHODEN ===")

# 1. write() - String schreiben
print("\n1. EINFACHES SCHREIBEN")

with open("output.txt", "w", encoding="utf-8") as f:
    bytes_written = f.write("Hallo Welt!\n")
    print(f"Geschrieben: {bytes_written} Zeichen")
    
    # Mehrere write()-Aufrufe
    f.write("Zweite Zeile\n")
    f.write("Dritte Zeile\n")

# Datei lesen zur Verifikation
with open("output.txt", "r", encoding="utf-8") as f:
    content = f.read()
    print(f"Geschriebener Inhalt:\n{content}")

# 2. writelines() - Liste von Strings schreiben
print("\n2. MEHRERE ZEILEN SCHREIBEN")

lines = [
    "Zeile 1\n",
    "Zeile 2\n", 
    "Zeile 3\n",
    "Zeile ohne Newline"
]

with open("multiline.txt", "w", encoding="utf-8") as f:
    f.writelines(lines)

# Ohne \n müssen wir sie manuell hinzufügen
lines_no_newline = ["Alpha", "Beta", "Gamma", "Delta"]

with open("multiline2.txt", "w", encoding="utf-8") as f:
    for line in lines_no_newline:
        f.write(line + "\n")

print("Multiline-Dateien erstellt")

# 3. Append-Modus
print("\n3. ANHÄNGEN AN BESTEHENDE DATEI")

# Erst eine Basisdatei erstellen
with open("append_test.txt", "w", encoding="utf-8") as f:
    f.write("Ursprünglicher Inhalt\n")

# Dann anhängen
with open("append_test.txt", "a", encoding="utf-8") as f:
    f.write("Angehängter Inhalt 1\n")
    f.write("Angehängter Inhalt 2\n")

# Ergebnis prüfen
with open("append_test.txt", "r", encoding="utf-8") as f:
    print("Inhalt nach Anhängen:")
    print(f.read())

# 4. Formatierte Ausgabe
print("\n4. FORMATIERTE AUSGABE")

data = {
    "name": "Alice Johnson",
    "age": 28,
    "salary": 75000,
    "skills": ["Python", "JavaScript", "SQL"]
}

with open("formatted.txt", "w", encoding="utf-8") as f:
    # f-strings verwenden
    f.write(f"Mitarbeiter-Report\n")
    f.write(f"==================\n")
    f.write(f"Name: {data['name']}\n")
    f.write(f"Alter: {data['age']} Jahre\n")
    f.write(f"Gehalt: ${data['salary']:,}\n")
    f.write(f"Fähigkeiten: {', '.join(data['skills'])}\n")
    f.write(f"Report erstellt am: {datetime.now().strftime('%Y-%m-%d %H:%M:%S')}\n")

print("Formatierte Datei erstellt")

# 5. CSV-Daten schreiben
print("\n5. CSV-DATEN SCHREIBEN")

employees = [
    ["Name", "Age", "Department", "Salary"],
    ["Alice Johnson", 28, "Engineering", 75000],
    ["Bob Smith", 34, "Marketing", 65000],
    ["Charlie Brown", 25, "Design", 58000],
    ["Diana Prince", 31, "Sales", 70000]
]

# Manuell CSV schreiben
with open("employees_manual.csv", "w", encoding="utf-8") as f:
    for row in employees:
        # Strings in Anführungszeichen, falls sie Kommas enthalten
        formatted_row = []
        for item in row:
            if isinstance(item, str) and ("," in item or '"' in item):
                # Escape quotes and wrap in quotes
                formatted_row.append(f'"{item.replace('"', '""')}"')
            else:
                formatted_row.append(str(item))
        
        f.write(",".join(formatted_row) + "\n")

print("CSV-Datei manuell erstellt")

# Mit csv-Modul (einfacher)
import csv

with open("employees_csv.csv", "w", newline="", encoding="utf-8") as f:
    writer = csv.writer(f)
    writer.writerows(employees)

print("CSV-Datei mit csv-Modul erstellt")

# 6. JSON-Daten schreiben
print("\n6. JSON-DATEN SCHREIBEN")

company_data = {
    "company": "TechCorp",
    "employees": [
        {
            "name": "Alice Johnson",
            "age": 28,
            "department": "Engineering",
            "skills": ["Python", "JavaScript", "SQL"],
            "active": True
        },
        {
            "name": "Bob Smith", 
            "age": 34,
            "department": "Marketing",
            "skills": ["SEO", "Content Marketing"],
            "active": True
        }
    ],
    "founded": 2020,
    "locations": ["Berlin", "Munich", "Hamburg"]
}

import json

# Kompakte JSON-Ausgabe
with open("company_compact.json", "w", encoding="utf-8") as f:
    json.dump(company_data, f, ensure_ascii=False)

# Formatierte JSON-Ausgabe
with open("company_formatted.json", "w", encoding="utf-8") as f:
    json.dump(company_data, f, indent=2, ensure_ascii=False, sort_keys=True)

print("JSON-Dateien erstellt")

# 7. Binäre Daten schreiben
print("\n7. BINÄRE DATEN SCHREIBEN")

# Bytes direkt schreiben
binary_data = bytes([0x50, 0x4B, 0x03, 0x04])  # ZIP-Dateisignatur
binary_data += b"Hello World in Binary\x00"

with open("binary_data.bin", "wb") as f:
    f.write(binary_data)

# Integer-Array als binäre Daten
import struct

numbers = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10]

with open("numbers.bin", "wb") as f:
    for num in numbers:
        # Integer als 4-byte little-endian schreiben
        f.write(struct.pack("<i", num))

print("Binäre Dateien erstellt")

# 8. Text mit verschiedenen Encodings schreiben
print("\n8. VERSCHIEDENE ENCODINGS")

multilingual_text = """
English: Hello World
Deutsch: Hallo Welt
Français: Bonjour le monde
Español: Hola mundo
中文: 你好世界
日本語: こんにちは世界
Русский: Привет мир
العربية: مرحبا بالعالم
"""

encodings = ["utf-8", "utf-16", "latin1"]

for encoding in encodings:
    filename = f"multilingual_{encoding.replace('-', '_')}.txt"
    try:
        with open(filename, "w", encoding=encoding) as f:
            f.write(multilingual_text)
        print(f"✅ {filename} erstellt mit {encoding}")
    except UnicodeEncodeError as e:
        print(f"❌ {filename}: Encoding-Fehler mit {encoding}: {e}")

# 9. Große Datenmengen schreiben (Streaming)
print("\n9. GROSSE DATENMENGEN (STREAMING)")

def generate_large_file(filename, num_lines=10000):
    """Erstellt große Datei zeilenweise"""
    with open(filename, "w", encoding="utf-8") as f:
        for i in range(num_lines):
            # Simuliere Datenzeile
            line = f"Line {i+1:06d}: Data timestamp {datetime.now()} - Random value {i*37%100}\n"
            f.write(line)
            
            # Progress alle 1000 Zeilen
            if (i + 1) % 1000 == 0:
                print(f"  Geschrieben: {i+1} Zeilen")

print("Erstelle große Datei...")
generate_large_file("large_data.txt", 5000)  # Reduziert für Demo

# 10. Sichere Schreiboperationen
print("\n10. SICHERE SCHREIBOPERATIONEN")

def safe_write_file(filename, content, encoding="utf-8", backup=True):
    """Sichere Dateischreibung mit Backup und Atomic Operations"""
    import tempfile
    import shutil
    
    try:
        # Backup erstellen falls Datei existiert
        if backup and os.path.exists(filename):
            backup_name = f"{filename}.backup"
            shutil.copy2(filename, backup_name)
            print(f"Backup erstellt: {backup_name}")
        
        # Temporary file für atomic write
        temp_fd, temp_path = tempfile.mkstemp(dir=os.path.dirname(filename) or ".")
        
        try:
            with os.fdopen(temp_fd, 'w', encoding=encoding) as temp_file:
                temp_file.write(content)
                temp_file.flush()
                os.fsync(temp_file.fileno())  # Force write to disk
            
            # Atomic move (auf Unix-Systemen)
            shutil.move(temp_path, filename)
            print(f"✅ Datei sicher geschrieben: {filename}")
            return True
            
        except Exception:
            # Cleanup temp file on error
            if os.path.exists(temp_path):
                os.unlink(temp_path)
            raise
            
    except Exception as e:
        print(f"❌ Fehler beim Schreiben von {filename}: {e}")
        return False

# Test der sicheren Schreibfunktion
test_content = "Wichtige Daten die sicher gespeichert werden müssen!\n" * 10

safe_write_file("important.txt", test_content)

# 11. Log-Datei schreiben
print("\n11. LOG-DATEI SCHREIBEN")

class SimpleLogger:
    def __init__(self, filename):
        self.filename = filename
        
    def log(self, level, message):
        timestamp = datetime.now().strftime("%Y-%m-%d %H:%M:%S")
        log_entry = f"[{timestamp}] {level.upper()}: {message}\n"
        
        with open(self.filename, "a", encoding="utf-8") as f:
            f.write(log_entry)
    
    def info(self, message):
        self.log("info", message)
    
    def warning(self, message):
        self.log("warning", message)
    
    def error(self, message):
        self.log("error", message)

# Logger verwenden
logger = SimpleLogger("application.log")

logger.info("Anwendung gestartet")
logger.info("Dateien werden verarbeitet")
logger.warning("Temp-Datei nicht gefunden, wird erstellt")
logger.error("Fehler beim Verarbeiten von Datei XYZ")
logger.info("Anwendung beendet")

print("Log-Datei erstellt")

# 12. Performance-Vergleich verschiedener Schreibmethoden
print("\n12. PERFORMANCE-VERGLEICH")

import time

def time_write_method(method_name, write_function, num_operations=1000):
    """Misst Zeit für Schreiboperation"""
    start_time = time.time()
    write_function(num_operations)
    end_time = time.time()
    print(f"{method_name}: {end_time - start_time:.3f} Sekunden")

def write_individual(n):
    with open("perf_individual.txt", "w") as f:
        for i in range(n):
            f.write(f"Line {i}\n")

def write_batch(n):
    lines = [f"Line {i}\n" for i in range(n)]
    with open("perf_batch.txt", "w") as f:
        f.writelines(lines)

def write_buffered(n):
    buffer = []
    with open("perf_buffered.txt", "w") as f:
        for i in range(n):
            buffer.append(f"Line {i}\n")
            if len(buffer) >= 100:  # Flush every 100 lines
                f.writelines(buffer)
                buffer = []
        if buffer:  # Flush remaining
            f.writelines(buffer)

print("Performance-Test mit 1000 Zeilen:")
time_write_method("Einzeln schreiben", write_individual, 1000)
time_write_method("Batch schreiben", write_batch, 1000)
time_write_method("Gepuffert schreiben", write_buffered, 1000)

# Cleanup - alle erstellten Dateien löschen
print("\n=== CLEANUP ===")
cleanup_files = [
    "output.txt", "multiline.txt", "multiline2.txt", "append_test.txt",
    "formatted.txt", "employees_manual.csv", "employees_csv.csv",
    "company_compact.json", "company_formatted.json", "binary_data.bin",
    "numbers.bin", "multilingual_utf_8.txt", "multilingual_utf_16.txt",
    "large_data.txt", "important.txt", "important.txt.backup",
    "application.log", "perf_individual.txt", "perf_batch.txt", "perf_buffered.txt"
]

for filename in cleanup_files:
    try:
        if os.path.exists(filename):
            os.remove(filename)
            print(f"Gelöscht: {filename}")
    except Exception as e:
        print(f"Fehler beim Löschen von {filename}: {e}")

print("Cleanup abgeschlossen!")</code></pre>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Arbeiten mit Dateipfaden</h2>
                        <p>Python bietet verschiedene Module für die Arbeit mit Dateipfaden und Verzeichnissen:</p>
                        
                        <div class="path-operations">
                            <div class="path-handling">
                                <h4>os.path und pathlib</h4>
                                <div class="code-block">
<pre><code class="language-python">import os
from pathlib import Path
import tempfile

print("=== ARBEITEN MIT PFADEN ===")

# 1. os.path (traditionell)
print("\n1. OS.PATH MODULE")

# Aktuelle Verzeichnisse
current_dir = os.getcwd()
print(f"Aktuelles Verzeichnis: {current_dir}")

# Pfad-Operationen
file_path = os.path.join(current_dir, "data", "file.txt")
print(f"Zusammengesetzter Pfad: {file_path}")

# Pfad-Komponenten
directory = os.path.dirname(file_path)
filename = os.path.basename(file_path)
name, ext = os.path.splitext(filename)

print(f"Verzeichnis: {directory}")
print(f"Dateiname: {filename}")
print(f"Name: {name}, Endung: {ext}")

# Pfad-Tests
print(f"Pfad existiert: {os.path.exists(file_path)}")
print(f"Ist Datei: {os.path.isfile(file_path)}")
print(f"Ist Verzeichnis: {os.path.isdir(file_path)}")

# Absolute vs. relative Pfade
relative_path = "data/file.txt"
absolute_path = os.path.abspath(relative_path)
print(f"Relativer Pfad: {relative_path}")
print(f"Absoluter Pfad: {absolute_path}")

# 2. pathlib (modern, empfohlen)
print("\n2. PATHLIB MODULE (MODERN)")

# Path-Objekte erstellen
current_path = Path.cwd()
file_path = current_path / "data" / "file.txt"  # Elegant!

print(f"Aktuelles Verzeichnis: {current_path}")
print(f"File-Pfad: {file_path}")

# Pfad-Eigenschaften
print(f"Parent: {file_path.parent}")
print(f"Name: {file_path.name}")
print(f"Stem (ohne Endung): {file_path.stem}")
print(f"Suffix: {file_path.suffix}")
print(f"Teile: {file_path.parts}")

# Pfad-Tests
print(f"Existiert: {file_path.exists()}")
print(f"Ist Datei: {file_path.is_file()}")
print(f"Ist Verzeichnis: {file_path.is_dir()}")

# 3. Verzeichnisse erstellen und verwalten
print("\n3. VERZEICHNIS-OPERATIONEN")

# Test-Verzeichnisstruktur erstellen
test_dir = Path("test_files")
sub_dirs = ["documents", "images", "data/csv", "data/json"]

print("Erstelle Verzeichnisstruktur...")
for sub_dir in sub_dirs:
    dir_path = test_dir / sub_dir
    dir_path.mkdir(parents=True, exist_ok=True)
    print(f"  Erstellt: {dir_path}")

# Dateien in Verzeichnissen erstellen
test_files = {
    "documents/readme.txt": "This is a readme file\nWith some content",
    "documents/manual.txt": "User manual content here",
    "images/photo1.jpg": "Binary image data placeholder",
    "data/csv/users.csv": "name,age,city\nAlice,25,Berlin\nBob,30,Munich",
    "data/json/config.json": '{"debug": true, "version": "1.0"}'
}

for file_path, content in test_files.items():
    full_path = test_dir / file_path
    with open(full_path, "w", encoding="utf-8") as f:
        f.write(content)
    print(f"  Datei erstellt: {full_path}")

# 4. Verzeichnisse durchsuchen
print("\n4. VERZEICHNISSE DURCHSUCHEN")

# os.listdir
print("os.listdir():")
for item in os.listdir(test_dir):
    item_path = test_dir / item
    item_type = "DIR" if item_path.is_dir() else "FILE"
    print(f"  {item_type}: {item}")

# os.walk (rekursiv)
print("\nos.walk() - rekursiv:")
for root, dirs, files in os.walk(test_dir):
    level = root.replace(str(test_dir), "").count(os.sep)
    indent = "  " * level
    print(f"{indent}{os.path.basename(root)}/")
    
    sub_indent = "  " * (level + 1)
    for file in files:
        print(f"{sub_indent}{file}")

# pathlib.iterdir() und rglob()
print("\npathlib - alle .txt Dateien:")
for txt_file in test_dir.rglob("*.txt"):
    print(f"  {txt_file}")

print("\npathlib - alle JSON/CSV Dateien:")
for data_file in test_dir.rglob("*.json"):
    print(f"  JSON: {data_file}")
for data_file in test_dir.rglob("*.csv"):
    print(f"  CSV: {data_file}")

# 5. Datei-Informationen
print("\n5. DATEI-INFORMATIONEN")

def get_detailed_file_info(file_path):
    """Detaillierte Datei-Informationen"""
    path = Path(file_path)
    
    if not path.exists():
        return f"Datei {path} existiert nicht"
    
    stat = path.stat()
    
    info = {
        "name": path.name,
        "size": stat.st_size,
        "created": stat.st_ctime,
        "modified": stat.st_mtime,
        "accessed": stat.st_atime,
        "is_file": path.is_file(),
        "is_dir": path.is_dir(),
        "parent": path.parent,
        "absolute": path.absolute()
    }
    
    return info

# Informationen für alle Dateien
for txt_file in test_dir.rglob("*"):
    if txt_file.is_file():
        info = get_detailed_file_info(txt_file)
        print(f"\n📄 {info['name']}")
        print(f"   Größe: {info['size']} bytes")
        print(f"   Pfad: {info['absolute']}")

# 6. Dateien kopieren, verschieben, löschen
print("\n6. DATEI-OPERATIONEN")

import shutil

# Datei kopieren
source = test_dir / "documents" / "readme.txt"
destination = test_dir / "documents" / "readme_copy.txt"

shutil.copy2(source, destination)  # copy2 erhält Metadaten
print(f"Kopiert: {source} -> {destination}")

# Verzeichnis kopieren
source_dir = test_dir / "documents"
dest_dir = test_dir / "documents_backup"

shutil.copytree(source_dir, dest_dir)
print(f"Verzeichnis kopiert: {source_dir} -> {dest_dir}")

# Datei verschieben/umbenennen
old_path = test_dir / "images" / "photo1.jpg"
new_path = test_dir / "images" / "photo1_renamed.jpg"

old_path.rename(new_path)
print(f"Umbenannt: {old_path} -> {new_path}")

# 7. Temporäre Dateien und Verzeichnisse
print("\n7. TEMPORÄRE DATEIEN")

# Temporäre Datei
with tempfile.NamedTemporaryFile(mode="w", suffix=".txt", delete=False) as temp_file:
    temp_file.write("Temporärer Inhalt")
    temp_path = temp_file.name

print(f"Temporäre Datei erstellt: {temp_path}")

# Temporäres Verzeichnis
with tempfile.TemporaryDirectory() as temp_dir:
    temp_path = Path(temp_dir)
    test_file = temp_path / "temp_test.txt"
    
    with open(test_file, "w") as f:
        f.write("Test in temp directory")
    
    print(f"Temp-Verzeichnis: {temp_path}")
    print(f"Dateien in temp dir: {list(temp_path.iterdir())}")
# Temp-Verzeichnis wird automatisch gelöscht

# 8. Dateisystem-Überwachung (einfache Version)
print("\n8. DATEI-ÜBERWACHUNG")

def monitor_directory_changes(directory, duration=5):
    """Einfache Verzeichnis-Überwachung"""
    import time
    
    path = Path(directory)
    initial_files = {f.name: f.stat().st_mtime for f in path.rglob("*") if f.is_file()}
    
    print(f"Überwache {directory} für {duration} Sekunden...")
    time.sleep(duration)
    
    current_files = {f.name: f.stat().st_mtime for f in path.rglob("*") if f.is_file()}
    
    # Neue Dateien
    new_files = set(current_files.keys()) - set(initial_files.keys())
    
    # Gelöschte Dateien
    deleted_files = set(initial_files.keys()) - set(current_files.keys())
    
    # Geänderte Dateien
    changed_files = []
    for filename in set(initial_files.keys()) & set(current_files.keys()):
        if initial_files[filename] != current_files[filename]:
            changed_files.append(filename)
    
    print(f"Neue Dateien: {new_files}")
    print(f"Gelöschte Dateien: {deleted_files}")
    print(f"Geänderte Dateien: {changed_files}")

# Kurze Demo (nur 1 Sekunde)
# monitor_directory_changes(test_dir, 1)

# 9. Pfad-Utilities
print("\n9. PFAD-UTILITIES")

def find_files_by_pattern(directory, pattern, max_size=None, min_size=None):
    """Findet Dateien nach Pattern und Größe"""
    path = Path(directory)
    matches = []
    
    for file_path in path.rglob(pattern):
        if file_path.is_file():
            size = file_path.stat().st_size
            
            if max_size and size > max_size:
                continue
            if min_size and size < min_size:
                continue
                
            matches.append({
                "path": file_path,
                "size": size,
                "name": file_path.name
            })
    
    return matches

# Alle .txt Dateien unter 100 bytes finden
small_txt_files = find_files_by_pattern(test_dir, "*.txt", max_size=100)
print(f"Kleine .txt Dateien (<100 bytes):")
for file_info in small_txt_files:
    print(f"  {file_info['name']}: {file_info['size']} bytes")

# 10. Cross-platform Pfade
print("\n10. CROSS-PLATFORM PFADE")

# Pfad-Separator
print(f"Pfad-Separator: '{os.sep}'")
print(f"Line-Separator: {repr(os.linesep)}")

# Home-Verzeichnis
home_path = Path.home()
print(f"Home-Verzeichnis: {home_path}")

# Relative Pfade normalisieren
messy_path = Path("../data/../documents/./file.txt")
clean_path = messy_path.resolve()
print(f"Unordentlicher Pfad: {messy_path}")
print(f"Bereinigter Pfad: {clean_path}")

# URL-style Pfade zu OS-Pfaden
url_path = "data/documents/file.txt"
os_path = Path(url_path)
print(f"URL-style: {url_path}")
print(f"OS-Pfad: {os_path}")

# Cleanup - Test-Verzeichnisse löschen
print("\n=== CLEANUP ===")

def safe_remove_directory(directory):
    """Sicheres Löschen eines Verzeichnisses"""
    path = Path(directory)
    if path.exists() and path.is_dir():
        try:
            shutil.rmtree(path)
            print(f"✅ Verzeichnis gelöscht: {path}")
        except Exception as e:
            print(f"❌ Fehler beim Löschen von {path}: {e}")

safe_remove_directory("test_files")

# Temporäre Datei löschen (falls noch vorhanden)
if 'temp_path' in locals():
    try:
        os.unlink(temp_path)
        print(f"Temporäre Datei gelöscht: {temp_path}")
    except:
        pass

print("Pfad-Operations Demo abgeschlossen!")</code></pre>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Praktisches Beispiel: Datei-Management-System</h2>
                        <p>Ein vollständiges File-Management-System, das verschiedene File I/O-Konzepte demonstriert:</p>
                        
                        <div class="file-management-system">
                            <div class="code-header">
                                <span class="code-title">file_management_system.py</span>
                                <span class="badge bg-success">Vollständiges Beispiel</span>
                            </div>
                            <div class="code-block">
<pre><code class="language-python">#!/usr/bin/env python3
"""
File Management System
Demonstriert umfassende File I/O-Operationen in Python
"""

import os
import shutil
import json
import csv
from pathlib import Path
from datetime import datetime, timedelta
from collections import defaultdict, Counter
import hashlib
import tempfile

class FileManager:
    def __init__(self, base_directory="file_manager_data"):
        self.base_dir = Path(base_directory)
        self.base_dir.mkdir(exist_ok=True)
        self.index_file = self.base_dir / "file_index.json"
        self.log_file = self.base_dir / "operations.log"
        
        # File Index für schnelle Suchen
        self.file_index = self.load_index()
        
        print(f"FileManager initialisiert: {self.base_dir}")
    
    def log_operation(self, operation, details=""):
        """Protokolliert Operationen"""
        timestamp = datetime.now().strftime("%Y-%m-%d %H:%M:%S")
        log_entry = f"[{timestamp}] {operation}: {details}\n"
        
        with open(self.log_file, "a", encoding="utf-8") as f:
            f.write(log_entry)
    
    def load_index(self):
        """Lädt Datei-Index"""
        if self.index_file.exists():
            try:
                with open(self.index_file, "r", encoding="utf-8") as f:
                    return json.load(f)
            except (json.JSONDecodeError, Exception) as e:
                print(f"Warnung: Index-Datei beschädigt: {e}")
                return {}
        return {}
    
    def save_index(self):
        """Speichert Datei-Index"""
        try:
            with open(self.index_file, "w", encoding="utf-8") as f:
                json.dump(self.file_index, f, indent=2, ensure_ascii=False)
            self.log_operation("INDEX_SAVE", "File index saved")
        except Exception as e:
            print(f"Fehler beim Speichern des Index: {e}")
    
    def calculate_file_hash(self, file_path):
        """Berechnet MD5-Hash einer Datei"""
        hash_md5 = hashlib.md5()
        try:
            with open(file_path, "rb") as f:
                for chunk in iter(lambda: f.read(4096), b""):
                    hash_md5.update(chunk)
            return hash_md5.hexdigest()
        except Exception:
            return None
    
    def add_file(self, source_path, category="general", tags=None, description=""):
        """Fügt Datei zum System hinzu"""
        source = Path(source_path)
        
        if not source.exists():
            return False, f"Quelldatei nicht gefunden: {source}"
        
        if not source.is_file():
            return False, f"Quelle ist keine Datei: {source}"
        
        # Zielverzeichnis basierend auf Kategorie
        target_dir = self.base_dir / "files" / category
        target_dir.mkdir(parents=True, exist_ok=True)
        
        # Eindeutigen Dateinamen generieren falls nötig
        target_path = target_dir / source.name
        counter = 1
        while target_path.exists():
            stem = source.stem
            suffix = source.suffix
            target_path = target_dir / f"{stem}_{counter}{suffix}"
            counter += 1
        
        try:
            # Datei kopieren
            shutil.copy2(source, target_path)
            
            # Metadaten sammeln
            stat = target_path.stat()
            file_hash = self.calculate_file_hash(target_path)
            
            # Index aktualisieren
            file_id = str(len(self.file_index) + 1)
            self.file_index[file_id] = {
                "original_name": source.name,
                "current_path": str(target_path.relative_to(self.base_dir)),
                "category": category,
                "tags": tags or [],
                "description": description,
                "size": stat.st_size,
                "created": datetime.fromtimestamp(stat.st_ctime).isoformat(),
                "modified": datetime.fromtimestamp(stat.st_mtime).isoformat(),
                "added_to_system": datetime.now().isoformat(),
                "file_hash": file_hash,
                "access_count": 0
            }
            
            self.save_index()
            self.log_operation("FILE_ADD", f"{source.name} -> {target_path}")
            
            return True, f"Datei hinzugefügt: {file_id}"
            
        except Exception as e:
            return False, f"Fehler beim Hinzufügen: {e}"
    
    def find_files(self, **criteria):
        """Sucht Dateien nach verschiedenen Kriterien"""
        results = []
        
        for file_id, metadata in self.file_index.items():
            match = True
            
            # Name (Teilstring)
            if "name" in criteria:
                if criteria["name"].lower() not in metadata["original_name"].lower():
                    match = False
            
            # Kategorie
            if "category" in criteria:
                if metadata["category"] != criteria["category"]:
                    match = False
            
            # Tags
            if "tags" in criteria:
                if not any(tag in metadata["tags"] for tag in criteria["tags"]):
                    match = False
            
            # Größe
            if "min_size" in criteria:
                if metadata["size"] < criteria["min_size"]:
                    match = False
            
            if "max_size" in criteria:
                if metadata["size"] > criteria["max_size"]:
                    match = False
            
            # Datum
            if "after_date" in criteria:
                file_date = datetime.fromisoformat(metadata["added_to_system"])
                if file_date < criteria["after_date"]:
                    match = False
            
            if match:
                results.append((file_id, metadata))
        
        return results
    
    def get_file_content(self, file_id):
        """Liest Dateiinhalt (für Textdateien)"""
        if file_id not in self.file_index:
            return None, "Datei-ID nicht gefunden"
        
        metadata = self.file_index[file_id]
        file_path = self.base_dir / metadata["current_path"]
        
        if not file_path.exists():
            return None, "Datei nicht gefunden auf Disk"
        
        # Access count erhöhen
        metadata["access_count"] += 1
        self.save_index()
        
        try:
            # Versuche als Text zu lesen
            with open(file_path, "r", encoding="utf-8") as f:
                content = f.read()
            
            self.log_operation("FILE_READ", f"ID {file_id}: {metadata['original_name']}")
            return content, "OK"
            
        except UnicodeDecodeError:
            return None, "Datei ist nicht als Text lesbar"
        except Exception as e:
            return None, f"Fehler beim Lesen: {e}"
    
    def export_file(self, file_id, target_path):
        """Exportiert Datei aus dem System"""
        if file_id not in self.file_index:
            return False, "Datei-ID nicht gefunden"
        
        metadata = self.file_index[file_id]
        source_path = self.base_dir / metadata["current_path"]
        
        if not source_path.exists():
            return False, "Quelldatei nicht gefunden"
        
        try:
            target = Path(target_path)
            target.parent.mkdir(parents=True, exist_ok=True)
            
            shutil.copy2(source_path, target)
            
            # Access count erhöhen
            metadata["access_count"] += 1
            self.save_index()
            
            self.log_operation("FILE_EXPORT", f"ID {file_id} -> {target}")
            return True, f"Datei exportiert nach {target}"
            
        except Exception as e:
            return False, f"Export-Fehler: {e}"
    
    def delete_file(self, file_id):
        """Löscht Datei aus dem System"""
        if file_id not in self.file_index:
            return False, "Datei-ID nicht gefunden"
        
        metadata = self.file_index[file_id]
        file_path = self.base_dir / metadata["current_path"]
        
        try:
            if file_path.exists():
                os.remove(file_path)
            
            # Aus Index entfernen
            original_name = metadata["original_name"]
            del self.file_index[file_id]
            self.save_index()
            
            self.log_operation("FILE_DELETE", f"ID {file_id}: {original_name}")
            return True, f"Datei gelöscht: {original_name}"
            
        except Exception as e:
            return False, f"Lösch-Fehler: {e}"
    
    def find_duplicates(self):
        """Findet Duplikate basierend auf Hash"""
        hash_groups = defaultdict(list)
        
        for file_id, metadata in self.file_index.items():
            if metadata["file_hash"]:
                hash_groups[metadata["file_hash"]].append((file_id, metadata))
        
        duplicates = {hash_val: files for hash_val, files in hash_groups.items() if len(files) > 1}
        return duplicates
    
    def get_statistics(self):
        """Erstellt System-Statistiken"""
        if not self.file_index:
            return {"message": "Keine Dateien im System"}
        
        # Grundstatistiken
        total_files = len(self.file_index)
        total_size = sum(metadata["size"] for metadata in self.file_index.values())
        
        # Nach Kategorie
        by_category = Counter(metadata["category"] for metadata in self.file_index.values())
        
        # Nach Dateityp (Erweiterung)
        by_extension = Counter()
        for metadata in self.file_index.values():
            ext = Path(metadata["original_name"]).suffix.lower()
            by_extension[ext or "no_extension"] += 1
        
        # Größenverteilung
        size_ranges = {
            "< 1KB": 0, "1KB - 100KB": 0, "100KB - 1MB": 0, 
            "1MB - 10MB": 0, "10MB - 100MB": 0, "> 100MB": 0
        }
        
        for metadata in self.file_index.values():
            size = metadata["size"]
            if size < 1024:
                size_ranges["< 1KB"] += 1
            elif size < 100 * 1024:
                size_ranges["1KB - 100KB"] += 1
            elif size < 1024 * 1024:
                size_ranges["100KB - 1MB"] += 1
            elif size < 10 * 1024 * 1024:
                size_ranges["1MB - 10MB"] += 1
            elif size < 100 * 1024 * 1024:
                size_ranges["10MB - 100MB"] += 1
            else:
                size_ranges["> 100MB"] += 1
        
        # Aktivität
        most_accessed = max(self.file_index.items(), key=lambda x: x[1]["access_count"])
        
        return {
            "total_files": total_files,
            "total_size": total_size,
            "total_size_formatted": self.format_size(total_size),
            "by_category": dict(by_category),
            "by_extension": dict(by_extension.most_common(10)),
            "size_distribution": size_ranges,
            "most_accessed": {
                "id": most_accessed[0],
                "name": most_accessed[1]["original_name"],
                "count": most_accessed[1]["access_count"]
            }
        }
    
    @staticmethod
    def format_size(size_bytes):
        """Formatiert Dateigröße"""
        for unit in ['B', 'KB', 'MB', 'GB', 'TB']:
            if size_bytes < 1024:
                return f"{size_bytes:.1f} {unit}"
            size_bytes /= 1024
        return f"{size_bytes:.1f} PB"
    
    def backup_system(self, backup_path):
        """Erstellt Backup des gesamten Systems"""
        backup_dir = Path(backup_path)
        
        try:
            if backup_dir.exists():
                shutil.rmtree(backup_dir)
            
            shutil.copytree(self.base_dir, backup_dir)
            
            self.log_operation("SYSTEM_BACKUP", f"Backup erstellt: {backup_path}")
            return True, f"Backup erstellt: {backup_path}"
            
        except Exception as e:
            return False, f"Backup-Fehler: {e}"
    
    def cleanup_orphaned_files(self):
        """Bereinigt Dateien ohne Index-Eintrag"""
        files_dir = self.base_dir / "files"
        if not files_dir.exists():
            return 0, []
        
        # Alle indexierten Dateien sammeln
        indexed_files = set()
        for metadata in self.file_index.values():
            indexed_files.add(self.base_dir / metadata["current_path"])
        
        # Alle Dateien im System finden
        all_files = set(files_dir.rglob("*"))
        all_files = {f for f in all_files if f.is_file()}
        
        # Orphaned files finden
        orphaned = all_files - indexed_files
        
        # Orphaned files löschen
        deleted = []
        for file_path in orphaned:
            try:
                os.remove(file_path)
                deleted.append(str(file_path))
            except Exception:
                pass
        
        if deleted:
            self.log_operation("CLEANUP", f"{len(deleted)} orphaned files deleted")
        
        return len(deleted), deleted

def demo_file_manager():
    """Demonstriert das File Management System"""
    print("🗂️  FILE MANAGEMENT SYSTEM DEMO")
    print("=" * 60)
    
    # File Manager initialisieren
    fm = FileManager("demo_file_system")
    
    # 1. Test-Dateien erstellen
    print("\n📁 Erstelle Test-Dateien...")
    
    test_files = {
        "documents/report.txt": "Quarterly Report\n\nSales: $100,000\nProfit: $25,000",
        "documents/notes.txt": "Meeting Notes\n- Discuss project timeline\n- Review budget",
        "code/script.py": "#!/usr/bin/env python3\nprint('Hello, World!')\n",
        "code/config.json": '{"debug": true, "version": "1.0.0"}',
        "images/photo.jpg": "Binary image data placeholder",
        "data/users.csv": "name,age,city\nAlice,25,Berlin\nBob,30,Munich"
    }
    
    temp_dir = Path("temp_test_files")
    temp_dir.mkdir(exist_ok=True)
    
    created_files = []
    for file_path, content in test_files.items():
        full_path = temp_dir / file_path
        full_path.parent.mkdir(parents=True, exist_ok=True)
        
        with open(full_path, "w", encoding="utf-8") as f:
            f.write(content)
        
        created_files.append(full_path)
        print(f"  ✅ {file_path}")
    
    # 2. Dateien zum System hinzufügen
    print("\n➕ Füge Dateien zum System hinzu...")
    
    file_configs = [
        (created_files[0], "documents", ["report", "quarterly"], "Q4 Sales Report"),
        (created_files[1], "documents", ["notes", "meeting"], "Team Meeting Notes"),
        (created_files[2], "code", ["python", "script"], "Hello World Script"),
        (created_files[3], "code", ["config", "json"], "Application Configuration"),
        (created_files[4], "media", ["image", "photo"], "Sample Photo"),
        (created_files[5], "data", ["csv", "users"], "User Data Export")
    ]
    
    added_file_ids = []
    for file_path, category, tags, description in file_configs:
        success, message = fm.add_file(file_path, category, tags, description)
        if success:
            file_id = message.split(": ")[1]
            added_file_ids.append(file_id)
            print(f"  ✅ {message}")
        else:
            print(f"  ❌ {message}")
    
    # 3. Dateien suchen
    print("\n🔍 Suche Dateien...")
    
    # Nach Kategorie
    code_files = fm.find_files(category="code")
    print(f"Code-Dateien: {len(code_files)}")
    for file_id, metadata in code_files:
        print(f"  ID {file_id}: {metadata['original_name']}")
    
    # Nach Tags
    config_files = fm.find_files(tags=["config"])
    print(f"Config-Dateien: {len(config_files)}")
    
    # Nach Name
    txt_files = fm.find_files(name="txt")
    print(f"TXT-Dateien: {len(txt_files)}")
    
    # 4. Datei-Inhalte lesen
    print("\n📖 Lese Datei-Inhalte...")
    
    for file_id in added_file_ids[:3]:  # Erste 3 Dateien
        content, status = fm.get_file_content(file_id)
        if content:
            metadata = fm.file_index[file_id]
            print(f"📄 {metadata['original_name']}:")
            print(f"   {content[:100]}{'...' if len(content) > 100 else ''}")
        else:
            print(f"❌ Fehler beim Lesen ID {file_id}: {status}")
    
    # 5. Duplikate finden
    print("\n🔍 Suche nach Duplikaten...")
    
    # Duplikat erstellen
    duplicate_path = temp_dir / "duplicate_report.txt"
    shutil.copy2(created_files[0], duplicate_path)
    fm.add_file(duplicate_path, "documents", ["duplicate"], "Duplicate Report")
    
    duplicates = fm.find_duplicates()
    if duplicates:
        print(f"Gefunden: {len(duplicates)} Duplikat-Gruppen")
        for hash_val, files in duplicates.items():
            print(f"  Hash {hash_val[:8]}...:")
            for file_id, metadata in files:
                print(f"    ID {file_id}: {metadata['original_name']}")
    else:
        print("Keine Duplikate gefunden")
    
    # 6. System-Statistiken
    print("\n📊 System-Statistiken...")
    stats = fm.get_statistics()
    
    print(f"Dateien gesamt: {stats['total_files']}")
    print(f"Gesamtgröße: {stats['total_size_formatted']}")
    
    print("Nach Kategorie:")
    for category, count in stats['by_category'].items():
        print(f"  {category}: {count}")
    
    print("Nach Dateityp:")
    for ext, count in stats['by_extension'].items():
        print(f"  {ext}: {count}")
    
    print(f"Meistgenutzte Datei: {stats['most_accessed']['name']} ({stats['most_accessed']['count']}x)")
    
    # 7. Export-Test
    print("\n💾 Export-Test...")
    export_dir = Path("exports")
    export_dir.mkdir(exist_ok=True)
    
    # Erste Datei exportieren
    first_file_id = added_file_ids[0]
    export_path = export_dir / "exported_report.txt"
    success, message = fm.export_file(first_file_id, export_path)
    print(f"Export: {message}")
    
    # 8. Backup erstellen
    print("\n💾 Backup erstellen...")
    backup_success, backup_message = fm.backup_system("file_system_backup")
    print(f"Backup: {backup_message}")
    
    # 9. Cleanup testen
    print("\n🧹 Cleanup-Test...")
    
    # Orphaned file erstellen (direkt ins files-Verzeichnis)
    orphan_path = fm.base_dir / "files" / "orphaned.txt"
    orphan_path.parent.mkdir(parents=True, exist_ok=True)
    with open(orphan_path, "w") as f:
        f.write("This is an orphaned file")
    
    deleted_count, deleted_files = fm.cleanup_orphaned_files()
    print(f"Orphaned files bereinigt: {deleted_count}")
    
    # 10. Lösch-Test
    print("\n🗑️  Datei löschen...")
    if added_file_ids:
        delete_id = added_file_ids[-1]  # Letzten löschen
        success, message = fm.delete_file(delete_id)
        print(f"Löschen: {message}")
    
    # Finale Statistiken
    print("\n📈 Finale Statistiken...")
    final_stats = fm.get_statistics()
    print(f"Dateien nach Operationen: {final_stats['total_files']}")
    
    # Cleanup - Test-Dateien löschen
    print("\n🧹 Cleanup...")
    
    cleanup_dirs = ["temp_test_files", "demo_file_system", "file_system_backup", "exports"]
    for dir_name in cleanup_dirs:
        dir_path = Path(dir_name)
        if dir_path.exists():
            try:
                shutil.rmtree(dir_path)
                print(f"✅ Gelöscht: {dir_name}")
            except Exception as e:
                print(f"❌ Fehler beim Löschen von {dir_name}: {e}")
    
    return fm

if __name__ == "__main__":
    demo_system = demo_file_manager()</code></pre>
                            </div>
                        </div>
                        
                        <div class="example-features">
                            <h5>Was dieses Beispiel demonstriert:</h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <h6>📁 File I/O Operationen:</h6>
                                    <ul class="feature-list">
                                        <li>Lesen und Schreiben verschiedener Dateiformate</li>
                                        <li>JSON für Metadaten und Konfiguration</li>
                                        <li>CSV für strukturierte Daten</li>
                                        <li>Binäre und Text-Dateien</li>
                                        <li>Sichere File-Operationen mit Error Handling</li>
                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <h6>🛠️ Erweiterte Konzepte:</h6>
                                    <ul class="feature-list">
                                        <li>Dateisystem-Navigation mit pathlib</li>
                                        <li>Hash-basierte Duplikatserkennung</li>
                                        <li>Metadaten-Management</li>
                                        <li>Backup und Recovery</li>
                                        <li>Logging und Audit-Trail</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="navigation-buttons">
                        <?php renderPythonPageNavigation('python-dateien'); ?>
                    </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>