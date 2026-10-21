<?php
return [
    'title' => 'Den Kundenauftrag analysieren',
    'intro' => 'Am Anfang jedes Kundenprojekts steht die Frage: Was genau soll erreicht werden – und woran merken wir, dass es geschafft ist? Hier lernst du Ist-Analyse, Anforderungen, Ziele sowie Lasten- und Pflichtenheft.',
    'goals' => [
        'Merkmale eines Projekts nennen',
        'Ist-Analyse und Soll-Konzept erstellen und Stakeholder bestimmen',
        'funktionale und nichtfunktionale Anforderungen formulieren und mit MoSCoW priorisieren',
        'Projektziele SMART formulieren',
        'Lastenheft und Pflichtenheft unterscheiden',
    ],
    'content' => <<<'INHALT'
<p>Durch alle Kapitel von LF12 zieht sich ein Beispiel: Die <strong>Fahrradwerkstatt Speiche GmbH</strong> (Köln, 12 Mitarbeitende) nimmt Reparaturtermine bisher
nur telefonisch an. Sie beauftragt eine Softwarefirma mit einer <strong>Online-Terminbuchung</strong>.</p>

<h6>Was ist ein Projekt?</h6>
<p>Nach DIN 69901 ist ein Projekt ein Vorhaben, das im Wesentlichen durch die <strong>Einmaligkeit</strong> seiner Bedingungen gekennzeichnet ist:
ein klares <strong>Ziel</strong>, eine <strong>zeitliche Begrenzung</strong> (Start und Ende), begrenzte <strong>Ressourcen</strong> (Budget, Personal),
Abgrenzung gegenüber anderen Vorhaben und eine projektspezifische Organisation. Der laufende Betrieb der Terminbuchung ist danach kein Projekt mehr – ihre
Einführung schon.</p>

<h6>Ist-Analyse und Soll-Konzept</h6>
<p>Die <strong>Ist-Analyse</strong> beschreibt den heutigen Zustand mit Zahlen und Problemen; das <strong>Soll-Konzept</strong> beschreibt den gewünschten
Zustand. Aus dem Unterschied ergibt sich der Projektauftrag.</p>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th></th><th>Ist</th><th>Soll</th></tr></thead>
  <tbody>
    <tr><td>Terminvergabe</td><td>nur telefonisch, Mo–Fr 9–18 Uhr; ca. 25 Anrufe pro Tag, je ~4 Minuten</td><td>online rund um die Uhr, Telefon als Alternative</td></tr>
    <tr><td>Terminübersicht</td><td>Papierkalender an der Theke</td><td>digitaler Kalender, auf Werkstatt-Tablet sichtbar</td></tr>
    <tr><td>Erinnerung</td><td>keine; ca. 10 % der Kunden erscheinen nicht</td><td>automatische E-Mail am Vortag</td></tr>
  </tbody>
</table>
<p><strong>Stakeholder</strong> sind alle, die vom Projekt betroffen sind oder es beeinflussen: Geschäftsführung (Auftraggeber, Budget), Werkstattmeister
(Kapazitätsplanung), Mitarbeiter an der Theke, Kunden, Datenschutzbeauftragter, Hosting-Anbieter. Eine Stakeholder-Analyse hält Interessen, Einfluss und
Einstellung fest – wer viel Einfluss hat und skeptisch ist, braucht besondere Aufmerksamkeit.</p>

<h6>Anforderungen formulieren</h6>
<ul>
  <li><strong>Funktionale Anforderungen</strong> beschreiben, <em>was</em> das System tun soll: „Kunden können einen freien 30-Minuten-Termin auswählen und buchen.“</li>
  <li><strong>Nichtfunktionale Anforderungen</strong> beschreiben, <em>wie gut</em> (Qualitätsmerkmale, LF10 Kapitel 10): „Die Buchungsseite erfüllt WCAG 2.2 AA.“
  „Die Terminsuche antwortet in höchstens 2 Sekunden.“</li>
  <li><strong>Rahmenbedingungen</strong>: Budget 18.000 €, Start der Saison am 1. März, Hosting in der EU, vorhandene Website auf WordPress.</li>
</ul>
<p>Anforderungen werden eindeutig, prüfbar und nummeriert festgehalten (/F10/, /NF20/ …), damit Tests und Abnahme darauf verweisen können. Zum Priorisieren
dient <strong>MoSCoW</strong>:</p>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th>Kategorie</th><th>Bedeutung</th><th>Beispiel</th></tr></thead>
  <tbody>
    <tr><td><strong>M</strong>ust have</td><td>ohne das kein Erfolg</td><td>Termin buchen und stornieren</td></tr>
    <tr><td><strong>S</strong>hould have</td><td>wichtig, aber notfalls später</td><td>Erinnerungs-E-Mail</td></tr>
    <tr><td><strong>C</strong>ould have</td><td>nett, wenn Zeit bleibt</td><td>Foto vom Schaden hochladen</td></tr>
    <tr><td><strong>W</strong>on't have (this time)</td><td>bewusst nicht in diesem Projekt</td><td>Online-Bezahlung</td></tr>
  </tbody>
</table>

<h6>Projektziele SMART formulieren</h6>
<p>Ziele sind <strong>s</strong>pezifisch, <strong>m</strong>essbar, <strong>a</strong>kzeptiert (bzw. attraktiv), <strong>r</strong>ealistisch und
<strong>t</strong>erminiert. „Die Werkstatt soll digitaler werden“ ist kein Ziel. SMART: „Bis zum 1. März sind mindestens 60 % aller Reparaturtermine online
buchbar; die Zahl der Terminanrufe sinkt bis Ende Mai um die Hälfte.“</p>

<h6>Lastenheft und Pflichtenheft</h6>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf12/lastenheft-pflichtenheft.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Lastenheft des Auftraggebers mit Was und wofür, Pflichtenheft des Auftragnehmers mit Wie und womit; das freigegebene Pflichtenheft ist Vertragsgrundlage">
  <figcaption class="figure-caption">Der Kunde sagt, was er braucht – der Auftragnehmer sagt, wie er es umsetzt</figcaption>
</figure>
<p>Nach DIN 69901-5 enthält das <strong>Lastenheft</strong> die vom Auftraggeber festgelegten Forderungen an die Lieferungen und Leistungen. Das
<strong>Pflichtenheft</strong> enthält die vom Auftragnehmer erarbeiteten Realisierungsvorgaben – es beschreibt die Umsetzung der Forderungen aus dem Lastenheft.
Jede Lastenheft-Anforderung muss im Pflichtenheft wiederzufinden sein. In agilen Projekten ersetzen Product Backlog und User Stories oft das Pflichtenheft
(siehe <a href="/Learningfields/Scrum/scrum_artefakte.php">Scrum-Artefakte</a>); ein grobes Lastenheft gibt es trotzdem meistens.</p>
<div class="lf-pruefung"><strong>Prüfungstipp:</strong> „Wer erstellt das Lastenheft?“ – der <strong>Auftraggeber</strong>. „Wer das Pflichtenheft?“ – der
<strong>Auftragnehmer</strong>. Eselsbrücke: Der Kunde lädt seine Last ab; der Dienstleister verpflichtet sich.</div>

<h6>Übungen mit Lösung</h6>
<p>1. Funktional oder nichtfunktional? a) Die Werkstatt kann Termine sperren. b) Das System ist zu 99,5 % im Monat verfügbar. c) Kunden erhalten nach der
Buchung eine Bestätigung. d) Alle personenbezogenen Daten werden in der EU gespeichert.</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">a) funktional, b) nichtfunktional (Zuverlässigkeit), c) funktional, d) nichtfunktional bzw. Rahmenbedingung (Datenschutz).</p>
</details>
<p>2. Formuliere „Die Seite soll schnell sein“ als SMART-Anforderung.</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Zum Beispiel: „Ab Go-live zeigt die Terminauswahl bei einer Mobilfunkverbindung (4G) die freien Termine innerhalb von 2 Sekunden an; gemessen
wöchentlich mit Lighthouse, Zielwert LCP ≤ 2,5 s.“</p>
</details>
<p>3. Warum sind die Interessen des Werkstattmeisters wichtig, obwohl er nicht Auftraggeber ist?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Er plant die Kapazitäten und arbeitet täglich mit dem Kalender. Ignoriert man ihn, passen Termindauer und Werkstattablauf nicht zusammen, und das
System wird umgangen – ein typischer Grund für gescheiterte Projekte.</p>
</details>
INHALT,
    'summary' => [
        'Projekt = einmalig, zielgerichtet, zeitlich begrenzt, mit begrenzten Ressourcen und eigener Organisation.',
        'Ist-Analyse mit Zahlen, Soll-Konzept, Stakeholder mit Interessen und Einfluss.',
        'Funktionale (was?) und nichtfunktionale (wie gut?) Anforderungen, Rahmenbedingungen; priorisiert mit MoSCoW.',
        'Ziele SMART: spezifisch, messbar, akzeptiert, realistisch, terminiert.',
        'Lastenheft vom Auftraggeber (was, wofür), Pflichtenheft vom Auftragnehmer (wie, womit) – Grundlage der Abnahme.',
    ],
    'quiz' => [
        ['question' => 'Wer erstellt das Pflichtenheft, und was steht darin?', 'answer' => 'Der Auftragnehmer; es beschreibt, wie und womit die Anforderungen aus dem Lastenheft umgesetzt werden.'],
        ['question' => 'Wofür steht MoSCoW?', 'answer' => 'Must have, Should have, Could have, Won\'t have (this time) – eine Methode zur Priorisierung von Anforderungen.'],
        ['question' => 'Was unterscheidet funktionale von nichtfunktionalen Anforderungen?', 'answer' => 'Funktionale Anforderungen beschreiben, was das System tut; nichtfunktionale, wie gut es das tut (Leistung, Sicherheit, Benutzbarkeit …).'],
        ['question' => 'Nenne die fünf Kriterien eines SMART-Ziels.', 'answer' => 'Spezifisch, messbar, akzeptiert (attraktiv), realistisch, terminiert.'],
    ],
];
