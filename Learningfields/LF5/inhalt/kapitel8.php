<?php
return [
    'title' => 'Transaktionen, Mehrbenutzerbetrieb und Indizes',
    'intro' => 'Viele Benutzer, dieselben Daten, gleichzeitig: Transaktionen sorgen dafür, dass nichts verloren geht. Indizes sorgen dafür, dass es dabei schnell bleibt.',
    'goals' => [
        'die ACID-Eigenschaften erklären',
        'Transaktionen mit START TRANSACTION, COMMIT und ROLLBACK steuern',
        'Mehrbenutzerprobleme wie Lost Update und Dirty Read erkennen und mit Sperren oder relativen Änderungen vermeiden',
        'Indizes gezielt anlegen und ihre Wirkung mit EXPLAIN prüfen',
    ],
    'content' => <<<'INHALT'
<h6>Transaktionen und ACID</h6>
<p>Eine <strong>Transaktion</strong> fasst mehrere Anweisungen zu einer logischen Einheit zusammen: entweder alle oder keine. Relationale DBMS garantieren dafür die
<strong>ACID</strong>-Eigenschaften:</p>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th>Eigenschaft</th><th>Bedeutung</th><th>Beispiel</th></tr></thead>
  <tbody>
    <tr><td><strong>A</strong>tomicity (Atomarität)</td><td>alles oder nichts</td><td>Umbuchung: Abgang und Zugang werden gemeinsam gespeichert oder gar nicht</td></tr>
    <tr><td><strong>C</strong>onsistency (Konsistenz)</td><td>vorher und nachher sind alle Regeln erfüllt</td><td>Bestand nie negativ (CHECK), Fremdschlüssel gültig</td></tr>
    <tr><td><strong>I</strong>solation</td><td>parallele Transaktionen stören sich nicht</td><td>B sieht unbestätigte Änderungen von A nicht</td></tr>
    <tr><td><strong>D</strong>urability (Dauerhaftigkeit)</td><td>nach COMMIT ist die Änderung sicher, auch bei Stromausfall</td><td>Transaktionsprotokoll auf der Platte</td></tr>
  </tbody>
</table>
<pre class="bg-light border rounded p-3"><code>START TRANSACTION;
UPDATE lager SET bestand = bestand + 5 WHERE artikel = 'Schlauch';
UPDATE lager SET bestand = bestand - 5 WHERE artikel = 'Klingel';   -- verletzt CHECK (bestand &gt;= 0)
-- Fehler → ROLLBACK: auch die erste Änderung wird zurückgenommen
COMMIT;   -- nur wenn alles geklappt hat</code></pre>
<p>Im Test auf MariaDB scheitert die zweite Anweisung mit „CONSTRAINT `lager.bestand` failed“; nach dem <code>ROLLBACK</code> hat der Schlauch wieder seinen alten Bestand.
Ohne explizite Transaktion arbeitet MySQL im <em>Autocommit</em>-Modus: Jede Anweisung ist eine eigene Transaktion. Transaktionen funktionieren nur mit der Speicher-Engine
<strong>InnoDB</strong> (Standard), nicht mit dem alten MyISAM.</p>

<h6>Mehrbenutzerbetrieb: was schiefgehen kann</h6>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf5/lost-update.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Links verlieren zwei Transaktionen eine Änderung, weil beide den alten Wert lesen; rechts sperrt A die Zeile mit FOR UPDATE und B wartet">
  <figcaption class="figure-caption">Lost Update und seine Lösung</figcaption>
</figure>
<p>Das Problem tritt auf, wenn ein Programm <em>liest, rechnet und zurückschreibt</em>. Mit zwei echten Datenbankverbindungen nachgestellt: Bestand 10, A verkauft 3, B verkauft 2
– gespeichert ist <strong>8</strong> statt 5. Zwei Lösungen:</p>
<ul>
  <li><strong>Relativ ändern</strong>, damit das DBMS rechnet: <code>UPDATE lager SET bestand = bestand - 2 …</code> – im Test korrekt 5.</li>
  <li><strong>Zeile sperren</strong>: In einer Transaktion mit <code>SELECT … FOR UPDATE</code> lesen. Eine zweite Transaktion, die dieselbe Zeile sperren will, wartet. Im Test brach B nach
  der eingestellten Wartezeit von 2 Sekunden mit „Lock wait timeout exceeded; try restarting transaction“ ab, A konnte sauber zu Ende schreiben.</li>
</ul>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th>Anomalie</th><th>was passiert</th></tr></thead>
  <tbody>
    <tr><td>Lost Update</td><td>eine Änderung überschreibt eine andere</td></tr>
    <tr><td>Dirty Read</td><td>B liest Daten, die A noch nicht bestätigt hat – und A macht ein Rollback</td></tr>
    <tr><td>Non-repeatable Read</td><td>B liest dieselbe Zeile zweimal und bekommt verschiedene Werte, weil A dazwischen bestätigt hat</td></tr>
    <tr><td>Phantom</td><td>B zählt zweimal und findet beim zweiten Mal neue Zeilen</td></tr>
  </tbody>
</table>
<p>Die <strong>Isolationsebene</strong> bestimmt, welche Anomalien ausgeschlossen sind (READ UNCOMMITTED, READ COMMITTED, REPEATABLE READ, SERIALIZABLE – von locker bis streng).
MySQL und MariaDB nutzen standardmäßig REPEATABLE READ; im Test sah B den noch nicht bestätigten Wert 99 von A nicht, sondern weiterhin 1. Je strenger die Ebene, desto mehr
müssen Transaktionen aufeinander warten. Warten zwei Transaktionen gegenseitig auf ihre Sperren, entsteht ein <strong>Deadlock</strong>; das DBMS bricht eine davon ab.</p>

<h6>Indizes</h6>
<p>Ohne Index muss die Datenbank zum Suchen jede Zeile lesen (<em>Full Table Scan</em>). Ein <strong>Index</strong> ist eine zusätzliche, sortierte Struktur – meist ein
<strong>B-Baum</strong> –, über die sich passende Zeilen in wenigen Schritten finden lassen, ähnlich dem Stichwortverzeichnis eines Buchs.</p>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf5/index-btree.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Links Tabellenscan über 200.000 Zeilen mit 188 ms, rechts Suche über einen B-Baum zu genau einer Zeile in 0,5 ms">
  <figcaption class="figure-caption">Gemessen mit 200.000 Kunden auf MariaDB</figcaption>
</figure>
<pre class="bg-light border rounded p-3"><code>EXPLAIN SELECT * FROM kunde WHERE email = 'kunde123456@example.org';
-- type = ALL, rows ≈ 200.000          → jede Zeile wird gelesen (188 ms)

CREATE INDEX idx_kunde_email ON kunde(email);

EXPLAIN SELECT * FROM kunde WHERE email = 'kunde123456@example.org';
-- type = ref, key = idx_kunde_email, rows = 1   (0,5 ms)</code></pre>
<ul>
  <li>Primärschlüssel und <code>UNIQUE</code>-Spalten haben automatisch einen Index; Fremdschlüsselspalten bekommen in InnoDB ebenfalls einen.</li>
  <li>Sinnvoll für Spalten, die oft in <code>WHERE</code>, <code>JOIN</code> und <code>ORDER BY</code> vorkommen und viele verschiedene Werte haben.</li>
  <li>Nicht kostenlos: Indizes brauchen Speicher, und jedes <code>INSERT</code>, <code>UPDATE</code> und <code>DELETE</code> muss sie mitpflegen. Bei Spalten mit wenigen Werten
  (ja/nein) bringen sie kaum etwas.</li>
  <li>Ein Index auf <code>email</code> hilft nicht bei <code>WHERE email LIKE '%@example.org'</code> – der Anfang des Suchbegriffs ist unbekannt.</li>
</ul>
<div class="lf-merke"><strong>Merke:</strong> Transaktion = alles oder nichts (ACID). Gleichzeitige Änderungen relativ formulieren oder mit <code>FOR UPDATE</code> sperren. Indizes
beschleunigen das Lesen und verlangsamen das Schreiben – Wirkung mit <code>EXPLAIN</code> prüfen statt raten.</div>

<h6>Übungen mit Lösung</h6>
<p>1. Eine Überweisung bucht 100 € von Konto A ab und auf Konto B. Nach der Abbuchung stürzt der Server ab. Was garantiert die Transaktion?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Atomarität: Da kein COMMIT erfolgte, wird die Abbuchung beim Wiederanlauf zurückgenommen. Es geht kein Geld verloren und keins entsteht.</p>
</details>
<p>2. Zwei Mitarbeiter buchen gleichzeitig den letzten freien Platz eines Kurses. Wie verhinderst du eine Doppelbuchung?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">In einer Transaktion die Kurszeile mit <code>SELECT … FOR UPDATE</code> sperren, freie Plätze prüfen, buchen, COMMIT – der zweite wartet und sieht danach 0 freie Plätze.
Alternativ: <code>UPDATE kurs SET frei = frei - 1 WHERE kurs_nr = 7 AND frei &gt; 0</code> und prüfen, ob eine Zeile geändert wurde.</p>
</details>
<p>3. Eine Abfrage <code>SELECT * FROM bestellung WHERE kunden_nr = 42 ORDER BY datum</code> ist langsam. Was tust du?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Mit <code>EXPLAIN</code> prüfen, ob ein Index genutzt wird. Falls nicht: Index auf <code>(kunden_nr, datum)</code> anlegen – er unterstützt Filter und Sortierung –
und erneut mit EXPLAIN und einer Zeitmessung kontrollieren.</p>
</details>
INHALT,
    'summary' => [
        'Transaktion = logische Einheit; ACID: Atomarität, Konsistenz, Isolation, Dauerhaftigkeit.',
        'START TRANSACTION … COMMIT bzw. ROLLBACK; ohne Transaktion gilt Autocommit; InnoDB nötig.',
        'Lost Update vermeiden: relativ ändern (bestand = bestand - x) oder mit SELECT … FOR UPDATE sperren.',
        'Isolationsebenen von READ UNCOMMITTED bis SERIALIZABLE; MySQL-Standard REPEATABLE READ; Deadlocks löst das DBMS durch Abbruch.',
        'Index (B-Baum) beschleunigt Suchen, kostet Speicher und Schreibzeit; Wirkung mit EXPLAIN prüfen.',
    ],
    'quiz' => [
        ['question' => 'Wofür steht das A in ACID?', 'answer' => 'Atomicity (Atomarität): Eine Transaktion wird ganz oder gar nicht ausgeführt.'],
        ['question' => 'Was ist ein Lost Update?', 'answer' => 'Zwei Transaktionen lesen denselben Wert und schreiben nacheinander zurück; die Änderung der ersten wird überschrieben.'],
        ['question' => 'Was bewirkt SELECT … FOR UPDATE?', 'answer' => 'Die gelesenen Zeilen werden bis zum Ende der Transaktion gesperrt; andere Transaktionen, die sie ebenfalls sperren oder ändern wollen, müssen warten.'],
        ['question' => 'Warum legt man nicht auf jede Spalte einen Index?', 'answer' => 'Indizes brauchen Speicher und verlangsamen INSERT, UPDATE und DELETE, weil sie mitgepflegt werden müssen; bei Spalten mit wenigen Werten bringen sie kaum Nutzen.'],
    ],
];
