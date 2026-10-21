<?php
return [
    'title' => 'Fehler systematisch analysieren, Fernwartung',
    'intro' => 'Raten kostet Zeit und erzeugt neue Fehler. Mit einem festen Vorgehen, den richtigen Werkzeugen und Methoden der Ursachenanalyse wird Fehlersuche planbar – vor Ort wie per Fernwartung.',
    'goals' => [
        'Fehler in festen Schritten analysieren und eingrenzen',
        'Diagnosewerkzeuge unter Windows gezielt einsetzen',
        'Ursachen mit der 5-Why-Methode und dem Ishikawa-Diagramm finden',
        'Fernwartung datenschutzgerecht und sicher durchführen',
    ],
    'content' => <<<'INHALT'
<h6>Vorgehen</h6>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf6/fehleranalyse.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Sieben Schritte: Informationen sammeln, reproduzieren, eingrenzen, Hypothese testen, Lösung umsetzen, Ergebnis prüfen, dokumentieren; Rücksprung bei nicht gelöst">
  <figcaption class="figure-caption">Erst verstehen, dann ändern</figcaption>
</figure>
<p>Bewährte Strategien zum <strong>Eingrenzen</strong>:</p>
<ul>
  <li><strong>Vergleichen</strong>: Funktioniert es bei Kollegen, an einem anderen PC, mit einem anderen Benutzer? Was ist anders?</li>
  <li><strong>Schicht für Schicht</strong> von unten nach oben (wie beim OSI-Modell, <a href="/Learningfields/LF9/kapitel1.php">LF9 Kapitel 1</a>): Strom und Kabel → Netzwerkverbindung → IP-Adresse → Namensauflösung → Dienst → Anwendung.</li>
  <li><strong>Halbieren</strong>: Bei langen Ketten in der Mitte prüfen und dann nur noch in der fehlerhaften Hälfte weitersuchen.</li>
  <li><strong>Letzte Änderung</strong>: „Seit wann?“ führt oft direkt zum Update, zum neuen Gerät oder zur geänderten Einstellung.</li>
</ul>

<h6>Werkzeuge unter Windows</h6>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th>Werkzeug</th><th>wofür</th></tr></thead>
  <tbody>
    <tr><td>Ereignisanzeige (<code>eventvwr.msc</code>)</td><td>Fehler und Warnungen von System und Anwendungen mit Zeitstempel</td></tr>
    <tr><td>Zuverlässigkeitsverlauf</td><td>Abstürze, Updates und Installationen auf einer Zeitachse – ideal für „Seit wann?“</td></tr>
    <tr><td>Task-Manager / Ressourcenmonitor</td><td>Auslastung von CPU, RAM, Datenträger und Netz, hängende Prozesse</td></tr>
    <tr><td>Geräte-Manager</td><td>Treiberprobleme, nicht erkannte Hardware</td></tr>
    <tr><td><code>ipconfig /all</code>, <code>ping</code>, <code>tracert</code>, <code>nslookup</code></td><td>Netzwerkkonfiguration, Erreichbarkeit, Weg, Namensauflösung (<a href="/Learningfields/LF9/kapitel7.php">LF9 Kapitel 7</a>)</td></tr>
    <tr><td><code>sfc /scannow</code></td><td>beschädigte Systemdateien prüfen und reparieren</td></tr>
  </tbody>
</table>

<h6>Ursachen finden</h6>
<p>Die <strong>5-Why-Methode</strong> fragt so lange „Warum?“, bis die eigentliche Ursache sichtbar wird – meist ein fehlender Prozess, nicht ein einzelner Mensch:</p>
<ol>
  <li>Der Webshop war zwei Stunden nicht erreichbar. – Warum? <em>Die Festplatte des Servers war voll.</em></li>
  <li>Warum? <em>Die Logdateien sind unbegrenzt gewachsen.</em></li>
  <li>Warum? <em>Es war keine Logrotation eingerichtet.</em></li>
  <li>Warum? <em>Bei der Installation wurde sie vergessen.</em></li>
  <li>Warum? <em>Es gibt keine Checkliste für Serverinstallationen.</em> → Maßnahme: Checkliste mit Logrotation und Überwachung des Speicherplatzes.</li>
</ol>
<p>Das <strong>Ishikawa-Diagramm</strong> (Fischgräten- oder Ursache-Wirkungs-Diagramm) sammelt mögliche Ursachen geordnet nach Kategorien – gut für die Arbeit im Team:</p>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf6/ishikawa.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Fischgrätendiagramm mit der Wirkung Druckaufträge gehen verloren und den Kategorien Mensch, Methode, Software, Hardware, Umgebung und Netz, Management">
  <figcaption class="figure-caption">Erst breit sammeln, dann gezielt prüfen</figcaption>
</figure>

<h6>Fernwartung</h6>
<p>Mit Fernwartungswerkzeugen (Windows-Remotehilfe/Remotedesktop oder kommerzielle Tools) sieht und bedient der Support den Bildschirm des Anwenders.
Das spart Wege – berührt aber Datenschutz und Sicherheit:</p>
<ul>
  <li>Verbindung nur mit <strong>ausdrücklicher Zustimmung</strong> des Anwenders, der die Sitzung sieht und jederzeit beenden kann.</li>
  <li>Anwender vorher bitten, vertrauliche Fenster (Mails, Personaldaten) zu schließen; keine Daten kopieren, die nicht für die Lösung nötig sind.</li>
  <li>Sitzung im Ticket <strong>protokollieren</strong> (wer, wann, was getan) und danach vollständig trennen; keine dauerhaften Zugänge ohne Vereinbarung.</li>
  <li>Kann ein externer Dienstleister dabei personenbezogene Daten sehen, braucht es einen <strong>Auftragsverarbeitungsvertrag</strong> (Art. 28 DSGVO, <a href="/Learningfields/LF4/kapitel8.php">LF4 Kapitel 8</a>).</li>
  <li>Fernwartungszugänge mit MFA absichern und Tools aktuell halten – sie sind ein beliebtes Einfallstor.</li>
</ul>
<div class="lf-merke"><strong>Merke:</strong> Betrüger geben sich am Telefon als „Microsoft-Support“ oder „IT-Abteilung“ aus und bitten, ein Fernwartungsprogramm zu installieren.
Echter Support ruft nicht unaufgefordert an und fragt nie nach Passwörtern. Im Zweifel auflegen und über die bekannte Nummer zurückrufen.</div>

<h6>Übungen mit Lösung</h6>
<p>1. Eine Anwenderin erreicht keine Websites, kann aber Dateien auf dem Fileserver öffnen. <code>ping 8.8.8.8</code> klappt, <code>ping www.example.org</code> nicht. Wo liegt der Fehler wahrscheinlich?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Netzwerk und IP-Routing funktionieren (Fileserver und 8.8.8.8 erreichbar), die Namensauflösung nicht: falsch eingetragener oder nicht erreichbarer DNS-Server.
Prüfen mit <code>ipconfig /all</code> und <code>nslookup</code>.</p>
</details>
<p>2. Ein Kollege hat beim Fehlersuchen gleichzeitig Treiber aktualisiert, die Firewall abgeschaltet und den Drucker neu installiert – jetzt geht es. Was ist das Problem?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Niemand weiß, welche Änderung geholfen hat. Die abgeschaltete Firewall ist zudem ein Sicherheitsrisiko. Richtig: eine Änderung pro Test,
Wirkungsloses zurücknehmen, Firewall wieder einschalten und die tatsächliche Ursache dokumentieren.</p>
</details>
<p>3. Nenne drei Regeln für eine datenschutzgerechte Fernwartungssitzung.</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Zum Beispiel: nur mit Zustimmung und unter Aufsicht des Anwenders; vertrauliche Fenster vorher schließen lassen; Sitzung protokollieren und danach trennen;
bei externen Dienstleistern AVV abschließen.</p>
</details>
INHALT,
    'summary' => [
        'Vorgehen: Infos sammeln, reproduzieren, eingrenzen, Hypothese testen, lösen, prüfen, dokumentieren.',
        'Eingrenzen durch Vergleichen, Schicht für Schicht, Halbieren und die Frage nach der letzten Änderung.',
        'Immer nur eine Änderung gleichzeitig; Wirkungsloses zurücknehmen.',
        'Ursachenanalyse: 5-Why bis zur Prozessursache, Ishikawa-Diagramm für die Sammlung im Team.',
        'Fernwartung nur mit Zustimmung, unter Aufsicht, protokolliert; bei Dienstleistern AVV.',
    ],
    'quiz' => [
        ['question' => 'Warum soll man bei der Fehlersuche nur eine Änderung gleichzeitig vornehmen?', 'answer' => 'Sonst weiß man nicht, welche Änderung gewirkt hat – oder welche neue Fehler verursacht.'],
        ['question' => 'Was ist die 5-Why-Methode?', 'answer' => 'Man fragt wiederholt „Warum?“, bis die eigentliche Ursache eines Problems sichtbar wird.'],
        ['question' => 'Wofür nutzt man ein Ishikawa-Diagramm?', 'answer' => 'Um mögliche Ursachen einer Wirkung nach Kategorien geordnet zu sammeln.'],
        ['question' => 'Was ist vor einer Fernwartungssitzung nötig?', 'answer' => 'Die ausdrückliche Zustimmung des Anwenders; bei externen Dienstleistern zudem ein Auftragsverarbeitungsvertrag.'],
    ],
];
