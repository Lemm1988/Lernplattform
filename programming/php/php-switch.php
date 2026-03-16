<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once $_SERVER['DOCUMENT_ROOT'] . '/config.php';

include $_SERVER['DOCUMENT_ROOT'] . '/includes/php-navigation.php';

$page_title = 'PHP Switch - Elegante Mehrfachauswahl';
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
                        
                        <?php renderNavigation('php-switch'); ?>
                        
                        <div class="d-flex justify-content-between align-items-center pt-3 pb-2 mb-3 border-bottom">
                            <h1 class="h2"><i class="bi bi-list me-2"></i>PHP Switch</h1>
                        </div>

                        <div class="card bg-light mb-4">
                            <div class="card-body">
                                <h2>🎛️ Switch - Die elegante Alternative zu ElseIf</h2>
                                <p class="lead">Wenn Sie eine Variable mit <strong>vielen verschiedenen Werten</strong> vergleichen müssen, ist Switch oft übersichtlicher und eleganter als eine lange ElseIf-Kette!</p>
                            </div>
                        </div>

                        <div class="alert alert-info">
                            <h5><i class="bi bi-lightbulb me-2"></i>Wann Switch verwenden?</h5>
                            <p class="mb-0">Switch ist perfekt, wenn Sie <strong>eine Variable mit mehreren exakten Werten</strong> vergleichen wollen - wie ein Menü mit verschiedenen Optionen oder die Auswertung von Noten, Wochentagen oder Status-Codes.</p>
                        </div>

                        <h3>⚖️ ElseIf vs. Switch - Der Vergleich</h3>
                        
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="card border-warning">
                                    <div class="card-header bg-warning">
                                        <h5 class="mb-0">🔄 Mit ElseIf (umständlich)</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
$wochentag = 3;

if ($wochentag == 1) {
    echo "Montag - Start in die Woche!";
} elseif ($wochentag == 2) {
    echo "Dienstag - Läuft schon!";
} elseif ($wochentag == 3) {
    echo "Mittwoch - Bergfest!";
} elseif ($wochentag == 4) {
    echo "Donnerstag - Fast geschafft!";
} elseif ($wochentag == 5) {
    echo "Freitag - Wochenende in Sicht!";
} elseif ($wochentag == 6) {
    echo "Samstag - Endlich frei!";
} elseif ($wochentag == 7) {
    echo "Sonntag - Entspannung!";
} else {
    echo "Ungültiger Wochentag";
}
?&gt;</code></pre>
                                            </div>
                                        </div>
                                        <small class="text-warning">Viel Wiederholung und umständlich</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card border-success">
                                    <div class="card-header bg-success text-white">
                                        <h5 class="mb-0">✨ Mit Switch (elegant)</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
$wochentag = 3;

switch ($wochentag) {
    case 1:
        echo "Montag - Start in die Woche!";
        break;
    case 2:
        echo "Dienstag - Läuft schon!";
        break;
    case 3:
        echo "Mittwoch - Bergfest!";
        break;
    case 4:
        echo "Donnerstag - Fast geschafft!";
        break;
    case 5:
        echo "Freitag - Wochenende in Sicht!";
        break;
    case 6:
        echo "Samstag - Endlich frei!";
        break;
    case 7:
        echo "Sonntag - Entspannung!";
        break;
    default:
        echo "Ungültiger Wochentag";
        break;
}
?&gt;</code></pre>
                                            </div>
                                        </div>
                                        <small class="text-success">Klarer und übersichtlicher</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h3>📋 Switch-Syntax verstehen</h3>
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h5>Grundstruktur:</h5>
                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
switch ($variable) {
    case "wert1":
        // Code für wert1
        break;
    
    case "wert2":
        // Code für wert2
        break;
    
    case "wert3":
        // Code für wert3
        break;
    
    default:
        // Code wenn kein case passt
        break;
}
?&gt;</code></pre>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <h5>Wichtige Bestandteile:</h5>
                                        <ul>
                                            <li><code>switch ($variable)</code> - Die Variable, die geprüft wird</li>
                                            <li><code>case "wert":</code> - Ein möglicher Wert</li>
                                            <li><code>break;</code> - Verhindert "Durchfallen" zum nächsten Case</li>
                                            <li><code>default:</code> - Wird ausgeführt, wenn kein Case passt (optional)</li>
                                        </ul>
                                        
                                        <div class="alert alert-warning">
                                            <strong>Wichtig:</strong> Das <code>break;</code> ist entscheidend! Ohne break wird der Code in den nächsten Cases weiterausgeführt.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h3>🎯 Praktische Switch-Beispiele</h3>
                        
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h5><i class="bi bi-calendar text-primary me-2"></i>Wochentagsplaner</h5>
                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
