<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';

include $_SERVER['DOCUMENT_ROOT'] . '/includes/php-navigation.php';

$page_title = 'PHP OOP - Objektorientierte Programmierung';
include $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php';
?>

<div class="layout-container">
<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/sidebar.php'; ?>
    <div class="main-wrapper">
        <main class="main-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-4 col-lg-3"></div>
                    <div class="col-md-8 col-lg-9">
                        
                        <?php renderNavigation('php-oopin'); ?>
                        
                        <div class="d-flex justify-content-between align-items-center pt-3 pb-2 mb-3 border-bottom">
                            <h1 class="h2"><i class="bi bi-box2 me-2"></i>PHP OOP</h1>
                        </div>

                        <div class="card bg-light mb-4">
                            <div class="card-body">
                                <h2>🎯 Objektorientierte Programmierung - Code wie ein Profi</h2>
                                <p class="lead">OOP ist die <strong>moderne Art zu programmieren</strong>. Statt chaotischen Funktionen organisieren Sie Code in <strong>wiederverwendbare Klassen</strong>. Von einfachen Objekten bis zu komplexen Design-Patterns - hier wird alles erklärt!</p>
                            </div>
                        </div>

                        <div class="alert alert-info">
                            <h5><i class="bi bi-lightbulb me-2"></i>Warum OOP so wichtig ist</h5>
                            <p class="mb-0">Moderne Frameworks wie <strong>Laravel</strong>, <strong>Symfony</strong>, <strong>WordPress</strong> basieren komplett auf OOP. Ohne OOP-Kenntnisse können Sie nicht professionell entwickeln!</p>
                        </div>

                        <h3>🆚 Prozedural vs. Objektorientiert</h3>
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Aspekt</th>
                                                <th>🔧 Prozedural</th>
                                                <th>🎯 Objektorientiert</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><strong>Code-Organisation</strong></td>
                                                <td>Funktionen + globale Variablen</td>
                                                <td>Klassen mit Eigenschaften + Methoden</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Datenkapselung</strong></td>
                                                <td>Alle Daten öffentlich zugänglich</td>
                                                <td>Private/protected Daten, kontrollierter Zugriff</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Wiederverwendbarkeit</strong></td>
                                                <td>Copy & Paste von Funktionen</td>
                                                <td>Vererbung, Traits, Interfaces</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Wartbarkeit</strong></td>
                                                <td>Schwierig bei großen Projekten</td>
                                                <td>Sehr gut durch Kapselung</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Teamarbeit</strong></td>
                                                <td>Konflikte bei Funktionsnamen</td>
                                                <td>Klare Struktur, Namespaces</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Testing</strong></td>
                                                <td>Schwierig zu testen</td>
                                                <td>Einfach durch Isolation</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <h3>🏗️ Klassen und Objekte - Die Grundlagen</h3>
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h5>Erste Klasse definieren:</h5>
                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
// Einfache Klasse
class Auto {
    // Eigenschaften/Properties (Attribute)
    public $marke;
    public $modell;
    public $farbe;
    public $km_stand = 0;
    
    // Methoden (Funktionen der Klasse)
    public function starten() {
        return "Das Auto startet... Brumm brumm!";
    }
    
    public function fahren($kilometer) {
        $this-&gt;km_stand += $kilometer;
        return "Gefahren: $kilometer km. Neuer Stand: {$this-&gt;km_stand} km";
    }
    
    public function getInfo() {
        return "Auto: {$this-&gt;marke} {$this-&gt;modell} ({$this-&gt;farbe}) - {$this-&gt;km_stand} km";
    }
}

// Objekte erstellen (Instanzen der Klasse)
$mein_auto = new Auto();
$mein_auto-&gt;marke = "BMW";
$mein_auto-&gt;modell = "X5";
$mein_auto-&gt;farbe = "schwarz";

echo $mein_auto-&gt;getInfo() . "\n";
echo $mein_auto-&gt;starten() . "\n";
echo $mein_auto-&gt;fahren(150) . "\n";
echo $mein_auto-&gt;getInfo() . "\n";

// Mehrere Objekte derselben Klasse
$auto2 = new Auto();
$auto2-&gt;marke = "Mercedes";
$auto2-&gt;modell = "C-Klasse";
$auto2-&gt;farbe = "weiß";

echo "\nZweites Auto:\n";
echo $auto2-&gt;getInfo() . "\n";

// Klasse mit Konstruktor für einfachere Initialisierung
class Benutzer {
    public $name;
    public $email;
    public $registriert_am;
    
    // Konstruktor - wird beim "new" automatisch aufgerufen
    public function __construct($name, $email) {
        $this-&gt;name = $name;
        $this-&gt;email = $email;
        $this-&gt;registriert_am = date('Y-m-d H:i:s');
        
        echo "Neuer Benutzer erstellt: $name\n";
    }
    
    // Destruktor - wird beim Objektabbau aufgerufen
    public function __destruct() {
        echo "Benutzer {$this-&gt;name} wird aus dem Speicher entfernt\n";
    }
    
    public function begruessung() {
        return "Hallo {$this-&gt;name}! Du bist seit {$this-&gt;registriert_am} registriert.";
    }
}

// Objekt mit Konstruktor erstellen
$user1 = new Benutzer("Max Mustermann", "max@example.com");
echo $user1-&gt;begruessung() . "\n";

$user2 = new Benutzer("Anna Schmidt", "anna@example.com");
echo $user2-&gt;begruessung() . "\n";

// Objekt-Array
$benutzer_liste = [
    new Benutzer("Tom Weber", "tom@example.com"),
    new Benutzer("Lisa Mueller", "lisa@example.com"),
    new Benutzer("Peter Klein", "peter@example.com")
];

echo "\nAlle Benutzer:\n";
foreach ($benutzer_liste as $benutzer) {
    echo "- " . $benutzer-&gt;begruessung() . "\n";
}
?&gt;</code></pre>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <h5>Sichtbarkeit (Visibility):</h5>
                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
