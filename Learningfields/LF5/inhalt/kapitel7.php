<?php
return [
        'title' => 'SQL-Abfragen: Daten lesen, auswerten und ändern',
        'intro' => 'Daten abfragen, filtern, gruppieren und Tabellen verbinden – so, wie es in der AP2 verlangt wird.',
        'content' => <<<'HTML'
<p>SQL (Structured Query Language) ist die Standardsprache relationaler Datenbanken. In der Abschlussprüfung musst du Abfragen
<strong>lesen</strong> („Was liefert diese Abfrage?“) und <strong>selbst schreiben</strong> („Ermitteln Sie alle Kunden, die …“).
Alle Beispiele in diesem Kapitel beziehen sich auf dieselben zwei Tabellen – die findest du auch im LF5-Quiz wieder.</p>

<h6 class="mt-4">Befehlsgruppen</h6>
<div class="table-responsive">
<table class="table table-sm table-bordered align-middle">
  <thead class="table-light"><tr><th>Gruppe</th><th>Zweck</th><th>Befehle</th></tr></thead>
  <tbody>
    <tr><td>DDL – Data Definition Language</td><td>Struktur festlegen</td><td><code>CREATE</code>, <code>ALTER</code>, <code>DROP</code>, <code>TRUNCATE</code></td></tr>
    <tr><td>DML – Data Manipulation Language</td><td>Daten ändern</td><td><code>INSERT</code>, <code>UPDATE</code>, <code>DELETE</code></td></tr>
    <tr><td>DQL – Data Query Language</td><td>Daten abfragen</td><td><code>SELECT</code></td></tr>
    <tr><td>DCL – Data Control Language</td><td>Rechte vergeben</td><td><code>GRANT</code>, <code>REVOKE</code></td></tr>
    <tr><td>TCL – Transaction Control Language</td><td>Transaktionen steuern</td><td><code>COMMIT</code>, <code>ROLLBACK</code></td></tr>
  </tbody>
</table>
</div>

<h6 class="mt-4">Die Beispieltabellen</h6>
<div class="row g-3">
  <div class="col-md-5">
    <table class="table table-sm table-bordered mb-0">
      <caption class="caption-top"><code>kunde</code></caption>
      <thead class="table-light"><tr><th>kunde_id</th><th>name</th><th>ort</th></tr></thead>
      <tbody>
        <tr><td>1</td><td>Meier</td><td>Köln</td></tr>
        <tr><td>2</td><td>Schulz</td><td>Bonn</td></tr>
        <tr><td>3</td><td>Kaya</td><td>Köln</td></tr>
        <tr><td>4</td><td>Novak</td><td><em>NULL</em></td></tr>
      </tbody>
    </table>
  </div>
  <div class="col-md-7">
    <table class="table table-sm table-bordered mb-0">
      <caption class="caption-top"><code>bestellung</code> – <code>kunde_id</code> ist Fremdschlüssel auf <code>kunde</code></caption>
      <thead class="table-light"><tr><th>bestell_id</th><th>kunde_id</th><th>datum</th><th>betrag</th></tr></thead>
      <tbody>
        <tr><td>10</td><td>1</td><td>2026-01-05</td><td>120.00</td></tr>
        <tr><td>11</td><td>1</td><td>2026-02-10</td><td>80.00</td></tr>
        <tr><td>12</td><td>2</td><td>2026-02-11</td><td>200.00</td></tr>
        <tr><td>13</td><td>3</td><td>2026-03-01</td><td>50.00</td></tr>
      </tbody>
    </table>
  </div>
</div>

<h6 class="mt-4">Aufbau einer SELECT-Abfrage</h6>
<pre class="bg-light border rounded p-3"><code>SELECT   spalten, Aggregatfunktionen   -- was soll ausgegeben werden?
FROM     tabelle  [JOIN … ON …]        -- woher kommen die Daten?
WHERE    bedingung                     -- welche Zeilen?
GROUP BY spalten                       -- wie zusammenfassen?
HAVING   bedingung_auf_gruppen         -- welche Gruppen?
ORDER BY spalten [ASC|DESC]            -- in welcher Reihenfolge?
LIMIT    anzahl;                       -- wie viele?</code></pre>
<p>Geschrieben wird in dieser Reihenfolge, die Datenbank <em>wertet</em> aber anders aus. Das erklärt viele Fehlermeldungen:
Ein Alias aus dem <code>SELECT</code> ist in <code>WHERE</code> noch unbekannt, in <code>ORDER BY</code> dagegen schon.</p>
<figure class="figure w-100 my-3">
  <img src="/assets/img/lernfelder/lf5/sql-auswertungsreihenfolge.svg" class="figure-img img-fluid w-100"
       alt="Logische Auswertungsreihenfolge: 1 FROM/JOIN, 2 WHERE, 3 GROUP BY, 4 HAVING, 5 SELECT, 6 DISTINCT, 7 ORDER BY, 8 LIMIT">
  <figcaption class="figure-caption">Logische Auswertungsreihenfolge einer SELECT-Abfrage</figcaption>
</figure>

<h6 class="mt-4">Zeilen filtern mit WHERE</h6>
<ul>
  <li>Vergleiche: <code>=</code>, <code>&lt;&gt;</code> (ungleich), <code>&lt;</code>, <code>&gt;</code>, <code>&lt;=</code>, <code>&gt;=</code></li>
  <li><code>BETWEEN 50 AND 120</code> – Grenzen <strong>eingeschlossen</strong></li>
  <li><code>IN ('Köln', 'Bonn')</code> – einer von mehreren Werten</li>
  <li><code>LIKE 'M%'</code> – Muster: <code>%</code> = beliebig viele Zeichen, <code>_</code> = genau ein Zeichen</li>
  <li><code>IS NULL</code> / <code>IS NOT NULL</code> – nie <code>= NULL</code>!</li>
</ul>
<div class="alert alert-warning">
  <strong>Prüfungsfalle AND vor OR:</strong> <code>AND</code> bindet stärker als <code>OR</code>. Ohne Klammern bedeutet
  <code>WHERE kunde_id = 1 OR kunde_id = 2 AND betrag &gt; 100</code> dasselbe wie
  <code>kunde_id = 1 OR (kunde_id = 2 AND betrag &gt; 100)</code> und liefert die Bestellungen 10, 11 und 12.
  Gemeint war meist <code>(kunde_id = 1 OR kunde_id = 2) AND betrag &gt; 100</code> – das liefert nur 10 und 12.
  Im Zweifel immer klammern.
</div>

<h6 class="mt-4">NULL – die häufigste Fehlerquelle</h6>
<p>NULL bedeutet „Wert unbekannt“, nicht 0 und nicht leerer Text. Jeder Vergleich mit NULL ergibt <em>UNKNOWN</em>, und
WHERE lässt nur Zeilen mit <em>TRUE</em> durch:</p>
<ul>
  <li><code>WHERE ort = NULL</code> liefert keine einzige Zeile – richtig ist <code>WHERE ort IS NULL</code> (liefert Novak).</li>
  <li><code>COUNT(*)</code> zählt alle Zeilen (4), <code>COUNT(ort)</code> nur die ohne NULL (3).</li>
  <li>Rechnen mit NULL ergibt NULL: <code>10 + NULL</code> = NULL. Ersatzwert mit <code>COALESCE(spalte, 0)</code>.</li>
  <li>Beim Gruppieren bildet NULL eine eigene Gruppe.</li>
</ul>

<h6 class="mt-4">Aggregieren und gruppieren</h6>
<p>Aggregatfunktionen (<code>COUNT</code>, <code>SUM</code>, <code>AVG</code>, <code>MIN</code>, <code>MAX</code>) fassen viele Zeilen zu
einem Wert zusammen. Mit <code>GROUP BY</code> passiert das je Gruppe. <strong>Regel:</strong> Jede Spalte im SELECT muss entweder
im <code>GROUP BY</code> stehen oder in einer Aggregatfunktion.</p>
<pre class="bg-light border rounded p-3"><code>SELECT   k.name, COUNT(b.bestell_id) AS anzahl, COALESCE(SUM(b.betrag), 0) AS umsatz
FROM     kunde k
LEFT JOIN bestellung b ON b.kunde_id = k.kunde_id
GROUP BY k.kunde_id, k.name
ORDER BY umsatz DESC, k.name;</code></pre>
<table class="table table-sm table-bordered w-auto">
  <thead class="table-light"><tr><th>name</th><th>anzahl</th><th>umsatz</th></tr></thead>
  <tbody>
    <tr><td>Meier</td><td>2</td><td>200.00</td></tr>
    <tr><td>Schulz</td><td>1</td><td>200.00</td></tr>
    <tr><td>Kaya</td><td>1</td><td>50.00</td></tr>
    <tr><td>Novak</td><td>0</td><td>0.00</td></tr>
  </tbody>
</table>
<p><code>COUNT(b.bestell_id)</code> statt <code>COUNT(*)</code> ist hier wichtig: Novak hat durch den LEFT JOIN eine Zeile mit
<code>bestell_id = NULL</code>. <code>COUNT(*)</code> würde sie als 1 zählen.</p>
<p><code>WHERE</code> filtert einzelne Zeilen <em>vor</em> dem Gruppieren, <code>HAVING</code> filtert Gruppen <em>danach</em> und darf
Aggregatfunktionen enthalten. „Kunden mit mehr als 150 € Umsatz“ heißt also <code>HAVING SUM(b.betrag) &gt; 150</code>
(Ergebnis: Meier und Schulz).</p>

<h6 class="mt-4">Tabellen verbinden: JOINs</h6>
<figure class="figure w-100 my-3">
  <img src="/assets/img/lernfelder/lf5/sql-joins.svg" class="figure-img img-fluid w-100" style="max-width: 640px"
       alt="Mengendiagramme der JOIN-Arten: INNER JOIN liefert die Schnittmenge, LEFT JOIN alles aus A, RIGHT JOIN alles aus B, FULL OUTER JOIN beides, LEFT JOIN mit IS NULL nur A ohne Partner">
  <figcaption class="figure-caption">JOIN-Arten: A ist die Tabelle nach FROM, B die Tabelle nach JOIN</figcaption>
</figure>
<pre class="bg-light border rounded p-3"><code>SELECT k.name, b.bestell_id, b.betrag
FROM   kunde k
INNER JOIN bestellung b ON b.kunde_id = k.kunde_id;</code></pre>
<p>Liefert 4 Zeilen (Meier zweimal, Schulz, Kaya). Mit <code>LEFT JOIN</code> kommt Novak mit NULL-Werten dazu (5 Zeilen).
Kunden <strong>ohne</strong> Bestellung findest du mit dem „Anti-Join“:</p>
<pre class="bg-light border rounded p-3"><code>SELECT k.name
FROM   kunde k
LEFT JOIN bestellung b ON b.kunde_id = k.kunde_id
WHERE  b.bestell_id IS NULL;      -- Ergebnis: Novak</code></pre>
<ul>
  <li>Vergisst du die <code>ON</code>-Bedingung, entsteht das <strong>kartesische Produkt</strong>: 4 × 4 = 16 Zeilen.</li>
  <li>MySQL kennt kein <code>FULL OUTER JOIN</code>. Man kombiniert <code>LEFT JOIN</code> und <code>RIGHT JOIN</code> mit <code>UNION</code>.</li>
  <li>Ein <strong>Self-Join</strong> verbindet eine Tabelle mit sich selbst, z. B. Mitarbeiter und ihre Vorgesetzten (zwei Aliase).</li>
</ul>

<h6 class="mt-4">Unterabfragen</h6>
<p>Eine Unterabfrage liefert einen Wert oder eine Liste, mit der die äußere Abfrage weiterarbeitet:</p>
<pre class="bg-light border rounded p-3"><code>-- Bestellungen über dem Durchschnitt (Ø = 112,50 €) → 10 und 12
SELECT bestell_id, betrag
FROM   bestellung
WHERE  betrag &gt; (SELECT AVG(betrag) FROM bestellung);

-- Kunden, die seit Februar 2026 bestellt haben → Kaya, Meier, Schulz
SELECT name
FROM   kunde k
WHERE  EXISTS (SELECT 1 FROM bestellung b
               WHERE b.kunde_id = k.kunde_id AND b.datum &gt;= '2026-02-01');</code></pre>
<p>Die zweite Unterabfrage ist <em>korreliert</em>: Sie bezieht sich auf <code>k.kunde_id</code> der äußeren Abfrage und läuft
gedanklich einmal pro Kunde.</p>

<h6 class="mt-4">Daten ändern</h6>
<pre class="bg-light border rounded p-3"><code>INSERT INTO kunde (kunde_id, name, ort) VALUES (5, 'Brandt', 'Bonn');
UPDATE bestellung SET betrag = betrag * 0.9 WHERE kunde_id = 2;   -- 10 % Rabatt
DELETE FROM bestellung WHERE datum &lt; '2026-01-01';</code></pre>
<div class="alert alert-danger">
  <strong>Ohne WHERE trifft es alle Zeilen.</strong> <code>UPDATE</code> und <code>DELETE</code> vorher als <code>SELECT</code> mit derselben
  Bedingung testen. Bei wichtigen Änderungen eine Transaktion verwenden, dann lässt sich der Fehler mit <code>ROLLBACK</code> zurücknehmen.
</div>

<h6 class="mt-4">So gehst du an eine SQL-Aufgabe in der Prüfung heran</h6>
<ol>
  <li><strong>Ausgabe:</strong> Welche Spalten sollen im Ergebnis stehen? → <code>SELECT</code></li>
  <li><strong>Tabellen:</strong> Wo stehen diese Daten, und über welche Schlüssel hängen die Tabellen zusammen? → <code>FROM</code> / <code>JOIN … ON</code></li>
  <li><strong>Zeilenfilter:</strong> Welche Bedingung gilt für einzelne Datensätze? → <code>WHERE</code></li>
  <li><strong>Zusammenfassen:</strong> Ist von „je“, „pro“, „Anzahl“, „Summe“ die Rede? → Aggregatfunktion + <code>GROUP BY</code></li>
  <li><strong>Gruppenfilter:</strong> Bezieht sich eine Bedingung auf das Ergebnis einer Aggregatfunktion? → <code>HAVING</code></li>
  <li><strong>Sortierung:</strong> → <code>ORDER BY</code>. Zum Schluss mit den Beispieldaten im Kopf nachrechnen.</li>
</ol>

<h6 class="mt-4">Übungen mit Lösung</h6>
<p>1. Ermittle den Umsatz je Ort, absteigend sortiert.</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<pre class="bg-light border rounded p-3 mt-2"><code>SELECT k.ort, SUM(b.betrag) AS umsatz
FROM   kunde k
JOIN   bestellung b ON b.kunde_id = k.kunde_id
GROUP BY k.ort
ORDER BY umsatz DESC;      -- Köln 250.00, Bonn 200.00</code></pre>
<p>Novak (Ort NULL) hat keine Bestellung und fällt durch den INNER JOIN heraus.</p>
</details>
<p>2. Gib Name, Datum und Betrag aller Bestellungen aus dem Februar 2026 aus.</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<pre class="bg-light border rounded p-3 mt-2"><code>SELECT k.name, b.datum, b.betrag
FROM   bestellung b
JOIN   kunde k ON k.kunde_id = b.kunde_id
WHERE  b.datum BETWEEN '2026-02-01' AND '2026-02-28'
ORDER BY b.datum;          -- Meier 2026-02-10 80.00, Schulz 2026-02-11 200.00</code></pre>
</details>
<p>3. Welche Kunden haben mehr als eine Bestellung aufgegeben?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<pre class="bg-light border rounded p-3 mt-2"><code>SELECT k.name, COUNT(*) AS anzahl
FROM   kunde k
JOIN   bestellung b ON b.kunde_id = k.kunde_id
GROUP BY k.kunde_id, k.name
HAVING COUNT(*) &gt; 1;       -- Meier 2</code></pre>
<p>Die Bedingung bezieht sich auf das Ergebnis von <code>COUNT</code>, deshalb steht sie in <code>HAVING</code> und nicht in <code>WHERE</code>.</p>
</details>
HTML,
        'examples' => [
            'Ein Onlineshop will wissen, welche Kunden seit sechs Monaten nichts bestellt haben, um ihnen einen Gutschein zu schicken: LEFT JOIN mit IS NULL (bzw. NOT EXISTS mit Datumsbedingung).',
            'Die Buchhaltung braucht den Monatsumsatz je Filiale: SUM() mit GROUP BY über Filiale und Monat.',
            'Im Support-Ticketsystem sollen alle offenen Tickets mit Kundennamen angezeigt werden: INNER JOIN zwischen ticket und kunde, WHERE status <> \'geschlossen\'.',
            'Vor einer Preiserhöhung testet der Azubi die WHERE-Bedingung zuerst mit SELECT und führt das UPDATE dann in einer Transaktion aus.'
        ],
        'tasks' => [
            'Schreibe eine Abfrage, die je Kunde die Anzahl der Bestellungen ausgibt – auch für Kunden ohne Bestellung (Ergebnis 0).',
            'Ermittle den Kunden mit dem höchsten Einzelbestellwert (Name und Betrag). Löse die Aufgabe einmal mit ORDER BY/LIMIT und einmal mit einer Unterabfrage.',
            'Erkläre an den Beispieltabellen, warum SELECT COUNT(*) und SELECT COUNT(ort) FROM kunde unterschiedliche Ergebnisse liefern.',
            'Formuliere eine Abfrage für „alle Kunden aus Köln oder Bonn mit einer Bestellung über 100 €“ und setze die Klammern richtig.'
        ],
        'summary' => [
            'Logische Auswertungsreihenfolge: FROM/JOIN → WHERE → GROUP BY → HAVING → SELECT → DISTINCT → ORDER BY → LIMIT.',
            'WHERE filtert Zeilen vor dem Gruppieren, HAVING filtert Gruppen danach (mit Aggregatfunktionen).',
            'Jede SELECT-Spalte steht im GROUP BY oder in einer Aggregatfunktion.',
            'NULL nie mit = vergleichen, sondern mit IS NULL. COUNT(spalte) ignoriert NULL, COUNT(*) nicht.',
            'INNER JOIN liefert nur Paare mit Partner, LEFT JOIN zusätzlich alle Zeilen der linken Tabelle (Rest NULL).',
            'AND bindet stärker als OR – Bedingungen im Zweifel klammern.',
            'UPDATE und DELETE ohne WHERE betreffen alle Zeilen.'
        ],
        'quiz' => [
            ['question' => 'Warum kann man einen Spaltenalias aus dem SELECT in ORDER BY verwenden, aber nicht in WHERE?', 'answer' => 'WHERE wird vor SELECT ausgewertet, der Alias existiert dann noch nicht. ORDER BY kommt nach SELECT.'],
            ['question' => 'Wie viele Zeilen liefert SELECT * FROM kunde WHERE ort = NULL bei den Beispieltabellen?', 'answer' => 'Keine. Der Vergleich mit NULL ergibt UNKNOWN. Richtig wäre WHERE ort IS NULL (liefert Novak).'],
            ['question' => 'Wie viele Zeilen liefert ein LEFT JOIN von kunde auf bestellung bei den Beispieltabellen?', 'answer' => '5 – die 4 Treffer des INNER JOIN plus Novak ohne Bestellung (mit NULL-Werten).'],
            ['question' => 'Wann gehört eine Bedingung in HAVING statt in WHERE?', 'answer' => 'Wenn sie sich auf das Ergebnis einer Aggregatfunktion bezieht, z. B. HAVING SUM(betrag) > 150.'],
            ['question' => 'Was passiert, wenn bei einem JOIN die ON-Bedingung fehlt?', 'answer' => 'Es entsteht das kartesische Produkt: Jede Zeile wird mit jeder kombiniert (4 × 4 = 16 Zeilen).']
        ]
];
