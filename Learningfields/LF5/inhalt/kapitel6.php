<?php
return [
    'title' => 'Vom Modell zur Datenbank: Tabellen anlegen und ändern',
    'intro' => 'Mit der Data Definition Language (DDL) entsteht aus dem Relationenmodell eine echte Datenbank – mit Datentypen und Regeln, die das DBMS bei jedem Zugriff durchsetzt.',
    'goals' => [
        'Datenbanken und Tabellen mit CREATE anlegen und passende SQL-Datentypen wählen',
        'Primär- und Fremdschlüssel, NOT NULL, UNIQUE, DEFAULT und CHECK einsetzen',
        'referenzielle Aktionen (RESTRICT, CASCADE, SET NULL) begründet wählen',
        'Tabellen mit ALTER ändern, Views anlegen und DROP, TRUNCATE und DELETE unterscheiden',
    ],
    'content' => <<<'INHALT'
<h6>Datenbank und Tabellen anlegen</h6>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf5/verleih-schema.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Vier Tabellen filiale, fahrrad, kunde und ausleihe mit Spalten, Datentypen, Schlüsseln, Fremdschlüsselbeziehungen und Prüfregeln">
  <figcaption class="figure-caption">Das physische Schema des Fahrradverleihs</figcaption>
</figure>
<pre class="bg-light border rounded p-3"><code>CREATE DATABASE verleih CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE verleih;

CREATE TABLE filiale (
    filial_nr  INT AUTO_INCREMENT PRIMARY KEY,
    ort        VARCHAR(50) NOT NULL
);

CREATE TABLE fahrrad (
    rahmen_nr       VARCHAR(20) PRIMARY KEY,
    modell          VARCHAR(50) NOT NULL,
    tagespreis      DECIMAL(6,2) NOT NULL CHECK (tagespreis &gt; 0),
    filial_nr       INT NOT NULL,
    angeschafft_am  DATE,
    FOREIGN KEY (filial_nr) REFERENCES filiale(filial_nr) ON DELETE RESTRICT
);

CREATE TABLE kunde (
    kunden_nr  INT AUTO_INCREMENT PRIMARY KEY,
    name       VARCHAR(60) NOT NULL,
    email      VARCHAR(100) NOT NULL UNIQUE,
    newsletter BOOLEAN NOT NULL DEFAULT FALSE
);

CREATE TABLE ausleihe (
    ausleih_nr INT AUTO_INCREMENT PRIMARY KEY,
    kunden_nr  INT NOT NULL,
    rahmen_nr  VARCHAR(20) NOT NULL,
    von        DATE NOT NULL,
    bis        DATE,
    FOREIGN KEY (kunden_nr) REFERENCES kunde(kunden_nr) ON DELETE CASCADE,
    FOREIGN KEY (rahmen_nr) REFERENCES fahrrad(rahmen_nr),
    CHECK (bis IS NULL OR bis &gt;= von)
);</code></pre>

<h6>Datentypen in SQL</h6>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th>Typ</th><th>für</th><th>Hinweis</th></tr></thead>
  <tbody>
    <tr><td><code>INT</code>, <code>BIGINT</code></td><td>Ganzzahlen, Schlüssel, Mengen</td><td>INT reicht bis gut 2 Milliarden</td></tr>
    <tr><td><code>DECIMAL(p,s)</code></td><td>Geldbeträge</td><td>p Stellen insgesamt, s davon nach dem Komma; exakt</td></tr>
    <tr><td><code>FLOAT</code>, <code>DOUBLE</code></td><td>Messwerte</td><td>ungenau (<a href="/Learningfields/LF5/kapitel2.php">Kapitel 2</a>), nie für Geld</td></tr>
    <tr><td><code>VARCHAR(n)</code></td><td>Texte bis n Zeichen</td><td>Namen, E-Mail, PLZ, Telefon</td></tr>
    <tr><td><code>TEXT</code></td><td>lange Texte</td><td>Beschreibungen, Kommentare</td></tr>
    <tr><td><code>DATE</code>, <code>DATETIME</code>, <code>TIMESTAMP</code></td><td>Datum und Zeit</td><td>Format <code>'2026-05-02'</code>, <code>'2026-05-02 14:30:00'</code></td></tr>
    <tr><td><code>BOOLEAN</code></td><td>ja/nein</td><td>in MySQL/MariaDB intern <code>TINYINT(1)</code> mit 0 und 1</td></tr>
  </tbody>
</table>

<h6>Regeln (Constraints)</h6>
<p>Was das DBMS selbst prüft, kann kein fehlerhaftes Programm verletzen. Gegen die Beispieldatenbank getestet (MariaDB):</p>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th>Regel</th><th>Versuch</th><th>Antwort der Datenbank</th></tr></thead>
  <tbody>
    <tr><td><code>UNIQUE</code></td><td>zweiter Kunde mit kaya@example.org</td><td>Duplicate entry 'kaya@example.org' for key 'email'</td></tr>
    <tr><td><code>CHECK</code></td><td>Tagespreis −5,00</td><td>CONSTRAINT `fahrrad.tagespreis` failed</td></tr>
    <tr><td><code>FOREIGN KEY</code></td><td>Ausleihe für Kunde 99, den es nicht gibt</td><td>Cannot add or update a child row: a foreign key constraint fails</td></tr>
    <tr><td><code>CHECK</code></td><td>Rückgabe vor Ausleihe (bis &lt; von)</td><td>CONSTRAINT `CONSTRAINT_1` failed</td></tr>
    <tr><td><code>ON DELETE RESTRICT</code></td><td>Filiale löschen, die noch Fahrräder hat</td><td>Cannot delete or update a parent row</td></tr>
    <tr><td><code>ON DELETE CASCADE</code></td><td>Kunde mit Ausleihen löschen</td><td>Kunde und seine Ausleihen werden gelöscht</td></tr>
  </tbody>
</table>
<p>Referenzielle Aktionen legen fest, was beim Löschen oder Ändern des referenzierten Datensatzes passiert: <strong>RESTRICT</strong> (bzw. NO ACTION) verbietet es,
<strong>CASCADE</strong> löscht abhängige Zeilen mit, <strong>SET NULL</strong> setzt den Fremdschlüssel auf NULL. CASCADE ist bequem, aber gefährlich – ein einziges
<code>DELETE</code> kann dann sehr viele Zeilen entfernen.</p>
<div class="lf-pruefung"><strong>Achtung, Fallstrick:</strong> In der Testumgebung (XAMPP) wurde ein Kunde <em>ohne</em> Namen trotz <code>NOT NULL</code> angelegt – mit einem
leeren Text und nur einer Warnung. Grund: Der Server lief ohne den strikten SQL-Modus. Mit <code>sql_mode = 'STRICT_TRANS_TABLES'</code> (Standard bei MySQL 8) lautet die
Antwort korrekt „Field 'name' doesn't have a default value“. Entwicklungs- und Produktionsserver sollten deshalb denselben SQL-Modus verwenden.</div>
<p>Noch eine Beobachtung aus dem Test: <code>AUTO_INCREMENT</code>-Nummern können Lücken haben. Fehlgeschlagene Einfügeversuche verbrauchen eine Nummer, gelöschte Zeilen
geben ihre nicht zurück. Fortlaufende, lückenlose Nummern (etwa für Rechnungen) muss die Anwendung selbst erzeugen.</p>

<h6>Tabellen ändern und löschen</h6>
<pre class="bg-light border rounded p-3"><code>ALTER TABLE kunde   ADD COLUMN telefon VARCHAR(30) AFTER email;     -- Spalte ergänzen
ALTER TABLE fahrrad MODIFY modell VARCHAR(80) NOT NULL;            -- Typ/Länge ändern
ALTER TABLE fahrrad ADD CONSTRAINT chk_preis_max CHECK (tagespreis &lt;= 200);
ALTER TABLE kunde   DROP COLUMN telefon;                            -- Spalte entfernen

DELETE FROM ausleihe WHERE bis &lt; '2020-01-01';   -- ausgewählte Zeilen (DML), einzeln rückgängig machbar
TRUNCATE TABLE ausleihe;                          -- alle Zeilen, schnell, Zähler zurück
DROP TABLE ausleihe;                              -- Tabelle samt Struktur weg</code></pre>
<p>Strukturänderungen an einer laufenden Anwendung werden als <strong>Migrationen</strong> durchgeführt: versionierte SQL-Skripte, die das Schema schrittweise anpassen,
nachvollziehbar im Repository liegen und vorher auf einer Testdatenbank ausprobiert werden (<a href="/Learningfields/LF12/kapitel7.php">LF12 Kapitel 7</a>). Vorher immer ein Backup (<a href="/Learningfields/LF5/kapitel9.php">Kapitel 9</a>).</p>

<h6>Views</h6>
<p>Eine <strong>View</strong> ist eine gespeicherte Abfrage, die sich wie eine Tabelle abfragen lässt – praktisch für häufige Auswertungen und um Benutzern nur bestimmte
Spalten zu zeigen (externe Ebene aus <a href="/Learningfields/LF5/kapitel3.php">Kapitel 3</a>):</p>
<pre class="bg-light border rounded p-3"><code>CREATE VIEW verfuegbare_fahrraeder AS
SELECT f.rahmen_nr, f.modell, f.tagespreis, fi.ort
FROM fahrrad f
JOIN filiale fi ON fi.filial_nr = f.filial_nr
WHERE f.rahmen_nr NOT IN (SELECT rahmen_nr FROM ausleihe
                          WHERE bis IS NULL OR bis &gt;= '2026-05-03');

SELECT * FROM verfuegbare_fahrraeder;   -- EBK9 | E-Bike | 30.00 | Köln</code></pre>

<h6>Übungen mit Lösung</h6>
<p>1. Schreibe die DDL für <code>Rechnung(<u>RechnungsNr</u>, Datum, Betrag, ↑KundenNr)</code>. Der Betrag darf nicht negativ sein, das Datum ist Pflicht.</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<pre class="bg-light border rounded p-3 mt-2"><code>CREATE TABLE rechnung (
    rechnungs_nr INT AUTO_INCREMENT PRIMARY KEY,
    datum        DATE NOT NULL,
    betrag       DECIMAL(10,2) NOT NULL CHECK (betrag &gt;= 0),
    kunden_nr    INT NOT NULL,
    FOREIGN KEY (kunden_nr) REFERENCES kunde(kunden_nr) ON DELETE RESTRICT
);</code></pre>
<p>RESTRICT, weil Rechnungen aufbewahrt werden müssen und nicht beim Löschen eines Kunden verschwinden dürfen.</p>
</details>
<p>2. Was ist der Unterschied zwischen <code>DELETE FROM kunde</code> und <code>DROP TABLE kunde</code>?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2"><code>DELETE</code> (DML) entfernt alle Zeilen, die Tabelle mit ihrer Struktur bleibt. <code>DROP TABLE</code> (DDL) entfernt die Tabelle selbst samt Struktur
und Daten.</p>
</details>
<p>3. Welche referenzielle Aktion passt für Bestellpositionen, wenn eine Bestellung gelöscht wird?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2"><code>ON DELETE CASCADE</code> – Positionen existieren nicht ohne ihre Bestellung (Komposition, <a href="/Learningfields/LF8/kapitel4.php">LF8 Kapitel 4</a>).</p>
</details>
INHALT,
    'summary' => [
        'DDL: CREATE, ALTER, DROP; Datentypen passend wählen (DECIMAL für Geld, VARCHAR für PLZ, DATE für Daten).',
        'Constraints: PRIMARY KEY, FOREIGN KEY, NOT NULL, UNIQUE, DEFAULT, CHECK – das DBMS setzt sie bei jedem Zugriff durch.',
        'Referenzielle Aktionen: RESTRICT verbietet, CASCADE löscht mit, SET NULL entkoppelt.',
        'Strikten SQL-Modus verwenden; AUTO_INCREMENT kann Lücken haben.',
        'DELETE (Zeilen), TRUNCATE (alle Zeilen, schnell), DROP (Tabelle); Views = gespeicherte Abfragen; Änderungen als Migrationen.',
    ],
    'quiz' => [
        ['question' => 'Was bewirkt ON DELETE CASCADE an einem Fremdschlüssel?', 'answer' => 'Wird der referenzierte Datensatz gelöscht, werden alle abhängigen Datensätze automatisch mitgelöscht.'],
        ['question' => 'Welcher Datentyp eignet sich für Geldbeträge?', 'answer' => 'DECIMAL(p,s), z. B. DECIMAL(10,2) – exakt, im Gegensatz zu FLOAT/DOUBLE.'],
        ['question' => 'Was ist eine View?', 'answer' => 'Eine gespeicherte Abfrage, die wie eine Tabelle abgefragt werden kann; sie speichert selbst keine Daten.'],
        ['question' => 'Wodurch unterscheiden sich TRUNCATE und DELETE ohne WHERE?', 'answer' => 'Beide entfernen alle Zeilen; TRUNCATE ist ein DDL-Befehl, arbeitet schneller und setzt den AUTO_INCREMENT-Zähler zurück, DELETE löscht Zeile für Zeile.'],
    ],
];
