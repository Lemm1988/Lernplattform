<?php
return [
    'title' => 'Wie ein Computer arbeitet',
    'intro' => 'Wer Arbeitsplätze ausstattet, muss wissen, was in einem Rechner passiert: wie Daten verarbeitet werden, welche Bauteile zusammenspielen und was beim Einschalten geschieht. Ganz unten stehen dabei einfache Logikgatter.',
    'goals' => [
        'das EVA-Prinzip an Beispielen erklären',
        'den Aufbau der Von-Neumann-Architektur beschreiben',
        'die wichtigsten Bauteile eines Mainboards benennen',
        'den Startvorgang mit UEFI erklären',
        'die Grundgatter UND, ODER, NICHT, XOR und NAND mit Wahrheitstabellen anwenden',
    ],
    'content' => <<<'INHALT'
<h6>EVA und Von Neumann</h6>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf2/von-neumann.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Oben Eingabe, Verarbeitung, Ausgabe, Speicherung; darunter CPU mit Steuerwerk, Rechenwerk und Registern, Arbeitsspeicher und Ein-/Ausgabewerk am gemeinsamen Bus">
  <figcaption class="figure-caption">Vom Grundprinzip zur Architektur</figcaption>
</figure>
<p>Fast jede Datenverarbeitung folgt dem <strong>EVA-Prinzip</strong>: Eingabe, Verarbeitung, Ausgabe – ergänzt um die Speicherung. Die <strong>Von-Neumann-Architektur</strong>
beschreibt, wie ein Rechner das umsetzt. Die CPU arbeitet einen Befehl nach dem anderen ab: Das Steuerwerk <em>holt</em> den Befehl aus dem Speicher, <em>dekodiert</em> ihn,
das Rechenwerk <em>führt ihn aus</em>, das Ergebnis wird <em>zurückgeschrieben</em>. Die <strong>Taktfrequenz</strong> gibt an, wie viele Takte pro Sekunde ablaufen (z. B. 4 GHz =
4 Milliarden). Bei der <strong>Harvard-Architektur</strong> haben Befehle und Daten getrennte Speicher und Busse – üblich in Mikrocontrollern und innerhalb der CPU-Caches.</p>

<h6>Das Mainboard</h6>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th>Bauteil</th><th>Aufgabe</th></tr></thead>
  <tbody>
    <tr><td>CPU-Sockel</td><td>nimmt den Prozessor auf; Sockel und Chipsatz bestimmen, welche CPUs passen</td></tr>
    <tr><td>Chipsatz</td><td>verbindet CPU mit Schnittstellen und Erweiterungen, legt Zahl der USB-, SATA- und PCIe-Anschlüsse fest</td></tr>
    <tr><td>RAM-Steckplätze</td><td>Arbeitsspeicher; bei zwei Modulen im passenden Paar arbeitet er im schnelleren Dual-Channel-Modus</td></tr>
    <tr><td>PCI-Express-Steckplätze</td><td>Erweiterungskarten wie Grafik oder Netzwerk; Bandbreite wächst mit Generation und Zahl der Lanes (x1, x4, x16)</td></tr>
    <tr><td>M.2 und SATA</td><td>Anschlüsse für SSDs und Festplatten (Kapitel 3)</td></tr>
    <tr><td>UEFI-Firmware</td><td>startet den Rechner, prüft die Hardware, lädt das Betriebssystem</td></tr>
    <tr><td>Spannungsversorgung, Anschlussblende</td><td>Strom vom Netzteil; außen USB, Netzwerk, Audio, Grafik</td></tr>
  </tbody>
</table>

<h6>Was beim Einschalten passiert</h6>
<ol>
  <li>Das Netzteil meldet stabile Spannungen, die CPU startet die <strong>UEFI-Firmware</strong> (Nachfolger des BIOS).</li>
  <li>Der <strong>POST</strong> (Power-On Self Test) prüft CPU, RAM und wichtige Hardware; Fehler zeigen sich als Piepcodes oder LED-Codes.</li>
  <li>UEFI sucht anhand der Bootreihenfolge einen Bootloader auf einem Datenträger (Partitionsschema GPT) und startet ihn.
    <strong>Secure Boot</strong> prüft dabei, ob der Bootloader signiert ist – das blockiert Schadsoftware, die sich vor dem Betriebssystem einnisten will.</li>
  <li>Der Bootloader lädt den Betriebssystemkern, der Treiber und Dienste startet und die Anmeldung anbietet.</li>
</ol>
<p>Windows 11 setzt UEFI mit Secure Boot und ein <strong>TPM 2.0</strong> voraus – einen Sicherheitschip, der Schlüssel etwa für die Laufwerksverschlüsselung BitLocker schützt.
Das ist bei der Auswahl älterer Hardware ein K.-o.-Kriterium.</p>

<h6>Logikgatter</h6>
<p>Ganz unten rechnet ein Computer mit zwei Zuständen: 0 und 1. Daraus bauen <strong>Gatter</strong> alle Funktionen auf. In deutschen Prüfungen werden meist die Schaltzeichen
nach DIN EN 60617 verwendet:</p>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf2/logikgatter.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Schaltzeichen und Wahrheitstabellen für UND, ODER, NICHT, XOR und NAND">
  <figcaption class="figure-caption">Fünf Grundgatter und ihre Wahrheitstabellen</figcaption>
</figure>
<div class="lf-merke"><strong>Merke:</strong> UND ist nur 1, wenn alle Eingänge 1 sind. ODER ist 1, sobald mindestens einer 1 ist. XOR ist 1, wenn die Eingänge
<em>verschieden</em> sind. Ein Kreis am Ausgang kehrt das Ergebnis um. XOR begegnet dir wieder bei Verschlüsselung (<a href="/Learningfields/LF4/kapitel7.php">LF4</a>) und RAID-Parität (<a href="/Learningfields/LF3/kapitel9.php">LF3</a>).</div>

<h6>Übungen mit Lösung</h6>
<p>1. Ordne dem EVA-Prinzip zu: Barcodescanner an der Kasse, Bondrucker, Kassensoftware berechnet die Summe, Umsatz wird in der Datenbank abgelegt.</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Eingabe: Barcodescanner. Verarbeitung: Kassensoftware. Ausgabe: Bondrucker. Speicherung: Datenbank.</p>
</details>
<p>2. Ein Halbaddierer addiert zwei Bits A und B. Welche Werte haben Summe (A XOR B) und Übertrag (A UND B) für A = 1, B = 1?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Summe: 1 XOR 1 = 0. Übertrag: 1 UND 1 = 1. Ergebnis binär 10 = dezimal 2 – also 1 + 1 = 2.</p>
</details>
<p>3. Ein Kunde möchte auf einem acht Jahre alten PC Windows 11 installieren. Welche Voraussetzungen prüfst du?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Unterstützte CPU, UEFI mit Secure Boot, TPM 2.0, mindestens 4 GB RAM und 64 GB Speicher. Fehlen TPM 2.0 oder eine unterstützte CPU, ist ein neues Gerät die saubere Lösung.</p>
</details>
INHALT,
    'summary' => [
        'EVA: Eingabe, Verarbeitung, Ausgabe, dazu Speicherung.',
        'Von Neumann: CPU (Steuerwerk, Rechenwerk, Register), gemeinsamer Speicher für Programme und Daten, E/A-Werk, Bussystem.',
        'Mainboard: Sockel, Chipsatz, RAM-Slots, PCIe, M.2/SATA, UEFI.',
        'Start: UEFI → POST → Bootloader (Secure Boot) → Betriebssystem; Windows 11 braucht TPM 2.0.',
        'Gatter: UND, ODER, NICHT, XOR, NAND; Kreis am Ausgang bedeutet Negation.',
    ],
    'quiz' => [
        ['question' => 'Wofür steht EVA?', 'answer' => 'Eingabe, Verarbeitung, Ausgabe.'],
        ['question' => 'Aus welchen Teilen besteht die CPU nach Von Neumann?', 'answer' => 'Steuerwerk, Rechenwerk (ALU) und Register.'],
        ['question' => 'Was ergibt 1 XOR 1?', 'answer' => '0 – XOR ist nur 1, wenn die Eingänge verschieden sind.'],
        ['question' => 'Was prüft Secure Boot?', 'answer' => 'Ob der Bootloader digital signiert und damit vertrauenswürdig ist.'],
    ],
];
