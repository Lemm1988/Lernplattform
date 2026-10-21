<?php
/**
 * LF10 – Benutzerschnittstellen gestalten und entwickeln
 * Ein Kapitel pro Datei in inhalt/kapitelN.php (jeweils ein Array, siehe includes/lernfeld.php).
 */
$lf_info = [
    'description' => 'Oberflächen menschzentriert planen, nach Gestaltungsregeln entwerfen, mit Nutzern testen und mit HTML, CSS, '
        . 'JavaScript und PHP sicher, responsiv und barrierefrei umsetzen.',
];

$chapters = [];
for ($i = 1; is_file(__DIR__ . "/inhalt/kapitel$i.php"); $i++) {
    $chapters["kapitel$i"] = require __DIR__ . "/inhalt/kapitel$i.php";
}
