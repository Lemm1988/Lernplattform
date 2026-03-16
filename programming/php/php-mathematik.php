<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
include $_SERVER['DOCUMENT_ROOT'] . '/includes/php-navigation.php';

$page_title = 'PHP Mathematik - Zahlen und Berechnungen';
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

                        <?php renderNavigation('php-math'); ?>

                        <div class="d-flex justify-content-between align-items-center pt-3 pb-2 mb-3 border-bottom">
                            <h1 class="h2"><i class="bi bi-calculator me-2"></i>PHP Mathematik</h1>
                        </div>

                        <div class="card bg-light mb-4">
                            <div class="card-body">
                                <h2>🧮 Mathematik in PHP - Zahlen professionell verarbeiten</h2>
                                <p class="lead">Von einfachen Berechnungen bis hin zu komplexen mathematischen
                                    Funktionen - PHP bietet alles, was Sie für <strong>professionelle
                                        Zahlenverarbeitung</strong> brauchen!</p>
                            </div>
                        </div>

                        <div class="alert alert-info">
                            <h5><i class="bi bi-lightbulb me-2"></i>Mathematik überall in der Webentwicklung</h5>
                            <p class="mb-0">Preisberechnungen, Statistiken, Bewertungen, Geometrie, Zinsen, Rabatte,
                                Zeitberechnungen - ohne Mathe läuft in der Webentwicklung <strong>fast nichts</strong>!
                            </p>
                        </div>

                        <h3>🔢 Grundrechenarten</h3>
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h5>Die vier Grundrechenarten:</h5>
                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
$a = 15;
$b = 4;

// Addition
$summe = $a + $b;           // 19
echo "$a + $b = $summe\n";

// Subtraktion  
$differenz = $a - $b;       // 11
echo "$a - $b = $differenz\n";

// Multiplikation
$produkt = $a * $b;         // 60
echo "$a * $b = $produkt\n";

// Division
$quotient = $a / $b;        // 3.75
echo "$a / $b = $quotient\n";

// Modulo (Rest der Division)
$rest = $a % $b;            // 3
echo "$a % $b = $rest\n";

// Potenz (PHP 5.6+)
$potenz = $a ** $b;         // 50625 (15^4)
echo "$a ** $b = $potenz\n";

// Negative Zahlen
$negativ = -$a;             // -15
echo "Negativ von $a = $negativ\n";
?&gt;</code></pre>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <h5>Praktische Berechnungen:</h5>
                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
// Einkaufsrechnung
$netto_preis = 100.00;
$mwst_satz = 19;           // 19%
$menge = 3;

$netto_summe = $netto_preis * $menge;
$mwst_betrag = $netto_summe * ($mwst_satz / 100);
$brutto_summe = $netto_summe + $mwst_betrag;

echo "Netto-Summe: " . number_format($netto_summe, 2) . "€\n";
echo "MwSt (19%): " . number_format($mwst_betrag, 2) . "€\n"; 
echo "Brutto-Summe: " . number_format($brutto_summe, 2) . "€\n";

// Rabatt berechnen
$rabatt_prozent = 15;
$rabatt_betrag = $brutto_summe * ($rabatt_prozent / 100);
$endpreis = $brutto_summe - $rabatt_betrag;

echo "Rabatt (15%): -" . number_format($rabatt_betrag, 2) . "€\n";
echo "Endpreis: " . number_format($endpreis, 2) . "€\n";

// Durchschnitt berechnen
$noten = [85, 92, 78, 88, 95];
$durchschnitt = array_sum($noten) / count($noten);
echo "Notenschnitt: " . round($durchschnitt, 1) . "\n";
?&gt;</code></pre>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h3>📊 Wichtige mathematische Funktionen</h3>

                        <div class="row mb-4">
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h5><i class="bi bi-arrow-up-circle text-success me-2"></i>Runden & Begrenzen
                                        </h5>
                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
$zahl = 15.7834;

// Runden
echo round($zahl);      // 16
echo round($zahl, 2);   // 15.78
echo round($zahl, 1);   // 15.8

// Aufrunden
echo ceil($zahl);       // 16
echo ceil(15.1);        // 16

