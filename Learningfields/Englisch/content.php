<?php
/**
 * IT-Fachenglisch – Querschnittsthema für Ausbildung, Abschlussprüfung und Berufsalltag
 * Ein Kapitel pro Datei in inhalt/kapitelN.php (jeweils ein Array, siehe includes/lernfeld.php).
 */
$lf_info = [
    'description' => 'Englische Fachtexte sicher lesen und schreiben: Lesestrategien und False Friends, IT-Fachwortschatz, Datenblätter und '
        . 'Fehlermeldungen, E-Mails, Bug Reports und Commit-Messages, Grammatik für technische Texte sowie Stand-ups, Support-Telefonate und User Stories.',
];

$chapters = [];
for ($i = 1; is_file(__DIR__ . "/inhalt/kapitel$i.php"); $i++) {
    $chapters["kapitel$i"] = require __DIR__ . "/inhalt/kapitel$i.php";
}
