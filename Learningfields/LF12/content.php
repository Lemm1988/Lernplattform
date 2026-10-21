<?php
/**
 * LF12 – Kundenspezifische Anwendungsentwicklung durchführen
 * Ein Kapitel pro Datei in inhalt/kapitelN.php (jeweils ein Array, siehe includes/lernfeld.php).
 */
$lf_info = [
    'description' => 'Ein Kundenprojekt von der Auftragsanalyse über Wirtschaftlichkeit, Kalkulation, Planung und Steuerung bis zur Auslieferung '
        . 'mit Git, CI/CD und Containern – mit Datenschutz, Lizenzen und der betrieblichen Projektarbeit der AP2.',
];

$chapters = [];
for ($i = 1; is_file(__DIR__ . "/inhalt/kapitel$i.php"); $i++) {
    $chapters["kapitel$i"] = require __DIR__ . "/inhalt/kapitel$i.php";
}
