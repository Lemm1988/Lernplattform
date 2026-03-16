<!-- Automatisch erstellt: 2025-11-13 -->

# Identifizierte Inkonsistenzen & Risikobereiche

## 1. Berechnungen & Statistiken

| Bereich | Beobachtung | Quelle |
|---------|-------------|--------|
| **Korrekte Antworten** | `quiz/quiz_details.php` interpretiert `quiz_sessions.total_score` als Anzahl korrekt beantworteter Fragen (`$quiz['correct_answers'] = $quiz['total_score'];`). Tatsächlich enthält das Feld die Summe der Punkte. | `quiz_details.php`, Zeilen 49–52 |
| **Bestehensgrenze** | - `quizes_done.php` & `start_quiz.php` nutzen inzwischen das Setting `passing_score_percentage`.<br>- `classes/ResultsCalculator::formatResultsForDisplay()` verwendet weiterhin die Konstante `PASSING_SCORE_PERCENTAGE` (Fallback 60 %). | `includes/functions.php`, `classes/ResultsCalculator.php` |
| **Max Score** | `start_quiz.php` berechnet `max_score` als Summe aller Fragepunkte (korrekt). Diverse Auswertungen (z. B. ältere SQL-Queries) nehmen implizit 60 Fragen × 1 Punkt an. Überprüfung sämtlicher Verwendungen notwendig. | `quiz/start_quiz.php`, `docs/Statistiken und deren Berechnungen.md` |
| **Ø-Score / Bestehensquote** | Bis vor kurzem unterschiedliche Formeln (Fixwert 60 % vs. Settings). Nach Anpassungen prüfen, ob alle Admin-Reports (`get_quiz_stats`, `get_detailed_quiz_statistics`) inzwischen einheitlich rechnen. | `quiz/start_quiz.php`, `includes/functions.php` |
| **Multiple Choice Punkte** | Bewertung weiterhin „alles oder nichts“. Keine Teilpunkte, obwohl DB (points) höhere Werte zulässt. Business-Vorgabe klären. | `classes/AnswerProcessor.php` |

## 2. Datenmodell & Nutzung

| Bereich | Beobachtung | Quelle |
|---------|-------------|--------|
| **`user_answers` Schema** | Tabellenbeschreibung (aktuelle Struktur) verwendet `selected_answer_id`; ältere Codepfade (Legacy) erwarteten `answer_id`/`answer_ids`. Sämtliche Abfragen prüfen, ob neues Schema komplett ausgerollt ist. | `Datenbankstruktur.txt`, Code-Review |
| **`quiz_sessions.questions_json`** | Wird zur Frage-Reihenfolge genutzt. In `quiz_details.php` werden Fragen über `user_answers` geladen → Reihenfolge kann von Original-JSON abweichen (Sortierung nach `answered_at`). | `quiz_details.php` |
| **Abgebrochene Sessions** | `start_quiz.php` setzt Status `abandoned`, aber es existiert kein sichtbarer Cleanup im Admin-Bereich. Datenbank wächst langfristig an. | `quiz/start_quiz.php` |
| **Belohnungswerte** | Schwellenwerte für IT-Coins fest im Code (`calculate_reward_points`). Keine Tabelle/Settings → Änderungen nur via Code möglich. | `includes/functions.php` |
| **Audit-Logs** | `reward_points_audit` vorhanden, aber aktuelle Anwendung unklar. Prüfen, ob `award_quiz_rewards` Einträge erzeugt (derzeit nein). | `Datenbankstruktur.txt`, `includes/functions.php` |

## 3. Admin- & User-Interface

| Bereich | Beobachtung | Quelle |
|---------|-------------|--------|
| **Admin-Settings** | Quiz-spezifische Settings (Belohnungsschwellen, Teilpunkte, Lernfeld-spezifische Limits) fehlen. Anpassungen nur via Code oder DB möglich. | `admin/settings.php` |
| **Statistikseiten** | Keine dedizierte Admin-Seite für detaillierte Quiz-Statistiken/Sitzungsverwaltung. Aktuelle Auswertungen zersplittert (Dashboard + Benutzeransicht). | `admin/dashboard.php`, Fehlen eigener Seiten |
| **Review-Ansicht** | Konsistenz der Multiple-Choice-Anzeige in `quiz_review.php` abhängig von `user_answer_selections`. Umfangreiche Tests nötig (insbesondere bei historischen Sessions ohne Selections). | `quiz/quiz_review.php` |

## 4. Logging & Fehlerbehandlung

| Bereich | Beobachtung | Quelle |
|---------|-------------|--------|
| **Fehlende Try/Catch** | `quiz_session.php` fängt Exceptions von `AnswerProcessor` teilweise ab, aber Rückmeldungen erfolgen über `set_error_message`. Prüfen, ob alle Exceptions sauber abgefangen werden (z. B. DB-Verbindungsfehler). | `quiz/quiz_session.php` |
| **Doppelte Logs** | `log_user_activity` + `statistics_logger.php` (optional). Klar definieren, welches Logging aktiv sein soll, um redundante Einträge zu vermeiden. | Diverse Dateien |

## 5. Zusammenfassung der wichtigsten Risiken

1. **Fehlinterpretation von `total_score`** → führt zu falschen Statistiken (korrekte Antworten, Bestehensquote) in bestimmten Sichten.
2. **Konfigurierbarkeit** → Änderungen an Schwellenwerten (IT-Coins, Punkte) nur via Code möglich.
3. **Datenkonsistenz** → Unterschiedliche Datenquellen (JSON vs. DB-Joins) können zu divergierenden Reihenfolgen/Anzeigeproblemen führen.
4. **Legacy-Strukturen** → `ResultsCalculator` & alte Felder/Constants benötigen Abgleich mit aktuellem Workflow.

> **Empfehlung:** Diese Liste in Phase 2 als Grundlage verwenden, um konkrete Maßnahmen (Refactoring, Settings-Erweiterungen, Cleanup-Skripte) abzuleiten.


