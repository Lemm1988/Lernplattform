<?php
return [
    'title' => 'Mikrocontroller und GPIO',
    'intro' => 'Der Mikrocontroller ist das Gehirn fast jedes cyber-physischen Systems. Seine Pins sind die Nervenenden: Sie lesen Taster, schalten LEDs und sprechen mit Sensoren. Wer die elektrischen Grundregeln der Pins kennt, vermeidet zerstörte Bauteile und rätselhafte Fehlmessungen.',
    'goals' => [
        'Mikrocontroller, Einplatinencomputer und SPS unterscheiden',
        'den inneren Aufbau eines Mikrocontrollers beschreiben',
        'GPIO-Pins als Ein- und Ausgang mit den passenden Pegeln einsetzen',
        'Pull-up- und Pull-down-Widerstände begründen und Taster entprellen',
        'den Vorwiderstand einer LED berechnen',
    ],
    'content' => <<<'INHALT'
<h6>Mikrocontroller, Einplatinencomputer, SPS</h6>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th></th><th>Mikrocontroller</th><th>Einplatinencomputer</th><th>SPS</th></tr></thead>
  <tbody>
    <tr><td>Beispiele</td><td>ATmega328P (Arduino Uno), ESP32, RP2040 (Raspberry Pi Pico)</td><td>Raspberry Pi 4/5, andere ARM-Boards</td><td>z. B. SIMATIC S7-1200, kompakte Kleinsteuerungen</td></tr>
    <tr><td>Betriebssystem</td><td>keins oder ein kleines Echtzeitbetriebssystem</td><td>Linux</td><td>Hersteller-Firmware, zyklische Programmbearbeitung</td></tr>
    <tr><td>Rechenleistung, Speicher</td><td>MHz-Bereich, KB RAM</td><td>GHz-Bereich, GB RAM</td><td>auf Steuerungsaufgaben zugeschnitten</td></tr>
    <tr><td>Start</td><td>sofort nach dem Einschalten</td><td>Bootvorgang, Sekunden</td><td>schnell, definierter Anlauf</td></tr>
    <tr><td>Echtzeit</td><td>gut vorhersagbar</td><td>nur eingeschränkt</td><td>ja, dafür gebaut</td></tr>
    <tr><td>Stromverbrauch</td><td>mA bis µA (Schlafmodus)</td><td>einige Watt</td><td>Netzbetrieb</td></tr>
    <tr><td>typischer Einsatz</td><td>Sensorknoten, Geräte, einfache Regelungen</td><td>Gateway, Dashboard, Bildverarbeitung</td><td>Maschinen und Anlagen in der Industrie</td></tr>
  </tbody>
</table>
<p>In der Praxis arbeiten die Klassen zusammen: Mikrocontroller messen und schalten vor Ort, ein Einplatinencomputer sammelt als <em>Gateway</em> die Daten und schickt sie weiter.</p>

<h6>Aufbau eines Mikrocontrollers</h6>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf7/mikrocontroller-aufbau.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Chip mit CPU-Kern, Flash, RAM, Takt und Watchdog, über einen internen Bus verbunden mit den Peripheriemodulen GPIO, ADC, Timer/PWM, UART, I2C und SPI, die über Pins nach außen führen">
  <figcaption class="figure-caption">Alles auf einem Chip: Rechenkern, Speicher und Peripherie</figcaption>
</figure>
<ul>
  <li><strong>Flash</strong>: nichtflüchtiger Programmspeicher – das Programm bleibt nach dem Ausschalten erhalten.</li>
  <li><strong>RAM</strong>: flüchtiger Arbeitsspeicher für Variablen, oft nur wenige Kilobyte. Große Arrays oder Zeichenketten werden schnell zum Problem.</li>
  <li><strong>Watchdog</strong>: ein Zeitgeber, den das Programm regelmäßig zurücksetzen muss. Hängt das Programm, läuft der Watchdog ab und startet den Controller neu.</li>
  <li><strong>Peripherie</strong>: Hardwaremodule, die Aufgaben selbstständig erledigen – der UART empfängt Zeichen, während die CPU etwas anderes rechnet.</li>
</ul>
<p>Viele Pins haben <strong>mehrere Funktionen</strong>: Derselbe Pin kann GPIO, ADC-Eingang oder I²C-Leitung sein. Welche Funktion gilt, legt die Software fest. Die <em>Pinbelegung</em> (Pinout) aus dem Datenblatt gehört deshalb in jede Dokumentation.</p>

<h6>GPIO: digitale Ein- und Ausgänge</h6>
<p>GPIO steht für <em>General Purpose Input/Output</em>. Jeder Pin wird per Software konfiguriert:</p>
<ul>
  <li><strong>Ausgang</strong>: Der Pin liefert HIGH (Versorgungsspannung, z. B. 3,3 V) oder LOW (0 V). Der Strom ist begrenzt – typisch einige bis etwa 20 mA, genaue Grenzwerte pro Pin und für den ganzen Chip stehen im Datenblatt.</li>
  <li><strong>Eingang</strong>: Der Pin liest eine Spannung als HIGH oder LOW. Als Faustregel gilt bei CMOS-Bausteinen: unter etwa 30 % der Versorgungsspannung = LOW, über etwa 70 % = HIGH, dazwischen ist der Zustand undefiniert.</li>
</ul>
<p class="lf-merke"><strong>Merke:</strong> Ein 3,3-V-Controller verträgt an seinen Pins meist keine 5 V. Für die Verbindung mit 5-V-Bausteinen braucht man einen <strong>Pegelwandler</strong> (Level Shifter) oder für reine Eingänge einen Spannungsteiler. Und: Motoren, Relais und Lampen nie direkt an einen GPIO hängen – immer über einen Treiber (<a href="/Learningfields/LF7/kapitel2.php">Kapitel 2</a>).</p>

<h6>Pull-up und Pull-down</h6>
<p>Ein Taster verbindet einen Eingang mit einem Pegel – solange er offen ist, hängt der Eingang aber „in der Luft“. Ein solcher <strong>floatender Eingang</strong> fängt Störungen ein und liefert zufällig HIGH oder LOW. Ein Widerstand zieht ihn deshalb auf einen definierten Ruhepegel:</p>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf7/pullup-pulldown.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Links Pull-up: Widerstand nach 3,3 Volt, Taster nach Masse, nicht gedrückt HIGH, gedrückt LOW. Rechts Pull-down: Taster nach 3,3 Volt, Widerstand nach Masse, nicht gedrückt LOW, gedrückt HIGH">
  <figcaption class="figure-caption">Ruhepegel festlegen: Pull-up (links) und Pull-down (rechts)</figcaption>
</figure>
<ul>
  <li>Beim <strong>Pull-up</strong> ist die Logik umgekehrt (<em>aktiv LOW</em>): gedrückt = LOW. Das ist die häufigste Variante, weil fast alle Mikrocontroller <strong>interne Pull-up-Widerstände</strong> besitzen (typisch einige 10 kΩ), die per Software zugeschaltet werden.</li>
  <li>Der Widerstand begrenzt den Strom bei gedrücktem Taster: 3,3 V / 10 kΩ = 0,33 mA. Ohne ihn wäre ein Kurzschluss zwischen Versorgung und Masse die Folge.</li>
  <li>Auch Busleitungen wie I²C brauchen Pull-up-Widerstände (<a href="/Learningfields/LF7/kapitel5.php">Kapitel 5</a>).</li>
</ul>

<h6>Taster entprellen</h6>
<p>Mechanische Kontakte federn beim Schließen und Öffnen einige Millisekunden nach. Der Mikrocontroller ist schnell genug, jeden dieser Sprünge als eigenen Tastendruck zu zählen.</p>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf7/entprellen.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Das Rohsignal springt nach dem Drücken mehrfach zwischen LOW und HIGH, bevor es stabil HIGH bleibt; das entprellte Signal wechselt erst, nachdem der Pegel 20 Millisekunden stabil war, und nur einmal">
  <figcaption class="figure-caption">Prellen am Pin und entprelltes Signal</figcaption>
</figure>
<p>Lösungen: in <strong>Software</strong> einen neuen Zustand erst übernehmen, wenn er eine Zeit lang (typisch 10–50 ms) stabil ist; in <strong>Hardware</strong> ein RC-Glied mit Schmitt-Trigger-Eingang. Das folgende Arduino-Programm (C++) schaltet eine LED bei jedem Tastendruck um:</p>
<pre class="bg-light border rounded p-3"><code>const int TASTER = 4;                    // Taster gegen GND
const int LED    = 2;
const unsigned long ENTPRELLZEIT = 20;   // ms

int stabil = HIGH;                       // HIGH = nicht gedrückt (Pull-up)
int letzterRohwert = HIGH;
unsigned long letzteAenderung = 0;
bool ledAn = false;

void setup() {
  pinMode(TASTER, INPUT_PULLUP);         // internen Pull-up zuschalten
  pinMode(LED, OUTPUT);
}

void loop() {
  int roh = digitalRead(TASTER);
  if (roh != letzterRohwert) {           // Pegel hat sich geändert – evtl. Prellen
    letzteAenderung = millis();
    letzterRohwert = roh;
  }
  if (millis() - letzteAenderung &gt;= ENTPRELLZEIT &amp;&amp; roh != stabil) {
    stabil = roh;                        // seit 20 ms stabil: übernehmen
    if (stabil == LOW) {                 // aktiv LOW: gedrückt
      ledAn = !ledAn;
      digitalWrite(LED, ledAn ? HIGH : LOW);
    }
  }
}</code></pre>
<p>Das Programm wartet nie mit <code>delay()</code>, sondern vergleicht Zeitstempel. So bleibt <code>loop()</code> schnell und kann nebenbei weitere Aufgaben erledigen (<a href="/Learningfields/LF7/kapitel7.php">Kapitel 7</a>).</p>

<h6>LED mit Vorwiderstand</h6>
<p>Eine LED hat eine nahezu feste <strong>Durchlassspannung</strong> (rot etwa 2 V, blau und weiß etwa 3 V). Ohne Begrenzung würde der Strom so lange steigen, bis LED oder Pin zerstört sind. Der Vorwiderstand nimmt die Differenzspannung auf:</p>
<p class="text-center"><code>R = (U<sub>Versorgung</sub> − U<sub>LED</sub>) / I<sub>LED</sub></code></p>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf7/led-vorwiderstand.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="GPIO mit 3,3 Volt, Widerstand mit 1,3 Volt Spannungsabfall, rote LED mit 2,0 Volt, Masse. Rechnung: 130 Ohm, gewählt 150 Ohm aus der E12-Reihe, 8,7 Milliampere, 11 Milliwatt">
  <figcaption class="figure-caption">Vorwiderstand in vier Schritten</figcaption>
</figure>
<p>Widerstände gibt es nur in <strong>Normwerten</strong>. Die Reihe E12 enthält je Dekade 10, 12, 15, 18, 22, 27, 33, 39, 47, 56, 68, 82. Gewählt wird der nächstgrößere Wert – dann fließt etwas weniger Strom, nie mehr.</p>

<h6>Übungen mit Lösung</h6>
<p>1. Eine rote LED (2,0 V, 15 mA) soll an einem 5-V-Pin leuchten. Berechne den Vorwiderstand und wähle einen E12-Wert. Wie groß ist der Strom dann?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">R = (5 V − 2,0 V) / 0,015 A = 200 Ω → nächstgrößerer E12-Wert 220 Ω. I = 3,0 V / 220 Ω ≈ 13,6 mA.</p>
</details>
<p>2. Eine blaue LED (3,0 V, 20 mA) an 5 V: Welcher Widerstand, welche Verlustleistung?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">R = 2,0 V / 0,020 A = 100 Ω (ist selbst ein E12-Wert). P = 2,0 V · 0,020 A = 40 mW – ein 1/8-W-Widerstand (125 mW) reicht.</p>
</details>
<p>3. Ein Taster ist mit internem Pull-up angeschlossen. Was liefert <code>digitalRead()</code> im Ruhezustand und gedrückt? Was passiert ohne Pull-up?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Ruhezustand HIGH, gedrückt LOW (aktiv LOW). Ohne Pull-up floatet der Eingang bei offenem Taster und liefert zufällige Werte.</p>
</details>
<p>4. Ein Kollege zählt Tastendrücke und wundert sich, dass bei einem Druck manchmal 3 oder 4 gezählt werden. Ursache und Abhilfe?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Der Taster prellt. Abhilfe: in Software entprellen (Zustand erst nach z. B. 20 ms Stabilität übernehmen) oder in Hardware mit RC-Glied und Schmitt-Trigger.</p>
</details>
INHALT,
    'summary' => [
        'Mikrocontroller: CPU, Flash, RAM und Peripherie auf einem Chip – sparsam, sofort startbereit, echtzeitfähig.',
        'Einplatinencomputer laufen mit Linux und eignen sich als Gateway; SPS steuern Industrieanlagen.',
        'GPIO-Ausgänge liefern nur wenige mA; Lasten über Treiber, 5-V-Signale an 3,3-V-Pins nur mit Pegelwandler.',
        'Offene Eingänge floaten; Pull-up (gedrückt = LOW) oder Pull-down (gedrückt = HIGH) legen den Ruhepegel fest.',
        'Mechanische Taster prellen einige ms und müssen in Software oder Hardware entprellt werden.',
        'LED-Vorwiderstand: R = (U − U_LED) / I, nächstgrößerer Normwert aus der E-Reihe.',
    ],
    'quiz' => [
        ['question' => 'Was ist ein floatender Eingang?', 'answer' => 'Ein Eingang ohne definierten Pegel (z. B. bei offenem Taster ohne Pull-Widerstand), der zufällig HIGH oder LOW liest.'],
        ['question' => 'Was liest ein Pin mit Pull-up, wenn der Taster gedrückt ist?', 'answer' => 'LOW – der Taster verbindet den Pin mit Masse (aktiv LOW).'],
        ['question' => 'Wozu dient ein Watchdog?', 'answer' => 'Er startet den Mikrocontroller neu, wenn das Programm hängt und den Watchdog nicht mehr rechtzeitig zurücksetzt.'],
        ['question' => 'Wie berechnet man den Vorwiderstand einer LED?', 'answer' => 'R = (Versorgungsspannung − LED-Durchlassspannung) / gewünschter Strom; dann den nächstgrößeren Normwert wählen.'],
    ],
];
