<?php
/**
 * Prüfungssimulation: Fragen aus den prüfungsrelevanten Lernfeldern gemischt, Zeitlimit wie in der Prüfung,
 * Bewertung nach dem 100-Punkte-Schlüssel der IHK.
 *
 * Die echte Prüfung besteht aus offenen, handlungsorientierten Aufgaben. Die Simulation nutzt die
 * Multiple-Choice-Fragen der Plattform und trainiert Themenmix und Zeitdruck – das sagen wir auch auf der Seite.
 * Benötigt die Spalte quiz_sessions.quiz_mode (migrations/2026-10-23_lernfortschritt_pruefung.sql).
 */

require_once __DIR__ . '/lernfeld.php';

function pruefungsteile() {
    return [
        'ap1' => [
            'kurz' => 'AP1', 'titel' => 'Einrichten eines IT-gestützten Arbeitsplatzes', 'teil' => 'Abschlussprüfung Teil 1',
            'minuten' => 90, 'fragen' => 40, 'lf' => ['LF1', 'LF2', 'LF3', 'LF4', 'LF5', 'LF6'], 'icon' => 'bi-pc-display', 'farbe' => '#2563eb',
        ],
        'ga1' => [
            'kurz' => 'GA1', 'titel' => 'Planen eines Softwareproduktes', 'teil' => 'Abschlussprüfung Teil 2',
            'minuten' => 90, 'fragen' => 40, 'lf' => ['LF5', 'LF8', 'LF10', 'LF11', 'LF12', 'Englisch'], 'icon' => 'bi-diagram-3', 'farbe' => '#4f46e5',
        ],
        'ga2' => [
            'kurz' => 'GA2', 'titel' => 'Entwicklung und Umsetzung von Algorithmen', 'teil' => 'Abschlussprüfung Teil 2',
            'minuten' => 90, 'fragen' => 40, 'lf' => ['LF5', 'LF7', 'LF8', 'LF11'], 'icon' => 'bi-code-slash', 'farbe' => '#7c3aed',
        ],
        'wiso' => [
            'kurz' => 'WiSo', 'titel' => 'Wirtschafts- und Sozialkunde', 'teil' => 'Abschlussprüfung Teil 2',
            'minuten' => 60, 'fragen' => 30, 'lf' => ['WiSo', 'LF1'], 'icon' => 'bi-briefcase', 'farbe' => '#d97706',
        ],
    ];
}

/** Ist die Datenbank vorbereitet (Spalte quiz_mode)? Ohne Migration bleibt die Simulation ausgeblendet. */
function pruefung_verfuegbar() {
    global $pdo;
    static $verfuegbar = null;
    if ($verfuegbar === null) {
        try {
            $verfuegbar = (bool)$pdo->query("SHOW COLUMNS FROM quiz_sessions LIKE 'quiz_mode'")->fetch();
        } catch (PDOException $e) {
            $verfuegbar = false;
        }
    }
    return $verfuegbar;
}

/** Note nach dem 100-Punkte-Schlüssel der IHK: [Note, Bezeichnung] */
function ihk_note($prozent) {
    $punkte = (int)round($prozent);
    if ($punkte >= 92) return [1, 'sehr gut'];
    if ($punkte >= 81) return [2, 'gut'];
    if ($punkte >= 67) return [3, 'befriedigend'];
    if ($punkte >= 50) return [4, 'ausreichend'];
    if ($punkte >= 30) return [5, 'mangelhaft'];
    return [6, 'ungenügend'];
}

/** Datenbank-IDs der Lernfelder eines Prüfungsteils mit der Zahl freigegebener Fragen */
function pruefung_lernfelder($teil) {
    $lernfelder = [];
    foreach ($teil['lf'] as $key) {
        $info = lernfeld_quiz_info($key);
        if ($info && (int)$info['fragen'] > 0) {
            $lernfelder[$key] = ['id' => (int)$info['id'], 'fragen' => (int)$info['fragen']];
        }
    }
    return $lernfelder;
}

/** Zufällige Fragen, reihum aus den Lernfeldern gezogen – so kommt jedes Thema ähnlich oft dran */
function pruefung_fragen_waehlen($teil) {
    global $pdo;
    $listen = [];
    foreach (pruefung_lernfelder($teil) as $lf) {
        $stmt = $pdo->prepare("SELECT id FROM questions WHERE learning_field_id = ? AND is_approved = 1 ORDER BY RAND()");
        $stmt->execute([$lf['id']]);
        $listen[] = array_map('intval', $stmt->fetchAll(PDO::FETCH_COLUMN));
    }
    $gewaehlt = [];
    $laengste = $listen ? max(array_map('count', $listen)) : 0;
    for ($runde = 0; $runde < $laengste && count($gewaehlt) < $teil['fragen']; $runde++) {
        foreach ($listen as $ids) {
            if (isset($ids[$runde]) && count($gewaehlt) < $teil['fragen']) {
                $gewaehlt[$ids[$runde]] = true;
            }
        }
    }
    $gewaehlt = array_keys($gewaehlt);
    shuffle($gewaehlt);
    return $gewaehlt;
}
