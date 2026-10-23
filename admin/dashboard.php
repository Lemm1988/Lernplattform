<?php
/**
 * Admin-Dashboard – Startpunkt der Verwaltung.
 * Erreichbar über "Administration" oben rechts. Alle Verwaltungsseiten hängen als Karten daran
 * (includes/admin_bereiche.php). Moderatoren sehen nur ihre Bereiche, keine Statistiken.
 */

require_once '../config.php';
require_admin_or_moderator();
$ist_admin = is_admin();

if ($ist_admin) {
    // IP-Zugriff prüfen (flexibel)
    check_admin_access();
}
require_once '../includes/functions.php';
require_once '../includes/admin_bereiche.php';

// Statistik-Tabellen erstellen falls nötig (muss vor den Statistik-Funktionen sein)
require_once '../includes/statistics_logger.php';
if (function_exists('create_statistics_tables')) {
    create_statistics_tables();
}

$page_title = $ist_admin ? 'Admin-Dashboard' : 'Moderation';
$extra_css = ['/assets/css/admin.css'];
$esc = function ($text) {
    return htmlspecialchars((string)$text, ENT_QUOTES, 'UTF-8');
};

$bereiche = admin_bereiche_fuer_rolle($ist_admin ? 'admin' : 'moderator');
$offen = admin_offene_aufgaben($ist_admin);
$seiten_anzahl = array_sum(array_map(function ($b) { return count($b['seiten']); }, $bereiche));

$wochentage = ['Sonntag', 'Montag', 'Dienstag', 'Mittwoch', 'Donnerstag', 'Freitag', 'Samstag'];
$monate = ['Januar', 'Februar', 'März', 'April', 'Mai', 'Juni', 'Juli', 'August', 'September', 'Oktober', 'November', 'Dezember'];
$heute_text = $wochentage[(int)date('w')] . ', ' . (int)date('j') . '. ' . $monate[(int)date('n') - 1] . ' ' . date('Y');

