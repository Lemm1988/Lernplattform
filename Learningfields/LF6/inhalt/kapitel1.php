<?php
return [
    'title' => 'IT-Service-Management: Services, Kunden, Service Desk',
    'intro' => 'Für Anwender zählt nicht, welcher Server läuft, sondern ob sie arbeiten können. IT-Service-Management richtet die IT an diesem Nutzen aus – mit klaren Abläufen statt Zuruf.',
    'goals' => [
        'die Begriffe IT-Service, Kunde, Anwender und Servicekatalog erklären',
        'Ziele und Rahmenwerke des IT-Service-Managements (ITIL, FitSM, ISO/IEC 20000) einordnen',
        'Aufgaben und Organisationsformen des Service Desks beschreiben',
        'Kanäle für Serviceanfragen vergleichen',
    ],
    'content' => <<<'INHALT'
<h6>Was ist ein IT-Service?</h6>
<p>Ein <strong>IT-Service</strong> ist eine Leistung der IT, die einem Kunden einen Nutzen bringt, ohne dass er sich um die Technik dahinter kümmern muss –
etwa „E-Mail und Kalender“, „Arbeitsplatz-PC bereitstellen“ oder „Warenwirtschaft betreiben“. Hinter einem Service stecken Hardware, Software, Netze, Menschen und Abläufe.</p>
<ul>
  <li><strong>Kunde</strong>: vereinbart den Service und bezahlt ihn, z. B. die Abteilungsleitung oder ein externer Auftraggeber.</li>
  <li><strong>Anwender</strong> (User): nutzt den Service im Alltag. Kunde und Anwender sind oft verschiedene Personen mit verschiedenen Erwartungen.</li>
  <li><strong>Servicekatalog</strong>: Liste der angebotenen Services mit Beschreibung, Zielgruppe, Qualität und Bestellweg.</li>
</ul>

<h6>IT-Service-Management (ITSM)</h6>
<p>ITSM steuert die IT wie einen Dienstleister: Services planen, liefern, unterstützen und verbessern – mit festgelegten Prozessen, Rollen und Kennzahlen.
Ziele sind verlässliche Qualität, planbare Kosten und zufriedene Kunden. Bekannte Rahmenwerke:</p>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th>Rahmenwerk</th><th>Merkmale</th></tr></thead>
  <tbody>
    <tr><td>ITIL 4</td><td>weltweit verbreitete Sammlung bewährter Praktiken (Best Practices), z. B. Incident Management, Problem Management, Change Enablement, Service Desk; Zertifizierung von Personen</td></tr>
    <tr><td>FitSM</td><td>schlanker, frei verfügbarer Standard mit klaren Begriffen und Mindestanforderungen an 14 Prozesse – gut für kleinere Organisationen</td></tr>
    <tr><td>ISO/IEC 20000</td><td>internationale Norm für ein Service-Management-System; Organisationen können sich zertifizieren lassen</td></tr>
  </tbody>
</table>
<p>Alle drei verwenden ähnliche Begriffe. Die folgenden Kapitel nutzen die gängigen Bezeichnungen aus ITIL und FitSM.</p>

<h6>Der Service Desk</h6>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf6/service-desk.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Telefon, E-Mail, Portal und Chat führen zum Service Desk als Single Point of Contact, der an Fachteams und Hersteller weiterleitet">
  <figcaption class="figure-caption">Ein Eingang für alle Anliegen</figcaption>
</figure>
<p>Der Service Desk ist der <strong>Single Point of Contact</strong> (SPOC): Anwender müssen nicht wissen, wer intern zuständig ist. Er nimmt Anfragen an,
erfasst sie als <strong>Ticket</strong>, löst einfache Fälle sofort, leitet den Rest weiter, informiert über den Stand und schließt das Ticket ab.</p>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th>Organisationsform</th><th>Merkmal</th></tr></thead>
  <tbody>
    <tr><td>lokal</td><td>vor Ort am Standort, persönlicher Kontakt – teuer bei vielen Standorten</td></tr>
    <tr><td>zentral</td><td>ein Service Desk für alle Standorte – effizient, aber weiter weg</td></tr>
    <tr><td>virtuell</td><td>verteilte Mitarbeitende arbeiten mit einem gemeinsamen Ticketsystem, als wäre es ein Desk</td></tr>
    <tr><td>Follow the Sun</td><td>Desks in mehreren Zeitzonen übergeben sich die Tickets – Service rund um die Uhr ohne Nachtschicht</td></tr>
  </tbody>
</table>

<h6>Kanäle</h6>
<ul>
  <li><strong>Telefon</strong>: schnell und persönlich, gut bei dringenden Störungen; muss sofort dokumentiert werden.</li>
  <li><strong>E-Mail</strong>: schriftlich, aber oft unvollständig – Rückfragen kosten Zeit.</li>
  <li><strong>Self-Service-Portal</strong>: Formulare fragen die nötigen Angaben gleich mit ab, dazu Wissensdatenbank und Statusanzeige.</li>
  <li><strong>Chat</strong>: schnell, mehrere Gespräche parallel möglich.</li>
  <li><strong>Vor Ort</strong> und <strong>Fernwartung</strong>: wenn Hardware getauscht oder am Gerät gearbeitet werden muss (Kapitel 6).</li>
</ul>
<div class="lf-merke"><strong>Merke:</strong> Was nicht im Ticket steht, ist nicht passiert. Auch der schnelle Anruf „nur mal kurz“ wird erfasst –
sonst fehlen die Daten für Kennzahlen, Problemanalyse und Abrechnung.</div>

<h6>Übungen mit Lösung</h6>
<p>1. Die Vertriebsleiterin beauftragt die IT mit einem CRM-System, die 15 Vertriebsmitarbeitenden arbeiten täglich damit. Wer ist Kunde, wer Anwender?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Kunde ist die Vertriebsleiterin (vereinbart und verantwortet den Service), Anwender sind die 15 Mitarbeitenden.</p>
</details>
<p>2. Ein Unternehmen hat Standorte in Hamburg, Mumbai und San Francisco und will Support rund um die Uhr ohne Nachtschichten. Welche Organisationsform passt?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Follow the Sun: Jeder Standort arbeitet zu seinen normalen Bürozeiten und übergibt offene Tickets an den nächsten.</p>
</details>
<p>3. Nenne zwei Vorteile eines Self-Service-Portals gegenüber E-Mail.</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Pflichtfelder sorgen für vollständige Angaben (weniger Rückfragen); Anwender finden Lösungen selbst in der Wissensdatenbank und sehen den Bearbeitungsstand.</p>
</details>
INHALT,
    'summary' => [
        'Ein IT-Service liefert Nutzen, ohne dass sich der Kunde um die Technik kümmern muss.',
        'Kunde vereinbart und bezahlt, Anwender nutzt; der Servicekatalog beschreibt das Angebot.',
        'Rahmenwerke: ITIL 4 (Best Practices), FitSM (schlank, frei), ISO/IEC 20000 (zertifizierbare Norm).',
        'Der Service Desk ist Single Point of Contact: annehmen, erfassen, lösen oder weiterleiten, informieren, schließen.',
        'Jedes Anliegen wird als Ticket dokumentiert.',
    ],
    'quiz' => [
        ['question' => 'Was bedeutet Single Point of Contact?', 'answer' => 'Der Service Desk ist die eine zentrale Anlaufstelle für alle Anliegen der Anwender.'],
        ['question' => 'Was unterscheidet Kunde und Anwender?', 'answer' => 'Der Kunde vereinbart und bezahlt den Service, der Anwender nutzt ihn.'],
        ['question' => 'Was ist FitSM?', 'answer' => 'Ein schlanker, frei verfügbarer Standard für IT-Service-Management.'],
        ['question' => 'Was ist Follow the Sun?', 'answer' => 'Service Desks in mehreren Zeitzonen übergeben sich Tickets und erreichen so 24-Stunden-Support ohne Nachtschicht.'],
    ],
];
