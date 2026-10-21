<?php
return [
    'title' => 'Routing und NAT',
    'intro' => 'Sobald ein Paket das eigene Netz verlässt, entscheiden Router über seinen Weg. Und weil IPv4-Adressen knapp sind, schreibt der Router an der Grenze zum Internet die Absenderadresse um.',
    'goals' => [
        'eine Routingtabelle lesen und den Longest Prefix Match anwenden',
        'statische Routen und Default-Route einsetzen',
        'RIP, OSPF und BGP grob einordnen',
        'erklären, was sich auf dem Weg eines Pakets an MAC- und IP-Adressen ändert',
        'NAT, PAT und Portweiterleitung unterscheiden',
    ],
    'content' => <<<'INHALT'
<h6>Was ein Router tut</h6>
<p>Ein Router verbindet Netze auf Schicht 3. Für jedes Paket schaut er die <strong>Ziel-IP</strong> in seiner <strong>Routingtabelle</strong> nach und schickt es
über das passende Interface zum nächsten Router (<em>Next Hop</em>) – oder direkt zum Ziel, wenn das Netz an ihm hängt. Dabei zählt er die <strong>TTL</strong>
um 1 herunter; erreicht sie 0, verwirft er das Paket und meldet das per ICMP („Time Exceeded“). Genau das nutzt <code>traceroute</code>/<code>tracert</code>.</p>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf9/routing-tabelle.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="R1 verbindet LAN A mit R2 über ein Transfernetz; die Routingtabelle von R1 enthält zwei direkte Netze, eine statische Route und eine Default-Route">
  <figcaption class="figure-caption">Direkt angeschlossene Netze kennt der Router von selbst, alles andere muss er lernen</figcaption>
</figure>

<h6>Longest Prefix Match</h6>
<p>Passen mehrere Einträge, gewinnt der <strong>spezifischste</strong> – der mit dem längsten Präfix. Die Default-Route <code>0.0.0.0/0</code> passt immer,
hat aber das kürzeste Präfix und greift deshalb nur, wenn nichts anderes passt.</p>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th>Eintrag</th><th>Ziel 10.1.2.77</th><th>Ziel 10.1.5.5</th><th>Ziel 10.200.1.1</th><th>Ziel 8.8.8.8</th></tr></thead>
  <tbody>
    <tr><td>10.0.0.0/8 → A</td><td>passt</td><td>passt</td><td><strong>passt ✓</strong></td><td>–</td></tr>
    <tr><td>10.1.0.0/16 → B</td><td>passt</td><td><strong>passt ✓</strong></td><td>–</td><td>–</td></tr>
    <tr><td>10.1.2.0/24 → C</td><td><strong>passt ✓</strong></td><td>–</td><td>–</td><td>–</td></tr>
    <tr><td>0.0.0.0/0 → D</td><td>passt</td><td>passt</td><td>passt</td><td><strong>passt ✓</strong></td></tr>
  </tbody>
</table>

<h6>Wie Routen in die Tabelle kommen</h6>
<ul>
  <li><strong>Direkt angeschlossen</strong> (connected): Netze an den eigenen Interfaces.</li>
  <li><strong>Statisch</strong>: vom Admin eingetragen. Übersichtlich und sicher, passt sich aber nicht an Ausfälle an – gut für kleine Netze und die Default-Route.</li>
  <li><strong>Dynamisch</strong>: Router tauschen per Routingprotokoll Informationen aus und reagieren auf Ausfälle.</li>
</ul>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th>Protokoll</th><th>Typ</th><th>Metrik</th><th>Einsatz</th></tr></thead>
  <tbody>
    <tr><td>RIP</td><td>Distanzvektor: Router kennt nur Entfernung und Richtung</td><td>Hops, max. 15</td><td>kleine, ältere Netze</td></tr>
    <tr><td>OSPF</td><td>Link-State: jeder Router kennt die ganze Topologie, berechnet kürzeste Wege (Dijkstra)</td><td>Kosten aus der Bandbreite</td><td>Unternehmensnetze (IGP)</td></tr>
    <tr><td>BGP</td><td>Pfadvektor zwischen autonomen Systemen</td><td>Pfadattribute, Richtlinien</td><td>Internet, zwischen Providern (EGP)</td></tr>
  </tbody>
</table>
<p>Kennt ein Router dasselbe Ziel aus mehreren Quellen, entscheidet die Vertrauenswürdigkeit der Quelle. Bei Cisco heißt sie <em>administrative Distanz</em>:
direkt 0, statisch 1, OSPF 110, RIP 120 – kleiner ist besser.</p>

<h6>Was sich unterwegs ändert</h6>
<p>PC A (LAN A) schickt ein Paket an einen Server in LAN B. Ziel-IP liegt nicht im eigenen Netz → der PC schickt den Frame an die MAC-Adresse seines <strong>Gateways</strong> (per ARP ermittelt).</p>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th>Abschnitt</th><th>Quell-MAC → Ziel-MAC</th><th>Quell-IP → Ziel-IP</th></tr></thead>
  <tbody>
    <tr><td>PC A → R1</td><td>PC A → R1 (G0/0)</td><td rowspan="3" class="align-middle">PC A → Server – bleibt gleich</td></tr>
    <tr><td>R1 → R2</td><td>R1 (G0/1) → R2 (G0/1)</td></tr>
    <tr><td>R2 → Server</td><td>R2 → Server</td></tr>
  </tbody>
</table>
<div class="lf-merke"><strong>Merke:</strong> MAC-Adressen gelten nur von Hop zu Hop und werden von jedem Router neu gesetzt. IP-Adressen gelten Ende zu Ende –
außer NAT schreibt sie um.</div>

<h6>NAT und PAT</h6>
<p>Private Adressen (RFC 1918) werden im Internet nicht geroutet. Der Router an der Grenze ersetzt deshalb beim Hinausgehen die private Quelladresse durch seine
öffentliche und merkt sich die Zuordnung. Weil sich viele Geräte eine öffentliche Adresse teilen, unterscheidet er sie über den Port: <strong>PAT</strong>
(Port Address Translation, auch NAT-Overload oder Masquerading).</p>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf9/nat-pat.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Zwei private PCs nutzen dieselbe öffentliche Adresse 203.0.113.5; der Router unterscheidet sie in der NAT-Tabelle über die Ports 40001 und 40002">
  <figcaption class="figure-caption">Eine öffentliche Adresse für das ganze Netz</figcaption>
</figure>
<ul>
  <li><strong>Source NAT / PAT</strong>: Verbindungen von innen nach außen. Der Normalfall am Internetanschluss.</li>
  <li><strong>Destination NAT / Portweiterleitung</strong>: Anfragen von außen an einen Port (z. B. 443) gehen an einen bestimmten internen Server.
    Ohne solche Regel kommt von außen keine neue Verbindung herein.</li>
  <li><strong>Statisches NAT (1:1)</strong>: eine öffentliche Adresse fest für ein internes Gerät.</li>
</ul>
<p>NAT verbirgt die interne Struktur, ist aber <strong>keine Firewall</strong>: Es bricht die Ende-zu-Ende-Adressierung, erschwert VoIP, Spiele und VPN
und verlangt Workarounds. Mit IPv6 ist NAT überflüssig; den Schutz übernimmt eine echte Firewall (<a href="/Learningfields/LF9/kapitel8.php">Kapitel 8</a>).</p>

<h6>Übungen mit Lösung</h6>
<p>1. Wohin leitet die Tabelle oben ein Paket an <code>10.1.3.1</code>?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">An B. 10.1.3.1 liegt nicht in 10.1.2.0/24, aber in 10.1.0.0/16 (16 Bit) und 10.0.0.0/8 (8 Bit) – das längere Präfix gewinnt.</p>
</details>
<p>2. R2 in der Grafik hat keine Route zu LAN A. PC A pingt einen Server in LAN B. Was passiert?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Die Anfrage kommt an (R1 kennt LAN B), aber die Antwort an 192.168.10.x findet R2 nicht – bzw. er schickt sie über seine Default-Route ins Internet.
Der Ping scheitert. Routing muss in <strong>beide Richtungen</strong> funktionieren; R2 braucht eine Route 192.168.10.0/24 über 10.0.0.1.</p>
</details>
<p>3. Ein Webserver im LAN (192.168.1.20) soll aus dem Internet über HTTPS erreichbar sein. Was richtest du am Router ein?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Eine Portweiterleitung (Destination NAT): öffentliche Adresse, TCP-Port 443 → 192.168.1.20:443. Besser noch: den Server in eine DMZ stellen (<a href="/Learningfields/LF9/kapitel8.php">Kapitel 8</a>).</p>
</details>
INHALT,
    'summary' => [
        'Router entscheiden anhand der Ziel-IP und der Routingtabelle; TTL wird je Hop um 1 verringert.',
        'Longest Prefix Match: der spezifischste Eintrag gewinnt, 0.0.0.0/0 nur als letzte Wahl.',
        'Routen: direkt angeschlossen, statisch oder dynamisch (RIP, OSPF, BGP).',
        'MAC-Adressen ändern sich bei jedem Hop, IP-Adressen bleiben – außer bei NAT.',
        'PAT: viele private Adressen teilen sich eine öffentliche, unterschieden über Ports; Portweiterleitung für eingehende Verbindungen.',
    ],
    'quiz' => [
        ['question' => 'Was besagt der Longest Prefix Match?', 'answer' => 'Passen mehrere Routen, wird die mit dem längsten Präfix (die spezifischste) verwendet.'],
        ['question' => 'Wie lautet die IPv4-Default-Route?', 'answer' => '0.0.0.0/0'],
        ['question' => 'Welche Metrik nutzt RIP, und wo liegt die Grenze?', 'answer' => 'Hop-Anzahl, maximal 15 Hops.'],
        ['question' => 'Welche Adressen ändern sich auf dem Weg eines Pakets durch mehrere Router?', 'answer' => 'Die MAC-Adressen (je Hop); IP-Adressen bleiben gleich, solange kein NAT im Spiel ist.'],
        ['question' => 'Wodurch unterscheidet PAT mehrere interne Geräte?', 'answer' => 'Durch unterschiedliche Quellports auf der öffentlichen Adresse.'],
    ],
];
