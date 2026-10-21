<?php
return [
    'title' => 'Verantwortung, Recht und Informationsquellen',
    'intro' => 'Wer ist im Betrieb für Sicherheit zuständig, welche Gesetze verlangen was, und woher erfährt man rechtzeitig von neuen Lücken? Die Antworten braucht jede Fachkraft, nicht nur die Sicherheitsabteilung.',
    'goals' => [
        'die Rollen Geschäftsleitung, ISB, DSB, IT-Betrieb und Mitarbeitende abgrenzen',
        'externe Stellen wie BSI, Aufsichtsbehörde und Polizei nennen',
        'wichtige Gesetze zur Informationssicherheit und zum Datenschutz einordnen',
        'Schwachstellenmeldungen mit CVE und CVSS lesen und bewerten',
    ],
    'content' => <<<'INHALT'
<h6>Wer ist verantwortlich?</h6>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf4/rollen.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Geschäftsleitung mit ISB und DSB darunter, IT-Betrieb und Mitarbeitende; außerhalb BSI, Datenschutz-Aufsichtsbehörde und Polizei">
  <figcaption class="figure-caption">Die Verantwortung liegt oben, die Umsetzung bei allen</figcaption>
</figure>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th>Rolle</th><th>Aufgaben</th></tr></thead>
  <tbody>
    <tr><td>Geschäftsleitung</td><td>trägt die <strong>Gesamtverantwortung</strong> und haftet; legt Sicherheitsziele fest, stellt Geld und Personal bereit. Delegieren kann sie Aufgaben, nicht die Verantwortung.</td></tr>
    <tr><td>Informationssicherheitsbeauftragte/r (ISB)</td><td>plant und steuert das Sicherheitsmanagement (ISMS, Kapitel 3), erstellt Richtlinien, berät, untersucht Vorfälle, berichtet direkt an die Leitung. In großen Unternehmen heißt die Rolle oft CISO.</td></tr>
    <tr><td>Datenschutzbeauftragte/r (DSB)</td><td>berät und überwacht die Einhaltung des Datenschutzes, schult, ist Ansprechpartner für Betroffene und Aufsichtsbehörde. <strong>Weisungsfrei</strong> und mit besonderem Kündigungsschutz.</td></tr>
    <tr><td>IT-Betrieb</td><td>setzt technische Maßnahmen um: Updates, Rechte, Backups, Überwachung.</td></tr>
    <tr><td>alle Mitarbeitenden</td><td>halten Richtlinien ein, gehen sorgsam mit Informationen um und <strong>melden</strong> Auffälligkeiten sofort – auch eigene Fehler.</td></tr>
  </tbody>
</table>
<p>Einen <strong>Datenschutzbeauftragten</strong> muss ein Unternehmen in Deutschland benennen, wenn in der Regel mindestens <strong>20 Personen</strong> ständig mit der automatisierten
Verarbeitung personenbezogener Daten beschäftigt sind (§ 38 BDSG) – oder unabhängig davon, wenn die Kerntätigkeit z. B. eine umfangreiche Verarbeitung von Gesundheitsdaten ist (Art. 37 DSGVO).
Der DSB kann intern oder extern sein. Die IT-Leitung oder die Geschäftsführung scheiden aus: Sie müssten sich selbst kontrollieren (Interessenkonflikt).</p>

<h6>Externe Stellen</h6>
<ul>
  <li><strong>BSI</strong> (Bundesamt für Sicherheit in der Informationstechnik): veröffentlicht IT-Grundschutz und Technische Richtlinien, warnt über CERT-Bund vor Schwachstellen,
    gibt jährlich einen Lagebericht heraus und nimmt Meldungen meldepflichtiger Unternehmen entgegen.</li>
  <li><strong>Datenschutz-Aufsichtsbehörden</strong> der Länder (für Bundesbehörden und Telekommunikation der BfDI): kontrollieren, beraten, verhängen Bußgelder, nehmen Meldungen von Datenpannen entgegen.</li>
  <li><strong>Polizei</strong>: Die Landeskriminalämter haben <em>Zentrale Ansprechstellen Cybercrime</em> (ZAC) für Unternehmen.</li>
</ul>

<h6>Rechtliche Grundlagen</h6>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th>Regelwerk</th><th>Kernaussage</th></tr></thead>
  <tbody>
    <tr><td>DSGVO und BDSG</td><td>Verarbeitung personenbezogener Daten; verlangt angemessene technische und organisatorische Maßnahmen (Kapitel 6 und 8)</td></tr>
    <tr><td>BSI-Gesetz</td><td>Betreiber <strong>kritischer Infrastrukturen</strong> (KRITIS: Energie, Wasser, Gesundheit, Finanzen …) müssen Sicherheit nach dem Stand der Technik umsetzen, nachweisen und erhebliche Vorfälle melden</td></tr>
    <tr><td>NIS-2-Richtlinie (EU)</td><td>weitet diese Pflichten auf deutlich mehr mittlere und große Unternehmen aus; die Geschäftsleitung muss Maßnahmen billigen, überwachen und sich schulen lassen</td></tr>
    <tr><td>Cyber Resilience Act (EU)</td><td>Hersteller von Produkten mit digitalen Elementen – auch Software – müssen Schwachstellen behandeln und Sicherheitsupdates liefern; die Pflichten greifen schrittweise ab 2026</td></tr>
    <tr><td>TDDDG</td><td>u. a. Einwilligung für nicht notwendige Cookies und vergleichbare Speicherzugriffe auf Endgeräten (früher TTDSG)</td></tr>
    <tr><td>Strafgesetzbuch</td><td>§ 202a Ausspähen von Daten, § 202b Abfangen von Daten, § 202c Vorbereiten (Hackertools), § 303a Datenveränderung, § 303b Computersabotage</td></tr>
  </tbody>
</table>
<div class="lf-merke"><strong>Merke:</strong> Auch „nur mal testen“ ist strafbar, wenn man ohne Erlaubnis Zugangssicherungen überwindet. Sicherheitstests (Penetrationstests)
gibt es nur mit schriftlichem Auftrag, der Umfang und Zeitraum festlegt.</div>

<h6>Informationsquellen: Lücken früh erfahren</h6>
<ul>
  <li><strong>Herstellerhinweise</strong> (Security Advisories) und Patchtage – Microsoft veröffentlicht Updates regulär am zweiten Dienstag im Monat.</li>
  <li><strong>CERT-Bund / BSI-Warnungen</strong>, <strong>Allianz für Cyber-Sicherheit</strong>, Fachmedien wie heise Security.</li>
  <li><strong>CVE</strong> (Common Vulnerabilities and Exposures): eindeutige Nummer je Schwachstelle, z. B. <code>CVE-2021-44228</code> für Log4Shell in der Java-Bibliothek Log4j.
    So weiß jeder sofort, welche Lücke gemeint ist.</li>
  <li><strong>CVSS</strong> (Common Vulnerability Scoring System): Schweregrad von 0,0 bis 10,0.</li>
</ul>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf4/cvss.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="CVSS-Skala: niedrig bis 3,9, mittel bis 6,9, hoch bis 8,9, kritisch ab 9,0; Log4Shell mit 10,0 markiert">
  <figcaption class="figure-caption">Der CVSS-Wert ordnet Schwachstellen nach Schweregrad</figcaption>
</figure>
<p>Für Entwicklerinnen und Entwickler heißt das: eingesetzte Bibliotheken kennen (eine Liste aller Abhängigkeiten, die <em>Software Bill of Materials</em>, SBOM)
und automatisch auf bekannte CVEs prüfen lassen, etwa mit <code>composer audit</code> oder <code>npm audit</code>.</p>

<h6>Übungen mit Lösung</h6>
<p>1. Die IT-Leiterin bietet an, zusätzlich Datenschutzbeauftragte zu werden. Was spricht dagegen?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Ein Interessenkonflikt: Sie entscheidet über die Verarbeitung und die Systeme und müsste sich als DSB selbst kontrollieren. Das ist unzulässig.</p>
</details>
<p>2. Ein Handwerksbetrieb hat 25 Beschäftigte; 21 davon arbeiten täglich am PC mit Kundendaten. Braucht er einen Datenschutzbeauftragten?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Ja. Mindestens 20 Personen sind ständig mit der automatisierten Verarbeitung personenbezogener Daten beschäftigt (§ 38 BDSG).</p>
</details>
<p>3. Für das VPN-Gateway der Firma wird eine Lücke mit CVSS 9,8 veröffentlicht, die ohne Anmeldung über das Internet ausnutzbar ist. Was tust du?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Sofort handeln: Herstellerhinweis lesen, Update bzw. empfohlene Schutzmaßnahme umgehend umsetzen, notfalls den Dienst vorübergehend abschalten.
Danach prüfen, ob die Lücke schon ausgenutzt wurde (Logs, Hinweise des Herstellers), und den ISB informieren.</p>
</details>
INHALT,
    'summary' => [
        'Die Geschäftsleitung trägt die Gesamtverantwortung; ISB steuert das ISMS, DSB überwacht den Datenschutz weisungsfrei.',
        'DSB-Pflicht ab in der Regel 20 Personen, die ständig personenbezogene Daten automatisiert verarbeiten (§ 38 BDSG).',
        'Externe Stellen: BSI (Standards, Warnungen), Datenschutz-Aufsichtsbehörden, Polizei (ZAC).',
        'Gesetze: DSGVO/BDSG, BSI-Gesetz mit KRITIS und NIS 2, Cyber Resilience Act, TDDDG, StGB §§ 202a–c, 303a/b.',
        'CVE benennt eine Schwachstelle eindeutig, CVSS bewertet ihren Schweregrad von 0 bis 10.',
    ],
    'quiz' => [
        ['question' => 'Wer trägt die Gesamtverantwortung für die Informationssicherheit?', 'answer' => 'Die Geschäftsleitung.'],
        ['question' => 'Ab wann braucht ein Unternehmen in der Regel einen Datenschutzbeauftragten?', 'answer' => 'Wenn mindestens 20 Personen ständig mit der automatisierten Verarbeitung personenbezogener Daten beschäftigt sind.'],
        ['question' => 'Wofür steht CVE?', 'answer' => 'Common Vulnerabilities and Exposures – eine eindeutige Kennung für eine bekannte Schwachstelle.'],
        ['question' => 'Ab welchem CVSS-Wert gilt eine Lücke als kritisch?', 'answer' => 'Ab 9,0.'],
    ],
];
