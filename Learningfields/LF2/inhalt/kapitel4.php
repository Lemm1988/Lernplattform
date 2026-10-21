<?php
return [
    'title' => 'Monitor, Drucker, Netzteil und ergonomischer Arbeitsplatz',
    'intro' => 'Am Monitor verbringen Beschäftigte Tausende Stunden im Jahr. Ein guter Arbeitsplatz ist deshalb keine Komfortfrage, sondern Arbeitsschutz – und die Folgekosten von Druckern und Netzteilen übersteigen oft den Kaufpreis.',
    'goals' => [
        'Monitore nach Größe, Auflösung, Pixeldichte und Paneltyp auswählen',
        'Breite und Pixeldichte eines Monitors berechnen',
        'Laser- und Tintendrucker über die Kosten pro Seite vergleichen',
        'den Wirkungsgrad eines Netzteils bewerten',
        'einen Bildschirmarbeitsplatz ergonomisch einrichten',
    ],
    'content' => <<<'INHALT'
<h6>Monitore</h6>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th>Merkmal</th><th>Worauf achten?</th></tr></thead>
  <tbody>
    <tr><td>Diagonale, Format</td><td>24" bis 27" im Büro üblich; 16:9 oder 16:10 (mehr Höhe für Dokumente und Code)</td></tr>
    <tr><td>Auflösung</td><td>Full HD (1920 × 1080), WQHD (2560 × 1440), 4K UHD (3840 × 2160)</td></tr>
    <tr><td>Pixeldichte</td><td>bei etwa 90–110 ppi wirkt Text auf Normalabstand scharf, ohne Skalierung</td></tr>
    <tr><td>Paneltyp</td><td>IPS: gute Farben und Blickwinkel (Standard im Büro); VA: hoher Kontrast; TN: schnell, aber blickwinkelabhängig; OLED: perfektes Schwarz, Einbrenngefahr bei statischen Inhalten</td></tr>
    <tr><td>Bildwiederholrate</td><td>60–75 Hz reichen fürs Büro, 120 Hz+ wirken flüssiger</td></tr>
    <tr><td>Ergonomie</td><td>entspiegelt, höhenverstellbar, neigbar, drehbar (Pivot), flimmerfrei</td></tr>
    <tr><td>Anschlüsse</td><td>DisplayPort, HDMI, USB-C mit Stromversorgung und USB-Hub</td></tr>
  </tbody>
</table>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf2/monitor-geometrie.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="27-Zoll-Monitor im Format 16:9 mit Berechnung von Breite und Höhe über den Satz des Pythagoras und Pixeldichte von rund 109 ppi">
  <figcaption class="figure-caption">Die Diagonale allein verrät noch nicht, wie breit ein Monitor ist</figcaption>
</figure>

<h6>Drucker</h6>
<p>Entscheidend sind die <strong>Kosten pro Seite</strong>: Preis des Verbrauchsmaterials ÷ Reichweite (die Herstellerangaben folgen Normen wie ISO/IEC 19752 bzw. 24711),
plus Papier. Beispiel: Toner für 80 € reicht 3000 Seiten → 2,67 ct + 1 ct Papier = 3,67 ct je Seite. Eine Tintenpatrone für 30 € mit 500 Seiten kostet 6 ct je Seite
plus Papier.</p>
<ul>
  <li><strong>Laser</strong>: schnell, günstig pro Seite, wischfest; höhere Anschaffung, Tonerstaub und Ozon – nicht direkt neben Arbeitsplätzen aufstellen.</li>
  <li><strong>Tinte</strong>: günstig in der Anschaffung, gut für Fotos; teurer pro Seite, Tinte kann eintrocknen.</li>
  <li><strong>Multifunktionsgerät</strong>: Druck, Scan, Kopie; im Büro als Netzwerkgerät mit Benutzerauthentifizierung („Follow-me-Printing“), damit vertrauliche Ausdrucke nicht im Ausgabefach liegen.</li>
</ul>

<h6>Netzteil und Energieeffizienz</h6>
<p>Ein Netzteil wandelt Wechselstrom in die Gleichspannungen des PCs um. Der <strong>Wirkungsgrad</strong> sagt, wie viel davon ankommt; der Rest wird zu Wärme.
Braucht ein PC 200 W, zieht er bei 90 % Wirkungsgrad 200 ÷ 0,9 ≈ 222 W aus der Steckdose, bei 82 % ≈ 244 W. Zertifikate wie <strong>80 PLUS</strong> (Bronze bis Titanium)
garantieren Mindestwirkungsgrade. Das Netzteil wird passend dimensioniert – ein überdimensioniertes arbeitet im Teillastbereich mit schlechterem Wirkungsgrad.</p>

<h6>Ergonomie am Bildschirmarbeitsplatz</h6>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf2/ergonomie.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Seitenansicht einer Person am Schreibtisch mit Sehabstand 50 bis 70 cm, Blick leicht nach unten und sieben nummerierten Regeln">
  <figcaption class="figure-caption">Sieben Regeln für einen gesunden Bildschirmarbeitsplatz</figcaption>
</figure>
<p>Die <strong>Arbeitsstättenverordnung</strong> (Anhang 6) regelt Bildschirmarbeitsplätze: ausreichend Platz, flimmerfreie, entspiegelte Bildschirme, getrennte Tastatur,
passende Beleuchtung, Software, die zur Aufgabe passt. Der Arbeitgeber muss die Gefährdung beurteilen, Beschäftigten eine Vorsorge zu Augen und Sehen anbieten
und bei Bedarf eine spezielle Bildschirmarbeitsbrille bezahlen. Für Notebook-Arbeit gilt: externer Monitor, Tastatur und Maus – der eingebaute Bildschirm ist zu tief.</p>

<h6>Übungen mit Lösung</h6>
<p>1. Wie breit ist ein 27-Zoll-Monitor im Format 16:9, und welche Pixeldichte hat er bei 2560 × 1440?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">√(16² + 9²) ≈ 18,36. Breite = 27 × 16 ÷ 18,36 ≈ 23,5" ≈ 59,8 cm. Pixeldichte = √(2560² + 1440²) ÷ 27 ≈ 2937 ÷ 27 ≈ 109 ppi.</p>
</details>
<p>2. Ein Büro druckt 2000 Seiten im Monat. Laser: Toner 80 € für 3000 Seiten. Tinte: 30 € für 500 Seiten. Wie hoch sind die Materialkosten (ohne Papier) pro Jahr?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">24.000 Seiten/Jahr. Laser: 2,67 ct × 24.000 = 640 €. Tinte: 6 ct × 24.000 = 1440 €. Der Laser spart rund 800 € pro Jahr – mehr als der Unterschied im Kaufpreis.</p>
</details>
<p>3. Ein PC braucht im Mittel 200 W und läuft 8 Stunden an 220 Tagen. Was spart ein Netzteil mit 90 % statt 82 % Wirkungsgrad bei 0,35 €/kWh?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Aufnahme 243,9 W statt 222,2 W, Differenz 21,7 W. 21,7 W × 1760 h ≈ 38,2 kWh → rund <strong>13,36 €</strong> pro PC und Jahr – bei 100 PCs über 1300 €.</p>
</details>
INHALT,
    'summary' => [
        'Monitore: Diagonale, Format, Auflösung, Pixeldichte (≈ 90–110 ppi fürs Büro), IPS-Panel, Ergonomie-Funktionen.',
        'Breite = Diagonale × Seitenanteil ÷ √(a² + b²); ppi = Pixeldiagonale ÷ Zoll-Diagonale.',
        'Druckerkosten pro Seite = Materialpreis ÷ Reichweite + Papier; Laser bei viel Druck günstiger.',
        'Netzteil: Aufnahme = Leistung ÷ Wirkungsgrad; 80 PLUS garantiert Mindestwirkungsgrade.',
        'Ergonomie: oberste Zeile unter Augenhöhe, 50–70 cm Abstand, seitlich zum Fenster, Sitzen und Stehen abwechseln (ArbStättV Anhang 6).',
    ],
    'quiz' => [
        ['question' => 'Wie berechnet man die Pixeldichte eines Monitors?', 'answer' => 'Pixeldiagonale (√(Breite² + Höhe²) in Pixeln) geteilt durch die Diagonale in Zoll.'],
        ['question' => 'Wie hoch sind die Tonerkosten pro Seite bei 80 € und 3000 Seiten Reichweite?', 'answer' => 'Etwa 2,67 Cent.'],
        ['question' => 'Wie viel zieht ein PC mit 200 W Bedarf bei 90 % Netzteil-Wirkungsgrad aus der Steckdose?', 'answer' => 'Etwa 222 W (200 ÷ 0,9).'],
        ['question' => 'Wo sollte die oberste Bildschirmzeile liegen?', 'answer' => 'Leicht unter Augenhöhe, sodass der Blick leicht nach unten geht.'],
    ],
];
