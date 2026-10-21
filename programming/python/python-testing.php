<?php
include $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php';
include $_SERVER['DOCUMENT_ROOT'] . '/includes/python-navigation.php';
?>

<div class="layout-container">
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/sidebar.php'; ?>
    <div class="main-wrapper">
        <main class="main-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-4 col-lg-3"></div>
                    <div class="col-md-8 col-lg-9">
                        <?php renderPythonNavigation('python-testing'); ?>
                        <div class="d-flex justify-content-between align-items-center pt-3 pb-2 mb-3 border-bottom">
                            <h1 class="h2"><i class="bi bi-check-square text-primary me-2"></i>Testen mit pytest</h1>
                        </div>

                        <div class="content-section">
                            <h2>Warum automatisierte Tests?</h2>
                            <p>Ein <strong>Unit-Test</strong> ist ein kleines Programm, das eine einzelne Funktion mit festen Eingaben aufruft
                                und das Ergebnis mit dem erwarteten Wert vergleicht. Einmal geschrieben, läuft er bei jeder Änderung in
                                Sekunden – und meldet sofort, wenn etwas kaputtgeht, das vorher funktioniert hat (<em>Regression</em>).</p>
                            <div class="table-responsive">
                                <table class="table table-sm table-bordered">
                                    <thead class="table-light">
                                        <tr><th>Teststufe</th><th>Was wird geprüft?</th><th>Wer / wann</th></tr>
                                    </thead>
                                    <tbody>
                                        <tr><td><strong>Unit-Test</strong> (Modultest)</td><td>einzelne Funktion oder Klasse, isoliert</td><td>Entwickler, bei jeder Änderung</td></tr>
                                        <tr><td><strong>Integrationstest</strong></td><td>Zusammenspiel mehrerer Module, z. B. Code + Datenbank</td><td>Entwickler / CI-Pipeline</td></tr>
                                        <tr><td><strong>Systemtest</strong></td><td>das Gesamtsystem gegen die Anforderungen</td><td>Testteam</td></tr>
                                        <tr><td><strong>Abnahmetest</strong></td><td>erfüllt die Software das Lastenheft?</td><td>Auftraggeber</td></tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="content-section">
                            <h2>Der erste Test</h2>
                            <p>pytest installierst du mit <code>pip install pytest</code>. Es findet automatisch alle Dateien
                                <code>test_*.py</code> und darin alle Funktionen, deren Name mit <code>test_</code> beginnt. Geprüft wird mit
                                dem normalen <code>assert</code>.</p>
                            <div class="code-block">
<pre><code class="language-python"># preise.py
def brutto(netto, steuersatz=0.19):
    """Berechnet den Bruttopreis, gerundet auf Cent."""
    if netto &lt; 0:
        raise ValueError("Nettopreis darf nicht negativ sein")
    return round(netto * (1 + steuersatz), 2)</code></pre>
                            </div>
                            <div class="code-block">
<pre><code class="language-python"># test_preise.py
from preise import brutto

def test_brutto_mit_regelsteuersatz():
    assert brutto(100) == 119.0

def test_brutto_mit_ermaessigtem_satz():
    assert brutto(100, 0.07) == 107.0</code></pre>
                            </div>
                            <div class="code-block">
<pre><code class="language-bash">$ pytest -v
test_preise.py::test_brutto_mit_regelsteuersatz PASSED          [ 50%]
test_preise.py::test_brutto_mit_ermaessigtem_satz PASSED        [100%]
========================= 2 passed in 0.02s =========================</code></pre>
                            </div>
                            <p>Schlägt ein Test fehl, zeigt pytest beide Werte nebeneinander – du siehst sofort, was erwartet war
                                und was tatsächlich herauskam.</p>
                        </div>

                        <div class="content-section">
                            <h2>Aufbau eines guten Tests: Arrange – Act – Assert</h2>
                            <p>Jeder Test folgt demselben Dreischritt. Das macht Tests lesbar wie eine kleine Geschichte:</p>
                            <div class="code-block">
