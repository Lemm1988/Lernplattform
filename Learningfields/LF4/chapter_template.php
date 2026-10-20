<?php
// Gemeinsame Kapitelvorlage: includes/lernfeld.php
if (!isset($chapterKey)) {
    http_response_code(404);
    exit('Kapitel nicht gefunden.');
}
require_once __DIR__ . '/../../includes/lernfeld.php';
render_lernfeld_chapter(basename(__DIR__), $chapterKey);
