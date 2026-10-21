<?php
return [
    'title' => 'Wissen dokumentieren, Anwender schulen, Qualität verbessern',
    'intro' => 'Jede gelöste Anfrage enthält Wissen. Wer es festhält, in verständliche Anleitungen und Schulungen übersetzt und die Zufriedenheit der Kunden misst, macht den Service von Woche zu Woche besser.',
    'goals' => [
        'Wissensartikel nach einem festen Aufbau erstellen',
        'Anleitungen zielgruppengerecht schreiben',
        'eine kurze Schulung mit der Vier-Stufen-Methode planen',
        'Kundenzufriedenheit messen und den Net Promoter Score berechnen',
        'Service kontinuierlich verbessern',
    ],
    'content' => <<<'INHALT'
<h6>Die Wissensdatenbank</h6>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf6/wissenskreislauf.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Kreislauf: Ticket gelöst, als Artikel erfassen, wiederverwenden, verbessern; daneben die Bestandteile eines guten Artikels">
  <figcaption class="figure-caption">Wissen entsteht beim Lösen – und wird beim nächsten Mal wiederverwendet</figcaption>
</figure>
<p>Der Grundgedanke von <strong>Knowledge-Centered Service</strong> (KCS): Wissen wird nicht in einem separaten Projekt aufgeschrieben, sondern direkt bei der Ticketbearbeitung
erfasst, bei jeder Nutzung geprüft und verbessert. Interne Artikel helfen dem Support, öffentliche Artikel den Anwendern im Self-Service-Portal.
Jeder Artikel braucht eine verantwortliche Person und ein Prüfdatum – veraltetes Wissen richtet Schaden an.</p>

<h6>Anleitungen schreiben</h6>
<ul>
  <li><strong>Zielgruppe</strong> klären: Was weiß der Leser schon, welche Begriffe kennt er?</li>
  <li><strong>Aufgabenorientiert</strong> formulieren: Überschrift als Ziel („Abwesenheitsnotiz einrichten“), nicht als Funktion („Das Menü Automatische Antworten“).</li>
  <li><strong>Nummerierte Schritte</strong>, ein Schritt = eine Handlung, im Imperativ: „Klicken Sie auf <em>Datei</em>.“</li>
  <li>Bezeichnungen <strong>genau wie auf dem Bildschirm</strong> schreiben und hervorheben; Screenshots mit Markierung, aber ohne personenbezogene Daten.</li>
  <li><strong>Warnhinweise vor</strong> dem riskanten Schritt, nicht danach. Das <strong>Ergebnis</strong> nennen, damit der Leser weiß, ob es geklappt hat.</li>
  <li>Von jemandem aus der Zielgruppe <strong>testen</strong> lassen.</li>
</ul>
<p>Formate je nach Zweck: Kurzanleitung (eine Seite), Handbuch, FAQ, Onlinehilfe, kurzes Video. Barrierearm heißt: klare Sprache, Alternativtexte für Bilder,
gute Kontraste (<a href="/Learningfields/LF10/index.php">LF10</a>).</p>

<h6>Schulungen planen</h6>
<p>Eine Schulung wird geplant wie ein kleines Projekt: <strong>Lernziele</strong> (Was können die Teilnehmenden danach?), <strong>Zielgruppe</strong> und Vorwissen,
<strong>Inhalte</strong> und Zeitplan, <strong>Methoden</strong> (Vortrag, Vorführung, Übung, Gruppenarbeit, E-Learning), <strong>Material</strong> und Technik
(Schulungsrechner, Testkonten), <strong>Erfolgskontrolle</strong> und Feedback. Für Software-Schulungen bewährt sich die Vier-Stufen-Methode:</p>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf6/vier-stufen.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Vier Stufen: vorbereiten, vormachen und erklären, nachmachen lassen, üben">
  <figcaption class="figure-caption">Erst zeigen, dann selbst machen lassen</figcaption>
</figure>
<div class="lf-merke"><strong>Merke:</strong> Menschen behalten am meisten von dem, was sie selbst getan haben. Eine Schulung, die nur aus Folien besteht, ändert wenig.
Teilnehmende sollten möglichst früh selbst an der Software arbeiten – mit Testdaten, nicht mit echten Kundendaten.</div>

<h6>Kundenzufriedenheit messen</h6>
<ul>
  <li><strong>Kurzumfrage nach Ticketabschluss</strong> (Customer Satisfaction, CSAT): „Wie zufrieden waren Sie?“ auf einer Skala, dazu ein Freitextfeld.</li>
  <li><strong>Net Promoter Score</strong> (NPS): „Wie wahrscheinlich empfehlen Sie uns weiter?“ von 0 bis 10. Promotoren geben 9–10, Kritiker 0–6, Werte 7–8 sind passiv.
    <strong>NPS = Anteil Promotoren in % − Anteil Kritiker in %</strong>, also ein Wert zwischen −100 und +100.</li>
  <li><strong>Beschwerden</strong> und Lob systematisch auswerten – eine Beschwerde ist eine kostenlose Fehlermeldung.</li>
</ul>

<h6>Kontinuierlich verbessern</h6>
<p>Regelmäßige Service-Reports (Ticketzahlen, Kennzahlen aus Kapitel 4, Zufriedenheit) zeigen Trends. Daraus entstehen Maßnahmen: Wo häufen sich Tickets?
Welche Artikel fehlen? Welche Schulung würde Anfragen vermeiden? Nach größeren Störungen hilft eine <strong>Nachbesprechung ohne Schuldzuweisung</strong>
(„Was lief gut, was nicht, was ändern wir?“). Das ist derselbe PDCA-Kreislauf wie im Sicherheitsmanagement (<a href="/Learningfields/LF4/kapitel3.php">LF4 Kapitel 3</a>).</p>

<h6>Übungen mit Lösung</h6>
<p>1. Nach der Umstellung auf ein neues Portal gehen 120 Antworten ein: 60 geben 9 oder 10 Punkte, 40 geben 7 oder 8, 20 geben 0 bis 6. Berechne den NPS.</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Promotoren 60 ÷ 120 = 50 %, Kritiker 20 ÷ 120 ≈ 16,7 %. NPS = 50 − 16,7 ≈ <strong>+33</strong>. Die 40 Passiven zählen nur im Nenner mit.</p>
</details>
<p>2. Verbessere den Anleitungsschritt: „Danach muss in den Einstellungen unter Konto irgendwo das Passwort geändert werden, aber vorher unbedingt speichern.“</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Zum Beispiel: „1. Speichern Sie Ihre offenen Dokumente. 2. Klicken Sie auf <em>Einstellungen</em>. 3. Wählen Sie <em>Konto</em> → <em>Passwort ändern</em>.
4. Geben Sie das alte und zweimal das neue Passwort ein und klicken Sie auf <em>Speichern</em>. Ergebnis: Die Meldung „Passwort geändert“ erscheint.“</p>
</details>
<p>3. Der Service Desk bekommt jeden Montag rund 30 Anfragen „Wie verbinde ich das VPN?“. Welche Maßnahmen schlägst du vor?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Einen öffentlichen Wissensartikel mit Schritt-für-Schritt-Anleitung und Screenshots im Portal; einen Link darauf in der Willkommensmail für neue Mitarbeitende;
eine kurze Schulung oder ein Video; prüfen, ob sich die VPN-Verbindung automatisieren lässt. Danach an der Ticketzahl messen, ob es wirkt.</p>
</details>
INHALT,
    'summary' => [
        'Wissen beim Lösen erfassen, wiederverwenden und verbessern (KCS); Artikel mit Symptom-Titel, Ursache, Lösungsschritten und Prüfdatum.',
        'Anleitungen: zielgruppengerecht, aufgabenorientiert, nummerierte Schritte, Warnung vor dem Schritt, Ergebnis nennen, testen lassen.',
        'Schulungen mit Lernzielen planen; Vier-Stufen-Methode: vorbereiten, vormachen, nachmachen lassen, üben.',
        'Zufriedenheit messen: Kurzumfrage, NPS = % Promotoren − % Kritiker, Beschwerden auswerten.',
        'Reports und Nachbesprechungen ohne Schuldzuweisung treiben die kontinuierliche Verbesserung (PDCA).',
    ],
    'quiz' => [
        ['question' => 'Wie lautet ein guter Titel für einen Wissensartikel?', 'answer' => 'Er beschreibt das Symptom aus Sicht des Anwenders, z. B. „Outlook fragt ständig nach dem Passwort“.'],
        ['question' => 'Welche vier Stufen hat die Vier-Stufen-Methode?', 'answer' => 'Vorbereiten, Vormachen und erklären, Nachmachen lassen, Üben.'],
        ['question' => 'Wie berechnet man den Net Promoter Score?', 'answer' => 'Anteil der Promotoren (9–10) in Prozent minus Anteil der Kritiker (0–6) in Prozent.'],
        ['question' => 'Wo gehört ein Warnhinweis in einer Anleitung hin?', 'answer' => 'Vor den riskanten Schritt.'],
    ],
];
