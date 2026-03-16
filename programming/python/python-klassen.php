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
                        <?php renderPythonNavigation('python-klassen'); ?>
                        <div class="d-flex justify-content-between align-items-center pt-3 pb-2 mb-3 border-bottom">
                            <h1 class="h2"><i class="bi bi-box2 text-primary me-2"></i>Python Klassen & OOP</h1>
                        </div>

                        <div class="row">
                            <div class="col-12">
                    
                    <div class="content-section">
                        <h2>Was ist Objektorientierte Programmierung?</h2>
                        <p><strong>Objektorientierte Programmierung (OOP)</strong> ist ein Programmierparadigma, das auf dem Konzept von "Objekten" basiert. Objekte sind Instanzen von Klassen, die Daten (Attribute) und Funktionen (Methoden) zusammenfassen.</p>
                        
                        <div class="oop-principles">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="principle-card">
                                        <i class="bi bi-shield-lock text-primary"></i>
                                        <h5>Kapselung (Encapsulation)</h5>
                                        <p>Daten und Methoden in Objekten zusammenfassen und kontrolliert zugänglich machen</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="principle-card">
                                        <i class="bi bi-diagram-2 text-success"></i>
                                        <h5>Vererbung (Inheritance)</h5>
                                        <p>Neue Klassen basierend auf bestehenden Klassen erstellen</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="principle-card">
                                        <i class="bi bi-shuffle text-info"></i>
                                        <h5>Polymorphismus</h5>
                                        <p>Gleiche Schnittstelle für verschiedene Objekttypen</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="principle-card">
                                        <i class="bi bi-eye-slash text-warning"></i>
                                        <h5>Abstraktion</h5>
                                        <p>Komplexe Implementierungsdetails verbergen</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="class-vs-object">
                            <h4>Klassen vs. Objekte</h4>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="concept-box">
                                        <h5>🏗️ Klasse</h5>
                                        <p><strong>Bauplan</strong> oder Vorlage für Objekte</p>
                                        <ul>
                                            <li>Definiert Struktur und Verhalten</li>
                                            <li>Enthält Attribute und Methoden</li>
                                            <li>Existiert nur einmal im Code</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="concept-box">
                                        <h5>🏠 Objekt</h5>
                                        <p><strong>Instanz</strong> einer Klasse</p>
                                        <ul>
                                            <li>Konkrete Realisierung der Klasse</li>
                                            <li>Hat eigene Attributwerte</li>
                                            <li>Kann mehrfach erstellt werden</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="first-class-example">
                            <h4>Erste Klasse in Python</h4>
                            <div class="code-block">
<pre><code class="language-python"># Einfache Klasse definieren
class Person:
    """Eine einfache Person-Klasse"""
    
    def __init__(self, name, age):
        """Konstruktor - wird beim Erstellen einer Instanz aufgerufen"""
        self.name = name  # Attribut
        self.age = age    # Attribut
    
    def greet(self):
        """Methode zum Begrüßen"""
        return f"Hallo, ich bin {self.name} und {self.age} Jahre alt."
    
    def have_birthday(self):
        """Methode zum Altern"""
        self.age += 1
        return f"{self.name} ist jetzt {self.age} Jahre alt!"

# Objekte (Instanzen) erstellen
person1 = Person("Alice", 25)
person2 = Person("Bob", 30)

print("=== OBJEKTE ERSTELLEN ===")
print(f"Person 1: {person1.name}, {person1.age} Jahre")
print(f"Person 2: {person2.name}, {person2.age} Jahre")

# Methoden aufrufen
print("\n=== METHODEN AUFRUFEN ===")
print(person1.greet())
print(person2.greet())

# Objekte sind unabhängig
print("\n=== OBJEKTE SIND UNABHÄNGIG ===")
print(person1.have_birthday())  # Nur person1 wird älter
print(person2.greet())          # person2 bleibt gleich

print(f"person1.age: {person1.age}")  # 26
print(f"person2.age: {person2.age}")  # 30</code></pre>
                            </div>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Klassen definieren und verwenden</h2>
                        <p>Detaillierte Erklärung der Klassendefinition in Python:</p>
                        
                        <div class="class-anatomy">
                            <div class="class-structure">
                                <h4>Anatomie einer Python-Klasse</h4>
                                <div class="code-block">
<pre><code class="language-python">class BankAccount:
    """
    Eine Bankkonto-Klasse, die alle wichtigen Konzepte demonstriert
    """
    
    # Klassenvariable (für alle Instanzen gleich)
    bank_name = "Python Bank"
    account_count = 0
    
    def __init__(self, owner, initial_balance=0):
        """
        Konstruktor (__init__): Wird beim Erstellen einer Instanz aufgerufen
        
        Args:
            owner (str): Kontoinhaber
            initial_balance (float): Anfangssaldo (Standard: 0)
        """
        # Instanzvariablen (für jede Instanz individuell)
        self.owner = owner
        self.balance = initial_balance
        self.transactions = []
        
        # Kontonummer generieren
        BankAccount.account_count += 1
        self.account_number = f"ACC-{BankAccount.account_count:04d}"
        
        # Erste Transaktion protokollieren
        if initial_balance > 0:
            self.transactions.append(f"Initial deposit: ${initial_balance}")
    
    def deposit(self, amount):
        """
        Geld einzahlen
        
        Args:
            amount (float): Einzuzahlender Betrag
            
        Returns:
            bool: True wenn erfolgreich, False wenn Fehler
        """
        if amount <= 0:
            print("Einzahlungsbetrag muss positiv sein!")
            return False
        
        self.balance += amount
        self.transactions.append(f"Deposit: ${amount}")
        print(f"${amount} eingezahlt. Neuer Saldo: ${self.balance}")
        return True
    
    def withdraw(self, amount):
        """Geld abheben"""
        if amount <= 0:
            print("Abhebungsbetrag muss positiv sein!")
            return False
        
        if amount > self.balance:
            print("Nicht genügend Guthaben!")
            return False
        
        self.balance -= amount
        self.transactions.append(f"Withdrawal: ${amount}")
        print(f"${amount} abgehoben. Neuer Saldo: ${self.balance}")
        return True
    
    def get_balance(self):
        """Aktuellen Saldo zurückgeben"""
        return self.balance
    
    def get_statement(self):
        """Kontoauszug erstellen"""
        statement = f"\n=== KONTOAUSZUG FÜR {self.owner} ==="
        statement += f"\nKontonummer: {self.account_number}"
        statement += f"\nBank: {self.bank_name}"
        statement += f"\nAktueller Saldo: ${self.balance}"
        statement += f"\n\nTransaktionen:"
        
        if self.transactions:
            for i, transaction in enumerate(self.transactions, 1):
                statement += f"\n  {i}. {transaction}"
        else:
            statement += "\n  Keine Transaktionen"
        
        statement += f"\n{'=' * 40}"
        return statement
    
    def __str__(self):
        """String-Repräsentation für print()"""
        return f"BankAccount({self.owner}, ${self.balance})"
    
    def __repr__(self):
        """Entwickler-freundliche Repräsentation"""
        return f"BankAccount(owner='{self.owner}', balance={self.balance})"

# Klassenvariable demonstrieren
print("=== KLASSENVARIABLEN ===")
print(f"Bank Name: {BankAccount.bank_name}")
print(f"Anzahl Konten vor Erstellung: {BankAccount.account_count}")

