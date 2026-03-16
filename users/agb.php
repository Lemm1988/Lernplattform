<?php
// Keine Leerzeichen oder Zeilenumbrüche vor diesem Tag!

// Zuerst Konfiguration und Session-Settings laden
require_once '../config.php';

// Content-Type Header für UTF-8
header('Content-Type: text/html; charset=UTF-8');

// Seitentitel für Header
$page_title = 'AGB';

// Header einbinden (stellt sicher, dass <meta charset="UTF-8"> im <head> steht)
include '../includes/header.php';
?>
<div class="layout-container">
    <?php include '../includes/sidebar.php'; ?>
    <div class="main-wrapper">
        <main class="main-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-4 col-lg-3">
                    </div>
                    <div class="col-md-8 col-lg-9">
                        <div class="container py-5">
                            <h1 class="mb-4"><i class="bi bi-file-earmark-text me-2"></i>Allgemeine Geschäftsbedingungen
                                (AGB)</h1>
                            <!-- Accordion START -->
                            <div class="accordion" id="agbAccordion">

                                <!-- 1 Geltungsbereich -->
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingScope">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapseScope" aria-expanded="true"
                                            aria-controls="collapseScope">
                                            <i class="bi bi-globe2 me-2"></i> Geltungsbereich
                                        </button>
                                    </h2>
                                    <div id="collapseScope" class="accordion-collapse collapse show"
                                        aria-labelledby="headingScope" data-bs-parent="#agbAccordion">
                                        <div class="accordion-body">
                                            <pre
                                                style="white-space: pre-wrap; background: none; border: none; font-family: inherit;">
Diese Allgemeinen Geschäftsbedingungen (AGB) gelten für die Nutzung der Fachinformatiker Lernplattform unter der Domain YourDomain und aller zugehörigen Dienste, Inhalte und Angebote.

Die Plattform richtet sich an Auszubildende, Studenten und Fachkräfte im Bereich Informatik, die sich auf die Abschlussprüfung zum Fachinformatiker vorbereiten möchten.

Mit der Nutzung der Plattform erkennen Sie diese AGB in ihrer jeweils gültigen Fassung an.
</pre>
                                        </div>
                                    </div>
                                </div>

                                <!-- 2 Vertragspartner & Registrierung -->
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingRegistration">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseRegistration"
                                            aria-expanded="false" aria-controls="collapseRegistration">
                                            <i class="bi bi-person-badge me-2"></i> Vertragspartner & Registrierung
                                        </button>
                                    </h2>
                                    <div id="collapseRegistration" class="accordion-collapse collapse"
                                        aria-labelledby="headingRegistration" data-bs-parent="#agbAccordion">
                                        <div class="accordion-body">
                                            <pre
                                                style="white-space: pre-wrap; background: none; border: none; font-family: inherit;">
Vertragspartner ist:
Patrick Lemm
Freiburgerstraße 32a
79674 Todtnau
Deutschland

E-Mail: admin@YourDomain
Telefon: 7499666

Die Nutzung der Lernplattform setzt eine kostenlose Registrierung voraus. Die bei der Registrierung gemachten Angaben müssen wahrheitsgemäß und vollständig sein. Eine E-Mail-Verifizierung ist erforderlich.

</pre>
                                        </div>
                                    </div>
                                </div>

                                <!-- 3 Leistungen der Plattform -->
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingServices">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseServices"
                                            aria-expanded="false" aria-controls="collapseServices">
                                            <i class="bi bi-layers me-2"></i> Leistungen der Plattform
                                        </button>
                                    </h2>
                                    <div id="collapseServices" class="accordion-collapse collapse"
                                        aria-labelledby="headingServices" data-bs-parent="#agbAccordion">
                                        <div class="accordion-body">
                                            <pre
                                                style="white-space: pre-wrap; background: none; border: none; font-family: inherit;">
Die Fachinformatiker Lernplattform bietet folgende kostenlose Dienstleistungen:

• Interaktive Lernmodule für Programmiersprachen (Java, PHP, Python, C/C++)
• Quiz-System mit Single-Choice und Multiple-Choice-Fragen
• Prüfungsvorbereitung für die IHK-Abschlussprüfung
• Community-Features (Fragen stellen, Diskussionen)
• News-System mit aktuellen IT-Informationen
• Benutzerprofil und Fortschrittsverfolgung
• 2FA-Sicherheit für Benutzerkonten

