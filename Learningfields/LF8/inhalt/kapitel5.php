<?php
return [
    'title' => 'Das Aktivitätsdiagramm',
    'intro' => 'Das Aktivitätsdiagramm zeigt Abläufe – mit Verzweigungen, Parallelität und Verantwortlichkeiten. Es ist die UML-Antwort auf Programmablaufplan und Geschäftsprozessmodell.',
    'goals' => [
        'die Elemente des Aktivitätsdiagramms benennen und korrekt zeichnen',
        'Entscheidungen mit Bedingungen (Guards) und parallele Abläufe modellieren',
        'Verantwortlichkeiten mit Schwimmbahnen darstellen',
        'einen beschriebenen Ablauf als Aktivitätsdiagramm umsetzen',
    ],
    'content' => <<<'INHALT'
<p>Während das Anwendungsfalldiagramm nur zeigt, <em>dass</em> es „Bestellung aufgeben“ gibt, zeigt das
<strong>Aktivitätsdiagramm</strong>, <em>wie</em> dieser Ablauf Schritt für Schritt funktioniert. Es eignet sich für Geschäftsprozesse
(wer macht was?) genauso wie für Algorithmen (welcher Schritt folgt auf welchen?).</p>

<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf8/aktivitaetsdiagramm.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Aktivitätsdiagramm mit Schwimmbahnen Kunde, Onlineshop und Lager, Entscheidung verfügbar oder nicht, Gabelung in parallele Zahlung und Kommissionierung, Vereinigung und Versand">
  <figcaption class="figure-caption">Aktivitätsdiagramm „Bestellung bearbeiten“ mit drei Schwimmbahnen</figcaption>
</figure>

<h6>Die Elemente</h6>
<div class="table-responsive">
<table class="table table-sm table-bordered align-middle">
  <thead class="table-light"><tr><th>Element</th><th>Darstellung</th><th>Bedeutung</th></tr></thead>
  <tbody>
    <tr><td>Startknoten</td><td>gefüllter Kreis</td><td>Beginn des Ablaufs (genau ein Startpunkt je Ablauf)</td></tr>
    <tr><td>Aktion</td><td>Rechteck mit stark abgerundeten Ecken</td><td>ein Arbeitsschritt, als Verb formuliert („Zahlung abwickeln“)</td></tr>
    <tr><td>Kontrollfluss</td><td>Pfeil</td><td>Reihenfolge: Nach dieser Aktion folgt jene</td></tr>
    <tr><td>Entscheidung</td><td>Raute mit einem Eingang und mehreren Ausgängen</td><td>Verzweigung; an jedem Ausgang eine Bedingung in eckigen Klammern, z. B. <code>[verfügbar]</code></td></tr>
    <tr><td>Zusammenführung</td><td>Raute mit mehreren Eingängen</td><td>alternative Wege laufen wieder zusammen</td></tr>
    <tr><td>Gabelung</td><td>dicker Balken, ein Eingang, mehrere Ausgänge</td><td>Ab hier laufen Aktionen <strong>parallel</strong></td></tr>
    <tr><td>Vereinigung</td><td>dicker Balken, mehrere Eingänge</td><td>wartet, bis <strong>alle</strong> parallelen Zweige fertig sind</td></tr>
    <tr><td>Endknoten</td><td>Kreis mit gefülltem Punkt</td><td>beendet die <em>gesamte</em> Aktivität</td></tr>
    <tr><td>Ablaufende</td><td>Kreis mit X</td><td>beendet nur diesen einen Zweig, andere parallele Zweige laufen weiter</td></tr>
    <tr><td>Schwimmbahn</td><td>Spalten (Partitionen) mit Überschrift</td><td>Wer ist für die Aktionen in der Spalte verantwortlich?</td></tr>
    <tr><td>Objektknoten</td><td>normales Rechteck im Fluss</td><td>ein Objekt, das zwischen Aktionen weitergegeben wird (z. B. „Rechnung“)</td></tr>
  </tbody>
</table>
</div>
<div class="lf-pruefung"><strong>Prüfungstipp:</strong> Die Bedingungen an einer Entscheidung müssen sich gegenseitig ausschließen und
zusammen alle Fälle abdecken: <code>[Betrag &gt; 100]</code> und <code>[Betrag &lt;= 100]</code> – nicht <code>[Betrag &gt; 100]</code>
und <code>[Betrag &lt; 100]</code>, denn dann fehlt genau 100. Und: Eine Raute ist eine Entscheidung, ein Balken ist Parallelität – nie verwechseln.</div>

<h6>Entscheidung oder Parallelität?</h6>
<p>Bei der <strong>Entscheidung</strong> (Raute) wird <em>genau ein</em> Weg genommen. Bei der <strong>Gabelung</strong> (Balken)
werden <em>alle</em> Wege gleichzeitig gegangen. Im Beispiel kommissioniert das Lager die Ware, während der Shop die Zahlung
abwickelt – das spart Zeit. Versendet wird erst, wenn beides erledigt ist: Dafür sorgt die Vereinigung.</p>

<h6>Schleifen</h6>
<p>Eine Wiederholung zeichnest du mit einer Entscheidung, deren einer Ausgang <em>zurück</em> zu einer früheren Aktion führt,
zum Beispiel: „Passwort eingeben“ → Raute → <code>[falsch und weniger als 3 Versuche]</code> zurück zu „Passwort eingeben“,
<code>[richtig]</code> weiter, <code>[3 Fehlversuche]</code> zu „Konto sperren“.</p>

<div class="lf-merke"><strong>Vergleich:</strong> Programmablaufplan (PAP) und Struktogramm aus LF5 beschreiben ebenfalls Abläufe,
kennen aber weder Parallelität noch Verantwortlichkeiten. Das Aktivitätsdiagramm ist universeller und wird deshalb auch für Geschäftsprozesse genutzt.</div>

<h6>So gehst du bei einer Aufgabe vor</h6>
<ol>
  <li>Beteiligte bestimmen → Schwimmbahnen anlegen.</li>
  <li>Die Schritte des Textes in Reihenfolge als Aktionen (Verb!) notieren und in die richtige Bahn setzen.</li>
  <li>Bei „wenn … dann … sonst“ eine Entscheidung mit vollständigen Bedingungen einfügen.</li>
  <li>Bei „gleichzeitig“, „parallel“, „während“ eine Gabelung und eine Vereinigung einfügen.</li>
  <li>Start- und Endknoten ergänzen, prüfen, dass jeder Weg an einem Ende ankommt.</li>
</ol>

<h6>Übung mit Lösung</h6>
<p>„Ein Kunde meldet eine Störung über das Ticketportal. Der First-Level-Support prüft das Ticket. Kann er es lösen,
informiert er den Kunden und schließt das Ticket. Sonst gibt er es an den Second-Level-Support weiter, der das Problem
behebt; anschließend informiert der First-Level-Support den Kunden und schließt das Ticket.“ Welche Schwimmbahnen,
Aktionen und Knoten brauchst du?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<ul class="mt-2">
  <li>Schwimmbahnen: <strong>Kunde</strong>, <strong>First-Level-Support</strong>, <strong>Second-Level-Support</strong></li>
  <li>Start → (Kunde) Störung melden → (1st) Ticket prüfen → Entscheidung</li>
  <li><code>[lösbar]</code> → Zusammenführung; <code>[nicht lösbar]</code> → (1st) Ticket weitergeben → (2nd) Problem beheben → Zusammenführung</li>
  <li>Zusammenführung → (1st) Kunden informieren → (1st) Ticket schließen → Ende</li>
  <li>Die Zusammenführung (Raute) vermeidet, dass „Kunden informieren“ zweimal gezeichnet werden muss. Parallelität gibt es hier nicht.</li>
</ul>
</details>
INHALT,
    'summary' => [
        'Aktivitätsdiagramm = Verhaltensdiagramm für Abläufe: Start, Aktionen, Kontrollfluss, Ende.',
        'Raute = Entscheidung/Zusammenführung mit vollständigen, sich ausschließenden Bedingungen in eckigen Klammern.',
        'Balken = Gabelung (parallel weiter) und Vereinigung (wartet auf alle Zweige).',
        'Endknoten beendet alles, Ablaufende (Kreis mit X) nur einen Zweig.',
        'Schwimmbahnen zeigen, wer verantwortlich ist.',
    ],
    'quiz' => [
        ['question' => 'Was ist der Unterschied zwischen Endknoten und Ablaufende?', 'answer' => 'Der Endknoten beendet die gesamte Aktivität, auch parallele Zweige. Das Ablaufende beendet nur den Zweig, in dem es steht.'],
        ['question' => 'Wie stellst du dar, dass zwei Aktionen gleichzeitig ablaufen?', 'answer' => 'Mit einer Gabelung (dicker Balken) vor den Aktionen und einer Vereinigung (dicker Balken) danach.'],
        ['question' => 'Wo stehen die Bedingungen einer Entscheidung und wie werden sie geschrieben?', 'answer' => 'An den ausgehenden Kanten der Raute, in eckigen Klammern, z. B. [verfügbar] und [nicht verfügbar].'],
        ['question' => 'Wozu dienen Schwimmbahnen?', 'answer' => 'Sie ordnen jede Aktion einer verantwortlichen Rolle, Abteilung oder einem System zu.'],
    ],
];
