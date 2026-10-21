<?php
return [
    'title' => 'Prozessor, Arbeitsspeicher, Grafik und Schnittstellen',
    'intro' => 'Ob ein Arbeitsplatz flüssig läuft, entscheiden vor allem Prozessor, Arbeitsspeicher und SSD. Wer Datenblätter lesen kann, wählt passend zur Aufgabe – statt das Teuerste oder das Billigste zu kaufen.',
    'goals' => [
        'Kennwerte von Prozessoren (Kerne, Threads, Takt, Cache, TDP) erklären',
        'Arbeitsspeicher nach Typ, Kapazität und Kanalbetrieb auswählen',
        'die Speicherhierarchie und die Rolle des Caches beschreiben',
        'integrierte und dedizierte Grafik abwägen',
        'USB-, Thunderbolt-, HDMI- und DisplayPort-Anschlüsse unterscheiden',
    ],
    'content' => <<<'INHALT'
<h6>Prozessor (CPU)</h6>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th>Kennwert</th><th>Bedeutung</th></tr></thead>
  <tbody>
    <tr><td>Kerne</td><td>eigenständige Recheneinheiten; viele Kerne helfen bei parallelen Aufgaben (Kompilieren, Virtualisierung, Video)</td></tr>
    <tr><td>Threads</td><td>mit Simultaneous Multithreading (Intel: Hyper-Threading) bearbeitet ein Kern zwei Befehlsströme</td></tr>
    <tr><td>Takt (Basis/Boost)</td><td>Takte pro Sekunde in GHz; der Boost-Takt gilt kurzzeitig und bei guter Kühlung</td></tr>
    <tr><td>Cache (L1–L3)</td><td>sehr schneller Zwischenspeicher in der CPU; mehr Cache = seltener auf den langsameren RAM warten</td></tr>
    <tr><td>TDP</td><td>Wärmeleistung, für die die Kühlung ausgelegt sein muss – Hinweis auf Verbrauch und Lautstärke</td></tr>
    <tr><td>Hybrid-Kerne</td><td>leistungsstarke Performance-Kerne und sparsame Effizienz-Kerne in einem Chip</td></tr>
    <tr><td>NPU</td><td>Recheneinheit für KI-Aufgaben (z. B. Spracherkennung), gemessen in TOPS</td></tr>
  </tbody>
</table>
<p>Taktfrequenzen verschiedener Generationen lassen sich nicht direkt vergleichen – eine neue CPU schafft pro Takt mehr. Für Vergleiche nimmt man Benchmarks,
die zur eigenen Anwendung passen.</p>

<h6>Speicherhierarchie</h6>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf2/speicherhierarchie.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Pyramide von Register über Cache, RAM und SSD bis HDD mit Zugriffszeiten von unter einer Nanosekunde bis zu Millisekunden">
  <figcaption class="figure-caption">Je schneller, desto kleiner und teurer</figcaption>
</figure>

<h6>Arbeitsspeicher (RAM)</h6>
<ul>
  <li><strong>Typ</strong>: DDR4 und DDR5 sind nicht kompatibel – Mainboard und CPU bestimmen den Typ. Notebooks nutzen die kleinere Bauform SO-DIMM oder fest verlöteten Speicher (nicht aufrüstbar!).</li>
  <li><strong>Kapazität</strong> als Faustregel: Büro 16 GB, Softwareentwicklung und Virtualisierung 32 GB und mehr, CAD und Videoschnitt 32–64 GB.
    Zu wenig RAM bremst stärker als eine etwas langsamere CPU, weil das System auf die SSD auslagert.</li>
  <li><strong>Dual Channel</strong>: Zwei gleiche Module arbeiten parallel und verdoppeln die Bandbreite. DDR5-5600 schafft 5600 Mio. Transfers × 8 Byte = 44,8 GB/s je Kanal,
    im Dual Channel 89,6 GB/s. Ein einzelnes 16-GB-Modul ist also langsamer als zwei 8-GB-Module.</li>
  <li><strong>ECC-RAM</strong> erkennt und korrigiert Bitfehler – Pflicht in Servern, sinnvoll in Workstations.</li>
</ul>

<h6>Grafik</h6>
<p>Die <strong>integrierte Grafik</strong> im Prozessor reicht für Büro, Web und Videowiedergabe auf mehreren Monitoren und spart Strom. Eine <strong>dedizierte Grafikkarte</strong>
mit eigenem Grafikspeicher (VRAM) braucht man für CAD, 3D, Videoschnitt, KI-Berechnungen oder Spiele – sie kostet zusätzlich Geld, Strom und erzeugt Wärme.</p>

<h6>Schnittstellen</h6>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf2/anschluesse.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Schematische Buchsen für USB-A, USB-C, HDMI, DisplayPort und RJ45 mit Kurzbeschreibung">
  <figcaption class="figure-caption">Buchsen erkennen – und wissen, dass dieselbe Buchse Verschiedenes können kann</figcaption>
</figure>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th>Standard</th><th>Datenrate</th><th>Bemerkung</th></tr></thead>
  <tbody>
    <tr><td>USB 2.0</td><td>480 Mbit/s</td><td>Maus, Tastatur, Drucker</td></tr>
    <tr><td>USB 3.2 Gen 1 („USB 5Gbps“)</td><td>5 Gbit/s</td><td>früher USB 3.0</td></tr>
    <tr><td>USB 3.2 Gen 2 („USB 10Gbps“)</td><td>10 Gbit/s</td><td>externe SSDs</td></tr>
    <tr><td>USB4 / Thunderbolt 4</td><td>bis 40 Gbit/s</td><td>über USB-C; Bildsignal, Docking-Stationen</td></tr>
    <tr><td>USB4 Version 2 / Thunderbolt 5</td><td>bis 80 Gbit/s</td><td>neueste Geräte</td></tr>
    <tr><td>USB Power Delivery</td><td>–</td><td>Laden über USB-C, bis 100 W, mit erweitertem Bereich bis 240 W</td></tr>
  </tbody>
</table>
<p>Für Monitore: <strong>HDMI</strong> (verbreitet, auch Fernseher und Beamer) und <strong>DisplayPort</strong> (hohe Auflösungen und Bildraten, mehrere Monitore in Reihe per Daisy Chain).
Über USB-C lässt sich das Bildsignal oft direkt ausgeben – ein Kabel für Bild, Daten, Netzwerk und Strom an einer Docking-Station.</p>

<h6>Übungen mit Lösung</h6>
<p>1. Welche Konfiguration empfiehlst du für (a) Sachbearbeitung mit Office und Browser, (b) Softwareentwicklung mit Containern und VMs, (c) CAD-Konstruktion?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">(a) aktuelle Mittelklasse-CPU, 16 GB RAM, 512-GB-SSD, integrierte Grafik. (b) CPU mit vielen Kernen, 32–64 GB RAM, 1-TB-NVMe-SSD.
(c) leistungsstarke CPU, 32–64 GB RAM, zertifizierte dedizierte Grafikkarte, schnelle SSD, großer Monitor mit hoher Auflösung.</p>
</details>
<p>2. Ein Notebook hat ein 16-GB-Modul DDR5-5600. Der Kunde überlegt, ein zweites gleiches Modul einzubauen. Was bringt das?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Doppelte Kapazität (32 GB) und Dual Channel: Die Speicherbandbreite steigt von 44,8 auf 89,6 GB/s – spürbar vor allem bei integrierter Grafik.
Vorher prüfen, ob ein freier Steckplatz da ist und der Speicher nicht verlötet ist.</p>
</details>
<p>3. Ein Kunde will mit einem einzigen Kabel Monitor, Netzwerk, Tastatur und Laden des Notebooks verbinden. Was brauchst du?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Eine Docking-Station mit USB-C (USB4 oder Thunderbolt) und Power Delivery; das Notebook muss am USB-C-Port Bildausgabe und Laden unterstützen,
die Ladeleistung der Dock muss zum Netzteil des Notebooks passen.</p>
</details>
INHALT,
    'summary' => [
        'CPU: Kerne, Threads, Takt, Cache, TDP; Generationen per Benchmark vergleichen, nicht per Takt.',
        'Speicherhierarchie: Register, Cache, RAM, SSD, HDD – schneller oben, größer unten.',
        'RAM: DDR4 und DDR5 inkompatibel; Dual Channel verdoppelt die Bandbreite; Büro 16 GB, Entwicklung 32 GB+.',
        'Integrierte Grafik für Büro, dedizierte für CAD, 3D, Video, KI.',
        'USB 2.0 480 Mbit/s bis USB4/Thunderbolt 80 Gbit/s; USB-C kann Bild und Strom bis 240 W übertragen.',
    ],
    'quiz' => [
        ['question' => 'Was ist der Cache einer CPU?', 'answer' => 'Ein sehr schneller Zwischenspeicher im Prozessor, der Zugriffe auf den langsameren Arbeitsspeicher reduziert.'],
        ['question' => 'Welche Bandbreite hat DDR5-5600 im Dual Channel?', 'answer' => '89,6 GB/s (2 × 5600 Mio. × 8 Byte).'],
        ['question' => 'Welche Datenrate hat USB 2.0?', 'answer' => '480 Mbit/s.'],
        ['question' => 'Wann braucht man eine dedizierte Grafikkarte?', 'answer' => 'Für CAD, 3D, Videoschnitt, KI-Berechnungen oder Spiele.'],
    ],
];
