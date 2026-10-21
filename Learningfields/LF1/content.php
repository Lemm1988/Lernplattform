<?php
/**
 * LF1 – Das Unternehmen und die eigene Rolle im Betrieb beschreiben
 * Ein Kapitel pro Datei in inhalt/kapitelN.php (jeweils ein Array, siehe includes/lernfeld.php).
 */
$lf_info = [
    'description' => 'Ausbildung und eigene Rolle, Lernen und Teamarbeit, Unternehmensziele und Kennzahlen, Rechtsformen und Handelsregister, '
        . 'Aufbauorganisation und Vollmachten, Geschäftsprozesse mit EPK, Arbeitsrecht und Arbeitsschutz sowie die Präsentation des eigenen Betriebs.',
];

$chapters = [];
for ($i = 1; is_file(__DIR__ . "/inhalt/kapitel$i.php"); $i++) {
    $chapters["kapitel$i"] = require __DIR__ . "/inhalt/kapitel$i.php";
}
