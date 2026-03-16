<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';
include $_SERVER['DOCUMENT_ROOT'] . '/includes/php-navigation.php';

$page_title = 'PHP Strings - Text verarbeiten und manipulieren';
include $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php';
?>

<div class="layout-container">
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/sidebar.php'; ?>
    <div class="main-wrapper">
        <main class="main-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-4 col-lg-3"></div>
                    <div class="col-md-8 col-lg-9">
                        
                        <?php renderNavigation('php-strings'); ?>
                        
                        <div class="d-flex justify-content-between align-items-center pt-3 pb-2 mb-3 border-bottom">
                            <h1 class="h2"><i class="bi bi-type me-2"></i>PHP Strings</h1>
                        </div>

                        <div class="card bg-light mb-4">
                            <div class="card-body">
                                <h2>🔤 Strings - Text wie ein Profi bearbeiten</h2>
                                <p class="lead">Strings (Texte) sind in der Webentwicklung allgegenwärtig - von Benutzernamen über HTML-Code bis hin zu API-Antworten. Lernen Sie alle wichtigen String-Funktionen kennen!</p>
                            </div>
                        </div>

                        <div class="alert alert-info">
                            <h5><i class="bi bi-lightbulb me-2"></i>Warum String-Bearbeitung wichtig ist</h5>
                            <p class="mb-0">Fast alles in der Webentwicklung sind Strings: Formulareingaben, Dateinamen, URLs, HTML-Code, E-Mail-Adressen, Passwörter. <strong>String-Funktionen zu beherrschen macht Sie zum besseren Entwickler!</strong></p>
                        </div>

                        <h3>📝 Strings erstellen und definieren</h3>
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h5>Verschiedene String-Syntaxen:</h5>
                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
// Einfache Anführungszeichen (literal)
$name = 'Max Mustermann';
$pfad = 'C:\Programme\PHP\php.exe';

// Doppelte Anführungszeichen (interpretiert)
$begrüßung = "Hallo $name!";
$info = "Heute ist " . date('Y-m-d');

// Variablen werden interpretiert
$alter = 25;
$text = "Ich bin $alter Jahre alt.";
echo $text; // "Ich bin 25 Jahre alt."

// Mit geschweiften Klammern (sicherer)
$produkt_id = 42;
$dateiname = "produkt_{$produkt_id}.jpg";
echo $dateiname; // "produkt_42.jpg"

// Escape-Sequenzen in doppelten Anführungszeichen
$mehrzeilig = "Zeile 1\nZeile 2\nZeile 3";
$mit_tab = "Name:\tMax\nAlter:\t25";
echo nl2br($mehrzeilig); // Für HTML-Ausgabe
?&gt;</code></pre>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <h5>Heredoc & Nowdoc für längere Texte:</h5>
                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
$benutzer = "Max";

// Heredoc (Variablen werden interpretiert)
$email_vorlage = &lt;&lt;&lt;EOD
Hallo $benutzer,

vielen Dank für Ihre Anmeldung!

Ihre Daten:
- Name: $benutzer
- Registriert: {date('Y-m-d')}

Mit freundlichen Grüßen
Ihr Team
EOD;

// Nowdoc (literal, wie einfache Anführungszeichen)
$sql_vorlage = &lt;&lt;&lt;'SQL'
SELECT * FROM users 
WHERE name = '$name' 
  AND active = 1
ORDER BY created_at DESC;
SQL;

// HTML-Template
$html = &lt;&lt;&lt;HTML
&lt;div class="card"&gt;
    &lt;div class="card-header"&gt;
        &lt;h3&gt;Willkommen $benutzer!&lt;/h3&gt;
    &lt;/div&gt;
    &lt;div class="card-body"&gt;
        &lt;p&gt;Schön Sie zu sehen!&lt;/p&gt;
    &lt;/div&gt;
&lt;/div&gt;
HTML;

