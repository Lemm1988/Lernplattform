<?php
return [
    'title' => 'Netzwerke im Überblick',
    'intro' => 'Bevor ein Client ins Netz kommt, hilft ein Blick auf das Ganze: Welche Arten von Netzen gibt es, wie sind sie aufgebaut, wer bietet Dienste an und wie werden Daten überhaupt vermittelt?',
    'goals' => [
        'Netze nach Ausdehnung einordnen (PAN, LAN, MAN, WAN, GAN)',
        'Internet, Intranet und Extranet unterscheiden',
        'Client-Server- und Peer-to-Peer-Modell vergleichen',
        'Leitungs- und Paketvermittlung erklären',
        'Topologien beschreiben und bewerten',
    ],
    'content' => <<<'INHALT'
<h6>Netze nach Ausdehnung</h6>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th>Netz</th><th>Ausdehnung</th><th>Beispiel</th></tr></thead>
  <tbody>
    <tr><td>PAN – Personal Area Network</td><td>wenige Meter</td><td>Smartphone mit Kopfhörer und Uhr per Bluetooth</td></tr>
    <tr><td>LAN – Local Area Network</td><td>Gebäude, Gelände</td><td>Büronetz mit Switches und WLAN</td></tr>
    <tr><td>MAN – Metropolitan Area Network</td><td>Stadt, Region</td><td>Glasfasernetz eines Stadtwerks, Campus mehrerer Standorte</td></tr>
    <tr><td>WAN – Wide Area Network</td><td>Länder, Kontinente</td><td>Verbindung zwischen Firmenstandorten über Provider</td></tr>
    <tr><td>GAN – Global Area Network</td><td>weltweit</td><td>das Internet, Satellitennetze</td></tr>
  </tbody>
</table>
<p>Das <strong>Internet</strong> ist öffentlich und weltweit. Ein <strong>Intranet</strong> nutzt dieselbe Technik (Webseiten, E-Mail), ist aber nur für die eigenen Beschäftigten
zugänglich. Ein <strong>Extranet</strong> öffnet Teile davon kontrolliert für Partner, etwa ein Lieferantenportal.</p>

<h6>Wer bietet Dienste an?</h6>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf3/client-server-p2p.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Links vier Clients, die einen zentralen Server nutzen; rechts vier gleichberechtigte Peers, die direkt verbunden sind">
  <figcaption class="figure-caption">Zentral verwaltet oder gleichberechtigt</figcaption>
</figure>
<p>Ein <strong>Client</strong> fordert einen Dienst an, ein <strong>Server</strong> stellt ihn bereit. „Server“ meint dabei die Software (den Dienst) – ein Rechner kann mehrere
Serverdienste und zugleich Clients betreiben. Ab einer Handvoll Arbeitsplätze setzen Unternehmen auf Client-Server, weil Benutzer, Rechte und Datensicherung sonst nicht beherrschbar sind.</p>

<h6>Wie Daten vermittelt werden</h6>
<ul>
  <li><strong>Leitungsvermittlung</strong>: Für die Dauer der Verbindung wird ein fester Weg mit fester Bandbreite reserviert – wie beim klassischen Telefonnetz.
    Gleichmäßige Qualität, aber die Leitung bleibt auch in Gesprächspausen belegt.</li>
  <li><strong>Paketvermittlung</strong>: Daten werden in Pakete zerlegt, die einzeln und eventuell auf verschiedenen Wegen zum Ziel laufen und dort wieder zusammengesetzt werden.
    Die Leitungen werden von vielen gleichzeitig genutzt – das Prinzip von IP und damit des Internets. Auch Telefonie läuft heute paketvermittelt (Voice over IP).</li>
</ul>

<h6>Topologien</h6>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf3/topologien.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Bus, Ring, Stern, Baum und vermaschte Topologie als kleine Schemazeichnungen mit Kurzbewertung">
  <figcaption class="figure-caption">Fünf Grundformen, wie Geräte verbunden werden</figcaption>
</figure>
<p>Im heutigen LAN ist der (erweiterte) <strong>Stern</strong> Standard: Jedes Gerät hat ein eigenes Kabel zum Switch, ein Kabelbruch betrifft nur dieses Gerät.
Für Ausfallsicherheit werden zentrale Verbindungen zusätzlich doppelt ausgelegt – eine teilweise <strong>Vermaschung</strong>, deren Schleifen der Spanning Tree
auflöst (<a href="/Learningfields/LF9/kapitel2.php">LF9 Kapitel 2</a>).</p>

<h6>Ein Netz planen</h6>
<p>Am Anfang steht die <strong>Ist-Aufnahme</strong>: vorhandene Geräte, Kabel, Räume, Dienste und Probleme. Daraus ergeben sich mit den Anforderungen (Zahl der Arbeitsplätze,
Dienste, Sicherheit, Wachstum, Budget) die Planungskriterien. Wie das im Detail aussieht, zeigt <a href="/Learningfields/LF9/kapitel1.php">LF9 Kapitel 1</a>.</p>

<h6>Übungen mit Lösung</h6>
<p>1. Ein Hersteller stellt seinen Händlern ein Portal mit Preislisten und Bestellstatus bereit, das intern auch die Mitarbeitenden nutzen. Intranet oder Extranet?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Extranet – es wird kontrolliert für externe Partner geöffnet. Der rein interne Teil wäre Intranet.</p>
</details>
<p>2. Ein Architekturbüro mit drei Rechnern teilt Dateien über Freigaben auf jedem PC. Welches Modell ist das, und was wird bei Wachstum zum Problem?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Peer-to-Peer (Arbeitsgruppe). Mit mehr Rechnern werden Benutzer, Rechte und Datensicherung auf jedem Gerät einzeln unübersichtlich; dann lohnt ein Server mit zentraler Ablage und Sicherung.</p>
</details>
<p>3. Warum eignet sich Paketvermittlung besser für das Internet als Leitungsvermittlung?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Datenverkehr kommt in Schüben. Bei Paketvermittlung teilen sich viele die Leitungen, Pausen bleiben nicht ungenutzt, und fällt ein Weg aus, nehmen die Pakete einen anderen.</p>
</details>
INHALT,
    'summary' => [
        'Nach Ausdehnung: PAN, LAN, MAN, WAN, GAN.',
        'Internet öffentlich, Intranet intern, Extranet für ausgewählte Partner.',
        'Client-Server: zentrale Verwaltung, Server als Ausfallpunkt; Peer-to-Peer: einfach, aber dezentral.',
        'Leitungsvermittlung reserviert einen Weg, Paketvermittlung (IP) teilt die Leitungen.',
        'Topologien: Bus, Ring, Stern (LAN-Standard), Baum, vermascht.',
    ],
    'quiz' => [
        ['question' => 'Was ist ein Extranet?', 'answer' => 'Ein Teil des Firmennetzes, der kontrolliert für externe Partner geöffnet ist.'],
        ['question' => 'Welche Topologie ist im heutigen LAN Standard?', 'answer' => 'Der (erweiterte) Stern mit Switches.'],
        ['question' => 'Was unterscheidet Paket- von Leitungsvermittlung?', 'answer' => 'Paketvermittlung zerlegt Daten in Pakete, die sich die Leitungen teilen; Leitungsvermittlung reserviert einen festen Weg.'],
        ['question' => 'Was ist ein Nachteil von Peer-to-Peer?', 'answer' => 'Keine zentrale Verwaltung: Rechte und Datensicherung müssen an jedem Gerät einzeln gepflegt werden.'],
    ],
];
