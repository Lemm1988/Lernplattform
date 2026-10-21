<?php
return [
    'title' => 'Datenblätter, Handbücher und Fehlermeldungen lesen',
    'intro' => 'Ob ein Gerät die Anforderungen erfüllt, steht meist in einem englischen Datenblatt; wie man es einrichtet, in einem englischen Handbuch; und was schiefging, in einer englischen Fehlermeldung. Wer die typischen Muster dieser Textsorten kennt, findet die entscheidende Information in Sekunden.',
    'goals' => [
        'den Aufbau eines englischen Datenblatts kennen und gezielt Werte entnehmen',
        'Verbindlichkeitsstufen wie must, should und may richtig deuten',
        'Zahlen, Einheiten, Datums- und Zeitangaben korrekt übertragen',
        'Anleitungen im Imperativ verstehen',
        'häufige Fehlermeldungen übersetzen und einordnen',
    ],
    'content' => <<<'INHALT'
<h6>Aufbau eines Datenblatts</h6>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/englisch/datenblatt-englisch.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Ausgedachtes Datenblatt eines Netzwerkspeichers mit Overview, Specifications, Requirements und Warranty; daneben Lesehilfen zu Dezimalpunkt, expandable, GbE, idle, must, should, limited und excluding">
  <figcaption class="figure-caption">Ein (ausgedachtes) Datenblatt mit Lesehilfen</figcaption>
</figure>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th>Abschnitt</th><th>enthält</th></tr></thead>
  <tbody>
    <tr><td>Overview / Key features</td><td>Kurzbeschreibung und Werbeaussagen – für die Bewertung meist unwichtig</td></tr>
    <tr><td>Specifications / Technical data</td><td>harte Fakten: Leistung, Kapazität, Anschlüsse, Maße, Gewicht, Leistungsaufnahme</td></tr>
    <tr><td>System requirements / Compatibility</td><td>was vorhanden sein muss (Betriebssystem, Prozessor, Speicher)</td></tr>
    <tr><td>Operating conditions</td><td>Temperatur, Luftfeuchtigkeit (<em>humidity</em>, <em>non-condensing</em> = nicht kondensierend)</td></tr>
    <tr><td>Warranty / Support</td><td>Garantiedauer und Ausnahmen (<em>excluding</em>, <em>limited</em>)</td></tr>
  </tbody>
</table>

<h6>Wie verbindlich ist eine Aussage?</h6>
<p>Technische Texte unterscheiden klar zwischen Pflicht und Empfehlung. In Standards (z. B. Internet-Protokollen) ist die Bedeutung sogar festgelegt (RFC 2119):</p>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th>Wort</th><th>Bedeutung</th></tr></thead>
  <tbody>
    <tr><td><strong>must</strong>, shall, required</td><td>zwingend – ohne das funktioniert es nicht oder ist nicht zulässig</td></tr>
    <tr><td><strong>must not</strong>, shall not</td><td>verboten – <em>darf nicht</em></td></tr>
    <tr><td><strong>should</strong>, recommended</td><td>dringend empfohlen; Abweichen nur mit gutem Grund</td></tr>
    <tr><td><strong>should not</strong></td><td>nicht empfohlen</td></tr>
    <tr><td><strong>may</strong>, optional</td><td>erlaubt, freiwillig</td></tr>
  </tbody>
</table>
<p class="lf-merke"><strong>Merke:</strong> <em>must not</em> heißt „darf nicht“, <em>don't have to</em> / <em>need not</em> heißt „muss nicht“. „You must not open the case“ verbietet das Öffnen; „You don't have to open the case“ sagt nur, dass es nicht nötig ist.</p>

<h6>Zahlen, Einheiten, Datum und Uhrzeit</h6>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th>englisch</th><th>deutsch</th><th>Hinweis</th></tr></thead>
  <tbody>
    <tr><td>2.5 GHz</td><td>2,5 GHz</td><td>Punkt als Dezimaltrennzeichen</td></tr>
    <tr><td>1,500 users</td><td>1.500 Nutzer</td><td>Komma als Tausendertrennzeichen</td></tr>
    <tr><td>1 billion</td><td>1 Milliarde</td><td>„trillion“ ist die deutsche Billion</td></tr>
    <tr><td>03/04/2026 (USA)</td><td>4. März 2026</td><td>USA: Monat/Tag/Jahr; Großbritannien: Tag/Monat/Jahr – eindeutig ist nur ISO 8601: 2026-03-04</td></tr>
    <tr><td>9:30 pm, 9:30 am</td><td>21:30, 9:30</td><td>12-Stunden-Format; Zeitzone beachten (CET, UTC)</td></tr>
    <tr><td>3.5-inch, 2.5"</td><td>3,5 Zoll</td><td>1 Zoll (inch) = 2,54 cm</td></tr>
    <tr><td>up to 1 Gbps</td><td>bis zu 1 Gbit/s</td><td>„up to“ = Höchstwert, im Alltag meist weniger</td></tr>
  </tbody>
</table>

<h6>Anleitungen und Handbücher</h6>
<p>Installationsanleitungen stehen im <strong>Imperativ</strong> und in klarer Reihenfolge:</p>
<pre class="bg-light border rounded p-3"><code>1. Unplug the device before opening the case.
2. Insert the drive into an empty bay until it clicks into place.
3. Make sure that the power LED is off.
4. If the LED flashes red, contact your administrator.
Note: Do not use the reset button during a firmware update.</code></pre>
<ul>
  <li><strong>Note</strong>, <strong>Caution</strong>, <strong>Warning</strong> kennzeichnen steigende Gefahr: Hinweis, Vorsicht (Sachschaden), Warnung (Verletzungsgefahr).</li>
  <li>Bedingungen beachten: <em>if</em> (falls), <em>unless</em> (es sei denn), <em>before / after / until</em> (bevor / nachdem / bis).</li>
</ul>

<h6>Fehlermeldungen</h6>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th>Meldung</th><th>Bedeutung</th><th>erster Prüfschritt</th></tr></thead>
  <tbody>
    <tr><td>Permission denied / Access denied</td><td>keine Berechtigung</td><td>Rechte des Benutzers oder der Datei prüfen</td></tr>
    <tr><td>File not found / No such file or directory</td><td>Datei oder Pfad existiert nicht</td><td>Pfad und Schreibweise prüfen</td></tr>
    <tr><td>Connection refused</td><td>Ziel erreichbar, aber kein Dienst auf dem Port</td><td>läuft der Dienst? richtiger Port?</td></tr>
    <tr><td>Connection timed out</td><td>keine Antwort in der Wartezeit</td><td>Netz, Firewall, Adresse prüfen</td></tr>
    <tr><td>Out of memory</td><td>Arbeitsspeicher erschöpft</td><td>Speicherverbrauch, Lecks, Grenzwerte</td></tr>
    <tr><td>Disk full / No space left on device</td><td>Datenträger voll</td><td>Logs und temporäre Dateien prüfen</td></tr>
    <tr><td>Invalid argument / Syntax error</td><td>ungültiger Wert bzw. Syntaxfehler</td><td>Eingabe und Zeile in der Meldung prüfen</td></tr>
    <tr><td>Deprecated</td><td>veraltet, wird künftig entfernt</td><td>keine Störung, aber auf neue Funktion umstellen</td></tr>
  </tbody>
</table>

<h6>Übungen mit Lösung</h6>
<p>1. Beantworte auf Deutsch anhand des Datenblatts oben: (a) Wie viel Arbeitsspeicher ist maximal möglich? (b) Sind Festplatten von der Garantie abgedeckt? (c) Ist die Installation von Firmware-Updates verpflichtend?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">(a) 32 GB (expandable to 32 GB). (b) Nein, die Garantie gilt ohne Laufwerke (excluding drives). (c) Nein, aber dringend empfohlen (should) – innerhalb von 30 Tagen. Pflicht ist dagegen der Anschluss an eine geerdete Steckdose (must).</p>
</details>
<p>2. Ein US-Hersteller kündigt eine Wartung für „06/07/2026, 11:00 pm EST“ an. Wann ist das?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Am 7. Juni 2026 um 23:00 Uhr US-Ostküstenzeit (USA: Monat/Tag/Jahr). Zeitzone umrechnen und im Zweifel nachfragen – oder ISO-Datum verlangen.</p>
</details>
<p>3. Übersetze und erkläre den Unterschied: „Users must not share passwords.“ – „Users do not have to change their password every month.“</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">„Benutzer dürfen Passwörter nicht weitergeben“ (Verbot). „Benutzer müssen ihr Passwort nicht jeden Monat ändern“ (keine Pflicht, aber erlaubt).</p>
</details>
INHALT,
    'summary' => [
        'Datenblatt: Fakten stehen unter Specifications, Requirements, Operating conditions und Warranty – nicht in der Overview.',
        'must = Pflicht, must not = Verbot, should = Empfehlung, may = erlaubt; don\'t have to = muss nicht.',
        'Zahlen: Dezimalpunkt, Tausenderkomma, billion = Milliarde; Datum in den USA Monat/Tag/Jahr, eindeutig ist ISO 8601.',
        'Anleitungen im Imperativ; Note < Caution < Warning.',
        'Fehlermeldungen: Permission denied, Connection refused, Timed out, No space left on device – jeweils mit erstem Prüfschritt.',
    ],
    'quiz' => [
        ['question' => 'Was bedeutet „must not“ in einer Anleitung?', 'answer' => 'Darf nicht – ein Verbot.'],
        ['question' => 'Wie lautet „1,500.75“ in deutscher Schreibweise?', 'answer' => '1.500,75.'],
        ['question' => 'Was bedeutet die Fehlermeldung „Connection refused“?', 'answer' => 'Das Zielsystem antwortet, aber auf dem Port läuft kein Dienst, der die Verbindung annimmt.'],
        ['question' => 'Welches Datumsformat ist international eindeutig?', 'answer' => 'ISO 8601: Jahr-Monat-Tag, z. B. 2026-03-04.'],
    ],
];
