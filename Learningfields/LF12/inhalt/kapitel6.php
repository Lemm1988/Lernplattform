<?php
return [
    'title' => 'Versionsverwaltung mit Git',
    'intro' => 'Ohne Versionsverwaltung kein Teamprojekt: Git speichert jede Änderung nachvollziehbar, erlaubt paralleles Arbeiten in Branches und macht Fehler rückgängig.',
    'goals' => [
        'Arbeitsverzeichnis, Staging-Bereich, lokales und entferntes Repository unterscheiden',
        'Commits erstellen und den Verlauf lesen',
        'mit Branches, Pull Requests und Merges im Team arbeiten und Konflikte auflösen',
        'Dateien mit .gitignore ausschließen, Versionen markieren und Änderungen zurücknehmen',
    ],
    'content' => <<<'INHALT'
<h6>Warum Versionsverwaltung?</h6>
<p>Dateinamen wie <code>index_final_v3_wirklich.php</code> und Code per Mail funktionieren schon bei zwei Personen nicht mehr. Ein <strong>Versionsverwaltungssystem</strong>
speichert jede Änderung mit Autor, Zeitpunkt und Beschreibung, erlaubt paralleles Arbeiten und das Zurückgehen zu jedem früheren Stand. <strong>Git</strong> ist
<em>verteilt</em>: Jede Kopie (Klon) enthält die komplette Geschichte; man kann auch offline committen.</p>

<h6>Die vier Bereiche</h6>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf12/git-bereiche.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Arbeitsverzeichnis, Staging-Bereich, lokales und entferntes Repository mit den Befehlen add, commit, push, pull und restore">
  <figcaption class="figure-caption">Änderungen wandern mit add, commit und push nach rechts – mit pull kommen die der anderen zurück</figcaption>
</figure>
<pre class="bg-light border rounded p-3"><code>git init -b main                   # neues Repository mit Branch "main"
git status --short                 # was hat sich geändert?
?? .gitignore
?? index.php
git add .                          # alle Änderungen vormerken (Staging)
git commit -m "Startseite angelegt"
git log --oneline                  # Verlauf, eine Zeile pro Commit
35bb2a3 Startseite angelegt</code></pre>
<p>Ein <strong>Commit</strong> ist ein Schnappschuss mit eindeutiger Prüfsumme (Hash) und Nachricht. Gute Commit-Nachrichten sagen im Imperativ oder knapp, <em>was</em>
und <em>warum</em> geändert wurde („Erinnerungsmail einen Tag vorher versenden“) – nicht „Änderungen“ oder „fix“.</p>

<h6>Was nicht ins Repository gehört: .gitignore</h6>
<pre class="bg-light border rounded p-3"><code># .gitignore
config.local.php      # Zugangsdaten
*.log                 # Logdateien (können personenbezogene Daten enthalten)
vendor/               # Abhängigkeiten, die Composer nachlädt</code></pre>
<p>Im Test erscheint <code>config.local.php</code> nach dem Anlegen gar nicht erst in <code>git status</code>. Passwörter, API-Schlüssel und Logs mit IP-Adressen
haben in einem Repository nichts verloren – erst recht nicht in einem öffentlichen. Einmal veröffentlichte Geheimnisse gelten als kompromittiert: Schlüssel
sofort austauschen; das spätere Entfernen aus der Geschichte (z. B. mit <code>git filter-repo</code>) ändert alle Hashes und muss mit dem Team abgestimmt werden.</p>

<h6>Branches, Pull Requests und Merge</h6>
<figure class="figure w-100">
  <img src="/assets/img/lernfelder/lf12/git-branches.svg" class="figure-img img-fluid w-100" style="max-width: 760px"
       alt="Branch main mit zwei Commits, abzweigender Feature-Branch mit einem Commit, Rückführung per Pull Request und Merge-Commit, Tag v1.0.0">
  <figcaption class="figure-caption">Neue Funktionen entstehen in eigenen Branches und kommen geprüft zurück</figcaption>
</figure>
<p>Ein <strong>Branch</strong> ist eine eigene Entwicklungslinie. Üblicher Ablauf im Team (Feature-Branch-Workflow):</p>
<pre class="bg-light border rounded p-3"><code>git switch -c feature/erinnerung   # neuen Branch anlegen und wechseln
# … programmieren …
git commit -am "Erinnerungshinweis"
git push -u origin feature/erinnerung
# auf GitHub/GitLab: Pull Request (Merge Request) öffnen → Code-Review, automatische Tests
git switch main
git pull                           # neuesten Stand holen
git merge feature/erinnerung       # zusammenführen</code></pre>
<p>Haben beide Seiten <strong>dieselben Zeilen</strong> geändert, kann Git nicht automatisch entscheiden und meldet einen <strong>Konflikt</strong>:</p>
<pre class="bg-light border rounded p-3"><code>CONFLICT (content): Merge conflict in index.php

&lt;?php
&lt;&lt;&lt;&lt;&lt;&lt;&lt; HEAD
echo "Termine buchen";           ← Stand auf main
=======
echo "Termine";                  ← Stand im Feature-Branch
echo "Erinnerung aktiv";
&gt;&gt;&gt;&gt;&gt;&gt;&gt; feature/erinnerung</code></pre>
<p>Auflösen heißt: die Datei so bearbeiten, wie sie richtig ist (hier: neue Überschrift <em>und</em> Erinnerungshinweis), die Markierungen entfernen, dann
<code>git add index.php</code> und <code>git commit</code>. Danach zeigt <code>git log --oneline --graph</code>:</p>
<pre class="bg-light border rounded p-3"><code>*   Merge feature/erinnerung
|\
| * Erinnerungshinweis
* | Überschrift geändert
|/
* Startseite angelegt</code></pre>

<h6>Versionen markieren und Fehler rückgängig machen</h6>
<ul>
  <li><code>git tag v1.0.0</code> markiert einen Stand als Version. Nach <strong>Semantic Versioning</strong> bedeutet MAJOR.MINOR.PATCH: inkompatible Änderung →
  MAJOR, neue Funktion → MINOR, Fehlerkorrektur → PATCH (1.0.0 → 1.1.0 → 1.1.1).</li>
  <li><code>git revert &lt;commit&gt;</code> erzeugt einen <em>neuen</em> Commit, der die Änderung umkehrt – sicher, auch wenn andere den Commit schon haben.</li>
  <li><code>git restore datei.php</code> verwirft ungespeicherte Änderungen im Arbeitsverzeichnis; <code>git restore --staged</code> nimmt eine Datei aus dem Staging.</li>
  <li><code>git reset --hard</code> und <code>git push --force</code> schreiben Geschichte um und können fremde Arbeit vernichten – nur mit Absprache.</li>
</ul>
<div class="lf-merke"><strong>Merke:</strong> Kleine Commits mit klaren Nachrichten, für jede Aufgabe ein Branch, Zusammenführung per Pull Request mit Review – und keine
Geheimnisse im Repository.</div>

<h6>Übungen mit Lösung</h6>
<p>1. Du hast <code>index.php</code> geändert und <code>git add index.php</code> ausgeführt. Was fehlt, damit die Kollegen die Änderung sehen?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2"><code>git commit -m "…"</code> (ins lokale Repository) und <code>git push</code> (ins entfernte Repository).</p>
</details>
<p>2. Ein Kollege hat versehentlich eine Datei mit Datenbankpasswort in ein öffentliches Repository gepusht. Was ist zu tun?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2">Zuerst das Passwort <strong>ändern</strong> – es gilt als bekannt. Dann die Datei in <code>.gitignore</code> eintragen, aus dem Repository entfernen
und in Absprache mit dem Team aus der Geschichte tilgen. Künftig Zugangsdaten nur in nicht versionierten Konfigurationsdateien oder Umgebungsvariablen halten.</p>
</details>
<p>3. Version 2.3.1 bekommt eine neue, abwärtskompatible Exportfunktion. Wie lautet die nächste Versionsnummer?</p>
<details class="mb-3"><summary>Lösung anzeigen</summary>
<p class="mt-2"><strong>2.4.0</strong> – neue Funktion erhöht MINOR, PATCH beginnt wieder bei 0.</p>
</details>
INHALT,
    'summary' => [
        'Git ist verteilt: Arbeitsverzeichnis → add → Staging → commit → lokales Repository → push → entferntes Repository; pull holt Änderungen.',
        'Commits sind Schnappschüsse mit Hash und aussagekräftiger Nachricht.',
        '.gitignore schließt Zugangsdaten, Logs und Abhängigkeiten aus; veröffentlichte Geheimnisse sofort austauschen.',
        'Feature-Branch → Pull Request mit Review und Tests → Merge; Konflikte von Hand auflösen, dann add und commit.',
        'Tags und Semantic Versioning (MAJOR.MINOR.PATCH); revert statt Geschichte umschreiben.',
    ],
    'quiz' => [
        ['question' => 'Was macht git add?', 'answer' => 'Es merkt Änderungen im Staging-Bereich für den nächsten Commit vor.'],
        ['question' => 'Wann entsteht ein Merge-Konflikt?', 'answer' => 'Wenn beide Branches dieselben Zeilen einer Datei unterschiedlich geändert haben und Git nicht automatisch entscheiden kann.'],
        ['question' => 'Warum ist git revert in geteilten Branches sicherer als git reset --hard?', 'answer' => 'revert erzeugt einen neuen Commit, der die Änderung umkehrt; die Geschichte bleibt erhalten. reset schreibt die Geschichte um und kann bei anderen zu Problemen und Datenverlust führen.'],
        ['question' => 'Wofür steht in Version 3.2.7 die 7?', 'answer' => 'Für die PATCH-Version: Fehlerkorrekturen ohne neue Funktionen (Semantic Versioning).'],
    ],
];