echo $html;
?&gt;</code></pre>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h3>🔧 Grundlegende String-Funktionen</h3>
                        
                        <div class="row mb-4">
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h5><i class="bi bi-rulers text-primary me-2"></i>Länge & Information</h5>
                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
$text = "Hallo Welt!";

// Länge ermitteln
echo strlen($text);        // 11

// Wörter zählen
echo str_word_count($text); // 2

// Ist String leer?
echo empty("");           // true
echo empty($text);        // false

// String-Info für Debugging
var_dump($text);

// Encoding prüfen
echo mb_detect_encoding($text); // ASCII

// Bytes vs. Zeichen (bei Umlauten wichtig)
$deutsch = "Größe";
echo strlen($deutsch);     // 6 (Bytes)
echo mb_strlen($deutsch);  // 5 (Zeichen)
?&gt;</code></pre>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h5><i class="bi bi-type-bold text-success me-2"></i>Groß-/Kleinschreibung</h5>
                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
$name = "max mustermann";

// Alles groß
echo strtoupper($name);    // MAX MUSTERMANN

// Alles klein
echo strtolower($name);    // max mustermann

// Erster Buchstabe groß
echo ucfirst($name);       // Max mustermann

// Jedes Wort groß
echo ucwords($name);       // Max Mustermann

// Ersten Buchstabe klein
echo lcfirst("MAX");       // mAX

// Für spezielle Zeichen (UTF-8)
$deutsch = "größe";
echo mb_strtoupper($deutsch); // GRÖSSE
echo mb_strtolower($deutsch); // größe
echo mb_ucfirst($deutsch);    // Größe

// Vergleich ohne Beachtung der Groß-/Kleinschreibung
if (strcasecmp("Max", "max") == 0) {
    echo "Gleich!";
}
?&gt;</code></pre>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h5><i class="bi bi-scissors text-warning me-2"></i>Leerzeichen entfernen</h5>
                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
$eingabe = "  Hallo Welt!  ";

// Leerzeichen an beiden Enden
echo trim($eingabe);       // "Hallo Welt!"

// Nur links
echo ltrim($eingabe);      // "Hallo Welt!  "

// Nur rechts
echo rtrim($eingabe);      // "  Hallo Welt!"

// Bestimmte Zeichen entfernen
$messy = "...Hallo!!!";
echo trim($messy, ".!");   // "Hallo"

// Mehrere Leerzeichen zu einem
$viele = "Hallo    Welt";
$sauber = preg_replace('/\s+/', ' ', $viele);
echo $sauber;              // "Hallo Welt"

// Alle Whitespace-Zeichen entfernen
$mit_tabs = "Hallo\t\nWelt";
echo str_replace(["\t", "\n", "\r"], "", $mit_tabs);
?&gt;</code></pre>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h3>🔍 Strings durchsuchen und finden</h3>
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h5>Position und Vorkommen finden:</h5>
                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
$text = "Hallo Welt, schöne Welt!";

// Erste Position finden
echo strpos($text, "Welt");      // 6

// Letzte Position finden
echo strrpos($text, "Welt");     // 19

// Ohne Berücksichtigung der Groß-/Kleinschreibung
echo stripos($text, "welt");     // 6

// Prüfen ob String enthalten ist
if (strpos($text, "schöne") !== false) {
    echo "Gefunden!";
}

// Vorkommen zählen
echo substr_count($text, "Welt"); // 2

// String enthält bestimmte Zeichen?
if (str_contains($text, "schöne")) {  // PHP 8+
    echo "Enthält 'schöne'!";
}

// Beginnt mit bestimmtem Text?
if (str_starts_with($text, "Hallo")) { // PHP 8+
    echo "Beginnt mit 'Hallo'!";
}

// Endet mit bestimmtem Text?  
if (str_ends_with($text, "Welt!")) {   // PHP 8+
    echo "Endet mit 'Welt!'!";
}
?&gt;</code></pre>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <h5>Erweiterte Suche mit Funktionen:</h5>
                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
$email = "max.mustermann@example.com";

// Nach erstem Vorkommen eines Zeichens suchen
echo strstr($email, "@");        // "@example.com"