// Abrunden  
echo floor($zahl);      // 15
echo floor(15.9);       // 15

// Absolutwert
echo abs(-42);          // 42
echo abs(42);           // 42

// Minimum/Maximum
echo min(5, 3, 8, 1);   // 1
echo max(5, 3, 8, 1);   // 8

// Zwischen Grenzen halten
function clamp($wert, $min, $max) {
    return max($min, min($wert, $max));
}

echo clamp(150, 0, 100); // 100
echo clamp(-10, 0, 100); // 0
echo clamp(50, 0, 100);  // 50
?&gt;</code></pre>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h5><i class="bi bi-graph-up text-primary me-2"></i>Potenz & Wurzel</h5>
                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
// Potenz
echo pow(2, 3);         // 8 (2^3)
echo pow(5, 2);         // 25 (5^2)
echo 2 ** 3;            // 8 (PHP 5.6+)

// Quadratwurzel
echo sqrt(25);          // 5
echo sqrt(2);           // 1.4142135...

// Exponentialfunktion
echo exp(1);            // 2.718... (e^1)
echo exp(2);            // 7.389... (e^2)

// Logarithmus
echo log(10);           // 2.302... (ln)
echo log10(100);        // 2 (log10)
echo log(8, 2);         // 3 (log2 von 8)

// Hypot (Hypotenuse)
echo hypot(3, 4);       // 5 (Pythagoras)

// Praktisches Beispiel: Zinseszins
$kapital = 1000;        // 1000€
$zinssatz = 0.05;       // 5%
$jahre = 10;

$endkapital = $kapital * pow(1 + $zinssatz, $jahre);
echo "Nach $jahre Jahren: " . 
     number_format($endkapital, 2) . "€";
?&gt;</code></pre>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h5><i class="bi bi-circle text-warning me-2"></i>Trigonometrie</h5>
                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
// Winkel zu Radiant konvertieren
function grad_zu_rad($grad) {
    return $grad * (M_PI / 180);
}

$winkel = 90; // Grad
$rad = grad_zu_rad($winkel);

// Trigonometrische Funktionen
echo sin($rad);         // 1 (sin 90°)
echo cos($rad);         // 0 (cos 90°) 
echo tan(grad_zu_rad(45)); // 1 (tan 45°)

// Umkehrfunktionen
echo rad2deg(asin(1));  // 90° (arcsin)
echo rad2deg(acos(0));  // 90° (arccos)
echo rad2deg(atan(1));  // 45° (arctan)

// Konstanten
echo M_PI;              // 3.14159...
echo M_E;               // 2.71828... (Euler)

// Kreis-Berechnungen
$radius = 5;
$umfang = 2 * M_PI * $radius;
$flaeche = M_PI * pow($radius, 2);

echo "Umfang: " . round($umfang, 2) . "\n";
echo "Fläche: " . round($flaeche, 2) . "\n";
?&gt;</code></pre>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h3>🎲 Zufallszahlen</h3>
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h5>Einfache Zufallszahlen:</h5>
                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
// Einfache Zufallszahl (0 bis RAND_MAX)
echo rand() . "\n";

// Zufallszahl in einem Bereich
echo rand(1, 6) . "\n";        // Würfel (1-6)
echo rand(100, 999) . "\n";    // 3-stellige Zahl

// Bessere Zufallszahlen (empfohlen)
echo mt_rand() . "\n";
echo mt_rand(1, 100) . "\n";   // 1-100

// Zufällige Dezimalzahl (0.0 - 1.0)
function random_float() {
    return mt_rand() / mt_getrandmax();
}

echo random_float() . "\n";    // z.B. 0.437291

// Zufällige Dezimalzahl in Bereich
function random_float_range($min, $max) {
    return $min + (random_float() * ($max - $min));
}

echo random_float_range(10.5, 20.8) . "\n";

// Seed setzen (für reproduzierbare Ergebnisse)
mt_srand(12345);
echo mt_rand(1, 100) . "\n";   // Immer gleich bei gleichem Seed
?&gt;</code></pre>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <h5>Praktische Anwendungen:</h5>
                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