class BankKonto {
    // public - von überall zugreifbar
    public $inhaber;
    
    // protected - nur von der Klasse selbst und Unterklassen
    protected $kontonummer;
    
    // private - nur von der Klasse selbst
    private $kontostand = 0.0;
    private $pin = '1234';
    
    public function __construct($inhaber, $kontonummer) {
        $this-&gt;inhaber = $inhaber;
        $this-&gt;kontonummer = $kontonummer;
    }
    
    // Öffentliche Methode für Zugriff auf private Eigenschaften
    public function getKontostand() {
        return $this-&gt;kontostand;
    }
    
    // Kontrollierter Zugriff mit Validierung
    public function einzahlen($betrag) {
        if ($betrag &gt; 0) {
            $this-&gt;kontostand += $betrag;
            return "Eingezahlt: $betrag €. Neuer Stand: {$this-&gt;kontostand} €";
        }
        return "Ungültiger Betrag!";
    }
    
    public function abheben($betrag, $pin) {
        if ($pin !== $this-&gt;pin) {
            return "Falsche PIN!";
        }
        
        if ($betrag &gt; 0 && $betrag &lt;= $this-&gt;kontostand) {
            $this-&gt;kontostand -= $betrag;
            return "Abgehoben: $betrag €. Neuer Stand: {$this-&gt;kontostand} €";
        }
        
        return "Nicht genügend Guthaben oder ungültiger Betrag!";
    }
    
    // Private Hilfsmethode
    private function log_transaktion($typ, $betrag) {
        $timestamp = date('Y-m-d H:i:s');
        echo "[LOG] $timestamp: $typ - $betrag € (Stand: {$this-&gt;kontostand} €)\n";
    }
    
    // Getter für protected Eigenschaft
    public function getKontonummer() {
        return "****" . substr($this-&gt;kontonummer, -4); // Nur letzten 4 Ziffern
    }
    
    // Setter mit Validierung
    public function setPIN($alte_pin, $neue_pin) {
        if ($alte_pin === $this-&gt;pin) {
            if (strlen($neue_pin) === 4 && is_numeric($neue_pin)) {
                $this-&gt;pin = $neue_pin;
                return "PIN erfolgreich geändert";
            }
            return "Neue PIN muss 4 Ziffern haben";
        }
        return "Alte PIN ist falsch";
    }
}

// Bankkonto verwenden
$konto = new BankKonto("Max Mustermann", "1234567890");

echo "Inhaber: " . $konto-&gt;inhaber . "\n";  // ✅ public - funktioniert
echo "Kontonummer: " . $konto-&gt;getKontostand() . "\n";  // ✅ über public Methode

// echo $konto-&gt;kontostand;  // ❌ private - würde Fehler verursachen
// echo $konto-&gt;pin;         // ❌ private - würde Fehler verursachen

echo $konto-&gt;einzahlen(1000) . "\n";
echo $konto-&gt;einzahlen(500) . "\n";
echo $konto-&gt;abheben(200, '1234') . "\n";
echo $konto-&gt;abheben(100, '9999') . "\n";  // Falsche PIN
echo $konto-&gt;setPIN('1234', '5678') . "\n";
echo $konto-&gt;abheben(100, '5678') . "\n";  // Mit neuer PIN

// Statische Eigenschaften und Methoden
class MathUtils {
    // Statische Eigenschaft - gehört zur Klasse, nicht zur Instanz
    public static $pi = 3.14159;
    private static $berechnungen = 0;
    
    // Statische Methode - kann ohne Objektinstanz aufgerufen werden
    public static function kreisflaeche($radius) {
        self::$berechnungen++;  // self:: für statische Eigenschaften
        return self::$pi * $radius * $radius;
    }
    
    public static function kreisumfang($radius) {
        self::$berechnungen++;
        return 2 * self::$pi * $radius;
    }
    
    public static function getBerechnungsAnzahl() {
        return self::$berechnungen;
    }
}

// Statische Methoden aufrufen (ohne new)
echo "\nMath-Utils:\n";
echo "Kreisfläche (r=5): " . MathUtils::kreisflaeche(5) . "\n";
echo "Kreisumfang (r=5): " . MathUtils::kreisumfang(5) . "\n";
echo "PI-Wert: " . MathUtils::$pi . "\n";
echo "Berechnungen insgesamt: " . MathUtils::getBerechnungsAnzahl() . "\n";

// Konstanten in Klassen
class ApiConfig {
    const API_VERSION = '2.1';
    const BASE_URL = 'https://api.example.com';
    const TIMEOUT = 30;
    
    public static function getEndpoint($path) {
        return self::BASE_URL . '/v' . self::API_VERSION . '/' . $path;
    }
}

echo "\nAPI-Konfiguration:\n";
echo "Version: " . ApiConfig::API_VERSION . "\n";
echo "User-Endpoint: " . ApiConfig::getEndpoint('users') . "\n";
?&gt;</code></pre>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h3>🔗 Vererbung (Inheritance)</h3>
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h5>Grundlegende Vererbung:</h5>
                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
// Basis-Klasse (Parent/Superclass)
class Fahrzeug {
    protected $marke;
    protected $geschwindigkeit = 0;
    protected $max_geschwindigkeit;
    
    public function __construct($marke, $max_geschwindigkeit) {
        $this-&gt;marke = $marke;
        $this-&gt;max_geschwindigkeit = $max_geschwindigkeit;
        echo "Fahrzeug erstellt: $marke\n";
    }
    
    public function beschleunigen($wert) {
        $neue_geschwindigkeit = $this-&gt;geschwindigkeit + $wert;
        
        if ($neue_geschwindigkeit &lt;= $this-&gt;max_geschwindigkeit) {
            $this-&gt;geschwindigkeit = $neue_geschwindigkeit;
            return "Beschleunigt auf {$this-&gt;geschwindigkeit} km/h";
        } else {
            $this-&gt;geschwindigkeit = $this-&gt;max_geschwindigkeit;
            return "Maximalgeschwindigkeit erreicht: {$this-&gt;max_geschwindigkeit} km/h";
        }
    }
    
