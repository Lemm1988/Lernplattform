<?php
return [
    'title' => 'Priorisierung, Service Level Agreements und Kennzahlen',
    'intro' => 'Welches Ticket zuerst? Und was hat die IT eigentlich versprochen? Prioritätsmatrix und SLA geben die Antwort – und Kennzahlen zeigen, ob das Versprechen gehalten wird. Hier wird auch gerechnet.',
    'goals' => [
        'die Priorität aus Auswirkung und Dringlichkeit bestimmen',
        'Inhalte eines SLA nennen und SLA, OLA und UC abgrenzen',
        'Reaktions- und Lösungsfristen unter Berücksichtigung der Servicezeiten berechnen',
        'Verfügbarkeiten berechnen, auch für hintereinander und parallel geschaltete Komponenten',
        'Service-Kennzahlen berechnen und interpretieren',
    ],
    'content' => <<<'INHALT'
<h6>Priorität = Auswirkung × Dringlichkeit</h6>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf6/prioritaetsmatrix.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Drei-mal-drei-Matrix aus Auswirkung und Dringlichkeit mit Prioritäten von 1 kritisch bis 5 planbar und Beispielen">
  <figcaption class="figure-caption">Zwei Fragen ergeben die Priorität</figcaption>
</figure>
<p>Jeder Priorität sind Zielzeiten zugeordnet. Ein Beispiel, wie es in einem SLA stehen könnte:</p>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th>Priorität</th><th>Reaktionszeit</th><th>Lösungszeit</th></tr></thead>
  <tbody>
    <tr><td>1 kritisch</td><td>15 Minuten</td><td>4 Stunden</td></tr>
    <tr><td>2 hoch</td><td>30 Minuten</td><td>8 Stunden</td></tr>
    <tr><td>3 mittel</td><td>2 Stunden</td><td>2 Arbeitstage</td></tr>
    <tr><td>4 niedrig</td><td>1 Arbeitstag</td><td>5 Arbeitstage</td></tr>
    <tr><td>5 planbar</td><td>2 Arbeitstage</td><td>nach Vereinbarung</td></tr>
  </tbody>
</table>
<p><strong>Reaktionszeit</strong>: bis eine qualifizierte Person mit der Bearbeitung beginnt (nicht die automatische Eingangsbestätigung).
<strong>Lösungszeit</strong>: bis der Service wiederhergestellt ist. Beide laufen in der Regel nur während der vereinbarten <strong>Servicezeit</strong>.</p>

<h6>Service Level Agreement</h6>
<p>Ein SLA ist eine Vereinbarung zwischen Service-Provider und Kunde über Leistung und Qualität eines Services. Typische Inhalte:</p>
<ul>
  <li>Beschreibung des Services und seiner Grenzen (was gehört dazu, was nicht)</li>
  <li>Servicezeiten (z. B. Mo–Fr 8–18 Uhr) und Erreichbarkeit des Service Desks</li>
  <li>Reaktions- und Lösungszeiten je Priorität, zugesagte Verfügbarkeit</li>
  <li>Mitwirkungspflichten des Kunden (z. B. Ansprechpartner benennen, Fernzugriff ermöglichen)</li>
  <li>Messverfahren, Berichte, Eskalationswege, Folgen bei Verfehlung (Vertragsstrafe oder Bonus-Malus), Laufzeit</li>
</ul>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf6/sla-ola-uc.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="SLA zwischen Kunde und IT, OLA zwischen IT und internem Netzwerkteam, Underpinning Contract zwischen IT und externem Hoster">
  <figcaption class="figure-caption">Interne und externe Vereinbarungen stützen das SLA</figcaption>
</figure>

<h6>Fristen berechnen</h6>
<p>Servicezeit Mo–Fr 8–18 Uhr, Reaktionszeit 2 Stunden. Ein Ticket kommt <strong>Freitag um 17:30 Uhr</strong>: Bis 18 Uhr laufen 30 Minuten, die restlichen
90 Minuten ab Montag 8 Uhr – die Frist endet <strong>Montag um 9:30 Uhr</strong>. Steht im SLA „24/7“, wäre es Freitag 19:30 Uhr.</p>

<h6>Verfügbarkeit</h6>
<p><strong>Verfügbarkeit = (vereinbarte Zeit − Ausfallzeit) ÷ vereinbarte Zeit × 100 %</strong>. Wie viel Ausfall eine Zusage erlaubt, zeigt die Tabelle (Monat mit 30 Tagen, rund um die Uhr):</p>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th>Verfügbarkeit</th><th>erlaubter Ausfall pro Monat</th><th>pro Jahr</th></tr></thead>
  <tbody>
    <tr><td>99 %</td><td>7,2 Stunden</td><td>87,6 Stunden</td></tr>
    <tr><td>99,5 %</td><td>3,6 Stunden</td><td>43,8 Stunden</td></tr>
    <tr><td>99,9 %</td><td>43,2 Minuten</td><td>8,76 Stunden</td></tr>
    <tr><td>99,99 %</td><td>4,32 Minuten</td><td>52,6 Minuten</td></tr>
  </tbody>
</table>
<p>Hängt ein Service von mehreren Komponenten ab, die <strong>alle</strong> laufen müssen (Reihe), werden die Verfügbarkeiten multipliziert: Server 99 % und Datenbank 99,5 %
ergeben 0,99 · 0,995 = 98,505 %. Sind zwei Komponenten <strong>redundant</strong> (parallel, eine reicht), ist der Dienst nur weg, wenn beide ausfallen:
1 − (0,01 · 0,01) = 99,99 % bei zwei Servern mit je 99 %.</p>

<h6>Kennzahlen</h6>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th>Kennzahl</th><th>Berechnung</th><th>Aussage</th></tr></thead>
  <tbody>
    <tr><td>Erstlösungsquote</td><td>beim ersten Kontakt gelöst ÷ alle Tickets</td><td>Wie gut ist der 1st Level ausgestattet?</td></tr>
    <tr><td>SLA-Erfüllungsquote</td><td>Tickets innerhalb der Frist ÷ alle Tickets</td><td>Wird das Versprechen gehalten?</td></tr>
    <tr><td>mittlere Lösungszeit</td><td>Summe der Lösungszeiten ÷ Anzahl</td><td>Wie lange warten Anwender im Schnitt?</td></tr>
    <tr><td>Wiedereröffnungsquote</td><td>wiedereröffnete ÷ gelöste Tickets</td><td>Wie nachhaltig sind die Lösungen?</td></tr>
    <tr><td>Rückstand (Backlog)</td><td>offene Tickets zu einem Stichtag</td><td>Reicht die Kapazität?</td></tr>
    <tr><td>Kundenzufriedenheit</td><td>Umfrage nach Abschluss, z. B. 1–5 Sterne</td><td>Wie wird der Service erlebt?</td></tr>
  </tbody>
</table>
<div class="lf-merke"><strong>Merke:</strong> Eine einzelne Kennzahl kann täuschen. Wer nur die Lösungszeit misst, verleitet zum schnellen Schließen – dann steigt die Wiedereröffnungsquote.
Kennzahlen deshalb immer gemeinsam betrachten.</div>

<h6>Übungen mit Lösung</h6>
<p>1. Bestimme die Priorität: Der Webshop eines Händlers nimmt keine Bestellungen mehr an, es ist Black Friday.</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Auswirkung hoch (alle Kunden, Hauptumsatz), Dringlichkeit hoch (jede Minute kostet Umsatz) → Priorität 1.</p>
</details>
<p>2. Ein Server war im April (30 Tage, 24/7 vereinbart) insgesamt 2 Stunden 15 Minuten ausgefallen. Welche Verfügbarkeit ergibt sich, und ist eine Zusage von 99,9 % eingehalten?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">30 · 24 · 60 = 43.200 Minuten; Ausfall 135 Minuten. (43.200 − 135) ÷ 43.200 = 99,688 %. Die Zusage von 99,9 % (höchstens 43,2 Minuten) ist verfehlt,
99,5 % (216 Minuten) wären eingehalten.</p>
</details>
<p>3. Von 500 Tickets im Monat wurden 340 beim ersten Kontakt gelöst; 108 von 120 Priorität-2-Tickets lagen innerhalb der Lösungszeit. Berechne Erstlösungsquote und SLA-Erfüllung für P2.</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Erstlösungsquote 340 ÷ 500 = 68 %. SLA-Erfüllung P2: 108 ÷ 120 = 90 %.</p>
</details>
<p>4. Der Hoster garantiert im Underpinning Contract eine Wiederherstellung in 8 Stunden. Das SLA mit dem Kunden verspricht für Priorität 1 eine Lösungszeit von 4 Stunden. Was ist falsch?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Der UC stützt das SLA nicht: Fällt der Hoster aus, kann die IT die 4 Stunden nicht einhalten. Entweder den UC nachverhandeln, eine Ausweichlösung schaffen oder das SLA anpassen.</p>
</details>
INHALT,
    'summary' => [
        'Priorität ergibt sich aus Auswirkung und Dringlichkeit, nicht aus der Lautstärke des Anrufers.',
        'SLA (mit dem Kunden), OLA (intern), UC (mit Lieferanten) – OLA und UC müssen das SLA stützen.',
        'Fristen laufen meist nur in der Servicezeit; Reaktion ≠ Lösung.',
        'Verfügbarkeit = (Sollzeit − Ausfall) ÷ Sollzeit; Reihe: multiplizieren; parallel: 1 − Produkt der Ausfallwahrscheinlichkeiten.',
        'Kennzahlen wie Erstlösungsquote, SLA-Erfüllung und Wiedereröffnungsquote gemeinsam betrachten.',
    ],
    'quiz' => [
        ['question' => 'Aus welchen zwei Größen ergibt sich die Priorität?', 'answer' => 'Aus Auswirkung (Impact) und Dringlichkeit (Urgency).'],
        ['question' => 'Wie viel Ausfall erlaubt eine Verfügbarkeit von 99,9 % in einem 30-Tage-Monat?', 'answer' => '43,2 Minuten.'],
        ['question' => 'Was ist ein OLA?', 'answer' => 'Ein Operational Level Agreement – eine interne Vereinbarung zwischen IT-Teams, die das SLA stützt.'],
        ['question' => 'Wie berechnet man die Verfügbarkeit zweier in Reihe geschalteter Komponenten?', 'answer' => 'Man multipliziert ihre Einzelverfügbarkeiten.'],
    ],
];
