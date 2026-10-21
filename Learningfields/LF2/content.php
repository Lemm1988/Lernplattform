<?php
/**
 * LF2 – Arbeitsplätze nach Kundenwunsch ausstatten
 * Ein Kapitel pro Datei in inhalt/kapitelN.php (jeweils ein Array, siehe includes/lernfeld.php).
 */
$lf_info = [
    'description' => 'Vom Kundenwunsch zum fertigen Arbeitsplatz: Aufbau eines Computers, Prozessor, RAM und Schnittstellen, Massenspeicher und Entsorgung, '
        . 'Monitor, Drucker und Ergonomie, Auswahl mit TCO und Nutzwertanalyse, Angebotsvergleich und Kalkulation, Finanzierung und Abschreibung, Beschaffung und Übergabe.',
];

$chapters = [];
for ($i = 1; is_file(__DIR__ . "/inhalt/kapitel$i.php"); $i++) {
    $chapters["kapitel$i"] = require __DIR__ . "/inhalt/kapitel$i.php";
}
