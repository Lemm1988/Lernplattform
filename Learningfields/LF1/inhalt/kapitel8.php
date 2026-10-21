<?php
return [
    'title' => 'Den Ausbildungsbetrieb präsentieren',
    'intro' => 'Am Ende von LF1 steht oft eine Präsentation des eigenen Betriebs – und am Ende der Ausbildung die Projektpräsentation vor dem Prüfungsausschuss. Beides gelingt mit derselben Handwerkskunst: klare Botschaft, klare Struktur, klare Folien.',
    'goals' => [
        'einen Steckbrief des Ausbildungsbetriebs erstellen',
        'eine Präsentation nach Ziel und Zielgruppe planen',
        'Folien mit einer Aussage je Folie gestalten',
        'den passenden Diagrammtyp für eine Aussage wählen',
        'frei vortragen und mit Fragen umgehen',
    ],
    'content' => <<<'INHALT'
<h6>Steckbrief des Unternehmens</h6>
<p>Die vorigen Kapitel liefern das Gerüst. Ein Steckbrief beantwortet:</p>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th>Bereich</th><th>Fragen</th></tr></thead>
  <tbody>
    <tr><td>Basisdaten</td><td>Name (Firma), Rechtsform, Gründung, Sitz und Standorte, Branche, Wirtschaftssektor</td></tr>
    <tr><td>Leistungen und Kunden</td><td>Produkte und Dienstleistungen, Kundengruppen, Wettbewerber, Alleinstellungsmerkmal</td></tr>
    <tr><td>Organisation</td><td>Organigramm, Zahl der Beschäftigten und Auszubildenden, Abteilungen, Kernprozesse</td></tr>
    <tr><td>Ziele und Werte</td><td>Leitbild, ökonomische, ökologische und soziale Ziele, Zertifizierungen</td></tr>
    <tr><td>Meine Rolle</td><td>Abteilung, Aufgaben, Ansprechpartner, Projekte, Lernziele</td></tr>
  </tbody>
</table>
<p>Vertrauliche Zahlen (Umsatz, Gehälter, Kundennamen) nur zeigen, wenn der Betrieb zustimmt – im Zweifel gerundete oder relative Angaben verwenden.</p>

<h6>Planen</h6>
<ol>
  <li><strong>Ziel</strong>: Was sollen die Zuhörer danach wissen, denken oder tun? In einem Satz formulieren.</li>
  <li><strong>Zielgruppe</strong>: Vorwissen, Erwartungen, Zeitbudget. Für die Klasse anders als für die Geschäftsleitung oder den Prüfungsausschuss.</li>
  <li><strong>Aufbau</strong>: Einstieg (Interesse wecken, Überblick), Hauptteil (wenige, logisch geordnete Punkte), Schluss (Zusammenfassung, Ausblick, Dank, Fragen).
    Faustregel für die Zeit: etwa 10–15 % Einstieg, 70–80 % Hauptteil, 10–15 % Schluss.</li>
  <li><strong>Medien</strong>: Folien, Whiteboard, Live-Demo, Handout – passend zur Aussage, nicht weil es geht.</li>
</ol>

<h6>Folien gestalten</h6>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf1/folie-vorher-nachher.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Links eine überladene Folie mit vielen kleinen Stichpunkten und einer Tabelle, rechts eine Folie mit einer Aussage als Titel und einem Balkendiagramm">
  <figcaption class="figure-caption">Weniger ist mehr – eine Aussage pro Folie</figcaption>
</figure>
<ul>
  <li>Der Folientitel ist eine <strong>Aussage</strong>, nicht nur ein Thema: „Support löst 68 % beim ersten Anruf“ statt „Support“.</li>
  <li>Wenig Text, große Schrift, hoher Kontrast; ein einheitliches Layout. Bilder und Diagramme statt Textwüsten.</li>
  <li>Quellen angeben – bei fremden Bildern auch die Nutzungsrechte beachten (<a href="/Learningfields/LF12/kapitel9.php">LF12 Kapitel 9</a>).</li>
  <li>Barrierefreiheit mitdenken: Farbe nie als einziges Merkmal, ausreichende Schriftgröße, Diagramme direkt beschriften.</li>
</ul>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf1/diagrammwahl.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Vier Mini-Diagramme: Balken für Vergleiche, Linie für Entwicklungen, 100-Prozent-Balken für Anteile, Tabelle für genaue Werte">
  <figcaption class="figure-caption">Die Aussage bestimmt das Diagramm</figcaption>
</figure>

<h6>Vortragen</h6>
<ul>
  <li><strong>Frei sprechen</strong> mit Stichwortkarten oder Referentenansicht – nicht die Folien vorlesen.</li>
  <li><strong>Blickkontakt</strong>, ruhiges Tempo, Pausen nach wichtigen Punkten; Körperhaltung offen, Hände sichtbar.</li>
  <li><strong>Zeit einhalten</strong>: vorher laut proben und stoppen. In der Prüfung ist die Zeit begrenzt.</li>
  <li><strong>Fragen</strong>: ausreden lassen, kurz wiederholen, ehrlich antworten. „Das weiß ich nicht, ich würde es so herausfinden: …“ ist besser als Raten.</li>
  <li>Technik vorher prüfen (Adapter, Beamer, Demo offline lauffähig) und einen Plan B haben (PDF auf USB-Stick).</li>
</ul>

<h6>Übungen mit Lösung</h6>
<p>1. Welcher Diagrammtyp passt? (a) Tickets pro Monat über zwei Jahre, (b) Umsatz je Produktgruppe, (c) Anteil der Kundengruppen am Umsatz (drei Gruppen).</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">(a) Liniendiagramm (Entwicklung über die Zeit). (b) Balkendiagramm (Vergleich von Kategorien). (c) 100-%-Balken oder – bei nur drei Teilen – ein Kreisdiagramm.</p>
</details>
<p>2. Formuliere für eine Folie über den Service Desk einen Aussagetitel: Im letzten Quartal wurden 1500 von 2000 Tickets innerhalb der vereinbarten Zeit gelöst.</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Zum Beispiel: „75 % der Tickets innerhalb der vereinbarten Zeit gelöst“ – oder, wenn das Ziel höher lag: „Ein Viertel der Tickets überschreitet die Lösungszeit“.</p>
</details>
<p>3. Du hast 10 Minuten für die Vorstellung deines Betriebs. Wie teilst du die Zeit auf?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Etwa 1 Minute Einstieg (Wer bin ich, worum geht es), 8 Minuten Hauptteil (Basisdaten, Leistungen, Organisation, meine Rolle), 1 Minute Schluss (Zusammenfassung, Ausblick, Fragen).</p>
</details>
INHALT,
    'summary' => [
        'Steckbrief: Basisdaten, Leistungen und Kunden, Organisation, Ziele und Werte, eigene Rolle; Vertrauliches nur mit Zustimmung.',
        'Planung: Ziel in einem Satz, Zielgruppe, Aufbau Einstieg – Hauptteil – Schluss, passende Medien.',
        'Folien: eine Aussage als Titel, wenig Text, große Schrift, Diagramme statt Textwüsten, Quellen.',
        'Diagrammwahl: Balken für Vergleiche, Linie für Entwicklungen, 100-%-Balken für Anteile, Tabelle für genaue Werte.',
        'Vortrag: frei sprechen, Blickkontakt, Zeit proben, ehrlich auf Fragen antworten, Plan B für die Technik.',
    ],
    'quiz' => [
        ['question' => 'Welcher Diagrammtyp eignet sich für eine Entwicklung über die Zeit?', 'answer' => 'Das Liniendiagramm.'],
        ['question' => 'Was ist ein Aussagetitel auf einer Folie?', 'answer' => 'Ein Titel, der die Kernbotschaft der Folie als Satz formuliert, statt nur das Thema zu nennen.'],
        ['question' => 'Wie wird eine Präsentation grob gegliedert?', 'answer' => 'In Einstieg, Hauptteil und Schluss.'],
        ['question' => 'Wann ist eine Tabelle besser als ein Diagramm?', 'answer' => 'Wenn das Publikum genaue Einzelwerte nachschlagen muss.'],
    ],
];