<pre><code class="language-python">from warenkorb import Warenkorb

def test_rabatt_ab_100_euro():
    # Arrange – Ausgangslage herstellen
    korb = Warenkorb()
    korb.hinzufuegen("Monitor", 200.00)

    # Act – genau eine Aktion ausführen
    summe = korb.summe_mit_rabatt()

    # Assert – Ergebnis prüfen
    assert summe == 180.00      # 10 % Rabatt ab 100 Euro</code></pre>
                            </div>
                            <div class="tip-box mt-3">
                                <h5><i class="bi bi-lightbulb text-warning"></i> Faustregeln</h5>
                                <ul class="small mb-0">
                                    <li>Ein Test prüft <strong>ein</strong> Verhalten – der Name sagt, welches.</li>
                                    <li>Tests sind unabhängig voneinander und laufen in beliebiger Reihenfolge.</li>
                                    <li>Keine echten Netzwerk- oder Datenbankzugriffe im Unit-Test.</li>
                                </ul>
                            </div>
                        </div>

                        <div class="content-section">
                            <h2>Fehlerfälle und Kommazahlen testen</h2>
                            <p>Mit <code>pytest.raises</code> prüfst du, dass eine Funktion bei ungültiger Eingabe die richtige Exception
                                wirft. Für Gleitkommazahlen nimmst du <code>pytest.approx</code>, weil <code>0.1 + 0.2</code> eben nicht exakt
                                <code>0.3</code> ist.</p>
                            <div class="code-block">
<pre><code class="language-python">import pytest
from preise import brutto

def test_negativer_preis_wird_abgelehnt():
    with pytest.raises(ValueError, match="negativ"):
        brutto(-5)

def test_gleitkomma_vergleich():
    assert 0.1 + 0.2 == pytest.approx(0.3)</code></pre>
                            </div>
                        </div>

                        <div class="content-section">
                            <h2>Testfälle systematisch finden</h2>
                            <p>Alle möglichen Eingaben zu testen ist unmöglich. Zwei Methoden helfen, mit wenigen Tests viel abzudecken –
                                beide sind typischer Prüfungsstoff:</p>
                            <h3>Äquivalenzklassen</h3>
                            <p>Eingaben, die das Programm gleich behandelt, bilden eine Klasse. Aus jeder Klasse genügt ein Vertreter.
                                Beispiel: Eine Funktion <code>versandkosten(gewicht_kg)</code> berechnet</p>
                            <ul>
                                <li>unter 0 kg → Fehler (ungültige Klasse),</li>
                                <li>0 bis unter 2 kg → 4,99 €,</li>
                                <li>2 bis 10 kg → 6,99 €,</li>
                                <li>über 10 kg → 14,99 €.</li>
                            </ul>
                            <h3>Grenzwertanalyse</h3>
                            <p>Fehler stecken besonders oft an den Rändern (<code>&lt;</code> statt <code>&lt;=</code>). Darum testest du
                                direkt an jeder Grenze und knapp daneben: −0,01 · 0 · 1,99 · 2 · 10 · 10,01.</p>
                            <p>Mit <code>@pytest.mark.parametrize</code> schreibst du dafür einen einzigen Test, der für jede Zeile der Tabelle
                                einmal läuft:</p>
                            <div class="code-block">
<pre><code class="language-python">import pytest
from versand import versandkosten

@pytest.mark.parametrize("gewicht, erwartet", [
    (0,     4.99),     # untere Grenze
    (1.99,  4.99),     # knapp unter 2 kg
    (2,     6.99),     # Grenze 2 kg
    (10,    6.99),     # Grenze 10 kg
    (10.01, 14.99),    # knapp über 10 kg
])
def test_versandkosten(gewicht, erwartet):
    assert versandkosten(gewicht) == erwartet

