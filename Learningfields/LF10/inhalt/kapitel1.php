<?php
return [
    'title' => 'Vom Nutzer her denken: UI, UX und menschzentrierte Gestaltung',
    'intro' => 'Gute Oberflächen entstehen nicht am Bildschirm des Entwicklers, sondern im Kontakt mit den Menschen, die sie später benutzen.',
    'goals' => [
        'Benutzerschnittstelle (UI) und Nutzererlebnis (UX) unterscheiden',
        'Arten von Benutzerschnittstellen mit Vor- und Nachteilen nennen',
        'den menschzentrierten Gestaltungsprozess nach ISO 9241-210 beschreiben',
        'Nutzungskontext erheben und Personas sowie Nutzungsszenarien erstellen',
    ],
    'content' => <<<'INHALT'
<p>Die Grundbegriffe der Software-Ergonomie – Gebrauchstauglichkeit nach ISO 9241-11, die Interaktionsprinzipien der ISO 9241-110 und die
Entwurfsstufen von der Skizze zum Prototyp – findest du in <a href="/Learningfields/LF8/kapitel7.php">LF8 Kapitel 7</a>. LF10 setzt dort an und
zeigt, wie man Oberflächen systematisch plant, gestaltet, umsetzt und prüft.</p>

<h6>UI und UX</h6>
<p>Die <strong>Benutzerschnittstelle</strong> (User Interface, UI) ist alles, womit ein Mensch ein System bedient: Bildschirmaufbau, Schaltflächen,
Menüs, Texte, Tastenkürzel, Fehlermeldungen. Das <strong>Nutzererlebnis</strong> (User Experience, UX) ist weiter gefasst: Nach ISO 9241-210 umfasst es
die Wahrnehmungen und Reaktionen einer Person, die aus der tatsächlichen <em>und der erwarteten</em> Benutzung entstehen – also auch, was vor und nach der
eigentlichen Bedienung passiert (Erwartungen, Registrierung, Support, Gefühl danach).</p>
<div class="lf-merke"><strong>Merke:</strong> Ein schönes UI kann zu einer schlechten UX gehören – etwa wenn die App toll aussieht, aber die Bestellung im
letzten Schritt mit einer unverständlichen Fehlermeldung abbricht. UX ist das Ganze, UI ein Teil davon.</div>

<h6>Arten von Benutzerschnittstellen</h6>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th>Art</th><th>Beispiel</th><th>Stärken</th><th>Schwächen</th></tr></thead>
  <tbody>
    <tr><td>Kommandozeile (CLI)</td><td>PowerShell, Git</td><td>schnell für Profis, automatisierbar (Skripte)</td><td>Befehle müssen gelernt werden</td></tr>
    <tr><td>Grafische Oberfläche (GUI)</td><td>Desktop-Programm, Webseite</td><td>Elemente sind sichtbar, wenig Vorwissen nötig</td><td>bei Routinearbeit oft langsamer</td></tr>
    <tr><td>Touch / mobil</td><td>Smartphone-App</td><td>direkte Bedienung, immer dabei</td><td>kleiner Bildschirm, ungenaue Finger</td></tr>
    <tr><td>Sprache (VUI)</td><td>Sprachassistent, Telefon-Hotline</td><td>Hände frei, barrierearm für Blinde</td><td>Fehlerkennung, Datenschutz, schwer zu überblicken</td></tr>
    <tr><td>Programmierschnittstelle (API)</td><td>REST-API</td><td>für andere Programme gemacht</td><td>nur für Entwickler nutzbar</td></tr>
  </tbody>
</table>

<h6>Menschzentrierte Gestaltung (ISO 9241-210)</h6>
<p>Die Norm beschreibt einen Prozess, der die späteren Nutzer von Anfang an einbezieht und so lange <strong>iteriert</strong>, bis die Anforderungen erfüllt sind:</p>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf10/hcd-prozess.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Kreislauf: Nutzungskontext verstehen, Anforderungen festlegen, Lösungen gestalten, aus Nutzersicht bewerten; bei Nichterfüllung zurück, sonst fertig">
  <figcaption class="figure-caption">Vier Aktivitäten im Kreis – so oft wie nötig</figcaption>
</figure>
<p>Grundsätze dahinter: Die Gestaltung beruht auf einem klaren Verständnis von Nutzern, Aufgaben und Umgebung; Nutzer sind während des ganzen Prozesses
beteiligt; Bewertungen aus Nutzersicht treiben die Verbesserung voran; das Team ist fachübergreifend (Entwicklung, Design, Fachabteilung).</p>

<h6>Den Nutzungskontext erheben</h6>
<p>Der <strong>Nutzungskontext</strong> beschreibt <em>wer</em> das System <em>wofür</em> und <em>unter welchen Bedingungen</em> nutzt:</p>
<ul>
  <li><strong>Benutzer</strong>: Vorwissen, Alter, Sprache, Einschränkungen, Häufigkeit der Nutzung</li>
  <li><strong>Ziele und Aufgaben</strong>: Was wollen sie erreichen? Wie oft, wie dringend?</li>
  <li><strong>Ressourcen</strong>: Geräte, Zeit, Unterstützung durch Kollegen</li>
  <li><strong>Umgebung</strong>: technisch (Browser, Netz), physisch (laut, hell, unterwegs, Handschuhe), sozial (Zeitdruck, Kundenkontakt)</li>
</ul>
<p>Methoden: <strong>Interviews</strong> und <strong>Fragebögen</strong> (was Nutzer sagen), <strong>Beobachtung</strong> am Arbeitsplatz (was sie tatsächlich
tun – oft etwas anderes), Auswertung von Support-Tickets und Nutzungsstatistiken.</p>

<h6>Personas und Szenarien</h6>
<p>Eine <strong>Persona</strong> ist ein fiktiver, aber auf echten Erhebungsdaten beruhender Stellvertreter einer Nutzergruppe. Sie macht Anforderungen greifbar:
Statt „der Nutzer“ fragt das Team „Würde Ayşe das finden?“</p>
<div class="card mb-3" style="max-width: 560px">
  <div class="card-body">
    <div class="d-flex align-items-center gap-3 mb-2">
      <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center fw-bold" style="width:48px;height:48px" aria-hidden="true">AY</div>
      <div><strong>Ayşe Yılmaz, 41</strong><br><span class="text-muted small">Disponentin in einer Spedition, nutzt das Tourenplanungssystem täglich</span></div>
    </div>
    <p class="small mb-1"><strong>Ziele:</strong> Touren bis 9 Uhr verteilen, Änderungen schnell an Fahrer weitergeben.</p>
    <p class="small mb-1"><strong>Frust:</strong> fünf Klicks für eine Adressänderung, Fehlermeldungen ohne Lösungshinweis.</p>
    <p class="small mb-1"><strong>Kontext:</strong> zwei Monitore, häufige Telefonate nebenbei, arbeitet viel mit der Tastatur.</p>
    <p class="small mb-0"><strong>Zitat:</strong> „Wenn das Telefon klingelt, muss ich sofort sehen, wo ich war.“</p>
  </div>
</div>
<p>Ein <strong>Nutzungsszenario</strong> erzählt eine konkrete Situation: „Um 8:40 ruft ein Fahrer an, eine Lieferadresse hat sich geändert. Ayşe sucht
die Tour über die Kundennummer, ändert die Adresse während des Telefonats und schickt die Änderung mit einer Taste an das Fahrer-Tablet.“ Daraus
lassen sich Anforderungen ableiten: Suche nach Kundennummer, Bearbeiten ohne Seitenwechsel, Tastenkürzel, Zustand bleibt nach Unterbrechung erhalten.
Eine <strong>User Journey Map</strong> stellt alle Schritte eines Nutzers über die Zeit dar – inklusive Gefühlen und Problemstellen – und zeigt, wo die
UX am meisten leidet.</p>
<div class="lf-pruefung"><strong>Prüfungstipp:</strong> In Aufgaben zur Oberflächengestaltung bekommst du oft eine Beschreibung der Nutzer. Beziehe
deine Lösung ausdrücklich darauf („Da die Mitarbeiter im Lager Handschuhe tragen, werden große Schaltflächen verwendet …“). Allgemeine Regeln ohne Bezug
zum Nutzungskontext bringen weniger Punkte.</div>

<h6>Übungen mit Lösung</h6>
<p>1. Ordne zu – UI oder UX? a) Farbe und Größe des Bestellbuttons. b) Ärger darüber, dass die Bestätigungsmail erst nach zwei Tagen kommt.
c) Reihenfolge der Felder im Formular. d) Das Gefühl, der Seite die Kreditkartendaten anvertrauen zu können.</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">a) UI, b) UX (liegt außerhalb der eigentlichen Oberfläche), c) UI, d) UX. Alles UI-Gestaltete beeinflusst natürlich auch die UX.</p>
</details>
<p>2. Eine App für Paketzusteller soll entwickelt werden. Beschreibe den Nutzungskontext mit mindestens vier Aspekten.</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Benutzer: unterschiedliche Sprachkenntnisse, kurze Einarbeitung. Aufgaben: Zustellung bestätigen, Unterschrift erfassen, Nachbarn eintragen –
oft hundertmal am Tag. Umgebung: draußen, wechselndes Licht (Sonne), Regen, eine Hand trägt ein Paket, Zeitdruck. Technik: Smartphone, Funklöcher →
Offline-Fähigkeit nötig.</p>
</details>
<p>3. Warum reicht es nicht, Nutzer nur zu befragen?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Menschen beschreiben ihre Arbeit oft anders, als sie sie tatsächlich erledigen (Umwege, Zettel am Monitor, Workarounds). Beobachtung deckt
solche Abweichungen auf; Befragungen zeigen dagegen Meinungen und Wünsche.</p>
</details>
INHALT,
    'summary' => [
        'UI = Bedienoberfläche; UX = gesamtes Erleben vor, während und nach der Nutzung (ISO 9241-210).',
        'Schnittstellenarten: CLI, GUI, Touch, Sprache, API – jeweils mit eigenen Stärken und Schwächen.',
        'Menschzentrierte Gestaltung: Kontext verstehen → Anforderungen → Lösungen → aus Nutzersicht bewerten → iterieren.',
        'Nutzungskontext = Benutzer, Ziele/Aufgaben, Ressourcen, Umgebung.',
        'Personas, Szenarien und User Journeys machen Nutzergruppen und ihre Probleme greifbar.',
    ],
    'quiz' => [
        ['question' => 'Was unterscheidet UX von UI?', 'answer' => 'UI ist die Bedienoberfläche selbst; UX umfasst das gesamte Erleben einschließlich Erwartungen vorher und Eindrücken nachher.'],
        ['question' => 'Welche vier Aktivitäten umfasst der menschzentrierte Gestaltungsprozess?', 'answer' => 'Nutzungskontext verstehen und beschreiben, Nutzungsanforderungen festlegen, Gestaltungslösungen entwickeln, Lösungen aus Nutzersicht evaluieren.'],
        ['question' => 'Was ist eine Persona?', 'answer' => 'Ein fiktiver, aber auf echten Daten beruhender Stellvertreter einer Nutzergruppe mit Zielen, Problemen und Nutzungskontext.'],
        ['question' => 'Nenne vier Bestandteile des Nutzungskontexts.', 'answer' => 'Benutzer, Ziele und Aufgaben, Ressourcen sowie die technische, physische und soziale Umgebung.'],
    ],
];
