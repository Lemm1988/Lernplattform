<?php
return [
    'title' => 'Objektorientierung in Java umsetzen',
    'intro' => 'Interfaces, Exceptions, Collections und eine erste grafische Oberfläche – die Werkzeuge, mit denen aus Klassen eine robuste Anwendung wird.',
    'goals' => [
        'Interfaces implementieren und Objekte über ihren Interface-Typ nutzen',
        'Fehler mit Exceptions behandeln und checked von unchecked Exceptions unterscheiden',
        'mit ArrayList, HashMap und Comparator arbeiten',
        'eine einfache Swing-Oberfläche mit Ereignisbehandlung aufbauen und das MVC-Muster erklären',
    ],
    'content' => <<<'INHALT'
<h6>Interfaces implementieren</h6>
<p>Ein Interface legt fest, <em>was</em> eine Klasse können muss. Wer es implementiert, verpflichtet sich, alle abstrakten Methoden anzubieten.
Der aufrufende Code arbeitet nur mit dem Interface-Typ und muss die konkrete Klasse nicht kennen – neue Zahlungsarten lassen sich
ergänzen, ohne den Bestellprozess anzufassen.</p>
<pre class="bg-light border rounded p-3"><code>public interface Zahlungsart {
    double gebuehr(double betrag);                       // abstrakt – muss jede Klasse liefern
    default String name() { return getClass().getSimpleName(); }   // Standardumsetzung
}

public class Rechnung implements Zahlungsart {
    public double gebuehr(double betrag) { return 0.0; }
}

public class Kreditkarte implements Zahlungsart {
    public double gebuehr(double betrag) { return betrag * 0.015; }   // 1,5 %
}

Zahlungsart[] arten = { new Rechnung(), new Kreditkarte() };
for (Zahlungsart z : arten) {
    System.out.printf("%s: %.2f%n", z.name(), z.gebuehr(200));   // Rechnung: 0,00  Kreditkarte: 3,00
}</code></pre>

<h6>Fehler behandeln mit Exceptions</h6>
<p>Eine <strong>Exception</strong> ist ein Objekt, das einen Ausnahmezustand meldet. Sie wird mit <code>throw</code> ausgelöst und mit
<code>try … catch</code> abgefangen. Der <code>finally</code>-Block läuft immer – auch nach einem Fehler –, etwa um eine Datei oder
Datenbankverbindung zu schließen.</p>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf8/exception-hierarchie.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Hierarchie: Throwable mit Error und Exception, darunter geprüfte Exceptions und RuntimeException mit ungeprüften Exceptions">
  <figcaption class="figure-caption">Checked Exceptions muss man behandeln, unchecked nicht</figcaption>
</figure>
<pre class="bg-light border rounded p-3"><code>// Eigene, fachliche Exception (checked, weil sie von Exception erbt)
public class BestandZuGeringException extends Exception {
    public BestandZuGeringException(String meldung) { super(meldung); }
}

public void entnehmen(int menge) throws BestandZuGeringException {
    if (menge &lt;= 0) {
        throw new IllegalArgumentException("Menge muss positiv sein");   // unchecked: Programmierfehler
    }
    if (menge &gt; bestand) {
        throw new BestandZuGeringException(name + ": nur " + bestand + " Stück da");
    }
    bestand -= menge;
}

try {
    monitor.entnehmen(5);
} catch (BestandZuGeringException e) {
    System.out.println("Fehler: " + e.getMessage());    // Fehler: Monitor: nur 4 Stück da
} finally {
    System.out.println("finally läuft immer");
}</code></pre>
<div class="lf-merke"><strong>Merke:</strong> <em>Checked</em> Exceptions (Unterklassen von <code>Exception</code>, aber nicht von
<code>RuntimeException</code>) zwingt der Compiler dich zu behandeln oder mit <code>throws</code> weiterzugeben – sie beschreiben
erwartbare Probleme wie „Datei fehlt“. <em>Unchecked</em> Exceptions (<code>RuntimeException</code>) zeigen meist Programmierfehler,
die man durch besseren Code vermeidet statt sie abzufangen. Leere <code>catch</code>-Blöcke sind ein Fehler: Der Fehler verschwindet spurlos.</div>

<h6>Collections: Listen, Maps und Sortieren</h6>
<div class="table-responsive">
<table class="table table-sm table-bordered align-middle">
  <thead class="table-light"><tr><th>Klasse</th><th>Eigenschaft</th><th>Typischer Einsatz</th></tr></thead>
  <tbody>
    <tr><td><code>ArrayList&lt;E&gt;</code></td><td>geordnete Liste, Duplikate erlaubt, wächst automatisch</td><td>Warenkorb, Suchergebnisse</td></tr>
    <tr><td><code>HashSet&lt;E&gt;</code></td><td>keine Duplikate, keine Reihenfolge</td><td>bereits gesehene IDs</td></tr>
    <tr><td><code>HashMap&lt;K,V&gt;</code></td><td>Schlüssel-Wert-Paare, Schlüssel eindeutig</td><td>Artikelnummer → Artikel, Wort → Anzahl</td></tr>
  </tbody>
</table>
</div>
<pre class="bg-light border rounded p-3"><code>List&lt;Artikel&gt; artikel = new ArrayList&lt;&gt;();
artikel.add(new Artikel("Monitor", 179.0, 4));
artikel.add(new Artikel("Maus", 19.9, 30));
artikel.add(new Artikel("Tastatur", 39.0, 12));

artikel.sort(Comparator.comparingDouble((Artikel a) -&gt; a.preis));   // Maus, Tastatur, Monitor

Map&lt;String, Integer&gt; zaehler = new HashMap&lt;&gt;();
for (String wort : "rot grün rot blau rot grün".split(" ")) {
    zaehler.merge(wort, 1, Integer::sum);       // vorhandenen Wert um 1 erhöhen
}
System.out.println(zaehler.get("rot"));          // 3</code></pre>
<p>Soll eine Klasse eine <strong>natürliche Sortierung</strong> haben, implementiert sie <code>Comparable&lt;T&gt;</code> mit
<code>compareTo</code>. Für wechselnde Sortierungen (nach Preis, nach Name …) übergibt man einen <code>Comparator</code>.
Überschreibe außerdem <code>toString()</code> für eine lesbare Ausgabe und – wenn Objekte inhaltlich verglichen werden sollen –
<code>equals()</code> und <code>hashCode()</code> immer gemeinsam.</p>

<h6>Eine grafische Oberfläche mit Swing</h6>
<p>Java bringt mit <strong>Swing</strong> eine GUI-Bibliothek mit (moderner: JavaFX). Eine Oberfläche besteht aus einem Fenster
(<code>JFrame</code>), Bedienelementen (<code>JButton</code>, <code>JLabel</code>, <code>JTextField</code>) und einem Layout-Manager,
der sie anordnet. Auf Benutzeraktionen reagiert man mit einem <strong>Listener</strong>: Das Programm wartet nicht aktiv, sondern wird
bei einem Ereignis aufgerufen (ereignisgesteuerte Programmierung). Werkzeuge wie der WindowBuilder in Eclipse erzeugen diesen Code per Drag and Drop.</p>
<pre class="bg-light border rounded p-3"><code>JFrame fenster = new JFrame("Klickzähler");
JLabel anzeige = new JLabel("0 Klicks", SwingConstants.CENTER);
JButton knopf = new JButton("Klick mich");

knopf.addActionListener(e -&gt; {                 // Ereignis: Button wurde geklickt
    zaehlerstand++;
    anzeige.setText(zaehlerstand + " Klicks");
});

fenster.setLayout(new BorderLayout(10, 10));
fenster.add(anzeige, BorderLayout.CENTER);
fenster.add(knopf, BorderLayout.SOUTH);
fenster.setSize(260, 140);
fenster.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
fenster.setVisible(true);</code></pre>

<h6>Das MVC-Muster</h6>
<p>Sobald eine Anwendung wächst, trennt man Darstellung, Steuerung und Daten. Das <strong>Model-View-Controller</strong>-Muster ist der
Standard dafür – in Desktop-Anwendungen genauso wie in Web-Frameworks.</p>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf8/mvc.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Der Benutzer bedient die View, die View meldet dem Controller ein Ereignis, der Controller ändert das Model, das Model meldet die Änderung an die View, die View liest die neuen Daten">
  <figcaption class="figure-caption">Model-View-Controller: Jede Schicht hat genau eine Aufgabe</figcaption>
</figure>
<ul>
  <li><strong>Model:</strong> Daten und Fachlogik (z. B. <code>Artikel</code>, Bestandsprüfung). Kennt die Oberfläche nicht und lässt sich deshalb einzeln testen.</li>
  <li><strong>View:</strong> zeigt die Daten an und nimmt Eingaben entgegen. Enthält keine Fachlogik.</li>
  <li><strong>Controller:</strong> verarbeitet Eingaben, ruft das Model auf und entscheidet, was als Nächstes angezeigt wird.</li>
</ul>
<p>Vorteile: Die Oberfläche lässt sich austauschen (Desktop, Web, App), ohne die Fachlogik neu zu schreiben, und mehrere Entwickler
können parallel arbeiten.</p>

<h6>Übungen mit Lösung</h6>
<p>1. Warum kompiliert dieser Code nicht? <code>public void laden() { new FileReader("daten.csv"); }</code></p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Der Konstruktor von <code>FileReader</code> kann eine <code>FileNotFoundException</code> werfen – eine <strong>checked</strong> Exception.
Sie muss mit <code>try … catch</code> behandelt oder per <code>throws FileNotFoundException</code> (bzw. <code>IOException</code>) in der Methodensignatur weitergegeben werden.</p>
</details>
<p>2. Welche Collection nimmst du für „Kundennummer → Kunde, schneller Zugriff über die Nummer“?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Eine <code>HashMap&lt;Integer, Kunde&gt;</code> (bzw. <code>Map&lt;Integer, Kunde&gt;</code>): Zugriff über den eindeutigen Schlüssel mit <code>get(nummer)</code>.</p>
</details>
<p>3. In einer Anwendung berechnet der Button-Listener direkt den Rabatt und schreibt in die Datenbank. Was verbessert MVC hier?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Rabattberechnung und Speichern gehören ins <strong>Model</strong> (bzw. eine Fachklasse), der Listener ruft nur den
<strong>Controller</strong> auf. So lässt sich die Rabattlogik ohne Oberfläche testen und wiederverwenden, und die View bleibt austauschbar.</p>
</details>
INHALT,
    'summary' => [
        'Interfaces entkoppeln: Code nutzt den Interface-Typ, konkrete Klassen sind austauschbar.',
        'throw löst aus, try-catch fängt, finally läuft immer; checked Exceptions muss man behandeln oder mit throws weitergeben.',
        'ArrayList = Liste, HashSet = ohne Duplikate, HashMap = Schlüssel → Wert; sortieren mit Comparable oder Comparator.',
        'GUI-Programme sind ereignisgesteuert: Listener reagieren auf Benutzeraktionen.',
        'MVC trennt Daten/Logik (Model), Darstellung (View) und Steuerung (Controller).',
    ],
    'quiz' => [
        ['question' => 'Was ist der Unterschied zwischen throw und throws?', 'answer' => 'throw löst eine Exception aus (Anweisung im Methodenrumpf). throws steht in der Methodensignatur und kündigt an, dass die Methode eine (checked) Exception weitergeben kann.'],
        ['question' => 'Wann wird der finally-Block ausgeführt?', 'answer' => 'Immer – nach dem try-Block, egal ob eine Exception auftrat, abgefangen wurde oder nicht (außer das Programm wird hart beendet).'],
        ['question' => 'Welche Aufgabe hat das Model im MVC-Muster?', 'answer' => 'Es enthält die Daten und die Fachlogik und ist unabhängig von View und Controller.'],
        ['question' => 'Wozu dient ein ActionListener in Swing?', 'answer' => 'Er enthält den Code, der bei einem Ereignis ausgeführt wird, z. B. wenn ein Button geklickt wird.'],
    ],
];
