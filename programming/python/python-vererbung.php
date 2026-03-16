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
                        <?php renderPythonNavigation('python-vererbung'); ?>
                        <div class="d-flex justify-content-between align-items-center pt-3 pb-2 mb-3 border-bottom">
                            <h1 class="h2"><i class="bi bi-diagram-2 text-primary me-2"></i>Python Vererbung & Erweiterte OOP</h1>
                        </div>

                        <div class="row">
                            <div class="col-12">
                    
                    <div class="content-section">
                        <h2>Was ist Vererbung?</h2>
                        <p><strong>Vererbung (Inheritance)</strong> ermöglicht es, neue Klassen basierend auf bestehenden Klassen zu erstellen. Die neue Klasse (Kindklasse/Subclass) erbt alle Attribute und Methoden der Elternklasse (Superclass) und kann diese erweitern oder überschreiben.</p>
                        
                        <div class="inheritance-benefits">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="benefit-card">
                                        <i class="bi bi-recycle text-success"></i>
                                        <h5>Code-Wiederverwendung</h5>
                                        <p>Gemeinsame Funktionalität nur einmal implementieren</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="benefit-card">
                                        <i class="bi bi-diagram-3 text-info"></i>
                                        <h5>Hierarchien modellieren</h5>
                                        <p>Natürliche "ist-ein" Beziehungen abbilden</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="benefit-card">
                                        <i class="bi bi-arrow-up text-warning"></i>
                                        <h5>Erweiterbarkeit</h5>
                                        <p>Bestehende Klassen ohne Änderung erweitern</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="benefit-card">
                                        <i class="bi bi-shuffle text-primary"></i>
                                        <h5>Polymorphismus</h5>
                                        <p>Gleiche Schnittstelle, verschiedenes Verhalten</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="inheritance-terminology">
                            <h4>Vererbungs-Terminologie</h4>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Begriff</th>
                                            <th>Synonyme</th>
                                            <th>Beschreibung</th>
                                            <th>Beispiel</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><strong>Basisklasse</strong></td>
                                            <td>Superclass, Elternklasse, Parent Class</td>
                                            <td>Die Klasse, von der geerbt wird</td>
                                            <td><code>class Animal</code></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Abgeleitete Klasse</strong></td>
                                            <td>Subclass, Kindklasse, Child Class</td>
                                            <td>Die Klasse, die erbt</td>
                                            <td><code>class Dog(Animal)</code></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Überschreiben</strong></td>
                                            <td>Override, Method Overriding</td>
                                            <td>Methode der Elternklasse neu definieren</td>
                                            <td>Neue <code>speak()</code> Methode</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Erweitern</strong></td>
                                            <td>Extend</td>
                                            <td>Neue Funktionalität hinzufügen</td>
                                            <td>Zusätzliche Methoden/Attribute</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        
                        <div class="basic-inheritance">
                            <h4>Grundlegende Vererbung</h4>
                            <div class="code-block">
<pre><code class="language-python"># Einfache Vererbung demonstrieren
print("=== GRUNDLEGENDE VERERBUNG ===")

# Basisklasse (Superclass)
class Animal:
    """Basis-Klasse für alle Tiere"""
    
    def __init__(self, name, species):
        self.name = name
        self.species = species
        self.age = 0
        self.health = 100
    
    def speak(self):
        """Basis-Implementierung - wird oft überschrieben"""
        return "Some generic animal sound"
    
    def eat(self, food):
        """Gemeinsame Funktionalität für alle Tiere"""
        print(f"{self.name} isst {food}")
        self.health += 5
        if self.health > 100:
            self.health = 100
    
    def sleep(self):
        """Weitere gemeinsame Funktionalität"""
        print(f"{self.name} schläft")
        self.health += 10
        if self.health > 100:
            self.health = 100
    
    def get_info(self):
        """Informationen über das Tier"""
        return f"{self.name} ist ein {self.species}, {self.age} Jahre alt, Gesundheit: {self.health}%"
    
    def __str__(self):
        return f"{self.species}: {self.name}"

# Abgeleitete Klasse (Subclass)
class Dog(Animal):
    """Hund-Klasse erbt von Animal"""
    
    def __init__(self, name, breed):
        # Superclass-Konstruktor aufrufen
        super().__init__(name, "Dog")
        self.breed = breed
        self.tricks = []
    
    def speak(self):
        """Überschreibt die Eltern-Methode"""
        return f"{self.name} bellt: Wuff! Wuff!"
    
    def fetch(self, item):
        """Neue Methode, nur für Hunde"""
        return f"{self.name} holt {item}"
    
    def learn_trick(self, trick):
        """Weitere neue Methode"""
        if trick not in self.tricks:
            self.tricks.append(trick)
            print(f"{self.name} hat '{trick}' gelernt!")
        else:
            print(f"{self.name} kann '{trick}' bereits")
    
    def perform_tricks(self):
        """Alle Tricks vorführen"""
        if self.tricks:
            print(f"{self.name} führt Tricks vor:")
            for trick in self.tricks:
                print(f"  - {trick}")
        else:
            print(f"{self.name} kann noch keine Tricks")
    
    def get_info(self):
        """Erweitert die Eltern-Methode"""
        base_info = super().get_info()
        return f"{base_info}, Rasse: {self.breed}, Tricks: {len(self.tricks)}"

class Cat(Animal):
    """Katzen-Klasse erbt von Animal"""
    
    def __init__(self, name, indoor=True):
        super().__init__(name, "Cat")
        self.indoor = indoor
        self.lives = 9
    
    def speak(self):
        """Überschreibt die Eltern-Methode"""
        return f"{self.name} miaut: Miau!"
    
    def purr(self):
        """Katzen-spezifische Methode"""
        return f"{self.name} schnurrt zufrieden"
    
    def climb(self, object_name):
        """Weitere katzen-spezifische Methode"""
        if self.indoor:
            return f"{self.name} klettert auf {object_name}"
        else:
            return f"{self.name} klettert auf einen Baum"
    
    def use_life(self):
        """Katzen haben 9 Leben"""
        if self.lives > 0:
            self.lives -= 1
            print(f"{self.name} hat ein Leben verloren. Noch {self.lives} Leben übrig.")
        else:
            print(f"{self.name} hat keine Leben mehr!")

# Vererbung in Aktion
print("Erstelle Tiere...")

# Basis-Tier
generic_animal = Animal("Unbekannt", "Unbekannte Spezies")
print(f"Generic: {generic_animal}")
print(f"Generic spricht: {generic_animal.speak()}")

# Hund
my_dog = Dog("Buddy", "Golden Retriever")
print(f"\nHund: {my_dog}")
print(f"Hund spricht: {my_dog.speak()}")  # Überschriebene Methode
print(f"Hund holt: {my_dog.fetch('Ball')}")  # Neue Methode

# Katze  
my_cat = Cat("Whiskers", indoor=False)
print(f"\nKatze: {my_cat}")
print(f"Katze spricht: {my_cat.speak()}")  # Überschriebene Methode
print(f"Katze schnurrt: {my_cat.purr()}")  # Neue Methode

# Gemeinsame Methoden (von Animal geerbt)
print(f"\n=== GEMEINSAME METHODEN ===")
for animal in [generic_animal, my_dog, my_cat]:
    animal.eat("Futter")
    print(f"  {animal.get_info()}")

# Hundetraining
print(f"\n=== HUNDETRAINING ===")
my_dog.learn_trick("Sitz")
my_dog.learn_trick("Platz")
my_dog.learn_trick("Rolle")
my_dog.perform_tricks()

# isinstance() und issubclass() - Type Checking
print(f"\n=== TYPE CHECKING ===")
print(f"my_dog ist Animal: {isinstance(my_dog, Animal)}")
print(f"my_dog ist Dog: {isinstance(my_dog, Dog)}")
print(f"my_dog ist Cat: {isinstance(my_dog, Cat)}")

