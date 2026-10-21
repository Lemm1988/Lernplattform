<?php
return [
    'title' => 'Schreiben: E-Mails, Tickets und Commit-Messages',
    'intro' => 'Eine klare englische E-Mail spart Rückfragen, ein gutes Ticket spart Stunden der Fehlersuche, eine saubere Commit-Message hilft dem Team noch Jahre später. Für alle drei gibt es feste Bausteine und Formulierungen, die du dir einmal zurechtlegst und dann immer wieder nutzt.',
    'goals' => [
        'eine englische Geschäfts-E-Mail mit festen Bausteinen aufbauen',
        'formelle und informelle Formulierungen unterscheiden',
        'einen Fehlerbericht (Bug Report) vollständig und reproduzierbar schreiben',
        'Commit-Messages nach gängigen Regeln formulieren',
    ],
    'content' => <<<'INHALT'
<h6>Aufbau einer E-Mail</h6>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/englisch/email-aufbau.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="E-Mail in sechs Bausteinen: Subject, Greeting, Purpose, Details, Call to action und Closing, jeweils mit Beispielsatz und deutscher Erläuterung">
  <figcaption class="figure-caption">Sechs Bausteine einer klaren Geschäfts-E-Mail</figcaption>
</figure>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th>Baustein</th><th>formell</th><th>informell (Team, bekannte Kunden)</th></tr></thead>
  <tbody>
    <tr><td>Anrede</td><td>Dear Mr Smith, / Dear Ms Taylor, / Dear Sir or Madam,</td><td>Hi Sam, / Hello team,</td></tr>
    <tr><td>Anlass</td><td>I am writing to inform you about … / with regard to your request …</td><td>Just a quick note about … / Following up on …</td></tr>
    <tr><td>Bitte</td><td>Could you please … / I would be grateful if you could …</td><td>Can you … ? / Please …</td></tr>
    <tr><td>Anhang</td><td>Please find attached the updated offer.</td><td>I've attached the log file.</td></tr>
    <tr><td>Entschuldigung</td><td>We apologise for any inconvenience caused.</td><td>Sorry for the delay.</td></tr>
    <tr><td>Abschluss</td><td>Please do not hesitate to contact me if you have any questions.</td><td>Let me know if you need anything else.</td></tr>
    <tr><td>Gruß</td><td>Kind regards, / Yours sincerely, (bei bekanntem Namen, britisch)</td><td>Best, / Cheers,</td></tr>
  </tbody>
</table>
<p>Tipps: Betreff konkret („Printer on 2nd floor out of order“ statt „Problem“), ein Anliegen pro E-Mail, kurze Absätze, Zeitangaben mit Zeitzone. Im Englischen folgt nach der Anrede mit Komma ein <em>großgeschriebener</em> Satzanfang.</p>

<h6>Ein guter Fehlerbericht</h6>
<p>Ein Bug Report muss so geschrieben sein, dass jemand anderes den Fehler <strong>nachstellen</strong> kann – ohne Rückfrage.</p>
<pre class="bg-light border rounded p-3"><code>Title:    Export to CSV fails for reports with more than 10,000 rows

Environment:  Version 4.2.1, Windows 11, Chrome 128
Steps to reproduce:
  1. Open "Reports" and select "Sales 2026".
  2. Set the filter to "All regions".
  3. Click "Export" and choose "CSV".
Expected result:  A CSV file with all rows is downloaded.
Actual result:    The progress bar stops at 80 %, an error appears:
                  "Request timed out".
Frequency:    always (3 of 3 attempts)
Attachments:  screenshot.png, browser-console.log
Priority:     High – the monthly report for management is due on Friday.</code></pre>
<p class="lf-merke"><strong>Merke:</strong> Titel, Umgebung, <em>Steps to reproduce</em>, <em>Expected result</em>, <em>Actual result</em> – erwartetes und tatsächliches Ergebnis immer getrennt aufschreiben. Eine Meinung („the export is broken“) ersetzt keine Beschreibung.</p>

<h6>Commit-Messages</h6>
<ul>
  <li><strong>Betreffzeile</strong> im <strong>Imperativ</strong>, kurz (Richtwert 50 Zeichen), ohne Punkt: <code>Fix timeout in CSV export</code> – nicht „Fixed …“ oder „Fixes …“. Gedanke dahinter: „If applied, this commit will <em>fix timeout in CSV export</em>.“</li>
  <li>Leerzeile, dann ein <strong>Textkörper</strong>, der erklärt, <em>warum</em> die Änderung nötig war – das <em>Was</em> zeigt der Code.</li>
  <li>Viele Teams nutzen Präfixe (<em>Conventional Commits</em>): <code>feat:</code> neue Funktion, <code>fix:</code> Fehlerbehebung, <code>docs:</code> Dokumentation, <code>refactor:</code> Umbau ohne neue Funktion, <code>test:</code> Tests.</li>
</ul>
<pre class="bg-light border rounded p-3"><code>fix: Stream CSV export instead of building it in memory

Large reports (&gt; 10,000 rows) exceeded the 30 s request limit
because the whole file was generated before sending. The export
now writes rows in chunks, so the first bytes arrive immediately.

Refs: #482</code></pre>
<p>Auch Variablen- und Methodennamen sowie Kommentare stehen in den meisten Projekten auf Englisch: <code>calculateTotalPrice()</code> statt <code>berechneGesamtpreis()</code> – so bleibt der Code für alle lesbar.</p>

<h6>Übungen mit Lösung</h6>
<p>1. Schreibe eine kurze, formelle E-Mail an einen Kunden: Die Lieferung der Notebooks verzögert sich um eine Woche, neuer Termin ist der 14. Mai. Entschuldige dich und biete einen Anruf an.</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Subject: Delivery of your notebooks – new date 14 May<br>Dear Ms Taylor,<br>I am writing to inform you that the delivery of your 20 notebooks has been delayed by one week due to a supplier issue. The new delivery date is 14 May. We apologise for any inconvenience caused.<br>If you would like to discuss the schedule, I would be happy to call you.<br>Kind regards,<br>Alex Becker</p>
</details>
<p>2. Verbessere den Fehlerbericht: „Login doesn't work. Please fix ASAP!!!“</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Ein aussagekräftiger Titel („Login fails with 'Invalid token' after password reset“), die Umgebung (Version, Browser), die Schritte zum Nachstellen, das erwartete und das tatsächliche Ergebnis, wie oft der Fehler auftritt, ein Screenshot oder Log und eine begründete Priorität ergänzen.</p>
</details>
<p>3. Formuliere als Commit-Betreff: „Ich habe die Validierung der E-Mail-Adresse im Registrierungsformular hinzugefügt.“</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2"><code>Add email validation to registration form</code> (oder mit Präfix: <code>feat: Add email validation to registration form</code>).</p>
</details>
INHALT,
    'summary' => [
        'E-Mail: Subject, Greeting, Purpose, Details, Call to action, Closing – ein Anliegen pro E-Mail.',
        'Formell: Dear …, I am writing to …, Could you please …, Kind regards; informell: Hi …, Can you …, Best.',
        'Bug Report: Titel, Umgebung, Steps to reproduce, Expected result, Actual result, Häufigkeit, Anhänge, Priorität.',
        'Commit-Message: Betreff im Imperativ, kurz, ohne Punkt; Textkörper erklärt das Warum; Präfixe wie feat: und fix:.',
    ],
    'quiz' => [
        ['question' => 'In welcher Form steht die Betreffzeile einer Commit-Message?', 'answer' => 'Im Imperativ, z. B. „Fix timeout in CSV export“.'],
        ['question' => 'Welche zwei Angaben dürfen in einem Bug Report nie fehlen, damit man den Fehler versteht?', 'answer' => 'Expected result und actual result – zusammen mit den Steps to reproduce.'],
        ['question' => 'Wie leitet man formell eine Bitte ein?', 'answer' => 'Zum Beispiel mit „Could you please …“ oder „I would be grateful if you could …“.'],
        ['question' => 'Wie kündigt man einen Anhang formell an?', 'answer' => '„Please find attached …“.'],
    ],
];
