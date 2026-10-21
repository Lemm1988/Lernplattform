<?php
return [
    'title' => 'Daten darstellen: Zahlensysteme, Datenmengen, Zeichen',
    'intro' => 'Computer kennen nur 0 und 1. Wie daraus Zahlen, Texte und Dateigrößen werden, gehört zum Grundwissen jeder IT-Fachkraft – und kommt in der Prüfung fast immer vor.',
    'goals' => [
        'Zahlen zwischen Dezimal-, Dual- und Hexadezimalsystem umrechnen',
        'negative Ganzzahlen im Zweierkomplement darstellen und Wertebereiche bestimmen',
        'Datenmengen mit dezimalen und binären Präfixen berechnen',
        'ASCII, Unicode und UTF-8 erklären und Kodierungsfehler erkennen',
    ],
    'content' => <<<'INHALT'
<h6>Stellenwertsysteme</h6>
<p>In einem Stellenwertsystem hängt der Wert einer Ziffer von ihrer Position ab. Jede Stelle ist eine Potenz der <strong>Basis</strong>:</p>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th>System</th><th>Basis</th><th>Ziffern</th><th>Schreibweise</th><th>Einsatz</th></tr></thead>
  <tbody>
    <tr><td>Dezimal</td><td>10</td><td>0–9</td><td>202</td><td>Alltag</td></tr>
    <tr><td>Dual (binär)</td><td>2</td><td>0, 1</td><td>1100 1010<sub>2</sub>, <code>0b11001010</code></td><td>Speicher, Logik, Netzmasken</td></tr>
    <tr><td>Hexadezimal</td><td>16</td><td>0–9, A–F (A = 10 … F = 15)</td><td>CA<sub>16</sub>, <code>0xCA</code></td><td>Farben (<code>#0d6efd</code>), Speicheradressen, MAC- und IPv6-Adressen</td></tr>
    <tr><td>Oktal</td><td>8</td><td>0–7</td><td>312<sub>8</sub></td><td>Dateirechte unter Linux (<code>chmod 755</code>)</td></tr>
  </tbody>
</table>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf5/zahlensysteme.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Dualzahl 11001010 mit Stellenwerten 128 bis 1, Summe 202, Gruppierung in C und A, daneben das Divisionsrestverfahren">
  <figcaption class="figure-caption">Drei Schreibweisen derselben Zahl: 202 = 1100 1010<sub>2</sub> = CA<sub>16</sub></figcaption>
</figure>
<ul>
  <li><strong>Dual → dezimal</strong>: die Stellenwerte der gesetzten Bits addieren.</li>
  <li><strong>Dezimal → dual</strong>: fortlaufend durch 2 teilen und die Reste von unten nach oben lesen (Divisionsrestverfahren). Alternativ: größte passende
  Zweierpotenz abziehen (202 − 128 = 74, − 64 = 10, − 8 = 2, − 2 = 0).</li>
  <li><strong>Dual ↔ hexadezimal</strong>: Je vier Bits (ein Nibble) ergeben genau eine Hex-Ziffer. Deshalb ist Hex die kompakte Schreibweise für Binärdaten:
  ein Byte = zwei Hex-Ziffern.</li>
  <li><strong>Hex → dezimal</strong>: 0x3F = 3 · 16 + 15 = 63.</li>
</ul>

<h6>Negative Zahlen: das Zweierkomplement</h6>
<p>Ganzzahlen mit Vorzeichen werden im <strong>Zweierkomplement</strong> gespeichert: Alle Bits der positiven Zahl umkehren und 1 addieren. Das höchste Bit zeigt
dann das Vorzeichen (1 = negativ).</p>
<pre class="bg-light border rounded p-3"><code> 5 = 0000 0101
     1111 1010   (alle Bits umkehren)
   +         1
-5 = 1111 1011</code></pre>
<p>Mit <em>n</em> Bits lassen sich ohne Vorzeichen die Werte 0 bis 2<sup>n</sup> − 1 darstellen, mit Vorzeichen −2<sup>n−1</sup> bis 2<sup>n−1</sup> − 1. Ein Byte
fasst also 0 bis 255 oder −128 bis 127. In Java hat <code>byte</code> 8, <code>short</code> 16, <code>int</code> 32 und <code>long</code> 64 Bit – wird der
Bereich überschritten, „läuft die Zahl über“ und springt ins Negative (vgl. 21! in <a href="/Learningfields/LF11/kapitel5.php">LF11 Kapitel 5</a>).</p>

<h6>Datenmengen</h6>
<p>8 Bit sind ein <strong>Byte</strong>. Für größere Mengen gibt es zwei Präfix-Systeme – und genau hier lauern Prüfungsfallen:</p>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th>dezimal (SI)</th><th>Wert</th><th>binär (IEC)</th><th>Wert</th></tr></thead>
  <tbody>
    <tr><td>1 kB (Kilobyte)</td><td>1.000 Byte</td><td>1 KiB (Kibibyte)</td><td>1.024 Byte</td></tr>
    <tr><td>1 MB (Megabyte)</td><td>1.000<sup>2</sup> Byte</td><td>1 MiB (Mebibyte)</td><td>1.024<sup>2</sup> = 1.048.576 Byte</td></tr>
    <tr><td>1 GB (Gigabyte)</td><td>1.000<sup>3</sup> Byte</td><td>1 GiB (Gibibyte)</td><td>1.024<sup>3</sup> Byte</td></tr>
    <tr><td>1 TB (Terabyte)</td><td>1.000<sup>4</sup> Byte</td><td>1 TiB (Tebibyte)</td><td>1.024<sup>4</sup> Byte</td></tr>
  </tbody>
</table>
<ul>
  <li>Eine als „500 GB“ verkaufte Festplatte zeigt Windows mit „465 GB“ an: 500 · 10<sup>9</sup> ÷ 2<sup>30</sup> ≈ 465,66 – Windows meint GiB.</li>
  <li>Übertragung: Datenraten werden in <strong>Bit</strong> pro Sekunde angegeben. 1,5 GB über eine 100-Mbit/s-Leitung: 1,5 · 10<sup>9</sup> · 8 Bit ÷ 100 · 10<sup>6</sup>
  Bit/s = <strong>120 Sekunden</strong> (ohne Protokoll-Overhead).</li>
  <li>Ein unkomprimiertes Full-HD-Bild mit 24 Bit Farbtiefe: 1920 · 1080 · 3 Byte = 6.220.800 Byte ≈ 6,22 MB ≈ 5,93 MiB.</li>
</ul>

<h6>Zeichen kodieren: ASCII, Unicode, UTF-8</h6>
<p><strong>ASCII</strong> ordnet 128 Zeichen (7 Bit) Zahlen zu: <code>'0'</code> = 48, <code>'A'</code> = 65, <code>'a'</code> = 97. Für Umlaute reichte das nicht; 8-Bit-Codes
wie ISO 8859-1 (Latin-1) ergänzten westeuropäische Zeichen, aber jede Sprache hatte ihre eigene Tabelle. <strong>Unicode</strong> gibt jedem Zeichen aller Schriften
eine eindeutige Nummer (Codepunkt, z. B. U+00FC für ü). <strong>UTF-8</strong> legt fest, wie diese Nummern als Bytes gespeichert werden – mit 1 bis 4 Byte:</p>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf5/utf8.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="A, ü, Euro und Fahrrad-Emoji mit Unicode-Codepunkt und ein bis vier UTF-8-Bytes">
  <figcaption class="figure-caption">UTF-8 ist zu ASCII kompatibel und braucht für andere Zeichen mehr Bytes</figcaption>
</figure>
<div class="lf-merke"><strong>Merke:</strong> Zeichensalat wie „Ã¼“ statt „ü“ entsteht, wenn UTF-8-Daten als Latin-1 gelesen werden. Deshalb Kodierung überall
gleich festlegen: Datei, Datenbank (<code>utf8mb4</code> in MySQL – das ältere <code>utf8</code> kann keine 4-Byte-Zeichen wie Emojis speichern),
Verbindung und HTML (<code>&lt;meta charset="UTF-8"&gt;</code>).</div>

<h6>Übungen mit Lösung</h6>
<p>1. Rechne 157 ins Dual- und Hexadezimalsystem um.</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">157 = 128 + 16 + 8 + 4 + 1 = <strong>1001 1101</strong><sub>2</sub>. Nibbles: 1001 = 9, 1101 = 13 = D → <strong>0x9D</strong>.</p>
</details>
<p>2. Welcher Dezimalwert steckt im Byte 1111 0110, a) ohne Vorzeichen, b) im Zweierkomplement?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">a) 128 + 64 + 32 + 16 + 4 + 2 = <strong>246</strong>. b) 246 − 256 = <strong>−10</strong> (Probe: 10 = 0000 1010 → 1111 0101 + 1 = 1111 0110).</p>
</details>
<p>3. Wie lange dauert die Übertragung einer 600-MB-Datei über eine 50-Mbit/s-Leitung?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">600 · 10<sup>6</sup> · 8 Bit ÷ 50 · 10<sup>6</sup> Bit/s = <strong>96 Sekunden</strong>.</p>
</details>
<p>4. Wie viele Byte belegt der Text „Grüße“ in UTF-8?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">G, r, e je 1 Byte; ü und ß je 2 Byte → 3 + 4 = <strong>7 Byte</strong> (bei 5 Zeichen).</p>
</details>
INHALT,
    'summary' => [
        'Dual: Basis 2; Hex: Basis 16 (A–F); 4 Bit = 1 Hex-Ziffer, 1 Byte = 2 Hex-Ziffern.',
        'Dezimal → dual mit dem Divisionsrestverfahren; dual → dezimal durch Addieren der Stellenwerte.',
        'Zweierkomplement: Bits umkehren, 1 addieren; n Bit mit Vorzeichen: −2ⁿ⁻¹ bis 2ⁿ⁻¹ − 1.',
        'kB/MB/GB = Potenzen von 1.000, KiB/MiB/GiB = Potenzen von 1.024; Datenraten in Bit pro Sekunde.',
        'ASCII 7 Bit, Unicode = Codepunkte, UTF-8 = 1 bis 4 Byte je Zeichen; Kodierung überall einheitlich festlegen.',
    ],
    'quiz' => [
        ['question' => 'Wie viele Hexadezimalziffern braucht man für ein Byte?', 'answer' => 'Zwei – jede Hex-Ziffer steht für genau vier Bits.'],
        ['question' => 'Welchen Wertebereich hat eine 8-Bit-Ganzzahl im Zweierkomplement?', 'answer' => 'Von −128 bis 127.'],
        ['question' => 'Wie viele Byte sind 1 KiB und wie viele 1 kB?', 'answer' => '1 KiB = 1.024 Byte, 1 kB = 1.000 Byte.'],
        ['question' => 'Warum kann ein Zeichen in UTF-8 mehrere Bytes belegen?', 'answer' => 'UTF-8 ist eine Kodierung variabler Länge: ASCII-Zeichen brauchen 1 Byte, andere Unicode-Zeichen 2 bis 4 Byte.'],
    ],
];
