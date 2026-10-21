<?php
return [
    'title' => 'Rechtsformen, Kaufmann und Handelsregister',
    'intro' => 'Ob Einzelunternehmen, GmbH oder AG – die Rechtsform entscheidet darüber, wer haftet, wer entscheidet und wie viel Kapital nötig ist. Für Wirtschafts- und Sozialkunde ist sie ein Dauerbrenner.',
    'goals' => [
        'Einzelunternehmen, Personen- und Kapitalgesellschaften vergleichen',
        'Haftung, Kapital und Geschäftsführung je Rechtsform bestimmen',
        'Ist-, Kann- und Formkaufmann unterscheiden',
        'Aufbau und Bedeutung des Handelsregisters erklären',
        'Firmengrundsätze und Firmenarten anwenden',
    ],
    'content' => <<<'INHALT'
<h6>Rechtsformen im Überblick</h6>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf1/rechtsformen.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Einzelunternehmen mit unbeschränkter Haftung, Personengesellschaften GbR, OHG und KG mit persönlicher Haftung, Kapitalgesellschaften GmbH, UG und AG mit Haftung nur des Gesellschaftsvermögens">
  <figcaption class="figure-caption">Die Haftung ist der wichtigste Unterschied</figcaption>
</figure>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th>Rechtsform</th><th>Mindestkapital</th><th>Haftung</th><th>Geschäftsführung</th><th>Register</th></tr></thead>
  <tbody>
    <tr><td>Einzelunternehmen (e. K.)</td><td>keines</td><td>Inhaber unbeschränkt</td><td>Inhaber</td><td>HR A (wenn Kaufmann)</td></tr>
    <tr><td>GbR</td><td>keines</td><td>Gesellschafter persönlich, unbeschränkt, gesamtschuldnerisch</td><td>laut Vertrag, sonst gemeinsam</td><td>freiwillig Gesellschaftsregister (eGbR)</td></tr>
    <tr><td>OHG</td><td>keines</td><td>alle Gesellschafter unbeschränkt, gesamtschuldnerisch</td><td>jeder Gesellschafter</td><td>HR A</td></tr>
    <tr><td>KG</td><td>keines</td><td>Komplementär unbeschränkt, Kommanditist bis zur Einlage</td><td>Komplementär</td><td>HR A</td></tr>
    <tr><td>GmbH</td><td>25.000 € (bei Anmeldung mind. 12.500 € eingezahlt)</td><td>nur Gesellschaftsvermögen</td><td>Geschäftsführer</td><td>HR B</td></tr>
    <tr><td>UG (haftungsbeschränkt)</td><td>ab 1 €</td><td>nur Gesellschaftsvermögen</td><td>Geschäftsführer</td><td>HR B</td></tr>
    <tr><td>AG</td><td>50.000 € Grundkapital</td><td>nur Gesellschaftsvermögen</td><td>Vorstand, kontrolliert vom Aufsichtsrat</td><td>HR B</td></tr>
  </tbody>
</table>
<ul>
  <li><strong>Gesamtschuldnerisch</strong> heißt: Ein Gläubiger kann von jedem Gesellschafter die ganze Schuld verlangen; dieser holt sich die Anteile intern von den anderen zurück.</li>
  <li>Die <strong>UG</strong> ist eine GmbH mit geringem Startkapital. Sie muss ein Viertel ihres Jahresüberschusses in eine Rücklage stellen, bis 25.000 € erreicht sind – dann kann sie zur GmbH werden.</li>
  <li>Kapitalgesellschaften sind <strong>juristische Personen</strong>: Sie handeln durch ihre Organe (GmbH: Geschäftsführer und Gesellschafterversammlung; AG: Vorstand, Aufsichtsrat, Hauptversammlung).
    Der GmbH-Gesellschaftsvertrag muss notariell beurkundet werden.</li>
  <li><strong>Gewinnverteilung</strong> bei OHG und KG: nach dem Gesellschaftsvertrag, ohne Regelung seit 2024 nach den Beteiligungsverhältnissen. Die frühere gesetzliche Regel
    (4 % auf die Kapitalanteile, Rest nach Köpfen) gilt nicht mehr – ältere Übungsaufgaben enthalten sie noch.</li>
</ul>

<h6>Wer ist Kaufmann?</h6>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf1/handelsregister.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Ist-, Kann- und Formkaufmann mit der Wirkung der Eintragung; Handelsregister mit Abteilung A für Einzelkaufleute und Personenhandelsgesellschaften und Abteilung B für Kapitalgesellschaften">
  <figcaption class="figure-caption">Kaufmannsarten und Handelsregister</figcaption>
</figure>
<p>Für Kaufleute gilt neben dem BGB das <strong>Handelsgesetzbuch</strong> (HGB) – mit strengeren Regeln, etwa der sofortigen Rügepflicht (<a href="/Learningfields/LF6/kapitel7.php">LF6 Kapitel 7</a>),
der Pflicht zur Buchführung und der Möglichkeit, Prokura zu erteilen (<a href="/Learningfields/LF1/kapitel5.php">Kapitel 5</a>). Das Handelsregister kann jeder online einsehen; was dort eingetragen und bekannt gemacht ist,
müssen Geschäftspartner gegen sich gelten lassen.</p>

<h6>Die Firma</h6>
<p>Die <strong>Firma</strong> ist der Name, unter dem ein Kaufmann seine Geschäfte betreibt und unterschreibt – nicht das Unternehmen selbst.</p>
<ul>
  <li><strong>Firmenarten</strong>: Personenfirma („Anna Berger e. K.“), Sachfirma („Netzwerktechnik Nord GmbH“), Fantasiefirma (Kunstwort), Mischfirma („Berger IT-Service GmbH“).</li>
  <li><strong>Firmengrundsätze</strong>: Wahrheit und Klarheit (nicht irreführend), Ausschließlichkeit (am Ort unterscheidbar), Beständigkeit (kann beim Inhaberwechsel fortgeführt werden),
    Öffentlichkeit (Eintragung im Handelsregister) – und immer der <strong>Rechtsformzusatz</strong> (e. K., OHG, KG, GmbH, AG …).</li>
</ul>

<h6>Übungen mit Lösung</h6>
<p>1. Drei Freunde gründen ein Softwarehaus und wollen nicht mit ihrem Privatvermögen haften, haben aber nur 3.000 € Startkapital. Welche Rechtsform passt?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Die UG (haftungsbeschränkt): Mindestkapital ab 1 €, Haftung nur mit dem Gesellschaftsvermögen. Sie müssen Gewinne teilweise thesaurieren, bis 25.000 € erreicht sind, und können dann zur GmbH werden.</p>
</details>
<p>2. Eine KG hat 90.000 € Schulden, die sie nicht bezahlen kann. Komplementärin A, Kommanditist B (Einlage 20.000 €, voll eingezahlt). Wer haftet womit?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">A haftet unbeschränkt, auch mit ihrem Privatvermögen. B haftet nur bis zur Höhe seiner Einlage; da sie eingezahlt ist, haftet er nicht darüber hinaus mit seinem Privatvermögen.</p>
</details>
<p>3. Ein kleiner IT-Händler mit zwei Aushilfen lässt sich freiwillig ins Handelsregister eintragen. Welche Kaufmannsart ist er, und was bewirkt die Eintragung?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Kannkaufmann. Die Eintragung macht ihn erst zum Kaufmann (konstitutiv); ab dann gelten für ihn die Regeln des HGB.</p>
</details>
INHALT,
    'summary' => [
        'Einzelunternehmen und Personengesellschaften: persönliche, unbeschränkte Haftung (Kommanditist nur bis zur Einlage).',
        'Kapitalgesellschaften: Haftung nur mit Gesellschaftsvermögen; GmbH 25.000 €, UG ab 1 €, AG 50.000 €.',
        'Istkaufmann (Eintragung deklaratorisch), Kannkaufmann (konstitutiv), Formkaufmann (kraft Rechtsform).',
        'Handelsregister beim Amtsgericht: Abteilung A Einzelkaufleute und Personenhandelsgesellschaften, B Kapitalgesellschaften.',
        'Firma = Name des Kaufmanns; Grundsätze Wahrheit, Ausschließlichkeit, Beständigkeit, Öffentlichkeit, Rechtsformzusatz.',
    ],
    'quiz' => [
        ['question' => 'Wie hoch ist das Mindest-Stammkapital einer GmbH?', 'answer' => '25.000 €.'],
        ['question' => 'Wie haftet ein Kommanditist?', 'answer' => 'Nur bis zur Höhe seiner Einlage.'],
        ['question' => 'In welche Abteilung des Handelsregisters wird eine AG eingetragen?', 'answer' => 'In Abteilung B.'],
        ['question' => 'Was ist die Firma im rechtlichen Sinn?', 'answer' => 'Der Name, unter dem ein Kaufmann seine Geschäfte betreibt und unterschreibt.'],
    ],
];
