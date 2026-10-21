<?php
return [
    'title' => 'Bedrohungen erkennen und Risiken bewerten',
    'intro' => 'Die meisten erfolgreichen Angriffe beginnen nicht mit genialer Technik, sondern mit einer E-Mail, einem schwachen Passwort oder einem vergessenen Update. Wer die Muster kennt, erkennt sie – und kann Risiken einschätzen.',
    'goals' => [
        'Schadsoftware-Arten unterscheiden und Infektionswege nennen',
        'Social Engineering und Phishing an typischen Merkmalen erkennen',
        'Angriffe auf Passwörter und Webanwendungen einordnen',
        'Risiken mit einer Risikomatrix bewerten',
        'Strategien der Risikobehandlung auswählen',
    ],
    'content' => <<<'INHALT'
<h6>Schadsoftware</h6>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th>Art</th><th>Merkmal</th></tr></thead>
  <tbody>
    <tr><td>Virus</td><td>hängt sich an Dateien oder Dokumente (z. B. Makros) und verbreitet sich, wenn sie ausgeführt bzw. geöffnet werden</td></tr>
    <tr><td>Wurm</td><td>verbreitet sich selbstständig über das Netz, meist über eine Sicherheitslücke – ohne Zutun des Nutzers</td></tr>
    <tr><td>Trojaner</td><td>tarnt sich als nützliches Programm und öffnet heimlich eine Hintertür oder lädt weitere Schadsoftware nach</td></tr>
    <tr><td>Ransomware</td><td>verschlüsselt Daten und fordert Lösegeld; häufig werden Daten vorher kopiert und mit Veröffentlichung gedroht</td></tr>
    <tr><td>Spyware, Keylogger</td><td>späht Eingaben, Passwörter und Daten aus</td></tr>
    <tr><td>Rootkit</td><td>versteckt sich und andere Schadsoftware tief im System, oft mit höchsten Rechten</td></tr>
    <tr><td>Bot / Botnetz</td><td>ferngesteuerter Rechner; viele davon zusammen versenden Spam oder führen DDoS-Angriffe aus</td></tr>
  </tbody>
</table>
<p>Typische Wege ins Netz: E-Mail-Anhänge und Links, Office-Makros, präparierte Websites (Drive-by-Download), USB-Sticks, ungepatchte Dienste mit Internetzugang
und gestohlene Zugangsdaten für VPN oder Remote-Desktop.</p>

<h6>Social Engineering</h6>
<p>Angreifer nutzen Hilfsbereitschaft, Respekt vor Autorität, Neugier, Angst und Zeitdruck. Technik schützt dagegen nur begrenzt – geschulte Menschen schon.</p>
<ul>
  <li><strong>Phishing</strong>: massenhaft verschickte Mails mit gefälschten Login-Seiten. <strong>Spear-Phishing</strong>: gezielt auf eine Person zugeschnitten, mit echten Details.</li>
  <li><strong>CEO-Fraud</strong>: Eine Mail „vom Chef“ verlangt eine eilige, vertrauliche Überweisung.</li>
  <li><strong>Vishing</strong> (Telefon), <strong>Smishing</strong> (SMS), <strong>Quishing</strong> (QR-Code auf Brief oder Plakat).</li>
  <li><strong>Pretexting</strong>: eine erfundene Rolle, etwa „IT-Support, ich brauche kurz Ihr Passwort“.</li>
  <li><strong>Tailgating</strong>: hinter einem Berechtigten durch die Sicherheitstür schlüpfen. <strong>Baiting</strong>: absichtlich liegen gelassene USB-Sticks.</li>
</ul>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf4/phishing.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Erfundene Phishing-Mail einer fiktiven Bank mit fünf markierten Warnzeichen: fremde Absender-Domain, Zeitdruck, unpersönliche Anrede, abweichendes Link-Ziel, unerwarteter Anhang">
  <figcaption class="figure-caption">Fünf Warnzeichen – schon eins reicht für Misstrauen</figcaption>
</figure>
<div class="lf-merke"><strong>Merke:</strong> Wer auf einen Phishing-Link geklickt oder Daten eingegeben hat, meldet das <strong>sofort</strong> der IT – ohne Angst vor Ärger.
Jede Minute zählt: Passwort ändern, Sitzungen beenden, Konto prüfen. Eine Kultur, in der Fehler verschwiegen werden, ist das größere Risiko.</div>

<h6>Angriffe auf Passwörter und Anwendungen</h6>
<ul>
  <li><strong>Brute Force</strong>: alle Kombinationen durchprobieren. <strong>Wörterbuchangriff</strong>: Listen häufiger Passwörter und Varianten („Sommer2025!“).</li>
  <li><strong>Credential Stuffing</strong>: Zugangsdaten aus einem Datenleck bei anderen Diensten ausprobieren – funktioniert, weil Passwörter mehrfach genutzt werden.</li>
  <li><strong>Password Spraying</strong>: ein häufiges Passwort gegen viele Konten, um Sperren nach Fehlversuchen zu umgehen.</li>
  <li><strong>Webanwendungen</strong>: SQL-Injection, Cross-Site-Scripting und CSRF (Gegenmaßnahmen in <a href="/Learningfields/LF10/kapitel7.php">LF10 Kapitel 7</a>);
    die häufigsten Lücken listet die <em>OWASP Top 10</em>.</li>
  <li><strong>Zero-Day</strong>: Lücke, für die es noch kein Update gibt. Hier helfen nur Schutzschichten, Überwachung und schnelle Reaktion.</li>
</ul>
<p>Nicht jede Gefahr ist ein Angriff: Bedienfehler, Hardwaredefekte, Stromausfall, Feuer und Wasser gehören genauso in die Betrachtung – ebenso Innentäter.</p>

<h6>Risiken bewerten</h6>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf4/risikomatrix.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Vier-mal-vier-Risikomatrix aus Eintrittswahrscheinlichkeit und Schadenshöhe mit vier eingetragenen Beispielrisiken">
  <figcaption class="figure-caption">Wahrscheinlichkeit und Schadenshöhe ergeben die Risikostufe</figcaption>
</figure>
<p>Bewertet wird das Risiko <em>nach</em> den bereits vorhandenen Maßnahmen. Der Festplattendefekt ist nur deshalb mittel, weil ein RAID existiert;
ohne es wäre der Schaden beträchtlich.</p>

<h6>Risiken behandeln</h6>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th>Strategie</th><th>Bedeutung</th><th>Beispiel</th></tr></thead>
  <tbody>
    <tr><td>vermeiden</td><td>die riskante Tätigkeit aufgeben</td><td>keine Kundendaten mehr auf privaten Geräten</td></tr>
    <tr><td>vermindern</td><td>Wahrscheinlichkeit oder Schaden durch Maßnahmen senken</td><td>Schulung, Updates, Offline-Backup</td></tr>
    <tr><td>übertragen</td><td>die finanziellen Folgen auf Dritte verlagern</td><td>Cyberversicherung, Dienstleister mit Haftung – die Verantwortung bleibt aber im Unternehmen</td></tr>
    <tr><td>akzeptieren</td><td>bewusst tragen, weil Maßnahmen teurer wären als der mögliche Schaden</td><td>kurzer Ausfall des Infobildschirms im Foyer</td></tr>
  </tbody>
</table>
<p>Was nach allen Maßnahmen übrig bleibt, ist das <strong>Restrisiko</strong>. Die Geschäftsleitung muss es kennen und schriftlich akzeptieren.</p>

<h6>Übungen mit Lösung</h6>
<p>1. Eine Schadsoftware verbreitet sich in einer Nacht über eine Lücke im Dateifreigabedienst auf 200 Rechner, ohne dass jemand etwas anklickt. Welche Art ist das?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Ein Wurm – er verbreitet sich selbstständig über das Netz. Gegenmaßnahmen: Updates, Segmentierung, Dateifreigaben nur wo nötig.</p>
</details>
<p>2. Die Buchhaltung erhält eine Mail der Geschäftsführerin: „Bitte heute noch 48.000 € an diesen neuen Lieferanten überweisen, vertraulich, ich bin im Meeting nicht erreichbar.“ Wie reagierst du?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Verdacht auf CEO-Fraud: Zeitdruck, Geheimhaltung, ungewöhnlicher Empfänger. Nicht überweisen, sondern über einen bekannten Kanal (Telefonnummer aus dem Verzeichnis,
nicht aus der Mail) rückfragen und die IT bzw. den ISB informieren. Sinnvoll ist eine feste Regel: neue Bankverbindungen immer per Rückruf bestätigen.</p>
</details>
<p>3. Ein Unternehmen schließt eine Cyberversicherung ab und verzichtet dafür auf Backups. Bewerte das.</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Falsch. Die Versicherung überträgt nur einen Teil der finanziellen Folgen; Daten und Kunden bringt sie nicht zurück. Zudem verlangen Versicherer in der Regel
selbst Mindestmaßnahmen wie Backups und zahlen sonst nicht. Übertragen ersetzt das Vermindern nicht.</p>
</details>
INHALT,
    'summary' => [
        'Virus braucht einen Wirt, Wurm verbreitet sich selbst, Trojaner tarnt sich, Ransomware verschlüsselt und erpresst.',
        'Social Engineering nutzt Vertrauen, Autorität und Zeitdruck: Phishing, Spear-Phishing, CEO-Fraud, Vishing, Tailgating.',
        'Passwortangriffe: Brute Force, Wörterbuch, Credential Stuffing, Password Spraying.',
        'Risiko = Eintrittswahrscheinlichkeit × Schadenshöhe, bewertet nach den vorhandenen Maßnahmen.',
        'Risikobehandlung: vermeiden, vermindern, übertragen, akzeptieren; das Restrisiko trägt die Leitung.',
    ],
    'quiz' => [
        ['question' => 'Was unterscheidet einen Wurm von einem Virus?', 'answer' => 'Ein Wurm verbreitet sich selbstständig über das Netz; ein Virus braucht eine Wirtsdatei, die ausgeführt wird.'],
        ['question' => 'Was ist Spear-Phishing?', 'answer' => 'Ein gezielter Phishing-Angriff auf eine bestimmte Person, mit echten Details aus ihrem Umfeld.'],
        ['question' => 'Was ist Credential Stuffing?', 'answer' => 'Das Ausprobieren geleakter Zugangsdaten bei anderen Diensten.'],
        ['question' => 'Welche vier Strategien der Risikobehandlung gibt es?', 'answer' => 'Vermeiden, vermindern, übertragen, akzeptieren.'],
    ],
];
