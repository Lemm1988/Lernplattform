<?php
return [
    'title' => 'SQL erweitern und Datenbanken aus Java ansprechen',
    'intro' => 'Tabellen mit Regeln anlegen, Rechte vergeben – und dann aus einem Java-Programm sicher lesen und schreiben, inklusive Transaktion.',
    'goals' => [
        'Tabellen mit Primär-, Fremdschlüssel, NOT NULL, UNIQUE, CHECK und DEFAULT anlegen',
        'Views, Rechte (GRANT) und Transaktionen einsetzen',
        'mit JDBC Verbindungen öffnen, Prepared Statements ausführen und ResultSets lesen',
        'das DAO-Muster erklären',
    ],
    'content' => <<<'INHALT'
<p>Die Abfragegrundlagen (SELECT, JOIN, GROUP BY) findest du in <a href="/Learningfields/LF5/kapitel7.php">LF5 Kapitel 7</a>
und zum Üben im <a href="/games/sql-trainer/index.php">SQL-Trainer</a>. Hier geht es um den Aufbau der Datenbank und um den Zugriff aus Programmen.</p>

<h6>Tabellen mit Regeln anlegen (DDL)</h6>
<pre class="bg-light border rounded p-3"><code>CREATE TABLE kunde (
    id     INT AUTO_INCREMENT PRIMARY KEY,          -- fortlaufende ID
    name   VARCHAR(50)  NOT NULL,                   -- Pflichtfeld
    email  VARCHAR(100) NOT NULL UNIQUE,            -- keine Dubletten
    ort    VARCHAR(50)
);

CREATE TABLE konto (
    id        INT AUTO_INCREMENT PRIMARY KEY,
    kunde_id  INT NOT NULL,
    saldo     DECIMAL(10,2) NOT NULL DEFAULT 0 CHECK (saldo &gt;= 0),   -- kein Minus
    FOREIGN KEY (kunde_id) REFERENCES kunde(id)
        ON DELETE RESTRICT                          -- Kunde mit Konto nicht löschbar
);

ALTER TABLE kunde ADD COLUMN telefon VARCHAR(30);  -- Struktur nachträglich ändern</code></pre>
<p>Diese Regeln setzt die Datenbank selbst durch – egal, welches Programm schreibt. Das ist die letzte Verteidigungslinie für die
Datenqualität (<a href="/Learningfields/LF8/kapitel1.php">Kapitel 1</a>).</p>

<h6>Views und Rechte</h6>
<pre class="bg-light border rounded p-3"><code>-- View: gespeicherte Abfrage, die wie eine Tabelle genutzt wird
CREATE VIEW kunde_kontostand AS
SELECT k.name, SUM(ko.saldo) AS gesamt
FROM kunde k JOIN konto ko ON ko.kunde_id = k.id
GROUP BY k.id, k.name;

-- DCL: Die Webanwendung darf lesen und schreiben, aber nichts löschen oder umbauen
CREATE USER 'shop_app'@'localhost' IDENTIFIED BY 'langes-zufaelliges-passwort';
GRANT SELECT, INSERT, UPDATE ON bank.* TO 'shop_app'@'localhost';
-- Auswertung nur über die View
GRANT SELECT ON bank.kunde_kontostand TO 'controlling'@'%';
REVOKE UPDATE ON bank.* FROM 'shop_app'@'localhost';</code></pre>

<h6>Transaktionen</h6>
<p>Eine Transaktion bündelt mehrere Anweisungen zu einer Einheit: <strong>alles oder nichts</strong> (ACID, siehe
<a href="/Learningfields/LF5/kapitel8.php">LF5 Kapitel 8</a>).</p>
<pre class="bg-light border rounded p-3"><code>START TRANSACTION;
UPDATE konto SET saldo = saldo - 50 WHERE id = 1;
UPDATE konto SET saldo = saldo + 50 WHERE id = 2;
COMMIT;      -- dauerhaft speichern   (bei Fehler stattdessen: ROLLBACK)</code></pre>

<h6>JDBC: Datenbankzugriff aus Java</h6>
<p><strong>JDBC</strong> (Java Database Connectivity) ist die Standardschnittstelle von Java für relationale Datenbanken. Dein Code
spricht nur mit der JDBC-API; ein <strong>Treiber</strong> übersetzt das für das jeweilige Datenbanksystem. Den Treiber bindest du als
Bibliothek ein (z. B. über Maven), für MySQL ist das <em>MySQL Connector/J</em>.</p>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf8/jdbc-ablauf.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Schichten Java-Anwendung, JDBC-API, Treiber, Datenbank und die fünf Schritte Verbindung, PreparedStatement, Parameter binden, ausführen, ResultSet lesen">
  <figcaption class="figure-caption">Fünf Schritte vom Java-Code zum Ergebnis</figcaption>
</figure>
<pre class="bg-light border rounded p-3"><code>public class KundenDao {
    private static final String URL = "jdbc:mysql://localhost:3306/bank";   // MariaDB: jdbc:mariadb://…
    private static final String USER = "shop_app";
    private static final String PASSWORT = "…";      // in echt aus einer Konfigurationsdatei lesen

    private Connection verbinden() throws SQLException {
        return DriverManager.getConnection(URL, USER, PASSWORT);
    }

    public List&lt;String&gt; kundenAus(String ort) throws SQLException {
        String sql = "SELECT id, name FROM kunde WHERE ort = ? ORDER BY name";
        List&lt;String&gt; ergebnis = new ArrayList&lt;&gt;();
        try (Connection con = verbinden();
             PreparedStatement ps = con.prepareStatement(sql)) {
            ps.setString(1, ort);                         // ? wird sicher ersetzt
            try (ResultSet rs = ps.executeQuery()) {
                while (rs.next()) {                       // Zeile für Zeile
                    ergebnis.add(rs.getInt("id") + ": " + rs.getString("name"));
                }
            }
        }                                                 // alles wird automatisch geschlossen
        return ergebnis;
    }

    public int anlegen(String name, String email, String ort) throws SQLException {
        String sql = "INSERT INTO kunde (name, email, ort) VALUES (?, ?, ?)";
        try (Connection con = verbinden();
             PreparedStatement ps = con.prepareStatement(sql, Statement.RETURN_GENERATED_KEYS)) {
            ps.setString(1, name);
            ps.setString(2, email);
            ps.setString(3, ort);
            ps.executeUpdate();                           // liefert die Anzahl geänderter Zeilen
            try (ResultSet keys = ps.getGeneratedKeys()) {
                keys.next();
                return keys.getInt(1);                    // neue ID aus AUTO_INCREMENT
            }
        }
    }

    // Überweisung als Transaktion: beide Buchungen oder keine
    public void ueberweisen(int von, int nach, BigDecimal betrag) throws SQLException {
        try (Connection con = verbinden()) {
            con.setAutoCommit(false);                     // Transaktion beginnt
            try (PreparedStatement ab  = con.prepareStatement("UPDATE konto SET saldo = saldo - ? WHERE id = ?");
                 PreparedStatement gut = con.prepareStatement("UPDATE konto SET saldo = saldo + ? WHERE id = ?")) {
                ab.setBigDecimal(1, betrag);  ab.setInt(2, von);   ab.executeUpdate();
                gut.setBigDecimal(1, betrag); gut.setInt(2, nach); gut.executeUpdate();
                con.commit();
            } catch (SQLException e) {
                con.rollback();                           // z. B. CHECK (saldo &gt;= 0) verletzt → alles zurück
                throw e;
            }
        }
    }
}</code></pre>
<p>Getestet gegen eine echte Datenbank: <code>kundenAus("Köln")</code> liefert <code>[1: Meier]</code>, der Injection-Versuch
<code>kundenAus("Köln' OR '1'='1")</code> liefert eine <strong>leere Liste</strong>, weil der ganze Text als Wert behandelt wird.
Eine Überweisung, die das Konto ins Minus bringen würde, scheitert am <code>CHECK</code> und wird vollständig zurückgerollt.</p>
<div class="lf-merke"><strong>Merke:</strong> SQL nie per String-Verkettung mit Eingaben zusammenbauen – immer <code>PreparedStatement</code>
mit <code>?</code>. Ressourcen mit <code>try-with-resources</code> öffnen, damit Verbindungen auch bei Fehlern geschlossen werden.
Datenbankfehler kommen als <code>SQLException</code>, Regelverletzungen (doppelte E-Mail, fehlender Fremdschlüssel) als
<code>SQLIntegrityConstraintViolationException</code>.</div>

<h6>Das DAO-Muster</h6>
<p>Ein <strong>Data Access Object</strong> (DAO) bündelt den gesamten Datenbankcode für eine Entität in einer Klasse
(<code>KundenDao</code> mit <code>finden</code>, <code>anlegen</code>, <code>aendern</code>, <code>loeschen</code>). Die übrige Anwendung
kennt kein SQL, nur Methoden. Vorteile: SQL an einer Stelle, leichter testbar, Datenbank austauschbar. Im MVC-Muster gehört das DAO zum Model.</p>

<h6>Übungen mit Lösung</h6>
<p>1. Welche Methode verwendest du für ein <code>DELETE</code>, und was liefert sie zurück?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2"><code>executeUpdate()</code> – sie liefert die <strong>Anzahl der betroffenen Zeilen</strong> (z. B. 0, wenn es die ID nicht gab).
<code>executeQuery()</code> ist nur für Anweisungen mit Ergebnistabelle (SELECT).</p>
</details>
<p>2. Ein Entwickler schreibt <code>"SELECT * FROM kunde ORDER BY " + spalte</code> und möchte die Spalte per <code>?</code> setzen. Geht das?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Nein. Platzhalter gibt es nur für <strong>Werte</strong>, nicht für Spalten- oder Tabellennamen. Die Spalte muss gegen eine
<strong>Positivliste</strong> geprüft werden (<code>if (!Set.of("name", "ort").contains(spalte)) …</code>), bevor sie in den SQL-Text kommt.</p>
</details>
<p>3. Warum steht <code>setAutoCommit(false)</code> vor den beiden UPDATEs?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Standardmäßig wird jede Anweisung sofort festgeschrieben. Mit <code>setAutoCommit(false)</code> beginnt eine Transaktion; erst
<code>commit()</code> speichert beide Änderungen gemeinsam, <code>rollback()</code> verwirft beide.</p>
</details>
INHALT,
    'summary' => [
        'Constraints (PRIMARY KEY, FOREIGN KEY, NOT NULL, UNIQUE, CHECK, DEFAULT) lassen die Datenbank selbst Regeln durchsetzen.',
        'Views = gespeicherte Abfragen; GRANT/REVOKE vergeben Rechte nach dem Least-Privilege-Prinzip.',
        'JDBC: Connection → PreparedStatement mit ? → set…() → executeQuery()/executeUpdate() → ResultSet mit next().',
        'Transaktion in JDBC: setAutoCommit(false), commit(), bei Fehler rollback().',
        'DAO-Klassen kapseln den Datenbankzugriff; die übrige Anwendung kennt kein SQL.',
    ],
    'quiz' => [
        ['question' => 'Was liefert rs.next() und wozu dient es?', 'answer' => 'true, solange eine weitere Zeile vorhanden ist, und bewegt den Zeiger auf diese Zeile. Deshalb liest man ein ResultSet mit while (rs.next()).'],
        ['question' => 'Was bewirkt ON DELETE RESTRICT?', 'answer' => 'Ein Datensatz, auf den noch Fremdschlüssel verweisen (Kunde mit Konten), kann nicht gelöscht werden.'],
        ['question' => 'Wozu braucht man einen JDBC-Treiber?', 'answer' => 'Er übersetzt die einheitlichen JDBC-Aufrufe in das Protokoll des konkreten Datenbanksystems (z. B. MySQL Connector/J).'],
        ['question' => 'Warum schützt ein PreparedStatement vor SQL-Injection?', 'answer' => 'SQL-Text und Werte werden getrennt übertragen; der Wert kann nie als SQL-Befehl interpretiert werden.'],
    ],
];
