<?php
return [
    'title' => 'Support-Organisation: Level, Eskalation, Tickets',
    'intro' => 'Nicht jede Anfrage kann der erste Kontakt lösen. Ein gestuftes Support-Modell sorgt dafür, dass einfache Fälle schnell erledigt sind und schwierige bei den richtigen Fachleuten landen – ohne dass ein Ticket verloren geht.',
    'goals' => [
        'die Aufgaben von 1st, 2nd und 3rd Level Support unterscheiden',
        'funktionale und hierarchische Eskalation erklären und anwenden',
        'ein vollständiges, aussagekräftiges Ticket erfassen',
        'den Lebenszyklus eines Tickets beschreiben',
    ],
    'content' => <<<'INHALT'
<h6>Support-Level</h6>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf6/support-level.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="1st Level Service Desk, 2nd Level Fachteams, 3rd Level Entwicklung und Hersteller; funktionale Eskalation nach unten, hierarchische Eskalation zur Leitung">
  <figcaption class="figure-caption">Funktional zu mehr Fachwissen, hierarchisch zu mehr Befugnis</figcaption>
</figure>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th>Level</th><th>Wer</th><th>Typische Aufgaben</th></tr></thead>
  <tbody>
    <tr><td>(0th Level)</td><td>Anwender selbst</td><td>Self-Service: Wissensdatenbank, Passwort-Reset im Portal</td></tr>
    <tr><td>1st Level</td><td>Service Desk</td><td>Annahme, Erfassung, Kategorisierung, Priorisierung; Standardlösungen nach Anleitung; Weiterleitung; Rückmeldung an Anwender</td></tr>
    <tr><td>2nd Level</td><td>Fachteams (Server, Netz, Anwendungen)</td><td>tiefere Analyse, Konfiguration, Fehler nachstellen, Vor-Ort-Einsatz</td></tr>
    <tr><td>3rd Level</td><td>Entwicklung, Hersteller, Spezialdienstleister</td><td>Fehler im Programmcode beheben, Hardware im Garantiefall tauschen, Patches liefern</td></tr>
  </tbody>
</table>
<p>Ziel ist eine hohe <strong>Erstlösungsquote</strong> (First Contact Resolution): Je mehr der 1st Level sofort löst, desto schneller sind Anwender wieder arbeitsfähig
und desto weniger werden Spezialisten unterbrochen. Dafür braucht der 1st Level gute Lösungsartikel in der Wissensdatenbank (Kapitel 8).</p>

<h6>Eskalation</h6>
<ul>
  <li><strong>Funktionale Eskalation</strong>: Das Ticket geht an ein Team mit mehr <em>Fachwissen</em> oder anderen Zugriffsrechten – 1st → 2nd → 3rd Level.</li>
  <li><strong>Hierarchische Eskalation</strong>: Die <em>Führung</em> wird eingeschaltet, weil Entscheidungen, Geld, zusätzliches Personal oder Information nötig sind –
    etwa wenn eine SLA-Verletzung droht, ein wichtiger Kunde sich beschwert oder ein Austausch Kosten verursacht.</li>
</ul>
<p>Eskalation ist kein Versagen, sondern ein geregelter Schritt. Wer zu spät eskaliert, riskiert Fristen; wer bei jeder Kleinigkeit eskaliert, verstopft die nächste Ebene.
Die Regeln (wann, an wen, wie) stehen deshalb im Eskalationsplan.</p>

<h6>Ein gutes Ticket</h6>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th>Feld</th><th>Beispiel</th></tr></thead>
  <tbody>
    <tr><td>Melder und Rückrufnummer</td><td>Jana Weber, Buchhaltung, Durchwahl 214</td></tr>
    <tr><td>betroffener Service / Gerät</td><td>Netzwerkdrucker DR-2OG-01 (2. OG)</td></tr>
    <tr><td>Beschreibung</td><td>druckt seit 9:15 Uhr nicht, Anzeige „Papierstau Fach 2“, obwohl kein Papier steckt</td></tr>
    <tr><td>bereits versucht</td><td>Drucker aus- und eingeschaltet, Fach 2 geöffnet – ohne Erfolg</td></tr>
    <tr><td>Auswirkung</td><td>12 Personen, Ausweichdrucker im 1. OG vorhanden</td></tr>
    <tr><td>Kategorie, Priorität</td><td>Hardware / Drucker, Priorität 3 (Kapitel 4)</td></tr>
    <tr><td>Status, Zuständigkeit, Verlauf</td><td>in Bearbeitung, 2nd Level Arbeitsplatz-Team; alle Schritte mit Zeitstempel</td></tr>
  </tbody>
</table>
<p>Ein Ticket mit „Drucker geht nicht“ zwingt zu Rückfragen. Die W-Fragen helfen: <em>Wer</em> ist betroffen, <em>was</em> genau passiert, <em>seit wann</em>,
<em>wo</em>, <em>was wurde verändert</em>, <em>was wurde schon versucht</em>?</p>

<h6>Lebenszyklus eines Tickets</h6>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf6/ticket-status.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Statusfolge neu, zugewiesen, in Bearbeitung, gelöst, geschlossen; Abzweig wartend; Wiedereröffnung von gelöst zurück in Bearbeitung">
  <figcaption class="figure-caption">Gelöst ist nicht dasselbe wie geschlossen</figcaption>
</figure>
<p>Bekannte Ticketsysteme sind etwa Zammad, Znuny (früher OTRS), GLPI oder Jira Service Management. Sie verwalten Tickets, Warteschlangen, SLA-Fristen, Vorlagen
und die Wissensdatenbank und liefern die Kennzahlen.</p>

<h6>Übungen mit Lösung</h6>
<p>1. Funktional oder hierarchisch? (a) Der 1st Level gibt ein Datenbankproblem an das DBA-Team. (b) Ein P1-Ticket droht die vereinbarte Lösungszeit zu reißen; die Teamleitung wird informiert.
(c) Ein Fehler in der selbst entwickelten Software geht an die Entwicklung.</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">(a) funktional. (b) hierarchisch. (c) funktional (3rd Level).</p>
</details>
<p>2. Ein Anwender schreibt: „Outlook spinnt mal wieder.“ Welche Fragen stellst du, bevor du das Ticket weitergibst?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Was genau passiert (Fehlermeldung, Wortlaut, Screenshot)? Seit wann? Immer oder nur bei bestimmten Aktionen? Nur an diesem PC oder auch in Outlook im Web?
Sind Kolleginnen und Kollegen betroffen? Wurde etwas geändert (Update, neues Postfach)? Was wurde schon versucht?</p>
</details>
<p>3. Warum wird ein Ticket nach der Lösung nicht sofort geschlossen?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Erst der Anwender kann bestätigen, dass die Lösung wirkt. Bis dahin steht es auf „gelöst“; bestätigt er oder verstreicht die Frist, wird es geschlossen.
Besteht das Problem weiter, wird es wiedereröffnet, statt ein neues Ticket ohne Vorgeschichte anzulegen.</p>
</details>
INHALT,
    'summary' => [
        '1st Level (Service Desk) nimmt an, erfasst und löst Standardfälle; 2nd Level analysiert tiefer; 3rd Level sind Entwicklung und Hersteller.',
        'Funktionale Eskalation: zu mehr Fachwissen. Hierarchische Eskalation: zur Führung, wenn Befugnis oder Ressourcen nötig sind.',
        'Ein gutes Ticket beantwortet die W-Fragen und enthält Auswirkung, Kategorie, Priorität und Verlauf.',
        'Lebenszyklus: neu → zugewiesen → in Bearbeitung (↔ wartend) → gelöst → geschlossen; Wiedereröffnung möglich.',
    ],
    'quiz' => [
        ['question' => 'Was ist funktionale Eskalation?', 'answer' => 'Weitergabe an ein Team mit mehr Fachwissen, z. B. vom 1st an den 2nd Level.'],
        ['question' => 'Wann eskaliert man hierarchisch?', 'answer' => 'Wenn Entscheidungen, Ressourcen oder Information der Führung nötig sind, etwa bei drohender SLA-Verletzung.'],
        ['question' => 'Was bedeutet Erstlösungsquote?', 'answer' => 'Der Anteil der Anfragen, die beim ersten Kontakt gelöst werden.'],
        ['question' => 'Was unterscheidet „gelöst“ von „geschlossen“?', 'answer' => 'Gelöst: Lösung mitgeteilt. Geschlossen: vom Anwender bestätigt oder nach Ablauf einer Frist.'],
    ],
];