// Vor erstem Vorkommen
echo strstr($email, "@", true);  // "max.mustermann"

// Nach letztem Vorkommen
echo strrchr($email, ".");       // ".com"

// String in Array suchen
$namen = ["Max", "Anna", "Tom"];
if (in_array("Max", $namen)) {
    echo "Max gefunden!";
}

// Ähnlichkeit berechnen
$wort1 = "Katze";
$wort2 = "Katzen";
$prozent = 0;
similar_text($wort1, $wort2, $prozent);
echo "Ähnlichkeit: " . round($prozent) . "%";

// Levenshtein-Distanz (Editier-Distanz)
echo levenshtein($wort1, $wort2);  // 1 (ein Zeichen Unterschied)

// Soundex (Phonetische Ähnlichkeit)
echo soundex("Schmidt");           // S530
echo soundex("Schmitt");           // S530 (klingen ähnlich)
?&gt;</code></pre>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h3>✂️ Strings schneiden und extrahieren</h3>
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h5>substr() - Teilstrings extrahieren:</h5>
                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
$text = "Hallo Welt 2024";

// Von Position bis Ende
echo substr($text, 6);         // "Welt 2024"

// Von Position mit Länge
echo substr($text, 0, 5);      // "Hallo"
echo substr($text, 6, 4);      // "Welt"

// Negative Positionen (vom Ende)
echo substr($text, -4);        // "2024"
echo substr($text, -9, 4);     // "Welt"

// Praktische Anwendungen
$dateiname = "dokument.pdf";
$name = substr($dateiname, 0, strrpos($dateiname, '.'));
$erweiterung = substr($dateiname, strrpos($dateiname, '.') + 1);

echo "Name: $name";            // "dokument"
echo "Erweiterung: $erweiterung"; // "pdf"

// Erste 50 Zeichen für Vorschau
$langer_text = "Das ist ein sehr langer Text, der gekürzt werden soll...";
$vorschau = substr($langer_text, 0, 50);
if (strlen($langer_text) > 50) {
    $vorschau .= "...";
}
echo $vorschau;
?&gt;</code></pre>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <h5>Erweiterte Extraktions-Funktionen:</h5>
                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
// Multibyte-sichere Version (für Umlaute etc.)
$deutsch = "Schöne Grüße aus München";
echo mb_substr($deutsch, 0, 6);   // "Schöne"
echo mb_substr($deutsch, -7);     // "München"

// Zeichen an bestimmter Position
echo $deutsch[0];                 // "S"
echo $deutsch[6];                 // " "

// String in Array aufteilen
$csv = "Max,25,Berlin,Entwickler";
$daten = explode(",", $csv);
print_r($daten); // ["Max", "25", "Berlin", "Entwickler"]

// Mit Begrenzung
$text_lang = "Eins,Zwei,Drei,Vier,Fünf";
$teile = explode(",", $text_lang, 3);
print_r($teile); // ["Eins", "Zwei", "Drei,Vier,Fünf"]

// Zeilen aufteilen
$mehrzeilig = "Zeile 1\nZeile 2\nZeile 3";
$zeilen = explode("\n", $mehrzeilig);

// String chunken (in gleiche Stücke)
$lang = "1234567890";
$chunks = str_split($lang, 3);
print_r($chunks); // ["123", "456", "789", "0"]

// Wörter extrahieren
$satz = "Das ist ein Test.";
$wörter = str_word_count($satz, 1);
print_r($wörter); // ["Das", "ist", "ein", "Test"]
?&gt;</code></pre>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h3>🔄 Strings ersetzen und manipulieren</h3>
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h5>str_replace() - Einfaches Ersetzen:</h5>
                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
$text = "Hallo Welt! Welt ist schön!";

// Einfaches Ersetzen
$neu = str_replace("Welt", "PHP", $text);
echo $neu; // "Hallo PHP! PHP ist schön!"

