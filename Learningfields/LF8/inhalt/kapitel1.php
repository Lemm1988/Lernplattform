<?php
return [
    'title' => 'Datenqualität und Programmierparadigmen',
    'intro' => 'Bevor Daten zwischen Systemen fließen, müssen sie stimmen – und die Software, die sie verarbeitet, folgt einem Programmierstil. Beides legt dieses Kapitel als Grundlage.',
    'goals' => [
        'die Kriterien der Datenqualität nennen und an Beispielen erklären',
        'Maßnahmen beschreiben, mit denen Software die Datenqualität sichert',
        'imperative und deklarative Programmierparadigmen unterscheiden und Sprachen zuordnen',
    ],
    'content' => <<<'INHALT'
<p>„Daten systemübergreifend bereitstellen“ heißt: Daten werden in einem System erfasst und in anderen weiterverwendet.
Eine Bestellung im Onlineshop landet zum Beispiel im Warenwirtschaftssystem, in der Buchhaltung und beim Versanddienstleister.
Ein Fehler bei der Erfassung wandert durch alle Systeme – <em>Garbage in, garbage out</em>.</p>

<h6>Kriterien der Datenqualität</h6>
<div class="table-responsive">
<table class="table table-sm table-bordered align-middle">
  <thead class="table-light"><tr><th>Kriterium</th><th>Bedeutung</th><th>Typischer Fehler</th></tr></thead>
  <tbody>
    <tr><td><strong>Korrektheit</strong></td><td>Daten stimmen mit der Realität überein.</td><td>Falsche Hausnummer, Tippfehler im Namen</td></tr>
    <tr><td><strong>Vollständigkeit</strong></td><td>Alle benötigten Angaben sind vorhanden.</td><td>Bestellung ohne Lieferadresse</td></tr>
    <tr><td><strong>Konsistenz</strong></td><td>Daten widersprechen sich nicht – auch nicht über Systeme hinweg.</td><td>Kunde ist im CRM „aktiv“, in der Buchhaltung „gelöscht“</td></tr>
    <tr><td><strong>Eindeutigkeit</strong></td><td>Jeder Sachverhalt ist genau einmal gespeichert.</td><td>Derselbe Kunde als „M. Meier“ und „Max Meier“ (Dublette)</td></tr>
    <tr><td><strong>Aktualität</strong></td><td>Daten entsprechen dem aktuellen Stand.</td><td>Alte Telefonnummer nach Umzug</td></tr>
    <tr><td><strong>Einheitlichkeit</strong></td><td>Gleiche Formate und Einheiten.</td><td>Datum mal als 05.03.2026, mal als 2026-03-05; Preise brutto und netto gemischt</td></tr>
    <tr><td><strong>Genauigkeit</strong></td><td>Ausreichend detailliert für den Zweck.</td><td>Gewicht auf ganze Kilo gerundet, obwohl Gramm nötig sind</td></tr>
    <tr><td><strong>Relevanz</strong></td><td>Nur Daten, die für den Zweck gebraucht werden (auch DSGVO: Datensparsamkeit).</td><td>Geburtsdatum für einen Newsletter</td></tr>
  </tbody>
</table>
</div>

<p>Software kann viel dafür tun, dass schlechte Daten gar nicht erst entstehen:</p>
<ul>
  <li><strong>Validierung bei der Eingabe:</strong> Pflichtfelder, Formatprüfung (E-Mail, PLZ), Wertebereiche, Auswahllisten statt Freitext.</li>
  <li><strong>Regeln in der Datenbank:</strong> <code>NOT NULL</code>, <code>UNIQUE</code>, Fremdschlüssel, <code>CHECK</code>-Bedingungen, passende Datentypen.</li>
  <li><strong>Normalisierung:</strong> Jede Information nur einmal speichern – das verhindert Widersprüche.</li>
  <li><strong>Dublettenprüfung</strong> beim Anlegen („Gibt es diesen Kunden schon?“) und <strong>Datenbereinigung</strong> (Data Cleansing) für Altbestände.</li>
  <li><strong>Eine führende Quelle</strong> je Stammdatum (z. B. Kundendaten nur im CRM pflegen) und automatisierte Schnittstellen statt Abtippen.</li>
</ul>
<div class="lf-pruefung"><strong>Prüfungstipp:</strong> Typische Aufgabe: „Nennen Sie drei Kriterien der Datenqualität und je ein Beispiel.“
Nenne das Kriterium <em>und</em> einen konkreten Fehler aus der Aufgabensituation – das bringt die volle Punktzahl.</div>

<h6>Programmierparadigmen</h6>
<p>Ein Programmierparadigma ist ein grundlegender Programmierstil – die Art, wie ein Problem in Code zerlegt wird.
Die wichtigste Unterscheidung: Beschreibt der Code, <strong>wie</strong> etwas Schritt für Schritt berechnet wird (imperativ),
oder nur, <strong>was</strong> das Ergebnis sein soll (deklarativ)?</p>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf8/programmierparadigmen.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Baumdiagramm der Programmierparadigmen: imperativ mit prozedural und objektorientiert, deklarativ mit funktional, logisch und Abfragesprachen">
  <figcaption class="figure-caption">Die wichtigsten Programmierparadigmen mit Beispielsprachen</figcaption>
</figure>
<ul>
  <li><strong>Prozedural:</strong> Das Programm ist eine Folge von Anweisungen, gegliedert in Prozeduren/Funktionen. Daten und Funktionen sind getrennt.</li>
  <li><strong>Objektorientiert:</strong> Daten (Attribute) und das Verhalten dazu (Methoden) bilden zusammen Objekte. Mehr dazu in Kapitel 2.</li>
  <li><strong>Funktional:</strong> Programme bestehen aus Funktionen, die zu gleichen Eingaben immer das gleiche Ergebnis liefern und nichts nebenbei verändern (keine Seiteneffekte).</li>
  <li><strong>Logisch:</strong> Man beschreibt Fakten und Regeln, das System leitet Antworten ab.</li>
  <li><strong>Abfragesprachen</strong> wie SQL: Man beschreibt das gewünschte Ergebnis, die Datenbank entscheidet, wie sie es ermittelt.</li>
</ul>
<p>Derselbe Auftrag – „Summe aller geraden Zahlen“ – einmal imperativ und einmal funktional in Java:</p>
<pre class="bg-light border rounded p-3"><code>List&lt;Integer&gt; zahlen = List.of(3, 8, 5, 12, 7, 4);

// Imperativ: WIE wird gerechnet?
int summe = 0;
for (int zahl : zahlen) {
    if (zahl % 2 == 0) {
        summe += zahl;
    }
}

// Funktional: WAS soll herauskommen?
int summe2 = zahlen.stream()
        .filter(zahl -&gt; zahl % 2 == 0)
        .mapToInt(Integer::intValue)
        .sum();             // beide Male 24</code></pre>
<p>Und deklarativ in SQL: <code>SELECT SUM(zahl) FROM zahlen WHERE zahl % 2 = 0;</code> – keine Schleife, kein Zwischenergebnis.</p>
<div class="lf-merke"><strong>Merke:</strong> Imperativ = Rezept (Schritt für Schritt), deklarativ = Bestellung (nur das Ergebnis).
Java, Python und C# sind <em>multiparadigmatisch</em>: Sie sind im Kern objektorientiert, unterstützen aber auch funktionale Elemente.</div>

<h6>Übungen mit Lösung</h6>
<p>1. In einer Kundentabelle findest du: „Meier, Max – 50667 Köln“, „Max Meier – 50667 Köln“, „Schulz – PLZ fehlt“,
„Kaya – Geburtsdatum 31.02.1990“. Welche Kriterien der Datenqualität sind verletzt?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<ul class="mt-2">
  <li>Meier zweimal → <strong>Eindeutigkeit</strong> (Dublette), unterschiedliche Schreibweise → <strong>Einheitlichkeit</strong></li>
  <li>Schulz ohne PLZ → <strong>Vollständigkeit</strong></li>
  <li>31.02. gibt es nicht → <strong>Korrektheit</strong>; eine Datumsprüfung bei der Eingabe hätte das verhindert.</li>
</ul>
</details>
<p>2. Ordne zu: SQL, Java, C, Haskell, HTML.</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">SQL → deklarativ (Abfragesprache), Java → objektorientiert (imperativ, mit funktionalen Elementen), C → prozedural,
Haskell → funktional. <strong>HTML ist keine Programmiersprache</strong>, sondern eine Auszeichnungssprache: Sie beschreibt
die Struktur eines Dokuments, kennt aber keine Verzweigungen oder Schleifen.</p>
</details>
INHALT,
    'summary' => [
        'Datenqualität: korrekt, vollständig, konsistent, eindeutig, aktuell, einheitlich, genau, relevant.',
        'Software sichert Qualität durch Validierung, Datenbankregeln (NOT NULL, UNIQUE, FK, CHECK), Normalisierung und Dublettenprüfung.',
        'Imperativ beschreibt den Lösungsweg (prozedural, objektorientiert), deklarativ das Ergebnis (funktional, logisch, SQL).',
        'Moderne Sprachen wie Java und Python sind multiparadigmatisch.',
    ],
    'quiz' => [
        ['question' => 'Was ist der Unterschied zwischen Konsistenz und Eindeutigkeit?', 'answer' => 'Konsistenz: Daten widersprechen sich nicht (auch nicht zwischen Systemen). Eindeutigkeit: Jeder Sachverhalt ist nur einmal gespeichert – keine Dubletten.'],
        ['question' => 'Nenne zwei Datenbankregeln, die die Datenqualität sichern.', 'answer' => 'Zum Beispiel NOT NULL (Pflichtangabe), UNIQUE (keine doppelten Werte), Fremdschlüssel (nur existierende Bezüge) oder CHECK (Wertebereich).'],
        ['question' => 'Warum ist SQL eine deklarative Sprache?', 'answer' => 'Man beschreibt nur das gewünschte Ergebnis; wie die Daten gesucht, sortiert und verknüpft werden, entscheidet das Datenbanksystem.'],
        ['question' => 'Was bedeutet „ohne Seiteneffekte“ in der funktionalen Programmierung?', 'answer' => 'Eine Funktion verändert nichts außerhalb von sich (keine globalen Variablen, keine Ausgabe nebenbei) und liefert für gleiche Eingaben immer dasselbe Ergebnis.'],
    ],
];