$heute = date('N'); // 1=Montag, 7=Sonntag

switch ($heute) {
    case 1:
        $plan = "Team-Meeting um 9:00";
        $stil = "primary";
        break;
    case 2:
        $plan = "Projektarbeit - Deep Work";
        $stil = "info";
        break;
    case 3:
        $plan = "Kundentermine";
        $stil = "warning";
        break;
    case 4:
        $plan = "Review und Planung";
        $stil = "secondary";
        break;
    case 5:
        $plan = "Wochenabschluss 🎉";
        $stil = "success";
        break;
    case 6:
    case 7:
        $plan = "Wochenende - Erholung!";
        $stil = "danger";
        break;
}

echo "&lt;div class='alert alert-$stil'&gt;";
echo "&lt;strong&gt;Heute:&lt;/strong&gt; $plan";
echo "&lt;/div&gt;";
?&gt;</code></pre>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h5><i class="bi bi-star text-warning me-2"></i>Bewertungssystem</h5>
                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
$bewertung = 4; // 1-5 Sterne

switch ($bewertung) {
    case 1:
        $text = "Sehr schlecht";
        $farbe = "danger";
        $sterne = "⭐";
        break;
    case 2:
        $text = "Schlecht";
        $farbe = "warning";
        $sterne = "⭐⭐";
        break;
    case 3:
        $text = "Durchschnittlich";
        $farbe = "info";
        $sterne = "⭐⭐⭐";
        break;
    case 4:
        $text = "Gut";
        $farbe = "primary";
        $sterne = "⭐⭐⭐⭐";
        break;
    case 5:
        $text = "Ausgezeichnet";
        $farbe = "success";
        $sterne = "⭐⭐⭐⭐⭐";
        break;
    default:
        $text = "Ungültige Bewertung";
        $farbe = "secondary";
        $sterne = "❓";
        break;
}

echo "&lt;span class='badge bg-$farbe'&gt;$sterne $text&lt;/span&gt;";
?&gt;</code></pre>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h3>⚠️ Das "break;" verstehen - Fall-Through Verhalten</h3>
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="alert alert-warning">
                                    <h6><i class="bi bi-exclamation-triangle me-2"></i>Aufgepasst!</h6>
                                    <p class="mb-0">Ohne <code>break;</code> läuft der Code in den nächsten Case weiter - das nennt man "Fall-Through".</p>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <h5>❌ Ohne break (ungewollt):</h5>
                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
$note = "B";

switch ($note) {
    case "A":
        echo "Ausgezeichnet!";
        // FEHLT: break;
    case "B":
        echo "Gut gemacht!";
        // FEHLT: break;
    case "C":
        echo "Befriedigend";
        break;
    default:
        echo "Unbekannte Note";
        break;
}

// Ausgabe bei $note = "B":
// "Gut gemacht!Befriedigend"
// Beide Cases werden ausgeführt!
?&gt;</code></pre>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <h5>✅ Mit break (korrekt):</h5>
                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
$note = "B";

switch ($note) {
                                        case "A":
        echo "Ausgezeichnet!";
        break;  // ✅ Stoppt hier
    case "B":
        echo "Gut gemacht!";
        break;  // ✅ Stoppt hier
    case "C":
        echo "Befriedigend";
        break;
    default:
        echo "Unbekannte Note";
        break;
}

// Ausgabe bei $note = "B":
// "Gut gemacht!"
// Nur der passende Case wird ausgeführt!
?&gt;</code></pre>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h3>🔄 Fall-Through gezielt nutzen</h3>
                        <div class="card mb-4">
                            <div class="card-body">
                                <p>Manchmal ist das Fall-Through-Verhalten erwünscht - für mehrere Cases mit gleicher Aktion:</p>
                                
                                <div class="card bg-dark text-light">
                                    <div class="card-header">
                                        <small><i class="bi bi-layers me-2"></i>Gezieltes Fall-Through</small>
                                    </div>
                                    <div class="card-body">
                                        <pre class="mb-0"><code class="language-php text-light">&lt;?php
$monat = 2;

