<?php
return [
    'title' => 'Was ist ein cyber-physisches System?',
    'intro' => 'Ein Thermostat, eine Abfüllanlage, ein E-Bike: Überall misst Software die physische Welt und greift in sie ein. In LF7 geht es darum, solche Systeme zu verstehen und gezielt zu ergänzen – um einen Sensor, eine Funktion oder eine Netzwerkanbindung.',
    'goals' => [
        'den Begriff cyber-physisches System (CPS) erklären und von Embedded System und IoT abgrenzen',
        'Sensor, Steuereinheit und Aktor in einem System benennen',
        'Steuerung und Regelung unterscheiden und die Größen eines Regelkreises benennen',
        'harte und weiche Echtzeitanforderungen unterscheiden',
        'den Ablauf eines Ergänzungsauftrags beschreiben',
    ],
    'content' => <<<'INHALT'
<h6>Cyber trifft Physik</h6>
<p>Ein <strong>cyber-physisches System</strong> (CPS) verbindet einen <em>physischen Prozess</em> – Temperatur, Bewegung, Druck, Licht – mit <em>Informationstechnik</em>: Sensoren erfassen den Zustand, Software entscheidet, Aktoren greifen ein. Fast immer ist das System zusätzlich vernetzt und tauscht Daten mit anderen Systemen oder einer Cloud aus.</p>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf7/cps-aufbau.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Sensoren erfassen den physischen Prozess und liefern Messwerte an ein eingebettetes System; dieses stellt Aktoren, die auf den Prozess wirken; über ein Netz ist das System mit einer Cloud verbunden">
  <figcaption class="figure-caption">Der Kreislauf eines CPS am Beispiel Gewächshaus</figcaption>
</figure>
<p>Das Gewächshaus begleitet uns durch das ganze Lernfeld: Ein Mikrocontroller misst Temperatur und Bodenfeuchte, schaltet Lüfter und Bewässerung und meldet die Werte an ein Dashboard. Im Laufe der Kapitel wird es Schritt für Schritt ergänzt.</p>

<h6>Begriffe abgrenzen</h6>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th>Begriff</th><th>Kern</th><th>Beispiel</th></tr></thead>
  <tbody>
    <tr><td><strong>Eingebettetes System</strong> (Embedded System)</td><td>Rechner, der fest in ein Gerät eingebaut ist und dort eine bestimmte Aufgabe erfüllt; oft ohne Bildschirm und Tastatur</td><td>Steuerung einer Waschmaschine, Motorsteuergerät</td></tr>
    <tr><td><strong>Cyber-physisches System</strong></td><td>Eingebettete Systeme, die über Sensoren und Aktoren mit einem physischen Prozess gekoppelt und untereinander vernetzt sind</td><td>Fertigungsstraße, deren Stationen sich selbst abstimmen</td></tr>
    <tr><td><strong>Internet of Things</strong> (IoT)</td><td>Betont die Vernetzung: Alltagsgegenstände und Maschinen sind über Internetprotokolle erreichbar</td><td>Smarte Steckdose, Paket-Tracker</td></tr>
    <tr><td><strong>Industrie 4.0</strong> / IIoT</td><td>CPS in der Produktion: vernetzte Maschinen, Daten für Wartung und Planung</td><td>Vorausschauende Wartung einer Pumpe</td></tr>
  </tbody>
</table>
<p>Die Grenzen sind fließend. Merke dir die Blickrichtung: <em>Embedded</em> schaut auf das Gerät, <em>CPS</em> auf das Zusammenspiel mit der physischen Welt, <em>IoT</em> auf die Vernetzung.</p>

<h6>Eingabe – Verarbeitung – Ausgabe</h6>
<p>Das EVA-Prinzip gilt auch hier, nur dass Ein- und Ausgabe physikalisch sind:</p>
<ul>
  <li><strong>Sensor</strong> (Eingabe): wandelt eine physikalische Größe in ein elektrisches Signal – Temperaturfühler, Taster, Lichtschranke, Beschleunigungssensor.</li>
  <li><strong>Steuereinheit</strong> (Verarbeitung): Mikrocontroller, Einplatinencomputer oder speicherprogrammierbare Steuerung (SPS) mit Software.</li>
  <li><strong>Aktor</strong> (Ausgabe): wandelt ein elektrisches Signal in eine physikalische Wirkung – Motor, Ventil, Relais, Heizelement, LED.</li>
</ul>
<p>Beispiele aus verschiedenen Branchen: das ABS im Auto (Raddrehzahl messen, Bremsdruck regeln), eine Insulinpumpe (Blutzucker messen, Insulin dosieren), ein Smart Grid (Netzlast messen, Erzeuger und Verbraucher zuschalten), ein Hochregallager (Positionen erfassen, Fahrzeuge steuern).</p>

<h6>Steuern oder regeln?</h6>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf7/regelkreis.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Oben eine Steuerung: Zeitschaltuhr schaltet die Heizung, die Raumtemperatur wird nicht gemessen. Unten ein Regelkreis: Sollwert minus Istwert ergibt die Abweichung, der Regler stellt die Heizung, ein Sensor misst die Raumtemperatur und führt sie zurück">
  <figcaption class="figure-caption">Steuerung (offene Wirkungskette) und Regelung (geschlossener Regelkreis)</figcaption>
</figure>
<p>Bei einer <strong>Steuerung</strong> beeinflusst eine Eingangsgröße eine Ausgangsgröße, ohne dass das Ergebnis zurückgemeldet wird – eine offene Wirkungskette. Bei einer <strong>Regelung</strong> wird die zu beeinflussende Größe ständig gemessen und mit dem gewünschten Wert verglichen – ein geschlossener Kreis mit Rückführung.</p>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th>Größe</th><th>Bedeutung</th><th>im Gewächshaus</th></tr></thead>
  <tbody>
    <tr><td>Sollwert (Führungsgröße)</td><td>gewünschter Wert</td><td>24 °C</td></tr>
    <tr><td>Istwert (Regelgröße)</td><td>gemessener tatsächlicher Wert</td><td>26,5 °C</td></tr>
    <tr><td>Regelabweichung</td><td>Sollwert − Istwert</td><td>−2,5 K (zu warm)</td></tr>
    <tr><td>Stellgröße</td><td>Ausgang des Reglers an das Stellglied</td><td>Lüfter mit 60 % Drehzahl</td></tr>
    <tr><td>Störgröße</td><td>unerwünschter Einfluss von außen</td><td>Sonneneinstrahlung, offene Tür</td></tr>
  </tbody>
</table>
<p class="lf-merke"><strong>Merke:</strong> Steuerung = keine Rückmeldung, Störungen bleiben unbemerkt. Regelung = Istwert wird zurückgeführt, Störungen werden ausgeglichen. Woran erkennst du eine Regelung? Die gestellte Größe wird selbst gemessen.</p>

<h6>Echtzeit</h6>
<p>Ein CPS muss nicht nur richtig, sondern auch <strong>rechtzeitig</strong> reagieren. Echtzeit heißt nicht „sehr schnell“, sondern „innerhalb einer garantierten Frist“.</p>
<ul>
  <li><strong>Harte Echtzeit</strong>: Eine verpasste Frist ist ein Fehler mit möglicherweise schweren Folgen – Airbag-Auslösung, Not-Halt eines Roboters, Motorzündung.</li>
  <li><strong>Weiche Echtzeit</strong>: Eine verpasste Frist verschlechtert die Qualität, ist aber nicht gefährlich – ruckelnde Videokonferenz, verspätet aktualisierte Temperaturanzeige.</li>
</ul>

<h6>Was ein CPS sonst noch können muss</h6>
<ul>
  <li><strong>Zuverlässigkeit und Robustheit</strong>: Betrieb über Jahre, bei Hitze, Kälte, Feuchtigkeit, Vibration, Stromausfällen.</li>
  <li><strong>Energieeffizienz</strong>: Viele Sensorknoten laufen mit Batterie oder Solarzelle (<a href="/Learningfields/LF7/kapitel7.php">Kapitel 7</a>).</li>
  <li><strong>Funktionale Sicherheit</strong> (Safety): Das System darf Menschen und Umwelt nicht gefährden – auch nicht im Fehlerfall.</li>
  <li><strong>Informationssicherheit</strong> (Security): Vernetzte Geräte sind angreifbar (<a href="/Learningfields/LF7/kapitel8.php">Kapitel 8</a>).</li>
  <li><strong>Wartbarkeit</strong>: Updates aus der Ferne, Diagnose, Austausch einzelner Komponenten.</li>
</ul>
<p>Ein verwandter Begriff ist der <strong>digitale Zwilling</strong>: ein Software-Abbild einer realen Anlage, das mit ihren Live-Daten gefüttert wird. Damit lassen sich Zustände überwachen, Änderungen vorab simulieren und Wartungen planen.</p>

<h6>Ein CPS ergänzen – der Auftrag</h6>
<p>In der Praxis baut man selten ein CPS von Grund auf. Typischer ist: Ein vorhandenes System soll erweitert werden – das Gewächshaus bekommt einen Bodenfeuchtesensor, die Kühlzelle eine Alarmmeldung aufs Handy. Der Ablauf:</p>
<ol>
  <li><strong>Ist-Analyse</strong>: Welche Komponenten, Schnittstellen, Protokolle und Spannungen gibt es schon?</li>
  <li><strong>Anforderungen</strong> klären: Was soll gemessen oder gesteuert werden, wie genau, wie oft, mit welcher Reaktionszeit, mit welchem Budget?</li>
  <li><strong>Komponenten auswählen</strong>: Sensor/Aktor, Schnittstelle (<a href="/Learningfields/LF7/kapitel5.php">Kapitel 5</a>), Funk oder Kabel (<a href="/Learningfields/LF7/kapitel6.php">Kapitel 6</a>), Stromversorgung.</li>
  <li><strong>Umsetzen</strong>: verdrahten, Software anpassen, Daten anbinden.</li>
  <li><strong>Testen</strong>: Einzeltest der neuen Komponente, dann Integrationstest mit dem Gesamtsystem; Grenzfälle wie Sensorausfall prüfen.</li>
  <li><strong>Inbetriebnahme und Übergabe</strong>: Dokumentation (Schaltplan, Pinbelegung, Konfiguration), Einweisung, Abnahmeprotokoll.</li>
</ol>
<p class="lf-pruefung"><strong>Prüfungstipp:</strong> In AP2-Aufgaben zu CPS bekommst du oft eine kurze Szenariobeschreibung. Markiere zuerst Sensoren, Aktoren und Schnittstellen – danach lassen sich die Teilaufgaben (Schnittstelle wählen, Werte umrechnen, Pseudocode schreiben) viel leichter zuordnen.</p>

<h6>Übungen mit Lösung</h6>
<p>1. Steuerung oder Regelung? (a) Treppenhauslicht, das nach Tastendruck 3 Minuten leuchtet, (b) Tempomat im Auto, (c) Kühlschrank mit Thermostat, (d) Waschmaschine mit festem Programmablauf.</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">(a) Steuerung – ob es hell genug ist, wird nicht gemessen. (b) Regelung – die Geschwindigkeit wird gemessen und nachgeführt. (c) Regelung – die Innentemperatur wird gemessen, der Kompressor danach geschaltet. (d) Steuerung – der Ablauf ist fest, es gibt keine Rückmeldung über das Ergebnis (wie sauber die Wäsche ist).</p>
</details>
<p>2. Eine Parkhausschranke soll automatisch öffnen, wenn ein gültiges Ticket eingeführt wird, und schließen, sobald das Fahrzeug durchgefahren ist. Nenne Sensoren und Aktoren.</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Sensoren: Ticketleser, Lichtschranke oder Induktionsschleife (Fahrzeug erkannt / durchgefahren), Endlagenschalter der Schranke (offen/geschlossen). Aktoren: Motor des Schrankenbaums, Ampel bzw. Anzeige.</p>
</details>
<p>3. Harte oder weiche Echtzeit? (a) Airbag, (b) Temperaturkurve im Web-Dashboard, (c) Not-Halt eines Industrieroboters, (d) Musik-Streaming.</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Hart: (a) und (c) – eine verpasste Frist gefährdet Menschen. Weich: (b) und (d) – eine Verzögerung stört nur.</p>
</details>
INHALT,
    'summary' => [
        'CPS = physischer Prozess + Sensoren + Software + Aktoren, meist vernetzt.',
        'Embedded betont das Gerät, CPS die Kopplung an die physische Welt, IoT die Vernetzung.',
        'Steuerung: offene Wirkungskette ohne Rückmeldung. Regelung: geschlossener Kreis, der Istwert wird zurückgeführt.',
        'Regelkreis-Größen: Sollwert, Istwert, Regelabweichung, Stellgröße, Störgröße.',
        'Harte Echtzeit: Frist verpasst = Fehler; weiche Echtzeit: Frist verpasst = schlechtere Qualität.',
        'Ergänzungsauftrag: Ist-Analyse, Anforderungen, Komponenten, Umsetzung, Test, Übergabe mit Dokumentation.',
    ],
    'quiz' => [
        ['question' => 'Was unterscheidet eine Regelung von einer Steuerung?', 'answer' => 'Die Regelung misst die Ausgangsgröße (Istwert) und vergleicht sie ständig mit dem Sollwert – ein geschlossener Kreis mit Rückführung.'],
        ['question' => 'Was ist ein Aktor?', 'answer' => 'Ein Bauteil, das ein elektrisches Signal in eine physikalische Wirkung umsetzt, z. B. Motor, Ventil oder Relais.'],
        ['question' => 'Was bedeutet harte Echtzeit?', 'answer' => 'Eine Reaktion muss garantiert innerhalb einer Frist erfolgen; ein Überschreiten gilt als Fehler mit möglicherweise schweren Folgen.'],
        ['question' => 'Was ist eine Störgröße?', 'answer' => 'Ein unerwünschter äußerer Einfluss auf die Regelgröße, z. B. eine offene Tür bei einer Temperaturregelung.'],
    ],
];