Alle Dienstleistungen werden kostenlos angeboten. Ein Anspruch auf ständige Verfügbarkeit der Plattform oder einzelner Funktionen besteht nicht. Änderungen oder Erweiterungen des Angebots sind jederzeit möglich.

Die Plattform dient ausschließlich der Aus- und Weiterbildung und ersetzt nicht die offizielle IHK-Prüfungsvorbereitung.
</pre>
                                        </div>
                                    </div>
                                </div>

                                <!-- 4 Nutzungsrechte & Urheberrecht -->
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingCopyright">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseCopyright"
                                            aria-expanded="false" aria-controls="collapseCopyright">
                                            <i class="bi bi-c-circle me-2"></i> Nutzungsrechte & Urheberrecht
                                        </button>
                                    </h2>
                                    <div id="collapseCopyright" class="accordion-collapse collapse"
                                        aria-labelledby="headingCopyright" data-bs-parent="#agbAccordion">
                                        <div class="accordion-body">
                                            <pre
                                                style="white-space: pre-wrap; background: none; border: none; font-family: inherit;">
Alle Inhalte der Fachinformatiker Lernplattform unterliegen dem Urheberrecht:

• Lernmodule, Quiz-Fragen und -Antworten
• Programmcode-Beispiele und Erklärungen
• Grafiken, Diagramme und Schaubilder
• Texte, Tutorials und Anleitungen
• Website-Design und -Struktur
• Datenbankinhalte und -strukturen

Jegliche Vervielfältigung, Verbreitung, Veröffentlichung, Bearbeitung, Übersetzung, Speicherung oder sonstige Nutzung – auch auszugsweise – ist ohne ausdrückliche schriftliche Genehmigung des Rechteinhabers strengstens untersagt.

Das Kopieren, Nachahmen, Scrapen oder automatisierte Auslesen der Inhalte ist ausdrücklich verboten. Zuwiderhandlungen werden zivil- und strafrechtlich verfolgt.

Ausnahme: Das Zitieren einzelner Code-Beispiele für Lernzwecke ist in angemessenem Umfang gestattet, sofern die Quelle angegeben wird.
</pre>
                                        </div>
                                    </div>
                                </div>

                                <!-- 5 Pflichten der Nutzer -->
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingDuties">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseDuties"
                                            aria-expanded="false" aria-controls="collapseDuties">
                                            <i class="bi bi-person-check me-2"></i> Pflichten der Nutzer
                                        </button>
                                    </h2>
                                    <div id="collapseDuties" class="accordion-collapse collapse"
                                        aria-labelledby="headingDuties" data-bs-parent="#agbAccordion">
                                        <div class="accordion-body">
                                            <pre
                                                style="white-space: pre-wrap; background: none; border: none; font-family: inherit;">
Nutzer verpflichten sich:

• Keine rechtswidrigen, beleidigenden, rassistischen oder anderweitig schädlichen Inhalte einzustellen
• Zugangsdaten vertraulich zu behandeln und nicht an Dritte weiterzugeben
• Keine Spam-Nachrichten oder Werbung zu versenden
• Keine Hacking-Versuche oder Angriffe auf die Plattform zu unternehmen
• Keine Inhalte zu verbreiten, die Urheberrechte Dritter verletzen
• Bei Fragen und Diskussionen sachlich und respektvoll zu bleiben
• Keine falschen oder irreführenden Informationen zu verbreiten
• Die Plattform nur für legale Lernzwecke zu nutzen

Bei Verstößen behält sich der Betreiber das Recht vor, Benutzerkonten zu sperren oder zu löschen.
</pre>
                                        </div>
                                    </div>
                                </div>

                                <!-- 6 Haftung & Gewährleistung -->
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingLiability">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseLiability"
                                            aria-expanded="false" aria-controls="collapseLiability">
                                            <i class="bi bi-shield-exclamation me-2"></i> Haftung & Gewährleistung
                                        </button>
                                    </h2>
                                    <div id="collapseLiability" class="accordion-collapse collapse"
                                        aria-labelledby="headingLiability" data-bs-parent="#agbAccordion">
                                        <div class="accordion-body">
                                            <pre
                                                style="white-space: pre-wrap; background: none; border: none; font-family: inherit;">
