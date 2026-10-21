<?php
return [
    'title' => 'Vom ER-Modell zu Tabellen: Relationenmodell und Normalisierung',
    'intro' => 'Aus dem ER-Modell werden Tabellen. Die Normalisierung prüft, ob dabei Redundanzen entstanden sind, die später zu widersprüchlichen Daten führen würden.',
    'goals' => [
        'ein ER-Modell nach festen Regeln in Tabellen überführen',
        'Einfüge-, Änderungs- und Löschanomalien erkennen',
        'funktionale Abhängigkeiten bestimmen',
        'Tabellen in die 1., 2. und 3. Normalform bringen',
    ],
    'content' => <<<'INHALT'
<h6>Abbildungsregeln: vom ER-Modell zur Tabelle</h6>
<p>Das ER-Modell aus <a href="/Learningfields/LF5/kapitel4.php">Kapitel 4</a> wird als <strong>Relationenschema</strong> notiert: Tabellenname, in Klammern die Spalten, Primärschlüssel unterstrichen,
Fremdschlüssel mit ↑ markiert.</p>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th>ER-Element</th><th>wird zu …</th><th>Fahrradverleih</th></tr></thead>
  <tbody>
    <tr><td>Entitätstyp</td><td>eigene Tabelle, Schlüsselattribut = Primärschlüssel</td><td>Kunde(<u>KundenNr</u>, Name, Telefon)</td></tr>
    <tr><td>1:n-Beziehung</td><td>Fremdschlüssel auf der <strong>n-Seite</strong></td><td>Fahrrad(<u>RahmenNr</u>, Modell, Tagespreis, ↑FilialNr)</td></tr>
    <tr><td>m:n-Beziehung</td><td><strong>Zwischentabelle</strong> mit beiden Fremdschlüsseln und den Beziehungsattributen</td><td>Ausleihe(<u>AusleihNr</u>, ↑KundenNr, ↑RahmenNr, von, bis)</td></tr>
    <tr><td>1:1-Beziehung</td><td>Fremdschlüssel mit <code>UNIQUE</code> in einer der Tabellen (oder beide Tabellen zusammenlegen)</td><td>Tracker(<u>TrackerNr</u>, ↑RahmenNr UNIQUE)</td></tr>
  </tbody>
</table>
<p>Bei der Ausleihe reicht der zusammengesetzte Schlüssel (KundenNr, RahmenNr) nicht – derselbe Kunde kann dasselbe Rad mehrmals leihen. Deshalb bekommt die
Zwischentabelle eine eigene Nummer (oder der Zeitpunkt wird Teil des Schlüssels).</p>

<h6>Warum normalisieren? Anomalien</h6>
<p>Stehen Daten mehrfach in einer Tabelle (<strong>Redundanz</strong>), entstehen Anomalien:</p>
<ul>
  <li><strong>Einfügeanomalie</strong>: Ein neues Fahrrad lässt sich nicht erfassen, solange es nicht verliehen wurde – weil die Tabelle nur Ausleihen kennt.</li>
  <li><strong>Änderungsanomalie</strong>: Der Tagespreis steht in jeder Ausleihzeile; wird er nur an einer Stelle geändert, widersprechen sich die Daten.</li>
  <li><strong>Löschanomalie</strong>: Wird die einzige Ausleihe eines Kunden gelöscht, verschwinden auch Name und Telefonnummer.</li>
</ul>

<h6>Funktionale Abhängigkeit</h6>
<p>B ist <strong>funktional abhängig</strong> von A (A → B), wenn zu jedem Wert von A genau ein Wert von B gehört. KundenNr → Name: Zu einer Kundennummer gehört genau
ein Name. Umgekehrt nicht: Zwei Kunden können Kaya heißen. Die Normalformen sind Regeln über solche Abhängigkeiten.</p>

<h6>Die drei Normalformen am Beispiel</h6>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf5/normalisierung.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Leihschein mit mehreren Fahrrädern in einem Feld wird schrittweise in die erste, zweite und dritte Normalform gebracht">
  <figcaption class="figure-caption">Vom Leihschein mit Mehrfachwerten zu vier Tabellen in der 3. Normalform</figcaption>
</figure>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th>Normalform</th><th>Bedingung</th><th>Verstoß im Beispiel und Lösung</th></tr></thead>
  <tbody>
    <tr><td>1. NF</td><td>Alle Werte sind atomar; keine Wiederholungsgruppen.</td><td>Das Feld „Fahrräder“ enthält zwei Räder → eine Zeile je Fahrrad, Schlüssel (LeihNr, RahmenNr).</td></tr>
    <tr><td>2. NF</td><td>1. NF und jedes Nichtschlüsselattribut hängt vom <strong>ganzen</strong> Schlüssel ab.</td><td>Datum und Name hängen nur von LeihNr ab, Modell und Preis nur von RahmenNr (partielle Abhängigkeiten) → Tabellen Leihschein, Leihposition, Fahrrad.</td></tr>
    <tr><td>3. NF</td><td>2. NF und kein Nichtschlüsselattribut hängt von einem anderen Nichtschlüsselattribut ab.</td><td>LeihNr → KundenNr → Name (transitiv) → Tabelle Kunde, im Leihschein bleibt der Fremdschlüssel KundenNr.</td></tr>
  </tbody>
</table>
<p>Eine Tabelle mit einem <em>einfachen</em> Primärschlüssel (nur eine Spalte) ist automatisch in der 2. NF, wenn sie in der 1. NF ist – partielle Abhängigkeiten
gibt es nur bei zusammengesetzten Schlüsseln.</p>
<p>Mit SQLite getestet: Die vier Tabellen der 3. NF lassen sich per JOIN wieder zur Ausgangsliste zusammensetzen (die Zerlegung ist verlustfrei). Eine Preisänderung betrifft
jetzt genau eine Zeile in <code>fahrrad</code>, ein neues Lastenrad lässt sich ohne Ausleihe anlegen, und ein Leihschein für einen nicht vorhandenen Kunden wird mit
„FOREIGN KEY constraint failed“ abgelehnt.</p>
<pre class="bg-light border rounded p-3"><code>SELECT l.leih_nr, l.datum, k.name, f.rahmen_nr, f.modell, f.tagespreis_cent
FROM leihschein l
JOIN kunde k        ON k.kunden_nr = l.kunden_nr
JOIN leihposition p ON p.leih_nr   = l.leih_nr
JOIN fahrrad f      ON f.rahmen_nr = p.rahmen_nr;</code></pre>
<div class="lf-merke"><strong>Merke:</strong> Normalisieren heißt: Jede Information steht an genau einer Stelle. Manchmal speichert man bewusst redundant
(<strong>Denormalisierung</strong>), etwa den Preis zum Zeitpunkt der Ausleihe in der Leihposition – weil sich der aktuelle Preis später ändern kann, die Rechnung aber nicht.
Das ist dann keine Redundanz, sondern eine andere Information (historischer Preis).</div>

<h6>Übungen mit Lösung</h6>
<p>1. Tabelle <code>Kursbelegung(<u>MatrNr, KursNr</u>, StudentName, KursTitel, Note)</code>. In welcher Normalform ist sie, und wie normalisierst du sie?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">1. NF. StudentName hängt nur von MatrNr ab, KursTitel nur von KursNr (partiell). 2. und 3. NF: Student(<u>MatrNr</u>, Name),
Kurs(<u>KursNr</u>, Titel), Belegung(<u>↑MatrNr, ↑KursNr</u>, Note) – Note hängt vom ganzen Schlüssel ab.</p>
</details>
<p>2. Tabelle <code>Mitarbeiter(<u>PersNr</u>, Name, PLZ, Ort)</code>. Welche Normalform ist verletzt?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Die 3. NF: PersNr → PLZ → Ort ist transitiv. Lösung: Ort(<u>PLZ</u>, Ort), Mitarbeiter(<u>PersNr</u>, Name, ↑PLZ). (In der Praxis lässt man PLZ und Ort oft
zusammen, weil eine PLZ mehrere Orte haben kann – auch das ist eine bewusste Entscheidung.)</p>
</details>
<p>3. Überführe ins Relationenmodell: Ein Autor schreibt viele Bücher, ein Buch hat mehrere Autoren.</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">m:n → Zwischentabelle: Autor(<u>AutorNr</u>, Name), Buch(<u>ISBN</u>, Titel), Autorenschaft(<u>↑AutorNr, ↑ISBN</u>, Reihenfolge).</p>
</details>
INHALT,
    'summary' => [
        'Entitätstyp → Tabelle; 1:n → Fremdschlüssel auf der n-Seite; m:n → Zwischentabelle; 1:1 → Fremdschlüssel mit UNIQUE.',
        'Redundanz führt zu Einfüge-, Änderungs- und Löschanomalien.',
        'Funktionale Abhängigkeit A → B: zu jedem A genau ein B.',
        '1. NF atomar; 2. NF keine partiellen Abhängigkeiten vom Schlüssel; 3. NF keine transitiven Abhängigkeiten.',
        'Normalisierte Tabellen lassen sich per JOIN verlustfrei zusammensetzen; Denormalisierung nur bewusst und begründet.',
    ],
    'quiz' => [
        ['question' => 'Wie wird eine m:n-Beziehung im Relationenmodell umgesetzt?', 'answer' => 'Mit einer Zwischentabelle, die die Primärschlüssel beider Tabellen als Fremdschlüssel enthält (plus Beziehungsattribute).'],
        ['question' => 'Was ist eine Änderungsanomalie?', 'answer' => 'Eine mehrfach gespeicherte Information wird nur an einigen Stellen geändert, sodass widersprüchliche Daten entstehen.'],
        ['question' => 'Wann ist eine Tabelle in der 2. Normalform?', 'answer' => 'Wenn sie in der 1. NF ist und jedes Nichtschlüsselattribut vom gesamten Primärschlüssel abhängt, nicht nur von einem Teil.'],
        ['question' => 'Was ist eine transitive Abhängigkeit?', 'answer' => 'Ein Nichtschlüsselattribut hängt über ein anderes Nichtschlüsselattribut vom Schlüssel ab, z. B. PersNr → PLZ → Ort.'],
    ],
];
