<?php
return [
    'title' => 'Technische und organisatorische Maßnahmen',
    'intro' => 'Aus Schutzbedarf und Risiken folgen Maßnahmen. Manche sind Technik, viele sind Regeln und Gewohnheiten. Dieses Kapitel ordnet sie und zeigt, worauf es bei Anmeldung, Passwörtern und Rechten ankommt.',
    'goals' => [
        'technische, organisatorische, personelle und infrastrukturelle Maßnahmen unterscheiden',
        'Zutritts-, Zugangs- und Zugriffskontrolle sicher auseinanderhalten',
        'Authentifizierungsfaktoren und Mehr-Faktor-Authentifizierung erklären',
        'die Stärke von Passwörtern berechnen und eine Passwortrichtlinie bewerten',
        'Berechtigungen nach Least Privilege und Funktionstrennung vergeben',
    ],
    'content' => <<<'INHALT'
<h6>Arten von Maßnahmen</h6>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th>Art</th><th>Beispiele</th></tr></thead>
  <tbody>
    <tr><td>technisch</td><td>Firewall, Virenschutz/EDR, Updates, Verschlüsselung (Festplatte, TLS), Backups, MFA, Protokollierung</td></tr>
    <tr><td>organisatorisch</td><td>Richtlinien (Passwort, Clean Desk, Clear Screen, private Geräte), Rechtekonzept, Notfallplan, Entsorgungsregeln, Besucherregelung</td></tr>
    <tr><td>personell</td><td>Schulungen und Awareness, Verpflichtung auf Vertraulichkeit, geregelter Ein- und Austritt, Vertretungen</td></tr>
    <tr><td>infrastrukturell</td><td>abschließbarer Serverraum, Brandmelder, Klimatisierung, USV, keine Wasserleitungen über dem Serverschrank</td></tr>
  </tbody>
</table>
<p>Die DSGVO verlangt in Art. 32 <strong>technische und organisatorische Maßnahmen</strong> (TOM), die dem Risiko angemessen sind – ausdrücklich genannt werden
Pseudonymisierung, Verschlüsselung, die dauerhafte Sicherstellung von Vertraulichkeit, Integrität, Verfügbarkeit und Belastbarkeit, die rasche Wiederherstellung
nach einem Zwischenfall und die regelmäßige Überprüfung der Maßnahmen.</p>

<h6>Die klassischen Kontrollarten</h6>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf4/zutritt-zugang-zugriff.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Drei verschachtelte Schichten: Zutritt zu Gebäude und Raum, Zugang zum IT-System, Zugriff auf die Daten, jeweils mit Beispielmaßnahmen">
  <figcaption class="figure-caption">Zutritt zum Raum, Zugang zum System, Zugriff auf die Daten</figcaption>
</figure>
<p>Diese Einteilung stammt aus dem alten Bundesdatenschutzgesetz und wird in Prüfungen weiter gern verwendet. Neben den drei Schichten im Bild gibt es:</p>
<ul>
  <li><strong>Weitergabekontrolle</strong>: Daten bei Übertragung und Transport schützen – TLS, VPN, verschlüsselte USB-Sticks.</li>
  <li><strong>Eingabekontrolle</strong>: nachvollziehen, wer wann welche Daten eingegeben oder geändert hat – Protokollierung.</li>
  <li><strong>Auftragskontrolle</strong>: Dienstleister verarbeiten Daten nur nach Weisung – Auftragsverarbeitungsvertrag.</li>
  <li><strong>Verfügbarkeitskontrolle</strong>: Schutz vor Verlust – Backup, USV, Brandschutz.</li>
  <li><strong>Trennungsgebot</strong>: Daten für verschiedene Zwecke getrennt verarbeiten – getrennte Datenbanken oder Mandanten, Test ohne Echtdaten.</li>
</ul>

<h6>Anmelden: wer bist du?</h6>
<p>Drei Schritte werden oft vermischt: <strong>Identifikation</strong> (ich behaupte, wer ich bin – Benutzername), <strong>Authentifizierung</strong> (ich beweise es – Passwort, Token)
und <strong>Autorisierung</strong> (das System entscheidet, was ich darf – Rechte).</p>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf4/authentifizierung.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Drei Faktorarten Wissen, Besitz, Sein; Beispiele für gültige und ungültige Zwei-Faktor-Kombinationen; Passkeys">
  <figcaption class="figure-caption">Echte MFA kombiniert verschiedene Faktorarten</figcaption>
</figure>

<h6>Wie stark ist ein Passwort?</h6>
<p>Bei zufällig gewählten Zeichen gilt: <strong>Anzahl Kombinationen = Zeichenvorrat<sup>Länge</sup></strong>. Die Zeiten gelten für einen Offline-Angriff mit
10 Milliarden Versuchen pro Sekunde auf einen schnellen Hash – mit langsamen Verfahren wie bcrypt dauert es um Größenordnungen länger.</p>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th>Passwort</th><th>Zeichenvorrat</th><th>Kombinationen</th><th>alle durchprobieren</th></tr></thead>
  <tbody>
    <tr><td>8 Zeichen: a–z, A–Z, 0–9</td><td>62</td><td>2,2 · 10<sup>14</sup></td><td>ca. 6 Stunden</td></tr>
    <tr><td>8 Zeichen: alle 94 druckbaren</td><td>94</td><td>6,1 · 10<sup>15</sup></td><td>ca. 7 Tage</td></tr>
    <tr><td>12 Zeichen: nur a–z</td><td>26</td><td>9,5 · 10<sup>16</sup></td><td>ca. 110 Tage</td></tr>
    <tr><td>12 Zeichen: a–z, A–Z, 0–9</td><td>62</td><td>3,2 · 10<sup>21</sup></td><td>ca. 10.000 Jahre</td></tr>
  </tbody>
</table>
<p>Länge schlägt Komplexität. Das gilt aber nur für <em>zufällige</em> Zeichen: „Passwort2025!“ steht in jeder Angriffsliste. Lange Passphrasen aus mehreren zufälligen Wörtern
sind stark und merkbar. Aktuelle Empfehlungen des BSI:</p>
<ul>
  <li>lange Passwörter oder Passphrasen; ein Passwortmanager erzeugt und speichert sie</li>
  <li>für jeden Dienst ein eigenes Passwort (sonst Credential Stuffing)</li>
  <li>kein regelmäßiger Zwangswechsel ohne Anlass – aber sofortiger Wechsel bei Verdacht auf Kompromittierung</li>
  <li>wo möglich MFA oder Passkeys</li>
</ul>
<p>Server speichern Passwörter nie im Klartext, sondern als gesalzenen, absichtlich langsamen Hash (Kapitel 7).</p>

<h6>Rechte vergeben</h6>
<ul>
  <li><strong>Least Privilege</strong> und <strong>Need-to-know</strong>: nur die Rechte, die für die Aufgabe nötig sind.</li>
  <li><strong>Rollenbasierte Rechte</strong> (RBAC): Rechte hängen an Rollen wie „Buchhaltung“, Personen bekommen Rollen. Das bleibt übersichtlich und prüfbar.</li>
  <li><strong>Funktionstrennung</strong> und <strong>Vier-Augen-Prinzip</strong>: Wer eine Zahlung anlegt, gibt sie nicht selbst frei.</li>
  <li><strong>Getrennte Admin-Konten</strong>: Im Alltag mit normalem Konto arbeiten, Adminrechte nur bei Bedarf.</li>
  <li><strong>Regelmäßig prüfen</strong> (Rezertifizierung) und beim <strong>Austritt</strong> sofort sperren – auch Cloud-Konten und VPN.</li>
</ul>

<h6>Übungen mit Lösung</h6>
<p>1. Ordne zu: (a) Chipkartenleser an der Serverraumtür, (b) Bildschirmsperre nach 5 Minuten, (c) Nur die Personalabteilung darf Gehälter sehen, (d) Protokoll, wer Kundenadressen geändert hat.</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">(a) Zutrittskontrolle. (b) Zugangskontrolle. (c) Zugriffskontrolle. (d) Eingabekontrolle.</p>
</details>
<p>2. Eine Bankkarten-PIN hat nur 4 Ziffern. Wie viele Kombinationen sind das, und warum ist das trotzdem vertretbar?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">10<sup>4</sup> = 10.000 Kombinationen. Vertretbar, weil die PIN nur zusammen mit der Karte (Besitz) funktioniert und die Karte nach drei Fehlversuchen gesperrt wird –
ein Angreifer kann nicht offline beliebig oft raten.</p>
</details>
<p>3. Ein Login verlangt Passwort und danach die Antwort auf „Name Ihres ersten Haustiers“. Ist das Zwei-Faktor-Authentifizierung?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Nein. Beides ist Wissen, also nur ein Faktor – und die Antwort lässt sich oft aus sozialen Netzwerken herausfinden. Besser: Code aus einer Authenticator-App oder ein Passkey.</p>
</details>
<p>4. Ein Mitarbeiter wechselt vom Vertrieb in die Buchhaltung und behält seine alten Rechte. Welches Prinzip ist verletzt, und wie verhindert man das?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Least Privilege (Rechte sammeln sich an). Abhilfe: rollenbasierte Rechte, die beim Abteilungswechsel getauscht statt ergänzt werden, und regelmäßige Rezertifizierung.</p>
</details>
INHALT,
    'summary' => [
        'Maßnahmen sind technisch, organisatorisch, personell oder infrastrukturell; die DSGVO verlangt angemessene TOM (Art. 32).',
        'Zutritt = Raum, Zugang = System, Zugriff = Daten; dazu Weitergabe-, Eingabe-, Auftrags-, Verfügbarkeitskontrolle und Trennungsgebot.',
        'Authentifizierungsfaktoren: Wissen, Besitz, Sein; MFA braucht mindestens zwei verschiedene Arten.',
        'Kombinationen = Zeichenvorrat^Länge; Länge schlägt Komplexität, eigenes Passwort je Dienst, Passwortmanager.',
        'Rechte nach Least Privilege, RBAC, Funktionstrennung; regelmäßig prüfen, beim Austritt sofort sperren.',
    ],
    'quiz' => [
        ['question' => 'Was regelt die Zugangskontrolle?', 'answer' => 'Wer ein IT-System benutzen darf – z. B. durch Anmeldung, MFA und Bildschirmsperre.'],
        ['question' => 'Welche drei Faktorarten gibt es bei der Authentifizierung?', 'answer' => 'Wissen, Besitz und Sein (Biometrie).'],
        ['question' => 'Wie viele Kombinationen hat ein zufälliges Passwort aus 8 Zeichen mit 62 möglichen Zeichen?', 'answer' => '62^8 ≈ 2,2 · 10^14.'],
        ['question' => 'Was bedeutet das Vier-Augen-Prinzip?', 'answer' => 'Kritische Vorgänge wie Zahlungen müssen von einer zweiten Person freigegeben werden.'],
    ],
];