switch ($monat) {
    case 12:
    case 1:
    case 2:
        echo "Winter ❄️ - Zeit für heißen Tee!";
        $jahreszeit = "Winter";
        break;
        
    case 3:
    case 4:
    case 5:
        echo "Frühling 🌸 - Alles blüht auf!";
        $jahreszeit = "Frühling";
        break;
        
    case 6:
    case 7:
    case 8:
        echo "Sommer ☀️ - Ab ins Schwimmbad!";
        $jahreszeit = "Sommer";
        break;
        
    case 9:
    case 10:
    case 11:
        echo "Herbst 🍂 - Bunte Blätter fallen!";
        $jahreszeit = "Herbst";
        break;
        
    default:
        echo "Ungültiger Monat";
        $jahreszeit = "Unbekannt";
        break;
}

// Arbeitszeiten nach Jahreszeit
switch ($jahreszeit) {
    case "Sommer":
        echo "&lt;br&gt;⏰ Arbeitszeiten: 7:00-15:00 (Hitze vermeiden)";
        break;
    case "Winter":
        echo "&lt;br&gt;⏰ Arbeitszeiten: 8:00-17:00 (Tageslicht nutzen)";
        break;
    default:
        echo "&lt;br&gt;⏰ Arbeitszeiten: 8:00-16:00 (Standard)";
        break;
}
?&gt;</code></pre>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h3>🎮 Komplexes Beispiel: Game-Status</h3>
                        <div class="card mb-4">
                            <div class="card-body">
                                <p>Ein realistisches Beispiel für ein Spiel-Menüsystem:</p>
                                
                                <div class="card bg-dark text-light">
                                    <div class="card-header">
                                        <small><i class="bi bi-controller me-2"></i>Game-Menü mit Switch</small>
                                    </div>
                                    <div class="card-body">
                                        <pre class="mb-0"><code class="language-php text-light">&lt;?php
$spieler_aktion = "inventar";
$spieler_level = 15;
$hat_schluessel = true;

switch ($spieler_aktion) {
    case "kampf":
    case "fight":
    case "angriff":
        if ($spieler_level >= 10) {
            echo "⚔️ Du greifst den Gegner an!";
            $schaden = rand(10, 20);
            echo "&lt;br&gt;💥 Du machst $schaden Schadenspunkte!";
        } else {
            echo "❌ Du bist zu schwach für den Kampf!";
        }
        break;
        
    case "inventar":
    case "inventory":
    case "items":
        echo "🎒 Dein Inventar:&lt;br&gt;";
        echo "- Schwert (Level 5)&lt;br&gt;";
        echo "- Heiltränke: 3 Stück&lt;br&gt;";
        if ($hat_schluessel) {
            echo "- 🗝️ Goldener Schlüssel&lt;br&gt;";
        }
        echo "- Gold: " . rand(100, 500) . " Münzen";
        break;
        
    case "tür":
    case "door":
    case "oeffnen":
        if ($hat_schluessel) {
            echo "🚪 Du öffnest die Tür mit dem goldenen Schlüssel!";
            echo "&lt;br&gt;✨ Ein geheimer Raum öffnet sich vor dir!";
        } else {
            echo "🔒 Die Tür ist verschlossen. Du brauchst einen Schlüssel.";
        }
        break;
        
    case "heilen":
    case "heal":
    case "trinken":
        echo "🧪 Du trinkst einen Heiltrank!";
        $heilung = rand(20, 40);
        echo "&lt;br&gt;💚 Du wirst um $heilung Lebenspunkte geheilt!";
        break;
        
    case "status":
    case "stats":
        echo "&lt;div class='card border-info'&gt;";
        echo "&lt;div class='card-header'&gt;📊 Spieler-Status&lt;/div&gt;";
        echo "&lt;div class='card-body'&gt;";
        echo "&lt;p&gt;&lt;strong&gt;Level:&lt;/strong&gt; $spieler_level&lt;/p&gt;";
        echo "&lt;p&gt;&lt;strong&gt;Lebenspunkte:&lt;/strong&gt; " . ($spieler_level * 10) . "&lt;/p&gt;";
        echo "&lt;p&gt;&lt;strong&gt;Erfahrung:&lt;/strong&gt; " . ($spieler_level * 100) . " XP&lt;/p&gt;";
        echo "&lt;/div&gt;&lt;/div&gt;";
        break;
        
    case "quit":
    case "exit":
    case "beenden":
        echo "👋 Auf Wiedersehen! Dein Spielstand wird gespeichert.";
        echo "&lt;br&gt;💾 Fortschritt gesichert.";
        break;
        
    default:
        echo "❓ Unbekannte Aktion: '$spieler_aktion'";
        echo "&lt;br&gt;💡 Verfügbare Aktionen: kampf, inventar, tür, heilen, status, quit";
        break;
}
?&gt;</code></pre>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h3>🔢 Switch mit verschiedenen Datentypen</h3>
                        <div class="card mb-4">
                            <div class="card-body">
                                <p>Switch funktioniert mit Strings, Numbers und anderen Datentypen:</p>
                                
                                <div class="row">
                                    <div class="col-md-4">
                                        <h6>Mit Strings:</h6>
                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
