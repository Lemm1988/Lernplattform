<?php
return [
    'title' => 'Das Entity-Relationship-Modell',
    'intro' => 'Bevor die erste Tabelle entsteht, wird die Wirklichkeit modelliert: Welche Dinge gibt es, was weiß man über sie, und wie hängen sie zusammen?',
    'goals' => [
        'Entitäten, Attribute und Beziehungen aus einer Fachbeschreibung ableiten',
        'Kardinalitäten 1:1, 1:n und m:n bestimmen',
        'ER-Diagramme in Chen-, Min-Max- und Krähenfuß-Notation lesen und zeichnen',
        'Generalisierung und Beziehungsattribute einsetzen',
    ],
    'content' => <<<'INHALT'
<h6>Die Bausteine</h6>
<ul>
  <li><strong>Entität</strong>: ein unterscheidbares Objekt der realen Welt (das Fahrrad mit Rahmennummer WTU123). Gleichartige Entitäten bilden einen
  <strong>Entitätstyp</strong> (Fahrrad) – im Diagramm ein Rechteck.</li>
  <li><strong>Attribut</strong>: eine Eigenschaft (Modell, Tagespreis) – Ellipse. Das <strong>Schlüsselattribut</strong> identifiziert jede Entität eindeutig und wird
  unterstrichen.</li>
  <li><strong>Beziehung</strong>: ein Zusammenhang zwischen Entitäten (Kunde <em>leiht</em> Fahrrad) – Raute. Auch Beziehungen können Attribute haben (Zeitraum der Ausleihe).</li>
  <li><strong>Kardinalität</strong>: wie viele Entitäten an einer Beziehung beteiligt sein können.</li>
</ul>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf5/er-fahrradverleih.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="ER-Diagramm in Chen-Notation mit Filiale, Fahrrad und Kunde, Beziehungen besitzt (1:n) und leiht (m:n) mit den Attributen von und bis">
  <figcaption class="figure-caption">ER-Modell eines Fahrradverleihs in Chen-Notation</figcaption>
</figure>

<h6>Kardinalitäten</h6>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th>Typ</th><th>Bedeutung</th><th>Beispiele</th></tr></thead>
  <tbody>
    <tr><td>1:1</td><td>Zu einer Entität gehört höchstens eine Entität der anderen Seite – und umgekehrt.</td><td>Fahrrad – GPS-Tracker; Mitarbeiter – Dienstwagen</td></tr>
    <tr><td>1:n</td><td>Eine Entität der einen Seite steht mit vielen der anderen in Beziehung, jede davon aber mit nur einer.</td><td>Filiale – Fahrrad; Kunde – Rechnung</td></tr>
    <tr><td>m:n</td><td>Auf beiden Seiten beliebig viele.</td><td>Kunde – Fahrrad (leiht); Student – Kurs</td></tr>
  </tbody>
</table>
<p>Zur Bestimmung stellt man zwei Fragen – von jeder Seite aus: „Wie viele Fahrräder kann <em>eine</em> Filiale besitzen?“ (viele) und „Zu wie vielen Filialen kann
<em>ein</em> Fahrrad gehören?“ (einer) → 1:n.</p>

<h6>Notationen</h6>
<p>In Prüfungen und Werkzeugen begegnen dir verschiedene Schreibweisen für dieselbe Aussage:</p>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf5/er-notationen.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Die Beziehung Filiale hat Fahrrad in Chen-Notation mit 1 und n, Min-Max-Notation mit (0,n) und (1,1), Krähenfuß-Notation und UML mit 1 und 0..*">
  <figcaption class="figure-caption">Vier Notationen, eine Aussage</figcaption>
</figure>
<p>Achtung bei der <strong>(min, max)-Notation</strong>: Das Zahlenpaar steht bei der Entität, deren Teilnahme es beschreibt – „eine Filiale nimmt 0- bis n-mal an der
Beziehung teil“. Dadurch stehen die Werte gegenüber der Chen-Notation scheinbar „vertauscht“. Die (min, max)-Notation ist genauer, weil sie auch Pflicht
(min = 1) und Kann (min = 0) ausdrückt.</p>

<h6>Generalisierung und Spezialisierung</h6>
<p>Haben mehrere Entitätstypen gemeinsame Attribute, fasst man sie zusammen: <strong>E-Bike</strong> und <strong>Lastenrad</strong> sind spezielle <strong>Fahrräder</strong>
(„ist-ein“-Beziehung). Gemeinsame Attribute (RahmenNr, Modell) stehen beim allgemeinen Typ, besondere beim speziellen (Akkukapazität beim E-Bike, Zuladung beim Lastenrad).
Das entspricht der Vererbung in der Objektorientierung (LF8 Kapitel 2).</p>

<h6>Vom Text zum Modell</h6>
<p>So gehst du bei einer Prüfungsaufgabe vor:</p>
<ol>
  <li><strong>Substantive</strong> markieren: Kandidaten für Entitätstypen und Attribute. Hat etwas eigene Eigenschaften und kommt mehrfach vor, ist es eine Entität; beschreibt es
  nur etwas, ist es ein Attribut.</li>
  <li><strong>Verben</strong> markieren: Kandidaten für Beziehungen.</li>
  <li>Für jede Beziehung die Kardinalität mit den zwei Fragen bestimmen.</li>
  <li>Schlüsselattribute festlegen; fehlt ein natürlicher Schlüssel, eine Nummer vergeben.</li>
  <li>Ergebnis gegen den Text prüfen: Lässt sich jede Aussage des Textes im Modell wiederfinden?</li>
</ol>
<div class="lf-merke"><strong>Merke:</strong> Das ER-Modell ist ein <em>konzeptionelles</em> Modell – es kennt noch keine Tabellen und keine Fremdschlüssel. Wie daraus Tabellen
werden, zeigt Kapitel 5.</div>

<h6>Übungen mit Lösung</h6>
<p>1. „Eine Bibliothek verwaltet Bücher mit ISBN, Titel und Erscheinungsjahr. Jedes Buch hat einen oder mehrere Autoren; ein Autor kann mehrere Bücher geschrieben haben.
Leser mit Ausweisnummer und Namen leihen Exemplare aus; jedes Exemplar gehört zu genau einem Buch.“ Nenne Entitätstypen, Beziehungen und Kardinalitäten.</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Entitätstypen: Buch (ISBN, Titel, Jahr), Autor (AutorNr, Name), Exemplar (ExemplarNr), Leser (AusweisNr, Name). Beziehungen: Autor <em>schreibt</em> Buch
(m:n), Buch <em>hat</em> Exemplar (1:n), Leser <em>leiht</em> Exemplar (m:n über die Zeit; zu einem Zeitpunkt 1:n) mit Beziehungsattributen Ausleihdatum und
Rückgabedatum.</p>
</details>
<p>2. Ist „Ort“ beim Kunden ein Attribut oder ein eigener Entitätstyp?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Meist ein Attribut. Soll man aber Informationen <em>über</em> Orte speichern (PLZ, Bundesland, Liefergebiet) und Orte mehrfach verwenden, wird ein eigener Entitätstyp daraus –
das vermeidet auch Schreibvarianten wie „Köln“ und „Koeln“.</p>
</details>
<p>3. Übersetze in (min, max)-Notation: Jeder Mitarbeiter gehört zu genau einer Abteilung; eine Abteilung hat mindestens einen Mitarbeiter.</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Mitarbeiter <strong>(1,1)</strong> — gehört zu — <strong>(1,n)</strong> Abteilung. Das Paar steht jeweils bei der Entität, deren Teilnahme es beschreibt.</p>
</details>
INHALT,
    'summary' => [
        'Entitätstyp (Rechteck), Attribut (Ellipse, Schlüssel unterstrichen), Beziehung (Raute) – auch Beziehungen können Attribute haben.',
        'Kardinalitäten 1:1, 1:n, m:n; bestimmen mit zwei Fragen von beiden Seiten aus.',
        'Chen (Zahlen beim Partner), (min,max) (Paar bei der teilnehmenden Entität), Krähenfuß, UML.',
        'Generalisierung: gemeinsame Attribute im allgemeinen Typ, „ist-ein“-Beziehung.',
        'Aus Texten: Substantive → Entitäten/Attribute, Verben → Beziehungen; ER-Modell ist konzeptionell, ohne Tabellen.',
    ],
    'quiz' => [
        ['question' => 'Welche Kardinalität hat die Beziehung „Student belegt Kurs“?', 'answer' => 'm:n – ein Student belegt viele Kurse, ein Kurs hat viele Studenten.'],
        ['question' => 'Wie wird ein Schlüsselattribut im ER-Diagramm gekennzeichnet?', 'answer' => 'Es wird unterstrichen.'],
        ['question' => 'Was drückt (0,n) bei einer Entität in der Min-Max-Notation aus?', 'answer' => 'Dass eine Entität dieses Typs an der Beziehung gar nicht oder beliebig oft teilnimmt.'],
        ['question' => 'Was ist ein Beziehungsattribut?', 'answer' => 'Ein Attribut, das zur Beziehung und nicht zu einer der Entitäten gehört, z. B. das Ausleihdatum bei „Kunde leiht Fahrrad“.'],
    ],
];
