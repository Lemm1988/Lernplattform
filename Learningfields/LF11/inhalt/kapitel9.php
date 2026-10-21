<?php
return [
    'title' => 'Entwurfsmuster',
    'intro' => 'Viele Entwurfsprobleme tauchen immer wieder auf. Entwurfsmuster sind erprobte Lösungsschablonen dafür – und ein gemeinsames Vokabular im Team.',
    'goals' => [
        'Entwurfsmuster definieren und den drei Kategorien zuordnen',
        'Singleton, Fabrikmethode, Adapter, Observer und Strategy erklären und in Java umsetzen',
        'MVC und DAO als Architekturmuster einordnen',
        'für eine Problemstellung das passende Muster auswählen',
    ],
    'content' => <<<'INHALT'
<h6>Was ist ein Entwurfsmuster?</h6>
<p>Ein <strong>Entwurfsmuster</strong> (Design Pattern) beschreibt eine bewährte, wiederverwendbare Lösung für ein wiederkehrendes Entwurfsproblem –
kein fertiger Code, sondern eine Schablone aus Klassen, Interfaces und ihren Beziehungen. Bekannt wurden sie 1994 durch das Buch der „Gang of Four“
(GoF) mit 23 Mustern in drei Kategorien:</p>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th>Kategorie</th><th>Frage</th><th>Beispiele</th></tr></thead>
  <tbody>
    <tr><td>Erzeugungsmuster</td><td>Wie entstehen Objekte?</td><td>Singleton, Fabrikmethode, Builder</td></tr>
    <tr><td>Strukturmuster</td><td>Wie setzt man Klassen und Objekte zusammen?</td><td>Adapter, Decorator, Fassade, Kompositum</td></tr>
    <tr><td>Verhaltensmuster</td><td>Wie arbeiten Objekte zusammen?</td><td>Observer, Strategy, Iterator, Command</td></tr>
  </tbody>
</table>
<p>Der Nutzen geht über den Code hinaus: Sagt jemand im Team „das lösen wir mit einem Observer“, wissen alle sofort, wie der Entwurf aussieht.</p>

<h6>Singleton (Erzeugungsmuster)</h6>
<p><strong>Problem:</strong> Von einer Klasse darf es genau ein Objekt geben, auf das alle zugreifen – etwa die Konfiguration oder ein Logger.
<strong>Lösung:</strong> privater Konstruktor, eine statische Instanz und eine statische Zugriffsmethode.</p>
<pre class="bg-light border rounded p-3"><code>public final class Konfiguration {
    private static final Konfiguration INSTANZ = new Konfiguration();   // einmalig beim Laden der Klasse
    private final String waehrung = "EUR";

    private Konfiguration() { }                 // von außen kein new möglich

    public static Konfiguration getInstanz() {
        return INSTANZ;
    }

    public String getWaehrung() { return waehrung; }
}

Konfiguration a = Konfiguration.getInstanz();
Konfiguration b = Konfiguration.getInstanz();
// a == b → true, der Konstruktor lief nur einmal</code></pre>
<p>Kritik: Ein Singleton ist globaler Zustand – Klassen, die es benutzen, verstecken diese Abhängigkeit und sind schwer zu testen. Oft ist es besser,
ein einziges Objekt zu erzeugen und es per Konstruktor weiterzureichen (Dependency Injection, <a href="/Learningfields/LF11/kapitel8.php">Kapitel 8</a>).</p>

<h6>Fabrikmethode (Erzeugungsmuster)</h6>
<p><strong>Problem:</strong> Der aufrufende Code soll nicht wissen müssen, welche konkrete Klasse er erzeugt.
<strong>Lösung:</strong> Eine Methode entscheidet, welches Objekt entsteht, und liefert es über ein gemeinsames Interface zurück.</p>
<pre class="bg-light border rounded p-3"><code>interface Zahlungsart {
    String bezahlen(int cent);
}

class ZahlungsFabrik {
    static Zahlungsart erzeuge(String art) {
        return switch (art) {
            case "paypal"   -&gt; new PayPal();
            case "rechnung" -&gt; new Rechnung();
            default -&gt; throw new IllegalArgumentException("Unbekannte Zahlungsart: " + art);
        };
    }
}

Zahlungsart z = ZahlungsFabrik.erzeuge(auswahlDesKunden);   // z. B. "paypal"
z.bezahlen(3980);                                           // "PayPal: 3980 Cent"</code></pre>
<p>Diese einfache Form heißt oft „statische Fabrik“; in der GoF-Variante legen Unterklassen fest, welches Produkt die Fabrikmethode erzeugt.</p>

<h6>Adapter (Strukturmuster)</h6>
<p><strong>Problem:</strong> Eine vorhandene Klasse (z. B. aus einer Bibliothek oder einem Altsystem) passt nicht zum Interface, das dein Code erwartet.
<strong>Lösung:</strong> Eine Adapterklasse implementiert das erwartete Interface und übersetzt die Aufrufe – wie ein Reisestecker.</p>
<pre class="bg-light border rounded p-3"><code>class AltesKassensystem {                          // fremder Code, nicht änderbar
    String zahleEuro(double euro) { … }
}

class KassenAdapter implements Zahlungsart {
    private final AltesKassensystem alt = new AltesKassensystem();

    public String bezahlen(int cent) {
        return alt.zahleEuro(cent / 100.0);       // Cent → Euro übersetzen
    }
}
// new KassenAdapter().bezahlen(3980) → "Altsystem: 39,80 €"</code></pre>

<h6>Observer und Strategy (Verhaltensmuster)</h6>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf11/observer-strategy.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Klassendiagramme: Lager mit Interface Beobachter und den Implementierungen Shopanzeige und Einkauf; Warenkorb mit Interface Versandstrategie und den Implementierungen Standardversand und Expressversand">
  <figcaption class="figure-caption">Zwei Muster, ein Grundgedanke: Die Klasse kennt nur ein Interface</figcaption>
</figure>
<p><strong>Observer</strong> – Problem: Wenn sich etwas ändert, sollen beliebig viele andere Objekte informiert werden, ohne dass die Quelle sie
kennen muss. Lösung: Beobachter melden sich beim Subjekt an; bei einer Änderung ruft das Subjekt bei allen dieselbe Interface-Methode auf.</p>
<pre class="bg-light border rounded p-3"><code>interface Beobachter {
    void bestandGeaendert(String artikel, int bestand);
}

class Lager {
    private final List&lt;Beobachter&gt; beobachter = new ArrayList&lt;&gt;();
    void anmelden(Beobachter b) { beobachter.add(b); }
    void abmelden(Beobachter b) { beobachter.remove(b); }

    void setBestand(String artikel, int bestand) {
        for (Beobachter b : beobachter) {
            b.bestandGeaendert(artikel, bestand);    // alle benachrichtigen
        }
    }
}

class Einkauf implements Beobachter {
    public void bestandGeaendert(String artikel, int bestand) {
        if (bestand &lt; 3) System.out.println("Einkauf: " + artikel + " nachbestellen");
    }
}</code></pre>
<p>Mit angemeldeter Shopanzeige und Einkauf führt <code>setBestand("Maus", 2)</code> zu „Anzeige: Maus lieferbar“ und „Einkauf: Maus nachbestellen“.
Nach <code>abmelden(einkauf)</code> meldet <code>setBestand("Maus", 0)</code> nur noch „Anzeige: Maus ausverkauft“. Event-Listener in GUIs
(<a href="/Learningfields/LF8/kapitel9.php">LF8 Kapitel 9</a>) sind genau dieses Muster.</p>
<p><strong>Strategy</strong> – Problem: Ein Algorithmus soll austauschbar sein, ohne die nutzende Klasse zu ändern. Lösung: Jede Variante ist eine
Klasse mit demselben Interface; die nutzende Klasse hält eine Referenz darauf, die man auch zur Laufzeit wechseln kann.</p>
<pre class="bg-light border rounded p-3"><code>interface Versandstrategie {
    int kostenCent(int gewichtGramm);
}

class Warenkorb {
    private Versandstrategie versand = new Standardversand();
    void setVersand(Versandstrategie v) { versand = v; }
    int versandkosten(int gewicht) { return versand.kostenCent(gewicht); }
}

korb.versandkosten(2500);                  // 690  (Standard)
korb.setVersand(new Expressversand());
korb.versandkosten(2500);                  // 1490 (Express)
korb.setVersand(g -&gt; 0);                   // Lambda als Strategie: Gratisversand → 0</code></pre>
<p>Die Rabattregeln aus <a href="/Learningfields/LF11/kapitel8.php">Kapitel 8</a> (Open/Closed-Prinzip) sind ebenfalls eine Strategy. Auch <code>Comparator</code> beim Sortieren ist eine Strategie.</p>

<h6>Architekturmuster</h6>
<p>Muster gibt es auch eine Ebene höher, für den Aufbau ganzer Anwendungen:</p>
<ul>
  <li><strong>MVC</strong> (Model-View-Controller, <a href="/Learningfields/LF8/kapitel9.php">LF8 Kapitel 9</a>): trennt Daten und Logik, Darstellung und Steuerung. Die View beobachtet oft das Model – ein Observer.</li>
  <li><strong>Schichtenarchitektur</strong>: Präsentation → Geschäftslogik → Datenzugriff; jede Schicht nutzt nur die darunterliegende.</li>
  <li><strong>DAO / Repository</strong> (<a href="/Learningfields/LF8/kapitel11.php">LF8 Kapitel 11</a>): kapselt den Datenbankzugriff hinter einem Interface.</li>
</ul>

<h6>Übersicht</h6>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th>Muster</th><th>Kategorie</th><th>Wann einsetzen?</th></tr></thead>
  <tbody>
    <tr><td>Singleton</td><td>Erzeugung</td><td>genau ein Objekt einer Klasse (Konfiguration, Logger)</td></tr>
    <tr><td>Fabrikmethode</td><td>Erzeugung</td><td>Erzeugung konkreter Klassen an einer Stelle bündeln</td></tr>
    <tr><td>Builder</td><td>Erzeugung</td><td>Objekte mit vielen optionalen Parametern schrittweise aufbauen</td></tr>
    <tr><td>Adapter</td><td>Struktur</td><td>unpassende Schnittstelle anpassen</td></tr>
    <tr><td>Decorator</td><td>Struktur</td><td>Objekt zur Laufzeit um Funktionen erweitern (z. B. Java-Streams: <code>new BufferedReader(new FileReader(…))</code>)</td></tr>
    <tr><td>Fassade</td><td>Struktur</td><td>einfache Schnittstelle vor ein kompliziertes Subsystem setzen</td></tr>
    <tr><td>Observer</td><td>Verhalten</td><td>viele Objekte über Änderungen informieren</td></tr>
    <tr><td>Strategy</td><td>Verhalten</td><td>Algorithmus austauschbar machen</td></tr>
    <tr><td>Iterator</td><td>Verhalten</td><td>Elemente einer Sammlung durchlaufen, ohne ihren Aufbau zu kennen (for-each)</td></tr>
  </tbody>
</table>

<h6>Übungen mit Lösung</h6>
<p>1. Welches Muster passt? a) Ein Newsletter-Dienst informiert alle Abonnenten über einen neuen Artikel. b) Eine Navigations-App berechnet die Route
wahlweise schnellstmöglich, kürzestmöglich oder ohne Autobahn. c) Eine neue Software soll einen alten Barcode-Scanner mit eigener Schnittstelle nutzen.</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">a) Observer, b) Strategy, c) Adapter.</p>
</details>
<p>2. Warum ist der Konstruktor beim Singleton <code>private</code>?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Damit niemand außerhalb der Klasse mit <code>new</code> weitere Objekte erzeugen kann. Der einzige Weg zum Objekt führt über <code>getInstanz()</code>.</p>
</details>
<p>3. Was haben Strategy und Observer gemeinsam, und worin unterscheiden sie sich?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Gemeinsam: Die Klasse arbeitet nur mit einem Interface, konkrete Klassen sind austauschbar (Dependency Inversion). Unterschied: Bei Strategy gibt es
<em>eine</em> aktive Implementierung, die eine Aufgabe <em>erledigt</em>; beim Observer gibt es <em>beliebig viele</em>, die über ein Ereignis
<em>benachrichtigt</em> werden.</p>
</details>
INHALT,
    'summary' => [
        'Entwurfsmuster = bewährte Lösungsschablone für wiederkehrende Entwurfsprobleme; GoF: Erzeugungs-, Struktur-, Verhaltensmuster.',
        'Singleton: privater Konstruktor, statische Instanz, getInstanz() – Vorsicht, globaler Zustand.',
        'Fabrikmethode bündelt die Erzeugung; Adapter übersetzt zwischen unpassenden Schnittstellen.',
        'Observer: Subjekt benachrichtigt alle angemeldeten Beobachter; Strategy: austauschbarer Algorithmus hinter einem Interface.',
        'Architekturmuster: MVC, Schichten, DAO/Repository.',
    ],
    'quiz' => [
        ['question' => 'Zu welcher Kategorie gehört das Adapter-Muster?', 'answer' => 'Zu den Strukturmustern.'],
        ['question' => 'Welches Problem löst das Observer-Muster?', 'answer' => 'Beliebig viele Objekte sollen über Änderungen eines Objekts informiert werden, ohne dass dieses die konkreten Empfänger kennen muss.'],
        ['question' => 'Wie sorgt ein Singleton dafür, dass es nur eine Instanz gibt?', 'answer' => 'Durch einen privaten Konstruktor und eine statische Methode, die immer dieselbe, einmal erzeugte Instanz zurückgibt.'],
        ['question' => 'Warum ist Comparator ein Beispiel für Strategy?', 'answer' => 'Der Sortieralgorithmus bleibt gleich, die Vergleichsregel wird als austauschbares Objekt hinter einem Interface übergeben.'],
    ],
];
