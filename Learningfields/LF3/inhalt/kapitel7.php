<?php
return [
    'title' => 'Clients einbinden: Domäne, Freigaben, Berechtigungen, Drucker',
    'intro' => 'Ein neuer Arbeitsplatz ist erst fertig, wenn sich die Person anmelden kann, ihre Laufwerke sieht, drucken kann und nur das darf, was sie soll. Dafür sorgen Domäne, Freigaben und ein durchdachtes Berechtigungskonzept.',
    'goals' => [
        'Arbeitsgruppe und Domäne vergleichen',
        'Aufbau und Aufgaben des Active Directory beschreiben',
        'Netzwerkfreigaben über UNC-Pfade und Netzlaufwerke nutzen',
        'wirksame Berechtigungen aus Freigabe- und NTFS-Rechten bestimmen',
        'Rechte nach AGDLP vergeben und Netzwerkdrucker einbinden',
    ],
    'content' => <<<'INHALT'
<h6>Arbeitsgruppe oder Domäne</h6>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf3/arbeitsgruppe-domaene.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Links drei PCs mit eigenen lokalen Konten; rechts drei PCs, die sich über einen Domänencontroller mit Active Directory anmelden">
  <figcaption class="figure-caption">Lokale Konten oder zentrale Verwaltung</figcaption>
</figure>
<p>Das <strong>Active Directory</strong> (AD) ist der Verzeichnisdienst von Windows Server. Es enthält Benutzer, Gruppen, Computer und Drucker, sortiert in
<strong>Organisationseinheiten</strong> (OUs, z. B. nach Abteilung oder Standort). Über <strong>Gruppenrichtlinien</strong> (GPOs) werden Einstellungen zentral verteilt:
Netzlaufwerke, Drucker, Passwortregeln, Bildschirmsperre, Software. Für Cloud-Dienste gibt es mit Microsoft Entra ID (früher Azure AD) eine Cloud-Variante; viele
Unternehmen betreiben beide gekoppelt.</p>
<p><strong>Einen PC in die Domäne aufnehmen</strong>: Der Client muss den Domänencontroller per DNS finden – als DNS-Server ist also der interne Server eingetragen,
nicht der Router oder ein öffentlicher DNS. Dann wird der PC mit einem berechtigten Konto der Domäne hinzugefügt und neu gestartet. Auch die Uhrzeit muss stimmen:
Die Kerberos-Anmeldung scheitert bei zu großer Zeitabweichung.</p>

<h6>Freigaben und Netzlaufwerke</h6>
<ul>
  <li>Windows-Freigaben nutzen das Protokoll <strong>SMB</strong> (Port 445).</li>
  <li>Angesprochen werden sie über einen <strong>UNC-Pfad</strong>: <code>\\server\freigabe\ordner</code>, z. B. <code>\\fs01\projekte</code>.</li>
  <li>Ein <strong>Netzlaufwerk</strong> bindet eine Freigabe unter einem Buchstaben ein – per Explorer, per Befehl <code>net use P: \\fs01\projekte</code> oder für alle per GPO.</li>
  <li>Freigaben, deren Name mit <code>$</code> endet, sind versteckt (z. B. die administrativen Freigaben <code>C$</code> und <code>ADMIN$</code>).</li>
</ul>

<h6>Wer darf was?</h6>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf3/berechtigungen.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Zugriff über das Netz durchläuft Freigabe- und NTFS-Berechtigung, die restriktivere gilt; lokaler Zugriff nur NTFS">
  <figcaption class="figure-caption">Zwei Filter – der engere gewinnt</figcaption>
</figure>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th></th><th>Freigabeberechtigung</th><th>NTFS-Berechtigung</th></tr></thead>
  <tbody>
    <tr><td>gilt für</td><td>Zugriff über das Netz</td><td>jeden Zugriff, lokal und über das Netz</td></tr>
    <tr><td>Stufen</td><td>Lesen, Ändern, Vollzugriff</td><td>u. a. Lesen, Lesen und Ausführen, Schreiben, Ändern, Vollzugriff</td></tr>
    <tr><td>Granularität</td><td>nur für die ganze Freigabe</td><td>für jeden Ordner und jede Datei, mit Vererbung</td></tr>
  </tbody>
</table>
<p>In der Praxis setzt man die Freigabe großzügig (z. B. „Authentifizierte Benutzer: Ändern“) und steuert die Details über NTFS – sonst muss man zwei Stellen pflegen.</p>

<h6>AGDLP: Rechte über Gruppen</h6>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf3/agdlp.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Benutzerkonten in einer globalen Gruppe nach Rolle, diese in einer domänenlokalen Gruppe nach Ressource, die die Berechtigung erhält">
  <figcaption class="figure-caption">Accounts → Global → Domain Local → Permission</figcaption>
</figure>

<h6>Drucker</h6>
<ul>
  <li><strong>Direkt per IP</strong>: Jeder Client spricht den Drucker selbst an – einfach, aber Treiber und Einstellungen auf jedem PC.</li>
  <li><strong>Über einen Druckserver</strong>: Treiber, Warteschlangen und Rechte zentral; Verteilung an die Clients per GPO. Im Unternehmen der Normalfall.</li>
  <li>Drucker brauchen eine feste Adresse (statisch oder DHCP-Reservierung) und sollten ein Firmware-Update-Konzept haben – sie sind vollwertige Netzwerkgeräte.</li>
</ul>

<h6>Übungen mit Lösung</h6>
<p>1. Anna ist in den Gruppen „Vertrieb“ (NTFS: Lesen) und „Projektteam“ (NTFS: Ändern) auf den Ordner <code>Angebote</code>. Die Freigabe erlaubt „Jeder: Lesen“.
Was darf sie über das Netz, was lokal am Server?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">NTFS-Rechte addieren sich: Ändern. Über das Netz gilt die restriktivere von Freigabe (Lesen) und NTFS (Ändern) → <strong>Lesen</strong>.
Lokal gilt nur NTFS → <strong>Ändern</strong>.</p>
</details>
<p>2. Zusätzlich ist Anna in der Gruppe „Praktikanten“, der auf <code>Angebote</code> „Schreiben: Verweigern“ zugewiesen ist. Was ändert sich?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Ein ausdrückliches Verweigern hat Vorrang vor Zulassen. Anna kann auch lokal nicht mehr schreiben, nur noch lesen.</p>
</details>
<p>3. Ein neuer PC lässt sich nicht in die Domäne aufnehmen: „Domäne nicht gefunden“. Was prüfst du zuerst?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Den DNS-Server in <code>ipconfig /all</code>: Er muss auf den internen DNS bzw. Domänencontroller zeigen, nicht auf den Router oder einen öffentlichen DNS.
Danach Netzverbindung zum Domänencontroller und die Uhrzeit prüfen.</p>
</details>
INHALT,
    'summary' => [
        'Arbeitsgruppe: lokale Konten je PC; Domäne: zentrale Verwaltung im Active Directory mit OUs und Gruppenrichtlinien.',
        'Domänenbeitritt braucht den internen DNS-Server und eine passende Uhrzeit.',
        'Freigaben per SMB, UNC-Pfad \\\\server\\freigabe, Netzlaufwerk per net use oder GPO.',
        'Über das Netz gilt die restriktivere von Freigabe- und NTFS-Berechtigung; NTFS-Rechte addieren sich, Verweigern hat Vorrang.',
        'AGDLP: Accounts in globale Gruppen, diese in domänenlokale Gruppen, die die Berechtigung erhalten.',
    ],
    'quiz' => [
        ['question' => 'Was ist ein UNC-Pfad?', 'answer' => 'Die Schreibweise für Netzwerkpfade: \\\\server\\freigabe\\ordner.'],
        ['question' => 'Welche Berechtigung gilt beim Zugriff über das Netz?', 'answer' => 'Die restriktivere aus Freigabe- und NTFS-Berechtigung.'],
        ['question' => 'Wofür steht AGDLP?', 'answer' => 'Accounts → Global groups → Domain Local groups → Permissions.'],
        ['question' => 'Was sind Gruppenrichtlinien?', 'answer' => 'Zentral im Active Directory festgelegte Einstellungen, die an Benutzer und Computer verteilt werden.'],
    ],
];
