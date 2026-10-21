<?php
return [
    'title' => 'Die betriebliche Projektarbeit in der Abschlussprüfung',
    'intro' => 'Die Hälfte deiner Gesamtnote entscheidet sich an einem eigenen Projekt aus deinem Betrieb. So planst du Antrag, Durchführung, Dokumentation, Präsentation und Fachgespräch.',
    'goals' => [
        'Aufbau und Gewichtung der Abschlussprüfung Teil 2 für Fachinformatiker/-innen Anwendungsentwicklung kennen',
        'einen genehmigungsfähigen Projektantrag mit Zeitplan formulieren',
        'eine Projektdokumentation sinnvoll gliedern und einen Soll-Ist-Vergleich erstellen',
        'Präsentation und Fachgespräch vorbereiten',
    ],
    'content' => <<<'INHALT'
<h6>Die Prüfung im Überblick</h6>
<p>Die gestreckte Abschlussprüfung für Fachinformatiker/-innen der Fachrichtung Anwendungsentwicklung (Ausbildungsordnung 2020) setzt sich so zusammen:</p>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th>Teil</th><th>Prüfungsbereich</th><th>Gewicht</th></tr></thead>
  <tbody>
    <tr><td>Teil 1</td><td>Einrichten eines IT-gestützten Arbeitsplatzes</td><td>20 %</td></tr>
    <tr><td rowspan="4">Teil 2</td><td><strong>Planen und Umsetzen eines Softwareprojektes</strong> (betriebliche Projektarbeit)</td><td><strong>50 %</strong></td></tr>
    <tr><td>Planen eines Softwareproduktes</td><td>10 %</td></tr>
    <tr><td>Entwicklung und Umsetzung von Softwarealgorithmen</td><td>10 %</td></tr>
    <tr><td>Wirtschafts- und Sozialkunde</td><td>10 %</td></tr>
  </tbody>
</table>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf12/projektarbeit-ablauf.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Fünf Schritte: Projektantrag, Genehmigung, Durchführung mit höchstens 80 Stunden, Dokumentation, Präsentation und Fachgespräch mit zusammen höchstens 30 Minuten">
  <figcaption class="figure-caption">Vom Antrag bis zum Fachgespräch</figcaption>
</figure>
<p>Fristen, Formulare, Seitenumfang und Formatvorgaben legt deine <strong>IHK</strong> fest – lies deren Merkblatt, bevor du anfängst. Was hier steht, sind
die allgemeinen Regeln und bewährte Vorgehensweisen.</p>

<h6>Der Projektantrag</h6>
<p>Der Antrag muss vom Prüfungsausschuss genehmigt werden, bevor du mit dem Projekt beginnst. Er zeigt, dass das Projekt eine echte, betriebliche Aufgabe ist,
die du eigenständig in höchstens 80 Stunden lösen kannst. Typische Inhalte:</p>
<ul>
  <li><strong>Projektbezeichnung</strong>: knapp und konkret – „Entwicklung einer Online-Terminbuchung für Reparaturaufträge“.</li>
  <li><strong>Ausgangssituation</strong>: Ist-Zustand mit Problem und Zahlen (<a href="/Learningfields/LF12/kapitel1.php">Kapitel 1</a>).</li>
  <li><strong>Projektziel</strong>: Soll-Zustand, Abgrenzung (was gehört nicht dazu?).</li>
  <li><strong>Projektumfeld</strong>: Auftraggeber, Schnittstellen, vorhandene Technik.</li>
  <li><strong>Zeitplanung</strong> nach Phasen mit Stunden, Summe höchstens 80 Stunden.</li>
  <li><strong>Präsentationsmittel</strong>: Notebook, Beamer usw.</li>
</ul>
<table class="table table-sm table-bordered text-end" style="max-width: 460px">
  <thead class="table-light"><tr><th class="text-start">Phase</th><th>Stunden</th></tr></thead>
  <tbody>
    <tr><td class="text-start">Analyse (Ist-Analyse, Wirtschaftlichkeit, Lastenheft)</td><td>9</td></tr>
    <tr><td class="text-start">Entwurf (Datenmodell, Oberfläche, Pflichtenheft)</td><td>13</td></tr>
    <tr><td class="text-start">Implementierung</td><td>34</td></tr>
    <tr><td class="text-start">Qualitätssicherung (Tests, Code-Review)</td><td>9</td></tr>
    <tr><td class="text-start">Abnahme und Einführung</td><td>4</td></tr>
    <tr><td class="text-start">Dokumentation</td><td>11</td></tr>
    <tr class="fw-bold"><td class="text-start">Summe</td><td>80</td></tr>
  </tbody>
</table>
<div class="lf-pruefung"><strong>Prüfungstipp:</strong> Abgelehnt werden häufig Anträge, die zu klein sind (reine Routinearbeit, nur Installation), zu groß
(nicht in 80 Stunden machbar) oder bei denen der eigene Anteil unklar bleibt. Zeige Entscheidungen, die du selbst triffst: Variantenvergleich, Entwurf,
Wirtschaftlichkeitsbetrachtung, Tests.</div>

<h6>Die Projektdokumentation</h6>
<p>Eine bewährte Gliederung – sie spiegelt die Kapitel dieses Lernfelds wider:</p>
<ol>
  <li><strong>Einleitung</strong>: Projektumfeld, Ziel, Begründung, Schnittstellen, Abgrenzung</li>
  <li><strong>Projektplanung</strong>: Phasen, Ressourcen (Personal, Hard- und Software), Vorgehensmodell</li>
  <li><strong>Analyse</strong>: Ist-Analyse, Wirtschaftlichkeit (Make or Buy, Kosten, Amortisation), Anwendungsfälle, Anforderungen</li>
  <li><strong>Entwurf</strong>: Architektur, Datenmodell, Oberflächenentwürfe, Geschäftslogik (UML), Qualitätssicherung</li>
  <li><strong>Implementierung</strong>: wichtigste Umsetzungsschritte – das Interessante, nicht jede Zeile</li>
  <li><strong>Qualitätssicherung und Abnahme</strong>: Testkonzept, Testergebnisse, Abnahmeprotokoll</li>
  <li><strong>Einführung und Dokumentation</strong>: Deployment, Schulung, Benutzer- und Entwicklerdokumentation</li>
  <li><strong>Fazit</strong>: Soll-Ist-Vergleich, Lessons Learned, Ausblick</li>
</ol>
<p>Diagramme, Code-Auszüge, Testprotokolle und die Kundendokumentation kommen in den <strong>Anhang</strong>. Schreib sachlich, in der Ich- oder Passivform
(einheitlich), mit Quellenangaben; erkläre Fachbegriffe beim ersten Auftreten; beschrifte Abbildungen und Tabellen und verweise im Text darauf.</p>

<h6>Soll-Ist-Vergleich und Lessons Learned</h6>
<table class="table table-sm table-bordered text-end" style="max-width: 560px">
  <thead class="table-light"><tr><th class="text-start">Phase</th><th>Soll</th><th>Ist</th><th>Differenz</th></tr></thead>
  <tbody>
    <tr><td class="text-start">Analyse</td><td>9 h</td><td>8 h</td><td>−1 h</td></tr>
    <tr><td class="text-start">Entwurf</td><td>13 h</td><td>12 h</td><td>−1 h</td></tr>
    <tr><td class="text-start">Implementierung</td><td>34 h</td><td>37 h</td><td>+3 h</td></tr>
    <tr><td class="text-start">Qualitätssicherung</td><td>9 h</td><td>9 h</td><td>0 h</td></tr>
    <tr><td class="text-start">Abnahme und Einführung</td><td>4 h</td><td>3 h</td><td>−1 h</td></tr>
    <tr><td class="text-start">Dokumentation</td><td>11 h</td><td>11 h</td><td>0 h</td></tr>
    <tr class="fw-bold"><td class="text-start">Summe</td><td>80 h</td><td>80 h</td><td>0 h</td></tr>
  </tbody>
</table>
<p>Abweichungen werden <strong>begründet</strong> („Die Anbindung an den Mailserver erforderte drei Stunden mehr, weil SPF und DKIM eingerichtet werden mussten;
die Zeit wurde in Analyse, Entwurf und Einführung eingespart.“). <strong>Lessons Learned</strong> beschreiben, was du beim nächsten Projekt anders machen würdest –
ehrlich, aber konstruktiv.</p>

<h6>Präsentation und Fachgespräch</h6>
<ul>
  <li><strong>Präsentation</strong> (in der Regel etwa 15 Minuten): Ausgangslage und Ziel, Vorgehen, wichtigste Entscheidungen mit Begründung, Ergebnis (gern eine kurze
  Live-Vorführung oder Screenshots), Soll-Ist-Vergleich und Fazit. Wenige Folien, große Schrift, Diagramme statt Textwüsten; Zeit vorher mehrfach proben.</li>
  <li><strong>Fachgespräch</strong>: Der Ausschuss fragt zum Projekt und zu angrenzenden Fachthemen – „Warum haben Sie sich für eine relationale Datenbank entschieden?“,
  „Wie haben Sie die Software gegen SQL-Injection geschützt?“, „Was hätten Sie mit mehr Zeit anders gemacht?“. Du musst jede Entscheidung in der Dokumentation
  begründen und erklären können. „Das weiß ich nicht genau, ich würde es so herausfinden …“ ist besser als Raten.</li>
</ul>
<div class="lf-merke"><strong>Merke:</strong> Alle Kapitel dieses Lernfelds sind Bausteine deiner Projektarbeit: Auftragsanalyse (<a href="/Learningfields/LF12/kapitel1.php">Kapitel 1</a>), Wirtschaftlichkeit
(<a href="/Learningfields/LF12/kapitel2.php">Kapitel 2</a>), Planung (<a href="/Learningfields/LF12/kapitel3.php">Kapitel 3</a> und <a href="/Learningfields/LF12/kapitel4.php">4</a>), Steuerung (<a href="/Learningfields/LF12/kapitel5.php">Kapitel 5</a>), Werkzeuge (<a href="/Learningfields/LF12/kapitel6.php">Kapitel 6</a> bis <a href="/Learningfields/LF12/kapitel8.php">8</a>), Recht (<a href="/Learningfields/LF12/kapitel9.php">Kapitel 9</a>). Die technischen Inhalte aus <a href="/Learningfields/LF8/index.php">LF8</a>, <a href="/Learningfields/LF10/index.php">LF10</a> und <a href="/Learningfields/LF11/index.php">LF11</a>
liefern Entwurf, Umsetzung und Tests.</div>

<h6>Übungen mit Lösung</h6>
<p>1. Bewerte diesen Projektantrag: „Installation und Einrichtung von WordPress auf dem Firmenserver“ (40 Stunden).</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Für Anwendungsentwicklung ungeeignet: überwiegend Routinetätigkeit ohne eigene Entwicklungsleistung, Entwurf oder Variantenvergleich. Besser: ein
eigenes Plugin oder eine Anwendung mit Analyse, Entwurf, Implementierung und Tests, die den Rahmen von 80 Stunden ausschöpft.</p>
</details>
<p>2. Die Implementierung hat 8 Stunden länger gedauert als geplant. Wie gehst du in der Dokumentation damit um?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Im Soll-Ist-Vergleich offen ausweisen, die Ursache nennen und zeigen, wie der Rahmen von 80 Stunden eingehalten wurde (z. B. Umfang reduziert, Should-haves
verschoben) – und in den Lessons Learned festhalten, was du daraus gelernt hast. Verschweigen oder „glätten“ fällt im Fachgespräch auf.</p>
</details>
<p>3. Welche drei Fragen würdest du im Fachgespräch zur Terminbuchung erwarten?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Zum Beispiel: Warum Eigenentwicklung statt SaaS (Nutzwertanalyse)? Wie sind personenbezogene Daten geschützt (DSGVO, Hashing, HTTPS, Löschkonzept)? Wie
haben Sie getestet (Grenzwerte, E2E-Tests, Abnahme)? Was passiert, wenn zwei Kunden gleichzeitig denselben Termin buchen (Transaktionen, eindeutiger Schlüssel)?</p>
</details>
INHALT,
    'summary' => [
        'Abschlussprüfung FIAE: Teil 1 20 %, Projektarbeit 50 %, Planen eines Softwareproduktes 10 %, Algorithmen 10 %, WiSo 10 %.',
        'Projektantrag vor Beginn genehmigen lassen: Ausgangslage, Ziel, Umfeld, Zeitplan (≤ 80 h), Präsentationsmittel.',
        'Dokumentation: Einleitung, Planung, Analyse, Entwurf, Implementierung, QS/Abnahme, Einführung, Fazit; Details in den Anhang.',
        'Soll-Ist-Vergleich mit begründeten Abweichungen; Lessons Learned ehrlich und konstruktiv.',
        'Präsentation und Fachgespräch zusammen höchstens 30 Minuten; jede Entscheidung begründen können.',
    ],
    'quiz' => [
        ['question' => 'Wie viele Stunden darf die betriebliche Projektarbeit für FIAE höchstens umfassen?', 'answer' => 'Höchstens 80 Stunden.'],
        ['question' => 'Welchen Anteil an der Gesamtnote hat der Prüfungsbereich „Planen und Umsetzen eines Softwareprojektes“?', 'answer' => '50 Prozent.'],
        ['question' => 'Was gehört in einen Projektantrag?', 'answer' => 'Projektbezeichnung, Ausgangssituation, Projektziel mit Abgrenzung, Projektumfeld, Zeitplanung nach Phasen (≤ 80 h) und Präsentationsmittel.'],
        ['question' => 'Was ist ein Soll-Ist-Vergleich in der Projektdokumentation?', 'answer' => 'Die Gegenüberstellung geplanter und tatsächlicher Zeiten (und Ergebnisse) je Phase mit Begründung der Abweichungen.'],
    ],
];
