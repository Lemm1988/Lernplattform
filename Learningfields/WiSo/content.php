<?php
/**
 * WiSo – Wirtschafts- und Sozialkunde (Prüfungsbereich der Abschlussprüfung Teil 2)
 * Ein Kapitel pro Datei in inhalt/kapitelN.php (jeweils ein Array, siehe includes/lernfeld.php).
 */
$lf_info = [
    'description' => 'Prüfungsvorbereitung für den Prüfungsbereich Wirtschafts- und Sozialkunde: Rechtsquellen, Arbeitsvertrag und Kündigungsschutz, '
        . 'Tarifverträge, Betriebsrat und Mitbestimmung, Entgeltabrechnung und Sozialversicherung 2026, Verträge und Vertragsstörungen, '
        . 'Markt und Wirtschaftspolitik sowie Nachhaltigkeit und Wandel der Arbeitswelt.',
];

$chapters = [];
for ($i = 1; is_file(__DIR__ . "/inhalt/kapitel$i.php"); $i++) {
    $chapters["kapitel$i"] = require __DIR__ . "/inhalt/kapitel$i.php";
}
