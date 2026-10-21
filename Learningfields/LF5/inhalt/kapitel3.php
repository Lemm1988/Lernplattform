<?php
return [
    'title' => 'Datenbanksysteme und das relationale Modell',
    'intro' => 'Was macht ein Datenbanksystem besser als eine Datei? Hier lernst du die Aufgaben eines DBMS, die Drei-Ebenen-Architektur und die Fachbegriffe des relationalen Modells.',
    'goals' => [
        'Datenbank, DBMS und Datenbanksystem unterscheiden',
        'Aufgaben eines DBMS nennen',
        'die Drei-Ebenen-Architektur und Datenunabhängigkeit erklären',
        'Relation, Tupel, Attribut, Domäne sowie Primär- und Fremdschlüssel verwenden',
        'Entitäts- und referenzielle Integrität erklären',
    ],
    'content' => <<<'INHALT'
<h6>Datenbank, DBMS, Datenbanksystem</h6>
<ul>
  <li>Die <strong>Datenbank</strong> (DB) ist der strukturierte Datenbestand selbst.</li>
  <li>Das <strong>Datenbankmanagementsystem</strong> (DBMS) ist die Software, die die Daten verwaltet und den Zugriff regelt – z. B. MySQL/MariaDB, PostgreSQL, Microsoft SQL
  Server, Oracle oder das in Programme eingebettete SQLite.</li>
  <li><strong>Datenbanksystem</strong> (DBS) = Datenbank + DBMS.</li>
</ul>
<p>Anwendungen greifen nie direkt auf die Dateien der Datenbank zu, sondern schicken Anfragen (meist SQL) an das DBMS. Bei Client-Server-Systemen wie MySQL läuft das
DBMS als eigener Dienst; SQLite steckt dagegen als Bibliothek im Programm (Smartphone-Apps, Browser).</p>

<h6>Was ein DBMS leistet</h6>
<p>Die Grenzen der Dateien aus Kapitel 2 sind genau die Aufgaben eines DBMS:</p>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th>Aufgabe</th><th>Bedeutung</th></tr></thead>
  <tbody>
    <tr><td>Integration, Redundanzfreiheit</td><td>Daten werden zentral und möglichst nur einmal gespeichert</td></tr>
    <tr><td>Mehrbenutzerbetrieb</td><td>viele Benutzer gleichzeitig, ohne sich gegenseitig Änderungen zu überschreiben (Transaktionen, Kapitel 8)</td></tr>
    <tr><td>Integritätssicherung</td><td>Regeln wie eindeutige Schlüssel, Pflichtfelder, gültige Verweise werden erzwungen</td></tr>
    <tr><td>Zugriffsschutz</td><td>Rechte pro Benutzer, Tabelle, ja sogar Spalte (Kapitel 9)</td></tr>
    <tr><td>Datensicherung, Wiederherstellung</td><td>Backups, Protokolle, Wiederanlauf nach Absturz</td></tr>
    <tr><td>Abfragesprache</td><td>SQL: beschreiben, <em>was</em> man will, nicht wie gesucht wird (Kapitel 7)</td></tr>
    <tr><td>Katalog (Data Dictionary)</td><td>das DBMS kennt seine eigene Struktur: Tabellen, Spalten, Typen, Indizes</td></tr>
  </tbody>
</table>

<h6>Die Drei-Ebenen-Architektur</h6>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf5/drei-ebenen.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Externe Ebene mit Sichten für Webshop, Lager und Buchhaltung, darunter die konzeptionelle Ebene mit dem Gesamtschema und die interne Ebene mit der physischen Speicherung">
  <figcaption class="figure-caption">ANSI/SPARC-Modell: jede Ebene kann sich ändern, ohne die darüber zu stören</figcaption>
</figure>
<p>Das ANSI/SPARC-Modell trennt drei Sichten auf die Daten. <strong>Physische Datenunabhängigkeit</strong>: Der Administrator kann einen Index anlegen oder die Daten auf
eine schnellere Platte verschieben, ohne dass sich an Tabellen oder Anwendungen etwas ändert. <strong>Logische Datenunabhängigkeit</strong>: Kommt eine neue Spalte
hinzu, laufen die Anwendungen weiter, die sie nicht brauchen – ihre Sicht (z. B. eine View) bleibt gleich.</p>

<h6>Das relationale Modell</h6>
<p>Edgar F. Codd beschrieb 1970 das <strong>relationale Modell</strong>: Daten stehen in Tabellen (Relationen), Beziehungen entstehen über gleiche Werte in Schlüsselspalten.</p>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf5/relation-begriffe.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Tabelle Kunde mit markierten Attributen, Tupel und Primärschlüssel; Tabelle Bestellung mit Fremdschlüssel kunde_nr, der auf Kunde 1001 verweist">
  <figcaption class="figure-caption">Die wichtigsten Fachbegriffe an zwei kleinen Tabellen</figcaption>
</figure>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th>Fachbegriff</th><th>umgangssprachlich</th></tr></thead>
  <tbody>
    <tr><td>Relation</td><td>Tabelle</td></tr>
    <tr><td>Tupel</td><td>Zeile, Datensatz</td></tr>
    <tr><td>Attribut</td><td>Spalte, Feld</td></tr>
    <tr><td>Domäne (Wertebereich)</td><td>erlaubte Werte einer Spalte (Datentyp plus Regeln)</td></tr>
    <tr><td>Kardinalität einer Relation / Grad</td><td>Anzahl der Zeilen / Anzahl der Spalten</td></tr>
  </tbody>
</table>
<p><strong>Schlüssel</strong>:</p>
<ul>
  <li>Ein <strong>Schlüsselkandidat</strong> identifiziert jede Zeile eindeutig und ist minimal (keine Spalte lässt sich weglassen) – etwa <code>kunde_nr</code> oder
  <code>email</code>.</li>
  <li>Der <strong>Primärschlüssel</strong> (PK) ist der ausgewählte Schlüsselkandidat. Er ist eindeutig, nie NULL und sollte sich nie ändern. Oft nimmt man einen künstlichen
  Schlüssel (laufende Nummer), weil natürliche Schlüssel wie E-Mail-Adressen sich ändern können.</li>
  <li>Ein <strong>zusammengesetzter Schlüssel</strong> besteht aus mehreren Spalten (z. B. <code>bestellnr + positionsnr</code>).</li>
  <li>Ein <strong>Fremdschlüssel</strong> (FK) verweist auf den Primärschlüssel einer anderen (oder derselben) Tabelle und stellt so eine Beziehung her.</li>
</ul>
<p><strong>Integritätsregeln</strong>, die das DBMS durchsetzt:</p>
<ul>
  <li><strong>Entitätsintegrität</strong>: Jede Zeile hat einen eindeutigen Primärschlüssel ungleich NULL.</li>
  <li><strong>Referenzielle Integrität</strong>: Ein Fremdschlüssel enthält nur Werte, die als Primärschlüssel existieren (oder NULL). Eine Bestellung für Kunde 9999, den es nicht gibt,
  wird abgelehnt; ein Kunde mit Bestellungen kann nicht einfach gelöscht werden (Kapitel 6).</li>
  <li><strong>Wertebereichsintegrität</strong>: Werte passen zur Domäne (Datentyp, <code>CHECK</code>).</li>
</ul>
<div class="lf-pruefung"><strong>Prüfungstipp:</strong> Die Fachbegriffe Relation, Tupel, Attribut und die Unterscheidung von Primär- und Fremdschlüssel werden gern abgefragt
– genauso wie die Frage, warum eine Datenbank einer Excel-Liste oder CSV-Datei überlegen ist (Mehrbenutzerbetrieb, Integrität, Rechte, Transaktionen).</div>

<h6>Übungen mit Lösung</h6>
<p>1. In der Tabelle <code>mitarbeiter(pers_nr, name, steuer_id, abteilung_nr)</code> sind <code>pers_nr</code> und <code>steuer_id</code> eindeutig. Was sind
Schlüsselkandidaten, was eignet sich als Primärschlüssel, was ist ein Fremdschlüssel?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Schlüsselkandidaten: <code>pers_nr</code> und <code>steuer_id</code>. Primärschlüssel: <code>pers_nr</code> (betrieblich vergeben, unveränderlich, nicht
datenschutzsensibel). <code>abteilung_nr</code> ist Fremdschlüssel auf die Tabelle der Abteilungen.</p>
</details>
<p>2. Der Administrator legt einen Index an, damit die Suche nach Namen schneller wird. Muss das Programm geändert werden? Welcher Begriff beschreibt das?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Nein – physische Datenunabhängigkeit: Änderungen der internen Ebene wirken sich nicht auf Schema und Anwendungen aus.</p>
</details>
<p>3. Welche Integritätsregel verletzt <code>INSERT INTO bestellung (best_nr, kunde_nr) VALUES (5002, 9999)</code>, wenn es keinen Kunden 9999 gibt?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Die referenzielle Integrität – der Fremdschlüssel verweist auf einen nicht vorhandenen Primärschlüssel. Ist der Fremdschlüssel definiert, lehnt das DBMS die Zeile ab.</p>
</details>
INHALT,
    'summary' => [
        'Datenbanksystem = Datenbank (Daten) + DBMS (verwaltende Software).',
        'DBMS-Aufgaben: Integration, Mehrbenutzerbetrieb, Integrität, Zugriffsschutz, Sicherung, Abfragesprache, Katalog.',
        'Drei Ebenen (extern, konzeptionell, intern) sorgen für logische und physische Datenunabhängigkeit.',
        'Relation = Tabelle, Tupel = Zeile, Attribut = Spalte, Domäne = Wertebereich.',
        'Primärschlüssel eindeutig und nicht NULL; Fremdschlüssel verweist auf Primärschlüssel; Entitäts- und referenzielle Integrität.',
    ],
    'quiz' => [
        ['question' => 'Was ist der Unterschied zwischen Datenbank und DBMS?', 'answer' => 'Die Datenbank ist der Datenbestand, das DBMS die Software, die ihn verwaltet und den Zugriff regelt.'],
        ['question' => 'Was bedeutet physische Datenunabhängigkeit?', 'answer' => 'Änderungen an der Speicherung (Indizes, Datenträger, Dateiorganisation) erfordern keine Änderungen am Schema oder an den Anwendungen.'],
        ['question' => 'Was ist ein Tupel?', 'answer' => 'Eine Zeile einer Relation, also ein Datensatz.'],
        ['question' => 'Was besagt die referenzielle Integrität?', 'answer' => 'Ein Fremdschlüssel darf nur Werte enthalten, die als Primärschlüssel in der referenzierten Tabelle existieren (oder NULL sein).'],
    ],
];
