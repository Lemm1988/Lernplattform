<?php
return [
    'title' => 'Datenschutz im eigenen Arbeitsbereich',
    'intro' => 'Datenschutz ist keine Sache der Rechtsabteilung allein. Jede offene CC-Liste, jeder Screenshot im Ticket und jede Testdatenbank mit echten Kunden ist eine Frage der DSGVO. Hier geht es darum, personenbezogene Daten zu erkennen und im Alltag richtig zu handeln.',
    'goals' => [
        'personenbezogene Daten und besondere Kategorien erkennen',
        'Anonymisierung und Pseudonymisierung unterscheiden',
        'Grundsätze, Rechtsgrundlagen und Betroffenenrechte der DSGVO nennen',
        'bei einer Datenpanne richtig und fristgerecht handeln',
        'Datenschutzfehler im eigenen Arbeitsalltag vermeiden',
    ],
    'content' => <<<'INHALT'
<h6>Was sind personenbezogene Daten?</h6>
<p>Alle Informationen, die sich auf eine <strong>identifizierte oder identifizierbare</strong> natürliche Person beziehen (Art. 4 DSGVO): Name, Anschrift, E-Mail, Telefonnummer,
Personalnummer, Kfz-Kennzeichen, Standortdaten, Foto, Stimme, IP-Adresse, Cookie-Kennungen. „Identifizierbar“ reicht – es genügt, dass sich die Person mit vertretbarem
Aufwand bestimmen lässt.</p>
<p><strong>Besondere Kategorien</strong> (Art. 9) sind grundsätzlich verboten und nur mit Ausnahmen erlaubt: Gesundheitsdaten, ethnische Herkunft, politische Meinungen,
religiöse oder weltanschauliche Überzeugungen, Gewerkschaftszugehörigkeit, genetische Daten, biometrische Daten zur Identifizierung, Sexualleben und sexuelle Orientierung.
Sie haben fast immer einen sehr hohen Schutzbedarf.</p>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf4/personenbezug.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Personenbezogene Daten mit Namen, pseudonymisiert mit Kundenkennung und getrennter Zuordnung, anonymisiert als zusammengefasste Statistik">
  <figcaption class="figure-caption">Pseudonymisierte Daten bleiben personenbezogen, anonymisierte nicht</figcaption>
</figure>

<h6>Die Regeln in Kürze</h6>
<ul>
  <li><strong>Grundsätze</strong> (Art. 5): Rechtmäßigkeit und Transparenz, Zweckbindung, Datenminimierung, Richtigkeit, Speicherbegrenzung, Integrität und Vertraulichkeit,
    Rechenschaftspflicht. Wie sie in einem Softwareprojekt umgesetzt werden, zeigt <a href="/Learningfields/LF12/kapitel9.php">LF12 Kapitel 9</a>.</li>
  <li><strong>Verbot mit Erlaubnisvorbehalt</strong>: Jede Verarbeitung braucht eine Rechtsgrundlage nach Art. 6 – Einwilligung, Vertrag, rechtliche Pflicht,
    lebenswichtige Interessen, öffentliche Aufgabe oder berechtigtes Interesse.</li>
  <li><strong>Einwilligung</strong>: freiwillig, informiert, für einen bestimmten Zweck, eindeutig (kein vorangekreuztes Häkchen) und jederzeit widerrufbar.</li>
  <li><strong>Auftragsverarbeitung</strong> (Art. 28): Verarbeitet ein Dienstleister Daten im Auftrag – Hosting, Cloud, externer Support, Lohnabrechnung –,
    braucht es einen Auftragsverarbeitungsvertrag (AVV). Für Übermittlungen in Länder außerhalb der EU gelten zusätzliche Regeln.</li>
  <li><strong>Dokumentation</strong>: Verzeichnis von Verarbeitungstätigkeiten (Art. 30); bei hohem Risiko eine Datenschutz-Folgenabschätzung (Art. 35).</li>
  <li><strong>Bußgelder</strong> (Art. 83): bis zu 20 Mio. € oder 4 % des weltweiten Jahresumsatzes, je nachdem, was höher ist. Dazu kommen Schadensersatzansprüche.</li>
</ul>

<h6>Rechte der Betroffenen</h6>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th>Recht</th><th>Artikel</th><th>Beispiel</th></tr></thead>
  <tbody>
    <tr><td>Information</td><td>13, 14</td><td>Datenschutzhinweise bei der Erhebung</td></tr>
    <tr><td>Auskunft</td><td>15</td><td>„Welche Daten haben Sie über mich gespeichert?“ – mit Kopie</td></tr>
    <tr><td>Berichtigung</td><td>16</td><td>falsche Anschrift korrigieren</td></tr>
    <tr><td>Löschung</td><td>17</td><td>Kundenkonto löschen, sofern keine Aufbewahrungspflicht entgegensteht</td></tr>
    <tr><td>Einschränkung</td><td>18</td><td>Daten sperren, solange die Richtigkeit strittig ist</td></tr>
    <tr><td>Datenübertragbarkeit</td><td>20</td><td>Export in einem gängigen, maschinenlesbaren Format</td></tr>
    <tr><td>Widerspruch</td><td>21</td><td>gegen Werbung jederzeit</td></tr>
  </tbody>
</table>
<p>Anfragen müssen unverzüglich, in der Regel innerhalb eines Monats beantwortet werden. Vorher die Identität prüfen – sonst gibt man die Daten womöglich einem Fremden.</p>

<h6>Datenpanne: was jetzt?</h6>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf4/datenpanne.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Zeitleiste von 0 bis 72 Stunden: sofort intern melden, eindämmen und bewerten, spätestens nach 72 Stunden Meldung an die Aufsichtsbehörde">
  <figcaption class="figure-caption">Wer zögert, verpasst die Frist</figcaption>
</figure>

<h6>Typische Fehler im Arbeitsalltag</h6>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th>Situation</th><th>richtig</th></tr></thead>
  <tbody>
    <tr><td>Rundmail an 80 Kunden</td><td>Empfänger in <strong>BCC</strong>, nicht in An oder CC – sonst sieht jeder alle Adressen</td></tr>
    <tr><td>Anrufer will Auskunft über ein Kundenkonto</td><td>Identität prüfen (Rückruf an hinterlegte Nummer, Kundennummer plus Merkmal)</td></tr>
    <tr><td>Testsystem für die Entwicklung</td><td>keine Echtdaten; erfundene oder anonymisierte Testdaten</td></tr>
    <tr><td>Fehlerbericht mit Screenshot</td><td>Kundendaten schwärzen, bevor das Bild ins Ticket oder an den Hersteller geht</td></tr>
    <tr><td>Kurz weg vom Platz</td><td>Bildschirm sperren (Windows-Taste + L), Unterlagen nicht offen liegen lassen</td></tr>
    <tr><td>Kundendaten schnell weitergeben</td><td>nicht über private Messenger oder private Mailkonten</td></tr>
    <tr><td>alte Ausdrucke und Datenträger</td><td>Aktenvernichter, Datenträger sicher löschen oder vernichten lassen</td></tr>
  </tbody>
</table>

<h6>Übungen mit Lösung</h6>
<p>1. Welche Daten sind personenbezogen? (a) die dynamische IP-Adresse eines Website-Besuchers, (b) „In Filiale Nord arbeiten 14 Personen“, (c) die Personalnummer 20417, (d) ein Foto der Weihnachtsfeier.</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">(a) ja – der Provider kann sie einem Anschluss zuordnen. (b) nein, eine zusammengefasste Zahl. (c) ja – über die Personalverwaltung ist die Person bestimmbar.
(d) ja, sofern Personen erkennbar sind.</p>
</details>
<p>2. Freitag 17 Uhr: Ein Kollege merkt, dass er eine Tabelle mit Gehaltsdaten an eine falsche externe Adresse geschickt hat. Was ist zu tun, und bis wann?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Sofort intern melden (Vorgesetzte, DSB). Eindämmen: Empfänger um Löschung bitten und dies bestätigen lassen. Bewerten: Gehaltsdaten, also eher hohes Risiko.
Meldung an die Aufsichtsbehörde bis spätestens Montag 17 Uhr (72 Stunden, das Wochenende zählt mit). Bei hohem Risiko auch die Betroffenen informieren. Alles dokumentieren.</p>
</details>
<p>3. Eine Entwicklerin kopiert die Produktivdatenbank mit 20.000 Kundendaten auf ihren Laptop, um einen Fehler nachzustellen. Was ist problematisch, und was wäre besser?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Verstoß gegen Zweckbindung und Datenminimierung, hohes Risiko bei Verlust des Laptops. Besser: mit anonymisierten oder erfundenen Testdaten arbeiten,
nur den nötigen Ausschnitt pseudonymisiert verwenden, Laptop verschlüsseln und die Kopie danach löschen.</p>
</details>
INHALT,
    'summary' => [
        'Personenbezogen ist alles, was eine Person identifiziert oder identifizierbar macht – auch IP-Adressen und Kennungen.',
        'Besondere Kategorien (Art. 9) wie Gesundheitsdaten brauchen besonderen Schutz.',
        'Pseudonymisierte Daten bleiben personenbezogen, anonymisierte fallen nicht unter die DSGVO.',
        'Jede Verarbeitung braucht eine Rechtsgrundlage; Betroffene haben Rechte auf Auskunft, Berichtigung, Löschung u. a.',
        'Datenpanne: sofort intern melden, eindämmen, bewerten, binnen 72 h an die Aufsichtsbehörde, immer dokumentieren.',
    ],
    'quiz' => [
        ['question' => 'Ist eine IP-Adresse ein personenbezogenes Datum?', 'answer' => 'Ja, in der Regel – sie lässt sich mit vertretbarem Aufwand einem Anschluss und damit einer Person zuordnen.'],
        ['question' => 'Was unterscheidet Pseudonymisierung von Anonymisierung?', 'answer' => 'Bei Pseudonymisierung ist die Person über eine getrennt aufbewahrte Zuordnung wieder bestimmbar, bei Anonymisierung nicht mehr.'],
        ['question' => 'Innerhalb welcher Frist ist eine Datenpanne der Aufsichtsbehörde zu melden?', 'answer' => 'Innerhalb von 72 Stunden, nachdem sie bekannt wurde.'],
        ['question' => 'Wie verschickt man eine Rundmail an viele Kunden datenschutzgerecht?', 'answer' => 'Mit den Empfängern im BCC-Feld.'],
    ],
];
