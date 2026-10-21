<?php
/**
 * LF7 – Cyber-physische Systeme ergänzen
 * Ein Kapitel pro Datei in inhalt/kapitelN.php (jeweils ein Array, siehe includes/lernfeld.php).
 */
$lf_info = [
    'description' => 'Aufbau cyber-physischer Systeme, Steuerung und Regelung, Sensoren und A/D-Wandlung, Mikrocontroller und GPIO, PWM, '
        . 'serielle Schnittstellen (UART, USB, I²C, SPI), IoT-Funk und MQTT, Software mit Zustandsautomaten und Energiebilanz '
        . 'sowie Sicherheit und Betrieb vernetzter Systeme.',
];

$chapters = [];
for ($i = 1; is_file(__DIR__ . "/inhalt/kapitel$i.php"); $i++) {
    $chapters["kapitel$i"] = require __DIR__ . "/inhalt/kapitel$i.php";
}
