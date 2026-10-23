<?php
/**
 * Nutzungsbedingungen (AGB) für die kostenlose Lernplattform.
 * Anbieterdaten stehen im Impressum (betreiber.local.php) – hier bewusst ohne Anschrift.
 */
require_once __DIR__ . '/../includes/rechtliches.php';
$b = betreiber();
$abschnitte = [
    'geltung' => 'Geltungsbereich und Anbieter',
    'leistungen' => 'Leistungen',
    'konto' => 'Benutzerkonto',
    'regeln' => 'Regeln für die Nutzung',
    'beitraege' => 'Eingereichte Fragen und Nachrichten',
    'urheberrecht' => 'Urheberrecht',
    'haftung' => 'Haftung',
    'ende' => 'Konto löschen und Sperrung',
    'aenderungen' => 'Änderungen',
    'schluss' => 'Schlussbestimmungen',
];

rechtsseite_start('Nutzungsbedingungen (AGB)', 'bi-file-earmark-text', 'Die Regeln für die Nutzung dieser kostenlosen Lernplattform.');
?>
<nav class="legal-toc" aria-label="Inhalt">
    <strong>Inhalt</strong>
    <ol>
        <?php foreach ($abschnitte as $id => $titel): ?>
            <li><a href="#<?= $id ?>"><?= htmlspecialchars($titel) ?></a></li>
        <?php endforeach; ?>
    </ol>
</nav>

<section class="legal-card" id="geltung">
    <h2>1. Geltungsbereich und Anbieter</h2>
    <p>Diese Bedingungen gelten für die Nutzung der Lernplattform unter dieser Domain. Anbieter ist
        <?= htmlspecialchars($b['name']) ?>; Anschrift und Kontaktwege stehen im
        <a href="<?= htmlspecialchars(get_setting('imprint_url', '/users/impressum.php')) ?>">Impressum</a>.</p>
</section>

<section class="legal-card" id="leistungen">
    <h2>2. Leistungen</h2>
    <p>Die Plattform hilft bei der Vorbereitung auf die Abschlussprüfungen für Fachinformatiker/-innen. Alle Angebote sind
        kostenlos.</p>
    <ul>
        <li>Ohne Konto: Lernfelder und Kapitel lesen, Programmier-Grundlagen, News.</li>
        <li>Mit Konto zusätzlich: Quiz mit Erklärungen, Fehlertraining, Prüfungssimulation, IT-Trainer, Lernfortschritt,
            IT-Coins, Fragen einreichen und Nachrichten an die Administration.</li>
    </ul>
    <p>Die Inhalte sind kein offizielles Material der IHK und ersetzen weder Ausbildung noch Berufsschule. Ein Anspruch auf
        ständige Verfügbarkeit oder auf bestimmte Funktionen besteht nicht; Angebote können erweitert, geändert oder
        eingestellt werden.</p>
</section>

<section class="legal-card" id="konto">
    <h2>3. Benutzerkonto</h2>
    <p>Für ein Konto brauchst du eine gültige E-Mail-Adresse, die du bestätigst. Halte dein Passwort geheim und gib dein
        Konto nicht an andere weiter. Bemerkst du einen Missbrauch, melde ihn bitte.</p>
</section>

<section class="legal-card" id="regeln">
    <h2>4. Regeln für die Nutzung</h2>
    <p>Bitte nutze die Plattform fair und rechtmäßig. Nicht erlaubt ist insbesondere:</p>
    <ul>
        <li>rechtswidrige, beleidigende, diskriminierende oder werbende Inhalte einzureichen oder zu versenden,</li>
        <li>Rechte anderer zu verletzen, etwa durch das Einreichen fremder, urheberrechtlich geschützter Prüfungsaufgaben,</li>
        <li>die Plattform anzugreifen, Sicherheitsmaßnahmen zu umgehen oder sie durch übermäßige Anfragen zu belasten,</li>
        <li>Inhalte automatisiert in großem Umfang auszulesen (Scraping) oder Konten automatisiert anzulegen.</li>
    </ul>
</section>

<section class="legal-card" id="beitraege">
    <h2>5. Eingereichte Fragen und Nachrichten</h2>
    <p>Wenn du eine Quizfrage einreichst, versicherst du, dass du sie selbst formuliert hast oder verwenden darf. Du räumst
        mir das einfache, unentgeltliche und zeitlich unbegrenzte Recht ein, sie auf der Plattform zu veröffentlichen und
        dafür zu bearbeiten (z. B. zu korrigieren oder zu kürzen). Einen Anspruch auf Veröffentlichung gibt es nicht.
        Rechtswidrige Inhalte werden entfernt.</p>
</section>

<section class="legal-card" id="urheberrecht">
    <h2>6. Urheberrecht</h2>
    <p>Texte, Grafiken, Aufgaben und Quizfragen sind urheberrechtlich geschützt. Für dein persönliches Lernen darfst du sie
        frei nutzen, auch Notizen und Ausdrucke für dich anlegen. Eine Veröffentlichung, Weitergabe oder kommerzielle Nutzung
        – auch in Auszügen – ist nur mit Erlaubnis gestattet; Zitate im gesetzlichen Rahmen (§ 51 UrhG) bleiben erlaubt.</p>
</section>

<section class="legal-card" id="haftung">
    <h2>7. Haftung</h2>
    <p>Die Inhalte werden sorgfältig erstellt, eine Gewähr für Richtigkeit, Vollständigkeit und Aktualität sowie für einen
        Prüfungserfolg wird aber nicht übernommen.</p>
    <p>Ich hafte unbeschränkt bei Vorsatz und grober Fahrlässigkeit sowie bei Verletzung von Leben, Körper oder Gesundheit.
        Weil die Plattform unentgeltlich ist, ist die Haftung im Übrigen ausgeschlossen, soweit das gesetzlich zulässig ist.</p>
</section>

<section class="legal-card" id="ende">
    <h2>8. Konto löschen und Sperrung</h2>
    <p>Du kannst dein Konto jederzeit ohne Angabe von Gründen unter
        <a href="/users/gdpr_data_management.php">Datenverwaltung</a> löschen. Bei schweren oder wiederholten Verstößen gegen
        diese Bedingungen kann ein Konto gesperrt oder gelöscht werden. Konten, die sechs Monate lang nicht genutzt wurden,
        werden automatisch gelöscht (siehe <a href="<?= htmlspecialchars(get_setting('privacy_policy_url', '/users/datenschutz.php')) ?>">Datenschutzerklärung</a>).</p>
</section>

<section class="legal-card" id="aenderungen">
    <h2>9. Änderungen</h2>
    <p>Diese Bedingungen können angepasst werden, etwa wenn neue Funktionen hinzukommen. Wesentliche Änderungen teile ich
        registrierten Nutzern vorher per E-Mail mit. Wer nicht einverstanden ist, kann sein Konto jederzeit löschen.</p>
</section>

<section class="legal-card" id="schluss">
    <h2>10. Schlussbestimmungen</h2>
    <p>Es gilt das Recht der Bundesrepublik Deutschland. Bist du Verbraucher/-in, gelten zusätzlich die zwingenden
        Verbraucherschutzvorschriften des Landes, in dem du lebst. Sollte eine Bestimmung unwirksam sein, bleiben die übrigen
        wirksam.</p>
</section>

<p class="legal-stand">Stand: Oktober 2026</p>
<?php rechtsseite_ende(); ?>
