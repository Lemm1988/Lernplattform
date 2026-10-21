<?php
return [
    'title' => 'Recht im Kundenprojekt: Datenschutz, Urheberrecht, Lizenzen',
    'intro' => 'Eine Terminbuchung verarbeitet Namen, E-Mail-Adressen und Telefonnummern – und baut auf fremden Bibliotheken auf. Wer die rechtlichen Spielregeln kennt, vermeidet teure Fehler.',
    'goals' => [
        'die Grundsätze der DSGVO auf ein Softwareprojekt anwenden',
        'Rechtsgrundlagen, Betroffenenrechte und technisch-organisatorische Maßnahmen nennen',
        'Urheberrecht und Nutzungsrechte an Software einordnen',
        'proprietäre Lizenzmodelle und Open-Source-Lizenzen (permissiv, Copyleft) unterscheiden',
    ],
    'content' => <<<'INHALT'
<h6>Datenschutz nach der DSGVO</h6>
<p>Personenbezogene Daten sind alle Informationen über eine identifizierte oder identifizierbare Person – Name, E-Mail, Telefonnummer, IP-Adresse,
Kennzeichen des Fahrrads mit Rahmennummer. Für ihre Verarbeitung gelten die <strong>Grundsätze aus Art. 5 DSGVO</strong>:</p>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th>Grundsatz</th><th>in der Terminbuchung</th></tr></thead>
  <tbody>
    <tr><td>Rechtmäßigkeit, Transparenz</td><td>Datenschutzerklärung auf der Buchungsseite</td></tr>
    <tr><td>Zweckbindung</td><td>Daten nur für Termin und Erinnerung, nicht heimlich für Werbung</td></tr>
    <tr><td>Datenminimierung</td><td>Name, E-Mail, Termin, kurze Beschreibung – kein Geburtsdatum, keine Anschrift</td></tr>
    <tr><td>Richtigkeit</td><td>Kunden können ihre Angaben ändern</td></tr>
    <tr><td>Speicherbegrenzung</td><td>Termindaten nach Ablauf der Aufbewahrungsfrist automatisch löschen</td></tr>
    <tr><td>Integrität, Vertraulichkeit</td><td>HTTPS, Passwort-Hashes, Zugriff nur für Berechtigte, Backups</td></tr>
    <tr><td>Rechenschaftspflicht</td><td>Maßnahmen dokumentieren und nachweisen können</td></tr>
  </tbody>
</table>
<p>Jede Verarbeitung braucht eine <strong>Rechtsgrundlage</strong> nach Art. 6 DSGVO – z. B. <strong>Vertrag</strong> (b), <strong>Einwilligung</strong> (a),
<strong>rechtliche Verpflichtung</strong> (c) oder <strong>berechtigtes Interesse</strong> (f). Für die Buchung und die Terminerinnerung ist der Vertrag die Grundlage;
ein Newsletter braucht dagegen eine eigene, freiwillige Einwilligung (kein vorangekreuztes Häkchen).</p>
<p><strong>Betroffenenrechte</strong>: Auskunft (Art. 15), Berichtigung (Art. 16), Löschung (Art. 17), Einschränkung (Art. 18), Datenübertragbarkeit (Art. 20),
Widerspruch (Art. 21). Die Software muss sie technisch unterstützen – etwa mit einer Exportfunktion und einer echten Löschung.</p>
<ul>
  <li><strong>Privacy by Design und by Default</strong> (Art. 25): Datenschutz von Anfang an einplanen; Voreinstellungen so datensparsam wie möglich.</li>
  <li><strong>Technisch-organisatorische Maßnahmen</strong> (TOM, Art. 32): Verschlüsselung, Zugriffskonzepte, Protokollierung, Backups, Schulung.</li>
  <li><strong>Verzeichnis von Verarbeitungstätigkeiten</strong> (Art. 30) und, bei externem Hosting, ein <strong>Auftragsverarbeitungsvertrag</strong> (Art. 28, LF8 Kapitel 12).</li>
  <li><strong>Datenpannen</strong> sind in der Regel binnen 72 Stunden der Aufsichtsbehörde zu melden (Art. 33).</li>
</ul>
<div class="lf-merke"><strong>Merke:</strong> Datenschutz betrifft auch Logdateien, Backups, Testsysteme und Repositories. Server-Logs mit IP-Adressen in einem
öffentlichen Git-Repository sind eine Datenpanne.</div>

<h6>Urheberrecht und Nutzungsrechte</h6>
<p>Software ist nach § 69a UrhG als Sprachwerk geschützt – der Quelltext ebenso wie das ausführbare Programm; Ideen und Algorithmen als solche dagegen nicht.
Schafft ein Angestellter Software in Erfüllung seiner Aufgaben, stehen die vermögensrechtlichen Befugnisse dem <strong>Arbeitgeber</strong> zu (§ 69b UrhG).
Bei einem Werkvertrag (Kapitel 3) muss vertraglich geregelt werden, welche <strong>Nutzungsrechte</strong> der Kunde erhält: einfach oder ausschließlich, zeitlich
und räumlich beschränkt oder unbeschränkt, mit oder ohne Recht zur Bearbeitung und Herausgabe des Quelltexts.</p>

<h6>Lizenzmodelle proprietärer Software</h6>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th>Modell</th><th>Bedeutung</th></tr></thead>
  <tbody>
    <tr><td>Einzelplatz / Named User</td><td>Lizenz für ein Gerät bzw. eine benannte Person</td></tr>
    <tr><td>Mehrplatz / Volumen</td><td>Paket für viele Arbeitsplätze, oft mit Rabatt</td></tr>
    <tr><td>Concurrent (Floating)</td><td>nur so viele gleichzeitige Nutzer wie Lizenzen, egal wer</td></tr>
    <tr><td>Abonnement / Miete (SaaS)</td><td>Nutzung, solange gezahlt wird</td></tr>
    <tr><td>Freemium, Shareware</td><td>Grundversion kostenlos, Zusatzfunktionen oder Dauernutzung kostenpflichtig</td></tr>
  </tbody>
</table>

<h6>Open-Source-Lizenzen</h6>
<p>Open Source heißt nicht „ohne Regeln“: Der Quelltext ist offen und darf genutzt, verändert und weitergegeben werden – aber unter den Bedingungen der jeweiligen
Lizenz.</p>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf12/lizenzen.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Spektrum von freizügigen Lizenzen wie MIT über schwaches Copyleft wie LGPL bis zu starkem Copyleft wie GPL und AGPL mit den jeweiligen Pflichten">
  <figcaption class="figure-caption">Je weiter rechts, desto mehr muss man bei der Weitergabe offenlegen</figcaption>
</figure>
<p>Für die Terminbuchung bedeutet das: Eine Kalender-Bibliothek unter MIT darf eingebaut werden, solange ihr Lizenztext mitgeliefert wird. Würde die Firma eine
GPL-Bibliothek in ein Produkt einbauen, das sie an Kunden <em>weitergibt</em>, müsste sie das gesamte Produkt unter der GPL samt Quelltext weitergeben.
Abhängigkeiten werden deshalb vor dem Einsatz auf ihre Lizenz geprüft; Werkzeuge erstellen dazu eine Stückliste der Abhängigkeiten (SBOM).</p>
<div class="lf-pruefung"><strong>Prüfungstipp:</strong> Copyleft greift bei der <strong>Weitergabe</strong> (Distribution). Wer GPL-Software nur intern nutzt, muss
nichts veröffentlichen. Die AGPL schließt die Lücke für Software, die nur als Webdienst angeboten wird.</div>

<h6>Übungen mit Lösung</h6>
<p>1. Welche Rechtsgrundlage gilt a) für die Speicherung der E-Mail-Adresse zur Terminbestätigung, b) für einen monatlichen Werbenewsletter?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">a) Vertragserfüllung (Art. 6 Abs. 1 lit. b DSGVO). b) Einwilligung (lit. a) – freiwillig, aktiv, jederzeit widerrufbar.</p>
</details>
<p>2. Ein Kunde verlangt die Löschung seiner Daten. Die Rechnungen zu seinen Reparaturen unterliegen aber einer gesetzlichen Aufbewahrungsfrist (als
Buchungsbelege derzeit acht Jahre). Was tust du?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Alle Daten löschen, die nicht mehr benötigt werden (Terminhistorie, Notizen). Die Rechnungsdaten fallen unter eine gesetzliche Aufbewahrungspflicht und
werden bis Fristende gesperrt (Verarbeitung eingeschränkt), danach gelöscht. Den Kunden darüber informieren.</p>
</details>
<p>3. Ein Entwickler möchte eine Bibliothek unter der Apache-2.0-Lizenz in ein kommerzielles, geschlossenes Produkt einbauen. Geht das?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Ja. Apache 2.0 ist freizügig: Lizenztext und Hinweise (NOTICE-Datei) müssen erhalten bleiben, Änderungen an der Bibliothek sind kenntlich zu machen; das
eigene Produkt darf geschlossen bleiben.</p>
</details>
INHALT,
    'summary' => [
        'DSGVO-Grundsätze: Rechtmäßigkeit, Zweckbindung, Datenminimierung, Richtigkeit, Speicherbegrenzung, Integrität/Vertraulichkeit, Rechenschaftspflicht.',
        'Rechtsgrundlage nötig (Vertrag, Einwilligung, rechtliche Pflicht, berechtigtes Interesse); Betroffenenrechte technisch unterstützen.',
        'Privacy by Design/Default, TOM, Verarbeitungsverzeichnis, AVV, Meldung von Datenpannen binnen 72 Stunden.',
        'Software ist urheberrechtlich geschützt; Nutzungsrechte im Vertrag regeln; bei Angestellten liegen sie beim Arbeitgeber.',
        'Open Source: permissiv (MIT, Apache) vs. Copyleft (LGPL schwach, GPL/AGPL stark) – Pflichten greifen bei der Weitergabe.',
    ],
    'quiz' => [
        ['question' => 'Was bedeutet Datenminimierung?', 'answer' => 'Es dürfen nur die personenbezogenen Daten erhoben werden, die für den Zweck wirklich erforderlich sind.'],
        ['question' => 'Was ist der Kern des Copyleft-Prinzips?', 'answer' => 'Wer veränderte oder abgeleitete Software weitergibt, muss sie unter denselben Lizenzbedingungen samt Quelltext weitergeben.'],
        ['question' => 'Wem stehen die Rechte an Software zu, die ein Angestellter im Rahmen seiner Arbeit entwickelt?', 'answer' => 'Grundsätzlich dem Arbeitgeber (§ 69b UrhG), soweit nichts anderes vereinbart ist.'],
        ['question' => 'Innerhalb welcher Frist ist eine Datenpanne in der Regel der Aufsichtsbehörde zu melden?', 'answer' => 'Innerhalb von 72 Stunden nach Bekanntwerden (Art. 33 DSGVO).'],
    ],
];
