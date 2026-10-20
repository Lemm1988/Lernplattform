<?php
/**
 * LF8 – Daten systemübergreifend bereitstellen
 * Ein Kapitel pro Datei in inhalt/kapitelN.php (jeweils ein Array, siehe includes/lernfeld.php).
 */
$lf_info = [
    'description' => 'Daten in guter Qualität erfassen, objektorientiert modellieren, in Datenbanken speichern und zwischen '
        . 'Systemen austauschen – mit UML, Java, SQL, NoSQL, JSON/XML und sauberen Tests.',
];

$chapters = [];
for ($i = 1; is_file(__DIR__ . "/inhalt/kapitel$i.php"); $i++) {
    $chapters["kapitel$i"] = require __DIR__ . "/inhalt/kapitel$i.php";
}
