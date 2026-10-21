<?php
return [
    'title' => 'Drahtlos: WLAN und Bluetooth',
    'intro' => 'Notebooks, Smartphones und Drucker hängen heute oft per Funk am Netz. Wer WLAN plant oder Verbindungsprobleme löst, braucht die Standards, Frequenzbänder und Kanäle – und ein Gefühl dafür, warum die angegebene Datenrate fast nie erreicht wird.',
    'goals' => [
        'WLAN-Standards von Wi-Fi 4 bis Wi-Fi 7 einordnen',
        'die Frequenzbänder 2,4, 5 und 6 GHz vergleichen',
        'überlappungsfreie Kanäle für benachbarte Access Points wählen',
        'Infrastrukturmodus, SSID, ESS, Roaming und Mesh erklären',
        'Bluetooth und NFC einordnen',
    ],
    'content' => <<<'INHALT'
<h6>WLAN-Standards</h6>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th>Standard</th><th>Name</th><th>Frequenz</th><th>max. Bruttorate (theoretisch)</th></tr></thead>
  <tbody>
    <tr><td>802.11n</td><td>Wi-Fi 4</td><td>2,4 und 5 GHz</td><td>600 Mbit/s</td></tr>
    <tr><td>802.11ac</td><td>Wi-Fi 5</td><td>5 GHz</td><td>ca. 6,9 Gbit/s</td></tr>
    <tr><td>802.11ax</td><td>Wi-Fi 6 / 6E</td><td>2,4 und 5 GHz, 6E zusätzlich 6 GHz</td><td>ca. 9,6 Gbit/s</td></tr>
    <tr><td>802.11be</td><td>Wi-Fi 7</td><td>2,4, 5 und 6 GHz</td><td>über 40 Gbit/s</td></tr>
  </tbody>
</table>
<p>Die Bruttowerte gelten unter Laborbedingungen mit vielen Antennen. In der Praxis teilen sich alle Geräte einer Funkzelle das Medium, WLAN arbeitet halbduplex,
Wände dämpfen, und Protokoll-Overhead kostet Leistung – realistisch ist oft weniger als die Hälfte. Wi-Fi 6 und 7 bringen vor allem mehr Effizienz bei vielen Geräten
(OFDMA) und weniger Wartezeit.</p>

<h6>Frequenzbänder und Kanäle</h6>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th>Band</th><th>Reichweite</th><th>Störungen</th><th>Bemerkung</th></tr></thead>
  <tbody>
    <tr><td>2,4 GHz</td><td>groß, durchdringt Wände besser</td><td>viele: Nachbar-WLANs, Bluetooth, Mikrowelle</td><td>wenige überlappungsfreie Kanäle</td></tr>
    <tr><td>5 GHz</td><td>mittel</td><td>weniger</td><td>viele Kanäle; manche müssen Radar ausweichen (DFS)</td></tr>
    <tr><td>6 GHz</td><td>kleiner</td><td>sehr wenige</td><td>nur Wi-Fi 6E/7; breite Kanäle, ideal für hohe Dichte</td></tr>
  </tbody>
</table>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf3/wlan-kanaele.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Die 13 Kanäle im 2,4-GHz-Band überlappen; Kanäle 1, 6 und 11 sind überlappungsfrei hervorgehoben">
  <figcaption class="figure-caption">Benachbarte Access Points auf 1, 6 und 11 verteilen</figcaption>
</figure>

<h6>Aufbau eines WLANs</h6>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf3/wlan-ess.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Zwei Access Points mit derselben SSID auf den Kanälen 1 und 11, ein Laptop wechselt beim Gehen von einer Funkzelle in die andere">
  <figcaption class="figure-caption">Mehrere Access Points, ein Netz</figcaption>
</figure>
<ul>
  <li><strong>Infrastrukturmodus</strong>: Clients verbinden sich mit einem Access Point, der ans kabelgebundene Netz angeschlossen ist – der Normalfall.
    Im <strong>Ad-hoc-Modus</strong> verbinden sich Geräte direkt miteinander.</li>
  <li><strong>Mesh</strong>: Access Points verbinden sich untereinander per Funk; nur einer braucht Kabel. Praktisch, wo keine Leitungen liegen – kostet aber Funkkapazität.</li>
  <li>Größere Installationen werden zentral über einen <strong>WLAN-Controller</strong> oder eine Cloud-Verwaltung konfiguriert (Kanäle, Sendeleistung, SSIDs, VLANs).</li>
  <li>Vor der Installation steht eine <strong>Ausleuchtung</strong> (Site Survey): Wo braucht es wie viel Abdeckung und Kapazität? Beton, Metall und Glas mit Metallbeschichtung dämpfen stark.</li>
  <li>Sicherheit: WPA3 bzw. WPA2/WPA3-Enterprise, Gäste in eigenem VLAN (<a href="/Learningfields/LF9/kapitel8.php">LF9 Kapitel 8</a>).</li>
</ul>

<h6>Bluetooth und NFC</h6>
<p><strong>Bluetooth</strong> verbindet Geräte über kurze Strecken im 2,4-GHz-Band (Personal Area Network): Headsets, Tastaturen, Sensoren. Typische Reichweite ist rund 10 Meter,
je nach Geräteklasse und Version auch deutlich mehr. <strong>Bluetooth Low Energy</strong> (BLE) braucht sehr wenig Strom und ist im Internet der Dinge verbreitet.
Geräte werden einmalig gekoppelt (Pairing); unbenutztes Bluetooth sollte aus Sicherheitsgründen abgeschaltet sein.
<strong>NFC</strong> (Near Field Communication) funkt nur über wenige Zentimeter – für kontaktloses Bezahlen, Zutrittskarten oder schnelles Koppeln.</p>

<h6>Übungen mit Lösung</h6>
<p>1. Drei Access Points im 2,4-GHz-Band hängen in benachbarten Büros. Welche Kanäle wählst du?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">1, 6 und 11 – sie überlappen nicht. Wer kann, nutzt zusätzlich oder stattdessen 5 GHz, weil es dort viel mehr freie Kanäle gibt.</p>
</details>
<p>2. Ein Notebook zeigt eine WLAN-Verbindung mit 1,2 Gbit/s an, eine Datei wird aber nur mit etwa 300 Mbit/s kopiert. Ist das ein Fehler?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Nicht unbedingt. Die Anzeige ist die Bruttorate der Funkverbindung. Halbduplex, Protokoll-Overhead, andere Geräte in der Zelle, Dämpfung und eventuell die
Geschwindigkeit des Servers oder Kabelnetzes senken den Nettodurchsatz deutlich.</p>
</details>
<p>3. In einer Lagerhalle soll WLAN bis in die Ecken reichen, Kabel gibt es nur an einer Stelle. Was schlägst du vor?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Ein Mesh-System, bei dem nur ein Access Point verkabelt ist – oder, wenn möglich, zusätzliche Kabel ziehen, weil kabelgebundene Access Points mehr Kapazität
übrig haben. Vorher eine Ausleuchtung machen; Regale mit Metall dämpfen stark.</p>
</details>
INHALT,
    'summary' => [
        'Wi-Fi 4 (802.11n), 5 (ac), 6/6E (ax), 7 (be); Bruttoraten sind theoretisch, netto oft weniger als die Hälfte.',
        '2,4 GHz: Reichweite, aber viele Störungen und nur 1, 6, 11 überlappungsfrei; 5 und 6 GHz: mehr Kanäle, weniger Reichweite.',
        'Infrastrukturmodus mit Access Points; SSID = Netzname; mehrere APs mit gleicher SSID = ESS, zwischen denen Clients wechseln (Roaming).',
        'Mesh verbindet APs per Funk; Controller verwalten große WLANs zentral.',
        'Bluetooth: PAN im 2,4-GHz-Band, BLE für IoT; NFC: wenige Zentimeter.',
    ],
    'quiz' => [
        ['question' => 'Welche Kanäle im 2,4-GHz-Band überlappen nicht?', 'answer' => 'Zum Beispiel 1, 6 und 11.'],
        ['question' => 'Welcher Standard heißt Wi-Fi 6?', 'answer' => 'IEEE 802.11ax.'],
        ['question' => 'Was ist eine SSID?', 'answer' => 'Der Name eines WLANs.'],
        ['question' => 'Was ist Roaming im WLAN?', 'answer' => 'Der automatische Wechsel eines Clients zu einem anderen Access Point mit derselben SSID, ohne dass der Nutzer etwas tun muss.'],
    ],
];
