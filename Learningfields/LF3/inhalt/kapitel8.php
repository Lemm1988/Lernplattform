<?php
return [
    'title' => 'Datenmengen und Übertragungsdauer berechnen',
    'intro' => 'Wie lange dauert der Upload, reicht die Leitung für das nächtliche Backup, wie groß wird die Bilddatei? Solche Rechnungen kommen in der AP1 regelmäßig – und scheitern fast immer an Bit und Byte oder an MB und MiB.',
    'goals' => [
        'Bit und Byte sowie Dezimal- und Binärpräfixe sicher umrechnen',
        'die Größe unkomprimierter Bild-, Audio- und Videodaten berechnen',
        'Übertragungsdauern berechnen, auch mit Overhead',
        'die nötige Datenrate für eine Übertragung im Zeitfenster bestimmen',
    ],
    'content' => <<<'INHALT'
<h6>Einheiten</h6>
<p>1 Byte = 8 Bit. Bei den Präfixen gibt es zwei Systeme (ausführlich in <a href="/Learningfields/LF5/kapitel1.php">LF5 Kapitel 1</a>):</p>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th>dezimal (SI)</th><th>Wert</th><th>binär (IEC)</th><th>Wert</th></tr></thead>
  <tbody>
    <tr><td>1 kB (Kilobyte)</td><td>1.000 Byte</td><td>1 KiB (Kibibyte)</td><td>1.024 Byte</td></tr>
    <tr><td>1 MB</td><td>1.000.000 Byte</td><td>1 MiB</td><td>1.048.576 Byte</td></tr>
    <tr><td>1 GB</td><td>10<sup>9</sup> Byte</td><td>1 GiB</td><td>1.073.741.824 Byte</td></tr>
  </tbody>
</table>
<p><strong>Datenraten sind immer dezimal und in Bit pro Sekunde</strong>: 100 Mbit/s = 100.000.000 Bit/s. Festplattenhersteller rechnen ebenfalls dezimal;
Windows zeigt dagegen binär gerechnete Werte mit „MB“ und „GB“ an. Deshalb „fehlen“ bei einer 1-TB-Platte im Explorer scheinbar rund 70 GB: 10<sup>12</sup> Byte sind 931 GiB.</p>

<h6>Übertragungsdauer</h6>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf3/uebertragungsdauer.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Rechenweg in drei Schritten: 4,7 GB in Byte, mal 8 in Bit, durch 100 Mbit/s ergibt 376 Sekunden">
  <figcaption class="figure-caption">Erst in Bit umrechnen, dann durch die Datenrate teilen</figcaption>
</figure>
<p>In der Praxis geht ein Teil der Bruttorate für Protokollköpfe, Bestätigungen und Wiederholungen verloren. Gibt eine Aufgabe einen Overhead an,
teilt man durch die <em>nutzbare</em> Rate: Bei 10 % Overhead sind von 50 Mbit/s nur 45 Mbit/s nutzbar.</p>

<h6>Größe von Mediendaten</h6>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf3/bildgroesse.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Pixelraster mit Breite und Höhe; Formel Breite mal Höhe mal Farbtiefe durch 8; Full HD mit 24 Bit ergibt 6.220.800 Byte">
  <figcaption class="figure-caption">Pixel mal Farbtiefe</figcaption>
</figure>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th>Medium</th><th>Formel (unkomprimiert)</th><th>Beispiel</th></tr></thead>
  <tbody>
    <tr><td>Bild</td><td>Breite × Höhe × Farbtiefe ÷ 8</td><td>4000 × 3000 × 24 Bit ÷ 8 = 36.000.000 Byte = 36 MB ≈ 34,33 MiB</td></tr>
    <tr><td>Audio</td><td>Abtastrate × Bittiefe × Kanäle × Sekunden ÷ 8</td><td>CD-Qualität 44.100 Hz × 16 Bit × 2 × 60 s ÷ 8 = 10.584.000 Byte ≈ 10,58 MB pro Minute</td></tr>
    <tr><td>Video</td><td>Bildgröße × Bilder pro Sekunde × Sekunden</td><td>Full HD, 24 Bit, 25 Bilder/s, 10 s: 6.220.800 × 25 × 10 ≈ 1,56 GB</td></tr>
  </tbody>
</table>
<p>Das Video-Beispiel zeigt, warum Videos immer komprimiert werden (z. B. H.264, H.265, AV1): Unkomprimiert bräuchte schon Full HD rund 1,24 Gbit/s.</p>

<h6>Benötigte Datenrate</h6>
<p>Umgekehrt: <strong>Datenrate = Datenmenge in Bit ÷ verfügbare Zeit</strong>. Ein Backup von 200 GB soll nachts in 4 Stunden übertragen werden:
200 · 10<sup>9</sup> · 8 Bit ÷ (4 · 3600 s) ≈ 111 Mbit/s. Eine 100-Mbit/s-Verbindung reicht also nicht – erst recht nicht mit Overhead.</p>
<div class="lf-pruefung"><strong>Prüfungstipp:</strong> Schreib die Einheiten bei jedem Zwischenschritt mit. Die häufigsten Fehler: Byte und Bit verwechselt (Faktor 8),
MiB wie MB gerechnet (Faktor 1,048…) und Minuten statt Sekunden. Am Ende sinnvoll runden und in Minuten und Sekunden angeben.</div>

<h6>Übungen mit Lösung</h6>
<p>1. Wie lange dauert die Übertragung einer 250-MiB-Datei über eine 16-Mbit/s-Leitung (ohne Overhead)?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">250 · 1.048.576 Byte = 262.144.000 Byte · 8 = 2.097.152.000 Bit. ÷ 16.000.000 Bit/s ≈ 131,1 s ≈ <strong>2 min 11 s</strong>.</p>
</details>
<p>2. 2 GB werden über 50 Mbit/s übertragen, 10 % gehen als Overhead verloren. Wie lange dauert es?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Nutzbar sind 45 Mbit/s. 2 · 10<sup>9</sup> · 8 Bit ÷ 45 · 10<sup>6</sup> Bit/s ≈ 355,6 s ≈ <strong>5 min 56 s</strong> (ohne Overhead wären es 320 s).</p>
</details>
<p>3. 30 Fotos in Full HD (24 Bit, unkomprimiert) sollen mit 10 Mbit/s hochgeladen werden. Wie lange dauert das?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Ein Foto: 6.220.800 Byte. 30 Fotos: 186.624.000 Byte · 8 = 1.492.992.000 Bit. ÷ 10.000.000 Bit/s ≈ 149,3 s ≈ <strong>2 min 29 s</strong>.</p>
</details>
<p>4. Wie groß ist eine 3-minütige Audioaufnahme in CD-Qualität (44,1 kHz, 16 Bit, Stereo) unkomprimiert, in MB und MiB?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">44.100 · 16 · 2 · 180 ÷ 8 = 31.752.000 Byte ≈ <strong>31,75 MB</strong> ≈ <strong>30,28 MiB</strong>.</p>
</details>
INHALT,
    'summary' => [
        '1 Byte = 8 Bit; kB/MB/GB dezimal (1000er-Schritte), KiB/MiB/GiB binär (1024er-Schritte).',
        'Datenraten sind dezimal und in Bit pro Sekunde.',
        'Übertragungsdauer = Datenmenge in Bit ÷ Datenrate; bei Overhead durch die nutzbare Rate teilen.',
        'Bild: Breite × Höhe × Farbtiefe ÷ 8; Audio: Abtastrate × Bittiefe × Kanäle × Zeit ÷ 8.',
        'Benötigte Datenrate = Datenmenge in Bit ÷ verfügbare Zeit.',
    ],
    'quiz' => [
        ['question' => 'Wie viele Byte hat 1 MiB?', 'answer' => '1.048.576 Byte (2^20).'],
        ['question' => 'Wie lange dauert die Übertragung von 4,7 GB über 100 Mbit/s?', 'answer' => '376 Sekunden, also etwa 6 Minuten 16 Sekunden.'],
        ['question' => 'Wie groß ist ein unkomprimiertes Full-HD-Bild mit 24 Bit Farbtiefe?', 'answer' => '1920 × 1080 × 3 Byte = 6.220.800 Byte ≈ 6,22 MB.'],
        ['question' => 'Welche Datenrate braucht man, um 200 GB in 4 Stunden zu übertragen?', 'answer' => 'Etwa 111 Mbit/s (200 · 10^9 · 8 Bit ÷ 14.400 s).'],
    ],
];
