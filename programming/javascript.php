<?php
require_once '../config.php';
require_login();
$page_title = 'JavaScript – Programmiersprache';
include '../includes/header.php';
?>
<div class="layout-container">
    <?php include '../includes/sidebar.php'; ?>
    <div class="main-wrapper">
        <main class="main-content">
            <div class="container-fluid py-4 lang-page">
                <div class="d-flex align-items-center gap-3 pb-2 mb-4 border-bottom">
                    <i class="bi bi-filetype-js fs-1 text-warning"></i>
                    <div>
                        <h1 class="h2 mb-0">JavaScript</h1>
                        <p class="text-muted mb-0">Die Sprache des Browsers – und dank Node.js auch auf dem Server</p>
                    </div>
                </div>

                <div class="row g-4">
                    <div class="col-xl-8">
                        <section class="mb-5">
                            <h2>Steckbrief</h2>
                            <div class="table-responsive">
                                <table class="table table-sm table-bordered">
                                    <tbody>
                                        <tr><th class="w-25">Erschienen</th><td>1995 (Netscape), standardisiert als ECMAScript</td></tr>
                                        <tr><th>Ausführung</th><td>interpretiert bzw. Just-in-time-kompiliert im Browser oder in Node.js</td></tr>
                                        <tr><th>Typisierung</th><td>dynamisch und schwach – der Typ hängt am Wert, nicht an der Variable</td></tr>
                                        <tr><th>Paradigmen</th><td>imperativ, objektorientiert (prototypbasiert, mit <code>class</code>-Syntax), funktional</td></tr>
                                        <tr><th>Einsatz</th><td>interaktive Webseiten, Single-Page-Apps, REST-Backends (Node.js), Desktop-Apps (Electron)</td></tr>
                                    </tbody>
                                </table>
                            </div>
                            <p>Wichtig für die Abgrenzung: <strong>Java und JavaScript haben außer dem Namen kaum etwas gemeinsam.</strong>
                                Java ist statisch typisiert und läuft in der JVM, JavaScript ist dynamisch typisiert und läuft in jedem Browser.</p>
                        </section>

                        <section class="mb-5">
                            <h2>Variablen und Datentypen</h2>
                            <p>Variablen deklarierst du mit <code>let</code> (veränderbar) oder <code>const</code> (nicht neu zuweisbar).
                                Das alte <code>var</code> solltest du nicht mehr verwenden, weil es keinen Block-Gültigkeitsbereich hat.</p>
                            <pre><code class="language-javascript">const mwst = 0.19;            // Zahl (number) – es gibt nur einen Zahlentyp
let artikel = "Headset";      // Zeichenkette (string)
let lieferbar = true;         // Wahrheitswert (boolean)
let rabatt = null;            // bewusst "kein Wert"
let farbe;                    // undefined – noch nie ein Wert zugewiesen

const preise = [19.99, 4.5, 120];                  // Array
const kunde = { name: "Weber", kundennr: 4711 };   // Objekt

console.log(typeof mwst);       // "number"
console.log(`${artikel} kostet ${(49.9 * (1 + mwst)).toFixed(2)} €`);   // Template-String</code></pre>
                            <div class="alert alert-warning small">
                                <strong>Stolperfalle Vergleich:</strong> <code>==</code> wandelt Typen vorher um (<code>"5" == 5</code> ist
                                <code>true</code>), <code>===</code> vergleicht Wert <em>und</em> Typ (<code>"5" === 5</code> ist <code>false</code>).
                                Verwende grundsätzlich <code>===</code>.
                            </div>
                        </section>

                        <section class="mb-5">
                            <h2>Kontrollstrukturen und Funktionen</h2>
                            <pre><code class="language-javascript">function versandkosten(gewichtKg) {
    if (gewichtKg &lt; 0) {
        throw new Error("Gewicht darf nicht negativ sein");
    } else if (gewichtKg &lt; 2) {
        return 4.99;
    } else if (gewichtKg &lt;= 10) {
        return 6.99;
    }
    return 14.99;
}

// Pfeilfunktion (arrow function) – kurze Schreibweise
const brutto = (netto) =&gt; Math.round(netto * 1.19 * 100) / 100;

for (let i = 1; i &lt;= 3; i++) {
    console.log(`Paket ${i}: ${versandkosten(i * 4)} €`);
}