# Konten erstellen
print("\n=== KONTEN ERSTELLEN ===")
account1 = BankAccount("Alice Johnson", 1000)
account2 = BankAccount("Bob Smith", 500)
account3 = BankAccount("Charlie Brown")  # Ohne Anfangssaldo

print(f"Anzahl Konten nach Erstellung: {BankAccount.account_count}")

# Kontoinformationen anzeigen
print("\n=== KONTOINFORMATIONEN ===")
print(f"Account 1: {account1}")
print(f"Account 2: {account2}")
print(f"Account 3: {account3}")

# Transaktionen durchführen
print("\n=== TRANSAKTIONEN ===")
account1.deposit(200)
account1.withdraw(150)
account1.withdraw(2000)  # Fehlschlag - nicht genug Guthaben

account2.deposit(300)
account2.withdraw(100)

account3.deposit(500)    # Erstes Geld einzahlen

# Kontoauszüge
print(account1.get_statement())
print(account2.get_statement())

# Verschiedene String-Repräsentationen
print("\n=== STRING REPRÄSENTATIONEN ===")
print(f"str(account1): {str(account1)}")
print(f"repr(account1): {repr(account1)}")

# Attribute direkt zugreifen (in Python möglich, aber nicht empfohlen)
print("\n=== DIREKTER ATTRIBUTZUGRIFF ===")
print(f"account1.owner: {account1.owner}")
print(f"account1.balance: {account1.balance}")
print(f"account1.account_number: {account1.account_number}")

# Alle Attribute eines Objekts anzeigen
print(f"\nAlle Attribute von account1: {vars(account1)}")

# Alle Methoden einer Klasse anzeigen
print(f"\nMethoden der BankAccount-Klasse:")
methods = [method for method in dir(BankAccount) if not method.startswith('_')]
print(methods)</code></pre>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Konstruktoren und Instanzvariablen</h2>
                        <p>Der <code>__init__</code>-Konstruktor und die Verwaltung von Instanzvariablen:</p>
                        
                        <div class="constructors">
                            <div class="init-method">
                                <h4>Der __init__ Konstruktor</h4>
                                <div class="code-block">
<pre><code class="language-python">class Student:
    """Erweiterte Student-Klasse mit verschiedenen Konstruktor-Features"""
    
    # Klassenvariablen
    school_name = "Python University"
    student_count = 0
    
    def __init__(self, name, student_id=None, courses=None, grade_level="Freshman"):
        """
        Konstruktor mit verschiedenen Parameter-Typen
        
        Args:
            name (str): Name des Studenten (erforderlich)
            student_id (str, optional): Studenten-ID, wird generiert falls None
            courses (list, optional): Liste der Kurse
            grade_level (str): Klassenstufe (Standard: "Freshman")
        """
        print(f"Erstelle neuen Studenten: {name}")
        
        # Pflichtparameter
        self.name = name
        
        # Optionale Parameter mit Default-Verhalten
        if student_id is None:
            Student.student_count += 1
            self.student_id = f"STU-{Student.student_count:05d}"
        else:
            self.student_id = student_id
            Student.student_count += 1
        
        # Mutable Default Arguments vermeiden (wichtig!)
        if courses is None:
            self.courses = []  # Neue Liste für jeden Studenten
        else:
            self.courses = courses.copy()  # Kopie der übergebenen Liste
        
        self.grade_level = grade_level
        
        # Weitere Attribute initialisieren
        self.grades = {}  # Leeres Dictionary für Noten
        self.gpa = 0.0
        self.enrollment_date = self._get_current_date()
        
        print(f"Student erstellt: {self.student_id}")
    
    def _get_current_date(self):
        """Private Hilfsmethode (durch _ gekennzeichnet)"""
        from datetime import date
        return date.today().strftime("%Y-%m-%d")
    
    def enroll_course(self, course_name):
        """In einen Kurs einschreiben"""
        if course_name not in self.courses:
            self.courses.append(course_name)
            self.grades[course_name] = None  # Noch keine Note
            print(f"{self.name} ist jetzt in {course_name} eingeschrieben")
            return True
        else:
            print(f"{self.name} ist bereits in {course_name} eingeschrieben")
            return False
    
    def drop_course(self, course_name):
        """Einen Kurs abwählen"""
        if course_name in self.courses:
            self.courses.remove(course_name)
            if course_name in self.grades:
                del self.grades[course_name]
            print(f"{self.name} hat {course_name} abgewählt")
            return True
        else:
            print(f"{self.name} ist nicht in {course_name} eingeschrieben")
            return False
    
    def set_grade(self, course_name, grade):
        """Note für einen Kurs setzen"""
        if course_name not in self.courses:
            print(f"{self.name} ist nicht in {course_name} eingeschrieben")
            return False
        
        if not (0 <= grade <= 100):
            print("Note muss zwischen 0 und 100 liegen")
            return False
        
        self.grades[course_name] = grade
        self._calculate_gpa()  # GPA neu berechnen
        print(f"Note für {course_name}: {grade}")
        return True
    
    def _calculate_gpa(self):
        """GPA (Grade Point Average) berechnen - private Methode"""
        completed_grades = [grade for grade in self.grades.values() if grade is not None]
        
        if completed_grades:
            self.gpa = sum(completed_grades) / len(completed_grades)
        else:
            self.gpa = 0.0
    
    def get_transcript(self):
        """Zeugnis erstellen"""
        transcript = f"\n=== ZEUGNIS - {self.school_name} ==="
        transcript += f"\nStudent: {self.name}"
        transcript += f"\nStudenten-ID: {self.student_id}"
        transcript += f"\nKlassenstufe: {self.grade_level}"
        transcript += f"\nEinschreibedatum: {self.enrollment_date}"
        transcript += f"\n\nKurse und Noten:"
        
        if self.courses:
            for course in self.courses:
                grade = self.grades.get(course, "Keine Note")
                transcript += f"\n  {course}: {grade}"
        else:
            transcript += "\n  Keine Kurse"
        
        transcript += f"\n\nGPA: {self.gpa:.2f}"
        transcript += f"\n{'=' * 40}"
        
        return transcript
    
    def __str__(self):
        return f"Student({self.name}, {self.student_id}, GPA: {self.gpa:.2f})"
    
    def __repr__(self):
        return f"Student(name='{self.name}', student_id='{self.student_id}', grade_level='{self.grade_level}')"

# Verschiedene Konstruktor-Aufrufe demonstrieren
print("=== VERSCHIEDENE KONSTRUKTOR-AUFRUFE ===")

# Nur mit Pflichtparameter
student1 = Student("Alice Johnson")

# Mit einigen optionalen Parametern
student2 = Student("Bob Smith", grade_level="Sophomore")

# Mit allen Parametern
student3 = Student(
    name="Charlie Brown",
    student_id="CUSTOM-001", 
    courses=["Math", "Physics"],
    grade_level="Junior"
)

# Mit Kursliste
student4 = Student("Diana Prince", courses=["Chemistry", "Biology", "English"])

print(f"\nStudenten erstellt: {Student.student_count}")

# Studenten-Informationen
print("\n=== STUDENTEN-INFORMATIONEN ===")
for i, student in enumerate([student1, student2, student3, student4], 1):
    print(f"Student {i}: {student}")

# Kurs-Operationen
print("\n=== KURS-OPERATIONEN ===")

