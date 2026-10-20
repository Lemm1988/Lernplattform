<?php
return [
    'title' => 'Daten austauschen: CSV, JSON, XML und REST-Schnittstellen',
    'intro' => 'Systeme sprechen selten dieselbe Sprache. Hier lernst du die wichtigsten Austauschformate kennen und wie Programme über REST-Schnittstellen miteinander reden.',
    'goals' => [
        'Arten von Schnittstellen unterscheiden (Datei, API, Nachrichten)',
        'CSV, JSON und XML lesen, schreiben und ineinander umwandeln',
        'wohlgeformtes und gültiges XML unterscheiden und ein XSD lesen',
        'REST-Prinzipien, HTTP-Methoden und Statuscodes anwenden und eine API aus Java aufrufen',
    ],
    'content' => <<<'INHALT'
<h6>Schnittstellen: Wie Systeme Daten austauschen</h6>
<p>Ein Webshop muss Bestellungen an die Warenwirtschaft melden, die Warenwirtschaft Rechnungen an die Buchhaltung, die Buchhaltung
Zahlungen an die Bank. Jede dieser Verbindungen ist eine <strong>Schnittstelle</strong>. Damit sie funktioniert, müssen sich beide
Seiten über <strong>Format</strong> (wie sehen die Daten aus?), <strong>Transportweg</strong> (wie kommen sie an?) und
<strong>Bedeutung</strong> (was heißt welches Feld?) einig sein – das hält man in einer Schnittstellenbeschreibung fest.</p>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th>Art</th><th>Ablauf</th><th>Beispiel</th></tr></thead>
  <tbody>
    <tr><td>Dateischnittstelle</td><td>System A exportiert eine Datei, System B importiert sie (oft zeitgesteuert)</td><td>nächtlicher CSV-Export der Artikel per SFTP</td></tr>
    <tr><td>API (synchron)</td><td>Programm fragt direkt an und wartet auf die Antwort</td><td>Shop fragt per REST den Lagerbestand ab</td></tr>
    <tr><td>Nachrichten (asynchron)</td><td>Sender legt Nachricht in eine Warteschlange, Empfänger holt sie ab, wenn er bereit ist</td><td>Bestellung landet in einer Message Queue</td></tr>
  </tbody>
</table>

<h6>Drei Formate im Vergleich</h6>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf8/datenformate.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Derselbe Kunde als CSV-Zeile, als JSON-Objekt und als XML-Element mit Vor- und Nachteilen">
  <figcaption class="figure-caption">Gleicher Inhalt, drei Darstellungen</figcaption>
</figure>

<p><strong>CSV</strong> (Comma-Separated Values) ist eine Tabelle als Textdatei: eine Zeile pro Datensatz, Felder durch ein
Trennzeichen getrennt, meist mit Kopfzeile. In Deutschland wird oft das <strong>Semikolon</strong> verwendet, weil das Komma
Dezimaltrennzeichen ist. Enthält ein Feld selbst das Trennzeichen, steht es in Anführungszeichen:
<code>1002;"Kaya; Partner GmbH";Bonn</code>. CSV kennt <strong>keine Datentypen</strong> – alles ist Text und muss beim Einlesen umgewandelt werden.</p>

<p><strong>JSON</strong> (JavaScript Object Notation) kennt sechs Datentypen: Zeichenkette (<code>"Text"</code>), Zahl (<code>12.5</code>),
Wahrheitswert (<code>true</code>/<code>false</code>), <code>null</code>, Objekt (<code>{ }</code> mit Schlüssel-Wert-Paaren) und
Array (<code>[ ]</code>). Strenge Regeln: Schlüssel und Texte immer in <strong>doppelten</strong> Anführungszeichen, kein Komma nach dem
letzten Element, keine Kommentare.</p>

<p><strong>XML</strong> (Extensible Markup Language) beschreibt Daten mit selbst gewählten Elementen (<code>&lt;name&gt;…&lt;/name&gt;</code>)
und Attributen (<code>nr="1001"</code>). Man unterscheidet:</p>
<ul>
  <li><strong>wohlgeformt</strong>: Die Syntaxregeln sind eingehalten – genau ein Wurzelelement, jedes Element wird geschlossen, korrekt
  verschachtelt, Groß-/Kleinschreibung beachtet, Attributwerte in Anführungszeichen, Sonderzeichen maskiert (<code>&amp;lt;</code>, <code>&amp;amp;</code>).</li>
  <li><strong>gültig</strong> (valide): wohlgeformt <em>und</em> passend zu einem Schema (<strong>XSD</strong> oder älter DTD), das Elemente,
  Reihenfolge, Pflichtangaben und Datentypen festlegt.</li>
</ul>
<pre class="bg-light border rounded p-3"><code>&lt;xs:element name="kunde" maxOccurs="unbounded"&gt;
  &lt;xs:complexType&gt;
    &lt;xs:sequence&gt;
      &lt;xs:element name="name" type="xs:string"/&gt;
      &lt;xs:element name="ort" type="xs:string" minOccurs="0"/&gt;     &lt;!-- optional --&gt;
      &lt;xs:element name="umsatz"&gt;
        &lt;xs:complexType&gt;
          &lt;xs:simpleContent&gt;
            &lt;xs:extension base="xs:decimal"&gt;                         &lt;!-- Zahl mit Attribut --&gt;
              &lt;xs:attribute name="waehrung" type="xs:string" default="EUR"/&gt;
            &lt;/xs:extension&gt;
          &lt;/xs:simpleContent&gt;
        &lt;/xs:complexType&gt;
      &lt;/xs:element&gt;
    &lt;/xs:sequence&gt;
    &lt;xs:attribute name="nr" type="xs:positiveInteger" use="required"/&gt;
  &lt;/xs:complexType&gt;
&lt;/xs:element&gt;</code></pre>
<p>Mit diesem Schema geprüft (Java, <code>javax.xml.validation</code>):</p>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th>Eingabe</th><th>Ergebnis des Validators</th></tr></thead>
  <tbody>
    <tr><td><code>&lt;umsatz&gt;viel&lt;/umsatz&gt;</code></td><td>wohlgeformt, aber ungültig: „'viel' ist kein gültiger Wert für 'decimal'“</td></tr>
    <tr><td><code>&lt;kunde&gt;</code> ohne <code>nr</code></td><td>wohlgeformt, aber ungültig: „Attribut 'nr' muss in Element 'kunde' vorkommen“</td></tr>
    <tr><td><code>&lt;umsatz&gt;10&lt;/kunde&gt;</code></td><td>nicht einmal wohlgeformt: „Elementtyp 'umsatz' muss mit dem entsprechenden Endtag beendet werden“</td></tr>
  </tbody>
</table>

<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th></th><th>CSV</th><th>JSON</th><th>XML</th></tr></thead>
  <tbody>
    <tr><th>Struktur</th><td>flache Tabelle</td><td>verschachtelt</td><td>verschachtelt</td></tr>
    <tr><th>Datentypen</th><td>keine</td><td>6 Grundtypen</td><td>über XSD</td></tr>
    <tr><th>Schema-Prüfung</th><td>–</td><td>JSON Schema</td><td>XSD, DTD</td></tr>
    <tr><th>Größe</th><td>sehr klein</td><td>klein</td><td>groß (Start- und Endtags)</td></tr>
    <tr><th>typischer Einsatz</th><td>Excel, Massenimport</td><td>Web-APIs, Konfiguration</td><td>Behörden, Banken (z. B. E-Rechnung), Office-Dateien</td></tr>
  </tbody>
</table>

<h6>Umwandeln: CSV einlesen, JSON und XML erzeugen</h6>
<p>Python bringt alle drei Formate in der Standardbibliothek mit:</p>
<pre class="bg-light border rounded p-3"><code>import csv, json
import xml.etree.ElementTree as ET

kunden = []
with open("kunden.csv", encoding="utf-8", newline="") as f:
    for zeile in csv.DictReader(f, delimiter=";"):               # Kopfzeile wird zu Schlüsseln
        zeile["kundennr"] = int(zeile["kundennr"])                # Text → Zahl
        zeile["umsatz"] = float(zeile["umsatz"].replace(".", "").replace(",", "."))   # "1.250,50" → 1250.5
        kunden.append(zeile)

print(json.dumps(kunden, ensure_ascii=False, indent=2))       # Liste → JSON-Text

wurzel = ET.Element("kunden")
for k in kunden:
    e = ET.SubElement(wurzel, "kunde", nr=str(k["kundennr"]))   # Attribut
    ET.SubElement(e, "name").text = k["name"]
    ET.SubElement(e, "ort").text = k["ort"]
    ET.SubElement(e, "umsatz", waehrung="EUR").text = f'{k["umsatz"]:.2f}'
ET.indent(wurzel)
print(ET.tostring(wurzel, encoding="unicode"))</code></pre>
<p>Aus der Zeile <code>1002;"Kaya; Partner GmbH";Bonn;980,00</code> wird korrekt der Name <code>Kaya; Partner GmbH</code> – das Semikolon
in Anführungszeichen trennt nicht. Den umgekehrten Weg geht <code>json.loads()</code>; bei einem Fehler wie <code>{'id': 7,}</code> meldet
es: „Expecting property name enclosed in double quotes“.</p>
<div class="lf-merke"><strong>Merke – typische Stolperfallen beim Austausch:</strong> Zeichenkodierung immer festlegen (<strong>UTF-8</strong>),
Datum im Format <strong>ISO 8601</strong> (<code>2026-10-21</code>, mit Zeit <code>2026-10-21T14:30:00Z</code> in UTC), Dezimalpunkt statt
Komma in JSON/XML, Einheiten und Währungen mitliefern, leere Werte eindeutig darstellen (<code>null</code> statt Leertext).</div>

<h6>REST: Programme reden über HTTP</h6>
<p><strong>REST</strong> (Representational State Transfer) ist ein Architekturstil für Web-Schnittstellen. Die Grundideen:</p>
<ul>
  <li><strong>Ressourcen</strong> haben eine eigene Adresse (URI): <code>/api/v1/kunden</code> ist die Sammlung, <code>/api/v1/kunden/2</code> ein Kunde.</li>
  <li>Die <strong>HTTP-Methode</strong> sagt, was passieren soll – nicht der Pfad (also nicht <code>/kundeLoeschen?id=2</code>).</li>
  <li><strong>Zustandslos</strong>: Jede Anfrage bringt alle nötigen Informationen mit (z. B. das Token), der Server merkt sich keine Sitzung.
  Dadurch lässt sich die API leicht auf mehrere Server verteilen.</li>
  <li>Daten werden als <strong>Repräsentation</strong> übertragen, heute meist JSON.</li>
</ul>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf8/rest-anfrage.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Client sendet POST /api/v1/kunden mit JSON-Body, Server antwortet mit 201 Created, Location-Header und dem neuen Kunden">
  <figcaption class="figure-caption">Anfrage und Antwort bestehen jeweils aus Startzeile, Headern und Body</figcaption>
</figure>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th>Methode</th><th>CRUD</th><th>Beispiel</th><th>sicher</th><th>idempotent</th></tr></thead>
  <tbody>
    <tr><td><code>GET</code></td><td>Read</td><td><code>GET /kunden/2</code></td><td>ja</td><td>ja</td></tr>
    <tr><td><code>POST</code></td><td>Create</td><td><code>POST /kunden</code> + Body</td><td>nein</td><td>nein</td></tr>
    <tr><td><code>PUT</code></td><td>Update (ganz ersetzen)</td><td><code>PUT /kunden/2</code> + vollständiger Body</td><td>nein</td><td>ja</td></tr>
    <tr><td><code>PATCH</code></td><td>Update (teilweise)</td><td><code>PATCH /kunden/2</code> + <code>{"ort": "Bonn"}</code></td><td>nein</td><td>nicht garantiert</td></tr>
    <tr><td><code>DELETE</code></td><td>Delete</td><td><code>DELETE /kunden/2</code></td><td>nein</td><td>ja</td></tr>
  </tbody>
</table>
<p><em>Sicher</em> heißt: ändert nichts auf dem Server. <em>Idempotent</em> heißt: Zehnmal ausführen hat dieselbe Wirkung wie einmal.
Zweimal <code>POST</code> legt zwei Kunden an, zweimal <code>DELETE /kunden/2</code> hinterlässt denselben Zustand – Kunde 2 ist weg.</p>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th>Statuscode</th><th>Bedeutung</th><th>typischer Anlass</th></tr></thead>
  <tbody>
    <tr><td>200 OK</td><td>Erfolg mit Inhalt</td><td>GET hat Daten geliefert</td></tr>
    <tr><td>201 Created</td><td>angelegt</td><td>POST erfolgreich, <code>Location</code>-Header zeigt auf die neue Ressource</td></tr>
    <tr><td>204 No Content</td><td>Erfolg ohne Inhalt</td><td>DELETE erfolgreich</td></tr>
    <tr><td>400 Bad Request</td><td>Anfrage fehlerhaft</td><td>Pflichtfeld fehlt, JSON kaputt</td></tr>
    <tr><td>401 Unauthorized</td><td>nicht angemeldet</td><td>Token fehlt oder abgelaufen</td></tr>
    <tr><td>403 Forbidden</td><td>angemeldet, aber keine Berechtigung</td><td>Student will Admin-Funktion nutzen</td></tr>
    <tr><td>404 Not Found</td><td>Ressource gibt es nicht</td><td><code>GET /kunden/99</code></td></tr>
    <tr><td>405 Method Not Allowed</td><td>Methode für diese Ressource nicht erlaubt</td><td><code>DELETE</code> auf eine nur lesbare Ressource</td></tr>
    <tr><td>409 Conflict</td><td>Konflikt mit dem aktuellen Zustand</td><td>E-Mail-Adresse schon vergeben</td></tr>
    <tr><td>500 Internal Server Error</td><td>Fehler im Server</td><td>unbehandelte Exception</td></tr>
  </tbody>
</table>
<p class="small text-muted">Faustregel: 2xx = Erfolg, 3xx = Umleitung, 4xx = Fehler des Clients, 5xx = Fehler des Servers.</p>

<h6>Eine REST-API aus Java aufrufen</h6>
<p>Seit Java 11 gibt es dafür <code>java.net.http.HttpClient</code> – ohne zusätzliche Bibliothek:</p>
<pre class="bg-light border rounded p-3"><code>HttpClient client = HttpClient.newHttpClient();
String basis = "http://localhost:8080/api/v1";

// GET: einen Kunden lesen
HttpRequest get = HttpRequest.newBuilder(URI.create(basis + "/kunden/1"))
        .header("Accept", "application/json")
        .GET()
        .build();
HttpResponse&lt;String&gt; antwort = client.send(get, HttpResponse.BodyHandlers.ofString());
System.out.println(antwort.statusCode() + " " + antwort.body());
// 200 {"id":1,"name":"Meier","ort":"Köln"}

// POST: neuen Kunden anlegen
String json = """
        {"name": "Kaya", "ort": "Bonn"}
        """;
HttpRequest post = HttpRequest.newBuilder(URI.create(basis + "/kunden"))
        .header("Content-Type", "application/json")
        .POST(HttpRequest.BodyPublishers.ofString(json))
        .build();
antwort = client.send(post, HttpResponse.BodyHandlers.ofString());
System.out.println(antwort.statusCode() + " " + antwort.headers().firstValue("Location").orElse("-"));
// 201 /api/v1/kunden/2</code></pre>
<p>Getestet gegen eine kleine Beispiel-API: <code>GET /kunden/99</code> liefert <code>404 {"fehler":"Kunde nicht gefunden"}</code>,
ein POST ohne Namen <code>400</code>, ein <code>DELETE</code> auf die nur lesbare Ressource <code>405</code> mit dem Header
<code>Allow: GET</code>. Den JSON-Text wandelt man in echten Projekten mit einer Bibliothek wie Jackson oder Gson in Java-Objekte um.</p>
<p>So kann die Gegenseite aussehen – hier minimal in PHP (in Java nimmt man dafür meist Spring Boot):</p>
<pre class="bg-light border rounded p-3"><code>header('Content-Type: application/json; charset=utf-8');
$pfad   = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];

