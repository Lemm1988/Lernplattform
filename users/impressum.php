<?php
/**
 * Impressum nach § 5 DDG und § 18 Abs. 2 MStV.
 * Name und Anschrift kommen aus betreiber.local.php (nur auf dem Server, nicht im Repository).
 */
require_once __DIR__ . '/../includes/rechtliches.php';
$b = betreiber();

rechtsseite_start('Impressum', 'bi-info-circle', 'Angaben gemäß § 5 Digitale-Dienste-Gesetz (DDG)');
?>
<div class="legal-grid">
    <section class="legal-card">
        <h2><i class="bi bi-person" aria-hidden="true"></i>Anbieter</h2>
        <address><?= betreiber_anschrift_html() ?></address>
    </section>
    <section class="legal-card">
        <h2><i class="bi bi-envelope" aria-hidden="true"></i>Kontakt</h2>
        <p>E-Mail: <?= betreiber_email_html() ?><br>
            Kontaktformular: <a href="/kontakt.php">Nachricht schreiben</a></p>
    </section>
</div>

<section class="legal-card">
    <h2><i class="bi bi-pencil-square" aria-hidden="true"></i>Verantwortlich für den Inhalt</h2>
    <p>Verantwortlich für die redaktionellen Inhalte nach § 18 Abs. 2 Medienstaatsvertrag (MStV):<br>
        <?= htmlspecialchars($b['name']) ?>, Anschrift wie oben</p>
</section>

<section class="legal-card">
    <h2><i class="bi bi-info-square" aria-hidden="true"></i>Hinweise</h2>
    <h3>Inhalte</h3>
    <p>Die Lerninhalte, Quizfragen und IT-Trainer werden mit Sorgfalt erstellt. Sie dienen der Vorbereitung auf die
        Abschlussprüfungen für Fachinformatiker/-innen, sind aber kein offizielles Material der IHK. Eine Gewähr für
        Richtigkeit, Vollständigkeit und Aktualität sowie für einen Prüfungserfolg kann nicht übernommen werden.</p>
    <h3>Links</h3>
    <p>Für Inhalte verlinkter fremder Seiten sind ausschließlich deren Betreiber verantwortlich. Bei Bekanntwerden von
        Rechtsverletzungen werden entsprechende Links umgehend entfernt.</p>
    <h3>Urheberrecht</h3>
    <p>Texte, Grafiken, Aufgaben und Quizfragen dieser Seite sind eigene Werke und urheberrechtlich geschützt. Für das
        persönliche Lernen darfst du sie selbstverständlich nutzen; eine Veröffentlichung oder Weitergabe – auch in
        Auszügen – ist nur mit Erlaubnis gestattet. Verwendete Software und Schriften stehen unter ihren eigenen
        Open-Source-Lizenzen.</p>
    <h3>Streitbeilegung</h3>
    <p>Zur Teilnahme an einem Streitbeilegungsverfahren vor einer Verbraucherschlichtungsstelle bin ich weder verpflichtet
        noch bereit.</p>
</section>
<?php rechtsseite_ende(); ?>