    public function bremsen($wert) {
        $this-&gt;geschwindigkeit = max(0, $this-&gt;geschwindigkeit - $wert);
        return "Gebremst auf {$this-&gt;geschwindigkeit} km/h";
    }
    
    public function getInfo() {
        return "Fahrzeug: {$this-&gt;marke}, {$this-&gt;geschwindigkeit}/{$this-&gt;max_geschwindigkeit} km/h";
    }
    
    // Diese Methode kann von Unterklassen überschrieben werden
    public function hupen() {
        return "Allgemeines Fahrzeuggeräusch";
    }
}

// Abgeleitete Klasse (Child/Subclass)
class PKW extends Fahrzeug {
    private $anzahl_tueren;
    private $anzahl_passagiere = 0;
    private $max_passagiere;
    
    public function __construct($marke, $max_geschwindigkeit, $anzahl_tueren, $max_passagiere = 5) {
        // Parent-Konstruktor aufrufen
        parent::__construct($marke, $max_geschwindigkeit);
        
        $this-&gt;anzahl_tueren = $anzahl_tueren;
        $this-&gt;max_passagiere = $max_passagiere;
        echo "PKW spezifiziert: $anzahl_tueren Türen, max. $max_passagiere Passagiere\n";
    }
    
    // Methode überschreiben (Override)
    public function hupen() {
        return "Beep beep! (PKW-Hupe)";
    }
    
    // Neue Methoden, die nur PKW haben
    public function passagier_einsteigen($anzahl = 1) {
        $neue_anzahl = $this-&gt;anzahl_passagiere + $anzahl;
        
        if ($neue_anzahl &lt;= $this-&gt;max_passagiere) {
            $this-&gt;anzahl_passagiere = $neue_anzahl;
            return "$anzahl Passagier(e) eingestiegen. Insgesamt: {$this-&gt;anzahl_passagiere}";
        } else {
            return "Nicht genug Platz! Max. {$this-&gt;max_passagiere} Passagiere erlaubt.";
        }
    }
    
    // Parent-Methode erweitern
    public function getInfo() {
        $basis_info = parent::getInfo();  // Original-Methode aufrufen
        return $basis_info . ", {$this-&gt;anzahl_passagiere}/{$this-&gt;max_passagiere} Passagiere, {$this-&gt;anzahl_tueren} Türen";
    }
}

// Weitere abgeleitete Klasse
class LKW extends Fahrzeug {
    private $ladekapazitaet;
    private $ladung = 0;
    
    public function __construct($marke, $max_geschwindigkeit, $ladekapazitaet) {
        parent::__construct($marke, $max_geschwindigkeit);
        $this-&gt;ladekapazitaet = $ladekapazitaet;
        echo "LKW spezifiziert: {$ladekapazitaet}t Ladekapazität\n";
    }
    
    public function hupen() {
        return "TUUUUT! (LKW-Hupe)";
    }
    
    public function beladen($gewicht) {
        $neue_ladung = $this-&gt;ladung + $gewicht;
        
        if ($neue_ladung &lt;= $this-&gt;ladekapazitaet) {
            $this-&gt;ladung = $neue_ladung;
            return "Beladen mit {$gewicht}t. Gesamtladung: {$this-&gt;ladung}t";
        } else {
            return "Überladung! Max. {$this-&gt;ladekapazitaet}t erlaubt.";
        }
    }
    
    public function getInfo() {
        $basis_info = parent::getInfo();
        return $basis_info . ", Ladung: {$this-&gt;ladung}/{$this-&gt;ladekapazitaet}t";
    }
}

// Vererbung in Aktion
echo "\n=== Vererbungs-Demo ===\n";

$pkw = new PKW("BMW", 250, 4, 5);
echo $pkw-&gt;beschleunigen(50) . "\n";
echo $pkw-&gt;passagier_einsteigen(3) . "\n";
echo $pkw-&gt;hupen() . "\n";
echo $pkw-&gt;getInfo() . "\n";

echo "\n";

$lkw = new LKW("MAN", 120, 40);
echo $lkw-&gt;beschleunigen(30) . "\n";
echo $lkw-&gt;beladen(25) . "\n";
echo $lkw-&gt;hupen() . "\n";
echo $lkw-&gt;getInfo() . "\n";

// Polymorphismus - verschiedene Objekte, gleiche Schnittstelle
$fahrzeuge = [$pkw, $lkw];

echo "\n=== Polymorphismus-Demo ===\n";
foreach ($fahrzeuge as $fahrzeug) {
    echo $fahrzeug-&gt;hupen() . "\n";  // Jede Klasse hat ihre eigene Implementation
    echo $fahrzeug-&gt;getInfo() . "\n";
}
?&gt;</code></pre>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <h5>Abstrakte Klassen:</h5>
                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
// Abstrakte Klasse - kann nicht direkt instanziiert werden
abstract class Mitarbeiter {
    protected $name;
    protected $gehalt;
    protected $abteilung;
    
    public function __construct($name, $abteilung) {
        $this-&gt;name = $name;
        $this-&gt;abteilung = $abteilung;
    }
    
    // Konkrete Methode (wird vererbt)
    public function getInfo() {
        return "Mitarbeiter: {$this-&gt;name}, Abteilung: {$this-&gt;abteilung}";
    }
    
    public function getName() {
        return $this-&gt;name;
    }
    
    // Abstrakte Methode - MUSS in Unterklassen implementiert werden
    abstract public function berechneGehalt();
    abstract public function getJobTitle();
    
    // Template-Method Pattern
    public function monatsabrechnung() {
        $gehalt = $this-&gt;berechneGehalt();
        $titel = $this-&gt;getJobTitle();
        
        return "Abrechnung für {$titel} {$this-&gt;name}: {$gehalt} € ({$this-&gt;abteilung})";
    }
}