print(f"Dog ist Subclass von Animal: {issubclass(Dog, Animal)}")
print(f"Cat ist Subclass von Animal: {issubclass(Cat, Animal)}")
print(f"Dog ist Subclass von Cat: {issubclass(Dog, Cat)}")

# Method Resolution Order (MRO)
print(f"\n=== METHOD RESOLUTION ORDER ===")
print(f"Dog MRO: {Dog.__mro__}")
print(f"Cat MRO: {Cat.__mro__}")</code></pre>
                            </div>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Super() und Methoden-Überladung</h2>
                        <p>Die <code>super()</code> Funktion ermöglicht es, auf Methoden der Elternklasse zuzugreifen und diese zu erweitern oder zu modifizieren:</p>
                        
                        <div class="super-usage">
                            <div class="super-examples">
                                <h4>Super() in verschiedenen Kontexten</h4>
                                <div class="code-block">
<pre><code class="language-python">class Vehicle:
    """Basis-Fahrzeug-Klasse"""
    
    def __init__(self, make, model, year):
        print(f"Vehicle.__init__ aufgerufen für {make} {model}")
        self.make = make
        self.model = model
        self.year = year
        self.mileage = 0
        self.fuel_capacity = 50
        self.current_fuel = self.fuel_capacity
        self.is_running = False
    
    def start(self):
        """Fahrzeug starten"""
        if not self.is_running:
            if self.current_fuel > 0:
                self.is_running = True
                print(f"{self.make} {self.model} gestartet")
                return True
            else:
                print(f"Kein Treibstoff! {self.make} {self.model} kann nicht starten")
                return False
        else:
            print(f"{self.make} {self.model} läuft bereits")
            return False
    
    def stop(self):
        """Fahrzeug stoppen"""
        if self.is_running:
            self.is_running = False
            print(f"{self.make} {self.model} gestoppt")
        else:
            print(f"{self.make} {self.model} ist bereits gestoppt")
    
    def drive(self, distance):
        """Fahrzeug fahren"""
        if not self.is_running:
            print(f"Fahrzeug muss erst gestartet werden")
            return False
        
        fuel_needed = distance * 0.1  # 0.1L pro km
        if fuel_needed > self.current_fuel:
            print(f"Nicht genug Treibstoff für {distance}km")
            return False
        
        self.mileage += distance
        self.current_fuel -= fuel_needed
        print(f"{distance}km gefahren. Kilometerstand: {self.mileage}km")
        return True
    
    def refuel(self, amount=None):
        """Tanken"""
        if amount is None:
            amount = self.fuel_capacity - self.current_fuel
        
        actual_amount = min(amount, self.fuel_capacity - self.current_fuel)
        self.current_fuel += actual_amount
        print(f"{actual_amount:.1f}L getankt. Tank: {self.current_fuel:.1f}L/{self.fuel_capacity}L")
        return actual_amount
    
    def get_info(self):
        """Fahrzeuginformationen"""
        status = "läuft" if self.is_running else "gestoppt"
        return f"{self.year} {self.make} {self.model} ({status}) - {self.mileage}km, {self.current_fuel:.1f}L Treibstoff"
    
    def __str__(self):
        return f"{self.year} {self.make} {self.model}"

class Car(Vehicle):
    """Auto-Klasse mit erweiterten Funktionen"""
    
    def __init__(self, make, model, year, doors=4):
        # Wichtig: super().__init__() VOR eigenen Attributen
        print(f"Car.__init__ aufgerufen")
        super().__init__(make, model, year)
        
        # Erweiterte Attribute
        self.doors = doors
        self.trunk_capacity = 400  # Liter
        self.trunk_contents = []
        self.passengers = 0
        self.max_passengers = 5
    
    def start(self):
        """Erweiterte Start-Methode"""
        print("Auto-spezifische Startsequenz:")
        print("  - Sicherheitsgurt-Warnung")
        print("  - Spiegel einstellen")
        
        # Eltern-Methode aufrufen
        result = super().start()
        
        if result:
            print("  - Radio anschalten")
            print("  - Klimaanlage aktivieren")
        
        return result
    
    def drive(self, distance):
        """Erweiterte Fahr-Methode mit Komfort-Features"""
        if self.passengers == 0:
            print("Warnung: Keine Passagiere im Auto")
        
        # Basis-Fahren mit super()
        result = super().drive(distance)
        
        if result:
            print("  - GPS aktualisiert")
            print("  - Fahrtenbuch eingetragen")
        
        return result
    
    def load_trunk(self, item, volume):
        """Gepäck einladen"""
        current_volume = sum(item['volume'] for item in self.trunk_contents)
        
        if current_volume + volume > self.trunk_capacity:
            print(f"Kofferraum voll! {item} passt nicht mehr rein")
            return False
        
        self.trunk_contents.append({'name': item, 'volume': volume})
        print(f"{item} ({volume}L) in Kofferraum geladen")
        return True
    
    def board_passenger(self, passenger_name):
        """Passagier einsteigen lassen"""
        if self.passengers >= self.max_passengers:
            print(f"Auto voll! {passenger_name} kann nicht einsteigen")
            return False
        
        self.passengers += 1
        print(f"{passenger_name} ist eingestiegen ({self.passengers}/{self.max_passengers})")
        return True
    
    def get_info(self):
        """Erweiterte Fahrzeuginfo"""
        base_info = super().get_info()
        trunk_volume = sum(item['volume'] for item in self.trunk_contents)
        
        additional_info = f", {self.doors} Türen, {self.passengers} Passagiere, Kofferraum: {trunk_volume}L/{self.trunk_capacity}L"
        return base_info + additional_info

class ElectricCar(Car):
    """Elektroauto - erbt von Car"""
    
    def __init__(self, make, model, year, doors=4, battery_capacity=75):
        print(f"ElectricCar.__init__ aufgerufen")
        # Konstruktor der Elternklasse aufrufen
        super().__init__(make, model, year, doors)
        
        # Elektroauto-spezifische Attribute
        self.battery_capacity = battery_capacity  # kWh
        self.current_charge = battery_capacity
        self.charging = False
        
        # Treibstoff-System überschreiben
        self.fuel_capacity = 0  # Elektroautos haben keinen Tank
        self.current_fuel = 0
    
    def start(self):
        """Elektroauto-spezifisches Starten"""
        print("Elektroauto-Start-Sequenz:")
        print("  - Batteriesystem prüfen")
        print("  - Elektromotor aktivieren")
        
        if self.current_charge <= 0:
            print("Batterie leer! Auto kann nicht starten")
            return False
        
        # Basis-Startlogik, aber ohne Treibstoff-Check
        if not self.is_running:
            self.is_running = True
            print(f"{self.make} {self.model} (elektrisch) gestartet")
            print("  - Regenerative Bremsen aktiviert")
            return True
        else:
            print(f"{self.make} {self.model} läuft bereits")
            return False
    
    def drive(self, distance):
        """Elektrisches Fahren"""
        if not self.is_running:
            print("Fahrzeug muss erst gestartet werden")
            return False
        
        energy_needed = distance * 0.2  # 0.2 kWh pro km
        if energy_needed > self.current_charge:
            print(f"Nicht genug Batterieladung für {distance}km")
            return False
        
        self.mileage += distance
        self.current_charge -= energy_needed
        print(f"{distance}km elektrisch gefahren. Kilometerstand: {self.mileage}km")
        print(f"  - Energie regeneriert beim Bremsen")
        return True
    
    def charge(self, power_kw=11, hours=1):
        """Batterie laden"""
        if self.charging:
            print("Auto lädt bereits")
            return
        
        self.charging = True
        energy_added = min(power_kw * hours, self.battery_capacity - self.current_charge)
        self.current_charge += energy_added
        
        print(f"{energy_added:.1f}kWh geladen ({hours}h @ {power_kw}kW)")
        print(f"Batteriestand: {self.current_charge:.1f}kWh/{self.battery_capacity}kWh ({(self.current_charge/self.battery_capacity)*100:.1f}%)")
        
        self.charging = False
    
    def refuel(self, amount=None):
        """Überschreibt refuel - Elektroautos können nicht getankt werden"""
        print("Elektroautos werden nicht getankt, sondern geladen! Verwende charge()")
        return 0
    
    def get_info(self):
        """Elektroauto-spezifische Info"""
        # Car's get_info aufrufen, aber Vehicle's Treibstoff-Info ersetzen
        info = super().get_info()
        
        # Treibstoff-Teil durch Batterie-Info ersetzen
        info = info.replace(f", {self.current_fuel:.1f}L Treibstoff", 
                          f", {self.current_charge:.1f}kWh Batterie ({(self.current_charge/self.battery_capacity)*100:.1f}%)")
        return info

