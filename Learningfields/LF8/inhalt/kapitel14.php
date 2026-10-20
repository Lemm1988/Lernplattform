<?php
return [
    'title' => 'Testen, Dokumentieren und Abnehmen',
    'intro' => 'Wie du systematisch Testfälle findest, sie mit JUnit automatisierst, deine Software dokumentierst und sie am Ende sauber an den Kunden übergibst.',
    'goals' => [
        'Teststufen im V-Modell sowie statische und dynamische Tests unterscheiden',
        'Testfälle mit Äquivalenzklassen und Grenzwertanalyse (Black-Box) ableiten',
        'Anweisungs-, Zweig- und Pfadüberdeckung (White-Box) bestimmen',
        'Unit-Tests mit JUnit 5 schreiben und Testgeneratoren, Mocks und TDD einordnen',
        'Dokumentationsarten nennen und ein Abnahmeprotokoll erstellen',
    ],
    'content' => <<<'INHALT'
<h6>Warum testen – und was Testen nicht kann</h6>
<p>Ein Mensch macht einen <strong>Fehler</strong> (Irrtum, z. B. <code>&gt;</code> statt <code>&gt;=</code>), dadurch steckt ein
<strong>Defekt</strong> (Bug) im Code, und wenn diese Stelle ausgeführt wird, zeigt sich eine <strong>Fehlerwirkung</strong>
(falsche Versandkosten auf der Rechnung). Tests sollen Fehlerwirkungen finden, <em>bevor</em> der Kunde sie findet.
Wichtig: Tests können nur die <strong>Anwesenheit</strong> von Fehlern zeigen, nie ihre Abwesenheit. Und: Testen findet Fehler,
<strong>Debuggen</strong> sucht anschließend die Ursache und behebt sie.</p>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th>statischer Test</th><th>dynamischer Test</th></tr></thead>
  <tbody>
    <tr><td>Code wird <strong>nicht</strong> ausgeführt</td><td>Programm wird mit Testdaten <strong>ausgeführt</strong></td></tr>
    <tr><td>Review, Walkthrough, Inspektion, statische Codeanalyse (Linter, Compiler-Warnungen)</td><td>Black-Box- und White-Box-Tests, Unit-Tests, Systemtests</td></tr>
    <tr><td>findet z. B. unlesbaren Code, Sicherheitslücken, Abweichungen von Richtlinien</td><td>findet falsches Verhalten zur Laufzeit</td></tr>
  </tbody>
</table>

<h6>Teststufen im V-Modell</h6>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf8/v-modell.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="V-Modell: links Anforderungen bis Komponentenentwurf, unten Implementierung, rechts Komponententest bis Abnahmetest">
  <figcaption class="figure-caption">Jede Teststufe prüft gegen die Entwurfsstufe auf gleicher Höhe</figcaption>
</figure>
<ul>
  <li><strong>Komponententest</strong> (Unit-Test): einzelne Methoden und Klassen isoliert, meist vom Entwickler, automatisiert.</li>
  <li><strong>Integrationstest</strong>: Zusammenspiel mehrerer Komponenten und Schnittstellen (z. B. DAO mit echter Testdatenbank, REST-Aufruf).</li>
  <li><strong>Systemtest</strong>: das ganze System gegen das Pflichtenheft, in einer Testumgebung, die der Produktion möglichst gleicht.</li>
  <li><strong>Abnahmetest</strong>: der Kunde prüft, ob der Vertrag erfüllt ist – oft mit echten Arbeitsabläufen.</li>
</ul>
<p>Nach jeder Änderung prüft ein <strong>Regressionstest</strong> (alle bisherigen Tests erneut), ob dabei etwas kaputtgegangen ist –
das geht praktisch nur automatisiert.</p>

<h6>Black-Box-Test: Äquivalenzklassen und Grenzwerte</h6>
<p>Beim Black-Box-Test kennst du nur die <strong>Spezifikation</strong>, nicht den Code. Unsere Anforderung:</p>
<div class="border rounded p-3 mb-3 bg-light"><em>„Bestellungen unter 50 € kosten 4,90 € Versand, ab 50 € ist der Versand frei.
Expressversand kostet 9,90 € Aufschlag. Ein negativer Warenwert ist ein Fehler.“</em></div>
<p>Alle Werte auszuprobieren ist unmöglich. Deshalb teilt man die Eingaben in <strong>Äquivalenzklassen</strong>: Gruppen, für die sich
das Programm laut Spezifikation gleich verhalten soll. Aus jeder Klasse genügt ein <em>Repräsentant</em>. Weil Fehler besonders gern an
den Rändern stecken, ergänzt die <strong>Grenzwertanalyse</strong> Tests direkt links und rechts jeder Grenze.</p>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf8/grenzwerte.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Zahlenstrahl mit drei Äquivalenzklassen für den Warenwert und den Grenzwerten -1, 0, 4999 und 5000">
  <figcaption class="figure-caption">Drei Klassen für den Warenwert, Grenzwerte an beiden Klassengrenzen</figcaption>
</figure>
<p>Geldbeträge rechnen wir in <strong>Cent als <code>int</code></strong> – so gibt es keine Rundungsfehler wie bei <code>double</code>.
Daraus entsteht die Testfalltabelle:</p>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th>Nr.</th><th>Warenwert (Cent)</th><th>Express</th><th>Herkunft</th><th>erwartetes Ergebnis</th></tr></thead>
  <tbody>
    <tr><td>T1</td><td>-50</td><td>nein</td><td>Repräsentant ÄK 1</td><td>Exception</td></tr>
    <tr><td>T2</td><td>-1</td><td>nein</td><td>Grenzwert ÄK 1</td><td>Exception</td></tr>
    <tr><td>T3</td><td>0</td><td>nein</td><td>Grenzwert ÄK 2</td><td>490</td></tr>
    <tr><td>T4</td><td>2000</td><td>nein</td><td>Repräsentant ÄK 2</td><td>490</td></tr>
    <tr><td>T5</td><td>4999</td><td>ja</td><td>Grenzwert ÄK 2</td><td>1480</td></tr>
    <tr><td>T6</td><td>5000</td><td>nein</td><td>Grenzwert ÄK 3</td><td>0</td></tr>
    <tr><td>T7</td><td>8000</td><td>ja</td><td>Repräsentant ÄK 3</td><td>990</td></tr>
  </tbody>
</table>
<p>Für die zweite Eingabe <em>Express</em> gibt es nur die Klassen <code>true</code> und <code>false</code>; beide kommen in der Tabelle vor.</p>

<h6>White-Box-Test: Überdeckungsgrade</h6>
<p>Beim White-Box-Test schaust du in den <strong>Code</strong> und wählst Testfälle so, dass bestimmte Teile durchlaufen werden.
Dazu zeichnet man den <strong>Kontrollflussgraphen</strong>:</p>
<pre class="bg-light border rounded p-3"><code>/**
 * Versandkostenberechnung für den Webshop.
 */
public class Versand {

    /**
     * Berechnet die Versandkosten einer Bestellung.
     *
     * @param warenwertCent Warenwert in Cent, darf nicht negativ sein
     * @param express       true, wenn Expressversand gewünscht ist
     * @return Versandkosten in Cent
     * @throws IllegalArgumentException wenn der Warenwert negativ ist
     */
    public static int kostenCent(int warenwertCent, boolean express) {
        if (warenwertCent &lt; 0) {
            throw new IllegalArgumentException("Warenwert darf nicht negativ sein");
        }
        int kosten = 490;
        if (warenwertCent &gt;= 5000) {
            kosten = 0;
        }
        if (express) {
            kosten += 990;
        }
        return kosten;
    }
}</code></pre>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf8/kontrollfluss-ueberdeckung.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Kontrollflussgraph mit drei Entscheidungen und Übersicht: C0 braucht 2, C1 3 und C2 5 Testfälle">
  <figcaption class="figure-caption">Je höher der Überdeckungsgrad, desto mehr Testfälle</figcaption>
</figure>
<ul>
  <li><strong>C0 – Anweisungsüberdeckung</strong>: Jede Anweisung wird mindestens einmal ausgeführt. Schwächstes Kriterium – es prüft z. B. nie,
  was passiert, wenn eine Bedingung <em>falsch</em> ist.</li>
  <li><strong>C1 – Zweigüberdeckung</strong>: Jede Kante des Graphen, also jeder Ja- <em>und</em> Nein-Zweig jeder Entscheidung, wird
  durchlaufen. Gilt als Mindeststandard; wer C1 erfüllt, erfüllt automatisch auch C0.</li>
  <li><strong>C2 – Pfadüberdeckung</strong>: Jeder mögliche Weg vom Start zum Ende. Die Zahl der Pfade wächst schnell (bei Schleifen
  oft unendlich), deshalb in der Praxis selten vollständig erreichbar.</li>
</ul>
<p>Werkzeuge wie <strong>JaCoCo</strong> messen die Überdeckung automatisch beim Ausführen der Unit-Tests. Ein <strong>Grey-Box-Test</strong>
kombiniert beides: Testfälle aus der Spezifikation, ergänzt um Wissen über den inneren Aufbau.</p>

<h6>Unit-Tests mit JUnit 5</h6>
<p>JUnit ist das Standard-Framework für Unit-Tests in Java. Ein Test folgt dem Muster <strong>Arrange – Act – Assert</strong>
(vorbereiten, ausführen, Ergebnis prüfen):</p>
<pre class="bg-light border rounded p-3"><code>import static org.junit.jupiter.api.Assertions.*;

import org.junit.jupiter.api.Test;
import org.junit.jupiter.params.ParameterizedTest;
import org.junit.jupiter.params.provider.CsvSource;

class VersandTest {

    @Test
    void unter50EuroKostetVersand() {
        assertEquals(490, Versand.kostenCent(2000, false));          // erwartet, tatsächlich
    }

    @Test
    void negativerWarenwertWirdAbgelehnt() {
        assertThrows(IllegalArgumentException.class, () -&gt; Versand.kostenCent(-1, false));
    }

    @ParameterizedTest(name = "{0} Cent, express={1} -&gt; {2}")         // ein Test, viele Datensätze
    @CsvSource({
        "0,     false, 490",
        "4999,  false, 490",
        "5000,  false, 0",
        "4999,  true,  1480",
        "5000,  true,  990",
    })
    void grenzwerte(int warenwertCent, boolean express, int erwartet) {
        assertEquals(erwartet, Versand.kostenCent(warenwertCent, express));
    }
}</code></pre>
<p>Alle 7 Tests laufen grün. Baut man absichtlich den typischen Fehler ein (<code>warenwertCent &gt; 5000</code> statt <code>&gt;= 5000</code>),
meldet JUnit genau an der Grenze:</p>
<pre class="bg-light border rounded p-3"><code>✔ 4999 Cent, express=false -&gt; 490
✘ 5000 Cent, express=false -&gt; 0      expected: &lt;0&gt; but was: &lt;490&gt;
✘ 5000 Cent, express=true -&gt; 990     expected: &lt;990&gt; but was: &lt;1480&gt;</code></pre>
<p>Ein Test nur mit dem Repräsentanten 8000 hätte den Fehler <strong>nicht</strong> gefunden – genau dafür gibt es die Grenzwertanalyse.</p>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th>JUnit-Baustein</th><th>Zweck</th></tr></thead>
  <tbody>
    <tr><td><code>@Test</code></td><td>markiert eine Testmethode</td></tr>
    <tr><td><code>@ParameterizedTest</code> + <code>@CsvSource</code></td><td>derselbe Test mit mehreren Datensätzen</td></tr>
    <tr><td><code>@BeforeEach</code> / <code>@AfterEach</code></td><td>vor/nach jedem Test ausführen (z. B. Testobjekt neu anlegen)</td></tr>
    <tr><td><code>@DisplayName</code>, <code>@Disabled</code></td><td>lesbarer Name, Test vorübergehend ausschalten</td></tr>
    <tr><td><code>assertEquals</code>, <code>assertTrue</code>, <code>assertNull</code></td><td>Ergebnis prüfen</td></tr>
    <tr><td><code>assertThrows</code></td><td>prüfen, dass eine bestimmte Exception fliegt</td></tr>
  </tbody>
</table>
<p><strong>Testgetriebene Entwicklung (TDD)</strong> dreht die Reihenfolge um: erst einen Test schreiben, der fehlschlägt (<em>Red</em>), dann
gerade so viel Code, dass er grün wird (<em>Green</em>), dann aufräumen, ohne dass Tests rot werden (<em>Refactor</em>).</p>

<h6>Testdaten, Generatoren und Automatisierung</h6>
<ul>
  <li><strong>Testdatengeneratoren</strong> erzeugen große Mengen realistischer, aber <em>erfundener</em> Daten (Namen, Adressen, IBANs).
  Echte Kundendaten haben in Testsystemen nichts zu suchen (DSGVO) – höchstens anonymisiert.</li>
  <li><strong>Testfallgeneratoren</strong> leiten Testfälle automatisch aus Spezifikationen, Modellen oder Parameterkombinationen ab,
  z. B. alle Grenzwerte einer Eingabe oder alle Paare von Optionen (paarweises Testen).</li>
  <li><strong>Fuzzing</strong> füttert ein Programm mit zufälligen oder kaputten Eingaben, um Abstürze und Sicherheitslücken zu finden.</li>
  <li><strong>Mocks</strong> ersetzen Abhängigkeiten durch Attrappen (z. B. eine Fake-Datenbank mit Mockito), damit ein Unit-Test schnell
  und unabhängig bleibt.</li>
  <li><strong>Continuous Integration</strong>: Bei jedem Commit baut ein Server das Projekt und führt alle Tests aus; ein roter Test blockiert die Auslieferung.</li>
</ul>

<h6>Testdokumentation</h6>
<p>Ein Testfall ist erst dann wiederholbar, wenn er dokumentiert ist. Typische Felder einer Testfallbeschreibung bzw. eines Testprotokolls:</p>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th>ID</th><th>Vorbedingung</th><th>Eingabe / Schritte</th><th>erwartet</th><th>tatsächlich</th><th>Status</th></tr></thead>
  <tbody>
    <tr><td>T6</td><td>Warenkorb leer, Kunde angemeldet</td><td>Artikel für 50,00 € einlegen, Standardversand wählen</td><td>Versand 0,00 €</td><td>Versand 4,90 €</td><td class="text-danger">fehlgeschlagen</td></tr>
  </tbody>
</table>
<p>Gefundene Fehler werden mit Schweregrad (z. B. kritisch, schwer, leicht, kosmetisch) in einem Ticketsystem erfasst. Der <strong>Testbericht</strong>
fasst zusammen: was getestet wurde, wie viele Tests bestanden bzw. fehlschlugen, offene Fehler und eine Empfehlung zur Freigabe.</p>

<h6>Software dokumentieren</h6>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th>Art</th><th>Zielgruppe</th><th>Inhalt (Beispiele)</th></tr></thead>
  <tbody>
    <tr><td>Benutzerdokumentation</td><td>Anwender</td><td>Handbuch, Online-Hilfe, Schritt-für-Schritt-Anleitungen, FAQ</td></tr>
    <tr><td>Entwicklerdokumentation</td><td>Entwickler, Wartung</td><td>Javadoc, README, Architektur- und UML-Diagramme, API-Doku (OpenAPI), Datenbankschema</td></tr>
    <tr><td>Betriebsdokumentation</td><td>Administratoren</td><td>Installation, Konfiguration, Backup und Wiederherstellung, Systemvoraussetzungen</td></tr>
    <tr><td>Projektdokumentation</td><td>Auftraggeber, Projektleitung</td><td>Lasten-/Pflichtenheft, Protokolle, Testbericht, Abnahmeprotokoll</td></tr>
  </tbody>
</table>
<p>Die Javadoc-Kommentare oben (<code>/** … */</code> mit <code>@param</code>, <code>@return</code>, <code>@throws</code>) werden mit
<code>javadoc -d doku Versand.java</code> zu HTML-Seiten. Kommentiere das <em>Warum</em> und die Schnittstelle, nicht jede einzelne Zeile.</p>

<h6>Abnahme</h6>
<p>Mit der <strong>Abnahme</strong> erklärt der Auftraggeber, dass das Werk im Wesentlichen vertragsgemäß ist. Bei Individualsoftware liegt
meist ein <strong>Werkvertrag</strong> vor (§ 631 ff. BGB), und die Abnahme (§ 640 BGB) hat wichtige Folgen:</p>
<ul>
  <li>Die <strong>Vergütung wird fällig</strong> (§ 641 BGB).</li>
  <li>Die <strong>Gefahr geht über</strong> – geht das Werk danach zufällig unter, trägt das der Auftraggeber (§ 644 BGB).</li>
  <li>Die <strong>Verjährung</strong> der Mängelansprüche beginnt (§ 634a BGB).</li>
  <li>Die <strong>Beweislast kehrt sich um</strong>: Danach muss der Auftraggeber beweisen, dass ein Mangel vorliegt.</li>
</ul>
<p>Wegen unwesentlicher Mängel darf die Abnahme nicht verweigert werden. Setzt der Auftragnehmer nach Fertigstellung eine angemessene Frist und
verweigert der Auftraggeber die Abnahme nicht unter Angabe mindestens eines Mangels, gilt das Werk als abgenommen (fiktive Abnahme).</p>
<p>Das <strong>Abnahmeprotokoll</strong> hält das Ergebnis fest:</p>
<div class="border rounded p-3 mb-3">
  <div class="row small g-2">
    <div class="col-md-6"><strong>Projekt:</strong> Webshop-Erweiterung Versandkosten<br><strong>Auftraggeber:</strong> Muster Handels GmbH<br>
      <strong>Auftragnehmer:</strong> Beispiel Software GmbH</div>
    <div class="col-md-6"><strong>Datum, Ort:</strong> 21.10.2026, Köln<br><strong>Teilnehmer:</strong> je eine Vertretung beider Seiten<br>
      <strong>Grundlage:</strong> Pflichtenheft Version 1.2</div>
  </div>
  <table class="table table-sm table-bordered mt-2 mb-2 small">
    <thead class="table-light"><tr><th>geprüfte Anforderung</th><th>Ergebnis</th></tr></thead>
    <tbody>
      <tr><td>/F10/ Versandkosten nach Warenwert</td><td>erfüllt</td></tr>
      <tr><td>/F11/ Expressaufschlag</td><td>erfüllt</td></tr>
      <tr><td>/F12/ Anzeige im Warenkorb</td><td>Mangel M1: Betrag ohne Euro-Zeichen (leicht), Behebung bis 28.10.2026</td></tr>
    </tbody>
  </table>
  <p class="small mb-1"><strong>Ergebnis:</strong> ☐ abgenommen &nbsp; ☒ abgenommen mit Vorbehalt der Mängelbeseitigung &nbsp; ☐ Abnahme verweigert</p>
  <p class="small mb-0"><strong>Unterschriften</strong> beider Parteien</p>
</div>

<h6>Übungen mit Lösung</h6>
<p>1. Ein Portal nimmt Bestellmengen von 1 bis 99 Stück an; ab 10 Stück gibt es 5 % Rabatt. Bilde die Äquivalenzklassen und die Grenzwerte.</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Ungültig: Menge &lt; 1, Menge &gt; 99, keine ganze Zahl (z. B. „abc“, 2,5). Gültig: 1–9 (ohne Rabatt), 10–99 (mit Rabatt).
Grenzwerte: 0 und 1, 9 und 10, 99 und 100.</p>
</details>
<p>2. Wie viele Testfälle brauchst du mindestens für C0 und für C1?</p>
<pre class="bg-light border rounded p-3"><code>static String bewerte(int punkte) {
    String note = "nicht bestanden";
    if (punkte &gt;= 50) {
        note = "bestanden";
        if (punkte &gt;= 92) {
            note = "sehr gut";
        }
    }
    return note;
}</code></pre>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">C0: <strong>1</strong> Testfall (z. B. 95) führt jede Anweisung aus. C1: <strong>3</strong> Testfälle, z. B. 30 (erstes if nein),
70 (erstes ja, zweites nein), 95 (beide ja). Hier gibt es genau drei Pfade, also braucht auch C2 drei Tests.</p>
</details>
<p>3. Welche Teststufe? a) Die Methode <code>berechneZinsen()</code> wird isoliert geprüft. b) Der Shop wird mit dem echten Zahlungsdienst-Sandkasten
verbunden. c) Die Fachabteilung spielt ihre täglichen Abläufe durch und unterschreibt.</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">a) Komponententest, b) Integrationstest, c) Abnahmetest.</p>
</details>
<p>4. Der Kunde verweigert die Abnahme, weil ein Tooltip einen Tippfehler hat. Zu Recht?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Nein. Ein unwesentlicher Mangel berechtigt nicht zur Verweigerung. Er wird im Protokoll festgehalten und muss behoben werden,
die Abnahme erfolgt aber (ggf. unter Vorbehalt).</p>
</details>
INHALT,
    'summary' => [
        'Statische Tests prüfen ohne Ausführung (Review, Codeanalyse), dynamische führen das Programm aus.',
        'V-Modell: Komponenten-, Integrations-, System- und Abnahmetest prüfen jeweils gegen die passende Entwurfsstufe.',
        'Black-Box: Äquivalenzklassen (gültig und ungültig) plus Grenzwerte direkt an jeder Klassengrenze.',
        'White-Box: C0 jede Anweisung, C1 jeder Zweig (schließt C0 ein), C2 jeder Pfad.',
        'JUnit 5: @Test, @ParameterizedTest, assertEquals, assertThrows; TDD = Red, Green, Refactor.',
        'Abnahme beim Werkvertrag: Vergütung fällig, Gefahrübergang, Verjährungsbeginn, Beweislastumkehr – festgehalten im Abnahmeprotokoll.',
    ],
    'quiz' => [
        ['question' => 'Warum reicht ein Repräsentant pro Äquivalenzklasse oft nicht aus?', 'answer' => 'Viele Fehler liegen an den Klassengrenzen (z. B. > statt >=). Ein Wert aus der Mitte erkennt sie nicht; deshalb ergänzt man Grenzwerte.'],
        ['question' => 'Was ist der Unterschied zwischen Anweisungs- und Zweigüberdeckung?', 'answer' => 'C0 verlangt, dass jede Anweisung einmal ausgeführt wird. C1 verlangt zusätzlich, dass jede Entscheidung einmal wahr und einmal falsch ist – auch Zweige ohne eigene Anweisung.'],
        ['question' => 'Was prüft assertThrows?', 'answer' => 'Dass beim Ausführen des übergebenen Codes eine Exception des angegebenen Typs geworfen wird; sonst schlägt der Test fehl.'],
        ['question' => 'Nenne zwei Rechtsfolgen der Abnahme beim Werkvertrag.', 'answer' => 'Z. B. Fälligkeit der Vergütung, Gefahrübergang, Beginn der Verjährung der Mängelansprüche, Umkehr der Beweislast.'],
        ['question' => 'Was ist ein Regressionstest?', 'answer' => 'Das erneute Ausführen bereits bestandener Tests nach einer Änderung, um ungewollte Nebenwirkungen zu entdecken.'],
    ],
];
