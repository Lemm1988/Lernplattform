<?php
return [
    'title' => 'Netzwerksicherheit: Firewall, DMZ, VPN und WLAN',
    'intro' => 'Ein Netz ist nur so sicher wie seine Übergänge. Firewalls entscheiden, was durchdarf, die DMZ hält öffentliche Dienste vom internen Netz fern, VPNs schützen Verbindungen über fremde Leitungen, und im WLAN zählt die richtige Verschlüsselung.',
    'goals' => [
        'Firewall-Arten unterscheiden und ein Regelwerk mit Default Deny auswerten',
        'den Zweck einer DMZ erklären und Regeln für sie formulieren',
        'Site-to-Site- und Remote-Access-VPN sowie IPsec und WireGuard einordnen',
        'WLAN-Sicherheitsstandards bewerten und 802.1X erklären',
        'typische Angriffe im LAN und ihre Gegenmaßnahmen nennen',
    ],
    'content' => <<<'INHALT'
<h6>Grundsätze</h6>
<ul>
  <li><strong>Default Deny</strong> (Whitelist): Alles ist verboten, was nicht ausdrücklich erlaubt ist. Das Gegenteil, eine Blacklist, übersieht immer etwas.</li>
  <li><strong>Least Privilege</strong>: Jedes System darf nur, was es für seine Aufgabe braucht.</li>
  <li><strong>Defense in Depth</strong>: mehrere Schutzschichten – Netzwerk-Firewall, Segmentierung, Host-Firewall, Updates, Monitoring.</li>
  <li><strong>Segmentierung</strong>: VLANs und Firewall-Zonen begrenzen, wie weit sich ein Angreifer oder Schadsoftware ausbreiten kann.</li>
</ul>

<h6>Firewall-Arten</h6>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th>Art</th><th>prüft</th><th>Stärken / Grenzen</th></tr></thead>
  <tbody>
    <tr><td>Paketfilter (stateless)</td><td>jedes Paket einzeln: IP-Adressen, Protokoll, Ports (Schicht 3/4)</td><td>schnell, aber ohne Zusammenhang – Rückverkehr braucht eigene Regeln</td></tr>
    <tr><td>Stateful Inspection</td><td>wie oben, plus Verbindungstabelle</td><td>Antworten auf erlaubte Verbindungen passieren automatisch; heutiger Standard</td></tr>
    <tr><td>Application Layer Gateway / Proxy</td><td>Inhalt auf Anwendungsebene (Schicht 7), z. B. HTTP</td><td>kann Inhalte filtern; eine <em>Web Application Firewall</em> (WAF) erkennt etwa SQL-Injection</td></tr>
    <tr><td>Next-Generation Firewall</td><td>alles davon plus Anwendungserkennung, IPS, Benutzerbezug</td><td>umfassend, aber komplex; TLS-Inspection berührt den Datenschutz</td></tr>
  </tbody>
</table>
<p>Daneben schützt die <strong>Host-Firewall</strong> jedes einzelne Gerät (Windows Defender Firewall, unter Linux nftables oder <code>ufw</code>).</p>

<h6>Ein Regelwerk lesen</h6>
<p>Regeln werden von oben nach unten geprüft, die <strong>erste passende</strong> entscheidet (<em>first match</em>). Die letzte Regel verwirft alles Übrige.</p>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th>Nr.</th><th>Quelle</th><th>Ziel</th><th>Dienst</th><th>Aktion</th></tr></thead>
  <tbody>
    <tr><td>1</td><td>beliebig</td><td>192.168.40.10 (Webserver)</td><td>TCP 443</td><td>erlauben</td></tr>
    <tr><td>2</td><td>192.168.10.0/24 (Verwaltung)</td><td>beliebig</td><td>TCP 80, 443</td><td>erlauben</td></tr>
    <tr><td>3</td><td>192.168.99.0/24 (Admins)</td><td>192.168.40.0/24</td><td>TCP 22</td><td>erlauben</td></tr>
    <tr><td>4</td><td>beliebig</td><td>beliebig</td><td>beliebig</td><td>verwerfen</td></tr>
  </tbody>
</table>
<p><strong>Verwerfen</strong> (drop) schickt keine Antwort – ein Scanner erfährt nichts. <strong>Ablehnen</strong> (reject) meldet die Sperre zurück, was die Fehlersuche im eigenen Netz erleichtert.</p>

<h6>DMZ</h6>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf9/dmz.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Internet, äußere Firewall, DMZ mit Webserver und Mail-Relay, innere Firewall, LAN; darunter die erlaubten und gesperrten Verbindungen">
  <figcaption class="figure-caption">Öffentliche Dienste stehen in einer eigenen Zone</figcaption>
</figure>
<p>Server, die aus dem Internet erreichbar sein müssen, stehen in der <strong>demilitarisierten Zone</strong>. Statt zwei Firewalls genügt oft eine mit drei Interfaces
(<em>Three-Legged Firewall</em>); zwei Firewalls verschiedener Hersteller bieten mehr Schutz, weil eine Sicherheitslücke nicht beide betrifft.</p>

<h6>VPN</h6>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf9/vpn.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Site-to-Site-Tunnel zwischen Zentrale und Filiale, Remote-Access-Tunnel vom Homeoffice; darunter das verschlüsselte Originalpaket in einem neuen IP-Paket">
  <figcaption class="figure-caption">Ein virtuelles privates Netz über das öffentliche Internet</figcaption>
</figure>
<ul>
  <li><strong>Site-to-Site</strong>: verbindet ganze Standorte dauerhaft; die Endgeräte merken nichts davon.</li>
  <li><strong>Remote Access</strong>: ein einzelnes Gerät (Homeoffice, Außendienst) wählt sich mit VPN-Client ins Firmennetz ein.
    Bei <em>Split Tunneling</em> geht nur der Firmenverkehr durch den Tunnel, der Rest direkt ins Internet.</li>
</ul>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th>Technik</th><th>Merkmale</th></tr></thead>
  <tbody>
    <tr><td>IPsec</td><td>Standard für Site-to-Site. IKE handelt die Schlüssel aus, ESP verschlüsselt und authentifiziert. Tunnelmodus verpackt das ganze Paket, Transportmodus nur die Nutzdaten.</td></tr>
    <tr><td>SSL/TLS-VPN (z. B. OpenVPN)</td><td>läuft über TLS, oft auf Port 443 und damit durch fast jede Firewall</td></tr>
    <tr><td>WireGuard</td><td>modern, sehr kleiner Code, feste aktuelle Kryptografie, schneller Verbindungsaufbau; läuft über UDP</td></tr>
  </tbody>
</table>
<p>Ein neuerer Ansatz ist <strong>Zero Trust</strong>: Statt einem Gerät nach der VPN-Anmeldung das ganze Netz zu öffnen, wird jeder Zugriff auf jede Anwendung einzeln geprüft
(„never trust, always verify“).</p>

<h6>WLAN-Sicherheit</h6>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th>Standard</th><th>Bewertung</th></tr></thead>
  <tbody>
    <tr><td>WEP, WPA (TKIP)</td><td>gebrochen – nicht mehr verwenden</td></tr>
    <tr><td>WPA2-Personal (AES/CCMP, gemeinsames Passwort)</td><td>ausreichend mit langem Passwort; ein mitgeschnittener Handshake lässt sich offline per Wörterbuch angreifen</td></tr>
    <tr><td>WPA3-Personal (SAE)</td><td>schützt gegen Offline-Wörterbuchangriffe, Forward Secrecy – Empfehlung für kleine Netze</td></tr>
    <tr><td>WPA2/WPA3-Enterprise (802.1X)</td><td>jeder Nutzer meldet sich einzeln an (RADIUS); Zugänge lassen sich einzeln sperren – Empfehlung für Firmen</td></tr>
  </tbody>
</table>
<p><strong>IEEE 802.1X</strong> funktioniert auch an Switch-Ports: Das Endgerät (<em>Supplicant</em>) meldet sich beim Switch oder Access Point (<em>Authenticator</em>) an,
der die Daten an einen <strong>RADIUS-Server</strong> (<em>Authentication Server</em>) weiterreicht. Erst nach erfolgreicher Prüfung wird der Port freigeschaltet –
gern auch gleich mit dem passenden VLAN. Außerdem: Gäste-WLAN in eigenem VLAN mit Client-Isolation, WPS abschalten.</p>

<h6>Angriffe im LAN und Gegenmaßnahmen</h6>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th>Angriff</th><th>Wirkung</th><th>Gegenmaßnahme</th></tr></thead>
  <tbody>
    <tr><td>MAC Flooding</td><td>MAC-Tabelle läuft über, Switch flutet alles wie ein Hub</td><td>Port Security (MAC-Adressen pro Port begrenzen)</td></tr>
    <tr><td>ARP Spoofing</td><td>Angreifer gibt sich als Gateway aus → Man-in-the-Middle</td><td>Dynamic ARP Inspection, Verschlüsselung (TLS)</td></tr>
    <tr><td>Rogue DHCP</td><td>falsches Gateway oder falscher DNS-Server</td><td>DHCP Snooping</td></tr>
    <tr><td>VLAN Hopping</td><td>Zugriff auf fremde VLANs</td><td>Trunk nur fest konfigurieren, Native VLAN ungenutzt</td></tr>
    <tr><td>fremde Geräte</td><td>unbefugter Zugang über eine freie Netzwerkdose</td><td>802.1X, ungenutzte Ports abschalten</td></tr>
    <tr><td>(D)DoS</td><td>Überlastung von Diensten oder Leitung</td><td>Rate Limiting, DDoS-Schutz beim Provider oder CDN</td></tr>
  </tbody>
</table>
<p>Ein <strong>IDS</strong> (Intrusion Detection System) erkennt verdächtigen Verkehr anhand von Signaturen oder Anomalien und alarmiert.
Ein <strong>IPS</strong> (Intrusion Prevention System) sitzt im Datenstrom und blockiert selbst – mit dem Risiko, auch legitimen Verkehr zu stoppen (False Positive).</p>

<h6>Übungen mit Lösung</h6>
<p>1. Werte das Regelwerk oben aus: (a) 198.51.100.7 → 192.168.40.10, TCP 443; (b) 192.168.10.5 → 192.168.40.20, TCP 3306; (c) 192.168.20.8 → 1.1.1.1, TCP 443.</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">(a) erlaubt durch Regel 1. (b) verworfen durch Regel 4 – Regel 2 erlaubt der Verwaltung nur 80 und 443, Regel 3 gilt nur für das Admin-Netz.
(c) verworfen durch Regel 4, weil 192.168.20.0/24 in Regel 2 nicht vorkommt.</p>
</details>
<p>2. Ein Unternehmen mit 80 Mitarbeitenden will sein WLAN absichern. Was empfiehlst du?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">WPA3-Enterprise (oder WPA2/WPA3-Enterprise für ältere Geräte) mit 802.1X und RADIUS, angebunden an die Benutzerverwaltung. Jeder hat eigene Zugangsdaten,
ausscheidende Mitarbeitende werden einzeln gesperrt. Gäste bekommen ein eigenes VLAN mit Internet-only und Client-Isolation.</p>
</details>
<p>3. Warum reicht NAT am Router nicht als Firewall?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">NAT verhindert nur nebenbei, dass unaufgeforderte Verbindungen von außen ein Ziel finden. Es prüft keine Regeln für ausgehenden Verkehr, keine Inhalte und schützt nicht
bei IPv6, wo es gar kein NAT gibt. Eine Firewall mit Default-Deny-Regeln ist trotzdem nötig.</p>
</details>
INHALT,
    'summary' => [
        'Default Deny, Least Privilege, Defense in Depth und Segmentierung sind die Grundprinzipien.',
        'Paketfilter (stateless), Stateful Inspection, Application Gateway/WAF, NGFW; Regeln nach first match.',
        'DMZ: öffentlich erreichbare Server in eigener Zone, aus dem Internet kein direkter Weg ins LAN.',
        'VPN: Site-to-Site oder Remote Access; IPsec (IKE, ESP), TLS-VPN, WireGuard.',
        'WLAN: WPA3 bzw. Enterprise mit 802.1X/RADIUS; WEP und WPA sind gebrochen.',
    ],
    'quiz' => [
        ['question' => 'Was bedeutet Default Deny?', 'answer' => 'Alles ist verboten, was nicht ausdrücklich erlaubt ist (Whitelist-Prinzip).'],
        ['question' => 'Was unterscheidet Stateful Inspection von einem einfachen Paketfilter?', 'answer' => 'Sie führt eine Verbindungstabelle und lässt Antworten auf erlaubte Verbindungen automatisch passieren.'],
        ['question' => 'Wozu dient eine DMZ?', 'answer' => 'Sie trennt öffentlich erreichbare Server vom internen Netz; ein kompromittierter Server gibt keinen direkten Zugang zum LAN.'],
        ['question' => 'Welche drei Rollen gibt es bei 802.1X?', 'answer' => 'Supplicant (Endgerät), Authenticator (Switch/AP), Authentication Server (RADIUS).'],
        ['question' => 'Unterschied IDS und IPS?', 'answer' => 'Ein IDS erkennt und alarmiert, ein IPS blockiert verdächtigen Verkehr selbst.'],
    ],
];
