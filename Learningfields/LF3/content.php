<?php
/**
 * LF3 – Clients in Netzwerke einbinden
 * Ein Kapitel pro Datei in inhalt/kapitelN.php (jeweils ein Array, siehe includes/lernfeld.php).
 */
$lf_info = [
    'description' => 'Grundlagen für den Netzwerkalltag: Netzarten und Topologien, OSI- und TCP/IP-Modell, Übertragungstechnik und Ethernet, WLAN, '
        . 'Netzwerkkomponenten, IP-Konfiguration am Client, Domäne und Freigaben, Übertragungsdauer berechnen, RAID und USV.',
];

$chapters = [];
for ($i = 1; is_file(__DIR__ . "/inhalt/kapitel$i.php"); $i++) {
    $chapters["kapitel$i"] = require __DIR__ . "/inhalt/kapitel$i.php";
}
