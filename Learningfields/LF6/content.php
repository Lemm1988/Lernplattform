<?php
/**
 * LF6 – Serviceanfragen bearbeiten
 * Ein Kapitel pro Datei in inhalt/kapitelN.php (jeweils ein Array, siehe includes/lernfeld.php).
 */
$lf_info = [
    'description' => 'Serviceanfragen professionell bearbeiten: IT-Service-Management, Support-Level und Tickets, Incident, Problem und Change, '
        . 'Priorisierung und SLA, Kundenkommunikation, Fehleranalyse und Fernwartung, Gewährleistung und Verträge, Wissensdatenbank und Schulung.',
];

$chapters = [];
for ($i = 1; is_file(__DIR__ . "/inhalt/kapitel$i.php"); $i++) {
    $chapters["kapitel$i"] = require __DIR__ . "/inhalt/kapitel$i.php";
}
