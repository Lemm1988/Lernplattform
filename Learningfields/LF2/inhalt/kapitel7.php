<?php
return [
    'title' => 'Wirtschaftlichkeit: Stromkosten, Finanzierung, Abschreibung',
    'intro' => 'Ob 25 neue Arbeitsplätze gekauft, finanziert oder geleast werden, entscheidet die Geschäftsleitung – aber sie braucht dafür belastbare Zahlen. Die liefert, wer Strom-, Zins- und Abschreibungsrechnungen beherrscht.',
    'goals' => [
        'Energieverbrauch und Stromkosten von IT-Geräten berechnen',
        'Kauf, Kredit, Leasing und Miete vergleichen',
        'Annuitäten- und Tilgungsdarlehen berechnen',
        'lineare Abschreibung und Sonderregeln für geringwertige Wirtschaftsgüter anwenden',
    ],
    'content' => <<<'INHALT'
<h6>Stromkosten</h6>
<p><strong>Energie (kWh) = Leistung (W) × Betriebsstunden ÷ 1000</strong>, <strong>Kosten = Energie × Strompreis</strong>.</p>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th>Schritt</th><th>Rechnung</th><th>Ergebnis</th></tr></thead>
  <tbody>
    <tr><td>Betrieb</td><td>80 W × 8 h × 220 Tage ÷ 1000</td><td>140,8 kWh</td></tr>
    <tr><td>Standby</td><td>2 W × (8760 h − 1760 h) ÷ 1000</td><td>14,0 kWh</td></tr>
    <tr><td>Summe</td><td>154,8 kWh × 0,35 €/kWh</td><td><strong>54,18 € pro Jahr</strong></td></tr>
  </tbody>
</table>
<p>Ohne Standby wären es 49,28 €. Für 25 Arbeitsplätze summiert sich schon der Betrieb auf 1232 € im Jahr. Sparsame Geräte, Energiesparoptionen, automatische Abschaltung
nach Feierabend und schaltbare Steckdosenleisten senken die Kosten – und gehören zur Nachhaltigkeit des Arbeitsplatzes.</p>

<h6>Finanzierung</h6>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th>Form</th><th>Vorteile</th><th>Nachteile</th></tr></thead>
  <tbody>
    <tr><td>Kauf aus Eigenmitteln</td><td>keine Zinsen, Eigentum, freie Nutzung</td><td>hoher Liquiditätsabfluss, Technik veraltet im eigenen Bestand</td></tr>
    <tr><td>Kauf mit Kredit</td><td>Eigentum, Kosten über die Laufzeit verteilt</td><td>Zinsen, Kreditwürdigkeit nötig</td></tr>
    <tr><td>Leasing</td><td>planbare Raten, oft mit Service, Austausch nach Laufzeit</td><td>insgesamt meist teurer, Vertragsbindung, Rückgabe in gutem Zustand</td></tr>
    <tr><td>Miete / Device as a Service</td><td>sehr flexibel, kurzfristig</td><td>auf Dauer am teuersten</td></tr>
  </tbody>
</table>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf2/finanzierung.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Balken: Kauf 30.000 Euro, Kredit 33.048,77 Euro, Leasing 34.200 Euro über drei Jahre">
  <figcaption class="figure-caption">Gesamtkosten für eine Ausstattung im Wert von 30.000 € über drei Jahre</figcaption>
</figure>

<h6>Darlehen berechnen</h6>
<p>Beim <strong>Annuitätendarlehen</strong> ist die jährliche Rate (Annuität) gleich hoch; der Zinsanteil sinkt, der Tilgungsanteil steigt.
<strong>Annuität = K × q<sup>n</sup> × (q − 1) ÷ (q<sup>n</sup> − 1)</strong> mit q = 1 + Zinssatz. Für 30.000 €, 5 %, 3 Jahre: 30.000 × 1,157625 × 0,05 ÷ 0,157625 ≈ <strong>11.016,26 €</strong>.</p>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th>Jahr</th><th>Restschuld Anfang</th><th>Zinsen (5 %)</th><th>Tilgung</th><th>Rate</th></tr></thead>
  <tbody>
    <tr><td>1</td><td>30.000,00 €</td><td>1.500,00 €</td><td>9.516,26 €</td><td>11.016,26 €</td></tr>
    <tr><td>2</td><td>20.483,74 €</td><td>1.024,19 €</td><td>9.992,07 €</td><td>11.016,26 €</td></tr>
    <tr><td>3</td><td>10.491,67 €</td><td>524,58 €</td><td>10.491,67 €</td><td>11.016,25 €</td></tr>
    <tr><td colspan="2"><strong>Summe</strong></td><td><strong>3.048,77 €</strong></td><td>30.000,00 €</td><td>33.048,77 €</td></tr>
  </tbody>
</table>
<p>Beim <strong>Tilgungsdarlehen</strong> (Ratentilgung) ist dagegen die Tilgung gleich: 10.000 € pro Jahr, die Zinsen sinken mit der Restschuld (1500 €, 1000 €, 500 €) –
zusammen 3000 €, etwas weniger als beim Annuitätendarlehen, weil schneller getilgt wird. Dafür ist die erste Rate am höchsten.</p>

<h6>Abschreibung</h6>
<p>Gekaufte Geräte verlieren an Wert. In der Buchhaltung wird dieser Werteverzehr als <strong>Abschreibung</strong> (AfA, Absetzung für Abnutzung) über die Nutzungsdauer verteilt
und mindert den Gewinn. <strong>Lineare AfA = Anschaffungskosten ÷ Nutzungsdauer</strong>.</p>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf2/abschreibung.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Buchwert eines Notebooks sinkt linear von 1200 Euro auf 0 Euro in drei Jahren; daneben Sonderregeln für geringwertige Wirtschaftsgüter und Computerhardware">
  <figcaption class="figure-caption">Jedes Jahr derselbe Betrag</figcaption>
</figure>
<p>Geringwertige Wirtschaftsgüter bis 800 € netto (z. B. ein Monitor für 320 €) dürfen im Anschaffungsjahr voll abgeschrieben werden. Welche Variante ein Unternehmen nutzt,
entscheidet die Buchhaltung bzw. die Steuerberatung.</p>

<h6>Übungen mit Lösung</h6>
<p>1. Ein Monitor verbraucht 25 W und läuft 9 Stunden an 220 Tagen. Wie hoch sind die Stromkosten bei 0,32 €/kWh?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">25 W × 9 h × 220 ÷ 1000 = 49,5 kWh; × 0,32 €/kWh = <strong>15,84 €</strong> pro Jahr.</p>
</details>
<p>2. Ein Unternehmen kauft 10 Notebooks zu je 1200 € netto und schreibt sie linear über 3 Jahre ab. Wie hoch ist die jährliche AfA, und wie hoch ist der Buchwert nach 2 Jahren?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Anschaffungskosten 12.000 €; AfA 12.000 € ÷ 3 = <strong>4000 € pro Jahr</strong>; Buchwert nach 2 Jahren 12.000 − 8000 = <strong>4000 €</strong>.</p>
</details>
<p>3. Ein Start-up hat wenig Eigenkapital, braucht aber 20 aktuelle Notebooks und will sich nicht um Reparaturen kümmern. Was empfiehlst du?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Leasing mit Servicevertrag: Die Liquidität bleibt erhalten, die Raten sind planbar, Reparaturen und der Austausch nach der Laufzeit sind geregelt.
Dass Leasing insgesamt teurer ist, wird durch diese Vorteile aufgewogen.</p>
</details>
INHALT,
    'summary' => [
        'kWh = W × h ÷ 1000; Kosten = kWh × Preis; Standby nicht vergessen.',
        'Kauf: kein Zins, aber Liquiditätsabfluss; Kredit: Zinsen; Leasing: planbar, oft mit Service, insgesamt meist teurer.',
        'Annuität = K × qⁿ × (q − 1) ÷ (qⁿ − 1): gleiche Raten, sinkender Zinsanteil; Tilgungsdarlehen: gleiche Tilgung, sinkende Raten.',
        'Lineare AfA = Anschaffungskosten ÷ Nutzungsdauer.',
        'GWG bis 800 € netto sofort abschreibbar; Computerhardware und Software seit 2021 auch über 1 Jahr.',
    ],
    'quiz' => [
        ['question' => 'Wie berechnet man den Energieverbrauch in kWh?', 'answer' => 'Leistung in Watt × Betriebsstunden ÷ 1000.'],
        ['question' => 'Was ist beim Annuitätendarlehen gleichbleibend?', 'answer' => 'Die Rate (Zins + Tilgung); der Zinsanteil sinkt, der Tilgungsanteil steigt.'],
        ['question' => 'Wie hoch ist die lineare AfA für 1200 € über 3 Jahre?', 'answer' => '400 € pro Jahr.'],
        ['question' => 'Bis zu welchem Nettowert gilt ein Wirtschaftsgut als geringwertig (sofort abschreibbar)?', 'answer' => 'Bis 800 € netto.'],
    ],
];
