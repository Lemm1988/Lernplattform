<?php
return [
    'title' => 'Sicherheit bei der Softwareplanung',
    'intro' => 'Sicherheit lässt sich nicht nachträglich „anschrauben“. Wer sie von Anfang an einplant, verhindert die typischen Lücken, die Angreifer heute ausnutzen.',
    'goals' => [
        'Schutzziele der Informationssicherheit auf Software übertragen',
        'die Prinzipien Security by Design, Defense in Depth und Least Privilege erklären',
        'typische Schwachstellen (Injection, XSS, CSRF, fehlerhafte Zugriffskontrolle) und ihre Abwehr beschreiben',
        'Passwörter korrekt speichern',
    ],
    'content' => <<<'INHALT'
<h6>Schutzziele</h6>
<p>Software muss die drei klassischen Schutzziele sichern – oft ergänzt um zwei weitere:</p>
<ul>
  <li><strong>Vertraulichkeit:</strong> Nur Berechtigte sehen die Daten (Zugriffskontrolle, Verschlüsselung).</li>
  <li><strong>Integrität:</strong> Daten werden nicht unbemerkt verändert (Validierung, Prüfsummen, Rechte).</li>
  <li><strong>Verfügbarkeit:</strong> Das System ist nutzbar, wenn es gebraucht wird (Backups, Lastverteilung, Schutz vor Überlastung).</li>
  <li>Dazu <strong>Authentizität</strong> (Wer ist es wirklich?) und <strong>Verbindlichkeit</strong> (Wer hat was getan? – Protokollierung).</li>
</ul>

<h6>Grundprinzipien</h6>
<ul>
  <li><strong>Security by Design:</strong> Sicherheitsanforderungen gehören ins Lastenheft, in die Architektur und in die Tests – nicht erst in die Fehlerbehebung.</li>
  <li><strong>Security by Default:</strong> Die Grundeinstellung ist die sichere (Debug-Ausgaben aus, Konten gesperrt bis zur Freigabe, nur nötige Ports offen).</li>
  <li><strong>Least Privilege:</strong> Jeder Benutzer, Dienst und Datenbank-Account bekommt nur die Rechte, die er wirklich braucht.</li>
  <li><strong>Privacy by Design</strong> (DSGVO Art. 25): Nur notwendige personenbezogene Daten erheben und sie technisch schützen.</li>
  <li><strong>Defense in Depth:</strong> Mehrere Schutzschichten hintereinander – fällt eine, hält die nächste.</li>
</ul>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf8/defense-in-depth.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Vier Schichten Netzwerk, Server, Anwendung und Daten mit den jeweiligen Schutzmaßnahmen">
  <figcaption class="figure-caption">Mehrere Sicherheitsebenen schützen die Daten in der Mitte</figcaption>
</figure>

<h6>Typische Schwachstellen und ihre Abwehr</h6>
<p>Die OWASP-Top-10 listen die häufigsten Sicherheitsrisiken von Webanwendungen. Für Entwickler sind diese besonders wichtig:</p>
<div class="table-responsive">
<table class="table table-sm table-bordered align-middle">
  <thead class="table-light"><tr><th>Schwachstelle</th><th>Was passiert?</th><th>Abwehr</th></tr></thead>
  <tbody>
    <tr><td><strong>SQL-Injection</strong></td><td>Eingaben werden als SQL ausgeführt: <code>' OR '1'='1</code> im Loginfeld umgeht die Passwortprüfung.</td><td>Prepared Statements (<a href="/Learningfields/LF8/kapitel11.php">Kapitel 11</a>), nie Eingaben in SQL-Strings einbauen</td></tr>
    <tr><td><strong>Cross-Site Scripting (XSS)</strong></td><td>Eingeschleuster JavaScript-Code läuft im Browser anderer Nutzer und stiehlt z. B. Sitzungen.</td><td>Ausgaben kontextgerecht escapen (<code>htmlspecialchars</code>), Content-Security-Policy</td></tr>
    <tr><td><strong>Cross-Site Request Forgery (CSRF)</strong></td><td>Eine fremde Seite löst im Namen eines angemeldeten Nutzers Aktionen aus.</td><td>Zufälliges CSRF-Token in jedem Formular prüfen, SameSite-Cookies</td></tr>
    <tr><td><strong>Fehlerhafte Zugriffskontrolle</strong></td><td>Wer die URL <code>/rechnung?id=124</code> ändert, sieht fremde Rechnungen.</td><td>Bei <em>jeder</em> Anfrage serverseitig prüfen: Darf dieser Nutzer das?</td></tr>
    <tr><td><strong>Unsichere Passwortspeicherung</strong></td><td>Nach einem Datenleck liegen Passwörter im Klartext oder als einfacher MD5-Hash vor.</td><td>Langsame Hashverfahren mit Salt (bcrypt, Argon2, PBKDF2)</td></tr>
    <tr><td><strong>Fehlkonfiguration</strong></td><td>Detaillierte Fehlermeldungen verraten Pfade und SQL; Testdateien sind öffentlich erreichbar.</td><td>Fehler nur loggen, nicht anzeigen; interne Ordner sperren</td></tr>
    <tr><td><strong>Unsichere Datei-Uploads</strong></td><td>Ein „Bild“ mit Endung <code>.php</code> wird hochgeladen und auf dem Server ausgeführt.</td><td>Dateityp am Inhalt prüfen, Endung selbst vergeben, Uploads nicht ausführbar</td></tr>
    <tr><td><strong>Veraltete Komponenten</strong></td><td>Eine Bibliothek mit bekannter Lücke wird weiter genutzt.</td><td>Abhängigkeiten pflegen und aktualisieren</td></tr>
  </tbody>
</table>
</div>
<div class="lf-merke"><strong>Merke – Eingabe und Ausgabe:</strong> Eingaben werden <em>validiert</em> (Format, Länge, Wertebereich; am besten per
Positivliste: „nur Ziffern, 5 Stellen“). Ausgaben werden <em>kodiert</em>, passend zum Zielort: HTML-Escaping für die Webseite,
Parameterbindung für SQL. Validierung allein schützt nicht vor XSS oder Injection – beides gehört zusammen.</div>

<h6>Passwörter richtig speichern</h6>
<p>Passwörter werden <strong>nie</strong> im Klartext und nie verschlüsselt (umkehrbar) gespeichert, sondern als <strong>Hash</strong> –
das Ergebnis einer Einwegfunktion. Beim Login wird das eingegebene Passwort genauso gehasht und mit dem gespeicherten Hash verglichen.</p>
<ul>
  <li>Ein zufälliges <strong>Salt</strong> pro Passwort sorgt dafür, dass gleiche Passwörter unterschiedliche Hashes haben – vorberechnete Tabellen (Rainbow Tables) nützen dann nichts.</li>
  <li>Das Verfahren muss <strong>absichtlich langsam</strong> sein (bcrypt, Argon2, PBKDF2 mit vielen Durchläufen), damit Durchprobieren teuer wird. MD5 und SHA-1 sind dafür ungeeignet.</li>
</ul>
<pre class="bg-light border rounded p-3"><code>// PBKDF2 mit zufälligem Salt – nur Bordmittel des JDK
byte[] salt = new byte[16];
new SecureRandom().nextBytes(salt);
PBEKeySpec spec = new PBEKeySpec(passwort, salt, 310_000, 256);   // 310.000 Durchläufe
byte[] hash = SecretKeyFactory.getInstance("PBKDF2WithHmacSHA256")
        .generateSecret(spec).getEncoded();
// gespeichert werden Salt UND Hash; beim Login mit demselben Salt neu berechnen
// und mit MessageDigest.isEqual(...) vergleichen (zeitkonstanter Vergleich)</code></pre>
<p>In PHP übernimmt <code>password_hash($passwort, PASSWORD_DEFAULT)</code> und <code>password_verify(…)</code> das komplett – inklusive Salt.</p>

<h6>Weitere Bausteine</h6>
<ul>
  <li><strong>Authentifizierung</strong> stärken: Mindestanforderungen an Passwörter, Sperre nach Fehlversuchen, Zwei-Faktor-Authentifizierung.</li>
  <li><strong>Sitzungen</strong> schützen: neue Sitzungs-ID nach dem Login, Cookies mit <code>HttpOnly</code>, <code>Secure</code>, <code>SameSite</code>, Timeout.</li>
  <li><strong>Geheimnisse</strong> (Datenbankpasswort, API-Schlüssel) gehören in eine Konfigurationsdatei außerhalb des Code-Repositorys.</li>
  <li><strong>Protokollierung</strong> sicherheitsrelevanter Ereignisse (Anmeldungen, Rechteänderungen) – ohne Passwörter oder unnötige personenbezogene Daten.</li>
</ul>

<h6>Übungen mit Lösung</h6>
<p>1. Ein Login-Formular baut die Abfrage so: <code>"SELECT * FROM user WHERE name='" + name + "' AND pw='" + pw + "'"</code>. Nenne zwei Fehler.</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">(1) <strong>SQL-Injection</strong>: Eingaben werden direkt in den SQL-String eingesetzt – mit <code>' OR '1'='1' -- </code> ist man ohne Passwort drin.
Abhilfe: Prepared Statement. (2) Das Passwort wird offenbar <strong>im Klartext</strong> gespeichert und verglichen.
Abhilfe: nur einen gesalzenen, langsamen Hash speichern und beim Login per Funktion (z. B. <code>password_verify</code>) vergleichen.</p>
</details>
<p>2. Ordne zu – welches Schutzziel ist verletzt? (a) Die Website ist nach einem Angriff stundenlang nicht erreichbar.
(b) Ein Angreifer ändert Preise in der Datenbank. (c) Kundendaten tauchen im Internet auf.</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">(a) Verfügbarkeit, (b) Integrität, (c) Vertraulichkeit.</p>
</details>
<p>3. Warum reicht es nicht, im Browser per JavaScript zu prüfen, ob eine Eingabe gültig ist?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Alles im Browser kann der Nutzer umgehen (Entwicklerwerkzeuge, eigene HTTP-Anfragen). Clientseitige Prüfung verbessert nur die
Bedienung; die verbindliche Prüfung muss <strong>auf dem Server</strong> stattfinden.</p>
</details>
INHALT,
    'summary' => [
        'Schutzziele: Vertraulichkeit, Integrität, Verfügbarkeit – dazu Authentizität und Verbindlichkeit.',
        'Prinzipien: Security und Privacy by Design, Security by Default, Least Privilege, Defense in Depth.',
        'SQL-Injection → Prepared Statements; XSS → Ausgaben escapen; CSRF → Token; Zugriffskontrolle bei jeder Anfrage auf dem Server.',
        'Passwörter: gesalzener, langsamer Hash (bcrypt, Argon2, PBKDF2) – nie Klartext, nie MD5.',
        'Eingaben validieren UND Ausgaben kodieren; clientseitige Prüfung ersetzt keine serverseitige.',
    ],
    'quiz' => [
        ['question' => 'Was ist ein Salt und wozu dient es?', 'answer' => 'Ein zufälliger Wert, der pro Passwort vor dem Hashen hinzugefügt und mitgespeichert wird. Gleiche Passwörter ergeben so verschiedene Hashes; vorberechnete Tabellen werden nutzlos.'],
        ['question' => 'Was bedeutet Least Privilege für den Datenbank-Account einer Webanwendung?', 'answer' => 'Er bekommt nur die nötigen Rechte (z. B. SELECT, INSERT, UPDATE auf die eigenen Tabellen) – kein DROP, keine Rechte auf andere Datenbanken, kein Admin-Konto.'],
        ['question' => 'Wie schützt ein CSRF-Token?', 'answer' => 'Der Server legt pro Sitzung ein zufälliges Token an und bettet es in seine Formulare ein. Eine fremde Seite kennt es nicht, ihre gefälschte Anfrage wird abgelehnt.'],
        ['question' => 'Warum sollten Fehlermeldungen im Live-Betrieb nicht im Browser erscheinen?', 'answer' => 'Sie verraten Angreifern Details wie Dateipfade, SQL-Abfragen, Tabellen- und Versionsnamen. Fehler werden nur protokolliert, der Nutzer sieht eine neutrale Meldung.'],
    ],
];
