<?php
return [
    'title' => 'Webseiten strukturieren: semantisches HTML',
    'intro' => 'HTML beschreibt, was ein Inhalt ist – nicht, wie er aussieht. Wer die richtigen Elemente wählt, bekommt Barrierefreiheit, Suchmaschinenfreundlichkeit und wartbaren Code fast geschenkt.',
    'goals' => [
        'Aufgaben von HTML, CSS und JavaScript trennen',
        'ein HTML5-Grundgerüst aufbauen und semantische Elemente einsetzen',
        'Überschriften, Links, Buttons, Bilder und Tabellen korrekt verwenden',
        'barrierefreie Formulare mit Labels, passenden Feldtypen und Gruppierung erstellen',
    ],
    'content' => <<<'INHALT'
<h6>Drei Sprachen, drei Aufgaben</h6>
<ul>
  <li><strong>HTML</strong> – Struktur und Bedeutung: Das ist eine Überschrift, das ist eine Navigation, das ist ein Formularfeld für eine E-Mail-Adresse.</li>
  <li><strong>CSS</strong> – Aussehen: Farben, Abstände, Layout, Anpassung an Bildschirmgrößen (Kapitel 5 und 6).</li>
  <li><strong>JavaScript</strong> – Verhalten im Browser: auf Klicks reagieren, Daten nachladen (Kapitel 9).</li>
</ul>
<p>Diese Trennung (Separation of Concerns) macht Seiten wartbar: Ein neues Design ändert nur das CSS, nicht den Inhalt. Die HTML-Grundlagen der
Syntax findest du auch im Bereich <a href="/programming/php/php-forms.php">PHP – Formulare</a>.</p>

<h6>Das Grundgerüst</h6>
<pre class="bg-light border rounded p-3"><code>&lt;!DOCTYPE html&gt;
&lt;html lang="de"&gt;                                     &lt;!-- Sprache: Screenreader lesen deutsch vor --&gt;
&lt;head&gt;
  &lt;meta charset="UTF-8"&gt;                               &lt;!-- Umlaute korrekt --&gt;
  &lt;meta name="viewport" content="width=device-width, initial-scale=1"&gt;   &lt;!-- mobil, Kapitel 6 --&gt;
  &lt;title&gt;Kontakt – Fahrradwerkstatt Speiche&lt;/title&gt;   &lt;!-- Tab-Titel, Suchergebnis --&gt;
  &lt;link rel="stylesheet" href="style.css"&gt;
&lt;/head&gt;
&lt;body&gt;
  …
&lt;/body&gt;
&lt;/html&gt;</code></pre>

<h6>Semantische Elemente</h6>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf10/semantisches-layout.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Seitenaufbau mit header und nav oben, main mit h1 und Formular, aside daneben und footer unten, jeweils mit Landmark-Rolle">
  <figcaption class="figure-caption">Jedes Bereichselement wird für Screenreader zu einer Sprungmarke (Landmark)</figcaption>
</figure>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th>Element</th><th>Bedeutung</th></tr></thead>
  <tbody>
    <tr><td><code>&lt;header&gt;</code></td><td>Kopfbereich der Seite (oder eines Artikels): Logo, Titel, oft die Navigation</td></tr>
    <tr><td><code>&lt;nav&gt;</code></td><td>Navigationsblock mit Links zu anderen Seiten</td></tr>
    <tr><td><code>&lt;main&gt;</code></td><td>der eigentliche Inhalt – genau einmal pro Seite</td></tr>
    <tr><td><code>&lt;article&gt;</code></td><td>in sich geschlossener Inhalt, der auch allein Sinn ergibt (Blogbeitrag, Produktkarte)</td></tr>
    <tr><td><code>&lt;section&gt;</code></td><td>thematischer Abschnitt mit eigener Überschrift</td></tr>
    <tr><td><code>&lt;aside&gt;</code></td><td>Ergänzendes neben dem Hauptinhalt (Infokasten, Werbung)</td></tr>
    <tr><td><code>&lt;footer&gt;</code></td><td>Fußbereich: Kontakt, Impressum, Copyright</td></tr>
    <tr><td><code>&lt;figure&gt;</code>, <code>&lt;figcaption&gt;</code></td><td>Abbildung mit Bildunterschrift</td></tr>
    <tr><td><code>&lt;div&gt;</code>, <code>&lt;span&gt;</code></td><td>ohne Bedeutung – nur als Container für die Gestaltung</td></tr>
  </tbody>
</table>

<h6>Überschriften, Links, Buttons, Bilder, Tabellen</h6>
<ul>
  <li><strong>Überschriften</strong> bilden die Gliederung: genau ein <code>&lt;h1&gt;</code>, dann <code>&lt;h2&gt;</code>, <code>&lt;h3&gt;</code> ohne Ebenen zu überspringen.
  Die Größe regelt CSS – nie eine Überschriftenebene nur wegen der Schriftgröße wählen.</li>
  <li><strong>Link oder Button?</strong> Ein Link (<code>&lt;a href&gt;</code>) <em>navigiert</em> zu einer anderen Seite, ein Button (<code>&lt;button&gt;</code>)
  <em>löst eine Aktion aus</em>. Ein <code>&lt;div onclick="…"&gt;</code> ist mit der Tastatur nicht erreichbar und für Screenreader unsichtbar – ein Fehler.</li>
  <li><strong>Linktexte</strong> müssen allein verständlich sein: „Preisliste als PDF“ statt „hier klicken“.</li>
  <li><strong>Bilder</strong> brauchen ein <code>alt</code>-Attribut: Bei inhaltlichen Bildern beschreibt es die Information („Diagramm: Umsatz stieg 2025 um 12 %“),
  bei rein dekorativen Bildern bleibt es leer (<code>alt=""</code>), damit Screenreader es überspringen.</li>
  <li><strong>Tabellen</strong> nur für tabellarische Daten, nie für das Layout. Kopfzellen als <code>&lt;th scope="col"&gt;</code>, Überschrift mit <code>&lt;caption&gt;</code>.</li>
</ul>

<h6>Formulare richtig aufbauen</h6>
<pre class="bg-light border rounded p-3"><code>&lt;form action="/termin" method="post"&gt;
  &lt;fieldset&gt;
    &lt;legend&gt;Ihre Daten&lt;/legend&gt;                       &lt;!-- Gruppe mit Überschrift --&gt;
    &lt;label for="name"&gt;Name&lt;/label&gt;
    &lt;input id="name" name="name" type="text" autocomplete="name" required&gt;

    &lt;label for="email"&gt;E-Mail&lt;/label&gt;
    &lt;input id="email" name="email" type="email" autocomplete="email" required&gt;
  &lt;/fieldset&gt;

  &lt;label for="datum"&gt;Wunschtermin&lt;/label&gt;
  &lt;input id="datum" name="datum" type="date"&gt;            &lt;!-- Kalender statt Freitext --&gt;

  &lt;label for="art"&gt;Art der Reparatur&lt;/label&gt;
  &lt;select id="art" name="art"&gt;
    &lt;option value="inspektion"&gt;Inspektion&lt;/option&gt;
    &lt;option value="bremse"&gt;Bremsen&lt;/option&gt;
  &lt;/select&gt;

  &lt;label for="nachricht"&gt;Nachricht&lt;/label&gt;
  &lt;textarea id="nachricht" name="nachricht" rows="4"&gt;&lt;/textarea&gt;

  &lt;button type="submit"&gt;Termin anfragen&lt;/button&gt;
&lt;/form&gt;</code></pre>
<ul>
  <li><strong>Jedes Feld braucht ein <code>&lt;label&gt;</code></strong>, das über <code>for</code> = <code>id</code> verknüpft ist. Ein Klick auf die Beschriftung
  setzt dann den Fokus ins Feld, und Screenreader lesen sie vor. Ein Platzhalter (<code>placeholder</code>) ersetzt kein Label – er verschwindet beim Tippen.</li>
  <li><strong>Passende Typen</strong>: <code>email</code>, <code>tel</code>, <code>number</code>, <code>date</code>, <code>password</code> zeigen auf dem Handy die richtige
  Tastatur und prüfen grob vor.</li>
  <li><strong><code>autocomplete</code></strong> lässt den Browser bekannte Daten vorschlagen – weniger Tippen, weniger Fehler.</li>
  <li><code>name</code> ist der Schlüssel, unter dem der Wert beim Server ankommt (<code>$_POST['email']</code>, Kapitel 7).</li>
</ul>
<p>Im Browser getestet: Alle fünf Felder sind über ihre Beschriftung auffindbar, die Seite hat die Landmarks banner, navigation, main, complementary und
contentinfo, und bei der Eingabe <code>kaya.example.org</code> meldet der Browser selbst: „Die E-Mail-Adresse muss ein @-Zeichen enthalten.“ Ein
Formular wird übrigens erst dann zur eigenen Landmark, wenn es einen Namen hat (<code>aria-label="Terminanfrage"</code>).</p>
<div class="lf-merke"><strong>Merke:</strong> Die erste Regel für ARIA-Attribute lautet: Verwende keins, wenn es ein passendes HTML-Element gibt. Ein echtes
<code>&lt;button&gt;</code> ist besser als <code>&lt;div role="button" tabindex="0"&gt;</code> mit selbst programmierter Tastaturbedienung.</div>

<h6>Übungen mit Lösung</h6>
<p>1. Finde vier Fehler: <code>&lt;h1&gt;Shop&lt;/h1&gt; &lt;h3&gt;Angebote&lt;/h3&gt; &lt;img src="sale.png"&gt; &lt;div onclick="kaufen()"&gt;Kaufen&lt;/div&gt;
&lt;input type="text" placeholder="E-Mail"&gt;</code></p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Überschriftenebene übersprungen (h1 → h3, richtig h2); Bild ohne <code>alt</code>; <code>div</code> statt <code>button</code> (nicht per Tastatur
bedienbar); E-Mail-Feld ohne <code>label</code>, mit falschem Typ <code>text</code> statt <code>email</code> und ohne <code>name</code>.</p>
</details>
<p>2. Welches Element passt? a) Liste der Kategorien links neben den Produkten. b) Ein einzelner Blogbeitrag. c) Der Hinweis „Versandkostenfrei ab 50 €“ in
einer Randspalte.</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">a) <code>&lt;nav&gt;</code> (es ist Navigation), b) <code>&lt;article&gt;</code>, c) <code>&lt;aside&gt;</code>.</p>
</details>
<p>3. Welcher alt-Text passt zu einem Foto des Firmengebäudes auf der „Über uns“-Seite, und welcher zu einer dekorativen Trennlinie?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Gebäude: z. B. <code>alt="Firmensitz der Speiche GmbH in der Kölner Ringstraße"</code>. Trennlinie: <code>alt=""</code> – leer, aber vorhanden.</p>
</details>
INHALT,
    'summary' => [
        'HTML = Struktur und Bedeutung, CSS = Aussehen, JavaScript = Verhalten.',
        'Semantische Elemente header, nav, main, article, section, aside, footer werden zu Landmarks für Screenreader.',
        'Ein h1, keine übersprungenen Ebenen; Link navigiert, Button handelt; Linktexte selbsterklärend.',
        'alt-Text beschreibt den Inhalt; dekorative Bilder bekommen alt="".',
        'Formulare: label for/id, passende input-Typen, autocomplete, fieldset/legend, name für den Server.',
    ],
    'quiz' => [
        ['question' => 'Warum ersetzt ein placeholder kein label?', 'answer' => 'Der Platzhalter verschwindet beim Tippen und wird nicht zuverlässig von Screenreadern vorgelesen; das Label bleibt sichtbar und ist mit dem Feld verknüpft.'],
        ['question' => 'Wann verwendet man <a> und wann <button>?', 'answer' => 'Ein Link navigiert zu einer anderen Seite oder Stelle, ein Button löst eine Aktion aus (Senden, Öffnen, Löschen).'],
        ['question' => 'Wie oft darf <main> auf einer Seite vorkommen?', 'answer' => 'Genau einmal (sichtbar) – es enthält den eigentlichen Inhalt der Seite.'],
        ['question' => 'Welchen alt-Text bekommt ein rein dekoratives Bild?', 'answer' => 'Ein leeres alt-Attribut (alt=""), damit Screenreader es überspringen.'],
    ],
];
