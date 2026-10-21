<?php
return [
    'title' => 'Entgelt, Steuern und Sozialversicherung',
    'intro' => 'Vom Bruttogehalt kommt nur ein Teil auf dem Konto an. Wer die Abzüge versteht, kann seine Abrechnung prüfen, Angebote vergleichen und in der Prüfung eine Nettolohnrechnung in wenigen Minuten lösen. Alle Werte gelten für 2026.',
    'goals' => [
        'eine Entgeltabrechnung vom Brutto zum Netto nachvollziehen',
        'Beitragssätze und Beitragsbemessungsgrenzen der Sozialversicherung anwenden',
        'Steuerklassen, Minijob und Midijob unterscheiden',
        'Prinzipien, Träger und Leistungen der Sozialversicherung erklären',
        'Werbungskosten in der Einkommensteuererklärung berechnen',
        'die drei Säulen der Altersvorsorge benennen',
    ],
    'content' => <<<'INHALT'
<h6>Aufbau einer Entgeltabrechnung</h6>
<ol>
  <li><strong>Bruttoentgelt</strong>: Grundgehalt plus Zulagen, Zuschläge, Prämien, vermögenswirksame Leistungen des Arbeitgebers.</li>
  <li><strong>Steuern</strong>: Lohnsteuer (nach Steuerklasse aus der Lohnsteuertabelle), Kirchensteuer (8 % der Lohnsteuer in Bayern und Baden-Württemberg, sonst 9 %, nur für Kirchenmitglieder), Solidaritätszuschlag (5,5 % der Lohnsteuer, entfällt aber dank einer hohen Freigrenze für die allermeisten Beschäftigten).</li>
  <li><strong>Sozialversicherung</strong>: Arbeitnehmeranteile zur Kranken-, Pflege-, Renten- und Arbeitslosenversicherung.</li>
  <li>Ergebnis: <strong>Nettoentgelt</strong>. Davon gehen noch persönliche Abzüge ab (z. B. Sparrate für vermögenswirksame Leistungen, Vorschuss) → <strong>Auszahlungsbetrag</strong>.</li>
</ol>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/wiso/brutto-netto.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Wasserfalldiagramm: Brutto 3.200 Euro, minus Lohnsteuer 370, Kirchensteuer 33,30, Krankenversicherung 280, Pflegeversicherung 76,80, Rentenversicherung 297,60, Arbeitslosenversicherung 41,60, ergibt Netto 2.100,70 Euro">
  <figcaption class="figure-caption">Beispielabrechnung 2026: 3.200 € brutto, Steuerklasse I, kinderlos, 26 Jahre, Lohnsteuer angenommen</figcaption>
</figure>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th>Position</th><th>Rechnung</th><th>Betrag</th></tr></thead>
  <tbody>
    <tr><td>Bruttogehalt</td><td></td><td>3.200,00 €</td></tr>
    <tr><td>Lohnsteuer</td><td>laut Lohnsteuertabelle (in der Prüfung gegeben)</td><td>− 370,00 €</td></tr>
    <tr><td>Kirchensteuer</td><td>9 % von 370,00 €</td><td>− 33,30 €</td></tr>
    <tr><td>Krankenversicherung</td><td>(14,6 % + 2,9 % Zusatzbeitrag) / 2 = 8,75 %</td><td>− 280,00 €</td></tr>
    <tr><td>Pflegeversicherung</td><td>1,8 % + 0,6 % Zuschlag für Kinderlose ab 23 = 2,4 %</td><td>− 76,80 €</td></tr>
    <tr><td>Rentenversicherung</td><td>18,6 % / 2 = 9,3 %</td><td>− 297,60 €</td></tr>
    <tr><td>Arbeitslosenversicherung</td><td>2,6 % / 2 = 1,3 %</td><td>− 41,60 €</td></tr>
    <tr><td><strong>Nettogehalt</strong></td><td></td><td><strong>2.100,70 €</strong></td></tr>
  </tbody>
</table>
<p>Der Arbeitgeber zahlt zusätzlich seinen Anteil (hier 676,80 €: Kranken 280,00, Pflege 57,60, Rente 297,60, Arbeitslosigkeit 41,60), die Unfallversicherung allein, die Insolvenzgeldumlage (0,15 %) und Umlagen für Krankheit und Mutterschaft. Ein Arbeitsplatz mit 3.200 € brutto kostet ihn also deutlich über 3.880 € im Monat – wichtig für die Kalkulation von Stundensätzen (<a href="/Learningfields/LF12/kapitel3.php">LF12 Kapitel 3</a>).</p>

<h6>Sozialversicherung 2026</h6>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th>Zweig</th><th>Beitragssatz</th><th>Anteil Beschäftigte</th><th>Beitragsbemessungsgrenze (Monat)</th></tr></thead>
  <tbody>
    <tr><td>Krankenversicherung</td><td>14,6 % + Zusatzbeitrag der Kasse (Ø 2,9 %)</td><td>Hälfte, Ø 8,75 %</td><td rowspan="2">5.812,50 €</td></tr>
    <tr><td>Pflegeversicherung</td><td>3,6 %</td><td>1,8 % (Kinderlose ab 23: 2,4 %; Sachsen abweichend; Abschläge ab dem 2. Kind unter 25)</td></tr>
    <tr><td>Rentenversicherung</td><td>18,6 %</td><td>9,3 %</td><td rowspan="2">8.450,00 €</td></tr>
    <tr><td>Arbeitslosenversicherung</td><td>2,6 %</td><td>1,3 %</td></tr>
    <tr><td>Unfallversicherung</td><td>je nach Gefahrklasse der Branche</td><td>0 % – zahlt der Arbeitgeber allein</td><td>–</td></tr>
  </tbody>
</table>
<ul>
  <li><strong>Beitragsbemessungsgrenze</strong>: Bis zu diesem Einkommen steigen die Beiträge; darüber liegendes Einkommen ist beitragsfrei. Bei 7.000 € brutto werden Kranken- und Pflegebeiträge nur von 5.812,50 € berechnet, Renten- und Arbeitslosenbeiträge von den vollen 7.000 €.</li>
  <li><strong>Versicherungspflichtgrenze</strong>: Wer mehr als 77.400 € im Jahr verdient, kann statt der gesetzlichen eine private Krankenversicherung wählen.</li>
</ul>

<h6>Prinzipien, Träger, Leistungen</h6>
<ul>
  <li><strong>Pflichtversicherung</strong>: Beschäftigte sind automatisch versichert. <strong>Solidaritätsprinzip</strong>: Beiträge richten sich nach dem Einkommen, Leistungen nach dem Bedarf. <strong>Umlageverfahren</strong> („Generationenvertrag“): Die heutigen Beiträge finanzieren die heutigen Renten. <strong>Selbstverwaltung</strong>: Versicherte und Arbeitgeber wählen Vertreter in die Gremien der Träger (Sozialwahl).</li>
</ul>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th>Zweig</th><th>Träger</th><th>wichtige Leistungen</th></tr></thead>
  <tbody>
    <tr><td>Kranken</td><td>Krankenkassen (AOK, Ersatzkassen …)</td><td>Behandlung, Medikamente, ab der 7. Woche Krankengeld (70 % des Bruttos, höchstens 90 % des Nettos)</td></tr>
    <tr><td>Pflege</td><td>Pflegekassen bei den Krankenkassen</td><td>Pflegegeld oder Sachleistungen je nach Pflegegrad 1–5</td></tr>
    <tr><td>Renten</td><td>Deutsche Rentenversicherung</td><td>Altersrente (Regelaltersgrenze steigt schrittweise auf 67 Jahre), Erwerbsminderungsrente, Reha</td></tr>
    <tr><td>Arbeitslosen</td><td>Bundesagentur für Arbeit</td><td>Arbeitslosengeld I (60 %, mit Kind 67 % des pauschalierten Nettos), Vermittlung, Weiterbildung und Umschulung</td></tr>
    <tr><td>Unfall</td><td>Berufsgenossenschaften, Unfallkassen</td><td>Leistungen nach Arbeits- und Wegeunfällen sowie Berufskrankheiten, Prävention</td></tr>
  </tbody>
</table>
<p>Arbeitslosengeld I gibt es nur, wer in den letzten 30 Monaten mindestens 12 Monate versicherungspflichtig gearbeitet hat (Anwartschaftszeit) und sich rechtzeitig arbeitssuchend meldet – spätestens drei Monate vor Ende des Arbeitsverhältnisses oder, wenn man es später erfährt, innerhalb von drei Tagen.</p>

<h6>Steuerklassen</h6>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th>Klasse</th><th>für</th></tr></thead>
  <tbody>
    <tr><td>I</td><td>Ledige, Geschiedene, dauernd getrennt Lebende</td></tr>
    <tr><td>II</td><td>Alleinerziehende (Entlastungsbetrag)</td></tr>
    <tr><td>III / V</td><td>Verheiratete mit sehr unterschiedlichem Einkommen: III für den höheren, V für den niedrigeren Verdienst</td></tr>
    <tr><td>IV / IV</td><td>Verheiratete mit ähnlichem Einkommen (auch mit Faktor)</td></tr>
    <tr><td>VI</td><td>zweites und jedes weitere Arbeitsverhältnis</td></tr>
  </tbody>
</table>

<h6>Minijob und Midijob 2026</h6>
<ul>
  <li><strong>Minijob</strong>: bis 603 € im Monat (gekoppelt an den Mindestlohn von 13,90 €; das entspricht rund 43 Stunden). Der Arbeitgeber zahlt pauschal 13 % Kranken-, 15 % Rentenversicherung und 2 % Pauschsteuer; die Beschäftigten tragen 3,6 % zur Rentenversicherung bei, können sich davon aber befreien lassen.</li>
  <li><strong>Midijob</strong> (Übergangsbereich): 603,01 € bis 2.000 €. Volle Versicherung, aber reduzierte Arbeitnehmerbeiträge, die gleitend auf den normalen Satz ansteigen.</li>
</ul>

<h6>Einkommensteuererklärung</h6>
<p>Die Lohnsteuer ist eine Vorauszahlung auf die Einkommensteuer. In der Steuererklärung kann man mehr Kosten geltend machen, als der Arbeitgeber berücksichtigen konnte – oft gibt es Geld zurück.</p>
<ul>
  <li><strong>Grundfreibetrag</strong> 2026: 12.348 € – bis dahin bleibt das zu versteuernde Einkommen steuerfrei.</li>
  <li><strong>Werbungskosten</strong> (Kosten, um Einnahmen zu erzielen): Fahrten zur Arbeit, Arbeitsmittel (Laptop, Fachbücher), Fortbildungen, Bewerbungen. Ohne Nachweis wird der <strong>Arbeitnehmer-Pauschbetrag</strong> von 1.230 € abgezogen; höhere Kosten lohnen sich nur mit Belegen.</li>
  <li><strong>Entfernungspauschale</strong> seit 2026: 0,38 € je Kilometer der einfachen Strecke, ab dem ersten Kilometer. <strong>Homeoffice-Pauschale</strong>: 6 € je Tag, höchstens 1.260 € im Jahr. Für denselben Tag gibt es in der Regel nur eine der beiden Pauschalen.</li>
  <li><strong>Sonderausgaben</strong> (z. B. Vorsorgeaufwendungen, Kirchensteuer, Spenden) und außergewöhnliche Belastungen mindern das Einkommen zusätzlich.</li>
</ul>

<h6>Drei Säulen der Altersvorsorge</h6>
<ul>
  <li><strong>Gesetzlich</strong>: Rentenversicherung im Umlageverfahren. Wegen des demografischen Wandels (mehr Rentner je Beitragszahler) reicht sie allein meist nicht, um den Lebensstandard zu halten.</li>
  <li><strong>Betrieblich</strong>: Betriebsrente, oft per <em>Entgeltumwandlung</em> – ein Teil des Bruttos fließt steuer- und abgabenbegünstigt in die Vorsorge. Spart der Arbeitgeber dabei Sozialabgaben, muss er in der Regel 15 % dazugeben.</li>
  <li><strong>Privat</strong>: eigene Vorsorge, z. B. Fondssparplan oder staatlich geförderte Verträge.</li>
</ul>
<p class="lf-merke"><strong>Merke:</strong> Rentenversicherung 18,6 %, Arbeitslosenversicherung 2,6 %, Krankenversicherung 14,6 % + Zusatzbeitrag, Pflegeversicherung 3,6 % (+0,6 % für Kinderlose, allein von den Beschäftigten getragen) – die Unfallversicherung zahlt der Arbeitgeber allein.</p>

<h6>Übungen mit Lösung</h6>
<p>1. Ein Mitarbeiter verdient 7.000 € brutto, ist kinderlos und 30 Jahre alt (Zusatzbeitrag 2,9 %). Berechne seine Arbeitnehmeranteile zur Sozialversicherung.</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Kranken: 8,75 % von 5.812,50 € = 508,59 €. Pflege: 2,4 % von 5.812,50 € = 139,50 €. Rente: 9,3 % von 7.000 € = 651,00 €. Arbeitslosigkeit: 1,3 % von 7.000 € = 91,00 €. Summe: 1.390,09 €.</p>
</details>
<p>2. Eine Studentin arbeitet als Minijobberin für 600 € im Monat. Welche Abgaben zahlt der Arbeitgeber, welche sie selbst, wenn sie sich nicht befreien lässt?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Arbeitgeber: 13 % Kranken = 78,00 €, 15 % Rente = 90,00 €, 2 % Pauschsteuer = 12,00 € (plus Umlagen). Sie selbst: 3,6 % Rente = 21,60 €.</p>
</details>
<p>3. Ein Entwickler fährt an 200 Tagen 18 km zur Arbeit und arbeitet an 40 weiteren Tagen im Homeoffice. Lohnen sich Belege für die Werbungskosten, wenn er sonst keine hat?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Fahrten: 200 · 18 km · 0,38 € = 1.368 €. Homeoffice: 40 · 6 € = 240 €. Summe 1.608 € – das liegt über dem Pauschbetrag von 1.230 €, die Einzelaufstellung bringt 378 € mehr Werbungskosten.</p>
</details>
<p>4. Welcher Versicherungszweig zahlt nach einem Unfall auf dem direkten Weg zur Arbeit? Wer trägt dessen Beiträge?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Die gesetzliche Unfallversicherung (Berufsgenossenschaft), denn Wegeunfälle sind versichert. Die Beiträge trägt der Arbeitgeber allein.</p>
</details>
INHALT,
    'summary' => [
        'Brutto − Lohnsteuer − Kirchensteuer (− Soli) − Arbeitnehmeranteile zur Sozialversicherung = Netto.',
        '2026: Rente 18,6 %, Arbeitslosigkeit 2,6 %, Kranken 14,6 % + Ø 2,9 %, Pflege 3,6 % (+0,6 % Kinderlose) – meist je zur Hälfte.',
        'Beitragsbemessungsgrenzen 2026: 5.812,50 € (Kranken/Pflege), 8.450 € (Rente/Arbeitslosigkeit) im Monat.',
        'Prinzipien: Pflichtversicherung, Solidarität, Umlageverfahren, Selbstverwaltung; Unfallversicherung zahlt der Arbeitgeber.',
        'Minijob bis 603 €, Midijob bis 2.000 €; Mindestlohn 13,90 €.',
        'Steuererklärung: Grundfreibetrag 12.348 €, Pauschbetrag 1.230 €, Entfernungspauschale 0,38 € ab dem 1. km, Homeoffice 6 € pro Tag.',
    ],
    'quiz' => [
        ['question' => 'Wie hoch ist der Beitragssatz zur Rentenversicherung 2026?', 'answer' => '18,6 %, je zur Hälfte von Arbeitgeber und Beschäftigten.'],
        ['question' => 'Was bedeutet Beitragsbemessungsgrenze?', 'answer' => 'Bis zu diesem Einkommen werden Beiträge erhoben; darüber liegendes Einkommen ist beitragsfrei.'],
        ['question' => 'Wer trägt die Beiträge zur gesetzlichen Unfallversicherung?', 'answer' => 'Der Arbeitgeber allein.'],
        ['question' => 'Wie hoch ist der Arbeitnehmer-Pauschbetrag?', 'answer' => '1.230 € im Jahr.'],
    ],
];