// Zufällige Farbe (Hex)
function zufaellige_farbe() {
    return sprintf("#%02x%02x%02x", 
                   mt_rand(0, 255), 
                   mt_rand(0, 255), 
                   mt_rand(0, 255));
}
echo zufaellige_farbe() . "\n"; // z.B. #a3f7d2

// Zufälliges Element aus Array
$namen = ["Max", "Anna", "Tom", "Lisa", "Ben"];
$zufaelliger_name = $namen[array_rand($namen)];
echo "Gewinner: $zufaelliger_name\n";

// Array mischen
$karten = range(1, 52);
shuffle($karten);
echo "Erste Karte: " . $karten[0] . "\n";

// Passwort generieren
function generiere_passwort($laenge = 12) {
    $zeichen = 'abcdefghijklmnopqrstuvwxyz' .
               'ABCDEFGHIJKLMNOPQRSTUVWXYZ' . 
               '0123456789!@#$%^&*';
    
    $passwort = '';
    for ($i = 0; $i < $laenge; $i++) {
        $passwort .= $zeichen[mt_rand(0, strlen($zeichen) - 1)];
    }
    return $passwort;
}

echo "Neues Passwort: " . generiere_passwort(16) . "\n";

// Würfel-Simulation
function wuerfel_simulation($anzahl_wuerfe = 1000) {
    $ergebnisse = array_fill(1, 6, 0);
    
    for ($i = 0; $i < $anzahl_wuerfe; $i++) {
        $wurf = mt_rand(1, 6);
        $ergebnisse[$wurf]++;
    }
    
    return $ergebnisse;
}

$simulation = wuerfel_simulation(6000);
foreach ($simulation as $zahl => $haeufigkeit) {
    $prozent = ($haeufigkeit / 6000) * 100;
    echo "Zahl $zahl: $haeufigkeit mal (" . 
         round($prozent, 1) . "%)\n";
}
?&gt;</code></pre>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h3>💰 Zahlen formatieren</h3>
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h5>number_format() - Der Klassiker:</h5>
                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
$zahl = 1234567.89;

// Grundformat
echo number_format($zahl) . "\n";         // 1,234,568

// Mit Dezimalstellen
echo number_format($zahl, 2) . "\n";      // 1,234,567.89

// Deutsche Formatierung
echo number_format($zahl, 2, ',', '.') . "\n"; // 1.234.567,89

// Ohne Tausender-Trenner
echo number_format($zahl, 2, '.', '') . "\n";  // 1234567.89

// Praktische Funktionen
function format_euro($betrag) {
    return number_format($betrag, 2, ',', '.') . ' €';
}

function format_us_dollar($betrag) {
    return '$' . number_format($betrag, 2);
}

echo format_euro(1234.56) . "\n";       // 1.234,56 €
echo format_us_dollar(1234.56) . "\n";  // $1,234.56

// Kurze Zahlen (K, M, B)
function format_kurz($zahl) {
    if ($zahl >= 1000000000) {
        return round($zahl / 1000000000, 1) . 'B';
    } elseif ($zahl >= 1000000) {
        return round($zahl / 1000000, 1) . 'M';  
    } elseif ($zahl >= 1000) {
        return round($zahl / 1000, 1) . 'K';
    }
    return $zahl;
}

echo format_kurz(1500) . "\n";         // 1.5K
echo format_kurz(2500000) . "\n";      // 2.5M
?&gt;</code></pre>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <h5>Erweiterte Formatierung:</h5>
                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
// Prozente formatieren
function format_prozent($wert, $dezimale = 1) {
    return number_format($wert * 100, $dezimale) . '%';
}

echo format_prozent(0.1567) . "\n";    // 15.7%
echo format_prozent(0.75, 0) . "\n";   // 75%

// Dateigrößen formatieren  
function format_bytes($bytes, $precision = 2) {
    $units = ['B', 'KB', 'MB', 'GB', 'TB'];
    
    for ($i = 0; $bytes >= 1024 && $i < 4; $i++) {
        $bytes /= 1024;
    }
    
    return round($bytes, $precision) . ' ' . $units[$i];
}