# Student 1: Kurse hinzufügen
student1.enroll_course("Python Programming")
student1.enroll_course("Data Structures")
student1.enroll_course("Web Development")

# Noten setzen
student1.set_grade("Python Programming", 95)
student1.set_grade("Data Structures", 88)
student1.set_grade("Web Development", 92)

# Student 2: Einige Kurse
student2.enroll_course("Calculus")
student2.enroll_course("Statistics")
student2.set_grade("Calculus", 85)
student2.set_grade("Statistics", 90)

# Student 3: Bereits eingeschrieben, Note hinzufügen
student3.set_grade("Math", 78)
student3.set_grade("Physics", 82)

# Zeugnisse anzeigen
print(student1.get_transcript())
print(student2.get_transcript())

# Problematisches Mutable Default Argument demonstrieren
print("\n=== MUTABLE DEFAULT ARGUMENTS PROBLEM ===")

class BadStudent:
    """Beispiel für FALSCHES mutable default argument"""
    def __init__(self, name, courses=[]):  # ❌ SCHLECHT!
        self.name = name
        self.courses = courses  # Alle Instanzen teilen sich die gleiche Liste!

class GoodStudent:
    """Beispiel für KORREKTES mutable default argument"""
    def __init__(self, name, courses=None):  # ✅ GUT!
        self.name = name
        self.courses = courses if courses is not None else []

# Problem demonstrieren
bad1 = BadStudent("Bad1")
bad2 = BadStudent("Bad2")

bad1.courses.append("Math")
print(f"bad1.courses: {bad1.courses}")  # ['Math']
print(f"bad2.courses: {bad2.courses}")  # ['Math'] - Problem! Sollte leer sein

# Korrekte Lösung
good1 = GoodStudent("Good1")
good2 = GoodStudent("Good2")

good1.courses.append("Math")
print(f"good1.courses: {good1.courses}")  # ['Math']
print(f"good2.courses: {good2.courses}")  # [] - Korrekt!

# Klassenattribute vs. Instanzattribute
print("\n=== KLASSEN- VS. INSTANZATTRIBUTE ===")

print(f"Student.school_name: {Student.school_name}")  # Klassenattribut
print(f"student1.school_name: {student1.school_name}")  # Zugriff über Instanz

# Klassenattribut über Klasse ändern
Student.school_name = "Advanced Python University"
print(f"Nach Änderung über Klasse:")
print(f"student1.school_name: {student1.school_name}")  # Geändert
print(f"student2.school_name: {student2.school_name}")  # Geändert

# Instanzattribut überschreibt Klassenattribut
student1.school_name = "Student1's Private School"
print(f"Nach Instanz-Überschreibung:")
print(f"Student.school_name: {Student.school_name}")    # Klassenattribut unverändert
print(f"student1.school_name: {student1.school_name}")  # Instanzattribut
print(f"student2.school_name: {student2.school_name}")  # Klassenattribut</code></pre>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Methoden und Attribute</h2>
                        <p>Verschiedene Arten von Methoden und Attributen in Python-Klassen:</p>
                        
                        <div class="methods-attributes">
                            <div class="method-types">
                                <h4>Instanz-, Klassen- und statische Methoden</h4>
                                <div class="code-block">
<pre><code class="language-python">class MathUtils:
    """
    Klasse die verschiedene Methodentypen demonstriert
    """
    
    # Klassenattribute
    pi = 3.14159
    calculation_count = 0
    
    def __init__(self, name):
        """Konstruktor"""
        self.name = name
        self.personal_calculations = 0
    
    # 1. INSTANZMETHODEN (standard)
    def calculate_circle_area(self, radius):
        """
        Instanzmethode: Hat Zugriff auf self (die Instanz)
        Kann Instanz- und Klassenattribute verwenden
        """
        area = self.pi * radius * radius
        self.personal_calculations += 1
        MathUtils.calculation_count += 1
        return area
    
    def get_personal_stats(self):
        """Instanzmethode für persönliche Statistiken"""
        return f"{self.name} hat {self.personal_calculations} Berechnungen durchgeführt"
    
    # 2. KLASSENMETHODEN
    @classmethod
    def get_total_calculations(cls):
        """
        Klassenmethode: Hat Zugriff auf cls (die Klasse)
        Wird oft für alternative Konstruktoren verwendet
        """
        return cls.calculation_count
    
    @classmethod
    def create_calculator(cls, name):
        """
        Alternative Konstruktor-Methode
        Klassenmethoden können als Fabrik-Methoden dienen
        """
        print(f"Erstelle Rechner für {name}")
        return cls(name)
    
    @classmethod
    def reset_calculations(cls):
        """Setzt Klassenattribut zurück"""
        cls.calculation_count = 0
        print("Berechnungszähler zurückgesetzt")
    
    # 3. STATISCHE METHODEN
    @staticmethod
    def convert_to_radians(degrees):
        """
        Statische Methode: Hat keinen Zugriff auf self oder cls
        Ist eine normale Funktion, die zur Klasse gehört
        """
        return degrees * (MathUtils.pi / 180)
    
    @staticmethod
    def is_prime(number):
        """Prüft ob eine Zahl eine Primzahl ist"""
        if number < 2:
            return False
        for i in range(2, int(number ** 0.5) + 1):
            if number % i == 0:
                return False
        return True
    
    @staticmethod
    def factorial(n):
        """Berechnet Fakultät einer Zahl"""
        if n <= 1:
            return 1
        return n * MathUtils.factorial(n - 1)
    
    def __str__(self):
        return f"MathUtils({self.name})"

# Methodentypen demonstrieren
print("=== VERSCHIEDENE METHODENTYPEN ===")

# Instanzen erstellen
calc1 = MathUtils("Rechner 1")
calc2 = MathUtils("Rechner 2")

# Alternative Konstruktor (Klassenmethode)
calc3 = MathUtils.create_calculator("Rechner 3")

print(f"Erstellt: {calc1}, {calc2}, {calc3}")

# 1. Instanzmethoden verwenden
print("\n--- INSTANZMETHODEN ---")
area1 = calc1.calculate_circle_area(5)
area2 = calc1.calculate_circle_area(3)
area3 = calc2.calculate_circle_area(7)

print(f"Flächen: {area1:.2f}, {area2:.2f}, {area3:.2f}")
print(calc1.get_personal_stats())
print(calc2.get_personal_stats())

# 2. Klassenmethoden verwenden
print("\n--- KLASSENMETHODEN ---")
total = MathUtils.get_total_calculations()
print(f"Gesamt Berechnungen: {total}")

# Klassenmethode über Instanz aufrufen (möglich, aber unüblich)
total_via_instance = calc1.get_total_calculations()
print(f"Gesamt über Instanz: {total_via_instance}")

# 3. Statische Methoden verwenden
print("\n--- STATISCHE METHODEN ---")

# Über Klasse aufrufen (üblich)
radians = MathUtils.convert_to_radians(90)
print(f"90 Grad = {radians:.4f} Radians")

prime_check = MathUtils.is_prime(17)
print(f"17 ist Primzahl: {prime_check}")

factorial_5 = MathUtils.factorial(5)
print(f"5! = {factorial_5}")

# Über Instanz aufrufen (möglich, aber unüblich)
prime_check_instance = calc1.is_prime(23)
print(f"23 ist Primzahl (über Instanz): {prime_check_instance}")

# Property-Decorator für berechnete Attribute
print("\n=== PROPERTIES ===")

