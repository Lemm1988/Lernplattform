<?php
return [
    'title' => 'Grammatik für technische Texte',
    'intro' => 'Für technische Texte braucht man keine vollständige Grammatik – aber eine Handvoll Strukturen kommt ständig vor: die richtige Zeitform für Statusmeldungen, das Passiv in Dokumentationen, Bedingungssätze in Anleitungen und Modalverben für Pflichten. Diese Werkzeuge reichen für die meisten E-Mails, Tickets und Handbücher.',
    'goals' => [
        'die passende Zeitform für Fakten, laufende Arbeiten, Ergebnisse und Pläne wählen',
        'Passivsätze verstehen und bilden',
        'Bedingungssätze in Anleitungen und Fehlermeldungen anwenden',
        'Modalverben für Fähigkeit, Pflicht, Verbot und Empfehlung einsetzen',
        'Abläufe mit Signalwörtern strukturieren',
    ],
    'content' => <<<'INHALT'
<h6>Zeitformen</h6>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/englisch/zeitformen.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Zeitstrahl: Past simple für abgeschlossene Ereignisse mit Zeitpunkt, Present perfect für Ergebnisse, Present simple für Fakten und Routinen, Present continuous für laufende Arbeiten, will-future für Ankündigungen und going to für Pläne">
  <figcaption class="figure-caption">Welche Zeitform wofür?</figcaption>
</figure>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th>Zeitform</th><th>Bildung</th><th>Signalwörter</th><th>Beispiel</th></tr></thead>
  <tbody>
    <tr><td>Present simple</td><td>Grundform, 3. Person + s</td><td>always, every night, usually</td><td>The script <em>runs</em> every night.</td></tr>
    <tr><td>Present continuous</td><td>am/is/are + -ing</td><td>now, at the moment, currently</td><td>We <em>are migrating</em> the database.</td></tr>
    <tr><td>Past simple</td><td>-ed bzw. unregelmäßige Form</td><td>yesterday, last week, at 3 pm, ago</td><td>The server <em>crashed</em> at 3 pm.</td></tr>
    <tr><td>Present perfect</td><td>have/has + Partizip</td><td>already, yet, just, since, for</td><td>We <em>have</em> already <em>fixed</em> the bug.</td></tr>
    <tr><td>will-future</td><td>will + Grundform</td><td>tomorrow, next week</td><td>The system <em>will restart</em> at 10 pm.</td></tr>
    <tr><td>going to</td><td>am/is/are going to + Grundform</td><td>(geplante Vorhaben)</td><td>We <em>are going to replace</em> the switches.</td></tr>
  </tbody>
</table>
<p class="lf-merke"><strong>Merke:</strong> Steht ein vergangener Zeitpunkt im Satz (<em>yesterday, at 3 pm, in 2024</em>), nimm das Past simple. Geht es um das Ergebnis jetzt, ohne Zeitpunkt, das Present perfect: „I installed the update yesterday.“ – „I have installed the update.“</p>

<h6>Das Passiv</h6>
<p>Dokumentationen und Statusmeldungen interessieren sich meist dafür, <em>was</em> passiert, nicht <em>wer</em> es tut. Deshalb ist das Passiv in technischen Texten häufig: <strong>Form von „to be“ + Partizip Perfekt</strong>.</p>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th>Zeit</th><th>Aktiv</th><th>Passiv</th></tr></thead>
  <tbody>
    <tr><td>Präsens</td><td>The system encrypts all files.</td><td>All files <em>are encrypted</em>.</td></tr>
    <tr><td>Vergangenheit</td><td>An admin deleted the account.</td><td>The account <em>was deleted</em>.</td></tr>
    <tr><td>Present perfect</td><td>We have updated the server.</td><td>The server <em>has been updated</em>.</td></tr>
    <tr><td>Zukunft</td><td>We will replace the disk.</td><td>The disk <em>will be replaced</em>.</td></tr>
    <tr><td>mit Modalverb</td><td>You must restart the device.</td><td>The device <em>must be restarted</em>.</td></tr>
  </tbody>
</table>

<h6>Bedingungssätze</h6>
<ul>
  <li><strong>Immer gültige Regel</strong> (Zero conditional): <em>If</em> + Present, Present – „If the battery is low, the LED turns red.“</li>
  <li><strong>Mögliche Folge</strong> (First conditional): <em>If</em> + Present, <em>will</em> + Grundform – „If the update fails, the system will roll back automatically.“</li>
  <li><strong>Anweisung</strong>: <em>If</em> + Present, Imperativ – „If the error occurs again, restart the service.“</li>
  <li><em>unless</em> = wenn nicht: „The backup does not start unless the drive is connected.“</li>
</ul>
<p>Achtung: Nach <em>if</em> steht im Englischen kein <em>will</em>. Falsch: „If the update will fail …“</p>

<h6>Modalverben</h6>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th>Modalverb</th><th>Bedeutung</th><th>Beispiel</th></tr></thead>
  <tbody>
    <tr><td>can / can't</td><td>können, Fähigkeit oder Möglichkeit</td><td>The app can export PDF files.</td></tr>
    <tr><td>must / have to</td><td>müssen</td><td>You must change the default password.</td></tr>
    <tr><td>must not / mustn't</td><td>nicht dürfen</td><td>You must not unplug the device during the update.</td></tr>
    <tr><td>don't have to / needn't</td><td>nicht müssen</td><td>You don't have to restart after this patch.</td></tr>
    <tr><td>should / shouldn't</td><td>sollten (Empfehlung)</td><td>You should enable two-factor authentication.</td></tr>
    <tr><td>may / might</td><td>dürfen; vielleicht</td><td>The service may be unavailable for a few minutes.</td></tr>
  </tbody>
</table>

<h6>Abläufe strukturieren</h6>
<p>Für Anleitungen, Präsentationen und Berichte: <em>first, then, next, after that, finally</em> für die Reihenfolge; <em>however</em> (jedoch), <em>therefore</em> (deshalb), <em>in addition</em> (außerdem), <em>for example</em> (zum Beispiel), <em>in contrast</em> (im Gegensatz dazu) für die Logik. Vergleiche: <em>faster than</em>, <em>more reliable than</em>, <em>the fastest</em>, <em>the most reliable</em>.</p>

<h6>Übungen mit Lösung</h6>
<p>1. Setze die richtige Zeitform ein: (a) „We ___ (install) the new firewall last Monday.“ (b) „The team ___ (work) on the migration at the moment.“ (c) „I ___ (just/finish) the report – you can read it now.“</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">(a) installed – Zeitpunkt in der Vergangenheit. (b) is working – läuft gerade. (c) have just finished – Ergebnis zählt jetzt.</p>
</details>
<p>2. Forme ins Passiv um: „The administrator has reset all passwords.“ – „The system will send a confirmation email.“</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">„All passwords have been reset (by the administrator).“ – „A confirmation email will be sent.“</p>
</details>
<p>3. Finde den Fehler: „If the connection will drop, the client tries to reconnect.“</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Nach <em>if</em> kein <em>will</em>: „If the connection drops, the client tries to reconnect.“</p>
</details>
<p>4. Übersetze: „Das Gerät darf während des Updates nicht ausgeschaltet werden. Ein Neustart ist danach nicht nötig.“</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">„The device must not be switched off during the update. You don't have to restart it afterwards.“ (oder: „A restart is not necessary afterwards.“)</p>
</details>
INHALT,
    'summary' => [
        'Present simple für Fakten und Routinen, Present continuous für Laufendes, Past simple mit Zeitpunkt, Present perfect für Ergebnisse ohne Zeitpunkt.',
        'will für Ankündigungen, going to für feste Pläne.',
        'Passiv: be + Partizip Perfekt – in Dokumentationen und Statusmeldungen sehr häufig.',
        'Bedingungssätze: If + Present, dann Present, will oder Imperativ; nach if kein will.',
        'must = müssen, must not = nicht dürfen, don\'t have to = nicht müssen, should = sollten, may = dürfen/vielleicht.',
    ],
    'quiz' => [
        ['question' => 'Welche Zeitform verwendet man bei „yesterday“ oder „at 3 pm“?', 'answer' => 'Das Past simple.'],
        ['question' => 'Wie bildet man das Passiv?', 'answer' => 'Form von „to be“ + Partizip Perfekt, z. B. „The file is encrypted“.'],
        ['question' => 'Was ist an „If the update will fail …“ falsch?', 'answer' => 'Nach „if“ steht kein „will“: „If the update fails …“.'],
        ['question' => 'Was bedeutet „You don\'t have to restart“?', 'answer' => 'Du musst nicht neu starten (es ist nicht nötig, aber erlaubt).'],
    ],
];