# Demonstration der Super-Verwendung
print("=== SUPER() DEMONSTRATION ===")

# Normales Auto
print("\n--- Normales Auto ---")
my_car = Car("Toyota", "Camry", 2023)
print(my_car.get_info())

my_car.board_passenger("Alice")
my_car.board_passenger("Bob")
my_car.load_trunk("Koffer", 50)
my_car.start()
my_car.drive(100)
print(my_car.get_info())

# Elektroauto
print("\n--- Elektroauto ---")
my_tesla = ElectricCar("Tesla", "Model 3", 2024, doors=4, battery_capacity=80)
print(my_tesla.get_info())

my_tesla.board_passenger("Charlie")
my_tesla.start()
my_tesla.drive(150)
my_tesla.refuel()  # Funktioniert nicht bei Elektroautos
my_tesla.charge(power_kw=50, hours=0.5)  # Schnellladen
print(my_tesla.get_info())

# Method Resolution Order zeigen
print("\n=== METHOD RESOLUTION ORDER ===")
print(f"ElectricCar MRO: {[cls.__name__ for cls in ElectricCar.__mro__]}")

# Super() ohne Argumente (Python 3 Style)
print("\n=== SUPER() OHNE ARGUMENTE ===")

class ModernClass:
    def __init__(self, value):
        self.value = value
    
    def display(self):
        return f"ModernClass: {self.value}"

class ModernChild(ModernClass):
    def __init__(self, value, extra):
        super().__init__(value)  # Python 3 Stil - einfacher
        self.extra = extra
    
    def display(self):
        base_display = super().display()
        return f"{base_display}, Extra: {self.extra}"

# vs. Python 2 Stil (funktioniert auch in Python 3)
class OldStyleChild(ModernClass):
    def __init__(self, value, extra):
        super(OldStyleChild, self).__init__(value)  # Python 2 Stil - explizit
        self.extra = extra
    
    def display(self):
        base_display = super(OldStyleChild, self).display()
        return f"{base_display}, Extra: {self.extra}"

modern = ModernChild("test", "additional")
old_style = OldStyleChild("test", "additional")

print(f"Modern Style: {modern.display()}")
print(f"Old Style: {old_style.display()}")

# Cooperative Inheritance (wichtig bei Multiple Inheritance)
print("\n=== COOPERATIVE INHERITANCE ===")

class A:
    def __init__(self):
        print("A.__init__")
        super().__init__()  # Wichtig: auch Basis-Klassen sollten super() aufrufen
    
    def method(self):
        print("A.method")
        super().method() if hasattr(super(), 'method') else None

class B:
    def __init__(self):
        print("B.__init__")
        super().__init__()
    
    def method(self):
        print("B.method")
        super().method() if hasattr(super(), 'method') else None

class C(A, B):
    def __init__(self):
        print("C.__init__")
        super().__init__()
    
    def method(self):
        print("C.method")
        super().method()

# MRO und Cooperative Inheritance
c = C()
print(f"C's MRO: {[cls.__name__ for cls in C.__mro__]}")
c.method()</code></pre>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Multiple Inheritance und MRO</h2>
                        <p>Python unterstützt <strong>Multiple Inheritance</strong> - eine Klasse kann von mehreren Elternklassen erben. Dies erfordert das Verständnis der <strong>Method Resolution Order (MRO)</strong>:</p>
                        
                        <div class="multiple-inheritance">
                            <div class="mro-explanation">
                                <h4>Multiple Inheritance und Method Resolution Order</h4>
                                <div class="code-block">
<pre><code class="language-python"># Multiple Inheritance Demonstration
print("=== MULTIPLE INHERITANCE ===")

# Basis-Klassen
class Flyable:
    """Mixin für flugfähige Objekte"""
    
    def __init__(self):
        print("Flyable.__init__")
        self.altitude = 0
        self.max_altitude = 10000
        super().__init__()  # Cooperative Inheritance
    
    def take_off(self):
        """Abheben"""
        if self.altitude == 0:
            self.altitude = 100
            print(f"Abgehoben! Höhe: {self.altitude}m")
            return True
        else:
            print("Bereits in der Luft!")
            return False
    
    def land(self):
        """Landen"""
        if self.altitude > 0:
            self.altitude = 0
            print("Gelandet!")
            return True
        else:
            print("Bereits am Boden!")
            return False
    
    def fly_to_altitude(self, target_altitude):
        """Zu bestimmter Höhe fliegen"""
        if target_altitude > self.max_altitude:
            print(f"Maximale Flughöhe überschritten! Max: {self.max_altitude}m")
            return False
        
        if target_altitude < 0:
            print("Flughöhe kann nicht negativ sein!")
            return False
        
        old_altitude = self.altitude
        self.altitude = target_altitude
        
        if target_altitude > old_altitude:
            print(f"Steige von {old_altitude}m auf {target_altitude}m")
        elif target_altitude < old_altitude:
            print(f"Sinke von {old_altitude}m auf {target_altitude}m")
        else:
            print(f"Bereits auf {target_altitude}m Höhe")
        
        return True

class Swimmable:
    """Mixin für schwimmfähige Objekte"""
    
    def __init__(self):
        print("Swimmable.__init__")
        self.depth = 0
        self.max_depth = 100
        super().__init__()  # Cooperative Inheritance
    
    def dive(self, target_depth):
        """Tauchen"""
        if target_depth > self.max_depth:
            print(f"Maximale Tauchtiefe überschritten! Max: {self.max_depth}m")
            return False
        
        if target_depth < 0:
            print("Tauchtiefe kann nicht negativ sein!")
            return False
        
        old_depth = self.depth
        self.depth = target_depth
        
        if target_depth > old_depth:
            print(f"Tauche von {old_depth}m auf {target_depth}m")
        elif target_depth < old_depth:
            print(f"Steige von {old_depth}m auf {target_depth}m")
        else:
            print(f"Bereits auf {target_depth}m Tiefe")
        
        return True
    
    def surface(self):
        """Auftauchen"""
        if self.depth > 0:
            old_depth = self.depth
            self.depth = 0
            print(f"Aufgetaucht von {old_depth}m Tiefe!")
            return True
        else:
            print("Bereits an der Oberfläche!")
            return False

class Animal:
    """Basis-Tierklasse"""
    
    def __init__(self, name, species):
        print(f"Animal.__init__ für {name}")
        self.name = name
        self.species = species
        self.energy = 100
        super().__init__()  # Wichtig für Multiple Inheritance
    
    def eat(self, food):
        """Essen"""
        self.energy += 10
        if self.energy > 100:
            self.energy = 100
        print(f"{self.name} isst {food}. Energie: {self.energy}")
    
    def sleep(self):
        """Schlafen"""
        self.energy = 100
        print(f"{self.name} schläft und erholt sich vollständig")
    
    def get_info(self):
        """Basis-Informationen"""
        return f"{self.name} ({self.species}) - Energie: {self.energy}%"

# Klassen mit Multiple Inheritance

class Bird(Animal, Flyable):
    """Vogel - kann fliegen"""
    
    def __init__(self, name, species, wing_span):
        print(f"Bird.__init__ für {name}")
        self.wing_span = wing_span
        # Wichtig: super() aufrufen für MRO
        super().__init__(name, species)
    
    def chirp(self):
        """Vogel-spezifisches Verhalten"""
        return f"{self.name} zwitschert!"
    
    def get_info(self):
        base_info = super().get_info()
        return f"{base_info}, Flügelspannweite: {self.wing_span}cm, Höhe: {self.altitude}m"

