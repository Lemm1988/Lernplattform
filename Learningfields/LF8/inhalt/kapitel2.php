<?php
return [
    'title' => 'Objektorientierung: die Konzepte',
    'intro' => 'Klassen, Objekte, Kapselung, Vererbung, Polymorphie und Abstraktion – die Begriffe, die in jeder AP2 vorkommen, an einem durchgehenden Beispiel erklärt.',
    'goals' => [
        'Klasse, Objekt, Attribut, Methode und Konstruktor unterscheiden',
        'Kapselung mit Sichtbarkeiten (private, protected, public) begründen',
        'Vererbung, Überschreiben und Überladen erklären und im Code erkennen',
        'abstrakte Klassen und Interfaces vergleichen',
    ],
    'content' => <<<'INHALT'
<p>Objektorientierte Programmierung (OOP) bildet Dinge aus der realen Welt als <strong>Objekte</strong> ab.
Ein Objekt bündelt seine <strong>Daten</strong> (Attribute, also den Zustand) mit dem passenden <strong>Verhalten</strong> (Methoden).
Statt „eine Funktion, die irgendein Konto verändert“ gibt es „ein Konto, das weiß, wie man darauf einzahlt“.</p>

<h6>Klasse und Objekt</h6>
<p>Eine <strong>Klasse</strong> ist der Bauplan: Sie legt fest, welche Attribute und Methoden alle Objekte dieser Art haben.
Ein <strong>Objekt</strong> (auch <em>Instanz</em>) ist ein konkretes Exemplar, das mit <code>new</code> nach diesem Bauplan erzeugt wird
und eigene Attributwerte hat. Der <strong>Konstruktor</strong> ist eine spezielle Methode mit dem Namen der Klasse, die beim Erzeugen
aufgerufen wird und das Objekt in einen gültigen Anfangszustand bringt.</p>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf8/klasse-objekte.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="UML-Klasse Konto mit privaten Attributen und öffentlichen Methoden, daraus mit new erzeugt drei Objekte k1, k2, k3 mit eigenen Werten">
  <figcaption class="figure-caption">Eine Klasse, drei Objekte: gleiche Methoden, eigene Attributwerte</figcaption>
</figure>

<h6>Kapselung</h6>
<p>Attribute sind <code>private</code>: Von außen kommt man nur über Methoden heran. So kann die Klasse ihre Regeln selbst
durchsetzen – ein Konto lässt keine negative Einzahlung und kein Überziehen zu, egal wer es benutzt.</p>
<pre class="bg-light border rounded p-3"><code>public class Konto {
    private final String iban;
    private double saldo;

    public Konto(String iban) {          // Konstruktor
        this.iban = iban;                // this = "dieses Objekt"
        this.saldo = 0.0;
    }

    public void einzahlen(double betrag) {
        if (betrag &lt;= 0) {
            throw new IllegalArgumentException("Betrag muss positiv sein");
        }
        saldo += betrag;
    }

    public boolean abheben(double betrag) {
        if (betrag &lt;= 0 || betrag &gt; saldo) {
            return false;                // Regel: kein Überziehen
        }
        saldo -= betrag;
        return true;
    }

    public double getSaldo() {           // nur lesen – es gibt bewusst kein setSaldo()
        return saldo;
    }
}</code></pre>
<div class="table-responsive">
<table class="table table-sm table-bordered align-middle w-auto">
  <thead class="table-light"><tr><th>Java</th><th>UML</th><th>Sichtbar für</th></tr></thead>
  <tbody>
    <tr><td><code>public</code></td><td><code>+</code></td><td>alle</td></tr>
    <tr><td><code>protected</code></td><td><code>#</code></td><td>eigene Klasse, Unterklassen (und das Paket)</td></tr>
    <tr><td>(ohne Angabe)</td><td><code>~</code></td><td>Klassen im selben Paket</td></tr>
    <tr><td><code>private</code></td><td><code>-</code></td><td>nur die eigene Klasse</td></tr>
  </tbody>
</table>
</div>
<p><strong>Getter und Setter</strong> sind Methoden zum Lesen und Ändern eines Attributs. Ein Setter ist kein Selbstzweck:
Er gehört nur dorthin, wo eine Änderung fachlich erlaubt ist – und er prüft den neuen Wert.</p>

<h6>Vererbung</h6>
<p>Eine Unterklasse übernimmt Attribute und Methoden ihrer Oberklasse und ergänzt oder verändert sie (Schlüsselwort
<code>extends</code>). Vererbung beschreibt eine <strong>„ist-ein“-Beziehung</strong>: Ein Lkw <em>ist ein</em> Fahrzeug.
Mit <code>super(…)</code> ruft die Unterklasse den Konstruktor der Oberklasse auf. In Java erbt eine Klasse von
<strong>genau einer</strong> Oberklasse; Interfaces kann sie dagegen beliebig viele implementieren.</p>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf8/vererbung-polymorphie.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Abstrakte Klasse Fahrzeug mit Unterklassen Pkw und Lkw, die mautProKm überschreiben; eine Liste von Fahrzeugen ruft zur Laufzeit jeweils die passende Methode auf">
  <figcaption class="figure-caption">Vererbung (hohler Pfeil zur Oberklasse) und Polymorphie</figcaption>
</figure>
<pre class="bg-light border rounded p-3"><code>public abstract class Fahrzeug {
    protected final String kennzeichen;

    protected Fahrzeug(String kennzeichen) {
        this.kennzeichen = kennzeichen;
    }

    public abstract double mautProKm();   // keine Umsetzung – jede Unterklasse MUSS sie liefern

    public String beschreiben() {
        return getClass().getSimpleName() + " " + kennzeichen + ": " + mautProKm() + " €/km";
    }
}

public class Lkw extends Fahrzeug {
    private final int achsen;

    public Lkw(String kennzeichen, int achsen) {
        super(kennzeichen);
        this.achsen = achsen;
    }

    @Override
    public double mautProKm() {
        return achsen &gt;= 4 ? 0.35 : 0.20;
    }
}</code></pre>

<h6>Polymorphie: Überschreiben und Überladen</h6>
<p><strong>Polymorphie</strong> („Vielgestaltigkeit“) heißt: Derselbe Aufruf verhält sich je nach Objekt unterschiedlich.
Eine Variable vom Typ <code>Fahrzeug</code> kann auf einen Pkw oder einen Lkw zeigen – welches <code>mautProKm()</code>
ausgeführt wird, entscheidet sich erst <strong>zur Laufzeit</strong> anhand des tatsächlichen Objekts (dynamische Bindung).</p>
<div class="table-responsive">
<table class="table table-sm table-bordered align-middle">
  <thead class="table-light"><tr><th></th><th>Überschreiben (Override)</th><th>Überladen (Overload)</th></tr></thead>
  <tbody>
    <tr><td>Wo?</td><td>in der Unterklasse</td><td>in derselben Klasse</td></tr>
    <tr><td>Signatur</td><td>gleicher Name, <strong>gleiche</strong> Parameter</td><td>gleicher Name, <strong>andere</strong> Parameterliste</td></tr>
    <tr><td>Entscheidung</td><td>zur Laufzeit (welches Objekt?)</td><td>beim Kompilieren (welche Argumente?)</td></tr>
    <tr><td>Beispiel</td><td><code>Lkw.mautProKm()</code> ersetzt <code>Fahrzeug.mautProKm()</code></td><td><code>info(int x)</code> und <code>info(double x)</code></td></tr>
  </tbody>
</table>
</div>
<div class="lf-pruefung"><strong>Prüfungstipp:</strong> Überschreiben vs. Überladen ist ein Klassiker. Merkhilfe: Über<strong>schreiben</strong>
= die geerbte Methode wird <em>neu geschrieben</em>. Über<strong>laden</strong> = ein Methodenname wird mit mehreren
Parameterlisten <em>beladen</em>. Der Rückgabetyp allein reicht zum Überladen nicht aus.</div>

<h6>Abstraktion: abstrakte Klasse und Interface</h6>
<p>Eine <strong>abstrakte Klasse</strong> ist eine unfertige Oberklasse: Von ihr kann man keine Objekte erzeugen, sie kann aber
schon Attribute, Konstruktoren und fertige Methoden mitbringen. Ein <strong>Interface</strong> ist ein reiner Vertrag
(„kann …“): Es legt fest, welche Methoden eine Klasse anbieten muss.</p>
<div class="table-responsive">
<table class="table table-sm table-bordered align-middle">
  <thead class="table-light"><tr><th></th><th>Abstrakte Klasse</th><th>Interface</th></tr></thead>
  <tbody>
    <tr><td>Beziehung</td><td>„ist ein“ (gemeinsame Basis)</td><td>„kann“ (Fähigkeit, z. B. <code>Comparable</code>, <code>Druckbar</code>)</td></tr>
    <tr><td>Attribute</td><td>ja, auch veränderliche</td><td>nur Konstanten</td></tr>
    <tr><td>Konstruktor</td><td>ja</td><td>nein</td></tr>
    <tr><td>Methoden</td><td>abstrakte und fertige</td><td>abstrakte, dazu <code>default</code>- und <code>static</code>-Methoden</td></tr>
    <tr><td>Anzahl je Klasse</td><td>genau eine (<code>extends</code>)</td><td>beliebig viele (<code>implements</code>)</td></tr>
  </tbody>
</table>
</div>

<h6>Klassenattribute mit <code>static</code></h6>
<p>Ein <code>static</code>-Attribut gehört der Klasse, nicht dem einzelnen Objekt – alle Objekte teilen es.
Typisch für Zähler oder Konstanten (<code>static final double MWST = 0.19;</code>). <code>static</code>-Methoden
ruft man über den Klassennamen auf (<code>Math.max(a, b)</code>), sie kennen kein <code>this</code>.</p>

<h6>Objekte werden über Referenzen angesprochen</h6>
<p>Eine Variable vom Typ <code>Konto</code> enthält nicht das Objekt selbst, sondern einen Verweis darauf. Java übergibt beim
Methodenaufruf immer eine <strong>Kopie des Werts</strong> (<em>call by value</em>) – bei Objekten ist das eine Kopie
der Referenz. Die Methode kann das Objekt also verändern, aber nicht die Variable des Aufrufers auf ein anderes Objekt umbiegen.</p>
<pre class="bg-light border rounded p-3"><code>static void aendern(Konto k)  { k.einzahlen(50); }                  // wirkt beim Aufrufer
static void ersetzen(Konto k) { k = new Konto("X"); k.einzahlen(999); } // wirkt NICHT

Konto konto = new Konto("DE00");
aendern(konto);
ersetzen(konto);
System.out.println(konto.getSaldo());   // 50.0</code></pre>

<h6>Übungen mit Lösung</h6>
<p>1. „Eine Bibliothek verleiht Bücher und DVDs an Mitglieder. Jedes Medium hat einen Titel und eine Inventarnummer,
Bücher zusätzlich eine ISBN. Mitglieder können Medien ausleihen und zurückgeben.“ Welche Klassen, Attribute und
Methoden erkennst du, und wo ist Vererbung sinnvoll?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<ul class="mt-2">
  <li>Abstrakte Oberklasse <code>Medium</code> (titel, inventarnummer), Unterklassen <code>Buch</code> (isbn) und <code>Dvd</code></li>
  <li>Klasse <code>Mitglied</code> (name, mitgliedsnummer) mit <code>ausleihen(Medium m)</code> und <code>zurueckgeben(Medium m)</code></li>
  <li>Faustregel: Substantive werden Klassen oder Attribute, Verben werden Methoden.</li>
</ul>
</details>
<p>2. Was gibt dieser Code aus?</p>
<pre class="bg-light border rounded p-3"><code>class Tier  { String laut() { return "..."; } }
class Hund  extends Tier { @Override String laut() { return "Wuff"; } }
class Katze extends Tier { @Override String laut() { return "Miau"; } }

Tier t = new Katze();
System.out.println(t.laut());</code></pre>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2"><strong>Miau.</strong> Der Variablentyp ist zwar <code>Tier</code>, entscheidend ist aber das tatsächliche Objekt
(<code>Katze</code>) – dynamische Bindung beim Überschreiben.</p>
</details>
<p>3. Eine Klasse hat die Methoden <code>double preis(int menge)</code> und <code>double preis(int menge, double rabatt)</code>. Überladen oder überschrieben?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2"><strong>Überladen:</strong> gleicher Name, unterschiedliche Parameterlisten, in derselben Klasse. Welche Methode gilt, entscheidet der Compiler anhand der Argumente.</p>
</details>
<p>4. Warum hat <code>Konto</code> im Beispiel kein <code>setSaldo(double)</code>?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Weil der Saldo nur durch fachlich erlaubte Vorgänge (einzahlen, abheben) entstehen darf. Ein freier Setter würde die Kapselung aushebeln – jeder könnte den Kontostand beliebig setzen.</p>
</details>
INHALT,
    'summary' => [
        'Klasse = Bauplan, Objekt = Instanz mit eigenen Attributwerten, erzeugt mit new; der Konstruktor initialisiert.',
        'Kapselung: Attribute private, Zugriff nur über Methoden, die die Regeln prüfen.',
        'Vererbung (extends) = ist-ein-Beziehung; in Java genau eine Oberklasse, aber beliebig viele Interfaces.',
        'Überschreiben: gleiche Signatur in der Unterklasse, Entscheidung zur Laufzeit. Überladen: andere Parameterliste, Entscheidung beim Kompilieren.',
        'Abstrakte Klasse = unfertige Basis mit Zustand; Interface = Vertrag über Fähigkeiten.',
        'static gehört zur Klasse; Objekte werden über Referenzen angesprochen, Java übergibt immer per Wert.',
    ],
    'quiz' => [
        ['question' => 'Kann man von einer abstrakten Klasse ein Objekt erzeugen?', 'answer' => 'Nein. Man kann nur Objekte konkreter Unterklassen erzeugen, die alle abstrakten Methoden umsetzen. Eine Variable vom abstrakten Typ ist aber erlaubt (Fahrzeug f = new Lkw(...)).'],
        ['question' => 'Wofür steht das Symbol # in einem UML-Klassendiagramm?', 'answer' => 'Für protected: sichtbar in der eigenen Klasse und in Unterklassen.'],
        ['question' => 'Wann wird bei überschriebenen Methoden entschieden, welche ausgeführt wird?', 'answer' => 'Zur Laufzeit anhand des tatsächlichen Objekttyps (dynamische Bindung) – nicht anhand des Variablentyps.'],
        ['question' => 'Nenne zwei Unterschiede zwischen abstrakter Klasse und Interface.', 'answer' => 'Zum Beispiel: Eine Klasse kann nur eine abstrakte Klasse erweitern, aber viele Interfaces implementieren; abstrakte Klassen haben Konstruktoren und veränderliche Attribute, Interfaces nur Konstanten.'],
        ['question' => 'Was bewirkt super(kennzeichen) im Konstruktor von Lkw?', 'answer' => 'Es ruft den Konstruktor der Oberklasse Fahrzeug auf, damit deren Attribute (kennzeichen) initialisiert werden – das muss die erste Anweisung im Konstruktor sein.'],
    ],
];
