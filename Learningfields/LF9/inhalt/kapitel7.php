<?php
return [
    'title' => 'Transportschicht und Netzwerkdienste: TCP, UDP, DNS, DHCP',
    'intro' => 'IP bringt Pakete zum richtigen Rechner – Ports bringen sie zur richtigen Anwendung. Darauf bauen die Dienste auf, ohne die kein Netz funktioniert: Namensauflösung, Adressvergabe, Web, E-Mail und Fernzugriff.',
    'goals' => [
        'TCP und UDP vergleichen und für Anwendungen auswählen',
        'den Drei-Wege-Handshake mit Sequenz- und Bestätigungsnummern beschreiben',
        'wichtige Ports und Protokolle zuordnen',
        'DNS-Auflösung und Record-Typen erklären',
        'den DHCP-Ablauf (DORA) und das DHCP-Relay beschreiben',
    ],
    'content' => <<<'INHALT'
<h6>Ports und Sockets</h6>
<p>Eine <strong>Portnummer</strong> (16 Bit, 0–65 535) adressiert die Anwendung auf einem Rechner. IP-Adresse + Port = <strong>Socket</strong>.
Eine Verbindung ist eindeutig durch fünf Werte bestimmt: Protokoll, Quell-IP, Quellport, Ziel-IP, Zielport.</p>
<ul>
  <li><strong>0–1023</strong>: Well-Known Ports für Standarddienste (Server)</li>
  <li><strong>1024–49 151</strong>: registrierte Ports (z. B. 3306 MySQL)</li>
  <li><strong>49 152–65 535</strong>: dynamische Ports, die das Betriebssystem Clients als Quellport zuweist</li>
</ul>

<h6>TCP und UDP</h6>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th></th><th>TCP</th><th>UDP</th></tr></thead>
  <tbody>
    <tr><td>Verbindung</td><td>verbindungsorientiert (Auf- und Abbau)</td><td>verbindungslos</td></tr>
    <tr><td>Zuverlässigkeit</td><td>Bestätigungen, Neuübertragung, richtige Reihenfolge</td><td>keine Garantie – verloren ist verloren</td></tr>
    <tr><td>Steuerung</td><td>Flusskontrolle (Fenster), Staukontrolle</td><td>keine</td></tr>
    <tr><td>Header</td><td>mind. 20 Byte</td><td>8 Byte</td></tr>
    <tr><td>Einsatz</td><td>Web, E-Mail, SSH, Dateiübertragung, Datenbanken</td><td>DNS, DHCP, NTP, VoIP, Video-Streaming, Online-Spiele</td></tr>
  </tbody>
</table>
<p>UDP lohnt sich, wo Geschwindigkeit wichtiger ist als Vollständigkeit: Ein verspätet nachgeliefertes Sprachpaket nützt niemandem mehr.
HTTP/3 nutzt das Protokoll QUIC, das auf UDP aufsetzt und Zuverlässigkeit und Verschlüsselung selbst erledigt.</p>

<h6>Der Drei-Wege-Handshake</h6>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf9/tcp-handshake.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="SYN mit seq=1000, SYN-ACK mit seq=5000 und ack=1001, ACK mit seq=1001 und ack=5001; danach ESTABLISHED">
  <figcaption class="figure-caption">SYN – SYN/ACK – ACK, mit Sequenz- und Bestätigungsnummern</figcaption>
</figure>
<p>Beide Seiten wählen eine zufällige Anfangs-Sequenznummer und bestätigen die der Gegenseite. Ein <strong>SYN-Flood</strong>-Angriff schickt massenhaft SYNs
ohne abschließendes ACK, bis die Tabelle halboffener Verbindungen voll ist – Gegenmittel sind SYN-Cookies und Firewalls.</p>

<h6>Wichtige Protokolle und Ports</h6>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th>Port</th><th>Protokoll</th><th>Transport</th><th>Zweck</th></tr></thead>
  <tbody>
    <tr><td>20/21</td><td>FTP</td><td>TCP</td><td>Dateiübertragung, unverschlüsselt – besser SFTP</td></tr>
    <tr><td>22</td><td>SSH / SFTP</td><td>TCP</td><td>verschlüsselte Fernwartung und Dateiübertragung</td></tr>
    <tr><td>23</td><td>Telnet</td><td>TCP</td><td>Fernzugriff im Klartext – nicht mehr verwenden</td></tr>
    <tr><td>25 / 587</td><td>SMTP</td><td>TCP</td><td>Mailversand zwischen Servern (25) bzw. vom Client mit Anmeldung (587)</td></tr>
    <tr><td>53</td><td>DNS</td><td>UDP (und TCP)</td><td>Namensauflösung</td></tr>
    <tr><td>67/68</td><td>DHCP</td><td>UDP</td><td>Adressvergabe (Server 67, Client 68)</td></tr>
    <tr><td>80 / 443</td><td>HTTP / HTTPS</td><td>TCP (HTTP/3: UDP)</td><td>Web; HTTPS = HTTP über TLS</td></tr>
    <tr><td>110 / 995</td><td>POP3 / POP3S</td><td>TCP</td><td>Mails abholen und meist vom Server löschen</td></tr>
    <tr><td>123</td><td>NTP</td><td>UDP</td><td>Zeitsynchronisation</td></tr>
    <tr><td>143 / 993</td><td>IMAP / IMAPS</td><td>TCP</td><td>Mails auf dem Server verwalten, auf allen Geräten synchron</td></tr>
    <tr><td>161/162</td><td>SNMP</td><td>UDP</td><td>Überwachung von Netzwerkgeräten</td></tr>
    <tr><td>389 / 636</td><td>LDAP / LDAPS</td><td>TCP</td><td>Verzeichnisdienst (z. B. Active Directory)</td></tr>
    <tr><td>3389</td><td>RDP</td><td>TCP/UDP</td><td>Windows-Remotedesktop</td></tr>
  </tbody>
</table>
<div class="lf-pruefung"><strong>Prüfungstipp:</strong> Häufig gefragt: 22, 25, 53, 67/68, 80, 443, 143/993 und 3389. Und: Welche Protokolle sind unverschlüsselt (FTP, Telnet, HTTP, POP3/IMAP ohne TLS),
und was ist der sichere Ersatz?</div>

<h6>DNS</h6>
<p>Das Domain Name System übersetzt Namen in Adressen. Es ist hierarchisch und verteilt: Root → Top-Level-Domain → Domain → Subdomain.</p>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf9/dns-aufloesung.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Client fragt den Resolver rekursiv; der Resolver fragt iterativ Root-, TLD- und autoritativen Server und liefert 203.0.113.80 zurück">
  <figcaption class="figure-caption">Rekursiv zum Resolver, iterativ durch die Hierarchie</figcaption>
</figure>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th>Record</th><th>Inhalt</th><th>Beispiel</th></tr></thead>
  <tbody>
    <tr><td>A / AAAA</td><td>IPv4- bzw. IPv6-Adresse</td><td><code>www A 203.0.113.80</code></td></tr>
    <tr><td>CNAME</td><td>Alias auf einen anderen Namen</td><td><code>shop CNAME www.example.org.</code></td></tr>
    <tr><td>MX</td><td>Mailserver der Domain, mit Priorität</td><td><code>MX 10 mail.example.org.</code></td></tr>
    <tr><td>NS</td><td>zuständige Nameserver</td><td><code>NS ns1.example.org.</code></td></tr>
    <tr><td>PTR</td><td>Rückwärtsauflösung: Adresse → Name</td><td><code>80.113.0.203.in-addr.arpa PTR www.example.org.</code></td></tr>
    <tr><td>TXT</td><td>beliebiger Text, z. B. SPF, DKIM, DMARC gegen gefälschte Absender</td><td><code>TXT "v=spf1 mx -all"</code></td></tr>
    <tr><td>SOA</td><td>Verwaltungsdaten der Zone (Seriennummer, Zeiten)</td><td>–</td></tr>
  </tbody>
</table>
<p>Werkzeuge: <code>nslookup www.example.org</code> (Windows und Linux), <code>dig www.example.org</code> (Linux), <code>ipconfig /flushdns</code> leert den Windows-Cache.</p>

<h6>DHCP</h6>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf9/dhcp-dora.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="DHCP in vier Schritten: Discover und Request als Broadcast, Offer und Acknowledge vom Server">
  <figcaption class="figure-caption">Discover – Offer – Request – Acknowledge</figcaption>
</figure>
<ul>
  <li>Der Server vergibt aus einem <strong>Pool</strong> (Scope) Adressen für eine begrenzte Zeit (<strong>Lease</strong>). Mitgeliefert werden Maske, Gateway, DNS-Server, Domain.</li>
  <li><strong>Reservierung</strong>: Ein Gerät (erkannt an der MAC-Adresse) bekommt immer dieselbe Adresse – praktisch für Drucker.</li>
  <li><strong>DHCP-Relay</strong>: Broadcasts überschreiten keinen Router. Ein Relay-Agent auf dem Router (bei Cisco <code>ip helper-address</code>) leitet sie per Unicast an den
    zentralen DHCP-Server weiter – so reicht ein Server für alle VLANs.</li>
  <li>Risiko: Ein fremder DHCP-Server im Netz (<em>Rogue DHCP</em>) kann Clients ein falsches Gateway unterschieben. Schutz: <em>DHCP Snooping</em> auf den Switches.</li>
</ul>

<h6>Weitere Dienste kurz</h6>
<ul>
  <li><strong>HTTPS</strong>: Vor dem HTTP-Austausch handeln Client und Server per TLS die Verschlüsselung aus; der Server weist sich mit einem Zertifikat aus (Kryptografie: LF4).</li>
  <li><strong>E-Mail</strong>: Der Client verschickt per SMTP an seinen Server; der sucht per MX-Record den Zielserver und liefert per SMTP aus; der Empfänger liest per IMAP.</li>
  <li><strong>NTP</strong>: Synchrone Uhren sind Pflicht – für Logauswertung, Zertifikatsprüfung und Kerberos-Anmeldung im Active Directory.</li>
</ul>

<h6>Übungen mit Lösung</h6>
<p>1. Der Client sendet <code>SYN seq=7000</code>, der Server antwortet mit <code>seq=300</code>. Welche Werte stehen im SYN-ACK und im abschließenden ACK?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">SYN-ACK: seq=300, ack=7001. ACK: seq=7001, ack=301.</p>
</details>
<p>2. <code>ping 203.0.113.80</code> funktioniert, <code>ping www.example.org</code> meldet „Host nicht gefunden“. Wo liegt das Problem?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Bei der Namensauflösung: falscher oder nicht erreichbarer DNS-Server in der Konfiguration, fehlender Record oder eine Firewall blockiert Port 53.
Prüfen mit <code>nslookup</code> und <code>ipconfig /all</code>.</p>
</details>
<p>3. Warum wird der DHCP-Request als Broadcast gesendet, obwohl der Client den Server schon kennt?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Der Client hat noch keine bestätigte Adresse. Außerdem sollen alle DHCP-Server, die ein Angebot geschickt haben, erfahren, welches angenommen wurde –
die anderen geben ihre reservierte Adresse wieder frei.</p>
</details>
<p>4. Für eine Videokonferenz-Software: TCP oder UDP? Begründe.</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">UDP für Audio und Video: Geringe Verzögerung zählt mehr als Vollständigkeit; ein neu übertragenes Paket käme zu spät. Steuerdaten (Anmeldung, Chat) laufen oft über TCP.</p>
</details>
INHALT,
    'summary' => [
        'Ports adressieren Anwendungen; Well-Known 0–1023, dynamische Client-Ports ab 49 152.',
        'TCP: verbindungsorientiert und zuverlässig (Handshake SYN – SYN/ACK – ACK); UDP: schnell, ohne Garantie.',
        'Ports: 22 SSH, 25/587 SMTP, 53 DNS, 67/68 DHCP, 80/443 HTTP(S), 143/993 IMAP, 3389 RDP.',
        'DNS: Client fragt rekursiv, Resolver iterativ; Records A, AAAA, CNAME, MX, NS, PTR, TXT.',
        'DHCP: Discover, Offer, Request, Acknowledge; Relay für andere Subnetze, Snooping gegen fremde Server.',
    ],
    'quiz' => [
        ['question' => 'Nenne die drei Schritte des TCP-Handshakes.', 'answer' => 'SYN, SYN/ACK, ACK.'],
        ['question' => 'Welcher DNS-Record verweist auf den Mailserver?', 'answer' => 'Der MX-Record.'],
        ['question' => 'Wofür steht DORA?', 'answer' => 'Discover, Offer, Request, Acknowledge – der DHCP-Ablauf.'],
        ['question' => 'Welche Ports nutzen SSH, DNS und HTTPS?', 'answer' => 'SSH 22, DNS 53, HTTPS 443.'],
        ['question' => 'Warum braucht man ein DHCP-Relay?', 'answer' => 'Weil Router keine Broadcasts weiterleiten; das Relay leitet DHCP-Anfragen aus anderen Subnetzen an den zentralen Server.'],
    ],
];