class Temperature:
    """Temperatur-Klasse mit Properties"""
    
    def __init__(self, celsius=0):
        self._celsius = celsius  # "Private" Variable (durch _ gekennzeichnet)
    
    @property
    def celsius(self):
        """Getter für Celsius"""
        return self._celsius
    
    @celsius.setter
    def celsius(self, value):
        """Setter für Celsius mit Validierung"""
        if value < -273.15:
            raise ValueError("Temperatur kann nicht unter -273.15°C liegen")
        self._celsius = value
    
    @property
    def fahrenheit(self):
        """Berechnete Property - nur Getter"""
        return (self._celsius * 9/5) + 32
    
    @fahrenheit.setter
    def fahrenheit(self, value):
        """Setter für Fahrenheit - berechnet Celsius"""
        self.celsius = (value - 32) * 5/9
    
    @property
    def kelvin(self):
        """Berechnete Property für Kelvin"""
        return self._celsius + 273.15
    
    @kelvin.setter
    def kelvin(self, value):
        """Setter für Kelvin"""
        self.celsius = value - 273.15
    
    def __str__(self):
        return f"Temperature({self.celsius:.1f}°C, {self.fahrenheit:.1f}°F, {self.kelvin:.1f}K)"

# Properties demonstrieren
temp = Temperature(25)  # 25°C
print(f"Initial: {temp}")

# Properties wie normale Attribute verwenden
print(f"Celsius: {temp.celsius}")
print(f"Fahrenheit: {temp.fahrenheit}")
print(f"Kelvin: {temp.kelvin}")

# Über verschiedene Properties setzen
temp.fahrenheit = 100  # 100°F
print(f"Nach Fahrenheit-Änderung: {temp}")

temp.kelvin = 300      # 300K
print(f"Nach Kelvin-Änderung: {temp}")

# Validierung testen
try:
    temp.celsius = -300  # Fehler!
except ValueError as e:
    print(f"Validierungsfehler: {e}")

# Private und Protected Attribute
print("\n=== PRIVATE UND PROTECTED ATTRIBUTE ===")

class DataProcessor:
    """Zeigt verschiedene Attribute-Sichtbarkeiten"""
    
    def __init__(self, name):
        self.public_attribute = "Jeder kann darauf zugreifen"
        self._protected_attribute = "Sollte nur von Subklassen verwendet werden"
        self.__private_attribute = "Schwer von außen zugänglich"
        self.name = name
    
    def show_attributes(self):
        """Zeigt alle Attribute von innen"""
        print(f"Public: {self.public_attribute}")
        print(f"Protected: {self._protected_attribute}")
        print(f"Private: {self.__private_attribute}")
    
    def _protected_method(self):
        """Protected Methode"""
        return "Diese Methode ist für interne Verwendung gedacht"
    
    def __private_method(self):
        """Private Methode"""
        return "Diese Methode ist privat"

processor = DataProcessor("Test Processor")

# Public Attribute - normaler Zugriff
print(f"Public: {processor.public_attribute}")

# Protected Attribute - Zugriff möglich, aber nicht empfohlen
print(f"Protected: {processor._protected_attribute}")

# Private Attribute - direkter Zugriff nicht möglich
try:
    print(processor.__private_attribute)  # AttributeError!
except AttributeError as e:
    print(f"Private Attribut-Zugriff fehlgeschlagen: {e}")

# Private Attribute über Name Mangling zugänglich
print(f"Private via Name Mangling: {processor._DataProcessor__private_attribute}")

# Alle Attribute anzeigen
print(f"\nAlle Attribute: {vars(processor)}")

# Von innen sind alle Attribute verfügbar
processor.show_attributes()

# Dynamische Attribute hinzufügen (zur Laufzeit)
print("\n=== DYNAMISCHE ATTRIBUTE ===")

class DynamicClass:
    def __init__(self, name):
        self.name = name

obj = DynamicClass("Test")
print(f"Initial: {vars(obj)}")

# Attribute zur Laufzeit hinzufügen
obj.new_attribute = "Dynamisch hinzugefügt"
obj.calculate = lambda x: x * 2  # Sogar Methoden!

print(f"Nach Hinzufügung: {vars(obj)}")
print(f"Neue Attribute: {obj.new_attribute}")
print(f"Dynamische Methode: {obj.calculate(5)}")

# hasattr, getattr, setattr, delattr
print("\n=== ATTRIBUTE PROGRAMMATISCH VERWALTEN ===")

class ConfigurableClass:
    def __init__(self):
        self.setting1 = "default1"
        self.setting2 = "default2"

config = ConfigurableClass()

# hasattr - prüfen ob Attribut existiert
print(f"Hat 'setting1': {hasattr(config, 'setting1')}")
print(f"Hat 'setting3': {hasattr(config, 'setting3')}")

# getattr - Attribut mit Default-Wert holen
value1 = getattr(config, 'setting1', 'not found')
value3 = getattr(config, 'setting3', 'not found')
print(f"setting1: {value1}")
print(f"setting3: {value3}")

# setattr - Attribut setzen
setattr(config, 'setting3', 'new value')
setattr(config, 'dynamic_setting', 'dynamic value')
print(f"Nach setattr: {vars(config)}")

# delattr - Attribut löschen
delattr(config, 'setting2')
print(f"Nach delattr: {vars(config)}")</code></pre>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Spezielle Methoden (Magic Methods)</h2>
                        <p>Dunder Methods (Double Underscore) für erweiterte Funktionalität:</p>
                        
                        <div class="magic-methods">
                            <div class="dunder-methods">
                                <h4>Wichtige Magic Methods</h4>
                                <div class="code-block">
