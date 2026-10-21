<?php
return [
    'title' => 'Software für cyber-physische Systeme',
    'intro' => 'Software für ein CPS läuft jahrelang ohne Neustart, reagiert auf Ereignisse in Millisekunden, kommt mit Sensorfehlern zurecht und soll dabei möglichst wenig Strom verbrauchen. Dafür gibt es bewährte Muster: Interrupts, Zustandsautomaten, Regler mit Hysterese, Filter und Schlafmodi.',
    'goals' => [
        'Superloop, Interrupts und Echtzeitbetriebssystem vergleichen',
        'Regeln für Interrupt-Service-Routinen anwenden',
        'eine Steuerung als Zustandsautomat entwerfen und programmieren',
        'eine Zweipunktregelung mit Hysterese umsetzen',
        'Messwerte filtern und auf Plausibilität prüfen',
        'den Durchschnittsstrom und die Batterielaufzeit eines Sensorknotens berechnen',
    ],
    'content' => <<<'INHALT'
<h6>Programmstrukturen</h6>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th>Struktur</th><th>Prinzip</th><th>Vorteile</th><th>Nachteile</th></tr></thead>
  <tbody>
    <tr><td><strong>Superloop</strong> (Endlosschleife)</td><td>eine Schleife fragt alle Eingänge nacheinander ab (Polling) und erledigt die Aufgaben</td><td>einfach, gut nachvollziehbar</td><td>Reaktionszeit hängt von der Schleifendauer ab; ein <code>delay()</code> blockiert alles</td></tr>
    <tr><td><strong>Interrupts</strong></td><td>die Hardware unterbricht das Hauptprogramm bei einem Ereignis und startet eine Interrupt-Service-Routine (ISR)</td><td>sofortige Reaktion, kein Ereignis geht verloren, Schlafen bis zum Ereignis möglich</td><td>gemeinsam genutzte Daten erfordern Sorgfalt</td></tr>
    <tr><td><strong>Echtzeitbetriebssystem</strong> (RTOS)</td><td>mehrere Tasks mit Prioritäten, ein Scheduler teilt die CPU zu</td><td>strukturiert bei vielen parallelen Aufgaben, Zeitgarantien</td><td>mehr Speicherbedarf, neue Fehlerquellen (z. B. Deadlocks)</td></tr>
  </tbody>
</table>
<p>In der Praxis werden die Ansätze kombiniert: Eine Superloop arbeitet die Aufgaben ab, Interrupts erfassen schnelle Ereignisse, Timer liefern den Takt. Freie RTOS-Beispiele sind FreeRTOS und Zephyr.</p>
<p><strong>Regeln für Interrupt-Service-Routinen:</strong></p>
<ul>
  <li><strong>Kurz halten</strong>: nur das Nötigste tun (Zähler erhöhen, Flag setzen). Keine Wartezeiten, keine Ausgaben über die serielle Schnittstelle.</li>
  <li>Variablen, die ISR und Hauptprogramm gemeinsam nutzen, als <code>volatile</code> deklarieren – sonst hält der Compiler sie womöglich in einem Register und das Hauptprogramm sieht die Änderung nie.</li>
  <li>Mehrbyte-Werte im Hauptprogramm <strong>atomar</strong> lesen: Interrupts kurz sperren, Wert kopieren, wieder freigeben.</li>
</ul>
<p>Beispiel: Ein Durchflusssensor liefert pro Liter Wasser eine feste Zahl von Impulsen. Die ISR zählt sie, das Hauptprogramm rechnet einmal pro Sekunde um:</p>
<pre class="bg-light border rounded p-3"><code>volatile unsigned long impulse = 0;      // wird in der ISR verändert

void zaehle() {                          // Interrupt-Service-Routine: kurz!
  impulse++;
}

void setup() {
  pinMode(3, INPUT_PULLUP);
  attachInterrupt(digitalPinToInterrupt(3), zaehle, FALLING);
}

void loop() {
  static unsigned long letzteMessung = 0;
  if (millis() - letzteMessung &gt;= 1000) {
    letzteMessung += 1000;
    noInterrupts();                      // atomar kopieren und zurücksetzen
    unsigned long n = impulse;
    impulse = 0;
    interrupts();
    float literProMinute = n / 7.5;      // laut Datenblatt: 7,5 Hz je l/min
    // ... anzeigen oder senden
  }
}</code></pre>

<h6>Zustandsautomaten</h6>
<p>Viele Steuerungen haben <em>Phasen</em>: warten, arbeiten, abkühlen, Fehler. Ein <strong>Zustandsautomat</strong> (State Machine) beschreibt sie mit <strong>Zuständen</strong>, <strong>Übergängen</strong> (ausgelöst durch Ereignisse oder Bedingungen) und <strong>Aktionen</strong>. Notation an den Pfeilen: <code>Ereignis [Bedingung] / Aktion</code>.</p>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf7/zustandsautomat.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Zustände BEREIT, BEWÄSSERN und VERSICKERN im Normalbetrieb; Boden unter 30 Prozent öffnet das Ventil, nach 5 Minuten oder bei 45 Prozent schließt es, nach 30 Minuten zurück zu BEREIT; Sensorfehler oder leerer Tank führen zu STÖRUNG, Quittieren zurück zu BEREIT">
  <figcaption class="figure-caption">Bewässerung im Gewächshaus als Zustandsautomat</figcaption>
</figure>
<pre class="bg-light border rounded p-3"><code>enum Zustand { BEREIT, BEWAESSERN, VERSICKERN, STOERUNG };
Zustand zustand = BEREIT;
unsigned long seit = 0;                  // Zeitpunkt des letzten Wechsels

void wechsle(Zustand neu) { zustand = neu; seit = millis(); }

void schritt(float boden, bool sensorOk, bool tankOk, bool quittiert) {
  if (zustand != STOERUNG &amp;&amp; (!sensorOk || !tankOk)) {
    ventil(false); alarm(); wechsle(STOERUNG);
    return;
  }
  unsigned long dauer = millis() - seit;
  switch (zustand) {
    case BEREIT:
      if (boden &lt; 30) { ventil(true); wechsle(BEWAESSERN); }
      break;
    case BEWAESSERN:
      if (dauer &gt;= 5UL * 60 * 1000 || boden &gt;= 45) { ventil(false); wechsle(VERSICKERN); }
      break;
    case VERSICKERN:
      if (dauer &gt;= 30UL * 60 * 1000) wechsle(BEREIT);
      break;
    case STOERUNG:
      if (quittiert &amp;&amp; sensorOk &amp;&amp; tankOk) wechsle(BEREIT);
      break;
  }
}</code></pre>
<p>Vorteile: Jeder Zustand ist eindeutig, jede Reaktion steht an genau einer Stelle, und der Automat lässt sich ohne Hardware testen, indem man <code>schritt()</code> mit erfundenen Werten aufruft. Wichtig ist der <strong>sichere Zustand</strong>: Bei einem Fehler wird das Ventil geschlossen – lieber eine vertrocknete Pflanze als ein überflutetes Gewächshaus.</p>

<h6>Zweipunktregelung mit Hysterese</h6>
<p>Der einfachste Regler kennt nur <em>an</em> und <em>aus</em>: Heizung, Kühlschrankkompressor, Pumpe. Schaltet er genau beim Sollwert, flattert das Relais bei 21,0 °C ständig hin und her. Die Lösung ist eine <strong>Hysterese</strong> – zwei Schwellen statt einer:</p>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf7/zweipunkt-hysterese.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Temperaturverlauf, der zwischen 20 und 22 Grad pendelt; die Heizung schaltet bei 20 Grad ein und bei 22 Grad aus; darunter die Einschaltzeiten der Heizung">
  <figcaption class="figure-caption">Sollwert 21 °C, Hysterese 2 K: ein bei 20 °C, aus bei 22 °C</figcaption>
</figure>
<pre class="bg-light border rounded p-3"><code>const float EIN = 20.0, AUS = 22.0;      // Sollwert 21 °C, Hysterese 2 K
bool heizung = false;

void regle(float temp) {
  if (temp &lt;= EIN)      heizung = true;
  else if (temp &gt;= AUS) heizung = false;
  // dazwischen: bisherigen Zustand beibehalten
  digitalWrite(RELAIS, heizung ? HIGH : LOW);
}</code></pre>
<p>Eine größere Hysterese bedeutet seltener schalten (schont Relais und Kompressor), aber größere Schwankungen. Für feinere Regelungen gibt es <strong>stetige Regler</strong>, die eine Stellgröße zwischen 0 und 100 % ausgeben (z. B. über PWM). Am bekanntesten ist der <strong>PID-Regler</strong>:</p>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th>Anteil</th><th>reagiert auf</th><th>Wirkung</th></tr></thead>
  <tbody>
    <tr><td>P (proportional)</td><td>die aktuelle Regelabweichung</td><td>große Abweichung → starkes Stellsignal; allein bleibt oft eine Restabweichung</td></tr>
    <tr><td>I (integral)</td><td>die über die Zeit aufsummierte Abweichung</td><td>beseitigt die Restabweichung, kann aber zum Überschwingen führen</td></tr>
    <tr><td>D (differenzial)</td><td>die Änderungsgeschwindigkeit der Abweichung</td><td>dämpft, reagiert vorausschauend auf schnelle Änderungen</td></tr>
  </tbody>
</table>

<h6>Messwerte aufbereiten</h6>
<p>Sensorwerte rauschen und enthalten Ausreißer. Zwei einfache Filter:</p>
<ul>
  <li><strong>Gleitender Mittelwert</strong>: Mittelwert der letzten n Werte. Glättet Rauschen, wird aber von Ausreißern verzogen.</li>
  <li><strong>Median</strong>: der mittlere Wert der sortierten letzten n Werte. Ignoriert einzelne Ausreißer.</li>
</ul>
<p>Beispiel mit den Werten 21,2 – 21,4 – 25,9 – 21,3 – 21,5 °C: Der Mittelwert ist 22,26 °C (der Ausreißer 25,9 zieht ihn hoch), der Median ist 21,4 °C.</p>
<p>Dazu kommen <strong>Plausibilitätsprüfungen</strong>: Liegt der Wert im möglichen Bereich? Ist die Änderung physikalisch möglich (ein Gewächshaus wird nicht in einer Sekunde 5 K wärmer)? Kommt überhaupt noch ein Wert (Zeitüberschreitung)? Bei einem Fehler geht das System in einen sicheren Zustand und meldet sich.</p>

<h6>Energie sparen</h6>
<p>Ein batteriebetriebener Sensorknoten verbringt die meiste Zeit im <strong>Tiefschlaf</strong>. Er wacht per Timer oder Interrupt auf, misst, funkt und schläft wieder. Entscheidend ist der Durchschnittsstrom:</p>
<p class="text-center"><code>I<sub>Ø</sub> = (I<sub>aktiv</sub> · t<sub>aktiv</sub> + I<sub>schlaf</sub> · t<sub>schlaf</sub>) / T</code> &nbsp;&nbsp; <code>Laufzeit = Kapazität / I<sub>Ø</sub></code></p>
<p>Beispiel: 50 mA für 1 s, danach 59 s Schlaf mit 0,02 mA. I<sub>Ø</sub> = (50 · 1 + 0,02 · 59) / 60 ≈ 0,853 mA. Mit 2000 mAh: 2000 / 0,853 ≈ 2345 h ≈ 98 Tage. Ohne Schlafmodus wären es 2000 / 50 = 40 h.</p>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf7/energie-bilanz.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Oben ein schematischer Stromverlauf mit kurzen Aktivphasen und langen Schlafphasen. Unten Laufzeiten mit 2000 Milliamperestunden: ohne Schlafmodus 1,7 Tage, Messung jede Minute 97,7 Tage, alle 5 Minuten 446,6 Tage, alle 10 Minuten 806,7 Tage">
  <figcaption class="figure-caption">Seltener aufwachen verlängert die Laufzeit um ein Vielfaches</figcaption>
</figure>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th>Messintervall</th><th>Durchschnittsstrom</th><th>Laufzeit (2000 mAh)</th></tr></thead>
  <tbody>
    <tr><td>ohne Schlafmodus</td><td>50 mA</td><td>40 h ≈ 1,7 Tage</td></tr>
    <tr><td>1 Minute</td><td>0,853 mA</td><td>≈ 97,7 Tage</td></tr>
    <tr><td>5 Minuten</td><td>0,187 mA</td><td>≈ 446,6 Tage</td></tr>
    <tr><td>10 Minuten</td><td>0,103 mA</td><td>≈ 806,7 Tage</td></tr>
  </tbody>
</table>
<p>Weitere Stellschrauben: Werte sammeln und gebündelt senden, Sensoren über einen GPIO nur bei Bedarf versorgen, Status-LEDs weglassen, Spannungsregler mit geringem Ruhestrom wählen. Reale Batterien liefern bei Kälte und durch Selbstentladung weniger – plane 20–30 % Reserve ein.</p>

<h6>Testen</h6>
<ul>
  <li><strong>Unit-Tests auf dem PC</strong> für Logik ohne Hardware: Zustandsautomat, Filter, Umrechnungen.</li>
  <li><strong>Simulation und Mocks</strong>: Sensorwerte aus einer Datei einspielen, Grenzfälle (Sensor tot, Wert springt) gezielt erzeugen.</li>
  <li><strong>Hardware-in-the-Loop</strong> (HIL): die echte Steuerung an einen simulierten Prozess anschließen – sicherer als am echten Kessel zu testen.</li>
  <li><strong>Feldtest</strong> und <strong>Logging</strong>: im Probebetrieb Fehlerzähler, Neustarts (Watchdog!) und Batteriespannung mitschreiben.</li>
</ul>

<h6>Übungen mit Lösung</h6>
<p>1. Ein Sensorknoten braucht 80 mA für 2 s alle 15 Minuten und schläft sonst mit 10 µA. Wie lange hält eine Batterie mit 2600 mAh rechnerisch?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">T = 900 s. I<sub>Ø</sub> = (80 mA · 2 s + 0,01 mA · 898 s) / 900 s = (160 + 8,98) / 900 ≈ 0,188 mA. Laufzeit = 2600 mAh / 0,188 mA ≈ 13 848 h ≈ 577 Tage. Mit 20 % Reserve etwa 460 Tage.</p>
</details>
<p>2. Ein Kühlraum soll 4 °C halten, die Hysterese beträgt 2 K symmetrisch um den Sollwert. Wann schaltet der Kompressor ein und aus? Was passiert bei 4,2 °C?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Ein bei 5 °C, aus bei 3 °C. Bei 4,2 °C bleibt der bisherige Zustand erhalten: Läuft der Kompressor gerade (Temperatur fällt), läuft er weiter; ist er aus (Temperatur steigt), bleibt er aus.</p>
</details>
<p>3. Der Bewässerungsautomat ist in BEREIT. Die Bodenfeuchte fällt auf 25 %. Nach 3 Minuten misst der Sensor 46 %, nach weiteren 10 Minuten meldet der Tank „leer“. Welche Zustände werden durchlaufen, und wie steht das Ventil am Ende?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">BEREIT → BEWÄSSERN (Ventil auf) → nach 3 min wegen ≥ 45 % → VERSICKERN (Ventil zu) → Tank leer → STÖRUNG (Ventil zu, Alarm). Am Ende ist das Ventil geschlossen.</p>
</details>
<p>4. Bilde für die Werte 21,0 – 21,2 – 21,4 – 25,9 – 21,3 – 21,5 – 21,6 den gleitenden Median über jeweils 3 Werte. Was fällt auf?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">21,2 – 21,4 – 21,4 – 21,5 – 21,5. Der Ausreißer 25,9 taucht im Ergebnis nicht auf. Der gleitende Mittelwert über 3 Werte läge dagegen dreimal bei rund 22,8 bis 22,9 °C – der Ausreißer verfälscht drei Ergebnisse.</p>
</details>
<p>5. In einer ISR steht <code>Serial.println(impulse); delay(100);</code>. Was ist daran falsch?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Eine ISR muss kurz sein. Ausgaben und Wartezeiten blockieren den Controller, während Interrupts gesperrt sind – weitere Impulse gehen verloren, und <code>delay()</code> funktioniert in einer ISR oft gar nicht, weil es selbst auf Timer-Interrupts angewiesen ist. Besser: in der ISR nur zählen, im Hauptprogramm ausgeben.</p>
</details>
INHALT,
    'summary' => [
        'Superloop für einfache Abläufe, Interrupts für schnelle Ereignisse, RTOS für viele parallele Aufgaben mit Prioritäten.',
        'ISR kurz halten, gemeinsame Variablen volatile, Mehrbyte-Werte atomar lesen.',
        'Zustandsautomat: Zustände, Übergänge (Ereignis [Bedingung] / Aktion), sicherer Zustand bei Fehlern.',
        'Zweipunktregler mit Hysterese: zwei Schwellen verhindern Flattern; PID-Regler für stetige Stellgrößen.',
        'Median entfernt Ausreißer, gleitender Mittelwert glättet Rauschen; Plausibilität prüfen.',
        'Durchschnittsstrom = (I_aktiv · t_aktiv + I_schlaf · t_schlaf) / T; Laufzeit = Kapazität / I_Ø, mit Reserve.',
    ],
    'quiz' => [
        ['question' => 'Warum braucht ein Zweipunktregler eine Hysterese?', 'answer' => 'Damit er nicht um den Sollwert herum ständig ein- und ausschaltet; zwei getrennte Schwellen sorgen für ruhigeres Schalten.'],
        ['question' => 'Warum werden Variablen, die eine ISR verändert, als volatile deklariert?', 'answer' => 'Damit der Compiler sie bei jedem Zugriff neu aus dem Speicher liest und das Hauptprogramm die Änderung sieht.'],
        ['question' => 'Welcher Filter entfernt einzelne Ausreißer besser: Mittelwert oder Median?', 'answer' => 'Der Median.'],
        ['question' => 'Wie berechnet man den Durchschnittsstrom eines Sensorknotens mit Schlafphasen?', 'answer' => '(Strom aktiv · Zeit aktiv + Strom im Schlaf · Zeit im Schlaf) / Periodendauer.'],
    ],
];
