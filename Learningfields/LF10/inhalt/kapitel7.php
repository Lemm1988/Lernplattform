<?php
return [
    'title' => 'Formulare verarbeiten: validieren, säubern, escapen',
    'intro' => 'Jede Eingabe kann falsch, unvollständig oder bösartig sein. Hier lernst du den sicheren Weg vom Formular bis in die Datenbank – und zurück auf den Bildschirm.',
    'goals' => [
        'clientseitige und serverseitige Validierung unterscheiden und begründen',
        'Eingaben in PHP säubern und mit filter_var, Längen und Positivlisten validieren',
        'Ausgaben kontextgerecht escapen und Prepared Statements verwenden',
        'Fehlermeldungen pro Feld anzeigen, Eingaben erhalten und das Post/Redirect/Get-Muster sowie CSRF-Token einsetzen',
    ],
    'content' => <<<'INHALT'
<h6>Client oder Server?</h6>
<p>Der Browser kann Eingaben vorab prüfen (<code>required</code>, <code>type="email"</code>, <code>min</code>/<code>max</code>, JavaScript). Das ist
<strong>Komfort</strong>: Nutzer sehen Fehler sofort. <strong>Sicherheit</strong> bringt es nicht – mit den Entwicklerwerkzeugen, einem Skript oder einem
eigenen HTTP-Request lässt sich jede Browserprüfung umgehen. Deshalb gilt: <strong>Der Server prüft immer alles noch einmal.</strong></p>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf10/formular-ablauf.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Ablauf: Browser sendet POST, Server prüft CSRF, säubert, validiert, speichert mit Prepared Statement und leitet mit 303 um; bei Fehlern erneute Anzeige des Formulars">
  <figcaption class="figure-caption">Fünf Schritte auf dem Server – und ein Rückweg bei Fehlern</figcaption>
</figure>

<h6>Säubern und validieren</h6>
<p><strong>Säubern</strong> (Sanitizing) bringt Eingaben in eine einheitliche Form: nur die erwarteten Felder lesen, Leerzeichen am Rand entfernen.
<strong>Validieren</strong> prüft, ob der Wert den Regeln entspricht – und lehnt ihn sonst ab, statt ihn stillschweigend zu „reparieren“.</p>
<pre class="bg-light border rounded p-3"><code>const KURSE = ['java' =&gt; 'Java-Grundkurs', 'sql' =&gt; 'SQL kompakt', 'web' =&gt; 'Webdesign'];

$fehler = [];
$werte  = ['name' =&gt; '', 'email' =&gt; '', 'alter' =&gt; '', 'kurs' =&gt; ''];

foreach ($werte as $feld =&gt; $_) {                               // 1. säubern
    $werte[$feld] = trim((string)($_POST[$feld] ?? ''));
}

$laenge = mb_strlen($werte['name']);                            // 2. validieren
if ($laenge &lt; 2 || $laenge &gt; 60) {
    $fehler['name'] = 'Bitte einen Namen mit 2 bis 60 Zeichen eingeben.';
}
if (filter_var($werte['email'], FILTER_VALIDATE_EMAIL) === false) {
    $fehler['email'] = 'Bitte eine gültige E-Mail-Adresse eingeben, z. B. name@firma.de.';
}
$alter = filter_var($werte['alter'], FILTER_VALIDATE_INT,
                    ['options' =&gt; ['min_range' =&gt; 16, 'max_range' =&gt; 99]]);
if ($alter === false) {
    $fehler['alter'] = 'Das Alter muss eine ganze Zahl von 16 bis 99 sein.';
}
if (!array_key_exists($werte['kurs'], KURSE)) {                 // Positivliste
    $fehler['kurs'] = 'Bitte einen Kurs aus der Liste wählen.';
}</code></pre>
<p>Eine <strong>Positivliste</strong> (Whitelist) erlaubt nur bekannte Werte – sicherer als eine Negativliste, die Gefährliches aufzählt und immer
etwas vergisst. Im Test wurde per Entwicklerwerkzeug ein Kurs <code>admin</code> in die Auswahl geschmuggelt und als Alter <code>17abc</code> gesendet:
Der Server lehnt beides ab, obwohl der Browser nichts mehr prüfen konnte.</p>

<h6>Escapen: richtig für das jeweilige Ziel</h6>
<p>Validierung verhindert unsinnige Daten, aber nicht jeden Angriff – ein Name wie <code>&lt;b&gt;Kaya&lt;/b&gt;</code> ist eine zulässige Zeichenkette. Sicher
wird es erst, wenn jede Ausgabe für ihr <strong>Ziel</strong> kodiert wird:</p>
<ul>
  <li><strong>In die Datenbank</strong>: Prepared Statement mit Platzhaltern (LF8 Kapitel 11) – nie Werte in SQL-Text einsetzen.</li>
  <li><strong>Ins HTML</strong>: <code>htmlspecialchars($text, ENT_QUOTES, 'UTF-8')</code> wandelt <code>&lt; &gt; " ' &amp;</code> in harmlose Entitäten um. Das verhindert
  Cross-Site-Scripting (XSS).</li>
</ul>
<pre class="bg-light border rounded p-3"><code>function e(string $text): string {
    return htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
}

$stmt = $db-&gt;prepare('INSERT INTO anmeldung (name, email, alter_jahre, kurs) VALUES (?, ?, ?, ?)');
$stmt-&gt;execute([$werte['name'], $werte['email'], $alter, $werte['kurs']]);

&lt;li&gt;&lt;?= e($a['name']) ?&gt;&lt;/li&gt;                         &lt;!-- Ausgabe immer escapen --&gt;
&lt;input id="name" name="name" value="&lt;?= e($werte['name']) ?&gt;"&gt;</code></pre>
<p>Getestet: Die Eingabe <code>&lt;script&gt;alert(1)&lt;/script&gt;</code> landet wieder als Text im Feld, es öffnet sich kein Dialog. Aus
<code>&lt;b&gt;Kaya&lt;/b&gt;</code> wird im HTML <code>&amp;lt;b&amp;gt;Kaya&amp;lt;/b&amp;gt;</code> – sichtbar als Text, nicht fett.</p>

<h6>Fehler anzeigen, Eingaben erhalten</h6>
<p>Bei Fehlern wird das Formular erneut ausgegeben – mit der Meldung direkt am Feld und den bisherigen Eingaben (escapt!). Über
<code>aria-describedby</code> lesen Screenreader die Meldung zusammen mit dem Feld vor:</p>
<pre class="bg-light border rounded p-3"><code>&lt;label for="email"&gt;E-Mail&lt;/label&gt;
&lt;input id="email" name="email" type="email" value="&lt;?= e($werte['email']) ?&gt;" aria-describedby="email-fehler"&gt;
&lt;?php if (isset($fehler['email'])): ?&gt;
    &lt;p class="fehler" id="email-fehler"&gt;&lt;?= e($fehler['email']) ?&gt;&lt;/p&gt;
&lt;?php endif; ?&gt;</code></pre>

<h6>Post/Redirect/Get und CSRF-Schutz</h6>
<p>Würde nach erfolgreichem Speichern direkt eine Seite ausgegeben, fragt der Browser beim Neuladen „Formular erneut senden?“ – und die Anmeldung
landet doppelt in der Datenbank. Das <strong>PRG-Muster</strong> antwortet stattdessen mit einer Umleitung; die Erfolgsmeldung reist über die Session mit:</p>
<pre class="bg-light border rounded p-3"><code>if (!$fehler) {
    $stmt-&gt;execute([…]);
    $_SESSION['meldung'] = 'Danke, ' . $werte['name'] . '! Die Anmeldung ist gespeichert.';
    header('Location: anmeldung.php', true, 303);    // 303 See Other → Browser lädt per GET
    exit;
}</code></pre>
<p>Im Test: <code>POST</code> → <code>303</code> → <code>GET</code> → <code>200</code>; nach dem Neuladen gibt es weiterhin genau einen Eintrag.</p>
<p><strong>Cross-Site Request Forgery</strong> (CSRF): Eine fremde Webseite könnte das Formular im Namen eines angemeldeten Nutzers abschicken. Dagegen
hilft ein zufälliges Token, das nur die eigene Seite kennt:</p>
<pre class="bg-light border rounded p-3"><code>if (empty($_SESSION['csrf'])) {
    $_SESSION['csrf'] = bin2hex(random_bytes(32));
}
// im Formular:
&lt;input type="hidden" name="csrf" value="&lt;?= e($_SESSION['csrf']) ?&gt;"&gt;
// beim Empfang:
if (!hash_equals($_SESSION['csrf'], $_POST['csrf'] ?? '')) {
    http_response_code(403);
    exit('Ungültiges Formular-Token');
}</code></pre>
<p>Ein POST ohne Token wurde im Test mit <code>403</code> abgewiesen. <code>hash_equals</code> vergleicht in konstanter Zeit, sodass sich das Token nicht
Zeichen für Zeichen erraten lässt.</p>
<div class="lf-merke"><strong>Merke:</strong> Validieren bei der Eingabe, escapen bei der Ausgabe – passend zum Ziel. Clientseitige Prüfung ist Komfort,
serverseitige Prüfung ist Pflicht.</div>

<h6>Übungen mit Lösung</h6>
<p>1. Ein Entwickler sagt: „Das E-Mail-Feld hat <code>type="email"</code> und <code>required</code>, eine Prüfung in PHP ist überflüssig.“ Stimmt das?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Nein. Browserprüfungen lassen sich mit den Entwicklerwerkzeugen, mit <code>novalidate</code> oder einem direkten HTTP-Request umgehen. Der Server muss
selbst mit <code>filter_var(…, FILTER_VALIDATE_EMAIL)</code> prüfen.</p>
</details>
<p>2. Welche Funktion verhindert XSS bei <code>echo "Hallo " . $_GET['name'];</code>, und wie sieht die korrigierte Zeile aus?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2"><code>echo 'Hallo ' . htmlspecialchars($_GET['name'] ?? '', ENT_QUOTES, 'UTF-8');</code></p>
</details>
<p>3. Warum antwortet man nach erfolgreichem POST mit Status 303 statt direkt mit der Erfolgsseite?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Post/Redirect/Get: Der Browser lädt die Folgeseite per GET. Ein Neuladen oder Zurückblättern sendet das Formular nicht erneut – keine doppelten
Bestellungen oder Anmeldungen.</p>
</details>
INHALT,
    'summary' => [
        'Clientseitige Prüfung = Komfort; serverseitige Prüfung = Pflicht, weil Browserprüfungen umgehbar sind.',
        'Säubern (trim, nur erwartete Felder), dann validieren (filter_var, Längen, Positivliste) und bei Fehlern ablehnen.',
        'Escapen nach Ziel: Prepared Statements für SQL, htmlspecialchars für HTML.',
        'Fehler pro Feld anzeigen, Eingaben escapt erhalten, mit aria-describedby verknüpfen.',
        'PRG: nach erfolgreichem POST mit 303 umleiten; CSRF-Token in Session und Formular, Vergleich mit hash_equals.',
    ],
    'quiz' => [
        ['question' => 'Warum reicht clientseitige Validierung nicht aus?', 'answer' => 'Sie läuft im Browser des Nutzers und lässt sich umgehen oder abschalten; nur die Prüfung auf dem Server ist verlässlich.'],
        ['question' => 'Was ist eine Positivliste (Whitelist)?', 'answer' => 'Eine Liste der erlaubten Werte; alles andere wird abgelehnt. Sicherer als eine Liste verbotener Werte.'],
        ['question' => 'Was macht htmlspecialchars?', 'answer' => 'Es wandelt HTML-Sonderzeichen wie < > " \' & in Entitäten um, sodass Eingaben als Text angezeigt und nicht als HTML oder Skript ausgeführt werden.'],
        ['question' => 'Wovor schützt ein CSRF-Token?', 'answer' => 'Davor, dass eine fremde Seite im Namen eines angemeldeten Nutzers Formulare an die eigene Anwendung sendet.'],
    ],
];
