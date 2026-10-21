<?php
return [
    'title' => 'Wirtschaftlich entscheiden: Make or Buy, Nutzwert, Amortisation',
    'intro' => 'Selbst entwickeln, mieten oder anpassen? Kostenvergleich, Nutzwertanalyse und Amortisationsrechnung machen die Entscheidung nachvollziehbar – genau so wird es in der Prüfung verlangt.',
    'goals' => [
        'Kriterien für Make-or-Buy-Entscheidungen nennen',
        'einen Kostenvergleich über einen festen Zeitraum aufstellen',
        'eine Nutzwertanalyse mit Gewichtung durchführen und interpretieren',
        'die Amortisationszeit einer Investition berechnen',
    ],
    'content' => <<<'INHALT'
<h6>Make or Buy</h6>
<p>Für die Terminbuchung der Fahrradwerkstatt gibt es drei Möglichkeiten:</p>
<ul>
  <li><strong>A – Eigenentwicklung</strong> (Individualsoftware): genau passend, aber teuer in der Erstellung.</li>
  <li><strong>B – Mietlösung (SaaS)</strong>: ein fertiger Online-Terminkalender gegen Monatsgebühr.</li>
  <li><strong>C – Standardsoftware anpassen</strong>: ein Plugin für die vorhandene WordPress-Seite plus Anpassungen.</li>
</ul>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th></th><th>Make (selbst entwickeln)</th><th>Buy (kaufen/mieten)</th></tr></thead>
  <tbody>
    <tr><th>Vorteile</th><td>passt genau zum Ablauf, volle Kontrolle über Daten und Weiterentwicklung, kein Lizenzrisiko</td><td>sofort verfügbar, geringe Anfangskosten, Wartung durch den Anbieter, erprobt</td></tr>
    <tr><th>Nachteile</th><td>hohe Anfangskosten, Entwicklungszeit, eigenes Know-how und Wartung nötig</td><td>Abhängigkeit (Lock-in), Anpassungen begrenzt, laufende Kosten, Datenschutz prüfen</td></tr>
  </tbody>
</table>

<h6>Kostenvergleich über drei Jahre</h6>
<table class="table table-sm table-bordered text-end">
  <thead class="table-light"><tr><th class="text-start">Kosten</th><th>A Eigenentwicklung</th><th>B SaaS</th><th>C Plugin + Anpassung</th></tr></thead>
  <tbody>
    <tr><td class="text-start">einmalig</td><td>18.000 €</td><td>500 € Einrichtung</td><td>4.000 € Anpassung</td></tr>
    <tr><td class="text-start">laufend</td><td>150 €/Monat Hosting, Wartung</td><td>89 €/Monat</td><td>199 €/Jahr Lizenz + 50 €/Monat Wartung</td></tr>
    <tr><td class="text-start">Rechnung</td><td>18.000 + 36 · 150</td><td>500 + 36 · 89</td><td>4.000 + 3 · 199 + 36 · 50</td></tr>
    <tr class="fw-bold"><td class="text-start">Summe 3 Jahre</td><td>23.400 €</td><td>3.704 €</td><td>6.397 €</td></tr>
  </tbody>
</table>
<p>Nach Kosten gewinnt klar die Mietlösung. Aber Kosten sind nicht alles: Kann der SaaS-Dienst die unterschiedlich langen Reparaturen abbilden? Wo liegen
die Kundendaten? Solche qualitativen Kriterien bewertet die Nutzwertanalyse.</p>

<h6>Nutzwertanalyse</h6>
<p>So gehst du vor:</p>
<ol>
  <li>Kriterien festlegen (aus den Anforderungen, <a href="/Learningfields/LF12/kapitel1.php">Kapitel 1</a>).</li>
  <li>Gewichte vergeben, die zusammen 100 % ergeben.</li>
  <li>Jede Alternative je Kriterium bewerten, hier mit Punkten von 1 (schlecht) bis 10 (sehr gut). Bei Kosten heißt „gut“: niedrig.</li>
  <li>Punkte × Gewicht rechnen und je Alternative aufsummieren.</li>
  <li>Ergebnis interpretieren und auf Plausibilität prüfen.</li>
</ol>
<table class="table table-sm table-bordered text-center">
  <thead class="table-light">
    <tr><th class="text-start" rowspan="2">Kriterium</th><th rowspan="2">Gewicht</th><th colspan="2">A Eigenentwicklung</th><th colspan="2">B SaaS</th><th colspan="2">C Plugin</th></tr>
    <tr><th>Punkte</th><th>gewichtet</th><th>Punkte</th><th>gewichtet</th><th>Punkte</th><th>gewichtet</th></tr>
  </thead>
  <tbody>
    <tr><td class="text-start">Anpassbarkeit an den Werkstattablauf</td><td>30 %</td><td>10</td><td>3,00</td><td>4</td><td>1,20</td><td>6</td><td>1,80</td></tr>
    <tr><td class="text-start">Kosten über 3 Jahre</td><td>25 %</td><td>3</td><td>0,75</td><td>9</td><td>2,25</td><td>7</td><td>1,75</td></tr>
    <tr><td class="text-start">Datenschutz / Hosting in der EU</td><td>20 %</td><td>9</td><td>1,80</td><td>5</td><td>1,00</td><td>8</td><td>1,60</td></tr>
    <tr><td class="text-start">Bedienbarkeit</td><td>15 %</td><td>8</td><td>1,20</td><td>8</td><td>1,20</td><td>6</td><td>0,90</td></tr>
    <tr><td class="text-start">Unabhängigkeit vom Anbieter</td><td>10 %</td><td>9</td><td>0,90</td><td>3</td><td>0,30</td><td>6</td><td>0,60</td></tr>
    <tr class="fw-bold"><td class="text-start">Nutzwert</td><td>100 %</td><td colspan="2">7,65</td><td colspan="2">5,95</td><td colspan="2">6,65</td></tr>
  </tbody>
</table>
<p>Die Eigenentwicklung erreicht den höchsten Nutzwert, weil die Werkstatt die Anpassbarkeit am stärksten gewichtet. Wichtig: Gewichte und Punkte sind
<strong>subjektiv</strong>. Deshalb legt man sie vor dem Vergleich und gemeinsam mit dem Auftraggeber fest und prüft, ob sich das Ergebnis bei leicht
anderen Gewichten umdreht (Sensitivität). Ein knapper Vorsprung ist kein klares Votum.</p>

<h6>Amortisationsrechnung</h6>
<p>Die Werkstatt will wissen: Wann hat sich die Investition von 18.000 € bezahlt gemacht? Dafür schätzt man den monatlichen Nutzen:</p>
<ul>
  <li>Weniger Telefonate: 25 Anrufe à 4 Minuten pro Tag, davon die Hälfte online → 50 Minuten pro Tag, bei 22 Arbeitstagen rund 18,3 Stunden im Monat.
  Bei 30 € Personalkosten pro Stunde sind das <strong>550 €</strong>.</li>
  <li>Weniger nicht erschienene Kunden dank Erinnerungsmail: geschätzt <strong>300 €</strong> zusätzlicher Deckungsbeitrag pro Monat.</li>
  <li>Abzüglich laufender Kosten von 150 € ergibt sich ein Netto-Rückfluss von <strong>700 € pro Monat</strong>.</li>
</ul>
<p class="text-center fs-6"><strong>Amortisationszeit = Investition ÷ Rückfluss pro Periode = 18.000 € ÷ 700 €/Monat ≈ 25,7 Monate</strong></p>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf12/amortisation.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Linie des kumulierten Rückflusses von minus 18.000 Euro, Nulldurchgang nach etwa 25,7 Monaten, plus 7.200 Euro nach 36 Monaten">
  <figcaption class="figure-caption">Ab dem Schnittpunkt mit der Nulllinie verdient die Investition Geld</figcaption>
</figure>
<p>Die <strong>statische</strong> Amortisationsrechnung ist einfach, berücksichtigt aber weder Zinsen noch, dass Geld heute mehr wert ist als in zwei Jahren.
Investitionen mit kurzer Amortisationszeit gelten als weniger riskant – die Zahl sagt aber nichts über die Erträge <em>nach</em> dem Break-even.</p>
<div class="lf-pruefung"><strong>Prüfungstipp:</strong> Nutzwertanalysen und Kostenvergleiche kommen in der AP2 regelmäßig vor. Schreib den Rechenweg hin
(Punkte × Gewicht), achte darauf, dass die Gewichte 100 % ergeben, und begründe die Empfehlung in ein, zwei Sätzen – auch dann, wenn sie nicht der
billigsten Lösung entspricht.</div>

<h6>Übungen mit Lösung</h6>
<p>1. Wie ändert sich der Nutzwert von B, wenn der SaaS-Anbieter beim Datenschutz nach einem Anbieterwechsel 9 statt 5 Punkte bekommt?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Datenschutz gewichtet 20 %: 9 · 0,20 = 1,80 statt 1,00, also + 0,80. Neuer Nutzwert B = 5,95 + 0,80 = <strong>6,75</strong> – jetzt knapp vor C (6,65),
aber weiter hinter A (7,65).</p>
</details>
<p>2. Eine neue Kassensoftware kostet 6.000 € und spart monatlich 400 € abzüglich 100 € Wartung. Nach wie vielen Monaten hat sie sich amortisiert?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">6.000 € ÷ (400 € − 100 €) = 6.000 € ÷ 300 € = <strong>20 Monate</strong>.</p>
</details>
<p>3. Nenne zwei Gründe, die trotz höherer Kosten für eine Eigenentwicklung sprechen können.</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Zum Beispiel: Kernprozess mit Wettbewerbsvorteil, der genau abgebildet werden muss; volle Kontrolle über Daten und Hosting (Datenschutz); keine
Abhängigkeit von Preisänderungen oder dem Fortbestand eines Anbieters; Integration in eigene Systeme.</p>
</details>
INHALT,
    'summary' => [
        'Make or Buy: Eigenentwicklung passt genau und bleibt unabhängig, Kauf/Miete ist schnell und günstig im Einstieg, aber mit Lock-in-Risiko.',
        'Kostenvergleich: einmalige plus laufende Kosten über denselben Zeitraum.',
        'Nutzwertanalyse: Kriterien, Gewichte (Summe 100 %), Punkte, Punkte × Gewicht, Summe, Interpretation.',
        'Statische Amortisationszeit = Investition ÷ Rückfluss pro Periode; im Beispiel ≈ 25,7 Monate.',
        'Gewichte und Bewertungen sind subjektiv – vorher festlegen, gemeinsam abstimmen, Empfehlung begründen.',
    ],
    'quiz' => [
        ['question' => 'Was ist das Ziel einer Nutzwertanalyse?', 'answer' => 'Alternativen anhand mehrerer, auch nicht in Geld messbarer Kriterien mit Gewichtung vergleichbar zu machen.'],
        ['question' => 'Wie berechnet man die statische Amortisationszeit?', 'answer' => 'Investitionsbetrag geteilt durch den (durchschnittlichen) Rückfluss pro Periode, z. B. 18.000 € ÷ 700 €/Monat ≈ 25,7 Monate.'],
        ['question' => 'Warum muss die Summe der Gewichte 100 % ergeben?', 'answer' => 'Damit die gewichteten Punkte vergleichbar sind und jedes Kriterium genau den vorgesehenen Anteil am Gesamtergebnis hat.'],
        ['question' => 'Nenne zwei Nachteile einer Mietlösung (SaaS).', 'answer' => 'Z. B. Abhängigkeit vom Anbieter (Lock-in), eingeschränkte Anpassbarkeit, dauerhafte laufende Kosten, Datenschutzfragen bei Speicherort und Zugriff.'],
    ],
];
