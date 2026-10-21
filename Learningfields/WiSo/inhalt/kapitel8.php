<?php
return [
    'title' => 'Markt, Wirtschaftsordnung und Wirtschaftspolitik',
    'intro' => 'Warum werden Grafikkarten plötzlich teurer, warum steigen Zinsen, warum stellen Firmen im Boom kaum noch Fachkräfte ein? Volkswirtschaftliche Grundbegriffe erklären, was im eigenen Betrieb oft nur als Folge ankommt – und sie sind ein fester Teil der WiSo-Prüfung.',
    'goals' => [
        'Wirtschaftsordnungen unterscheiden und die soziale Marktwirtschaft beschreiben',
        'den erweiterten Wirtschaftskreislauf erklären',
        'Preisbildung, Marktformen und Funktionen des Preises anwenden',
        'Konjunkturphasen und Konjunkturindikatoren zuordnen',
        'Inflation berechnen und die Instrumente von Geld- und Fiskalpolitik einordnen',
        'die Ziele des magischen Sechsecks und ihre Konflikte nennen',
    ],
    'content' => <<<'INHALT'
<h6>Wirtschaftsordnungen</h6>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th></th><th>freie Marktwirtschaft</th><th>Zentralverwaltungswirtschaft</th><th>soziale Marktwirtschaft</th></tr></thead>
  <tbody>
    <tr><td>Wer plant?</td><td>Haushalte und Unternehmen über Märkte</td><td>der Staat zentral</td><td>Märkte, ergänzt durch staatliche Rahmenregeln</td></tr>
    <tr><td>Eigentum an Produktionsmitteln</td><td>privat</td><td>staatlich</td><td>privat, aber „Eigentum verpflichtet“ (Art. 14 GG)</td></tr>
    <tr><td>Rolle des Staates</td><td>schützt nur Eigentum und Sicherheit</td><td>steuert alles</td><td>sichert Wettbewerb und sozialen Ausgleich (Sozialstaat, Art. 20 GG)</td></tr>
    <tr><td>Schwäche</td><td>soziale Härten, Monopole</td><td>Mangel, fehlende Anreize</td><td>Zielkonflikte zwischen Freiheit und Ausgleich</td></tr>
  </tbody>
</table>
<p>Deutschland folgt der <strong>sozialen Marktwirtschaft</strong>: Wettbewerb sorgt für Effizienz und Innovation, der Staat greift korrigierend ein – mit Sozialversicherung, Arbeitnehmerschutz, Kartellrecht und Umverteilung über Steuern.</p>

<h6>Der Wirtschaftskreislauf</h6>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/wiso/wirtschaftskreislauf.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Geldströme zwischen Haushalten, Unternehmen, Staat, Banken und Ausland: Einkommen, Konsumausgaben, Steuern, Transfers, Staatsaufträge, Ersparnis, Kredite, Exporterlöse und Importausgaben">
  <figcaption class="figure-caption">Erweiterter Wirtschaftskreislauf mit fünf Sektoren</figcaption>
</figure>
<p>Das <strong>Bruttoinlandsprodukt</strong> (BIP) misst den Wert aller in einem Jahr im Inland hergestellten Waren und Dienstleistungen für die Endverwendung. Das <em>nominale</em> BIP rechnet mit aktuellen Preisen; das <em>reale</em> BIP rechnet die Preissteigerung heraus und zeigt das tatsächliche Wachstum.</p>

<h6>Markt und Preisbildung</h6>
<p>Auf einem Markt treffen Angebot und Nachfrage aufeinander – auf dem Gütermarkt (z. B. Hardware), dem Arbeitsmarkt (z. B. Entwicklerinnen und Entwickler) und dem Kapitalmarkt (Kredite, Anlagen).</p>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/wiso/preisbildung.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Fallende Nachfragekurve und steigende Angebotskurve schneiden sich bei 30 Euro und 60 Stück; bei 40 Euro Angebotsüberhang von 50 Stück, bei 20 Euro Nachfrageüberhang von 50 Stück">
  <figcaption class="figure-caption">Gleichgewichtspreis im Polypol (Beispiel: Nachfrage = 120 − 2 · Preis, Angebot = 3 · Preis − 30)</figcaption>
</figure>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th>Preis</th><th>Nachfrage</th><th>Angebot</th><th>Situation</th></tr></thead>
  <tbody>
    <tr><td>20 €</td><td>80</td><td>30</td><td>Nachfrageüberhang 50 → Preis steigt</td></tr>
    <tr><td>30 €</td><td>60</td><td>60</td><td>Gleichgewicht: Markt wird geräumt</td></tr>
    <tr><td>40 €</td><td>40</td><td>90</td><td>Angebotsüberhang 50 → Preis sinkt</td></tr>
  </tbody>
</table>
<p>Der Preis erfüllt dabei mehrere Funktionen: Er <strong>signalisiert</strong> Knappheit, <strong>lenkt</strong> Produktionsfaktoren dorthin, wo sie am meisten erlösen, <strong>gleicht</strong> Angebot und Nachfrage <strong>aus</strong> und <strong>sortiert</strong> unwirtschaftliche Anbieter aus.</p>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th>Marktform (Angebotsseite)</th><th>Anbieter</th><th>Preisspielraum</th><th>Beispiele</th></tr></thead>
  <tbody>
    <tr><td><strong>Polypol</strong></td><td>viele kleine</td><td>gering – der Markt bestimmt den Preis</td><td>Webagenturen, IT-Freelancer, Gastronomie</td></tr>
    <tr><td><strong>Oligopol</strong></td><td>wenige große</td><td>mittel – Anbieter beobachten sich gegenseitig</td><td>Mobilfunknetze, große Cloud-Anbieter, Smartphone-Betriebssysteme</td></tr>
    <tr><td><strong>Monopol</strong></td><td>einer</td><td>hoch – Preis wird gesetzt</td><td>Schienennetz, Stromnetz in einer Region, zeitweise durch Patente</td></tr>
  </tbody>
</table>
<p>Damit Wettbewerb funktioniert, verbietet das <strong>Gesetz gegen Wettbewerbsbeschränkungen</strong> Kartelle (z. B. Preisabsprachen) und den Missbrauch einer marktbeherrschenden Stellung; große Fusionen prüft das <strong>Bundeskartellamt</strong>. Für sehr große Digitalplattformen („Gatekeeper“) gelten zusätzlich EU-Regeln wie der Digital Markets Act.</p>

<h6>Konjunktur</h6>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/wiso/konjunkturzyklus.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Wellenförmiger Verlauf der Wirtschaftsleistung um einen steigenden Trend mit den Phasen Aufschwung, Hochkonjunktur, Abschwung und Tiefstand">
  <figcaption class="figure-caption">Die Wirtschaft schwankt um einen langfristigen Wachstumstrend</figcaption>
</figure>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th>Phase</th><th>typische Merkmale</th></tr></thead>
  <tbody>
    <tr><td>Aufschwung (Expansion)</td><td>steigende Aufträge und Produktion, mehr Investitionen, sinkende Arbeitslosigkeit</td></tr>
    <tr><td>Hochkonjunktur (Boom)</td><td>ausgelastete Kapazitäten, Fachkräftemangel, steigende Preise und Löhne, steigende Zinsen</td></tr>
    <tr><td>Abschwung (Rezession)</td><td>sinkende Aufträge und Investitionen, Kurzarbeit; zwei Quartale mit sinkendem realem BIP gelten als „technische Rezession“</td></tr>
    <tr><td>Tiefstand (Depression)</td><td>hohe Arbeitslosigkeit, niedrige Auslastung, schwache Preisentwicklung, pessimistische Erwartungen</td></tr>
  </tbody>
</table>
<p><strong>Konjunkturindikatoren</strong>: <em>Frühindikatoren</em> zeigen die Entwicklung im Voraus (Auftragseingänge, Geschäftsklimaindizes), <em>Präsenzindikatoren</em> die aktuelle Lage (Produktion, BIP), <em>Spätindikatoren</em> reagieren verzögert (Arbeitslosenquote, Preise).</p>

<h6>Inflation und Geldpolitik</h6>
<p>Die <strong>Inflationsrate</strong> misst, wie stark die Verbraucherpreise gegenüber dem Vorjahr steigen. Das Statistische Bundesamt beobachtet dafür einen <strong>Warenkorb</strong> typischer Güter und Dienstleistungen (Verbraucherpreisindex).</p>
<p class="text-center"><code>Inflationsrate = (Preisniveau neu / Preisniveau alt − 1) · 100 %</code></p>
<ul>
  <li>Folgen: Geld verliert an Kaufkraft; Sparerinnen und Sparer verlieren, wenn die Zinsen unter der Inflation liegen; Schuldner profitieren.</li>
  <li><strong>Geldpolitik</strong>: Die Europäische Zentralbank strebt mittelfristig eine Inflationsrate von 2 % an. Ihr wichtigstes Instrument ist der <strong>Leitzins</strong>: Höhere Zinsen verteuern Kredite, dämpfen Nachfrage und Preise; niedrigere Zinsen beleben die Wirtschaft.</li>
  <li><strong>Fiskalpolitik</strong> des Staates: <em>antizyklisch</em> im Abschwung mehr ausgeben oder Steuern senken, im Boom sparen. <em>Angebotsorientiert</em>: Bedingungen für Unternehmen verbessern, z. B. Bürokratie abbauen, Investitionen erleichtern.</li>
</ul>

<h6>Das magische Sechseck</h6>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/wiso/magisches-sechseck.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Sechseck mit den Zielen Preisniveaustabilität, hoher Beschäftigungsstand, stetiges Wachstum, außenwirtschaftliches Gleichgewicht, Schutz der Umwelt und gerechte Einkommensverteilung; die ersten vier bilden das magische Viereck des Stabilitätsgesetzes">
  <figcaption class="figure-caption">Ziele der Wirtschaftspolitik</figcaption>
</figure>
<p>Das <strong>Stabilitätsgesetz</strong> von 1967 nennt vier Ziele (magisches Viereck); Umweltschutz und gerechte Verteilung ergänzen es zum Sechseck. „Magisch“ heißt es, weil sich nicht alle Ziele gleichzeitig erreichen lassen:</p>
<ul>
  <li><strong>Zielkonflikt</strong>: Mehr Wachstum bedeutet oft mehr Ressourcenverbrauch; niedrige Zinsen fördern Beschäftigung, können aber die Inflation anheizen.</li>
  <li><strong>Zielharmonie</strong>: Wachstum schafft Arbeitsplätze – Wachstum und hoher Beschäftigungsstand unterstützen sich.</li>
</ul>
<p class="lf-merke"><strong>Merke:</strong> Angebotsüberhang → Preis sinkt, Nachfrageüberhang → Preis steigt. Frühindikator = Auftragseingang, Spätindikator = Arbeitslosenquote. EZB-Ziel: 2 % Inflation. Antizyklisch = gegen die Konjunktur steuern.</p>

<h6>Übungen mit Lösung</h6>
<p>1. Ein Warenkorb kostete im Vorjahr 400 €, heute 414 €. Wie hoch ist die Inflationsrate? Was sind 1.000 € nach zwei Jahren mit je 3 % Inflation noch wert?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">414 / 400 − 1 = 3,5 %. Kaufkraft: 1.000 € / 1,03² ≈ 942,60 € in heutigen Preisen.</p>
</details>
<p>2. Auf einem Markt gilt Nachfrage = 120 − 2 · Preis und Angebot = 3 · Preis − 30. Bestimme Gleichgewichtspreis, -menge und Umsatz. Was passiert bei einem Preis von 40 €?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">120 − 2p = 3p − 30 → 150 = 5p → p = 30 €, Menge 60 Stück, Umsatz 1.800 €. Bei 40 € werden 90 angeboten, aber nur 40 nachgefragt: Angebotsüberhang 50, der Preis sinkt.</p>
</details>
<p>3. Auftragseingänge sinken seit Monaten, die Arbeitslosenquote ist aber noch niedrig, Firmen klagen über Fachkräftemangel. In welcher Phase befindet sich die Wirtschaft vermutlich?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Am Übergang vom Boom zum Abschwung: Der Frühindikator Auftragseingang sinkt bereits, der Spätindikator Arbeitslosenquote reagiert erst später.</p>
</details>
<p>4. Die EZB erhöht den Leitzins. Welche Wirkung ist beabsichtigt, welche Nebenwirkung möglich?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Beabsichtigt: Kredite werden teurer, Investitionen und Konsum gehen zurück, die Inflation sinkt. Nebenwirkung: schwächeres Wachstum, im Extremfall höhere Arbeitslosigkeit – ein Zielkonflikt zwischen Preisstabilität und Beschäftigung.</p>
</details>
<p>5. Ordne die Marktformen zu: (a) drei große Mobilfunknetzbetreiber, (b) tausende IT-Freelancer, (c) ein einziger Netzbetreiber für das Stromnetz einer Region.</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">(a) Oligopol, (b) Polypol, (c) Monopol.</p>
</details>
INHALT,
    'summary' => [
        'Soziale Marktwirtschaft: Wettbewerb plus staatlicher Rahmen und sozialer Ausgleich (Art. 14 und 20 GG).',
        'Wirtschaftskreislauf: Haushalte, Unternehmen, Staat, Banken, Ausland; BIP nominal und real.',
        'Gleichgewichtspreis, wo Angebot = Nachfrage; Überhänge verändern den Preis. Marktformen: Polypol, Oligopol, Monopol.',
        'Konjunktur: Aufschwung, Boom, Abschwung, Tiefstand; Früh-, Präsenz- und Spätindikatoren.',
        'Inflation = Preisniveau neu / alt − 1; EZB-Ziel 2 %, Leitzins als Hauptinstrument; Fiskalpolitik antizyklisch oder angebotsorientiert.',
        'Magisches Viereck (Stabilitätsgesetz 1967) + Umwelt + Verteilung = Sechseck; Zielkonflikte und Zielharmonien.',
    ],
    'quiz' => [
        ['question' => 'Was passiert bei einem Angebotsüberhang?', 'answer' => 'Der Preis sinkt, bis Angebot und Nachfrage wieder übereinstimmen.'],
        ['question' => 'Welche vier Ziele nennt das Stabilitätsgesetz?', 'answer' => 'Preisniveaustabilität, hoher Beschäftigungsstand, außenwirtschaftliches Gleichgewicht, stetiges und angemessenes Wirtschaftswachstum.'],
        ['question' => 'Ist die Arbeitslosenquote ein Früh- oder Spätindikator?', 'answer' => 'Ein Spätindikator.'],
        ['question' => 'Welche Inflationsrate strebt die EZB an?', 'answer' => 'Mittelfristig 2 %.'],
    ],
];
