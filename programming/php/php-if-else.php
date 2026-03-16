<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';

include $_SERVER['DOCUMENT_ROOT'] . '/includes/php-navigation.php';

$page_title = 'PHP If/Else - Entscheidungen treffen';
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
                        
                        <?php renderNavigation('php-if-else'); ?>
                        
                        <div class="d-flex justify-content-between align-items-center pt-3 pb-2 mb-3 border-bottom">
                            <h1 class="h2"><i class="bi bi-shuffle me-2"></i>PHP If/Else</h1>
                        </div>

                        <div class="card bg-light mb-4">
                            <div class="card-body">
                                <h2>🤔 Entscheidungen in PHP treffen</h2>
                                <p class="lead">If/Else-Anweisungen sind das Herzstück der Programmlogik. Sie ermöglichen es Ihrem Code, <strong>intelligent zu reagieren</strong> und verschiedene Aktionen basierend auf Bedingungen auszuführen!</p>
                            </div>
                        </div>

                        <div class="alert alert-info">
                            <h5><i class="bi bi-lightbulb me-2"></i>Stellen Sie sich vor...</h5>
                            <p class="mb-0">If/Else ist wie ein <strong>Türsteher</strong> vor einem Club: "Wenn Sie über 18 sind, kommen Sie rein, ansonsten müssen Sie draußen bleiben." Genau so funktioniert Programmierung - Bedingungen prüfen und entsprechend handeln!</p>
                        </div>

                        <h3>🚪 Die einfache If-Anweisung</h3>
                        <div class="card mb-4">
                            <div class="card-body">
                                <p>Die einfachste Form: "Wenn diese Bedingung wahr ist, dann tu das."</p>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <h5>Grundsyntax:</h5>
                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
if (bedingung) {
    // Code wird ausgeführt, wenn bedingung = true
    echo "Die Bedingung ist wahr!";
}
?&gt;</code></pre>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <h5>Praktisches Beispiel:</h5>
                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
$alter = 20;

if ($alter >= 18) {
    echo "Sie sind volljährig!";
}

$wetter = "sonnig";
if ($wetter === "sonnig") {
    echo "Perfekt für einen Spaziergang!";
}

$punkte = 85;
if ($punkte > 90) {
    echo "Hervorragend! Top-Leistung!";
}
?&gt;</code></pre>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h3>🔄 If-Else - Die Alternative</h3>
                        <div class="card mb-4">
                            <div class="card-body">
                                <p>"Wenn diese Bedingung wahr ist, tu das - <strong>ansonsten</strong> tu etwas anderes."</p>
                                
                                <div class="card bg-dark text-light">
                                    <div class="card-header">
                                        <small><i class="bi bi-code me-2"></i>If-Else Syntax</small>
                                    </div>
                                    <div class="card-body">
                                        <pre class="mb-0"><code class="language-php text-light">&lt;?php
$alter = 16;

if ($alter >= 18) {
    echo "Willkommen! Sie dürfen rein.";
} else {
    echo "Tut mir leid, Sie sind zu jung.";
}

$temperatur = 15;
if ($temperatur > 25) {
    echo "Es ist warm - T-Shirt anziehen!";
} else {
    echo "Es ist kühl - Jacke nicht vergessen!";
}

$kontostand = -50;
if ($kontostand >= 0) {
    echo "Ihr Konto ist gedeckt.";
} else {
    echo "Achtung: Ihr Konto ist im Minus!";
}
?&gt;</code></pre>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h3>🎯 ElseIf - Mehrere Bedingungen</h3>
                        <div class="card mb-4">
                            <div class="card-body">
                                <p>Für komplexere Entscheidungen mit mehreren Möglichkeiten:</p>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <h5>Notensystem:</h5>
                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
$punkte = 78;