echo format_bytes(1536) . "\n";        // 1.5 KB
echo format_bytes(5242880) . "\n";     // 5 MB

// Römische Zahlen
function zu_roemisch($zahl) {
    $werte = [1000=>'M', 900=>'CM', 500=>'D', 400=>'CD',
              100=>'C', 90=>'XC', 50=>'L', 40=>'XL',
              10=>'X', 9=>'IX', 5=>'V', 4=>'IV', 1=>'I'];
    
    $ergebnis = '';
    foreach ($werte as $wert => $symbol) {
        while ($zahl >= $wert) {
            $ergebnis .= $symbol;
            $zahl -= $wert;
        }
    }
    return $ergebnis;
}

echo zu_roemisch(2024) . "\n";         // MMXXIV
echo zu_roemisch(42) . "\n";           // XLII

// Zahlen in Worten (vereinfacht, deutsch)
function zahl_in_worten($zahl) {
    $einer = ['', 'eins', 'zwei', 'drei', 'vier', 'fünf',
              'sechs', 'sieben', 'acht', 'neun'];
    $zehner = ['', '', 'zwanzig', 'dreißig', 'vierzig', 'fünfzig',
               'sechzig', 'siebzig', 'achtzig', 'neunzig'];
    
    if ($zahl < 10) return $einer[$zahl];
    if ($zahl < 20) {
        $special = ['zehn', 'elf', 'zwölf', 'dreizehn', 'vierzehn',
                   'fünfzehn', 'sechzehn', 'siebzehn', 'achtzehn', 'neunzehn'];
        return $special[$zahl - 10];
    }
    if ($zahl < 100) {
        return $einer[$zahl % 10] . ($zahl % 10 ? 'und' : '') . 
               $zehner[intval($zahl / 10)];
    }
    
    return strval($zahl); // Für größere Zahlen
}

echo zahl_in_worten(42) . "\n";        // zweiundvierzig
?&gt;</code></pre>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h3>📈 Statistik und Datenanalyse</h3>
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="card bg-dark text-light">
                                    <div class="card-header">
                                        <small><i class="bi bi-bar-chart me-2"></i>Statistische Funktionen</small>
                                    </div>
                                    <div class="card-body">
                                        <pre class="mb-0"><code class="language-php text-light">&lt;?php
// Beispiel-Daten: Verkaufszahlen
$verkaeufe = [120, 85, 95, 110, 130, 75, 140, 90, 115, 105];

// Grundlegende Statistiken
function berechne_statistiken($daten) {
    $anzahl = count($daten);
    $summe = array_sum($daten);
    $mittelwert = $summe / $anzahl;
    
    // Sortieren für Median
    $sortiert = $daten;
    sort($sortiert);
    
    // Median berechnen
    if ($anzahl % 2 == 0) {
        $median = ($sortiert[$anzahl/2 - 1] + $sortiert[$anzahl/2]) / 2;
    } else {
        $median = $sortiert[floor($anzahl/2)];
    }
    
    // Varianz und Standardabweichung
    $varianz_summe = 0;
    foreach ($daten as $wert) {
        $varianz_summe += pow($wert - $mittelwert, 2);
    }
    $varianz = $varianz_summe / $anzahl;
    $standardabweichung = sqrt($varianz);
    
    return [
        'anzahl' => $anzahl,
        'summe' => $summe,
        'mittelwert' => round($mittelwert, 2),
        'median' => $median,
        'minimum' => min($daten),
        'maximum' => max($daten),
        'spannweite' => max($daten) - min($daten),
        'varianz' => round($varianz, 2),
        'standardabweichung' => round($standardabweichung, 2)
    ];
}

$stats = berechne_statistiken($verkaeufe);

