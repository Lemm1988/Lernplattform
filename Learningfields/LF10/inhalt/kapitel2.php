<?php
return [
    'title' => 'Gestaltungsgrundlagen für Oberflächen',
    'intro' => 'Warum wirkt eine Seite aufgeräumt und die andere chaotisch? Wahrnehmungsgesetze, Hierarchie, Typografie, Farbe und Konsistenz erklären es – und lassen sich gezielt einsetzen.',
    'goals' => [
        'Gestaltgesetze erklären und für Layouts nutzen',
        'visuelle Hierarchie über Größe, Gewicht, Farbe und Position steuern',
        'Typografie, Weißraum und Raster sinnvoll einsetzen',
        'Farben bewusst und barrierefrei wählen und Kontraste prüfen',
        'Konsistenz, Affordanz sowie die Gesetze von Fitts und Hick anwenden',
    ],
    'content' => <<<'INHALT'
<h6>Gestaltgesetze: wie wir Dinge gruppieren</h6>
<p>Unser Gehirn ordnet, was es sieht, automatisch zu Gruppen und Formen. Die <strong>Gestaltgesetze</strong> beschreiben diese Regeln – wer sie kennt,
kann Zusammengehöriges zusammen wirken lassen, ohne Linien und Rahmen zu brauchen.</p>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf10/gestaltgesetze.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Fünf Gestaltgesetze mit Punktmustern und UI-Beispielen: Nähe, Ähnlichkeit, Geschlossenheit, gemeinsame Region, Kontinuität">
  <figcaption class="figure-caption">Nähe, Ähnlichkeit, Geschlossenheit, gemeinsame Region, Kontinuität</figcaption>
</figure>
<p>Der häufigste Fehler in Formularen verstößt gegen das Gesetz der Nähe: Steht die Beschriftung genauso weit vom eigenen Feld entfernt wie vom
vorherigen, ist unklar, wozu sie gehört. Abstand ist ein Gestaltungsmittel – innerhalb einer Gruppe klein, zwischen Gruppen groß.</p>

<h6>Visuelle Hierarchie</h6>
<p>Der Blick soll zuerst auf das Wichtigste fallen. Mittel dafür sind <strong>Größe</strong>, <strong>Schriftgewicht</strong>, <strong>Farbe/Kontrast</strong>
und <strong>Position</strong>. Pro Seite gibt es genau eine Hauptaktion (Primary Button, z. B. „Bestellen“); Nebenaktionen („Abbrechen“) sind
zurückhaltender gestaltet. Westliche Leser überfliegen Textseiten oft in F-Form (oben quer, dann links nach unten), einfache Seiten in Z-Form – wichtige
Informationen gehören daher nach oben links, nicht in die rechte Spalte.</p>

<h6>Weißraum, Raster und Typografie</h6>
<ul>
  <li><strong>Weißraum</strong> (Leerraum) ist kein verschwendeter Platz, sondern trennt Bereiche und lässt Inhalte atmen.</li>
  <li><strong>Raster</strong>: Elemente richten sich an gemeinsamen Linien und Spalten aus (Bootstrap nutzt ein 12-Spalten-Raster). Was bündig ist, wirkt geordnet.</li>
  <li><strong>Schrift</strong>: höchstens zwei Schriftfamilien; Fließtext mindestens etwa 16 px; Zeilenlänge 50–75 Zeichen; Zeilenabstand etwa das 1,5-Fache
  der Schriftgröße; linksbündig statt Blocksatz am Bildschirm.</li>
  <li><strong>Überschriften</strong> gliedern; GROSSBUCHSTABEN und Kursivschrift sind für längere Texte schwer lesbar.</li>
</ul>

<h6>Farbe und Kontrast</h6>
<p>Farben transportieren Bedeutung (rot = Fehler/Gefahr, grün = Erfolg, gelb = Warnung) und Markenidentität. Drei Regeln:</p>
<ol>
  <li>Wenige Farben, konsequent eingesetzt: eine Akzentfarbe für Aktionen, Grautöne für Text, Signalfarben nur für Status.</li>
  <li><strong>Nie nur Farbe</strong> als Informationsträger: Rund 8 % der Männer haben eine Rot-Grün-Sehschwäche. Ein Fehler wird zusätzlich mit
  Symbol und Text gekennzeichnet („⚠ Bitte gültige E-Mail eingeben“).</li>
  <li>Ausreichender <strong>Kontrast</strong> zwischen Text und Hintergrund – messbar nach WCAG:</li>
</ol>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf10/kontrast.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Fünf Textbeispiele mit Kontrastverhältnissen von 15,4:1 bis 1,6:1 und der Bewertung nach WCAG AA">
  <figcaption class="figure-caption">Hellgrau auf Weiß und Weiß auf Gelb sind beliebt – und für viele Menschen kaum lesbar</figcaption>
</figure>
<p>Das Kontrastverhältnis reicht von 1:1 (gleiche Farbe) bis 21:1 (Schwarz auf Weiß). Prüfen lässt es sich mit den Entwicklerwerkzeugen des Browsers
oder Online-Kontrastrechnern. Das Blau der Bootstrap-Buttons (<code>#0d6efd</code>) erreicht mit weißer Schrift genau 4,5:1 – also gerade so AA.</p>

<h6>Konsistenz und Affordanz</h6>
<p><strong>Konsistenz</strong> heißt: Gleiches sieht gleich aus und verhält sich gleich. <em>Intern</em> (innerhalb der Anwendung: „Speichern“ ist immer
rechts unten und immer blau) und <em>extern</em> (mit Konventionen anderer Anwendungen: Logo oben links führt zur Startseite, Warenkorb oben rechts,
unterstrichener Text ist ein Link). Konsistenz senkt die Lernzeit – sie ist das Prinzip der Erwartungskonformität aus der ISO 9241-110.</p>
<p><strong>Affordanz</strong> bedeutet, dass ein Element zeigt, wie es benutzt wird: Ein Button sieht drückbar aus (Fläche, Schatten, Hover-Effekt), ein
Eingabefeld hat einen Rahmen. „Flache“ Designs, bei denen Text und Button gleich aussehen, verschlechtern die Bedienbarkeit.</p>

<h6>Zwei Gesetze aus der Psychologie</h6>
<ul>
  <li><strong>Fitts' Gesetz</strong>: Die Zeit, ein Ziel mit Maus oder Finger zu treffen, hängt von Entfernung und Größe ab. Häufige Aktionen also groß und
  nah machen; Touch-Ziele mindestens etwa 44 × 44 px (WCAG 2.2 verlangt für AA mindestens 24 × 24 CSS-Pixel oder ausreichend Abstand). Gefährliche Aktionen
  („Alles löschen“) dürfen dagegen ruhig weiter weg liegen.</li>
  <li><strong>Hicks Gesetz</strong>: Je mehr gleichwertige Auswahlmöglichkeiten, desto länger dauert die Entscheidung. Lange Menüs gruppieren, seltene
  Optionen in „Erweitert“ verstecken, sinnvolle Voreinstellungen anbieten.</li>
</ul>
<div class="lf-pruefung"><strong>Prüfungstipp:</strong> Bei Aufgaben „Bewerten Sie den Bildschirmentwurf“ lohnt eine feste Checkliste: Gruppierung
(Nähe, Region), Hierarchie (eine Hauptaktion?), Konsistenz, Kontrast und Farbe nicht als einziges Merkmal, Größe der Klickflächen, verständliche
Beschriftungen. Nenne jeweils Mangel <em>und</em> Verbesserung.</div>

<h6>Übungen mit Lösung</h6>
<p>1. In einem Formular stehen alle Beschriftungen genau in der Mitte zwischen zwei Eingabefeldern. Welches Gesetz ist verletzt, und wie behebst du es?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Das Gesetz der Nähe: Beschriftung und Feld werden nicht als Paar erkannt. Abstand zwischen Beschriftung und eigenem Feld verkleinern,
Abstand zum nächsten Paar vergrößern (oder Beschriftung direkt links neben das Feld setzen).</p>
</details>
<p>2. Eine Statusanzeige zeigt einen grünen oder roten Punkt ohne Text. Bewerte das.</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Information nur über Farbe – für Menschen mit Rot-Grün-Sehschwäche und Screenreader-Nutzer nicht erkennbar. Besser: Symbol und Text
ergänzen („✓ Online“ / „✕ Offline“).</p>
</details>
<p>3. Ein Shop zeigt auf der Produktseite vier gleich große, gleichfarbige Buttons: „In den Warenkorb“, „Merken“, „Teilen“, „Vergleichen“. Was würdest du ändern?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Visuelle Hierarchie herstellen: „In den Warenkorb“ als einzige Hauptaktion groß und in der Akzentfarbe; die anderen als dezente Nebenaktionen
(Umriss oder nur Symbol mit Text). Hicks Gesetz: weniger gleichwertige Optionen beschleunigen die Entscheidung.</p>
</details>
INHALT,
    'summary' => [
        'Gestaltgesetze (Nähe, Ähnlichkeit, Geschlossenheit, gemeinsame Region, Kontinuität) steuern, was als zusammengehörig wahrgenommen wird.',
        'Visuelle Hierarchie über Größe, Gewicht, Farbe und Position; genau eine Hauptaktion pro Seite.',
        'Weißraum und Raster schaffen Ordnung; Fließtext ab etwa 16 px, 50–75 Zeichen pro Zeile.',
        'Kontrast nach WCAG AA: 4,5:1 für normalen Text, 3:1 für großen Text und Bedienelemente; Information nie nur über Farbe.',
        'Konsistenz senkt die Lernzeit; Fitts: wichtige Ziele groß und nah; Hick: wenige gleichwertige Optionen.',
    ],
    'quiz' => [
        ['question' => 'Was besagt das Gestaltgesetz der Nähe?', 'answer' => 'Elemente, die nah beieinander liegen, werden als zusammengehörig wahrgenommen.'],
        ['question' => 'Welches Kontrastverhältnis verlangt WCAG AA für normalen Fließtext?', 'answer' => 'Mindestens 4,5 : 1.'],
        ['question' => 'Was besagt Fitts\' Gesetz für die Gestaltung von Bedienelementen?', 'answer' => 'Je größer und näher ein Ziel ist, desto schneller wird es getroffen – häufige Aktionen also groß und gut erreichbar platzieren.'],
        ['question' => 'Warum darf Information nicht nur über Farbe vermittelt werden?', 'answer' => 'Menschen mit Farbsehschwäche oder Screenreader-Nutzer können sie sonst nicht erkennen; Symbole und Text müssen ergänzen.'],
    ],
];
