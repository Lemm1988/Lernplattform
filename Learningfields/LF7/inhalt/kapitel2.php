<?php
return [
    'title' => 'Sensoren, Aktoren und A/D-Wandlung',
    'intro' => 'Ein Mikrocontroller rechnet mit Zahlen, die Welt draußen liefert Spannungen, Ströme und Widerstände. Dieses Kapitel zeigt, wie aus einer Temperatur ein Messwert wird – und wie aus einem Bit wieder eine Bewegung.',
    'goals' => [
        'Sensoren nach Ausgangssignal (binär, analog, digital) einordnen',
        'Kenngrößen eines Sensors wie Messbereich, Auflösung und Genauigkeit unterscheiden',
        'Auflösung und Rohwert eines A/D-Wandlers berechnen und zurückrechnen',
        'Spannungsteiler und 4–20-mA-Schnittstelle anwenden',
        'geeignete Treiber für Aktoren wie Relais, Motoren und Servos auswählen',
    ],
    'content' => <<<'INHALT'
<h6>Sensoren nach Ausgangssignal</h6>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th>Art</th><th>Signal</th><th>Beispiele</th><th>Anschluss am Mikrocontroller</th></tr></thead>
  <tbody>
    <tr><td><strong>binär</strong></td><td>nur zwei Zustände (an/aus)</td><td>Taster, Reedkontakt, Endlagenschalter, Bewegungsmelder (PIR), Lichtschranke</td><td>digitaler Eingang (GPIO, <a href="/Learningfields/LF7/kapitel3.php">Kapitel 3</a>)</td></tr>
    <tr><td><strong>analog</strong></td><td>stufenlose Spannung, Strom oder Widerstand</td><td>NTC/PT1000 (Temperatur), Fotowiderstand (Licht), Potenziometer, kapazitiver Bodenfeuchtesensor</td><td>Analogeingang mit A/D-Wandler</td></tr>
    <tr><td><strong>digital</strong></td><td>fertiger Zahlenwert über eine Schnittstelle</td><td>Temperatur-/Feuchte-/Drucksensor mit I²C, Beschleunigungssensor mit SPI, GPS-Modul mit UART</td><td>Bus-Schnittstelle (<a href="/Learningfields/LF7/kapitel5.php">Kapitel 5</a>)</td></tr>
  </tbody>
</table>
<p>Digitale Sensoren haben den Wandler bereits eingebaut, sind oft kalibriert und störsicherer. Analoge Sensoren sind einfach und günstig, brauchen aber eine saubere Umrechnung.</p>
<p>Ein Sonderfall ist die <strong>Laufzeitmessung</strong>: Ein Ultraschallsensor sendet einen Impuls und misst, wann das Echo zurückkommt. Schall legt in Luft etwa 343 m/s zurück, und zwar hin <em>und</em> zurück. Daher: <code>Abstand = 343 m/s · t / 2</code>. Kommt das Echo nach 2,0 ms, ist das Hindernis 343 · 0,002 / 2 = 0,343 m entfernt.</p>

<h6>Kenngrößen eines Sensors</h6>
<ul>
  <li><strong>Messbereich</strong>: kleinster bis größter messbarer Wert, z. B. −40 bis +85 °C.</li>
  <li><strong>Auflösung</strong>: kleinste unterscheidbare Änderung, z. B. 0,1 °C.</li>
  <li><strong>Genauigkeit</strong>: maximale Abweichung vom wahren Wert, z. B. ±0,5 °C. Eine hohe Auflösung sagt nichts über die Genauigkeit – ein Thermometer kann auf 0,01 °C auflösen und trotzdem 2 °C danebenliegen.</li>
  <li><strong>Ansprechzeit</strong>: wie schnell der Sensor einer Änderung folgt.</li>
  <li><strong>Drift und Kalibrierung</strong>: Werte verschieben sich mit Alter und Temperatur; Abgleich mit einem Referenzgerät.</li>
</ul>

<h6>Der A/D-Wandler</h6>
<p>Ein Analog-Digital-Wandler (ADC) macht aus einer Spannung eine ganze Zahl. Dafür tut er zwei Dinge:</p>
<ol>
  <li><strong>Abtasten</strong>: In festen Abständen wird die Spannung gemessen. Die <em>Abtastrate</em> muss mehr als doppelt so hoch sein wie die höchste Frequenz im Signal (Abtasttheorem nach Nyquist/Shannon), sonst entstehen Scheinsignale (Aliasing).</li>
  <li><strong>Quantisieren</strong>: Jeder Messwert wird einer von 2<sup>n</sup> Stufen zugeordnet. n ist die <em>Auflösung in Bit</em>.</li>
</ol>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf7/adc-quantisierung.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Ein glattes analoges Signal wird 16-mal abgetastet; ein 3-Bit-Wandler ordnet jeden Abtastwert einer von 8 Stufen zu, das Ergebnis ist eine Treppenkurve">
  <figcaption class="figure-caption">Abtasten und Quantisieren – hier mit nur 3 Bit, damit die Stufen sichtbar sind</figcaption>
</figure>
<p>Die Stufenbreite heißt <strong>LSB</strong> (Least Significant Bit) und ergibt sich aus der Referenzspannung:</p>
<p class="text-center"><code>LSB = U<sub>ref</sub> / 2<sup>n</sup></code> &nbsp;&nbsp; <code>Rohwert = U<sub>ein</sub> / LSB</code> &nbsp;&nbsp; <code>U<sub>ein</sub> = Rohwert · LSB</code></p>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th>Wandler</th><th>Stufen</th><th>LSB</th></tr></thead>
  <tbody>
    <tr><td>8 Bit, 5 V</td><td>256</td><td>5 V / 256 ≈ 19,5 mV</td></tr>
    <tr><td>10 Bit, 5 V</td><td>1024</td><td>5 V / 1024 ≈ 4,88 mV</td></tr>
    <tr><td>10 Bit, 3,3 V</td><td>1024</td><td>3,3 V / 1024 ≈ 3,22 mV</td></tr>
    <tr><td>12 Bit, 3,3 V</td><td>4096</td><td>3,3 V / 4096 ≈ 0,81 mV</td></tr>
  </tbody>
</table>
<p>Der größte Rohwert ist 2<sup>n</sup> − 1 (bei 10 Bit also 1023). Manche Datenblätter rechnen deshalb mit 2<sup>n</sup> − 1 statt 2<sup>n</sup> im Nenner; der Unterschied ist kleiner als eine Stufe. In der Prüfung gilt die Formel aus der Aufgabe.</p>
<p class="lf-merke"><strong>Merke:</strong> Jedes zusätzliche Bit halbiert die Stufenbreite. Die maximale Spannung am Eingang ist die Referenzspannung – höhere Spannungen können den Pin zerstören. Ein 5-V-Signal an einem 3,3-V-Controller braucht einen Spannungsteiler oder Pegelwandler.</p>

<h6>Spannungsteiler: Widerstand messen</h6>
<p>Ein ADC misst Spannung, viele Sensoren ändern aber ihren <em>Widerstand</em>. Die Lösung ist ein Spannungsteiler aus einem Festwiderstand und dem Sensor:</p>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf7/spannungsteiler-ntc.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Schaltung aus R1 10 Kiloohm und einem NTC zwischen 3,3 Volt und Masse, der Mittelpunkt geht an A0. Tabelle: 0 Grad 2,54 Volt Rohwert 789, 25 Grad 1,65 Volt Rohwert 512, 50 Grad 0,87 Volt Rohwert 270">
  <figcaption class="figure-caption">NTC im Spannungsteiler an einem 10-Bit-ADC mit 3,3 V</figcaption>
</figure>
<p>Der NTC (Heißleiter) leitet bei Wärme besser, sein Widerstand sinkt, die Spannung an A0 auch. Weil die Kennlinie gekrümmt ist, rechnet die Software mit einer Formel oder einer Wertetabelle in °C um. Ein <strong>PT1000</strong> (Platin, 1000 Ω bei 0 °C) ist dagegen nahezu linear und genauer, aber teurer.</p>
<p>Linear arbeitende Sensoren sind leichter umzurechnen. Liefert ein Temperatursensor zum Beispiel 500 mV bei 0 °C und steigt um 10 mV pro Kelvin, gilt <code>T = (U − 0,5 V) · 100 °C/V</code>. Bei 0,75 V sind es also 25 °C.</p>

<h6>Industrie: 4–20 mA und 0–10 V</h6>
<p>Über lange Leitungen in Fabrikhallen sind kleine Spannungen störanfällig. Industriesensoren liefern deshalb oft einen <strong>Strom von 4 bis 20 mA</strong> (Stromschleife) oder eine Spannung von 0 bis 10 V.</p>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf7/kennlinie-4-20ma.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Gerade Kennlinie von 4 Milliampere bei 0 bar bis 20 Milliampere bei 10 bar, markiert 12 Milliampere gleich 5 bar; unter 3,6 und über 21 Milliampere liegt der Fehlerbereich">
  <figcaption class="figure-caption">Drucksensor 0–10 bar mit 4–20-mA-Ausgang</figcaption>
</figure>
<ul>
  <li>Ein Strom ist in einer Reihenschaltung überall gleich – Leitungswiderstände verfälschen ihn nicht.</li>
  <li>Der Nullpunkt liegt bei 4 mA, nicht bei 0 mA (<em>live zero</em>). Fließt gar kein Strom, ist das kein Messwert „0“, sondern ein Fehler: Drahtbruch oder Sensor ausgefallen.</li>
  <li>Umrechnung allgemein: <code>Wert = (I − 4 mA) / 16 mA · Messbereich + Anfangswert</code>.</li>
</ul>
<p>Am Mikrocontroller wird der Strom über einen Messwiderstand (Shunt) in eine Spannung gewandelt: 20 mA durch 150 Ω ergeben 3,0 V – passend für einen 3,3-V-ADC.</p>

<h6>Aktoren und ihre Treiber</h6>
<p>Ein GPIO-Pin liefert nur wenige Milliampere bei 3,3 V oder 5 V. Für alles, was mehr Leistung braucht, ist ein <strong>Treiber</strong> nötig:</p>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th>Aktor</th><th>Ansteuerung</th><th>Hinweis</th></tr></thead>
  <tbody>
    <tr><td>LED</td><td>direkt am GPIO mit Vorwiderstand</td><td>Strom begrenzen (<a href="/Learningfields/LF7/kapitel3.php">Kapitel 3</a>)</td></tr>
    <tr><td>Relais</td><td>Transistor als Schalter, Freilaufdiode parallel zur Spule</td><td>schaltet 230 V galvanisch getrennt – Arbeiten an Netzspannung nur durch Elektrofachkräfte</td></tr>
    <tr><td>Gleichstrommotor</td><td>MOSFET (eine Richtung) oder H-Brücke (zwei Richtungen)</td><td>Drehzahl über PWM (<a href="/Learningfields/LF7/kapitel4.php">Kapitel 4</a>)</td></tr>
    <tr><td>Servo</td><td>PWM-Signal, eigene Versorgung</td><td>fährt einen Winkel an, interne Regelung</td></tr>
    <tr><td>Schrittmotor</td><td>Schrittmotortreiber (Takt + Richtung)</td><td>z. B. 200 Schritte pro Umdrehung = 1,8° pro Schritt</td></tr>
    <tr><td>Magnetventil, Heizelement</td><td>MOSFET oder Relais</td><td>bei Spulen immer Freilaufdiode</td></tr>
  </tbody>
</table>
<p>Die <strong>Freilaufdiode</strong> schützt den Transistor: Wird eine Spule abgeschaltet, erzeugt sie eine hohe Gegenspannung. Die Diode lässt diesen Strom abklingen, statt ihn durch den Transistor zu jagen.</p>

<h6>Übungen mit Lösung</h6>
<p>1. Ein 12-Bit-ADC mit 3,3 V Referenz liefert den Rohwert 2048. Welche Spannung liegt an? Wie groß ist eine Stufe?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">LSB = 3,3 V / 4096 ≈ 0,806 mV. U = 2048 · 3,3 V / 4096 = 1,65 V (genau die halbe Referenzspannung).</p>
</details>
<p>2. Ein 10-Bit-ADC (3,3 V) misst den Rohwert 620. Wie hoch ist die Spannung? Welcher Temperatur entspricht das bei einem linearen Sensor mit 500 mV bei 0 °C und 10 mV/K?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">U = 620 · 3,3 V / 1024 ≈ 2,00 V. Das liegt weit über dem, was der Sensor bei Raumtemperatur liefert: T = (2,00 V − 0,5 V) · 100 °C/V ≈ 150 °C – entweder ist es sehr heiß, oder der Sensor ist falsch angeschlossen. Plausibilitätsprüfungen gehören deshalb in jede Messsoftware.</p>
</details>
<p>3. Ein Füllstandssensor misst 0 bis 4 m und liefert 4–20 mA. Gemessen werden 10,4 mA. Wie hoch ist der Füllstand? Was bedeutet ein Messwert von 0 mA?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">h = (10,4 − 4) / 16 · 4 m = 6,4 / 16 · 4 m = 1,6 m. 0 mA ist kein gültiger Messwert, sondern ein Fehler (Drahtbruch, Sensor ohne Versorgung) – genau dafür gibt es den Live-Zero bei 4 mA.</p>
</details>
<p>4. Ein Ultraschallsensor meldet ein Echo nach 5,8 ms. Wie weit ist das Hindernis entfernt?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">s = 343 m/s · 0,0058 s / 2 ≈ 0,99 m.</p>
</details>
INHALT,
    'summary' => [
        'Sensoren liefern binäre, analoge oder digitale Signale; digitale bringen ihren Wandler mit und hängen an einem Bus.',
        'Auflösung ≠ Genauigkeit. Messbereich, Ansprechzeit und Drift gehören ebenfalls ins Datenblatt.',
        'ADC: abtasten (mehr als doppelte Signalfrequenz) und quantisieren in 2^n Stufen; LSB = Uref / 2^n.',
        'Widerstandssensoren (NTC, LDR) misst man über einen Spannungsteiler.',
        '4–20 mA: störsicher über lange Leitungen; 4 mA = Messbereichsanfang, unter 3,6 mA = Fehler.',
        'Aktoren mit höherer Leistung brauchen Treiber (Transistor, MOSFET, H-Brücke, Relais), Spulen eine Freilaufdiode.',
    ],
    'quiz' => [
        ['question' => 'Wie berechnet man die Stufenbreite (LSB) eines A/D-Wandlers?', 'answer' => 'Referenzspannung geteilt durch 2 hoch Bitzahl, z. B. 3,3 V / 1024 ≈ 3,22 mV bei 10 Bit.'],
        ['question' => 'Warum beginnt die Stromschleife bei 4 mA und nicht bei 0 mA?', 'answer' => 'So lässt sich ein Fehler wie Drahtbruch (0 mA) vom Messbereichsanfang (4 mA) unterscheiden.'],
        ['question' => 'Was sagt das Abtasttheorem?', 'answer' => 'Die Abtastrate muss mehr als doppelt so hoch sein wie die höchste Frequenz im Signal.'],
        ['question' => 'Wozu dient eine Freilaufdiode an einer Relaisspule?', 'answer' => 'Sie leitet die Induktionsspannung beim Abschalten ab und schützt so den schaltenden Transistor.'],
    ],
];