echo "&lt;div class='alert alert-info'&gt;";
echo "&lt;h4&gt;📊 Verkaufsstatistiken:&lt;/h4&gt;";
echo "&lt;div class='row'&gt;";
echo "&lt;div class='col-md-6'&gt;";
echo "&lt;p&gt;&lt;strong&gt;Anzahl Datenpunkte:&lt;/strong&gt; {$stats['anzahl']}&lt;/p&gt;";
echo "&lt;p&gt;&lt;strong&gt;Gesamtsumme:&lt;/strong&gt; {$stats['summe']} Stück&lt;/p&gt;";
echo "&lt;p&gt;&lt;strong&gt;Durchschnitt:&lt;/strong&gt; {$stats['mittelwert']} Stück&lt;/p&gt;";
echo "&lt;p&gt;&lt;strong&gt;Median:&lt;/strong&gt; {$stats['median']} Stück&lt;/p&gt;";
echo "&lt;/div&gt;&lt;div class='col-md-6'&gt;";
echo "&lt;p&gt;&lt;strong&gt;Minimum:&lt;/strong&gt; {$stats['minimum']} Stück&lt;/p&gt;";
echo "&lt;p&gt;&lt;strong&gt;Maximum:&lt;/strong&gt; {$stats['maximum']} Stück&lt;/p&gt;";
echo "&lt;p&gt;&lt;strong&gt;Spannweite:&lt;/strong&gt; {$stats['spannweite']} Stück&lt;/p&gt;";
echo "&lt;p&gt;&lt;strong&gt;Standardabweichung:&lt;/strong&gt; {$stats['standardabweichung']}&lt;/p&gt;";
echo "&lt;/div&gt;&lt;/div&gt;&lt;/div&gt;";

// Quartile berechnen
function berechne_quartile($daten) {
    sort($daten);
    $n = count($daten);
    
    $q1_pos = ($n + 1) / 4;
    $q2_pos = ($n + 1) / 2;  // Median
    $q3_pos = 3 * ($n + 1) / 4;
    
    $q1 = $daten[floor($q1_pos) - 1];
    $q2 = $daten[floor($q2_pos) - 1];
    $q3 = $daten[floor($q3_pos) - 1];
    
    return [$q1, $q2, $q3];
}

$quartile = berechne_quartile($verkaeufe);
echo "Quartile: Q1={$quartile[0]}, Q2={$quartile[1]}, Q3={$quartile[2]}\n";

// Prozentile
function perzentil($daten, $p) {
    sort($daten);
    $n = count($daten);
    $pos = ($p / 100) * ($n - 1);
    
    if (floor($pos) == $pos) {
        return $daten[$pos];
    } else {
        $lower = $daten[floor($pos)];
        $upper = $daten[ceil($pos)];
        return $lower + ($pos - floor($pos)) * ($upper - $lower);
    }
}

echo "90. Perzentil: " . round(perzentil($verkaeufe, 90), 1) . "\n";

// Korrelation zwischen zwei Datensätzen
function korrelation($x, $y) {
    $n = count($x);
    $sum_x = array_sum($x);
    $sum_y = array_sum($y);
    $sum_xy = 0;
    $sum_x2 = 0;
    $sum_y2 = 0;
    
    for ($i = 0; $i < $n; $i++) {
        $sum_xy += $x[$i] * $y[$i];
        $sum_x2 += $x[$i] * $x[$i];
        $sum_y2 += $y[$i] * $y[$i];
    }
    
    $numerator = $n * $sum_xy - $sum_x * $sum_y;
    $denominator = sqrt(($n * $sum_x2 - $sum_x * $sum_x) * ($n * $sum_y2 - $sum_y * $sum_y));
    
    return $denominator != 0 ? $numerator / $denominator : 0;
}

// Beispiel: Korrelation zwischen Werbung und Verkauf
$werbung = [1000, 1500, 800, 1200, 2000, 600, 1800, 900, 1400, 1100];
$korr = korrelation($werbung, $verkaeufe);
echo "Korrelation Werbung-Verkauf: " . round($korr, 3) . "\n";
?&gt;</code></pre>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h3>🏦 Finanz-Mathematik</h3>
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h5>Zinsen und Rendite:</h5>
                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
// Einfache Zinsen
function einfache_zinsen($kapital, $zinssatz, $jahre) {
    return $kapital * ($zinssatz / 100) * $jahre;
}

// Zinseszinsen
function zinseszinsen($kapital, $zinssatz, $jahre) {
    return $kapital * pow(1 + ($zinssatz / 100), $jahre);
}