<pre><code class="language-python">class Vector:
    """
    2D-Vektor-Klasse die viele Magic Methods demonstriert
    """
    
    def __init__(self, x, y):
        """Konstruktor"""
        self.x = x
        self.y = y
    
    # STRING REPRÄSENTATION
    def __str__(self):
        """Benutzerfreundliche String-Darstellung für print()"""
        return f"Vector({self.x}, {self.y})"
    
    def __repr__(self):
        """Entwicklerfreundliche Darstellung für Debugging"""
        return f"Vector(x={self.x}, y={self.y})"
    
    # ARITHMETISCHE OPERATOREN
    def __add__(self, other):
        """Addition: v1 + v2"""
        if isinstance(other, Vector):
            return Vector(self.x + other.x, self.y + other.y)
        elif isinstance(other, (int, float)):
            return Vector(self.x + other, self.y + other)
        return NotImplemented
    
    def __radd__(self, other):
        """Rechts-Addition: 5 + vector"""
        return self.__add__(other)
    
    def __sub__(self, other):
        """Subtraktion: v1 - v2"""
        if isinstance(other, Vector):
            return Vector(self.x - other.x, self.y - other.y)
        elif isinstance(other, (int, float)):
            return Vector(self.x - other, self.y - other)
        return NotImplemented
    
    def __mul__(self, other):
        """Multiplikation: v * scalar oder v * v (Dot Product)"""
        if isinstance(other, (int, float)):
            # Skalar-Multiplikation
            return Vector(self.x * other, self.y * other)
        elif isinstance(other, Vector):
            # Dot Product (Skalarprodukt)
            return self.x * other.x + self.y * other.y
        return NotImplemented
    
    def __rmul__(self, other):
        """Rechts-Multiplikation: 3 * vector"""
        return self.__mul__(other)
    
    def __truediv__(self, other):
        """Division: v / scalar"""
        if isinstance(other, (int, float)) and other != 0:
            return Vector(self.x / other, self.y / other)
        return NotImplemented
    
    def __pow__(self, power):
        """Potenzierung: v ** n (komponentenweise)"""
        return Vector(self.x ** power, self.y ** power)
    
    def __neg__(self):
        """Negation: -v"""
        return Vector(-self.x, -self.y)
    
    def __abs__(self):
        """Betrag: abs(v) - Vektorlänge"""
        return (self.x ** 2 + self.y ** 2) ** 0.5
    
    # VERGLEICHSOPERATOREN
    def __eq__(self, other):
        """Gleichheit: v1 == v2"""
        if isinstance(other, Vector):
            return self.x == other.x and self.y == other.y
        return False
    
    def __ne__(self, other):
        """Ungleichheit: v1 != v2"""
        return not self.__eq__(other)
    
    def __lt__(self, other):
        """Kleiner als: v1 < v2 (basierend auf Länge)"""
        if isinstance(other, Vector):
            return abs(self) < abs(other)
        return NotImplemented
    
    def __le__(self, other):
        """Kleiner gleich: v1 <= v2"""
        return self.__lt__(other) or self.__eq__(other)
    
    def __gt__(self, other):
        """Größer als: v1 > v2"""
        if isinstance(other, Vector):
            return abs(self) > abs(other)
        return NotImplemented
    
    def __ge__(self, other):
        """Größer gleich: v1 >= v2"""
        return self.__gt__(other) or self.__eq__(other)
    
    # CONTAINER-METHODEN
    def __getitem__(self, index):
        """Indexzugriff: v[0] für x, v[1] für y"""
        if index == 0:
            return self.x
        elif index == 1:
            return self.y
        else:
            raise IndexError("Vector index out of range (0 or 1)")
    
    def __setitem__(self, index, value):
        """Index-Zuweisung: v[0] = 5"""
        if index == 0:
            self.x = value
        elif index == 1:
            self.y = value
        else:
            raise IndexError("Vector index out of range (0 or 1)")
    
    def __len__(self):
        """Länge: len(v) - Anzahl Komponenten"""
        return 2
    
    def __contains__(self, item):
        """Membership: x in v"""
        return item == self.x or item == self.y
    
    def __iter__(self):
        """Iterator: for component in v"""
        yield self.x
        yield self.y
    
    # CALLABLE
    def __call__(self, scalar=1):
        """Aufrufbar machen: v() - normalisiert den Vektor"""
        length = abs(self)
        if length == 0:
            return Vector(0, 0)
        return Vector(self.x / length * scalar, self.y / length * scalar)
    
    # HASH (für Sets und Dict Keys)
    def __hash__(self):
        """Hash-Wert für Verwendung in Sets/Dict Keys"""
        return hash((self.x, self.y))
    
    # KONTEXT MANAGER
    def __enter__(self):
        """Context Manager Eingang"""
        print(f"Entering context with {self}")
        return self
    
    def __exit__(self, exc_type, exc_val, exc_tb):
        """Context Manager Ausgang"""
        print(f"Exiting context with {self}")
        return False

# Magic Methods demonstrieren
print("=== MAGIC METHODS DEMONSTRATION ===")

# Vektoren erstellen
v1 = Vector(3, 4)
v2 = Vector(1, 2)

# String-Repräsentationen
print(f"str(v1): {str(v1)}")
print(f"repr(v1): {repr(v1)}")

# Arithmetische Operationen
print("\n--- ARITHMETIK ---")
print(f"v1 + v2 = {v1 + v2}")
print(f"v1 - v2 = {v1 - v2}")
print(f"v1 * 2 = {v1 * 2}")
print(f"3 * v1 = {3 * v1}")
print(f"v1 * v2 (Dot Product) = {v1 * v2}")
print(f"v1 / 2 = {v1 / 2}")
print(f"v1 ** 2 = {v1 ** 2}")
print(f"-v1 = {-v1}")
print(f"abs(v1) = {abs(v1)}")

# Vergleiche
print("\n--- VERGLEICHE ---")
print(f"v1 == v2: {v1 == v2}")
print(f"v1 != v2: {v1 != v2}")
print(f"v1 > v2: {v1 > v2}")   # Basierend auf Länge
print(f"v1 < v2: {v1 < v2}")

# Container-Operationen
print("\n--- CONTAINER OPERATIONEN ---")
print(f"v1[0] = {v1[0]}")      # x-Komponente
print(f"v1[1] = {v1[1]}")      # y-Komponente
print(f"len(v1) = {len(v1)}")
print(f"3 in v1: {3 in v1}")
print(f"5 in v1: {5 in v1}")

# Index-Zuweisung
v1[0] = 10
print(f"Nach v1[0] = 10: {v1}")

# Iteration
print("Iteration über v1:")
for component in v1:
    print(f"  {component}")

# Als Funktion aufrufen
print(f"\n--- CALLABLE ---")
normalized = v1()  # Normalisierter Vektor
print(f"Normalisiert: {normalized}")
print(f"Länge des normalisierten Vektors: {abs(normalized):.6f}")

# Hash-Wert
print(f"\n--- HASH ---")
print(f"hash(v1): {hash(v1)}")
print(f"hash(v2): {hash(v2)}")

# In Set verwenden
vector_set = {v1, v2, Vector(3, 4)}  # Duplikat wird entfernt
print(f"Set von Vektoren: {vector_set}")

# Context Manager
print(f"\n--- CONTEXT MANAGER ---")
with v1 as vector:
    print(f"Im Context: {vector}")
    # Arbeite mit dem Vektor

# Weitere wichtige Magic Methods
print("\n=== WEITERE MAGIC METHODS ===")

class SmartList:
    """Liste mit erweiterten Magic Methods"""
    
    def __init__(self, items=None):
        self.items = items or []
    
    def __len__(self):
        return len(self.items)
    
    def __getitem__(self, index):
        return self.items[index]
    
    def __setitem__(self, index, value):
        self.items[index] = value
    
    def __delitem__(self, index):
        del self.items[index]
    
    def __iadd__(self, other):
        """In-place Addition: lst += other"""
        if isinstance(other, SmartList):
            self.items.extend(other.items)
        else:
            self.items.append(other)
        return self
    
    def __bool__(self):
        """Wahrheitswert: bool(lst)"""
        return len(self.items) > 0
    
    def __reversed__(self):
        """Reversed Iterator: reversed(lst)"""
        return reversed(self.items)
    
    def __format__(self, format_spec):
        """String-Formatierung: f"{lst:short}" """
        if format_spec == "short":
            return f"SmartList[{len(self.items)} items]"
        elif format_spec == "long":
            return f"SmartList({self.items})"
        else:
            return str(self.items)
    
    def __str__(self):
        return f"SmartList({self.items})"

smart_list = SmartList([1, 2, 3])

print(f"SmartList: {smart_list}")
print(f"Length: {len(smart_list)}")
print(f"Item 0: {smart_list[0]}")
print(f"Bool value: {bool(smart_list)}")
print(f"Empty bool: {bool(SmartList())}")

# In-place Addition
smart_list += 4
smart_list += SmartList([5, 6])
print(f"Nach +=: {smart_list}")

# Formatierung
print(f"Short format: {smart_list:short}")
print(f"Long format: {smart_list:long}")

