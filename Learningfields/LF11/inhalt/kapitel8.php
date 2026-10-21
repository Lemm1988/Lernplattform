<?php
return [
    'title' => 'Entwurfsprinzipien und Clean Code',
    'intro' => 'Code wird viel öfter gelesen als geschrieben. Entwurfsprinzipien wie SOLID sorgen dafür, dass Software änderbar bleibt; Clean Code und Refactoring halten sie lesbar.',
    'goals' => [
        'lose Kopplung und hohe Kohäsion erklären',
        'die SOLID-Prinzipien an Beispielen erläutern und Verstöße erkennen',
        'DRY, KISS und YAGNI anwenden',
        'Code Smells erkennen und Code mit Refactoring verbessern, ohne das Verhalten zu ändern',
    ],
    'content' => <<<'INHALT'
<h6>Kopplung und Kohäsion</h6>
<p><strong>Kopplung</strong> beschreibt, wie stark Module voneinander abhängen. <strong>Kohäsion</strong> beschreibt, wie gut die Teile
<em>innerhalb</em> eines Moduls zusammengehören. Ziel ist immer: <strong>lose Kopplung, hohe Kohäsion</strong>.</p>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf11/kopplung-kohaesion.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Links drei Module mit gemischten Aufgaben und vielen Querverbindungen, rechts drei Module mit je einer Aufgabe und wenigen Verbindungen">
  <figcaption class="figure-caption">Rechts kann man das Lager-Modul ändern, ohne Kunden und Rechnung anzufassen</figcaption>
</figure>

<h6>Die SOLID-Prinzipien</h6>
<p>SOLID fasst fünf Prinzipien des objektorientierten Entwurfs zusammen:</p>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th></th><th>Prinzip</th><th>Kernaussage</th></tr></thead>
  <tbody>
    <tr><td><strong>S</strong></td><td>Single Responsibility</td><td>Eine Klasse hat genau eine Aufgabe – und damit nur einen Grund, sich zu ändern.</td></tr>
    <tr><td><strong>O</strong></td><td>Open/Closed</td><td>Offen für Erweiterung, geschlossen für Änderung: Neues kommt als neue Klasse dazu, statt bestehenden Code umzubauen.</td></tr>
    <tr><td><strong>L</strong></td><td>Liskov Substitution</td><td>Eine Unterklasse muss sich überall verwenden lassen, wo die Oberklasse erwartet wird – ohne Überraschungen.</td></tr>
    <tr><td><strong>I</strong></td><td>Interface Segregation</td><td>Lieber mehrere kleine Interfaces als ein großes, von dem Klassen Methoden erben, die sie nicht brauchen.</td></tr>
    <tr><td><strong>D</strong></td><td>Dependency Inversion</td><td>Hänge von Abstraktionen (Interfaces) ab, nicht von konkreten Klassen.</td></tr>
  </tbody>
</table>

<p><strong>S – eine Aufgabe pro Klasse.</strong> Eine Klasse <code>Rechnung</code>, die Beträge berechnet, ein PDF erzeugt <em>und</em> in die Datenbank
schreibt, muss bei jeder Layoutänderung, jeder Steueränderung und jedem Datenbankwechsel angefasst werden. Besser: <code>Rechnung</code> (Berechnung),
<code>RechnungsPdf</code> (Darstellung), <code>RechnungsRepository</code> (Speichern).</p>

<p><strong>O – erweitern statt ändern.</strong> Statt einer wachsenden <code>if-else</code>-Kette über Kundentypen gibt es ein Interface, und jede
Rabattart ist eine eigene Klasse. Ein neuer Mengenrabatt ändert keine bestehende Zeile:</p>
<pre class="bg-light border rounded p-3"><code>interface Rabattregel {
    int rabattCent(int betragCent);
}

class Stammkundenrabatt implements Rabattregel {
    public int rabattCent(int betragCent) { return betragCent * 5 / 100; }
}

class Mengenrabatt implements Rabattregel {                     // neu hinzugefügt
    public int rabattCent(int betragCent) { return betragCent &gt;= 50_000 ? 2_500 : 0; }
}

static int endpreis(int betragCent, Rabattregel regel) {
    return betragCent - regel.rabattCent(betragCent);
}
// endpreis(10_000, new Stammkundenrabatt()) → 9500   endpreis(60_000, new Mengenrabatt()) → 57500</code></pre>

<p><strong>L – Unterklassen dürfen nicht überraschen.</strong> Mathematisch ist ein Quadrat ein Rechteck. Im Code geht das schief:</p>
<pre class="bg-light border rounded p-3"><code>class Rechteck {
    protected int breite, hoehe;
    void setBreite(int b) { breite = b; }
    void setHoehe(int h)  { hoehe = h; }
    int flaeche() { return breite * hoehe; }
}

class Quadrat extends Rechteck {                     // hält Seiten immer gleich
    @Override void setBreite(int b) { breite = b; hoehe = b; }
    @Override void setHoehe(int h)  { breite = h; hoehe = h; }
}

static int teste(Rechteck r) {
    r.setBreite(5);
    r.setHoehe(4);
    return r.flaeche();                              // erwartet 20
}
// teste(new Rechteck()) → 20     teste(new Quadrat()) → 16  ✗</code></pre>
<p>Code, der mit Rechtecken korrekt arbeitet, liefert mit einem Quadrat falsche Ergebnisse. Die „ist-ein“-Beziehung stimmt hier nur im Alltag, nicht im
Verhalten – Quadrat und Rechteck sollten besser beide ein gemeinsames Interface <code>Form</code> implementieren.</p>

<p><strong>I – kleine Interfaces.</strong> Ein Interface <code>Buerogeraet</code> mit <code>drucken()</code>, <code>scannen()</code> und <code>faxen()</code>
zwingt einen einfachen Drucker, <code>faxen()</code> mit einer Exception zu „implementieren“. Besser drei Interfaces <code>Drucker</code>, <code>Scanner</code>,
<code>Fax</code> – ein Multifunktionsgerät implementiert alle drei.</p>

<p><strong>D – von Abstraktionen abhängen.</strong></p>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf11/dependency-inversion.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Vorher hängt BestellService direkt an MySqlDatenbank, nachher an einem Interface BestellRepository mit zwei Implementierungen">
  <figcaption class="figure-caption">Die Abhängigkeit zeigt nachher auf das Interface</figcaption>
</figure>
<pre class="bg-light border rounded p-3"><code>interface BestellRepository {
    void speichern(Bestellung b);
    List&lt;Bestellung&gt; alle();
}

class BestellService {
    private final BestellRepository repo;

    BestellService(BestellRepository repo) {      // Abhängigkeit wird hineingegeben (Dependency Injection)
        this.repo = repo;
    }

    void bestellen(int nummer, int betragCent) {
        if (betragCent &lt;= 0) throw new IllegalArgumentException("Betrag muss positiv sein");
        repo.speichern(new Bestellung(nummer, betragCent));
    }
}

// im Test – ganz ohne Datenbank:
BestellService service = new BestellService(new SpeicherRepository());</code></pre>

<h6>DRY, KISS, YAGNI</h6>
<ul>
  <li><strong>DRY</strong> – Don't Repeat Yourself: Jede Information und jede Regel gibt es genau einmal. Kopierter Code bedeutet doppelte Fehlerkorrektur.</li>
  <li><strong>KISS</strong> – Keep It Simple, Stupid: Die einfachste Lösung, die funktioniert, ist meist die beste.</li>
  <li><strong>YAGNI</strong> – You Aren't Gonna Need It: Baue keine Funktionen „für später“, die heute niemand braucht.</li>
</ul>

<h6>Clean Code und Code Smells</h6>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th>Code Smell</th><th>Woran man ihn erkennt</th><th>Gegenmittel</th></tr></thead>
  <tbody>
    <tr><td>schlechte Namen</td><td><code>s</code>, <code>t</code>, <code>daten2</code>, <code>doIt()</code></td><td>aussagekräftig umbenennen: <code>summe</code>, <code>kundentyp</code></td></tr>
    <tr><td>magische Zahlen</td><td><code>if (s &gt; 100)</code>, <code>s + 4.9</code></td><td>benannte Konstanten: <code>GRENZE_VERSANDFREI</code></td></tr>
    <tr><td>lange Methode</td><td>mehr als ein Bildschirm, mehrere Aufgaben</td><td>Teile in Methoden auslagern (Extract Method)</td></tr>
    <tr><td>Gott-Klasse</td><td>eine Klasse weiß und kann alles</td><td>nach Aufgaben aufteilen (SRP)</td></tr>
    <tr><td>doppelter Code</td><td>gleiche Zeilen an mehreren Stellen</td><td>gemeinsame Methode (DRY)</td></tr>
    <tr><td>tiefe Verschachtelung</td><td>if in if in for in if</td><td>früh zurückkehren (Guard Clauses), Methoden auslagern</td></tr>
    <tr><td>lange Parameterliste</td><td>mehr als drei, vier Parameter</td><td>Parameterobjekt, z. B. <code>record Adresse(…)</code></td></tr>
    <tr><td>überflüssige Kommentare</td><td><code>i++; // i erhöhen</code></td><td>Code selbsterklärend schreiben; Kommentare erklären das <em>Warum</em></td></tr>
  </tbody>
</table>

<h6>Refactoring</h6>
<p><strong>Refactoring</strong> verbessert die innere Struktur von Code, <strong>ohne sein Verhalten zu ändern</strong>. Voraussetzung sind Tests, die
vorher und nachher grün sind. IDEs unterstützen typische Schritte: Umbenennen, Methode extrahieren, Konstante einführen, Variable inline setzen.</p>
<div class="row g-3">
  <div class="col-lg-6"><p class="mb-1"><strong>vorher</strong></p><pre class="bg-light border rounded p-3 h-100"><code>static String berechne(int[] p, int t) {
    double s = 0;
    for (int i = 0; i &lt; p.length; i++) {
        s = s + p[i];
    }
    if (t == 1) {
        s = s - s * 0.05;
    } else if (t == 2) {
        s = s - s * 0.1;
    }
    if (s &gt; 100) {
        return "Summe: " + s + " (versandkostenfrei)";
    } else {
        return "Summe: " + (s + 4.9) + " (inkl. Versand)";
    }
}</code></pre></div>
  <div class="col-lg-6"><p class="mb-1"><strong>nachher</strong></p><pre class="bg-light border rounded p-3 h-100"><code>static final double VERSANDKOSTEN = 4.90;
static final double GRENZE_VERSANDFREI = 100.0;

enum Kundentyp {
    NORMAL(0.0), STAMMKUNDE(0.05), PREMIUM(0.10);
    final double rabatt;
    Kundentyp(double rabatt) { this.rabatt = rabatt; }
}

static String berechne(int[] preise, Kundentyp typ) {
    double summe = summe(preise) * (1 - typ.rabatt);
    if (summe &gt; GRENZE_VERSANDFREI) {
        return "Summe: " + summe + " (versandkostenfrei)";
    }
    return "Summe: " + (summe + VERSANDKOSTEN) + " (inkl. Versand)";
}</code></pre></div>
</div>
<p class="mt-3">Beide Versionen liefern für alle getesteten Warenkörbe und Kundentypen exakt dieselben Texte (z. B. „Summe: 104.65 (inkl. Versand)“).
Der nächste sinnvolle Schritt wäre, Beträge in Cent als <code>int</code> zu rechnen (<a href="/Learningfields/LF8/kapitel14.php">LF8 Kapitel 14</a>) – das ändert aber Rundungen und ist dann
<em>kein</em> reines Refactoring mehr, sondern eine Verhaltensänderung, die eigene Tests braucht.</p>

<h6>Übungen mit Lösung</h6>
<p>1. Welches SOLID-Prinzip ist verletzt? a) Eine Klasse <code>Pinguin extends Vogel</code> wirft in <code>fliegen()</code> eine Exception.
b) <code>Bericht</code> berechnet Kennzahlen und versendet E-Mails. c) <code>Bestellservice</code> erzeugt intern <code>new MySqlDatenbank()</code>.</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">a) Liskov – ein Pinguin lässt sich nicht überall einsetzen, wo ein Vogel erwartet wird. b) Single Responsibility – zwei Aufgaben.
c) Dependency Inversion – Abhängigkeit von einer konkreten Klasse statt von einem Interface; nicht ohne Datenbank testbar.</p>
</details>
<p>2. Nenne drei Code Smells in dieser Methode: <code>double calc(double a, double b, int x) { if (x == 3) return a * 0.19 + b; … }</code></p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Nichtssagende Namen (<code>calc</code>, <code>a</code>, <code>b</code>, <code>x</code>), magische Zahlen (<code>3</code>, <code>0.19</code> – besser
<code>MEHRWERTSTEUERSATZ</code>), Typcode als <code>int</code> statt <code>enum</code>. Außerdem <code>double</code> für Geldbeträge.</p>
</details>
<p>3. Warum braucht man vor einem Refactoring Tests?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Refactoring darf das Verhalten nicht ändern. Nur automatisierte Tests, die vorher und nachher grün sind, belegen das zuverlässig.</p>
</details>
INHALT,
    'summary' => [
        'Ziel: lose Kopplung zwischen Modulen, hohe Kohäsion innerhalb eines Moduls.',
        'SOLID: eine Aufgabe pro Klasse, erweitern statt ändern, Unterklassen ohne Überraschungen, kleine Interfaces, von Abstraktionen abhängen.',
        'DRY: nichts doppelt; KISS: einfach halten; YAGNI: nichts auf Vorrat bauen.',
        'Code Smells: schlechte Namen, magische Zahlen, lange Methoden, Gott-Klassen, doppelter Code.',
        'Refactoring verbessert die Struktur ohne Verhaltensänderung – abgesichert durch Tests.',
    ],
    'quiz' => [
        ['question' => 'Was bedeutet das Open/Closed-Prinzip?', 'answer' => 'Software soll offen für Erweiterungen, aber geschlossen für Änderungen sein: Neue Funktionen kommen als neue Klassen hinzu, bestehender Code bleibt unverändert.'],
        ['question' => 'Was ist hohe Kohäsion?', 'answer' => 'Die Elemente eines Moduls oder einer Klasse gehören fachlich eng zusammen und erfüllen gemeinsam genau eine Aufgabe.'],
        ['question' => 'Was ist Dependency Injection?', 'answer' => 'Eine Klasse erzeugt ihre Abhängigkeiten nicht selbst, sondern bekommt sie (meist als Interface) von außen übergeben, z. B. im Konstruktor.'],
        ['question' => 'Wofür steht DRY?', 'answer' => 'Don\'t Repeat Yourself – jede Regel und jede Information soll es im Code nur einmal geben.'],
    ],
];