$farbe = "rot";

switch ($farbe) {
    case "rot":
        echo "🔴 Gefahr!";
        break;
    case "grün":
        echo "🟢 Sicher!";
        break;
    case "gelb":
        echo "🟡 Vorsicht!";
        break;
}
?&gt;</code></pre>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <h6>Mit Numbers:</h6>
                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
$fehler_code = 404;

switch ($fehler_code) {
    case 200:
        echo "✅ Erfolgreich";
        break;
    case 404:
        echo "❌ Nicht gefunden";
        break;
    case 500:
        echo "💥 Server-Fehler";
        break;
}
?&gt;</code></pre>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <h6>Mit Boolean:</h6>
                                        <div class="card bg-dark text-light">
                                            <div class="card-body">
                                                <pre class="mb-0"><code class="language-php text-light">&lt;?php
$ist_premium = true;

switch ($ist_premium) {
    case true:
        echo "🌟 Premium-User";
        break;
    case false:
        echo "👤 Standard-User";
        break;
}
?&gt;</code></pre>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <h3>💡 Switch vs. If-Else - Wann was verwenden?</h3>
                        
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="card border-success">
                                    <div class="card-header bg-success text-white">
                                        <h6 class="mb-0">✅ Switch verwenden wenn:</h6>
                                    </div>
                                    <div class="card-body">
                                        <ul class="mb-0">
                                            <li><strong>Exakte Werte</strong> verglichen werden</li>
                                            <li><strong>Viele Möglichkeiten</strong> (> 3-4 Cases)</li>
                                            <li><strong>Eine Variable</strong> mit verschiedenen Werten</li>
                                            <li><strong>Menüs, Status</strong> oder <strong>Kategorien</strong></li>
                                            <li><strong>Übersichtlichkeit</strong> wichtig ist</li>
                                        </ul>
                                        
                                        <div class="mt-2">
                                            <strong>Beispiele:</strong>
                                            <small class="d-block">Wochentage, Monate, Status-Codes, Benutzerrollen, Produktkategorien</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card border-warning">
                                    <div class="card-header bg-warning">
                                        <h6 class="mb-0">⚠️ If-Else besser wenn:</h6>
                                    </div>
                                    <div class="card-body">
                                        <ul class="mb-0">
                                            <li><strong>Bereiche verglichen</strong> werden (&gt;, &lt;, &gt;=, &lt;=)</li>
                                            <li><strong>Komplexe Bedingungen</strong> (&amp;&amp;, ||)</li>
                                            <li><strong>Verschiedene Variablen</strong> verglichen werden</li>
                                            <li><strong>Wenige Bedingungen</strong> (1-3)</li>
                                            <li><strong>Boolean-Logik</strong> wichtig ist</li>
                                        </ul>
                                        
                                        <div class="mt-2">
                                            <strong>Beispiele:</strong>
                                            <small class="d-block">Alter prüfen, Bereiche (0-100), Login-Validierung, komplexe Geschäftslogik</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="alert alert-success">
                            <h5><i class="bi bi-list me-2"></i>Switch - Die wichtigsten Punkte</h5>
                            <ul class="mb-0">
                                <li>✅ <strong>Switch</strong> für viele exakte Werte einer Variable</li>
                                <li>✅ <strong>break;</strong> nach jedem Case nicht vergessen!</li>
                                <li>✅ <strong>default:</strong> als Fallback für unbekannte Werte</li>
                                <li>✅ <strong>Fall-Through</strong> gezielt für mehrere Cases nutzen</li>
                                <li>✅ <strong>Übersichtlicher</strong> als lange ElseIf-Ketten</li>
                                <li>✅ Funktioniert mit <strong>Strings, Numbers, Boolean</strong></li>
                                <li>✅ Perfekt für <strong>Menüs, Status und Kategorien</strong></li>
                            </ul>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <h6>Vorheriges Thema</h6>
                                        <a href="php-if-else.php" class="btn btn-outline-secondary">
                                            <i class="bi bi-arrow-left me-2"></i>If/Else
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <h6>Nächstes Thema</h6>
                                        <a href="php-loops.php" class="btn btn-primary">
                                            <i class="bi bi-arrow-repeat me-2"></i>Schleifen
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