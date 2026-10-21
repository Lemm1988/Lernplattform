<?php
return [
    'title' => 'Daten schützen: Sicherung, Wiederherstellung und Rechte',
    'intro' => 'Festplatten fallen aus, Menschen löschen versehentlich, Angreifer verschlüsseln Server. Wer seine Daten sichert, Wiederherstellung übt und Rechte sparsam vergibt, übersteht das.',
    'goals' => [
        'Voll-, inkrementelle und differenzielle Sicherung unterscheiden',
        'Sicherungsstrategien (3-2-1, Generationenprinzip) und die Kennzahlen RPO und RTO anwenden',
        'eine Datenbank mit mysqldump sichern und wiederherstellen',
        'Benutzer anlegen und Rechte mit GRANT und REVOKE nach dem Prinzip der minimalen Rechte vergeben',
    ],
    'content' => <<<'INHALT'
<h6>Arten der Datensicherung</h6>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf5/backup-arten.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Vergleich über vier Tage: tägliche Vollsicherung, inkrementelle und differenzielle Sicherung mit den jeweils zum Wiederherstellen nötigen Sicherungen">
  <figcaption class="figure-caption">Sonntag Vollsicherung, Donnerstag Ausfall – welche Sicherungen braucht man?</figcaption>
</figure>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th>Art</th><th>sichert</th><th>Wiederherstellung</th><th>Speicher und Zeit</th></tr></thead>
  <tbody>
    <tr><td>Vollsicherung</td><td>alle Daten</td><td>nur die letzte Vollsicherung</td><td>hoch</td></tr>
    <tr><td>inkrementell</td><td>Änderungen seit der <strong>letzten Sicherung</strong> (egal welcher Art)</td><td>Vollsicherung + <strong>alle</strong> Inkremente danach</td><td>gering</td></tr>
    <tr><td>differenziell</td><td>Änderungen seit der <strong>letzten Vollsicherung</strong></td><td>Vollsicherung + <strong>letzte</strong> differenzielle</td><td>wächst bis zur nächsten Vollsicherung</td></tr>
  </tbody>
</table>

<h6>Strategie</h6>
<ul>
  <li><strong>3-2-1-Regel</strong>: mindestens <strong>3</strong> Kopien der Daten, auf <strong>2</strong> verschiedenen Medien, davon <strong>1</strong> an einem anderen Ort
  (außer Haus oder in der Cloud). Gegen Ransomware zusätzlich eine Kopie, die nicht ständig verbunden bzw. unveränderbar ist.</li>
  <li><strong>Generationenprinzip</strong> (Großvater–Vater–Sohn): tägliche Sicherungen (Söhne) werden wöchentlich, wöchentliche (Väter) monatlich überschrieben, monatliche
  (Großväter) länger aufbewahrt. So kann man auch zu einem Stand vor Wochen zurück.</li>
  <li><strong>RPO</strong> (Recovery Point Objective): Wie viele Daten darf man höchstens verlieren? Tägliche Sicherung um 2 Uhr → bis zu 24 Stunden.</li>
  <li><strong>RTO</strong> (Recovery Time Objective): Wie lange darf die Wiederherstellung höchstens dauern?</li>
  <li><strong>Wiederherstellung testen</strong>: Ein Backup, das nie zurückgespielt wurde, ist nur eine Hoffnung.</li>
  <li>Sicherungen enthalten personenbezogene Daten: verschlüsseln, Zugriff beschränken, Aufbewahrungsfristen und Löschpflichten beachten (LF12 Kapitel 9).</li>
</ul>
<p>RAID ersetzt keine Datensicherung: Es schützt vor dem Ausfall einer Platte, aber nicht vor versehentlichem Löschen, Viren oder Bränden – Fehler werden sofort auf alle
Platten gespiegelt.</p>

<h6>Datenbanken sichern und wiederherstellen</h6>
<p>Datenbankdateien im laufenden Betrieb einfach zu kopieren, ergibt oft einen inkonsistenten Stand. Ein <strong>logischer Dump</strong> erzeugt dagegen SQL-Anweisungen, die
die Datenbank neu aufbauen:</p>
<pre class="bg-light border rounded p-3"><code># sichern – --single-transaction liefert einen konsistenten Stand ohne Sperre (InnoDB)
mysqldump -u backup -p --single-transaction --routines verleih &gt; verleih_2026-10-21.sql

# wiederherstellen
mysql -u root -p verleih &lt; verleih_2026-10-21.sql</code></pre>
<p>Im Test: Datenbank mit zwei Kunden gesichert, Tabelle gelöscht („Table … doesn't exist“), Dump eingespielt – beide Kunden waren wieder da. Für große Datenbanken
gibt es physische Sicherungswerkzeuge, und mit dem <strong>Binärlog</strong> lassen sich nach dem Einspielen der letzten Sicherung alle späteren Änderungen nachspielen
(<em>Point-in-Time-Recovery</em>) – etwa bis eine Minute vor dem versehentlichen <code>DELETE</code>. In phpMyAdmin heißt der Dump „Exportieren“.</p>

<h6>Benutzer und Rechte</h6>
<p>Nach dem <strong>Prinzip der minimalen Rechte</strong> (Least Privilege, LF8 Kapitel 6) bekommt jede Anwendung einen eigenen Datenbankbenutzer mit genau den Rechten,
die sie braucht – nie den Administrator <code>root</code>.</p>
<pre class="bg-light border rounded p-3"><code>CREATE USER 'verleih_app'@'localhost' IDENTIFIED BY 'langes-zufaelliges-passwort';
GRANT SELECT, INSERT, UPDATE ON verleih.* TO 'verleih_app'@'localhost';
SHOW GRANTS FOR 'verleih_app'@'localhost';

REVOKE INSERT ON verleih.* FROM 'verleih_app'@'localhost';
DROP USER 'verleih_app'@'localhost';</code></pre>
<p>Getestet mit einem Testbenutzer: Lesen und Einfügen klappen; <code>DELETE</code> und <code>DROP TABLE</code> werden mit „command denied“ abgewiesen, ebenso jeder Zugriff
auf eine andere Datenbank. Nach dem <code>REVOKE</code> scheitert auch das Einfügen. So kann selbst eine erfolgreiche SQL-Injection keine Tabellen löschen.</p>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th>Benutzer</th><th>Rechte</th></tr></thead>
  <tbody>
    <tr><td>Webanwendung</td><td>SELECT, INSERT, UPDATE (evtl. DELETE) auf die eigene Datenbank</td></tr>
    <tr><td>Auswertung/Controlling</td><td>nur SELECT, am besten nur auf Views</td></tr>
    <tr><td>Backup</td><td>SELECT, LOCK TABLES, SHOW VIEW, EVENT, TRIGGER</td></tr>
    <tr><td>Migrationen</td><td>zusätzlich CREATE, ALTER, INDEX – nur während der Wartung</td></tr>
  </tbody>
</table>
<div class="lf-merke"><strong>Merke:</strong> Sicherung + getestete Wiederherstellung + minimale Rechte. Der Zugang zur Datenbank gehört nicht ins öffentliche Netz: Der Server
lauscht nur lokal oder im internen Netz, die Anwendung verbindet sich mit eigenem Benutzer und starkem Passwort.</div>

<h6>Übungen mit Lösung</h6>
<p>1. Sonntag Vollsicherung, Montag bis Freitag inkrementell. Am Samstag fällt der Server aus. Welche Sicherungen spielst du ein?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Die Vollsicherung vom Sonntag und danach <strong>alle</strong> Inkremente von Montag bis Freitag in der richtigen Reihenfolge.</p>
</details>
<p>2. Wie lautet die Antwort bei differenzieller Sicherung?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Vollsicherung vom Sonntag plus die differenzielle Sicherung vom <strong>Freitag</strong> – sie enthält alle Änderungen seit Sonntag.</p>
</details>
<p>3. Ein Shop speichert Bestellungen in einer Datenbank. Der Chef sagt: „Wir haben RAID 1, ein Backup brauchen wir nicht.“ Was entgegnest du?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">RAID 1 spiegelt Daten auf zwei Platten und schützt nur vor dem Ausfall einer Platte. Versehentliches Löschen, Softwarefehler, Ransomware oder ein Brand treffen beide
Platten gleichzeitig. Nötig sind regelmäßige, getestete Sicherungen nach der 3-2-1-Regel.</p>
</details>
<p>4. Gib einem Benutzer <code>controlling</code> nur Leserechte auf die View <code>umsatz_pro_monat</code> der Datenbank <code>shop</code>.</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2"><code>GRANT SELECT ON shop.umsatz_pro_monat TO 'controlling'@'%';</code></p>
</details>
INHALT,
    'summary' => [
        'Voll: alles; inkrementell: seit letzter Sicherung (Wiederherstellung: Voll + alle Inkremente); differenziell: seit letzter Vollsicherung (Voll + letzte Differenz).',
        '3-2-1-Regel, Generationenprinzip, RPO (Datenverlust) und RTO (Ausfallzeit); Wiederherstellung regelmäßig testen.',
        'RAID ist keine Datensicherung.',
        'mysqldump --single-transaction für konsistente logische Sicherungen; Wiederherstellung durch Einspielen des Dumps.',
        'Eigene Datenbankbenutzer pro Anwendung; GRANT/REVOKE nach dem Prinzip der minimalen Rechte.',
    ],
    'quiz' => [
        ['question' => 'Was sichert eine differenzielle Sicherung?', 'answer' => 'Alle Änderungen seit der letzten Vollsicherung.'],
        ['question' => 'Was besagt die 3-2-1-Regel?', 'answer' => 'Mindestens drei Kopien der Daten auf zwei verschiedenen Medien, davon eine an einem anderen Ort.'],
        ['question' => 'Was ist das RPO?', 'answer' => 'Recovery Point Objective: die maximal tolerierbare Menge an Datenverlust, gemessen als Zeitraum seit der letzten Sicherung.'],
        ['question' => 'Warum sollte eine Webanwendung nicht mit dem Benutzer root auf die Datenbank zugreifen?', 'answer' => 'Bei einer Sicherheitslücke hätte ein Angreifer alle Rechte auf alle Datenbanken; nach dem Prinzip der minimalen Rechte bekommt die Anwendung nur die nötigen Rechte.'],
    ],
];
