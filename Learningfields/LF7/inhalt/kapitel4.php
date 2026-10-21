<?php
return [
    'title' => 'Pulsweitenmodulation (PWM)',
    'intro' => 'Ein digitaler Pin kennt nur an und aus. Trotzdem dimmt derselbe Pin eine LED stufenlos, regelt die Drehzahl eines Lüfters und stellt einen Servo auf 37 Grad. Der Trick heißt Pulsweitenmodulation: sehr schnell ein- und ausschalten und dabei das Verhältnis verändern.',
    'goals' => [
        'Periodendauer, Frequenz, Einschaltdauer und Tastgrad unterscheiden und berechnen',
        'den Mittelwert von Spannung und Leistung eines PWM-Signals bestimmen',
        'PWM-Werte mit 8-Bit-Auflösung umrechnen',
        'eine passende PWM-Frequenz für LED, Motor und Servo wählen',
        'die Impulslänge für einen Servowinkel bestimmen',
    ],
    'content' => <<<'INHALT'
<h6>Das Prinzip</h6>
<p>Bei der <strong>Pulsweitenmodulation</strong> schaltet ein Pin periodisch zwischen LOW und HIGH. Die <em>Frequenz</em> bleibt fest, verändert wird nur, wie lange der Pin in jeder Periode eingeschaltet ist. Weil das so schnell geschieht, „sieht“ die Last nur den Mittelwert: Das Auge mittelt das Flackern der LED, die Masse des Motors mittelt die Kraftstöße.</p>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf7/pwm-tastgrad.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Drei Rechtecksignale mit gleicher Periode und Tastgrad 25, 50 und 75 Prozent; die Mittelwerte bei 5 Volt betragen 1,25, 2,5 und 3,75 Volt">
  <figcaption class="figure-caption">Gleiche Frequenz, unterschiedliche Einschaltdauer</figcaption>
</figure>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th>Größe</th><th>Formel</th><th>Beispiel</th></tr></thead>
  <tbody>
    <tr><td>Periodendauer T</td><td>T = 1 / f</td><td>f = 1 kHz → T = 1 ms = 1000 µs</td></tr>
    <tr><td>Tastgrad (Duty Cycle) D</td><td>D = t<sub>ein</sub> / T</td><td>t<sub>ein</sub> = 300 µs → D = 30 %</td></tr>
    <tr><td>Einschaltdauer t<sub>ein</sub></td><td>t<sub>ein</sub> = D · T</td><td>30 % von 1000 µs = 300 µs</td></tr>
    <tr><td>mittlere Spannung</td><td>U<sub>Ø</sub> = D · U<sub>max</sub></td><td>25 % von 5 V = 1,25 V</td></tr>
    <tr><td>mittlere Leistung (ohmsche Last)</td><td>P<sub>Ø</sub> = D · P<sub>max</sub></td><td>30 % von 24 W = 7,2 W</td></tr>
  </tbody>
</table>
<p class="lf-merke"><strong>Merke:</strong> Der Tastgrad bestimmt den Mittelwert, die Frequenz bestimmt nur, wie „glatt“ das Ergebnis wirkt. 50 % bei 100 Hz und 50 % bei 10 kHz liefern denselben Mittelwert.</p>

<h6>Warum PWM statt Vorwiderstand?</h6>
<p>Man könnte eine LED auch mit einem Potenziometer dimmen. Dann verheizt der Widerstand aber die Differenzleistung. Bei PWM ist der Transistor entweder <em>voll an</em> (kaum Spannung über ihm) oder <em>voll aus</em> (kein Strom) – in beiden Fällen entsteht fast keine Verlustleistung. PWM ist deshalb die Standardmethode für Motoren, Heizungen, Lüfter und LED-Beleuchtung und steckt auch in jedem Schaltnetzteil.</p>

<h6>PWM im Mikrocontroller</h6>
<p>PWM-Signale erzeugen die <strong>Timer</strong> in Hardware: Ein Zähler läuft mit dem Systemtakt hoch, beim Vergleichswert schaltet der Pin um, beim Überlauf beginnt die nächste Periode. Die CPU muss sich nicht darum kümmern.</p>
<ul>
  <li><strong>Auflösung</strong>: Bei 8 Bit gibt es 256 Stufen (0–255). Der Wert 64 ergibt D = 64 / 255 ≈ 25,1 %, bei 3,3 V also etwa 0,83 V im Mittel. Auf dem Arduino heißt die Funktion <code>analogWrite(pin, wert)</code> – trotz des Namens ist das Signal digital.</li>
  <li><strong>Frequenz und Auflösung hängen zusammen</strong>: Bei einem einfachen Timer gilt f<sub>PWM</sub> = f<sub>Takt</sub> / (Vorteiler · 2<sup>n</sup>). Mit 16 MHz, Vorteiler 64 und 8 Bit ergibt das 16 000 000 / (64 · 256) ≈ 977 Hz. Mehr Bits bedeuten bei gleichem Takt eine niedrigere Frequenz.</li>
</ul>

<h6>Welche Frequenz?</h6>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th>Last</th><th>typische Frequenz</th><th>Grund</th></tr></thead>
  <tbody>
    <tr><td>LED</td><td>einige hundert Hz bis einige kHz</td><td>darunter sichtbares Flimmern, besonders bei Bewegung und in Kameraaufnahmen</td></tr>
    <tr><td>Gleichstrommotor, Lüfter</td><td>ca. 1–25 kHz, oft über 20 kHz</td><td>unter 20 kHz kann die Wicklung hörbar pfeifen</td></tr>
    <tr><td>Heizelement</td><td>sehr niedrig, auch unter 1 Hz</td><td>die Wärme reagiert träge; seltenes Schalten schont Relais</td></tr>
    <tr><td>Servo</td><td>50 Hz (Periode 20 ms)</td><td>die Impulslänge kodiert den Winkel</td></tr>
  </tbody>
</table>

<h6>Servos</h6>
<p>Ein Modellbau-Servo enthält Motor, Getriebe, Potenziometer und eine eigene Regelung. Es erwartet alle 20 ms einen Impuls; dessen <strong>Länge</strong> gibt den Sollwinkel vor:</p>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf7/servo-pwm.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Impulse alle 20 Millisekunden: 1 Millisekunde ergibt 0 Grad, 1,5 Millisekunden 90 Grad, 2 Millisekunden 180 Grad; rechts die zugehörigen Hebelstellungen">
  <figcaption class="figure-caption">Impulslänge bestimmt den Winkel (typische Werte, Datenblatt beachten)</figcaption>
</figure>
<p>Zwischen den Eckwerten wird linear interpoliert: <code>Winkel = (t<sub>Impuls</sub> − 1 ms) / 1 ms · 180°</code>. Viele Servos nutzen einen etwas größeren Bereich (etwa 0,5–2,5 ms) – über die Grenzen hinaus fährt das Getriebe gegen den Anschlag. Servos brauchen beim Anlaufen viel Strom und deshalb eine eigene Versorgung; nur die Masse wird mit dem Mikrocontroller verbunden.</p>

<h6>Motoren: Drehzahl und Richtung</h6>
<ul>
  <li><strong>Drehzahl</strong>: PWM an einem MOSFET (Low-Side-Schalter) mit Freilaufdiode über dem Motor.</li>
  <li><strong>Richtung</strong>: Eine <strong>H-Brücke</strong> aus vier Schaltern kann die Polarität am Motor umkehren. Fertige Treiber-ICs enthalten H-Brücke, Schutzdioden und Übertemperaturschutz; der Mikrocontroller gibt nur PWM und Richtung vor.</li>
  <li><strong>Regelung</strong>: Soll die Drehzahl unter Last konstant bleiben, misst ein Drehgeber (Encoder) die Ist-Drehzahl, und die Software passt den Tastgrad an – ein Regelkreis wie in <a href="/Learningfields/LF7/kapitel1.php">Kapitel 1</a>.</li>
</ul>
<p>Tipp: Wird ein PWM-Signal über einen Tiefpass (Widerstand + Kondensator) geglättet, entsteht eine echte Gleichspannung – ein einfacher Digital-Analog-Wandler.</p>

<h6>Übungen mit Lösung</h6>
<p>1. Ein 12-V-Lüfter wird mit PWM bei 500 Hz und 40 % Tastgrad betrieben. Berechne Periodendauer, Einschaltdauer und mittlere Spannung.</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">T = 1 / 500 Hz = 2 ms. t<sub>ein</sub> = 0,4 · 2 ms = 0,8 ms. U<sub>Ø</sub> = 0,4 · 12 V = 4,8 V. (500 Hz liegt im hörbaren Bereich – ein Lüfter könnte damit summen.)</p>
</details>
<p>2. Ein 8-Bit-PWM-Ausgang an 5 V erhält den Wert 191. Wie groß sind Tastgrad und mittlere Spannung?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">D = 191 / 255 ≈ 74,9 %. U<sub>Ø</sub> ≈ 0,749 · 5 V ≈ 3,75 V.</p>
</details>
<p>3. Ein Servo (1 ms = 0°, 2 ms = 180°, 50 Hz) erhält Impulse von 1,25 ms. Welcher Winkel und welcher Tastgrad ergeben sich?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Winkel = (1,25 − 1) / 1 · 180° = 45°. Tastgrad = 1,25 ms / 20 ms = 6,25 %.</p>
</details>
<p>4. Eine 24-W-Heizfolie im Gewächshaus soll im Mittel 7,2 W liefern. Welcher Tastgrad ist nötig, und warum genügt hier eine Frequenz unter 1 Hz?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">D = 7,2 W / 24 W = 30 %. Die Temperatur der Folie ändert sich nur langsam; selbst Schaltperioden von mehreren Sekunden mitteln sich aus. Bei Relais spart das zudem Schaltspiele.</p>
</details>
INHALT,
    'summary' => [
        'PWM: feste Frequenz, veränderliche Einschaltdauer; die Last mittelt das Signal.',
        'T = 1/f, Tastgrad D = t_ein / T, U_Ø = D · U_max, P_Ø = D · P_max (ohmsche Last).',
        'PWM ist verlustarm, weil der Schalter nur voll an oder voll aus ist.',
        'Timer erzeugen PWM in Hardware; 8 Bit = 256 Stufen; höhere Auflösung senkt bei gleichem Takt die Frequenz.',
        'Frequenzwahl: LED > einige hundert Hz, Motoren oft > 20 kHz, Servos 50 Hz.',
        'Servo: Impulslänge 1–2 ms (typisch) kodiert 0–180°; Richtungsumkehr bei Motoren über eine H-Brücke.',
    ],
    'quiz' => [
        ['question' => 'Was ist der Tastgrad eines PWM-Signals?', 'answer' => 'Das Verhältnis von Einschaltdauer zu Periodendauer, D = t_ein / T, meist in Prozent.'],
        ['question' => 'Welche mittlere Spannung liefert PWM mit 25 % an 5 V?', 'answer' => '1,25 V.'],
        ['question' => 'Mit welcher Frequenz wird ein typischer Servo angesteuert?', 'answer' => 'Mit 50 Hz, also alle 20 ms ein Impuls von etwa 1 bis 2 ms Länge.'],
        ['question' => 'Wozu dient eine H-Brücke?', 'answer' => 'Sie kann die Polarität an einem Gleichstrommotor umkehren und ihn so in beide Richtungen drehen lassen.'],
    ],
];
