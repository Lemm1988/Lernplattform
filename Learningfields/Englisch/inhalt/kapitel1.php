<?php
return [
    'title' => 'Englisch in Ausbildung und Prüfung',
    'intro' => 'Fehlermeldungen, Dokumentationen, Stack Overflow, Kunden-E-Mails: In der IT begegnet dir Englisch jeden Tag. Auch in den Abschlussprüfungen tauchen englische Materialien auf. Dieses Kapitel zeigt, wie du englische Fachtexte schnell und sicher erschließt – auch wenn du nicht jedes Wort kennst.',
    'goals' => [
        'typische englische Materialien in Prüfung und Berufsalltag kennen',
        'die Lesestrategien Skimming, Scanning und genaues Lesen gezielt einsetzen',
        'unbekannte Wörter aus Kontext, Wortfamilie und Internationalismen erschließen',
        'häufige False Friends erkennen und richtig übersetzen',
    ],
    'content' => <<<'INHALT'
<h6>Wo dir Englisch begegnet</h6>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th>im Berufsalltag</th><th>in der Prüfung (typisch)</th></tr></thead>
  <tbody>
    <tr><td>Fehlermeldungen, Logdateien, Compiler-Ausgaben</td><td>Auszug aus einem Datenblatt oder Produktvergleich – Fragen dazu auf Deutsch beantworten</td></tr>
    <tr><td>Dokumentationen, API-Referenzen, Handbücher</td><td>englische Kunden- oder Hersteller-E-Mail verstehen und die Kernaussagen wiedergeben</td></tr>
    <tr><td>Foren und Q&amp;A-Seiten, Issues auf GitHub</td><td>kurze Antwort oder E-Mail auf Englisch formulieren</td></tr>
    <tr><td>internationale Teams, Meetings, Tickets</td><td>Fachbegriffe in Pseudocode, Diagrammen und Aufgabentexten</td></tr>
  </tbody>
</table>
<p>Welche Hilfsmittel (z. B. ein Wörterbuch) zugelassen sind, steht in der Hilfsmittelliste deiner IHK – sieh vor der Prüfung nach.</p>

<h6>Drei Lesestrategien</h6>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th>Strategie</th><th>Ziel</th><th>So geht's</th></tr></thead>
  <tbody>
    <tr><td><strong>Skimming</strong> (überfliegen)</td><td>Worum geht es?</td><td>Überschrift, Zwischenüberschriften, ersten und letzten Satz der Absätze, Tabellen und Hervorhebungen lesen – höchstens eine Minute</td></tr>
    <tr><td><strong>Scanning</strong> (gezielt suchen)</td><td>eine bestimmte Information finden</td><td>mit der Frage im Kopf nach Zahlen, Namen, Fachbegriffen suchen, den Rest ignorieren</td></tr>
    <tr><td><strong>Detailed reading</strong> (genau lesen)</td><td>eine Stelle vollständig verstehen</td><td>nur die gefundene Passage Satz für Satz lesen, auf Verneinungen und Bedingungen achten (<em>not</em>, <em>unless</em>, <em>only if</em>, <em>except</em>)</td></tr>
  </tbody>
</table>
<p class="lf-pruefung"><strong>Prüfungstipp:</strong> Erst die Fragen lesen, dann den Text scannen. Bei einem Datenblatt stehen die Antworten fast immer in Tabellen oder Aufzählungen – Fließtext ist oft Werbung.</p>

<h6>Unbekannte Wörter erschließen</h6>
<ul>
  <li><strong>Kontext</strong>: Was muss an dieser Stelle stehen? In „The update is <em>mandatory</em> for all devices“ deutet das Satzende auf „verpflichtend“.</li>
  <li><strong>Wortfamilie</strong>: Kennst du <em>to rely</em> (sich verlassen), erschließt sich <em>reliable</em> (zuverlässig) und <em>reliability</em> (Zuverlässigkeit).</li>
  <li><strong>Internationalismen</strong>: <em>configuration, compatibility, performance, server</em> – viele Fachwörter sind im Deutschen gleich oder ähnlich.</li>
  <li><strong>Vorsilben und Endungen</strong>: <em>un-</em> (nicht), <em>re-</em> (wieder), <em>-able</em> (-bar), <em>-less</em> (-los): <em>unreadable</em> = unlesbar, <em>wireless</em> = drahtlos, <em>to reinstall</em> = neu installieren.</li>
  <li>Nicht jedes Wort ist wichtig. Für die Antwort reicht oft das Verständnis des Satzes, nicht jedes Adjektivs.</li>
</ul>

<h6>False Friends</h6>
<p>Manche Wörter sehen deutsch aus, bedeuten aber etwas anderes. Sie führen zu den teuersten Missverständnissen:</p>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th>englisch</th><th>bedeutet</th><th>nicht</th><th>„nicht“ heißt auf Englisch</th></tr></thead>
  <tbody>
    <tr><td>to become</td><td>werden</td><td>bekommen</td><td>to get, to receive</td></tr>
    <tr><td>eventually</td><td>schließlich, letztendlich</td><td>eventuell</td><td>possibly, perhaps</td></tr>
    <tr><td>actual, actually</td><td>tatsächlich</td><td>aktuell</td><td>current, up to date</td></tr>
    <tr><td>to control</td><td>steuern, beherrschen</td><td>kontrollieren (prüfen)</td><td>to check, to inspect</td></tr>
    <tr><td>billion</td><td>Milliarde</td><td>Billion</td><td>trillion</td></tr>
    <tr><td>sensible</td><td>vernünftig</td><td>sensibel</td><td>sensitive</td></tr>
    <tr><td>consequent</td><td>daraus folgend</td><td>konsequent</td><td>consistent</td></tr>
    <tr><td>provision</td><td>Bereitstellung</td><td>Provision</td><td>commission</td></tr>
    <tr><td>handy</td><td>praktisch</td><td>Handy</td><td>mobile phone</td></tr>
    <tr><td>chef</td><td>Koch</td><td>Chef</td><td>boss, manager</td></tr>
    <tr><td>also</td><td>auch</td><td>also (deshalb)</td><td>so, therefore</td></tr>
    <tr><td>to ignore</td><td>bewusst nicht beachten</td><td>nicht kennen</td><td>not to know</td></tr>
  </tbody>
</table>
<p class="lf-merke"><strong>Merke:</strong> <em>The actual value</em> ist der tatsächliche Wert, <em>the current value</em> der aktuelle. <em>Eventually the server restarts</em> heißt: Er startet schließlich neu – nicht vielleicht.</p>

<h6>Übungen mit Lösung</h6>
<p>1. Übersetze: „Eventually, the actual cause of the outage was found: a sensible change in the firewall configuration had not been tested.“</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">„Schließlich wurde die tatsächliche Ursache des Ausfalls gefunden: Eine an sich vernünftige Änderung der Firewall-Konfiguration war nicht getestet worden.“</p>
</details>
<p>2. Welche Lesestrategie setzt du ein? (a) Du sollst in einem dreiseitigen Datenblatt die maximale Leistungsaufnahme finden. (b) Du willst wissen, ob ein Artikel überhaupt zu deinem Problem passt.</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">(a) Scanning – gezielt nach „power consumption“ oder „W“ suchen. (b) Skimming – Überschrift, Einleitung und Zwischenüberschriften überfliegen.</p>
</details>
<p>3. Erschließe die Bedeutung: <em>unreliable, reconnect, scalability, password-less</em>.</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">unzuverlässig, erneut verbinden, Skalierbarkeit, ohne Passwort (passwortlos).</p>
</details>
INHALT,
    'summary' => [
        'Englisch begegnet dir in Fehlermeldungen, Dokumentationen, E-Mails und in Prüfungsmaterialien wie Datenblättern.',
        'Skimming für den Überblick, Scanning für gezielte Informationen, genaues Lesen nur für die gefundene Stelle.',
        'Unbekannte Wörter über Kontext, Wortfamilie, Internationalismen und Vor-/Nachsilben erschließen.',
        'False Friends: become = werden, eventually = schließlich, actual = tatsächlich, billion = Milliarde, sensible = vernünftig.',
    ],
    'quiz' => [
        ['question' => 'Was bedeutet „eventually“?', 'answer' => 'Schließlich, letztendlich – nicht „eventuell“ (das heißt possibly).'],
        ['question' => 'Wie heißt „aktuell“ auf Englisch?', 'answer' => 'current oder up to date – „actual“ bedeutet tatsächlich.'],
        ['question' => 'Wofür nutzt man Scanning?', 'answer' => 'Um gezielt eine bestimmte Information (Zahl, Begriff) in einem Text zu finden.'],
        ['question' => 'Was bedeutet „billion“?', 'answer' => 'Milliarde (10⁹).'],
    ],
];