Die Nutzung der Lernplattform erfolgt auf eigene Gefahr. Für die Richtigkeit, Vollständigkeit und Aktualität der Inhalte wird keine Gewähr übernommen.

Wichtige Haftungsausschlüsse:
• Keine Gewähr für Prüfungserfolg oder Lernfortschritt
• Keine Haftung für technische Ausfälle oder Datenverluste
• Keine Gewähr für Aktualität der Quiz-Fragen bezüglich IHK-Prüfungen
• Keine Haftung für Schäden durch Drittanbieter-Software (Bootstrap, Icons)

Eine Haftung für Schäden, die aus der Nutzung entstehen, ist – außer bei Vorsatz oder grober Fahrlässigkeit – ausgeschlossen.

Die Plattform ersetzt nicht die offizielle IHK-Prüfungsvorbereitung oder professionelle Ausbildungsberatung.
</pre>
                                        </div>
                                    </div>
                                </div>

                                <!-- 7 Datenschutz -->
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingPrivacy">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapsePrivacy"
                                            aria-expanded="false" aria-controls="collapsePrivacy">
                                            <i class="bi bi-shield-lock me-2"></i> Datenschutz
                                        </button>
                                    </h2>
                                    <div id="collapsePrivacy" class="accordion-collapse collapse"
                                        aria-labelledby="headingPrivacy" data-bs-parent="#agbAccordion">
                                        <div class="accordion-body">
                                            <pre
                                                style="white-space: pre-wrap; background: none; border: none; font-family: inherit;">
Es gilt die jeweils aktuelle Datenschutzerklärung, einsehbar unter "Datenschutz".

Die Lernplattform erfasst folgende personenbezogene Daten:
• Registrierungsdaten (E-Mail, Name, Passwort)
• Quiz-Ergebnisse und Lernfortschritt
• IP-Adressen und technische Daten
• Login-Historie (IP-Adresse, Browser-Informationen)
• Kommunikationsdaten (Fragen, Nachrichten)

Alle Daten werden gemäß DSGVO verarbeitet und nicht an Dritte weitergegeben. Nutzer haben jederzeit das Recht auf Auskunft, Berichtigung, Löschung und Datenübertragbarkeit.

Weitere Details finden Sie in der separaten Datenschutzerklärung.
</pre>
                                        </div>
                                    </div>
                                </div>

                                <!-- 8 Quiz-System & Bewertung -->
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingQuiz">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseQuiz"
                                            aria-expanded="false" aria-controls="collapseQuiz">
                                            <i class="bi bi-question-square me-2"></i> Quiz-System & Bewertung
                                        </button>
                                    </h2>
                                    <div id="collapseQuiz" class="accordion-collapse collapse"
                                        aria-labelledby="headingQuiz" data-bs-parent="#agbAccordion">
                                        <div class="accordion-body">
                                            <pre
                                                style="white-space: pre-wrap; background: none; border: none; font-family: inherit;">
Das Quiz-System dient ausschließlich der Lernkontrolle und Prüfungsvorbereitung:

• Quiz-Ergebnisse dienen nur der Selbsteinschätzung
• Keine Gewähr für Prüfungserfolg bei der IHK-Prüfung
• Quiz-Fragen können jederzeit geändert oder entfernt werden
• Bewertungssystem: Single-Choice und Multiple-Choice-Fragen
• Bestehensgrenze: 60% (kann sich ändern)
• Zeitlimit: 2 Stunden pro Quiz (kann sich ändern)

Die Quiz-Ergebnisse werden gespeichert und können vom Nutzer eingesehen werden. Eine Weitergabe der Ergebnisse an Dritte erfolgt nicht.

Das Quiz-System ersetzt nicht die offizielle IHK-Prüfungsvorbereitung.
</pre>
                                        </div>
                                    </div>
                                </div>

                                <!-- 9 Nutzergenerierte Inhalte -->
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingUserContent">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseUserContent"
                                            aria-expanded="false" aria-controls="collapseUserContent">
                                            <i class="bi bi-chat-text me-2"></i> Nutzergenerierte Inhalte
                                        </button>
                                    </h2>
                                    <div id="collapseUserContent" class="accordion-collapse collapse"
                                        aria-labelledby="headingUserContent" data-bs-parent="#agbAccordion">
                                        <div class="accordion-body">
                                            <pre
                                                style="white-space: pre-wrap; background: none; border: none; font-family: inherit;">
