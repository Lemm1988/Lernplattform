<?php
return [
    'title' => 'Clients im IP-Netz: Adresse, Maske, Gateway, DNS',
    'intro' => 'Damit ein Client mitreden kann, braucht er vier Angaben. Wer weiß, wofür jede davon da ist, erkennt an den Symptomen sofort, welche falsch ist.',
    'goals' => [
        'die vier IP-Einstellungen eines Clients erklären',
        'entscheiden, ob ein Ziel lokal oder über das Gateway erreicht wird',
        'die Aufgabe von ARP beschreiben',
        'statische und dynamische Adressvergabe abwägen',
        'Fehlkonfigurationen an ihren Symptomen erkennen und mit Bordmitteln prüfen',
    ],
    'content' => <<<'INHALT'
<h6>Vier Angaben</h6>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th>Einstellung</th><th>Beispiel</th><th>wofür</th></tr></thead>
  <tbody>
    <tr><td>IP-Adresse</td><td><code>192.168.10.23</code></td><td>eindeutige Adresse des Clients im Netz</td></tr>
    <tr><td>Subnetzmaske / Präfix</td><td><code>255.255.255.0</code> bzw. <code>/24</code></td><td>welcher Teil der Adresse das Netz bezeichnet – wer ist „lokal“?</td></tr>
    <tr><td>Standardgateway</td><td><code>192.168.10.1</code></td><td>Router, an den alles für fremde Netze geht</td></tr>
    <tr><td>DNS-Server</td><td><code>192.168.10.5</code></td><td>übersetzt Namen in IP-Adressen</td></tr>
  </tbody>
</table>
<p>Eine IPv4-Adresse hat 32 Bit in vier Oktetten. Bei <code>/24</code> sind die ersten drei Oktette das Netz, das letzte die Geräte – 254 nutzbare Adressen
(.0 ist die Netzadresse, .255 der Broadcast). Wie man beliebige Netze berechnet, steht in <a href="/Learningfields/LF9/kapitel4.php">LF9 Kapitel 4</a>.
Private Bereiche für interne Netze: <code>10.0.0.0/8</code>, <code>172.16.0.0/12</code>, <code>192.168.0.0/16</code>.</p>

<h6>Lokal oder über das Gateway?</h6>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf3/lokal-oder-gateway.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Der Client vergleicht per UND-Verknüpfung mit der Maske, ob das Ziel im eigenen Netz liegt; lokal sendet er direkt, sonst an das Standardgateway">
  <figcaption class="figure-caption">Die Maske entscheidet, wohin der Frame geht</figcaption>
</figure>
<p><strong>ARP</strong> (Address Resolution Protocol) findet zu einer IP-Adresse im lokalen Netz die MAC-Adresse: Der Client fragt per Broadcast
„Wer hat 192.168.10.1?“, das Gerät mit dieser Adresse antwortet mit seiner MAC. Das Ergebnis landet im ARP-Cache (<code>arp -a</code>). Bei IPv6 übernimmt das NDP.</p>

<h6>Statisch oder per DHCP?</h6>
<ul>
  <li><strong>DHCP</strong> für Clients: keine Tipparbeit, keine doppelten Adressen, Änderungen (z. B. neuer DNS-Server) zentral (<a href="/Learningfields/LF9/kapitel7.php">LF9 Kapitel 7</a>).</li>
  <li><strong>Statisch</strong> für Infrastruktur, die immer unter derselben Adresse erreichbar sein muss: Router, Server, Switches, Drucker – außerhalb des DHCP-Bereichs.</li>
  <li><strong>DHCP-Reservierung</strong> als Mittelweg: Der Server gibt einem Gerät anhand seiner MAC-Adresse immer dieselbe Adresse, verwaltet bleibt alles zentral.</li>
</ul>

<h6>Prüfen unter Windows</h6>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th>Befehl</th><th>zeigt bzw. tut</th></tr></thead>
  <tbody>
    <tr><td><code>ipconfig /all</code></td><td>alle Einstellungen: IP, Maske, Gateway, DNS, MAC, DHCP-Server, Lease</td></tr>
    <tr><td><code>ipconfig /release</code>, <code>ipconfig /renew</code></td><td>DHCP-Adresse abgeben und neu anfordern</td></tr>
    <tr><td><code>ipconfig /flushdns</code></td><td>DNS-Cache leeren</td></tr>
    <tr><td><code>ping 192.168.10.1</code></td><td>Erreichbarkeit (ICMP Echo) – Firewalls können Ping blockieren</td></tr>
    <tr><td><code>tracert www.example.org</code></td><td>Weg über die Router</td></tr>
    <tr><td><code>nslookup www.example.org</code></td><td>Namensauflösung prüfen</td></tr>
    <tr><td><code>Test-NetConnection server -Port 445</code></td><td>(PowerShell) Erreicht der Client einen bestimmten Port?</td></tr>
  </tbody>
</table>

<h6>Symptome und Ursachen</h6>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th>Symptom</th><th>wahrscheinliche Ursache</th></tr></thead>
  <tbody>
    <tr><td>Adresse <code>169.254.x.x</code></td><td>kein DHCP-Server erreicht (Kabel, VLAN, DHCP-Dienst)</td></tr>
    <tr><td>lokale Geräte erreichbar, Internet und andere Netze nicht</td><td>Gateway falsch oder fehlt</td></tr>
    <tr><td><code>ping 8.8.8.8</code> geht, Namen werden nicht aufgelöst</td><td>DNS-Server falsch oder nicht erreichbar</td></tr>
    <tr><td>manche Geräte im eigenen Netz nicht erreichbar, andere Netze teils doch</td><td>Subnetzmaske falsch</td></tr>
    <tr><td>Windows meldet einen Adresskonflikt</td><td>IP-Adresse doppelt vergeben (statisch im DHCP-Bereich)</td></tr>
  </tbody>
</table>

<h6>Übungen mit Lösung</h6>
<p>1. Ein PC hat <code>192.168.1.50/25</code>. Erreicht er <code>192.168.1.100</code> und <code>192.168.1.200</code> direkt oder über das Gateway?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">/25 = 255.255.255.128. Der PC liegt in <code>192.168.1.0/25</code> (.0–.127). <code>.100</code> liegt im selben Netz → direkt.
<code>.200</code> UND Maske = <code>192.168.1.128</code> → anderes Netz → über das Gateway.</p>
</details>
<p>2. Ein PC hat <code>192.168.10.23</code>, aber versehentlich die Maske <code>255.255.0.0</code>, Gateway <code>192.168.10.1</code>. Ein Server liegt in <code>192.168.20.5/24</code>. Was passiert?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Mit /16 hält der PC <code>192.168.20.5</code> für lokal und fragt per ARP direkt nach dessen MAC – im eigenen Segment antwortet niemand.
Der Server bleibt unerreichbar, obwohl das Gateway richtig eingetragen ist. Lösung: Maske korrigieren bzw. DHCP verwenden.</p>
</details>
<p>3. Ein neuer Netzwerkdrucker soll immer unter derselben Adresse erreichbar sein, die Adressen sollen aber zentral verwaltet bleiben. Was richtest du ein?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Eine DHCP-Reservierung für die MAC-Adresse des Druckers. Alternativ eine statische Adresse außerhalb des DHCP-Bereichs, sauber dokumentiert.</p>
</details>
INHALT,
    'summary' => [
        'Ein Client braucht IP-Adresse, Subnetzmaske, Standardgateway und DNS-Server.',
        'Per UND mit der Maske prüft er, ob das Ziel lokal liegt; sonst sendet er an das Gateway.',
        'ARP ermittelt im lokalen Netz die MAC-Adresse zur IP-Adresse.',
        'Clients per DHCP, Infrastruktur statisch oder per DHCP-Reservierung.',
        'Symptome verraten den Fehler: 169.254 = kein DHCP, nur lokal = Gateway, IP ja/Namen nein = DNS.',
    ],
    'quiz' => [
        ['question' => 'Welche vier IP-Einstellungen braucht ein Client?', 'answer' => 'IP-Adresse, Subnetzmaske, Standardgateway und DNS-Server.'],
        ['question' => 'Wofür ist das Standardgateway zuständig?', 'answer' => 'Es ist der Router, an den der Client alle Pakete für fremde Netze schickt.'],
        ['question' => 'Was macht ARP?', 'answer' => 'Es ermittelt im lokalen Netz die MAC-Adresse zu einer IP-Adresse.'],
        ['question' => 'Ein PC erreicht Server per IP, aber nicht per Namen. Was ist wahrscheinlich falsch?', 'answer' => 'Der DNS-Server ist falsch eingetragen oder nicht erreichbar.'],
    ],
];
