<?php
return [
    'title' => 'Angebote vergleichen und kalkulieren',
    'intro' => 'Drei Lieferanten, drei Preise, drei verschiedene Rabatte – welches Angebot ist wirklich günstiger? Und zu welchem Preis kann ein Systemhaus das Gerät weiterverkaufen? Die Kalkulation gehört zum Pflichtprogramm der AP1.',
    'goals' => [
        'Angebote quantitativ mit der Bezugskalkulation vergleichen',
        'qualitative Kriterien in die Entscheidung einbeziehen',
        'einen Verkaufspreis mit der Handelskalkulation berechnen',
        'Skonto und Rabatt „im Hundert“ richtig rechnen',
        'Kalkulationszuschlag, Kalkulationsfaktor und Handelsspanne bestimmen',
    ],
    'content' => <<<'INHALT'
<h6>Angebote einholen</h6>
<p>Für eine Beschaffung werden in der Regel mehrere Angebote eingeholt – mit einer <strong>Anfrage</strong>, die genau beschreibt, was gebraucht wird (Menge, technische Mindestanforderungen,
Liefertermin). Nur so sind die Angebote vergleichbar. Eine Anfrage ist rechtlich unverbindlich; ein Angebot bindet den Anbieter dagegen, sofern es keine Freizeichnungsklausel
(„freibleibend“) enthält.</p>

<h6>Quantitativer Angebotsvergleich: die Bezugskalkulation</h6>
<p>Verglichen wird der <strong>Bezugspreis</strong> (Einstandspreis) – also was das Gerät tatsächlich kostet, wenn es im Haus ist:</p>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th></th><th>Lieferant A</th><th>Lieferant B</th><th>Lieferant C</th></tr></thead>
  <tbody>
    <tr><td>Listeneinkaufspreis</td><td>900,00 €</td><td>860,00 €</td><td>950,00 €</td></tr>
    <tr><td>− Rabatt</td><td>10 % = 90,00 €</td><td>5 % = 43,00 €</td><td>15 % = 142,50 €</td></tr>
    <tr><td>= Zieleinkaufspreis</td><td>810,00 €</td><td>817,00 €</td><td>807,50 €</td></tr>
    <tr><td>− Skonto</td><td>2 % = 16,20 €</td><td>3 % = 24,51 €</td><td>–</td></tr>
    <tr><td>= Bareinkaufspreis</td><td>793,80 €</td><td>792,49 €</td><td>807,50 €</td></tr>
    <tr><td>+ Bezugskosten</td><td>15,00 €</td><td>frei Haus</td><td>25,00 €</td></tr>
    <tr><td><strong>= Bezugspreis</strong></td><td><strong>808,80 €</strong></td><td><strong>792,49 €</strong></td><td><strong>832,50 €</strong></td></tr>
  </tbody>
</table>
<p>Den niedrigsten Listenpreis hat B, den höchsten Rabatt C – am günstigsten ist am Ende B. Skonto lohnt sich fast immer: 3 % für 20 Tage frühere Zahlung entsprechen
einem Jahreszins von über 50 %.</p>
<p><strong>Qualitativ</strong> zählen außerdem Lieferzeit, Zuverlässigkeit, Zahlungsbedingungen, Garantie und Service, Umweltaspekte und die bisherigen Erfahrungen.
Beides lässt sich in einer Nutzwertanalyse zusammenführen (<a href="/Learningfields/LF2/kapitel5.php">Kapitel 5</a>).</p>

<h6>Verkaufskalkulation</h6>
<p>Ein Systemhaus kauft das Notebook ein und verkauft es weiter. Auf den Bezugspreis kommen die eigenen Kosten (Handlungskosten: Personal, Miete, Lager …), der Gewinn,
die Nachlässe, die man dem Kunden gewährt, und die Umsatzsteuer:</p>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf2/kalkulationsschema.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Kalkulationsschema vom Listeneinkaufspreis 900 Euro bis zum Listenverkaufspreis brutto 1364,63 Euro mit allen Zwischenschritten">
  <figcaption class="figure-caption">Vom Listeneinkaufspreis zum Bruttoverkaufspreis</figcaption>
</figure>
<div class="lf-pruefung"><strong>Prüfungstipp:</strong> Beim Einkauf werden Rabatt und Skonto vom höheren Betrag abgezogen (<em>vom Hundert</em>). Beim Verkauf rechnet man rückwärts:
Kundenskonto und Kundenrabatt sollen sich auf den <em>späteren</em>, höheren Preis beziehen, deshalb <em>im Hundert</em> – Barverkaufspreis ÷ 98 × 100, nicht × 1,02.</div>

<h6>Kennzahlen der Kalkulation</h6>
<ul>
  <li><strong>Kalkulationszuschlag</strong> = (Listenverkaufspreis netto − Bezugspreis) ÷ Bezugspreis × 100 = (1146,75 − 808,80) ÷ 808,80 ≈ 41,78 %</li>
  <li><strong>Kalkulationsfaktor</strong> = Listenverkaufspreis netto ÷ Bezugspreis ≈ 1,4178 – mit ihm lässt sich jeder Bezugspreis schnell hochrechnen</li>
  <li><strong>Handelsspanne</strong> = (Listenverkaufspreis netto − Bezugspreis) ÷ Listenverkaufspreis netto × 100 ≈ 29,47 %</li>
</ul>
<p>Für Dienstleistungen wie Installation und Einrichtung kalkuliert man mit Stundensätzen; wie die entstehen, zeigt <a href="/Learningfields/LF12/kapitel3.php">LF12 Kapitel 3</a>.</p>

<h6>Übungen mit Lösung</h6>
<p>1. Lieferant D bietet einen Monitor für 320 € an, 8 % Rabatt, 2 % Skonto, 6,90 € Versand. Wie hoch ist der Bezugspreis?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">320 − 25,60 = 294,40 € Zieleinkaufspreis; − 5,89 € Skonto = 288,51 € Bareinkaufspreis; + 6,90 € = <strong>295,41 €</strong>.</p>
</details>
<p>2. Mit dem Kalkulationsfaktor 1,4178: Welcher Listenverkaufspreis netto ergibt sich für einen Bezugspreis von 295,41 €?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">295,41 € × 1,4178 ≈ <strong>418,83 €</strong> netto.</p>
</details>
<p>3. Warum wird der Kundenskonto „im Hundert“ und nicht „vom Hundert“ aufgeschlagen?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Der Kunde zieht den Skonto später vom Zielverkaufspreis ab. Damit danach genau der Barverkaufspreis übrig bleibt, muss der Barverkaufspreis 98 % des Zielverkaufspreises sein:
Zielverkaufspreis = Barverkaufspreis ÷ 0,98. Ein Aufschlag von 2 % wäre zu wenig.</p>
</details>
INHALT,
    'summary' => [
        'Angebote vergleicht man über den Bezugspreis: Listenpreis − Rabatt − Skonto + Bezugskosten.',
        'Qualitative Kriterien (Lieferzeit, Service, Zuverlässigkeit) gehören mit in die Entscheidung.',
        'Verkauf: Bezugspreis + Handlungskosten = Selbstkosten + Gewinn = Barverkaufspreis; Skonto und Rabatt im Hundert; + USt.',
        'Kalkulationszuschlag und Handelsspanne setzen dieselbe Differenz ins Verhältnis zum Bezugs- bzw. Verkaufspreis.',
        'Skonto lohnt sich fast immer – er entspricht einem sehr hohen Jahreszins.',
    ],
    'quiz' => [
        ['question' => 'Welcher Preis wird beim Angebotsvergleich verglichen?', 'answer' => 'Der Bezugspreis (Einstandspreis): Listenpreis − Rabatt − Skonto + Bezugskosten.'],
        ['question' => 'Was sind Handlungskosten?', 'answer' => 'Die Gemeinkosten des Handelsbetriebs wie Personal, Miete, Lager und Verwaltung.'],
        ['question' => 'Wie berechnet man den Zielverkaufspreis bei 2 % Kundenskonto?', 'answer' => 'Barverkaufspreis ÷ 98 × 100 (im Hundert).'],
        ['question' => 'Was ist der Kalkulationsfaktor?', 'answer' => 'Listenverkaufspreis netto ÷ Bezugspreis.'],
    ],
];
