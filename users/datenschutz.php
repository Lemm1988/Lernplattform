<?php
/**
 * Datenschutzerklärung nach Art. 13 DSGVO.
 * Name und Anschrift kommen aus betreiber.local.php (nur auf dem Server, nicht im Repository).
 * Bei neuen Funktionen, die personenbezogene Daten verarbeiten (z. B. Werbung), diese Seite anpassen.
 */
require_once __DIR__ . '/../includes/rechtliches.php';
$b = betreiber();
$abschnitte = [
    'verantwortlich' => 'Verantwortlicher',
    'ueberblick' => 'Überblick',
    'hosting' => 'Hosting und Server-Logdateien',
    'konto' => 'Benutzerkonto',
    'lernen' => 'Quiz, Lernfortschritt und IT-Trainer',
    'protokolle' => 'Sicherheits- und Aktivitätsprotokolle',
    'kontakt' => 'Kontakt',
    'newsletter' => 'Newsletter und E-Mails',
    'cookies' => 'Cookies und Speicher im Browser',
    'empfaenger' => 'Empfänger und Drittanbieter',
    'dauer' => 'Speicherdauer',
    'rechte' => 'Deine Rechte',
];

rechtsseite_start('Datenschutzerklärung', 'bi-shield-lock', 'Welche Daten diese Lernplattform verarbeitet, wozu und wie lange.');
?>
<nav class="legal-toc" aria-label="Inhalt">
    <strong>Inhalt</strong>
    <ol>
        <?php foreach ($abschnitte as $id => $titel): ?>
            <li><a href="#<?= $id ?>"><?= htmlspecialchars($titel) ?></a></li>
        <?php endforeach; ?>
    </ol>
</nav>

<section class="legal-card" id="verantwortlich">
    <h2><i class="bi bi-person" aria-hidden="true"></i>1. Verantwortlicher</h2>
    <address><?= betreiber_anschrift_html() ?></address>
    <p class="mt-2">E-Mail: <?= betreiber_email_html() ?> · <a href="/kontakt.php">Kontaktformular</a></p>
    <p>Ein Datenschutzbeauftragter ist nicht benannt, weil dafür keine gesetzliche Pflicht besteht. Bei Fragen zum
        Datenschutz wende dich direkt an mich.</p>
</section>

<section class="legal-card" id="ueberblick">
    <h2><i class="bi bi-list-check" aria-hidden="true"></i>2. Überblick</h2>
    <p>Die Lernplattform ist kostenlos. Lerninhalte kannst du ohne Konto lesen. Für Quiz, Prüfungssimulation, IT-Trainer
        und Lernfortschritt brauchst du ein Konto. Es gibt <strong>kein Tracking, keine Analyse-Tools, keine Werbung und
        keine eingebundenen Inhalte fremder Server</strong> – Schriften, Symbole und Programmbibliotheken liegen auf dem
        eigenen Server.</p>
    <div class="table-responsive">
        <table class="table table-sm table-bordered legal-table">
            <thead><tr><th scope="col">Zweck</th><th scope="col">Daten</th><th scope="col">Rechtsgrundlage (DSGVO)</th></tr></thead>
            <tbody>
                <tr><td>Webseite ausliefern, Sicherheit</td><td>Server-Logdateien</td><td>Art. 6 Abs. 1 lit. f</td></tr>
                <tr><td>Benutzerkonto, Lernfunktionen</td><td>Kontodaten, Quiz-Ergebnisse, Fortschritt</td><td>Art. 6 Abs. 1 lit. b</td></tr>
                <tr><td>Schutz vor Missbrauch</td><td>Anmeldeversuche, Aktivitätsprotokolle</td><td>Art. 6 Abs. 1 lit. f</td></tr>
                <tr><td>Anfragen beantworten</td><td>Name, E-Mail, Nachricht</td><td>Art. 6 Abs. 1 lit. b und f</td></tr>
                <tr><td>Newsletter</td><td>E-Mail-Adresse</td><td>Art. 6 Abs. 1 lit. a (Einwilligung)</td></tr>
            </tbody>
        </table>
    </div>
</section>

