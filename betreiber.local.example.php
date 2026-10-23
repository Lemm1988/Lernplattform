<?php
/**
 * Vorlage: Angaben zum Betreiber für Impressum, Datenschutzerklärung, AGB und Kontaktformular.
 *
 * Auf dem Server als betreiber.local.php speichern und ausfüllen. Die echte Datei steht in .gitignore
 * und gehört nie ins Repository – sie enthält Name und Anschrift.
 */
return [
    'name' => 'Vorname Nachname',
    'strasse' => 'Straße Hausnummer',
    'ort' => 'PLZ Ort',
    'land' => 'Deutschland',
    // Empfänger für das Kontaktformular und Kontaktadresse in den Rechtstexten
    'email' => 'kontakt@example.org',
    // Zuständige Datenschutz-Aufsichtsbehörde (richtet sich nach dem Wohnsitz des Betreibers)
    'aufsicht_name' => 'Landesbeauftragte/r für den Datenschutz deines Bundeslandes',
    'aufsicht_web' => 'https://www.datenschutzkonferenz-online.de/datenschutzaufsichtsbehoerden.html',
];
