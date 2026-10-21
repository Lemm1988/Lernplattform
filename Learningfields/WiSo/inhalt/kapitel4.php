<?php
return [
    'title' => 'Mitbestimmung im Betrieb und im Unternehmen',
    'intro' => 'Eine neue Zeiterfassung, ein Ticketsystem mit Auswertungen, Microsoft 365 für alle: Bei vielen IT-Projekten muss der Betriebsrat zustimmen. Wer das weiß, plant ihn von Anfang an ein – und vermeidet Projekte, die kurz vor dem Start gestoppt werden.',
    'goals' => [
        'Voraussetzungen, Wahl und Größe eines Betriebsrats kennen',
        'die Stufen der Beteiligung des Betriebsrats unterscheiden',
        'erkennen, wann IT-Projekte mitbestimmungspflichtig sind',
        'Aufgaben und Voraussetzungen der Jugend- und Auszubildendenvertretung nennen',
        'Betriebsvereinbarung und Unternehmensmitbestimmung einordnen',
    ],
    'content' => <<<'INHALT'
<h6>Der Betriebsrat</h6>
<p>Das <strong>Betriebsverfassungsgesetz</strong> (BetrVG) regelt die Mitbestimmung im Betrieb. Ein Betriebsrat kann gewählt werden, wenn ein Betrieb mindestens <strong>fünf ständige wahlberechtigte Beschäftigte</strong> hat, von denen drei wählbar sind. Der Arbeitgeber muss die Wahl dulden, aber nicht anstoßen – die Initiative geht von den Beschäftigten oder der Gewerkschaft aus.</p>
<ul>
  <li><strong>Wahlberechtigt</strong> sind alle Beschäftigten ab 16 Jahren, auch Auszubildende. <strong>Wählbar</strong> ist, wer mindestens 18 Jahre alt und seit sechs Monaten im Betrieb ist.</li>
  <li><strong>Amtszeit</strong>: vier Jahre. Die regelmäßigen Wahlen finden bundesweit zwischen 1. März und 31. Mai statt (2026, 2030 …).</li>
  <li>Die Arbeit des Betriebsrats findet in der Arbeitszeit statt, die Kosten trägt der Arbeitgeber. Ab 200 Beschäftigten wird mindestens ein Mitglied ganz von der Arbeit freigestellt.</li>
  <li>Mindestens einmal im Kalendervierteljahr lädt der Betriebsrat zur <strong>Betriebsversammlung</strong> ein und berichtet über seine Arbeit.</li>
</ul>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th>wahlberechtigte Beschäftigte</th><th>5–20</th><th>21–50</th><th>51–100</th><th>101–200</th><th>201–400</th></tr></thead>
  <tbody><tr><td>Mitglieder des Betriebsrats</td><td>1</td><td>3</td><td>5</td><td>7</td><td>9</td></tr></tbody>
</table>

<h6>Wie stark sind die Rechte?</h6>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/wiso/mitbestimmung-stufen.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Sechs Stufen von schwach nach stark: Information, Anhörung, Beratung, Widerspruch, Zustimmungsverweigerung, Mitbestimmung, jeweils mit Beispielen und Paragrafen des BetrVG">
  <figcaption class="figure-caption">Von der Information bis zur echten Mitbestimmung</figcaption>
</figure>
<ul>
  <li><strong>Mitwirkung</strong> (Information, Anhörung, Beratung, Widerspruch): Der Betriebsrat wird beteiligt, der Arbeitgeber entscheidet am Ende aber allein. Eine Kündigung ohne vorherige <em>Anhörung</em> ist trotzdem unwirksam.</li>
  <li><strong>Zustimmungsverweigerung</strong> bei personellen Einzelmaßnahmen (Einstellung, Eingruppierung, Versetzung) in Unternehmen mit mehr als 20 Beschäftigten: Verweigert der Betriebsrat aus einem gesetzlichen Grund, muss der Arbeitgeber die Zustimmung vom Arbeitsgericht ersetzen lassen.</li>
  <li><strong>Echte Mitbestimmung</strong> in sozialen Angelegenheiten (§ 87): Ohne Einigung darf der Arbeitgeber nicht handeln; im Streit entscheidet die <strong>Einigungsstelle</strong> verbindlich.</li>
</ul>

<h6>Mitbestimmung bei IT-Projekten</h6>
<p>Nach § 87 Abs. 1 Nr. 6 BetrVG bestimmt der Betriebsrat mit bei der „Einführung und Anwendung von technischen Einrichtungen, die dazu bestimmt sind, das Verhalten oder die Leistung der Arbeitnehmer zu überwachen“. Die Rechtsprechung lässt genügen, dass eine Software dazu <em>geeignet</em> ist – auch wenn niemand die Auswertung plant.</p>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th>Beispiel</th><th>warum mitbestimmungspflichtig?</th></tr></thead>
  <tbody>
    <tr><td>Ticketsystem mit Bearbeitungszeiten je Person</td><td>Leistung einzelner Beschäftigter wird messbar</td></tr>
    <tr><td>elektronische Zeiterfassung</td><td>Arbeitszeit und Anwesenheit werden protokolliert; zusätzlich betrifft sie die Lage der Arbeitszeit</td></tr>
    <tr><td>Office-Suite mit Aktivitätsberichten, Videokonferenzen mit Teilnahmeprotokollen</td><td>Nutzungs- und Anwesenheitsdaten fallen an</td></tr>
    <tr><td>GPS-Ortung von Dienstfahrzeugen, Videoüberwachung</td><td>Verhalten wird aufgezeichnet</td></tr>
  </tbody>
</table>
<p>Ergebnis der Verhandlung ist meist eine <strong>Betriebsvereinbarung</strong>: Welche Daten werden erhoben, wer darf sie auswerten, wie lange werden sie gespeichert, keine Leistungskontrolle einzelner Personen. Sie wirkt unmittelbar und zwingend für alle Beschäftigten des Betriebs. Was üblicherweise ein Tarifvertrag regelt – vor allem die Höhe der Entgelte – darf eine Betriebsvereinbarung nicht regeln (Tarifvorrang).</p>
<p class="lf-pruefung"><strong>Prüfungstipp:</strong> Auch in der Projektdokumentation zur Abschlussprüfung lohnt ein Satz zum Betriebsrat, wenn eine Anwendung Personendaten verarbeitet – zusammen mit dem Datenschutz (<a href="/Learningfields/LF4/kapitel8.php">LF4 Kapitel 8</a>).</p>

<h6>Jugend- und Auszubildendenvertretung</h6>
<ul>
  <li>Gewählt in Betrieben mit Betriebsrat und mindestens <strong>fünf Beschäftigten unter 18 Jahren oder Auszubildenden unter 25 Jahren</strong>.</li>
  <li>Wählen dürfen genau diese Gruppen; wählbar sind alle Beschäftigten unter 25 Jahren. Amtszeit: zwei Jahre.</li>
  <li>Die JAV vertritt die Interessen der jungen Beschäftigten <em>gegenüber dem Betriebsrat</em> – nicht direkt gegenüber dem Arbeitgeber. Sie kann an Betriebsratssitzungen teilnehmen und hat dort bei Themen, die überwiegend junge Beschäftigte betreffen, Stimmrecht.</li>
</ul>

<h6>Rechte jedes einzelnen Beschäftigten</h6>
<p>Auch ohne Betriebsrat gilt: Unterrichtung über Aufgaben und Veränderungen am Arbeitsplatz, Anhörung in betrieblichen Angelegenheiten, die einen selbst betreffen, Einsicht in die eigene Personalakte und ein Beschwerderecht (§§ 81–84 BetrVG).</p>

<h6>Mitbestimmung im Unternehmen</h6>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th>Gesetz</th><th>gilt für</th><th>Arbeitnehmervertreter im Aufsichtsrat</th></tr></thead>
  <tbody>
    <tr><td>Drittelbeteiligungsgesetz</td><td>Kapitalgesellschaften (z. B. AG, GmbH) mit mehr als 500 Beschäftigten</td><td>ein Drittel der Sitze</td></tr>
    <tr><td>Mitbestimmungsgesetz</td><td>Kapitalgesellschaften mit mehr als 2000 Beschäftigten</td><td>die Hälfte der Sitze; bei Stimmengleichheit entscheidet die doppelte Stimme der oder des Vorsitzenden (Anteilseignerseite)</td></tr>
    <tr><td>Montan-Mitbestimmungsgesetz</td><td>Bergbau und Stahl mit mehr als 1000 Beschäftigten</td><td>volle Parität mit einem neutralen Mitglied</td></tr>
  </tbody>
</table>
<p>Im öffentlichen Dienst übernehmen <strong>Personalräte</strong> die Rolle des Betriebsrats; leitende Angestellte haben einen eigenen <strong>Sprecherausschuss</strong>.</p>

<h6>Übungen mit Lösung</h6>
<p>1. Ein IT-Dienstleister mit 80 wahlberechtigten Beschäftigten wählt erstmals einen Betriebsrat. Wie viele Mitglieder hat er? Wird jemand freigestellt?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Fünf Mitglieder (51–100 Beschäftigte). Eine vollständige Freistellung gibt es erst ab 200 Beschäftigten; die Betriebsratsarbeit findet trotzdem in der bezahlten Arbeitszeit statt.</p>
</details>
<p>2. Die Geschäftsleitung führt ein Ticketsystem ein, das pro Mitarbeiter anzeigt, wie viele Tickets in welcher Zeit gelöst wurden. Der Betriebsrat wurde nicht gefragt. Was gilt?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Die Einführung ist mitbestimmungspflichtig (§ 87 Abs. 1 Nr. 6 BetrVG), weil das System geeignet ist, die Leistung zu überwachen. Der Betriebsrat kann verlangen, dass die Nutzung unterbleibt, bis eine Einigung – meist eine Betriebsvereinbarung – vorliegt.</p>
</details>
<p>3. Ein Betrieb hat 40 Beschäftigte, darunter vier Auszubildende (19, 20, 22 und 26 Jahre alt), aber keine Beschäftigten unter 18. Kann eine JAV gewählt werden?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Nein. Nur drei Auszubildende sind unter 25 Jahre alt; nötig wären mindestens fünf Beschäftigte unter 18 oder Auszubildende unter 25 – und außerdem ein Betriebsrat.</p>
</details>
<p>4. Welche Maßnahme kann der Betriebsrat nur verzögern, aber nicht endgültig verhindern: (a) die Lage der täglichen Arbeitszeit, (b) eine Kündigung, (c) die Einführung einer Videoüberwachung?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">(b) Bei der Kündigung hat der Betriebsrat nur ein Anhörungs- und Widerspruchsrecht; der Arbeitgeber kann trotz Widerspruch kündigen (der Widerspruch stärkt aber die Position der gekündigten Person, etwa beim Anspruch auf Weiterbeschäftigung). (a) und (c) unterliegen der echten Mitbestimmung.</p>
</details>
INHALT,
    'summary' => [
        'Betriebsrat ab fünf ständigen wahlberechtigten Beschäftigten; Wahl ab 16, wählbar ab 18 und sechs Monaten Betriebszugehörigkeit; Amtszeit vier Jahre.',
        'Beteiligungsstufen: Information, Anhörung, Beratung, Widerspruch, Zustimmungsverweigerung, echte Mitbestimmung.',
        'IT-Systeme, die Verhalten oder Leistung überwachen können, sind mitbestimmungspflichtig (§ 87 Abs. 1 Nr. 6 BetrVG) – Ergebnis meist eine Betriebsvereinbarung.',
        'JAV: in Betrieben mit Betriebsrat und mindestens fünf Beschäftigten unter 18 oder Azubis unter 25; Amtszeit zwei Jahre.',
        'Unternehmensmitbestimmung: Drittelbeteiligung ab 500, paritätisch ab 2000 Beschäftigten (Kapitalgesellschaften).',
    ],
    'quiz' => [
        ['question' => 'Ab wie vielen Beschäftigten kann ein Betriebsrat gewählt werden?', 'answer' => 'Ab mindestens fünf ständigen wahlberechtigten Beschäftigten, von denen drei wählbar sind.'],
        ['question' => 'Warum ist die Einführung einer Zeiterfassungssoftware mitbestimmungspflichtig?', 'answer' => 'Sie ist geeignet, Verhalten oder Leistung der Beschäftigten zu überwachen (§ 87 Abs. 1 Nr. 6 BetrVG).'],
        ['question' => 'Wie lange ist die Amtszeit einer Jugend- und Auszubildendenvertretung?', 'answer' => 'Zwei Jahre.'],
        ['question' => 'Wer entscheidet bei echter Mitbestimmung, wenn sich Arbeitgeber und Betriebsrat nicht einigen?', 'answer' => 'Die Einigungsstelle.'],
    ],
];
