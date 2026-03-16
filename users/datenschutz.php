<?php
require_once '../config.php';
$page_title = 'Datenschutz';
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
                            <h1 class="mb-4"><i class="bi bi-shield-lock me-2"></i>Datenschutzerklärung</h1>

                            <!-- Accordion START -->
                            <div class="accordion" id="privacyAccordion">

                                <!-- 1 Allgemeine Hinweise -->
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingGeneral">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapseGeneral" aria-expanded="true"
                                            aria-controls="collapseGeneral">
                                            🛈 Allgemeine Hinweise
                                        </button>
                                    </h2>
                                    <div id="collapseGeneral" class="accordion-collapse collapse show"
                                        aria-labelledby="headingGeneral" data-bs-parent="#privacyAccordion">
                                        <div class="accordion-body">
                                            <pre
                                                style="white-space: pre-wrap; background: none; border: none; font-family: inherit;">
Der Schutz Ihrer personenbezogenen Daten hat höchste Priorität. Nachfolgend informieren wir Sie gem. Art. 12 ff. DSGVO umfassend darüber,
welche Daten wir erfassen, zu welchem Zweck dies geschieht und welche Rechte Sie als betroffene Person haben.
</pre>
                                        </div>
                                    </div>
                                </div>

                                <!-- 2 Verantwortlicher -->
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingController">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseController"
                                            aria-expanded="false" aria-controls="collapseController">
                                            👤 Verantwortlicher
                                        </button>
                                    </h2>
                                    <div id="collapseController" class="accordion-collapse collapse"
                                        aria-labelledby="headingController" data-bs-parent="#privacyAccordion">
                                        <div class="accordion-body">
                                            <pre
                                                style="white-space: pre-wrap; background: none; border: none; font-family: inherit;">
Verantwortlicher für die Datenverarbeitung:

MaxMuster
Musterstraße 123
12345 Musterstadt
Deutschland

E-Mail: admin@YourDomain
Telefon: 000-000-000

Verantwortlich i. S. d. Art. 4 Nr. 7 DSGVO ist der oben genannte Betreiber der Fachinformatiker Lernplattform.
</pre>
                                        </div>
                                    </div>
                                </div>

                                <!-- 3 Erhebung & Verarbeitung -->
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingProcessing">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseProcessing"
                                            aria-expanded="false" aria-controls="collapseProcessing">
                                            📑 Erhebung & Verarbeitung personenbezogener Daten
                                        </button>
                                    </h2>
                                    <div id="collapseProcessing" class="accordion-collapse collapse"
                                        aria-labelledby="headingProcessing" data-bs-parent="#privacyAccordion">
                                        <div class="accordion-body">
                                            <pre
                                                style="white-space: pre-wrap; background: none; border: none; font-family: inherit;">
Die Fachinformatiker Lernplattform erfasst folgende personenbezogene Daten:

• Registrierungsdaten: E-Mail, Benutzername, Passwort-Hash, Vor- und Nachname
  (Rechtsgrundlage: Art. 6 Abs. 1 lit. b DSGVO – Vertragserfüllung)

• Quiz-Ergebnisse und Lernfortschritt: Speicherung zur Bereitstellung personalisierter Inhalte
  (Rechtsgrundlage: Art. 6 Abs. 1 lit. b DSGVO – Vertragserfüllung)

• Kontaktnachrichten: Fragen, Feedback und Support-Anfragen
  (Rechtsgrundlage: Art. 6 Abs. 1 lit. f DSGVO – berechtigtes Interesse)

• Technische Daten: IP-Adresse, Browser-Informationen, Zugriffszeiten, Login-Historie
  (Rechtsgrundlage: Art. 6 Abs. 1 lit. f DSGVO – berechtigtes Interesse)

• 2FA-Daten: Sicherheitstoken für Zwei-Faktor-Authentifizierung
  (Rechtsgrundlage: Art. 6 Abs. 1 lit. f DSGVO – berechtigtes Interesse)

• Session-Daten: Login-Status, Präferenzen, temporäre Einstellungen
  (Rechtsgrundlage: Art. 6 Abs. 1 lit. b DSGVO – Vertragserfüllung)
</pre>
                                        </div>
                                    </div>
                                </div>

                                <!-- 4 Cookies & Tracking -->
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingCookies">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseCookies"
                                            aria-expanded="false" aria-controls="collapseCookies">
                                            🍪 Cookies & Analyse-Tools
                                        </button>
                                    </h2>
                                    <div id="collapseCookies" class="accordion-collapse collapse"
                                        aria-labelledby="headingCookies" data-bs-parent="#privacyAccordion">
                                        <div class="accordion-body">
                                            <pre
                                                style="white-space: pre-wrap; background: none; border: none; font-family: inherit;">
Die Fachinformatiker Lernplattform verwendet folgende Cookies:

Notwendige Cookies (Art. 6 Abs. 1 lit. f DSGVO):
• Session-Cookies für Login-Status und Sicherheit
• CSRF-Token für Schutz vor Angriffen
• Cookie-Banner-Einstellungen

Funktionale Cookies (Art. 6 Abs. 1 lit. b DSGVO):
• Benutzereinstellungen und Präferenzen
• Quiz-Fortschritt und temporäre Speicherung
• Sidebar-Zustand und UI-Einstellungen

Analyse-Cookies:
• Derzeit werden keine Tracking- oder Analyse-Cookies verwendet
• Keine Weitergabe von Daten an Drittanbieter
• Keine Google Analytics oder ähnliche Tools

