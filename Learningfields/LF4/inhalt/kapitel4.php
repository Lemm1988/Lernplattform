<?php
return [
    'title' => 'Schutzbedarfsfeststellung',
    'intro' => 'Nicht alles braucht den gleichen Schutz. Die Schutzbedarfsfeststellung klärt, wie schlimm es wäre, wenn Vertraulichkeit, Integrität oder Verfügbarkeit verletzt werden – und überträgt das Ergebnis von den Anwendungen auf Systeme und Räume.',
    'goals' => [
        'die Schutzbedarfskategorien normal, hoch und sehr hoch anhand von Schadensszenarien anwenden',
        'den Schutzbedarf von Anwendungen je Schutzziel begründet festlegen',
        'den Schutzbedarf nach dem Maximumprinzip auf IT-Systeme und Räume vererben',
        'Kumulations- und Verteilungseffekt erkennen',
        'eine Schutzbedarfsfeststellung nachvollziehbar dokumentieren',
    ],
    'content' => <<<'INHALT'
<h6>Die drei Kategorien</h6>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th>Kategorie</th><th>Schadensauswirkungen</th></tr></thead>
  <tbody>
    <tr><td><strong>normal</strong></td><td>begrenzt und überschaubar</td></tr>
    <tr><td><strong>hoch</strong></td><td>können beträchtlich sein</td></tr>
    <tr><td><strong>sehr hoch</strong></td><td>können ein existenziell bedrohliches, katastrophales Ausmaß erreichen</td></tr>
  </tbody>
</table>
<p>Damit die Einstufung nicht vom Bauchgefühl abhängt, legt das Unternehmen vorab fest, was „beträchtlich“ für es bedeutet. Das BSI nennt dafür sechs <strong>Schadensszenarien</strong>.
Die Grenzen in der Tabelle sind ein Beispiel für ein kleines Unternehmen – jedes Unternehmen bestimmt eigene.</p>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th>Schadensszenario</th><th>normal</th><th>hoch</th><th>sehr hoch</th></tr></thead>
  <tbody>
    <tr><td>Verstoß gegen Gesetze, Vorschriften, Verträge</td><td>geringfügige Folgen</td><td>erhebliche Konventionalstrafen</td><td>existenzbedrohende Strafen, Lizenzentzug</td></tr>
    <tr><td>Beeinträchtigung des informationellen Selbstbestimmungsrechts</td><td>Daten mit geringer Wirkung, z. B. Namensliste</td><td>z. B. Gehaltsdaten, Bewertungen</td><td>Gesundheitsdaten, Daten, die Leben oder Freiheit gefährden</td></tr>
    <tr><td>Beeinträchtigung der persönlichen Unversehrtheit</td><td>ausgeschlossen</td><td>nicht ausgeschlossen</td><td>Gefahr für Leib und Leben</td></tr>
    <tr><td>Beeinträchtigung der Aufgabenerfüllung</td><td>Ausfall über 24 h tolerierbar</td><td>2 bis 24 h tolerierbar</td><td>unter 2 h tolerierbar</td></tr>
    <tr><td>negative Innen- oder Außenwirkung</td><td>geringes, internes Ansehen</td><td>breite Ansehensbeeinträchtigung</td><td>landesweite Rufschädigung</td></tr>
    <tr><td>finanzielle Auswirkungen</td><td>unter 10.000 €</td><td>10.000 bis 500.000 €</td><td>über 500.000 €</td></tr>
  </tbody>
</table>

<h6>Vorgehen</h6>
<ol>
  <li><strong>Anwendungen bewerten</strong> – getrennt für Vertraulichkeit, Integrität und Verfügbarkeit. Ausgangspunkt sind die Geschäftsprozesse und Informationen, die eine Anwendung verarbeitet.</li>
  <li><strong>Auf IT-Systeme vererben</strong>: Ein System erbt den Schutzbedarf der Anwendungen, die es betreibt oder von denen es abhängt.</li>
  <li><strong>Auf Räume und Verbindungen vererben</strong>: Ein Raum erbt von den Systemen, die er beherbergt, eine Netzverbindung von den Daten, die über sie laufen.</li>
  <li><strong>Begründen und dokumentieren</strong>: Jede Einstufung bekommt eine kurze Begründung – sonst ist sie bei der nächsten Prüfung nicht nachvollziehbar.</li>
</ol>

<h6>Beispiel: Softwarehaus mit 30 Beschäftigten</h6>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th>Anwendung</th><th>V</th><th>I</th><th>A</th><th>Begründung</th></tr></thead>
  <tbody>
    <tr><td>A1 Lohnbuchhaltung</td><td>hoch</td><td>hoch</td><td>normal</td><td>Gehaltsdaten (Persönlichkeitsrecht); falsche Beträge lösen Fehlüberweisungen aus; Abrechnung nur monatlich, Ausfall von Tagen tolerierbar</td></tr>
    <tr><td>A2 Git-Server</td><td>hoch</td><td>hoch</td><td>normal</td><td>Quellcode der Kunden unter Geheimhaltungsvereinbarung; manipulierter Code gelangt zum Kunden; Entwickler haben lokale Kopien</td></tr>
    <tr><td>A3 Ticketsystem</td><td>normal</td><td>normal</td><td>hoch</td><td>vertraglich zugesicherte Reaktionszeit von 4 Stunden, bei Verstoß Vertragsstrafe</td></tr>
    <tr><td>A4 Firmen-Website</td><td>normal</td><td>hoch</td><td>normal</td><td>nur öffentliche Inhalte; eine verunstaltete Seite schadet dem Ruf</td></tr>
  </tbody>
</table>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf4/schutzbedarf-vererbung.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Vier Anwendungen mit ihrem Schutzbedarf; Server S1 mit A1 und A3 erbt hoch, hoch, hoch; der Serverraum mit S1 und S2 ebenfalls">
  <figcaption class="figure-caption">Maximumprinzip: S1 übernimmt die Vertraulichkeit von A1 und die Verfügbarkeit von A3</figcaption>
</figure>
<p>S1 hat nun bei allen drei Schutzzielen hohen Bedarf, obwohl keine einzelne Anwendung das hat. Daraus folgt ein Hinweis für die Planung:
Vielleicht ist es günstiger, das Ticketsystem auf einen eigenen Server zu legen, statt den ganzen S1 hochverfügbar zu machen.</p>

<h6>Wenn das Maximum nicht reicht – oder zu viel ist</h6>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf4/kumulation-verteilung.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Links: zwölf VMs mit normalem Bedarf machen den Host hoch; rechts: ein hochverfügbares Ticketsystem auf zwei Servern, jeder einzeln normal">
  <figcaption class="figure-caption">Kumulation erhöht, Verteilung senkt den Schutzbedarf</figcaption>
</figure>
<ul>
  <li><strong>Kumulationseffekt</strong>: Viele kleine Schäden summieren sich. Ein Host mit zwölf VMs, ein zentraler Switch, an dem alle Arbeitsplätze hängen,
    eine Datenbank mit Tausenden harmloser Einzeldatensätze – der Schutzbedarf des Ganzen ist höher als der jedes Teils.</li>
  <li><strong>Verteilungseffekt</strong>: Ist eine Anwendung redundant auf mehrere Systeme verteilt, braucht das einzelne System für die Verfügbarkeit weniger Schutz.
    Ebenso bei der Vertraulichkeit, wenn auf einem System nur unkritische Teile der Daten liegen. Achtung: Der Lastverteiler selbst erbt dann den vollen Bedarf.</li>
</ul>
<div class="lf-pruefung"><strong>Prüfungstipp:</strong> Gefragt wird oft eine Tabelle mit Anwendungen und Systemen, in der du den Schutzbedarf je Schutzziel ergänzen und
<em>begründen</em> sollst. Nenne bei der Begründung das Schadensszenario („Gehaltsdaten → informationelles Selbstbestimmungsrecht“) und das Vererbungsprinzip.</div>

<h6>Übungen mit Lösung</h6>
<p>1. Ein Datenbankserver enthält die Kundendatenbank (V hoch, I hoch, A hoch) und eine Testdatenbank mit Fantasiedaten (alles normal). Welcher Schutzbedarf gilt für den Server?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Hoch für alle drei Schutzziele (Maximumprinzip). Die Testdatenbank senkt den Bedarf nicht – sie gehört auch eher auf ein eigenes System.</p>
</details>
<p>2. Ein Ausfall des Webshops kostet erfahrungsgemäß etwa 50.000 € pro Tag. Welche Kategorie ergibt sich mit den Grenzen aus der Tabelle für die Verfügbarkeit, wenn der Shop bis zu zwei Tage ausfallen könnte?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Zwei Tage × 50.000 € = 100.000 € – das liegt zwischen 10.000 und 500.000 €, also <strong>hoch</strong>.</p>
</details>
<p>3. In einem Büro hängen alle 30 Arbeitsplätze (je normaler Schutzbedarf) an einem einzigen Switch. Welcher Effekt greift, und was folgt daraus?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Der Kumulationseffekt: Fällt der Switch aus, steht das ganze Büro. Seine Verfügbarkeit ist hoch einzustufen – Maßnahmen wären z. B. ein Ersatzgerät vor Ort oder ein zweiter Switch.</p>
</details>
<p>4. Warum wird der Schutzbedarf je Schutzziel und nicht als ein Gesamtwert festgelegt?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Weil die Maßnahmen verschieden sind: Hohe Vertraulichkeit verlangt Verschlüsselung und Rechte, hohe Verfügbarkeit Redundanz und Backups. Ein Gesamtwert würde
überflüssige oder fehlende Maßnahmen verursachen – siehe die Website mit normaler Vertraulichkeit, aber hoher Integrität.</p>
</details>
INHALT,
    'summary' => [
        'Kategorien: normal (begrenzt), hoch (beträchtlich), sehr hoch (existenziell bedrohlich).',
        'Sechs Schadensszenarien mit unternehmenseigenen Grenzen machen die Einstufung nachvollziehbar.',
        'Reihenfolge: Anwendungen → IT-Systeme → Räume und Verbindungen, je Schutzziel V, I, A.',
        'Maximumprinzip: das System erbt den höchsten Bedarf seiner Anwendungen.',
        'Kumulationseffekt erhöht, Verteilungseffekt senkt den Bedarf; jede Einstufung wird begründet.',
    ],
    'quiz' => [
        ['question' => 'Welche drei Schutzbedarfskategorien gibt es?', 'answer' => 'normal, hoch, sehr hoch.'],
        ['question' => 'Was besagt das Maximumprinzip?', 'answer' => 'Ein System erbt je Schutzziel den höchsten Schutzbedarf der Anwendungen, die es betreibt.'],
        ['question' => 'Was ist der Kumulationseffekt?', 'answer' => 'Viele Anwendungen mit geringem Bedarf auf einem System ergeben zusammen einen höheren Schutzbedarf.'],
        ['question' => 'Womit beginnt die Schutzbedarfsfeststellung?', 'answer' => 'Mit den Geschäftsprozessen bzw. Anwendungen und den Informationen, die sie verarbeiten.'],
    ],
];
