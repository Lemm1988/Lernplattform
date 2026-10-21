<?php
return [
    'title' => 'Referenzmodelle: OSI und TCP/IP',
    'intro' => 'Netzwerkkommunikation ist in Schichten organisiert. Wer die Schichten kennt, kann Geräte, Protokolle und Fehler sauber einordnen – das OSI-Modell ist deshalb Pflichtstoff in jeder IT-Prüfung.',
    'goals' => [
        'die sieben OSI-Schichten mit Aufgaben und Dateneinheiten nennen',
        'das TCP/IP-Modell dem OSI-Modell zuordnen',
        'Protokolle, Adressen und Geräte den Schichten zuordnen',
        'Kapselung und Entkapselung beschreiben',
        'das Schichtenmodell für die Fehlersuche nutzen',
    ],
    'content' => <<<'INHALT'
<h6>Warum Schichten?</h6>
<p>Jede Schicht löst eine Teilaufgabe und nutzt dafür die Dienste der Schicht darunter. Dadurch lassen sich Teile austauschen, ohne den Rest zu ändern:
Ein Browser funktioniert gleich, ob die Daten über Kabel, WLAN oder Mobilfunk laufen. Die Schichtenmodelle sind <strong>Referenzmodelle</strong> – sie beschreiben
Aufgaben, keine konkrete Software, und sorgen dafür, dass Produkte verschiedener Hersteller zusammenarbeiten.</p>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf3/osi-tcpip.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Sieben OSI-Schichten mit Dateneinheiten neben den vier Schichten des TCP/IP-Modells und typischen Protokollen">
  <figcaption class="figure-caption">OSI hat sieben Schichten, TCP/IP fasst sie zu vier zusammen</figcaption>
</figure>

<h6>Die Schichten im Einzelnen</h6>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th>Nr.</th><th>Schicht</th><th>Aufgabe</th><th>Beispiele</th><th>Geräte</th></tr></thead>
  <tbody>
    <tr><td>7</td><td>Anwendung</td><td>Schnittstelle zu den Anwendungen, Netzdienste</td><td>HTTP, SMTP, IMAP, DNS, DHCP, SSH, FTP</td><td rowspan="3" class="align-middle">Proxy, Application Gateway</td></tr>
    <tr><td>6</td><td>Darstellung</td><td>Daten in ein gemeinsames Format bringen, kodieren, verschlüsseln, komprimieren</td><td>UTF-8, JPEG, TLS (Verschlüsselung)</td></tr>
    <tr><td>5</td><td>Sitzung</td><td>Sitzungen auf- und abbauen, steuern, wiederaufnehmen</td><td>RPC, Sitzungen in SMB</td></tr>
    <tr><td>4</td><td>Transport</td><td>Ende-zu-Ende-Verbindung zwischen Anwendungen, Ports, Zuverlässigkeit, Flusskontrolle</td><td>TCP, UDP</td><td>Firewall (Paketfilter)</td></tr>
    <tr><td>3</td><td>Vermittlung</td><td>logische Adressen, Wegewahl (Routing) zwischen Netzen</td><td>IPv4, IPv6, ICMP</td><td>Router, Layer-3-Switch</td></tr>
    <tr><td>2</td><td>Sicherung</td><td>Zugriff auf das Medium, physische Adressen, Fehlererkennung im Frame</td><td>Ethernet (MAC), WLAN 802.11</td><td>Switch, Bridge, Access Point, Netzwerkkarte</td></tr>
    <tr><td>1</td><td>Bitübertragung</td><td>Bits als elektrische, optische oder Funksignale übertragen; Stecker, Kabel, Pegel</td><td>Twisted Pair, Glasfaser, Funk</td><td>Kabel, Repeater, Hub, Medienkonverter</td></tr>
  </tbody>
</table>
<p>In der Praxis lassen sich die Schichten 5 bis 7 oft nicht trennen – genau deshalb fasst das TCP/IP-Modell sie zur <strong>Anwendungsschicht</strong> zusammen.
Das <strong>TCP/IP-Modell</strong> (auch DoD-Modell) beschreibt die tatsächlich im Internet verwendeten Protokolle; das OSI-Modell dient vor allem zum Einordnen und Erklären.</p>

<h6>Kapselung</h6>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf3/kapselung.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Daten werden schrittweise mit TCP-Header zum Segment, mit IP-Header zum Paket und mit Ethernet-Header und FCS zum Frame verpackt und als Bits übertragen">
  <figcaption class="figure-caption">Jede Schicht setzt ihren Kopf vor die Daten der Schicht darüber</figcaption>
</figure>
<p>Beim Empfänger läuft es umgekehrt (<strong>Entkapselung</strong>): Jede Schicht liest „ihren“ Kopf, prüft und entfernt ihn und reicht den Rest nach oben.
Logisch sprechen dabei gleiche Schichten miteinander: Die TCP-Schicht des Senders „redet“ mit der TCP-Schicht des Empfängers, obwohl die Daten physisch
alle Schichten hinunter und wieder hinauf laufen.</p>

<h6>Drei Adressen, drei Schichten</h6>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th>Schicht</th><th>Adresse</th><th>Beispiel</th><th>gilt</th></tr></thead>
  <tbody>
    <tr><td>4 Transport</td><td>Port</td><td><code>443</code></td><td>adressiert die Anwendung auf dem Rechner</td></tr>
    <tr><td>3 Vermittlung</td><td>IP-Adresse</td><td><code>192.168.10.23</code></td><td>Ende zu Ende über Netzgrenzen hinweg</td></tr>
    <tr><td>2 Sicherung</td><td>MAC-Adresse</td><td><code>3C:52:82:1A:7F:04</code></td><td>nur im lokalen Netzsegment, von Hop zu Hop</td></tr>
  </tbody>
</table>
<div class="lf-merke"><strong>Merke:</strong> Fehlersuche entlang der Schichten, von unten nach oben: Leuchtet die Link-LED (1)? Hat der Switch die MAC gelernt (2)?
Stimmen IP-Adresse, Maske und Gateway (3)? Ist der Port erreichbar (4)? Funktioniert der Dienst (7)? So vermeidet man, an der Anwendung zu suchen,
wenn das Kabel nicht steckt.</div>

<h6>Übungen mit Lösung</h6>
<p>1. Ordne die Schicht zu: (a) Router, (b) Switch, (c) TLS-Verschlüsselung, (d) Hub, (e) UDP.</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">(a) 3 Vermittlung. (b) 2 Sicherung. (c) 6 Darstellung (im TCP/IP-Modell Anwendungsschicht). (d) 1 Bitübertragung. (e) 4 Transport.</p>
</details>
<p>2. Wie heißt die Dateneinheit auf Schicht 2, 3 und 4?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Schicht 2: Frame (Rahmen). Schicht 3: Paket. Schicht 4: Segment (bei UDP: Datagramm).</p>
</details>
<p>3. Ein Anwender erreicht das Intranet nicht. Die Link-LED leuchtet, <code>ipconfig</code> zeigt <code>169.254.12.8</code>. Auf welcher Schicht liegt das Problem?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Schicht 1 ist in Ordnung (Link). Der Client hat keine gültige IP-Adresse vom DHCP-Server bekommen – ein Problem auf Schicht 3 bzw. beim DHCP-Dienst
(Schicht 7), etwa falsches VLAN am Switch-Port oder DHCP-Server nicht erreichbar.</p>
</details>
INHALT,
    'summary' => [
        'OSI von 7 nach 1: Anwendung, Darstellung, Sitzung, Transport, Vermittlung, Sicherung, Bitübertragung.',
        'TCP/IP: Anwendung (OSI 5–7), Transport (4), Internet (3), Netzzugang (1–2).',
        'Dateneinheiten: Daten, Segment, Paket, Frame, Bits.',
        'Port (4), IP-Adresse (3), MAC-Adresse (2); Router auf 3, Switch auf 2, Hub auf 1.',
        'Kapselung beim Senden, Entkapselung beim Empfangen; Fehlersuche von unten nach oben.',
    ],
    'quiz' => [
        ['question' => 'Wie heißt OSI-Schicht 3?', 'answer' => 'Vermittlungsschicht (Network Layer).'],
        ['question' => 'Welche OSI-Schichten fasst die Anwendungsschicht des TCP/IP-Modells zusammen?', 'answer' => 'Die Schichten 5, 6 und 7.'],
        ['question' => 'Auf welcher Schicht arbeitet ein Switch?', 'answer' => 'Auf Schicht 2, der Sicherungsschicht.'],
        ['question' => 'Was ist Kapselung?', 'answer' => 'Jede Schicht fügt beim Senden den Daten der Schicht darüber ihren eigenen Header (und ggf. Trailer) hinzu.'],
    ],
];