if ($ist_admin) {
    $total_users = (int)get_user_count();
    $active_users = (int)get_active_user_count();
    $online_users = (int)get_online_users_count();
    $new_registrations = (int)get_new_registrations_last_7_days();
    $roles = get_user_roles_distribution();
    $question_status = get_question_status_counts();
    $quiz_stats = get_quiz_stats();
    $mod_logs = get_last_moderator_actions();
    $cron_logs = get_last_cron_logs();
    $reward_stats = get_reward_statistics();

    // Quiz-Abschlüsse der letzten 14 Tage – Tage ohne Abschluss mit 0 auffüllen
    $trend_werte = [];
    foreach (get_quiz_completion_trend(14) as $zeile) {
        $trend_werte[$zeile['completion_date']] = (int)$zeile['completions'];
    }
    $kurztage = ['So', 'Mo', 'Di', 'Mi', 'Do', 'Fr', 'Sa'];
    $trend = [];
    for ($i = 13; $i >= 0; $i--) {
        $zeit = strtotime("-$i day");
        $tag = date('Y-m-d', $zeit);
        $trend[] = [
            'anzahl' => $trend_werte[$tag] ?? 0,
            'kurz' => date('j.n.', $zeit),
            'lang' => $kurztage[(int)date('w', $zeit)] . ', ' . date('d.m.', $zeit),
            'heute' => $i === 0,
        ];
    }
    $trend_summe = array_sum(array_column($trend, 'anzahl'));
    $trend_max = max(array_column($trend, 'anzahl'));
    // Saubere Achsenschritte (1, 2, 5, 10, 20 …)
    $schritt = max(1, (int)ceil($trend_max / 4));
    $groesse = 10 ** (int)floor(log10($schritt));
    foreach ([1, 2, 5, 10] as $faktor) {
        if ($faktor * $groesse >= $schritt) {
            $schritt = $faktor * $groesse;
            break;
        }
    }
    $skala_max = max($schritt, $schritt * (int)ceil($trend_max / $schritt));
    $max_index = $trend_max > 0 ? array_search($trend_max, array_column($trend, 'anzahl'), true) : -1;

    // Rollenverteilung – feste Farbe je Rolle (nicht nach Rang)
    $rollen_info = [
        'student' => ['name' => 'Lernende', 'farbe' => '#4f46e5'],
        'moderator' => ['name' => 'Moderatoren', 'farbe' => '#eb6834'],
        'admin' => ['name' => 'Admins', 'farbe' => '#1baf7a'],
    ];
    $rollen = [];
    foreach ($rollen_info as $schluessel => $info) {
        $rollen[$schluessel] = $info + ['anzahl' => 0];
    }
    foreach ($roles as $zeile) {
        $schluessel = isset($rollen_info[$zeile['role']]) ? $zeile['role'] : 'sonstige';
        if (!isset($rollen[$schluessel])) {
            $rollen[$schluessel] = ['name' => 'Sonstige', 'farbe' => '#94a3b8', 'anzahl' => 0];
        }
        $rollen[$schluessel]['anzahl'] += (int)$zeile['count'];
    }
    $rollen_summe = max(1, array_sum(array_column($rollen, 'anzahl')));

    $fragen_offen = (int)($question_status['offen'] ?? 0);
    $fragen_geprueft = (int)($question_status['geprueft'] ?? 0);
    $fragen_abgelehnt = (int)($question_status['abgelehnt'] ?? 0);
    $quiz_gesamt = (int)($quiz_stats['total'] ?? 0);
    $quiz_bestanden = (int)($quiz_stats['passed'] ?? 0);
    $quiz_quote = (float)($quiz_stats['avg_percentage'] ?? 0);
    $bestanden_quote = $quiz_gesamt > 0 ? round($quiz_bestanden / $quiz_gesamt * 100) : 0;
    $aktiv_quote = $total_users > 0 ? round($active_users / $total_users * 100) : 0;

    // Letzte Aktionen
    $activity_labels = [
        'login' => 'Anmeldung',
        'logout' => 'Abmeldung',
        'quiz_start' => 'Quiz gestartet',
        'quiz_completed' => 'Quiz abgeschlossen',
        'quiz_abandoned' => 'Quiz abgebrochen',
        'page_access' => 'Seitenzugriff',
        'request_post' => 'Formulareingabe',
        'request_put' => 'Update-Anfrage',
        'request_delete' => 'Lösch-Anfrage',
        'request_patch' => 'Änderungs-Anfrage',
        'profile_updated' => 'Profil aktualisiert',
        'password_changed' => 'Passwort geändert',
        'settings_updated' => 'Einstellungen aktualisiert'
    ];
    $recent_activities = null;
    $recent_logs = [];
    try {
        $stmt = $pdo->prepare("
            SELECT ual.*, u.username, u.role
            FROM user_activity_logs ual
            LEFT JOIN users u ON ual.user_id = u.id
            ORDER BY ual.created_at DESC
            LIMIT 10
        ");
        $stmt->execute();
        $recent_activities = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        // Fallback auf alte Logs
        $stmt = $pdo->prepare("SELECT l.*, u.username FROM log_entries l LEFT JOIN users u ON l.user_id = u.id WHERE l.action NOT IN ('login', 'cronjob') ORDER BY l.created_at DESC LIMIT 5");
        $stmt->execute();
        $recent_logs = $stmt->fetchAll();
    }
}

$aufgaben = [];
if ($ist_admin) {
    $aufgaben[] = ['url' => '/admin/messages.php', 'icon' => 'bi-envelope', 'anzahl' => $offen['nachrichten'],
        'offen' => 'unbeantwortete Nachricht|unbeantwortete Nachrichten', 'erledigt' => 'Alle Nachrichten beantwortet'];
}
$aufgaben[] = ['url' => '/admin/question_management.php?status=0', 'icon' => 'bi-patch-question', 'anzahl' => $offen['fragen'],
    'offen' => 'Frage wartet auf Prüfung|Fragen warten auf Prüfung', 'erledigt' => 'Alle Fragen geprüft'];
if ($ist_admin) {
    $aufgaben[] = ['url' => '/admin/user_management.php', 'icon' => 'bi-person-plus', 'anzahl' => $new_registrations, 'info' => true,
        'offen' => 'neue Registrierung (7 Tage)|neue Registrierungen (7 Tage)', 'erledigt' => 'Keine neuen Registrierungen (7 Tage)'];
}
// Jährliche Pflege: WiSo-Kapitel enthalten Beitragssätze und Grenzen eines bestimmten Jahres
if ($ist_admin) {
    require_once '../includes/lernfeld.php';
    $wiso_stand = (int)(lernfeld_meta()['WiSo']['stand'] ?? 0);
    if ($wiso_stand && (int)date('Y') > $wiso_stand) {
        $aufgaben[] = ['url' => '/Learningfields/WiSo/', 'icon' => 'bi-calendar-check', 'anzahl' => 1,
            'offen' => 'WiSo-Werte auf ' . date('Y') . ' aktualisieren|', 'erledigt' => '', 'ohne_zahl' => true];
    }
}
$offen_summe = $offen['nachrichten'] + $offen['fragen'];

include '../includes/header.php';
?>
<div class="layout-container">
    <?php include '../includes/sidebar.php'; ?>
    <div class="main-wrapper">
        <main class="main-content">
            <div class="adm">

                <!-- Kopf -->
                <section class="adm-hero">
                    <div class="adm-hero-main">
                        <span class="adm-eyebrow"><i class="bi bi-gear-wide-connected" aria-hidden="true"></i><?= $ist_admin ? 'Administration' : 'Moderation' ?> · <?= $esc($heute_text) ?></span>
                        <h1><?= $ist_admin ? 'Admin-Dashboard' : 'Moderation' ?></h1>
                        <p>
                            <?= $offen_summe > 0 ? ($offen_summe === 1 ? 'Eine Sache wartet auf dich.' : $offen_summe . ' Dinge warten auf dich.') : 'Alles erledigt.' ?>
                            <?= $seiten_anzahl === 1 ? 'Darunter findest du deine Verwaltungsseite.' : 'Darunter findest du alle ' . $seiten_anzahl . ' Verwaltungsseiten.' ?>
                        </p>
                    </div>
                    <?php if ($ist_admin): ?>
                        <div class="adm-hero-stats">
                            <div class="adm-hero-stat">
                                <span class="adm-hero-stat-label"><i class="bi bi-people" aria-hidden="true"></i>Benutzer</span>
                                <span class="adm-hero-stat-value"><?= number_format($total_users, 0, ',', '.') ?></span>
                            </div>
                            <div class="adm-hero-stat">
                                <span class="adm-hero-stat-label"><span class="adm-live" aria-hidden="true"></span>Gerade online</span>
                                <span class="adm-hero-stat-value"><?= number_format($online_users, 0, ',', '.') ?></span>
                            </div>
                            <div class="adm-hero-stat">
                                <span class="adm-hero-stat-label"><i class="bi bi-lightning-charge" aria-hidden="true"></i>Quizze (7 Tage)</span>
                                <span class="adm-hero-stat-value"><?= number_format((int)($quiz_stats['recent'] ?? 0), 0, ',', '.') ?></span>
                            </div>
                        </div>
                    <?php endif; ?>
                </section>

                <!-- Zu erledigen -->
                <section class="adm-section" aria-labelledby="admAufgaben">
                    <h2 class="adm-section-title" id="admAufgaben"><i class="bi bi-check2-square" aria-hidden="true"></i>Zu erledigen</h2>
                    <div class="adm-todo">
                        <?php foreach ($aufgaben as $nr => $aufgabe):
                            $texte = explode('|', $aufgabe['offen']);
                            $hat_offen = $aufgabe['anzahl'] > 0;
                            $klasse = $hat_offen ? (!empty($aufgabe['info']) ? 'is-info' : 'is-open') : 'is-clear';
                        ?>
                            <a class="adm-todo-item <?= $klasse ?>" href="<?= $esc($aufgabe['url']) ?>" data-reveal style="--reveal-delay: <?= $nr * 0.06 ?>s">
                                <span class="adm-todo-icon"><i class="bi <?= $hat_offen ? $aufgabe['icon'] : 'bi-check-lg' ?>" aria-hidden="true"></i></span>
                                <span class="adm-todo-text">
                                    <?php if ($hat_offen): ?>
                                        <?php if (empty($aufgabe['ohne_zahl'])): ?><strong><?= number_format($aufgabe['anzahl'], 0, ',', '.') ?></strong><?php endif; ?>
                                        <span><?= $esc($aufgabe['anzahl'] === 1 ? $texte[0] : $texte[1]) ?></span>
                                    <?php else: ?>
                                        <span><?= $esc($aufgabe['erledigt']) ?></span>
                                    <?php endif; ?>
                                </span>
                                <i class="bi bi-arrow-right adm-arrow" aria-hidden="true"></i>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </section>

                <!-- Verwaltungsbereiche -->
                <section class="adm-section" aria-labelledby="admBereiche">
                    <div class="adm-section-head">
                        <h2 class="adm-section-title" id="admBereiche"><i class="bi bi-grid-1x2" aria-hidden="true"></i>Verwaltung</h2>
                        <?php if ($seiten_anzahl > 4): ?>
                            <label class="adm-search">
                                <i class="bi bi-search" aria-hidden="true"></i>
                                <span class="visually-hidden">Verwaltungsseite suchen</span>
                                <input type="search" id="admSuche" placeholder="Seite suchen …" autocomplete="off">
                                <kbd title="Taste / springt in die Suche">/</kbd>
                            </label>
                        <?php endif; ?>
                    </div>
                    <?php foreach ($bereiche as $bereich): ?>
                        <div class="adm-group">
                            <h3 class="adm-group-title"><i class="bi <?= $esc($bereich['icon']) ?>" aria-hidden="true"></i><?= $esc($bereich['titel']) ?></h3>
                            <div class="adm-tiles">
                                <?php foreach ($bereich['seiten'] as $nr => $seite):
                                    $zaehler = isset($seite['zaehler']) ? ($offen[$seite['zaehler']] ?? 0) : 0;
                                ?>
                                    <a class="adm-tile" href="<?= $esc($seite['url']) ?>" style="--c: <?= $esc($seite['farbe']) ?>; --reveal-delay: <?= min($nr, 5) * 0.05 ?>s" data-reveal
                                       data-suche="<?= $esc(mb_strtolower($seite['titel'] . ' ' . $seite['text'] . ' ' . $bereich['titel'])) ?>">
                                        <span class="adm-tile-icon"><i class="bi <?= $esc($seite['icon']) ?>" aria-hidden="true"></i></span>
                                        <span class="adm-tile-text">
                                            <strong><?= $esc($seite['titel']) ?></strong>
                                            <small><?= $esc($seite['text']) ?></small>
                                        </span>
                                        <?php if ($zaehler > 0): ?>
                                            <span class="adm-tile-badge" title="<?= (int)$zaehler ?> offen"><?= (int)$zaehler ?></span>
                                        <?php endif; ?>
                                        <i class="bi bi-arrow-right adm-arrow" aria-hidden="true"></i>
                                    </a>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    <p class="adm-empty" id="admKeinTreffer" hidden>
                        <i class="bi bi-search" aria-hidden="true"></i>Keine Verwaltungsseite gefunden.
                    </p>
                </section>

                <?php if ($ist_admin): ?>
                <!-- Kennzahlen -->
                <section class="adm-section" aria-labelledby="admZahlen">
                    <h2 class="adm-section-title" id="admZahlen"><i class="bi bi-activity" aria-hidden="true"></i>Kennzahlen</h2>
                    <div class="adm-grid-2">
                        <div class="adm-card" data-reveal>
                            <div class="adm-card-head">
                                <div>
                                    <h3>Benutzer</h3>
                                    <p>Konten und Rollen</p>
                                </div>
                                <a class="adm-card-link" href="/admin/user_management.php">Verwalten<i class="bi bi-arrow-right" aria-hidden="true"></i></a>
                            </div>
                            <div class="adm-stats">
                                <div class="adm-stat">
                                    <span class="adm-stat-label">Gesamt</span>
                                    <span class="adm-stat-value"><?= number_format($total_users, 0, ',', '.') ?></span>
                                </div>
                                <div class="adm-stat">
                                    <span class="adm-stat-label">Aktiv</span>
                                    <span class="adm-stat-value"><?= number_format($active_users, 0, ',', '.') ?></span>
                                    <span class="adm-meter" role="img" aria-label="<?= $aktiv_quote ?> % der Konten sind aktiv"><span style="width: <?= $aktiv_quote ?>%"></span></span>
                                </div>
                                <div class="adm-stat">
                                    <span class="adm-stat-label">Gerade online</span>
                                    <span class="adm-stat-value"><?= number_format($online_users, 0, ',', '.') ?></span>
                                </div>
                                <div class="adm-stat">
                                    <span class="adm-stat-label">Neu (7 Tage)</span>
                                    <span class="adm-stat-value"><?= number_format($new_registrations, 0, ',', '.') ?></span>
                                </div>
                            </div>
                            <div class="adm-roles">
                                <h4>Rollenverteilung</h4>
                                <div class="adm-stack" role="img" aria-label="Rollenverteilung: <?= $esc(implode(', ', array_map(function ($r) { return $r['name'] . ' ' . $r['anzahl']; }, $rollen))) ?>">
                                    <?php foreach ($rollen as $rolle): if ($rolle['anzahl'] === 0) continue; ?>
                                        <span class="adm-stack-seg" style="flex-grow: <?= $rolle['anzahl'] ?>; --c: <?= $rolle['farbe'] ?>" title="<?= $esc($rolle['name'] . ': ' . $rolle['anzahl']) ?>"></span>
                                    <?php endforeach; ?>
                                </div>
                                <ul class="adm-legend">
                                    <?php foreach ($rollen as $rolle): ?>
                                        <li>
                                            <span class="adm-swatch" style="--c: <?= $rolle['farbe'] ?>" aria-hidden="true"></span>
                                            <span><?= $esc($rolle['name']) ?></span>
                                            <strong><?= number_format($rolle['anzahl'], 0, ',', '.') ?></strong>
                                            <small><?= round($rolle['anzahl'] / $rollen_summe * 100) ?> %</small>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>

                        <div class="adm-card" data-reveal style="--reveal-delay: .08s">
                            <div class="adm-card-head">
                                <div>
                                    <h3>Fragen &amp; Quiz</h3>
                                    <p>Fragenpool und abgeschlossene Quizze</p>
                                </div>
                                <a class="adm-card-link" href="/admin/quiz_statistics.php">Details<i class="bi bi-arrow-right" aria-hidden="true"></i></a>
                            </div>
                            <div class="adm-stats">
                                <div class="adm-stat">
                                    <span class="adm-stat-label">Fragen freigegeben</span>
                                    <span class="adm-stat-value"><?= number_format($fragen_geprueft, 0, ',', '.') ?></span>
                                </div>
                                <div class="adm-stat">
                                    <span class="adm-stat-label">Fragen offen / abgelehnt</span>
                                    <span class="adm-stat-value"><?= number_format($fragen_offen, 0, ',', '.') ?> <small>/ <?= number_format($fragen_abgelehnt, 0, ',', '.') ?></small></span>
                                </div>
                                <div class="adm-stat">
                                    <span class="adm-stat-label">Quizze gesamt</span>
                                    <span class="adm-stat-value"><?= number_format($quiz_gesamt, 0, ',', '.') ?></span>
                                </div>
                                <div class="adm-stat">
                                    <span class="adm-stat-label">Gestartet (7 Tage)</span>
                                    <span class="adm-stat-value"><?= number_format((int)($quiz_stats['recent'] ?? 0), 0, ',', '.') ?></span>
                                </div>
                                <div class="adm-stat">
                                    <span class="adm-stat-label">Bestanden</span>
                                    <span class="adm-stat-value"><?= number_format($quiz_bestanden, 0, ',', '.') ?> <small><?= $bestanden_quote ?> %</small></span>
                                    <span class="adm-meter" role="img" aria-label="<?= $bestanden_quote ?> % der Quizze bestanden"><span style="width: <?= $bestanden_quote ?>%"></span></span>
                                </div>
                                <div class="adm-stat">
                                    <span class="adm-stat-label">Ø Erfolgsquote</span>
                                    <span class="adm-stat-value"><?= number_format($quiz_quote, 1, ',', '.') ?> %</span>
                                    <span class="adm-meter" role="img" aria-label="Durchschnittlich <?= number_format($quiz_quote, 1, ',', '.') ?> % richtig"><span style="width: <?= min(100, $quiz_quote) ?>%"></span></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Quiz-Abschlüsse der letzten 14 Tage -->
                    <div class="adm-card" data-reveal>
                        <div class="adm-card-head">
                            <div>
                                <h3>Quiz-Abschlüsse</h3>
                                <p>Letzte 14 Tage · <?= number_format($trend_summe, 0, ',', '.') ?> insgesamt</p>
                            </div>
                        </div>
                        <div class="adm-chart<?= $trend_summe === 0 ? ' is-empty' : '' ?>">
                            <div class="adm-chart-plot">
                                <?php for ($wert = $skala_max; $wert >= 0; $wert -= $schritt): ?>
                                    <span class="adm-gridline" style="bottom: <?= $wert / $skala_max * 100 ?>%"><span><?= $wert ?></span></span>
                                <?php endfor; ?>
                                <div class="adm-cols">
                                    <?php foreach ($trend as $nr => $tag): ?>
                                        <div class="adm-col<?= $tag['heute'] ? ' is-today' : '' ?>" tabindex="0" style="--i: <?= $nr ?>"
                                             aria-label="<?= $esc($tag['lang'] . ': ' . $tag['anzahl'] . ' abgeschlossen') ?>">
                                            <span class="adm-col-bar" style="height: <?= $tag['anzahl'] / $skala_max * 100 ?>%">
                                                <?php if ($nr === $max_index): ?><span class="adm-col-value"><?= $tag['anzahl'] ?></span><?php endif; ?>
                                            </span>
                                            <span class="adm-tip" aria-hidden="true"><strong><?= $tag['anzahl'] ?></strong> <?= $tag['anzahl'] === 1 ? 'Quiz' : 'Quizze' ?><small><?= $esc($tag['lang']) ?></small></span>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            <div class="adm-chart-x" aria-hidden="true">
                                <?php foreach ($trend as $tag): ?>
                                    <span<?= $tag['heute'] ? ' class="is-today"' : '' ?>><?= $tag['heute'] ? 'Heute' : $esc($tag['kurz']) ?></span>
                                <?php endforeach; ?>
                            </div>
                            <?php if ($trend_summe === 0): ?>
                                <p class="adm-chart-empty">In den letzten 14 Tagen wurde kein Quiz abgeschlossen.</p>
                            <?php endif; ?>
                        </div>
                        <details class="adm-table-toggle">
                            <summary>Werte als Tabelle</summary>
                            <table class="table table-sm mb-0">
                                <thead><tr><th scope="col">Tag</th><th scope="col" class="text-end">Abgeschlossene Quizze</th></tr></thead>
                                <tbody>
                                    <?php foreach ($trend as $tag): ?>
                                        <tr><td><?= $esc($tag['lang']) ?></td><td class="text-end"><?= $tag['anzahl'] ?></td></tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </details>
                    </div>
                </section>

                <!-- Protokolle -->
                <section class="adm-section" aria-labelledby="admProtokolle">
                    <h2 class="adm-section-title" id="admProtokolle"><i class="bi bi-clock-history" aria-hidden="true"></i>Was zuletzt passiert ist</h2>
                    <div class="adm-grid-log">
                        <div class="adm-card" data-reveal>
                            <div class="adm-card-head">
                                <div>
                                    <h3>Letzte Aktionen</h3>
                                    <p>Die zehn neuesten Einträge</p>
                                </div>
                                <a class="adm-card-link" href="/admin/activity_logs.php">Alle Protokolle<i class="bi bi-arrow-right" aria-hidden="true"></i></a>
                            </div>
                            <?php if ($recent_activities !== null): ?>
                                <?php if ($recent_activities): ?>
                                    <ul class="adm-list">
                                        <?php foreach ($recent_activities as $activity):
                                            $details = $activity['details'] ? json_decode($activity['details'], true) : null;
                                        ?>
                                            <li>
                                                <span class="adm-list-main">
                                                    <strong><?= $esc($activity['username'] ?? 'Unbekannt') ?></strong>
                                                    <?php if ($activity['role']): ?>
                                                        <span class="adm-role adm-role-<?= $esc($activity['role']) ?>"><?= $esc(ucfirst($activity['role'])) ?></span>
                                                    <?php endif; ?>
                                                    <span class="adm-list-sub">
                                                        <?= $esc($activity_labels[$activity['activity_type']] ?? $activity['activity_type']) ?>
                                                        <?php if (is_array($details) && isset($details['page'])): ?>
                                                            <span class="adm-muted">→ <?= $esc(basename($details['page'])) ?></span>
                                                        <?php endif; ?>
                                                    </span>
                                                </span>
                                                <time class="adm-time" datetime="<?= $esc($activity['created_at']) ?>"><?= time_ago($activity['created_at']) ?></time>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                <?php else: ?>
                                    <p class="adm-empty"><i class="bi bi-inbox" aria-hidden="true"></i>Keine Aktivitäten gefunden.</p>
                                <?php endif; ?>
                            <?php else: ?>
                                <ul class="adm-list">
                                    <?php foreach ($recent_logs as $log): ?>
                                        <li>
                                            <span class="adm-list-main">
                                                <strong><?= $esc($log['username'] ?? 'System') ?></strong>
                                                <span class="adm-list-sub"><?= $esc($log['description'] ?? $log['action'] ?? 'Aktion') ?></span>
                                            </span>
                                            <span class="adm-time"><?= format_german_datetime($log['created_at']) ?></span>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php endif; ?>
                        </div>

                        <div class="adm-stack-cards">
                            <div class="adm-card" data-reveal style="--reveal-delay: .06s">
                                <div class="adm-card-head">
                                    <div>
                                        <h3>Admin- &amp; Moderator-Logins</h3>
                                        <p>An- und Abmeldungen</p>
                                    </div>
                                </div>
                                <?php if ($mod_logs): ?>
                                    <ul class="adm-list">
                                        <?php foreach ($mod_logs as $log): $ist_login = ($log['activity_type'] ?? '') === 'login'; ?>
                                            <li>
                                                <span class="adm-dot <?= $ist_login ? 'is-in' : 'is-out' ?>" aria-hidden="true"><i class="bi <?= $ist_login ? 'bi-box-arrow-in-right' : 'bi-box-arrow-right' ?>"></i></span>
                                                <span class="adm-list-main">
                                                    <strong><?= $esc($log['username'] ?? 'Unbekannt') ?></strong>
                                                    <?php if (isset($log['role'])): ?>
                                                        <span class="adm-role adm-role-<?= $esc($log['role']) ?>"><?= $esc(ucfirst($log['role'])) ?></span>
                                                    <?php endif; ?>
                                                    <span class="adm-list-sub"><?= $ist_login ? 'Login' : 'Logout' ?></span>
                                                </span>
                                                <span class="adm-time"><?= format_german_datetime($log['created_at'] ?? '') ?></span>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                <?php else: ?>
                                    <p class="adm-empty"><i class="bi bi-info-circle" aria-hidden="true"></i>Keine Admin- oder Moderator-Logins gefunden.</p>
                                <?php endif; ?>
                            </div>
                            <div class="adm-card" data-reveal style="--reveal-delay: .12s">
                                <div class="adm-card-head">
                                    <div>
                                        <h3>Cronjob-Protokoll</h3>
                                        <p>Automatische Aufgaben</p>
                                    </div>
                                </div>
                                <?php if ($cron_logs): ?>
                                    <ul class="adm-list">
                                        <?php foreach ($cron_logs as $log): ?>
                                            <li>
                                                <span class="adm-dot is-cron" aria-hidden="true"><i class="bi bi-gear"></i></span>
                                                <span class="adm-list-main"><span class="adm-code"><?= $esc($log['action']) ?></span></span>
                                                <span class="adm-time"><?= format_german_datetime($log['created_at']) ?></span>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                <?php else: ?>
                                    <p class="adm-empty"><i class="bi bi-moon-stars" aria-hidden="true"></i>Noch keine Cronjob-Einträge.</p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- IT-Coins -->
                <section class="adm-section" aria-labelledby="admCoins">
                    <h2 class="adm-section-title" id="admCoins"><i class="bi bi-coin" aria-hidden="true"></i>IT-Coins</h2>
                    <div class="adm-card" data-reveal>
                        <div class="adm-card-head">
                            <div>
                                <h3>Belohnungssystem</h3>
                                <p>IT-Coins der Lernenden und die besten Sammler</p>
                            </div>
                            <a class="adm-card-link" href="/admin/reward_management.php">IT-Coins verwalten<i class="bi bi-arrow-right" aria-hidden="true"></i></a>
                        </div>
                        <div class="adm-coins">
                            <div class="adm-stats adm-stats-2">
                                <div class="adm-stat">
                                    <span class="adm-stat-label">IT-Coins vergeben</span>
                                    <span class="adm-stat-value"><?= number_format($reward_stats['overview']['total_points_awarded'] ?? 0, 0, ',', '.') ?></span>
                                </div>
                                <div class="adm-stat">
                                    <span class="adm-stat-label">Quizze belohnt</span>
                                    <span class="adm-stat-value"><?= number_format($reward_stats['overview']['total_quizzes_completed'] ?? 0, 0, ',', '.') ?></span>
                                </div>
                                <div class="adm-stat">
                                    <span class="adm-stat-label">Ø pro Lernendem</span>
                                    <span class="adm-stat-value"><?= number_format($reward_stats['overview']['avg_points_per_user'] ?? 0, 1, ',', '.') ?></span>
                                </div>
                                <div class="adm-stat">
                                    <span class="adm-stat-label">Höchster Stand</span>
                                    <span class="adm-stat-value"><?= number_format($reward_stats['overview']['max_points'] ?? 0, 0, ',', '.') ?></span>
                                </div>
                            </div>
                            <div class="adm-top">
                                <h4>Top 5 Sammler</h4>
                                <?php if (!empty($reward_stats['top_users'])): ?>
                                    <ol class="adm-ranking">
                                        <?php foreach ($reward_stats['top_users'] as $index => $user): ?>
                                            <li>
                                                <span class="adm-rank adm-rank-<?= $index + 1 ?>"><?= $index + 1 ?></span>
                                                <span class="adm-list-main">
                                                    <strong><?= $esc($user['username']) ?></strong>
                                                    <span class="adm-list-sub"><?= (int)$user['total_quizzes_passed'] ?> Quizze bestanden</span>
                                                </span>
                                                <span class="adm-coin-badge"><i class="bi bi-coin" aria-hidden="true"></i><?= number_format((int)$user['reward_points'], 0, ',', '.') ?></span>
                                            </li>
                                        <?php endforeach; ?>
                                    </ol>
                                <?php else: ?>
                                    <p class="adm-empty"><i class="bi bi-trophy" aria-hidden="true"></i>Noch keine IT-Coins vergeben.</p>
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php if (!empty($reward_stats['recent_rewards'])): ?>
                            <h4 class="adm-subhead">Letzte Belohnungen</h4>
                            <div class="table-responsive">
                                <table class="table table-sm align-middle mb-0">
                                    <thead>
                                        <tr>
                                            <th scope="col">Benutzer</th>
                                            <th scope="col">Lernfeld</th>
                                            <th scope="col" class="text-end">IT-Coins</th>
                                            <th scope="col" class="text-end">Erfolg</th>
                                            <th scope="col" class="text-end">Datum</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach (array_slice($reward_stats['recent_rewards'], 0, 5) as $reward): ?>
                                            <tr>
                                                <td><?= $esc($reward['username']) ?></td>
                                                <td><?= $esc($reward['learning_field_title'] ?? 'Allgemein') ?></td>
                                                <td class="text-end">+<?= (int)$reward['points_earned'] ?></td>
                                                <td class="text-end"><?= number_format($reward['success_percentage'], 1, ',', '.') ?> %</td>
                                                <td class="text-end text-nowrap"><?= date('d.m.Y H:i', strtotime($reward['completion_date'])) ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php endif; ?>
                    </div>
                </section>
                <?php endif; ?>

            </div>
        </main>
    </div>
</div>
<script>
// Verwaltungsseiten filtern; "/" springt in die Suche, Enter öffnet den einzigen Treffer
(function () {
    const suche = document.getElementById('admSuche');
    if (!suche) return;
    const kacheln = Array.from(document.querySelectorAll('.adm-tile'));
    const gruppen = Array.from(document.querySelectorAll('.adm-group'));
    const leer = document.getElementById('admKeinTreffer');

    function filtern() {
        const begriffe = suche.value.toLowerCase().trim().split(/\s+/).filter(Boolean);
        kacheln.forEach(function (k) {
            const text = k.dataset.suche;
            k.hidden = !begriffe.every(function (b) { return text.indexOf(b) !== -1; });
        });
        gruppen.forEach(function (g) {
            g.hidden = !g.querySelector('.adm-tile:not([hidden])');
        });
        leer.hidden = kacheln.some(function (k) { return !k.hidden; });
    }
    suche.addEventListener('input', filtern);
    suche.addEventListener('keydown', function (e) {
        if (e.key === 'Enter') {
            const treffer = kacheln.filter(function (k) { return !k.hidden; });
            if (treffer.length === 1) window.location.href = treffer[0].href;
        } else if (e.key === 'Escape') {
            suche.value = '';
            filtern();
        }
    });
    document.addEventListener('keydown', function (e) {
        const ziel = e.target;
        if (e.key === '/' && !(ziel.isContentEditable || /^(INPUT|TEXTAREA|SELECT)$/.test(ziel.tagName))) {
            e.preventDefault();
            suche.focus();
        }
    });
})();
</script>
<?php include '../includes/footer.php'; ?>
