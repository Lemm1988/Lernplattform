<?php
/**
 * LF11 – Funktionalität in Anwendungen realisieren
 * Ein Kapitel pro Datei in inhalt/kapitelN.php (jeweils ein Array, siehe includes/lernfeld.php).
 */
$lf_info = [
    'description' => 'Algorithmen entwerfen und prüfen, passende Datenstrukturen wählen, suchen und sortieren, Aufwand abschätzen, '
        . 'Abläufe mit Sequenz- und Zustandsdiagrammen modellieren und sauber mit Entwurfsprinzipien und Entwurfsmustern umsetzen.',
];

$chapters = [];
for ($i = 1; is_file(__DIR__ . "/inhalt/kapitel$i.php"); $i++) {
    $chapters["kapitel$i"] = require __DIR__ . "/inhalt/kapitel$i.php";
}