if (preg_match('#^/api/v1/kunden/(\d+)$#', $pfad, $m)) {
    $kunde = findeKunde((int)$m[1]);                      // z. B. per PDO aus der Datenbank
    if ($kunde === null) { http_response_code(404); echo json_encode(['fehler' =&gt; 'Kunde nicht gefunden']); exit; }
    echo json_encode($kunde, JSON_UNESCAPED_UNICODE);     // Status 200 ist Standard
    exit;
}
if ($pfad === '/api/v1/kunden' &amp;&amp; $method === 'POST') {
    $neu = json_decode(file_get_contents('php://input'), true);
    if (!is_array($neu) || empty($neu['name'])) { http_response_code(400); echo json_encode(['fehler' =&gt; 'Feld "name" fehlt']); exit; }
    $id = speichereKunde($neu);
    http_response_code(201);
    header("Location: /api/v1/kunden/$id");
    echo json_encode(['id' =&gt; $id] + $neu, JSON_UNESCAPED_UNICODE);
    exit;
}</code></pre>

<h6>APIs absichern und dokumentieren</h6>
<ul>
  <li>Nur über <strong>HTTPS</strong> anbieten.</li>
  <li><strong>Authentifizierung</strong> pro Anfrage: API-Schlüssel im Header oder ein Token (<code>Authorization: Bearer …</code>, z. B. nach OAuth 2.0).</li>
  <li>Alle Eingaben serverseitig <strong>prüfen</strong> – ein Client kann beliebige Daten schicken.</li>
  <li><strong>Rate Limiting</strong>: zu viele Anfragen mit <code>429 Too Many Requests</code> abweisen.</li>
  <li>Versionieren (<code>/api/v1/…</code>), damit alte Clients weiter funktionieren.</li>
  <li>Dokumentieren mit <strong>OpenAPI</strong> (früher Swagger): eine maschinenlesbare Beschreibung aller Endpunkte, aus der Doku-Seiten und Client-Code erzeugt werden können.</li>