if ($punkte >= 90) {
    echo "Note: Sehr gut (1)";
} elseif ($punkte >= 80) {
    echo "Note: Gut (2)";
} elseif ($punkte >= 70) {
    echo "Note: Befriedigend (3)";
} elseif ($punkte >= 60) {
    echo "Note: Ausreichend (4)";
} elseif ($punkte >= 50) {
    echo "Note: Mangelhaft (5)";
} else {
    echo "Note: Ungenügend (6)";
}
?&gt;</code></pre>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <h5>Tageszeit bestimmen:</h5>
                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
$stunde = date('H'); // Aktuelle Stunde (0-23)

if ($stunde < 6) {
    $tageszeit = "Frühe Nacht";
    $gruß = "Sie sind aber früh wach!";
} elseif ($stunde < 12) {
    $tageszeit = "Morgen";
    $gruß = "Guten Morgen!";
} elseif ($stunde < 18) {
    $tageszeit = "Nachmittag";  
    $gruß = "Guten Tag!";
} else {
    $tageszeit = "Abend";
    $gruß = "Guten Abend!";
}

echo "$gruß Es ist $tageszeit.";
?&gt;</code></pre>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h3>🧮 Komplexe Bedingungen</h3>
                        <div class="card mb-4">
                            <div class="card-body">
                                <h5>Mehrere Bedingungen mit logischen Operatoren verknüpfen:</h5>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <h5>UND-Verknüpfung (&&):</h5>
                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
$alter = 25;
$hat_fuehrerschein = true;
$ist_nuechtern = true;

// ALLE Bedingungen müssen erfüllt sein
if ($alter >= 18 && $hat_fuehrerschein && $ist_nuechtern) {
    echo "Darf Auto fahren!";
} else {
    echo "Darf nicht fahren.";
}

// Rabatt für Studenten unter 30
$ist_student = true;
$alter = 22;

if ($ist_student && $alter < 30) {
    echo "20% Studentenrabatt!";
}
?&gt;</code></pre>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <h5>ODER-Verknüpfung (||):</h5>
                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
$ist_admin = false;
$ist_moderator = true;
$ist_premium = false;

// MINDESTENS eine Bedingung muss erfüllt sein
if ($ist_admin || $ist_moderator || $ist_premium) {
    echo "Zugang zum Admin-Bereich erlaubt!";
} else {
    echo "Zugang verweigert.";
}

// Wochenende oder Feiertag
$heute = date('N'); // 1-7 (Mo-So)
$ist_feiertag = false;

if ($heute >= 6 || $ist_feiertag) {
    echo "Heute ist frei! 🎉";
}
?&gt;</code></pre>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h3>🔍 Verschachtelte If-Anweisungen</h3>
                        <div class="card mb-4">
                            <div class="card-body">
                                <p>If-Anweisungen können ineinander verschachtelt werden für komplexere Logik:</p>
                                
                                <div class="card bg-dark text-light">
                                    <div class="card-header">
                                        <small><i class="bi bi-layers me-2"></i>Verschachtelte Bedingungen</small>
                                    </div>
                                    <div class="card-body">
                                        <pre class="mb-0"><code class="language-php text-light">&lt;?php
$benutzer_typ = "premium";
$alter = 17;
$land = "Deutschland";

if ($benutzer_typ === "premium") {
    echo "Premium-Benutzer erkannt! 🌟&lt;br&gt;";
    
    if ($alter >= 18) {
        echo "Vollzugriff auf alle Inhalte.&lt;br&gt;";
        
        if ($land === "Deutschland") {
            echo "Deutsche Inhalte verfügbar.&lt;br&gt;";
        } else {
            echo "Internationale Inhalte verfügbar.&lt;br&gt;";
        }
    } else {
        echo "Jugendschutz aktiv - eingeschränkte Inhalte.&lt;br&gt;";
    }
} else {
    echo "Standard-Benutzer - Basis-Inhalte verfügbar.&lt;br&gt;";
}

// Login-System Beispiel
$benutzername = "max123";
$passwort = "geheim";
$ist_aktiv = true;

