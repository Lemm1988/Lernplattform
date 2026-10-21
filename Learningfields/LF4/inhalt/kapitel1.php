<?php
return [
    'title' => 'Grundbegriffe und Schutzziele',
    'intro' => 'Bevor man etwas schützen kann, muss klar sein, was geschützt werden soll und wovor. Dieses Kapitel legt die Begriffe fest, die in jeder Sicherheitsfrage der Prüfung vorkommen.',
    'goals' => [
        'Datenschutz, Datensicherheit, IT-Sicherheit und Informationssicherheit abgrenzen',
        'die Schutzziele Vertraulichkeit, Integrität und Verfügbarkeit erklären und erweitern',
        'Sicherheitsvorfälle den verletzten Schutzzielen zuordnen',
        'Bedrohung, Schwachstelle, Gefährdung und Risiko unterscheiden',
    ],
    'content' => <<<'INHALT'
<h6>Vier Begriffe, die oft verwechselt werden</h6>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th>Begriff</th><th>schützt</th><th>Beispiel</th></tr></thead>
  <tbody>
    <tr><td><strong>Datenschutz</strong></td><td>den <em>Menschen</em> vor Missbrauch seiner personenbezogenen Daten (Recht auf informationelle Selbstbestimmung)</td><td>Kundendaten nur für den vereinbarten Zweck nutzen</td></tr>
    <tr><td><strong>Datensicherheit</strong></td><td>alle <em>Daten</em> vor Verlust, Manipulation und unbefugtem Zugriff – mit technischen Mitteln</td><td>Backup, Verschlüsselung, Zugriffsrechte</td></tr>
    <tr><td><strong>IT-Sicherheit</strong></td><td><em>IT-Systeme</em> und die darauf verarbeiteten Informationen</td><td>Firewall, Virenschutz, Updates</td></tr>
    <tr><td><strong>Informationssicherheit</strong></td><td><em>Informationen in jeder Form</em> – auch auf Papier, im Gespräch, im Kopf</td><td>Aktenvernichter, Clean-Desk-Regel, Schulungen</td></tr>
  </tbody>
</table>
<p>Informationssicherheit ist der umfassendste Begriff. Datenschutz ist dagegen ein <strong>Rechtsgebiet</strong> (DSGVO, Kapitel 8): Er sagt, <em>ob</em> Daten verarbeitet werden dürfen.
Datensicherheit liefert die Mittel, damit erlaubt verarbeitete Daten auch geschützt sind.</p>

<h6>Die Schutzziele</h6>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf4/schutzziele.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Dreieck aus Vertraulichkeit, Integrität und Verfügbarkeit; daneben Authentizität, Verbindlichkeit und Zurechenbarkeit">
  <figcaption class="figure-caption">Drei Grundwerte und ihre Erweiterungen</figcaption>
</figure>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th>Schutzziel</th><th>verletzt, wenn …</th><th>typische Maßnahmen</th></tr></thead>
  <tbody>
    <tr><td>Vertraulichkeit</td><td>ein gestohlener Laptop unverschlüsselte Kundendaten enthält</td><td>Verschlüsselung, Zugriffsrechte, Clean Desk</td></tr>
    <tr><td>Integrität</td><td>ein Angreifer die Kontonummer in einer Rechnungsvorlage ändert</td><td>Rechtekonzept, Prüfsummen, Signaturen, Protokollierung</td></tr>
    <tr><td>Verfügbarkeit</td><td>der Webshop durch eine Überlastung (DDoS) oder einen Plattendefekt ausfällt</td><td>Redundanz, Backups, USV, Wartungsverträge</td></tr>
    <tr><td>Authentizität</td><td>eine E-Mail scheinbar vom Chef kommt, aber gefälscht ist</td><td>signierte E-Mails, Rückruf bei Zahlungsanweisungen</td></tr>
    <tr><td>Verbindlichkeit</td><td>ein Kunde bestreitet, eine Bestellung ausgelöst zu haben</td><td>digitale Signatur, Bestätigungsprozesse</td></tr>
  </tbody>
</table>
<div class="lf-merke"><strong>Merke:</strong> Ein Vorfall verletzt oft mehrere Schutzziele zugleich. Ransomware verschlüsselt Daten (Verfügbarkeit) –
und viele Gruppen kopieren sie vorher ab und drohen mit Veröffentlichung (Vertraulichkeit).</div>

<h6>Von der Bedrohung zum Schaden</h6>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf4/bedrohung-risiko.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Bedrohung Ransomware trifft auf die Schwachstelle fehlender Updates, daraus wird ein Sicherheitsvorfall mit Schaden; Maßnahmen beugen vor oder begrenzen">
  <figcaption class="figure-caption">Maßnahmen setzen an der Schwachstelle oder am Schaden an</figcaption>
</figure>
<ul>
  <li><strong>Bedrohung</strong>: Umstand, der Schaden anrichten <em>könnte</em> – Schadsoftware, Feuer, Bedienfehler, ein verärgerter Ex-Mitarbeiter.</li>
  <li><strong>Schwachstelle</strong>: Fehler oder Lücke, durch die eine Bedrohung wirken kann – fehlende Updates, schwache Passwörter, offener Serverraum.</li>
  <li><strong>Gefährdung</strong>: eine Bedrohung, die konkret auf eine Schwachstelle eines Objekts trifft (Begriff des BSI).</li>
  <li><strong>Risiko</strong>: Kombination aus Eintrittswahrscheinlichkeit und Schadenshöhe (Kapitel 5).</li>
  <li><strong>Sicherheitsvorfall</strong>: ein Ereignis, bei dem ein Schutzziel tatsächlich verletzt wurde.</li>
</ul>
<p>Hundertprozentige Sicherheit gibt es nicht. Ziel ist ein Sicherheitsniveau, das dem <strong>Schutzbedarf</strong> angemessen ist (Kapitel 4) –
und das sich mit Aufwand und Kosten vertreten lässt. Deshalb ist Informationssicherheit kein Projekt, sondern ein dauerhafter Prozess (Kapitel 3).</p>

<h6>Übungen mit Lösung</h6>
<p>1. Ordne zu, welches Schutzziel vor allem verletzt ist: (a) Ein Praktikant kann die Gehaltsliste öffnen. (b) Nach einem Wasserschaden ist der Server zwei Tage aus.
(c) Ein Virus verändert Zahlen in einer Kalkulationstabelle.</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">(a) Vertraulichkeit. (b) Verfügbarkeit. (c) Integrität.</p>
</details>
<p>2. Ist „Wir haben ein Virenschutzprogramm“ eine Aussage zum Datenschutz?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Nein, zur Datensicherheit bzw. IT-Sicherheit. Datenschutz fragt, ob und wofür personenbezogene Daten verarbeitet werden dürfen. Virenschutz ist eine technische Maßnahme,
die auch dem Datenschutz dient (als TOM), ihn aber nicht ersetzt.</p>
</details>
<p>3. Ein Server steht in einem Keller in einem Hochwassergebiet, aber der Keller ist seit 50 Jahren trocken. Nenne Bedrohung und Schwachstelle.</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Bedrohung: Hochwasser. Schwachstelle: der Standort im Keller ohne Schutz. Die geringe Eintrittswahrscheinlichkeit senkt das Risiko, beseitigt es aber nicht –
der mögliche Schaden (Totalausfall) ist hoch.</p>
</details>
INHALT,
    'summary' => [
        'Datenschutz schützt Menschen, Datensicherheit die Daten, Informationssicherheit Informationen in jeder Form.',
        'Grundwerte: Vertraulichkeit, Integrität, Verfügbarkeit; dazu Authentizität, Verbindlichkeit, Zurechenbarkeit.',
        'Bedrohung + Schwachstelle = Gefährdung; Risiko = Eintrittswahrscheinlichkeit × Schadenshöhe.',
        'Ziel ist ein dem Schutzbedarf angemessenes Sicherheitsniveau, das laufend überprüft wird.',
    ],
    'quiz' => [
        ['question' => 'Welche drei Grundwerte der Informationssicherheit gibt es?', 'answer' => 'Vertraulichkeit, Integrität, Verfügbarkeit.'],
        ['question' => 'Was schützt der Datenschutz?', 'answer' => 'Die Person – ihr Recht, selbst über ihre personenbezogenen Daten zu bestimmen.'],
        ['question' => 'Welches Schutzziel ist verletzt, wenn Daten unbemerkt verändert werden?', 'answer' => 'Die Integrität.'],
        ['question' => 'Was ist eine Schwachstelle?', 'answer' => 'Ein Fehler oder eine Lücke, über die eine Bedrohung wirksam werden kann, z. B. ein fehlendes Update.'],
    ],
];
