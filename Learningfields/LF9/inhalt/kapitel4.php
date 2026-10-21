<?php
return [
    'title' => 'IPv4-Subnetting und VLSM',
    'intro' => 'Subnetting gehört zu den sichersten Punkten in der Prüfung – wenn man den Rechenweg beherrscht. Hier lernst du ihn Schritt für Schritt, mit Binärdarstellung und Blockgrößen-Trick.',
    'goals' => [
        'Netz- und Hostanteil einer IPv4-Adresse mit Präfix bestimmen',
        'Netzadresse, Broadcast und nutzbaren Bereich berechnen',
        'ein Netz in gleich große Subnetze aufteilen',
        'mit VLSM einen bedarfsgerechten Adressplan erstellen',
        'private und besondere Adressbereiche erkennen',
    ],
    'content' => <<<'INHALT'
<h6>Aufbau einer IPv4-Adresse</h6>
<p>Eine IPv4-Adresse hat 32 Bit, geschrieben als vier Dezimalzahlen (Oktette) von 0 bis 255. Das <strong>Präfix</strong> (CIDR-Schreibweise, z. B. <code>/26</code>)
gibt an, wie viele Bit von links zum <strong>Netzanteil</strong> gehören. Der Rest ist der <strong>Hostanteil</strong>.
Die <strong>Subnetzmaske</strong> drückt dasselbe aus: Einsen für den Netzanteil, Nullen für den Hostanteil.</p>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf9/ip-binaer.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="192.168.10.77/26 binär: 26 Bit Netzanteil, 6 Bit Hostanteil; Netzadresse 192.168.10.64, Broadcast 192.168.10.127">
  <figcaption class="figure-caption">Netzadresse: Hostbits auf 0 · Broadcast: Hostbits auf 1</figcaption>
</figure>
<p>Aus <em>h</em> Hostbits ergeben sich 2<sup>h</sup> Adressen, davon 2<sup>h</sup> − 2 für Geräte nutzbar (Netzadresse und Broadcast fallen weg).
Das Gateway braucht eine dieser Adressen – meist die erste oder die letzte.</p>

<h6>Die wichtigsten Präfixe</h6>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th>Präfix</th><th>Maske</th><th>Adressen</th><th>nutzbar</th><th>Blockgröße</th></tr></thead>
  <tbody>
    <tr><td>/16</td><td>255.255.0.0</td><td>65 536</td><td>65 534</td><td>1 im 2. Oktett</td></tr>
    <tr><td>/20</td><td>255.255.240.0</td><td>4096</td><td>4094</td><td>16 im 3. Oktett</td></tr>
    <tr><td>/21</td><td>255.255.248.0</td><td>2048</td><td>2046</td><td>8 im 3. Oktett</td></tr>
    <tr><td>/22</td><td>255.255.252.0</td><td>1024</td><td>1022</td><td>4 im 3. Oktett</td></tr>
    <tr><td>/23</td><td>255.255.254.0</td><td>512</td><td>510</td><td>2 im 3. Oktett</td></tr>
    <tr><td>/24</td><td>255.255.255.0</td><td>256</td><td>254</td><td>1 im 3. Oktett</td></tr>
    <tr><td>/25</td><td>255.255.255.128</td><td>128</td><td>126</td><td>128</td></tr>
    <tr><td>/26</td><td>255.255.255.192</td><td>64</td><td>62</td><td>64</td></tr>
    <tr><td>/27</td><td>255.255.255.224</td><td>32</td><td>30</td><td>32</td></tr>
    <tr><td>/28</td><td>255.255.255.240</td><td>16</td><td>14</td><td>16</td></tr>
    <tr><td>/29</td><td>255.255.255.248</td><td>8</td><td>6</td><td>8</td></tr>
    <tr><td>/30</td><td>255.255.255.252</td><td>4</td><td>2</td><td>4</td></tr>
  </tbody>
</table>
<p>Merkhilfe für die Maskenwerte: 128, 192, 224, 240, 248, 252, 254, 255 – jedes weitere Bit addiert die nächste Zweierpotenz (128 + 64 + 32 …).</p>

<h6>Rechenweg mit der Blockgröße</h6>
<p>Beispiel: <code>10.20.37.200/21</code></p>
<ol>
  <li><strong>Maske</strong>: /21 = 8 + 8 + 5 Bit → 255.255.<strong>248</strong>.0. Das „interessante“ Oktett ist das dritte.</li>
  <li><strong>Blockgröße</strong> = 256 − 248 = <strong>8</strong>. Netze beginnen im dritten Oktett bei 0, 8, 16, 24, 32, 40 …</li>
  <li><strong>Netzadresse</strong>: größtes Vielfaches von 8, das ≤ 37 ist → 32 → <code>10.20.32.0</code></li>
  <li><strong>Broadcast</strong>: nächstes Netz (40) minus 1 → <code>10.20.39.255</code></li>
  <li><strong>Hosts</strong>: <code>10.20.32.1</code> bis <code>10.20.39.254</code>, also 2<sup>11</sup> − 2 = 2046</li>
</ol>
<div class="lf-pruefung"><strong>Prüfungstipp:</strong> Schreib bei jeder Subnetting-Aufgabe zuerst Maske und Blockgröße auf. Steht das interessante Oktett nicht an letzter Stelle,
haben alle folgenden Oktette in der Netzadresse 0 und im Broadcast 255.</div>

<h6>Gleich große Subnetze bilden</h6>
<p>Jedes vom Hostanteil „geliehene“ Bit verdoppelt die Zahl der Subnetze und halbiert ihre Größe. Für <em>n</em> Subnetze braucht man ⌈log<sub>2</sub> n⌉ Bit.
<code>192.168.10.0/24</code> in vier Netze: 2 Bit leihen → /26 mit Blockgröße 64 → <code>.0</code>, <code>.64</code>, <code>.128</code>, <code>.192</code>, je 62 Hosts.</p>

<h6>VLSM: Subnetze nach Bedarf</h6>
<p>Gleich große Netze verschwenden Adressen, wenn die Abteilungen unterschiedlich groß sind. Mit <strong>VLSM</strong> (Variable Length Subnet Mask)
bekommt jedes Netz das kleinste passende Präfix. Wichtig ist die Reihenfolge: <strong>größte Anforderung zuerst</strong>, dann liegen alle Netze lückenlos
auf ihren Blockgrenzen.</p>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf9/vlsm.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="192.168.50.0/24 mit VLSM aufgeteilt: /25 für Produktion, /26 Verwaltung, /27 Gäste, /28 Server, zwei /30-Transfernetze, ein /29 bleibt frei">
  <figcaption class="figure-caption">Ein /24 für sechs Netze unterschiedlicher Größe</figcaption>
</figure>
<p>Vorgehen je Netz: Hosts + 2 (Netz und Broadcast) aufrunden auf die nächste Zweierpotenz. 100 Hosts → 102 → 128 Adressen → /25.
50 → 52 → 64 → /26. 20 → 22 → 32 → /27. 10 → 12 → 16 → /28. Verbindungen zwischen zwei Routern brauchen 2 Adressen → /30.</p>

<h6>Zusammenfassen (Supernetting)</h6>
<p>Umgekehrt lassen sich benachbarte Netze für die Routingtabelle zusammenfassen: <code>192.168.0.0/24</code> bis <code>192.168.3.0/24</code> haben die ersten 22 Bit gemeinsam
→ eine Route <code>192.168.0.0/22</code>. Das klappt nur, wenn die Netze lückenlos sind und das erste auf einer passenden Blockgrenze beginnt.</p>

<h6>Besondere Adressbereiche</h6>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th>Bereich</th><th>Bedeutung</th></tr></thead>
  <tbody>
    <tr><td>10.0.0.0/8, 172.16.0.0/12, 192.168.0.0/16</td><td>private Netze (RFC 1918), im Internet nicht geroutet → NAT nötig (<a href="/Learningfields/LF9/kapitel6.php">Kapitel 6</a>)</td></tr>
    <tr><td>127.0.0.0/8</td><td>Loopback, <code>127.0.0.1</code> = der eigene Rechner</td></tr>
    <tr><td>169.254.0.0/16</td><td>APIPA / Link-Local: selbst vergeben, wenn kein DHCP-Server antwortet – ein Warnsignal bei der Fehlersuche</td></tr>
    <tr><td>100.64.0.0/10</td><td>Carrier-Grade NAT beim Provider</td></tr>
    <tr><td>224.0.0.0/4</td><td>Multicast</td></tr>
    <tr><td>0.0.0.0/0</td><td>Default-Route („alle Ziele“)</td></tr>
    <tr><td>255.255.255.255</td><td>Broadcast im eigenen Netz</td></tr>
  </tbody>
</table>
<p>Die alten Adressklassen A (/8), B (/16) und C (/24) begegnen dir noch in älteren Texten; heute gilt klassenloses Routing (CIDR).</p>

<h6>Übungen mit Lösung</h6>
<p>1. Bestimme Netzadresse und Broadcast von <code>172.16.45.14/20</code>.</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Maske 255.255.240.0, Blockgröße 16 im dritten Oktett. 45 liegt zwischen 32 und 48 → Netz <code>172.16.32.0</code>, Broadcast <code>172.16.47.255</code>.</p>
</details>
<p>2. Liegen <code>192.168.5.130/25</code> und <code>192.168.5.100/25</code> im selben Netz?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Nein. Blockgröße 128: .100 gehört zu <code>192.168.5.0/25</code>, .130 zu <code>192.168.5.128/25</code>. Die beiden brauchen einen Router.</p>
</details>
<p>3. <code>172.16.0.0/16</code> soll in Subnetze mit jeweils mindestens 500 Hosts geteilt werden. Welches Präfix, wie viele Subnetze?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">500 + 2 = 502 → 512 = 2<sup>9</sup> → 9 Hostbits → <strong>/23</strong> (510 Hosts). Geliehen werden 23 − 16 = 7 Bit → 2<sup>7</sup> = <strong>128 Subnetze</strong>.</p>
</details>
<p>4. Ein PC hat die Adresse <code>169.254.31.7</code>. Was ist los?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Er hat keine Antwort von einem DHCP-Server bekommen und sich selbst eine APIPA-Adresse gegeben. Prüfen: Kabel/WLAN, VLAN des Ports, DHCP-Server bzw. DHCP-Relay.</p>
</details>
INHALT,
    'summary' => [
        'IPv4: 32 Bit; das Präfix trennt Netz- und Hostanteil, die Maske drückt dasselbe aus.',
        'Netzadresse = Hostbits 0, Broadcast = Hostbits 1, nutzbar 2^h − 2.',
        'Blockgröße = 256 − Maskenwert im interessanten Oktett; Netze beginnen auf Vielfachen davon.',
        'VLSM: größte Anforderung zuerst, je Netz das kleinste passende Präfix; Router-Links /30.',
        'Privat: 10/8, 172.16/12, 192.168/16; 169.254/16 bedeutet „kein DHCP erreicht“.',
    ],
    'quiz' => [
        ['question' => 'Wie viele nutzbare Adressen hat ein /27?', 'answer' => '30 (32 Adressen minus Netz und Broadcast).'],
        ['question' => 'Welche Maske gehört zu /22?', 'answer' => '255.255.252.0'],
        ['question' => 'Netzadresse von 192.168.10.77/26?', 'answer' => '192.168.10.64 (Blockgröße 64, Broadcast .127).'],
        ['question' => 'Warum beginnt man bei VLSM mit dem größten Netz?', 'answer' => 'Damit alle Netze auf ihren Blockgrenzen lückenlos hintereinander passen und keine Adressen verschwendet werden.'],
        ['question' => 'Welche drei Bereiche sind nach RFC 1918 privat?', 'answer' => '10.0.0.0/8, 172.16.0.0/12 und 192.168.0.0/16.'],
    ],
];
