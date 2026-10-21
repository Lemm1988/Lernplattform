<?php
return [
    'title' => 'Recht im Service: Gewährleistung, Garantie, Verträge',
    'intro' => '„Das ist doch noch in der Garantie!“ – oft ist die Gewährleistung gemeint. Wer Serviceanfragen bearbeitet, muss die Rechte von Kunden kennen und wissen, welcher Vertrag hinter einer Leistung steht.',
    'goals' => [
        'Gewährleistung und Garantie sicher unterscheiden',
        'Fristen und Beweislast bei Mängeln bestimmen',
        'die Rechte des Käufers in der richtigen Reihenfolge anwenden',
        'die Untersuchungs- und Rügepflicht unter Kaufleuten beachten',
        'Kauf-, Werk-, Dienst- und Mietvertrag im IT-Umfeld zuordnen',
    ],
    'content' => <<<'INHALT'
<h6>Gewährleistung und Garantie</h6>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th></th><th>Gewährleistung (Mängelhaftung)</th><th>Garantie</th></tr></thead>
  <tbody>
    <tr><td>Grundlage</td><td>Gesetz (§§ 434 ff. BGB)</td><td>freiwillige Zusage (§ 443 BGB)</td></tr>
    <tr><td>gegenüber</td><td>dem Verkäufer (Vertragspartner)</td><td>dem Garantiegeber, meist dem Hersteller</td></tr>
    <tr><td>Voraussetzung</td><td>Mangel lag schon bei der Übergabe vor</td><td>nach den Garantiebedingungen, oft jeder Defekt in der Laufzeit</td></tr>
    <tr><td>Dauer</td><td>2 Jahre ab Übergabe bei neuer Ware</td><td>frei festgelegt, z. B. 3 oder 5 Jahre</td></tr>
    <tr><td>Umfang</td><td>gesetzliche Rechte, gegenüber Verbrauchern nicht einschränkbar</td><td>frei festgelegt, gilt zusätzlich</td></tr>
  </tbody>
</table>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf6/gewaehrleistung-zeitleiste.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Zeitachse: Gewährleistung 24 Monate mit Beweislastumkehr in den ersten 12 Monaten; Herstellergarantie im Beispiel 36 Monate">
  <figcaption class="figure-caption">Gewährleistung und Garantie laufen nebeneinander</figcaption>
</figure>
<p>Die <strong>Beweislastumkehr</strong> (§ 477 BGB) gilt beim Kauf durch Verbraucher: Zeigt sich ein Mangel innerhalb eines Jahres nach Übergabe, wird vermutet,
dass er schon bei Übergabe da war. Danach muss der Käufer das beweisen – was bei Elektronik schwierig ist. Bei gebrauchter Ware darf die Gewährleistung gegenüber
Verbrauchern auf ein Jahr verkürzt werden.</p>
<p>Ein <strong>Mangel</strong> kann ein Sachmangel sein (die Ware hat nicht die vereinbarte oder übliche Beschaffenheit, eine Montageanleitung ist fehlerhaft) oder ein
Rechtsmangel (ein Dritter hat Rechte an der Sache, etwa eine Software ohne gültige Lizenz). Verkäufer von Waren mit digitalen Elementen – Smartphones, Smart-TVs –
müssen Verbrauchern außerdem für einen angemessenen Zeitraum die nötigen <strong>Sicherheits- und Funktionsupdates</strong> bereitstellen.</p>

<h6>Rechte des Käufers</h6>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf6/maengelrechte.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Stufe 1 Nacherfüllung durch Reparatur oder Ersatz; wenn sie scheitert, Stufe 2 Rücktritt oder Minderung; zusätzlich Schadensersatz bei Verschulden">
  <figcaption class="figure-caption">Erst Nacherfüllung, dann Rücktritt oder Minderung</figcaption>
</figure>
<div class="lf-pruefung"><strong>Prüfungstipp:</strong> Die Reihenfolge ist entscheidend: Ein Käufer kann nicht sofort sein Geld zurückverlangen, sondern muss dem Verkäufer
zuerst die Nacherfüllung ermöglichen. Ausnahme: Sie ist unmöglich, wird verweigert oder ist unzumutbar.</div>

<h6>Unter Kaufleuten: sofort prüfen</h6>
<p>Ist der Kauf für beide Seiten ein Handelsgeschäft (B2B), muss der Käufer die Ware <strong>unverzüglich untersuchen</strong> und erkennbare Mängel
<strong>unverzüglich rügen</strong> (§ 377 HGB). Versäumt er das, gilt die Ware als genehmigt – die Mängelrechte für erkennbare Mängel sind verloren.
Für IT heißt das: Lieferungen sofort auspacken, testen und Mängel schriftlich melden.</p>

<h6>Welcher Vertrag?</h6>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th>Vertrag</th><th>geschuldet ist</th><th>IT-Beispiel</th></tr></thead>
  <tbody>
    <tr><td>Kaufvertrag (§ 433 BGB)</td><td>Übergabe und Eigentum einer mangelfreien Sache</td><td>Notebooks, Monitore, Standardsoftware mit Dauerlizenz</td></tr>
    <tr><td>Werkvertrag (§ 631 BGB)</td><td>ein <strong>Erfolg</strong>: ein funktionierendes Ergebnis</td><td>Individualsoftware entwickeln, Netzwerk einrichten</td></tr>
    <tr><td>Dienstvertrag (§ 611 BGB)</td><td>eine <strong>Tätigkeit</strong>, kein bestimmter Erfolg</td><td>Supportstunden, Beratung, Schulung</td></tr>
    <tr><td>Mietvertrag (§ 535 BGB)</td><td>Gebrauch auf Zeit gegen Entgelt</td><td>Hardware-Miete; Software als Service wird meist wie Miete behandelt</td></tr>
  </tbody>
</table>
<p>Beim Werkvertrag ist die <strong>Abnahme</strong> wichtig: Damit erklärt der Kunde das Werk als im Wesentlichen vertragsgemäß, die Vergütung wird fällig, die Beweislast
für Mängel geht auf ihn über und die Verjährung der Mängelansprüche beginnt. Deshalb wird eine Abnahme mit Protokoll durchgeführt (<a href="/Learningfields/LF8/kapitel14.php">LF8 Kapitel 14</a>).</p>

<h6>Übungen mit Lösung</h6>
<p>1. Eine Privatkundin hat vor acht Monaten ein Notebook gekauft, jetzt fällt das Display aus. Was kann sie verlangen, und wer muss was beweisen?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Gewährleistung gegenüber dem Händler: zuerst Nacherfüllung nach ihrer Wahl (Reparatur oder neues Gerät). Weil der Mangel innerhalb eines Jahres auftritt,
wird vermutet, dass er schon bei Übergabe vorlag – der Händler müsste das Gegenteil beweisen.</p>
</details>
<p>2. Derselbe Defekt tritt nach 20 Monaten auf; der Hersteller gibt 3 Jahre Garantie. Welche Möglichkeiten hat die Kundin?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Gewährleistung besteht noch (24 Monate), aber sie müsste beweisen, dass der Mangel schon bei Übergabe vorlag. Meist einfacher ist die Herstellergarantie,
die nach ihren Bedingungen jeden Defekt in der Laufzeit abdeckt.</p>
</details>
<p>3. Ein Unternehmen erhält 20 Monitore, packt sie aber erst drei Monate später aus und reklamiert dann sichtbare Pixelfehler. Wie ist die Lage?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Unter Kaufleuten gilt § 377 HGB: Die Ware hätte unverzüglich untersucht und erkennbare Mängel sofort gerügt werden müssen. Die Rüge kommt zu spät,
die Monitore gelten als genehmigt. Ansprüche bestehen höchstens noch über eine Herstellergarantie.</p>
</details>
<p>4. Ordne den Vertragstyp zu: (a) Ein Systemhaus programmiert einen Webshop zum Festpreis. (b) Ein Kunde bucht ein Kontingent von 20 Supportstunden. (c) Cloud-Speicher für 9 € im Monat.</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">(a) Werkvertrag – ein funktionierender Webshop ist geschuldet. (b) Dienstvertrag – die Tätigkeit ist geschuldet. (c) wird meist wie ein Mietvertrag behandelt.</p>
</details>
INHALT,
    'summary' => [
        'Gewährleistung: gesetzlich, gegenüber dem Verkäufer, 2 Jahre bei neuer Ware; Garantie: freiwillig, meist vom Hersteller, zusätzlich.',
        'Beweislastumkehr beim Verbraucherkauf: im ersten Jahr wird vermutet, dass der Mangel schon bei Übergabe bestand.',
        'Reihenfolge: Nacherfüllung (Reparatur oder Ersatz) → bei Scheitern Rücktritt oder Minderung; Schadensersatz bei Verschulden.',
        'B2B: unverzüglich untersuchen und rügen (§ 377 HGB), sonst gilt die Ware als genehmigt.',
        'Kaufvertrag: Sache; Werkvertrag: Erfolg (mit Abnahme); Dienstvertrag: Tätigkeit; Mietvertrag: Gebrauch auf Zeit.',
    ],
    'quiz' => [
        ['question' => 'Gegen wen richtet sich die Gewährleistung?', 'answer' => 'Gegen den Verkäufer, also den Vertragspartner.'],
        ['question' => 'Wie lange gilt die Beweislastumkehr beim Verbraucherkauf?', 'answer' => 'Ein Jahr ab Übergabe.'],
        ['question' => 'Welches Recht hat der Käufer bei einem Mangel zuerst?', 'answer' => 'Nacherfüllung: Nachbesserung (Reparatur) oder Nachlieferung (Ersatz).'],
        ['question' => 'Was unterscheidet Werkvertrag und Dienstvertrag?', 'answer' => 'Beim Werkvertrag ist ein Erfolg geschuldet, beim Dienstvertrag nur die Tätigkeit.'],
    ],
];
