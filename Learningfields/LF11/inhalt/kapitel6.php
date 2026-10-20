<?php
return [
    'title' => 'Das Sequenzdiagramm',
    'intro' => 'Wer ruft wen in welcher Reihenfolge auf? Das Sequenzdiagramm zeigt die Zusammenarbeit von Objekten über die Zeit – und lässt sich direkt in Code übersetzen.',
    'goals' => [
        'Lebenslinien, Aktivierungsbalken und Nachrichtenarten lesen und zeichnen',
        'synchrone und asynchrone Nachrichten, Antworten und Objekterzeugung unterscheiden',
        'kombinierte Fragmente (alt, opt, loop, par) einsetzen',
        'ein Sequenzdiagramm aus Code erstellen und umgekehrt',
    ],
    'content' => <<<'INHALT'
<h6>Wofür ein Sequenzdiagramm?</h6>
<p>Das Klassendiagramm (LF8 Kapitel 4) zeigt, welche Klassen es gibt. Das Aktivitätsdiagramm (LF8 Kapitel 5) zeigt einen Ablauf, aber nicht,
<em>welches Objekt</em> welchen Schritt ausführt. Das <strong>Sequenzdiagramm</strong> schließt diese Lücke: Es zeigt für <strong>ein Szenario</strong>
(meist einen Anwendungsfall), welche Objekte welche Nachrichten in welcher Reihenfolge austauschen. Die Zeit läuft von oben nach unten.</p>

<h6>Die Bausteine</h6>
<ul>
  <li><strong>Lebenslinie</strong>: Kasten mit dem Objekt (<code>name:Klasse</code> oder nur <code>:Klasse</code>, unterstrichen) und eine gestrichelte
  Linie nach unten. Akteure wie der Kunde werden als Strichmännchen gezeichnet.</li>
  <li><strong>Aktivierungsbalken</strong>: schmales Rechteck auf der Lebenslinie – solange das Objekt gerade arbeitet (eine Methode läuft).</li>
  <li><strong>Nachrichten</strong>: Pfeile zwischen den Lebenslinien, beschriftet mit dem Methodenaufruf.</li>
</ul>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf11/sequenz-notation.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Pfeilarten: synchron mit gefüllter Spitze, Antwort gestrichelt, asynchron mit offener Spitze, create und X für Zerstörung; Fragmente alt, opt, loop, par">
  <figcaption class="figure-caption">Auf die Pfeilspitzen kommt es an</figcaption>
</figure>
<div class="lf-pruefung"><strong>Prüfungstipp:</strong> Gefüllte Spitze = synchron (normaler Methodenaufruf, der Aufrufer wartet). Offene Spitze mit
durchgezogener Linie = asynchron (z. B. Nachricht in eine Warteschlange, Mailversand im Hintergrund). Gestrichelt = Antwort bzw. Rückgabewert.
Rückgaben darf man weglassen, wenn sie nichts Wichtiges zurückliefern.</div>

<h6>Ein vollständiges Beispiel</h6>
<p>Szenario „Kunde bestellt einen Artikel“: Der Webshop prüft den Bestand, bucht den Betrag ab, legt eine Bestellung an und verschickt eine
Bestätigung. Ist der Artikel nicht lieferbar, bekommt der Kunde einen Hinweis.</p>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf11/sequenzdiagramm-bestellung.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Sequenzdiagramm mit Kunde, Webshop, Lager, Zahlungsdienst, Bestellung und Maildienst und einem alt-Fragment für verfügbar und sonst">
  <figcaption class="figure-caption">Ein Szenario, sechs Beteiligte, ein alt-Fragment</figcaption>
</figure>
<p>So sieht der passende Code der Klasse <code>Webshop</code> aus. Jede Nachricht im Diagramm ist ein Methodenaufruf, das alt-Fragment ist das
<code>if-else</code>, <code>«create»</code> ist ein <code>new</code>:</p>
<pre class="bg-light border rounded p-3"><code>public class Webshop {
    private final Lager lager = new Lager();
    private final Zahlungsdienst zahlung = new Zahlungsdienst();
    private final Maildienst mail = new Maildienst();

    public String bestellen(String email, String artikel, int menge) {
        if (lager.pruefeBestand(artikel, menge)) {                 // synchron, Antwort: verfügbar
            int betrag = berechneBetrag(artikel, menge);           // Selbstaufruf
            zahlung.abbuchen(betrag);                              // synchron, Antwort: ok
            Bestellung b = new Bestellung(artikel, menge);         // «create»
            mail.sendeBestaetigung(email);                         // asynchron – läuft im Hintergrund
            return "Bestellung " + b.getNummer() + " bestätigt";
        } else {
            return "Artikel nicht lieferbar";
        }
    }

    private int berechneBetrag(String artikel, int menge) { … }
}</code></pre>
<p>Im Testlauf ergibt die Bestellung von zwei Mäusen genau die Aufrufreihenfolge aus dem Diagramm (<code>pruefeBestand</code>,
<code>berechneBetrag</code>, <code>abbuchen(3980)</code>, <code>«create» Bestellung 1001</code>, <code>sendeBestaetigung</code>), die Bestellung eines
nicht vorrätigen Monitors endet nach <code>pruefeBestand</code> mit „Artikel nicht lieferbar“.</p>

<h6>Kombinierte Fragmente</h6>
<p>Ein Fragment ist ein Rahmen mit dem Operator in der linken oberen Ecke. Bedingungen (Guards) stehen in eckigen Klammern am Anfang eines Abschnitts.</p>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th>Operator</th><th>Bedeutung</th><th>Code</th></tr></thead>
  <tbody>
    <tr><td><code>alt</code></td><td>Alternativen, durch gestrichelte Linien getrennt; genau ein Abschnitt wird ausgeführt</td><td><code>if … else if … else</code>, <code>switch</code></td></tr>
    <tr><td><code>opt</code></td><td>optionaler Abschnitt, nur wenn die Bedingung gilt</td><td><code>if</code> ohne <code>else</code></td></tr>
    <tr><td><code>loop</code></td><td>Wiederholung, z. B. <code>loop [für jede Position]</code> oder <code>loop(1,3)</code></td><td><code>for</code>, <code>while</code></td></tr>
    <tr><td><code>par</code></td><td>Abschnitte laufen parallel</td><td>Threads</td></tr>
    <tr><td><code>ref</code></td><td>Verweis auf ein anderes Sequenzdiagramm</td><td>ausgelagerte Methode</td></tr>
  </tbody>
</table>

<h6>Sequenzdiagramm oder Aktivitätsdiagramm?</h6>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th></th><th>Sequenzdiagramm</th><th>Aktivitätsdiagramm</th></tr></thead>
  <tbody>
    <tr><th>Schwerpunkt</th><td>Nachrichten zwischen Objekten, zeitliche Reihenfolge</td><td>Ablauf von Aktionen mit Verzweigungen und Parallelität</td></tr>
    <tr><th>zeigt Verantwortliche</th><td>ja, jede Lebenslinie ist ein Objekt</td><td>nur über Schwimmbahnen</td></tr>
    <tr><th>typisch für</th><td>Entwurf: Welche Methode ruft welche auf?</td><td>Geschäftsprozesse, Algorithmen</td></tr>
  </tbody>
</table>

<h6>Übungen mit Lösung</h6>
<p>1. Welche Nachrichtenart passt? a) <code>konto.getSaldo()</code>, b) eine Bestellung wird in eine Message Queue gelegt, c) der Rückgabewert von
<code>getSaldo()</code>.</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">a) synchrone Nachricht (gefüllte Spitze), b) asynchrone Nachricht (offene Spitze, durchgezogen), c) Antwort (gestrichelt, offene Spitze).</p>
</details>
<p>2. Zeichne das Sequenzdiagramm zu diesem Code (Lebenslinien <code>:Kasse</code>, <code>:Warenkorb</code>, <code>:Artikel</code>):</p>
<pre class="bg-light border rounded p-3"><code>int summe(Warenkorb korb) {                     // in Klasse Kasse
    int s = 0;
    for (Artikel a : korb.getArtikel()) {
        s += a.getPreis();
    }
    return s;
}</code></pre>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2"><code>:Kasse</code> sendet <code>getArtikel()</code> an <code>:Warenkorb</code> und erhält die Liste zurück (gestrichelt). Danach ein Fragment
<code>loop [für jeden Artikel]</code>, darin <code>getPreis()</code> von <code>:Kasse</code> an <code>:Artikel</code> mit Antwort <code>preis</code>.
Das Aufsummieren ist eine interne Berechnung und braucht keine eigene Nachricht.</p>
</details>
<p>3. Im Diagramm steht ein Fragment <code>opt [Kunde ist Neukunde]</code> mit der Nachricht <code>sendeWillkommensgutschein()</code>. Wie sieht das im Code aus?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2"><code>if (kunde.istNeukunde()) { mail.sendeWillkommensgutschein(kunde); }</code> – ein <code>if</code> ohne <code>else</code>.</p>
</details>
INHALT,
    'summary' => [
        'Sequenzdiagramm = Interaktion von Objekten in einem Szenario; Zeit läuft von oben nach unten.',
        'Lebenslinie (gestrichelt) mit Aktivierungsbalken, solange eine Methode läuft.',
        'Synchron: gefüllte Spitze; asynchron: offene Spitze; Antwort: gestrichelt; Erzeugung: «create»; Ende: X.',
        'Fragmente: alt (if-else), opt (if), loop (Schleife), par (parallel), ref (Verweis).',
        'Nachrichten entsprechen Methodenaufrufen – Diagramm und Code lassen sich ineinander übersetzen.',
    ],
    'quiz' => [
        ['question' => 'Woran erkennst du im Sequenzdiagramm eine asynchrone Nachricht?', 'answer' => 'Durchgezogene Linie mit offener (nicht gefüllter) Pfeilspitze; der Sender wartet nicht auf eine Antwort.'],
        ['question' => 'Was stellt ein Aktivierungsbalken dar?', 'answer' => 'Den Zeitraum, in dem das Objekt aktiv ist, also eine seiner Methoden ausgeführt wird.'],
        ['question' => 'Welches Fragment entspricht einer for-Schleife?', 'answer' => 'loop, z. B. loop [für jede Position].'],
        ['question' => 'Wie wird die Erzeugung eines Objekts dargestellt?', 'answer' => 'Durch einen gestrichelten Pfeil mit «create», der direkt auf den Kopf der neuen Lebenslinie zeigt; der Kasten steht auf der Höhe der Nachricht.'],
    ],
];
