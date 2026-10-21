<?php
return [
    'title' => 'Fachwortschatz der IT',
    'intro' => 'Viele IT-Begriffe benutzt du schon täglich auf Englisch – andere klingen vertraut, bedeuten aber etwas Bestimmtes. Dieses Kapitel sammelt den wichtigsten Wortschatz nach Themen, zeigt typische Verben und die Abkürzungen, die in Chats und Tickets ständig auftauchen.',
    'goals' => [
        'zentrale Fachbegriffe zu Hardware, Netzwerk, Softwareentwicklung, Daten und Sicherheit kennen',
        'typische Verben für IT-Tätigkeiten richtig einsetzen',
        'Wortbildungsregeln nutzen, um Begriffe abzuleiten',
        'gängige Abkürzungen aus E-Mails, Chats und Code-Reviews verstehen',
    ],
    'content' => <<<'INHALT'
<h6>Hardware und Netzwerk</h6>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/englisch/netzwerk-englisch.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Büronetz mit englischen Begriffen und deutscher Übersetzung: Internet, modem, firewall, router, switch und patch panel im server rack, workstation, network printer, file server und access point, verbunden über Ethernet cable; dazu typische Verben">
  <figcaption class="figure-caption">Ein Büronetz auf Englisch</figcaption>
</figure>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th>englisch</th><th>deutsch</th><th>englisch</th><th>deutsch</th></tr></thead>
  <tbody>
    <tr><td>motherboard</td><td>Hauptplatine</td><td>power supply (unit), PSU</td><td>Netzteil</td></tr>
    <tr><td>memory, RAM</td><td>Arbeitsspeicher</td><td>storage, drive</td><td>Massenspeicher, Laufwerk</td></tr>
    <tr><td>graphics card</td><td>Grafikkarte</td><td>port, connector</td><td>Anschluss</td></tr>
    <tr><td>peripheral device</td><td>Peripheriegerät</td><td>uninterruptible power supply, UPS</td><td>USV</td></tr>
    <tr><td>bandwidth</td><td>Bandbreite</td><td>throughput</td><td>Durchsatz</td></tr>
    <tr><td>latency</td><td>Verzögerung, Laufzeit</td><td>subnet mask</td><td>Subnetzmaske</td></tr>
    <tr><td>default gateway</td><td>Standardgateway</td><td>outage</td><td>Ausfall</td></tr>
  </tbody>
</table>

<h6>Softwareentwicklung</h6>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th>englisch</th><th>deutsch</th><th>englisch</th><th>deutsch</th></tr></thead>
  <tbody>
    <tr><td>requirement</td><td>Anforderung</td><td>specification</td><td>Spezifikation, Pflichtenheft</td></tr>
    <tr><td>feature</td><td>Funktion, Merkmal</td><td>bug, defect</td><td>Fehler</td></tr>
    <tr><td>source code</td><td>Quellcode</td><td>to compile</td><td>übersetzen (kompilieren)</td></tr>
    <tr><td>variable, constant</td><td>Variable, Konstante</td><td>loop, condition</td><td>Schleife, Bedingung</td></tr>
    <tr><td>method, function</td><td>Methode, Funktion</td><td>parameter, return value</td><td>Parameter, Rückgabewert</td></tr>
    <tr><td>inheritance</td><td>Vererbung</td><td>interface</td><td>Schnittstelle</td></tr>
    <tr><td>unit test</td><td>Komponententest</td><td>release, deployment</td><td>Veröffentlichung, Auslieferung</td></tr>
    <tr><td>version control</td><td>Versionsverwaltung</td><td>branch, merge</td><td>Zweig, zusammenführen</td></tr>
  </tbody>
</table>

<h6>Daten und Sicherheit</h6>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th>englisch</th><th>deutsch</th><th>englisch</th><th>deutsch</th></tr></thead>
  <tbody>
    <tr><td>database, table, record</td><td>Datenbank, Tabelle, Datensatz</td><td>primary key, foreign key</td><td>Primär-, Fremdschlüssel</td></tr>
    <tr><td>query</td><td>Abfrage</td><td>backup, to restore</td><td>Datensicherung, wiederherstellen</td></tr>
    <tr><td>encryption</td><td>Verschlüsselung</td><td>authentication</td><td>Anmeldung, Echtheitsprüfung</td></tr>
    <tr><td>authorization, permission</td><td>Berechtigung</td><td>vulnerability</td><td>Schwachstelle</td></tr>
    <tr><td>threat</td><td>Bedrohung</td><td>data protection, privacy</td><td>Datenschutz</td></tr>
  </tbody>
</table>

<h6>Typische Verben</h6>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th>Verb</th><th>Bedeutung</th><th>Beispiel</th></tr></thead>
  <tbody>
    <tr><td>to set up</td><td>einrichten</td><td>We set up a new VPN for the branch office.</td></tr>
    <tr><td>to install / to uninstall</td><td>installieren / entfernen</td><td>Please uninstall the old driver first.</td></tr>
    <tr><td>to update / to upgrade</td><td>aktualisieren / auf eine höhere Version bringen</td><td>We upgraded from version 2 to version 3.</td></tr>
    <tr><td>to troubleshoot</td><td>Fehler eingrenzen und beheben</td><td>I am troubleshooting the printer issue.</td></tr>
    <tr><td>to deploy</td><td>ausliefern, in Betrieb nehmen</td><td>The app is deployed every Friday.</td></tr>
    <tr><td>to log in / to log out</td><td>anmelden / abmelden</td><td>Log in with your company account.</td></tr>
    <tr><td>to shut down / to restart / to boot</td><td>herunterfahren / neu starten / hochfahren</td><td>Restart the server after the update.</td></tr>
  </tbody>
</table>
<p>Achtung bei Nomen und Verb: <em>login</em> und <em>setup</em> sind Nomen (das Login, die Einrichtung), <em>to log in</em> und <em>to set up</em> die Verben – „Please log in“, nicht „Please login“.</p>

<h6>Wortbildung</h6>
<ul>
  <li><strong>-er / -or</strong> macht aus Verben Geräte oder Personen: <em>to print → printer, to route → router, to edit → editor</em>.</li>
  <li><strong>-tion / -ment / -ity</strong> bilden Nomen: <em>to configure → configuration, to deploy → deployment, available → availability</em>.</li>
  <li><strong>-able / -ible</strong> bilden Adjektive: <em>to scale → scalable</em> (skalierbar), <em>to access → accessible</em> (zugänglich, auch: barrierefrei).</li>
  <li><strong>Komposita</strong> stehen im Englischen meist getrennt: <em>password policy</em> (Passwortrichtlinie), <em>user interface</em> (Benutzeroberfläche).</li>
</ul>

<h6>Abkürzungen in Chats, Tickets und Reviews</h6>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th>Abkürzung</th><th>steht für</th><th>Bedeutung</th></tr></thead>
  <tbody>
    <tr><td>ASAP</td><td>as soon as possible</td><td>so bald wie möglich</td></tr>
    <tr><td>FYI</td><td>for your information</td><td>zur Information</td></tr>
    <tr><td>ETA</td><td>estimated time of arrival</td><td>voraussichtlich fertig bzw. da um</td></tr>
    <tr><td>EOD</td><td>end of day</td><td>bis Feierabend</td></tr>
    <tr><td>TBD</td><td>to be determined</td><td>noch festzulegen</td></tr>
    <tr><td>WIP</td><td>work in progress</td><td>in Arbeit</td></tr>
    <tr><td>LGTM</td><td>looks good to me</td><td>passt, Freigabe im Code-Review</td></tr>
    <tr><td>PR</td><td>pull request</td><td>Änderungsvorschlag zum Zusammenführen</td></tr>
    <tr><td>RTFM</td><td>read the … manual</td><td>unhöflich – in Kundenkontakt nie verwenden</td></tr>
  </tbody>
</table>
<p class="lf-merke"><strong>Merke:</strong> Verben mit Partikel werden getrennt geschrieben (<em>to set up, to log in, to shut down</em>), die Nomen zusammen (<em>the setup, the login, the shutdown</em>).</p>

<h6>Übungen mit Lösung</h6>
<p>1. Übersetze: „Vor dem Upgrade bitte eine Datensicherung erstellen und die Berechtigungen prüfen.“</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">„Before the upgrade, please create a backup and check the permissions.“</p>
</details>
<p>2. Setze ein: <em>log in / login</em> – „Your ___ has expired. Please ___ again.“</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">„Your login has expired. Please log in again.“ – Nomen zusammen, Verb getrennt.</p>
</details>
<p>3. Ein Kollege schreibt im Chat: „FYI: deployment TBD, ETA for the fix is EOD.“ Was bedeutet das?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Zur Information: Der Termin für die Auslieferung steht noch nicht fest; die Fehlerbehebung soll bis Feierabend fertig sein.</p>
</details>
INHALT,
    'summary' => [
        'Wortschatz nach Themen lernen: Hardware, Netzwerk, Softwareentwicklung, Daten, Sicherheit.',
        'Typische Verben: to set up, to troubleshoot, to deploy, to upgrade, to restore, to log in.',
        'Verben mit Partikel getrennt (to log in), Nomen zusammen (the login).',
        'Wortbildung: -er/-or für Geräte und Personen, -tion/-ment/-ity für Nomen, -able für Adjektive.',
        'Abkürzungen: ASAP, FYI, ETA, EOD, TBD, WIP, LGTM, PR.',
    ],
    'quiz' => [
        ['question' => 'Was bedeutet „vulnerability“?', 'answer' => 'Schwachstelle.'],
        ['question' => 'Was ist der Unterschied zwischen „to update“ und „to upgrade“?', 'answer' => 'Update = aktualisieren (z. B. Patch), Upgrade = auf eine höhere Version oder Ausstattung wechseln.'],
        ['question' => 'Was bedeutet „LGTM“ im Code-Review?', 'answer' => '„Looks good to me“ – die Änderung ist aus Sicht des Reviewers in Ordnung.'],
        ['question' => 'Wie heißt „Datensicherung wiederherstellen“?', 'answer' => 'to restore a backup.'],
    ],
];