class Fish(Animal, Swimmable):
    """Fisch - kann schwimmen"""
    
    def __init__(self, name, species, fin_count):
        print(f"Fish.__init__ für {name}")
        self.fin_count = fin_count
        super().__init__(name, species)
    
    def swim_fast(self):
        """Fisch-spezifisches Verhalten"""
        return f"{self.name} schwimmt schnell!"
    
    def get_info(self):
        base_info = super().get_info()
        return f"{base_info}, Flossen: {self.fin_count}, Tiefe: {self.depth}m"

class Duck(Animal, Flyable, Swimmable):
    """Ente - kann fliegen UND schwimmen (Multiple Inheritance)"""
    
    def __init__(self, name, color="brown"):
        print(f"Duck.__init__ für {name}")
        self.color = color
        # Duck kann nur begrenzt tauchen
        super().__init__(name, "Duck")
        self.max_depth = 5  # Enten sind keine Tieftaucher
    
    def quack(self):
        """Enten-spezifisches Verhalten"""
        return f"{self.name} quakt: Quack!"
    
    def get_info(self):
        base_info = super().get_info()
        return f"{base_info}, Farbe: {self.color}, Höhe: {self.altitude}m, Tiefe: {self.depth}m"

# MRO Demonstration
print("\n=== METHOD RESOLUTION ORDER ===")

animals = [
    Bird("Eagle", "Bald Eagle", 220),
    Fish("Nemo", "Clownfish", 7),
    Duck("Donald", "white")
]

for animal in animals:
    print(f"\n{animal.__class__.__name__} MRO:")
    for i, cls in enumerate(animal.__class__.__mro__):
        print(f"  {i+1}. {cls.__name__}")

# Funktionalitäten testen
print("\n=== FUNKTIONALITÄTEN TESTEN ===")

eagle = Bird("Eagle", "Bald Eagle", 220)
nemo = Fish("Nemo", "Clownfish", 7)  
donald = Duck("Donald", "white")

print(f"\n--- Eagle (nur fliegen) ---")
print(eagle.get_info())
eagle.take_off()
eagle.fly_to_altitude(1000)
print(eagle.chirp())
print(eagle.get_info())

print(f"\n--- Nemo (nur schwimmen) ---")
print(nemo.get_info())
nemo.dive(20)
print(nemo.swim_fast())
print(nemo.get_info())

print(f"\n--- Donald (fliegen und schwimmen) ---")
print(donald.get_info())
print(donald.quack())

# Donald kann beides!
donald.take_off()
donald.fly_to_altitude(500)
donald.land()
donald.dive(3)
donald.surface()
print(donald.get_info())

# Diamond Problem Demonstration
print("\n=== DIAMOND PROBLEM ===")

class A:
    def __init__(self):
        print("A.__init__")
        super().__init__()
    
    def method(self):
        print("A.method")

class B(A):
    def __init__(self):
        print("B.__init__")
        super().__init__()
    
    def method(self):
        print("B.method")
        super().method()

class C(A):
    def __init__(self):
        print("C.__init__")
        super().__init__()
    
    def method(self):
        print("C.method")
        super().method()

class D(B, C):  # Diamond Inheritance
    def __init__(self):
        print("D.__init__")
        super().__init__()
    
    def method(self):
        print("D.method")
        super().method()

print("Diamond Problem Hierarchie:")
print("    A")
print("   / \\")
print("  B   C")
print("   \\ /")
print("    D")

d = D()
print(f"\nD's MRO: {[cls.__name__ for cls in D.__mro__]}")
print("Method call order:")
d.method()

# Mixin Pattern
print("\n=== MIXIN PATTERN ===")

class TimestampMixin:
    """Mixin für Zeitstempel-Funktionalität"""
    
    def __init__(self):
        from datetime import datetime
        self.created_at = datetime.now()
        super().__init__()
    
    def get_age_seconds(self):
        from datetime import datetime
        return (datetime.now() - self.created_at).total_seconds()

class SerializableMixin:
    """Mixin für Serialisierung"""
    
    def __init__(self):
        super().__init__()
    
    def to_dict(self):
        """Objekt zu Dictionary konvertieren"""
        result = {}
        for key, value in self.__dict__.items():
            if not key.startswith('_'):
                if hasattr(value, 'isoformat'):  # datetime
                    result[key] = value.isoformat()
                else:
                    result[key] = value
        return result
    
    def to_json(self):
        """Objekt zu JSON konvertieren"""
        import json
        return json.dumps(self.to_dict(), indent=2)

class EnhancedAnimal(Animal, TimestampMixin, SerializableMixin):
    """Tier mit zusätzlichen Mixin-Funktionalitäten"""
    
    def __init__(self, name, species):
        super().__init__(name, species)

# Enhanced Animal testen
enhanced_cat = EnhancedAnimal("Fluffy", "Cat")
print(f"\nEnhanced Cat erstellt vor {enhanced_cat.get_age_seconds():.2f} Sekunden")
print(f"Dictionary: {enhanced_cat.to_dict()}")
print(f"JSON:\n{enhanced_cat.to_json()}")

# Mixin Kombination
class SuperDuck(Duck, TimestampMixin, SerializableMixin):
    """Ente mit allen Extras"""
    
    def __init__(self, name, color="brown"):
        super().__init__(name, color)

super_duck = SuperDuck("SuperDucky", "golden")
super_duck.take_off()
super_duck.fly_to_altitude(200)

print(f"\nSuper Duck JSON:")
print(super_duck.to_json())</code></pre>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Abstract Base Classes und Interfaces</h2>
                        <p>Abstract Base Classes (ABC) definieren Schnittstellen, die von Unterklassen implementiert werden müssen:</p>
                        
                        <div class="abstract-classes">
                            <div class="abc-examples">
                                <h4>ABC-Module und abstrakte Methoden</h4>
                                <div class="code-block">
<pre><code class="language-python"># Abstract Base Classes (ABC)
from abc import ABC, abstractmethod, abstractproperty
from typing import List, Optional

print("=== ABSTRACT BASE CLASSES ===")

# Abstrakte Basis-Klasse
class Shape(ABC):
    """Abstrakte Form-Klasse"""
    
    def __init__(self, name):
        self.name = name
        self._color = "black"
    
    @abstractmethod
    def area(self) -> float:
        """Abstrakte Methode - muss implementiert werden"""
        pass
    
    @abstractmethod
    def perimeter(self) -> float:
        """Weitere abstrakte Methode"""
        pass
    
    @property
    @abstractmethod
    def vertices(self) -> int:
        """Abstrakte Property - Anzahl Ecken"""
        pass
    
    # Konkrete Methode (nicht abstrakt)
    def describe(self) -> str:
        """Konkrete Methode kann in ABC existieren"""
        return f"{self.name}: {self._color}, Fläche: {self.area():.2f}, Umfang: {self.perimeter():.2f}"
    
    @property
    def color(self) -> str:
        return self._color
    
    @color.setter
    def color(self, value: str):
        self._color = value
    
    # Template Method Pattern
    def draw(self):
        """Template-Methode nutzt abstrakte Methoden"""
        print(f"Zeichne {self.name}:")
        print(f"  - Farbe: {self.color}")
        print(f"  - Ecken: {self.vertices}")
        print(f"  - Fläche: {self.area():.2f}")
        print(f"  - Umfang: {self.perimeter():.2f}")
        self._draw_specific()  # Hook-Methode
    
    def _draw_specific(self):
        """Hook-Methode für spezifische Zeichnung"""
        print(f"  - Standard-Zeichnung für {self.name}")

