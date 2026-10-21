<?php
return [
    'title' => 'Kommunikation mit Kunden und Anwendern',
    'intro' => 'Der beste technische Fix hilft wenig, wenn der Anwender sich nicht ernst genommen fühlt. Gesprächsführung ist im Support Handwerkszeug – und in der Prüfung ein fester Bestandteil.',
    'goals' => [
        'ein Support-Gespräch in Phasen strukturiert führen',
        'aktives Zuhören und passende Fragetechniken einsetzen',
        'Nachrichten mit dem Vier-Seiten-Modell analysieren',
        'mit Beschwerden und Konflikten professionell umgehen',
        'verständliche schriftliche Antworten für verschiedene Zielgruppen formulieren',
    ],
    'content' => <<<'INHALT'
<h6>Ein Gespräch in fünf Phasen</h6>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf6/gespraechsphasen.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Fünf Phasen: begrüßen, Anliegen erfassen, zusammenfassen, lösen oder vereinbaren, abschließen; die Dokumentation läuft mit">
  <figcaption class="figure-caption">Struktur gibt Sicherheit – auch in schwierigen Gesprächen</figcaption>
</figure>

<h6>Zuhören und fragen</h6>
<p><strong>Aktives Zuhören</strong> heißt: aufmerksam sein, nicht unterbrechen, mit kurzen Signalen zeigen, dass man folgt („verstehe“, „ja“), das Gehörte in eigenen Worten
wiedergeben (<em>paraphrasieren</em>) und Gefühle ansprechen („Das klingt, als stünden Sie gerade unter Zeitdruck“).</p>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th>Fragetyp</th><th>Beispiel</th><th>Einsatz</th></tr></thead>
  <tbody>
    <tr><td>offen (W-Fragen)</td><td>„Was genau passiert, wenn Sie drucken?“</td><td>Informationen sammeln, Anwender erzählen lassen</td></tr>
    <tr><td>geschlossen</td><td>„Leuchtet die Lampe am Drucker rot?“</td><td>gezielt eingrenzen, Fakten bestätigen</td></tr>
    <tr><td>Alternativfrage</td><td>„Sind Sie im Büro oder im Homeoffice?“</td><td>zwischen bekannten Möglichkeiten unterscheiden</td></tr>
    <tr><td>Kontrollfrage</td><td>„Habe ich richtig verstanden, dass es nur bei PDFs auftritt?“</td><td>Verständnis sichern, Missverständnisse vermeiden</td></tr>
  </tbody>
</table>
<p>Bewährt ist die <strong>Trichtertechnik</strong>: erst offen fragen, um das Bild zu bekommen, dann immer gezielter und geschlossener, um einzugrenzen.
Suggestivfragen („Sie haben doch sicher schon neu gestartet?“) vermeiden – sie bringen Anwender dazu, „ja“ zu sagen, auch wenn es nicht stimmt.</p>

<h6>Vier Seiten einer Nachricht</h6>
<p>Nach dem Kommunikationsmodell von Friedemann Schulz von Thun enthält jede Nachricht vier Botschaften – und der Empfänger hört sie mit vier „Ohren“.</p>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf6/vier-seiten.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Die Aussage „Der Drucker geht schon wieder nicht!“ mit Sachinhalt, Selbstkundgabe, Beziehung und Appell; daneben eine Antwort, die auf mehrere Seiten eingeht">
  <figcaption class="figure-caption">Sachinhalt, Selbstkundgabe, Beziehung, Appell</figcaption>
</figure>

<h6>Gut formulieren</h6>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th>statt</th><th>besser</th></tr></thead>
  <tbody>
    <tr><td>„Da haben Sie wohl was falsch gemacht.“</td><td>„Schauen wir gemeinsam, was passiert ist.“</td></tr>
    <tr><td>„Dafür bin ich nicht zuständig.“</td><td>„Ich gebe das an die Kollegen vom Netzwerkteam weiter, die melden sich bis 14 Uhr.“</td></tr>
    <tr><td>„Das geht nicht.“</td><td>„Das geht so leider nicht, aber wir können …“</td></tr>
    <tr><td>„Der DHCP-Lease ist abgelaufen.“ (für Laien)</td><td>„Ihr PC hat keine Netzwerkadresse bekommen. Ich sorge dafür, dass er eine bekommt.“</td></tr>
    <tr><td>Du-Botschaft: „Sie hören mir nicht zu!“</td><td>Ich-Botschaft: „Ich merke, dass wir aneinander vorbeireden. Darf ich noch mal zusammenfassen?“</td></tr>
  </tbody>
</table>
<p>Fachbegriffe sind kein Zeichen von Kompetenz. Gegenüber Laien erklärt man Wirkung und nächsten Schritt; gegenüber der Fachabteilung darf es präziser sein.</p>

<h6>Beschwerden und Konflikte</h6>
<ol>
  <li><strong>Ruhig bleiben</strong> und den Ärger nicht persönlich nehmen – er gilt meist der Situation.</li>
  <li><strong>Ausreden lassen</strong>, zuhören, Verständnis zeigen („Ich verstehe, dass das ärgerlich ist“). Das ist kein Schuldeingeständnis.</li>
  <li><strong>Sachlich klären</strong>: Was genau ist passiert, was erwartet der Kunde?</li>
  <li><strong>Lösung anbieten</strong> oder realistische nächste Schritte vereinbaren – nur zusagen, was man halten kann.</li>
  <li><strong>Zusagen einhalten</strong> und nachfassen. Wenn nötig, hierarchisch eskalieren (<a href="/Learningfields/LF6/kapitel2.php">Kapitel 2</a>).</li>
</ol>
<div class="lf-merke"><strong>Merke:</strong> Bei Beleidigungen oder Drohungen darf das Gespräch freundlich, aber bestimmt beendet werden: „In diesem Ton kann ich Ihnen nicht helfen.
Ich melde mich gern wieder, wenn wir sachlich sprechen können.“ Vorfall im Ticket festhalten und die Teamleitung informieren.</div>

<h6>Schriftlich antworten</h6>
<p>Eine gute Ticketantwort hat einen klaren Betreff mit Ticketnummer, eine persönliche Anrede, fasst das Anliegen in einem Satz zusammen, nennt die Lösung in nummerierten
Schritten (gern mit Screenshot) und sagt, was als Nächstes passiert. Ironie, Großbuchstaben und Vorwürfe haben darin nichts zu suchen.</p>

<h6>Übungen mit Lösung</h6>
<p>1. Ein Anwender sagt am Telefon: „Ich warte jetzt seit drei Tagen auf meinen Zugang!“ Analysiere die Nachricht mit den vier Seiten.</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Sachinhalt: Der Zugang ist seit drei Tagen nicht eingerichtet. Selbstkundgabe: Ich bin verärgert, kann nicht richtig arbeiten.
Beziehung: Ihr kümmert euch nicht um mich. Appell: Richtet den Zugang jetzt ein.</p>
</details>
<p>2. Formuliere zu „Drucker geht nicht“ eine offene, eine geschlossene und eine Kontrollfrage.</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Offen: „Was passiert, wenn Sie auf Drucken klicken?“ Geschlossen: „Erscheint der Auftrag in der Druckwarteschlange?“
Kontrollfrage: „Habe ich richtig verstanden, dass der Drucker bei den Kollegen funktioniert, nur bei Ihnen nicht?“</p>
</details>
<p>3. Schreibe den Satz „Sie haben die falsche Software installiert, das unterstützen wir nicht.“ kundenorientiert um.</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Zum Beispiel: „Die installierte Version gehört leider nicht zu unserem Standard, deshalb können wir dafür keinen Support leisten. Ich installiere Ihnen gern die
freigegebene Version – passt Ihnen heute 15 Uhr?“</p>
</details>
INHALT,
    'summary' => [
        'Gesprächsphasen: begrüßen, Anliegen erfassen, zusammenfassen, lösen oder vereinbaren, abschließen – dokumentieren läuft mit.',
        'Aktives Zuhören: aufmerksam sein, paraphrasieren, Gefühle ansprechen.',
        'Fragetechniken: offen, geschlossen, Alternativ- und Kontrollfrage; Trichter von offen nach geschlossen.',
        'Vier-Seiten-Modell: Sachinhalt, Selbstkundgabe, Beziehung, Appell.',
        'Beschwerden: ruhig bleiben, zuhören, sachlich klären, realistische Lösung, Zusagen einhalten.',
    ],
    'quiz' => [
        ['question' => 'Welche vier Seiten hat eine Nachricht nach Schulz von Thun?', 'answer' => 'Sachinhalt, Selbstkundgabe (Selbstoffenbarung), Beziehung, Appell.'],
        ['question' => 'Was ist eine Kontrollfrage?', 'answer' => 'Eine Frage, mit der man das eigene Verständnis bestätigen lässt, z. B. „Habe ich richtig verstanden, dass …?“'],
        ['question' => 'Was bedeutet paraphrasieren?', 'answer' => 'Das Gehörte in eigenen Worten wiedergeben.'],
        ['question' => 'Wie geht die Trichtertechnik?', 'answer' => 'Erst offene Fragen für den Überblick, dann zunehmend gezielte, geschlossene Fragen zum Eingrenzen.'],
    ],
];
