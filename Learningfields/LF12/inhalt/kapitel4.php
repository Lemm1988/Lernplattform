<?php
return [
    'title' => 'Das Projekt planen: Vorgehensmodell, PSP, Netzplan, Gantt',
    'intro' => 'Wer macht was in welcher Reihenfolge – und welche Aufgaben dürfen sich auf keinen Fall verspäten? Projektstrukturplan, Netzplan und Gantt-Diagramm geben die Antworten.',
    'goals' => [
        'Vorgehensmodelle (Wasserfall, V-Modell, iterativ, agil) vergleichen und begründet auswählen',
        'einen Projektstrukturplan mit Arbeitspaketen erstellen',
        'einen Netzplan mit Vorwärts- und Rückwärtsrechnung berechnen und den kritischen Pfad bestimmen',
        'ein Gantt-Diagramm mit Meilensteinen lesen und erstellen',
    ],
    'content' => <<<'INHALT'
<h6>Das passende Vorgehensmodell</h6>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th>Modell</th><th>Idee</th><th>geeignet, wenn …</th></tr></thead>
  <tbody>
    <tr><td>Wasserfall</td><td>Phasen nacheinander (Analyse, Entwurf, Umsetzung, Test, Einführung); jede Phase endet mit einem Dokument</td><td>Anforderungen stabil und klar, z. B. gesetzliche Vorgaben</td></tr>
    <tr><td>V-Modell</td><td>wie Wasserfall, jeder Entwurfsstufe steht eine Teststufe gegenüber (LF8 Kapitel 14)</td><td>hohe Qualitäts- und Nachweispflichten (Behörden, Medizin)</td></tr>
    <tr><td>Iterativ-inkrementell, Spiralmodell</td><td>mehrere Durchläufe; jeder liefert einen nutzbaren Teil, Risiken werden früh geprüft</td><td>große Projekte mit technischen Risiken</td></tr>
    <tr><td>Agil (Scrum, Kanban)</td><td>kurze Sprints, lauffähige Inkremente, laufende Anpassung an Feedback</td><td>Anforderungen ändern sich, Kunde arbeitet eng mit (siehe <a href="/Learningfields/Scrum/Scrum_Fundation_index.php">Scrum Foundation</a>)</td></tr>
  </tbody>
</table>
<p>Für die Terminbuchung der Werkstatt ist ein kleines, überschaubares Projekt mit Festpreis geplant (Kapitel 3). Ein klassischer Plan mit Meilensteinen ist
hier sinnvoll; viele Teams kombinieren ihn mit kurzen Feedback-Runden zur Oberfläche (hybrides Vorgehen).</p>

<h6>Projektstrukturplan (PSP)</h6>
<p>Der PSP zerlegt das Projekt hierarchisch in Teilaufgaben bis hinunter zu <strong>Arbeitspaketen</strong> – der kleinsten Einheit, die man schätzen,
einer Person zuordnen und abnehmen kann. Er kann objektorientiert (nach Produktteilen), funktionsorientiert (nach Tätigkeiten) oder phasenorientiert
gegliedert sein.</p>
<div class="border rounded p-3 mb-3 small" style="max-width: 560px">
  <strong>1 Online-Terminbuchung</strong>
  <ul class="mb-0">
    <li>1.1 Analyse – <em>AP 1.1.1 Ist-Analyse, AP 1.1.2 Pflichtenheft</em></li>
    <li>1.2 Umsetzung – <em>AP 1.2.1 Datenbank und Backend, AP 1.2.2 Buchungsoberfläche, AP 1.2.3 Werkstatt-Kalender, AP 1.2.4 E-Mail-Erinnerung</em></li>
    <li>1.3 Qualitätssicherung – <em>AP 1.3.1 Tests, AP 1.3.2 Abnahme</em></li>
    <li>1.4 Einführung – <em>AP 1.4.1 Schulung, AP 1.4.2 Dokumentation, AP 1.4.3 Go-live</em></li>
  </ul>
</div>
<p>Ein Arbeitspaket wird beschrieben mit Ziel, Ergebnis, Verantwortlichem, Aufwand, Dauer, Abhängigkeiten und Abnahmekriterium.</p>

<h6>Der Netzplan</h6>
<p>Der <strong>Netzplan</strong> zeigt die Abhängigkeiten der Vorgänge und berechnet daraus Termine und Puffer. Vorgänge (vereinfacht aus Kapitel 3, Dauer
in Arbeitstagen):</p>
<table class="table table-sm table-bordered text-center" style="max-width: 520px">
  <thead class="table-light"><tr><th>Nr</th><th class="text-start">Vorgang</th><th>Dauer</th><th>Vorgänger</th></tr></thead>
  <tbody>
    <tr><td>A</td><td class="text-start">Analyse und Pflichtenheft</td><td>3</td><td>–</td></tr>
    <tr><td>B</td><td class="text-start">Datenbank und Backend</td><td>6</td><td>A</td></tr>
    <tr><td>C</td><td class="text-start">Buchungsoberfläche</td><td>5</td><td>A</td></tr>
    <tr><td>D</td><td class="text-start">Werkstatt-Kalender</td><td>4</td><td>B</td></tr>
    <tr><td>E</td><td class="text-start">E-Mail-Erinnerung</td><td>2</td><td>B</td></tr>
    <tr><td>F</td><td class="text-start">Tests</td><td>3</td><td>C, D, E</td></tr>
    <tr><td>G</td><td class="text-start">Einführung</td><td>2</td><td>F</td></tr>
  </tbody>
</table>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf12/netzplan.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Vorgangsknoten-Netzplan mit sieben Vorgängen, kritischer Pfad A, B, D, F, G hervorgehoben, Projektdauer 18 Tage">
  <figcaption class="figure-caption">Vorgangsknoten-Netzplan mit berechneten Zeiten – der kritische Pfad ist hervorgehoben</figcaption>
</figure>
<p><strong>Vorwärtsrechnung</strong> (früheste Zeiten): Der erste Vorgang beginnt bei 0. FEZ = FAZ + Dauer. Hat ein Vorgang mehrere Vorgänger, ist sein FAZ
das <strong>größte</strong> FEZ der Vorgänger. F wartet also auf D (FEZ 13), obwohl C schon bei 8 fertig ist.</p>
<p><strong>Rückwärtsrechnung</strong> (späteste Zeiten): Der letzte Vorgang endet spätestens bei der Projektdauer (18). SAZ = SEZ − Dauer. Hat ein Vorgang mehrere
Nachfolger, ist sein SEZ das <strong>kleinste</strong> SAZ der Nachfolger – B muss bei 9 fertig sein, weil D bei 9 beginnen muss.</p>
<ul>
  <li><strong>Gesamtpuffer</strong> GP = SAZ − FAZ (= SEZ − FEZ): so viel darf sich ein Vorgang verschieben, ohne das Projektende zu gefährden. C hat 5 Tage, E 2 Tage.</li>
  <li><strong>Freier Puffer</strong> FP = kleinster FAZ der Nachfolger − eigenes FEZ: so viel darf er sich verschieben, ohne einen Nachfolger zu verschieben.</li>
  <li><strong>Kritischer Pfad</strong>: alle Vorgänge mit Gesamtpuffer 0 – hier A → B → D → F → G. Jede Verzögerung dort verschiebt das Projektende.</li>
</ul>
<div class="lf-merke"><strong>Merke:</strong> Vorwärts = Maximum der Vorgänger-FEZ, rückwärts = Minimum der Nachfolger-SAZ. Wer den kritischen Pfad kennt, weiß, wo
zusätzliche Leute oder Zeit etwas bringen – bei C nützt Beschleunigung gar nichts.</div>

<h6>Gantt-Diagramm und Meilensteine</h6>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf12/gantt.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Balkenplan über 18 Tage mit kritischen Vorgängen, Puffern bei C und E sowie Meilensteinen an Tag 3 und Tag 18">
  <figcaption class="figure-caption">Derselbe Plan als Balkendiagramm – gut für Statusbesprechungen mit dem Kunden</figcaption>
</figure>
<p>Das <strong>Gantt-Diagramm</strong> (Balkenplan) zeigt Vorgänge als Balken auf einer Zeitachse. Abhängigkeiten sind weniger deutlich als im Netzplan, dafür sieht
man auf einen Blick, was wann läuft und wo Puffer liegen. <strong>Meilensteine</strong> sind Ereignisse ohne Dauer, an denen ein überprüfbares Ergebnis
vorliegt (Raute) – etwa „Pflichtenheft freigegeben“. An Meilensteinen wird entschieden, ob und wie es weitergeht.</p>
<p>Werkzeuge: MS Project, GanttProject, Jira (Zeitachse), Excel-Vorlagen. Für die Prüfung musst du Netzpläne von Hand berechnen können.</p>

<h6>Übungen mit Lösung</h6>
<p>1. Vorgang D (Kalender) dauert 6 statt 4 Tage. Wie lange dauert das Projekt, und was passiert mit dem Puffer von E?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">D liegt auf dem kritischen Pfad: FEZ D = 9 + 6 = 15, F beginnt bei 15 und endet bei 18, G endet bei <strong>20</strong> Tagen. E (FEZ 11) muss erst bei
15 fertig sein: Gesamtpuffer <strong>4</strong> Tage statt 2.</p>
</details>
<p>2. Vorgang C (Oberfläche) verzögert sich um 3 Tage. Verschiebt sich das Projektende?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Nein. C hat 5 Tage Gesamtpuffer; neues FEZ = 11, F beginnt trotzdem erst bei 13. Erst ab mehr als 5 Tagen Verzögerung wird C kritisch.</p>
</details>
<p>3. Berechne: X (3 Tage) und Y (5 Tage) beginnen beide bei 0, Z (2 Tage) braucht X und Y. Wann endet Z frühestens, und welchen Puffer hat X?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">FAZ Z = max(3, 5) = 5, FEZ Z = <strong>7</strong>. SEZ X = SAZ Z = 5, SAZ X = 2 → Gesamtpuffer X = 2 − 0 = <strong>2 Tage</strong>.</p>
</details>
INHALT,
    'summary' => [
        'Vorgehensmodell nach Projektlage wählen: Wasserfall/V-Modell bei stabilen Anforderungen, iterativ/agil bei Unsicherheit.',
        'PSP: hierarchische Zerlegung bis zu Arbeitspaketen mit Ergebnis, Verantwortlichem, Aufwand und Abnahmekriterium.',
        'Netzplan: vorwärts FEZ = FAZ + D, FAZ = Max der Vorgänger-FEZ; rückwärts SAZ = SEZ − D, SEZ = Min der Nachfolger-SAZ.',
        'Gesamtpuffer = SAZ − FAZ; kritischer Pfad = Vorgänge mit Gesamtpuffer 0; im Beispiel A-B-D-F-G, 18 Tage.',
        'Gantt-Diagramm: Balken auf der Zeitachse; Meilensteine sind Ereignisse ohne Dauer mit überprüfbarem Ergebnis.',
    ],
    'quiz' => [
        ['question' => 'Was ist der kritische Pfad?', 'answer' => 'Die Folge von Vorgängen ohne Gesamtpuffer; jede Verzögerung auf diesem Pfad verschiebt das Projektende.'],
        ['question' => 'Wie bestimmt man in der Vorwärtsrechnung den FAZ eines Vorgangs mit mehreren Vorgängern?', 'answer' => 'Als das größte (späteste) FEZ aller Vorgänger.'],
        ['question' => 'Was unterscheidet Gesamtpuffer und freien Puffer?', 'answer' => 'Der Gesamtpuffer gibt an, wie weit sich ein Vorgang verschieben darf, ohne das Projektende zu verschieben; der freie Puffer, ohne einen Nachfolger zu verschieben.'],
        ['question' => 'Was ist ein Meilenstein?', 'answer' => 'Ein Ereignis ohne Dauer, an dem ein überprüfbares Ergebnis vorliegt und über das weitere Vorgehen entschieden wird.'],
    ],
];
