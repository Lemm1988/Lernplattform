<?php
return [
    'title' => 'Aufbauorganisation und Vollmachten',
    'intro' => 'Wer darf wem Anweisungen geben, und wer darf für das Unternehmen unterschreiben? Organigramm und Vollmachten regeln das – und sagen viel darüber aus, wie ein Betrieb tickt.',
    'goals' => [
        'Stelle, Instanz, Abteilung und Leitungsspanne erklären',
        'Einlinien-, Mehrlinien-, Stablinien-, Sparten- und Matrixorganisation vergleichen',
        'den eigenen Ausbildungsbetrieb als Organigramm darstellen',
        'Prokura und Handlungsvollmacht nach Umfang, Erteilung und Zeichnung unterscheiden',
    ],
    'content' => <<<'INHALT'
<h6>Bausteine der Aufbauorganisation</h6>
<ul>
  <li><strong>Stelle</strong>: kleinste organisatorische Einheit, ein Aufgabenbereich für eine Person (z. B. „Anwendungsentwickler/in Backend“). Beschrieben in der Stellenbeschreibung.</li>
  <li><strong>Instanz</strong>: Stelle mit Leitungs- und Weisungsbefugnis (Teamleitung, Abteilungsleitung).</li>
  <li><strong>Abteilung</strong>: mehrere Stellen unter einer Instanz.</li>
  <li><strong>Leitungsspanne</strong>: Zahl der direkt unterstellten Stellen. Groß = flache Hierarchie, kurze Wege; klein = viele Ebenen.</li>
</ul>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf1/organisationsformen.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Drei Organigramme: Einliniensystem mit einem Vorgesetzten je Stelle, Stabliniensystem mit beratenden Stabsstellen, Matrixorganisation mit Funktionen und Produkten als Achsen">
  <figcaption class="figure-caption">Drei häufige Organisationsformen</figcaption>
</figure>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th>Form</th><th>Merkmal</th><th>Stärke / Schwäche</th></tr></thead>
  <tbody>
    <tr><td>Einliniensystem</td><td>jede Stelle hat genau einen Vorgesetzten</td><td>klare Wege; aber lang und Leitung schnell überlastet</td></tr>
    <tr><td>Mehrliniensystem</td><td>Weisungen von mehreren Fachvorgesetzten</td><td>Fachkompetenz; aber widersprüchliche Anweisungen möglich</td></tr>
    <tr><td>Stabliniensystem</td><td>Einlinie plus beratende Stabsstellen (z. B. Datenschutz, IT-Sicherheit, Recht)</td><td>Expertise für die Leitung; Stäbe haben keine Weisungsbefugnis</td></tr>
    <tr><td>Spartenorganisation</td><td>Gliederung nach Produkten, Kundengruppen oder Regionen</td><td>kundennah, eigenverantwortlich; aber Doppelarbeit in den Sparten</td></tr>
    <tr><td>Matrixorganisation</td><td>Funktionen × Produkte oder Projekte</td><td>flexibel, gute Abstimmung; aber zwei Vorgesetzte, Konflikte</td></tr>
  </tbody>
</table>
<p>Datenschutz- und Informationssicherheitsbeauftragte sind typische Stabsstellen direkt bei der Geschäftsleitung (<a href="/Learningfields/LF4/kapitel2.php">LF4 Kapitel 2</a>).
Für Projekte gibt es eigene Formen der Projektorganisation – bis hin zur Matrix, in der Projektmitarbeitende fachlich der Projektleitung, disziplinarisch ihrer Abteilung unterstehen.</p>

<h6>Vollmachten</h6>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf1/vollmachten.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Verschachtelte Bereiche: Prokura umfasst die allgemeine Handlungsvollmacht, darin Artvollmacht und Einzelvollmacht; daneben Geschäfte, die auch Prokuristen nicht dürfen">
  <figcaption class="figure-caption">Je weiter innen, desto enger die Vollmacht</figcaption>
</figure>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th></th><th>Prokura (§§ 48–53 HGB)</th><th>Handlungsvollmacht (§ 54 HGB)</th></tr></thead>
  <tbody>
    <tr><td>Wer erteilt?</td><td>nur Kaufleute (Inhaber, gesetzliche Vertreter), ausdrücklich</td><td>Kaufleute und Prokuristen, auch stillschweigend möglich</td></tr>
    <tr><td>Handelsregister</td><td>wird eingetragen (deklaratorisch)</td><td>wird nicht eingetragen</td></tr>
    <tr><td>Umfang</td><td>alle Geschäfte, die <em>irgendein</em> Handelsgewerbe mit sich bringt</td><td>Geschäfte, die <em>dieses</em> Gewerbe gewöhnlich mit sich bringt</td></tr>
    <tr><td>Beschränkung nach außen</td><td>unwirksam gegenüber Dritten (Ausnahme: Filial- oder Gesamtprokura)</td><td>wirksam, wenn der Dritte sie kennt oder kennen muss</td></tr>
    <tr><td>Zeichnung</td><td>ppa. (per procura)</td><td>i. V. (in Vollmacht) bzw. i. A. (im Auftrag)</td></tr>
  </tbody>
</table>
<p>Eine <strong>Gesamtprokura</strong> verlangt, dass zwei Personen gemeinsam handeln (Vier-Augen-Prinzip); eine <strong>Filialprokura</strong> gilt nur für eine Niederlassung.</p>

<h6>Übungen mit Lösung</h6>
<p>1. Die Leiterin Einkauf hat Prokura. Intern wurde vereinbart, dass sie nur Bestellungen bis 50.000 € unterschreibt. Sie bestellt Server für 80.000 €. Ist der Vertrag wirksam?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Ja. Beschränkungen der Prokura wirken nur im Innenverhältnis, gegenüber dem Lieferanten ist der Vertrag wirksam (§ 50 HGB). Intern kann die Überschreitung Folgen für sie haben.</p>
</details>
<p>2. Ein Mitarbeiter mit allgemeiner Handlungsvollmacht will für die Firma ein Darlehen aufnehmen. Darf er das?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Nur mit besonderer Befugnis. Darlehensaufnahme, Wechselverbindlichkeiten, Prozessführung sowie Grundstücksgeschäfte sind von der Handlungsvollmacht ausgenommen (§ 54 Abs. 2 HGB).</p>
</details>
<p>3. Ein Softwarehaus hat Teams für Entwicklung und Test, arbeitet aber gleichzeitig an drei Kundenprodukten, die jeweils eine Produktverantwortliche haben. Welche Organisationsform liegt vor?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Eine Matrixorganisation: Funktionen (Entwicklung, Test) und Produkte bilden die beiden Achsen; Mitarbeitende haben fachliche und produktbezogene Vorgesetzte.</p>
</details>
INHALT,
    'summary' => [
        'Stelle = kleinste Einheit, Instanz = Stelle mit Weisungsbefugnis, Leitungsspanne = Zahl der direkt Unterstellten.',
        'Einlinien-, Mehrlinien-, Stablinien-, Sparten- und Matrixorganisation mit typischen Stärken und Schwächen.',
        'Stabsstellen (z. B. DSB, ISB) beraten, haben aber keine Weisungsbefugnis.',
        'Prokura (ppa.): ins Handelsregister eingetragen, umfasst auch außergewöhnliche Geschäfte, nach außen unbeschränkbar.',
        'Handlungsvollmacht (i. V., i. A.): allgemeine, Art- oder Einzelvollmacht für gewöhnliche Geschäfte.',
    ],
    'quiz' => [
        ['question' => 'Was ist eine Instanz in der Aufbauorganisation?', 'answer' => 'Eine Stelle mit Leitungs- und Weisungsbefugnis.'],
        ['question' => 'Welche Befugnis haben Stabsstellen?', 'answer' => 'Sie beraten die Leitung, haben aber keine Weisungsbefugnis gegenüber den Linienstellen.'],
        ['question' => 'Mit welchem Zusatz zeichnet ein Prokurist?', 'answer' => 'ppa. (per procura).'],
        ['question' => 'Wird die Handlungsvollmacht ins Handelsregister eingetragen?', 'answer' => 'Nein, nur die Prokura.'],
    ],
];
