<?php
return [
    'title' => 'Benutzerschnittstellen und Softwareergonomie',
    'intro' => 'Eine Software kann technisch perfekt sein und trotzdem scheitern, wenn niemand sie bedienen kann. Softwareergonomie macht Benutzbarkeit planbar und prüfbar.',
    'goals' => [
        'Gebrauchstauglichkeit nach DIN EN ISO 9241-11 definieren',
        'die Interaktionsprinzipien nach DIN EN ISO 9241-110 nennen und Verstöße zuordnen',
        'Grundregeln der Barrierefreiheit anwenden',
        'Skizze, Wireframe, Mockup und Prototyp unterscheiden',
    ],
    'content' => <<<'INHALT'
<p><strong>Benutzerschnittstelle</strong> (User Interface, UI) ist alles, womit ein Mensch eine Software bedient: Bildschirmmasken,
Menüs, Tastenkombinationen, Meldungen. <strong>User Experience</strong> (UX) ist weiter gefasst – das gesamte Erleben vor, während
und nach der Nutzung. Ein schönes UI ohne durchdachte UX bleibt frustrierend.</p>

<h6>Gebrauchstauglichkeit (Usability)</h6>
<p>Nach <strong>DIN EN ISO 9241-11</strong> ist ein System gebrauchstauglich, wenn bestimmte Benutzer damit bestimmte Ziele erreichen –</p>
<ul>
  <li><strong>effektiv:</strong> Das Ziel wird vollständig und richtig erreicht,</li>
  <li><strong>effizient:</strong> mit angemessenem Aufwand (Zeit, Klicks, Nachdenken),</li>
  <li><strong>zufriedenstellend:</strong> ohne Ärger, möglichst mit positivem Gefühl.</li>
</ul>

<h6>Interaktionsprinzipien nach DIN EN ISO 9241-110</h6>
<p>Die Norm beschreibt, wie der Dialog zwischen Mensch und System gestaltet sein soll. Die Fassung von 2020 nennt sieben
Prinzipien; in Prüfungen tauchen oft noch die älteren Namen (Fassung 2006) auf – du solltest beide kennen.</p>
<div class="table-responsive">
<table class="table table-sm table-bordered align-middle">
  <thead class="table-light"><tr><th>Prinzip</th><th>Bedeutung</th><th>Verstoß (Beispiel)</th></tr></thead>
  <tbody>
    <tr><td><strong>Aufgabenangemessenheit</strong></td><td>Das System unterstützt die Aufgabe, ohne unnötige Schritte.</td><td>Für eine Adressänderung muss man fünf Seiten durchklicken.</td></tr>
    <tr><td><strong>Selbstbeschreibungsfähigkeit</strong></td><td>Man erkennt jederzeit, wo man ist, was möglich ist und was passiert.</td><td>Meldung „Fehler 0x80040154“ ohne Erklärung.</td></tr>
    <tr><td><strong>Erwartungskonformität</strong></td><td>Das System verhält sich wie gewohnt und einheitlich.</td><td>Das Diskettensymbol löscht statt zu speichern; „OK“ steht mal links, mal rechts.</td></tr>
    <tr><td><strong>Erlernbarkeit</strong> <small>(früher Lernförderlichkeit)</small></td><td>Das System unterstützt beim Kennenlernen.</td><td>Keine Hilfe, keine Tooltips, keine Beispiele.</td></tr>
    <tr><td><strong>Steuerbarkeit</strong></td><td>Der Nutzer bestimmt Ablauf und Tempo, kann abbrechen und rückgängig machen.</td><td>Ein Assistent ohne „Zurück“ und „Abbrechen“.</td></tr>
    <tr><td><strong>Robustheit gegen Benutzungsfehler</strong> <small>(früher Fehlertoleranz)</small></td><td>Fehler werden verhindert oder lassen sich leicht korrigieren.</td><td>Ein Tippfehler löscht alle Eingaben im Formular; „Löschen“ ohne Rückfrage.</td></tr>
    <tr><td><strong>Benutzerbindung</strong> <small>(früher teils Individualisierbarkeit)</small></td><td>Die Nutzung ist ansprechend und motiviert zum Weiterarbeiten; Anpassungen an eigene Bedürfnisse sind möglich.</td><td>Starre, unübersichtliche Oberfläche ohne Einstellmöglichkeiten.</td></tr>
  </tbody>
</table>
</div>
<div class="lf-pruefung"><strong>Prüfungstipp:</strong> Typische Aufgabe: „Ordnen Sie den beschriebenen Mängeln je einen Grundsatz der ISO 9241-110 zu
und schlagen Sie eine Verbesserung vor.“ Schreibe immer Prinzip <em>und</em> konkrete Abhilfe – etwa „Steuerbarkeit: Schaltfläche
‚Abbrechen‘ auf jeder Seite des Assistenten“.</div>

<h6>Barrierefreiheit</h6>
<p>Software soll auch für Menschen mit Einschränkungen nutzbar sein. Öffentliche Stellen sind über die BITV 2.0 dazu verpflichtet;
seit dem 28. Juni 2025 gilt mit dem <strong>Barrierefreiheitsstärkungsgesetz</strong> auch für viele private Angebote, etwa
Onlineshops und Bankdienstleistungen. Maßstab sind die Web Content Accessibility Guidelines (<strong>WCAG</strong>) mit vier Prinzipien:</p>
<ul>
  <li><strong>Wahrnehmbar:</strong> Alternativtexte für Bilder, ausreichender Kontrast, Untertitel, Informationen nicht nur über Farbe.</li>
  <li><strong>Bedienbar:</strong> alles per Tastatur erreichbar, sichtbarer Fokus, genug Zeit für Eingaben.</li>
  <li><strong>Verständlich:</strong> einfache Sprache, verständliche Fehlermeldungen, beschriftete Eingabefelder.</li>
  <li><strong>Robust:</strong> sauberes, standardkonformes HTML, damit Screenreader die Seite richtig vorlesen.</li>
</ul>

<h6>Von der Idee zur Oberfläche</h6>
<p>Oberflächen entstehen in Stufen. Je früher ein Fehler im Entwurf auffällt, desto billiger ist er zu beheben – an einer Papierskizze
ändert man in Sekunden, was im fertigen Programm Tage kostet.</p>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf8/entwurfsstufen-ui.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Derselbe Anmeldebildschirm als Skizze, Wireframe, Mockup und klickbarer Prototyp">
  <figcaption class="figure-caption">Skizze, Wireframe, Mockup und Prototyp – mit steigender Detailtreue</figcaption>
</figure>
<div class="table-responsive">
<table class="table table-sm table-bordered align-middle">
  <thead class="table-light"><tr><th>Stufe</th><th>Zeigt</th><th>Wofür</th><th>Werkzeuge</th></tr></thead>
  <tbody>
    <tr><td>Skizze (Scribble)</td><td>die grobe Idee</td><td>Brainstorming, erste Abstimmung</td><td>Papier, Whiteboard</td></tr>
    <tr><td>Wireframe</td><td>Struktur, Anordnung, Inhalte – ohne Farben</td><td>Navigation und Aufbau festlegen</td><td>Balsamiq, draw.io</td></tr>
    <tr><td>Mockup</td><td>das visuelle Design (Farben, Schriften, Bilder), statisch</td><td>Aussehen mit dem Kunden abstimmen</td><td>Figma, Adobe XD</td></tr>
    <tr><td>Prototyp</td><td>interaktive Bedienung (klickbar)</td><td>Usability-Tests mit echten Nutzern</td><td>Figma, Axure, HTML</td></tr>
  </tbody>
</table>
</div>
<p>Ein <strong>horizontaler</strong> Prototyp zeigt viele Bildschirme, aber ohne Funktion dahinter; ein <strong>vertikaler</strong>
Prototyp setzt eine einzelne Funktion vollständig um, durch alle Schichten bis zur Datenbank.</p>

<h6>Übung mit Lösung</h6>
<p>Ordne jedem Mangel ein Prinzip der ISO 9241-110 zu: (a) Nach dem Absenden eines fehlerhaften Formulars sind alle Felder leer.
(b) Im Bestellprozess gibt es keine Möglichkeit, zum Warenkorb zurückzukehren. (c) Ein Pflichtfeld ist nicht als solches gekennzeichnet.
(d) In der Kundenmaske heißt die Schaltfläche „Commit“, in der Artikelmaske „Speichern“.</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<ul class="mt-2">
  <li>(a) <strong>Robustheit gegen Benutzungsfehler</strong> (Fehlertoleranz) – Eingaben behalten, nur das fehlerhafte Feld markieren.</li>
  <li>(b) <strong>Steuerbarkeit</strong> – „Zurück zum Warenkorb“ anbieten.</li>
  <li>(c) <strong>Selbstbeschreibungsfähigkeit</strong> – Pflichtfelder mit * und Erklärung kennzeichnen.</li>
  <li>(d) <strong>Erwartungskonformität</strong> – einheitliche Begriffe in der ganzen Anwendung.</li>
</ul>
</details>
INHALT,
    'summary' => [
        'Usability (ISO 9241-11) = effektiv, effizient, zufriedenstellend.',
        'ISO 9241-110: Aufgabenangemessenheit, Selbstbeschreibungsfähigkeit, Erwartungskonformität, Erlernbarkeit, Steuerbarkeit, Robustheit gegen Benutzungsfehler, Benutzerbindung.',
        'Barrierefreiheit nach WCAG: wahrnehmbar, bedienbar, verständlich, robust – seit Juni 2025 auch für viele private Angebote Pflicht.',
        'Skizze → Wireframe (Struktur) → Mockup (Aussehen) → Prototyp (Bedienung) mit steigender Detailtreue.',
    ],
    'quiz' => [
        ['question' => 'Was ist der Unterschied zwischen Mockup und Prototyp?', 'answer' => 'Das Mockup zeigt das fertige Aussehen, ist aber statisch. Der Prototyp ist bedienbar (klickbar) und dient dazu, die Benutzung mit Nutzern zu testen.'],
        ['question' => 'Welches Prinzip verletzt ein Löschbefehl ohne Rückfrage und ohne Rückgängig-Funktion?', 'answer' => 'Robustheit gegen Benutzungsfehler (früher Fehlertoleranz); teilweise auch Steuerbarkeit.'],
        ['question' => 'Nenne zwei Maßnahmen, damit eine Webseite für blinde Menschen nutzbar ist.', 'answer' => 'Zum Beispiel Alternativtexte für Bilder, beschriftete Formularfelder, vollständige Tastaturbedienung, sauberes semantisches HTML für Screenreader.'],
        ['question' => 'Was bedeutet „effizient“ im Sinne der ISO 9241-11?', 'answer' => 'Das Ziel wird mit angemessenem Aufwand erreicht – wenig Zeit, wenige Schritte, geringe Denkarbeit.'],
    ],
];
