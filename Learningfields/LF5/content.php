<?php
$lf5Chapters = [
    'kapitel1' => [
        'title' => '1. Datenmodellierung und ER-Modell',
        'intro' => 'Grundlagen der Datenmodellierung und Entity-Relationship-Modelle erstellen.',
        'content' => <<<'HTML'
<p>Datenmodellierung ist der Prozess, reale Sachverhalte in eine strukturierte Datenbankstruktur zu überführen. Das Entity-Relationship-Modell (ER-Modell) ist eine bewährte Methode zur konzeptionellen Modellierung. Entitäten (Entities) repräsentieren Objekte der realen Welt (z. B. Kunde, Bestellung, Produkt), Attribute beschreiben Eigenschaften von Entitäten (z. B. Name, E-Mail, Preis), und Beziehungen (Relationships) verbinden Entitäten miteinander (z. B. "Kunde bestellt Produkt").</p>
<p>Kardinalitäten beschreiben die Anzahl der Beziehungen: 1:1 (eins-zu-eins), 1:N (eins-zu-viele), N:M (viele-zu-viele). Beispiele: Ein Kunde hat viele Bestellungen (1:N), ein Mitarbeiter gehört zu einer Abteilung (N:1), Studenten belegen Kurse (N:M). Kardinalitäten werden durch Min/Max-Notation oder Chen-Notation dargestellt.</p>
<p>Schlüssel: Primärschlüssel (Primary Key) identifizieren Entitäten eindeutig, Fremdschlüssel (Foreign Key) referenzieren andere Entitäten, zusammengesetzte Schlüssel bestehen aus mehreren Attributen. Wichtig: Jede Entität braucht einen Primärschlüssel, Fremdschlüssel müssen auf gültige Primärschlüssel verweisen.</p>
<p>ER-Diagramme visualisieren das Datenmodell: Rechtecke für Entitäten, Ellipsen für Attribute, Rauten für Beziehungen, Linien verbinden die Elemente. Tools wie MySQL Workbench, dbdiagram.io oder draw.io helfen beim Erstellen von ER-Diagrammen.</p>
HTML,
        'examples' => [
            'Ein Azubi modelliert ein einfaches Bestellsystem: Entitäten "Kunde", "Bestellung", "Produkt" mit Beziehungen und Kardinalitäten.',
            'Die Auszubildende erstellt ein ER-Diagramm für ein Schulverwaltungssystem mit Entitäten "Schüler", "Kurs", "Lehrer" und N:M-Beziehung zwischen Schülern und Kursen.',
            'Der Azubi identifiziert Primärschlüssel (z. B. Kunden-ID) und Fremdschlüssel (z. B. Bestellnummer verweist auf Kunde) in einem Datenmodell.'
        ],
        'tasks' => [
            'Erstelle ein ER-Modell für ein einfaches System (z. B. Bibliothek, Fitnessstudio) mit mindestens 3 Entitäten.',
            'Identifiziere Kardinalitäten zwischen den Entitäten und begründe deine Entscheidung.',
            'Zeichne ein ER-Diagramm mit einem Tool deiner Wahl und dokumentiere die Entitäten, Attribute und Beziehungen.'
        ],
        'summary' => [
            'Datenmodellierung überführt reale Sachverhalte in strukturierte Datenbankstrukturen.',
            'ER-Modell nutzt Entitäten, Attribute und Beziehungen zur Modellierung.',
            'Kardinalitäten (1:1, 1:N, N:M) beschreiben die Anzahl der Beziehungen.',
            'Primärschlüssel identifizieren Entitäten, Fremdschlüssel referenzieren andere Entitäten.',
            'ER-Diagramme visualisieren das Datenmodell für besseres Verständnis.'
        ],
        'quiz' => [
            ['question' => 'Was sind die Hauptelemente eines ER-Modells?', 'answer' => 'Entitäten (Entities), Attribute und Beziehungen (Relationships).'],
            ['question' => 'Was bedeutet Kardinalität 1:N?', 'answer' => 'Eine Entität kann mit vielen Entitäten einer anderen Art in Beziehung stehen (z. B. ein Kunde hat viele Bestellungen).'],
            ['question' => 'Was ist ein Primärschlüssel?', 'answer' => 'Ein Attribut oder eine Kombination von Attributen, die eine Entität eindeutig identifiziert.'],
            ['question' => 'Wofür werden Fremdschlüssel verwendet?', 'answer' => 'Um Beziehungen zwischen Entitäten herzustellen, indem auf Primärschlüssel anderer Entitäten verwiesen wird.'],
            ['question' => 'Wie stellt man eine N:M-Beziehung in einer relationalen Datenbank dar?', 'answer' => 'Durch eine Zwischentabelle (Junction Table), die die Beziehungen zwischen den beiden Entitäten speichert.']
        ]
    ],
    'kapitel2' => [
        'title' => '2. Normalisierung',
        'intro' => 'Datenbanken normalisieren, um Redundanzen zu vermeiden und Datenintegrität zu gewährleisten.',
        'content' => <<<'HTML'
<p>Normalisierung ist ein Prozess zur Optimierung des Datenbankdesigns, um Redundanzen zu vermeiden, Datenintegrität zu gewährleisten und Anomalien zu verhindern. Die Normalformen (1NF, 2NF, 3NF, BCNF) bauen aufeinander auf und stellen zunehmend strengere Anforderungen.</p>
<p>1. Normalform (1NF): Jedes Attribut enthält atomare Werte (keine Listen oder zusammengesetzte Werte), jede Zeile ist eindeutig identifizierbar. Beispiel: Statt "Adresse: Musterstraße 1, 12345 Musterstadt" sollten "Straße", "PLZ" und "Stadt" separate Spalten sein.</p>
<p>2. Normalform (2NF): Erfüllt 1NF, und alle Nicht-Schlüssel-Attribute hängen vollständig vom Primärschlüssel ab (keine partiellen Abhängigkeiten). Beispiel: In einer Tabelle "Bestellung_Produkt" sollte der Produktname nicht direkt gespeichert werden, sondern über eine Referenz auf die Produkttabelle.</p>
<p>3. Normalform (3NF): Erfüllt 2NF, und keine Nicht-Schlüssel-Attribute hängen transitiv von anderen Nicht-Schlüssel-Attributen ab. Beispiel: In einer Kundentabelle sollte nicht "Land" und "Währung" gespeichert werden, wenn "Währung" von "Land" abhängt - besser separate Tabelle für Länder.</p>
<p>Denormalisierung: In manchen Fällen kann bewusste Denormalisierung sinnvoll sein, um Performance zu verbessern (z. B. bei Read-Heavy-Anwendungen). Dies sollte jedoch gut dokumentiert und begründet sein.</p>
HTML,
        'examples' => [
            'Ein Azubi normalisiert eine Tabelle mit Kundendaten: Er trennt Adressdaten in separate Spalten (1NF) und entfernt redundante Produktinformationen (2NF).',
            'Die Auszubildende erkennt eine transitive Abhängigkeit: "Abteilungsname" hängt von "Abteilungs-ID" ab, nicht direkt vom Mitarbeiter - sie erstellt eine separate Abteilungstabelle (3NF).',
            'Der Azubi dokumentiert eine bewusste Denormalisierung: In einer Reporting-Tabelle werden berechnete Werte gespeichert, um Abfragen zu beschleunigen.'
        ],
        'tasks' => [
            'Normalisiere eine nicht-normalisierte Tabelle schrittweise bis zur 3NF.',
            'Identifiziere Redundanzen und Anomalien in einem gegebenen Datenmodell.',
            'Begründe, wann Denormalisierung sinnvoll sein kann und dokumentiere die Entscheidung.'
        ],
        'summary' => [
            'Normalisierung vermeidet Redundanzen und gewährleistet Datenintegrität.',
            '1NF: atomare Werte, eindeutige Zeilen.',
            '2NF: vollständige Abhängigkeit vom Primärschlüssel.',
            '3NF: keine transitiven Abhängigkeiten.',
            'Denormalisierung kann bei Performance-Optimierung sinnvoll sein, muss aber dokumentiert werden.'
        ],
        'quiz' => [
            ['question' => 'Was ist das Ziel der Normalisierung?', 'answer' => 'Redundanzen vermeiden, Datenintegrität gewährleisten, Anomalien verhindern.'],
            ['question' => 'Was bedeutet 1NF?', 'answer' => 'Jedes Attribut enthält atomare Werte, jede Zeile ist eindeutig identifizierbar.'],
            ['question' => 'Was ist eine partielle Abhängigkeit?', 'answer' => 'Ein Nicht-Schlüssel-Attribut hängt nur von einem Teil des zusammengesetzten Primärschlüssels ab.'],
            ['question' => 'Was bedeutet transitive Abhängigkeit?', 'answer' => 'Ein Nicht-Schlüssel-Attribut hängt von einem anderen Nicht-Schlüssel-Attribut ab, nicht direkt vom Primärschlüssel.'],
            ['question' => 'Wann kann Denormalisierung sinnvoll sein?', 'answer' => 'Bei Read-Heavy-Anwendungen, um Abfrage-Performance zu verbessern, muss aber dokumentiert werden.']
        ]
    ],
    'kapitel3' => [
        'title' => '3. SQL-Grundlagen',
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
    ],
    'kapitel4' => [
        'title' => '4. Datenbankentwurf und Implementierung',
        'intro' => 'Von der Konzeption zur Implementierung: Datenbanken planen und erstellen.',
        'content' => <<<'HTML'
<p>Datenbankentwurf folgt einem strukturierten Prozess: Anforderungsanalyse (Was soll gespeichert werden?), konzeptionelles Design (ER-Modell), logisches Design (Tabellenstruktur, Normalisierung), physisches Design (Indizes, Datentypen, Constraints), Implementierung (CREATE TABLE), Testen und Optimierung.</p>
<p>Datentypen wählen: INTEGER (ganze Zahlen), VARCHAR/TEXT (Zeichenketten), DATE/DATETIME (Datum/Zeit), DECIMAL (Genaue Dezimalzahlen), BOOLEAN (Wahrheitswerte), BLOB (Binärdaten). Wichtig: Passende Datentypen sparen Speicherplatz und verbessern Performance.</p>
<p>Constraints (Einschränkungen) gewährleisten Datenintegrität: PRIMARY KEY (eindeutige Identifikation), FOREIGN KEY (Referenzielle Integrität), NOT NULL (Pflichtfeld), UNIQUE (eindeutige Werte), CHECK (Wertebereich), DEFAULT (Standardwert). Constraints verhindern fehlerhafte Daten.</p>
<p>Indizes verbessern Abfrage-Performance: Primärindex (automatisch für PRIMARY KEY), Sekundärindex (für häufig abgefragte Spalten), zusammengesetzter Index (mehrere Spalten). Wichtig: Zu viele Indizes verlangsamen INSERT/UPDATE, daher gezielt einsetzen.</p>
<p>Dokumentation: Datenmodell dokumentieren (ER-Diagramm, Tabellenbeschreibungen), Spaltenbeschreibungen (Kommentare in der Datenbank), Beziehungen dokumentieren, Änderungen versionieren. Gute Dokumentation erleichtert Wartung und Weiterentwicklung.</p>
HTML,
        'examples' => [
            'Ein Azubi erstellt eine Tabelle "kunden" mit PRIMARY KEY, NOT NULL Constraints und FOREIGN KEY zu "adressen".',
            'Die Auszubildende wählt passende Datentypen: VARCHAR(100) für Namen, DECIMAL(10,2) für Preise, DATE für Geburtsdatum.',
            'Der Azubi erstellt Indizes auf häufig abgefragten Spalten (z. B. E-Mail-Adresse für Login-Abfragen).',
            'Die Auszubildende dokumentiert das Datenmodell mit ER-Diagramm und Spaltenkommentaren in der Datenbank.'
        ],
        'tasks' => [
            'Erstelle ein vollständiges Datenbankdesign für ein einfaches System: ER-Modell, Tabellen, Constraints, Indizes.',
            'Implementiere die Tabellen mit CREATE TABLE und teste die Constraints.',
            'Dokumentiere dein Datenmodell mit ER-Diagramm und Beschreibungen.'
        ],
        'summary' => [
            'Datenbankentwurf folgt strukturiertem Prozess: Anforderungsanalyse → Design → Implementierung.',
            'Passende Datentypen sparen Speicherplatz und verbessern Performance.',
            'Constraints gewährleisten Datenintegrität (PRIMARY KEY, FOREIGN KEY, NOT NULL, etc.).',
            'Indizes verbessern Abfrage-Performance, sollten aber gezielt eingesetzt werden.',
            'Dokumentation erleichtert Wartung und Weiterentwicklung.'
        ],
        'quiz' => [
            ['question' => 'Welche Phasen umfasst der Datenbankentwurf?', 'answer' => 'Anforderungsanalyse, konzeptionelles Design (ER-Modell), logisches Design, physisches Design, Implementierung, Testen.'],
            ['question' => 'Warum sind Constraints wichtig?', 'answer' => 'Sie gewährleisten Datenintegrität und verhindern fehlerhafte Daten.'],
            ['question' => 'Was ist der Unterschied zwischen PRIMARY KEY und UNIQUE?', 'answer' => 'PRIMARY KEY ist eindeutig und NOT NULL, UNIQUE ist eindeutig, kann aber NULL sein.'],
            ['question' => 'Wann sollte man Indizes erstellen?', 'answer' => 'Auf häufig abgefragten Spalten, aber nicht zu viele, da sie INSERT/UPDATE verlangsamen.'],
            ['question' => 'Warum ist Dokumentation wichtig?', 'answer' => 'Sie erleichtert Wartung, Weiterentwicklung und das Verständnis der Datenbankstruktur.']
        ]
    ],
    'kapitel5' => [
        'title' => '5. Indizes und Performance-Optimierung',
        'intro' => 'Datenbankabfragen optimieren durch gezielten Einsatz von Indizes.',
        'content' => <<<'HTML'
<p>Indizes sind Datenstrukturen, die die Suche in Datenbanken beschleunigen. Ein Index ähnelt einem Inhaltsverzeichnis: Statt die gesamte Tabelle zu durchsuchen, kann die Datenbank direkt zur gesuchten Zeile springen. Indizes werden automatisch für PRIMARY KEY und UNIQUE Constraints erstellt.</p>
<p>Index-Typen: B-Tree-Index (Standard, für die meisten Abfragen), Hash-Index (für exakte Gleichheitssuchen), Volltext-Index (für Textsuche). Die meisten Datenbanken nutzen B-Tree-Indizes als Standard.</p>
<p>Wann Indizes erstellen: Auf Spalten, die häufig in WHERE-Klauseln verwendet werden, auf FOREIGN KEYs (verbessert JOIN-Performance), auf Spalten für ORDER BY und GROUP BY. Nicht indexieren: Spalten mit wenigen unterschiedlichen Werten (niedrige Kardinalität), Spalten, die selten abgefragt werden, sehr kleine Tabellen.</p>
<p>Performance-Analyse: Nutze EXPLAIN (MySQL) oder EXPLAIN ANALYZE (PostgreSQL), um Abfragepläne zu analysieren. Achte auf: Full Table Scans (sollten vermieden werden), Index Usage, Join-Typen. Query-Profiler helfen, langsame Abfragen zu identifizieren.</p>
<p>Optimierung: Vermeide SELECT * (nur benötigte Spalten), nutze LIMIT für große Ergebnislisten, optimiere JOINs (richtige JOIN-Reihenfolge), vermeide Funktionen in WHERE-Klauseln (verhindert Index-Nutzung), nutze Prepared Statements (verhindert SQL-Injection, verbessert Performance).</p>
HTML,
        'examples' => [
            'Ein Azubi erstellt einen Index auf "email" in der Kundentabelle, da Login-Abfragen häufig nach E-Mail-Adressen suchen.',
            'Die Auszubildende analysiert eine langsame Abfrage mit EXPLAIN und erkennt einen Full Table Scan - sie erstellt einen Index.',
            'Der Azubi optimiert eine Abfrage, indem er SELECT * durch spezifische Spalten ersetzt und LIMIT hinzufügt.',
            'Die Auszubildende nutzt einen zusammengesetzten Index auf (kunde_id, bestelldatum) für häufig verwendete Abfragen.'
        ],
        'tasks' => [
            'Analysiere Abfragen mit EXPLAIN und identifiziere Optimierungspotenzial.',
            'Erstelle Indizes für häufig verwendete Abfragen und messe die Performance-Verbesserung.',
            'Optimiere langsame Abfragen durch bessere Index-Nutzung und Query-Optimierung.'
        ],
        'summary' => [
            'Indizes beschleunigen Datenbankabfragen erheblich.',
            'B-Tree-Indizes sind Standard für die meisten Abfragen.',
            'Indizes auf häufig abgefragten Spalten, FOREIGN KEYs und für ORDER BY/GROUP BY.',
            'EXPLAIN analysiert Abfragepläne und zeigt Optimierungspotenzial.',
            'Query-Optimierung: SELECT * vermeiden, LIMIT nutzen, JOINs optimieren, Prepared Statements verwenden.'
        ],
        'quiz' => [
            ['question' => 'Was ist ein Index?', 'answer' => 'Eine Datenstruktur, die die Suche in Datenbanken beschleunigt, ähnlich einem Inhaltsverzeichnis.'],
            ['question' => 'Welche Index-Typen gibt es?', 'answer' => 'B-Tree-Index (Standard), Hash-Index (exakte Gleichheit), Volltext-Index (Textsuche).'],
            ['question' => 'Wann sollte man Indizes erstellen?', 'answer' => 'Auf häufig abgefragten Spalten, FOREIGN KEYs, Spalten für ORDER BY/GROUP BY.'],
            ['question' => 'Wie analysiert man Abfrage-Performance?', 'answer' => 'Mit EXPLAIN oder EXPLAIN ANALYZE, um Abfragepläne zu sehen und Full Table Scans zu identifizieren.'],
            ['question' => 'Warum sollte man SELECT * vermeiden?', 'answer' => 'Es lädt unnötige Daten und kann Index-Nutzung verhindern. Nur benötigte Spalten abfragen.']
        ]
    ],
    'kapitel6' => [
        'title' => '6. Transaktionen und ACID',
        'intro' => 'Datenintegrität durch Transaktionen und ACID-Eigenschaften gewährleisten.',
        'content' => <<<'HTML'
<p>Transaktionen sind atomare Einheiten von Datenbankoperationen: Entweder werden alle Operationen erfolgreich ausgeführt (COMMIT), oder keine (ROLLBACK). Transaktionen gewährleisten Datenkonsistenz auch bei Fehlern oder gleichzeitigen Zugriffen.</p>
<p>ACID-Eigenschaften: Atomicity (Atomarität - alle oder keine Operation), Consistency (Konsistenz - Datenbank bleibt in gültigem Zustand), Isolation (Isolation - Transaktionen beeinflussen sich nicht), Durability (Dauerhaftigkeit - Änderungen sind permanent nach COMMIT).</p>
<p>Isolationsstufen: READ UNCOMMITTED (niedrigste, Dirty Reads möglich), READ COMMITTED (Standard, verhindert Dirty Reads), REPEATABLE READ (verhindert Non-Repeatable Reads), SERIALIZABLE (höchste, verhindert Phantom Reads). Höhere Isolationsstufen bieten mehr Konsistenz, aber weniger Parallelität.</p>
<p>Locking: Pessimistic Locking (Zeilen werden gesperrt, bis Transaktion beendet), Optimistic Locking (Versionierung, Konflikte werden bei COMMIT erkannt). Pessimistic Locking verhindert Konflikte, kann aber zu Deadlocks führen. Optimistic Locking ermöglicht mehr Parallelität, erfordert aber Konfliktbehandlung.</p>
<p>Deadlocks entstehen, wenn zwei Transaktionen gegenseitig auf gesperrte Ressourcen warten. Datenbanken erkennen Deadlocks automatisch und brechen eine Transaktion ab. Prävention: Konsistente Reihenfolge beim Sperren, kurze Transaktionen, passende Isolationsstufe wählen.</p>
HTML,
        'examples' => [
            'Ein Azubi führt eine Überweisung durch: START TRANSACTION, UPDATE konto1, UPDATE konto2, COMMIT - beide Updates werden atomar ausgeführt.',
            'Die Auszubildende nutzt ROLLBACK, um alle Änderungen rückgängig zu machen, wenn ein Fehler auftritt.',
            'Der Azubi wählt REPEATABLE READ, um sicherzustellen, dass wiederholte Lesevorgänge konsistente Ergebnisse liefern.',
            'Die Auszubildende implementiert Optimistic Locking mit Versionsnummern, um Konflikte bei gleichzeitigen Updates zu erkennen.'
        ],
        'tasks' => [
            'Implementiere eine Transaktion mit mehreren Operationen und teste COMMIT/ROLLBACK.',
            'Teste verschiedene Isolationsstufen und beobachte das Verhalten bei gleichzeitigen Zugriffen.',
            'Analysiere Deadlock-Szenarien und implementiere Präventionsmaßnahmen.'
        ],
        'summary' => [
            'Transaktionen sind atomare Einheiten: alle oder keine Operation.',
            'ACID: Atomicity, Consistency, Isolation, Durability.',
            'Isolationsstufen: READ UNCOMMITTED, READ COMMITTED, REPEATABLE READ, SERIALIZABLE.',
            'Locking: Pessimistic (Sperren) vs. Optimistic (Versionierung).',
            'Deadlocks werden automatisch erkannt, Prävention durch konsistente Sperrreihenfolge.'
        ],
        'quiz' => [
            ['question' => 'Was ist eine Transaktion?', 'answer' => 'Eine atomare Einheit von Datenbankoperationen: entweder alle erfolgreich (COMMIT) oder keine (ROLLBACK).'],
            ['question' => 'Was bedeutet ACID?', 'answer' => 'Atomicity (Atomarität), Consistency (Konsistenz), Isolation (Isolation), Durability (Dauerhaftigkeit).'],
            ['question' => 'Was ist der Unterschied zwischen READ COMMITTED und REPEATABLE READ?', 'answer' => 'READ COMMITTED verhindert Dirty Reads, REPEATABLE READ verhindert zusätzlich Non-Repeatable Reads.'],
            ['question' => 'Was ist Optimistic Locking?', 'answer' => 'Versionierung von Datensätzen, Konflikte werden bei COMMIT erkannt, ermöglicht mehr Parallelität.'],
            ['question' => 'Wie entstehen Deadlocks?', 'answer' => 'Wenn zwei Transaktionen gegenseitig auf gesperrte Ressourcen warten. Prävention: konsistente Sperrreihenfolge.']
        ]
    ],
    'kapitel7' => [
        'title' => '7. Datenbankanpassungen und Migrationen',
        'intro' => 'Datenbankstrukturen ändern und Daten migrieren ohne Ausfallzeiten.',
        'content' => <<<'HTML'
<p>Datenbankanpassungen sind unvermeidlich: Neue Anforderungen, Bugfixes, Performance-Optimierungen erfordern Schema-Änderungen. Wichtig: Änderungen müssen geplant, getestet und dokumentiert werden, um Datenverlust und Ausfallzeiten zu vermeiden.</p>
<p>ALTER TABLE-Befehle: Spalten hinzufügen (ADD COLUMN), ändern (MODIFY COLUMN), löschen (DROP COLUMN), Indizes hinzufügen/entfernen, Constraints ändern. Wichtig: Manche Änderungen können zeitaufwändig sein (z. B. Spalte mit Daten ändern), daher in Wartungsfenstern durchführen.</p>
<p>Migrationen sind strukturierte Schema-Änderungen: Versionierte Skripte, die Änderungen dokumentieren und reproduzierbar machen. Migration-Tools (z. B. Flyway, Liquibase, Django Migrations) verwalten Migrationen automatisch. Vorteile: Nachvollziehbarkeit, Reproduzierbarkeit, Rollback-Möglichkeit.</p>
<p>Datenmigration: Beim Ändern von Strukturen müssen Daten migriert werden. Strategien: Direkte Migration (einfach, aber riskant), Staging-Ansatz (Sicherheit durch Zwischenschritt), Blue-Green-Deployment (parallele Systeme). Wichtig: Backup vor Migration, Testen mit Testdaten, Rollback-Plan.</p>
<p>Best Practices: Änderungen in Entwicklung testen, Backup vor Produktion, Migrationen in Transaktionen (wenn möglich), Dokumentation, Kommunikation mit Team, Monitoring nach Migration. Schema-Änderungen sollten Teil des Versionsmanagements sein.</p>
HTML,
        'examples' => [
            'Ein Azubi fügt eine neue Spalte "telefon" zur Kundentabelle hinzu: ALTER TABLE kunden ADD COLUMN telefon VARCHAR(20).',
            'Die Auszubildende erstellt eine Migration, um eine Tabelle zu normalisieren: Neue Tabelle erstellen, Daten migrieren, alte Tabelle löschen.',
            'Der Azubi testet Schema-Änderungen zuerst in einer Test-Datenbank, bevor er sie in Produktion anwendet.',
            'Die Auszubildende nutzt ein Migration-Tool, um Schema-Änderungen zu versionieren und automatisch anzuwenden.'
        ],
        'tasks' => [
            'Führe eine Schema-Änderung durch (z. B. Spalte hinzufügen, ändern) und dokumentiere den Prozess.',
            'Erstelle eine Migration für eine komplexere Änderung (z. B. Normalisierung) mit Datenmigration.',
            'Teste einen Rollback-Prozess für eine Migration.'
        ],
        'summary' => [
            'Datenbankanpassungen müssen geplant, getestet und dokumentiert werden.',
            'ALTER TABLE ermöglicht Schema-Änderungen (Spalten, Indizes, Constraints).',
            'Migrationen sind versionierte, reproduzierbare Schema-Änderungen.',
            'Datenmigration erfordert sorgfältige Planung und Testen.',
            'Best Practices: Testen, Backup, Dokumentation, Versionsmanagement.'
        ],
        'quiz' => [
            ['question' => 'Warum sind Migrationen wichtig?', 'answer' => 'Sie machen Schema-Änderungen nachvollziehbar, reproduzierbar und ermöglichen Rollbacks.'],
            ['question' => 'Was ist beim Ändern von Spalten zu beachten?', 'answer' => 'Manche Änderungen können zeitaufwändig sein, daher in Wartungsfenstern durchführen, Backup erstellen.'],
            ['question' => 'Was ist der Unterschied zwischen direkter Migration und Staging-Ansatz?', 'answer' => 'Direkte Migration ist einfach aber riskant, Staging-Ansatz bietet Sicherheit durch Zwischenschritt.'],
            ['question' => 'Warum sollte man Migrationen testen?', 'answer' => 'Um Datenverlust und Ausfallzeiten zu vermeiden, Fehler früh zu erkennen.'],
            ['question' => 'Was gehört zu Best Practices bei Migrationen?', 'answer' => 'Testen in Entwicklung, Backup, Dokumentation, Versionsmanagement, Monitoring nach Migration.']
        ]
    ],
    'kapitel8' => [
        'title' => '8. Backup und Recovery',
        'intro' => 'Datenbanken sichern und im Fehlerfall wiederherstellen.',
        'content' => <<<'HTML'
<p>Backups sind essentiell für Datensicherheit: Hardware-Ausfälle, menschliche Fehler, Software-Bugs, Cyberangriffe können Datenverlust verursachen. Ein Backup-Plan definiert: Was wird gesichert? Wie oft? Wo werden Backups gespeichert? Wie lange werden sie aufbewahrt?</p>
<p>Backup-Typen: Vollbackup (komplette Datenbank), Inkrementelles Backup (nur Änderungen seit letztem Backup), Differentielles Backup (Änderungen seit letztem Vollbackup). Kombinationen (z. B. wöchentlich voll, täglich inkrementell) bieten gute Balance zwischen Sicherheit und Ressourcenverbrauch.</p>
<p>Backup-Strategien: Hot Backup (während Betrieb, keine Ausfallzeit), Cold Backup (Datenbank gestoppt, konsistent), Logical Backup (SQL-Dumps, portabel), Physical Backup (Dateisystem-Level, schnell). Die Wahl hängt von Anforderungen (Ausfallzeit, Größe, Portabilität) ab.</p>
<p>Recovery: Point-in-Time-Recovery (Wiederherstellung bis zu einem bestimmten Zeitpunkt), Full Recovery (komplette Wiederherstellung), Partial Recovery (nur bestimmte Tabellen/Datenbanken). Wichtig: Recovery-Prozess regelmäßig testen, um sicherzustellen, dass Backups funktionieren.</p>
<p>Best Practices: Automatisierte Backups, regelmäßige Tests der Recovery-Prozesse, Offsite-Speicherung (geografisch getrennt), Verschlüsselung von Backups, Dokumentation des Backup- und Recovery-Prozesses, Monitoring und Alerts bei Backup-Fehlern.</p>
HTML,
        'examples' => [
            'Ein Azubi erstellt ein tägliches Vollbackup der Produktionsdatenbank und speichert es auf einem separaten Server.',
            'Die Auszubildende testet den Recovery-Prozess monatlich, um sicherzustellen, dass Backups funktionieren.',
            'Der Azubi implementiert eine Backup-Strategie: Wöchentlich voll, täglich inkrementell, Backups werden 30 Tage aufbewahrt.',
            'Die Auszubildende nutzt Point-in-Time-Recovery, um eine Datenbank bis kurz vor einem Fehler wiederherzustellen.'
        ],
        'tasks' => [
            'Erstelle einen Backup-Plan für eine Datenbank: Typen, Häufigkeit, Speicherort, Aufbewahrungsdauer.',
            'Führe ein Backup durch und teste den Recovery-Prozess.',
            'Dokumentiere den Backup- und Recovery-Prozess für dein Team.'
        ],
        'summary' => [
            'Backups sind essentiell für Datensicherheit.',
            'Backup-Typen: Vollbackup, Inkrementell, Differentiell.',
            'Backup-Strategien: Hot/Cold, Logical/Physical Backup.',
            'Recovery: Point-in-Time, Full, Partial Recovery.',
            'Best Practices: Automatisierung, regelmäßige Tests, Offsite-Speicherung, Dokumentation.'
        ],
        'quiz' => [
            ['question' => 'Warum sind Backups wichtig?', 'answer' => 'Schutz vor Datenverlust durch Hardware-Ausfälle, Fehler, Bugs, Cyberangriffe.'],
            ['question' => 'Was ist der Unterschied zwischen inkrementellem und differentiellem Backup?', 'answer' => 'Inkrementell: Änderungen seit letztem Backup, Differentiell: Änderungen seit letztem Vollbackup.'],
            ['question' => 'Was ist Hot Backup?', 'answer' => 'Backup während des Betriebs, keine Ausfallzeit, aber komplexer.'],
            ['question' => 'Was ist Point-in-Time-Recovery?', 'answer' => 'Wiederherstellung der Datenbank bis zu einem bestimmten Zeitpunkt, erfordert Transaction Logs.'],
            ['question' => 'Warum sollte man Recovery-Prozesse regelmäßig testen?', 'answer' => 'Um sicherzustellen, dass Backups funktionieren und der Recovery-Prozess bekannt ist.']
        ]
    ],
];

?>

