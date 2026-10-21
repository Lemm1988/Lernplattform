<?php
return [
    'title' => 'Beschaffen, liefern, installieren, übergeben',
    'intro' => 'Zwischen der Entscheidung für ein Angebot und dem Arbeitsplatz, an dem jemand produktiv arbeitet, liegen viele Schritte – vom Kaufvertrag über den Wareneingang bis zum Abnahmeprotokoll. Wer sie sauber durchläuft, vermeidet Ärger mit Lieferanten und Kunden.',
    'goals' => [
        'den Ablauf einer Beschaffung beschreiben',
        'das Zustandekommen und die Pflichten aus dem Kaufvertrag erklären',
        'auf Lieferverzug und mangelhafte Lieferung richtig reagieren',
        'Wareneingang, Inventarisierung und Installation planen',
        'eine Übergabe mit Einweisung und Abnahmeprotokoll durchführen',
    ],
    'content' => <<<'INHALT'
<h6>Der Ablauf</h6>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf2/beschaffung.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Zehn Schritte von Bedarf ermitteln über Bestellung, Wareneingang, Inventarisierung, Installation und Übergabe bis zur Zahlung">
  <figcaption class="figure-caption">Von der Idee bis zur bezahlten Rechnung</figcaption>
</figure>

<h6>Der Kaufvertrag</h6>
<p>Ein Vertrag kommt durch zwei übereinstimmende Willenserklärungen zustande: <strong>Antrag</strong> und <strong>Annahme</strong>. Bestellt der Kunde auf ein verbindliches Angebot hin,
ist der Vertrag geschlossen; bestellt er ohne vorheriges Angebot, ist erst die Auftragsbestätigung des Verkäufers die Annahme. Pflichten nach § 433 BGB:</p>
<ul>
  <li><strong>Verkäufer</strong>: Sache übergeben, Eigentum verschaffen, frei von Mängeln.</li>
  <li><strong>Käufer</strong>: Kaufpreis zahlen, Sache abnehmen.</li>
</ul>
<p>Die Auftragsbestätigung wird mit der Bestellung verglichen (Artikel, Menge, Preis, Liefertermin, Zahlungsbedingungen) – Abweichungen sofort klären.</p>

<h6>Wenn etwas schiefgeht</h6>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th>Störung</th><th>Was tun?</th></tr></thead>
  <tbody>
    <tr><td>Lieferverzug</td><td>Lieferant mahnen und eine angemessene Nachfrist setzen; danach Rücktritt oder Schadensersatz möglich. Ist ein fester Termin entscheidend vereinbart (Fixgeschäft), entfällt die Mahnung.</td></tr>
    <tr><td>mangelhafte Lieferung</td><td>Mängelrüge mit genauer Beschreibung (Artikel, Seriennummer, Mangel, Datum); unter Kaufleuten unverzüglich (§ 377 HGB). Rechte: zuerst Nacherfüllung, dann Rücktritt oder Minderung (<a href="/Learningfields/LF6/kapitel7.php">LF6 Kapitel 7</a>).</td></tr>
    <tr><td>Transportschaden</td><td>beim Zusteller auf dem Lieferschein vermerken lassen, fotografieren, Lieferant sofort informieren</td></tr>
    <tr><td>Zahlungsverzug (eigener)</td><td>vermeiden: Rechnung prüfen und innerhalb des Zahlungsziels bzw. der Skontofrist zahlen</td></tr>
  </tbody>
</table>

<h6>Wareneingang und Inventarisierung</h6>
<ul>
  <li>Lieferschein mit Bestellung vergleichen: Artikel, Menge, Zustand der Verpackung.</li>
  <li>Geräte auspacken, Funktion prüfen, <strong>Seriennummern</strong> erfassen.</li>
  <li><strong>Inventarnummer</strong> vergeben und im Inventar bzw. Asset-Management (CMDB, <a href="/Learningfields/LF6/kapitel3.php">LF6 Kapitel 3</a>) mit Standort, Nutzer, Kaufdatum, Garantieende und Lieferant eintragen.</li>
  <li>Garantien registrieren, Rechnungen und Lieferscheine ablegen (Aufbewahrungsfristen).</li>
</ul>

<h6>Installation</h6>
<p>Ein Rollout folgt einer <strong>Checkliste</strong>, damit jeder Arbeitsplatz gleich und vollständig eingerichtet ist:</p>
<ol>
  <li>Firmware (UEFI) und Treiber aktualisieren, Betriebssystem-Image bzw. automatische Bereitstellung aufspielen.</li>
  <li>In die Domäne aufnehmen, Gruppenrichtlinien, Netzlaufwerke und Drucker zuweisen (<a href="/Learningfields/LF3/kapitel7.php">LF3 Kapitel 7</a>).</li>
  <li>Fachsoftware installieren und lizenzieren, Laufwerksverschlüsselung aktivieren, Virenschutz prüfen.</li>
  <li>Benutzerdaten vom Altgerät übernehmen; Altgeräte sicher löschen (Kapitel 3).</li>
  <li>Testen: Anmeldung, Netzwerk, Drucken, Fachanwendung, Videokonferenz, Docking-Station.</li>
</ol>
<p>Bei der Arbeit an offenen Geräten auf ESD-Schutz achten (Erdungsarmband), schwere Geräte richtig heben und Verpackungen sortenrein entsorgen.</p>

<h6>Übergabe und Abnahme</h6>
<p>Zur Übergabe gehören eine <strong>Einweisung</strong> der Anwender (Anmeldung, Docking, Drucken, wo es Hilfe gibt), die <strong>Dokumentation</strong>
(Konfiguration, Inventarliste, Lizenzen) und das <strong>Abnahmeprotokoll</strong>. Mit der Unterschrift bestätigt der Kunde die vertragsgemäße Leistung; offene Mängel werden mit Frist festgehalten.</p>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf2/abnahmeprotokoll.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Muster-Abnahmeprotokoll mit Projekt, Auftraggeber, Auftragnehmer, geprüften Leistungen, einem Mangel mit Frist, Ergebnis abgenommen mit Mängeln und zwei Unterschriften">
  <figcaption class="figure-caption">Was abgenommen wurde, was noch offen ist, wer unterschreibt</figcaption>
</figure>
<p>Zum Abschluss lohnt eine kurze Nachbesprechung: Was lief gut, was beim nächsten Rollout anders? Diese <strong>Lessons Learned</strong> fließen in die Checkliste ein.</p>

<h6>Übungen mit Lösung</h6>
<p>1. Ein Händler schickt ein Angebot über 12 Monitore. Der Kunde bestellt 12 Monitore zu den angebotenen Bedingungen. Wann ist der Kaufvertrag geschlossen?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Mit der Bestellung: Das Angebot ist der Antrag, die Bestellung die Annahme. Eine Auftragsbestätigung ist dann nur noch eine Bestätigung.</p>
</details>
<p>2. Bei der Lieferung von 12 Notebooks fehlen zwei, eines hat ein zerkratztes Display. Was tust du?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Fehlmenge auf dem Lieferschein vermerken und beim Lieferanten anmahnen (mit Nachfrist). Für das beschädigte Gerät unverzüglich eine Mängelrüge mit Seriennummer und Fotos senden
und Nacherfüllung (Ersatz) verlangen. Alles dokumentieren.</p>
</details>
<p>3. Welche Angaben gehören in ein Abnahmeprotokoll?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Projekt, Auftraggeber und Auftragnehmer, Datum, geprüfte Leistungen mit Ergebnis, festgestellte Mängel mit Frist zur Behebung, Ergebnis der Abnahme
(abgenommen, mit Mängeln, nicht abgenommen) und die Unterschriften beider Seiten.</p>
</details>
INHALT,
    'summary' => [
        'Ablauf: Bedarf, Anfrage, Angebote, Bestellung, Auftragsbestätigung, Wareneingang, Inventarisierung, Installation, Übergabe, Zahlung.',
        'Kaufvertrag: Antrag und Annahme; Verkäufer liefert mangelfrei und verschafft Eigentum, Käufer zahlt und nimmt ab.',
        'Lieferverzug: mahnen, Nachfrist; Mangel: sofort rügen, unter Kaufleuten unverzüglich.',
        'Wareneingang prüfen, Seriennummern und Inventarnummern erfassen; Installation nach Checkliste.',
        'Übergabe mit Einweisung, Dokumentation und unterschriebenem Abnahmeprotokoll; Lessons Learned festhalten.',
    ],
    'quiz' => [
        ['question' => 'Wodurch kommt ein Kaufvertrag zustande?', 'answer' => 'Durch zwei übereinstimmende Willenserklärungen: Antrag und Annahme.'],
        ['question' => 'Was ist bei einem Lieferverzug zu tun?', 'answer' => 'Den Lieferanten mahnen und eine angemessene Nachfrist setzen; danach sind Rücktritt oder Schadensersatz möglich.'],
        ['question' => 'Wozu dient eine Inventarnummer?', 'answer' => 'Sie identifiziert ein Gerät eindeutig im Inventar bzw. Asset-Management.'],
        ['question' => 'Was bestätigt der Kunde mit dem Abnahmeprotokoll?', 'answer' => 'Dass die Leistung im Wesentlichen vertragsgemäß erbracht ist; offene Mängel werden mit Frist festgehalten.'],
    ],
];
