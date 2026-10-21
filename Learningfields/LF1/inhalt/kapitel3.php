<?php
return [
    'title' => 'Das Unternehmen: Ziele, Kennzahlen, Umfeld',
    'intro' => 'Wer seinen Ausbildungsbetrieb beschreiben soll, braucht mehr als die Mitarbeiterzahl: Was will das Unternehmen erreichen, wer stellt Ansprüche an es, wie misst man Erfolg und wo steht es in der Wirtschaft?',
    'goals' => [
        'ökonomische, ökologische und soziale Unternehmensziele unterscheiden und Zielbeziehungen erkennen',
        'Anspruchsgruppen und ihre Interessen benennen',
        'Produktivität, Wirtschaftlichkeit und Rentabilität berechnen',
        'Unternehmen den Wirtschaftssektoren zuordnen und Formen der Arbeitsteilung erklären',
        'Leitbild und Standortfaktoren eines Unternehmens beschreiben',
    ],
    'content' => <<<'INHALT'
<h6>Unternehmensziele</h6>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf1/unternehmensziele.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Ökonomische, ökologische und soziale Ziele mit Beispielen; darunter Zielharmonie, Zielkonflikt und Zielneutralität">
  <figcaption class="figure-caption">Drei Zielbereiche, die sich ergänzen oder widersprechen können</figcaption>
</figure>
<p>Das <strong>ökonomische Prinzip</strong> beschreibt, wie wirtschaftlich gehandelt wird: Beim <strong>Maximalprinzip</strong> holt man mit gegebenen Mitteln das bestmögliche Ergebnis
heraus (mit 50.000 € Budget so viele Arbeitsplätze wie möglich ausstatten), beim <strong>Minimalprinzip</strong> erreicht man ein festes Ziel mit möglichst geringem Einsatz
(20 Arbeitsplätze so günstig wie möglich).</p>
<p>Ein <strong>Leitbild</strong> fasst Werte und Selbstverständnis zusammen („Wir machen IT verständlich – fair, sicher, nachhaltig“). Es soll Orientierung geben und nach innen wie außen wirken.</p>

<h6>Anspruchsgruppen</h6>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf1/stakeholder.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Unternehmen in der Mitte, links interne Anspruchsgruppen Eigentümer, Geschäftsleitung, Mitarbeitende, rechts externe Kunden, Lieferanten, Banken, Staat und Gesellschaft mit ihren Interessen">
  <figcaption class="figure-caption">Stakeholder mit unterschiedlichen Interessen</figcaption>
</figure>

<h6>Erfolg messen</h6>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th>Kennzahl</th><th>Formel</th><th>Beispiel (IT-Dienstleister)</th></tr></thead>
  <tbody>
    <tr><td>Produktivität</td><td>Ausbringungsmenge ÷ Einsatzmenge</td><td>1440 Tickets ÷ (4 Personen × 160 h) = 2,25 Tickets je Stunde</td></tr>
    <tr><td>Wirtschaftlichkeit</td><td>Ertrag ÷ Aufwand</td><td>1.200.000 € ÷ 1.140.000 € ≈ 1,05 (über 1 = wirtschaftlich)</td></tr>
    <tr><td>Eigenkapitalrentabilität</td><td>Gewinn ÷ Eigenkapital × 100</td><td>60.000 € ÷ 400.000 € × 100 = 15 %</td></tr>
    <tr><td>Umsatzrentabilität</td><td>Gewinn ÷ Umsatz × 100</td><td>60.000 € ÷ 1.200.000 € × 100 = 5 %</td></tr>
    <tr><td>Gesamtkapitalrentabilität</td><td>(Gewinn + Fremdkapitalzinsen) ÷ Gesamtkapital × 100</td><td>(60.000 € + 24.000 €) ÷ 1.000.000 € × 100 = 8,4 %</td></tr>
  </tbody>
</table>
<p>Produktivität rechnet in Mengen, Wirtschaftlichkeit in Werten, Rentabilität setzt den Gewinn ins Verhältnis zum eingesetzten Kapital. Eine Eigenkapitalrentabilität
lohnt sich nur, wenn sie über dem liegt, was das Geld sicher angelegt bringen würde.</p>

<h6>Das Unternehmen in der Wirtschaft</h6>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th>Sektor</th><th>Tätigkeit</th><th>Beispiel</th></tr></thead>
  <tbody>
    <tr><td>primär</td><td>Urproduktion</td><td>Landwirtschaft, Bergbau</td></tr>
    <tr><td>sekundär</td><td>Weiterverarbeitung</td><td>Industrie, Handwerk – etwa ein Hersteller von Netzwerktechnik</td></tr>
    <tr><td>tertiär</td><td>Dienstleistungen</td><td>Handel, Banken, IT-Dienstleister</td></tr>
    <tr><td>quartär</td><td>Information und Wissen</td><td>Softwareentwicklung, Beratung, Forschung (oft zum tertiären Sektor gezählt)</td></tr>
  </tbody>
</table>
<ul>
  <li><strong>Arbeitsteilung</strong>: <em>betrieblich</em> (Abteilungen, Spezialisierung im Team), <em>volkswirtschaftlich</em> (Betriebe spezialisieren sich auf Teile der Wertschöpfung),
    <em>international</em> (Entwicklung in Deutschland, Chipfertigung in Asien, Support in mehreren Zeitzonen). Vorteile: Spezialisierung, Produktivität; Nachteile: Abhängigkeit, lange Lieferketten, eintönige Arbeit.</li>
  <li><strong>Standortfaktoren</strong>: Verfügbarkeit von Fachkräften, Breitbandanbindung, Nähe zu Kunden, Mieten, Steuern und Förderung, Verkehrsanbindung, Lebensqualität.</li>
</ul>

<h6>Übungen mit Lösung</h6>
<p>1. Ein IT-Dienstleister erzielt 900.000 € Ertrag bei 840.000 € Aufwand; das Eigenkapital beträgt 300.000 €. Berechne Wirtschaftlichkeit und Eigenkapitalrentabilität.</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Wirtschaftlichkeit = 900.000 ÷ 840.000 ≈ 1,07. Gewinn = 60.000 €; Eigenkapitalrentabilität = 60.000 ÷ 300.000 × 100 = 20 %.</p>
</details>
<p>2. Die Geschäftsleitung will alte Server durch sparsame ersetzen. Welche Zielbeziehung liegt vor?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Langfristig Zielharmonie zwischen ökonomischen (geringere Stromkosten) und ökologischen Zielen (weniger Energie, CO₂). Kurzfristig kann ein Konflikt mit
der Liquidität bestehen, weil die Anschaffung Geld bindet.</p>
</details>
<p>3. Mit 30.000 € Budget sollen so viele Schulungsplätze wie möglich eingerichtet werden. Welches ökonomische Prinzip ist das?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Das Maximalprinzip: gegebener Mitteleinsatz, größtmögliches Ergebnis.</p>
</details>
INHALT,
    'summary' => [
        'Ziele: ökonomisch, ökologisch, sozial; Beziehungen: Harmonie, Konflikt, Neutralität.',
        'Maximalprinzip: mit gegebenen Mitteln maximaler Erfolg; Minimalprinzip: festes Ziel mit minimalem Einsatz.',
        'Anspruchsgruppen intern (Eigentümer, Leitung, Mitarbeitende) und extern (Kunden, Lieferanten, Banken, Staat, Gesellschaft).',
        'Produktivität = Menge ÷ Menge; Wirtschaftlichkeit = Ertrag ÷ Aufwand; Rentabilität = Gewinn ÷ Kapital × 100.',
        'Sektoren: primär, sekundär, tertiär, quartär; Arbeitsteilung betrieblich, volkswirtschaftlich, international.',
    ],
    'quiz' => [
        ['question' => 'Wie berechnet man die Wirtschaftlichkeit?', 'answer' => 'Ertrag ÷ Aufwand.'],
        ['question' => 'Was ist das Minimalprinzip?', 'answer' => 'Ein festgelegtes Ziel mit möglichst geringem Mitteleinsatz erreichen.'],
        ['question' => 'Wie hoch ist die Eigenkapitalrentabilität bei 60.000 € Gewinn und 400.000 € Eigenkapital?', 'answer' => '15 %.'],
        ['question' => 'Zu welchem Wirtschaftssektor gehört ein IT-Dienstleister?', 'answer' => 'Zum tertiären Sektor (Dienstleistungen), teils auch als quartärer Sektor (Information) bezeichnet.'],
    ],
];
