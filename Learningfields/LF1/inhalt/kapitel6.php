<?php
return [
    'title' => 'Geschäftsprozesse darstellen und verbessern',
    'intro' => 'Die Aufbauorganisation zeigt, wer wo sitzt; die Ablauforganisation, was nacheinander passiert. Wer Software für Unternehmen entwickelt, muss Geschäftsprozesse lesen, modellieren und verbessern können.',
    'goals' => [
        'Kern-, Unterstützungs- und Managementprozesse unterscheiden',
        'eine Prozesslandkarte eines Unternehmens erstellen',
        'Prozesse als ereignisgesteuerte Prozesskette (EPK) modellieren',
        'Durchlaufzeit und Schwachstellen eines Prozesses analysieren',
        'kontinuierliche Verbesserung und Digitalisierung von Prozessen einordnen',
    ],
    'content' => <<<'INHALT'
<h6>Was ist ein Geschäftsprozess?</h6>
<p>Ein <strong>Geschäftsprozess</strong> ist eine Folge von Tätigkeiten mit definiertem Anfang (Auslöser) und Ende (Ergebnis), die einen Wert für einen Kunden schafft –
intern oder extern. Er läuft meist quer durch mehrere Abteilungen. Die <strong>Ablauforganisation</strong> regelt, in welcher Reihenfolge, wann, wo und womit gearbeitet wird.</p>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf1/prozesslandkarte.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Prozesslandkarte: oben Managementprozesse, in der Mitte die Kernprozesse vom Kundenwunsch bis zum zufriedenen Kunden, unten Unterstützungsprozesse">
  <figcaption class="figure-caption">Managementprozesse steuern, Kernprozesse schaffen Wert, Unterstützungsprozesse ermöglichen</figcaption>
</figure>
<p>Kernprozesse sind das, wofür Kunden bezahlen – bei einem IT-Dienstleister vom Angebot über die Entwicklung bis zum Support. Im Ganzen bilden sie die
<strong>Wertschöpfungskette</strong>. Unterstützungsprozesse sind nötig, aber für den Kunden unsichtbar; sie werden deshalb häufiger ausgelagert (Outsourcing).</p>

<h6>Prozesse modellieren: die EPK</h6>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf1/epk.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="EPK: Ereignis Anfrage eingegangen, Funktion Anfrage prüfen mit Vertrieb und Kundendaten, XOR-Verzweigung in Angebot erstellen oder Absage formulieren">
  <figcaption class="figure-caption">Ereignisse und Funktionen wechseln sich ab</figcaption>
</figure>
<ul>
  <li><strong>Ereignis</strong> (Sechseck): ein Zustand, der eintritt – im Partizip formuliert („Anfrage ist eingegangen“).</li>
  <li><strong>Funktion</strong> (abgerundetes Rechteck): eine Tätigkeit – Substantiv + Verb („Anfrage prüfen“).</li>
  <li><strong>Konnektoren</strong>: UND (alle Zweige), ODER (mindestens einer), XOR (genau einer).</li>
  <li>Die <strong>erweiterte EPK</strong> (eEPK) ergänzt Organisationseinheiten (wer?) und Informationsobjekte (womit?).</li>
</ul>
<p>Andere Notationen: <strong>BPMN</strong> (international verbreitet, mit Swimlanes für Beteiligte), Flussdiagramme und UML-Aktivitätsdiagramme
(<a href="/Learningfields/LF11/index.php">LF11</a>). In der Softwareentwicklung ist das Prozessmodell oft der Ausgangspunkt für Anforderungen.</p>

<h6>Prozesse analysieren und verbessern</h6>
<ul>
  <li><strong>Durchlaufzeit</strong> = Bearbeitungszeit + Transportzeit + Liegezeit. Oft ist die Liegezeit am größten: Ein Antrag wird 20 Minuten bearbeitet, liegt aber drei Tage in Postfächern.</li>
  <li>Typische <strong>Schwachstellen</strong>: Medienbrüche (Papier → Abtippen), doppelte Datenerfassung, unklare Zuständigkeiten, zu viele Freigaben, Warteschleifen.</li>
  <li><strong>Digitalisierung</strong>: Formulare im Portal, Workflows mit automatischen Weiterleitungen und Fristen, Schnittstellen statt Abtippen (<a href="/Learningfields/LF8/index.php">LF8</a>).</li>
  <li><strong>Kontinuierlicher Verbesserungsprozess</strong> (KVP, japanisch Kaizen): kleine, stetige Verbesserungen im PDCA-Kreislauf, getragen von den Beschäftigten.
    Kennzahlen wie Durchlaufzeit, Fehlerquote und Kundenzufriedenheit zeigen, ob es wirkt.</li>
</ul>

<h6>Übungen mit Lösung</h6>
<p>1. Ordne zu – Kern-, Unterstützungs- oder Managementprozess? (a) Gehaltsabrechnung, (b) Software beim Kunden installieren, (c) Jahresziele festlegen, (d) Hotline für Kunden.</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">(a) Unterstützung. (b) Kern. (c) Management. (d) Kern – der Support ist Teil der Leistung für den Kunden.</p>
</details>
<p>2. Was ist an dieser EPK falsch: Ereignis „Rechnung ist eingegangen“ → XOR → Funktion „Rechnung bezahlen“ / Funktion „Rechnung reklamieren“?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Nach einem Ereignis darf nicht mit XOR verzweigt werden – ein Ereignis kann nichts entscheiden. Richtig: Ereignis → Funktion „Rechnung prüfen“ → XOR →
Ereignis „Rechnung ist korrekt“ / „Rechnung ist fehlerhaft“ → jeweils die passende Funktion.</p>
</details>
<p>3. Urlaubsanträge werden ausgedruckt, unterschrieben, ins Personalbüro getragen und dort abgetippt. Wie verbesserst du den Prozess?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Medienbruch beseitigen: digitaler Antrag im Portal, automatische Weiterleitung an die Führungskraft zur Freigabe, danach direkt in die Personalsoftware.
Ergebnis: kürzere Durchlauf- und Liegezeiten, keine Abtippfehler, Status für alle sichtbar.</p>
</details>
INHALT,
    'summary' => [
        'Geschäftsprozess: Tätigkeitsfolge vom Auslöser zum Ergebnis mit Wert für einen Kunden, meist abteilungsübergreifend.',
        'Kernprozesse schaffen Wert, Unterstützungsprozesse ermöglichen, Managementprozesse steuern.',
        'EPK: Ereignis (Sechseck) und Funktion (abgerundetes Rechteck) wechseln sich ab; Konnektoren UND, ODER, XOR; nach Ereignissen keine Entscheidung.',
        'Durchlaufzeit = Bearbeitung + Transport + Liegezeit; Schwachstellen sind oft Medienbrüche und Wartezeiten.',
        'KVP (Kaizen): stetige kleine Verbesserungen im PDCA-Kreislauf.',
    ],
    'quiz' => [
        ['question' => 'Welche Form hat ein Ereignis in der EPK?', 'answer' => 'Ein Sechseck.'],
        ['question' => 'Was ist ein Kernprozess?', 'answer' => 'Ein Prozess, der direkt Wert für den Kunden schafft, z. B. Entwicklung oder Support beim IT-Dienstleister.'],
        ['question' => 'Woraus setzt sich die Durchlaufzeit zusammen?', 'answer' => 'Aus Bearbeitungs-, Transport- und Liegezeiten.'],
        ['question' => 'Was ist ein Medienbruch?', 'answer' => 'Ein Wechsel des Mediums im Prozess, z. B. von Papier zu manueller Eingabe am PC – eine typische Fehler- und Zeitquelle.'],
    ],
];
