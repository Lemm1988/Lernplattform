<?php
return [
    'title' => 'Das Klassendiagramm',
    'intro' => 'Das wichtigste Strukturdiagramm: Es zeigt Klassen mit Attributen und Methoden und wie sie zusammenhängen. In der AP2 musst du es lesen, ergänzen und in Code übersetzen.',
    'goals' => [
        'Klassen mit Sichtbarkeit, Datentypen und Methodensignaturen notieren',
        'Assoziation, Aggregation, Komposition, Generalisierung, Realisierung und Abhängigkeit unterscheiden',
        'Multiplizitäten lesen und setzen',
        'ein Klassendiagramm in Java-Code umsetzen',
    ],
    'content' => <<<'INHALT'
<h6>Notation einer Klasse</h6>
<p>Eine Klasse ist ein Rechteck mit drei Abschnitten: <strong>Name</strong>, <strong>Attribute</strong>, <strong>Methoden</strong>.</p>
<pre class="bg-light border rounded p-3"><code>Attribut:  Sichtbarkeit name : Datentyp [= Startwert]      - saldo : double = 0.0
Methode:   Sichtbarkeit name(param : Typ, …) : Rückgabetyp  + abheben(betrag : double) : boolean</code></pre>
<ul>
  <li>Sichtbarkeit: <code>+</code> public, <code>-</code> private, <code>#</code> protected, <code>~</code> Paket</li>
  <li><u>Unterstrichen</u> = <code>static</code> (Klassenattribut oder Klassenmethode)</li>
  <li><em>Kursiv</em> oder mit <code>«abstract»</code> = abstrakte Klasse bzw. abstrakte Methode; <code>«interface»</code> über dem Namen = Interface</li>
  <li>Konstruktoren stehen bei den Methoden, meist ohne Rückgabetyp: <code>+ Konto(iban : String)</code></li>
</ul>

<h6>Beziehungen zwischen Klassen</h6>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf8/uml-beziehungen.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Übersicht der Beziehungsarten: Assoziation, Aggregation, Komposition, Generalisierung, Realisierung und Abhängigkeit mit Notation und Beispiel">
  <figcaption class="figure-caption">Sechs Beziehungsarten – Linienart und Pfeilspitze machen den Unterschied</figcaption>
</figure>
<p><strong>Aggregation oder Komposition?</strong> Frag dich: Darf das Teil ohne das Ganze weiterexistieren?
Ein Mitarbeiter bleibt, wenn das Team aufgelöst wird (Aggregation). Eine Bestellposition ohne ihre Bestellung ergibt keinen Sinn –
sie wird mitgelöscht (Komposition). Außerdem gehört ein Teil bei der Komposition zu genau <em>einem</em> Ganzen.</p>

<h6>Multiplizitäten</h6>
<p>Die Zahlen an den Enden einer Linie geben an, <strong>wie viele Objekte</strong> der Klasse an diesem Ende mit einem Objekt der
anderen Klasse verbunden sind.</p>
<div class="table-responsive">
<table class="table table-sm table-bordered align-middle w-auto">
  <thead class="table-light"><tr><th>Angabe</th><th>Bedeutung</th></tr></thead>
  <tbody>
    <tr><td><code>1</code></td><td>genau eins</td></tr>
    <tr><td><code>0..1</code></td><td>keins oder eins (optional)</td></tr>
    <tr><td><code>*</code> oder <code>0..*</code></td><td>beliebig viele, auch keins</td></tr>
    <tr><td><code>1..*</code></td><td>mindestens eins</td></tr>
    <tr><td><code>2..5</code></td><td>zwischen zwei und fünf</td></tr>
  </tbody>
</table>
</div>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf8/klassendiagramm-webshop.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Klassendiagramm mit Kunde, Bestellung, Bestellposition und Artikel samt Multiplizitäten">
  <figcaption class="figure-caption">Klassendiagramm eines Webshops</figcaption>
</figure>
<p>So liest du die Beziehung Kunde–Bestellung: Von der Klasse aus über die Linie zur Zahl am <em>anderen</em> Ende.
„Ein Kunde gibt <strong>0..*</strong> Bestellungen auf“ und „Eine Bestellung gehört zu genau <strong>1</strong> Kunden“.
Entsprechend besteht jede Bestellung aus <strong>mindestens einer</strong> Position, und jede Position verweist auf genau einen Artikel.</p>
<div class="lf-pruefung"><strong>Prüfungstipp:</strong> Bilde zu jeder Beziehung zwei Sätze („Ein A hat … B“, „Ein B gehört zu … A“).
Wenn ein Satz fachlich keinen Sinn ergibt, steht die Zahl am falschen Ende.</div>

<h6>Vom Diagramm zum Code</h6>
<ul>
  <li>Attribute und Methoden werden 1:1 übernommen, die Sichtbarkeit als Schlüsselwort.</li>
  <li>Eine Assoziation mit Multiplizität <code>1</code> oder <code>0..1</code> wird ein Attribut vom Typ der anderen Klasse.</li>
  <li>Bei <code>*</code> oder <code>1..*</code> wird daraus eine Sammlung, meist <code>List&lt;…&gt;</code>.</li>
  <li>Die Navigationsrichtung (Pfeil) entscheidet, <em>welche</em> Klasse das Attribut bekommt. Ohne Pfeil: beide.</li>
  <li>Komposition: Das Ganze erzeugt seine Teile selbst und gibt sie nicht nach außen weiter.</li>
</ul>
<pre class="bg-light border rounded p-3"><code>public class Bestellung {
    private int nummer;
    private LocalDate datum;
    private final Kunde kunde;                                       // 0..* → 1
    private final List&lt;Bestellposition&gt; positionen = new ArrayList&lt;&gt;(); // Komposition 1..*

    public Bestellung(Kunde kunde) {
        this.kunde = kunde;
    }

    // Komposition: Die Bestellung erzeugt ihre Positionen selbst
    public void hinzufuegen(Artikel artikel, int menge) {
        positionen.add(new Bestellposition(artikel, menge));
    }

    public double berechneSumme() {
        double summe = 0;
        for (Bestellposition p : positionen) {
            summe += p.berechneBetrag();      // menge * artikel.getPreis()
        }
        return summe;                         // 2 × 19,90 + 1 × 179,00 = 218,80
    }
}</code></pre>

<h6>Übungen mit Lösung</h6>
<p>1. „Ein Hotel hat mehrere Zimmer. Wird das Hotel abgerissen, gibt es die Zimmer nicht mehr. Gäste buchen Zimmer;
eine Buchung umfasst genau ein Zimmer und genau einen Gast, ein Gast kann mehrere Buchungen haben.“ Welche Beziehungen und Multiplizitäten entstehen?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<ul class="mt-2">
  <li>Hotel ◆— Zimmer: <strong>Komposition</strong>, Hotel <code>1</code>, Zimmer <code>1..*</code></li>
  <li>Gast — Buchung: Gast <code>1</code>, Buchung <code>0..*</code> (ein neuer Gast hat evtl. noch keine)</li>
  <li>Buchung — Zimmer: Buchung <code>0..*</code>, Zimmer <code>1</code></li>
</ul>
</details>
<p>2. Wie sieht in Java das Attribut aus, wenn ein <code>Team</code> per Aggregation <code>0..*</code> Mitarbeiter hat – und was ist der Unterschied zur Komposition im Code?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2"><code>private List&lt;Mitarbeiter&gt; mitglieder = new ArrayList&lt;&gt;();</code> mit einer Methode
<code>aufnehmen(Mitarbeiter m)</code>, die ein <em>von außen</em> übergebenes, bereits existierendes Objekt aufnimmt. Bei der
Komposition erzeugt das Ganze die Teile selbst (<code>new Bestellposition(…)</code> innerhalb von <code>Bestellung</code>).</p>
</details>
<p>3. Im Diagramm steht <code><u>- anzahl : int</u></code> (unterstrichen). Was bedeutet das?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Ein privates <strong>Klassenattribut</strong> (<code>private static int anzahl;</code>), das sich alle Objekte teilen – z. B. ein Zähler für erzeugte Objekte.</p>
</details>
INHALT,
    'summary' => [
        'Klasse = Name, Attribute (Sichtbarkeit name : Typ), Methoden (Sichtbarkeit name(param : Typ) : Rückgabetyp).',
        'Unterstrichen = static, kursiv/«abstract» = abstrakt, «interface» = Interface.',
        'Aggregation (hohle Raute): Teil lebt weiter. Komposition (gefüllte Raute): Teil stirbt mit dem Ganzen.',
        'Generalisierung: durchgezogen + hohles Dreieck; Realisierung: gestrichelt + hohles Dreieck; Abhängigkeit: gestrichelt + offene Spitze.',
        'Multiplizitäten liest man am gegenüberliegenden Ende; * wird im Code zur Liste.',
    ],
    'quiz' => [
        ['question' => 'Woran erkennst du im Diagramm eine Komposition?', 'answer' => 'An der gefüllten (schwarzen) Raute am Ende des Ganzen.'],
        ['question' => 'Was bedeutet die Multiplizität 0..1?', 'answer' => 'Keine oder genau eine Verbindung – die Beziehung ist optional.'],
        ['question' => 'Wie setzt du eine Assoziation mit Multiplizität 1..* in Java um?', 'answer' => 'Als Sammlungsattribut, z. B. List<Bestellposition>; die Regel „mindestens eins“ muss der Code zusätzlich sicherstellen (z. B. im Konstruktor oder beim Speichern).'],
        ['question' => 'Welche Linie verbindet eine Klasse mit einem Interface, das sie implementiert?', 'answer' => 'Eine gestrichelte Linie mit hohler Dreiecksspitze am Interface (Realisierung).'],
    ],
];