Sie können Cookies in Ihrem Browser deaktivieren, dies kann jedoch die Funktionalität der Plattform einschränken.
</pre>
                                        </div>
                                    </div>
                                </div>

                                <!-- 5 Drittanbieter -->
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingThird">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseThird"
                                            aria-expanded="false" aria-controls="collapseThird">
                                            🔗 Weitergabe an Auftragsverarbeiter / Drittanbieter
                                        </button>
                                    </h2>
                                    <div id="collapseThird" class="accordion-collapse collapse"
                                        aria-labelledby="headingThird" data-bs-parent="#privacyAccordion">
                                        <div class="accordion-body">
                                            <pre
                                                style="white-space: pre-wrap; background: none; border: none; font-family: inherit;">
Eine Weitergabe Ihrer personenbezogenen Daten erfolgt nicht an Dritte.

Ausnahmen:
• Hosting-Dienstleister (IONOS): Technische Bereitstellung der Plattform
  (Serverstandort: Deutschland, Auftragsverarbeitungsvertrag nach Art. 28 DSGVO)

• Keine Weitergabe an:
  - Werbeunternehmen oder Marketing-Dienstleister
  - Soziale Netzwerke oder Tracking-Anbieter
  - Zahlungsdienstleister (da kostenlose Plattform)
  - Versanddienstleister (da digitale Inhalte)

Alle Daten verbleiben auf Servern in Deutschland und werden nicht in Drittländer übertragen.
</pre>
                                        </div>
                                    </div>
                                </div>

                                <!-- 6 Datenverwaltung -->
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingDataManagement">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseDataManagement"
                                            aria-expanded="false" aria-controls="collapseDataManagement">
                                            <i class="bi bi-gear me-2"></i> Datenverwaltung & Ihre Rechte
                                        </button>
                                    </h2>
                                    <div id="collapseDataManagement" class="accordion-collapse collapse"
                                        aria-labelledby="headingDataManagement" data-bs-parent="#privacyAccordion">
                                        <div class="accordion-body">
                                            <pre
                                                style="white-space: pre-wrap; background: none; border: none; font-family: inherit;">
Sie haben jederzeit die Möglichkeit, Ihre Daten zu verwalten:

• Datenexport: Laden Sie alle Ihre Daten in einem strukturierten JSON-Format herunter
• Datenlöschung: Löschen Sie Ihr Benutzerkonto und alle zugehörigen Daten
• Datenberichtigung: Ändern Sie Ihre Profildaten über das Benutzerprofil
• Datenauskunft: Sehen Sie ein, welche Daten über Sie gespeichert sind

Zugriff auf die Datenverwaltung:
• Über das Benutzerprofil: "Datenverwaltung" im Menü
• Direkt: /users/gdpr_data_management.php
• Kontakt: admin@YourDomain

Alle Aktionen sind kostenlos und werden unverzüglich bearbeitet.
</pre>
                                        </div>
                                    </div>
                                </div>

                                <!-- 7 Ihre Rechte -->
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingRights">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseRights"
                                            aria-expanded="false" aria-controls="collapseRights">
                                            🛠️ Rechte der betroffenen Personen
                                        </button>
                                    </h2>
                                    <div id="collapseRights" class="accordion-collapse collapse"
                                        aria-labelledby="headingRights" data-bs-parent="#privacyAccordion">
                                        <div class="accordion-body">
                                            <pre
                                                style="white-space: pre-wrap; background: none; border: none; font-family: inherit;">
Sie haben jederzeit das Recht auf
• Auskunft (Art. 15 DSGVO)
• Berichtigung (Art. 16 DSGVO)
• Löschung / „Recht auf Vergessenwerden“ (Art. 17 DSGVO)
• Einschränkung der Verarbeitung (Art. 18 DSGVO)
• Datenübertragbarkeit (Art. 20 DSGVO)
• Widerspruch gegen Verarbeitung (Art. 21 DSGVO)
• Beschwerde bei einer Aufsichtsbehörde (Art. 77 DSGVO)
</pre>
                                        </div>
                                    </div>
                                </div>

                                <!-- 8 Datensicherheit -->
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingSecurity">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseSecurity"
                                            aria-expanded="false" aria-controls="collapseSecurity">
                                            🔒 Datensicherheit
                                        </button>
                                    </h2>
                                    <div id="collapseSecurity" class="accordion-collapse collapse"
                                        aria-labelledby="headingSecurity" data-bs-parent="#privacyAccordion">
                                        <div class="accordion-body">
                                            <pre
                                                style="white-space: pre-wrap; background: none; border: none; font-family: inherit;">
• TLS-Verschlüsselung (https) schützt alle Datenübertragungen zwischen Ihrem Endgerät und unserem Server.
• Zugriffskontrollen, Zwei-Faktor-Authentifizierung für Administratoren.
• Regelmäßige Backups & Sicherheits-Updates.
</pre>
                                        </div>
                                    </div>
                                </div>

                                <!-- 9 Kontakt -->
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingContact">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseContact"
                                            aria-expanded="false" aria-controls="collapseContact">
                                            ✉️ Kontakt bei Datenschutzfragen
                                        </button>
                                    </h2>
                                    <div id="collapseContact" class="accordion-collapse collapse"
                                        aria-labelledby="headingContact" data-bs-parent="#privacyAccordion">
                                        <div class="accordion-body">
                                            <pre
                                                style="white-space: pre-wrap; background: none; border: none; font-family: inherit;">
Bei Fragen wenden Sie sich bitte an unseren Datenschutzbeauftragten:
E-Mail: admin@YourDomain
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
<?php include '../includes/footer.php'; ?>