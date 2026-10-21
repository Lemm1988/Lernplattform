<?php
return [
    'title' => 'Sicherheit und Betrieb vernetzter Systeme',
    'intro' => 'Ein gehacktes Notebook kostet Daten. Ein gehacktes CPS kann Ventile öffnen, Maschinen anfahren oder ein Stromnetz abschalten. Deshalb gehören Safety und Security bei cyber-physischen Systemen zusammen – von der Entwicklung über den Betrieb bis zur Außerbetriebnahme.',
    'goals' => [
        'Safety und Security unterscheiden und ihren Zusammenhang erklären',
        'typische Schwachstellen von IoT- und OT-Geräten erkennen',
        'Schutzmaßnahmen nach dem Prinzip der Verteidigung in der Tiefe zuordnen',
        'den Ablauf eines sicheren Firmware-Updates beschreiben',
        'ein Netz in Zonen für Büro-IT, OT und IoT gliedern',
        'wichtige Normen und EU-Vorgaben einordnen',
    ],
    'content' => <<<'INHALT'
<h6>Safety und Security</h6>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th></th><th>Safety (funktionale Sicherheit)</th><th>Security (Informationssicherheit)</th></tr></thead>
  <tbody>
    <tr><td>Frage</td><td>Kann das System Menschen oder Umwelt schaden?</td><td>Kann jemand das System missbrauchen?</td></tr>
    <tr><td>Ursache</td><td>zufällige Ausfälle, Fehlbedienung, Softwarefehler</td><td>absichtliche Angriffe</td></tr>
    <tr><td>Beispiele für Maßnahmen</td><td>Not-Halt (fest verdrahtet), sichere Grundstellung bei Fehlern, Watchdog, redundante Sensoren</td><td>Verschlüsselung, Authentifizierung, signierte Updates, Netzsegmentierung</td></tr>
    <tr><td>Normen (Auswahl)</td><td>IEC 61508 (Sicherheitsintegritätslevel SIL 1–4), Maschinenrichtlinie bzw. Maschinenverordnung</td><td>IEC 62443, ETSI EN 303 645, ISO/IEC 27001</td></tr>
  </tbody>
</table>
<p>Beide hängen zusammen: Ein Angreifer kann eine Sicherheitsfunktion ausschalten und so einen Unfall herbeiführen. Bekannte Fälle sind <strong>Stuxnet</strong> (2010, manipulierte Steuerungen von Uranzentrifugen) und die Angriffe auf das <strong>ukrainische Stromnetz</strong> 2015, bei denen Hunderttausende Haushalte ohne Strom waren. Deshalb gilt: Safety-Funktionen wie der Not-Halt dürfen nicht allein von vernetzter Software abhängen.</p>
<p class="lf-merke"><strong>Merke:</strong> Safety schützt die Welt vor dem System, Security schützt das System vor der Welt.</p>

<h6>Typische Schwachstellen</h6>
<ul>
  <li><strong>Standard- oder fest eingebaute Passwörter</strong>: Das Botnetz <em>Mirai</em> übernahm 2016 Hunderttausende Kameras und Router, indem es einfach Werkspasswörter durchprobierte, und legte mit ihnen große Internetdienste lahm.</li>
  <li><strong>Unverschlüsselte Protokolle</strong>: MQTT auf Port 1883 ohne Anmeldung, Telnet, HTTP. Jeder im Netz kann mitlesen, falsche Messwerte einspeisen oder Befehle senden.</li>
  <li><strong>Keine oder unsichere Updates</strong>: Firmware ohne Signatur, Geräte ohne Update-Möglichkeit, Hersteller ohne Sicherheitsupdates.</li>
  <li><strong>Offene Debug-Schnittstellen</strong>: Über UART- oder JTAG-Pins auf der Platine lassen sich oft Firmware und Schlüssel auslesen – wer physischen Zugang hat, hat dann alles.</li>
  <li><strong>Veraltete Komponenten</strong>: alte Bibliotheken und Betriebssysteme mit bekannten Lücken.</li>
  <li><strong>Altprotokolle in der Industrie</strong>: Modbus und viele Feldbusse kennen keine Authentifizierung – sie stammen aus einer Zeit abgeschotteter Anlagen.</li>
</ul>
<p><strong>OT ist anders als IT.</strong> In der Büro-IT steht oft die Vertraulichkeit an erster Stelle, in der Produktion (Operational Technology) die <strong>Verfügbarkeit</strong> und <strong>Integrität</strong>: Eine Anlage, die stillsteht oder falsch steuert, kostet sofort Geld oder gefährdet Menschen. Anlagen laufen 15 bis 30 Jahre, Updates erfordern oft einen geplanten Stillstand. Viele Geräte lassen sich gar nicht patchen – dann müssen Netzmaßnahmen sie abschirmen.</p>

<h6>Verteidigung in der Tiefe</h6>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf7/sicherheit-schichten.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Vier verschachtelte Schichten: Organisation, Netzwerk, Kommunikation und im Kern das Gerät, jeweils mit typischen Maßnahmen">
  <figcaption class="figure-caption">Mehrere Schutzschichten statt einer einzigen Mauer</figcaption>
</figure>
<p>Für das Gewächshaus heißt das zum Beispiel: Jedes Gerät hat ein eigenes Zertifikat, der Broker akzeptiert nur verschlüsselte, angemeldete Verbindungen, und jedes Gateway darf nur in seinen eigenen Topic-Zweig schreiben. Eine Konfiguration für den verbreiteten Broker Mosquitto:</p>
<pre class="bg-light border rounded p-3"><code># mosquitto.conf – nur TLS, nur mit Gerätezertifikat
listener 8883
cafile   /etc/mosquitto/certs/ca.crt
certfile /etc/mosquitto/certs/server.crt
keyfile  /etc/mosquitto/certs/server.key
require_certificate true
use_identity_as_username true      # Name aus dem Zertifikat = Benutzername
allow_anonymous false
acl_file /etc/mosquitto/acl

# /etc/mosquitto/acl – jedes Gateway schreibt nur in seinen Zweig
pattern write gewaechshaus/%u/#
user dashboard
topic read gewaechshaus/#</code></pre>
<p>Ein gestohlenes Gateway aus Haus 1 kann so keine Werte für Haus 2 fälschen. Sein Zertifikat wird gesperrt, und der Schaden bleibt begrenzt.</p>

<h6>Sichere Firmware-Updates</h6>
<p>Updates über das Netz (<em>Over the Air</em>, OTA) schließen Lücken – sie sind aber selbst ein Angriffsweg. Ein sicheres Verfahren:</p>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf7/ota-update.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Der Build-Server signiert die Firmware mit dem privaten Schlüssel, der Update-Server liefert sie per HTTPS. Das Gerät lädt sie in Partition B, prüft die Signatur mit dem öffentlichen Schlüssel, startet von B neu und führt einen Selbsttest durch; bei Erfolg wird B gültig, sonst Rollback auf A">
  <figcaption class="figure-caption">Signiertes Update mit A/B-Partitionen und Rollback</figcaption>
</figure>
<ul>
  <li><strong>Signatur</strong>: Nur Firmware, die mit dem privaten Schlüssel des Herstellers signiert ist, wird installiert (asymmetrische Kryptografie, vgl. <a href="/Learningfields/LF4/kapitel7.php">LF4 Kapitel 7</a>).</li>
  <li><strong>Secure Boot</strong>: Schon der Bootloader prüft bei jedem Start die Signatur – manipulierte Firmware startet gar nicht erst.</li>
  <li><strong>A/B-Partitionen</strong>: Das Update landet in der freien Partition. Ein Stromausfall mittendrin schadet nicht, und eine fehlerhafte Version wird automatisch zurückgerollt.</li>
  <li><strong>Kein Downgrade</strong>: Ein Versionszähler verhindert, dass ein Angreifer eine alte, verwundbare, aber korrekt signierte Version einspielt.</li>
</ul>

<h6>Netze in Zonen teilen</h6>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf7/netz-zonen.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Internet, Firewall, Büro-IT und DMZ mit Broker, Update-Server und VPN-Zugang, eine zweite Firewall, dahinter OT-Zone und IoT-Segment; IoT-Geräte verbinden sich nur ausgehend mit dem Broker, Büro-IT hat keinen direkten Zugriff auf die OT">
  <figcaption class="figure-caption">Zonen und kontrollierte Übergänge (Zones and Conduits nach IEC 62443)</figcaption>
</figure>
<ul>
  <li>IoT-Geräte gehören in ein <strong>eigenes Segment</strong> (VLAN, vgl. <a href="/Learningfields/LF9/kapitel3.php">LF9 Kapitel 3</a>), nicht ins Büronetz.</li>
  <li>Verbindungen nur <strong>von innen nach außen</strong> zu einem definierten Ziel (Broker), keine Portfreigaben aus dem Internet auf Geräte.</li>
  <li><strong>Fernwartung</strong> nur über VPN mit Mehrfaktor-Anmeldung, zeitlich begrenzt und protokolliert.</li>
  <li>Daten zwischen Zonen über eine <strong>DMZ</strong> austauschen statt über direkte Verbindungen.</li>
</ul>

<h6>Regeln und Normen</h6>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th>Regelwerk</th><th>Gilt für</th><th>Kernaussagen</th></tr></thead>
  <tbody>
    <tr><td><strong>IEC 62443</strong></td><td>industrielle Automatisierung</td><td>Zonen und Übergänge, Security Level SL 1–4, Pflichten für Betreiber, Integratoren und Hersteller</td></tr>
    <tr><td><strong>ETSI EN 303 645</strong></td><td>IoT-Geräte für Verbraucher</td><td>keine universellen Standardpasswörter, Meldestelle für Schwachstellen, Software aktualisierbar halten, sichere Kommunikation</td></tr>
    <tr><td><strong>Funkanlagenrichtlinie</strong>, delegierte Verordnung (EU) 2022/30</td><td>vernetzte Funkgeräte auf dem EU-Markt</td><td>seit 1. August 2025 Pflicht: Schutz des Netzes, personenbezogener Daten und vor Betrug; harmonisierte Normen der Reihe EN 18031</td></tr>
    <tr><td><strong>Cyber Resilience Act</strong> (EU) 2024/2847</td><td>fast alle Produkte mit digitalen Elementen</td><td>Security by Design, keine bekannten ausnutzbaren Lücken bei Auslieferung, sichere Grundeinstellungen, Sicherheitsupdates über den Unterstützungszeitraum (in der Regel mindestens 5 Jahre); Meldepflicht für aktiv ausgenutzte Schwachstellen seit 11. September 2026 (Frühwarnung binnen 24 Stunden), volle Anwendung ab 11. Dezember 2027</td></tr>
    <tr><td><strong>Maschinenverordnung</strong> (EU) 2023/1230</td><td>Maschinen</td><td>ab 20. Januar 2027; verlangt auch Schutz sicherheitsrelevanter Steuerungen gegen Manipulation</td></tr>
  </tbody>
</table>
<p class="lf-pruefung"><strong>Prüfungstipp:</strong> In AP2-Szenarien wird oft eine unsichere Lösung beschrieben („Die Sensoren senden per MQTT auf Port 1883, das Standardpasswort wurde beibehalten …“). Nenne dann konkrete Schwachstellen <em>und</em> passende Maßnahmen – jeweils mit Begründung.</p>

<h6>Betrieb über den ganzen Lebenszyklus</h6>
<ol>
  <li><strong>Inventar</strong>: Welche Geräte gibt es, wo stehen sie, welche Firmware läuft? Ohne Liste kein Patch-Management.</li>
  <li><strong>Überwachen</strong>: Heartbeat bzw. Last Will, Batteriestand, Funkqualität, Fehlerzähler, Neustarts; Alarm bei Ausfall.</li>
  <li><strong>Aktualisieren</strong>: Sicherheitsmeldungen der Hersteller verfolgen, Updates testen und gestaffelt ausrollen.</li>
  <li><strong>Zertifikate und Schlüssel</strong>: Laufzeiten im Blick behalten, rechtzeitig erneuern, bei Verlust sperren.</li>
  <li><strong>Außerbetriebnahme</strong>: Zertifikat widerrufen, Zugangsdaten löschen, Gerät aus dem Inventar austragen, Datenträger sicher löschen.</li>
</ol>

<h6>Übungen mit Lösung</h6>
<p>1. Safety oder Security? (a) Not-Halt-Taster an einem Förderband, (b) TLS-Verschlüsselung für MQTT, (c) Heizung schaltet bei Sensorausfall ab, (d) signierte Firmware.</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Safety: (a) und (c) – sie schützen Menschen und Anlage bei Fehlern. Security: (b) und (d) – sie schützen vor Angreifern.</p>
</details>
<p>2. Eine Lagerhalle wird mit IP-Kameras überwacht. Sie hängen im Büronetz, das Admin-Passwort ist „admin“, Telnet ist aktiv, Updates gibt es als ZIP-Datei auf einer HTTP-Seite. Nenne vier Schwachstellen und je eine Maßnahme.</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Standardpasswort → individuelles, starkes Passwort. Telnet (unverschlüsselt) → abschalten, Verwaltung nur über HTTPS/SSH. Updates per HTTP ohne Signatur → nur signierte Updates über HTTPS, besser Hersteller mit sicherem Update-Prozess wählen. Kameras im Büronetz → eigenes VLAN, Zugriff nur vom Videoserver.</p>
</details>
<p>3. Warum arbeitet ein OTA-Update mit zwei Firmware-Partitionen?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Die laufende Firmware bleibt unangetastet, während das Update in die freie Partition geschrieben wird. Bei Stromausfall, ungültiger Signatur oder fehlgeschlagenem Selbsttest startet das Gerät weiter bzw. wieder von der alten Version (Rollback) – es wird nicht unbrauchbar.</p>
</details>
<p>4. Warum steht in der OT die Verfügbarkeit oft vor der Vertraulichkeit?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Ein Ausfall oder eine Fehlsteuerung wirkt sofort physisch: Produktion steht, Ware verdirbt, Menschen können gefährdet werden. Messwerte einer Anlage sind dagegen oft weniger vertraulich als etwa Kundendaten.</p>
</details>
<p>5. Ein Sensor sendet per MQTT an Port 1883 ohne Anmeldung. Welche drei Angriffe sind möglich, und wie verhinderst du sie?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Mitlesen der Daten, Einspeisen gefälschter Messwerte, Senden von Befehlen an Aktoren. Gegenmaßnahmen: TLS auf Port 8883, Anmeldung mit Gerätezertifikat oder individuellem Passwort, <code>allow_anonymous false</code>, Zugriffsrechte je Topic (ACL), Broker nicht offen ins Internet stellen.</p>
</details>
INHALT,
    'summary' => [
        'Safety schützt Menschen und Umwelt vor dem System, Security schützt das System vor Angreifern – beide hängen zusammen.',
        'Typische Schwachstellen: Standardpasswörter (Mirai), unverschlüsselte Protokolle, unsichere Updates, offene Debug-Ports, veraltete Software.',
        'OT priorisiert Verfügbarkeit und Integrität; Anlagen laufen Jahrzehnte und lassen sich oft nicht einfach patchen.',
        'Verteidigung in der Tiefe: Gerät, Kommunikation, Netzwerk, Organisation.',
        'Sichere Updates: Signatur, Secure Boot, A/B-Partitionen mit Rollback, Schutz vor Downgrade.',
        'Regelwerke: IEC 62443, ETSI EN 303 645, RED-Cybersicherheit seit 08/2025, Cyber Resilience Act (Meldepflichten seit 09/2026, voll ab 12/2027).',
    ],
    'quiz' => [
        ['question' => 'Was ist der Unterschied zwischen Safety und Security?', 'answer' => 'Safety schützt Menschen und Umwelt vor Gefahren durch das System, Security schützt das System vor absichtlichen Angriffen.'],
        ['question' => 'Wie konnte das Mirai-Botnetz so viele Geräte übernehmen?', 'answer' => 'Viele IoT-Geräte nutzten unveränderte Standardpasswörter, die das Botnetz einfach durchprobierte.'],
        ['question' => 'Wozu dient Secure Boot?', 'answer' => 'Der Bootloader prüft bei jedem Start die Signatur der Firmware und startet nur unveränderte, vom Hersteller signierte Software.'],
        ['question' => 'Welche Norm behandelt die Security industrieller Automatisierungssysteme?', 'answer' => 'Die IEC 62443 (Zonen und Übergänge, Security Level).'],
    ],
];
