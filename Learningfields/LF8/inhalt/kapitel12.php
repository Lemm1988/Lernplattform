<?php
return [
    'title' => 'NoSQL und Datenbanken in der Cloud',
    'intro' => 'Wann relationale Datenbanken an Grenzen stoßen, wie Dokumentdatenbanken funktionieren und was du beim Betrieb in der Cloud beachten musst.',
    'goals' => [
        'Gründe für NoSQL nennen und horizontale von vertikaler Skalierung unterscheiden',
        'ACID und BASE gegenüberstellen und das CAP-Theorem erklären',
        'Dokumente in MongoDB anlegen, abfragen, ändern und auswerten',
        'IaaS, PaaS, SaaS und DBaaS abgrenzen und Cloud-Risiken (Datenschutz, Lock-in) bewerten',
    ],
    'content' => <<<'INHALT'
<h6>Warum überhaupt NoSQL?</h6>
<p>Relationale Datenbanken sind für strukturierte Daten mit klaren Beziehungen ideal. Probleme entstehen, wenn
Datenmengen und Zugriffszahlen so stark wachsen, dass <strong>ein Server nicht mehr reicht</strong>, oder wenn sich die
Struktur der Daten ständig ändert (Produkte mit völlig unterschiedlichen Eigenschaften, Sensordaten, Logdateien).
<strong>NoSQL</strong> steht für „Not only SQL“ – Datenbanken, die bewusst auf Teile des relationalen Modells verzichten.</p>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th></th><th>vertikal skalieren (scale up)</th><th>horizontal skalieren (scale out)</th></tr></thead>
  <tbody>
    <tr><th>Idee</th><td>größerer Server: mehr CPU, RAM, SSD</td><td>mehr Server, Daten werden verteilt</td></tr>
    <tr><th>Grenze</th><td>Hardware-Obergrenze, teuer</td><td>praktisch offen, Standard-Hardware</td></tr>
    <tr><th>Technik</th><td>–</td><td><strong>Sharding</strong> (Daten aufteilen) und <strong>Replikation</strong> (Kopien auf mehreren Knoten)</td></tr>
    <tr><th>typisch</th><td>klassische relationale DB</td><td>viele NoSQL-Systeme</td></tr>
  </tbody>
</table>

<h6>ACID, BASE und das CAP-Theorem</h6>
<p>Relationale Systeme garantieren <strong>ACID</strong> (Atomicity, Consistency, Isolation, Durability, siehe
<a href="/Learningfields/LF5/kapitel8.php">LF5 Kapitel 8</a>). Verteilte NoSQL-Systeme folgen oft dem lockereren
<strong>BASE</strong>-Prinzip: <em>Basically Available</em> (fast immer erreichbar), <em>Soft State</em> (Zustand kann sich
ohne neue Eingabe noch ändern, während Knoten sich abgleichen) und <em>Eventual Consistency</em> (alle Kopien sind
<strong>irgendwann</strong> gleich, nicht sofort).</p>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf8/cap-theorem.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="CAP-Dreieck mit Konsistenz, Verfügbarkeit und Partitionstoleranz sowie Beispielen für CA, CP und AP">
  <figcaption class="figure-caption">CAP-Theorem: Bei einer Netzwerkstörung muss ein verteiltes System zwischen Konsistenz und Verfügbarkeit wählen</figcaption>
</figure>
<p>Beispiel: Ein Online-Shop verteilt seinen Warenkorb-Speicher auf zwei Rechenzentren, die Verbindung dazwischen fällt aus.
Ein <strong>AP</strong>-System nimmt weiter Bestellungen an und gleicht später ab (Risiko: derselbe letzte Artikel wird
zweimal verkauft). Ein <strong>CP</strong>-System lehnt Schreibzugriffe auf der abgeschnittenen Seite ab (Risiko: Kunden sehen
eine Fehlermeldung). Für einen Kontostand wählt man C, für „Gefällt mir“-Zähler eher A.</p>

<h6>Welche NoSQL-Art wofür?</h6>
<p>Die Grundtypen kennst du aus <a href="/Learningfields/LF8/kapitel10.php">Kapitel 10</a>. Entscheidend ist die Frage: <em>Wie greife ich später auf die Daten zu?</em></p>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th>Typ</th><th>gut für</th><th>Beispiel</th></tr></thead>
  <tbody>
    <tr><td>Dokument</td><td>Objekte mit wechselnder Struktur, die man meist komplett liest: Produktkatalog, Profile, CMS-Inhalte</td><td>MongoDB</td></tr>
    <tr><td>Schlüssel-Wert</td><td>blitzschnelles Lesen per Schlüssel: Sessions, Cache, Zähler</td><td>Redis</td></tr>
    <tr><td>Spaltenfamilie</td><td>riesige Schreibmengen über viele Server: Messwerte, Logs, Zeitreihen</td><td>Cassandra</td></tr>
    <tr><td>Graph</td><td>stark vernetzte Daten: soziale Netze, Empfehlungen, Routen</td><td>Neo4j</td></tr>
  </tbody>
</table>

<h6>Dokumentdatenbank am Beispiel MongoDB</h6>
<p>MongoDB speichert <strong>Dokumente</strong> im JSON-ähnlichen Format BSON. Dokumente liegen in <strong>Collections</strong>;
ein festes Schema gibt es nicht – zwei Dokumente derselben Collection dürfen unterschiedliche Felder haben. Jedes Dokument
erhält automatisch ein eindeutiges Feld <code>_id</code>.</p>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th>relational</th><th>MongoDB</th></tr></thead>
  <tbody>
    <tr><td>Datenbank</td><td>Datenbank</td></tr>
    <tr><td>Tabelle</td><td>Collection</td></tr>
    <tr><td>Zeile (Datensatz)</td><td>Dokument</td></tr>
    <tr><td>Spalte</td><td>Feld</td></tr>
    <tr><td>Primärschlüssel</td><td><code>_id</code></td></tr>
    <tr><td>JOIN</td><td>Einbetten oder <code>$lookup</code></td></tr>
  </tbody>
</table>
<p>Zugriff mit Python und der Bibliothek <code>pymongo</code>:</p>
<pre class="bg-light border rounded p-3"><code>from pymongo import MongoClient

client = MongoClient("mongodb://localhost:27017")
kunden = client["shop"]["kunden"]          # Datenbank "shop", Collection "kunden"

# CREATE – unterschiedliche Felder sind erlaubt, "adresse" ist eingebettet
kunden.insert_one({"name": "Meier", "ort": "Köln", "punkte": 120,
                   "adresse": {"strasse": "Ringstr. 4", "plz": "50667"}})
kunden.insert_many([
    {"name": "Kaya", "ort": "Bonn", "punkte": 340, "tags": ["stammkunde"]},
    {"name": "Schulz", "ort": "Köln", "punkte": 80},
])

# READ – Filter als Dokument, zweites Argument = Projektion (welche Felder)
for k in kunden.find({"ort": "Köln"}, {"_id": 0, "name": 1}):
    print(k)                                        # {'name': 'Meier'}  {'name': 'Schulz'}

top = kunden.find({"punkte": {"$gt": 100}}).sort("punkte", -1)
print([k["name"] for k in top])                     # ['Kaya', 'Meier']

print(kunden.find_one({"adresse.plz": "50667"})["name"])   # Meier – Punkt greift ins eingebettete Dokument

# UPDATE – Operatoren statt kompletter Neuschreibung
kunden.update_one({"name": "Schulz"},
                  {"$inc": {"punkte": 50}, "$push": {"tags": "newsletter"}})
# Schulz hat jetzt punkte = 130 und tags = ['newsletter']

# Auswertung mit der Aggregation-Pipeline (entspricht GROUP BY ... ORDER BY)
pipeline = [
    {"$group": {"_id": "$ort", "anzahl": {"$sum": 1}, "summe": {"$sum": "$punkte"}}},
    {"$sort": {"summe": -1}},
]
print(list(kunden.aggregate(pipeline)))
# [{'_id': 'Bonn', 'anzahl': 1, 'summe': 340}, {'_id': 'Köln', 'anzahl': 2, 'summe': 250}]

# DELETE
kunden.delete_one({"name": "Schulz"})</code></pre>
<p>Vergleich mit SQL: <code>find({"punkte": {"$gt": 100}})</code> entspricht <code>SELECT * FROM kunden WHERE punkte &gt; 100</code>.
Weitere Vergleichsoperatoren: <code>$lt</code> (&lt;), <code>$gte</code> (&gt;=), <code>$lte</code> (&lt;=), <code>$ne</code> (≠), <code>$in</code> (in Liste).</p>

<h6>Einbetten oder referenzieren?</h6>
<p>Die wichtigste Designentscheidung bei Dokumentdatenbanken:</p>
<ul>
  <li><strong>Einbetten</strong> (Adresse im Kunden, Positionen in der Bestellung): alles mit einem Zugriff lesbar, kein Join nötig.
  Gut, wenn die Teile nur zusammen mit dem Elternobjekt benutzt werden und die Liste nicht unbegrenzt wächst.</li>
  <li><strong>Referenzieren</strong> (Bestellung speichert nur <code>kunde_id</code>): gut, wenn Daten von vielen Dokumenten genutzt
  werden oder sich oft ändern – sonst müsste man jede Kopie ändern (Redundanz, Anomalien wie in <a href="/Learningfields/LF8/kapitel10.php">Kapitel 10</a>).</li>
</ul>
<p>Kurz: Ein Dokumentmodell wird nach den <strong>Abfragen</strong> entworfen, ein relationales Modell nach den <strong>Daten</strong> (Normalisierung).</p>

<h6>Schlüssel-Wert am Beispiel Redis</h6>
<pre class="bg-light border rounded p-3"><code>SET session:7f3a "{\"user\": 42, \"rolle\": \"student\"}" EX 1800   # läuft nach 30 Minuten ab
GET session:7f3a
INCR seitenaufrufe:startseite                                       # atomarer Zähler</code></pre>
<p>Redis hält die Daten im Arbeitsspeicher und ist deshalb extrem schnell – typisch als Cache vor einer relationalen Datenbank.</p>

<h6>Datenbanken in der Cloud</h6>
<p><strong>Cloud-Computing</strong> heißt: IT-Ressourcen werden über das Netz bei Bedarf bereitgestellt und nach Verbrauch abgerechnet.
Typische Merkmale: Selbstbedienung ohne Rückfrage beim Anbieter, Zugriff über das Netz, gemeinsam genutzte Ressourcen,
schnelle Elastizität (hoch- und herunterskalieren) und messbare Nutzung (Pay-per-Use).</p>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf8/cloud-servicemodelle.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Vergleich On-Premises, IaaS, PaaS/DBaaS und SaaS: welche Schichten du und welche der Anbieter verwaltet">
  <figcaption class="figure-caption">Servicemodelle: Je weiter rechts, desto mehr übernimmt der Anbieter</figcaption>
</figure>
<p><strong>DBaaS</strong> (Database as a Service) ist eine PaaS-Variante: Der Anbieter installiert und patcht das DBMS, erstellt
Backups, repliziert und skaliert. Du kümmerst dich um Schema, Daten, Benutzer und Abfragen. Alternativ installierst du die Datenbank
selbst auf einer virtuellen Maschine (IaaS) – mehr Kontrolle, aber Updates und Backups sind dann deine Aufgabe.
Diese Aufteilung heißt <strong>Shared Responsibility Model</strong>.</p>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th>Bereitstellungsmodell</th><th>Bedeutung</th></tr></thead>
  <tbody>
    <tr><td>Public Cloud</td><td>Infrastruktur eines Anbieters, von vielen Kunden geteilt</td></tr>
    <tr><td>Private Cloud</td><td>exklusiv für eine Organisation, im eigenen oder fremden Rechenzentrum</td></tr>
    <tr><td>Hybrid Cloud</td><td>Kombination, z. B. sensible Daten privat, Webfrontend public</td></tr>
    <tr><td>Community Cloud</td><td>gemeinsam von Organisationen mit gleichen Anforderungen (z. B. Behörden, Kliniken)</td></tr>
    <tr><td>Multi-Cloud</td><td>Dienste mehrerer Anbieter parallel, um Abhängigkeit zu verringern</td></tr>
  </tbody>
</table>
<div class="row g-3 mb-3">
  <div class="col-md-6"><div class="border rounded p-3 h-100"><strong>Vorteile</strong>
    <ul class="mb-0"><li>keine Anschaffungskosten, Abrechnung nach Nutzung</li><li>schnell bereit, schnell skalierbar</li>
    <li>Backups, Hochverfügbarkeit und Updates inklusive</li><li>weltweit verteilbar</li></ul></div></div>
  <div class="col-md-6"><div class="border rounded p-3 h-100"><strong>Risiken</strong>
    <ul class="mb-0"><li>Abhängigkeit vom Anbieter (<em>Vendor Lock-in</em>) durch proprietäre Dienste</li>
    <li>laufende Kosten können bei Dauerlast höher sein als eigene Hardware</li>
    <li>Internetverbindung wird kritisch</li><li>Datenschutz: wo stehen die Server, wer hat Zugriff?</li></ul></div></div>
</div>
<div class="lf-pruefung"><strong>Prüfungstipp Datenschutz:</strong> Verarbeitet ein Cloud-Anbieter personenbezogene Daten in deinem Auftrag,
brauchst du einen <strong>Auftragsverarbeitungsvertrag</strong> (AVV, Art. 28 DSGVO). Verantwortlich gegenüber den Betroffenen bleibst
<strong>du</strong>. Achte auf den Serverstandort (EU), Verschlüsselung bei Übertragung und Speicherung und eine Exit-Strategie
(Daten in einem Standardformat exportierbar).</div>

<h6>Übungen mit Lösung</h6>
<p>1. Übersetze nach MongoDB: <code>SELECT name FROM kunden WHERE ort = 'Bonn' AND punkte &gt;= 200</code></p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2"><code>kunden.find({"ort": "Bonn", "punkte": {"$gte": 200}}, {"_id": 0, "name": 1})</code> – mehrere Bedingungen
im selben Filterdokument sind automatisch UND-verknüpft.</p>
</details>
<p>2. Welcher Datenbanktyp passt? a) Warenkorb-Sessions eines Shops, b) „Kunden, die X kauften, kauften auch …“, c) Buchhaltung</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">a) Schlüssel-Wert (schneller Zugriff per Session-ID, automatisches Ablaufen), b) Graph (Beziehungen zwischen Kunden und
Produkten), c) relational (feste Struktur, ACID-Transaktionen zwingend).</p>
</details>
<p>3. Ordne zu: a) Du mietest eine VM und installierst MySQL selbst. b) Du buchst eine verwaltete MySQL-Instanz. c) Das Team nutzt ein
Online-Ticketsystem im Browser. Wer spielt im Fall a) Sicherheitsupdates für das Betriebssystem ein?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">a) IaaS, b) PaaS/DBaaS, c) SaaS. Bei IaaS bist <strong>du</strong> für Betriebssystem-Updates zuständig – der Anbieter
nur für Hardware, Netz und Virtualisierung.</p>
</details>
INHALT,
    'summary' => [
        'NoSQL skaliert meist horizontal (Sharding, Replikation) und hat ein flexibles Schema.',
        'ACID = strenge Konsistenz; BASE = Basically Available, Soft State, Eventual Consistency.',
        'CAP: Bei einer Netzwerkpartition muss ein verteiltes System Konsistenz oder Verfügbarkeit opfern.',
        'MongoDB: Datenbank → Collection → Dokument; find, insert_one, update_one mit $set/$inc, aggregate.',
        'Dokumentmodell nach Abfragen entwerfen: einbetten, was zusammen gelesen wird, sonst referenzieren.',
        'IaaS → PaaS/DBaaS → SaaS: der Anbieter übernimmt immer mehr Schichten; für den Datenschutz bleibt der Kunde verantwortlich (AVV).',
    ],
    'quiz' => [
        ['question' => 'Was bedeutet Eventual Consistency?', 'answer' => 'Nach einer Änderung haben nicht sofort alle Kopien den neuen Stand, aber nach kurzer Zeit gleichen sich alle Knoten an.'],
        ['question' => 'Was ist der Unterschied zwischen Sharding und Replikation?', 'answer' => 'Sharding teilt die Daten auf mehrere Server auf (jeder hat einen Teil). Replikation hält Kopien derselben Daten auf mehreren Servern (Ausfallsicherheit, Lesegeschwindigkeit).'],
        ['question' => 'Wofür steht DBaaS und zu welchem Servicemodell gehört es?', 'answer' => 'Database as a Service – eine PaaS-Variante: Der Anbieter betreibt das DBMS inklusive Updates und Backups, der Kunde verwaltet Schema und Daten.'],
        ['question' => 'Welcher Vertrag ist nötig, wenn ein Cloud-Anbieter Kundendaten für dich speichert?', 'answer' => 'Ein Auftragsverarbeitungsvertrag (AVV) nach Art. 28 DSGVO.'],
    ],
];
