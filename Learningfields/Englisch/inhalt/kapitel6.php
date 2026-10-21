<?php
return [
    'title' => 'Sprechen im Team: Meetings, Support und User Stories',
    'intro' => 'Im Daily Stand-up kurz berichten, am Telefon ein Problem eingrenzen, in einer Besprechung höflich widersprechen, Anforderungen als User Story festhalten: Gesprochenes Englisch im IT-Alltag folgt wiederkehrenden Mustern. Mit ein paar sicheren Formulierungen kommst du weit.',
    'goals' => [
        'im Daily Stand-up strukturiert berichten',
        'in Meetings zustimmen, widersprechen und nachfragen',
        'ein Support-Telefonat führen und Informationen sicher erfragen',
        'User Stories und Akzeptanzkriterien auf Englisch formulieren',
    ],
    'content' => <<<'INHALT'
<h6>Daily Stand-up</h6>
<p>Im Stand-up (<a href="/Learningfields/Scrum/Scrum_Fundation_index.php">Scrum</a>) beantwortet jede Person kurz drei Fragen:</p>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th>Frage</th><th>Formulierung</th></tr></thead>
  <tbody>
    <tr><td>Was habe ich seit gestern geschafft?</td><td>Yesterday I finished the login page and fixed two bugs in the export.</td></tr>
    <tr><td>Was mache ich heute?</td><td>Today I'm going to write unit tests for the payment service.</td></tr>
    <tr><td>Was blockiert mich?</td><td>I'm blocked by the missing API key. / No blockers.</td></tr>
  </tbody>
</table>

<h6>Meetings</h6>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th>Absicht</th><th>Formulierungen</th></tr></thead>
  <tbody>
    <tr><td>zustimmen</td><td>I agree. / That makes sense. / Good point.</td></tr>
    <tr><td>höflich widersprechen</td><td>I see your point, but … / I'm not sure that will work because … / Have we considered …?</td></tr>
    <tr><td>nachfragen</td><td>Sorry, could you repeat that? / What exactly do you mean by …? / Just to make sure I understand: …</td></tr>
    <tr><td>vorschlagen</td><td>What about …? / I suggest we … / Why don't we …?</td></tr>
    <tr><td>zusammenfassen</td><td>So, to sum up: … / Let's agree on the next steps.</td></tr>
  </tbody>
</table>
<p>Ein „Just to make sure I understand“ mit eigener Zusammenfassung verhindert mehr Fehler als jede Grammatikregel.</p>

<h6>Support am Telefon</h6>
<ol>
  <li><strong>Begrüßen und vorstellen</strong>: „IT service desk, Alex speaking. How can I help you?“</li>
  <li><strong>Daten erfragen</strong>: „Could I have your name and employee ID, please?“ – „Could you spell that, please?“</li>
  <li><strong>Problem eingrenzen</strong>: „When did the problem start?“ – „Does it happen on other devices too?“ – „Have you changed anything recently?“ – „What does the error message say exactly?“</li>
  <li><strong>Anleiten</strong>: „Please click on … / Could you restart the application?“ – „What do you see now?“</li>
  <li><strong>Abschließen</strong>: „I've created ticket number 4711. I'll get back to you by 3 pm.“ – „Is there anything else I can do for you?“</li>
</ol>
<p>Das Buchstabieralphabet hilft bei Namen und Codes: <em>A as in Alpha, B as in Bravo, C as in Charlie …</em> Zahlen einzeln sprechen („four – seven – one – one“).</p>

<h6>User Stories und Akzeptanzkriterien</h6>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/englisch/user-story.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="User-Story-Karte: As a support agent, I want to filter tickets by priority, so that I can handle urgent requests first; darunter zwei Akzeptanzkriterien im Format Given, When, Then; rechts die Bausteine erklärt">
  <figcaption class="figure-caption">User Story und Akzeptanzkriterien im Given-When-Then-Format</figcaption>
</figure>
<ul>
  <li><strong>User Story</strong>: <em>As a</em> &lt;Rolle&gt;, <em>I want to</em> &lt;Ziel&gt;, <em>so that</em> &lt;Nutzen&gt;. Sie beschreibt den Bedarf aus Sicht der Nutzer – nicht die technische Lösung.</li>
  <li><strong>Akzeptanzkriterien</strong>: <em>Given</em> &lt;Ausgangslage&gt;, <em>when</em> &lt;Aktion&gt;, <em>then</em> &lt;erwartetes Ergebnis&gt;. Jedes Kriterium ist testbar und lässt sich oft direkt in einen automatisierten Test übersetzen.</li>
  <li><strong>Definition of Done</strong>: gemeinsame Liste, wann eine Story fertig ist, z. B. „code reviewed, tests passed, documentation updated, deployed to staging“.</li>
</ul>

<h6>Kurz präsentieren</h6>
<p>„Today I'd like to show you …“ – „First, … Then, … Finally, …“ – „As you can see on this slide, …“ – „To sum up, …“ – „Thank you. Are there any questions?“ Mehr zum Präsentieren in <a href="/Learningfields/LF1/kapitel8.php">LF1 Kapitel 8</a>.</p>

<h6>Übungen mit Lösung</h6>
<p>1. Formuliere deinen Stand-up-Beitrag: Gestern hast du die Datenbankmigration getestet, heute willst du die Dokumentation schreiben, du wartest noch auf Zugangsdaten zum Testserver.</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">„Yesterday I tested the database migration. Today I'm going to write the documentation. I'm blocked by the missing credentials for the test server.“</p>
</details>
<p>2. Schreibe eine User Story mit einem Akzeptanzkriterium: Ein Kunde möchte seine Rechnungen als PDF herunterladen, um sie zu archivieren.</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">„As a customer, I want to download my invoices as PDF files, so that I can archive them.“ – „Given I am logged in and on the invoice page, when I click 'Download PDF' next to an invoice, then a PDF of this invoice is downloaded.“</p>
</details>
<p>3. Ein Anrufer sagt: „My computer is broken.“ Stelle drei Fragen, um das Problem einzugrenzen.</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Zum Beispiel: „What exactly happens when you switch it on?“ – „Do you see an error message? What does it say?“ – „When did the problem start, and did you change anything before?“</p>
</details>
INHALT,
    'summary' => [
        'Stand-up: Yesterday I …, Today I\'m going to …, I\'m blocked by … / No blockers.',
        'Meetings: höflich widersprechen („I see your point, but …“) und Verständnis absichern („Just to make sure I understand …“).',
        'Support-Telefonat: begrüßen, Daten erfragen und buchstabieren lassen, eingrenzen, anleiten, mit Ticketnummer und Zusage abschließen.',
        'User Story: As a … I want to … so that …; Akzeptanzkriterien: Given … when … then …; dazu eine Definition of Done.',
    ],
    'quiz' => [
        ['question' => 'Wie lautet das Muster einer User Story?', 'answer' => 'As a <Rolle>, I want to <Ziel>, so that <Nutzen>.'],
        ['question' => 'Wofür stehen Given, When und Then?', 'answer' => 'Ausgangslage, Aktion und erwartetes Ergebnis eines Akzeptanzkriteriums.'],
        ['question' => 'Wie bittest du am Telefon, einen Namen zu buchstabieren?', 'answer' => '„Could you spell that, please?“'],
        ['question' => 'Wie sagst du im Stand-up, dass dich etwas blockiert?', 'answer' => '„I\'m blocked by …“ – oder „No blockers“, wenn nichts blockiert.'],
    ],
];
