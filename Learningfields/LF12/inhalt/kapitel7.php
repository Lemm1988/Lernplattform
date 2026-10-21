<?php
return [
    'title' => 'Automatisch prüfen und ausliefern: CI/CD und Deployment',
    'intro' => 'Jede Änderung automatisch bauen, testen und auf Knopfdruck ausliefern – so werden Releases vom Nervenkitzel zur Routine.',
    'goals' => [
        'Continuous Integration, Continuous Delivery und Continuous Deployment unterscheiden',
        'die Stufen einer Pipeline beschreiben und eine einfache Pipeline-Konfiguration lesen',
        'Entwicklungs-, Test- und Produktionsumgebung trennen und Konfiguration sowie Geheimnisse richtig ablegen',
        'Deployment-Strategien und einen sicheren Ablauf mit Datenbankmigrationen und Rückfallplan beschreiben',
    ],
    'content' => <<<'INHALT'
<h6>CI, CD und CD</h6>
<ul>
  <li><strong>Continuous Integration</strong> (CI): Alle Entwickler führen ihre Änderungen häufig zusammen; jeder Push löst automatisch Build und Tests aus. Fehler
  fallen nach Minuten auf statt nach Wochen.</li>
  <li><strong>Continuous Delivery</strong>: Jeder Stand, der die Pipeline besteht, <em>könnte</em> ausgeliefert werden; die Freigabe in die Produktion erfolgt per Knopfdruck.</li>
  <li><strong>Continuous Deployment</strong>: Was alle Prüfungen besteht, geht <em>automatisch</em> in die Produktion.</li>
</ul>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf12/pipeline.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Pipeline mit Push, Build, Prüfen, Staging und Produktion; bei Fehlern stoppt die Pipeline und meldet an das Team">
  <figcaption class="figure-caption">Eine Pipeline ist eine Kette von Prüfungen – jede Stufe muss bestehen</figcaption>
</figure>

<h6>Eine Pipeline konfigurieren</h6>
<p>Pipelines werden als Datei im Repository beschrieben, z. B. für GitHub Actions in <code>.github/workflows/ci.yml</code>. Diese Konfiguration prüft ein PHP-Projekt:</p>
<pre class="bg-light border rounded p-3"><code>name: CI
on:
  push:
    branches: [main]
  pull_request:                                  # auch jeden Pull Request prüfen

jobs:
  pruefen:
    runs-on: ubuntu-latest
    steps:
      - uses: actions/checkout@v4                # Code holen
      - uses: shivammathur/setup-php@v2          # PHP installieren
        with:
          php-version: '8.2'
      - name: Syntax aller PHP-Dateien prüfen
        run: find . -name "*.php" -not -path "./vendor/*" -print0 | xargs -0 -n1 php -l
      - name: Unit-Tests
        run: php tests/run_all_tests.php</code></pre>
<p>Schlägt ein Schritt fehl (Rückgabewert ≠ 0), stoppt die Pipeline, und der Pull Request wird rot markiert. Der Syntax-Schritt wurde lokal gegen diese
Lernplattform ausgeführt: 372 PHP-Dateien geprüft – und tatsächlich eine abgeschnittene Testdatei gefunden. Genau dafür ist CI da: Der Fehler wäre bei
jedem Push sofort aufgefallen.</p>

<h6>Umgebungen, Konfiguration und Geheimnisse</h6>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th>Umgebung</th><th>Zweck</th><th>Daten</th></tr></thead>
  <tbody>
    <tr><td>Entwicklung (lokal)</td><td>programmieren, schnell ausprobieren</td><td>Beispieldaten (Seed)</td></tr>
    <tr><td>Test / Staging</td><td>Integration, E2E-Tests, Abnahme durch den Kunden; möglichst wie Produktion aufgebaut</td><td>Testdaten, nie ungeschützte Echtdaten</td></tr>
    <tr><td>Produktion</td><td>echter Betrieb</td><td>Echtdaten – Zugriff nur für Berechtigte</td></tr>
  </tbody>
</table>
<p>Der <strong>Code</strong> ist überall gleich; was sich unterscheidet, steht in der <strong>Konfiguration</strong>: Datenbankzugang, Fehleranzeige, Mailserver. Diese
liegt außerhalb des Repositories – als Umgebungsvariablen oder in einer nicht versionierten Datei wie <code>config.local.php</code>. Passwörter und API-Schlüssel
für die Pipeline gehören in den <strong>Secret-Speicher</strong> des CI-Systems, nie in die YAML-Datei. In der Produktion werden Fehlermeldungen nicht angezeigt,
sondern geloggt (<code>display_errors = Off</code>).</p>

<h6>Ausrollen ohne Bauchschmerzen</h6>
<p>Ein Deployment, das von Hand per FTP Dateien kopiert, ist fehleranfällig: vergessene Dateien, halb hochgeladene Stände, keine Rückkehr. Ein geplanter Ablauf:</p>
<ol>
  <li><strong>Sichern</strong>: Datenbank-Backup und Kopie des bisherigen Standes.</li>
  <li><strong>Datenbankmigrationen</strong> ausführen – versionierte SQL-Skripte, die das Schema Schritt für Schritt anpassen und gefahrlos wiederholbar sind.</li>
  <li><strong>Neue Version ausrollen</strong>, möglichst als Ganzes (z. B. in ein neues Verzeichnis und dann umschalten).</li>
  <li><strong>Smoke-Test</strong>: Startseite, Login, wichtigste Funktion – läuft alles?</li>
  <li><strong>Überwachen</strong>: Fehlerlogs und Erreichbarkeit beobachten; bei Problemen <strong>Rollback</strong> auf die vorige Version.</li>
</ol>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th>Strategie</th><th>Ablauf</th><th>Vorteil</th></tr></thead>
  <tbody>
    <tr><td>Blue-Green</td><td>zwei gleiche Umgebungen; die neue Version läuft auf der inaktiven, dann wird der Verkehr umgeschaltet</td><td>kein Ausfall, sofortiger Rückweg</td></tr>
    <tr><td>Rolling</td><td>Server werden nacheinander aktualisiert</td><td>keine doppelte Infrastruktur nötig</td></tr>
    <tr><td>Canary</td><td>zuerst bekommt nur ein kleiner Teil der Nutzer die neue Version</td><td>Fehler treffen nur wenige</td></tr>
  </tbody>
</table>
<div class="lf-merke"><strong>Merke:</strong> Gebaut wird einmal, ausgerollt wird dasselbe Paket in jede Umgebung. Was in der Produktion läuft, muss vorher in
genau dieser Form getestet worden sein.</div>

<h6>Übungen mit Lösung</h6>
<p>1. Was unterscheidet Continuous Delivery von Continuous Deployment?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Bei Continuous Delivery ist jeder geprüfte Stand auslieferbar, die Freigabe in die Produktion erfolgt aber bewusst per Knopfdruck. Bei Continuous
Deployment geht jeder Stand, der alle Prüfungen besteht, automatisch in die Produktion.</p>
</details>
<p>2. Ein Entwickler schreibt das Datenbankpasswort für die Tests direkt in die <code>ci.yml</code>. Was ist falsch, und wie geht es richtig?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Die Datei ist versioniert und für alle mit Zugriff aufs Repository lesbar. Richtig: Passwort als verschlüsseltes Secret im CI-System hinterlegen und
in der Pipeline als Umgebungsvariable einlesen (bei GitHub Actions z. B. <code>${{ secrets.DB_PASSWORT }}</code>).</p>
</details>
<p>3. Nach dem Ausrollen meldet das Fehlerlog massenhaft Datenbankfehler. Was tust du?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Rollback auf die vorige Version (und ggf. das Datenbank-Backup), Kunden informieren, Ursache in der Staging-Umgebung nachstellen – häufig eine vergessene
oder fehlerhafte Migration – und erst nach erfolgreichem Test erneut ausrollen.</p>
</details>
INHALT,
    'summary' => [
        'CI: häufig integrieren, jeder Push wird automatisch gebaut und getestet.',
        'Continuous Delivery: Freigabe per Knopfdruck; Continuous Deployment: automatisch in die Produktion.',
        'Pipeline als Datei im Repository; schlägt ein Schritt fehl, stoppt sie.',
        'Umgebungen trennen; Konfiguration und Secrets außerhalb des Codes; Produktion ohne Fehleranzeige.',
        'Deployment: Backup, Migrationen, Ausrollen, Smoke-Test, Überwachen, Rollback; Strategien Blue-Green, Rolling, Canary.',
    ],
    'quiz' => [
        ['question' => 'Was ist Continuous Integration?', 'answer' => 'Änderungen werden häufig in den gemeinsamen Stand integriert, und jeder Push wird automatisch gebaut und getestet.'],
        ['question' => 'Wo gehören Zugangsdaten für eine Pipeline hin?', 'answer' => 'In den verschlüsselten Secret-Speicher des CI-Systems, nicht in den Code oder die versionierte Konfigurationsdatei.'],
        ['question' => 'Was ist ein Blue-Green-Deployment?', 'answer' => 'Zwei gleich aufgebaute Umgebungen: Die neue Version wird auf der inaktiven installiert und geprüft, dann wird der Verkehr umgeschaltet; ein Rückweg ist sofort möglich.'],
        ['question' => 'Was ist ein Smoke-Test?', 'answer' => 'Ein kurzer Test der wichtigsten Funktionen direkt nach dem Ausrollen, um grobe Fehler sofort zu erkennen.'],
    ],
];