# Konkrete Implementierung 1
class Rectangle(Shape):
    """Rechteck-Implementierung"""
    
    def __init__(self, width: float, height: float):
        super().__init__("Rectangle")
        self.width = width
        self.height = height
    
    def area(self) -> float:
        """Implementierung der abstrakten Methode"""
        return self.width * self.height
    
    def perimeter(self) -> float:
        """Implementierung der abstrakten Methode"""
        return 2 * (self.width + self.height)
    
    @property
    def vertices(self) -> int:
        """Implementierung der abstrakten Property"""
        return 4
    
    def _draw_specific(self):
        """Spezifische Zeichnung für Rechteck"""
        print(f"  - Zeichne {self.width} x {self.height} Rechteck")

class Circle(Shape):
    """Kreis-Implementierung"""
    
    def __init__(self, radius: float):
        super().__init__("Circle")
        self.radius = radius
    
    def area(self) -> float:
        import math
        return math.pi * self.radius ** 2
    
    def perimeter(self) -> float:
        import math
        return 2 * math.pi * self.radius
    
    @property
    def vertices(self) -> int:
        return 0  # Kreis hat keine Ecken
    
    def _draw_specific(self):
        print(f"  - Zeichne Kreis mit Radius {self.radius}")

class Triangle(Shape):
    """Dreieck-Implementierung"""
    
    def __init__(self, side_a: float, side_b: float, side_c: float):
        super().__init__("Triangle")
        self.side_a = side_a
        self.side_b = side_b
        self.side_c = side_c
        
        # Validierung
        if not self._is_valid_triangle():
            raise ValueError("Ungültige Dreiecks-Seiten")
    
    def _is_valid_triangle(self) -> bool:
        """Dreiecksungleichung prüfen"""
        return (self.side_a + self.side_b > self.side_c and
                self.side_a + self.side_c > self.side_b and
                self.side_b + self.side_c > self.side_a)
    
    def area(self) -> float:
        """Heron'sche Formel"""
        import math
        s = self.perimeter() / 2
        return math.sqrt(s * (s - self.side_a) * (s - self.side_b) * (s - self.side_c))
    
    def perimeter(self) -> float:
        return self.side_a + self.side_b + self.side_c
    
    @property
    def vertices(self) -> int:
        return 3

# ABC Demonstration
print("\n--- Formen erstellen ---")

# Versuch, abstrakte Klasse zu instanziieren (Fehler!)
try:
    abstract_shape = Shape("Test")
except TypeError as e:
    print(f"Kann ABC nicht instanziieren: {e}")

# Konkrete Implementierungen
shapes = [
    Rectangle(5, 3),
    Circle(2),
    Triangle(3, 4, 5)
]

for shape in shapes:
    shape.color = ["red", "blue", "green"][shapes.index(shape)]
    print(f"\n{shape.describe()}")
    shape.draw()

# Interface-ähnliche abstrakte Klasse
class Drawable(ABC):
    """Interface für zeichenbare Objekte"""
    
    @abstractmethod
    def draw_to_canvas(self, canvas):
        """Auf Canvas zeichnen"""
        pass
    
    @abstractmethod
    def get_bounding_box(self):
        """Begrenzungsbox zurückgeben"""
        pass

class Movable(ABC):
    """Interface für bewegbare Objekte"""
    
    @abstractmethod
    def move(self, dx: float, dy: float):
        """Objekt bewegen"""
        pass
    
    @abstractmethod
    def get_position(self):
        """Position zurückgeben"""
        pass

# Multiple Interface Implementation
class GameSprite(Drawable, Movable):
    """Spiel-Sprite implementiert mehrere Interfaces"""
    
    def __init__(self, x: float, y: float, image_path: str):
        self.x = x
        self.y = y
        self.image_path = image_path
        self.width = 32
        self.height = 32
    
    def draw_to_canvas(self, canvas):
        print(f"Zeichne Sprite {self.image_path} auf Canvas bei ({self.x}, {self.y})")
    
    def get_bounding_box(self):
        return {
            'x': self.x,
            'y': self.y,
            'width': self.width,
            'height': self.height
        }
    
    def move(self, dx: float, dy: float):
        self.x += dx
        self.y += dy
        print(f"Sprite bewegt zu ({self.x}, {self.y})")
    
    def get_position(self):
        return (self.x, self.y)

# Protocol (Python 3.8+) - Alternative zu ABC
try:
    from typing import Protocol
    
    class Comparable(Protocol):
        """Protocol für vergleichbare Objekte"""
        
        def __lt__(self, other):
            ...
        
        def __le__(self, other):
            ...
    
    def sort_items(items: List[Comparable]) -> List[Comparable]:
        """Sortiert vergleichbare Objekte"""
        return sorted(items)
    
    # Klasse implementiert Protocol implizit
    class Product:
        def __init__(self, name: str, price: float):
            self.name = name
            self.price = price
        
        def __lt__(self, other):
            return self.price < other.price
        
        def __le__(self, other):
            return self.price <= other.price
        
        def __str__(self):
            return f"{self.name}: ${self.price}"
    
    products = [
        Product("Laptop", 999),
        Product("Mouse", 25),
        Product("Keyboard", 75)
    ]
    
    sorted_products = sort_items(products)
    print(f"\n--- PROTOCOL DEMONSTRATION ---")
    print("Sortierte Produkte nach Preis:")
    for product in sorted_products:
        print(f"  {product}")

except ImportError:
    print("Protocol nicht verfügbar (Python < 3.8)")

# Mixin vs. ABC
class LoggingMixin:
    """Mixin für Logging (konkrete Implementierung)"""
    
    def log(self, message: str):
        from datetime import datetime
        timestamp = datetime.now().strftime("%Y-%m-%d %H:%M:%S")
        print(f"[{timestamp}] {self.__class__.__name__}: {message}")

class Persistent(ABC):
    """ABC für persistente Objekte"""
    
    @abstractmethod
    def save(self):
        """Objekt speichern"""
        pass
    
    @abstractmethod
    def load(self, identifier):
        """Objekt laden"""
        pass
    
    @abstractmethod
    def delete(self):
        """Objekt löschen"""
        pass

class User(LoggingMixin, Persistent):
    """User-Klasse mit Mixin und ABC"""
    
    def __init__(self, username: str, email: str):
        self.username = username
        self.email = email
        self.id = None
        self.log(f"User {username} erstellt")
    
    def save(self):
        # Simulierte Speicherung
        if self.id is None:
            self.id = hash(self.username) % 10000
        self.log(f"User {self.username} gespeichert mit ID {self.id}")
    
    def load(self, identifier):
        # Simuliertes Laden
        self.id = identifier
        self.log(f"User mit ID {identifier} geladen")
    
    def delete(self):
        self.log(f"User {self.username} gelöscht")
        self.id = None

# Demonstration
print(f"\n--- MIXIN + ABC ---")
user = User("alice", "alice@example.com")
user.save()
user.delete()

# Template Method Pattern mit ABC
class DataProcessor(ABC):
    """Template für Datenverarbeitung"""
    
    def process_data(self, data):
        """Template-Methode definiert Ablauf"""
        self.validate_data(data)
        cleaned_data = self.clean_data(data)
        processed_data = self.transform_data(cleaned_data)
        result = self.save_result(processed_data)
        return result
    
    @abstractmethod
    def validate_data(self, data):
        """Abstrakt: Daten validieren"""
        pass
    
    @abstractmethod
    def clean_data(self, data):
        """Abstrakt: Daten bereinigen"""
        pass
    
    @abstractmethod
    def transform_data(self, data):
        """Abstrakt: Daten transformieren"""
        pass
    
    def save_result(self, data):
        """Konkret: Standard-Speicherung"""
        print(f"Ergebnis gespeichert: {len(data)} Datensätze")
        return data