def test_negatives_gewicht():
    with pytest.raises(ValueError):
        versandkosten(-0.01)</code></pre>
                            </div>
                        </div>

                        <div class="content-section">
                            <h2>Fixtures: gemeinsame Ausgangslage</h2>
                            <p>Brauchen mehrere Tests dieselben Testdaten, legst du sie in eine <strong>Fixture</strong>. pytest erzeugt sie
                                für jeden Test neu und übergibt sie als Parameter – die Tests beeinflussen sich so nicht gegenseitig.</p>
                            <div class="code-block">
<pre><code class="language-python">import pytest
from warenkorb import Warenkorb

@pytest.fixture
def voller_korb():
    korb = Warenkorb()
    korb.hinzufuegen("Tastatur", 39.90)
    korb.hinzufuegen("Maus", 19.90)
    return korb

def test_anzahl_artikel(voller_korb):
    assert voller_korb.anzahl() == 2

def test_artikel_entfernen(voller_korb):
    voller_korb.entfernen("Maus")
    assert voller_korb.anzahl() == 1</code></pre>
                            </div>
                        </div>

                        <div class="content-section">
                            <h2>Test-Driven Development (TDD)</h2>
                            <p>Bei TDD schreibst du den Test <em>vor</em> dem Code, in einem kurzen Kreislauf:</p>
                            <ol>
                                <li><strong>Red:</strong> Test für das nächste kleine Verhalten schreiben – er schlägt fehl.</li>
                                <li><strong>Green:</strong> gerade so viel Code schreiben, dass der Test grün wird.</li>
                                <li><strong>Refactor:</strong> Code aufräumen; die Tests sichern ab, dass nichts kaputtgeht.</li>
                            </ol>
                            <p>Wie viel deines Codes die Tests durchlaufen, misst <code>pytest --cov</code> (Paket <code>pytest-cov</code>).
                                Eine hohe Abdeckung heißt aber nur, dass Code <em>ausgeführt</em> wurde – nicht, dass die Asserts sinnvoll sind.</p>
                            <div class="table-responsive">
                                <table class="table table-sm table-bordered">
                                    <thead class="table-light">
                                        <tr><th></th><th>Blackbox-Test</th><th>Whitebox-Test</th></tr>
                                    </thead>
                                    <tbody>
                                        <tr><td>Grundlage</td><td>Spezifikation (was soll passieren?)</td><td>Quellcode (welche Zweige gibt es?)</td></tr>
                                        <tr><td>Methoden</td><td>Äquivalenzklassen, Grenzwerte</td><td>Anweisungs- und Zweigabdeckung</td></tr>
                                        <tr><td>Wer</td><td>auch ohne Programmierkenntnisse möglich</td><td>Entwickler</td></tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="content-section">
                            <h2>Übung</h2>
                            <p>Die Funktion <code>note(punkte)</code> rechnet 0–100 Punkte in eine Schulnote um: ab 92 → 1, ab 81 → 2,
                                ab 67 → 3, ab 50 → 4, ab 30 → 5, darunter → 6. Werte außerhalb von 0–100 lösen einen <code>ValueError</code> aus.
                                Schreib einen parametrisierten Test mit Grenzwerten und einen Test für ungültige Eingaben.</p>
                            <details>
                                <summary>Lösung anzeigen</summary>
                                <div class="code-block">
<pre><code class="language-python">import pytest
from noten import note

@pytest.mark.parametrize("punkte, erwartet", [
    (100, 1), (92, 1), (91, 2), (81, 2), (80, 3), (67, 3),
    (66, 4), (50, 4), (49, 5), (30, 5), (29, 6), (0, 6),
])
def test_notengrenzen(punkte, erwartet):
    assert note(punkte) == erwartet

@pytest.mark.parametrize("punkte", [-1, 101])
def test_ungueltige_punkte(punkte):
    with pytest.raises(ValueError):
        note(punkte)</code></pre>
                                </div>
                            </details>
                        </div>

                        <div class="navigation-buttons">
                            <?php renderPythonPageNavigation('python-testing'); ?>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