// Konkrete Implementierung 1
class Vollzeitmitarbeiter extends Mitarbeiter {
    private $monatsgehalt;
    
    public function __construct($name, $abteilung, $monatsgehalt) {
        parent::__construct($name, $abteilung);
        $this-&gt;monatsgehalt = $monatsgehalt;
    }
    
    public function berechneGehalt() {
        return $this-&gt;monatsgehalt;
    }
    
    public function getJobTitle() {
        return "Vollzeitmitarbeiter";
    }
}

// Konkrete Implementierung 2
class Freelancer extends Mitarbeiter {
    private $stundenlohn;
    private $geleistete_stunden;
    
    public function __construct($name, $abteilung, $stundenlohn) {
        parent::__construct($name, $abteilung);
        $this-&gt;stundenlohn = $stundenlohn;
        $this-&gt;geleistete_stunden = 0;
    }
    
    public function stundenHinzufuegen($stunden) {
        $this-&gt;geleistete_stunden += $stunden;
        return "Hinzugefügt: $stunden Stunden. Gesamt: {$this-&gt;geleistete_stunden}";
    }
    
    public function berechneGehalt() {
        return $this-&gt;stundenlohn * $this-&gt;geleistete_stunden;
    }
    
    public function getJobTitle() {
        return "Freelancer";
    }
}

// Konkrete Implementierung 3
class Manager extends Mitarbeiter {
    private $grundgehalt;
    private $bonus_prozent;
    private $team_groesse;
    
    public function __construct($name, $abteilung, $grundgehalt, $team_groesse) {
        parent::__construct($name, $abteilung);
        $this-&gt;grundgehalt = $grundgehalt;
        $this-&gt;team_groesse = $team_groesse;
        $this-&gt;bonus_prozent = min(50, $team_groesse * 5); // Max 50% Bonus
    }
    
    public function berechneGehalt() {
        $bonus = $this-&gt;grundgehalt * ($this-&gt;bonus_prozent / 100);
        return $this-&gt;grundgehalt + $bonus;
    }
    
    public function getJobTitle() {
        return "Manager";
    }
    
    public function getTeamInfo() {
        return "Führt Team von {$this-&gt;team_groesse} Mitarbeitern";
    }
}

// Abstrakte Klassen in Aktion
echo "\n=== Abstrakte Klassen Demo ===\n";

$mitarbeiter_liste = [
    new Vollzeitmitarbeiter("Anna Schmidt", "IT", 4500),
    new Manager("Tom Weber", "Vertrieb", 6000, 8),
    new Freelancer("Lisa Mueller", "Design", 75)
];

// Freelancer arbeitet
$freelancer = $mitarbeiter_liste[2]; // Lisa
echo $freelancer-&gt;stundenHinzufuegen(40) . "\n";
echo $freelancer-&gt;stundenHinzufuegen(35) . "\n";

echo "\n--- Monatsabrechnungen ---\n";
foreach ($mitarbeiter_liste as $mitarbeiter) {
    echo $mitarbeiter-&gt;monatsabrechnung() . "\n";
    
    // Spezielle Methoden wenn verfügbar
    if ($mitarbeiter instanceof Manager) {
        echo "  → " . $mitarbeiter-&gt;getTeamInfo() . "\n";
    }
}

// $direkter_mitarbeiter = new Mitarbeiter("Test", "Test"); // ❌ Fehler! Abstrakte Klasse
?&gt;</code></pre>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h3>🔌 Interfaces und Traits</h3>
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h5>Interfaces (Verträge):</h5>
                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
// Interface definiert einen "Vertrag" - was implementiert werden MUSS
interface DatabaseInterface {
    public function connect();
    public function query($sql);
    public function close();
}

interface CacheInterface {
    public function get($key);
    public function set($key, $value, $ttl = 3600);
    public function delete($key);
    public function clear();
}

// Interface für serialisierbare Objekte
interface SerializableInterface {
    public function serialize();
    public function unserialize($data);
}

// Klasse kann mehrere Interfaces implementieren
class MySQLDatabase implements DatabaseInterface, CacheInterface {
    private $connection;
    private $cache = [];
    
    public function connect() {
        echo "Verbindung zu MySQL hergestellt\n";
        $this-&gt;connection = true;
        return $this;
    }
    
    public function query($sql) {
        if (!$this-&gt;connection) {
            throw new Exception("Keine Datenbankverbindung");
        }
        
        echo "SQL ausgeführt: $sql\n";
        return "Ergebnis für: $sql";
    }
    
    public function close() {
        echo "MySQL-Verbindung geschlossen\n";
        $this-&gt;connection = false;
    }
    
    // Cache-Interface Implementation
    public function get($key) {
        return $this-&gt;cache[$key] ?? null;
    }
    
    public function set($key, $value, $ttl = 3600) {
        $this-&gt;cache[$key] = [
            'value' =&gt; $value,
            'expires' =&gt; time() + $ttl
        ];
        echo "Cache gesetzt: $key\n";
    }
    
    public function delete($key) {
        unset($this-&gt;cache[$key]);
        echo "Cache gelöscht: $key\n";
    }
    
    public function clear() {
        $this-&gt;cache = [];
        echo "Cache komplett gelöscht\n";
    }
}

// Alternative Implementation
class PostgreSQLDatabase implements DatabaseInterface {
    private $connection;
    
    public function connect() {
        echo "Verbindung zu PostgreSQL hergestellt\n";
        $this-&gt;connection = true;
        return $this;
    }
    
    public function query($sql) {
        if (!$this-&gt;connection) {
            throw new Exception("Keine Datenbankverbindung");
        }
        
        echo "PostgreSQL Query: $sql\n";
        return "PostgreSQL Ergebnis für: $sql";
    }
    
    public function close() {
        echo "PostgreSQL-Verbindung geschlossen\n";
        $this-&gt;connection = false;
    }
}

// Polymorphismus mit Interfaces
function datenbank_operationen(DatabaseInterface $db) {
    $db-&gt;connect();
    $result = $db-&gt;query("SELECT * FROM users");
    echo "Ergebnis: $result\n";
    $db-&gt;close();
}

