<?php
return [
    'title' => 'Anforderungen erheben und Produkte auswählen',
    'intro' => 'Ein guter Arbeitsplatz beginnt mit der Frage, was jemand damit tun will – nicht mit dem Katalog. Danach wird nach festen Kriterien ausgewählt: Leistung, Kosten über die ganze Nutzungsdauer, Umwelt und Ergonomie.',
    'goals' => [
        'Kundenanforderungen im Gespräch erheben und dokumentieren',
        'Auswahlkriterien für IT-Produkte benennen und gewichten',
        'Umwelt- und Effizienzsiegel einordnen',
        'Gesamtkosten (TCO) über die Nutzungsdauer berechnen',
        'eine Nutzwertanalyse durchführen und interpretieren',
    ],
    'content' => <<<'INHALT'
<h6>Anforderungen erheben</h6>
<p>Im Gespräch mit dem Kunden – intern oder extern – werden Aufgaben und Rahmenbedingungen geklärt. Hilfreiche Fragen:</p>
<ul>
  <li>Welche <strong>Tätigkeiten</strong> und welche Software? (Office, CAD, Entwicklung, Videokonferenzen)</li>
  <li><strong>Wo</strong> wird gearbeitet? (Büro, Homeoffice, unterwegs → Notebook, Docking-Station, Mobilfunk)</li>
  <li>Welche <strong>Peripherie</strong> und <strong>Schnittstellen</strong> sind nötig? Was ist schon vorhanden?</li>
  <li>Gibt es <strong>Vorgaben</strong>: Betriebssystem, Domäne, Sicherheit, Datenschutz, Barrierefreiheit, Corporate Design?</li>
  <li><strong>Budget</strong>, Zeitrahmen, Anzahl der Geräte, Nutzungsdauer, Kauf oder Leasing (<a href="/Learningfields/LF2/kapitel7.php">Kapitel 7</a>)?</li>
</ul>
<p>Die Anforderungen werden schriftlich festgehalten: Der Kunde beschreibt im <strong>Lastenheft</strong>, <em>was</em> er braucht, der Auftragnehmer im <strong>Pflichtenheft</strong>,
<em>wie</em> er es umsetzt. Ausführlich in <a href="/Learningfields/LF12/kapitel1.php">LF12 Kapitel 1</a>. Man unterscheidet <strong>funktionale</strong> Anforderungen
(„Videokonferenzen in HD“) und <strong>nichtfunktionale</strong> („Gewicht unter 1,5 kg“, „Lieferung in 2 Wochen“).</p>

<h6>Auswahlkriterien</h6>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th>Kriterium</th><th>Beispiele</th></tr></thead>
  <tbody>
    <tr><td>Leistung</td><td>CPU, RAM, SSD, Grafik passend zur Tätigkeit (<a href="/Learningfields/LF2/kapitel2.php">Kapitel 2</a> und <a href="/Learningfields/LF2/kapitel3.php">3</a>)</td></tr>
    <tr><td>Kompatibilität</td><td>mit vorhandener Software, Dockingstationen, Betriebssystem-Image, Domäne</td></tr>
    <tr><td>Erweiterbarkeit</td><td>freie RAM-Steckplätze, M.2-Slot, Anschlüsse</td></tr>
    <tr><td>Ergonomie</td><td>Display, Tastatur, Gewicht, Lautstärke (<a href="/Learningfields/LF2/kapitel4.php">Kapitel 4</a>)</td></tr>
    <tr><td>Energie, Umwelt</td><td>Verbrauch, Reparierbarkeit, Rücknahme, Siegel</td></tr>
    <tr><td>Service</td><td>Garantie, Vor-Ort-Service, Ersatzteilverfügbarkeit, Lieferzeit</td></tr>
    <tr><td>Sicherheit</td><td>TPM, Firmware-Updates, Hersteller-Support-Zeitraum</td></tr>
    <tr><td>Kosten</td><td>Anschaffung und laufende Kosten (TCO)</td></tr>
  </tbody>
</table>
<p><strong>Siegel</strong> helfen beim Vergleich: <em>Blauer Engel</em> (deutsches Umweltzeichen: Energie, Schadstoffe, Reparierbarkeit), <em>TCO Certified</em>
(Umwelt und soziale Verantwortung in der Herstellung), <em>EPEAT</em> (Umweltbewertung über den Lebenszyklus), <em>Energy Star</em> (Energieeffizienz).
Monitore tragen zudem das EU-Energielabel.</p>

<h6>Gesamtkosten: Total Cost of Ownership</h6>
<p>Der Kaufpreis ist nur ein Teil der Kosten. Die <strong>TCO</strong> umfassen auch Strom, Support, Wartung, Software, Schulung und Entsorgung über die Nutzungsdauer.</p>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf2/tco.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Gestapelte Balken: PC A 1617,12 Euro aus Anschaffung, Strom und Support; PC B 1710 Euro trotz niedrigerem Kaufpreis">
  <figcaption class="figure-caption">Der günstigere Kaufpreis ist nicht immer die günstigere Lösung</figcaption>
</figure>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th></th><th>Anschaffung</th><th>Strom (4 × pro Jahr)</th><th>Support (4 × pro Jahr)</th><th>Summe</th></tr></thead>
  <tbody>
    <tr><td>PC A</td><td>1.100,00 €</td><td>4 × 49,28 € = 197,12 €</td><td>4 × 80 € = 320,00 €</td><td><strong>1.617,12 €</strong></td></tr>
    <tr><td>PC B</td><td>950,00 €</td><td>4 × 70,00 € = 280,00 €</td><td>4 × 120 € = 480,00 €</td><td><strong>1.710,00 €</strong></td></tr>
  </tbody>
</table>

<h6>Nutzwertanalyse</h6>
<p>Wenn neben dem Preis auch schwer vergleichbare Kriterien zählen, hilft die <strong>Nutzwertanalyse</strong>: Kriterien festlegen, gewichten (zusammen 100 %),
jedes Angebot je Kriterium bewerten (z. B. 1–10 Punkte), Punkte × Gewicht rechnen und aufsummieren. Der höchste Nutzwert gewinnt.</p>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf2/nutzwertanalyse.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Gestapelte Balken der gewichteten Punkte: Notebook X 7,5, Notebook Y 7,6, Notebook Z 7,3">
  <figcaption class="figure-caption">Notebook Y liegt knapp vorn – vor allem dank Leistung und Akkulaufzeit</figcaption>
</figure>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th>Kriterium</th><th>Gewicht</th><th>X</th><th>Y</th><th>Z</th></tr></thead>
  <tbody>
    <tr><td>Leistung</td><td>40 %</td><td>8 → 3,2</td><td>9 → 3,6</td><td>6 → 2,4</td></tr>
    <tr><td>Akkulaufzeit</td><td>30 %</td><td>6 → 1,8</td><td>8 → 2,4</td><td>9 → 2,7</td></tr>
    <tr><td>Gewicht</td><td>20 %</td><td>9 → 1,8</td><td>5 → 1,0</td><td>7 → 1,4</td></tr>
    <tr><td>Service</td><td>10 %</td><td>7 → 0,7</td><td>6 → 0,6</td><td>8 → 0,8</td></tr>
    <tr><td><strong>Nutzwert</strong></td><td>100 %</td><td><strong>7,5</strong></td><td><strong>7,6</strong></td><td><strong>7,3</strong></td></tr>
  </tbody>
</table>
<div class="lf-merke"><strong>Merke:</strong> Gewichte und Bewertungsskala werden <em>vor</em> dem Vergleich festgelegt – sonst rechnet man sich den Favoriten schön.
Bei so knappen Ergebnissen wie hier lohnt ein Blick auf K.-o.-Kriterien und den Preis, bevor entschieden wird.</div>

<h6>Übungen mit Lösung</h6>
<p>1. Ordne zu – funktional oder nichtfunktional? (a) „Das Notebook muss zwei externe Monitore ansteuern.“ (b) „Akkulaufzeit mindestens 8 Stunden.“ (c) „Lieferung bis 15. März.“</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">(a) funktional (was es können muss). (b) nichtfunktional (Qualitätsmerkmal). (c) nichtfunktional (Rahmenbedingung).</p>
</details>
<p>2. Wie verändert sich das Ergebnis der Nutzwertanalyse, wenn Akkulaufzeit 40 % und Leistung 30 % gewichtet werden?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">X: 0,3·8 + 0,4·6 + 0,2·9 + 0,1·7 = 7,3. Y: 0,3·9 + 0,4·8 + 0,2·5 + 0,1·6 = 7,5. Z: 0,3·6 + 0,4·9 + 0,2·7 + 0,1·8 = 7,6.
Jetzt liegt Z vorn – die Gewichtung entscheidet mit.</p>
</details>
<p>3. Warum ist bei der TCO-Betrachtung die Nutzungsdauer wichtig?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Laufende Kosten (Strom, Support, Wartung) wachsen mit jedem Jahr. Je länger die Nutzung, desto stärker fallen sie ins Gewicht – und desto eher lohnt ein teureres,
sparsameres und langlebigeres Gerät.</p>
</details>
INHALT,
    'summary' => [
        'Anforderungen im Gespräch erheben: Tätigkeiten, Ort, Peripherie, Vorgaben, Budget; festhalten in Lasten- und Pflichtenheft.',
        'Kriterien: Leistung, Kompatibilität, Erweiterbarkeit, Ergonomie, Energie/Umwelt, Service, Sicherheit, Kosten.',
        'Siegel: Blauer Engel, TCO Certified, EPEAT, Energy Star, EU-Energielabel.',
        'TCO = Anschaffung + laufende Kosten über die Nutzungsdauer.',
        'Nutzwertanalyse: Kriterien gewichten, bewerten, Punkte × Gewicht summieren; Gewichte vorher festlegen.',
    ],
    'quiz' => [
        ['question' => 'Was beschreibt das Lastenheft?', 'answer' => 'Die Anforderungen des Kunden – was er braucht und wofür.'],
        ['question' => 'Was umfassen die Total Cost of Ownership?', 'answer' => 'Alle Kosten über die Nutzungsdauer: Anschaffung plus Strom, Support, Wartung, Software, Schulung, Entsorgung.'],
        ['question' => 'Wie berechnet man den Nutzwert eines Angebots?', 'answer' => 'Je Kriterium Punkte × Gewichtung rechnen und die Ergebnisse addieren.'],
        ['question' => 'Wofür steht der Blaue Engel?', 'answer' => 'Deutsches Umweltzeichen, u. a. für geringen Energieverbrauch, wenig Schadstoffe und Reparierbarkeit.'],
    ],
];
