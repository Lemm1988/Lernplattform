<?php
return [
    'title' => 'Datenmodelle und Datenbankentwurf',
    'intro' => 'Welches Datenmodell passt zur Aufgabe – und wie kommt man von einer Anforderung zu sauberen Tabellen? Hier entsteht der Entwurf, auf dem Kapitel 11 aufbaut.',
    'goals' => [
        'relationale und NoSQL-Datenmodelle unterscheiden und begründet auswählen',
        'die 5 Vs von Big Data erklären',
        'die Phasen des Datenbankentwurfs beschreiben',
        'ein ER-Modell in Tabellen überführen und bis zur 3. Normalform normalisieren',
    ],
    'content' => <<<'INHALT'
<h6>Das passende Datenmodell wählen</h6>
<p>Ein Datenmodell legt fest, in welcher Struktur Daten gespeichert und abgefragt werden. Das <strong>relationale</strong> Modell
(Tabellen, SQL) ist der Standard für betriebliche Anwendungen. Für sehr große, schnell wachsende oder wenig strukturierte Daten
gibt es <strong>NoSQL</strong>-Modelle („not only SQL“), die in Kapitel 12 genauer vorkommen.</p>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf8/datenmodelle.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Sechs Datenmodelle: relational, dokumentenorientiert, Schlüssel-Wert, spaltenorientiert, Graph und hierarchisch mit Beispielsystemen">
  <figcaption class="figure-caption">Datenmodelle mit typischen Datenbanksystemen</figcaption>
</figure>
<div class="table-responsive">
<table class="table table-sm table-bordered align-middle">
  <thead class="table-light"><tr><th>Anforderung</th><th>Passendes Modell</th></tr></thead>
  <tbody>
    <tr><td>Buchhaltung, Bestellungen – feste Struktur, Transaktionen müssen stimmen</td><td>relational</td></tr>
    <tr><td>Produktkatalog mit sehr unterschiedlichen Eigenschaften je Produkt</td><td>dokumentenorientiert</td></tr>
    <tr><td>Sitzungsdaten oder Zwischenspeicher mit extrem schnellem Zugriff</td><td>Schlüssel-Wert</td></tr>
    <tr><td>Soziales Netzwerk, Empfehlungen („Kunden kauften auch“)</td><td>Graph</td></tr>
    <tr><td>Milliarden Sensorwerte, Auswertungen über wenige Spalten</td><td>spaltenorientiert</td></tr>
  </tbody>
</table>
</div>

<h6>Big Data – die 5 Vs</h6>
<ul>
  <li><strong>Volume</strong> – riesige Datenmengen (Tera- bis Petabyte)</li>
  <li><strong>Velocity</strong> – hohe Geschwindigkeit, mit der Daten entstehen und verarbeitet werden müssen (z. B. Sensoren in Echtzeit)</li>
  <li><strong>Variety</strong> – Vielfalt: strukturiert (Tabellen), semistrukturiert (JSON, XML), unstrukturiert (Texte, Bilder)</li>
  <li><strong>Veracity</strong> – Verlässlichkeit: Wie vertrauenswürdig und vollständig sind die Daten? (siehe Datenqualität, Kapitel 1)</li>
  <li><strong>Value</strong> – Wert: Daten lohnen sich nur, wenn sich daraus Nutzen ziehen lässt</li>
</ul>

<h6>Der Entwurfsprozess</h6>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf8/db-entwurfsprozess.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Fünf Phasen: Anforderungsanalyse, konzeptioneller Entwurf mit ER-Modell, logischer Entwurf mit Relationenmodell, Normalisierung, physischer Entwurf mit SQL-DDL">
  <figcaption class="figure-caption">Vom Lastenheft zur fertigen Datenbank</figcaption>
</figure>
<p>Der <strong>konzeptionelle</strong> Entwurf ist unabhängig von jeder Technik (ER-Modell, siehe
<a href="/Learningfields/LF5/kapitel1.php">LF5 Kapitel 1</a>). Der <strong>logische</strong> Entwurf legt das Datenmodell fest –
bei relationalen Datenbanken Tabellen, Primär- und Fremdschlüssel. Erst der <strong>physische</strong> Entwurf berücksichtigt das konkrete
Datenbanksystem: Datentypen, Indizes, Speicher.</p>

<h6>Vom ER-Modell zu Tabellen</h6>
<div class="table-responsive">
<table class="table table-sm table-bordered align-middle">
  <thead class="table-light"><tr><th>Beziehung</th><th>Umsetzung</th><th>Beispiel</th></tr></thead>
  <tbody>
    <tr><td><strong>1:n</strong></td><td>Fremdschlüssel auf der n-Seite</td><td><code>bestellung.kunde_id</code> → <code>kunde.id</code></td></tr>
    <tr><td><strong>n:m</strong></td><td>eigene Zwischentabelle mit beiden Fremdschlüsseln (zusammen Primärschlüssel); Attribute der Beziehung kommen hier hinein</td><td><code>teilnahme(teilnehmer_nr, kurs_nr, note)</code></td></tr>
    <tr><td><strong>1:1</strong></td><td>Fremdschlüssel mit <code>UNIQUE</code> auf einer Seite – oder beide Entitäten in einer Tabelle</td><td><code>mitarbeiter_ausweis.mitarbeiter_id UNIQUE</code></td></tr>
  </tbody>
</table>
</div>

<h6>Normalisierung an einem Beispiel</h6>
<p>Eine Seminarfirma verwaltet ihre Anmeldungen bisher in einer einzigen Tabelle:</p>
<div class="table-responsive">
<table class="table table-sm table-bordered align-middle small">
  <thead class="table-light"><tr><th>TeilnehmerNr</th><th>Name</th><th>Firma</th><th>FirmenOrt</th><th>Kurse</th></tr></thead>
  <tbody>
    <tr><td>101</td><td>Lena Wolf</td><td>ByteBurg GmbH</td><td>Köln</td><td>K1 SQL-Grundlagen 490 €, K2 Java OOP 690 €</td></tr>
    <tr><td>102</td><td>Tom Berger</td><td>ByteBurg GmbH</td><td>Köln</td><td>K1 SQL-Grundlagen 490 €</td></tr>
    <tr><td>103</td><td>Aylin Demir</td><td>Datenwerk AG</td><td>Bonn</td><td>K2 Java OOP 690 €</td></tr>
  </tbody>
</table>
</div>
<p><strong>1. Normalform</strong> – nur atomare Werte: Die Spalte „Kurse“ enthält mehrere Werte. Jede Teilnahme bekommt eine eigene Zeile,
Primärschlüssel ist jetzt <strong>(TeilnehmerNr, KursNr)</strong>.</p>
<pre class="bg-light border rounded p-3"><code>anmeldung(<u>TeilnehmerNr</u>, <u>KursNr</u>, Name, Firma, FirmenOrt, KursTitel, Preis)
101 | K1 | Lena Wolf   | ByteBurg GmbH | Köln | SQL-Grundlagen | 490
101 | K2 | Lena Wolf   | ByteBurg GmbH | Köln | Java OOP       | 690
102 | K1 | Tom Berger  | ByteBurg GmbH | Köln | SQL-Grundlagen | 490
103 | K2 | Aylin Demir | Datenwerk AG  | Bonn | Java OOP       | 690</code></pre>
<p><strong>2. Normalform</strong> – keine partiellen Abhängigkeiten: Name, Firma und FirmenOrt hängen nur von TeilnehmerNr ab,
KursTitel und Preis nur von KursNr – also nur von einem <em>Teil</em> des Schlüssels. Sie wandern in eigene Tabellen.</p>
<pre class="bg-light border rounded p-3"><code>teilnehmer(<u>TeilnehmerNr</u>, Name, Firma, FirmenOrt)
kurs(<u>KursNr</u>, KursTitel, Preis)
teilnahme(<u>TeilnehmerNr</u>↑, <u>KursNr</u>↑)              ↑ = Fremdschlüssel</code></pre>
<p><strong>3. Normalform</strong> – keine transitiven Abhängigkeiten: In <code>teilnehmer</code> hängt FirmenOrt von Firma ab, also
nur indirekt vom Schlüssel (TeilnehmerNr → Firma → FirmenOrt). Die Firma wird eine eigene Tabelle.</p>
<pre class="bg-light border rounded p-3"><code>firma(<u>FirmaNr</u>, Name, Ort)
teilnehmer(<u>TeilnehmerNr</u>, Name, FirmaNr↑)
kurs(<u>KursNr</u>, KursTitel, Preis)
teilnahme(<u>TeilnehmerNr</u>↑, <u>KursNr</u>↑)</code></pre>
<p>Ergebnis: Zieht die ByteBurg GmbH um, ändert man <em>eine</em> Zeile statt vieler (keine Änderungsanomalie). Einen neuen Kurs kann man
anlegen, bevor sich jemand anmeldet (keine Einfügeanomalie). Und wer seinen einzigen Kurs storniert, verschwindet nicht samt Firmendaten
(keine Löschanomalie).</p>
<div class="lf-pruefung"><strong>Prüfungstipp:</strong> Schreib bei jedem Schritt dazu, <em>welche</em> Abhängigkeit du auflöst
(„Preis hängt nur von KursNr ab → partielle Abhängigkeit → eigene Tabelle kurs“). Die Begründung bringt in der AP2 oft mehr Punkte als die Tabellen allein.</div>

<h6>Übung mit Lösung</h6>
<p>Normalisiere bis zur 3. NF: <code>ausleihe(AusleihNr, Datum, MitgliedNr, MitgliedName, PLZ, Ort, BuchISBN, BuchTitel)</code> –
eine Ausleihe umfasst genau ein Buch.</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<ul class="mt-2">
  <li>1NF ist erfüllt (alle Werte atomar), Schlüssel: AusleihNr. Weil der Schlüssel nur aus einer Spalte besteht, ist auch die 2NF erfüllt.</li>
  <li>3NF verletzt: MitgliedName, PLZ hängen über MitgliedNr ab, Ort über PLZ, BuchTitel über BuchISBN (transitiv).</li>
  <li>Ergebnis: <code>ausleihe(<u>AusleihNr</u>, Datum, MitgliedNr↑, BuchISBN↑)</code>, <code>mitglied(<u>MitgliedNr</u>, Name, PLZ↑)</code>,
  <code>ort(<u>PLZ</u>, Ort)</code>, <code>buch(<u>ISBN</u>, Titel)</code></li>
</ul>
</details>
INHALT,
    'summary' => [
        'Relational für strukturierte, transaktionale Daten; NoSQL (Dokument, Schlüssel-Wert, Spalten, Graph) für Spezialfälle und große Datenmengen.',
        'Big Data: Volume, Velocity, Variety, Veracity, Value.',
        'Entwurf: Anforderungen → konzeptionell (ER) → logisch (Tabellen) → Normalisierung → physisch (DDL, Indizes).',
        '1:n → FK auf der n-Seite, n:m → Zwischentabelle, 1:1 → FK mit UNIQUE.',
        '1NF atomar, 2NF keine partiellen, 3NF keine transitiven Abhängigkeiten.',
    ],
    'quiz' => [
        ['question' => 'Wofür steht „Variety“ bei Big Data?', 'answer' => 'Für die Vielfalt der Datenformate: strukturiert, semistrukturiert (JSON, XML) und unstrukturiert (Texte, Bilder, Videos).'],
        ['question' => 'Wohin kommt das Attribut „Note“ einer n:m-Beziehung zwischen Teilnehmer und Kurs?', 'answer' => 'In die Zwischentabelle (z. B. teilnahme), weil es weder allein zum Teilnehmer noch allein zum Kurs gehört.'],
        ['question' => 'Warum kann eine Tabelle mit einspaltigem Primärschlüssel die 2. NF nicht verletzen (wenn sie in 1NF ist)?', 'answer' => 'Partielle Abhängigkeiten setzen einen zusammengesetzten Schlüssel voraus – von einem Teil eines einspaltigen Schlüssels kann nichts abhängen.'],
        ['question' => 'Welches Datenmodell passt zu „Freunde von Freunden finden“?', 'answer' => 'Ein Graphmodell (z. B. Neo4j): Beziehungen sind dort direkt gespeichert und lassen sich schnell über mehrere Stufen verfolgen.'],
    ],
];
