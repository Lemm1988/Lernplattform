<?php
/**
 * Öffentliches Kontaktformular (auch ohne Konto) – zweiter Kontaktweg neben der E-Mail im Impressum.
 * Nachrichten gehen per E-Mail an den Betreiber (betreiber.local.php); gespeichert wird nichts.
 * Schutz vor Spam: verstecktes Feld, Mindest-Ausfüllzeit, höchstens drei Nachrichten pro Stunde und Sitzung, CSRF-Token.
 */
require_once __DIR__ . '/includes/rechtliches.php';

const KONTAKT_MIN_SEKUNDEN = 4;
const KONTAKT_MAX_PRO_STUNDE = 3;

$themen = ['Frage zur Plattform', 'Fehler in einem Inhalt', 'Datenschutz', 'Sonstiges'];
$fehler = [];
$werte = ['name' => '', 'email' => '', 'thema' => $themen[0], 'nachricht' => ''];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $werte = [
        'name' => trim((string)($_POST['name'] ?? '')),
        'email' => trim((string)($_POST['email'] ?? '')),
        'thema' => in_array($_POST['thema'] ?? '', $themen, true) ? $_POST['thema'] : $themen[0],
        'nachricht' => trim((string)($_POST['nachricht'] ?? '')),
    ];
    $gesendet = array_filter($_SESSION['kontakt_gesendet'] ?? [], function ($zeit) { return $zeit > time() - 3600; });
    $start = (int)($_SESSION['kontakt_formular_zeit'] ?? 0);
    $ist_bot = ($_POST['website'] ?? '') !== '' || $start === 0 || time() - $start < KONTAKT_MIN_SEKUNDEN;

    if (mb_strlen($werte['name']) < 2 || mb_strlen($werte['name']) > 100) $fehler[] = 'Bitte gib deinen Namen an.';
    if (!filter_var($werte['email'], FILTER_VALIDATE_EMAIL)) $fehler[] = 'Bitte gib eine gültige E-Mail-Adresse an, damit ich antworten kann.';
    if (mb_strlen($werte['nachricht']) < 20) $fehler[] = 'Die Nachricht ist zu kurz (mindestens 20 Zeichen).';
    if (mb_strlen($werte['nachricht']) > 5000) $fehler[] = 'Die Nachricht ist zu lang (höchstens 5000 Zeichen).';
    if (count($gesendet) >= KONTAKT_MAX_PRO_STUNDE) $fehler[] = 'Du hast gerade schon mehrere Nachrichten geschickt. Bitte versuch es später noch einmal.';

    if (!$fehler && $ist_bot) {
        // Bots bekommen dieselbe Erfolgsmeldung, damit sie nichts über den Schutz lernen
        set_success_message('Danke! Deine Nachricht ist angekommen.');
        header('Location: /kontakt.php');
        exit;
    }
    if (!$fehler) {
        $e = function ($text) { return nl2br(htmlspecialchars($text, ENT_QUOTES, 'UTF-8')); };
        $inhalt = '<p><strong>Neue Nachricht über das Kontaktformular</strong></p>'
            . '<p>Name: ' . $e($werte['name']) . '<br>E-Mail: ' . $e($werte['email']) . '<br>Thema: ' . $e($werte['thema'])
            . (is_logged_in() ? '<br>Angemeldet als: ' . $e($_SESSION['username'] ?? '') : '') . '</p>'
            . '<p>' . $e($werte['nachricht']) . '</p>';
        $empfaenger = (string)betreiber()['email'];
        if (!betreiber()['fehlt'] && send_email($empfaenger, 'Kontaktformular: ' . $werte['thema'], $inhalt)) {
            $gesendet[] = time();
            $_SESSION['kontakt_gesendet'] = array_values($gesendet);
            set_success_message('Danke! Deine Nachricht ist angekommen. Ich antworte dir an ' . $werte['email'] . '.');
            header('Location: /kontakt.php');
            exit;
        }
        error_log('Kontaktformular: E-Mail an den Betreiber konnte nicht gesendet werden');
        $fehler[] = 'Die Nachricht konnte gerade nicht gesendet werden. Bitte schreib mir direkt per E-Mail.';
    }
}
$_SESSION['kontakt_formular_zeit'] = time();

rechtsseite_start('Kontakt', 'bi-envelope', 'Fragen, Hinweise auf Fehler oder Anliegen zum Datenschutz – schreib mir gern.');
?>
<?php if ($fehler): ?>
    <div class="alert alert-danger" role="alert">
        <ul class="mb-0"><?php foreach ($fehler as $text): ?><li><?= htmlspecialchars($text) ?></li><?php endforeach; ?></ul>
    </div>
<?php endif; ?>

<div class="legal-grid">
    <section class="legal-card">
        <h2><i class="bi bi-chat-dots" aria-hidden="true"></i>Nachricht schreiben</h2>
        <form method="post" action="/kontakt.php" novalidate>
            <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token'] ?? '') ?>">
            <div class="hp-feld" aria-hidden="true">
                <label for="website">Website (bitte leer lassen)</label>
                <input type="text" id="website" name="website" tabindex="-1" autocomplete="off">
            </div>
            <div class="mb-3">
                <label class="form-label" for="kName">Name</label>
                <input class="form-control" id="kName" name="name" maxlength="100" required autocomplete="name" value="<?= htmlspecialchars($werte['name']) ?>">
            </div>
            <div class="mb-3">
                <label class="form-label" for="kEmail">E-Mail für die Antwort</label>
                <input class="form-control" id="kEmail" name="email" type="email" maxlength="255" required autocomplete="email" value="<?= htmlspecialchars($werte['email']) ?>">
            </div>
            <div class="mb-3">
                <label class="form-label" for="kThema">Thema</label>
                <select class="form-select" id="kThema" name="thema">
                    <?php foreach ($themen as $thema): ?>
                        <option<?= $thema === $werte['thema'] ? ' selected' : '' ?>><?= htmlspecialchars($thema) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label" for="kNachricht">Nachricht</label>
                <textarea class="form-control" id="kNachricht" name="nachricht" rows="6" minlength="20" maxlength="5000" required><?= htmlspecialchars($werte['nachricht']) ?></textarea>
            </div>
            <p class="small text-muted">Deine Angaben verwende ich nur, um deine Anfrage zu beantworten, und lösche sie danach.
                Mehr dazu in der <a href="<?= htmlspecialchars(get_setting('privacy_policy_url', '/users/datenschutz.php')) ?>">Datenschutzerklärung</a>.</p>
            <button type="submit" class="btn btn-primary"><i class="bi bi-send me-1" aria-hidden="true"></i>Nachricht senden</button>
        </form>
    </section>
    <section class="legal-card">
        <h2><i class="bi bi-envelope-at" aria-hidden="true"></i>Per E-Mail</h2>
        <p><?= betreiber_email_html() ?></p>
        <?php if (is_logged_in() && is_contact_enabled_for_user()): ?>
            <h3>Mit Konto</h3>
            <p>Fragen zur Plattform kannst du auch über <a href="<?= htmlspecialchars(get_setting('contact_url', '/users/kontakt.php')) ?>">deine Nachrichten</a>
                stellen – die Antwort findest du dann direkt in deinem Konto.</p>
        <?php endif; ?>
        <h3>Anbieter</h3>
        <p>Name und Anschrift findest du im <a href="<?= htmlspecialchars(get_setting('imprint_url', '/users/impressum.php')) ?>">Impressum</a>.</p>
    </section>
</div>
<?php rechtsseite_ende(); ?>
