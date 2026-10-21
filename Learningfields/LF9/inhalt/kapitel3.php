<?php
return [
    'title' => 'VLANs: Netze logisch trennen',
    'intro' => 'Verwaltung, Produktion und Gäste sollen sich nicht sehen – aber alle hängen an denselben Switches. VLANs trennen die Netze logisch, ohne neue Kabel.',
    'goals' => [
        'Gründe für VLANs nennen',
        'Access- und Trunk-Ports unterscheiden und einem Einsatzzweck zuordnen',
        'den Aufbau des 802.1Q-Tags beschreiben',
        'Inter-VLAN-Routing mit Router-on-a-Stick und Layer-3-Switch erklären',
        'einen VLAN- und Adressplan für ein kleines Unternehmen erstellen',
    ],
    'content' => <<<'INHALT'
<h6>Warum VLANs?</h6>
<p>Ein <strong>Virtual LAN</strong> teilt einen physischen Switch in mehrere logische Switches. Jedes VLAN ist eine eigene <strong>Broadcastdomäne</strong> und bekommt ein eigenes IP-Subnetz.</p>
<ul>
  <li><strong>Sicherheit:</strong> Gäste-WLAN und Firmennetz sind getrennt; Übergänge laufen über Router oder Firewall, wo Regeln greifen.</li>
  <li><strong>Leistung:</strong> Broadcasts bleiben im eigenen VLAN.</li>
  <li><strong>Flexibilität:</strong> Die Zugehörigkeit hängt am Port-Profil, nicht am Raum. Zieht die Buchhaltung um, ändert man die Konfiguration statt der Verkabelung.</li>
  <li><strong>Kosten:</strong> Ein Switch statt drei getrennter.</li>
</ul>

<h6>Access- und Trunk-Ports</h6>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf9/vlan-trunk.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Zwei Switches mit Geräten in VLAN 10 und 20, verbunden über einen Trunk; ein Router verbindet die VLANs über Subinterfaces">
  <figcaption class="figure-caption">Access-Ports ohne Tag, Trunks mit Tag, Routing zwischen den VLANs</figcaption>
</figure>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th></th><th>Access-Port</th><th>Trunk-Port</th></tr></thead>
  <tbody>
    <tr><td>VLANs</td><td>genau eines</td><td>mehrere</td></tr>
    <tr><td>Frames</td><td>ohne Tag – das Endgerät merkt nichts vom VLAN</td><td>mit 802.1Q-Tag, damit der Empfänger das VLAN erkennt</td></tr>
    <tr><td>angeschlossen</td><td>PC, Drucker, Kamera</td><td>anderer Switch, Router, Access Point mit mehreren SSIDs, Virtualisierungshost</td></tr>
  </tbody>
</table>
<p>Ein Trunk hat ein <strong>Native VLAN</strong>, dessen Frames ohne Tag übertragen werden (Standard: VLAN 1). Aus Sicherheitsgründen legt man es auf ein ungenutztes VLAN
und benutzt VLAN 1 nicht für Endgeräte – sonst sind Angriffe wie <em>VLAN Hopping</em> leichter.</p>

<h6>Der 802.1Q-Tag</h6>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf9/8021q-tag.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Der 4 Byte lange 802.1Q-Tag zwischen Quell-MAC und EtherType mit TPID, PCP, DEI und 12 Bit VLAN-ID">
  <figcaption class="figure-caption">Vier Byte zwischen Quell-MAC und EtherType</figcaption>
</figure>
<p>Das Feld <strong>PCP</strong> (Priority Code Point) wird für Quality of Service genutzt: Sprachdaten von IP-Telefonen bekommen eine hohe Priorität,
damit Gespräche bei Last nicht stocken.</p>

<h6>Inter-VLAN-Routing</h6>
<p>Zwischen VLANs gibt es auf Schicht 2 keine Verbindung. Soll Verkehr fließen, muss er geroutet werden – und genau dort kann man ihn filtern.</p>
<ul>
  <li><strong>Router-on-a-Stick:</strong> ein Router-Port als Trunk, darauf ein Subinterface je VLAN. Günstig, aber alle Daten teilen sich einen Link.</li>
  <li><strong>Layer-3-Switch:</strong> der Switch routet selbst, je VLAN ein virtuelles Interface (SVI). Schnell, Standard in größeren Netzen.</li>
</ul>
<p>So könnte die Konfiguration im verbreiteten Cisco-IOS-Stil aussehen (andere Hersteller nutzen andere Befehle, die Begriffe sind dieselben):</p>
<pre><code>vlan 10
 name Verwaltung
vlan 20
 name Produktion

interface GigabitEthernet0/1
 switchport mode access
 switchport access vlan 10

interface GigabitEthernet0/24
 switchport mode trunk
 switchport trunk allowed vlan 10,20

! auf dem Router: Subinterface für VLAN 10
interface GigabitEthernet0/0.10
 encapsulation dot1Q 10
 ip address 192.168.10.1 255.255.255.0</code></pre>

<h6>Beispiel: VLAN- und Adressplan</h6>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th>VLAN</th><th>Name</th><th>Netz</th><th>Gateway</th><th>Darf zu …</th></tr></thead>
  <tbody>
    <tr><td>10</td><td>Verwaltung</td><td>192.168.10.0/24</td><td>192.168.10.1</td><td>Server, Internet</td></tr>
    <tr><td>20</td><td>Produktion</td><td>192.168.20.0/24</td><td>192.168.20.1</td><td>Server</td></tr>
    <tr><td>30</td><td>Gäste</td><td>192.168.30.0/24</td><td>192.168.30.1</td><td>nur Internet</td></tr>
    <tr><td>40</td><td>Server</td><td>192.168.40.0/24</td><td>192.168.40.1</td><td>Internet (Updates)</td></tr>
    <tr><td>99</td><td>Management</td><td>192.168.99.0/24</td><td>192.168.99.1</td><td>nur von Admin-PCs erreichbar</td></tr>
  </tbody>
</table>
<div class="lf-merke"><strong>Merke:</strong> Ein VLAN = eine Broadcastdomäne = ein IP-Subnetz. Ohne Router (oder Layer-3-Switch) gibt es keine Kommunikation zwischen VLANs.
DHCP-Anfragen sind Broadcasts – für einen zentralen DHCP-Server braucht der Router deshalb ein <em>DHCP-Relay</em> (<a href="/Learningfields/LF9/kapitel7.php">Kapitel 7</a>).</div>

<h6>Übungen mit Lösung</h6>
<p>1. PC 1 (VLAN 10) und PC 2 (VLAN 20) hängen am selben Switch, ein Router ist nicht vorhanden. Klappt ein <code>ping</code>?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Nein. Die VLANs sind getrennte Broadcastdomänen und Subnetze; ohne Router gibt es keinen Weg zwischen ihnen – auch nicht auf demselben Switch.</p>
</details>
<p>2. Ein Access Point strahlt die SSIDs „Firma“ (VLAN 10) und „Gast“ (VLAN 30) aus. Wie wird sein Switch-Port konfiguriert?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Als <strong>Trunk</strong> mit den VLANs 10 und 30 (und ggf. dem Management-VLAN). Der Access Point ordnet jede SSID einem VLAN zu und taggt die Frames entsprechend.</p>
</details>
<p>3. Wie viele VLANs lassen sich mit 802.1Q nutzen, und warum?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">4094. Die VLAN-ID hat 12 Bit, also 2<sup>12</sup> = 4096 Werte; 0 und 4095 sind reserviert.</p>
</details>
INHALT,
    'summary' => [
        'VLAN = logische Trennung eines Switches; jedes VLAN ist eine eigene Broadcastdomäne mit eigenem Subnetz.',
        'Access-Port: ein VLAN, ohne Tag. Trunk-Port: mehrere VLANs, mit 802.1Q-Tag.',
        '802.1Q-Tag: 4 Byte mit TPID 0x8100, Priorität (PCP) und 12 Bit VLAN-ID (1–4094 nutzbar).',
        'Zwischen VLANs wird geroutet: Router-on-a-Stick (Subinterfaces) oder Layer-3-Switch (SVIs).',
        'Native VLAN nicht auf VLAN 1 lassen, VLAN 1 nicht für Endgeräte nutzen.',
    ],
    'quiz' => [
        ['question' => 'Was ist der Unterschied zwischen einem Access- und einem Trunk-Port?', 'answer' => 'Access: genau ein VLAN, Frames ohne Tag. Trunk: mehrere VLANs, Frames mit 802.1Q-Tag.'],
        ['question' => 'Wie viele Bit hat die VLAN-ID?', 'answer' => '12 Bit – 4096 Werte, davon 4094 nutzbar.'],
        ['question' => 'Was braucht man, damit zwei VLANs kommunizieren können?', 'answer' => 'Einen Router oder Layer-3-Switch (Inter-VLAN-Routing).'],
        ['question' => 'Was ist Router-on-a-Stick?', 'answer' => 'Ein Router-Port als Trunk mit einem Subinterface je VLAN, das als Gateway dient.'],
        ['question' => 'Wofür wird das PCP-Feld genutzt?', 'answer' => 'Für die Priorität (QoS), z. B. damit Sprachdaten bevorzugt werden.'],
    ],
];