// Beispiel: 1000€ bei 5% über 10 Jahre
$kapital = 1000;
$zinssatz = 5;
$jahre = 10;

$einfach = einfache_zinsen($kapital, $zinssatz, $jahre);
$zinseszins = zinseszinsen($kapital, $zinssatz, $jahre);

echo "Einfache Zinsen: " . number_format($einfach, 2) . "€\n";
echo "Zinseszinsen: " . number_format($zinseszins, 2) . "€\n";
echo "Unterschied: " . number_format($zinseszins - $einfach, 2) . "€\n";

// Monatliche Sparraten
function sparplan($monatliche_rate, $zinssatz_jahr, $jahre) {
    $zinssatz_monat = $zinssatz_jahr / 100 / 12;
    $monate = $jahre * 12;
    
    if ($zinssatz_monat == 0) {
        return $monatliche_rate * $monate;
    }
    
    return $monatliche_rate * 
           ((pow(1 + $zinssatz_monat, $monate) - 1) / $zinssatz_monat);
}

$endwert = sparplan(100, 3, 20);  // 100€/Monat, 3%, 20 Jahre
echo "Sparplan-Endwert: " . number_format($endwert, 2) . "€\n";

// Effektiver Jahreszins
function effektiver_jahreszins($nominal_zins, $aufschlaege_pro_jahr = 1) {
    return pow(1 + ($nominal_zins / 100) / $aufschlaege_pro_jahr, 
               $aufschlaege_pro_jahr) - 1;
}

$eff_zins = effektiver_jahreszins(5, 12) * 100;  // Monatlich
echo "Effektiver Jahreszins: " . round($eff_zins, 2) . "%\n";
?&gt;</code></pre>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <h5>Kredite und Ratenzahlung:</h5>
                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
// Monatliche Kreditrate berechnen (Annuität)
function kreditrate($kreditsumme, $zinssatz_jahr, $laufzeit_jahre) {
    $zinssatz_monat = $zinssatz_jahr / 100 / 12;
    $monate = $laufzeit_jahre * 12;
    
    if ($zinssatz_monat == 0) {
        return $kreditsumme / $monate;
    }
    
    $rate = $kreditsumme * 
            ($zinssatz_monat * pow(1 + $zinssatz_monat, $monate)) /
            (pow(1 + $zinssatz_monat, $monate) - 1);
    
    return $rate;
}

// Beispiel: 200.000€ Hauskredit, 3.5% Zinsen, 25 Jahre
$kreditsumme = 200000;
$zinssatz = 3.5;
$laufzeit = 25;

$monatliche_rate = kreditrate($kreditsumme, $zinssatz, $laufzeit);
$gesamtkosten = $monatliche_rate * $laufzeit * 12;
$zinsen_total = $gesamtkosten - $kreditsumme;

echo "&lt;div class='alert alert-warning'&gt;";
echo "&lt;h5&gt;🏠 Hauskredit-Beispiel:&lt;/h5&gt;";
echo "&lt;p&gt;&lt;strong&gt;Kreditsumme:&lt;/strong&gt; " . number_format($kreditsumme, 0, ',', '.') . "€&lt;/p&gt;";
echo "&lt;p&gt;&lt;strong&gt;Monatliche Rate:&lt;/strong&gt; " . number_format($monatliche_rate, 2, ',', '.') . "€&lt;/p&gt;";
echo "&lt;p&gt;&lt;strong&gt;Gesamtkosten:&lt;/strong&gt; " . number_format($gesamtkosten, 2, ',', '.') . "€&lt;/p&gt;";
echo "&lt;p&gt;&lt;strong&gt;Zinsen gesamt:&lt;/strong&gt; " . number_format($zinsen_total, 2, ',', '.') . "€&lt;/p&gt;";
echo "&lt;/div&gt;";

