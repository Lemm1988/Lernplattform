<?php
return [
    'title' => 'Zustandsdiagramm und Objektdiagramm',
    'intro' => 'Viele Objekte durchlaufen Zustände: Eine Bestellung ist neu, bezahlt, versendet. Das Zustandsdiagramm legt fest, welche Übergänge erlaubt sind. Das Objektdiagramm zeigt eine Momentaufnahme konkreter Objekte.',
    'goals' => [
        'Zustände, Übergänge, Ereignisse, Bedingungen und Aktionen im Zustandsdiagramm lesen und zeichnen',
        'innere Aktivitäten (entry, do, exit) einsetzen',
        'ein Zustandsdiagramm in Java mit enum umsetzen',
        'ein Objektdiagramm von einem Klassendiagramm unterscheiden und erstellen',
    ],
    'content' => <<<'INHALT'
<h6>Zustandsdiagramm (Zustandsautomat)</h6>
<p>Ein <strong>Zustandsdiagramm</strong> beschreibt das Verhalten <strong>eines</strong> Objekts über seine gesamte Lebensdauer: in welchen
Zuständen es sein kann und durch welche Ereignisse es von einem Zustand in einen anderen wechselt. Es eignet sich für alles mit einem Status –
Bestellungen, Tickets, Benutzerkonten, Ampeln, Automaten.</p>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf11/zustandsdiagramm-bestellung.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Zustandsdiagramm: Neu, Bezahlt, Versendet, Zugestellt und Storniert mit beschrifteten Übergängen und zwei Endzuständen">
  <figcaption class="figure-caption">Die Lebensgeschichte einer Bestellung</figcaption>
</figure>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th>Element</th><th>Darstellung</th><th>Bedeutung</th></tr></thead>
  <tbody>
    <tr><td>Startzustand</td><td>gefüllter Kreis</td><td>Hier beginnt das Leben des Objekts (genau einer).</td></tr>
    <tr><td>Zustand</td><td>Rechteck mit abgerundeten Ecken</td><td>Situation, in der das Objekt eine Weile verharrt, z. B. „Bezahlt“.</td></tr>
    <tr><td>Übergang (Transition)</td><td>Pfeil, beschriftet mit <code>Ereignis [Bedingung] / Aktion</code></td><td>Tritt das Ereignis ein und ist die Bedingung erfüllt, wird die Aktion ausgeführt und der Zustand gewechselt.</td></tr>
    <tr><td>Selbstübergang</td><td>Pfeil zurück in denselben Zustand</td><td>Ereignis wird verarbeitet, der Zustand bleibt (Teilzahlung).</td></tr>
    <tr><td>Endzustand</td><td>Kreis mit Punkt („Bullauge“)</td><td>Das Objekt hat sein Lebensende erreicht; es darf mehrere geben.</td></tr>
    <tr><td>innere Aktivitäten</td><td>im Zustand: <code>entry /</code>, <code>do /</code>, <code>exit /</code></td><td>beim Betreten, solange der Zustand gilt, beim Verlassen</td></tr>
    <tr><td>Zeitereignis</td><td><code>after(14 Tage)</code>, <code>when(Datum)</code></td><td>Übergang nach Ablauf einer Zeit oder zu einem Zeitpunkt</td></tr>
  </tbody>
</table>
<p>Wichtig ist auch, was <strong>fehlt</strong>: Aus „Versendet“ führt kein Pfeil nach „Storniert“. Eine versendete Bestellung kann also nicht mehr
storniert werden – dafür gäbe es einen eigenen Prozess (Rücksendung).</p>

<h6>Vom Diagramm zum Code</h6>
<p>Zustände werden zu einem <code>enum</code>, jedes Ereignis zu einer Methode. Die Methode prüft, ob der Übergang im aktuellen Zustand erlaubt ist,
und wirft sonst eine Exception:</p>
<pre class="bg-light border rounded p-3"><code>enum Status { NEU, BEZAHLT, VERSENDET, ZUGESTELLT, STORNIERT }

public class Bestellung {
    private Status status = Status.NEU;               // Startzustand → Neu
    private final int betragCent;
    private int bezahltCent = 0;

    public Bestellung(int betragCent) { this.betragCent = betragCent; }

    public void bezahlen(int cent) {
        if (status != Status.NEU) throw new IllegalStateException("bezahlen nicht möglich im Zustand " + status);
        bezahltCent += cent;
        if (bezahltCent &gt;= betragCent) {               // Bedingung [vollständig]
            status = Status.BEZAHLT;
            rechnungSenden();                          // entry-Aktivität von „Bezahlt“
        }                                              // sonst: Selbstübergang [Rest offen]
    }

    public void versenden() {
        if (status != Status.BEZAHLT) throw new IllegalStateException("versenden nicht möglich im Zustand " + status);
        status = Status.VERSENDET;
    }

    public void stornieren() {
        switch (status) {
            case NEU -&gt; status = Status.STORNIERT;
            case BEZAHLT -&gt; {
                erstatten(bezahltCent);                // Aktion am Übergang
                status = Status.STORNIERT;
            }
            default -&gt; throw new IllegalStateException("stornieren nicht möglich im Zustand " + status);
        }
    }
    // zustellen() analog
}</code></pre>
<p>Getestet: Nach einer Teilzahlung von 20,00 € einer 39,80-€-Bestellung bleibt der Status <code>NEU</code>, nach der Restzahlung ist er
<code>BEZAHLT</code>. <code>stornieren()</code> nach dem Versand wirft „stornieren nicht möglich im Zustand VERSENDET“, <code>versenden()</code> einer
unbezahlten Bestellung „versenden nicht möglich im Zustand NEU“.</p>
<div class="lf-merke"><strong>Merke:</strong> Ein Zustandsdiagramm ist eine Spezifikation für Tests: Jeder Pfeil ist ein Testfall „Übergang klappt“,
jeder <em>fehlende</em> Pfeil ein Testfall „Ereignis wird abgelehnt“ (vgl. LF8 Kapitel 14).</div>

<h6>Objektdiagramm</h6>
<p>Ein <strong>Objektdiagramm</strong> ist eine <strong>Momentaufnahme</strong>: Es zeigt konkrete Objekte mit ihren aktuellen Attributwerten und
Verbindungen (Links) zu einem bestimmten Zeitpunkt. Das Klassendiagramm ist der Bauplan, das Objektdiagramm ein Foto davon, was gerade im Speicher steht.</p>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf11/objektdiagramm.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Objektdiagramm mit Kunde kaya, zwei Bestellungen, zwei Positionen und zwei Artikeln mit konkreten Attributwerten">
  <figcaption class="figure-caption">Eine Kundin, zwei Bestellungen – mit echten Werten statt Datentypen</figcaption>
</figure>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th></th><th>Klassendiagramm</th><th>Objektdiagramm</th></tr></thead>
  <tbody>
    <tr><th>Kopf</th><td><code>Kunde</code></td><td><u><code>kaya : Kunde</code></u> (unterstrichen)</td></tr>
    <tr><th>Attribute</th><td><code>- name : String</code></td><td><code>name = "Kaya"</code></td></tr>
    <tr><th>Methoden</th><td>werden angegeben</td><td>entfallen</td></tr>
    <tr><th>Beziehungen</th><td>Assoziationen mit Multiplizitäten (1, 0..*)</td><td>Links ohne Multiplizitäten – jede Verbindung einzeln</td></tr>
  </tbody>
</table>
<p>Objektdiagramme helfen, ein abstraktes Klassendiagramm zu prüfen („Geht das so überhaupt?“) und Testdaten zu beschreiben. Das hier gezeigte
Objektdiagramm passt zu einem Klassendiagramm mit <code>Kunde 1 — 0..* Bestellung 1 — 1..* Position * — 1 Artikel</code>.</p>

<h6>Übungen mit Lösung</h6>
<p>1. Ein Benutzerkonto ist zunächst <em>unbestätigt</em>. Mit <code>bestaetigen()</code> wird es <em>aktiv</em>. Nach drei Fehlversuchen beim Login
wird es <em>gesperrt</em>; ein Admin kann es mit <code>entsperren()</code> wieder aktivieren. <code>loeschen()</code> ist in jedem Zustand möglich und
beendet den Lebenszyklus. Beschreibe Zustände und Übergänge.</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Start → <strong>Unbestätigt</strong> –bestaetigen()→ <strong>Aktiv</strong>. Aktiv –loginFehlgeschlagen() [fehlversuche &lt; 2] / fehlversuche++→ Aktiv
(Selbstübergang). Aktiv –loginFehlgeschlagen() [fehlversuche = 2]→ <strong>Gesperrt</strong>. Gesperrt –entsperren() / fehlversuche = 0→ Aktiv.
Von Unbestätigt, Aktiv und Gesperrt jeweils –loeschen()→ Endzustand.</p>
</details>
<p>2. Welche Beschriftung hat der Übergang „Wenn ein Kunde zahlt und der Betrag reicht, wird eine Rechnung erstellt“?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2"><code>bezahlen(betrag) [betrag ≥ offenerBetrag] / rechnungErstellen()</code> – Ereignis, Bedingung in eckigen Klammern, Aktion nach dem Schrägstrich.</p>
</details>
<p>3. Worin unterscheidet sich <u><code>b1001 : Bestellung</code></u> von <code>Bestellung</code>?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Das erste ist ein konkretes Objekt (Instanz) namens b1001 im Objektdiagramm, unterstrichen. Das zweite ist die Klasse im Klassendiagramm.</p>
</details>
INHALT,
    'summary' => [
        'Zustandsdiagramm: Lebenszyklus eines Objekts aus Zuständen und Übergängen.',
        'Übergangsbeschriftung: Ereignis [Bedingung] / Aktion; Zeitereignisse mit after(…) oder when(…).',
        'Innere Aktivitäten: entry (beim Betreten), do (während), exit (beim Verlassen).',
        'Umsetzung: enum für Zustände, Methoden für Ereignisse, IllegalStateException für verbotene Übergänge.',
        'Objektdiagramm: Momentaufnahme mit unterstrichenen Objektnamen, konkreten Werten und Links.',
    ],
    'quiz' => [
        ['question' => 'Wie lautet das Schema für die Beschriftung eines Übergangs?', 'answer' => 'Ereignis [Bedingung] / Aktion – jeder Teil ist optional.'],
        ['question' => 'Was bedeutet entry / rechnungSenden in einem Zustand?', 'answer' => 'Die Aktivität wird jedes Mal ausgeführt, wenn das Objekt den Zustand betritt – egal über welchen Übergang.'],
        ['question' => 'Wie viele Start- und Endzustände darf ein Zustandsdiagramm haben?', 'answer' => 'Genau einen Startzustand, aber beliebig viele (auch keinen) Endzustand.'],
        ['question' => 'Was zeigt ein Objektdiagramm, was ein Klassendiagramm nicht zeigt?', 'answer' => 'Konkrete Objekte mit ihren aktuellen Attributwerten und einzelnen Verbindungen zu einem bestimmten Zeitpunkt.'],
    ],
];
