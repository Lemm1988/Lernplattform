<?php
return [
    'title' => 'Kommunikation zwischen cyber-physischen Systemen',
    'intro' => 'Ein einzelner Sensorknoten ist nützlich – vernetzt wird er wertvoll. Aber Funk kostet Energie, Batterien sind klein, und das Netz ist nicht immer da. Dieses Kapitel zeigt, wie CPS Daten austauschen: über welche Funkstandards, mit welchem Protokoll und wo die Daten verarbeitet werden.',
    'goals' => [
        'Funkstandards für das IoT nach Reichweite, Datenrate und Energiebedarf auswählen',
        'das Publish-Subscribe-Prinzip von MQTT mit Broker, Topics und Wildcards erklären',
        'die QoS-Stufen von MQTT unterscheiden',
        'MQTT, HTTP/REST, CoAP und OPC UA einordnen',
        'Aufgaben von Edge-Gateway und Cloud abgrenzen und Datenmengen abschätzen',
    ],
    'content' => <<<'INHALT'
<h6>Funk oder Kabel?</h6>
<p>Kabel sind zuverlässig und können gleich Strom liefern (Power over Ethernet), in der Industrie sind Feldbusse und Industrial Ethernet Standard. Funk spart Verkabelung und erlaubt bewegliche oder weit verstreute Sensoren – kostet aber Energie, und die Verbindung kann gestört sein. Bei Funk gilt ein Dreieck, aus dem man nur zwei Ecken bekommt: <strong>große Reichweite</strong>, <strong>hohe Datenrate</strong>, <strong>geringer Energiebedarf</strong>.</p>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf7/funk-reichweite.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Streudiagramm mit logarithmischen Achsen: WLAN 50 Meter und einige hundert Mbit/s, Bluetooth LE 30 Meter und 1 Mbit/s, Zigbee 80 Meter und 250 kbit/s, LTE-M 10 Kilometer und 1 Mbit/s, NB-IoT 10 Kilometer und 60 kbit/s, LoRaWAN 5 Kilometer und wenige kbit/s">
  <figcaption class="figure-caption">Reichweite und Datenrate typischer IoT-Funkstandards (Größenordnungen)</figcaption>
</figure>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th>Standard</th><th>Reichweite</th><th>Datenrate</th><th>Energie</th><th>typisch für</th></tr></thead>
  <tbody>
    <tr><td>WLAN (Wi-Fi)</td><td>ca. 30–50 m in Gebäuden</td><td>bis Hunderte Mbit/s</td><td>hoch</td><td>Kameras, Geräte mit Netzteil, Gateways</td></tr>
    <tr><td>Bluetooth Low Energy</td><td>ca. 10–50 m</td><td>bis 1–2 Mbit/s</td><td>niedrig</td><td>Wearables, Kopplung mit dem Smartphone, Beacons</td></tr>
    <tr><td>Zigbee / Thread</td><td>ca. 10–100 m je Funkstrecke, mehr im Mesh</td><td>250 kbit/s</td><td>niedrig</td><td>Smart Home; Geräte leiten Nachrichten weiter (Mesh)</td></tr>
    <tr><td>LoRaWAN</td><td>2–15 km</td><td>ca. 0,3–50 kbit/s</td><td>sehr niedrig</td><td>Zähler, Umwelt- und Landwirtschaftssensoren, wenige Byte pro Nachricht</td></tr>
    <tr><td>NB-IoT / LTE-M</td><td>Mobilfunkzelle, gute Gebäudedurchdringung</td><td>einige 10 kbit/s bis ca. 1 Mbit/s</td><td>niedrig bis mittel</td><td>Tracker, Zähler, Geräte ohne eigenes Netz; SIM und Vertrag nötig</td></tr>
  </tbody>
</table>
<p>LoRaWAN funkt in Europa im lizenzfreien 868-MHz-Band. Dort gilt in den meisten Teilbändern ein <strong>Duty Cycle</strong> von 1 %: Ein Gerät darf höchstens 1 % der Zeit senden, also 36 Sekunden pro Stunde. Ein Sensor mit 0,4 s Sendezeit pro Nachricht darf deshalb höchstens alle 0,4 s / 0,01 = 40 s senden.</p>

<h6>MQTT: Publish und Subscribe</h6>
<p><strong>MQTT</strong> ist das Standardprotokoll im IoT. Es läuft über TCP, hat einen sehr kleinen Overhead und arbeitet nach dem <strong>Publish-Subscribe-Prinzip</strong>: Geräte schicken ihre Nachrichten an einen zentralen <strong>Broker</strong>, der sie an alle Interessenten verteilt.</p>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf7/mqtt-pubsub.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Zwei Sensoren veröffentlichen Werte unter Topics an einen Broker; Dashboard und Datenbank abonnieren gewaechshaus/#, die Lüftersteuerung abonniert gewaechshaus/+/temperatur">
  <figcaption class="figure-caption">Publisher und Subscriber sind entkoppelt – sie kennen nur den Broker</figcaption>
</figure>
<ul>
  <li><strong>Topic</strong>: hierarchischer Name mit <code>/</code> als Trenner, z. B. <code>gewaechshaus/haus1/temperatur</code>. Topics müssen nicht angelegt werden – sie entstehen beim ersten Publish.</li>
  <li><strong>Wildcards</strong> beim Abonnieren: <code>+</code> steht für genau eine Ebene, <code>#</code> für beliebig viele weitere Ebenen und darf nur am Ende stehen.</li>
  <li><strong>Nutzlast</strong> (Payload): beliebige Bytes, oft JSON wie <code>{"t":23.4,"h":61}</code>.</li>
  <li><strong>Retained Message</strong>: Der Broker merkt sich die letzte Nachricht eines Topics und schickt sie neuen Abonnenten sofort – das Dashboard zeigt nach dem Start gleich einen Wert.</li>
  <li><strong>Last Will</strong>: Eine Nachricht, die der Broker veröffentlicht, wenn ein Gerät unerwartet die Verbindung verliert, z. B. <code>status = offline</code>.</li>
  <li><strong>Ports</strong>: 1883 unverschlüsselt, <strong>8883 mit TLS</strong>. In produktiven Systemen immer TLS und Anmeldung verwenden (<a href="/Learningfields/LF7/kapitel8.php">Kapitel 8</a>).</li>
</ul>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th>Abonnement</th><th><code>gewaechshaus/haus1/temperatur</code></th><th><code>gewaechshaus/haus2/feuchte</code></th><th><code>gewaechshaus/haus1/boden/feuchte</code></th></tr></thead>
  <tbody>
    <tr><td><code>gewaechshaus/#</code></td><td>ja</td><td>ja</td><td>ja</td></tr>
    <tr><td><code>gewaechshaus/+/temperatur</code></td><td>ja</td><td>nein</td><td>nein</td></tr>
    <tr><td><code>gewaechshaus/+/feuchte</code></td><td>nein</td><td>ja</td><td>nein – <code>+</code> deckt nur eine Ebene ab</td></tr>
    <tr><td><code>gewaechshaus/haus1/#</code></td><td>ja</td><td>nein</td><td>ja</td></tr>
  </tbody>
</table>
<p><strong>Quality of Service</strong> legt fest, wie sicher eine Nachricht ankommt:</p>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th>QoS</th><th>Zusage</th><th>Ablauf</th><th>geeignet für</th></tr></thead>
  <tbody>
    <tr><td>0</td><td>höchstens einmal (<em>at most once</em>)</td><td>senden und vergessen</td><td>häufige Messwerte, bei denen ein fehlender Wert nicht stört</td></tr>
    <tr><td>1</td><td>mindestens einmal (<em>at least once</em>)</td><td>Bestätigung, bei Bedarf Wiederholung – Duplikate möglich</td><td>Alarme, Zählerstände mit Zeitstempel (Duplikate erkennbar)</td></tr>
    <tr><td>2</td><td>genau einmal (<em>exactly once</em>)</td><td>vierstufiger Handshake, langsamer</td><td>Befehle, die nicht doppelt ausgeführt werden dürfen, z. B. Abbuchungen</td></tr>
  </tbody>
</table>
<p class="lf-merke"><strong>Merke:</strong> MQTT = Broker in der Mitte, Topics als Adressen, <code>+</code> eine Ebene, <code>#</code> alle Ebenen am Ende, QoS 0/1/2 = höchstens/mindestens/genau einmal, Port 1883 bzw. 8883 mit TLS.</p>

<h6>Andere Protokolle</h6>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th>Protokoll</th><th>Prinzip</th><th>Stärken</th><th>typischer Einsatz</th></tr></thead>
  <tbody>
    <tr><td>MQTT</td><td>Publish/Subscribe über Broker, TCP</td><td>schlank, viele Empfänger, Geräte hinter NAT erreichbar</td><td>Telemetrie, Smart Home, IoT-Plattformen</td></tr>
    <tr><td>HTTP/REST</td><td>Anfrage/Antwort (Client/Server)</td><td>überall verfügbar, gut für Web-APIs</td><td>Konfiguration, gelegentliche Uploads, Cloud-Schnittstellen</td></tr>
    <tr><td>CoAP</td><td>REST-ähnlich über UDP</td><td>sehr wenig Overhead für schwache Geräte</td><td>batteriebetriebene Sensoren in IP-Netzen</td></tr>
    <tr><td>OPC UA</td><td>Client/Server und Pub/Sub mit Informationsmodell</td><td>herstellerübergreifend, Datentypen und Bedeutung inklusive, Sicherheit eingebaut</td><td>Industrie 4.0, Maschinen- und Anlagendaten</td></tr>
    <tr><td>Modbus (RTU/TCP)</td><td>Controller fragt Register ab</td><td>sehr einfach, weit verbreitet, alt</td><td>Energiezähler, Wechselrichter, Steuerungen</td></tr>
  </tbody>
</table>

<h6>Edge und Cloud</h6>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf7/edge-cloud.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Drei Ebenen: Geräte messen und schalten, das Edge-Gateway übersetzt Protokolle, filtert und regelt lokal, die Cloud speichert, wertet aus und verteilt Updates">
  <figcaption class="figure-caption">Wo die Daten verarbeitet werden</figcaption>
</figure>
<p><strong>Edge Computing</strong> heißt: Daten möglichst nah an der Quelle verarbeiten. Das Gateway im Gewächshaus regelt die Lüftung selbst, auch wenn das Internet ausfällt, und schickt nur Minutenmittelwerte statt jeder Einzelmessung in die Cloud. Die <strong>Cloud</strong> übernimmt, was viel Speicher oder den Blick über alle Standorte braucht: Langzeitspeicherung, Auswertungen, Dashboards, Benachrichtigungen, Update-Verteilung.</p>
<p class="lf-pruefung"><strong>Prüfungstipp:</strong> Bei „Was soll lokal, was in der Cloud passieren?“ entscheiden Reaktionszeit (Sicherheitsabschaltung immer lokal), Verfügbarkeit bei Netzausfall, Datenmenge und Datenschutz.</p>

<h6>Datenformate und Datenmengen</h6>
<ul>
  <li><strong>JSON</strong> ist lesbar und überall verarbeitbar, aber vergleichsweise groß. Binärformate (z. B. CBOR, Protocol Buffers) sparen Bytes – wichtig bei LoRaWAN mit wenigen Byte pro Nachricht.</li>
  <li>Zeitstempel in <strong>UTC</strong> und im Format ISO 8601 (<code>2026-10-21T08:15:00Z</code>), Einheiten eindeutig benennen (<code>temp_c</code> statt <code>temp</code>).</li>
  <li>Datenmenge abschätzen: <code>Menge = Nachrichtengröße · Nachrichten pro Zeit · Anzahl Geräte</code>. Sie entscheidet über Mobilfunktarif, Speicherbedarf und Funkstandard.</li>
</ul>

<h6>Übungen mit Lösung</h6>
<p>1. Welche der Topics <code>lager/halle2/regal5/temp</code>, <code>lager/halle2/temp</code>, <code>lager/halle3/regal1/temp</code> empfängt ein Abonnent von (a) <code>lager/+/temp</code>, (b) <code>lager/halle2/#</code>, (c) <code>lager/+/+/temp</code>?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">(a) nur <code>lager/halle2/temp</code>. (b) <code>lager/halle2/regal5/temp</code> und <code>lager/halle2/temp</code>. (c) <code>lager/halle2/regal5/temp</code> und <code>lager/halle3/regal1/temp</code>.</p>
</details>
<p>2. Ein Sensor sendet jede Minute eine MQTT-Nachricht mit 100 Byte (inklusive Overhead). Wie viele Daten fallen pro Tag und pro 30-Tage-Monat an?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Pro Tag: 100 B · 60 · 24 = 144 000 B = 144 kB. Pro Monat: 144 kB · 30 = 4,32 MB. Ein kleiner IoT-Mobilfunktarif reicht.</p>
</details>
<p>3. Ein LoRaWAN-Sensor braucht pro Nachricht 1,5 s Sendezeit. Wie oft darf er bei 1 % Duty Cycle höchstens senden?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">1,5 s / 0,01 = 150 s. Er darf also höchstens alle 2,5 Minuten senden (24-mal pro Stunde).</p>
</details>
<p>4. Welche QoS-Stufe wählst du für (a) Temperaturwerte alle 10 s, (b) einen Feueralarm, (c) den Befehl „Bewässerung für 5 Minuten einschalten“?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">(a) QoS 0 – der nächste Wert kommt gleich. (b) QoS 1 – er muss ankommen; ein doppelter Alarm schadet nicht. (c) QoS 2 – oder QoS 1 mit einer Befehls-ID, an der das Gerät Duplikate erkennt; eine doppelte Ausführung würde zu viel wässern.</p>
</details>
<p>5. Funkstandard wählen: (a) Bodenfeuchtesensoren auf einem 3 km entfernten Feld ohne Strom, eine Messung alle 15 Minuten; (b) Überwachungskamera im Lager; (c) Fitnessarmband, das mit dem Smartphone spricht.</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">(a) LoRaWAN (oder NB-IoT) – große Reichweite, wenige Daten, Batteriebetrieb. (b) WLAN oder Ethernet mit PoE – hohe Datenrate, Stromversorgung vorhanden. (c) Bluetooth Low Energy.</p>
</details>
INHALT,
    'summary' => [
        'Funk: Reichweite, Datenrate und Energiebedarf stehen im Zielkonflikt – WLAN schnell, BLE nah, LoRaWAN weit und sparsam.',
        'LoRaWAN im 868-MHz-Band: meist 1 % Duty Cycle (36 s Sendezeit pro Stunde).',
        'MQTT: Publish/Subscribe über einen Broker, hierarchische Topics, + = eine Ebene, # = alle weiteren Ebenen.',
        'QoS 0 höchstens einmal, 1 mindestens einmal, 2 genau einmal; Retained Message und Last Will; Port 1883 / 8883 (TLS).',
        'HTTP/REST für Web-APIs, CoAP für schwache Geräte über UDP, OPC UA für die Industrie, Modbus für einfache Registerabfragen.',
        'Edge verarbeitet vor Ort (schnell, offline-fähig), die Cloud speichert und wertet standortübergreifend aus.',
    ],
    'quiz' => [
        ['question' => 'Welche Rolle hat der Broker bei MQTT?', 'answer' => 'Er nimmt alle veröffentlichten Nachrichten an und verteilt sie anhand der Topics an die Abonnenten.'],
        ['question' => 'Was bedeutet die Wildcard + in einem MQTT-Abonnement?', 'answer' => 'Genau eine beliebige Topic-Ebene.'],
        ['question' => 'Was garantiert MQTT QoS 1?', 'answer' => 'Die Nachricht kommt mindestens einmal an; Duplikate sind möglich.'],
        ['question' => 'Warum regelt man sicherheitskritische Funktionen an der Edge statt in der Cloud?', 'answer' => 'Weil die Reaktion schnell und auch bei Ausfall der Internetverbindung funktionieren muss.'],
    ],
];