// Ohne Beachtung der Groß-/Kleinschreibung
$neu2 = str_ireplace("welt", "PHP", $text);

// Mehrere Ersetzungen gleichzeitig
$suchen = ["Hallo", "Welt", "!"];
$ersetzen = ["Hi", "PHP", ".");
$ergebnis = str_replace($suchen, $ersetzen, $text);
echo $ergebnis; // "Hi PHP. PHP ist schön."

// Zählen wie oft ersetzt wurde
$anzahl = 0;
$neu3 = str_replace("Welt", "PHP", $text, $anzahl);
echo "Ersetzt: $anzahl mal"; // 2 mal

// HTML-Tags entfernen
$html = "&lt;p&gt;Das ist &lt;strong&gt;wichtig&lt;/strong&gt;!&lt;/p&gt;";
echo strip_tags($html); // "Das ist wichtig!"

// Nur bestimmte Tags behalten
echo strip_tags($html, "&lt;strong&gt;"); // "Das ist &lt;strong&gt;wichtig&lt;/strong&gt;!"

// Sonderzeichen für HTML kodieren
$gefährlich = "&lt;script&gt;alert('hack');&lt;/script&gt;";
echo htmlspecialchars($gefährlich);
?&gt;</code></pre>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <h5>Erweiterte Manipulation:</h5>
                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
// String umkehren
$name = "Max";
echo strrev($name); // "xaM"

// Zeichen wiederholen
echo str_repeat("*", 10); // "**********"
echo str_repeat("Hi! ", 3); // "Hi! Hi! Hi! "

// String mit Zeichen auffüllen
$nummer = "42";
echo str_pad($nummer, 5, "0", STR_PAD_LEFT);  // "00042"
echo str_pad($nummer, 6, "-", STR_PAD_BOTH);  // "--42--"

// Rot13 Verschlüsselung (einfach)
$geheim = str_rot13("Hallo");
echo $geheim; // "Unyyb"
echo str_rot13($geheim); // "Hallo" (zurück)

// Shuffle (Buchstaben mischen)
echo str_shuffle("Hallo"); // z.B. "lHlao"

// String zu Array (alle Zeichen)
$wort = "Hallo";
$buchstaben = str_split($wort);
print_r($buchstaben); // ["H", "a", "l", "l", "o"]

// Zufällige Zeichen
$zeichen = "abcdefghijklmnopqrstuvwxyz0123456789";
$zufällig = substr(str_shuffle($zeichen), 0, 8);
echo $zufällig; // z.B. "k7m3n9p1"
?&gt;</code></pre>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h3>🎯 String-Formatierung und Templates</h3>
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h5>printf() - Formatierte Ausgabe:</h5>
                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
// Platzhalter mit printf()
$name = "Max";
$alter = 25;
$gehalt = 55000.50;

// %s = String, %d = Integer, %f = Float
printf("Hallo %s, du bist %d Jahre alt.", $name, $alter);

// Formatierung von Zahlen
printf("Gehalt: %.2f €", $gehalt);        // 2 Dezimalstellen
printf("Gehalt: %,d €", (int)$gehalt);    // Mit Tausender-Trennzeichen

// sprintf() - String zurückgeben statt ausgeben
$formatiert = sprintf("Benutzer: %s (%d Jahre)", $name, $alter);
echo $formatiert;

// Mit führenden Nullen
printf("Benutzer-ID: %05d", 42);          // "Benutzer-ID: 00042"

// Rechts-/Linksbündig
printf("Name: %-10s|", $name);            // "Name: Max       |"
printf("Name: %10s|", $name);             // "Name:        Max|"

// Hexadezimal, Oktal, Binär
$zahl = 255;
printf("Dezimal: %d", $zahl);             // 255
printf("Hex: %x", $zahl);                 // ff
printf("Oktal: %o", $zahl);               // 377
printf("Binär: %b", $zahl);               // 11111111
?&gt;</code></pre>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <h5>Template-System mit Platzhaltern:</h5>
                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