echo "\n=== Interface Demo ===\n";

$mysql = new MySQLDatabase();
$postgres = new PostgreSQLDatabase();

datenbank_operationen($mysql);    // Funktioniert
datenbank_operationen($postgres); // Funktioniert auch

// Cache verwenden (nur bei MySQL verfügbar)
if ($mysql instanceof CacheInterface) {
    $mysql-&gt;set('user_123', ['name' =&gt; 'Max', 'email' =&gt; 'max@example.com']);
    $user_data = $mysql-&gt;get('user_123');
    echo "Aus Cache: " . json_encode($user_data) . "\n";
}
?&gt;</code></pre>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <h5>Traits (Mehrfachvererbung):</h5>
                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
// Traits erlauben Code-Wiederverwendung ohne Vererbung
trait TimestampTrait {
    protected $created_at;
    protected $updated_at;
    
    public function initTimestamps() {
        $this-&gt;created_at = date('Y-m-d H:i:s');
        $this-&gt;updated_at = date('Y-m-d H:i:s');
    }
    
    public function touch() {
        $this-&gt;updated_at = date('Y-m-d H:i:s');
    }
    
    public function getCreatedAt() {
        return $this-&gt;created_at;
    }
    
    public function getUpdatedAt() {
        return $this-&gt;updated_at;
    }
}

trait ValidationTrait {
    protected $errors = [];
    
    public function addError($field, $message) {
        $this-&gt;errors[$field] = $message;
    }
    
    public function hasErrors() {
        return !empty($this-&gt;errors);
    }
    
    public function getErrors() {
        return $this-&gt;errors;
    }
    
    public function clearErrors() {
        $this-&gt;errors = [];
    }
    
    protected function validateEmail($email) {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this-&gt;addError('email', 'Ungültige E-Mail-Adresse');
            return false;
        }
        return true;
    }
    
    protected function validateRequired($field, $value) {
        if (empty($value)) {
            $this-&gt;addError($field, "Feld '$field' ist erforderlich");
            return false;
        }
        return true;
    }
}

trait LoggingTrait {
    protected function log($level, $message) {
        $timestamp = date('Y-m-d H:i:s');
        $class = get_class($this);
        echo "[$timestamp] [$level] [$class] $message\n";
    }
    
    protected function logInfo($message) {
        $this-&gt;log('INFO', $message);
    }
    
    protected function logError($message) {
        $this-&gt;log('ERROR', $message);
    }
    
    protected function logWarning($message) {
        $this-&gt;log('WARNING', $message);
    }
}

// Klassen können mehrere Traits verwenden
class User {
    use TimestampTrait, ValidationTrait, LoggingTrait;
    
    private $name;
    private $email;
    
    public function __construct($name, $email) {
        $this-&gt;initTimestamps();
        
        if ($this-&gt;validate($name, $email)) {
            $this-&gt;name = $name;
            $this-&gt;email = $email;
            $this-&gt;logInfo("Benutzer erstellt: $name");
        } else {
            $this-&gt;logError("Benutzer-Validierung fehlgeschlagen");
            throw new Exception("Validierungsfehler: " . implode(', ', $this-&gt;getErrors()));
        }
    }
    
    private function validate($name, $email) {
        $this-&gt;clearErrors();
        
        $valid = true;
        $valid = $this-&gt;validateRequired('name', $name) && $valid;
        $valid = $this-&gt;validateRequired('email', $email) && $valid;
        $valid = $this-&gt;validateEmail($email) && $valid;
        
        return $valid;
    }
    
    public function updateEmail($new_email) {
        if ($this-&gt;validateEmail($new_email)) {
            $old_email = $this-&gt;email;
            $this-&gt;email = $new_email;
            $this-&gt;touch();
            $this-&gt;logInfo("E-Mail geändert von $old_email zu $new_email");
            return true;
        }
        return false;
    }
    
    public function getInfo() {
        return [
            'name' =&gt; $this-&gt;name,
            'email' =&gt; $this-&gt;email,
            'created_at' =&gt; $this-&gt;getCreatedAt(),
            'updated_at' =&gt; $this-&gt;getUpdatedAt()
        ];
    }
}

class Product {
    use TimestampTrait, ValidationTrait, LoggingTrait;
    
    private $name;
    private $price;
    
    public function __construct($name, $price) {
        $this-&gt;initTimestamps();
        
        if ($this-&gt;validate($name, $price)) {
            $this-&gt;name = $name;
            $this-&gt;price = $price;
            $this-&gt;logInfo("Produkt erstellt: $name ($price €)");
        } else {
            throw new Exception("Produkt-Validierung fehlgeschlagen");
        }
    }
    
    private function validate($name, $price) {
        $this-&gt;clearErrors();
        
        $valid = true;
        $valid = $this-&gt;validateRequired('name', $name) && $valid;
        
        if (!is_numeric($price) || $price &lt; 0) {
            $this-&gt;addError('price', 'Preis muss eine positive Zahl sein');
            $valid = false;
        }
        
        return $valid;
    }
    
    public function updatePrice($new_price) {
        if (is_numeric($new_price) && $new_price &gt;= 0) {
            $old_price = $this-&gt;price;
            $this-&gt;price = $new_price;
            $this-&gt;touch();
            $this-&gt;logInfo("Preis geändert von $old_price € auf $new_price €");
            return true;
        } else {
            $this-&gt;logWarning("Ungültiger Preis: $new_price");
            return false;
        }
    }
}

echo "\n=== Traits Demo ===\n";

try {
    $user = new User("Max Mustermann", "max@example.com");
    print_r($user-&gt;getInfo());
    
    sleep(1); // Kurz warten für timestamp
    $user-&gt;updateEmail("max.mustermann@example.com");
    print_r($user-&gt;getInfo());
    
    $product = new Product("Laptop", 1299.99);
    $product-&gt;updatePrice(1199.99);
    
} catch (Exception $e) {
    echo "Fehler: " . $e-&gt;getMessage() . "\n";
}

