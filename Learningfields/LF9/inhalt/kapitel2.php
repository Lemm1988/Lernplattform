<?php
return [
    'title' => 'Switching: Ethernet, MAC-Adressen und Spanning Tree',
    'intro' => 'Im LAN entscheidet der Switch, welcher Frame an welchen Port geht. Wer versteht, wie er lernt, findet Fehler schneller – und weiß, warum Schleifen ohne Spanning Tree ein Netz lahmlegen.',
    'goals' => [
        'den Aufbau eines Ethernet-Frames und einer MAC-Adresse beschreiben',
        'erklären, wie ein Switch seine MAC-Adresstabelle aufbaut und Frames weiterleitet',
        'Kollisions- und Broadcastdomänen in einem Netzplan zählen',
        'die Aufgabe von Spanning Tree erklären und die Root Bridge bestimmen',
        'Link Aggregation als Mittel für Bandbreite und Redundanz einordnen',
    ],
    'content' => <<<'INHALT'
<h6>Der Ethernet-Frame</h6>
<p>Auf Schicht 2 werden Daten in <strong>Frames</strong> verpackt. Der Switch interessiert sich vor allem für die beiden Adressen am Anfang:</p>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th>Feld</th><th>Länge</th><th>Bedeutung</th></tr></thead>
  <tbody>
    <tr><td>Präambel + SFD</td><td>7 + 1 Byte</td><td>Taktsynchronisation, Start-Kennung (zählt nicht zur Framegröße)</td></tr>
    <tr><td>Ziel-MAC</td><td>6 Byte</td><td>an wen?</td></tr>
    <tr><td>Quell-MAC</td><td>6 Byte</td><td>von wem? – daraus lernt der Switch</td></tr>
    <tr><td>802.1Q-Tag (optional)</td><td>4 Byte</td><td>VLAN-Nummer und Priorität (<a href="/Learningfields/LF9/kapitel3.php">Kapitel 3</a>)</td></tr>
    <tr><td>EtherType</td><td>2 Byte</td><td>was steckt drin? 0x0800 = IPv4, 0x86DD = IPv6, 0x0806 = ARP</td></tr>
    <tr><td>Nutzdaten</td><td>46–1500 Byte</td><td>z. B. ein IP-Paket; die 1500 Byte heißen <strong>MTU</strong></td></tr>
    <tr><td>FCS</td><td>4 Byte</td><td>Prüfsumme (CRC-32); fehlerhafte Frames werden verworfen</td></tr>
  </tbody>
</table>
<p>Ein Frame ist also mindestens 64 und höchstens 1518 Byte groß (mit VLAN-Tag 1522 Byte).</p>

<h6>MAC-Adressen</h6>
<p>Eine MAC-Adresse ist 48 Bit lang und wird als sechs Hex-Bytes geschrieben, etwa <code>3C:52:82:1A:7F:04</code>.
Die ersten drei Bytes sind der <strong>OUI</strong> (Herstellerkennung), die letzten drei vergibt der Hersteller fortlaufend.
Zwei Bits im ersten Byte haben eine Sonderbedeutung:</p>
<ul>
  <li>niederwertigstes Bit = 1 → <strong>Multicast</strong> (z. B. <code>01:00:5E:…</code>); alle Bits 1 → <strong>Broadcast</strong> <code>FF:FF:FF:FF:FF:FF</code></li>
  <li>zweites Bit = 1 → <strong>lokal verwaltet</strong>, also nicht vom Hersteller (z. B. <code>02:…</code>, typisch für virtuelle Maschinen und zufällige WLAN-MACs von Smartphones)</li>
</ul>

<h6>Wie ein Switch lernt und weiterleitet</h6>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf9/switch-lernen.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Switch mit vier Ports: Er lernt die Absenderadresse, flutet unbekannte Ziele an alle anderen Ports und leitet bekannte Ziele gezielt weiter">
  <figcaption class="figure-caption">Lernen aus der Quelladresse, Weiterleiten nach der Zieladresse</figcaption>
</figure>
<ol>
  <li><strong>Lernen:</strong> Die Quell-MAC eines eingehenden Frames wird mit dem Eingangsport in die MAC-Adresstabelle (CAM-Tabelle) eingetragen.</li>
  <li><strong>Weiterleiten:</strong> Ist die Ziel-MAC bekannt, geht der Frame nur an diesen Port (<em>Unicast</em>).</li>
  <li><strong>Fluten:</strong> Ist sie unbekannt – oder ist es ein Broadcast –, geht der Frame an alle Ports außer dem Eingang.</li>
  <li><strong>Filtern:</strong> Liegt das Ziel am Eingangsport selbst, wird der Frame verworfen.</li>
  <li><strong>Altern:</strong> Einträge, die lange nicht bestätigt wurden (oft 300 s), verschwinden; so bemerkt der Switch umgezogene Geräte.</li>
</ol>
<p>Weiterleitungsverfahren: <strong>Store-and-Forward</strong> liest den ganzen Frame und prüft die FCS (Standard, verwirft defekte Frames);
<strong>Cut-Through</strong> sendet schon nach der Ziel-MAC weiter (geringere Latenz, leitet aber auch defekte Frames weiter);
<strong>Fragment-Free</strong> wartet die ersten 64 Byte ab, in denen Kollisionsreste auffallen würden.</p>

<h6>Kollisions- und Broadcastdomänen</h6>
<ul>
  <li><strong>Kollisionsdomäne</strong>: Bereich, in dem sich gleichzeitig gesendete Signale stören können. Ein <strong>Hub</strong> bildet mit allen Geräten eine einzige,
    beim <strong>Switch</strong> ist jeder Port eine eigene. Mit Vollduplex gibt es dort praktisch keine Kollisionen mehr.</li>
  <li><strong>Broadcastdomäne</strong>: Bereich, den ein Broadcast erreicht. Switches leiten Broadcasts weiter, erst ein <strong>Router</strong> (oder ein VLAN) trennt sie.
    Jedes Router-Interface ist eine eigene Broadcastdomäne.</li>
</ul>
<div class="lf-pruefung"><strong>Prüfungstipp:</strong> Zählaufgaben gehen so: Broadcastdomänen = Anzahl genutzter Router-Interfaces (bzw. VLANs).
Kollisionsdomänen = jede Verbindung an einem Switch- oder Router-Port zählt einzeln, ein Hub mit allem, was an ihm hängt, zählt einmal.</div>

<h6>Spanning Tree (STP, IEEE 802.1D)</h6>
<p>Für Ausfallsicherheit verbindet man Switches über mehrere Wege. Das erzeugt eine Schleife: Ein Broadcast würde endlos kreisen (<em>Broadcast-Sturm</em>),
und die MAC-Tabellen würden ständig umlernen. Spanning Tree schaltet deshalb einzelne Ports logisch ab, bis aus dem Netz ein schleifenfreier Baum wird.</p>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf9/stp.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Drei Switches im Dreieck: Switch 1 ist Root Bridge, Switch 2 und 3 haben je einen Root Port, der Port von Switch 3 zu Switch 2 ist blockiert">
  <figcaption class="figure-caption">Die Root Bridge wird gewählt, der Rest richtet sich nach ihr aus</figcaption>
</figure>
<ul>
  <li><strong>Bridge-ID</strong> = Priorität (Standard 32768, einstellbar in Schritten von 4096) + MAC-Adresse. Die kleinste Bridge-ID gewinnt.</li>
  <li><strong>Pfadkosten</strong> hängen von der Geschwindigkeit ab, z. B. 19 für 100 Mbit/s, 4 für 1 Gbit/s, 2 für 10 Gbit/s (klassische Werte nach 802.1D).</li>
  <li>Klassisches STP braucht bis zu 50 s, bis ein Ersatzweg aktiv ist. <strong>RSTP</strong> (802.1w) schafft das in wenigen Sekunden und ist heute Standard.</li>
</ul>
<div class="lf-merke"><strong>Merke:</strong> Die Root Bridge sollte ein leistungsstarker Switch im Kern sein. Man legt sie deshalb gezielt über eine kleine Priorität fest,
statt den Zufall der kleinsten MAC-Adresse entscheiden zu lassen.</div>

<h6>Link Aggregation</h6>
<p>Mehrere parallele Kabel zwischen zwei Switches würde STP bis auf eins blockieren. Mit <strong>Link Aggregation</strong> (LACP, IEEE 802.1AX) werden sie
zu einer logischen Verbindung gebündelt: mehr Bandbreite, und fällt ein Kabel aus, laufen die anderen weiter.</p>

<h6>Übungen mit Lösung</h6>
<p>1. Ein Router hat zwei genutzte LAN-Interfaces. An Interface 1 hängt ein Switch mit drei PCs, an Interface 2 ein Hub mit zwei PCs.
Wie viele Broadcast- und wie viele Kollisionsdomänen gibt es?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Broadcastdomänen: <strong>2</strong> (eine je Router-Interface).
Kollisionsdomänen: <strong>5</strong> – am Switch vier Verbindungen (drei PCs plus Uplink zum Router), dazu der Hub mit seinen PCs und dem Router-Port als eine Domäne.</p>
</details>
<p>2. In der Grafik oben wird bei Switch 3 die Priorität auf 4096 gesenkt. Was ändert sich?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Switch 3 hat jetzt die kleinste Bridge-ID und wird Root Bridge. Switch 1 und Switch 2 wählen ihren direkten Port zu Switch 3 als Root Port.
Auf der Leitung Switch 1–Switch 2 gewinnt Switch 1 (32768 + kleinere MAC) den Designated Port; der Port von Switch 2 wird blockiert.</p>
</details>
<p>3. Ist <code>02:42:AC:11:00:02</code> eine vom Hersteller vergebene MAC-Adresse?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Nein. 0x02 = 0000 0010: Das zweite Bit ist gesetzt, die Adresse ist <strong>lokal verwaltet</strong> (solche Adressen vergibt z. B. Docker für Container).
Das unterste Bit ist 0, es ist also eine Unicast-Adresse.</p>
</details>
INHALT,
    'summary' => [
        'Ethernet-Frame: Ziel-MAC, Quell-MAC, optional VLAN-Tag, EtherType, 46–1500 Byte Nutzdaten (MTU), FCS.',
        'MAC-Adresse: 48 Bit, die ersten 3 Byte sind der OUI; Broadcast = FF:FF:FF:FF:FF:FF.',
        'Switch: lernt aus der Quell-MAC, leitet nach der Ziel-MAC, flutet Unbekanntes und Broadcasts.',
        'Jeder Switch-Port ist eine eigene Kollisionsdomäne; Broadcastdomänen trennt erst der Router oder ein VLAN.',
        'STP verhindert Schleifen: kleinste Bridge-ID wird Root, überflüssige Ports werden blockiert; RSTP ist schneller.',
    ],
    'quiz' => [
        ['question' => 'Aus welchem Feld eines Frames lernt der Switch?', 'answer' => 'Aus der Quell-MAC-Adresse, zusammen mit dem Eingangsport.'],
        ['question' => 'Was macht ein Switch mit einem Frame an eine unbekannte Ziel-MAC?', 'answer' => 'Er flutet ihn an alle Ports außer dem Eingangsport.'],
        ['question' => 'Welches Gerät trennt Broadcastdomänen?', 'answer' => 'Ein Router (bzw. ein Layer-3-Switch); logisch auch ein VLAN.'],
        ['question' => 'Wie wird die Root Bridge bestimmt?', 'answer' => 'Kleinste Bridge-ID: zuerst die Priorität, bei Gleichstand die kleinere MAC-Adresse.'],
        ['question' => 'Wozu dient LACP?', 'answer' => 'Mehrere physische Links zu einer logischen Verbindung bündeln – mehr Bandbreite und Redundanz.'],
    ],
];
