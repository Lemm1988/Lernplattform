<?php
/**
 * LF4 – Schutzbedarfsanalyse im eigenen Arbeitsbereich durchführen
 * Ein Kapitel pro Datei in inhalt/kapitelN.php (jeweils ein Array, siehe includes/lernfeld.php).
 */
$lf_info = [
    'description' => 'Informationssicherheit und Datenschutz im eigenen Arbeitsbereich: Schutzziele, Verantwortung und Recht, IT-Grundschutz, '
        . 'Schutzbedarfsfeststellung, Bedrohungen und Risiken, technische und organisatorische Maßnahmen, Kryptografie und DSGVO.',
];

$chapters = [];
for ($i = 1; is_file(__DIR__ . "/inhalt/kapitel$i.php"); $i++) {
    $chapters["kapitel$i"] = require __DIR__ . "/inhalt/kapitel$i.php";
}