class CSVProcessor(DataProcessor):
    """CSV-spezifischer Prozessor"""
    
    def validate_data(self, data):
        if not isinstance(data, list):
            raise ValueError("CSV-Daten müssen Liste sein")
        print("CSV-Daten validiert")
    
    def clean_data(self, data):
        # Leere Zeilen entfernen
        cleaned = [row for row in data if row.strip()]
        print(f"CSV bereinigt: {len(data)} -> {len(cleaned)} Zeilen")
        return cleaned
    
    def transform_data(self, data):
        # Zu Dictionary-Liste konvertieren
        if not data:
            return []
        
        header = data[0].split(',')
        result = []
        for row in data[1:]:
            values = row.split(',')
            result.append(dict(zip(header, values)))
        
        print(f"CSV transformiert zu {len(result)} Dictionaries")
        return result

# Template Method demonstration
csv_data = [
    "name,age,city",
    "Alice,25,Berlin",
    "Bob,30,Munich",
    "",  # Leere Zeile
    "Charlie,35,Hamburg"
]

processor = CSVProcessor()
result = processor.process_data(csv_data)
print(f"Verarbeitetes Ergebnis: {result}")</code></pre>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="content-section">
                        <h2>Praktisches Beispiel: Spiel-Engine mit Vererbungshierarchie</h2>
                        <p>Ein vollständiges Spiel-Engine-System, das alle Vererbungskonzepte in einem komplexen, realistischen Szenario demonstriert:</p>
                        
                        <div class="game-engine-system">
                            <div class="code-header">
                                <span class="code-title">game_engine_inheritance.py</span>
                                <span class="badge bg-success">Vollständiges Beispiel</span>
                            </div>
                            <div class="code-block">
<pre><code class="language-python">#!/usr/bin/env python3
"""
Spiel-Engine mit umfassender Vererbungshierarchie
Demonstriert alle OOP-Konzepte: Inheritance, ABC, Mixins, Multiple Inheritance
"""

from abc import ABC, abstractmethod
from typing import List, Tuple, Dict, Optional, Any
from enum import Enum
from datetime import datetime
import math
import random

# Enums für Spiel-Zustände
class EntityType(Enum):
    PLAYER = "player"
    ENEMY = "enemy"
    NPC = "npc"
    ITEM = "item"
    PROJECTILE = "projectile"

class DamageType(Enum):
    PHYSICAL = "physical"
    MAGICAL = "magical"
    FIRE = "fire"
    ICE = "ice"
    POISON = "poison"

# Basis-Mixins für gemeinsame Funktionalitäten
class PositionMixin:
    """Mixin für Positionierung im 2D-Raum"""
    
    def __init__(self, x: float = 0, y: float = 0):
        self.x = x
        self.y = y
        super().__init__()
    
    def move_to(self, x: float, y: float):
        """Absolute Bewegung"""
        self.x = x
        self.y = y
    
    def move_by(self, dx: float, dy: float):
        """Relative Bewegung"""
        self.x += dx
        self.y += dy
    
    def distance_to(self, other) -> float:
        """Distanz zu anderem Objekt"""
        if hasattr(other, 'x') and hasattr(other, 'y'):
            return math.sqrt((self.x - other.x)**2 + (self.y - other.y)**2)
        return float('inf')
    
    def get_position(self) -> Tuple[float, float]:
        return (self.x, self.y)

class HealthMixin:
    """Mixin für Gesundheitspunkte"""
    
    def __init__(self, max_health: int = 100):
        self.max_health = max_health
        self.current_health = max_health
        self.is_alive = True
        super().__init__()
    
    def take_damage(self, damage: int, damage_type: DamageType = DamageType.PHYSICAL) -> int:
        """Schaden nehmen"""
        actual_damage = self._calculate_damage_reduction(damage, damage_type)
        self.current_health -= actual_damage
        
        if self.current_health <= 0:
            self.current_health = 0
            self._on_death()
        
        return actual_damage
    
    def heal(self, amount: int) -> int:
        """Heilen"""
        if not self.is_alive:
            return 0
        
        old_health = self.current_health
        self.current_health = min(self.current_health + amount, self.max_health)
        return self.current_health - old_health
    
    def _calculate_damage_reduction(self, damage: int, damage_type: DamageType) -> int:
        """Override in Subklassen für Resistenzen"""
        return damage
    
    def _on_death(self):
        """Called when health reaches 0"""
        self.is_alive = False
        print(f"{getattr(self, 'name', 'Entity')} ist gestorben!")
    
    @property
    def health_percentage(self) -> float:
        return (self.current_health / self.max_health) * 100

class RenderMixin:
    """Mixin für Rendering"""
    
    def __init__(self, sprite: str = "default", size: int = 32):
        self.sprite = sprite
        self.size = size
        self.visible = True
        self.rotation = 0.0
        super().__init__()
    
    def render(self, screen):
        """Basis-Rendering"""
        if self.visible and hasattr(self, 'x') and hasattr(self, 'y'):
            print(f"Render {self.sprite} at ({self.x:.1f}, {self.y:.1f}) size:{self.size}")
    
    def hide(self):
        self.visible = False
    
    def show(self):
        self.visible = True

class TimestampMixin:
    """Mixin für Zeitstempel"""
    
    def __init__(self):
        self.created_at = datetime.now()
        self.last_updated = self.created_at
        super().__init__()
    
    def update_timestamp(self):
        self.last_updated = datetime.now()
    
    def get_age_seconds(self) -> float:
        return (datetime.now() - self.created_at).total_seconds()

# Abstrakte Basis-Klassen
class GameObject(ABC, PositionMixin, RenderMixin, TimestampMixin):
    """Abstrakte Basis für alle Spiel-Objekte"""
    
    def __init__(self, name: str, entity_type: EntityType, **kwargs):
        self.name = name
        self.entity_type = entity_type
        self.active = True
        self.tags = set()
        super().__init__(**kwargs)
    
    @abstractmethod
    def update(self, delta_time: float):
        """Update-Logic (muss implementiert werden)"""
        pass
    
    def add_tag(self, tag: str):
        self.tags.add(tag)
    
    def has_tag(self, tag: str) -> bool:
        return tag in self.tags
    
    def destroy(self):
        """Objekt zerstören"""
        self.active = False
        self.visible = False
        print(f"{self.name} wurde zerstört")
    
    def __str__(self):
        pos = f"({self.x:.1f}, {self.y:.1f})" if hasattr(self, 'x') else "no position"
        return f"{self.name} [{self.entity_type.value}] at {pos}"

class LivingEntity(GameObject, HealthMixin):
    """Abstrakte Basis für lebende Entitäten"""
    
    def __init__(self, name: str, entity_type: EntityType, max_health: int = 100, **kwargs):
        super().__init__(name=name, entity_type=entity_type, max_health=max_health, **kwargs)
        self.level = 1
        self.experience = 0
        self.stats = {
            'strength': 10,
            'agility': 10,
            'intelligence': 10
        }
    
    @abstractmethod
    def attack(self, target: 'LivingEntity') -> int:
        """Angriff ausführen"""
        pass
    
    def gain_experience(self, amount: int):
        """Erfahrung sammeln"""
        self.experience += amount
        # Vereinfachtes Level-System
        while self.experience >= (self.level * 100):
            self.level_up()
    
    def level_up(self):
        """Level aufsteigen"""
        self.level += 1
        # Gesundheit erhöhen
        health_increase = 20
        self.max_health += health_increase
        self.current_health += health_increase
        
        # Stats erhöhen
        for stat in self.stats:
            self.stats[stat] += 2
        
        print(f"{self.name} ist auf Level {self.level} aufgestiegen!")
    
    def _on_death(self):
        super()._on_death()
        self.add_tag("dead")

# Spezielle Fähigkeiten-Interfaces
class Movable(ABC):
    """Interface für bewegbare Objekte"""
    
    @abstractmethod
    def move(self, direction: Tuple[float, float], speed: float):
        pass

class Attackable(ABC):
    """Interface für angreifbare Objekte"""
    
    @abstractmethod
    def can_be_attacked_by(self, attacker) -> bool:
        pass

# Konkrete Implementierungen

