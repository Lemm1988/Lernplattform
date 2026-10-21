<?php
return [
    'title' => 'Wenn Verträge gestört sind',
    'intro' => 'Die Server kommen zu spät, das Display hat Pixelfehler, der Kunde zahlt nicht. Für jede dieser Störungen regelt das BGB, was man verlangen darf und welche Fristen laufen. Wer die Reihenfolge kennt, setzt seine Rechte durch, ohne sie durch einen Formfehler zu verlieren.',
    'goals' => [
        'Voraussetzungen und Rechte beim Lieferverzug benennen',
        'Mängelarten erkennen und die Rangfolge der Käuferrechte anwenden',
        'Annahme- und Zahlungsverzug unterscheiden und Verzugszinsen berechnen',
        'Ablauf des gerichtlichen Mahnverfahrens beschreiben',
        'Verjährungsfristen berechnen sowie Hemmung und Neubeginn unterscheiden',
    ],
    'content' => <<<'INHALT'
<h6>Lieferungsverzug</h6>
<p>Der Verkäufer kommt in Verzug, wenn die Lieferung <strong>fällig</strong> ist, er trotz <strong>Mahnung</strong> nicht liefert und die Verzögerung zu vertreten hat (für Schadensersatz). Die Mahnung ist entbehrlich, wenn der Liefertermin <strong>kalendermäßig bestimmt</strong> ist („bis 15. Mai“), beim Fixkauf oder wenn der Verkäufer die Lieferung ernsthaft verweigert.</p>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th>Recht des Käufers</th><th>Voraussetzung</th></tr></thead>
  <tbody>
    <tr><td>auf Lieferung bestehen und Ersatz des Verzögerungsschadens</td><td>Verzug; Schadensersatz nur bei Verschulden</td></tr>
    <tr><td>Rücktritt vom Vertrag</td><td>angemessene Nachfrist ist erfolglos abgelaufen (beim Fixkauf ohne Nachfrist); Verschulden nicht nötig</td></tr>
    <tr><td>Schadensersatz statt der Leistung, z. B. Mehrkosten eines Deckungskaufs</td><td>Nachfrist erfolglos und Verschulden</td></tr>
  </tbody>
</table>

<h6>Mangelhafte Lieferung</h6>
<p>Eine Sache ist mangelhaft, wenn sie bei Übergabe nicht der vereinbarten Beschaffenheit entspricht, sich nicht für die gewöhnliche Verwendung eignet oder nicht die übliche Beschaffenheit hat. Dazu zählen auch:</p>
<ul>
  <li><strong>Montagemangel</strong> und mangelhafte Montageanleitung,</li>
  <li><strong>Falschlieferung</strong> (andere Sache) und <strong>Zuweniglieferung</strong>,</li>
  <li><strong>Rechtsmangel</strong>: Ein Dritter hat Rechte an der Sache, z. B. eine nicht übertragbare Softwarelizenz.</li>
  <li>Bei Waren mit digitalen Elementen (Smartphone, Router, Smart-TV) müssen Verkäufer an Verbraucher außerdem für einen angemessenen Zeitraum <strong>Sicherheits- und Funktionsupdates</strong> bereitstellen – fehlen sie, ist das ebenfalls ein Mangel.</li>
</ul>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/wiso/maengelrechte.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Mangel bei Übergabe, zuerst Nacherfüllung durch Nachbesserung oder Ersatzlieferung; wenn sie scheitert, nach Wahl Rücktritt oder Minderung, bei Verschulden zusätzlich Schadensersatz; zwei Jahre Frist, Beweislastumkehr im ersten Jahr bei Verbrauchern, Rügepflicht unter Kaufleuten">
  <figcaption class="figure-caption">Erst Nacherfüllung, dann Rücktritt oder Minderung</figcaption>
</figure>
<ul>
  <li><strong>Gewährleistung</strong> ist gesetzlich und gilt zwei Jahre ab Übergabe; bei gebrauchten Sachen kann sie gegenüber Verbrauchern auf ein Jahr verkürzt werden. Eine <strong>Garantie</strong> ist ein freiwilliges Zusatzversprechen mit eigenen Bedingungen (<a href="/Learningfields/LF6/kapitel7.php">LF6 Kapitel 7</a>).</li>
  <li><strong>Unter Kaufleuten</strong> muss die Ware unverzüglich geprüft und ein offener Mangel sofort gerügt werden; ein versteckter Mangel unverzüglich nach Entdeckung.</li>
</ul>

<h6>Annahmeverzug</h6>
<p>Nimmt der Käufer die ordnungsgemäß angebotene Ware nicht an, gerät er in <strong>Annahmeverzug</strong>. Der Verkäufer haftet dann nur noch für Vorsatz und grobe Fahrlässigkeit; das Risiko des zufälligen Untergangs geht auf den Käufer über. Der Verkäufer kann die Ware einlagern (hinterlegen) und weiter den Kaufpreis plus Mehrkosten verlangen oder sie nach Androhung im <strong>Selbsthilfeverkauf</strong> versteigern lassen.</p>

<h6>Zahlungsverzug</h6>
<ul>
  <li>Der Schuldner kommt in Verzug durch <strong>Mahnung</strong> nach Fälligkeit, ohne Mahnung bei einem kalendermäßig bestimmten Zahlungstermin – und spätestens <strong>30 Tage nach Fälligkeit und Zugang der Rechnung</strong>. Verbraucher gilt die 30-Tage-Regel nur, wenn die Rechnung darauf hinweist.</li>
  <li><strong>Verzugszinsen</strong> pro Jahr: Basiszinssatz + 5 Prozentpunkte, wenn ein Verbraucher beteiligt ist; Basiszinssatz + 9 Prozentpunkte zwischen Unternehmen, zusätzlich eine Pauschale von 40 €. Den Basiszinssatz passt die Bundesbank halbjährlich an.</li>
</ul>
<p class="text-center"><code>Zinsen = Betrag · Zinssatz · Tage / 365</code></p>
<p>Beispiel mit einem angenommenen Basiszinssatz von 2 %: Ein Geschäftskunde zahlt 10.000 € 30 Tage zu spät → 10.000 € · 11 % · 30 / 365 ≈ 90,41 € Zinsen + 40 € Pauschale.</p>

<h6>Mahnverfahren</h6>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/wiso/mahnverfahren.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Außergerichtlich: Rechnung, Zahlungsverzug, Mahnungen. Gerichtlich: Mahnbescheid, bei Widerspruch streitiges Verfahren, sonst Vollstreckungsbescheid, bei Einspruch streitiges Verfahren, sonst Zwangsvollstreckung">
  <figcaption class="figure-caption">Vom kaufmännischen zum gerichtlichen Mahnverfahren</figcaption>
</figure>
<p>Das gerichtliche Mahnverfahren ist schnell und günstig, weil das Gericht <em>nicht prüft</em>, ob die Forderung besteht. Der Antrag wird online beim zuständigen zentralen Mahngericht gestellt. Ist die Forderung umstritten, legt der Schuldner Widerspruch ein – dann muss der Gläubiger klagen und beweisen.</p>

<h6>Verjährung</h6>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/wiso/verjaehrung.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Zeitstrahl: Lieferung am 15. März 2026; die Kaufpreisforderung verjährt nach drei Jahren ab Jahresende, also am 31. Dezember 2029; die Gewährleistung läuft zwei Jahre ab Übergabe bis 15. März 2028">
  <figcaption class="figure-caption">Regelmäßige Verjährung (ab Jahresende) und Gewährleistung (ab Übergabe)</figcaption>
</figure>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th>Frist</th><th>gilt für</th><th>Beginn</th></tr></thead>
  <tbody>
    <tr><td>3 Jahre (regelmäßige Verjährung)</td><td>z. B. Kaufpreis-, Lohn-, Werklohnforderungen</td><td>Ende des Jahres, in dem der Anspruch entstand und der Gläubiger davon wusste</td></tr>
    <tr><td>2 Jahre</td><td>Mängelansprüche beim Kauf beweglicher Sachen</td><td>Übergabe</td></tr>
    <tr><td>30 Jahre</td><td>rechtskräftig festgestellte Ansprüche (Urteil, Vollstreckungsbescheid)</td><td>Rechtskraft</td></tr>
  </tbody>
</table>
<p>Nach Ablauf der Frist besteht die Forderung zwar weiter, der Schuldner darf die Zahlung aber verweigern (Einrede der Verjährung). Wer trotzdem zahlt, kann das Geld nicht zurückfordern.</p>
<p class="lf-merke"><strong>Merke:</strong> Mängel → zuerst Nacherfüllung. Zahlung → Verzug spätestens nach 30 Tagen. Gericht → Mahnbescheid, Widerspruch 2 Wochen, Vollstreckungsbescheid, Einspruch 2 Wochen. Verjährung → 3 Jahre ab Jahresende, Gewährleistung 2 Jahre ab Übergabe.</p>

<h6>Übungen mit Lösung</h6>
<p>1. Bestellt sind 20 Notebooks „Lieferung bis spätestens 10. Juni“. Am 12. Juni ist nichts da. Muss der Käufer mahnen? Was kann er tun?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Keine Mahnung nötig, der Termin ist kalendermäßig bestimmt – der Verkäufer ist seit dem 11. Juni in Verzug. Der Käufer kann auf Lieferung bestehen und bei Verschulden den Verzögerungsschaden verlangen. Will er zurücktreten oder Schadensersatz statt der Leistung (z. B. teureren Deckungskauf), setzt er eine angemessene Nachfrist.</p>
</details>
<p>2. Ein Monitor zeigt nach drei Wochen Streifen. Die Kundin verlangt sofort ihr Geld zurück. Zu Recht?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Nein, zuerst hat der Verkäufer das Recht zur Nacherfüllung. Die Kundin kann wählen, ob repariert oder ein neuer Monitor geliefert wird. Erst wenn das scheitert, kann sie zurücktreten. Weil sie Verbraucherin ist und der Mangel im ersten Jahr auftritt, wird vermutet, dass er schon bei Übergabe vorlag.</p>
</details>
<p>3. Eine Rechnung über 4.800 € wurde am 3. Februar 2026 fällig, die Leistung am selben Tag erbracht. Wann verjährt die Forderung?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Die Frist beginnt mit Ablauf des 31. Dezember 2026 und endet mit Ablauf des 31. Dezember 2029.</p>
</details>
<p>4. Der Schuldner erhält einen Mahnbescheid und reagiert nicht. Was folgt?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Der Gläubiger beantragt den Vollstreckungsbescheid (innerhalb von sechs Monaten). Legt der Schuldner auch dagegen nicht binnen zwei Wochen Einspruch ein, wird er rechtskräftig; damit kann der Gläubiger die Zwangsvollstreckung betreiben, z. B. durch den Gerichtsvollzieher oder eine Kontopfändung.</p>
</details>
<p>5. Ein Privatkunde zahlt eine Rechnung über 1.200 € 60 Tage zu spät. Wie hoch sind die Verzugszinsen bei einem angenommenen Basiszinssatz von 2 %?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Zinssatz 2 % + 5 Prozentpunkte = 7 %. 1.200 € · 7 % · 60 / 365 ≈ 13,81 €. Die 40-€-Pauschale gibt es gegenüber Verbrauchern nicht.</p>
</details>
INHALT,
    'summary' => [
        'Lieferverzug: Fälligkeit + Mahnung (entbehrlich bei Kalendertermin oder Fixkauf); Rücktritt oder Schadensersatz statt Leistung nach erfolgloser Nachfrist.',
        'Mangel: zuerst Nacherfüllung (Nachbesserung oder Ersatzlieferung), dann Rücktritt oder Minderung, bei Verschulden Schadensersatz; Gewährleistung 2 Jahre.',
        'Kaufleute müssen sofort prüfen und rügen; Waren mit digitalen Elementen brauchen Updates.',
        'Zahlungsverzug spätestens 30 Tage nach Fälligkeit und Rechnung; Zinsen Basiszins + 5 (Verbraucher) bzw. + 9 Prozentpunkte (B2B) plus 40 €.',
        'Mahnverfahren: Mahnbescheid → (Widerspruch) → Vollstreckungsbescheid → (Einspruch) → Zwangsvollstreckung.',
        'Verjährung 3 Jahre ab Jahresende; Titel 30 Jahre; Hemmung durch Mahnbescheid/Klage, Neubeginn durch Anerkenntnis.',
    ],
    'quiz' => [
        ['question' => 'Welches Recht hat der Käufer bei einem Mangel zuerst?', 'answer' => 'Nacherfüllung – nach seiner Wahl Nachbesserung oder Ersatzlieferung.'],
        ['question' => 'Wann kommt ein Geschäftskunde ohne Mahnung in Zahlungsverzug?', 'answer' => 'Spätestens 30 Tage nach Fälligkeit und Zugang der Rechnung oder sofort bei einem kalendermäßig bestimmten Zahlungstermin.'],
        ['question' => 'Wie lange ist die regelmäßige Verjährungsfrist und wann beginnt sie?', 'answer' => 'Drei Jahre, beginnend mit dem Ende des Jahres, in dem der Anspruch entstanden ist.'],
        ['question' => 'Was kann ein Schuldner gegen einen Mahnbescheid tun?', 'answer' => 'Innerhalb von zwei Wochen Widerspruch einlegen; dann folgt ein streitiges Gerichtsverfahren.'],
    ],
];