// Arrays funktional verarbeiten
const nettopreise = [10, 25, 99];
const bruttopreise = nettopreise.map(brutto);                 // [11.9, 29.75, 117.81]
const teuer = bruttopreise.filter(p =&gt; p &gt; 20);               // [29.75, 117.81]
const summe = bruttopreise.reduce((acc, p) =&gt; acc + p, 0);   // 159.46</code></pre>
                        </section>

                        <section class="mb-5">
                            <h2>Das DOM: Webseiten verändern</h2>
                            <p>Im Browser stellt JavaScript die Seite als Baum von Objekten bereit, das <strong>Document Object Model</strong>.
                                Über das DOM liest und änderst du Elemente und reagierst mit <strong>Event-Listenern</strong> auf Benutzeraktionen.</p>
                            <pre><code class="language-html">&lt;label for="menge"&gt;Menge&lt;/label&gt;
&lt;input id="menge" type="number" value="1" min="1"&gt;
&lt;p&gt;Gesamt: &lt;span id="gesamt"&gt;19,99 €&lt;/span&gt;&lt;/p&gt;

&lt;script&gt;
    const eingabe = document.querySelector("#menge");
    const ausgabe = document.querySelector("#gesamt");

    eingabe.addEventListener("input", () =&gt; {
        const menge = Number(eingabe.value);
        ausgabe.textContent = (menge * 19.99).toFixed(2).replace(".", ",") + " €";
    });
&lt;/script&gt;</code></pre>
                            <p class="small text-muted">Nutze <code>textContent</code> statt <code>innerHTML</code>, wenn du Benutzereingaben ausgibst –
                                sonst öffnest du eine Lücke für Cross-Site-Scripting (XSS).</p>
                        </section>

                        <section class="mb-5">
                            <h2>Asynchron arbeiten: fetch und async/await</h2>
                            <p>Netzwerkanfragen dauern. Damit die Seite währenddessen nicht einfriert, arbeitet JavaScript
                                <strong>asynchron</strong>: <code>fetch()</code> liefert sofort ein <em>Promise</em> zurück, das später erfüllt wird.
                                Mit <code>async</code>/<code>await</code> liest sich das wie normaler, sequenzieller Code.</p>
                            <pre><code class="language-javascript">async function ladeKunde(id) {
    try {
        const antwort = await fetch(`/api/kunden/${id}`);
        if (!antwort.ok) {
            throw new Error(`HTTP ${antwort.status}`);
        }
        const kunde = await antwort.json();     // JSON → JavaScript-Objekt
        console.log(kunde.name);
    } catch (fehler) {
        console.error("Laden fehlgeschlagen:", fehler.message);
    }
}</code></pre>
                        </section>

                        <section class="mb-5">
                            <h2>Übung</h2>
                            <p>Schreib eine Funktion <code>durchschnitt(noten)</code>, die den Mittelwert eines Arrays auf eine Nachkommastelle
                                gerundet zurückgibt und bei einem leeren Array <code>null</code> liefert.</p>
                            <details>
                                <summary>Lösung anzeigen</summary>
                                <pre><code class="language-javascript">function durchschnitt(noten) {
    if (noten.length === 0) {
        return null;
    }
    const summe = noten.reduce((acc, n) =&gt; acc + n, 0);
    return Math.round(summe / noten.length * 10) / 10;
}

console.log(durchschnitt([2, 3, 1, 2]));   // 2
console.log(durchschnitt([]));             // null</code></pre>
                            </details>
                        </section>
                    </div>

                    <div class="col-xl-4">
                        <div class="card border-0 bg-light mb-4">
                            <div class="card-body">
                                <h3 class="h5"><i class="bi bi-mortarboard me-2"></i>Prüfungsbezug</h3>
                                <ul class="small mb-0">
                                    <li>Client- vs. serverseitige Verarbeitung (LF10, LF12)</li>
                                    <li>Validierung im Browser ersetzt <strong>nie</strong> die Prüfung auf dem Server</li>
                                    <li>XSS: Ausgaben immer kontextgerecht maskieren</li>
                                    <li>Datenaustausch per JSON und REST-API</li>
                                </ul>
                            </div>
                        </div>
                        <div class="card border-0 bg-light">
                            <div class="card-body">
                                <h3 class="h5"><i class="bi bi-arrow-left-right me-2"></i>JavaScript vs. Java</h3>
                                <table class="table table-sm small mb-0">
                                    <thead><tr><th></th><th>JavaScript</th><th>Java</th></tr></thead>
                                    <tbody>
                                        <tr><td>Typen</td><td>dynamisch</td><td>statisch</td></tr>
                                        <tr><td>Ausführung</td><td>Browser, Node.js</td><td>JVM</td></tr>
                                        <tr><td>Zahlen</td><td>nur <code>number</code></td><td><code>int</code>, <code>double</code> …</td></tr>
                                        <tr><td>Klassen</td><td>Prototypen</td><td>klassenbasiert</td></tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
<?php include '../includes/footer.php'; ?>