// Restschuld nach X Jahren
function restschuld($kreditsumme, $zinssatz_jahr, $laufzeit_jahre, $jahre_vergangen) {
    $zinssatz_monat = $zinssatz_jahr / 100 / 12;
    $monate_gesamt = $laufzeit_jahre * 12;
    $monate_vergangen = $jahre_vergangen * 12;
    
    $rate = kreditrate($kreditsumme, $zinssatz_jahr, $laufzeit_jahre);
    
    if ($zinssatz_monat == 0) {
        return $kreditsumme - ($rate * $monate_vergangen);
    }
    
    $restschuld = $kreditsumme * 
                  (pow(1 + $zinssatz_monat, $monate_gesamt) - 
                   pow(1 + $zinssatz_monat, $monate_vergangen)) /
                  (pow(1 + $zinssatz_monat, $monate_gesamt) - 1);
    
    return max(0, $restschuld);
}

$restschuld_10j = restschuld($kreditsumme, $zinssatz, $laufzeit, 10);
echo "Restschuld nach 10 Jahren: " . number_format($restschuld_10j, 2, ',', '.') . "€\n";

// Tilgungsplan (erste 3 Raten)
function tilgungsplan($kreditsumme, $zinssatz_jahr, $monate, $anzeige_monate = 3) {
    $zinssatz_monat = $zinssatz_jahr / 100 / 12;
    $rate = kreditrate($kreditsumme, $zinssatz_jahr, $monate / 12);
    
    $restschuld = $kreditsumme;
    
    echo "&lt;table class='table table-sm'&gt;";
    echo "&lt;thead&gt;&lt;tr&gt;&lt;th&gt;Monat&lt;/th&gt;&lt;th&gt;Rate&lt;/th&gt;&lt;th&gt;Zinsen&lt;/th&gt;&lt;th&gt;Tilgung&lt;/th&gt;&lt;th&gt;Restschuld&lt;/th&gt;&lt;/tr&gt;&lt;/thead&gt;&lt;tbody&gt;";
    
    for ($monat = 1; $monat <= min($anzeige_monate, $monate); $monat++) {
        $zinsen = $restschuld * $zinssatz_monat;
        $tilgung = $rate - $zinsen;
        $restschuld -= $tilgung;
        
        echo "&lt;tr&gt;";
        echo "&lt;td&gt;$monat&lt;/td&gt;";
        echo "&lt;td&gt;" . number_format($rate, 2) . "€&lt;/td&gt;";
        echo "&lt;td&gt;" . number_format($zinsen, 2) . "€&lt;/td&gt;";
        echo "&lt;td&gt;" . number_format($tilgung, 2) . "€&lt;/td&gt;";
        echo "&lt;td&gt;" . number_format($restschuld, 2) . "€&lt;/td&gt;";
        echo "&lt;/tr&gt;";
    }
    echo "&lt;/tbody&gt;&lt;/table&gt;";
}

tilgungsplan($kreditsumme, $zinssatz, $laufzeit * 12, 6);
?&gt;</code></pre>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h3>⚙️ Praktische Mathematik-Helfer</h3>
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="card bg-dark text-light">
                                    <div class="card-header">
                                        <small><i class="bi bi-tools me-2"></i>Nützliche Mathe-Funktionen für den
                                            Alltag</small>
                                    </div>
                                    <div class="card-body">
                                        <pre class="mb-0"><code class="language-php text-light">&lt;?php
// Mathematische Konstanten
echo "π (Pi): " . M_PI . "\n";
echo "e (Euler): " . M_E . "\n";
echo "φ (Goldener Schnitt): " . ((1 + sqrt(5)) / 2) . "\n";

// Prüfungen
function ist_gerade($zahl) {
    return $zahl % 2 === 0;
}

function ist_primzahl($zahl) {
    if ($zahl < 2) return false;
    if ($zahl == 2) return true;
    if ($zahl % 2 == 0) return false;
    
    for ($i = 3; $i <= sqrt($zahl); $i += 2) {
        if ($zahl % $i == 0) return false;
    }
    return true;
}

function ist_perfekte_zahl($zahl) {
    $summe = 1;
    for ($i = 2; $i <= sqrt($zahl); $i++) {
        if ($zahl % $i == 0) {
            $summe += $i;
            if ($i != $zahl / $i) {
                $summe += $zahl / $i;
            }
        }
    }
    return $summe == $zahl && $zahl > 1;
}

