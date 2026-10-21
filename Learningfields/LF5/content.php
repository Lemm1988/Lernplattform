<?php
/**
 * LF5 – Software zur Verwaltung von Daten anpassen
 * Ein Kapitel pro Datei in inhalt/kapitelN.php (jeweils ein Array, siehe includes/lernfeld.php).
 */
$lf_info = [
    'description' => 'Daten darstellen und in Programmen und Dateien verwalten, Datenbanken modellieren, normalisieren und anlegen, '
        . 'mit SQL abfragen und ändern – und die Daten mit Transaktionen, Indizes, Sicherungen und Rechten schützen.',
];

$chapters = [];
for ($i = 1; is_file(__DIR__ . "/inhalt/kapitel$i.php"); $i++) {
    $chapters["kapitel$i"] = require __DIR__ . "/inhalt/kapitel$i.php";
}
