<?php
return [
    'title' => 'Qualität von Oberflächen sichern',
    'intro' => 'Wann ist eine Benutzeroberfläche „gut genug“? Qualitätsmodelle machen das messbar, Styleguides und automatisierte Tests halten die Qualität über viele Versionen hinweg.',
    'goals' => [
        'Qualitätsmerkmale nach ISO/IEC 25010 nennen und an Beispielen erläutern',
        'konstruktive und analytische Qualitätssicherung unterscheiden',
        'manuelle und automatisierte UI-Tests planen und einen End-to-End-Test lesen',
        'Performance und Barrierefreiheit einer Web-Oberfläche messen',
    ],
    'content' => <<<'INHALT'
<h6>Qualitätsmodell nach ISO/IEC 25010</h6>
<p>Die Norm ISO/IEC 25010 beschreibt die <strong>Produktqualität</strong> von Software mit acht Merkmalen. Sie ist die Nachfolgerin der ISO 9126, deren
Begriffe (Funktionalität, Zuverlässigkeit, Benutzbarkeit, Effizienz, Änderbarkeit, Übertragbarkeit) in Prüfungsaufgaben ebenfalls noch vorkommen.</p>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf10/iso25010.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Acht Qualitätsmerkmale: funktionale Eignung, Leistungseffizienz, Kompatibilität, Benutzbarkeit, Zuverlässigkeit, Sicherheit, Wartbarkeit, Übertragbarkeit">
  <figcaption class="figure-caption">Acht Merkmale – jedes mit messbaren Teilmerkmalen</figcaption>
</figure>
<p>In der Überarbeitung von 2023 heißen zwei Merkmale anders (Benutzbarkeit → Interaktionsfähigkeit, Übertragbarkeit → Flexibilität) und
<em>Safety</em> (Schutz von Menschen und Umwelt) kam als neuntes Merkmal hinzu. Für die Prüfung reicht es, die Merkmale zu kennen und auf ein Beispiel
anzuwenden – etwa: „Die Suche liefert nach höchstens 2 Sekunden ein Ergebnis“ (Leistungseffizienz), „Alle Funktionen sind per Tastatur bedienbar“
(Benutzbarkeit/Barrierefreiheit).</p>
<div class="lf-pruefung"><strong>Prüfungstipp:</strong> Qualitätsanforderungen müssen <strong>messbar</strong> sein. „Die Seite soll schnell laden“ ist nicht
prüfbar; „Die Startseite ist bei 4G-Verbindung nach 2,5 Sekunden vollständig sichtbar“ schon. Solche nichtfunktionalen Anforderungen gehören ins
Pflichtenheft.</div>

<h6>Konstruktive und analytische Qualitätssicherung</h6>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th></th><th>konstruktiv – Fehler vermeiden</th><th>analytisch – Fehler finden</th></tr></thead>
  <tbody>
    <tr><th>Idee</th><td>Qualität wird von Anfang an „hineingebaut“</td><td>vorhandene Ergebnisse werden geprüft</td></tr>
    <tr><th>Beispiele</th><td>Styleguide und Design-System, Komponentenbibliothek, Programmierrichtlinien, Vorlagen, Schulung, geeignete Werkzeuge
    (Linter, Formatierer), Vorgehensmodell</td><td>Tests (manuell und automatisiert), Code-Reviews, Usability-Tests (<a href="/Learningfields/LF10/kapitel3.php">Kapitel 3</a>), Barrierefreiheits-Audit,
    Performance-Messung</td></tr>
  </tbody>
</table>
<p>Ein <strong>Styleguide</strong> (Gestaltungsrichtlinie) legt Farben, Schriften, Abstände, Symbole und Formulierungen fest. Ein
<strong>Design-System</strong> geht weiter und liefert fertige, getestete Komponenten (Buttons, Formularfelder, Dialoge) samt Code. Beides sichert die
Konsistenz aus <a href="/Learningfields/LF10/kapitel2.php">Kapitel 2</a> über viele Seiten und Entwickler hinweg – auch Bootstrap ist im Kern ein solches System.</p>

<h6>Oberflächen testen</h6>
<p>Die Teststufen und -verfahren aus <a href="/Learningfields/LF8/kapitel14.php">LF8 Kapitel 14</a> gelten auch für Oberflächen. Typische UI-Tests:</p>
<ul>
  <li><strong>Manueller Test</strong> nach Testfallbeschreibung: Schritte, Eingaben, erwartetes Ergebnis, Protokoll.</li>
  <li><strong>End-to-End-Test</strong> (E2E): Ein Programm steuert einen echten Browser, klickt und tippt wie ein Mensch und prüft das Ergebnis.
  Werkzeuge: Playwright, Selenium, Cypress.</li>
  <li><strong>Cross-Browser- und Gerätetest</strong>: Chrome, Firefox, Safari; Smartphone, Tablet, Desktop.</li>
  <li><strong>Visueller Regressionstest</strong>: Screenshots werden mit einer freigegebenen Version verglichen, um ungewollte Layoutänderungen zu finden.</li>
</ul>
<p>Ein E2E-Test für die Kursanmeldung aus <a href="/Learningfields/LF10/kapitel7.php">Kapitel 7</a>, geschrieben mit Playwright für Python:</p>
<pre class="bg-light border rounded p-3"><code>from playwright.sync_api import expect

URL = "http://127.0.0.1:8003/anmeldung.php"

def test_fehlermeldung_bei_ungueltiger_email(page):
    page.goto(URL)
    page.get_by_label("Name").fill("Kaya")
    page.get_by_label("E-Mail").fill("kaya.example.org")
    page.get_by_label("Alter").fill("34")
    page.get_by_label("Kurs").select_option("sql")
    page.get_by_role("button", name="Anmelden").click()
    expect(page.locator("#email-fehler")).to_contain_text("gültige E-Mail-Adresse")
    expect(page.get_by_label("Name")).to_have_value("Kaya")        # Eingabe bleibt erhalten

def test_erfolgreiche_anmeldung(page):
    page.goto(URL)
    page.get_by_label("Name").fill("Kaya")
    page.get_by_label("E-Mail").fill("kaya@example.org")
    page.get_by_label("Alter").fill("34")
    page.get_by_label("Kurs").select_option("sql")
    page.get_by_role("button", name="Anmelden").click()
    expect(page.get_by_role("status")).to_contain_text("Danke, Kaya!")
    expect(page.locator("#liste li").last).to_have_text("Kaya – SQL kompakt")</code></pre>
<p>Beide Tests laufen grün. Auffällig: Der Test findet die Felder über ihre <strong>Beschriftung</strong> (<code>get_by_label</code>) und Buttons über
ihre <strong>Rolle</strong> – genau so, wie Menschen und Screenreader die Seite wahrnehmen. Fehlen Labels, scheitert der Test. Barrierefreiheit und
Testbarkeit gehen Hand in Hand.</p>

<h6>Performance und Barrierefreiheit messen</h6>
<p>Google bewertet Webseiten mit den <strong>Core Web Vitals</strong>:</p>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th>Kennzahl</th><th>misst</th><th>gut bis</th></tr></thead>
  <tbody>
    <tr><td>LCP – Largest Contentful Paint</td><td>wann der größte sichtbare Inhalt geladen ist</td><td>2,5 s</td></tr>
    <tr><td>INP – Interaction to Next Paint</td><td>wie schnell die Seite auf Klicks und Eingaben reagiert</td><td>200 ms</td></tr>
    <tr><td>CLS – Cumulative Layout Shift</td><td>wie stark Inhalte beim Laden verspringen</td><td>0,1</td></tr>
  </tbody>
</table>
<p>Gemessen wird z. B. mit <strong>Lighthouse</strong> in den Chrome-Entwicklerwerkzeugen, das zugleich Barrierefreiheit, Best Practices und
Suchmaschinenoptimierung prüft. Typische Verbesserungen: Bilder komprimieren und mit Breite/Höhe angeben (gegen Layoutsprünge), CSS und JavaScript
minimieren, Daten erst bei Bedarf laden (Lazy Loading), Caching aktivieren.</p>
<div class="lf-merke"><strong>Merke:</strong> Automatische Prüfungen sind schnell und lassen sich bei jedem Commit wiederholen (Continuous Integration),
finden aber nicht alles. Ob eine Oberfläche verständlich ist, zeigt nur ein Test mit Menschen.</div>

<h6>Übungen mit Lösung</h6>
<p>1. Ordne zu: a) Nach einem Serverausfall ist der Shop nach 5 Minuten wieder erreichbar. b) Ein neuer Zahlungsanbieter lässt sich in einem Tag
anbinden. c) Die App läuft auch unter Android 12. d) Neue Mitarbeiter finden sich ohne Schulung zurecht.</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">a) Zuverlässigkeit (Wiederherstellbarkeit), b) Wartbarkeit (Änderbarkeit, Modularität), c) Übertragbarkeit (Anpassbarkeit),
d) Benutzbarkeit (Erlernbarkeit).</p>
</details>
<p>2. Konstruktiv oder analytisch? a) Code-Review, b) Einführung eines Styleguides, c) Lighthouse-Messung, d) Schulung zu Barrierefreiheit.</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">a) analytisch, b) konstruktiv, c) analytisch, d) konstruktiv.</p>
</details>
<p>3. Formuliere die Anforderung „Die Seite soll benutzerfreundlich sein“ messbar.</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Zum Beispiel: „Mindestens 4 von 5 Testpersonen der Zielgruppe schließen eine Bestellung ohne Hilfe in unter 3 Minuten ab; der SUS-Wert liegt
bei mindestens 75; alle Seiten erfüllen WCAG 2.2 Stufe AA.“</p>
</details>
INHALT,
    'summary' => [
        'ISO/IEC 25010: funktionale Eignung, Leistungseffizienz, Kompatibilität, Benutzbarkeit, Zuverlässigkeit, Sicherheit, Wartbarkeit, Übertragbarkeit.',
        'Qualitätsanforderungen messbar formulieren.',
        'Konstruktive QS vermeidet Fehler (Styleguide, Design-System, Richtlinien); analytische QS findet sie (Tests, Reviews, Audits).',
        'UI-Tests: manuell, End-to-End mit Playwright/Selenium, Cross-Browser, visuelle Regression.',
        'Core Web Vitals (LCP, INP, CLS) und Lighthouse für Performance und Barrierefreiheit.',
    ],
    'quiz' => [
        ['question' => 'Was unterscheidet konstruktive von analytischer Qualitätssicherung?', 'answer' => 'Konstruktive Maßnahmen verhindern Fehler von vornherein (Richtlinien, Styleguides, Werkzeuge); analytische Maßnahmen finden Fehler in fertigen Ergebnissen (Tests, Reviews).'],
        ['question' => 'Was ist ein End-to-End-Test?', 'answer' => 'Ein automatisierter Test, der die Anwendung über die Oberfläche in einem echten Browser bedient und das Ergebnis aus Nutzersicht prüft.'],
        ['question' => 'Was misst der Core-Web-Vital CLS?', 'answer' => 'Wie stark Inhalte während des Ladens verspringen (Cumulative Layout Shift); gut ist ein Wert bis 0,1.'],
        ['question' => 'Nenne vier Qualitätsmerkmale nach ISO/IEC 25010.', 'answer' => 'Z. B. funktionale Eignung, Leistungseffizienz, Benutzbarkeit, Zuverlässigkeit, Sicherheit, Wartbarkeit, Kompatibilität, Übertragbarkeit.'],
    ],
];
