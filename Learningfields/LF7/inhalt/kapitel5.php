<?php
return [
    'title' => 'Serielle Schnittstellen: UART, USB, I²C und SPI',
    'intro' => 'Sensoren, Displays, Funkmodule und der PC wollen mit dem Mikrocontroller reden – meist über wenige Leitungen, Bit für Bit. Welche Schnittstelle passt, entscheidet über Verdrahtung, Geschwindigkeit und Reichweite. Diese vier begegnen dir ständig.',
    'goals' => [
        'Übertragungsarten unterscheiden: seriell/parallel, synchron/asynchron, simplex/halbduplex/vollduplex',
        'einen UART-Rahmen aufbauen und Übertragungszeiten berechnen',
        'den Zusammenhang von USB und UART erklären',
        'Aufbau und Adressierung des I²C-Busses beschreiben',
        'SPI mit Chip-Select erklären und die passende Schnittstelle für ein Szenario wählen',
    ],
    'content' => <<<'INHALT'
<h6>Grundbegriffe</h6>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th>Begriff</th><th>Bedeutung</th></tr></thead>
  <tbody>
    <tr><td><strong>seriell</strong> / parallel</td><td>Bits nacheinander über eine Leitung bzw. gleichzeitig über viele Leitungen. Seriell spart Leitungen und Pins und ist heute Standard.</td></tr>
    <tr><td><strong>synchron</strong></td><td>Eine eigene Taktleitung sagt dem Empfänger, wann ein Bit gültig ist (I²C, SPI).</td></tr>
    <tr><td><strong>asynchron</strong></td><td>Kein Takt; beide Seiten vereinbaren vorher die Geschwindigkeit, ein Startbit synchronisiert jedes Zeichen (UART).</td></tr>
    <tr><td>simplex / halbduplex / vollduplex</td><td>nur eine Richtung / beide Richtungen abwechselnd / beide Richtungen gleichzeitig</td></tr>
    <tr><td>Punkt-zu-Punkt / Bus</td><td>genau zwei Teilnehmer / viele Teilnehmer an gemeinsamen Leitungen, die adressiert oder ausgewählt werden</td></tr>
  </tbody>
</table>

<h6>UART</h6>
<p>Der <strong>UART</strong> (Universal Asynchronous Receiver Transmitter) ist die einfachste serielle Schnittstelle: eine Sendeleitung <strong>TX</strong>, eine Empfangsleitung <strong>RX</strong> und eine gemeinsame Masse. TX des einen Geräts gehört an RX des anderen – die Leitungen werden <em>gekreuzt</em>.</p>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf7/uart-frame.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Oben Mikrocontroller und GPS-Modul mit gekreuzten TX- und RX-Leitungen und gemeinsamer Masse. Unten der Rahmen für A gleich 0x41 im Format 8N1: Ruhepegel HIGH, Startbit 0, Datenbits 1 0 0 0 0 0 1 0, Stoppbit 1">
  <figcaption class="figure-caption">Verdrahtung und Rahmen eines UART-Zeichens</figcaption>
</figure>
<ul>
  <li>Die Leitung ruht auf <strong>HIGH</strong>. Ein <strong>Startbit</strong> (LOW) kündigt ein Zeichen an.</li>
  <li>Es folgen 5 bis 9 <strong>Datenbits</strong>, das niedrigstwertige Bit (LSB) zuerst.</li>
  <li>Optional ein <strong>Paritätsbit</strong>: Bei gerader Parität (even) wird es so gesetzt, dass die Anzahl der Einsen in Daten + Paritätsbit gerade ist. Es erkennt einzelne Bitfehler, korrigiert sie aber nicht.</li>
  <li>Ein oder zwei <strong>Stoppbits</strong> (HIGH) schließen das Zeichen ab.</li>
</ul>
<p>Die Kurzschreibweise <strong>8N1</strong> bedeutet 8 Datenbits, keine Parität (<em>none</em>), 1 Stoppbit – zusammen mit dem Startbit also <strong>10 Bit pro Byte</strong>. Die <strong>Baudrate</strong> gibt die Schrittgeschwindigkeit an (beim UART gleich Bit/s). Üblich sind 9600 und 115200 Baud.</p>
<p class="text-center"><code>Bytes pro Sekunde = Baudrate / Bits pro Zeichen</code> &nbsp;&nbsp; <code>Dauer = Anzahl Bytes · Bits pro Zeichen / Baudrate</code></p>
<p>Beispiel: 115200 Baud, 8N1 → 115200 / 10 = 11 520 Byte/s. 1 KiB (1024 Byte) bei 9600 Baud dauert 1024 · 10 / 9600 ≈ 1,07 s.</p>
<p class="lf-merke"><strong>Merke:</strong> Stimmen Baudrate oder Format nicht überein, erscheinen im Terminal nur wirre Zeichen. Das ist der häufigste UART-Fehler – gleich danach kommen vertauschte TX/RX-Leitungen und fehlende gemeinsame Masse.</p>
<p>UART beschreibt nur den Rahmen, nicht die Spannung auf der Leitung. Dafür gibt es verschiedene <strong>Pegelstandards</strong>:</p>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th>Standard</th><th>Pegel</th><th>Reichweite</th><th>Einsatz</th></tr></thead>
  <tbody>
    <tr><td>TTL/CMOS-Pegel</td><td>0 V / 3,3 V oder 5 V</td><td>Zentimeter bis wenige Meter</td><td>direkt zwischen Bausteinen auf einer Platine</td></tr>
    <tr><td>RS-232</td><td>±3 bis ±15 V, invertiert (1 = negativ)</td><td>ca. 15 m</td><td>ältere PCs, Messgeräte, Konsolenports von Netzwerkgeräten</td></tr>
    <tr><td>RS-485</td><td>differenziell (Spannungsdifferenz zweier Leitungen)</td><td>bis ca. 1200 m (bei niedriger Datenrate)</td><td>Industrie, Bus mit vielen Teilnehmern, z. B. Modbus RTU</td></tr>
  </tbody>
</table>

<h6>USB und UART – wie hängt das zusammen?</h6>
<p>Moderne PCs haben keine serielle Schnittstelle mehr. Trotzdem spricht die Arduino-IDE über „COM3“ mit dem Board. Möglich macht das ein Wandler:</p>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf7/usb-uart.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="PC mit virtuellem COM-Port, per USB verbunden mit einem USB-UART-Wandler auf dem Board, der über TX und RX mit dem Mikrocontroller verbunden ist">
  <figcaption class="figure-caption">Der USB-UART-Wandler übersetzt zwischen beiden Welten</figcaption>
</figure>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th></th><th>UART</th><th>USB</th></tr></thead>
  <tbody>
    <tr><td>Leitungen</td><td>TX, RX, GND</td><td>D+ und D− (differenziell), VBUS (5 V), GND; ab USB 3 zusätzliche Paare</td></tr>
    <tr><td>Prinzip</td><td>asynchron, Zeichen für Zeichen</td><td>paketbasiert; der Host fragt die Geräte ab</td></tr>
    <tr><td>Rollen</td><td>gleichberechtigt</td><td>Host (PC) und Device (Gerät)</td></tr>
    <tr><td>Anmeldung</td><td>keine – Einstellungen vorher vereinbaren</td><td>Plug and Play: Das Gerät meldet sich mit Klasse und Kennung an (Enumeration)</td></tr>
    <tr><td>Geschwindigkeit</td><td>typisch bis einige hundert kBaud</td><td>1,5 / 12 / 480 Mbit/s (USB 2.0), ab 5 Gbit/s (USB 3.x), bis 80 Gbit/s (USB4)</td></tr>
    <tr><td>Stromversorgung</td><td>nein</td><td>ja: 5 V mit 500 mA (USB 2.0) bzw. 900 mA (USB 3.x), mit USB Power Delivery bis 240 W</td></tr>
    <tr><td>Komplexität</td><td>sehr einfach, in jedem Mikrocontroller</td><td>aufwendiges Protokoll, eigener Controller nötig</td></tr>
  </tbody>
</table>
<p>Ein Gerät, das sich als <strong>USB-CDC</strong> (Communication Device Class) anmeldet, erscheint im Betriebssystem als virtueller COM-Port – egal, ob ein separater Wandlerchip oder der Mikrocontroller selbst USB spricht.</p>

<h6>I²C</h6>
<p><strong>I²C</strong> (Inter-Integrated Circuit, gesprochen „I-Quadrat-C“) verbindet viele Bausteine auf einer Platine mit nur zwei Leitungen: <strong>SDA</strong> (Daten) und <strong>SCL</strong> (Takt). Ein <em>Controller</em> (früher „Master“) erzeugt den Takt und spricht <em>Targets</em> (früher „Slaves“) über ihre Adresse an.</p>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf7/i2c-bus.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Controller und drei Targets mit den Adressen 0x76, 0x3C und 0x68 an den gemeinsamen Leitungen SDA und SCL mit Pull-up-Widerständen; darunter ein Telegramm aus Start, 7-Bit-Adresse, R/W, ACK, Daten, ACK, Stopp">
  <figcaption class="figure-caption">Zwei Leitungen, viele Teilnehmer – unterschieden durch Adressen</figcaption>
</figure>
<ul>
  <li><strong>Pull-up-Widerstände</strong> (z. B. 4,7 kΩ) ziehen beide Leitungen auf HIGH. Die Teilnehmer können eine Leitung nur auf LOW ziehen (Open-Drain). So kann kein Kurzschluss entstehen, wenn zwei gleichzeitig senden.</li>
  <li><strong>Adressen</strong>: meist 7 Bit. Von den 128 Werten sind 16 reserviert, 112 bleiben nutzbar. Die Adresse steht im Datenblatt; oft lässt sie sich über einen Pin zwischen zwei Werten umschalten.</li>
  <li><strong>Ablauf</strong>: Startbedingung, 7-Bit-Adresse plus R/W-Bit (0 = schreiben, 1 = lesen), das Target bestätigt mit <strong>ACK</strong>, dann Datenbytes mit je einem ACK, Stoppbedingung. Antwortet niemand, bleibt die Leitung HIGH (<strong>NACK</strong>) – ein guter Test, ob ein Gerät angeschlossen ist („I²C-Scanner“).</li>
  <li><strong>Geschwindigkeit</strong>: 100 kbit/s (Standard Mode), 400 kbit/s (Fast Mode), 1 Mbit/s (Fast Mode Plus).</li>
  <li><strong>Reichweite</strong>: gedacht für eine Platine oder kurze Kabel; lange Leitungen verschleifen die Flanken.</li>
</ul>
<p>Beispiel: Das Adressbyte zum <em>Schreiben</em> an 0x76 lautet 0x76 · 2 + 0 = 0xEC, zum <em>Lesen</em> 0xED – die 7-Bit-Adresse wird um eine Stelle nach links geschoben und das R/W-Bit angehängt.</p>

<h6>SPI</h6>
<p><strong>SPI</strong> (Serial Peripheral Interface) ist schneller und einfacher als I²C, braucht aber mehr Leitungen:</p>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf7/spi-bus.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Controller mit gemeinsamen Leitungen SCLK, MOSI und MISO zu Display und SD-Karte sowie je einer eigenen Chip-Select-Leitung CS1 und CS2">
  <figcaption class="figure-caption">SPI: gemeinsame Daten- und Taktleitungen, je Gerät ein Chip-Select</figcaption>
</figure>
<ul>
  <li><strong>SCLK</strong>: Takt vom Controller. <strong>MOSI</strong> (Controller Out, Peripheral In, auch COPI/SDO) und <strong>MISO</strong> (Controller In, Peripheral Out, auch CIPO/SDI): Daten in beide Richtungen gleichzeitig – <em>vollduplex</em>.</li>
  <li><strong>CS</strong> (Chip Select, auch SS): je Gerät eine eigene Leitung, aktiv LOW. Statt Adressen wählt der Controller das Gerät elektrisch aus. Bei vielen Geräten werden die Pins knapp.</li>
  <li>Keine Bestätigung (ACK), kein festes Protokoll – das Datenblatt des Geräts legt fest, welche Bytes was bedeuten, und welcher der vier <strong>SPI-Modi</strong> (Taktpolarität und -phase) gilt.</li>
  <li>Taktraten bis in den zweistelligen MHz-Bereich: ideal für Displays, SD-Karten, Flash-Speicher und schnelle ADCs.</li>
</ul>

<h6>Vergleich und Auswahl</h6>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th></th><th>UART</th><th>I²C</th><th>SPI</th><th>RS-485</th><th>CAN</th></tr></thead>
  <tbody>
    <tr><td>Leitungen (+ GND)</td><td>2 (TX, RX)</td><td>2 (SDA, SCL)</td><td>3 + 1 CS je Gerät</td><td>2 (A, B)</td><td>2 (CAN-H, CAN-L)</td></tr>
    <tr><td>Takt</td><td>asynchron</td><td>synchron</td><td>synchron</td><td>asynchron</td><td>asynchron</td></tr>
    <tr><td>Teilnehmer</td><td>2</td><td>viele (Adressen)</td><td>viele (Chip-Select)</td><td>viele (Bus)</td><td>viele (Nachrichten-IDs)</td></tr>
    <tr><td>Duplex</td><td>voll</td><td>halb</td><td>voll</td><td>meist halb</td><td>halb</td></tr>
    <tr><td>Tempo (typisch)</td><td>9,6–115,2 kBaud</td><td>100–400 kbit/s</td><td>1–50 MHz</td><td>bis Mbit/s</td><td>bis 1 Mbit/s, CAN FD mehr</td></tr>
    <tr><td>Reichweite</td><td>kurz (TTL)</td><td>Platine</td><td>Platine</td><td>bis ca. 1200 m</td><td>ca. 40 m bei 1 Mbit/s</td></tr>
    <tr><td>Beispiel</td><td>GPS-Modul, Debug-Ausgabe</td><td>Sensoren, kleine Displays</td><td>TFT-Display, SD-Karte</td><td>Modbus RTU in Anlagen</td><td>Fahrzeuge, Maschinen</td></tr>
  </tbody>
</table>
<p class="lf-pruefung"><strong>Prüfungstipp:</strong> Bei Auswahlfragen auf Stichworte achten: „wenige Pins, mehrere Sensoren auf der Platine“ → I²C. „hohe Datenrate, Display, Speicherkarte“ → SPI. „zwei Geräte, Text oder NMEA-Daten“ → UART. „lange Strecke in der Halle, mehrere Geräte“ → RS-485. „Fahrzeug, Priorität von Nachrichten“ → CAN.</p>

<h6>Übungen mit Lösung</h6>
<p>1. Wie lange dauert die Übertragung von 2048 Byte bei 115200 Baud im Format 8N1?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">2048 · 10 Bit / 115200 Bit/s ≈ 0,178 s = 178 ms.</p>
</details>
<p>2. Gib die Bitfolge auf der Leitung für das Zeichen „K“ (0x4B) im Format 8E1 an (gerade Parität).</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">0x4B = 0100 1011. LSB zuerst: 1 1 0 1 0 0 1 0. Die Daten enthalten vier Einsen (gerade) → Paritätsbit 0. Gesamt: Start 0 | 1 1 0 1 0 0 1 0 | Parität 0 | Stopp 1 – also 11 Bit pro Zeichen.</p>
</details>
<p>3. Um wie viel sinkt der Nutzdatendurchsatz bei 115200 Baud, wenn statt 8N1 das Format 8E1 verwendet wird?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">8N1: 115200 / 10 = 11 520 Byte/s. 8E1: 115200 / 11 ≈ 10 473 Byte/s. Das sind rund 9 % weniger.</p>
</details>
<p>4. Im Gewächshaus sollen zwei baugleiche Klimasensoren mit der festen Adresse 0x76 an denselben I²C-Bus. Was passiert, und welche Lösungen gibt es?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Beide würden auf dieselbe Adresse antworten – die Daten kollidieren. Lösungen: Adress-Pin eines Sensors umlegen (z. B. auf 0x77), einen I²C-Multiplexer einsetzen oder einen zweiten I²C-Bus des Controllers nutzen.</p>
</details>
<p>5. Wähle eine Schnittstelle: (a) GPS-Modul an Mikrocontroller, (b) Farbdisplay mit hoher Bildrate, (c) 20 Energiezähler in einer 300 m langen Halle, (d) Temperatur-, Druck- und Lichtsensor auf einer kleinen Platine.</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">(a) UART. (b) SPI. (c) RS-485, z. B. mit Modbus RTU. (d) I²C.</p>
</details>
INHALT,
    'summary' => [
        'Seriell = Bits nacheinander; synchron mit Taktleitung (I²C, SPI), asynchron mit vereinbarter Baudrate (UART).',
        'UART: TX/RX gekreuzt, gemeinsame Masse; Rahmen Start – Daten (LSB zuerst) – Parität – Stopp; 8N1 = 10 Bit pro Byte.',
        'Dauer = Bytes · Bits pro Zeichen / Baudrate; Pegel: TTL, RS-232 oder RS-485.',
        'USB ist paketbasiert mit Host und Device; ein USB-UART-Wandler oder USB-CDC liefert dem PC einen virtuellen COM-Port.',
        'I²C: SDA und SCL mit Pull-ups, 7-Bit-Adressen (112 nutzbar), ACK/NACK, 100/400 kbit/s, für kurze Strecken.',
        'SPI: SCLK, MOSI, MISO plus Chip-Select je Gerät, vollduplex und schnell, ohne Adressen und ohne ACK.',
    ],
    'quiz' => [
        ['question' => 'Was bedeutet 8N1?', 'answer' => '8 Datenbits, keine Parität, 1 Stoppbit – mit Startbit 10 Bit pro Zeichen.'],
        ['question' => 'Warum braucht der I²C-Bus Pull-up-Widerstände?', 'answer' => 'Die Teilnehmer können die Leitungen nur auf LOW ziehen (Open-Drain); die Pull-ups sorgen für den HIGH-Pegel.'],
        ['question' => 'Wie wählt der SPI-Controller ein Gerät aus?', 'answer' => 'Über eine eigene Chip-Select-Leitung je Gerät, die auf LOW gezogen wird.'],
        ['question' => 'Wie kommuniziert ein PC ohne serielle Schnittstelle mit einem UART?', 'answer' => 'Über einen USB-UART-Wandler (oder USB-CDC), der im Betriebssystem als virtueller COM-Port erscheint.'],
    ],
];
