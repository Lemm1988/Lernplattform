<?php
return [
    'title' => 'Das Projekt steuern: Fortschritt, Risiken, Änderungen',
    'intro' => 'Kein Projekt läuft nach Plan. Entscheidend ist, Abweichungen früh zu erkennen, Risiken vorausschauend zu behandeln und Änderungswünsche geordnet einzuarbeiten.',
    'goals' => [
        'die Zielgrößen Leistung, Zeit und Kosten im magischen Dreieck gegeneinander abwägen',
        'den Projektfortschritt mit Soll-Ist-Vergleich, Statusbericht und Meilensteintrendanalyse überwachen',
        'Risiken identifizieren, mit einer Risikomatrix bewerten und Maßnahmen zuordnen',
        'Änderungswünsche über ein geregeltes Änderungsmanagement bearbeiten',
    ],
    'content' => <<<'INHALT'
<h6>Das magische Dreieck</h6>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf12/magisches-dreieck.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Dreieck aus Leistung, Zeit und Kosten mit drei Beispielen, wie eine Änderung die anderen Größen beeinflusst">
  <figcaption class="figure-caption">Wer an einer Ecke zieht, verschiebt die anderen</figcaption>
</figure>
<p>Leistung (Umfang und Qualität), Zeit und Kosten hängen voneinander ab. Ein Projektleiter kann nicht alle drei gleichzeitig verbessern – er muss mit dem
Auftraggeber klären, welche Größe Vorrang hat. Bei der Werkstatt ist der Saisonstart am 1. März fest; notfalls wird der Umfang gekürzt (MoSCoW, <a href="/Learningfields/LF12/kapitel1.php">Kapitel 1</a>).</p>

<h6>Fortschritt überwachen</h6>
<ul>
  <li><strong>Soll-Ist-Vergleich</strong>: Geplante und tatsächliche Termine, Aufwände und Kosten je Arbeitspaket gegenüberstellen. Wichtig ist nicht nur „Wie viel
  ist verbraucht?“, sondern „Wie viel ist fertig?“ – 80 % des Budgets für 50 % der Leistung ist ein Alarmsignal.</li>
  <li><strong>Statusbericht</strong> (z. B. wöchentlich): erledigt, nächste Schritte, Probleme, Risiken, Entscheidungsbedarf; dazu eine <strong>Ampel</strong> für Zeit,
  Kosten und Qualität (grün = im Plan, gelb = Abweichung mit Gegenmaßnahme, rot = Ziel gefährdet, Entscheidung nötig).</li>
  <li><strong>Meilensteintrendanalyse</strong> (MTA): Bei jeder Statusrunde wird der prognostizierte Termin jedes Meilensteins eingetragen. Steigt die Linie, rutscht
  der Meilenstein immer weiter nach hinten – ein Trend, der früher auffällt als die eigentliche Verspätung.</li>
</ul>

<h6>Risikomanagement</h6>
<p>Ein <strong>Risiko</strong> ist ein mögliches Ereignis, das das Projektziel gefährdet. Risikomanagement läuft in vier Schritten: <strong>identifizieren</strong>
(Brainstorming, Checklisten, Erfahrungen), <strong>bewerten</strong> (Wahrscheinlichkeit × Auswirkung), <strong>Maßnahmen planen</strong>, <strong>überwachen</strong>.</p>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf12/risikomatrix.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Drei mal drei Risikomatrix mit fünf eingetragenen Projektrisiken und deren Risikowerten">
  <figcaption class="figure-caption">Risiken mit hohem Wert stehen oben rechts – dort zuerst handeln</figcaption>
</figure>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th>Strategie</th><th>Bedeutung</th><th>Beispiel</th></tr></thead>
  <tbody>
    <tr><td>vermeiden</td><td>Ursache beseitigen, anderen Weg wählen</td><td>Online-Bezahlung gar nicht erst einbauen (R5)</td></tr>
    <tr><td>vermindern</td><td>Wahrscheinlichkeit oder Auswirkung senken</td><td>Werkstattmeister früh in Entwürfe einbeziehen (R1); SPF/DKIM für den Mailversand einrichten (R3)</td></tr>
    <tr><td>übertragen</td><td>Risiko an Dritte abgeben</td><td>Hosting mit vertraglicher Verfügbarkeit (SLA), Versicherung</td></tr>
    <tr><td>akzeptieren</td><td>bewusst tragen, ggf. Notfallplan</td><td>kurzer Hosting-Ausfall (R4): Hinweis „Bitte anrufen“</td></tr>
  </tbody>
</table>
<p>Risiken werden in einem <strong>Risikoregister</strong> mit Verantwortlichem, Maßnahme und Status geführt und in jeder Statusrunde neu bewertet.</p>

<h6>Änderungsmanagement</h6>
<p>Änderungswünsche sind normal – unkontrolliert führen sie aber zu <em>Scope Creep</em>: Der Umfang wächst schleichend, Zeit und Budget nicht. Bei Festpreisprojekten
(<a href="/Learningfields/LF12/kapitel3.php">Kapitel 3</a>) gilt deshalb ein geregelter Ablauf:</p>
<ol>
  <li><strong>Änderungsantrag</strong> (Change Request) schriftlich erfassen: Was, warum, wer?</li>
  <li><strong>Auswirkungen analysieren</strong>: Aufwand, Kosten, Termine, Risiken, betroffene Anforderungen.</li>
  <li><strong>Entscheiden</strong>: Auftraggeber genehmigt, lehnt ab oder verschiebt (z. B. in eine zweite Ausbaustufe).</li>
  <li><strong>Umsetzen und dokumentieren</strong>: Pflichtenheft, Plan und ggf. Vertrag anpassen.</li>
</ol>
<p>Beispiel: Die Werkstatt möchte Fotos vom Schaden hochladen lassen. Analyse: 1,5 Personentage, 860 € netto, kein Einfluss auf den kritischen Pfad, weil der
Upload in die Oberfläche (Vorgang C mit 5 Tagen Puffer) fällt. Die Geschäftsführung genehmigt.</p>
<div class="lf-merke"><strong>Merke:</strong> In agilen Projekten sind Änderungen eingeplant: Neue Wünsche kommen ins Product Backlog, der Product Owner priorisiert, und
das Team übernimmt sie in einen späteren Sprint – ohne den laufenden Sprint zu ändern.</div>

<h6>Kommunikation und Konflikte</h6>
<p>Ein <strong>Kommunikationsplan</strong> legt fest, wer welche Information wann und wie bekommt (Statusbericht an die Geschäftsführung, Daily mit dem Team,
Abstimmung mit dem Werkstattmeister nach jeder Oberflächen-Iteration). Konflikte im Team werden früh und sachlich angesprochen: Problem beschreiben, Interessen
klären, Lösungen gemeinsam suchen, Ergebnis festhalten.</p>

<h6>Übungen mit Lösung</h6>
<p>1. Das Projekt hat nach der Hälfte der Zeit 70 % des Budgets verbraucht, aber erst 40 % der Arbeitspakete abgeschlossen. Wie bewertest du den Status?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Rot: Kosten laufen der Leistung davon und die Zeit ebenfalls (50 % Zeit, 40 % fertig). Ursachen analysieren, Gegenmaßnahmen und eine Entscheidung des
Auftraggebers herbeiführen (Umfang kürzen, Budget erhöhen oder Termin verschieben).</p>
</details>
<p>2. Ordne die Strategie zu: a) Abschluss einer Haftpflichtversicherung. b) Statt einer neuen, unbekannten Bibliothek wird eine bewährte genutzt. c) Code-Reviews,
um Fehler früh zu finden.</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">a) übertragen, b) vermeiden, c) vermindern.</p>
</details>
<p>3. Warum darf ein Entwickler einen Änderungswunsch des Kunden nicht „einfach schnell mit einbauen“?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Ohne Analyse und Entscheidung fehlen Aufwand und Kosten im Plan, Tests und Dokumentation werden nicht angepasst, und beim Festpreis trägt die Firma den
Mehraufwand. Außerdem fehlt der Nachweis, was vereinbart war – Streit bei der Abnahme ist programmiert.</p>
</details>
INHALT,
    'summary' => [
        'Magisches Dreieck: Leistung, Zeit und Kosten beeinflussen sich gegenseitig – Prioritäten mit dem Auftraggeber klären.',
        'Fortschritt: Soll-Ist-Vergleich (verbraucht vs. fertig), Statusbericht mit Ampel, Meilensteintrendanalyse.',
        'Risiken: identifizieren, bewerten (Wahrscheinlichkeit × Auswirkung), Maßnahmen (vermeiden, vermindern, übertragen, akzeptieren), überwachen.',
        'Änderungsmanagement: Antrag, Auswirkungsanalyse, Entscheidung, Umsetzung und Dokumentation – gegen Scope Creep.',
        'Kommunikationsplan: wer bekommt welche Information wann und wie.',
    ],
    'quiz' => [
        ['question' => 'Welche drei Größen bilden das magische Dreieck?', 'answer' => 'Leistung (Umfang und Qualität), Zeit und Kosten.'],
        ['question' => 'Wie berechnet man in einer einfachen Risikomatrix den Risikowert?', 'answer' => 'Eintrittswahrscheinlichkeit mal Auswirkung (Schadenshöhe), z. B. jeweils auf einer Skala von 1 bis 3.'],
        ['question' => 'Was ist Scope Creep?', 'answer' => 'Das schleichende, unkontrollierte Wachsen des Projektumfangs durch nicht geregelte Änderungen, ohne dass Zeit und Budget angepasst werden.'],
        ['question' => 'Was zeigt eine Meilensteintrendanalyse?', 'answer' => 'Wie sich die prognostizierten Termine der Meilensteine über mehrere Berichtstermine entwickeln – steigende Linien zeigen drohende Verzögerungen früh.'],
    ],
];
