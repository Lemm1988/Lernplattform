<?php
require_once '../config.php';
$page_title = 'Hilfe & FAQ';
include '../includes/header.php';
?>
<div class="layout-container">
    <?php include '../includes/sidebar.php'; ?>
    <div class="main-wrapper">
        <main class="main-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-4 col-lg-3"></div>
                    <div class="col-md-8 col-lg-9">
                        <div class="container py-5">
                            <h1 class="mb-4"><i class="bi bi-question-circle me-2"></i>Hilfe & FAQ</h1>
                            
                            <div class="alert alert-info mb-4">
                                <h5><i class="bi bi-info-circle me-2"></i>Willkommen auf der Fachinformatiker Lernplattform!</h5>
                                <p class="mb-0">Diese Plattform bietet Ihnen umfassende Lernmaterialien für die Abschlussprüfung zum Fachinformatiker. Hier finden Sie Antworten auf die häufigsten Fragen.</p>
                            </div>
                            
                            <div class="accordion" id="faqAccordion">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingStart">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapseStart" aria-expanded="true"
                                            aria-controls="collapseStart">
                                            🚀 Erste Schritte
                                        </button>
                                    </h2>
                                    <div id="collapseStart" class="accordion-collapse collapse show"
                                        aria-labelledby="headingStart" data-bs-parent="#faqAccordion">
                                        <div class="accordion-body">
                                            <h5>Wie erstelle ich ein Benutzerkonto?</h5>
                                            <p>Klicken Sie auf "Registrieren" in der oberen rechten Ecke der Website. Füllen Sie das Anmeldeformular aus:</p>
                                            <ul>
                                                <li><strong>E-Mail-Adresse</strong> (dient als Ihr Benutzername)</li>
                                                <li><strong>Sicheres Passwort</strong> (mindestens 8 Zeichen mit Groß-/Kleinbuchstaben, Zahlen und Sonderzeichen)</li>
                                                <li><strong>Vor- und Nachname</strong></li>
                                            </ul>
                                            <p>Bestätigen Sie Ihre E-Mail-Adresse über den Link, den Sie per E-Mail erhalten.</p>

                                            <h5>Wie logge ich mich ein?</h5>
                                            <p>Klicken Sie auf "Anmelden" in der oberen rechten Ecke und geben Sie Ihre E-Mail-Adresse und Ihr Passwort ein.</p>

                                            <h5>Wie navigiere ich durch die Website?</h5>
                                            <p>Die Website ist in folgende Hauptbereiche unterteilt:</p>
                                            <ul>
                                                <li><strong>Startseite</strong> - Dashboard mit Übersicht</li>
                                                <li><strong>Programmierung</strong> - Lernmaterialien für Java, PHP, Python, C/C++</li>
                                                <li><strong>Quiz</strong> - Tests und Übungen</li>
                                                <li><strong>News</strong> - Aktuelle Nachrichten und Updates</li>
                                                <li><strong>Profil</strong> - Persönliche Einstellungen</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingProgramming">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseProgramming"
                                            aria-expanded="false" aria-controls="collapseProgramming">
                                            💻 Programmiersprachen lernen
                                        </button>
                                    </h2>
                                    <div id="collapseProgramming" class="accordion-collapse collapse"
                                        aria-labelledby="headingProgramming" data-bs-parent="#faqAccordion">
                                        <div class="accordion-body">
                                            <h5>Welche Programmiersprachen kann ich lernen?</h5>
                                            <p>Die Plattform bietet umfassende Lernmaterialien für:</p>
                                            
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <h6><i class="bi bi-cup-hot me-2"></i>Java</h6>
                                                    <ul>
                                                        <li>Grundlagen und Syntax</li>
                                                        <li>Objektorientierte Programmierung</li>
                                                        <li>Arrays und Collections</li>
                                                        <li>Lambda-Ausdrücke und Streams</li>
                                                        <li>Exception Handling</li>
                                                        <li>Generics und Interfaces</li>
                                                    </ul>
                                                </div>
                                                <div class="col-md-6">
                                                    <h6><i class="bi bi-code-slash me-2"></i>PHP</h6>
                                                    <ul>
                                                        <li>Grundlagen und Syntax</li>
                                                        <li>Variablen und Datentypen</li>
                                                        <li>Funktionen und OOP</li>
                                                        <li>Datenbankanbindung</li>
                                                        <li>Formulare und Sicherheit</li>
                                                        <li>Dateien und Sessions</li>
                                                    </ul>
                                                </div>
                                            </div>
                                            
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <h6><i class="bi bi-python me-2"></i>Python</h6>
                                                    <ul>
                                                        <li>Grundlagen und Syntax</li>
                                                        <li>Datentypen und Listen</li>
                                                        <li>Funktionen und Klassen</li>
                                                        <li>Module und Bibliotheken</li>
                                                        <li>Debugging und Testing</li>
                                                        <li>Projekte und Anwendungen</li>
                                                    </ul>
                                                </div>
                                                <div class="col-md-6">
                                                    <h6><i class="bi bi-terminal me-2"></i>C/C++</h6>
                                                    <ul>
                                                        <li>C-Grundlagen</li>
                                                        <li>C++ Objektorientierung</li>
                                                        <li>Pointer und Speicherverwaltung</li>
                                                        <li>Algorithmen und Datenstrukturen</li>
                                                    </ul>
                                                </div>
                                            </div>

                                            <h5>Wie strukturiere ich mein Lernen?</h5>
                                            <p>Jede Programmiersprache ist in logische Module unterteilt:</p>
                                            <ol>
                                                <li><strong>Einführung</strong> - Grundkonzepte und Installation</li>
                                                <li><strong>Syntax</strong> - Sprachelemente und Regeln</li>
                                                <li><strong>Datentypen</strong> - Variablen und Datenstrukturen</li>
                                                <li><strong>Kontrollstrukturen</strong> - Schleifen und Bedingungen</li>
                                                <li><strong>Funktionen/Methoden</strong> - Code-Organisation</li>
                                                <li><strong>Objektorientierung</strong> - Klassen und Objekte</li>
                                                <li><strong>Erweiterte Themen</strong> - Spezielle Features</li>
                                            </ol>
                                        </div>
                                    </div>
                                </div>

                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingQuiz">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseQuiz"
                                            aria-expanded="false" aria-controls="collapseQuiz">
                                            🧠 Quiz-System
                                        </button>
                                    </h2>
                                    <div id="collapseQuiz" class="accordion-collapse collapse"
                                        aria-labelledby="headingQuiz" data-bs-parent="#faqAccordion">
                                        <div class="accordion-body">
                                            <div class="alert alert-info mb-3">
                                                <strong>Neu!</strong> Unser Quiz-System unterstützt sowohl Single-Choice als auch Multiple-Choice-Fragen. 
                                                <a href="hilfe_multiple_choice.php" class="alert-link">Hier erfahren Sie mehr über die verschiedenen Fragetypen</a>.
                                            </div>

                                            <h5>Wie starte ich ein Quiz?</h5>
                                            <ol>
                                                <li>Gehen Sie auf "Quiz" im Hauptmenü</li>
                                                <li>Wählen Sie eine Kategorie aus</li>
                                                <li>Klicken Sie auf "Quiz starten"</li>
                                                <li>Beantworten Sie die Fragen</li>
                                                <li>Sehen Sie sich Ihr Ergebnis an</li>
                                            </ol>

                                            <h5>Welche Fragetypen gibt es?</h5>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <h6>Single-Choice-Fragen (○)</h6>
                                                    <ul>
                                                        <li>Runde Auswahlfelder (Radiobuttons)</li>
                                                        <li>Nur eine Antwort kann ausgewählt werden</li>
                                                        <li>Traditioneller Fragetyp</li>
                                                    </ul>
                                                </div>
                                                <div class="col-md-6">
                                                    <h6>Multiple-Choice-Fragen (☐)</h6>
                                                    <ul>
                                                        <li>Eckige Auswahlfelder (Checkboxen)</li>
                                                        <li>Mehrere Antworten können ausgewählt werden</li>
                                                        <li>Für komplexere Fragen geeignet</li>
                                                    </ul>
                                                </div>
                                            </div>

                                            <h5>Wie funktioniert die Bewertung?</h5>
                                            <ul>
                                                <li><strong>Punkte pro richtiger Antwort</strong></li>
                                                <li><strong>Endnote in Prozent</strong></li>
                                                <li><strong>Detaillierte Auswertung</strong> mit Erklärungen</li>
                                                <li><strong>Fortschrittsverfolgung</strong> über mehrere Quizzes</li>
                                            </ul>

                                            <h5>Kann ich ein Quiz wiederholen?</h5>
                                            <p>Ja, Sie können jedes Quiz beliebig oft wiederholen. Ihre beste Punktzahl wird gespeichert und Sie können Ihren Fortschritt verfolgen.</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingNews">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseNews"
                                            aria-expanded="false" aria-controls="collapseNews">
                                            📰 News-System
                                        </button>
                                    </h2>
                                    <div id="collapseNews" class="accordion-collapse collapse"
                                        aria-labelledby="headingNews" data-bs-parent="#faqAccordion">
                                        <div class="accordion-body">
                                            <h5>Was ist das News-System?</h5>
                                            <p>Das News-System bietet aktuelle Informationen, Updates und Lernmaterialien rund um die Fachinformatiker-Ausbildung.</p>

                                            <h5>Welche Inhalte finde ich in den News?</h5>
                                            <ul>
                                                <li><strong>Plattform-Updates</strong> - Neue Features und Verbesserungen</li>
                                                <li><strong>Lernmaterialien</strong> - Zusätzliche Ressourcen und Tipps</li>
                                                <li><strong>Prüfungsinformationen</strong> - Aktuelle Hinweise zur IHK-Prüfung</li>
                                                <li><strong>Community-News</strong> - Erfolgsgeschichten und Erfahrungen</li>
                                            </ul>

                                            <h5>Wie kann ich News durchsuchen?</h5>
                                            <p>Nutzen Sie die Suchfunktion oder filtern Sie nach:</p>
                                            <ul>
                                                <li><strong>Kategorien</strong> - Themenbereiche wie "Programmierung", "Prüfung", "Tipps"</li>
                                                <li><strong>Tags</strong> - Schlagwörter für spezifische Themen</li>
                                                <li><strong>Datum</strong> - Chronologische Sortierung</li>
                                            </ul>

                                            <h5>Kann ich News kommentieren?</h5>
                                            <p>Ja, registrierte Benutzer können News kommentieren und sich mit anderen Lernenden austauschen.</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingProfil">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseProfil"
                                            aria-expanded="false" aria-controls="collapseProfil">
                                            👤 Profil und Einstellungen
                                        </button>
                                    </h2>
                                    <div id="collapseProfil" class="accordion-collapse collapse"
                                        aria-labelledby="headingProfil" data-bs-parent="#faqAccordion">
                                        <div class="accordion-body">
                                            <h5>Wie kann ich mein Profil bearbeiten?</h5>
                                            <ol>
                                                <li>Klicken Sie auf Ihr Profilbild oder "Profil"</li>
                                                <li>Wählen Sie "Profil bearbeiten"</li>
                                                <li>Ändern Sie Ihre persönlichen Informationen</li>
                                                <li>Speichern Sie die Änderungen</li>
                                            </ol>

                                            <h5>Wie ändere ich mein Passwort?</h5>
                                            <ol>
                                                <li>Gehen Sie zu "Profil" > "Sicherheitseinstellungen"</li>
                                                <li>Geben Sie Ihr aktuelles Passwort ein</li>
                                                <li>Geben Sie Ihr neues Passwort zweimal ein</li>
                                                <li>Klicken Sie auf "Passwort speichern"</li>
                                            </ol>

                                            <h5>Was ist 2FA (Zwei-Faktor-Authentifizierung)?</h5>
                                            <p>2FA erhöht die Sicherheit Ihres Kontos durch eine zusätzliche Authentifizierung:</p>
                                            <ul>
                                                <li><strong>Einrichtung</strong> - Scannen Sie einen QR-Code mit einer Authenticator-App</li>
                                                <li><strong>Anmeldung</strong> - Geben Sie zusätzlich zum Passwort einen 6-stelligen Code ein</li>
                                                <li><strong>Empfohlene Apps</strong> - Google Authenticator, Microsoft Authenticator, Authy</li>
                                            </ul>

                                            <h5>Wo sehe ich meinen Lernfortschritt?</h5>
                                            <p>In Ihrem Dashboard finden Sie:</p>
                                            <ul>
                                                <li>Übersicht abgeschlossener Module</li>
                                                <li>Quiz-Ergebnisse und Statistiken</li>
                                                <li>Lernzeit und Fortschrittsbalken</li>
                                                <li>Empfehlungen für weitere Themen</li>
                                                <li>Login-Historie mit IP-Adresse und Browser-Info</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingTech">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseTech"
                                            aria-expanded="false" aria-controls="collapseTech">
                                            🔧 Technische Probleme
                                        </button>
                                    </h2>
                                    <div id="collapseTech" class="accordion-collapse collapse"
                                        aria-labelledby="headingTech" data-bs-parent="#faqAccordion">
                                        <div class="accordion-body">
                                            <h5>Die Website lädt nicht richtig - was kann ich tun?</h5>
                                            <ol>
                                                <li>Überprüfen Sie Ihre Internetverbindung</li>
                                                <li>Aktualisieren Sie die Seite (F5 oder Ctrl+R)</li>
                                                <li>Leeren Sie Ihren Browser-Cache und Cookies</li>
                                                <li>Deaktivieren Sie Adblocker temporär</li>
                                                <li>Versuchen Sie einen anderen Browser</li>
                                                <li>Kontaktieren Sie den Support bei anhaltenden Problemen</li>
                                            </ol>

                                            <h5>Ich kann mich nicht einloggen - was tun?</h5>
                                            <ol>
                                                <li>Überprüfen Sie E-Mail-Adresse und Passwort</li>
                                                <li>Achten Sie auf Groß-/Kleinschreibung</li>
                                                <li>Nutzen Sie "Passwort vergessen" falls nötig</li>
                                                <li>Leeren Sie Browser-Cache und Cookies</li>
                                                <li>Versuchen Sie den privaten/inkognito Modus</li>
                                            </ol>

                                            <h5>Probleme mit dem Rich-Text-Editor</h5>
                                            <p>Falls der Editor nicht lädt:</p>
                                            <ul>
                                                <li>Deaktivieren Sie Adblocker temporär</li>
                                                <li>Erlauben Sie JavaScript</li>
                                                <li>Laden Sie die Seite neu</li>
                                                <li>Nutzen Sie den einfachen Editor als Alternative</li>
                                            </ul>

                                            <h5>Browser-Kompatibilität</h5>
                                            <p>Unterstützte Browser (neueste Versionen):</p>
                                            <ul>
                                                <li>Google Chrome (empfohlen)</li>
                                                <li>Mozilla Firefox</li>
                                                <li>Safari (Mac/iOS)</li>
                                                <li>Microsoft Edge</li>
                                                <li>Opera</li>
                                            </ul>
                                            <p><strong>Hinweis:</strong> Ältere Browser (Internet Explorer) werden nicht mehr unterstützt.</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingSupport">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseSupport"
                                            aria-expanded="false" aria-controls="collapseSupport">
                                            💬 Support und Kontakt
                                        </button>
                                    </h2>
                                    <div id="collapseSupport" class="accordion-collapse collapse"
                                        aria-labelledby="headingSupport" data-bs-parent="#faqAccordion">
                                        <div class="accordion-body">
                                            <h5>Wie kann ich den Support kontaktieren?</h5>
                                            <p>Nutzen Sie das <a href="kontakt.php" class="btn btn-outline-primary btn-sm">Kontaktformular</a> für:</p>
                                            <ul>
                                                <li>Technische Probleme</li>
                                                <li>Fragen zu Inhalten</li>
                                                <li>Feedback und Verbesserungsvorschläge</li>
                                                <li>Allgemeine Anfragen</li>
                                            </ul>

                                            <h5>Wie schnell erhalte ich eine Antwort?</h5>
                                            <ul>
                                                <li><strong>E-Mail-Support:</strong> innerhalb von 24-48 Stunden (Werktage)</li>
                                                <li><strong>Kontaktformular:</strong> innerhalb von 24 Stunden</li>
                                                <li><strong>Dringende technische Probleme:</strong> priorisierte Bearbeitung</li>
                                            </ul>

                                            <h5>Weitere Hilfe</h5>
                                            <p>Zusätzliche Ressourcen:</p>
                                            <ul>
                                                <li><a href="hilfe_multiple_choice.php">Multiple-Choice-Hilfe</a></li>
                                                <li><a href="impressum.php">Impressum</a></li>
                                                <li><a href="datenschutz.php">Datenschutzerklärung</a></li>
                                                <li><a href="agb.php">Allgemeine Geschäftsbedingungen</a></li>
                                            </ul>

                                            <div class="alert alert-warning mt-3">
                                                <strong>Hinweis:</strong> Bei technischen Problemen beschreiben Sie bitte das Problem so detailliert wie möglich und geben Sie Ihren Browser und die Version an.
                                            </div>
                                        </div>
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
<?php include '../includes/footer.php'; ?>