// Trait-Konflikte lösen
trait A {
    public function test() {
        return "A";
    }
}

trait B {
    public function test() {
        return "B";
    }
}

class C {
    use A, B {
        A::test insteadof B;  // A's test verwenden
        B::test as testB;     // B's test als testB verfügbar machen
    }
}

$c = new C();
echo "\nTrait-Konflikt-Lösung:\n";
echo $c-&gt;test() . "\n";   // "A"
echo $c-&gt;testB() . "\n";  // "B"
?&gt;</code></pre>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h3>🎮 Großes Praxisbeispiel: E-Commerce System</h3>
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="card bg-dark text-light">
                                    <div class="card-header">
                                        <small><i class="bi bi-shop me-2"></i>Vollständiges OOP E-Commerce System</small>
                                    </div>
                                    <div class="card-body">
                                        <pre class="mb-0"><code class="language-php text-light">&lt;?php
// === INTERFACES ===

interface ProductInterface {
    public function getPrice();
    public function getName();
    public function getCategory();
}

interface CartInterface {
    public function addItem(ProductInterface $product, int $quantity = 1);
    public function removeItem(string $product_id);
    public function getTotal();
    public function getItems();
    public function clear();
}

interface PaymentInterface {
    public function processPayment(float $amount, array $payment_data);
    public function refund(string $transaction_id, float $amount);
}

// === TRAITS ===

trait PricingTrait {
    protected function calculateDiscount(float $price, float $discount_percent): float {
        return $price * (1 - $discount_percent / 100);
    }
    
    protected function calculateTax(float $price, float $tax_rate = 19.0): float {
        return $price * ($tax_rate / 100);
    }
    
    protected function formatPrice(float $price): string {
        return number_format($price, 2, ',', '.') . ' €';
    }
}

trait ValidationTrait {
    protected $errors = [];
    
    protected function validateEmail(string $email): bool {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this-&gt;errors[] = 'Ungültige E-Mail-Adresse';
            return false;
        }
        return true;
    }
    
    protected function validateRequired(string $value, string $field): bool {
        if (empty(trim($value))) {
            $this-&gt;errors[] = "Feld '$field' ist erforderlich";
            return false;
        }
        return true;
    }
    
    public function getErrors(): array {
        return $this-&gt;errors;
    }
    
    public function hasErrors(): bool {
        return !empty($this-&gt;errors);
    }
}

// === ABSTRAKTE KLASSEN ===

abstract class Product implements ProductInterface {
    use PricingTrait;
    
    protected string $id;
    protected string $name;
    protected float $price;
    protected string $category;
    protected int $stock;
    
    public function __construct(string $id, string $name, float $price, string $category, int $stock = 0) {
        $this-&gt;id = $id;
        $this-&gt;name = $name;
        $this-&gt;price = $price;
        $this-&gt;category = $category;
        $this-&gt;stock = $stock;
    }
    
    public function getId(): string {
        return $this-&gt;id;
    }
    
    public function getName(): string {
        return $this-&gt;name;
    }
    
    public function getPrice(): float {
        return $this-&gt;price;
    }
    
    public function getCategory(): string {
        return $this-&gt;category;
    }
    
    public function getStock(): int {
        return $this-&gt;stock;
    }
    
    public function reduceStock(int $quantity): bool {
        if ($this-&gt;stock &gt;= $quantity) {
            $this-&gt;stock -= $quantity;
            return true;
        }
        return false;
    }
    
    // Abstrakte Methoden für spezielle Produkttypen
    abstract public function getShippingWeight(): float;
    abstract public function getProductType(): string;
}

// === KONKRETE PRODUKT-KLASSEN ===

class PhysicalProduct extends Product {
    private float $weight;
    private array $dimensions;
    
    public function __construct(string $id, string $name, float $price, string $category, int $stock, float $weight, array $dimensions) {
        parent::__construct($id, $name, $price, $category, $stock);
        $this-&gt;weight = $weight;
        $this-&gt;dimensions = $dimensions;
    }
    
    public function getShippingWeight(): float {
        return $this-&gt;weight;
    }
    
    public function getProductType(): string {
        return 'physical';
    }
    
    public function getDimensions(): array {
        return $this-&gt;dimensions;
    }
}

class DigitalProduct extends Product {
    private string $download_url;
    private int $download_limit;
    
    public function __construct(string $id, string $name, float $price, string $category, string $download_url, int $download_limit = 5) {
        parent::__construct($id, $name, $price, $category, 999999); // Digitale Produkte haben "unendlichen" Stock
        $this-&gt;download_url = $download_url;
        $this-&gt;download_limit = $download_limit;
    }
    
    public function getShippingWeight(): float {
        return 0; // Digitale Produkte haben kein Gewicht
    }
    
    public function getProductType(): string {
        return 'digital';
    }
    
    public function getDownloadUrl(): string {
        return $this-&gt;download_url;
    }
}

// === WARENKORB ===

class ShoppingCart implements CartInterface {
    use PricingTrait;
    
    private array $items = [];
    private string $currency = 'EUR';
    
    public function addItem(ProductInterface $product, int $quantity = 1): void {
        $product_id = $product-&gt;getId();
        
        if (isset($this-&gt;items[$product_id])) {
            $this-&gt;items[$product_id]['quantity'] += $quantity;
        } else {
            $this-&gt;items[$product_id] = [
                'product' =&gt; $product,
                'quantity' =&gt; $quantity,
                'added_at' =&gt; new DateTime()
            ];
        }
    }
    
    public function removeItem(string $product_id): void {
        unset($this-&gt;items[$product_id]);
    }
    
    public function updateQuantity(string $product_id, int $quantity): void {
        if (isset($this-&gt;items[$product_id])) {
            if ($quantity &lt;= 0) {
                $this-&gt;removeItem($product_id);
            } else {
                $this-&gt;items[$product_id]['quantity'] = $quantity;
            }
        }
    }
    
