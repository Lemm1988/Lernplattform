<?php
return [
    'title' => 'Zustand im Web: Cookies, Sessions und Login',
    'intro' => 'HTTP vergisst nach jeder Anfrage alles. Damit ein Warenkorb oder ein Login trotzdem funktioniert, braucht es Cookies und Sessions – und die richtigen Sicherheitseinstellungen.',
    'goals' => [
        'erklären, warum HTTP zustandslos ist und wie Cookies und Sessions Zustand herstellen',
        'Sessions in PHP starten, nutzen und beenden',
        'einen Login mit password_hash/password_verify und neuer Session-ID umsetzen',
        'Cookie-Attribute (HttpOnly, Secure, SameSite) und Datenschutzregeln für Cookies anwenden',
    ],
    'content' => <<<'INHALT'
<h6>HTTP ist zustandslos</h6>
<p>Jede HTTP-Anfrage steht für sich; der Server weiß nicht von selbst, dass zwei Anfragen von derselben Person stammen. Für Warenkorb, Login oder
Spracheinstellung muss der Zustand deshalb mitgeführt werden:</p>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th></th><th>Cookie</th><th>Session</th></tr></thead>
  <tbody>
    <tr><th>Speicherort</th><td>im Browser</td><td>auf dem Server (Datei, Datenbank, Redis)</td></tr>
    <tr><th>Inhalt</th><td>kleine Textwerte (ca. 4 KB)</td><td>beliebige Daten in <code>$_SESSION</code></td></tr>
    <tr><th>Manipulierbar?</th><td>ja – der Nutzer kann Cookies ändern</td><td>nein – im Browser liegt nur eine zufällige ID</td></tr>
    <tr><th>Typisch für</th><td>Spracheinstellung, Einwilligung, die Session-ID selbst</td><td>Login-Status, Warenkorb, Formular-Token</td></tr>
  </tbody>
</table>
<p>Eine Session nutzt also ein Cookie: Es enthält nur die <strong>Session-ID</strong> (in PHP heißt es <code>PHPSESSID</code>). Bei jeder Anfrage schickt der
Browser es mit, und PHP lädt die passenden Daten nach <code>$_SESSION</code>.</p>

<h6>Ablauf eines Logins</h6>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf10/session-ablauf.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Vier Schritte zwischen Browser und Server: Session-Cookie erhalten, Login mit neuer Session-ID, Aufruf mit Cookie, Abmelden mit Löschen der Session">
  <figcaption class="figure-caption">Die Daten bleiben auf dem Server – der Browser kennt nur die ID</figcaption>
</figure>
<pre class="bg-light border rounded p-3"><code>// start.php – am Anfang jeder Seite
session_set_cookie_params([
    'lifetime' =&gt; 0,                           // bis zum Schließen des Browsers
    'path'     =&gt; '/',
    'secure'   =&gt; true,                        // nur über HTTPS senden
    'httponly' =&gt; true,                        // für JavaScript unsichtbar
    'samesite' =&gt; 'Lax',                       // bei Anfragen fremder Seiten nicht mitsenden
]);
session_start();

// login.php
$hash = $benutzerHash[$name] ?? null;          // aus der Datenbank, angelegt mit password_hash()
if ($hash !== null &amp;&amp; password_verify($passwort, $hash)) {
    session_regenerate_id(true);               // neue ID nach dem Login
    $_SESSION['benutzer'] = $name;
    header('Location: konto.php', true, 303);
    exit;
}
$fehler = 'Benutzername oder Passwort ist falsch.';

// konto.php – geschützte Seite
if (!isset($_SESSION['benutzer'])) {
    header('Location: login.php', true, 303);
    exit;
}</code></pre>
<p>Warum diese Details?</p>
<ul>
  <li><strong><code>password_hash</code> / <code>password_verify</code></strong>: gesalzener, langsamer Hash (bcrypt/Argon2) – Passwörter nie im Klartext oder mit MD5
  speichern (<a href="/Learningfields/LF8/kapitel6.php">LF8 Kapitel 6</a>).</li>
  <li><strong>Gleiche Fehlermeldung</strong> für falschen Namen und falsches Passwort: Sonst verrät die Seite, welche Benutzernamen existieren.</li>
  <li><strong><code>session_regenerate_id(true)</code></strong>: Ein Angreifer könnte einem Opfer vor dem Login eine ihm bekannte Session-ID unterschieben
  (<em>Session Fixation</em>). Mit einer neuen ID nach dem Login ist die alte wertlos.</li>
  <li><strong>HttpOnly</strong>: Selbst wenn eine XSS-Lücke existiert, kann JavaScript die Session-ID nicht auslesen. <strong>Secure</strong>: nie über
  unverschlüsseltes HTTP. <strong>SameSite=Lax</strong>: erschwert CSRF.</li>
</ul>
<p>Im Browser getestet: Ohne Login leitet <code>konto.php</code> zur Anmeldung um. Das Cookie ist HttpOnly mit SameSite=Lax, <code>document.cookie</code>
bleibt leer. Nach dem Login gibt es eine neue Session-ID, und ein Browser mit der <em>alten</em> ID landet wieder auf der Login-Seite. Der Zähler
<code>$_SESSION['aufrufe']</code> steht nach dem Login und zwei Neuladevorgängen auf 3.</p>

<h6>Abmelden</h6>
<pre class="bg-light border rounded p-3"><code>$_SESSION = [];                                     // Daten leeren
$p = session_get_cookie_params();
setcookie(session_name(), '', ['expires' =&gt; time() - 3600, 'path' =&gt; $p['path'],
          'secure' =&gt; $p['secure'], 'httponly' =&gt; $p['httponly'], 'samesite' =&gt; $p['samesite']]);
session_destroy();                                  // Session auf dem Server löschen
header('Location: login.php', true, 303);
exit;</code></pre>
<p>Das Abmelden läuft per POST (Formular-Button), nicht per Link – sonst könnte jede fremde Seite Nutzer mit einem eingebetteten Bild abmelden.
Sessions sollten außerdem nach einer Zeit ohne Aktivität ablaufen (z. B. 30 Minuten).</p>

<h6>Cookies und Datenschutz</h6>
<p>Nach dem TDDDG (früher TTDSG, § 25) dürfen Informationen nur mit <strong>Einwilligung</strong> im Endgerät gespeichert oder ausgelesen werden – außer sie sind
für den gewünschten Dienst <strong>unbedingt erforderlich</strong>. Session-Cookies für Login und Warenkorb sind erforderlich; Tracking- und
Werbe-Cookies brauchen eine echte Einwilligung (vorher, freiwillig, gleichwertige Ablehnen-Möglichkeit). Ein Cookie-Banner, das Tracking schon vor dem
Klick setzt, ist rechtswidrig.</p>

<h6>Übungen mit Lösung</h6>
<p>1. Warum speichert man den Login-Status in der Session und nicht in einem Cookie <code>eingeloggt=1</code>?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Cookies liegen im Browser und lassen sich beliebig ändern – jeder könnte <code>eingeloggt=1</code> setzen. In der Session liegen die Daten auf dem
Server; der Browser hat nur eine zufällige, schwer zu erratende ID.</p>
</details>
<p>2. Was ist Session Fixation, und welche Funktion schützt davor?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Ein Angreifer schiebt dem Opfer eine ihm bekannte Session-ID unter und wartet, bis es sich anmeldet; dann ist er mit derselben ID eingeloggt.
<code>session_regenerate_id(true)</code> direkt nach dem Login vergibt eine neue ID und macht die alte ungültig.</p>
</details>
<p>3. Welche Cookie-Attribute sollte ein Session-Cookie haben, und warum?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2"><code>HttpOnly</code> (kein Zugriff per JavaScript, schützt bei XSS), <code>Secure</code> (nur über HTTPS), <code>SameSite=Lax</code> oder
<code>Strict</code> (nicht bei Anfragen von fremden Seiten mitsenden, erschwert CSRF).</p>
</details>
INHALT,
    'summary' => [
        'HTTP ist zustandslos; Cookies speichern im Browser, Sessions auf dem Server – verbunden über die Session-ID im Cookie.',
        'Login: password_verify, gleiche Fehlermeldung für Name und Passwort, danach session_regenerate_id(true).',
        'Geschützte Seiten prüfen $_SESSION und leiten sonst um; Abmelden per POST mit session_destroy und gelöschtem Cookie.',
        'Session-Cookie mit HttpOnly, Secure und SameSite.',
        'Nicht notwendige Cookies (Tracking) nur mit vorheriger Einwilligung (TDDDG § 25, DSGVO).',
    ],
    'quiz' => [
        ['question' => 'Was speichert der Browser bei einer PHP-Session?', 'answer' => 'Nur die Session-ID in einem Cookie (PHPSESSID); die eigentlichen Daten liegen auf dem Server.'],
        ['question' => 'Wozu dient das Cookie-Attribut HttpOnly?', 'answer' => 'Das Cookie ist für JavaScript nicht lesbar; selbst bei einer XSS-Lücke kann die Session-ID nicht gestohlen werden.'],
        ['question' => 'Warum ruft man nach dem Login session_regenerate_id(true) auf?', 'answer' => 'Um Session Fixation zu verhindern: Die vorherige, eventuell untergeschobene ID wird ungültig.'],
        ['question' => 'Welche Cookies dürfen ohne Einwilligung gesetzt werden?', 'answer' => 'Nur solche, die für den vom Nutzer gewünschten Dienst unbedingt erforderlich sind, z. B. Session-Cookies für Login oder Warenkorb.'],
    ],
];
