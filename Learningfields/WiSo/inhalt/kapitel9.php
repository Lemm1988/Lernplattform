<?php
return [
    'title' => 'Nachhaltigkeit und Wandel der Arbeitswelt',
    'intro' => 'Rechenzentren verbrauchen Strom, Smartphones Rohstoffe, Software bestimmt, wer teilhaben kann. Gleichzeitig verändern KI, Homeoffice und Fachkräftemangel die Arbeit selbst. Dieses Kapitel verbindet WiSo mit dem IT-Alltag und zeigt, wie man sich im Beruf weiterentwickelt.',
    'goals' => [
        'Nachhaltigkeit in drei Dimensionen beschreiben und auf IT übertragen',
        'Kennzahl PUE und Regeln zur Energieeffizienz von Rechenzentren anwenden',
        'Pflichten bei Elektrogeräten, Ökodesign und Barrierefreiheit kennen',
        'Treiber des Wandels der Arbeitswelt erklären',
        'Wege der beruflichen Weiterbildung in der IT unterscheiden',
    ],
    'content' => <<<'INHALT'
<h6>Was heißt nachhaltig?</h6>
<p>Nachhaltig ist eine Entwicklung, die die Bedürfnisse der heutigen Generation befriedigt, ohne die Möglichkeiten künftiger Generationen zu gefährden (Brundtland-Bericht, 1987). Die Vereinten Nationen haben dazu 17 Nachhaltigkeitsziele (Agenda 2030) formuliert – von Armut über Bildung bis Klimaschutz.</p>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/wiso/nachhaltigkeit.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Drei Säulen unter dem Dach Nachhaltigkeit: Ökologie mit effizienten Rechenzentren, langer Gerätenutzung und effizientem Code; Ökonomie mit Energiekosten, langlebigen Systemen und TCO; Soziales mit fairer Lieferkette, Barrierefreiheit, Datenschutz und Weiterbildung">
  <figcaption class="figure-caption">Ökologie, Ökonomie und Soziales – mit Beispielen aus der IT</figcaption>
</figure>

<h6>Green IT</h6>
<ul>
  <li><strong>Rechenzentren</strong>: Die Kennzahl <strong>PUE</strong> (Power Usage Effectiveness) setzt den gesamten Energiebedarf ins Verhältnis zum Bedarf der IT selbst: <code>PUE = Gesamtenergie / Energie der IT-Geräte</code>. Ideal wäre 1,0 – jede Kilowattstunde für Kühlung, Beleuchtung und Verluste erhöht den Wert. Nach dem Energieeffizienzgesetz müssen Rechenzentren, die ab 1. Juli 2026 in Betrieb gehen, einen PUE von höchstens 1,2 erreichen und einen Teil ihrer Abwärme nutzbar machen; für bestehende Rechenzentren gelten gestaffelte Grenzwerte, die der Gesetzgeber 2026 überarbeitet.</li>
  <li><strong>Geräte</strong>: Der größte Teil der Umweltbelastung eines Notebooks oder Smartphones entsteht bei der Herstellung. Längere Nutzung, Reparatur und generalüberholte Geräte (Refurbished) wirken deshalb oft stärker als Stromsparen im Betrieb. Seit 20. Juni 2025 müssen neue Smartphones und Tablets in der EU strengere Ökodesign-Regeln erfüllen: Ersatzteile sieben Jahre lang, mindestens fünf Jahre Betriebssystem-Updates, ein Energielabel mit Reparierbarkeitsindex.</li>
  <li><strong>Software</strong>: Effiziente Algorithmen, sparsame Datenübertragung und passend dimensionierte Cloud-Ressourcen senken Energiebedarf und Kosten zugleich – ein Beispiel für Zielharmonie.</li>
  <li><strong>Entsorgung</strong>: Elektroaltgeräte gehören nicht in den Hausmüll (durchgestrichene Mülltonne). Händler mit größerer Verkaufs- oder Versandfläche müssen Altgeräte zurücknehmen, kleine Geräte auch ohne Neukauf. Vor der Abgabe Datenträger sicher löschen oder vernichten (<a href="/Learningfields/LF2/kapitel3.php">LF2 Kapitel 3</a>).</li>
</ul>

<h6>Soziale Verantwortung</h6>
<ul>
  <li><strong>Barrierefreiheit</strong>: Seit 28. Juni 2025 verpflichtet das Barrierefreiheitsstärkungsgesetz viele Anbieter, etwa von Onlineshops, Bankdiensten und E-Books, zu barrierefreien digitalen Angeboten (<a href="/Learningfields/LF10/index.php">LF10</a>).</li>
  <li><strong>Lieferketten</strong>: Rohstoffe wie Kobalt oder seltene Erden werden teils unter schlechten Arbeitsbedingungen gewonnen. Unternehmen müssen zunehmend nachweisen, dass sie Menschenrechte und Umweltstandards in ihren Lieferketten beachten.</li>
  <li><strong>Datenschutz</strong> und Schutz vor Diskriminierung durch Algorithmen gehören ebenfalls zur sozialen Dimension.</li>
</ul>

<h6>Wandel der Arbeitswelt</h6>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th>Treiber</th><th>Folgen</th></tr></thead>
  <tbody>
    <tr><td><strong>Digitalisierung und KI</strong></td><td>Routineaufgaben werden automatisiert, neue Tätigkeiten entstehen (z. B. Datenanalyse, KI-Betrieb). Die EU-KI-Verordnung (KI-Gesetz) regelt KI-Systeme seit 2025 schrittweise nach ihrem Risiko – verbotene Praktiken, Transparenzpflichten, strenge Regeln für Hochrisiko-Anwendungen.</td></tr>
    <tr><td><strong>Flexible Arbeit</strong></td><td>Homeoffice und mobiles Arbeiten sparen Pendelzeit, verwischen aber Grenzen. Arbeitszeitgesetz, Arbeitsschutz und Datenschutz gelten auch zu Hause.</td></tr>
    <tr><td><strong>Demografischer Wandel</strong></td><td>Mehr Menschen gehen in Rente, als nachrücken: Fachkräftemangel, längere Lebensarbeitszeit, gezielte Zuwanderung von Fachkräften.</td></tr>
    <tr><td><strong>Globalisierung</strong></td><td>Internationale Arbeitsteilung, Teams über Zeitzonen hinweg, Offshoring und Nearshoring in der Softwareentwicklung, Englisch als Arbeitssprache.</td></tr>
  </tbody>
</table>

<h6>Lebenslanges Lernen</h6>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th>Weg</th><th>Beispiel</th></tr></thead>
  <tbody>
    <tr><td><strong>Anpassungsfortbildung</strong>: im Beruf auf dem aktuellen Stand bleiben</td><td>Schulung zu einem neuen Framework, Herstellerzertifikat (Cloud, Netzwerk, Sicherheit)</td></tr>
    <tr><td><strong>Aufstiegsfortbildung</strong> nach dem BBiG</td><td>drei Stufen: Geprüfte/r Berufsspezialist/in, <strong>Bachelor Professional in IT</strong>, <strong>Master Professional in IT</strong> – öffentlich-rechtliche IHK-Abschlüsse</td></tr>
    <tr><td><strong>Studium</strong></td><td>mit Berufsausbildung und Berufserfahrung oft auch ohne Abitur möglich; berufsbegleitend oder dual</td></tr>
    <tr><td><strong>Umschulung</strong></td><td>Ausbildung in einem neuen Beruf, häufig gefördert durch Agentur für Arbeit oder Rentenversicherung</td></tr>
  </tbody>
</table>
<p>Förderung: Das <strong>Aufstiegs-BAföG</strong> unterstützt Aufstiegsfortbildungen mit Zuschüssen und günstigen Darlehen. In den meisten Bundesländern gibt es außerdem einen Anspruch auf <strong>Bildungsurlaub</strong> (in der Regel fünf Tage pro Jahr) – nicht aber in Bayern und Sachsen.</p>
<p class="lf-merke"><strong>Merke:</strong> Nachhaltigkeit = Ökologie + Ökonomie + Soziales. PUE = Gesamtenergie / IT-Energie, je näher an 1, desto besser. Aufstiegsfortbildung in drei Stufen bis zum Master Professional.</p>

<h6>Übungen mit Lösung</h6>
<p>1. Ein Rechenzentrum verbraucht im Jahr 13 GWh, davon 10 GWh für Server, Speicher und Netz. Wie hoch ist der PUE? Erfüllt es den Wert für neue Rechenzentren?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">PUE = 13 / 10 = 1,3. Für ein neues Rechenzentrum ab Juli 2026 (höchstens 1,2) wäre das zu hoch.</p>
</details>
<p>2. Ordne der passenden Dimension der Nachhaltigkeit zu: (a) Screenreader-taugliche Weboberfläche, (b) Abwärme des Serverraums heizt das Büro, (c) Laptops sechs statt drei Jahre nutzen und so Anschaffungskosten sparen.</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">(a) Soziales, (b) Ökologie (und Ökonomie, weil Heizkosten sinken), (c) Ökonomie und Ökologie – ein Beispiel für Zielharmonie.</p>
</details>
<p>3. Nach der Ausbildung möchtest du ohne Studium einen höheren Abschluss mit Führungsverantwortung erwerben. Welcher Weg passt?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Die Aufstiegsfortbildung, z. B. zum Bachelor Professional in IT; finanziell unterstützt durch das Aufstiegs-BAföG.</p>
</details>
INHALT,
    'summary' => [
        'Nachhaltigkeit: heutige Bedürfnisse erfüllen, ohne künftige Generationen zu gefährden – ökologisch, ökonomisch, sozial.',
        'Green IT: PUE = Gesamtenergie / IT-Energie; neue Rechenzentren ab Juli 2026 höchstens 1,2; Geräte lange nutzen und reparieren.',
        'Ökodesign für Smartphones/Tablets seit Juni 2025; Rücknahmepflicht für Altgeräte; Barrierefreiheitsstärkungsgesetz seit Juni 2025.',
        'Wandel: Digitalisierung und KI (EU-KI-Verordnung), flexible Arbeit, demografischer Wandel, Globalisierung.',
        'Weiterbildung: Anpassung, Aufstieg (Berufsspezialist, Bachelor und Master Professional), Studium, Umschulung; Aufstiegs-BAföG, Bildungsurlaub.',
    ],
    'quiz' => [
        ['question' => 'Welche drei Dimensionen hat Nachhaltigkeit?', 'answer' => 'Ökologie, Ökonomie und Soziales.'],
        ['question' => 'Wie berechnet man den PUE eines Rechenzentrums?', 'answer' => 'Gesamtenergiebedarf des Rechenzentrums geteilt durch den Energiebedarf der IT-Geräte.'],
        ['question' => 'Welche Stufen hat die Aufstiegsfortbildung nach dem BBiG?', 'answer' => 'Geprüfte/r Berufsspezialist/in, Bachelor Professional, Master Professional.'],
        ['question' => 'Seit wann gilt das Barrierefreiheitsstärkungsgesetz?', 'answer' => 'Seit dem 28. Juni 2025.'],
    ],
];
