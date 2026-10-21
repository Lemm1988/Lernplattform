<?php
return [
    'title' => 'Daten im Programm und in Dateien',
    'intro' => 'Bevor Daten in eine Datenbank wandern, leben sie in Variablen und Dateien. Hier lernst du Datentypen, typische Fallen und eine kleine Datenverwaltung mit einer CSV-Datei – inklusive ihrer Grenzen.',
    'goals' => [
        'einfache Datentypen und ihren Einsatz unterscheiden',
        'Typumwandlungen und Gleitkomma-Ungenauigkeiten erkennen und behandeln',
        'Datensätze in einer CSV-Datei anlegen, suchen, ändern und löschen',
        'die Grenzen dateibasierter Datenhaltung begründen',
    ],
    'content' => <<<'INHALT'
<h6>Datentypen</h6>
<p>Der Datentyp legt fest, welche Werte eine Variable aufnehmen kann, wie viel Speicher sie braucht und welche Operationen möglich sind.</p>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th>Art</th><th>Beispiele</th><th>Java</th><th>Python</th><th>SQL</th></tr></thead>
  <tbody>
    <tr><td>Ganzzahl</td><td>Menge, Kundennummer</td><td><code>int</code>, <code>long</code></td><td><code>int</code></td><td><code>INT</code></td></tr>
    <tr><td>Gleitkommazahl</td><td>Messwert, Koordinate</td><td><code>double</code></td><td><code>float</code></td><td><code>DOUBLE</code></td></tr>
    <tr><td>Festkommazahl</td><td>Geldbetrag</td><td><code>BigDecimal</code></td><td><code>Decimal</code></td><td><code>DECIMAL(10,2)</code></td></tr>
    <tr><td>Wahrheitswert</td><td>aktiv, bezahlt</td><td><code>boolean</code></td><td><code>bool</code></td><td><code>BOOLEAN</code></td></tr>
    <tr><td>Zeichenkette</td><td>Name, E-Mail</td><td><code>String</code></td><td><code>str</code></td><td><code>VARCHAR(n)</code></td></tr>
    <tr><td>Datum/Zeit</td><td>Geburtstag, Termin</td><td><code>LocalDate</code></td><td><code>datetime</code></td><td><code>DATE</code>, <code>DATETIME</code></td></tr>
  </tbody>
</table>
<p>Faustregeln: Postleitzahlen und Telefonnummern sind <strong>Text</strong>, keine Zahlen (führende Nullen: „01067“, „+49 …“, man rechnet nicht damit). Geld nie als
Gleitkommazahl speichern:</p>
<pre class="bg-light border rounded p-3"><code>0.1 + 0.2                          # 0.30000000000000004
0.1 + 0.2 == 0.3                   # False
Decimal("0.1") + Decimal("0.2")    # 0.3   – exakte Dezimalrechnung
round(2.675, 2)                    # 2.67  – 2.675 ist intern etwas kleiner</code></pre>
<p>Gleitkommazahlen werden binär gespeichert; Dezimalbrüche wie 0,1 sind darin nicht exakt darstellbar (so wie 1/3 dezimal nicht). Für Geldbeträge nimmt man
Festkommatypen oder rechnet in Cent als Ganzzahl.</p>

<h6>Typumwandlung</h6>
<p>Eingaben aus Formularen und Dateien sind zunächst immer Text. Vor dem Rechnen muss umgewandelt werden – und das kann scheitern:</p>
<pre class="bg-light border rounded p-3"><code>int("42") + 1        # 43
"42" + "1"           # "421"  – Texte werden aneinandergehängt
float("3.5")         # 3.5
str(7) + " Tage"     # "7 Tage"
int("4,5")           # ValueError: invalid literal for int() with base 10: '4,5'</code></pre>
<p><strong>Implizite</strong> Umwandlung macht die Sprache selbst (in Java <code>int</code> → <code>double</code>), <strong>explizite</strong> fordert der Programmierer an
(<code>(int) 3.9</code> ergibt 3 – es wird abgeschnitten, nicht gerundet; LF8 Kapitel 8).</p>

<h6>Datensätze und Datenstrukturen</h6>
<p>Zusammengehörige Werte bilden einen <strong>Datensatz</strong> (Kunde mit Nummer, Name, Ort). Im Programm wird er als Objekt, <code>record</code> oder Dictionary
abgebildet; viele Datensätze stehen in einer Liste. Welche Struktur wofür passt, zeigt <a href="/Learningfields/LF11/kapitel2.php">LF11 Kapitel 2</a>. Wie man
Abläufe als Pseudocode, PAP oder Struktogramm darstellt, steht in <a href="/Learningfields/LF11/kapitel1.php">LF11 Kapitel 1</a>.</p>

<h6>Daten dauerhaft speichern: Dateien</h6>
<p>Variablen verschwinden beim Programmende. Für dauerhafte Daten braucht man Dateien – <strong>Textdateien</strong> (CSV, JSON, XML; lesbar, austauschbar, LF8 Kapitel 13)
oder <strong>Binärdateien</strong> (Bilder, eigene Formate; kompakt, aber nur mit passendem Programm lesbar).</p>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf5/programm-datei.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Kundendaten als Liste im Programm, als Zeilen in der Datei kunden.csv und eine Liste mit fünf Grenzen dateibasierter Datenhaltung">
  <figcaption class="figure-caption">Eine CSV-Datei ist nur Text – das ist ihre Stärke und ihre Schwäche</figcaption>
</figure>
<p>Eine kleine Kundenverwaltung mit einer CSV-Datei in Python:</p>
<pre class="bg-light border rounded p-3"><code>import csv
from pathlib import Path

DATEI = Path("kunden.csv")
FELDER = ["nr", "name", "ort"]

def laden():
    if not DATEI.exists():
        return []
    with DATEI.open(encoding="utf-8", newline="") as f:
        return list(csv.DictReader(f, delimiter=";"))

def speichern(kunden):
    with DATEI.open("w", encoding="utf-8", newline="") as f:
        schreiber = csv.DictWriter(f, fieldnames=FELDER, delimiter=";")
        schreiber.writeheader()
        schreiber.writerows(kunden)

def anlegen(name, ort):
    kunden = laden()
    nr = max((int(k["nr"]) for k in kunden), default=1000) + 1
    kunden.append({"nr": nr, "name": name, "ort": ort})
    speichern(kunden)
    return nr

def suchen(ort):
    return [k["name"] for k in laden() if k["ort"] == ort]

def aendern(nr, neuer_ort):
    kunden = laden()
    for k in kunden:
        if int(k["nr"]) == nr:
            k["ort"] = neuer_ort
    speichern(kunden)                 # die ganze Datei wird neu geschrieben

def loeschen(nr):
    speichern([k for k in laden() if int(k["nr"]) != nr])</code></pre>
<p>Testlauf: <code>anlegen</code> vergibt 1001, 1002, 1003; <code>suchen("Köln")</code> liefert Meier und Schulz; nach <code>aendern(1003, "Bonn")</code> und
<code>loeschen(1001)</code> liefert <code>suchen("Bonn")</code> Kaya und Schulz, und die Datei enthält noch zwei Datenzeilen. Mit <code>encoding="utf-8"</code> landet „Köln“
korrekt in der Datei (Kapitel 1). Fehlt die Datei beim Lesen ohne die <code>exists()</code>-Prüfung, bricht Python mit <code>FileNotFoundError</code> ab.</p>
<div class="lf-merke"><strong>Merke:</strong> Dateien eignen sich für kleine Datenmengen, Konfiguration, Protokolle und den Datenaustausch. Sobald mehrere Benutzer gleichzeitig
arbeiten, viele Daten durchsucht werden oder Regeln (eindeutige Nummern, gültige Werte) garantiert sein müssen, ist ein Datenbanksystem die bessere Wahl.</div>

<h6>Übungen mit Lösung</h6>
<p>1. Welcher Datentyp passt? a) Postleitzahl, b) Preis eines Artikels, c) Anzahl im Lager, d) „Newsletter abonniert“.</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">a) Zeichenkette (führende Null, keine Rechnung), b) Festkommazahl bzw. Cent als Ganzzahl, c) Ganzzahl, d) Wahrheitswert.</p>
</details>
<p>2. Zwei Mitarbeiter öffnen gleichzeitig die Kundenverwaltung. A legt einen Kunden an, B ändert einen Ort; beide speichern. Was passiert?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Beide haben die Datei vorher komplett geladen. Wer zuletzt speichert, überschreibt die ganze Datei – die Änderung des anderen geht verloren
(<em>Lost Update</em>). Ein Datenbanksystem verhindert das mit Transaktionen und Sperren (Kapitel 8).</p>
</details>
<p>3. Warum ergibt <code>"5" + "3"</code> in Python „53“ und nicht 8?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Beide Werte sind Zeichenketten; <code>+</code> hängt sie aneinander. Für eine Addition müssen sie erst umgewandelt werden: <code>int("5") + int("3")</code> = 8.</p>
</details>
INHALT,
    'summary' => [
        'Datentyp bestimmt Wertebereich, Speicherbedarf und erlaubte Operationen.',
        'PLZ und Telefonnummern als Text; Geld als Festkommazahl oder in Cent – nie als Gleitkommazahl.',
        'Eingaben sind Text und müssen umgewandelt werden; Umwandlung kann scheitern (ValueError).',
        'Dateien speichern Daten dauerhaft; CSV ist einfacher Text mit Trennzeichen.',
        'Grenzen von Dateien: gleichzeitige Zugriffe, Suche, fehlende Regeln, ganze Datei neu schreiben → Datenbanksystem.',
    ],
    'quiz' => [
        ['question' => 'Warum sollte man Geldbeträge nicht als double speichern?', 'answer' => 'Dezimalbrüche wie 0,1 sind binär nicht exakt darstellbar; es entstehen Rundungsfehler (0.1 + 0.2 ≠ 0.3).'],
        ['question' => 'Welcher Datentyp passt für eine Postleitzahl und warum?', 'answer' => 'Eine Zeichenkette – sonst gehen führende Nullen verloren, und gerechnet wird mit Postleitzahlen nicht.'],
        ['question' => 'Was ist ein Lost Update?', 'answer' => 'Zwei Prozesse lesen dieselben Daten und schreiben nacheinander zurück; die Änderung des ersten wird vom zweiten überschrieben.'],
        ['question' => 'Nenne zwei Gründe, statt einer Datei eine Datenbank zu verwenden.', 'answer' => 'Z. B. mehrere gleichzeitige Benutzer, schnelle Suche über Indizes, Integritätsregeln, Zugriffsrechte, Transaktionen.'],
    ],
];