// Tests
echo ist_gerade(42) ? "42 ist gerade\n" : "42 ist ungerade\n";
echo ist_primzahl(17) ? "17 ist Primzahl\n" : "17 ist keine Primzahl\n";
echo ist_perfekte_zahl(28) ? "28 ist perfekt\n" : "28 ist nicht perfekt\n";

// Fibonacci-Folge
function fibonacci($n) {
    if ($n <= 1) return $n;
    
    $a = 0; $b = 1;
    for ($i = 2; $i <= $n; $i++) {
        $temp = $a + $b;
        $a = $b;
        $b = $temp;
    }
    return $b;
}

echo "Fibonacci-Folge: ";
for ($i = 0; $i < 10; $i++) {
    echo fibonacci($i) . " ";
}
echo "\n";

// Fakultät
function fakultaet($n) {
    if ($n <= 1) return 1;
    return $n * fakultaet($n - 1);
}

echo "5! = " . fakultaet(5) . "\n";  // 120

// Binomialkoeffizient (n über k)
function binomial($n, $k) {
    if ($k > $n) return 0;
    if ($k == 0 || $k == $n) return 1;
    
    return fakultaet($n) / (fakultaet($k) * fakultaet($n - $k));
}

echo "10 über 3 = " . binomial(10, 3) . "\n";  // 120

// Größter gemeinsamer Teiler (ggT)
function ggt($a, $b) {
    while ($b != 0) {
        $temp = $b;
        $b = $a % $b;
        $a = $temp;
    }
    return $a;
}

// Kleinstes gemeinsames Vielfaches (kgV)
function kgv($a, $b) {
    return abs($a * $b) / ggt($a, $b);
}

echo "ggT(48, 18) = " . ggt(48, 18) . "\n";  // 6
echo "kgV(48, 18) = " . kgv(48, 18) . "\n";  // 144

// Distanz zwischen zwei Punkten
function distanz($x1, $y1, $x2, $y2) {
    return sqrt(pow($x2 - $x1, 2) + pow($y2 - $y1, 2));
}

echo "Distanz (0,0) zu (3,4): " . distanz(0, 0, 3, 4) . "\n";  // 5

// Winkel zwischen zwei Punkten
function winkel_grad($x1, $y1, $x2, $y2) {
    $rad = atan2($y2 - $y1, $x2 - $x1);
    return rad2deg($rad);
}

echo "Winkel: " . round(winkel_grad(0, 0, 1, 1), 1) . "°\n";  // 45°
?&gt;</code></pre>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="alert alert-success">
                            <h5><i class="bi bi-calculator me-2"></i>PHP Mathematik - Wichtigste Erkenntnisse</h5>
                            <ul class="mb-0">
                                <li>✅ <strong>Grundrechenarten</strong> - +, -, *, /, %, ** für alle Berechnungen</li>
                                <li>✅ <strong>round(), ceil(), floor()</strong> - Zahlen runden und begrenzen</li>
                                <li>✅ <strong>min(), max(), abs()</strong> - Vergleiche und Absolutwerte</li>
                                <li>✅ <strong>pow(), sqrt(), log()</strong> - Potenz, Wurzel und Logarithmus</li>
                                <li>✅ <strong>rand(), mt_rand()</strong> - Zufallszahlen generieren</li>
                                <li>✅ <strong>number_format()</strong> - Zahlen benutzerfreundlich formatieren</li>
                                <li>✅ <strong>Statistische Funktionen</strong> - Durchschnitt, Median,
                                    Standardabweichung</li>
                                <li>✅ <strong>Finanz-Mathematik</strong> - Zinsen, Kredite und Renditeberechnungen</li>
                            </ul>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <h6>Vorheriges Thema</h6>
                                        <a href="php-stringse.php" class="btn btn-outline-secondary">
                                            <i class="bi bi-arrow-left me-2"></i>Strings
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <h6>Nächstes Thema</h6>
                                        <a href="php-constanten.php" class="btn btn-primary">
                                            <i class="bi bi-lock me-2"></i>Konstanten
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