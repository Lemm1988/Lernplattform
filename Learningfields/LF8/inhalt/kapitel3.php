<?php
return [
    'title' => 'UML und das Anwendungsfalldiagramm',
    'intro' => 'Mit UML planst du Software, bevor eine Zeile Code entsteht. Das Anwendungsfalldiagramm zeigt, wer was mit dem System machen kann – meist das erste Diagramm in einem Projekt.',
    'goals' => [
        'Zweck der UML erklären und Struktur- von Verhaltensdiagrammen unterscheiden',
        'Akteure, Anwendungsfälle, Systemgrenze, «include», «extend» und Generalisierung korrekt einsetzen',
        'ein Anwendungsfalldiagramm aus einer Aufgabenbeschreibung erstellen',
        'einen Anwendungsfall strukturiert beschreiben',
    ],
    'content' => <<<'INHALT'
<p>Die <strong>Unified Modeling Language (UML)</strong> ist eine grafische Sprache, um Software zu planen und zu dokumentieren.
Sie ist standardisiert (Object Management Group, aktuell Version 2.5) und unabhängig von der Programmiersprache: Ein
Klassendiagramm lässt sich in Java, C# oder Python umsetzen. Diagramme sind schneller verstanden und leichter zu ändern
als Code – Fehler in der Planung sind am günstigsten, solange es nur ein Bild ist.</p>

<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf8/uml-diagrammarten.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Übersicht der UML-Diagrammarten: Strukturdiagramme und Verhaltensdiagramme, prüfungsrelevante hervorgehoben">
  <figcaption class="figure-caption">Strukturdiagramme zeigen den Aufbau, Verhaltensdiagramme die Abläufe</figcaption>
</figure>

<h6>Elemente des Anwendungsfalldiagramms</h6>
<p>Das Anwendungsfalldiagramm (engl. <em>use case diagram</em>) beschreibt das System <strong>von außen</strong>:
Welche Funktionen bietet es, und wer nutzt sie? Wie etwas intern abläuft, zeigt es bewusst nicht.</p>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf8/anwendungsfalldiagramm.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Anwendungsfalldiagramm eines Onlineshops mit Akteuren Kunde, Stammkunde, Kundendienst und Zahlungsdienstleister, Anwendungsfällen, include und extend">
  <figcaption class="figure-caption">Anwendungsfalldiagramm für einen Onlineshop</figcaption>
</figure>
<div class="table-responsive">
<table class="table table-sm table-bordered align-middle">
  <thead class="table-light"><tr><th>Element</th><th>Darstellung</th><th>Bedeutung</th></tr></thead>
  <tbody>
    <tr><td><strong>Akteur</strong></td><td>Strichmännchen (oder Rechteck mit «actor»)</td><td>Rolle außerhalb des Systems, die mit ihm interagiert – ein Mensch <em>oder</em> ein anderes System (z. B. Zahlungsdienstleister)</td></tr>
    <tr><td><strong>Anwendungsfall</strong></td><td>Ellipse mit Verb + Objekt</td><td>Funktion mit einem für den Akteur sichtbaren Nutzen („Bestellung aufgeben“)</td></tr>
    <tr><td><strong>Systemgrenze</strong></td><td>Rechteck mit Systemnamen</td><td>Was gehört zum System? Anwendungsfälle innen, Akteure immer außen</td></tr>
    <tr><td><strong>Assoziation</strong></td><td>durchgezogene Linie</td><td>Der Akteur ist an diesem Anwendungsfall beteiligt</td></tr>
    <tr><td><strong>«include»</strong></td><td>gestrichelter Pfeil <em>vom Basisfall zum eingebundenen Fall</em></td><td>Der eingebundene Ablauf gehört <strong>immer</strong> dazu: Ohne Zahlung keine Bestellung</td></tr>
    <tr><td><strong>«extend»</strong></td><td>gestrichelter Pfeil <em>vom erweiternden Fall zum Basisfall</em></td><td>Optionale Erweiterung unter einer Bedingung: Gutschein nur, wenn der Kunde einen hat</td></tr>
    <tr><td><strong>Generalisierung</strong></td><td>durchgezogene Linie mit hohler Dreiecksspitze</td><td>Spezialisierung: Ein Stammkunde kann alles, was ein Kunde kann, und ggf. mehr</td></tr>
  </tbody>
</table>
</div>
<div class="lf-pruefung"><strong>Prüfungsfalle Pfeilrichtung:</strong> Bei «include» zeigt der Pfeil auf den Fall, der <em>immer</em> eingebunden wird
(Bestellung aufgeben → Zahlung durchführen). Bei «extend» zeigt er auf den Basisfall, der <em>erweitert</em> wird
(Gutschein einlösen → Bestellung aufgeben). Merkhilfe: Der Pfeil zeigt jeweils von dem, der etwas „will“, zu dem, „was gebraucht“ bzw. „ergänzt“ wird.</div>

<h6>So erstellst du ein Anwendungsfalldiagramm aus einer Aufgabe</h6>
<ol>
  <li><strong>Systemgrenze festlegen:</strong> Welches System wird gebaut? Der Name kommt ins Rechteck.</li>
  <li><strong>Akteure finden:</strong> Wer oder was außerhalb nutzt das System oder wird von ihm genutzt? Auf Rollen achten („Kunde“, nicht „Frau Meier“).</li>
  <li><strong>Anwendungsfälle sammeln:</strong> Was wollen die Akteure erreichen? Immer als „Verb + Objekt“ formulieren.</li>
  <li><strong>Assoziationen zeichnen:</strong> Akteur und Anwendungsfall verbinden – ohne Pfeilspitzen.</li>
  <li><strong>Gemeinsames auslagern:</strong> Teilabläufe, die mehrere Fälle immer brauchen → «include». Optionale Zusätze → «extend».</li>
  <li><strong>Prüfen:</strong> Akteure stehen außen, kein Anwendungsfall ohne Akteur (außer eingebundene Fälle), keine Ablaufreihenfolge im Diagramm.</li>
</ol>
<div class="lf-merke"><strong>Merke:</strong> Ein Anwendungsfalldiagramm hat keine Reihenfolge. „Erst anmelden, dann bestellen“ gehört in ein
Aktivitätsdiagramm oder in die Anwendungsfallbeschreibung, nicht in die Anordnung der Ellipsen.</div>

<h6>Die Anwendungsfallbeschreibung</h6>
<p>Das Diagramm ist nur die Landkarte. Die Details stehen in einer tabellarischen Beschreibung je Anwendungsfall:</p>
<div class="table-responsive">
<table class="table table-sm table-bordered align-middle">
  <tbody>
    <tr><th class="table-light">Name</th><td>Bestellung aufgeben</td></tr>
    <tr><th class="table-light">Akteur</th><td>Kunde (primär), Zahlungsdienstleister (sekundär)</td></tr>
    <tr><th class="table-light">Vorbedingung</th><td>Der Kunde ist angemeldet, der Warenkorb ist nicht leer.</td></tr>
    <tr><th class="table-light">Auslöser</th><td>Der Kunde klickt im Warenkorb auf „Zur Kasse“.</td></tr>
    <tr><th class="table-light">Ablauf</th><td>1. Lieferadresse bestätigen · 2. Versandart wählen · 3. Zahlung durchführen (include) · 4. Bestellübersicht prüfen und absenden · 5. Bestätigung per E-Mail</td></tr>
    <tr><th class="table-light">Alternativen</th><td>3a. Zahlung abgelehnt → Hinweis, andere Zahlungsart wählen · 2a. Gutschein einlösen (extend)</td></tr>
    <tr><th class="table-light">Nachbedingung</th><td>Die Bestellung ist gespeichert, der Lagerbestand reserviert.</td></tr>
  </tbody>
</table>
</div>

<h6>Übungen mit Lösung</h6>
<p>1. „Für eine Bibliothek soll ein Ausleihsystem entstehen. Mitglieder können den Katalog durchsuchen und Medien
ausleihen. Bei jeder Ausleihe wird der Mitgliedsausweis geprüft. Ist ein Medium verliehen, können Mitglieder es
optional vormerken. Mitarbeitende verbuchen Rückgaben und können alles, was Mitglieder können.“ Nenne Akteure,
Anwendungsfälle und Beziehungen.</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<ul class="mt-2">
  <li>Systemgrenze: Ausleihsystem. Akteure: <strong>Mitglied</strong>, <strong>Mitarbeiter</strong> (Generalisierung: Mitarbeiter → Mitglied, hohler Pfeil zeigt auf Mitglied).</li>
  <li>Anwendungsfälle: Katalog durchsuchen, Medium ausleihen, Ausweis prüfen, Medium vormerken, Rückgabe verbuchen.</li>
  <li>Medium ausleihen <strong>«include»</strong> Ausweis prüfen (Pfeil zu „Ausweis prüfen“), Medium vormerken <strong>«extend»</strong> Medium ausleihen (Pfeil zu „Medium ausleihen“).</li>
  <li>Mitglied ↔ durchsuchen, ausleihen; Mitarbeiter ↔ Rückgabe verbuchen.</li>
</ul>
</details>
<p>2. Was ist an diesem Anwendungsfall falsch: „Datenbank“ als Akteur innerhalb der Systemgrenze, verbunden mit „SQL-Abfrage ausführen“?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Zwei Fehler: Akteure stehen <strong>außerhalb</strong> der Systemgrenze, und „SQL-Abfrage ausführen“ ist ein
technischer Implementierungsschritt ohne Nutzen für einen Akteur – kein Anwendungsfall. Eine eigene Datenbank ist Teil des
Systems und erscheint gar nicht; nur ein fremdes System (z. B. die Warenwirtschaft eines Partners) wäre ein Akteur.</p>
</details>
INHALT,
    'summary' => [
        'UML ist eine standardisierte, sprachunabhängige grafische Modellierungssprache (OMG, Version 2.5).',
        'Strukturdiagramme zeigen den Aufbau (z. B. Klassendiagramm), Verhaltensdiagramme Abläufe (z. B. Anwendungsfall-, Aktivitäts-, Sequenzdiagramm).',
        'Anwendungsfalldiagramm: Akteure außerhalb, Anwendungsfälle (Verb + Objekt) innerhalb der Systemgrenze.',
        '«include» = immer dabei, Pfeil zum eingebundenen Fall; «extend» = optional, Pfeil zum Basisfall.',
        'Details (Vorbedingung, Ablauf, Alternativen, Nachbedingung) stehen in der Anwendungsfallbeschreibung.',
    ],
    'quiz' => [
        ['question' => 'Kann ein Akteur auch ein technisches System sein?', 'answer' => 'Ja, jedes externe System, das mit dem eigenen System interagiert (z. B. Zahlungsdienstleister, Mailserver eines Partners), ist ein Akteur.'],
        ['question' => 'In welche Richtung zeigt der Pfeil bei «extend»?', 'answer' => 'Vom erweiternden (optionalen) Anwendungsfall zum Basisfall, der erweitert wird.'],
        ['question' => 'Warum stellt das Anwendungsfalldiagramm keine Reihenfolge dar?', 'answer' => 'Es beschreibt nur, welche Funktionen es gibt und wer sie nutzt. Abläufe und Reihenfolgen zeigen Aktivitäts- oder Sequenzdiagramme bzw. die Anwendungsfallbeschreibung.'],
        ['question' => 'Nenne vier Bestandteile einer Anwendungsfallbeschreibung.', 'answer' => 'Zum Beispiel Name, Akteur, Vorbedingung, Auslöser, Ablauf (Hauptszenario), Alternativen, Nachbedingung.'],
    ],
];
