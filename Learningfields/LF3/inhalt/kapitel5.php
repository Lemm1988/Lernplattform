<?php
return [
    'title' => 'Netzwerkkomponenten',
    'intro' => 'Hub, Switch, Router, Access Point, Modem – im Alltag werden die Begriffe oft durcheinandergeworfen. Wer sie sauber trennt, kann ein kleines Netz planen und weiß, welches Gerät für welchen Fehler infrage kommt.',
    'goals' => [
        'aktive und passive Netzwerkkomponenten unterscheiden',
        'Hub, Switch und Router nach Funktion und OSI-Schicht abgrenzen',
        'Anschlussarten ans Internet (DSL, Kabel, Glasfaser, Mobilfunk) einordnen',
        'Komponenten für ein kleines Büronetz auswählen',
        'Netzwerkschrank, Patchpanel und Höheneinheiten erklären',
    ],
    'content' => <<<'INHALT'
<h6>Ein typisches kleines Netz</h6>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf3/buero-netz.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Internet über Glasfaser zum ONT, dann Router mit Firewall, verwalteter PoE-Switch im Netzwerkschrank; daran PCs, Drucker, Access Points, NAS und IP-Telefone">
  <figcaption class="figure-caption">Vom Hausanschluss bis zum Arbeitsplatz</figcaption>
</figure>

<h6>Aktive Komponenten</h6>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th>Gerät</th><th>Schicht</th><th>Funktion</th></tr></thead>
  <tbody>
    <tr><td>Netzwerkkarte (NIC)</td><td>1–2</td><td>verbindet ein Gerät mit dem Netz, hat die MAC-Adresse</td></tr>
    <tr><td>Repeater, Hub</td><td>1</td><td>verstärkt Signale; der Hub verteilt alles an alle Ports – veraltet</td></tr>
    <tr><td>Bridge, Switch</td><td>2</td><td>leitet Frames anhand der MAC-Adresse gezielt weiter (<a href="/Learningfields/LF9/kapitel2.php">LF9 Kapitel 2</a>)</td></tr>
    <tr><td>Layer-3-Switch</td><td>2–3</td><td>Switch, der zusätzlich zwischen VLANs routet</td></tr>
    <tr><td>Router</td><td>3</td><td>verbindet Netze, entscheidet anhand der IP-Adresse über den Weg</td></tr>
    <tr><td>Access Point</td><td>2</td><td>verbindet WLAN-Geräte mit dem kabelgebundenen Netz (Bridge)</td></tr>
    <tr><td>Firewall</td><td>3–7</td><td>filtert Verkehr zwischen Netzen nach Regeln</td></tr>
    <tr><td>Modem</td><td>1</td><td>wandelt Signale für die Zugangsleitung um</td></tr>
    <tr><td>Medienkonverter</td><td>1</td><td>verbindet Kupfer und Glasfaser</td></tr>
  </tbody>
</table>
<p>Der „Router“ zu Hause ist meist ein Kombigerät aus Modem, Router, Firewall, Switch, Access Point, DHCP- und DNS-Server. Im Unternehmen trennt man diese
Funktionen auf eigene Geräte – das erhöht Leistung, Sicherheit und Ausfallsicherheit.</p>
<p>Bei Switches unterscheidet man <strong>unmanaged</strong> (einstecken und fertig) und <strong>managed</strong> (konfigurierbar: VLANs, PoE-Steuerung, Port-Statistik,
Spanning Tree, Port Security). Im Firmennetz sind verwaltete Switches Pflicht.</p>

<h6>Anschluss ans Internet</h6>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th>Technik</th><th>Leitung</th><th>Merkmal</th></tr></thead>
  <tbody>
    <tr><td>DSL (VDSL)</td><td>Telefonkupferleitung</td><td>Datenrate sinkt mit der Entfernung zum Verteiler</td></tr>
    <tr><td>Kabel (DOCSIS)</td><td>TV-Koaxialkabel</td><td>hohe Raten, aber geteiltes Medium im Wohngebiet</td></tr>
    <tr><td>Glasfaser (FTTH)</td><td>Glasfaser bis ins Haus, Abschluss am ONT</td><td>sehr hohe, oft symmetrische Raten</td></tr>
    <tr><td>Mobilfunk (LTE, 5G)</td><td>Funk</td><td>flexibel, als Hauptanschluss oder als Ausfallreserve</td></tr>
  </tbody>
</table>
<p>Für Unternehmen zählen neben der Datenrate: Upload, feste IP-Adresse, garantierte Entstörzeit (SLA) und eine zweite Leitung eines anderen Anbieters als Reserve.</p>

<h6>Passive Komponenten und Schrank</h6>
<ul>
  <li><strong>Datendosen</strong> am Arbeitsplatz, fest verlegte Kabel (Installationskabel) zum Verteiler.</li>
  <li><strong>Patchpanel</strong>: Dort enden die fest verlegten Kabel; kurze <strong>Patchkabel</strong> verbinden Panel und Switch. So bleibt die Installation unberührt,
    wenn sich die Zuordnung ändert.</li>
  <li><strong>Netzwerkschrank</strong> (19 Zoll): Geräte werden in <strong>Höheneinheiten</strong> gemessen, 1 HE = 1,75 Zoll = 44,45 mm. Ein 42-HE-Schrank bietet
    rund 1,87 m Einbauhöhe. Dazu gehören Lüftung, Kabelführung, Steckdosenleiste und eine USV (Kapitel 9).</li>
  <li><strong>Beschriftung</strong> von Dosen, Panel-Ports und Kabeln – ohne sie wird jede Fehlersuche zur Detektivarbeit.</li>
</ul>

<h6>Übungen mit Lösung</h6>
<p>1. Was unterscheidet Hub, Switch und Router?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Der Hub (Schicht 1) sendet alles an alle Ports. Der Switch (Schicht 2) leitet Frames anhand der MAC-Adresse gezielt an den richtigen Port.
Der Router (Schicht 3) verbindet verschiedene Netze und entscheidet anhand der IP-Adresse.</p>
</details>
<p>2. Ein Büro bekommt 12 PCs, 2 Drucker, 2 WLAN-Access-Points, ein NAS und 8 IP-Telefone. Wie viele Switch-Ports brauchst du mindestens, und worauf achtest du?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">12 + 2 + 2 + 1 + 8 = 25 Endgeräte plus 1 Uplink zum Router = 26 Ports. Ein 24-Port-Switch reicht nicht; also 48 Ports oder zwei Switches, mit Reserve für Wachstum.
Der Switch sollte verwaltet sein (VLANs für Telefone und Gäste) und PoE+ für Access Points und Telefone liefern – das PoE-Budget prüfen (Kapitel 3).</p>
</details>
<p>3. Ein Netzwerkschrank hat 24 HE. Eingebaut werden: 2 Switches (je 1 HE), 2 Patchpanels (je 1 HE), 1 Router (1 HE), 1 USV (2 HE), 1 Server (2 HE),
2 Kabelführungen (je 1 HE). Wie viele HE bleiben frei?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">2 + 2 + 1 + 2 + 2 + 2 = 11 HE belegt, also 13 HE frei.</p>
</details>
INHALT,
    'summary' => [
        'Hub: Schicht 1, alles an alle; Switch: Schicht 2, nach MAC; Router: Schicht 3, nach IP; Access Point: WLAN-Bridge.',
        'Im Unternehmen sind Modem, Router/Firewall, Switch und Access Points getrennte Geräte; Switches sind verwaltet.',
        'Anschlüsse: DSL, Kabel, Glasfaser (ONT), Mobilfunk; wichtig sind auch Upload, feste IP, Entstörzeit und Reserve.',
        'Installationskabel enden im Patchpanel; Patchkabel verbinden zum Switch.',
        '19-Zoll-Schrank, 1 HE = 44,45 mm; alles beschriften.',
    ],
    'quiz' => [
        ['question' => 'Auf welcher OSI-Schicht arbeitet ein Hub?', 'answer' => 'Auf Schicht 1, der Bitübertragungsschicht.'],
        ['question' => 'Wofür dient ein Patchpanel?', 'answer' => 'Dort enden die fest verlegten Kabel; Patchkabel verbinden es flexibel mit dem Switch.'],
        ['question' => 'Wie hoch ist eine Höheneinheit?', 'answer' => '1,75 Zoll = 44,45 mm.'],
        ['question' => 'Was ist ein ONT?', 'answer' => 'Der Glasfaser-Netzabschluss (Optical Network Termination) beim Kunden, quasi das Glasfaser-Modem.'],
    ],
];