if (!empty($benutzername) && !empty($passwort)) {
    if ($benutzername === "max123" && $passwort === "geheim") {
        if ($ist_aktiv) {
            echo "✅ Login erfolgreich! Willkommen zurück!";
        } else {
            echo "❌ Account ist deaktiviert.";
        }
    } else {
        echo "❌ Falsche Anmeldedaten.";
    }
} else {
    echo "❌ Bitte alle Felder ausfüllen.";
}
?&gt;</code></pre>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h3>⚡ Kurze If-Syntax (Ternary Operator)</h3>
                        <div class="card mb-4">
                            <div class="card-body">
                                <p>Für einfache If-Else Entscheidungen gibt es eine Kurzform:</p>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <h5>Normale If-Else:</h5>
                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
$alter = 17;

if ($alter >= 18) {
    $status = "Erwachsen";
} else {
    $status = "Minderjährig";
}

echo $status;
?&gt;</code></pre>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <h5>Ternary Operator:</h5>
                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
$alter = 17;

// Syntax: bedingung ? wert_wenn_wahr : wert_wenn_falsch
$status = ($alter >= 18) ? "Erwachsen" : "Minderjährig";

echo $status;

// Weitere Beispiele:
$wetter = "Regen";
$aktivität = ($wetter === "Sonne") ? "Schwimmen gehen" : "Film schauen";

$punkte = 95;
$note = ($punkte >= 90) ? "Sehr gut" : "Gut";

echo "Bei $wetter: $aktivität";
echo "Mit $punkte Punkten: Note $note";
?&gt;</code></pre>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h3>🎨 Praktisches Beispiel: Benutzer-Dashboard</h3>
                        <div class="card mb-4">
                            <div class="card-body">
                                <p>Ein realistisches Beispiel, das verschiedene If-Else Konstrukte kombiniert:</p>
                                
                                <div class="card bg-dark text-light">
                                    <div class="card-header">
                                        <small><i class="bi bi-person-circle me-2"></i>Benutzer-Dashboard mit Bedingungen</small>
                                    </div>
                                    <div class="card-body">
                                        <pre class="mb-0"><code class="language-php text-light">&lt;?php
// Benutzer-Daten
$benutzer = [
    'name' => 'Anna Müller',
    'alter' => 28,
    'typ' => 'premium',
    'punkte' => 1250,
    'ist_aktiv' => true,
    'letzte_anmeldung' => '2024-08-30',
    'sprache' => 'deutsch'
];

echo "&lt;div class='card'&gt;";
echo "&lt;div class='card-header'&gt;";

// Begrüßung basierend auf Tageszeit
$stunde = date('H');
if ($stunde < 12) {
    $begrüßung = "Guten Morgen";
} elseif ($stunde < 18) {
    $begrüßung = "Guten Tag";
} else {
    $begrüßung = "Guten Abend";
}

echo "&lt;h2&gt;$begrüßung, " . $benutzer['name'] . "!&lt;/h2&gt;";

// Status-Badge
if ($benutzer['typ'] === 'premium') {
    echo "&lt;span class='badge bg-warning'&gt;🌟 Premium&lt;/span&gt;";
} elseif ($benutzer['typ'] === 'moderator') {
    echo "&lt;span class='badge bg-info'&gt;🛡️ Moderator&lt;/span&gt;";
} else {
    echo "&lt;span class='badge bg-secondary'&gt;Basis&lt;/span&gt;";
}

echo "&lt;/div&gt;&lt;div class='card-body'&gt;";