<section class="legal-card" id="hosting">
    <h2><i class="bi bi-hdd-network" aria-hidden="true"></i>3. Hosting und Server-Logdateien</h2>
    <p>Die Seite liegt bei der IONOS SE, Elgendorfer Str. 57, 56410 Montabaur, auf Servern in Deutschland. Mit IONOS
        besteht ein Vertrag zur Auftragsverarbeitung (Art. 28 DSGVO).</p>
    <p>Bei jedem Aufruf speichert der Server automatisch: IP-Adresse, Datum und Uhrzeit, aufgerufene Seite, übertragene
        Datenmenge, zuvor besuchte Seite (Referrer) und Browserkennung. Das ist nötig, um die Seite auszuliefern und
        Angriffe zu erkennen (berechtigtes Interesse nach Art. 6 Abs. 1 lit. f DSGVO). Die Logdateien werden nur für
        begrenzte Zeit aufbewahrt und danach automatisch gelöscht.</p>
</section>

<section class="legal-card" id="konto">
    <h2><i class="bi bi-person-badge" aria-hidden="true"></i>4. Benutzerkonto</h2>
    <p>Bei der Registrierung speichere ich Benutzername, E-Mail-Adresse und dein Passwort – nur als sicheren Hash, nie im
        Klartext. Dazu kommen Rolle, Registrierungsdatum, letzte Anmeldung, dein gewählter Avatar und, falls du sie
        einrichtest, die Daten der Zwei-Faktor-Anmeldung. Zur Bestätigung der E-Mail-Adresse erhältst du eine E-Mail mit
        einem Link. Rechtsgrundlage ist die Bereitstellung der Plattform (Art. 6 Abs. 1 lit. b DSGVO).</p>
    <p>Du kannst unter <a href="/users/gdpr_data_management.php">Datenverwaltung</a> jederzeit alle Daten herunterladen
        oder dein Konto mit allen Daten löschen.</p>
</section>

<section class="legal-card" id="lernen">
    <h2><i class="bi bi-mortarboard" aria-hidden="true"></i>5. Quiz, Lernfortschritt und IT-Trainer</h2>
    <p>Damit du deine Ergebnisse siehst und das Fehlertraining funktioniert, speichere ich zu deinem Konto: gestartete und
        abgeschlossene Quizze und Prüfungssimulationen, deine Antworten, Punkte und IT-Coins, als gelesen markierte
        Kapitel sowie von dir eingereichte Fragen und Nachrichten (Art. 6 Abs. 1 lit. b DSGVO). Diese Daten sieht außer
        dir nur die Administration der Plattform.</p>
    <p>Die IT-Trainer speichern deinen Spielstand nur in deinem Browser (siehe Abschnitt 9) – er wird nicht übertragen.</p>
</section>

<section class="legal-card" id="protokolle">
    <h2><i class="bi bi-clock-history" aria-hidden="true"></i>6. Sicherheits- und Aktivitätsprotokolle</h2>
    <p>Zum Schutz vor Missbrauch und zur Fehlersuche protokolliere ich bei angemeldeten Nutzern aufgerufene Seiten und
        Aktionen mit Zeitpunkt, Browserkennung und einer <strong>gekürzten</strong> IP-Adresse (das letzte Byte wird entfernt).
        Fehlgeschlagene und erfolgreiche Anmeldungen werden mit vollständiger IP-Adresse gespeichert, um
        Passwort-Rateangriffe zu erkennen und zu sperren (Art. 6 Abs. 1 lit. f DSGVO).</p>
</section>

<section class="legal-card" id="kontakt">
    <h2><i class="bi bi-envelope" aria-hidden="true"></i>7. Kontakt</h2>
    <p>Schreibst du mir über das <a href="/kontakt.php">Kontaktformular</a> oder per E-Mail, verarbeite ich Name,
        E-Mail-Adresse und Nachricht, um deine Anfrage zu beantworten (Art. 6 Abs. 1 lit. b bzw. f DSGVO). Nachrichten
        über das öffentliche Formular werden nicht in der Datenbank gespeichert, sondern per E-Mail zugestellt und nach
        Erledigung gelöscht. Nachrichten aus deinem Konto bleiben dort gespeichert, bis du sie oder dein Konto löschst.</p>
</section>

<section class="legal-card" id="newsletter">
    <h2><i class="bi bi-envelope-paper" aria-hidden="true"></i>8. Newsletter und E-Mails</h2>
    <p>Einen Newsletter bekommst du nur, wenn du bei der Registrierung oder in deinen
        <a href="/settings.php">Einstellungen</a> zugestimmt hast (Art. 6 Abs. 1 lit. a DSGVO). Die Einwilligung kannst du
        dort jederzeit mit Wirkung für die Zukunft widerrufen. Unabhängig davon erhältst du E-Mails, die für dein Konto nötig
        sind – etwa zur Bestätigung der Adresse, zum Zurücksetzen des Passworts oder einen Hinweis, bevor ein lange
        ungenutztes Konto gelöscht wird.</p>