class Player(LivingEntity, Movable):
    """Spieler-Klasse"""
    
    def __init__(self, name: str, character_class: str = "warrior"):
        super().__init__(
            name=name, 
            entity_type=EntityType.PLAYER, 
            max_health=120,
            sprite=f"{character_class}_player"
        )
        self.character_class = character_class
        self.inventory = []
        self.equipped_weapon = None
        self.mana = 100
        self.max_mana = 100
        
        # Klassen-spezifische Stats
        if character_class == "warrior":
            self.stats['strength'] += 5
            self.max_health += 30
        elif character_class == "mage":
            self.stats['intelligence'] += 8
            self.max_mana += 50
        elif character_class == "rogue":
            self.stats['agility'] += 6
    
    def update(self, delta_time: float):
        """Player-Update"""
        self.update_timestamp()
        
        # Mana-Regeneration
        if self.mana < self.max_mana:
            self.mana += delta_time * 2
            self.mana = min(self.mana, self.max_mana)
    
    def attack(self, target: LivingEntity) -> int:
        """Spieler-Angriff"""
        if not self.is_alive:
            return 0
        
        base_damage = self.stats['strength'] + (self.level * 2)
        
        # Waffen-Bonus
        if self.equipped_weapon:
            base_damage += self.equipped_weapon.damage
        
        # Kritischer Treffer basierend auf Agility
        crit_chance = self.stats['agility'] * 0.01
        if random.random() < crit_chance:
            base_damage *= 2
            print(f"{self.name} landet kritischen Treffer!")
        
        damage_dealt = target.take_damage(base_damage)
        print(f"{self.name} greift {target.name} an für {damage_dealt} Schaden!")
        
        return damage_dealt
    
    def move(self, direction: Tuple[float, float], speed: float):
        """Bewegung mit Agility-Bonus"""
        agility_modifier = 1 + (self.stats['agility'] * 0.02)
        effective_speed = speed * agility_modifier
        
        dx = direction[0] * effective_speed
        dy = direction[1] * effective_speed
        self.move_by(dx, dy)
    
    def cast_spell(self, spell_name: str, target=None) -> bool:
        """Zauber wirken"""
        spells = {
            "fireball": {"cost": 20, "damage": 30 + self.stats['intelligence']},
            "heal": {"cost": 15, "healing": 25 + self.stats['intelligence']},
            "lightning": {"cost": 25, "damage": 35 + self.stats['intelligence']}
        }
        
        if spell_name not in spells:
            print(f"Zauber {spell_name} unbekannt!")
            return False
        
        spell = spells[spell_name]
        
        if self.mana < spell["cost"]:
            print(f"Nicht genug Mana für {spell_name}!")
            return False
        
        self.mana -= spell["cost"]
        
        if spell_name == "heal":
            healed = self.heal(spell["healing"])
            print(f"{self.name} heilt sich für {healed} HP!")
        else:
            if target and hasattr(target, 'take_damage'):
                damage = target.take_damage(spell["damage"], DamageType.MAGICAL)
                print(f"{self.name} wirkt {spell_name} auf {target.name} für {damage} magischen Schaden!")
        
        return True

class Enemy(LivingEntity, Movable, Attackable):
    """Feind-Klasse"""
    
    def __init__(self, name: str, enemy_type: str = "goblin", level: int = 1):
        health = 60 + (level * 20)
        super().__init__(
            name=name, 
            entity_type=EntityType.ENEMY, 
            max_health=health,
            sprite=f"{enemy_type}_enemy"
        )
        self.enemy_type = enemy_type
        self.level = level
        self.aggro_range = 50.0
        self.target = None
        self.loot_table = []
        
        # Level-basierte Stats
        for stat in self.stats:
            self.stats[stat] += (level - 1) * 3
        
        # Typ-spezifische Eigenschaften
        if enemy_type == "goblin":
            self.stats['agility'] += 3
        elif enemy_type == "orc":
            self.stats['strength'] += 5
            self.max_health += 40
        elif enemy_type == "skeleton":
            self.add_tag("undead")
    
    def update(self, delta_time: float):
        """Enemy AI Update"""
        self.update_timestamp()
        
        if not self.is_alive:
            return
        
        # Einfache AI: Ziel verfolgen wenn in Reichweite
        if self.target and hasattr(self.target, 'distance_to'):
            distance = self.distance_to(self.target)
            
            if distance <= self.aggro_range:
                # Zum Ziel bewegen
                if distance > 5:  # Mindestabstand für Angriff
                    direction = self._calculate_direction_to(self.target)
                    self.move(direction, 20 * delta_time)
                else:
                    # Angreifen
                    self.attack(self.target)
    
    def _calculate_direction_to(self, target) -> Tuple[float, float]:
        """Richtung zum Ziel berechnen"""
        dx = target.x - self.x
        dy = target.y - self.y
        distance = math.sqrt(dx**2 + dy**2)
        
        if distance == 0:
            return (0, 0)
        
        return (dx / distance, dy / distance)
    
    def attack(self, target: LivingEntity) -> int:
        """Enemy-Angriff"""
        if not self.is_alive:
            return 0
        
        base_damage = self.stats['strength'] + self.level
        damage_dealt = target.take_damage(base_damage)
        print(f"{self.name} greift {target.name} an für {damage_dealt} Schaden!")
        
        return damage_dealt
    
    def move(self, direction: Tuple[float, float], speed: float):
        """Enemy-Bewegung"""
        dx = direction[0] * speed
        dy = direction[1] * speed
        self.move_by(dx, dy)
    
    def can_be_attacked_by(self, attacker) -> bool:
        """Kann von Angreifer angegriffen werden"""
        if attacker.entity_type == EntityType.PLAYER:
            return True
        elif attacker.entity_type == EntityType.ENEMY:
            return False  # Enemies greifen sich normalerweise nicht an
        return True
    
    def set_target(self, target: LivingEntity):
        """Ziel setzen"""
        self.target = target
    
    def _on_death(self):
        """Beim Tod Erfahrung und Loot geben"""
        super()._on_death()
        
        if self.target and hasattr(self.target, 'gain_experience'):
            exp_reward = self.level * 50
            self.target.gain_experience(exp_reward)
            print(f"{self.target.name} erhält {exp_reward} Erfahrungspunkte!")

class NPC(LivingEntity):
    """Non-Player Character"""
    
    def __init__(self, name: str, npc_type: str = "villager"):
        super().__init__(
            name=name, 
            entity_type=EntityType.NPC, 
            max_health=50,
            sprite=f"{npc_type}_npc"
        )
        self.npc_type = npc_type
        self.dialogue = []
        self.shop_items = []
        self.quests = []
    
    def update(self, delta_time: float):
        """NPC-Update (meist statisch)"""
        self.update_timestamp()
    
    def attack(self, target: LivingEntity) -> int:
        """NPCs greifen normalerweise nicht an"""
        print(f"{self.name} weigert sich zu kämpfen!")
        return 0
    
    def talk_to(self, player):
        """Mit NPC sprechen"""
        if self.dialogue:
            print(f"{self.name}: {random.choice(self.dialogue)}")
        else:
            print(f"{self.name}: Hallo, {player.name}!")

class Weapon(GameObject):
    """Waffen-Klasse"""
    
    def __init__(self, name: str, damage: int, weapon_type: str = "sword"):
        super().__init__(
            name=name, 
            entity_type=EntityType.ITEM,
            sprite=f"{weapon_type}_weapon"
        )
        self.damage = damage
        self.weapon_type = weapon_type
        self.durability = 100
        self.max_durability = 100
    
    def update(self, delta_time: float):
        """Waffen-Update"""
        self.update_timestamp()
    
    def use(self) -> bool:
        """Waffe verwenden (Haltbarkeit reduzieren)"""
        if self.durability > 0:
            self.durability -= 1
            if self.durability == 0:
                print(f"{self.name} ist zerbrochen!")
            return True
        return False