// Account-Status prüfen
if (!$benutzer['ist_aktiv']) {
    echo "&lt;div class='alert alert-danger'&gt;❌ Ihr Account ist deaktiviert!&lt;/div&gt;";
} else {
    echo "&lt;div class='alert alert-success'&gt;✅ Account ist aktiv&lt;/div&gt;";
    
    // Punkte-Status
    if ($benutzer['punkte'] >= 2000) {
        echo "&lt;p&gt;🏆 Elite-Status erreicht! ({$benutzer['punkte']} Punkte)&lt;/p&gt;";
    } elseif ($benutzer['punkte'] >= 1000) {
        echo "&lt;p&gt;⭐ Fortgeschritten-Status! ({$benutzer['punkte']} Punkte)&lt;/p&gt;";
    } else {
        echo "&lt;p&gt;🔰 Anfänger-Status ({$benutzer['punkte']} Punkte)&lt;/p&gt;";
    }
    
    // Altersbasierte Inhalte
    $inhalt_typ = ($benutzer['alter'] >= 18) ? "Vollversion" : "Jugendversion";
    echo "&lt;p&gt;📚 Verfügbare Inhalte: $inhalt_typ&lt;/p&gt;";
    
    // Premium-Features
    if ($benutzer['typ'] === 'premium') {
        echo "&lt;div class='alert alert-info'&gt;";
        echo "&lt;h5&gt;Premium-Features:&lt;/h5&gt;";
        echo "&lt;ul&gt;";
        echo "&lt;li&gt;✅ Werbefreie Nutzung&lt;/li&gt;";
        echo "&lt;li&gt;✅ Exklusive Inhalte&lt;/li&gt;";
        echo "&lt;li&gt;✅ Prioritärer Support&lt;/li&gt;";
        echo "&lt;/ul&gt;&lt;/div&gt;";
    }
}

echo "&lt;/div&gt;&lt;/div&gt;";
?&gt;</code></pre>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h3>⚠️ Häufige Fehler vermeiden</h3>
                        
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="card border-danger">
                                    <div class="card-header bg-danger text-white">
                                        <h6 class="mb-0">❌ Häufige Fehler</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="card bg-dark text-light mb-3">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">// FALSCH: Zuweisung statt Vergleich
if ($alter = 18) {  // = statt ==
    echo "18 Jahre alt";
}

// FALSCH: Vergessene Klammern
if $alter >= 18 {
    echo "Volljährig";
}

// FALSCH: Fehlende geschweifte Klammern bei mehreren Befehlen
if ($alter >= 18)
    echo "Volljährig";
    echo "Darf wählen";  // Läuft immer!</code></pre>
                                            </div>
                                        </div>
                                        <small class="text-danger">Diese Fehler führen zu unerwarteten Ergebnissen!</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card border-success">
                                    <div class="card-header bg-success text-white">
                                        <h6 class="mb-0">✅ Richtige Schreibweise</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="card bg-dark text-light mb-3">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">// RICHTIG: Vergleich mit ==
if ($alter == 18) {
    echo "Genau 18 Jahre alt";
}

// RICHTIG: Klammern um Bedingung
if ($alter >= 18) {
    echo "Volljährig";
}

// RICHTIG: Geschweifte Klammern
if ($alter >= 18) {
    echo "Volljährig";
    echo "Darf wählen";
}</code></pre>
                                            </div>
                                        </div>
                                        <small class="text-success">So funktioniert es korrekt!</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="alert alert-success">
                            <h5><i class="bi bi-shuffle me-2"></i>If/Else - Kernpunkte merken</h5>
                            <ul class="mb-0">
                                <li>✅ <strong>If</strong> für einfache Bedingungen - "Wenn..., dann..."</li>
                                <li>✅ <strong>If-Else</strong> für Alternativen - "Wenn..., dann..., sonst..."</li>
                                <li>✅ <strong>ElseIf</strong> für mehrere Möglichkeiten</li>
                                <li>✅ <strong>&& (UND)</strong> wenn alle Bedingungen erfüllt sein müssen</li>
                                <li>✅ <strong>|| (ODER)</strong> wenn mindestens eine Bedingung erfüllt sein soll</li>
                                <li>✅ <strong>Ternary (?:)</strong> für kurze If-Else Entscheidungen</li>
                                <li>✅ <strong>===</strong> statt == für genaue Vergleiche verwenden</li>
                            </ul>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <h6>Vorheriges Thema</h6>
                                        <a href="php-operatoren.php" class="btn btn-outline-secondary">
                                            <i class="bi bi-arrow-left me-2"></i>PHP Operatoren
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <h6>Nächstes Thema</h6>
                                        <a href="php-switch.php" class="btn btn-primary">
                                            <i class="bi bi-list me-2"></i>Switch-Anweisung
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