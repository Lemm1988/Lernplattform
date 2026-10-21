<?php
return [
    'title' => 'Incident, Service Request, Problem und Change',
    'intro' => 'Ob etwas eine Störung, ein Wunsch, ein wiederkehrendes Problem oder eine geplante Änderung ist, entscheidet darüber, wie es bearbeitet wird. Die vier Begriffe sauber zu trennen, ist Grundlage jeder Serviceprüfung.',
    'goals' => [
        'Incidents, Service Requests, Problems und Changes unterscheiden',
        'Workaround, Known Error und Major Incident erklären',
        'den Zusammenhang zwischen Incident, Problem und Change an einem Beispiel zeigen',
        'Arten von Changes und ihre Genehmigung beschreiben',
        'den Nutzen einer CMDB für die Auswirkungsanalyse nennen',
    ],
    'content' => <<<'INHALT'
<h6>Die vier Begriffe</h6>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th>Begriff</th><th>Bedeutung</th><th>Ziel</th><th>Beispiel</th></tr></thead>
  <tbody>
    <tr><td><strong>Incident</strong> (Störung)</td><td>ungeplante Unterbrechung oder Qualitätsminderung eines Services</td><td>Service so schnell wie möglich wiederherstellen</td><td>„Ich komme nicht ins ERP-System.“</td></tr>
    <tr><td><strong>Service Request</strong> (Serviceanfrage)</td><td>Wunsch nach einer Standardleistung, keine Störung</td><td>zügig nach festem Ablauf erfüllen</td><td>neues Passwort, Software installieren, Zugriffsrecht, Auskunft</td></tr>
    <tr><td><strong>Problem</strong></td><td>(noch) unbekannte Ursache eines oder mehrerer Incidents</td><td>Ursache finden und dauerhaft beseitigen</td><td>„Warum stürzt das ERP-System jeden Montag ab?“</td></tr>
    <tr><td><strong>Change</strong></td><td>Hinzufügen, Ändern oder Entfernen von etwas, das Services beeinflussen kann</td><td>Änderungen kontrolliert und mit geringem Risiko durchführen</td><td>Firmware-Update, neuer Server, geänderte Firewall-Regel</td></tr>
  </tbody>
</table>
<div class="lf-merke"><strong>Merke:</strong> Beim Incident zählt die <em>Geschwindigkeit</em> – ein Workaround ist erlaubt. Beim Problem zählt die <em>Ursache</em>.
Ein Service Request ist <em>planbar</em> und hat oft eine Genehmigungsstufe (z. B. Vorgesetzte bestätigen ein neues Zugriffsrecht).</div>

<h6>Vom Incident zum Change</h6>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf6/incident-problem-change.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="40 VPN-Störungen mit Workaround führen zu einem Problem, daraus wird ein Known Error mit bekannter Ursache und ein Change mit Firmware-Update">
  <figcaption class="figure-caption">Incident Management löscht den Brand, Problem Management sucht den Brandherd</figcaption>
</figure>
<ul>
  <li><strong>Workaround</strong>: vorläufige Umgehung, die Anwender wieder arbeitsfähig macht, ohne die Ursache zu beseitigen.</li>
  <li><strong>Known Error</strong> (bekannter Fehler): Problem mit bekannter Ursache, meist mit dokumentiertem Workaround. Gesammelt in einer Known Error Database, damit der 1st Level gleich richtig reagiert.</li>
  <li><strong>Proaktives Problem Management</strong> sucht Muster, bevor viele Anwender betroffen sind – etwa in Logs, Monitoring oder Ticketstatistiken.</li>
  <li><strong>Major Incident</strong>: Störung mit sehr großer Auswirkung, z. B. das ganze Unternehmen ohne E-Mail. Dafür gibt es ein eigenes Verfahren mit eigenem Team,
    festen Kommunikationsintervallen und einer Nachbesprechung.</li>
</ul>

<h6>Changes</h6>
<p>Viele Störungen entstehen durch Änderungen. Deshalb werden Changes mit einem <strong>Request for Change</strong> (RfC) beantragt, bewertet (Nutzen, Risiko, Auswirkung,
Ressourcen, Zeitpunkt), genehmigt, getestet, umgesetzt und überprüft. Zu jedem Change gehört ein <strong>Rollback-Plan</strong>: der Weg zurück, falls etwas schiefgeht.</p>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th>Art</th><th>Merkmal</th><th>Beispiel</th></tr></thead>
  <tbody>
    <tr><td>Standard-Change</td><td>risikoarm, erprobt, vorab genehmigt – läuft wie ein Service Request</td><td>Arbeitsplatz-PC nach Vorlage einrichten</td></tr>
    <tr><td>Normal-Change</td><td>wird einzeln bewertet und von der zuständigen Stelle genehmigt, bei großen Changes z. B. ein Change Advisory Board (CAB)</td><td>Migration des Mailservers</td></tr>
    <tr><td>Emergency-Change</td><td>muss sofort umgesetzt werden; verkürzte Genehmigung, Dokumentation wird nachgeholt</td><td>Sicherheitsupdate für eine aktiv ausgenutzte Lücke</td></tr>
  </tbody>
</table>

<h6>Die CMDB</h6>
<p>Eine <strong>Configuration Management Database</strong> enthält die <em>Configuration Items</em> (CIs) – Server, Anwendungen, Netzkomponenten, Verträge – und ihre Beziehungen:
„Die Warenwirtschaft läuft auf VM-07, VM-07 läuft auf Host-02, Host-02 hängt an Switch-Core-1.“ Damit lässt sich schnell beantworten, welche Services von einer Störung
oder einem geplanten Change betroffen sind.</p>

<h6>Übungen mit Lösung</h6>
<p>1. Ordne zu: (a) Eine neue Kollegin braucht einen Laptop und ein Konto. (b) Das ERP-System ist für alle extrem langsam. (c) Der Drucker im 2. OG fällt seit Wochen
jeden Dienstag aus, die Ursache kennt niemand. (d) Am Wochenende wird der Mailserver aktualisiert.</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">(a) Service Request. (b) Incident – bei so großer Auswirkung ein Major Incident. (c) Problem. (d) Change (Normal-Change).</p>
</details>
<p>2. Der 1st Level löst jeden Montag dieselbe Störung mit einem Neustart des Dienstes. Was sollte zusätzlich passieren?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Ein Problem anlegen und die Incidents verknüpfen. Problem Management sucht die Ursache; bis dahin wird der Neustart als Workaround (Known Error) dokumentiert.
Die dauerhafte Lösung wird dann als Change umgesetzt.</p>
</details>
<p>3. Warum braucht auch ein kleiner Change einen Rollback-Plan?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Auch scheinbar kleine Änderungen können unerwartete Nebenwirkungen haben. Mit Rollback-Plan lässt sich der alte Zustand schnell wiederherstellen,
statt unter Zeitdruck nach einer Lösung zu suchen.</p>
</details>
INHALT,
    'summary' => [
        'Incident: Störung, schnell wiederherstellen. Service Request: Standardwunsch, nach Ablauf erfüllen.',
        'Problem: unbekannte Ursache von Incidents; mit bekannter Ursache wird es zum Known Error.',
        'Workaround überbrückt, Change beseitigt die Ursache dauerhaft.',
        'Changes: Standard (vorab genehmigt), Normal (einzeln bewertet, ggf. CAB), Emergency (sofort); immer mit Rollback-Plan.',
        'Die CMDB zeigt Abhängigkeiten zwischen CIs und hilft, Auswirkungen abzuschätzen.',
    ],
    'quiz' => [
        ['question' => 'Was ist ein Incident?', 'answer' => 'Eine ungeplante Unterbrechung oder Qualitätsminderung eines IT-Services.'],
        ['question' => 'Was ist ein Known Error?', 'answer' => 'Ein Problem, dessen Ursache bekannt ist, meist mit dokumentiertem Workaround.'],
        ['question' => 'Was ist ein Standard-Change?', 'answer' => 'Eine risikoarme, erprobte Änderung, die vorab genehmigt ist.'],
        ['question' => 'Wozu dient eine CMDB?', 'answer' => 'Sie verwaltet Configuration Items und ihre Beziehungen, um Auswirkungen von Störungen und Änderungen zu erkennen.'],
    ],
];
