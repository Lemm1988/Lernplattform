<?php
return [
    'title' => 'IPv6: Adressen, Präfixe, Autokonfiguration',
    'intro' => 'IPv4-Adressen sind seit Jahren aufgebraucht. IPv6 bietet 2^128 Adressen und vereinfacht vieles – wenn man die Schreibweise und die Adressarten sicher beherrscht.',
    'goals' => [
        'IPv6-Adressen kürzen und wieder ausschreiben',
        'Präfix, Subnetz-ID und Interface-ID unterscheiden',
        'Adressarten (Global Unicast, Unique Local, Link-Local, Multicast) erkennen',
        'SLAAC und DHCPv6 vergleichen',
        'IPv4 und IPv6 gegenüberstellen und Übergangstechniken nennen',
    ],
    'content' => <<<'INHALT'
<h6>Schreibweise</h6>
<p>Eine IPv6-Adresse hat <strong>128 Bit</strong>, geschrieben als acht Blöcke zu je vier Hexziffern (16 Bit), getrennt durch Doppelpunkte.</p>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf9/ipv6-aufbau.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="128 Bit: 48 Bit Global Routing Prefix, 16 Bit Subnetz-ID, 64 Bit Interface-ID; darunter das Kürzen von 2001:0db8:0a0b:0000:0000:0000:00ff:0001 zu 2001:db8:a0b::ff:1">
  <figcaption class="figure-caption">Aufbau einer typischen Adresse und die zwei Kürzungsregeln</figcaption>
</figure>
<ol>
  <li>Führende Nullen in jedem Block dürfen entfallen: <code>0db8</code> → <code>db8</code>, <code>0000</code> → <code>0</code>.</li>
  <li><strong>Eine</strong> zusammenhängende Folge von Null-Blöcken darf durch <code>::</code> ersetzt werden – die längste, bei Gleichstand die erste.</li>
</ol>
<p>Netze werden wie bei IPv4 mit Präfix angegeben: <code>2001:db8:a0b:12::/64</code>. In URLs steht die Adresse in eckigen Klammern: <code>http://[2001:db8::1]:8080/</code>.</p>

<h6>Präfixe und Subnetze</h6>
<p>Ein Subnetz hat bei IPv6 praktisch immer <strong>/64</strong>: 64 Bit Netz, 64 Bit Interface-ID. Ein Unternehmen bekommt vom Provider meist ein <strong>/48</strong>
(16 Bit Subnetz-ID → 65 536 Subnetze) oder ein <strong>/56</strong> (256 Subnetze), ein Privatanschluss oft ein /56.
„Subnetting“ heißt hier nur noch: die Subnetz-ID hochzählen – <code>2001:db8:4a00:0::/64</code>, <code>…:1::/64</code>, <code>…:2::/64</code> usw.
Es gibt weder Adressknappheit noch eine Broadcastadresse, die man abziehen müsste.</p>

<h6>Adressarten</h6>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th>Art</th><th>Bereich</th><th>Bedeutung</th></tr></thead>
  <tbody>
    <tr><td>Global Unicast (GUA)</td><td><code>2000::/3</code> (beginnt mit 2 oder 3)</td><td>weltweit eindeutig und routbar – wie eine öffentliche IPv4-Adresse</td></tr>
    <tr><td>Unique Local (ULA)</td><td><code>fc00::/7</code>, genutzt <code>fd00::/8</code></td><td>intern, nicht im Internet geroutet – vergleichbar mit privaten IPv4-Netzen</td></tr>
    <tr><td>Link-Local</td><td><code>fe80::/10</code></td><td>jedes IPv6-Interface hat eine; gilt nur im eigenen Segment, Router leiten sie nicht weiter</td></tr>
    <tr><td>Multicast</td><td><code>ff00::/8</code></td><td><code>ff02::1</code> = alle Knoten, <code>ff02::2</code> = alle Router im Segment</td></tr>
    <tr><td>Loopback</td><td><code>::1</code></td><td>der eigene Rechner (wie 127.0.0.1)</td></tr>
    <tr><td>unspezifiziert</td><td><code>::</code></td><td>„noch keine Adresse“; <code>::/0</code> ist die Default-Route</td></tr>
    <tr><td>Dokumentation</td><td><code>2001:db8::/32</code></td><td>für Beispiele reserviert – deshalb taucht es hier überall auf</td></tr>
  </tbody>
</table>
<div class="lf-merke"><strong>Merke:</strong> IPv6 kennt <strong>keinen Broadcast</strong>. Seine Aufgaben übernimmt Multicast. ARP wird durch das
<strong>Neighbor Discovery Protocol</strong> (NDP, über ICMPv6) ersetzt – deshalb darf eine Firewall ICMPv6 nicht pauschal blockieren.</div>

<h6>Die Interface-ID</h6>
<ul>
  <li><strong>EUI-64</strong>: aus der MAC-Adresse abgeleitet. MAC teilen, <code>FFFE</code> in die Mitte setzen, das siebte Bit (U/L-Bit) umdrehen:
    <code>3C:52:82:1A:7F:04</code> → <code>3e52:82ff:fe1a:7f04</code> (0x3C = 0011 1100 → 0011 1110 = 0x3E).</li>
  <li><strong>Zufällig</strong> (Privacy Extensions): Clients nutzen heute meist zufällige, regelmäßig wechselnde IDs, damit man ein Gerät nicht über die MAC-Adresse verfolgen kann.</li>
  <li><strong>Manuell oder per DHCPv6</strong>: für Server und Router, deren Adresse sich nicht ändern darf.</li>
</ul>

<h6>Autokonfiguration: SLAAC und DHCPv6</h6>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf9/slaac.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="SLAAC-Ablauf: Link-Local bilden, Router Solicitation an ff02::2, Router Advertisement mit Präfix, globale Adresse bilden und per DAD prüfen">
  <figcaption class="figure-caption">Stateless Address Autoconfiguration – ganz ohne DHCP-Server</figcaption>
</figure>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th>Verfahren</th><th>Adresse kommt von</th><th>Weitere Infos (DNS)</th></tr></thead>
  <tbody>
    <tr><td>SLAAC</td><td>Präfix aus dem Router Advertisement + eigene Interface-ID</td><td>RDNSS im Router Advertisement</td></tr>
    <tr><td>SLAAC + stateless DHCPv6 (O-Flag)</td><td>wie SLAAC</td><td>DHCPv6-Server</td></tr>
    <tr><td>stateful DHCPv6 (M-Flag)</td><td>DHCPv6-Server, der die Vergabe protokolliert</td><td>DHCPv6-Server</td></tr>
  </tbody>
</table>
<p>Das Standardgateway kommt bei IPv6 immer aus dem Router Advertisement – auch bei DHCPv6. Es ist die Link-Local-Adresse des Routers.</p>

<h6>IPv4 und IPv6 im Vergleich</h6>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th></th><th>IPv4</th><th>IPv6</th></tr></thead>
  <tbody>
    <tr><td>Adresslänge</td><td>32 Bit, dezimal</td><td>128 Bit, hexadezimal</td></tr>
    <tr><td>Header</td><td>20–60 Byte, mit Prüfsumme</td><td>fest 40 Byte, ohne Prüfsumme, Erweiterungen in Extension Headern</td></tr>
    <tr><td>Lebensdauer</td><td>TTL</td><td>Hop Limit</td></tr>
    <tr><td>Adressauflösung</td><td>ARP (Broadcast)</td><td>NDP (Multicast, ICMPv6)</td></tr>
    <tr><td>Konfiguration</td><td>manuell oder DHCP</td><td>manuell, SLAAC oder DHCPv6</td></tr>
    <tr><td>NAT</td><td>wegen Adressmangel üblich</td><td>nicht nötig, Ende-zu-Ende-Adressierung</td></tr>
    <tr><td>Fragmentierung</td><td>durch Router und Sender</td><td>nur durch den Sender (Path MTU Discovery)</td></tr>
  </tbody>
</table>
<p><strong>Übergang:</strong> <em>Dual Stack</em> (beide Protokolle parallel, am häufigsten), <em>Tunnel</em> (IPv6 in IPv4 verpackt oder umgekehrt),
<em>NAT64/DNS64</em> (reine IPv6-Clients erreichen IPv4-Server). Viele Internetanschlüsse in Deutschland nutzen <em>DS-Lite</em>: echtes IPv6, IPv4 nur noch
über einen Tunnel mit Carrier-Grade NAT beim Provider – deshalb sind solche Anschlüsse per IPv4 von außen nicht erreichbar.</p>

<h6>Übungen mit Lösung</h6>
<p>1. Kürze <code>2001:0db8:0000:0000:0000:ff00:0042:8329</code> so weit wie möglich.</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2"><code>2001:db8::ff00:42:8329</code></p>
</details>
<p>2. Schreibe <code>fe80::1:2a</code> vollständig aus. Was für eine Adresse ist das?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2"><code>fe80:0000:0000:0000:0000:0000:0001:002a</code> – eine Link-Local-Adresse, nur im eigenen Segment gültig.</p>
</details>
<p>3. Warum ist <code>2001:db8::5::7</code> ungültig?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2"><code>::</code> kommt zweimal vor. Man kann nicht erkennen, wie sich die vier fehlenden Null-Blöcke auf die beiden Stellen verteilen.</p>
</details>
<p>4. Ein Unternehmen hat <code>2001:db8:4a00::/48</code>. Wie viele /64-Subnetze sind möglich, und wie lautet das dritte?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">64 − 48 = 16 Bit Subnetz-ID → 2<sup>16</sup> = 65 536 Subnetze. Das dritte (ID 2): <code>2001:db8:4a00:2::/64</code>.</p>
</details>
INHALT,
    'summary' => [
        'IPv6: 128 Bit, acht Hex-Blöcke; führende Nullen weglassen, eine Null-Folge durch :: ersetzen.',
        'Subnetze sind /64; Unternehmen bekommen meist ein /48 oder /56.',
        'GUA 2000::/3, ULA fd00::/8, Link-Local fe80::/10, Multicast ff00::/8, Loopback ::1.',
        'Kein Broadcast; NDP über ICMPv6 ersetzt ARP.',
        'SLAAC: Präfix aus dem Router Advertisement + eigene Interface-ID; DHCPv6 stateful (M) oder stateless (O).',
    ],
    'quiz' => [
        ['question' => 'Wie viele Bit hat eine IPv6-Adresse?', 'answer' => '128 Bit.'],
        ['question' => 'Wie oft darf :: in einer Adresse vorkommen?', 'answer' => 'Höchstens einmal.'],
        ['question' => 'Woran erkennt man eine Link-Local-Adresse?', 'answer' => 'Sie beginnt mit fe80 (Bereich fe80::/10).'],
        ['question' => 'Was ersetzt ARP bei IPv6?', 'answer' => 'Das Neighbor Discovery Protocol (NDP) über ICMPv6.'],
        ['question' => 'Woher bekommt ein Host bei SLAAC sein Präfix?', 'answer' => 'Aus dem Router Advertisement des Routers.'],
    ],
];
