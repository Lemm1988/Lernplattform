<?php
return [
    'title' => 'Netzwerke planen: Anforderungen, Topologie, Verkabelung',
    'intro' => 'Bevor ein Switch eingesteckt wird, steht die Planung: Wer braucht was, wie viel, wie sicher? Und welche Kabel tragen das alles?',
    'goals' => [
        'Anforderungen an ein Netzwerk systematisch erheben',
        'Topologien vergleichen und begründet auswählen',
        'die Bereiche der strukturierten Verkabelung und ihre Längengrenzen nennen',
        'Übertragungsmedien (Twisted Pair, Lichtwellenleiter, Funk) auswählen',
        'Netzwerkgeräte den Schichten des OSI-Modells zuordnen',
    ],
    'content' => <<<'INHALT'
<h6>Anforderungsanalyse</h6>
<p>Wie bei Software (<a href="/Learningfields/LF12/kapitel1.php">LF12 Kapitel 1</a>) beginnt jedes Netzwerkprojekt mit dem Ist-Zustand und den Anforderungen:</p>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th>Frage</th><th>Beispiel</th></tr></thead>
  <tbody>
    <tr><td>Wie viele Teilnehmer, wo?</td><td>45 Arbeitsplätze auf 3 Etagen, 10 Drucker, 30 WLAN-Geräte, 2 Server</td></tr>
    <tr><td>Welche Dienste und Datenmengen?</td><td>Office, Dateiablage, Videokonferenzen, Backups nachts</td></tr>
    <tr><td>Welche Bereiche sind zu trennen?</td><td>Verwaltung, Produktion, Gäste-WLAN, Server (→ VLANs, <a href="/Learningfields/LF9/kapitel3.php">Kapitel 3</a>)</td></tr>
    <tr><td>Verfügbarkeit?</td><td>Produktion darf höchstens 1 Stunde ausfallen → redundante Verbindungen, USV</td></tr>
    <tr><td>Sicherheit?</td><td>Zugriff von außen nur über VPN, Gäste ohne Zugang zum Firmennetz (<a href="/Learningfields/LF9/kapitel8.php">Kapitel 8</a>)</td></tr>
    <tr><td>Wachstum, Budget?</td><td>+30 % Arbeitsplätze in drei Jahren, Reserve im Adressplan und bei den Switch-Ports</td></tr>
  </tbody>
</table>

<h6>Topologien</h6>
<ul>
  <li><strong>Stern</strong>: alle Geräte an einem zentralen Switch. Ausfall eines Kabels betrifft nur ein Gerät; der Switch ist zentraler Ausfallpunkt. Heute Standard.</li>
  <li><strong>Erweiterter Stern (Baum)</strong>: Sterne über mehrere Ebenen (Kern-, Verteil-, Zugangsebene) – typisch für Firmennetze.</li>
  <li><strong>Masche</strong>: mehrere Wege zwischen Knoten, hohe Ausfallsicherheit, teuer – im Backbone und im Internet.</li>
  <li><strong>Bus</strong> und <strong>Ring</strong>: historisch (frühes Ethernet, Token Ring); heute kaum noch im LAN.</li>
</ul>

<h6>Strukturierte Verkabelung</h6>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf9/strukturierte-verkabelung.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Zwei Gebäude: Primärbereich zwischen Standort- und Gebäudeverteiler, Sekundärbereich senkrecht zu den Etagenverteilern, Tertiärbereich zu den Anschlussdosen">
  <figcaption class="figure-caption">Primär-, Sekundär- und Tertiärbereich nach EN 50173</figcaption>
</figure>
<p>Die strukturierte Verkabelung ist anwendungsneutral: Die Kabel liegen einmal, und an jeder Dose kann später ein PC, Telefon, Drucker oder Access Point hängen.
Im <strong>Tertiärbereich</strong> gilt für Twisted Pair: höchstens <strong>90 m</strong> fest verlegtes Kabel plus 10 m Patchkabel – zusammen 100 m.</p>

<h6>Übertragungsmedien</h6>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th>Medium</th><th>Reichweite</th><th>Datenrate (typisch)</th><th>Einsatz</th></tr></thead>
  <tbody>
    <tr><td>Twisted Pair Cat 6A</td><td>100 m</td><td>10 Gbit/s</td><td>Tertiärbereich, Arbeitsplatz</td></tr>
    <tr><td>Twisted Pair Cat 8</td><td>30 m</td><td>25/40 Gbit/s</td><td>Rechenzentrum, kurze Strecken</td></tr>
    <tr><td>LWL Multimode (OM3/OM4)</td><td>einige 100 m</td><td>10–100 Gbit/s</td><td>Sekundärbereich, Gebäude</td></tr>
    <tr><td>LWL Singlemode (OS2)</td><td>bis viele km</td><td>sehr hoch</td><td>Primärbereich, zwischen Standorten</td></tr>
    <tr><td>WLAN (Wi-Fi 6/7)</td><td>Raum bis Etage</td><td>geteiltes Medium</td><td>mobile Geräte</td></tr>
  </tbody>
</table>
<p>Lichtwellenleiter sind unempfindlich gegen elektromagnetische Störungen und Blitzschlag (keine Potenzialunterschiede zwischen Gebäuden) – deshalb zwischen Gebäuden
immer LWL. Kupfer ist günstiger und kann Endgeräte per <strong>PoE</strong> (Power over Ethernet) mit Strom versorgen, etwa Access Points und IP-Telefone.</p>

<h6>Geräte und Schichten</h6>
<p>Das OSI-Modell (ausführlich in <a href="/Learningfields/LF3/index.php">LF3</a>) hilft, Geräte und Fehler einzuordnen:</p>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th>Schicht</th><th>Name</th><th>Adresse / Einheit</th><th>Gerät</th></tr></thead>
  <tbody>
    <tr><td>1</td><td>Bitübertragung</td><td>Bits, Signale</td><td>Kabel, Repeater, Medienkonverter</td></tr>
    <tr><td>2</td><td>Sicherung (Data Link)</td><td>MAC-Adresse, Frame</td><td>Switch, Access Point (Bridge)</td></tr>
    <tr><td>3</td><td>Vermittlung (Network)</td><td>IP-Adresse, Paket</td><td>Router, Layer-3-Switch</td></tr>
    <tr><td>4</td><td>Transport</td><td>Port, Segment</td><td>Firewall (Paketfilter)</td></tr>
    <tr><td>5–7</td><td>Sitzung, Darstellung, Anwendung</td><td>Daten</td><td>Proxy, Application Firewall</td></tr>
  </tbody>
</table>
<div class="lf-merke"><strong>Merke:</strong> Fehlersuche von unten nach oben: Leuchtet die Link-LED (Schicht 1)? Kennt der Switch die MAC-Adresse (2)? Stimmen IP-Adresse,
Maske und Gateway (3)? Ist der Port erreichbar (4)? Läuft der Dienst (7)?</div>

<h6>Übungen mit Lösung</h6>
<p>1. Zwei Gebäude liegen 400 m auseinander. Welches Medium verbindest du, und warum?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Lichtwellenleiter (Singlemode oder Multimode OM4, je nach Datenrate): Twisted Pair schafft nur 100 m, und LWL verhindert Probleme durch unterschiedliche Erdpotenziale
und Blitzeinschläge zwischen Gebäuden.</p>
</details>
<p>2. Ein Arbeitsplatz liegt 95 m kabelweg vom Etagenverteiler entfernt; das Patchkabel ist 3 m lang. Ist das zulässig?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Nein. Fest verlegt sind höchstens 90 m erlaubt. Lösung: zusätzlicher Verteiler näher am Arbeitsplatz oder eine andere Kabelführung.</p>
</details>
<p>3. Auf welcher OSI-Schicht arbeitet ein Switch, auf welcher ein Router?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Switch: Schicht 2 (MAC-Adressen). Router: Schicht 3 (IP-Adressen). Layer-3-Switches können beides.</p>
</details>
INHALT,
    'summary' => [
        'Anforderungen erheben: Teilnehmer, Dienste, Datenmengen, Trennung, Verfügbarkeit, Sicherheit, Wachstum.',
        'Topologie heute: (erweiterter) Stern; Masche für Redundanz im Backbone.',
        'Strukturierte Verkabelung: Primär (Gebäude ↔ Gebäude), Sekundär (Steigbereich), Tertiär (Etage → Dose, 90 m + 10 m).',
        'Twisted Pair bis 100 m und mit PoE; LWL für lange Strecken und zwischen Gebäuden.',
        'Switch = Schicht 2 (MAC), Router = Schicht 3 (IP); Fehlersuche von unten nach oben.',
    ],
    'quiz' => [
        ['question' => 'Wie lang darf die fest verlegte Twisted-Pair-Strecke im Tertiärbereich höchstens sein?', 'answer' => '90 m (plus 10 m Patchkabel, zusammen 100 m).'],
        ['question' => 'Warum verbindet man Gebäude mit Lichtwellenleitern?', 'answer' => 'Größere Reichweite und keine elektrische Verbindung – unempfindlich gegen Störungen, Potenzialunterschiede und Blitzschlag.'],
        ['question' => 'Was ist ein Nachteil der Sterntopologie?', 'answer' => 'Der zentrale Switch ist ein Single Point of Failure; fällt er aus, ist das ganze Segment betroffen.'],
        ['question' => 'Was ist PoE?', 'answer' => 'Power over Ethernet: Stromversorgung von Endgeräten wie Access Points oder IP-Telefonen über das Netzwerkkabel.'],
    ],
];