    public function getItems(): array {
        return $this-&gt;items;
    }
    
    public function getItemCount(): int {
        return array_sum(array_column($this-&gt;items, 'quantity'));
    }
    
    public function getTotal(): float {
        $total = 0;
        foreach ($this-&gt;items as $item) {
            $total += $item['product']-&gt;getPrice() * $item['quantity'];
        }
        return $total;
    }
    
    public function getTotalWithTax(float $tax_rate = 19.0): float {
        $total = $this-&gt;getTotal();
        return $total + $this-&gt;calculateTax($total, $tax_rate);
    }
    
    public function clear(): void {
        $this-&gt;items = [];
    }
    
    public function getShippingWeight(): float {
        $total_weight = 0;
        foreach ($this-&gt;items as $item) {
            $total_weight += $item['product']-&gt;getShippingWeight() * $item['quantity'];
        }
        return $total_weight;
    }
}

// === KUNDE ===

class Customer {
    use ValidationTrait;
    
    private string $id;
    private string $name;
    private string $email;
    private array $addresses = [];
    private array $order_history = [];
    
    public function __construct(string $name, string $email) {
        $this-&gt;errors = [];
        
        if ($this-&gt;validateRequired($name, 'name') && $this-&gt;validateEmail($email)) {
            $this-&gt;id = uniqid('customer_');
            $this-&gt;name = $name;
            $this-&gt;email = $email;
        } else {
            throw new InvalidArgumentException('Validierungsfehler: ' . implode(', ', $this-&gt;errors));
        }
    }
    
    public function getId(): string { return $this-&gt;id; }
    public function getName(): string { return $this-&gt;name; }
    public function getEmail(): string { return $this-&gt;email; }
    
    public function addAddress(string $type, array $address): void {
        $this-&gt;addresses[$type] = $address;
    }
    
    public function getAddress(string $type): ?array {
        return $this-&gt;addresses[$type] ?? null;
    }
    
    public function addOrder(Order $order): void {
        $this-&gt;order_history[] = $order;
    }
}

// === BESTELLUNG ===

class Order {
    use PricingTrait;
    
    private string $id;
    private Customer $customer;
    private ShoppingCart $cart;
    private string $status;
    private DateTime $created_at;
    private ?DateTime $shipped_at = null;
    private array $shipping_address;
    
    const STATUS_PENDING = 'pending';
    const STATUS_PAID = 'paid';
    const STATUS_SHIPPED = 'shipped';
    const STATUS_DELIVERED = 'delivered';
    const STATUS_CANCELLED = 'cancelled';
    
    public function __construct(Customer $customer, ShoppingCart $cart, array $shipping_address) {
        $this-&gt;id = uniqid('order_');
        $this-&gt;customer = $customer;
        $this-&gt;cart = clone $cart; // Warenkorb "einfrieren"
        $this-&gt;shipping_address = $shipping_address;
        $this-&gt;status = self::STATUS_PENDING;
        $this-&gt;created_at = new DateTime();
    }
    
    public function getId(): string { return $this-&gt;id; }
    public function getCustomer(): Customer { return $this-&gt;customer; }
    public function getStatus(): string { return $this-&gt;status; }
    public function getTotal(): float { return $this-&gt;cart-&gt;getTotalWithTax(); }
    
    public function updateStatus(string $status): void {
        $valid_statuses = [
            self::STATUS_PENDING,
            self::STATUS_PAID,
            self::STATUS_SHIPPED,
            self::STATUS_DELIVERED,
            self::STATUS_CANCELLED
        ];
        
        if (in_array($status, $valid_statuses)) {
            $this-&gt;status = $status;
            
            if ($status === self::STATUS_SHIPPED) {
                $this-&gt;shipped_at = new DateTime();
                $this-&gt;reduceStock();
            }
        }
    }
    
    private function reduceStock(): void {
        foreach ($this-&gt;cart-&gt;getItems() as $item) {
            $item['product']-&gt;reduceStock($item['quantity']);
        }
    }
    
    public function getOrderSummary(): array {
        return [
            'order_id' =&gt; $this-&gt;id,
            'customer' =&gt; $this-&gt;customer-&gt;getName(),
            'status' =&gt; $this-&gt;status,
            'items' =&gt; count($this-&gt;cart-&gt;getItems()),
            'total' =&gt; $this-&gt;formatPrice($this-&gt;getTotal()),
            'created_at' =&gt; $this-&gt;created_at-&gt;format('Y-m-d H:i:s')
        ];
    }
}

// === PAYMENT SYSTEM ===

class CreditCardPayment implements PaymentInterface {
    public function processPayment(float $amount, array $payment_data): array {
        // Simulation einer Kreditkarten-Verarbeitung
        $card_number = $payment_data['card_number'] ?? '';
        $masked_card = '****-****-****-' . substr($card_number, -4);
        
        // Einfache Validierung
        if (strlen($card_number) &lt; 16) {
            return [
                'success' =&gt; false,
                'error' =&gt; 'Ungültige Kartennummer'
            ];
        }
        
        $transaction_id = uniqid('cc_');
        
        return [
            'success' =&gt; true,
            'transaction_id' =&gt; $transaction_id,
            'amount' =&gt; $amount,
            'card' =&gt; $masked_card,
            'processed_at' =&gt; date('Y-m-d H:i:s')
        ];
    }
    
    public function refund(string $transaction_id, float $amount): array {
        return [
            'success' =&gt; true,
            'refund_id' =&gt; uniqid('refund_'),
            'original_transaction' =&gt; $transaction_id,
            'amount' =&gt; $amount,
            'processed_at' =&gt; date('Y-m-d H:i:s')
        ];
    }
}

// === E-COMMERCE SYSTEM ===

class ECommerceSystem {
    private array $products = [];
    private array $customers = [];
    private array $orders = [];
    
    public function addProduct(Product $product): void {
        $this-&gt;products[$product-&gt;getId()] = $product;
    }
    