</ul>
<p><strong>SOAP</strong> ist der ältere Gegenentwurf: ein festes <em>Protokoll</em> mit XML-Umschlag (Envelope) und einer Schnittstellenbeschreibung in
<strong>WSDL</strong>. Es ist strenger und schwergewichtiger als REST und findet sich vor allem noch in Banken, Versicherungen und Behörden.</p>

<h6>Übungen mit Lösung</h6>
<p>1. Finde drei Fehler: <code>{'name': "Kaya", "aktiv": True, "punkte": 340,}</code></p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Schlüssel <code>'name'</code> in einfachen statt doppelten Anführungszeichen, <code>True</code> muss kleingeschrieben werden
(<code>true</code>), Komma nach dem letzten Element. Richtig: <code>{"name": "Kaya", "aktiv": true, "punkte": 340}</code></p>
</details>
<p>2. Welche Methode und welcher Statuscode? a) Ein Kunde ändert nur seine Telefonnummer. b) Ein Artikel wird erfolgreich gelöscht.
c) Ein Client fragt <code>/api/v1/bestellungen/500</code> an, die es nicht gibt. d) Jemand ohne Token ruft eine geschützte Ressource auf.</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">a) <code>PATCH /kunden/{id}</code>, Antwort 200 (oder 204). b) <code>DELETE /artikel/{id}</code>, Antwort 204 No Content.
c) <code>GET</code>, Antwort 404 Not Found. d) Antwort 401 Unauthorized.</p>
</details>
<p>3. Ist das XML wohlgeformt? <code>&lt;Kunde&gt;&lt;name&gt;Meier &amp; Söhne&lt;/name&gt;&lt;/kunde&gt;</code></p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Nein, zwei Fehler: <code>&lt;Kunde&gt;</code> und <code>&lt;/kunde&gt;</code> passen nicht zusammen (Groß-/Kleinschreibung), und das
<code>&amp;</code> muss als <code>&amp;amp;</code> geschrieben werden.</p>
</details>
<p>4. Warum ist <code>GET /api/v1/kunden/2/loeschen</code> schlechtes REST-Design?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Die Aktion gehört in die Methode, nicht in den Pfad: <code>DELETE /api/v1/kunden/2</code>. Außerdem muss <code>GET</code> sicher sein –
Suchmaschinen, Vorschau-Funktionen oder Caches rufen GET-Links auf und würden dabei Daten löschen.</p>
</details>
INHALT,
    'summary' => [
        'Schnittstellen: Datei (Export/Import), API (synchron) oder Nachrichten (asynchron, Queue).',
        'CSV = flache Tabelle ohne Typen; JSON = Objekte/Arrays mit 6 Typen; XML = Elemente/Attribute, prüfbar per XSD.',
        'Wohlgeformt = Syntax korrekt; gültig = wohlgeformt und schemakonform.',
        'REST: Ressourcen mit URI, Aktion über die HTTP-Methode, zustandslos, meist JSON.',
        'GET lesen, POST anlegen, PUT ersetzen, PATCH teilweise ändern, DELETE löschen; 2xx Erfolg, 4xx Client-Fehler, 5xx Server-Fehler.',
        'APIs absichern: HTTPS, Token, Eingabeprüfung, Rate Limiting; dokumentieren mit OpenAPI.',
    ],
    'quiz' => [
        ['question' => 'Was ist der Unterschied zwischen PUT und PATCH?', 'answer' => 'PUT ersetzt die Ressource vollständig (alle Felder werden mitgeschickt), PATCH ändert nur die übermittelten Felder.'],
        ['question' => 'Was bedeutet „idempotent“?', 'answer' => 'Mehrfaches Ausführen derselben Anfrage hat dieselbe Wirkung wie einmaliges Ausführen (GET, PUT, DELETE).'],
        ['question' => 'Wann ist ein XML-Dokument gültig?', 'answer' => 'Wenn es wohlgeformt ist und zusätzlich den Regeln eines Schemas (XSD oder DTD) entspricht.'],
        ['question' => 'Welcher Statuscode passt zu einem erfolgreichen POST, und welcher Header gehört dazu?', 'answer' => '201 Created mit dem Header Location, der die Adresse der neu angelegten Ressource enthält.'],
        ['question' => 'Warum verwendet man in deutschen CSV-Dateien oft das Semikolon?', 'answer' => 'Weil das Komma in Deutschland Dezimaltrennzeichen ist (1.250,50) und sonst mit dem Feldtrenner kollidieren würde.'],
    ],
];
