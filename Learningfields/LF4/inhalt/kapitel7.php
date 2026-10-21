<?php
return [
    'title' => 'Kryptografie: verschlüsseln, hashen, signieren',
    'intro' => 'Verschlüsselung schützt die Vertraulichkeit, Hashwerte die Integrität, Signaturen die Authentizität. Dieses Kapitel erklärt die Verfahren so weit, wie man sie für Prüfung und Praxis braucht – mit XOR als Rechenbeispiel.',
    'goals' => [
        'mit XOR ver- und entschlüsseln',
        'symmetrische, asymmetrische und hybride Verfahren vergleichen',
        'die Zahl benötigter Schlüssel berechnen',
        'Eigenschaften und Einsatz von Hashfunktionen erklären, auch bei Passwörtern',
        'digitale Signatur und Zertifikatskette beschreiben',
    ],
    'content' => <<<'INHALT'
<h6>Grundidee</h6>
<p>Ein Verschlüsselungsverfahren macht aus <strong>Klartext</strong> mit einem <strong>Schlüssel</strong> einen <strong>Geheimtext</strong>. Nach dem Prinzip von Kerckhoffs
darf das Verfahren öffentlich bekannt sein – die Sicherheit hängt allein am geheimen Schlüssel. Selbst erfundene, „geheime“ Algorithmen sind deshalb ein Warnsignal.</p>

<h6>XOR: das einfachste Rechenbeispiel</h6>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf4/xor.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Das Zeichen A (01000001) XOR Schlüssel 00101010 ergibt 01101011 (k); erneutes XOR mit demselben Schlüssel ergibt wieder A">
  <figcaption class="figure-caption">Verschlüsseln und Entschlüsseln sind dieselbe Operation</figcaption>
</figure>
<p>XOR (exklusives Oder) ist 1, wenn genau eines der beiden Bits 1 ist. Ist der Schlüssel echt zufällig, so lang wie die Nachricht und wird nur einmal benutzt,
ist das Verfahren beweisbar sicher (<em>One-Time-Pad</em>). Mit einem kurzen, wiederholten Schlüssel lässt es sich dagegen leicht knacken.
In modernen Verfahren wie AES steckt XOR als ein Baustein unter vielen.</p>

<h6>Symmetrisch und asymmetrisch</h6>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf4/symmetrisch-asymmetrisch.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Oben: Anna und Ben nutzen denselben geheimen Schlüssel. Unten: Anna verschlüsselt mit Bens öffentlichem Schlüssel, Ben entschlüsselt mit seinem privaten">
  <figcaption class="figure-caption">Ein gemeinsamer Schlüssel oder ein Schlüsselpaar</figcaption>
</figure>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th></th><th>symmetrisch</th><th>asymmetrisch</th></tr></thead>
  <tbody>
    <tr><td>Schlüssel</td><td>ein gemeinsamer geheimer Schlüssel</td><td>Schlüsselpaar: öffentlicher und privater Schlüssel</td></tr>
    <tr><td>Beispiele</td><td>AES (128/256 Bit), ChaCha20</td><td>RSA (BSI empfiehlt mindestens 3000 Bit), elliptische Kurven</td></tr>
    <tr><td>Geschwindigkeit</td><td>sehr schnell, auch für große Datenmengen</td><td>langsam, nur für kleine Datenmengen</td></tr>
    <tr><td>Problem</td><td>sicherer Schlüsselaustausch; viele Schlüssel</td><td>Echtheit des öffentlichen Schlüssels (→ Zertifikate)</td></tr>
    <tr><td>Schlüssel für n Personen</td><td>n · (n − 1) / 2</td><td>n Schlüsselpaare</td></tr>
  </tbody>
</table>
<p>In der Praxis werden beide kombiniert: <strong>hybride Verschlüsselung</strong>. Mit asymmetrischen Verfahren handeln die Partner einen zufälligen
<em>Sitzungsschlüssel</em> aus, die eigentlichen Daten werden damit symmetrisch verschlüsselt. So arbeiten TLS (HTTPS), VPNs, SSH und verschlüsselte E-Mail.
Weil künftige Quantencomputer RSA und elliptische Kurven brechen könnten, werden zusätzlich <em>Post-Quanten-Verfahren</em> wie ML-KEM eingeführt.</p>

<h6>Hashfunktionen</h6>
<p>Eine Hashfunktion bildet beliebig lange Daten auf einen Wert fester Länge ab – bei SHA-256 auf 256 Bit (64 Hexzeichen). Eigenschaften:</p>
<ul>
  <li><strong>Einwegfunktion</strong>: Aus dem Hashwert lässt sich die Eingabe nicht zurückrechnen.</li>
  <li><strong>Kollisionsresistenz</strong>: Es ist praktisch unmöglich, zwei Eingaben mit gleichem Hash zu finden.</li>
  <li><strong>Lawineneffekt</strong>: Ein geändertes Zeichen ändert den ganzen Wert.
    SHA-256 von „Hallo“ beginnt mit <code>753692ec36adb4c7</code>, von „hallo“ mit <code>d3751d33f9cd5049</code>.</li>
</ul>
<p>MD5 und SHA-1 gelten als gebrochen und sind für Sicherheitszwecke tabu; aktuell sind SHA-256, SHA-512 und SHA-3. Einsatz: Integrität von Downloads prüfen,
Signaturen, Git-Commits – und Passwörter.</p>
<div class="lf-merke"><strong>Merke:</strong> Passwörter werden mit einem zufälligen <strong>Salt</strong> und einem absichtlich <strong>langsamen</strong> Verfahren gehasht –
bcrypt, scrypt oder Argon2, in PHP mit <code>password_hash()</code>. Ein schneller Hash wie SHA-256 allein ist dafür ungeeignet, weil Angreifer damit Milliarden
Versuche pro Sekunde schaffen. Das Salt sorgt dafür, dass gleiche Passwörter verschiedene Hashes ergeben und vorberechnete Tabellen nutzlos sind.</div>

<h6>Digitale Signatur</h6>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf4/signatur.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Anna hasht das Dokument und signiert den Hash mit ihrem privaten Schlüssel; Ben vergleicht seinen eigenen Hash mit dem aus der Signatur gewonnenen">
  <figcaption class="figure-caption">Privater Schlüssel signiert, öffentlicher Schlüssel prüft</figcaption>
</figure>
<p>Beim Verschlüsseln nutzt man den öffentlichen Schlüssel des <em>Empfängers</em>, beim Signieren den privaten Schlüssel des <em>Absenders</em>.
Eine Signatur macht ein Dokument nicht geheim; dafür wird zusätzlich verschlüsselt.</p>

<h6>Zertifikate und PKI</h6>
<p>Woher weiß Ben, dass ein öffentlicher Schlüssel wirklich Anna gehört? Ein <strong>Zertifikat</strong> (Standard X.509) bindet den Schlüssel an eine Identität und ist von einer
<strong>Zertifizierungsstelle</strong> (CA) signiert. Das Gesamtsystem aus CAs, Regeln und Sperrlisten heißt <strong>Public-Key-Infrastruktur</strong> (PKI).</p>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf4/zertifikatskette.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Root-CA signiert Zwischen-CA, Zwischen-CA signiert das Serverzertifikat; der Browser prüft Kette, Name, Gültigkeit und Widerruf">
  <figcaption class="figure-caption">Vertrauen wird über eine Kette von Signaturen weitergegeben</figcaption>
</figure>

<h6>Übungen mit Lösung</h6>
<p>1. Verschlüssle das Halbbyte 1011 mit dem Schlüssel 0110 per XOR und entschlüssle das Ergebnis wieder.</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">1011 ⊕ 0110 = 1101. Entschlüsseln: 1101 ⊕ 0110 = 1011.</p>
</details>
<p>2. Zehn Mitarbeitende sollen paarweise vertraulich kommunizieren. Wie viele Schlüssel braucht man symmetrisch, wie viele asymmetrisch?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Symmetrisch: 10 · 9 / 2 = <strong>45</strong> geheime Schlüssel, für jedes Paar einer. Asymmetrisch: <strong>10 Schlüsselpaare</strong> (20 Schlüssel), jede Person eins.</p>
</details>
<p>3. Anna will Ben eine Datei schicken, die nur Ben lesen kann und von der Ben sicher weiß, dass sie von Anna kommt. Welche Schlüssel werden benutzt?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Anna signiert mit <strong>ihrem privaten</strong> Schlüssel und verschlüsselt (hybrid) mit <strong>Bens öffentlichem</strong> Schlüssel. Ben entschlüsselt mit
<strong>seinem privaten</strong> Schlüssel und prüft die Signatur mit <strong>Annas öffentlichem</strong> Schlüssel.</p>
</details>
<p>4. Eine Datenbank speichert Passwörter als ungesalzene MD5-Hashes. Was ist das Problem, und was ist besser?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">MD5 ist schnell und gebrochen; ohne Salt haben gleiche Passwörter gleiche Hashes und lassen sich mit vorberechneten Tabellen nachschlagen.
Besser: <code>password_hash()</code> mit bcrypt oder Argon2 (Salt automatisch), alte Hashes beim nächsten Login umstellen.</p>
</details>
INHALT,
    'summary' => [
        'Kerckhoffs: Sicherheit liegt im geheimen Schlüssel, nicht im geheimen Verfahren.',
        'XOR: Bit kippt, wo der Schlüssel 1 ist; zweimal XOR ergibt das Original.',
        'Symmetrisch (AES) schnell, aber Schlüsselaustausch; asymmetrisch (RSA, ECC) mit Schlüsselpaar, langsam; hybrid in TLS.',
        'Hash: Einweg, feste Länge, kollisionsresistent; Passwörter mit Salt und langsamem Verfahren (bcrypt, Argon2).',
        'Signatur: Hash mit privatem Schlüssel des Absenders, Prüfung mit dessen öffentlichem; Zertifikate binden Schlüssel an Identitäten.',
    ],
    'quiz' => [
        ['question' => 'Was ergibt 1 XOR 1?', 'answer' => '0'],
        ['question' => 'Welcher Schlüssel wird zum Signieren verwendet?', 'answer' => 'Der private Schlüssel des Absenders.'],
        ['question' => 'Warum nutzt TLS hybride Verschlüsselung?', 'answer' => 'Asymmetrisch wird ein Sitzungsschlüssel sicher vereinbart, die Daten werden dann schnell symmetrisch verschlüsselt.'],
        ['question' => 'Wozu dient ein Salt beim Passwort-Hashing?', 'answer' => 'Gleiche Passwörter ergeben verschiedene Hashes; vorberechnete Tabellen werden nutzlos.'],
    ],
];
