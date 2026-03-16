# Interne Inhalte für entfernte Fremdverlinkungen

| Seite / Datei | Bereich | Benötigter Eigeninhalt | Geplanter Speicherort / Verlinkung |
| --- | --- | --- | --- |
| `scrum_page_template.php` (Fallback-Sidebar) | Ressourcenkarte, wenn Seite keine eigenen Cards mitbringt | Eigene Kurzfassung des Scrum Guide 2020 mit Download-Hinweisen, damit die Standardkarte auf interne Inhalte verweist | Neue Seite `Learningfields/Scrum/resources/scrum-guide-zusammenfassung.php` und Link innerhalb der Default-Sidebar |
| `product_owner_rolle.php` | Sidebar „Weiterführende Ressourcen“ | Kompakte „Product-Owner-Checkliste“ (PDF/Webseite) mit Kernaussagen aus dem Scrum Guide | Neue Ressource `Learningfields/Scrum/resources/product-owner-guide.php`, anschließend in der Sidebar verlinken |
| `developers_rolle.php` | Sidebar „Lesetipps“ | Eigenes „Developers Spickzettel“-Dokument mit Commitments, Rechten und Pflichten | Neue Ressource `Learningfields/Scrum/resources/developers-guide.php` und Link im Lesetipps-Block |
| `scrum_events.php` | Sidebar „Event-Ressourcen“ | Interner „Scrum Events Überblick“ (Poster oder HTML) mit Timeboxen, Agenda und Outcomes | Neue Datei `Learningfields/Scrum/resources/scrum-events-referenz.php`, dort verlinken |
| `scrum_artefakte.php` | Sidebar „Artefakt-Ressourcen“ | Eigene Artefakt-Matrix inkl. Commitments, Verantwortlichen und Beispielen | Neue Datei `Learningfields/Scrum/resources/artefakte-uebersicht.php`, Link in der Sidebar ergänzen |
| `schaetzung_velocity.php` | Sidebar „Werkzeuge & Guides“ | Schritt-für-Schritt-Anleitung zu Planning Poker (inkl. Karten-Deck, Moderationstipps) | Neue Ressource `Learningfields/Scrum/resources/planning-poker-guide.php`, Link einfügen |
| `monitoring_metriken.php` | Sidebar „Dashboards & Tools“ | Reproduzierbare Burndown/Burnup-Vorlage (z. B. Excel) plus Anleitung zur Nutzung | Template im Ordner `Learningfields/Scrum/assets/burndown-template.xlsx` + begleitende Seite `resources/monitoring-dashboards.php` |
| `skalierbare_agile_methoden.php` | Sidebar „Framework-Ressourcen“ | (a) Eigene LeSS-Zusammenfassung, (b) Nexus-Integration-Handout | Neue Seiten `resources/less-overview.php` und `resources/nexus-guide.php`, beide im Ressourcenblock verlinken |
| `weitere_agile_methoden.php` | Sidebar „Methoden-Links“ | Drei interne Infoblätter: (a) Crystal Family Überblick, (b) DSDM/AgileBA Kurzeinführung, (c) Kanban Guide (DE) | Dateien `resources/crystal-overview.php`, `resources/dsdm-guide.php`, `resources/kanban-guide.php`, anschließend im Methoden-Block verlinken |
| `extreme_programming.php` | Sidebar „XP-Ressourcen“ | XP-Grundlagenartikel + Poster mit 12 Kernpraktiken, um Ron Jeffries/Martin Fowler-Links zu ersetzen | Seiten `resources/xp-grundlagen.php` und `resources/xp-practices-poster.php`, Linkliste wieder aktivieren |

> Hinweis: Die Ressourcen können auch als PDFs umgesetzt werden. Wichtig ist, dass sie im Projekt (z. B. im neuen Unterordner `Learningfields/Scrum/resources/`) liegen, damit alle bisherigen Verlinkungen wieder aktiviert werden können, ohne externe Domains zu verwenden.

