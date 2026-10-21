<?php
return [
    'title' => 'Übertragungstechnik: Medien, Ethernet, Zugriffsverfahren',
    'intro' => 'Unter den Protokollen liegt die Physik: Kabel, Stecker, Signale und Regeln, wer wann senden darf. Dieses Kapitel deckt OSI-Schicht 1 und 2 ab – von der Kabelkategorie bis zur Stromversorgung per Netzwerkkabel.',
    'goals' => [
        'Simplex, Halbduplex und Vollduplex sowie serielle und parallele Übertragung unterscheiden',
        'CSMA/CD und CSMA/CA erklären und zuordnen',
        'Ethernet-Bezeichnungen wie 1000BASE-T entschlüsseln',
        'Twisted-Pair-Kategorien, Schirmungen und Lichtwellenleiter auswählen',
        'ein PoE-Leistungsbudget berechnen',
    ],
    'content' => <<<'INHALT'
<h6>Übertragungsarten</h6>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf3/duplex.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Simplex mit einer Richtung, Halbduplex abwechselnd in beide Richtungen, Vollduplex gleichzeitig in beide Richtungen">
  <figcaption class="figure-caption">Richtung und Gleichzeitigkeit</figcaption>
</figure>
<ul>
  <li><strong>Seriell</strong>: Bits nacheinander über eine Leitung (USB, SATA, PCI Express, Ethernet). <strong>Parallel</strong>: mehrere Bits gleichzeitig über mehrere Leitungen
    (alte Drucker- und Festplattenschnittstellen). Bei hohen Taktraten laufen parallele Signale auseinander und stören sich – deshalb ist heute fast alles seriell.</li>
  <li><strong>Synchron</strong>: Sender und Empfänger arbeiten mit gemeinsamem Takt. <strong>Asynchron</strong>: Jedes Zeichen bringt Start- und Stoppbits mit.</li>
</ul>

<h6>Wer darf senden? Zugriffsverfahren</h6>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf3/csma.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Ablauf von CSMA/CD mit Kollisionserkennung und Jam-Signal; Ablauf von CSMA/CA mit Backoff, RTS/CTS und Bestätigung per ACK">
  <figcaption class="figure-caption">Erkennen (Kabel, Hub) oder vermeiden (Funk)</figcaption>
</figure>
<p>CSMA steht für <em>Carrier Sense Multiple Access</em>: Alle teilen sich ein Medium und hören vor dem Senden, ob es frei ist. Im WLAN kommt das Problem der
<em>versteckten Station</em> hinzu: Zwei Geräte hören einander nicht, stören sich aber beim Access Point. RTS/CTS (Request/Clear to Send) reserviert dann das Medium.</p>

<h6>Ethernet</h6>
<p>Ethernet (IEEE 802.3) ist der Standard im kabelgebundenen LAN. Die Bezeichnungen folgen einem Schema: <strong>1000BASE-T</strong> = 1000 Mbit/s, Basisband,
Twisted Pair.</p>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th>Bezeichnung</th><th>Datenrate</th><th>Medium</th><th>Reichweite</th></tr></thead>
  <tbody>
    <tr><td>100BASE-TX</td><td>100 Mbit/s</td><td>Twisted Pair ab Cat 5</td><td>100 m</td></tr>
    <tr><td>1000BASE-T</td><td>1 Gbit/s</td><td>Twisted Pair ab Cat 5e</td><td>100 m</td></tr>
    <tr><td>2.5GBASE-T / 5GBASE-T</td><td>2,5 / 5 Gbit/s</td><td>Twisted Pair Cat 5e / Cat 6</td><td>100 m</td></tr>
    <tr><td>10GBASE-T</td><td>10 Gbit/s</td><td>Twisted Pair Cat 6A (Cat 6 bis ca. 55 m)</td><td>100 m</td></tr>
    <tr><td>1000BASE-SX / 10GBASE-SR</td><td>1 / 10 Gbit/s</td><td>Multimode-Glasfaser</td><td>einige 100 m</td></tr>
    <tr><td>1000BASE-LX / 10GBASE-LR</td><td>1 / 10 Gbit/s</td><td>Singlemode-Glasfaser</td><td>bis 10 km</td></tr>
  </tbody>
</table>

<h6>Kabel und Stecker</h6>
<p><strong>Twisted Pair</strong> hat vier verdrillte Adernpaare; die Verdrillung hebt Störungen auf. Höhere Kategorien erlauben höhere Frequenzen:
Cat 5e (100 MHz), Cat 6 (250 MHz), <strong>Cat 6A (500 MHz, Standard für Neuinstallationen)</strong>, Cat 7 (600 MHz), Cat 8 (2000 MHz, bis 30 m im Rechenzentrum).
Stecker ist der <strong>RJ45</strong> (8P8C); die Belegung folgt T568A oder T568B. Gekreuzte Kabel braucht man dank Auto-MDI-X praktisch nicht mehr.</p>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf3/kabelschirmung.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Querschnitte durch U/UTP ohne Schirm, F/UTP mit Folie um alle Paare und S/FTP mit Geflecht und Folie je Paar">
  <figcaption class="figure-caption">Vor dem Schrägstrich der Gesamtschirm, dahinter der Paarschirm</figcaption>
</figure>
<p><strong>Lichtwellenleiter</strong> übertragen Licht: unempfindlich gegen elektromagnetische Störungen, abhörsicherer, große Reichweiten.
<strong>Multimode</strong> (OM3/OM4, 50 µm Kern) für Gebäude und Rechenzentrum, <strong>Singlemode</strong> (OS2, 9 µm Kern) für Kilometer.
Gängige Stecker sind LC und SC; Switches nehmen die Glasfaser über steckbare Module (SFP) auf.</p>

<h6>Power over Ethernet</h6>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th>Standard</th><th>Leistung am Switch-Port</th><th>am Endgerät</th><th>typisch für</th></tr></thead>
  <tbody>
    <tr><td>802.3af (PoE)</td><td>15,4 W</td><td>12,95 W</td><td>IP-Telefon, einfache Kamera</td></tr>
    <tr><td>802.3at (PoE+)</td><td>30 W</td><td>25,5 W</td><td>WLAN-Access-Point, Dome-Kamera</td></tr>
    <tr><td>802.3bt Typ 3</td><td>60 W</td><td>51 W</td><td>leistungsstarke Access Points</td></tr>
    <tr><td>802.3bt Typ 4</td><td>90 W</td><td>71,3 W</td><td>Displays, Thin Clients</td></tr>
  </tbody>
</table>
<p>Ein PoE-Switch hat ein <strong>Gesamtbudget</strong>. Dafür zählt die Leistung am Port, nicht die am Endgerät – der Rest geht im Kabel verloren.</p>

<h6>Übungen mit Lösung</h6>
<p>1. Was bedeutet 10GBASE-T, und welches Kabel ist für 90 m nötig?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">10 Gbit/s, Basisband, Twisted Pair. Für 90 m braucht es mindestens Cat 6A; Cat 6 schafft 10 Gbit/s nur bis etwa 55 m.</p>
</details>
<p>2. Ein Switch hat ein PoE-Budget von 370 W. Angeschlossen werden sollen 8 Access Points (PoE+) und 12 IP-Telefone (PoE). Reicht das?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">8 × 30 W = 240 W, 12 × 15,4 W = 184,8 W, zusammen 424,8 W – das überschreitet 370 W. Entweder einen Switch mit größerem Budget wählen
oder die Geräte auf zwei Switches verteilen. (Mit 6 Access Points wären es 364,8 W – knapp, ohne Reserve.)</p>
</details>
<p>3. Warum verwendet WLAN CSMA/CA statt CSMA/CD?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Ein Funkgerät kann während des Sendens nicht zuverlässig hören, ob es eine Kollision gibt, und versteckte Stationen hören einander gar nicht.
Deshalb vermeidet WLAN Kollisionen mit Backoff und optional RTS/CTS und lässt jeden Frame per ACK bestätigen.</p>
</details>
INHALT,
    'summary' => [
        'Simplex: eine Richtung; Halbduplex: abwechselnd; Vollduplex: gleichzeitig.',
        'Heute überträgt man seriell (USB, SATA, PCIe, Ethernet).',
        'CSMA/CD erkennt Kollisionen (Hub, halbduplex), CSMA/CA vermeidet sie (WLAN, mit ACK).',
        '1000BASE-T = 1 Gbit/s über Twisted Pair; Cat 6A für 10 Gbit/s auf 100 m; LWL Multimode/Singlemode.',
        'PoE 15,4 W, PoE+ 30 W, PoE++ 60/90 W am Port; das Switch-Budget begrenzt die Summe.',
    ],
    'quiz' => [
        ['question' => 'Was bedeutet Halbduplex?', 'answer' => 'Übertragung in beide Richtungen, aber nur abwechselnd.'],
        ['question' => 'Welches Zugriffsverfahren nutzt WLAN?', 'answer' => 'CSMA/CA – Carrier Sense Multiple Access with Collision Avoidance.'],
        ['question' => 'Was bedeutet das T in 1000BASE-T?', 'answer' => 'Twisted Pair (verdrilltes Kupferkabel).'],
        ['question' => 'Wie viel Leistung liefert PoE+ (802.3at) am Switch-Port?', 'answer' => '30 Watt.'],
    ],
];