class Projectile(GameObject, Movable):
    """Projektil-Klasse für Pfeile, Zauber etc."""
    
    def __init__(self, name: str, damage: int, speed: float, direction: Tuple[float, float], owner):
        super().__init__(
            name=name, 
            entity_type=EntityType.PROJECTILE,
            sprite="projectile"
        )
        self.damage = damage
        self.speed = speed
        self.direction = direction
        self.owner = owner
        self.lifetime = 5.0  # Sekunden
        self.piercing = False
        self.hit_targets = set()
    
    def update(self, delta_time: float):
        """Projektil-Update"""
        self.update_timestamp()
        
        # Bewegen
        self.move(self.direction, self.speed * delta_time)
        
        # Lebensdauer reduzieren
        self.lifetime -= delta_time
        if self.lifetime <= 0:
            self.destroy()
    
    def move(self, direction: Tuple[float, float], speed: float):
        """Projektil-Bewegung"""
        dx = direction[0] * speed
        dy = direction[1] * speed
        self.move_by(dx, dy)
    
    def hit(self, target):
        """Ziel getroffen"""
        if target in self.hit_targets:
            return False
        
        if hasattr(target, 'take_damage'):
            damage_dealt = target.take_damage(self.damage)
            print(f"{self.name} trifft {target.name} für {damage_dealt} Schaden!")
            
            self.hit_targets.add(target)
            
            if not self.piercing:
                self.destroy()
            
            return True
        return False

# Game Engine Klasse
class GameEngine:
    """Haupt-Spiel-Engine"""
    
    def __init__(self):
        self.entities: List[GameObject] = []
        self.players: List[Player] = []
        self.running = False
        self.delta_time = 1.0 / 60.0  # 60 FPS
        self.game_time = 0.0
    
    def add_entity(self, entity: GameObject):
        """Entität hinzufügen"""
        self.entities.append(entity)
        if isinstance(entity, Player):
            self.players.append(entity)
        print(f"Entität hinzugefügt: {entity}")
    
    def remove_entity(self, entity: GameObject):
        """Entität entfernen"""
        if entity in self.entities:
            self.entities.remove(entity)
        if entity in self.players:
            self.players.remove(entity)
    
    def update(self):
        """Engine-Update"""
        self.game_time += self.delta_time
        
        # Alle Entitäten updaten
        for entity in self.entities[:]:  # Kopie für sichere Iteration
            if entity.active:
                entity.update(self.delta_time)
            else:
                self.remove_entity(entity)
    
    def render(self):
        """Rendering"""
        print(f"\n--- Frame {self.game_time:.1f}s ---")
        active_entities = [e for e in self.entities if e.active and e.visible]
        
        for entity in active_entities:
            entity.render(None)  # Screen placeholder
    
    def run_simulation(self, steps: int = 10):
        """Simulation für Demo"""
        self.running = True
        
        for step in range(steps):
            if not self.running:
                break
            
            print(f"\n=== SIMULATION STEP {step + 1} ===")
            self.update()
            
            # Einfache Kollisionserkennung für Demo
            self._check_collisions()
        
        self.running = False
    
    def _check_collisions(self):
        """Einfache Kollisionserkennung"""
        projectiles = [e for e in self.entities if isinstance(e, Projectile) and e.active]
        targets = [e for e in self.entities if isinstance(e, LivingEntity) and e.active]
        
        for projectile in projectiles:
            for target in targets:
                if target != projectile.owner:
                    distance = projectile.distance_to(target)
                    if distance <= 5.0:  # Kollision
                        projectile.hit(target)

def demo_game_engine():
    """Demonstriert die Spiel-Engine"""
    print("🎮 SPIEL-ENGINE MIT VERERBUNG DEMO")
    print("=" * 70)
    
    # Engine erstellen
    engine = GameEngine()
    
    # Spieler erstellen
    print("\n👤 Spieler erstellen...")
    player = Player("Hero", "warrior")
    player.move_to(10, 10)
    
    mage = Player("Gandalf", "mage")
    mage.move_to(5, 5)
    
    engine.add_entity(player)
    engine.add_entity(mage)
    
    # Waffen erstellen
    sword = Weapon("Excalibur", 25, "sword")
    staff = Weapon("Magic Staff", 15, "staff")
    
    player.equipped_weapon = sword
    mage.equipped_weapon = staff
    
    engine.add_entity(sword)
    engine.add_entity(staff)
    
    # Feinde erstellen
    print("\n👹 Feinde erstellen...")
    goblin = Enemy("Goblin Warrior", "goblin", 2)
    goblin.move_to(30, 30)
    goblin.set_target(player)
    
    orc = Enemy("Orc Chief", "orc", 3)
    orc.move_to(40, 25)
    orc.set_target(mage)
    
    engine.add_entity(goblin)
    engine.add_entity(orc)
    
    # NPC erstellen
    merchant = NPC("Merchant Bob", "trader")
    merchant.move_to(0, 0)
    merchant.dialogue = ["Welcome to my shop!", "Fine wares for sale!"]
    
    engine.add_entity(merchant)
    
    # Projektil erstellen
    arrow = Projectile("Magic Arrow", 20, 100, (1, 0), mage)
    arrow.move_to(mage.x, mage.y)
    
    engine.add_entity(arrow)
    
    # Simulation starten
    print(f"\n⚡ Simulation starten...")
    print(f"Entities: {len(engine.entities)}")
    
    # Anfangszustand
    print(f"\n=== ANFANGSZUSTAND ===")
    for entity in engine.entities:
        if isinstance(entity, LivingEntity):
            print(f"{entity.name}: Level {entity.level}, HP {entity.current_health}/{entity.max_health}")
    
    # Kampf-Demo
    print(f"\n⚔️ KAMPF DEMONSTRATION")
    
    # Spieler greift Goblin an
    damage = player.attack(goblin)
    
    # Mage wirkt Zauber
    mage.cast_spell("fireball", orc)
    
    # Goblin greift zurück
    if goblin.is_alive:
        goblin.attack(player)
    
    # NPC Interaktion
    print(f"\n💬 NPC INTERAKTION")
    merchant.talk_to(player)
    
    # Engine-Simulation
    print(f"\n🔄 ENGINE SIMULATION")
    engine.run_simulation(3)
    
    # Endergebnis
    print(f"\n=== ENDERGEBNIS ===")
    surviving_entities = [e for e in engine.entities if e.active]
    
    for entity in surviving_entities:
        if isinstance(entity, LivingEntity):
            status = "ALIVE" if entity.is_alive else "DEAD"
            print(f"{entity.name}: {status} - Level {entity.level}, HP {entity.current_health}/{entity.max_health}")
    
    # Vererbungshierarchie anzeigen
    print(f"\n📊 VERERBUNGSHIERARCHIEN")
    
    classes_to_show = [Player, Enemy, NPC, Weapon, Projectile]
    
    for cls in classes_to_show:
        print(f"\n{cls.__name__} MRO:")
        for i, base_cls in enumerate(cls.__mro__):
            indent = "  " * i
            print(f"{indent}{base_cls.__name__}")
    
    return engine

if __name__ == "__main__":
    demo_engine = demo_game_engine()</code></pre>
                            </div>
                        </div>
                        
                        <div class="example-features">
                            <h5>Was dieses Beispiel demonstriert:</h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <h6>🏗️ Vererbungskonzepte:</h6>
                                    <ul class="feature-list">
                                        <li>Single und Multiple Inheritance</li>
                                        <li>Abstract Base Classes (ABC) mit @abstractmethod</li>
                                        <li>Mixin-Pattern für Code-Wiederverwendung</li>
                                        <li>Method Resolution Order (MRO) bei komplexen Hierarchien</li>
                                        <li>super() für kooperative Vererbung</li>
                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <h6>🎮 Praktische Anwendung:</h6>
                                    <ul class="feature-list">
                                        <li>Realistische Spiel-Engine-Architektur</li>
                                        <li>Template Method Pattern mit ABC</li>
                                        <li>Interface-ähnliche Strukturen mit ABC</li>
                                        <li>Komposition und Vererbung kombiniert</li>
                                        <li>Polymorphismus in Aktion</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="navigation-buttons">
                        <?php renderPythonPageNavigation('python-vererbung'); ?>
                    </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>