// Einfaches Template-System
function render_template($template, $daten) {
    foreach ($daten as $key => $value) {
        $template = str_replace("{{$key}}", $value, $template);
    }
    return $template;
}

$email_template = &lt;&lt;&lt;EMAIL
Hallo {{name}},

vielen Dank für Ihre Bestellung {{bestellnr}}!

Ihre Daten:
- Name: {{name}}
- E-Mail: {{email}}
- Betrag: {{betrag}} €

Mit freundlichen Grüßen
{{firma}}
EMAIL;

$daten = [
    "name" => "Max Mustermann",
    "bestellnr" => "B-2024-001",
    "email" => "max@example.com", 
    "betrag" => number_format(299.99, 2),
    "firma" => "Meine Firma GmbH"
];

echo render_template($email_template, $daten);

// Erweiterte Formatierung für Geld
function format_currency($betrag, $währung = "€") {
    return number_format($betrag, 2, ",", ".") . " " . $währung;
}

echo format_currency(1234.56); // "1.234,56 €"

// URL-Template
function build_url($template, $parameter) {
    return str_replace(
        array_map(fn($k) => "{{$k}}", array_keys($parameter)),
        array_values($parameter),
        $template
    );
}

$url_template = "https://api.example.com/users/{{user_id}}/posts/{{post_id}}";
$url = build_url($url_template, ["user_id" => 123, "post_id" => 456]);
echo $url; // "https://api.example.com/users/123/posts/456"
?&gt;</code></pre>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h3>🔐 String-Validierung und -bereinigung</h3>
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="card bg-dark text-light">
                                    <div class="card-header">
                                        <small><i class="bi bi-shield-check me-2"></i>Sichere String-Verarbeitung</small>
                                    </div>
                                    <div class="card-body">
                                        <pre class="mb-0"><code class="language-php text-light">&lt;?php
