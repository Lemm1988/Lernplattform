<?php
return [
    'title' => 'Ausfallsicherheit: RAID und USV',
    'intro' => 'Festplatten gehen kaputt, der Strom fällt aus. RAID und unterbrechungsfreie Stromversorgung sorgen dafür, dass Server und Netz trotzdem weiterlaufen – und beide kommen in der AP1 regelmäßig mit Rechenaufgaben vor.',
    'goals' => [
        'die RAID-Level 0, 1, 5, 6 und 10 nach Kapazität, Leistung und Ausfallsicherheit vergleichen',
        'nutzbare Kapazitäten von RAID-Verbünden berechnen',
        'erklären, warum RAID kein Backup ersetzt',
        'USV-Bauarten VFD, VI und VFI unterscheiden',
        'eine USV nach Leistung dimensionieren und die Überbrückungszeit berechnen',
    ],
    'content' => <<<'INHALT'
<h6>RAID</h6>
<p>RAID (Redundant Array of Independent Disks) fasst mehrere Laufwerke zu einem logischen Laufwerk zusammen – für mehr Leistung, mehr Ausfallsicherheit oder beides.</p>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf3/raid.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Datenblöcke auf Platten: RAID 0 verteilt, RAID 1 spiegelt, RAID 5 verteilt mit Parität, RAID 10 spiegelt paarweise und verteilt">
  <figcaption class="figure-caption">Verteilen, spiegeln, Parität – oder Kombinationen</figcaption>
</figure>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th>Level</th><th>min. Platten</th><th>nutzbare Kapazität</th><th>verkraftet</th><th>Einsatz</th></tr></thead>
  <tbody>
    <tr><td>RAID 0</td><td>2</td><td>n × C</td><td>keinen Ausfall</td><td>Geschwindigkeit, unkritische Daten (Videoschnitt-Cache)</td></tr>
    <tr><td>RAID 1</td><td>2</td><td>C (bei 2 Platten)</td><td>1 Ausfall</td><td>Systemplatte eines Servers</td></tr>
    <tr><td>RAID 5</td><td>3</td><td>(n − 1) × C</td><td>1 Ausfall</td><td>Fileserver, gutes Verhältnis von Kapazität und Sicherheit</td></tr>
    <tr><td>RAID 6</td><td>4</td><td>(n − 2) × C</td><td>2 Ausfälle</td><td>große Platten, lange Wiederherstellungszeiten</td></tr>
    <tr><td>RAID 10</td><td>4</td><td>n ÷ 2 × C</td><td>1 je Spiegelpaar</td><td>Datenbanken: schnell und sicher</td></tr>
  </tbody>
</table>
<p>Die <strong>Parität</strong> bei RAID 5 ist ein XOR der Datenblöcke (<a href="/Learningfields/LF4/kapitel7.php">LF4 Kapitel 7</a>): Aus A1 = 1011 und A2 = 0110 wird
Ap = 1101. Fällt die Platte mit A2 aus, rechnet der Controller A1 ⊕ Ap = 1011 ⊕ 1101 = 0110 zurück. Nach dem Tausch einer defekten Platte wird der Verbund
neu aufgebaut (<em>Rebuild</em>); bei großen Platten dauert das Stunden bis Tage, in denen eine zweite Panne alles zerstören würde – ein Argument für RAID 6.
Eine <strong>Hot-Spare</strong>-Platte springt automatisch ein; <strong>Hot-Swap</strong> erlaubt den Tausch im laufenden Betrieb.</p>
<div class="lf-merke"><strong>Merke:</strong> RAID schützt vor dem Ausfall einer Platte – nicht vor versehentlichem Löschen, Ransomware, Controllerdefekt, Diebstahl oder Brand.
Jede Änderung wird sofort auf alle Platten geschrieben, auch die Verschlüsselung durch Ransomware. <strong>RAID ist kein Backup.</strong> (Sicherungsstrategien: <a href="/Learningfields/LF5/kapitel9.php">LF5 Kapitel 9</a>)</div>

<h6>Unterbrechungsfreie Stromversorgung</h6>
<p>Eine USV überbrückt Stromausfälle mit Akkus und filtert Spannungsschwankungen, Spitzen und Frequenzabweichungen. Sie soll nicht stundenlang weiterlaufen,
sondern Kurzunterbrechungen abfangen und bei längeren Ausfällen Zeit verschaffen, um Server <strong>geordnet herunterzufahren</strong> – das löst die USV per USB- oder
Netzwerksignal selbst aus.</p>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf3/usv-typen.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Drei USV-Bauarten: Offline mit Umschalter, Line-Interactive mit Spannungsregler, Online mit dauerhaftem Weg über Gleichrichter, Akku und Wechselrichter">
  <figcaption class="figure-caption">Je mehr Entkopplung vom Netz, desto besser der Schutz</figcaption>
</figure>

<h6>USV dimensionieren</h6>
<ul>
  <li><strong>Wirkleistung</strong> P in Watt (W): was die Geräte tatsächlich verbrauchen.</li>
  <li><strong>Scheinleistung</strong> S in Voltampere (VA): was die USV liefern muss; S = P ÷ cos φ. Der <strong>Leistungsfaktor</strong> cos φ liegt bei IT-Geräten meist zwischen 0,8 und 1.</li>
  <li>Eine USV hat <strong>beide</strong> Angaben (z. B. 1000 VA / 600 W) – beide müssen reichen. Dazu kommt eine Reserve von etwa 20–30 % für Wachstum und Alterung der Akkus.</li>
</ul>
<p><strong>Überbrückungszeit</strong> (vereinfacht): t = Akkuenergie in Wh × Wirkungsgrad ÷ Last in W. Die Akkuenergie ist Spannung × Kapazität:
Zwei 12-V-Akkus mit je 9 Ah in Reihe liefern 24 V × 9 Ah = 216 Wh. Bei 300 W Last und 90 % Wirkungsgrad: 216 × 0,9 ÷ 300 = 0,648 h ≈ <strong>39 Minuten</strong>.
(In Reihe addieren sich die Spannungen, parallel die Kapazitäten – die Energie in Wh ist in beiden Fällen gleich.) Hersteller geben Laufzeiten meist als Tabelle oder Kurve an,
weil Akkus bei hoher Last überproportional schneller leer werden.</p>

<h6>Übungen mit Lösung</h6>
<p>1. Ein NAS hat 6 Platten zu je 4 TB. Welche nutzbare Kapazität ergibt sich bei RAID 5, RAID 6 und RAID 10?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">RAID 5: (6 − 1) × 4 TB = <strong>20 TB</strong>. RAID 6: (6 − 2) × 4 TB = <strong>16 TB</strong>. RAID 10: 6 ÷ 2 × 4 TB = <strong>12 TB</strong>.</p>
</details>
<p>2. In einem RAID 5 aus drei Platten stehen A1 = 1011 und die Parität Ap = 1101. Die Platte mit A2 fällt aus. Welchen Wert hatte A2?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">A2 = A1 ⊕ Ap = 1011 ⊕ 1101 = <strong>0110</strong>.</p>
</details>
<p>3. An eine USV sollen ein Server (400 W), ein Switch (50 W) und ein Monitor (30 W) angeschlossen werden, cos φ = 0,8, Reserve 20 %. Welche USV passt:
A (750 VA / 450 W), B (1000 VA / 600 W), C (1500 VA / 900 W)?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Last 480 W → mit Reserve 576 W. Scheinleistung 480 ÷ 0,8 = 600 VA → mit Reserve 720 VA. A scheidet aus (450 W &lt; 576 W).
<strong>B reicht</strong> (600 W ≥ 576 W, 1000 VA ≥ 720 VA). C reicht auch, ist aber überdimensioniert und teurer.</p>
</details>
<p>4. Eine USV hat zwei 12-V-Akkus mit je 7 Ah in Reihe, Wirkungsgrad 85 %, Last 200 W. Wie lange überbrückt sie?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">24 V × 7 Ah = 168 Wh. 168 × 0,85 ÷ 200 = 0,714 h ≈ <strong>43 Minuten</strong>.</p>
</details>
INHALT,
    'summary' => [
        'RAID 0: n × C, keine Redundanz; RAID 1: Spiegel; RAID 5: (n − 1) × C, 1 Ausfall; RAID 6: (n − 2) × C, 2 Ausfälle; RAID 10: n ÷ 2 × C.',
        'RAID-5-Parität ist ein XOR; fehlende Blöcke lassen sich zurückrechnen.',
        'RAID ist kein Backup – es schützt nur vor Plattenausfall.',
        'USV-Bauarten: VFD (Offline), VI (Line-Interactive), VFI (Online/Doppelwandler, ohne Umschaltzeit).',
        'Dimensionierung: Watt und VA prüfen (S = P ÷ cos φ) plus Reserve; Überbrückungszeit ≈ Wh × Wirkungsgrad ÷ W.',
    ],
    'quiz' => [
        ['question' => 'Wie viel Kapazität ist bei RAID 5 aus 4 Platten zu je 2 TB nutzbar?', 'answer' => '6 TB ((4 − 1) × 2 TB).'],
        ['question' => 'Warum ist RAID kein Backup?', 'answer' => 'Es schützt nur vor Plattenausfall; Löschen, Ransomware oder Brand betreffen alle Platten gleichzeitig.'],
        ['question' => 'Welche USV-Bauart hat keine Umschaltzeit?', 'answer' => 'VFI – die Online- bzw. Doppelwandler-USV.'],
        ['question' => 'Wie berechnet man die Scheinleistung aus der Wirkleistung?', 'answer' => 'S = P ÷ cos φ.'],
    ],
];
