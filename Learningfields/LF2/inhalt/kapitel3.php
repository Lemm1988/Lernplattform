<?php
return [
    'title' => 'Massenspeicher: HDD, SSD, Dateisysteme, sichere Entsorgung',
    'intro' => 'Die SSD ist heute das Bauteil, das einen Arbeitsplatz am spürbarsten schneller macht. Wer Speicher auswählt, muss aber auch an Kapazitätsplanung, Lebensdauer, Partitionierung – und an das Ende denken: Alte Datenträger enthalten Daten.',
    'goals' => [
        'HDD, SATA-SSD und NVMe-SSD nach Leistung, Kosten und Einsatz vergleichen',
        'Kennwerte wie IOPS und TBW interpretieren und Lebensdauer abschätzen',
        'den Speicherbedarf mit Wachstum und Reserve berechnen',
        'MBR und GPT sowie gängige Dateisysteme unterscheiden',
        'Datenträger datenschutzgerecht löschen oder nach DIN 66399 vernichten lassen',
    ],
    'content' => <<<'INHALT'
<h6>HDD und SSD</h6>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf2/hdd-ssd.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Schematische Festplatte mit Magnetscheibe und Schreib-Lese-Arm neben einer M.2-SSD mit Controller, Cache und Flash-Chips">
  <figcaption class="figure-caption">Mechanik gegen Flash-Speicher</figcaption>
</figure>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th></th><th>HDD</th><th>SATA-SSD</th><th>NVMe-SSD (PCIe 4.0 x4)</th></tr></thead>
  <tbody>
    <tr><td>sequenziell lesen</td><td>ca. 150–280 MB/s</td><td>bis ca. 550 MB/s (Grenze von SATA)</td><td>bis ca. 7 GB/s</td></tr>
    <tr><td>Zugriffszeit</td><td>einige ms</td><td>unter 0,1 ms</td><td>unter 0,1 ms</td></tr>
    <tr><td>Bauform</td><td>3,5" / 2,5"</td><td>2,5"</td><td>M.2 (meist 2280)</td></tr>
    <tr><td>Stärke</td><td>günstig pro TB, große Kapazität</td><td>passt in ältere Geräte</td><td>schnellste Variante, kaum teurer</td></tr>
  </tbody>
</table>
<p>Für den Alltag zählen weniger die sequenziellen Spitzenwerte als <strong>IOPS</strong> (Input/Output Operations per Second) bei vielen kleinen, zufälligen Zugriffen –
genau dort sind SSDs Festplatten um ein Vielfaches überlegen. Die Haltbarkeit einer SSD gibt der Hersteller als <strong>TBW</strong> an (Terabytes Written):
Eine SSD mit 600 TBW, auf die täglich 50 GB geschrieben werden, hält rechnerisch 600.000 GB ÷ 50 GB = 12.000 Tage, also rund 33 Jahre.</p>

<h6>Speicherbedarf planen</h6>
<p>Ausgangswert ermitteln, Wachstum berücksichtigen, Reserve aufschlagen. Beispiel: 25 Beschäftigte mit je 20 GB auf dem Fileserver, Wachstum 20 % pro Jahr,
Planung für 3 Jahre, 30 % Reserve:</p>
<ul>
  <li>heute: 25 × 20 GB = 500 GB</li>
  <li>nach 3 Jahren: 500 GB × 1,2³ = 864 GB</li>
  <li>mit Reserve: 864 GB × 1,3 ≈ 1123 GB → nutzbar mindestens rund 1,2 TB, z. B. als RAID (<a href="/Learningfields/LF3/kapitel9.php">LF3 Kapitel 9</a>) plus Platz für Datensicherungen</li>
</ul>

<h6>Partitionierung und Dateisysteme</h6>
<table class="table table-sm table-bordered">
  <thead class="table-light"><tr><th></th><th>Merkmal</th></tr></thead>
  <tbody>
    <tr><td>MBR (Master Boot Record)</td><td>altes Schema: höchstens 2 TiB je Datenträger, höchstens 4 primäre Partitionen</td></tr>
    <tr><td>GPT (GUID-Partitionstabelle)</td><td>Standard mit UEFI: sehr große Datenträger, unter Windows bis 128 Partitionen, Sicherungskopie der Tabelle</td></tr>
    <tr><td>NTFS</td><td>Windows-Standard: Rechte (<a href="/Learningfields/LF3/kapitel7.php">LF3 Kapitel 7</a>), Journal, Verschlüsselung, große Dateien</td></tr>
    <tr><td>exFAT</td><td>für USB-Sticks und Speicherkarten, große Dateien, von Windows, macOS und Linux lesbar</td></tr>
    <tr><td>FAT32</td><td>sehr kompatibel, aber Dateien höchstens 4 GiB groß</td></tr>
    <tr><td>ext4</td><td>verbreitet unter Linux</td></tr>
  </tbody>
</table>

<h6>Sicher löschen und vernichten</h6>
<p>Eine gelöschte Datei ist nicht weg – nur ihr Eintrag. Bevor Datenträger das Haus verlassen (Verkauf, Leasingrückgabe, Reparatur, Entsorgung), müssen die Daten
unwiederbringlich entfernt werden:</p>
<ul>
  <li><strong>HDD</strong>: vollständig überschreiben (einmal genügt bei aktuellen Platten).</li>
  <li><strong>SSD</strong>: Überschreiben ist unzuverlässig, weil der Controller Schreibvorgänge verteilt. Richtig: der eingebaute <strong>Secure-Erase- bzw. Sanitize-Befehl</strong>
    des Herstellers – oder die SSD war von Anfang an verschlüsselt (BitLocker), dann reicht das Vernichten des Schlüssels.</li>
  <li><strong>Defekte oder sehr schutzbedürftige Datenträger</strong>: physisch vernichten lassen, mit Nachweis.</li>
</ul>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf2/din66399.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Materialklassen P, F, O, T, H und E; Matrix, welche Sicherheitsstufen 1 bis 7 je Schutzklasse zulässig sind">
  <figcaption class="figure-caption">Materialklasse, Schutzklasse und Sicherheitsstufe</figcaption>
</figure>
<p>Altgeräte selbst gehören nach dem Elektro- und Elektronikgerätegesetz (ElektroG) nicht in den Restmüll, sondern zu Rücknahmestellen oder zertifizierten Entsorgern.</p>

<h6>Übungen mit Lösung</h6>
<p>1. Ein Arbeitsplatz-PC startet mit einer Festplatte über eine Minute und reagiert träge. Was empfiehlst du?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Die HDD gegen eine SSD tauschen (NVMe, wenn ein M.2-Steckplatz vorhanden ist, sonst SATA-SSD) und das System übertragen oder neu installieren.
Das bringt meist mehr als jede andere Aufrüstung.</p>
</details>
<p>2. Ein Team hat heute 800 GB Daten, Wachstum 25 % pro Jahr, Planung für 2 Jahre plus 20 % Reserve. Wie viel Speicher wird gebraucht?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">800 GB × 1,25² = 1250 GB; × 1,2 = <strong>1500 GB</strong>, also 1,5 TB nutzbare Kapazität.</p>
</details>
<p>3. Leasing-Notebooks mit SSD gehen an den Leasinggeber zurück. Wie stellst du sicher, dass keine Kundendaten mitgehen?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Mit dem Secure-Erase-/Sanitize-Befehl löschen oder, wenn die SSDs durchgehend mit BitLocker verschlüsselt waren, die Schlüssel vernichten und das Gerät neu aufsetzen.
Den Vorgang dokumentieren. Bei Zweifeln die SSD ausbauen und nach DIN 66399 (Materialklasse E) vernichten lassen.</p>
</details>
INHALT,
    'summary' => [
        'HDD: günstig, groß, langsam beim Zugriff; SSD: schnell, leise, robust; NVMe über PCIe ist die schnellste Variante.',
        'IOPS zählen im Alltag mehr als sequenzielle Spitzenwerte; TBW beschreibt die Haltbarkeit einer SSD.',
        'Speicherbedarf = heutiger Bedarf × (1 + Wachstum)^Jahre × Reserve.',
        'GPT mit UEFI statt MBR (2 TiB, 4 Partitionen); NTFS für Windows, exFAT für Wechseldatenträger, FAT32 nur bis 4 GiB je Datei.',
        'SSDs per Secure Erase/Sanitize löschen; Vernichtung nach DIN 66399 mit Materialklasse, Schutzklasse und Sicherheitsstufe.',
    ],
    'quiz' => [
        ['question' => 'Warum ist eine SSD im Alltag so viel schneller als eine HDD?', 'answer' => 'Sie hat keine Mechanik und schafft viel mehr zufällige Zugriffe (IOPS) bei Zugriffszeiten unter 0,1 ms.'],
        ['question' => 'Wofür steht TBW?', 'answer' => 'Terabytes Written – die vom Hersteller zugesicherte Gesamtschreibmenge einer SSD.'],
        ['question' => 'Wie groß darf eine Datei auf FAT32 höchstens sein?', 'answer' => '4 GiB (genauer 4 GiB minus 1 Byte).'],
        ['question' => 'Wofür steht der Buchstabe H in „H-3“ nach DIN 66399?', 'answer' => 'Für die Materialklasse Festplatten (magnetische Festplatten); 3 ist die Sicherheitsstufe.'],
    ],
];