Nutzer können folgende Inhalte erstellen:
• Fragen über das Kontaktformular
• Diskussionsbeiträge in der Community
• Feedback und Verbesserungsvorschläge

Rechte an nutzergenerierten Inhalten:
• Der Nutzer behält die Rechte an seinen Inhalten
• Durch das Einstellen räumt der Nutzer dem Betreiber ein einfaches Nutzungsrecht ein
• Der Betreiber kann die Inhalte für die Plattform verwenden und moderieren
• Beleidigende oder rechtswidrige Inhalte werden entfernt

Der Betreiber übernimmt keine Verantwortung für nutzergenerierte Inhalte und behält sich das Recht vor, diese zu moderieren oder zu entfernen.
</pre>
                                        </div>
                                    </div>
                                </div>

                                <!-- 10 Änderungen der AGB -->
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingChanges">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseChanges"
                                            aria-expanded="false" aria-controls="collapseChanges">
                                            <i class="bi bi-arrow-repeat me-2"></i> Änderungen der AGB
                                        </button>
                                    </h2>
                                    <div id="collapseChanges" class="accordion-collapse collapse"
                                        aria-labelledby="headingChanges" data-bs-parent="#agbAccordion">
                                        <div class="accordion-body">
                                            <pre
                                                style="white-space: pre-wrap; background: none; border: none; font-family: inherit;">
Der Betreiber behält sich vor, diese AGB jederzeit zu ändern. Nutzer werden über wesentliche Änderungen rechtzeitig informiert. Die weitere Nutzung gilt als Zustimmung zu den neuen Bedingungen.
</pre>
                                        </div>
                                    </div>
                                </div>

                                <!-- 11 Schlussbestimmungen -->
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingFinal">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseFinal"
                                            aria-expanded="false" aria-controls="collapseFinal">
                                            <i class="bi bi-flag me-2"></i> Schlussbestimmungen
                                        </button>
                                    </h2>
                                    <div id="collapseFinal" class="accordion-collapse collapse"
                                        aria-labelledby="headingFinal" data-bs-parent="#agbAccordion">
                                        <div class="accordion-body">
                                            <pre
                                                style="white-space: pre-wrap; background: none; border: none; font-family: inherit;">
Sollten einzelne Bestimmungen dieser AGB unwirksam sein oder werden, bleibt die Wirksamkeit der übrigen Bestimmungen unberührt. Es gilt ausschließlich das Recht der Bundesrepublik Deutschland. Gerichtsstand ist, soweit gesetzlich zulässig, der Sitz des Betreibers.
</pre>
                                        </div>
                                    </div>
                                </div>

                                <!-- 12 Urheberrechtsvermerk -->
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingCopyrightNotice">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseCopyrightNotice"
                                            aria-expanded="false" aria-controls="collapseCopyrightNotice">
                                            <i class="bi bi-c-circle me-2"></i> Urheberrechtsvermerk & Kopierschutz
                                        </button>
                                    </h2>
                                    <div id="collapseCopyrightNotice" class="accordion-collapse collapse"
                                        aria-labelledby="headingCopyrightNotice" data-bs-parent="#agbAccordion">
                                        <div class="accordion-body">
                                            <pre
                                                style="white-space: pre-wrap; background: none; border: none; font-family: inherit;">
Alle Rechte an der Website, den Inhalten, dem Design und dem Quelltext liegen ausschließlich beim Betreiber von YourDomain. Jegliche – auch auszugsweise – Vervielfältigung, Verbreitung, öffentliche Wiedergabe, Bearbeitung oder sonstige Nutzung ist ohne ausdrückliche schriftliche Genehmigung strengstens untersagt.

Das Kopieren, Scrapen oder automatisierte Auslesen der Seite oder einzelner Inhalte ist ausdrücklich verboten und wird rechtlich verfolgt. Zuwiderhandlungen werden sowohl zivil- als auch strafrechtlich geahndet.
</pre>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <!-- Accordion END -->
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
<?php
// Footer nur einmal einbinden, keine Leerzeichen nach diesem Tag!
include '../includes/footer.php';