// E-Mail-Validierung
function ist_email_gueltig($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

// URL-Validierung
function ist_url_gueltig($url) {
    return filter_var($url, FILTER_VALIDATE_URL) !== false;
}

// Nur Buchstaben und Zahlen erlauben
function nur_alphanum($text) {
    return ctype_alnum($text);
}

// Gefährliche Zeichen entfernen
function bereinige_benutzername($name) {
    // Nur Buchstaben, Zahlen, Bindestriche und Unterstriche
    $name = preg_replace('/[^a-zA-Z0-9_-]/', '', $name);
    $name = trim($name);
    return substr($name, 0, 30); // Max. 30 Zeichen
}

// SQL-Injection verhindern (besserer Weg: Prepared Statements!)
function escape_sql($text) {
    return addslashes($text);
}

// XSS verhindern
function sicher_ausgeben($text) {
    return htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
}

// Dateinamen bereinigen
function sicherer_dateiname($name) {
    // Gefährliche Zeichen entfernen
    $name = preg_replace('/[^a-zA-Z0-9._-]/', '', $name);
    $name = trim($name, '.');  // Führende/nachfolgende Punkte
    return substr($name, 0, 255); // Maximale Länge
}

// Passwort-Stärke prüfen
function pruefe_passwort($pw) {
    $fehler = [];
    if (strlen($pw) < 8) $fehler[] = "Mindestens 8 Zeichen";
    if (!preg_match('/[A-Z]/', $pw)) $fehler[] = "Großbuchstabe fehlt";
    if (!preg_match('/[a-z]/', $pw)) $fehler[] = "Kleinbuchstabe fehlt";
    if (!preg_match('/[0-9]/', $pw)) $fehler[] = "Zahl fehlt";
    if (!preg_match('/[^A-Za-z0-9]/', $pw)) $fehler[] = "Sonderzeichen fehlt";
    
    return empty($fehler) ? true : $fehler;
}

// Tests
echo ist_email_gueltig("test@example.com") ? "✅" : "❌";
echo ist_url_gueltig("https://www.example.com") ? "✅" : "❌";
echo nur_alphanum("abc123") ? "✅" : "❌";

$username = bereinige_benutzername("Max@Müller!123");
echo "Bereinigt: $username"; // "MaxMller123"

$gefährlich = "&lt;script&gt;alert('XSS')&lt;/script&gt;";
echo "Sicher: " . sicher_ausgeben($gefährlich);

$pw_check = pruefe_passwort("test");
if ($pw_check !== true) {
    echo "Passwort-Probleme: " . implode(", ", $pw_check);
}
?&gt;</code></pre>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h3>🌐 Encoding und Spezialzeichen</h3>
                        
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h5><i class="bi bi-globe text-info me-2"></i>UTF-8 und Umlaute</h5>
                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
// UTF-8 Funktionen für internationale Zeichen
$deutsch = "Größe, Umlaute: äöü ÄÖÜ ß";

// Multibyte-sichere Funktionen verwenden
echo mb_strlen($deutsch);              // Korrekte Länge
echo mb_strtoupper($deutsch);          // GRÖSSE, UMLAUTE: ÄÖÜ ÄÖÜ SS
echo mb_strtolower($deutsch);          // größe, umlaute: äöü äöü ß
echo mb_substr($deutsch, 0, 5);        // "Größe"

// Encoding konvertieren
$iso = mb_convert_encoding($deutsch, 'ISO-8859-1', 'UTF-8');
$utf8_zurück = mb_convert_encoding($iso, 'UTF-8', 'ISO-8859-1');

// Encoding erkennen
echo mb_detect_encoding($deutsch); // UTF-8

// URL-Encoding
$url_text = "Hallo Welt & Umlaute äöü";
echo urlencode($url_text);         // Für URLs geeignet
echo rawurlencode($url_text);      // RFC-konform

// JSON-sichere Kodierung
$json_text = "Anführungszeichen \" und Backslash \\";
echo json_encode($json_text, JSON_UNESCAPED_UNICODE);

// Base64 Kodierung
$original = "Geheime Nachricht";
$kodiert = base64_encode($original);
$dekodiert = base64_decode($kodiert);
echo "Original: $original";
echo "Kodiert: $kodiert";
echo "Dekodiert: $dekodiert";
?&gt;</code></pre>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h5><i class="bi bi-code text-success me-2"></i>HTML & URL Behandlung</h5>
                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
// HTML-Entities
$text = "Müller & Söhne GmbH";

// HTML-Entities kodieren
echo htmlentities($text); 
// "M&amp;uuml;ller &amp;amp; S&amp;ouml;hne GmbH"

// Zurück konvertieren
echo html_entity_decode("M&amp;uuml;ller &amp;amp; S&amp;ouml;hne");

// Spezielle Zeichen für HTML
echo htmlspecialchars("&lt;h1&gt;Titel&lt;/h1&gt;");
// "&amp;lt;h1&amp;gt;Titel&amp;lt;/h1&amp;gt;"

// URL-Komponenten parsen
$url = "https://user:pass@example.com:8080/path?query=test#fragment";
$parts = parse_url($url);
print_r($parts);

// Query-String zu Array
$query = "name=Max&amp;alter=25&amp;stadt=Berlin";
parse_str($query, $params);
print_r($params); // ["name" => "Max", "alter" => "25", ...]

// Array zu Query-String
$data = ["name" => "Max", "alter" => 25];
echo http_build_query($data); // "name=Max&amp;alter=25"

// Slug für URLs erstellen
function create_slug($text) {
    $text = strtolower($text);
    $text = str_replace(['ä','ö','ü','ß'], ['ae','oe','ue','ss'], $text);
    $text = preg_replace('/[^a-z0-9-]/', '-', $text);
    $text = preg_replace('/-+/', '-', $text);
    return trim($text, '-');
}

echo create_slug("Müller & Söhne GmbH"); // "mueller-soehne-gmbh"
?&gt;</code></pre>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h3>🎮 Großes Praxisbeispiel: Content-Management-System</h3>
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="card bg-dark text-light">
                                    <div class="card-header">
                                        <small><i class="bi bi-newspaper me-2"></i>String-Verarbeitung im CMS</small>
                                    </div>
                                    <div class="card-body">
                                        <pre class="mb-0"><code class="language-php text-light">&lt;?php
// CMS-Artikel Verarbeitung mit String-Funktionen
class ArticleProcessor {
    
    public function create_excerpt($content, $max_words = 50) {
        // HTML-Tags entfernen
        $clean = strip_tags($content);
        
        // Zu Array von Wörtern
        $words = str_word_count($clean, 1);
        
        if (count($words) <= $max_words) {
            return $clean;
        }
        
        // Erste X Wörter nehmen
        $excerpt = implode(' ', array_slice($words, 0, $max_words));
        return $excerpt . '...';
    }
    
    public function create_slug($title) {
        $slug = strtolower(trim($title));
        
        // Umlaute ersetzen
        $replacements = [
            'ä' => 'ae', 'ö' => 'oe', 'ü' => 'ue', 'ß' => 'ss',
            'Ä' => 'ae', 'Ö' => 'oe', 'Ü' => 'ue'
        ];
        
        $slug = strtr($slug, $replacements);
        
        // Nur erlaubte Zeichen behalten
        $slug = preg_replace('/[^a-z0-9\s-]/', '', $slug);
        
        // Leerzeichen zu Bindestrichen
        $slug = preg_replace('/[\s-]+/', '-', $slug);
        
        return trim($slug, '-');
    }
    
    public function highlight_search_term($content, $search_term) {
        if (empty($search_term)) return $content;
        
        // HTML-sicher machen
        $safe_term = htmlspecialchars($search_term);
        
        // Hervorheben (case-insensitive)
        return str_ireplace(
            $search_term, 
            "&lt;mark&gt;$safe_term&lt;/mark&gt;", 
            $content
        );
    }
    
    public function process_content($raw_content) {
        // 1. Gefährliche Inhalte entfernen
        $content = strip_tags($raw_content, '&lt;p&gt;&lt;br&gt;&lt;strong&gt;&lt;em&gt;&lt;ul&gt;&lt;ol&gt;&lt;li&gt;&lt;h1&gt;&lt;h2&gt;&lt;h3&gt;');
        
        // 2. Zeilenumbrüche zu &lt;br&gt; konvertieren
        $content = nl2br($content);
        
        // 3. Doppelte Leerzeichen entfernen
        $content = preg_replace('/\s+/', ' ', $content);
        
        // 4. Auto-Links erstellen
        $content = preg_replace(
            '/(https?:\/\/[^\s]+)/', 
            '&lt;a href="$1" target="_blank"&gt;$1&lt;/a&gt;', 
            $content
        );
        
        return trim($content);
    }
    
    public function generate_reading_time($content) {
        $word_count = str_word_count(strip_tags($content));
        $reading_time = ceil($word_count / 200); // 200 Wörter/Minute
        
        if ($reading_time <= 1) {
            return "1 Minute";
        } else {
            return "$reading_time Minuten";
        }
    }
    
    public function format_publish_date($timestamp, $format = 'd.m.Y H:i') {
        $date = new DateTime($timestamp);
        $now = new DateTime();
        $diff = $now->diff($date);
        
        // Relative Zeitangaben für recent posts
        if ($diff->days == 0) {
            if ($diff->h == 0) {
                return "vor {$diff->i} Minuten";
            } else {
                return "vor {$diff->h} Stunden";
            }
        } elseif ($diff->days == 1) {
            return "gestern";
        } elseif ($diff->days <= 7) {
            return "vor {$diff->days} Tagen";
        } else {
            return $date->format($format);
        }
    }
}

// Demonstration
$processor = new ArticleProcessor();

// Beispiel-Artikel
$artikel = [
    "title" => "Die Zukunft der Künstlichen Intelligenz & Machine Learning",
    "content" => "&lt;p&gt;Künstliche Intelligenz (KI) wird unsere Welt grundlegend verändern. Von autonomen Fahrzeugen bis hin zu intelligenten Haushalten - die Möglichkeiten sind endlos.&lt;/p&gt;&lt;p&gt;Machine Learning Algorithmen werden immer besser darin, komplexe Muster zu erkennen und Vorhersagen zu treffen. Dies eröffnet neue Möglichkeiten in der Medizin, im Finanzwesen und vielen anderen Bereichen.&lt;/p&gt;&lt;p&gt;Mehr Infos unter: https://www.ki-beispiel.de&lt;/p&gt;",
    "created_at" => "2024-08-30 14:30:00"
];

echo "&lt;div class='card mb-4'&gt;";
echo "&lt;div class='card-header'&gt;";
echo "&lt;h3&gt;" . htmlspecialchars($artikel["title"]) . "&lt;/h3&gt;";

// Slug erstellen
$slug = $processor->create_slug($artikel["title"]);
echo "&lt;small class='text-muted'&gt;URL-Slug: " . $slug . "&lt;/small&gt;&lt;br&gt;";

// Lesedauer
$reading_time = $processor->generate_reading_time($artikel["content"]);
echo "&lt;small class='text-muted'&gt;Lesedauer: " . $reading_time . "&lt;/small&gt;&lt;br&gt;";

// Datum formatieren
$formatted_date = $processor->format_publish_date($artikel["created_at"]);
echo "&lt;small class='text-muted'&gt;Veröffentlicht: " . $formatted_date . "&lt;/small&gt;";

echo "&lt;/div&gt;";
echo "&lt;div class='card-body'&gt;";

// Excerpt erstellen
$excerpt = $processor->create_excerpt($artikel["content"], 30);
echo "&lt;p class='lead'&gt;" . htmlspecialchars($excerpt) . "&lt;/p&gt;";

// Vollständigen Inhalt verarbeiten
$processed_content = $processor->process_content($artikel["content"]);
echo "&lt;div&gt;" . $processed_content . "&lt;/div&gt;";

// Suchterm hervorheben (Beispiel)
$search_term = "Machine Learning";
$highlighted = $processor->highlight_search_term($processed_content, $search_term);
echo "&lt;hr&gt;&lt;h4&gt;Mit hervorgehobenem Suchbegriff '$search_term':&lt;/h4&gt;";
echo "&lt;div&gt;" . $highlighted . "&lt;/div&gt;";

echo "&lt;/div&gt;&lt;/div&gt;";
?&gt;</code></pre>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="alert alert-success">
                            <h5><i class="bi bi-type me-2"></i>Strings - Die wichtigsten Funktionen im Überblick</h5>
                            <ul class="mb-0">
                                <li>✅ <strong>strlen()</strong> für Länge, <strong>substr()</strong> für Ausschnitte</li>
                                <li>✅ <strong>strtolower()/strtoupper()</strong> für Groß-/Kleinschreibung</li>
                                <li>✅ <strong>trim()</strong> für Leerzeichen, <strong>str_replace()</strong> für Ersetzungen</li>
                                <li>✅ <strong>explode()/implode()</strong> für Array-Konvertierung</li>
                                <li>✅ <strong>strpos()/strstr()</strong> zum Suchen und Finden</li>
                                <li>✅ <strong>htmlspecialchars()</strong> für XSS-Schutz</li>
                                <li>✅ <strong>mb_*()</strong> Funktionen für UTF-8/Umlaute verwenden</li>
                            </ul>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <h6>Vorheriges Thema</h6>
                                        <a href="php-arrays.php" class="btn btn-outline-secondary">
                                            <i class="bi bi-arrow-left me-2"></i>Arrays
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <h6>Nächstes Thema</h6>
                                        <a href="php-mathematik.php" class="btn btn-primary">
                                            <i class="bi bi-calculator me-2"></i>Mathematik
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <h6>Zur Übersicht</h6>
                                        <a href="php-index.php" class="btn btn-outline-secondary">
                                            <i class="bi bi-house me-2"></i>PHP Hauptseite
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

    <?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>