# Reversed
print("Rückwärts:")
for item in reversed(smart_list):
    print(f"  {item}")

# Vergleich aller implementierten Magic Methods
print(f"\n=== ALLE MAGIC METHODS ===")
magic_methods = [method for method in dir(Vector) if method.startswith('__') and method.endswith('__')]
print(f"Vector hat {len(magic_methods)} Magic Methods:")
for method in sorted(magic_methods):
    print(f"  {method}")</code></pre>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Praktisches Beispiel: E-Commerce-System</h2>
                        <p>Ein vollständiges E-Commerce-System, das alle OOP-Konzepte in einem praktischen Szenario demonstriert:</p>
                        
                        <div class="ecommerce-system">
                            <div class="code-header">
                                <span class="code-title">ecommerce_oop_system.py</span>
                                <span class="badge bg-success">Vollständiges Beispiel</span>
                            </div>
                            <div class="code-block">
<pre><code class="language-python">#!/usr/bin/env python3
"""
E-Commerce System mit umfassender OOP-Demonstration
Zeigt Klassen, Methoden, Properties, Magic Methods und mehr
"""

from datetime import datetime, timedelta
from typing import List, Dict, Optional
from enum import Enum
import json

class OrderStatus(Enum):
    """Bestellstatus als Enum"""
    PENDING = "pending"
    CONFIRMED = "confirmed"
    SHIPPED = "shipped"
    DELIVERED = "delivered"
    CANCELLED = "cancelled"

class Product:
    """Produkt-Klasse mit umfassender Funktionalität"""
    
    # Klassenvariablen
    _product_count = 0
    _all_products = {}
    
    def __init__(self, name: str, price: float, category: str, description: str = "", stock: int = 0):
        # Produkt-ID generieren
        Product._product_count += 1
        self._product_id = f"PROD-{Product._product_count:05d}"
        
        # Attribute mit Validierung
        self._name = ""
        self._price = 0.0
        self._stock = 0
        
        # Properties verwenden für Validierung
        self.name = name
        self.price = price
        self.stock = stock
        
        self.category = category
        self.description = description
        self.created_at = datetime.now()
        self.reviews = []
        self.view_count = 0
        
        # Produkt in globaler Liste speichern
        Product._all_products[self._product_id] = self
    
    @property
    def product_id(self):
        """Schreibgeschützte Produkt-ID"""
        return self._product_id
    
    @property
    def name(self):
        return self._name
    
    @name.setter
    def name(self, value):
        if not value or len(value.strip()) == 0:
            raise ValueError("Product name cannot be empty")
        self._name = value.strip()
    
    @property
    def price(self):
        return self._price
    
    @price.setter
    def price(self, value):
        if value < 0:
            raise ValueError("Price cannot be negative")
        self._price = float(value)
    
    @property
    def stock(self):
        return self._stock
    
    @stock.setter
    def stock(self, value):
        if value < 0:
            raise ValueError("Stock cannot be negative")
        self._stock = int(value)
    
    @property
    def is_available(self):
        """Berechnete Property - verfügbar wenn auf Lager"""
        return self._stock > 0
    
    @property
    def average_rating(self):
        """Durchschnittliche Bewertung"""
        if not self.reviews:
            return 0.0
        return sum(review['rating'] for review in self.reviews) / len(self.reviews)
    
    def add_review(self, rating: int, comment: str, reviewer: str):
        """Bewertung hinzufügen"""
        if not (1 <= rating <= 5):
            raise ValueError("Rating must be between 1 and 5")
        
        review = {
            'rating': rating,
            'comment': comment,
            'reviewer': reviewer,
            'date': datetime.now().isoformat()
        }
        self.reviews.append(review)
    
    def reserve_stock(self, quantity: int) -> bool:
        """Lager reservieren"""
        if quantity <= 0:
            return False
        if quantity > self._stock:
            return False
        
        self._stock -= quantity
        return True
    
    def release_stock(self, quantity: int):
        """Lager freigeben (bei Stornierung)"""
        self._stock += quantity
    
    def view(self):
        """Produktansicht zählen"""
        self.view_count += 1
    
    @classmethod
    def get_all_products(cls):
        """Alle Produkte zurückgeben"""
        return list(cls._all_products.values())
    
    @classmethod
    def find_by_id(cls, product_id: str):
        """Produkt nach ID finden"""
        return cls._all_products.get(product_id)
    
    @classmethod
    def find_by_category(cls, category: str):
        """Produkte nach Kategorie finden"""
        return [p for p in cls._all_products.values() if p.category.lower() == category.lower()]
    
    @classmethod
    def get_product_count(cls):
        """Anzahl aller Produkte"""
        return cls._product_count
    
    # Magic Methods
    def __str__(self):
        return f"{self.name} (${self.price:.2f})"
    
    def __repr__(self):
        return f"Product(id='{self.product_id}', name='{self.name}', price={self.price})"
    
    def __eq__(self, other):
        if isinstance(other, Product):
            return self.product_id == other.product_id
        return False
    
    def __hash__(self):
        return hash(self.product_id)
    
    def __lt__(self, other):
        if isinstance(other, Product):
            return self.price < other.price
        return NotImplemented

class Customer:
    """Kunden-Klasse"""
    
    _customer_count = 0
    
    def __init__(self, name: str, email: str, address: str = ""):
        Customer._customer_count += 1
        self._customer_id = f"CUST-{Customer._customer_count:05d}"
        
        self.name = name
        self.email = email
        self.address = address
        self.created_at = datetime.now()
        self.orders = []
        self.loyalty_points = 0
    
    @property
    def customer_id(self):
        return self._customer_id
    
    @property
    def total_spent(self):
        """Gesamtausgaben berechnen"""
        return sum(order.total_amount for order in self.orders 
                  if order.status != OrderStatus.CANCELLED)
    
    @property
    def order_count(self):
        """Anzahl Bestellungen"""
        return len([o for o in self.orders if o.status != OrderStatus.CANCELLED])
    
    def add_loyalty_points(self, points: int):
        """Treuepunkte hinzufügen"""
        self.loyalty_points += points
    
    def redeem_loyalty_points(self, points: int) -> bool:
        """Treuepunkte einlösen"""
        if points <= self.loyalty_points:
            self.loyalty_points -= points
            return True
        return False
    
    def __str__(self):
        return f"Customer({self.name}, {self.email})"
    
    def __repr__(self):
        return f"Customer(id='{self.customer_id}', name='{self.name}')"

class OrderItem:
    """Einzelner Artikel in einer Bestellung"""
    
    def __init__(self, product: Product, quantity: int, price_per_item: float = None):
        self.product = product
        self.quantity = quantity
        self.price_per_item = price_per_item or product.price
        self.added_at = datetime.now()
    
    @property
    def total_price(self):
        """Gesamtpreis für diesen Artikel"""
        return self.price_per_item * self.quantity
    
    def __str__(self):
        return f"{self.quantity}x {self.product.name} @ ${self.price_per_item:.2f}"
    
    def __repr__(self):
        return f"OrderItem(product={self.product.name}, quantity={self.quantity})"

