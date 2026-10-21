<?php
return [
    'title' => 'Aufwand schätzen, kalkulieren, anbieten',
    'intro' => 'Wie lange dauert das Projekt, und was darf es kosten? Mit Schätzverfahren, einer sauberen Kalkulation und dem passenden Vertrag wird aus dem Auftrag ein belastbares Angebot.',
    'goals' => [
        'Schätzverfahren (Experten, Analogie, Drei-Punkt, agile Schätzung) unterscheiden und anwenden',
        'einen Stundensatz kalkulieren und einen Angebotspreis berechnen',
        'die Bestandteile eines Angebots nennen',
        'Werkvertrag, Dienstvertrag, Kauf- und Mietvertrag sowie Festpreis und Aufwandsabrechnung unterscheiden',
    ],
    'content' => <<<'INHALT'
<h6>Aufwand schätzen</h6>
<p>Grundlage jeder Schätzung ist eine Zerlegung der Arbeit in <strong>Arbeitspakete</strong> (mehr dazu in Kapitel 4). Kleine Pakete lassen sich besser schätzen
als ein ganzes Projekt.</p>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th>Verfahren</th><th>Vorgehen</th><th>geeignet, wenn …</th></tr></thead>
  <tbody>
    <tr><td>Expertenschätzung</td><td>Erfahrene Entwickler schätzen; bei der <em>Delphi-Methode</em> mehrere unabhängig und in Runden, bis sich die Werte annähern</td><td>Erfahrung im Team vorhanden</td></tr>
    <tr><td>Analogieverfahren</td><td>Vergleich mit ähnlichen abgeschlossenen Projekten</td><td>Daten früherer Projekte existieren</td></tr>
    <tr><td>Drei-Punkt-Schätzung (PERT)</td><td>je Paket optimistisch (O), wahrscheinlich (M), pessimistisch (P); Erwartungswert (O + 4M + P) ÷ 6</td><td>Unsicherheit soll sichtbar werden</td></tr>
    <tr><td>Function-Point-Analyse</td><td>Funktionen (Eingaben, Ausgaben, Abfragen, Datenbestände) zählen und gewichten</td><td>große Projekte, frühe Phase</td></tr>
    <tr><td>Agile Schätzung</td><td>relative Größe in Story Points, z. B. mit Planning Poker; Dauer über die Velocity</td><td>Scrum-Projekte (siehe <a href="/Learningfields/Scrum/schaetzung_velocity.php">Schätzung und Velocity</a>)</td></tr>
  </tbody>
</table>
<p>Drei-Punkt-Schätzung für die Terminbuchung (Werte in Personentagen, PT):</p>
<table class="table table-sm table-bordered text-center">
  <thead class="table-light"><tr><th class="text-start">Arbeitspaket</th><th>O</th><th>M</th><th>P</th><th>(O + 4M + P) ÷ 6</th></tr></thead>
  <tbody>
    <tr><td class="text-start">Analyse und Pflichtenheft</td><td>2</td><td>3</td><td>5</td><td>3,17</td></tr>
    <tr><td class="text-start">Datenbank und Backend</td><td>4</td><td>6</td><td>10</td><td>6,33</td></tr>
    <tr><td class="text-start">Buchungsoberfläche</td><td>4</td><td>5</td><td>8</td><td>5,33</td></tr>
    <tr><td class="text-start">Werkstatt-Kalender</td><td>3</td><td>4</td><td>7</td><td>4,33</td></tr>
    <tr><td class="text-start">E-Mail-Erinnerung</td><td>1</td><td>1,5</td><td>3</td><td>1,67</td></tr>
    <tr><td class="text-start">Tests</td><td>2</td><td>3</td><td>5</td><td>3,17</td></tr>
    <tr><td class="text-start">Einführung und Dokumentation</td><td>1</td><td>2</td><td>3</td><td>2,00</td></tr>
    <tr class="fw-bold"><td class="text-start">Summe</td><td></td><td></td><td></td><td>26,00 PT = 208 h</td></tr>
  </tbody>
</table>
<p>Weil die pessimistischen Werte weiter vom Mittel entfernt liegen als die optimistischen, liegt der Erwartungswert über der Summe der wahrscheinlichsten
Werte (24,5 PT). Genau das ist gewollt: Projekte dauern erfahrungsgemäß eher länger als kürzer.</p>

<h6>Vom Gehalt zum Stundensatz</h6>
<p>Ein Stundensatz muss nicht nur das Gehalt decken, sondern auch Lohnnebenkosten, nicht abrechenbare Zeiten, Gemeinkosten und einen Gewinn. Beispiel:
4.200 € Bruttogehalt im Monat, 21 % Arbeitgeberanteil zur Sozialversicherung, 1.500 abrechenbare Stunden im Jahr (nach Urlaub, Krankheit, Schulung,
internen Aufgaben).</p>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf12/kalkulation.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Kalkulation: 60.984 € Personalkosten ÷ 1.500 h = 40,66 €, plus 60 % Gemeinkosten = 65,06 €, plus 10 % Gewinn = 71,57 €, mal 208 h = 14.886,56 € netto, plus 19 % USt = 17.715,01 € brutto">
  <figcaption class="figure-caption">Zuschlagskalkulation – jeder Schritt auf Cent gerundet</figcaption>
</figure>
<p>Rechenweg: 4.200 € × 12 × 1,21 = 60.984 € Personalkosten im Jahr. 60.984 € ÷ 1.500 h = 40,66 €/h. Gemeinkostenzuschlag 60 %: 24,40 € → Selbstkosten
65,06 €/h. Gewinnzuschlag 10 %: 6,51 € → <strong>Stundensatz 71,57 € netto</strong>. Angebot: 208 h × 71,57 € = <strong>14.886,56 € netto</strong>,
zuzüglich 19 % Umsatzsteuer 2.828,45 € = 17.715,01 € brutto. Das liegt im Budget der Werkstatt von 18.000 €.</p>

<h6>Das Angebot</h6>
<p>Ein Angebot ist eine verbindliche Willenserklärung: Nimmt der Kunde es unverändert an, ist der Vertrag geschlossen. Es enthält mindestens:</p>
<ul>
  <li>Anbieter und Empfänger, Datum, Angebotsnummer</li>
  <li><strong>Leistungsbeschreibung</strong> (Bezug auf Lastenheft/Pflichtenheft, Abgrenzung: was ist <em>nicht</em> enthalten)</li>
  <li>Preis (netto, Umsatzsteuer, brutto), Abrechnungsart, ggf. Rabatte</li>
  <li>Liefer- bzw. Fertigstellungstermin, Mitwirkungspflichten des Kunden</li>
  <li>Zahlungsbedingungen (z. B. 30 % bei Auftrag, 70 % nach Abnahme), Gültigkeit des Angebots, Verweis auf AGB</li>
</ul>

<h6>Vertragsarten und Abrechnung</h6>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th>Vertrag</th><th>geschuldet ist …</th><th>typisch für</th></tr></thead>
  <tbody>
    <tr><td>Werkvertrag (§ 631 BGB)</td><td>ein <strong>Erfolg</strong>, das fertige Werk; mit Abnahme und Mängelrechten (LF8 Kapitel 14)</td><td>Individualsoftware zum Festpreis</td></tr>
    <tr><td>Dienstvertrag (§ 611 BGB)</td><td>eine <strong>Tätigkeit</strong>, kein bestimmtes Ergebnis</td><td>Beratung, Schulung, Support, Entwickler „nach Stunden“</td></tr>
    <tr><td>Kaufvertrag (§ 433 BGB)</td><td>Übergabe und Eigentum an einer Sache bzw. dauerhafte Überlassung</td><td>Standardsoftware mit Dauerlizenz, Hardware</td></tr>
    <tr><td>Mietvertrag (§ 535 BGB)</td><td>Gebrauchsüberlassung auf Zeit</td><td>SaaS, Software-Abonnement, Cloud-Server</td></tr>
  </tbody>
</table>
<p><strong>Festpreis</strong>: Der Preis steht vorher fest, das Risiko für Mehraufwand trägt der Auftragnehmer – daher saubere Leistungsbeschreibung und
Änderungsmanagement (Kapitel 5). <strong>Nach Aufwand</strong> (Time &amp; Material): abgerechnet werden die tatsächlich geleisteten Stunden – flexibel, das
Kostenrisiko liegt beim Kunden. Agile Projekte werden häufig nach Aufwand oder mit festem Budget pro Sprint abgerechnet.</p>

<h6>Übungen mit Lösung</h6>
<p>1. Berechne den PERT-Erwartungswert für ein Paket mit O = 3, M = 5, P = 13 Tagen.</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">(3 + 4 · 5 + 13) ÷ 6 = 36 ÷ 6 = <strong>6 Tage</strong> – deutlich mehr als der wahrscheinlichste Wert, weil das Risiko nach oben groß ist.</p>
</details>
<p>2. Ein Entwickler kostet im Jahr 72.000 € bei 1.600 abrechenbaren Stunden. Gemeinkosten 50 %, Gewinn 10 %. Wie hoch ist der Stundensatz netto?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">72.000 ÷ 1.600 = 45,00 €; + 50 % = 67,50 €; + 10 % = <strong>74,25 €</strong> netto.</p>
</details>
<p>3. Ein Kunde will „einen erfahrenen Entwickler für drei Monate, der unser Team unterstützt“. Welcher Vertrag passt?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Ein Dienstvertrag: Geschuldet ist die Mitarbeit, kein bestimmtes Werk. (Achtung in der Praxis: Bei Eingliederung in die Organisation des Kunden
droht Scheinselbstständigkeit bzw. verdeckte Arbeitnehmerüberlassung.)</p>
</details>
INHALT,
    'summary' => [
        'Schätzen auf Basis von Arbeitspaketen: Experten/Delphi, Analogie, Drei-Punkt (O + 4M + P) ÷ 6, Function Points, Story Points.',
        'Stundensatz: Personalkosten ÷ abrechenbare Stunden + Gemeinkosten + Gewinn; Angebot = Stunden × Satz + Umsatzsteuer.',
        'Angebot: Leistungsbeschreibung mit Abgrenzung, Preis, Termine, Zahlungsbedingungen, Gültigkeit.',
        'Werkvertrag schuldet Erfolg (Abnahme), Dienstvertrag Tätigkeit, Kauf Übereignung, Miete Gebrauch auf Zeit.',
        'Festpreis: Risiko beim Auftragnehmer; nach Aufwand: Risiko beim Kunden.',
    ],
    'quiz' => [
        ['question' => 'Wie lautet die Formel der Drei-Punkt-Schätzung nach PERT?', 'answer' => 'Erwartungswert = (optimistisch + 4 · wahrscheinlich + pessimistisch) ÷ 6.'],
        ['question' => 'Was unterscheidet Werkvertrag und Dienstvertrag?', 'answer' => 'Beim Werkvertrag ist ein Erfolg (das fertige Werk) geschuldet, beim Dienstvertrag nur die Tätigkeit.'],
        ['question' => 'Warum ist der Stundensatz deutlich höher als Gehalt ÷ Arbeitsstunden?', 'answer' => 'Weil Lohnnebenkosten, nicht abrechenbare Zeiten, Gemeinkosten (Büro, Software, Verwaltung) und ein Gewinn gedeckt werden müssen.'],
        ['question' => 'Wer trägt beim Festpreis das Risiko für Mehraufwand?', 'answer' => 'Der Auftragnehmer – deshalb sind eine klare Leistungsbeschreibung und ein geregeltes Änderungsmanagement wichtig.'],
    ],
];
