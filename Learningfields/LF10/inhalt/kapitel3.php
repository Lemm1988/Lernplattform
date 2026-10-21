<?php
return [
    'title' => 'Usability bewerten: Heuristiken und Tests',
    'intro' => 'Ob eine Oberfläche gut bedienbar ist, zeigt sich nicht im Bauchgefühl des Entwicklers. Heuristiken liefern eine Prüfliste, Usability-Tests den Beweis mit echten Nutzern.',
    'goals' => [
        'die zehn Usability-Heuristiken nach Nielsen erklären und an Beispielen anwenden',
        'gute Fehlermeldungen formulieren',
        'Evaluationsmethoden (heuristische Evaluation, Usability-Test, A/B-Test, Fragebogen) unterscheiden',
        'einen Usability-Test planen, durchführen und auswerten sowie einen SUS-Wert berechnen',
    ],
    'content' => <<<'INHALT'
<h6>Die zehn Heuristiken nach Nielsen</h6>
<p>Jakob Nielsen hat 1994 zehn allgemeine Faustregeln (Heuristiken) für gebrauchstaugliche Oberflächen formuliert. Sie überschneiden sich mit den
Interaktionsprinzipien der ISO 9241-110 (<a href="/Learningfields/LF8/kapitel7.php">LF8 Kapitel 7</a>), sind aber konkreter und eignen sich gut als
Prüfliste.</p>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th>#</th><th>Heuristik</th><th>Bedeutung</th><th>Beispiel</th></tr></thead>
  <tbody>
    <tr><td>1</td><td>Sichtbarkeit des Systemzustands</td><td>Das System zeigt jederzeit, was gerade passiert.</td><td>Ladebalken beim Upload, „Gespeichert ✓“, Schritt 2 von 4</td></tr>
    <tr><td>2</td><td>Übereinstimmung mit der realen Welt</td><td>Begriffe und Symbole der Nutzer, nicht der Technik.</td><td>„Warenkorb“ statt „Session-Cart“, Papierkorb-Symbol</td></tr>
    <tr><td>3</td><td>Benutzerkontrolle und Freiheit</td><td>Nutzer können Aktionen abbrechen und rückgängig machen.</td><td>„Rückgängig“ nach dem Löschen einer Mail, Abbrechen-Button</td></tr>
    <tr><td>4</td><td>Konsistenz und Standards</td><td>Gleiches sieht gleich aus, Konventionen werden eingehalten.</td><td>Logo oben links führt zur Startseite</td></tr>
    <tr><td>5</td><td>Fehlervermeidung</td><td>Besser als jede Fehlermeldung ist ein Design, das Fehler verhindert.</td><td>Datumsauswahl statt Freitext, Rückfrage vor dem Löschen</td></tr>
    <tr><td>6</td><td>Wiedererkennen statt Erinnern</td><td>Optionen sind sichtbar, nichts muss auswendig gelernt werden.</td><td>zuletzt gesuchte Begriffe, Auswahlliste statt Codes</td></tr>
    <tr><td>7</td><td>Flexibilität und Effizienz</td><td>Einsteiger kommen zurecht, Profis haben Abkürzungen.</td><td>Tastenkürzel, Favoriten, Vorlagen</td></tr>
    <tr><td>8</td><td>Ästhetisches, minimalistisches Design</td><td>Keine überflüssigen Informationen, die vom Wesentlichen ablenken.</td><td>Formular nur mit nötigen Feldern</td></tr>
    <tr><td>9</td><td>Fehler erkennen, verstehen, beheben</td><td>Fehlermeldungen in klarer Sprache mit Lösungsweg.</td><td>„Passwort zu kurz – mindestens 12 Zeichen“</td></tr>
    <tr><td>10</td><td>Hilfe und Dokumentation</td><td>Hilfe ist leicht zu finden, aufgabenbezogen und knapp.</td><td>Fragezeichen-Symbol am Feld, kontextbezogene Hilfe</td></tr>
  </tbody>
</table>

<h6>Gute Fehlermeldungen</h6>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf10/fehlermeldung.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Links eine allgemeine Fehlermeldung oben mit geleertem Formular, rechts eine Meldung direkt am E-Mail-Feld mit Lösungshinweis und erhaltenen Eingaben">
  <figcaption class="figure-caption">Dieselbe falsche Eingabe – zwei sehr unterschiedliche Erlebnisse</figcaption>
</figure>
<p>Eine gute Fehlermeldung beantwortet drei Fragen: <strong>Was</strong> ist passiert? <strong>Warum</strong>? <strong>Was kann ich tun?</strong> Sie steht
dort, wo der Fehler ist, verwendet die Sprache der Nutzer (keine Fehlercodes oder Stacktraces), gibt niemandem die Schuld („Sie haben falsch …“) und
erhält alle bisherigen Eingaben. Technische Details gehören ins Log, nicht auf den Bildschirm – sie helfen dort nur Angreifern (<a href="/Learningfields/LF8/kapitel6.php">LF8 Kapitel 6</a>).</p>

<h6>Methoden der Evaluation</h6>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th>Methode</th><th>Wer prüft?</th><th>Wann?</th><th>Ergebnis</th></tr></thead>
  <tbody>
    <tr><td>Heuristische Evaluation</td><td>3–5 Usability-Experten prüfen unabhängig anhand der Heuristiken</td><td>früh, auch an Wireframes</td><td>Liste von Problemen mit Schweregrad, schnell und günstig</td></tr>
    <tr><td>Cognitive Walkthrough</td><td>Experten spielen Aufgaben aus Sicht eines Erstnutzers Schritt für Schritt durch</td><td>früh</td><td>Stellen, an denen Neulinge hängen bleiben</td></tr>
    <tr><td>Usability-Test</td><td>echte Nutzer der Zielgruppe lösen Aufgaben, ein Moderator beobachtet</td><td>ab Prototyp</td><td>beobachtete Probleme, Erfolgsquote, Zeit</td></tr>
    <tr><td>A/B-Test</td><td>zwei Varianten im Live-Betrieb, je ein Teil der Besucher</td><td>nach dem Start</td><td>messbarer Unterschied, z. B. Abschlussrate</td></tr>
    <tr><td>Fragebogen (z. B. SUS)</td><td>Nutzer bewerten nach der Nutzung</td><td>nach Tests oder im Betrieb</td><td>vergleichbare Zahl für die subjektive Zufriedenheit</td></tr>
    <tr><td>Eye-Tracking</td><td>Kamera misst Blickverlauf</td><td>Labortest</td><td>Heatmap: Was wird gesehen, was übersehen?</td></tr>
  </tbody>
</table>
<p>Experten-Methoden finden viele Probleme günstig, ersetzen aber keine Tests mit echten Nutzern – Experten sind keine Erstnutzer. Nach einer bekannten
Faustregel von Nielsen decken schon etwa <strong>fünf Testpersonen</strong> den Großteil der Probleme auf; besser sind mehrere kleine Testrunden als eine große.</p>

<h6>Ablauf eines Usability-Tests</h6>
<ol>
  <li><strong>Ziele festlegen</strong>: Was soll geprüft werden? („Finden Kunden die Rücksendung?“)</li>
  <li><strong>Aufgaben formulieren</strong>: realistisch und ohne die Lösung zu verraten – nicht „Klicken Sie auf Rücksendung“, sondern „Ihre Schuhe passen nicht. Schicken Sie sie zurück.“</li>
  <li><strong>Teilnehmende auswählen</strong> aus der Zielgruppe (nicht die Kollegen aus der Entwicklung).</li>
  <li><strong>Durchführen</strong>: Methode des <strong>lauten Denkens</strong> (Thinking Aloud) – die Person spricht aus, was sie denkt und sucht. Der Moderator hilft nicht,
  sondern fragt höchstens „Was erwarten Sie hier?“. Ein Protokoll hält Beobachtungen, Zeit und Erfolg fest.</li>
  <li><strong>Auswerten</strong>: Probleme sammeln, nach Schweregrad (kosmetisch bis kritisch) und Häufigkeit ordnen, Verbesserungen ableiten – und erneut testen.</li>
</ol>

<h6>System Usability Scale (SUS)</h6>
<p>Der SUS-Fragebogen besteht aus zehn Aussagen, die auf einer Skala von 1 (stimme gar nicht zu) bis 5 (stimme voll zu) bewertet werden. Die ungeraden
Aussagen sind positiv formuliert („Ich fand das System einfach zu benutzen“), die geraden negativ („Ich fand das System unnötig komplex“). Berechnung:</p>
<ul>
  <li>ungerade Aussagen: Antwort − 1</li>
  <li>gerade Aussagen: 5 − Antwort</li>
  <li>Summe aller zehn Werte × 2,5 → Ergebnis zwischen 0 und 100</li>
</ul>
<p>Beispiel: Antworten 4, 2, 5, 1, 4, 2, 5, 2, 4, 1. Ungerade: 3 + 4 + 3 + 4 + 3 = 17. Gerade: 3 + 4 + 3 + 3 + 4 = 17. (17 + 17) × 2,5 =
<strong>85</strong>. Werte um 68 gelten als durchschnittlich, ab etwa 80 als gut. Der SUS-Wert ist kein Prozentwert, sondern ein Vergleichsmaß –
etwa zwischen zwei Versionen derselben Anwendung.</p>

<h6>Übungen mit Lösung</h6>
<p>1. Welche Heuristik ist verletzt? a) Nach dem Klick auf „Senden“ passiert zehn Sekunden lang sichtbar nichts. b) Eine Fehlermeldung lautet
„NullPointerException in Line 42“. c) Eine gelöschte Datei kann nicht wiederhergestellt werden, eine Rückfrage gab es nicht.</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">a) Sichtbarkeit des Systemzustands (Ladeanzeige fehlt). b) Fehler erkennen, verstehen, beheben – und Übereinstimmung mit der realen Welt
(Techniksprache). c) Fehlervermeidung (keine Rückfrage) und Benutzerkontrolle (kein Rückgängig).</p>
</details>
<p>2. Formuliere eine Testaufgabe für einen Usability-Test einer Bibliotheks-App, die prüft, ob Nutzer ein Buch verlängern können.</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">„Sie haben das Buch ‚Der Hobbit‘ ausgeliehen und schaffen es nicht, es bis Freitag zurückzubringen. Sorgen Sie dafür, dass Sie keine Gebühr
zahlen müssen.“ – ohne das Wort „verlängern“ und ohne den Menüpunkt zu nennen.</p>
</details>
<p>3. Berechne den SUS-Wert für die Antworten 3, 3, 3, 3, 3, 3, 3, 3, 3, 3.</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Ungerade: 5 × (3 − 1) = 10. Gerade: 5 × (5 − 3) = 10. (10 + 10) × 2,5 = <strong>50</strong>.</p>
</details>
INHALT,
    'summary' => [
        'Nielsens zehn Heuristiken: Systemzustand, reale Welt, Kontrolle, Konsistenz, Fehlervermeidung, Wiedererkennen, Effizienz, Minimalismus, Fehlerhilfe, Dokumentation.',
        'Fehlermeldung: was, warum, was tun – am Feld, in Nutzersprache, Eingaben bleiben erhalten.',
        'Heuristische Evaluation durch 3–5 Experten ist günstig, ersetzt aber keine Tests mit echten Nutzern.',
        'Usability-Test: realistische Aufgaben, Zielgruppe, lautes Denken, Protokoll, Auswertung nach Schweregrad, wiederholen.',
        'SUS: ungerade − 1, gerade 5 − x, Summe × 2,5; rund 68 ist Durchschnitt.',
    ],
    'quiz' => [
        ['question' => 'Was bedeutet die Heuristik „Wiedererkennen statt Erinnern“?', 'answer' => 'Optionen und Informationen sind sichtbar oder leicht abrufbar, damit Nutzer sich nichts merken müssen – z. B. Auswahllisten statt einzutippender Codes.'],
        ['question' => 'Was ist die Methode des lauten Denkens?', 'answer' => 'Testpersonen sprechen während der Bearbeitung der Aufgaben aus, was sie denken, suchen und erwarten; so werden Verständnisprobleme sichtbar.'],
        ['question' => 'Welche drei Fragen beantwortet eine gute Fehlermeldung?', 'answer' => 'Was ist passiert, warum, und was kann der Nutzer tun, um das Problem zu beheben?'],
        ['question' => 'Was unterscheidet eine heuristische Evaluation von einem Usability-Test?', 'answer' => 'Bei der heuristischen Evaluation prüfen Experten anhand von Regeln; beim Usability-Test lösen echte Nutzer Aufgaben und werden beobachtet.'],
    ],
];
