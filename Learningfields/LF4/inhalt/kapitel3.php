<?php
return [
    'title' => 'IT-Grundschutz und Sicherheitsmanagement',
    'intro' => 'Niemand muss Informationssicherheit neu erfinden. Das BSI liefert mit dem IT-Grundschutz eine erprobte Methode und einen Katalog typischer Gefährdungen und Anforderungen – kostenlos und in der Prüfung gern gefragt.',
    'goals' => [
        'Aufgabe und Kreislauf eines ISMS (PDCA) beschreiben',
        'die BSI-Standards 200-1 bis 200-4 zuordnen',
        'die Schritte der Standard-Absicherung nach IT-Grundschutz erklären',
        'Aufbau und Schichten des IT-Grundschutz-Kompendiums kennen',
        'Wiederanlaufzeit (RTO) und tolerierbaren Datenverlust (RPO) berechnen',
    ],
    'content' => <<<'INHALT'
<h6>Das ISMS</h6>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf4/pdca.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="PDCA-Kreislauf Plan, Do, Check, Act um das ISMS; daneben Normen ISO/IEC 27001 und BSI-Standard 200-1">
  <figcaption class="figure-caption">Ein ISMS plant, setzt um, prüft und verbessert – immer wieder</figcaption>
</figure>
<p>Am Anfang steht die <strong>Leitlinie zur Informationssicherheit</strong>: ein kurzes Dokument der Geschäftsleitung mit Zielen, Geltungsbereich und Zuständigkeiten.
Daraus entsteht das <strong>Sicherheitskonzept</strong> mit den konkreten Maßnahmen.</p>

<h6>Die BSI-Standards</h6>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th>Standard</th><th>Inhalt</th></tr></thead>
  <tbody>
    <tr><td>200-1</td><td>Anforderungen an ein Managementsystem für Informationssicherheit (ISMS), kompatibel zu ISO/IEC 27001</td></tr>
    <tr><td>200-2</td><td>IT-Grundschutz-Methodik: wie man vorgeht – Basis-, Kern- oder Standard-Absicherung</td></tr>
    <tr><td>200-3</td><td>Risikoanalyse auf der Basis von IT-Grundschutz</td></tr>
    <tr><td>200-4</td><td>Business Continuity Management: Notfallvorsorge und Wiederanlauf</td></tr>
  </tbody>
</table>
<p>Dazu kommt das <strong>IT-Grundschutz-Kompendium</strong> mit den Bausteinen. Wer nachweisen will, dass er so arbeitet, kann sich nach
<em>ISO 27001 auf Basis von IT-Grundschutz</em> zertifizieren lassen.</p>

<h6>Vorgehen: Standard-Absicherung</h6>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf4/grundschutz-vorgehen.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Acht Schritte: Initiierung, Strukturanalyse, Schutzbedarfsfeststellung, Modellierung, IT-Grundschutz-Check, Risikoanalyse, Umsetzung, Aufrechterhaltung">
  <figcaption class="figure-caption">Von der Leitlinie bis zur laufenden Verbesserung</figcaption>
</figure>
<ul>
  <li>Die <strong>Strukturanalyse</strong> erfasst den <em>Informationsverbund</em>: Geschäftsprozesse, Anwendungen, IT-Systeme, Räume, Netze – meist mit einem bereinigten Netzplan.
    Gleichartige Objekte werden zu Gruppen zusammengefasst (z. B. „40 Büro-PCs mit gleicher Ausstattung“).</li>
  <li>Bei der <strong>Modellierung</strong> wird jedem Zielobjekt der passende Baustein zugeordnet: dem Webserver <em>APP.3.2 Webserver</em>, den Büro-PCs
    <em>SYS.2.1 Allgemeiner Client</em>, dem Serverraum <em>INF.2 Rechenzentrum sowie Serverraum</em>.</li>
  <li>Der <strong>IT-Grundschutz-Check</strong> vergleicht Soll und Ist. Was fehlt, landet im Umsetzungsplan.</li>
</ul>

<h6>Das IT-Grundschutz-Kompendium</h6>
<p>Die Bausteine sind in Schichten sortiert. Jeder Baustein beschreibt die Gefährdungslage und listet Anforderungen auf.</p>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th>Schicht</th><th>Thema</th><th>Beispiel-Baustein</th></tr></thead>
  <tbody>
    <tr><td>ISMS</td><td>Sicherheitsmanagement</td><td>ISMS.1 Sicherheitsmanagement</td></tr>
    <tr><td>ORP</td><td>Organisation und Personal</td><td>ORP.4 Identitäts- und Berechtigungsmanagement</td></tr>
    <tr><td>CON</td><td>Konzepte und Vorgehensweisen</td><td>CON.3 Datensicherungskonzept, CON.10 Entwicklung von Webanwendungen</td></tr>
    <tr><td>OPS</td><td>Betrieb</td><td>OPS.1.1.3 Patch- und Änderungsmanagement</td></tr>
    <tr><td>DER</td><td>Detektion und Reaktion</td><td>DER.2.1 Behandlung von Sicherheitsvorfällen</td></tr>
    <tr><td>APP</td><td>Anwendungen</td><td>APP.3.1 Webanwendungen und Webservices</td></tr>
    <tr><td>SYS</td><td>IT-Systeme</td><td>SYS.2.1 Allgemeiner Client</td></tr>
    <tr><td>IND</td><td>Industrielle IT</td><td>IND.2.1 Allgemeine ICS-Komponente (Steuerungen, LF7)</td></tr>
    <tr><td>NET</td><td>Netze und Kommunikation</td><td>NET.1.1 Netzarchitektur und -design</td></tr>
    <tr><td>INF</td><td>Infrastruktur</td><td>INF.2 Rechenzentrum sowie Serverraum</td></tr>
  </tbody>
</table>
<p>Die Anforderungen haben drei Stufen: <strong>Basis</strong> (MUSS, sofort umsetzen), <strong>Standard</strong> (SOLLTE, Stand der Technik bei normalem Schutzbedarf)
und Anforderungen bei <strong>erhöhtem Schutzbedarf</strong>. Das Kompendium nennt außerdem 47 <strong>elementare Gefährdungen</strong> von G 0.1 Feuer über
G 0.18 Fehlplanung oder fehlende Anpassung bis G 0.46 Integritätsverlust schützenswerter Informationen.</p>

<h6>Notfallvorsorge (BSI-Standard 200-4)</h6>
<p>Business Continuity Management sorgt dafür, dass kritische Prozesse auch nach einem schweren Vorfall weiterlaufen oder schnell wieder anlaufen.
Eine <strong>Business-Impact-Analyse</strong> legt je Prozess fest:</p>
<ul>
  <li><strong>RTO</strong> (Recovery Time Objective): Wie lange darf der Prozess höchstens ausfallen?</li>
  <li><strong>RPO</strong> (Recovery Point Objective): Wie viele Daten (gemessen in Zeit) dürfen höchstens verloren gehen? Daraus folgt der Abstand der Datensicherungen.</li>
</ul>
<p>Ergebnis ist ein <strong>Notfallhandbuch</strong> mit Alarmierungsplan, Ansprechpartnern und Wiederanlaufplänen – ausgedruckt, denn bei einem Totalausfall ist das Wiki nicht erreichbar.
Notfälle werden geübt, sonst funktioniert der Plan im Ernstfall nicht.</p>

<h6>Übungen mit Lösung</h6>
<p>1. Welchem BSI-Standard ordnest du zu: (a) Wie führe ich eine Risikoanalyse durch? (b) Was tun wir, wenn das Rechenzentrum abbrennt? (c) Welche Schritte hat die Standard-Absicherung?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">(a) 200-3. (b) 200-4. (c) 200-2.</p>
</details>
<p>2. Die Datenbank wird jede Nacht um 23:00 Uhr gesichert. Am nächsten Tag fällt der Server um 16:00 Uhr aus, die Wiederherstellung dauert 5 Stunden.
Wie viel Arbeit geht verloren, und reicht das bei einem RPO von 4 Stunden?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Verloren sind die Änderungen von 23:00 bis 16:00 Uhr, also 17 Stunden. Das überschreitet das RPO von 4 Stunden deutlich. Nötig sind Sicherungen mindestens alle 4 Stunden,
besser eine laufende Sicherung der Transaktionslogs oder eine Replikation. Die Wiederherstellung (5 h) muss außerdem ins RTO passen.</p>
</details>
<p>3. Für ein neues IoT-Gerät in der Produktion gibt es keinen passenden Baustein im Kompendium. Was sieht die Methodik vor?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Eine Risikoanalyse nach BSI-Standard 200-3: Gefährdungen ermitteln (z. B. aus den elementaren Gefährdungen), bewerten und passende Maßnahmen festlegen.</p>
</details>
INHALT,
    'summary' => [
        'Ein ISMS steuert Informationssicherheit dauerhaft im PDCA-Kreislauf; Grundlage ist die Leitlinie der Geschäftsleitung.',
        'BSI 200-1 ISMS, 200-2 Methodik, 200-3 Risikoanalyse, 200-4 Business Continuity Management.',
        'Standard-Absicherung: Strukturanalyse, Schutzbedarfsfeststellung, Modellierung, IT-Grundschutz-Check, ggf. Risikoanalyse, Umsetzung.',
        'Kompendium: Bausteine in Schichten (ISMS, ORP, CON, OPS, DER, APP, SYS, IND, NET, INF); Anforderungen Basis, Standard, erhöht.',
        'RTO = maximale Ausfallzeit, RPO = maximal tolerierbarer Datenverlust; Notfallhandbuch und Übungen.',
    ],
    'quiz' => [
        ['question' => 'Wofür steht PDCA?', 'answer' => 'Plan, Do, Check, Act – der Verbesserungskreislauf eines Managementsystems.'],
        ['question' => 'Welcher BSI-Standard beschreibt die IT-Grundschutz-Methodik?', 'answer' => 'BSI-Standard 200-2.'],
        ['question' => 'Was passiert bei der Modellierung?', 'answer' => 'Jedem Zielobjekt werden die passenden Bausteine des IT-Grundschutz-Kompendiums zugeordnet.'],
        ['question' => 'Was bedeutet RPO?', 'answer' => 'Recovery Point Objective – der maximal tolerierbare Datenverlust, gemessen als Zeitraum.'],
    ],
];