    public function getProduct(string $product_id): ?Product {
        return $this-&gt;products[$product_id] ?? null;
    }
    
    public function registerCustomer(string $name, string $email): Customer {
        $customer = new Customer($name, $email);
        $this-&gt;customers[$customer-&gt;getId()] = $customer;
        return $customer;
    }
    
    public function createOrder(Customer $customer, ShoppingCart $cart, array $shipping_address): Order {
        $order = new Order($customer, $cart, $shipping_address);
        $this-&gt;orders[$order-&gt;getId()] = $order;
        $customer-&gt;addOrder($order);
        return $order;
    }
    
    public function processPayment(Order $order, PaymentInterface $payment_method, array $payment_data): array {
        $result = $payment_method-&gt;processPayment($order-&gt;getTotal(), $payment_data);
        
        if ($result['success']) {
            $order-&gt;updateStatus(Order::STATUS_PAID);
        }
        
        return $result;
    }
    
    public function getSystemStats(): array {
        $total_revenue = 0;
        $completed_orders = 0;
        
        foreach ($this-&gt;orders as $order) {
            if ($order-&gt;getStatus() === Order::STATUS_DELIVERED) {
                $total_revenue += $order-&gt;getTotal();
                $completed_orders++;
            }
        }
        
        return [
            'total_products' =&gt; count($this-&gt;products),
            'total_customers' =&gt; count($this-&gt;customers),
            'total_orders' =&gt; count($this-&gt;orders),
            'completed_orders' =&gt; $completed_orders,
            'total_revenue' =&gt; $total_revenue
        ];
    }
}

// === DEMO DES SYSTEMS ===

echo "\n=== E-Commerce System Demo ===\n";

$ecommerce = new ECommerceSystem();

// Produkte erstellen
$laptop = new PhysicalProduct('laptop-001', 'Gaming Laptop', 1299.99, 'Electronics', 10, 2.5, ['length' =&gt; 35, 'width' =&gt; 25, 'height' =&gt; 3]);
$software = new DigitalProduct('software-001', 'Antivirus Premium', 49.99, 'Software', 'https://download.example.com/antivirus');

$ecommerce-&gt;addProduct($laptop);
$ecommerce-&gt;addProduct($software);

// Kunde registrieren
$customer = $ecommerce-&gt;registerCustomer('Max Mustermann', 'max@example.com');
$customer-&gt;addAddress('shipping', [
    'street' =&gt; 'Musterstraße 123',
    'city' =&gt; 'Berlin',
    'zip' =&gt; '10115',
    'country' =&gt; 'Deutschland'
]);

// Warenkorb erstellen und befüllen
$cart = new ShoppingCart();
$cart-&gt;addItem($laptop, 1);
$cart-&gt;addItem($software, 2);

echo "Warenkorb:\n";
echo "- Artikel: " . $cart-&gt;getItemCount() . "\n";
echo "- Netto: " . number_format($cart-&gt;getTotal(), 2) . " €\n";
echo "- Mit MwSt: " . number_format($cart-&gt;getTotalWithTax(), 2) . " €\n";
echo "- Gewicht: " . $cart-&gt;getShippingWeight() . " kg\n";

// Bestellung erstellen
$order = $ecommerce-&gt;createOrder($customer, $cart, $customer-&gt;getAddress('shipping'));
echo "\nBestellung erstellt: " . $order-&gt;getId() . "\n";

// Zahlung verarbeiten
$payment = new CreditCardPayment();
$payment_result = $ecommerce-&gt;processPayment($order, $payment, [
    'card_number' =&gt; '1234567890123456',
    'expiry' =&gt; '12/25',
    'cvv' =&gt; '123'
]);

if ($payment_result['success']) {
    echo "Zahlung erfolgreich: " . $payment_result['transaction_id'] . "\n";
    
    // Bestellung versenden
    $order-&gt;updateStatus(Order::STATUS_SHIPPED);
    echo "Bestellung versendet\n";
    
    // Bestellung als geliefert markieren
    $order-&gt;updateStatus(Order::STATUS_DELIVERED);
    echo "Bestellung zugestellt\n";
} else {
    echo "Zahlung fehlgeschlagen: " . $payment_result['error'] . "\n";
}

// System-Statistiken
$stats = $ecommerce-&gt;getSystemStats();
echo "\nSystem-Statistiken:\n";
foreach ($stats as $key =&gt; $value) {
    echo "- $key: $value\n";
}

// Bestellübersicht
print_r($order-&gt;getOrderSummary());
?&gt;</code></pre>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="alert alert-success">
                            <h5><i class="bi bi-box2 me-2"></i>OOP - Die wichtigsten Erkenntnisse</h5>
                            <ul class="mb-0">
                                <li>✅ <strong>Klassen & Objekte</strong> - Grundbaustein der OOP</li>
                                <li>✅ <strong>Encapsulation</strong> - private/protected für Datenschutz</li>
                                <li>✅ <strong>Inheritance</strong> - Code-Wiederverwendung durch Vererbung</li>
                                <li>✅ <strong>Polymorphismus</strong> - Gleiche Schnittstelle, verschiedene Implementierungen</li>
                                <li>✅ <strong>Abstrakte Klassen</strong> - Template für ähnliche Klassen</li>
                                <li>✅ <strong>Interfaces</strong> - Verträge für konsistente APIs</li>
                                <li>✅ <strong>Traits</strong> - Code-Sharing ohne Vererbung</li>
                            </ul>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <h6>Vorheriges Thema</h6>
                                        <a href="php-datab.php" class="btn btn-outline-secondary">
                                            <i class="bi bi-arrow-left me-2"></i>Datenbank
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <h6>Nächstes Thema</h6>
                                        <a href="php-err.php" class="btn btn-primary">
                                            <i class="bi bi-bug me-2"></i>Error Handling
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <h6>Zur Übersicht</h6>
                                        <a href="php-index.php" class="btn btn-outline-secondary">
                                            <i class="bi bi-house me-2"></i>PHP Hauptseite
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>