</section>

<section class="legal-card" id="cookies">
    <h2><i class="bi bi-database" aria-hidden="true"></i>9. Cookies und Speicher im Browser</h2>
    <p>Es werden nur technisch notwendige Einträge gesetzt. Dafür ist keine Einwilligung nötig (§ 25 Abs. 2 Nr. 2 TDDDG).</p>
    <div class="table-responsive">
        <table class="table table-sm table-bordered legal-table">
            <thead><tr><th scope="col">Name</th><th scope="col">Zweck</th><th scope="col">Dauer</th></tr></thead>
            <tbody>
                <tr><td>PHPSESSID (Cookie)</td><td>Anmeldung und Schutz von Formularen vor Fremdzugriff (CSRF)</td><td>bis zum Schließen des Browsers bzw. Abmelden</td></tr>
                <tr><td>cookie_consent (Cookie)</td><td>merkt sich, dass du den Cookie-Hinweis geschlossen hast</td><td>1 Jahr</td></tr>
                <tr><td>Spielstände (localStorage)</td><td>Fortschritt in den IT-Trainern, nur auf deinem Gerät</td><td>bis du ihn im Browser löschst</td></tr>
            </tbody>
        </table>
    </div>
</section>

<section class="legal-card" id="empfaenger">
    <h2><i class="bi bi-share" aria-hidden="true"></i>10. Empfänger und Drittanbieter</h2>
    <p>Daten werden nicht verkauft und nicht an Dritte weitergegeben. Empfänger ist nur der Hoster IONOS als
        Auftragsverarbeiter. E-Mails werden über den E-Mail-Server des Hosters versendet. Eine Übermittlung in Länder
        außerhalb der EU findet nicht statt.</p>
</section>

<section class="legal-card" id="dauer">
    <h2><i class="bi bi-hourglass-split" aria-hidden="true"></i>11. Speicherdauer</h2>
    <ul>
        <li>Kontodaten, Ergebnisse und Fortschritt: bis du dein Konto löschst. Konten, die sechs Monate lang nicht genutzt
            wurden, werden mit allen Daten automatisch gelöscht; vorher kann eine Erinnerung per E-Mail kommen.</li>
        <li>Aktivitäts- und Anmeldeprotokolle: höchstens sechs Monate.</li>
        <li>Anfragen über das Kontaktformular: bis sie erledigt sind.</li>
        <li>Gesetzliche Aufbewahrungspflichten bleiben unberührt.</li>
    </ul>
</section>

<section class="legal-card" id="rechte">
    <h2><i class="bi bi-person-check" aria-hidden="true"></i>12. Deine Rechte</h2>
    <p>Du hast das Recht auf Auskunft (Art. 15 DSGVO), Berichtigung (Art. 16), Löschung (Art. 17), Einschränkung der
        Verarbeitung (Art. 18), Datenübertragbarkeit (Art. 20) und Widerspruch gegen Verarbeitungen auf Grundlage
        berechtigter Interessen (Art. 21). Eine erteilte Einwilligung kannst du jederzeit widerrufen (Art. 7 Abs. 3).
        Vieles davon erledigst du selbst unter <a href="/users/gdpr_data_management.php">Datenverwaltung</a>; sonst
        genügt eine Nachricht an mich.</p>
    <p>Außerdem kannst du dich bei einer Datenschutz-Aufsichtsbehörde beschweren (Art. 77 DSGVO), zum Beispiel bei der für
        mich zuständigen: <?= htmlspecialchars($b['aufsicht_name'] ?? '') ?>
        <?php if (!empty($b['aufsicht_web'])): ?>(<a href="<?= htmlspecialchars($b['aufsicht_web']) ?>" rel="noopener" target="_blank"><?= htmlspecialchars(preg_replace('#^https?://(www\.)?#', '', $b['aufsicht_web'])) ?></a>)<?php endif; ?>.</p>
    <p>Die Bereitstellung von Daten ist freiwillig. Ohne Konto kannst du die Lerninhalte lesen, aber Quiz, Trainer und
        Fortschritt nicht nutzen. Eine automatisierte Entscheidungsfindung oder ein Profiling findet nicht statt.</p>
</section>

<p class="legal-stand">Stand: Oktober 2026</p>
<?php rechtsseite_ende(); ?>
