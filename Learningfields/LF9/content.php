<?php
/**
 * LF9 – Netzwerke und Dienste bereitstellen
 * Ein Kapitel pro Datei in inhalt/kapitelN.php (jeweils ein Array, siehe includes/lernfeld.php).
 */
$lf_info = [
    'description' => 'Netzwerke planen und betreiben: Verkabelung, Switching und VLANs, IPv4-Subnetting, IPv6, Routing und NAT, '
        . 'Dienste wie DNS und DHCP, Firewall, DMZ und VPN sowie ein Linux-Server mit SSH und Apache.',
];

$chapters = [];
for ($i = 1; is_file(__DIR__ . "/inhalt/kapitel$i.php"); $i++) {
    $chapters["kapitel$i"] = require __DIR__ . "/inhalt/kapitel$i.php";
}