class ShoppingCart:
    """Warenkorb-Klasse"""
    
    def __init__(self, customer: Customer):
        self.customer = customer
        self.items: List[OrderItem] = []
        self.created_at = datetime.now()
        self.discount_code = None
        self.discount_amount = 0.0
    
    def add_item(self, product: Product, quantity: int = 1) -> bool:
        """Artikel zum Warenkorb hinzufügen"""
        if not product.is_available:
            print(f"Produkt {product.name} ist nicht verfügbar")
            return False
        
        if quantity > product.stock:
            print(f"Nicht genügend Lager für {product.name}")
            return False
        
        # Prüfen ob Produkt bereits im Warenkorb
        for item in self.items:
            if item.product == product:
                if item.quantity + quantity <= product.stock:
                    item.quantity += quantity
                    print(f"{quantity}x {product.name} zum Warenkorb hinzugefügt")
                    return True
                else:
                    print(f"Nicht genügend Lager für zusätzliche {quantity}x {product.name}")
                    return False
        
        # Neues Item hinzufügen
        item = OrderItem(product, quantity)
        self.items.append(item)
        print(f"{quantity}x {product.name} zum Warenkorb hinzugefügt")
        return True
    
    def remove_item(self, product: Product, quantity: int = None) -> bool:
        """Artikel aus Warenkorb entfernen"""
        for item in self.items:
            if item.product == product:
                if quantity is None or quantity >= item.quantity:
                    # Komplettes Item entfernen
                    self.items.remove(item)
                    print(f"{product.name} aus Warenkorb entfernt")
                else:
                    # Nur Menge reduzieren
                    item.quantity -= quantity
                    print(f"{quantity}x {product.name} aus Warenkorb entfernt")
                return True
        
        print(f"{product.name} nicht im Warenkorb gefunden")
        return False
    
    def clear(self):
        """Warenkorb leeren"""
        self.items.clear()
        self.discount_code = None
        self.discount_amount = 0.0
    
    def apply_discount(self, code: str, amount: float):
        """Rabattcode anwenden"""
        self.discount_code = code
        self.discount_amount = amount
    
    @property
    def subtotal(self):
        """Zwischensumme ohne Rabatt"""
        return sum(item.total_price for item in self.items)
    
    @property
    def total(self):
        """Gesamtsumme mit Rabatt"""
        return max(0, self.subtotal - self.discount_amount)
    
    @property
    def item_count(self):
        """Gesamtanzahl Artikel"""
        return sum(item.quantity for item in self.items)
    
    def __len__(self):
        """Anzahl verschiedener Produkte"""
        return len(self.items)
    
    def __iter__(self):
        """Iteration über Items"""
        return iter(self.items)
    
    def __str__(self):
        if not self.items:
            return "Leerer Warenkorb"
        
        result = f"Warenkorb für {self.customer.name}:\n"
        for item in self.items:
            result += f"  {item}\n"
        
        result += f"Zwischensumme: ${self.subtotal:.2f}\n"
        if self.discount_amount > 0:
            result += f"Rabatt ({self.discount_code}): -${self.discount_amount:.2f}\n"
        result += f"Gesamt: ${self.total:.2f}"
        
        return result

class Order:
    """Bestellungs-Klasse"""
    
    _order_count = 0
    
    def __init__(self, customer: Customer, cart: ShoppingCart):
        Order._order_count += 1
        self._order_id = f"ORD-{Order._order_count:05d}"
        
        self.customer = customer
        self.items = [OrderItem(item.product, item.quantity, item.price_per_item) 
                     for item in cart.items]
        self.subtotal = cart.subtotal
        self.discount_amount = cart.discount_amount
        self.discount_code = cart.discount_code
        self.total_amount = cart.total
        
        self.status = OrderStatus.PENDING
        self.created_at = datetime.now()
        self.confirmed_at = None
        self.shipped_at = None
        self.delivered_at = None
        
        # Lager reservieren
        self._reserve_stock()
        
        # Zur Kundenliste hinzufügen
        customer.orders.append(self)
    
    @property
    def order_id(self):
        return self._order_id
    
    def _reserve_stock(self):
        """Lager für Bestellung reservieren"""
        for item in self.items:
            if not item.product.reserve_stock(item.quantity):
                # Rollback bei Fehlschlag
                self._release_stock()
                raise ValueError(f"Nicht genügend Lager für {item.product.name}")
    
    def _release_stock(self):
        """Lager wieder freigeben"""
        for item in self.items:
            item.product.release_stock(item.quantity)
    
    def confirm(self) -> bool:
        """Bestellung bestätigen"""
        if self.status == OrderStatus.PENDING:
            self.status = OrderStatus.CONFIRMED
            self.confirmed_at = datetime.now()
            
            # Treuepunkte vergeben (1 Punkt pro $10)
            points = int(self.total_amount // 10)
            self.customer.add_loyalty_points(points)
            
            print(f"Bestellung {self.order_id} bestätigt. {points} Treuepunkte vergeben.")
            return True
        return False
    
    def ship(self) -> bool:
        """Bestellung versenden"""
        if self.status == OrderStatus.CONFIRMED:
            self.status = OrderStatus.SHIPPED
            self.shipped_at = datetime.now()
            print(f"Bestellung {self.order_id} versendet")
            return True
        return False
    
    def deliver(self) -> bool:
        """Bestellung als geliefert markieren"""
        if self.status == OrderStatus.SHIPPED:
            self.status = OrderStatus.DELIVERED
            self.delivered_at = datetime.now()
            print(f"Bestellung {self.order_id} geliefert")
            return True
        return False
    
    def cancel(self) -> bool:
        """Bestellung stornieren"""
        if self.status in [OrderStatus.PENDING, OrderStatus.CONFIRMED]:
            self.status = OrderStatus.CANCELLED
            self._release_stock()  # Lager freigeben
            print(f"Bestellung {self.order_id} storniert")
            return True
        return False
    
    def get_order_summary(self):
        """Bestellzusammenfassung"""
        summary = f"\n=== BESTELLUNG {self.order_id} ==="
        summary += f"\nKunde: {self.customer.name}"
        summary += f"\nStatus: {self.status.value}"
        summary += f"\nErstellt: {self.created_at.strftime('%Y-%m-%d %H:%M')}"
        
        if self.confirmed_at:
            summary += f"\nBestätigt: {self.confirmed_at.strftime('%Y-%m-%d %H:%M')}"
        if self.shipped_at:
            summary += f"\nVersendet: {self.shipped_at.strftime('%Y-%m-%d %H:%M')}"
        if self.delivered_at:
            summary += f"\nGeliefert: {self.delivered_at.strftime('%Y-%m-%d %H:%M')}"
        
        summary += f"\n\nArtikel:"
        for item in self.items:
            summary += f"\n  {item} = ${item.total_price:.2f}"
        
        summary += f"\n\nZwischensumme: ${self.subtotal:.2f}"
        if self.discount_amount > 0:
            summary += f"\nRabatt ({self.discount_code}): -${self.discount_amount:.2f}"
        summary += f"\nGesamtsumme: ${self.total_amount:.2f}"
        summary += f"\n{'=' * 40}"
        
        return summary
    
    def __str__(self):
        return f"Order {self.order_id} ({self.status.value}) - ${self.total_amount:.2f}"

class ECommerceStore:
    """Hauptklasse für den E-Commerce-Store"""
    
    def __init__(self, name: str):
        self.name = name
        self.customers: Dict[str, Customer] = {}
        self.active_carts: Dict[str, ShoppingCart] = {}
        self.orders: List[Order] = []
        self.discount_codes = {
            "WELCOME10": 10.0,
            "SAVE20": 20.0,
            "LOYAL50": 50.0
        }
    
    def register_customer(self, name: str, email: str, address: str = "") -> Customer:
        """Kunden registrieren"""
        customer = Customer(name, email, address)
        self.customers[customer.customer_id] = customer
        print(f"Kunde {name} registriert mit ID {customer.customer_id}")
        return customer
    
    def get_customer(self, customer_id: str) -> Optional[Customer]:
        """Kunde finden"""
        return self.customers.get(customer_id)
    
    def create_cart(self, customer: Customer) -> ShoppingCart:
        """Warenkorb erstellen"""
        cart = ShoppingCart(customer)
        self.active_carts[customer.customer_id] = cart
        return cart
    
    def get_cart(self, customer: Customer) -> Optional[ShoppingCart]:
        """Warenkorb eines Kunden holen"""
        return self.active_carts.get(customer.customer_id)
    
    def place_order(self, customer: Customer) -> Optional[Order]:
        """Bestellung aufgeben"""
        cart = self.get_cart(customer)
        if not cart or not cart.items:
            print("Warenkorb ist leer")
            return None
        
        try:
            order = Order(customer, cart)
            self.orders.append(order)
            cart.clear()  # Warenkorb leeren
            print(f"Bestellung {order.order_id} erfolgreich aufgegeben")
            return order
        except ValueError as e:
            print(f"Bestellung fehlgeschlagen: {e}")
            return None
    
    def apply_discount_code(self, customer: Customer, code: str) -> bool:
        """Rabattcode einlösen"""
        cart = self.get_cart(customer)
        if not cart:
            return False
        
        if code in self.discount_codes:
            discount = self.discount_codes[code]
            cart.apply_discount(code, discount)
            print(f"Rabattcode {code} angewendet: -${discount:.2f}")
            return True
        else:
            print(f"Ungültiger Rabattcode: {code}")
            return False
    
    def get_store_statistics(self):
        """Store-Statistiken"""
        total_revenue = sum(order.total_amount for order in self.orders 
                           if order.status != OrderStatus.CANCELLED)
        
        completed_orders = [o for o in self.orders if o.status == OrderStatus.DELIVERED]
        
        if completed_orders:
            avg_order_value = sum(o.total_amount for o in completed_orders) / len(completed_orders)
        else:
            avg_order_value = 0
        
        stats = {
            "store_name": self.name,
            "total_customers": len(self.customers),
            "total_products": Product.get_product_count(),
            "total_orders": len(self.orders),
            "completed_orders": len(completed_orders),
            "total_revenue": total_revenue,
            "average_order_value": avg_order_value
        }
        
        return stats

def demo_ecommerce_system():
    """Demonstriert das E-Commerce-System"""
    print("🛒 E-COMMERCE SYSTEM DEMO")
    print("=" * 60)
    
    # Store erstellen
    store = ECommerceStore("Python Electronics Store")
    
    # Produkte erstellen
    print("\n📦 Produkte erstellen...")
    products = [
        Product("Laptop Pro 15", 1299.99, "Electronics", "High-performance laptop", 10),
        Product("Wireless Mouse", 29.99, "Accessories", "Ergonomic wireless mouse", 50),
        Product("Mechanical Keyboard", 149.99, "Accessories", "RGB mechanical keyboard", 25),
        Product("4K Monitor", 399.99, "Electronics", "27-inch 4K monitor", 15),
        Product("USB-C Hub", 79.99, "Accessories", "7-in-1 USB-C hub", 30)
    ]
    
    for product in products:
        print(f"  ✅ {product}")
    
    # Kunden registrieren
    print("\n👥 Kunden registrieren...")
    customers = [
        store.register_customer("Alice Johnson", "alice@example.com", "123 Main St"),
        store.register_customer("Bob Smith", "bob@example.com", "456 Oak Ave"),
        store.register_customer("Charlie Brown", "charlie@example.com", "789 Pine Rd")
    ]
    
    # Shopping-Szenario
    print("\n🛍️ Shopping-Szenario...")
    
    # Alice kauft ein
    alice = customers[0]
    alice_cart = store.create_cart(alice)
    
    # Produkte zum Warenkorb hinzufügen
    alice_cart.add_item(products[0], 1)  # Laptop
    alice_cart.add_item(products[1], 2)  # 2x Maus
    alice_cart.add_item(products[2], 1)  # Keyboard
    
    print(f"\n{alice_cart}")
    
    # Rabattcode anwenden
    store.apply_discount_code(alice, "WELCOME10")
    print(f"\nNach Rabatt:\n{alice_cart}")
    
    # Bestellung aufgeben
    alice_order = store.place_order(alice)
    if alice_order:
        alice_order.confirm()
        alice_order.ship()
        alice_order.deliver()
        print(alice_order.get_order_summary())
    
    # Bob's Bestellung
    print("\n--- Bob's Bestellung ---")
    bob = customers[1]
    bob_cart = store.create_cart(bob)
    
    bob_cart.add_item(products[3], 1)  # Monitor
    bob_cart.add_item(products[4], 1)  # USB Hub
    
    store.apply_discount_code(bob, "SAVE20")
    bob_order = store.place_order(bob)
    if bob_order:
        bob_order.confirm()
        
    # Store-Statistiken
    print("\n📊 Store-Statistiken:")
    stats = store.get_store_statistics()
    for key, value in stats.items():
        if isinstance(value, float):
            print(f"  {key}: ${value:.2f}")
        else:
            print(f"  {key}: {value}")
    
    # Produkt-Reviews
    print("\n⭐ Produkt-Reviews...")
    products[0].add_review(5, "Excellent laptop!", "Alice")
    products[0].add_review(4, "Great performance", "TechReviewer")
    products[1].add_review(5, "Perfect mouse", "Alice")
    
    print(f"Laptop Bewertung: {products[0].average_rating:.1f}/5.0")
    
    # Produktsuche
    print("\n🔍 Produktsuche...")
    electronics = Product.find_by_category("Electronics")
    print(f"Electronics: {[str(p) for p in electronics]}")
    
    accessories = Product.find_by_category("Accessories")
    print(f"Accessories: {[str(p) for p in accessories]}")
    
    # Sortierte Produktliste
    print("\n💰 Produkte nach Preis sortiert:")
    sorted_products = sorted(products)
    for product in sorted_products:
        print(f"  {product}")
    
    return store

if __name__ == "__main__":
    demo_store = demo_ecommerce_system()</code></pre>
                            </div>
                        </div>
                        
                        <div class="example-features">
                            <h5>Was dieses Beispiel demonstriert:</h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <h6>🏗️ OOP-Grundlagen:</h6>
                                    <ul class="feature-list">
                                        <li>Klassen und Objekte mit realen Anwendungsfällen</li>
                                        <li>Konstruktoren mit Parametervalidierung</li>
                                        <li>Instanz- und Klassenmethoden</li>
                                        <li>Properties mit Gettern und Settern</li>
                                        <li>Magic Methods für natürliche Syntax</li>
                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <h6>🔧 Erweiterte Konzepte:</h6>
                                    <ul class="feature-list">
                                        <li>Enums für typsichere Konstanten</li>
                                        <li>Komposition und Aggregation</li>
                                        <li>Datenvalidierung und Fehlerbehandlung</li>
                                        <li>Berechnete Properties</li>
                                        <li>Klassenweite Datenverfolgung</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="navigation-buttons">
                        <?php renderPythonPageNavigation('python-klassen'); ?>
                    </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>