<!-- Automatisch erstellt: 2025-11-13 -->

# Vereinfachungsmöglichkeiten – Datenbank, Code & Workflow

## 1. Datenbank

| Thema | Empfehlung | Nutzen |
|-------|------------|--------|
| **Belohnungsschwellen** | Schwellenwerte (`calculate_reward_points`) in `settings` auslagern, z. B. `reward_thresholds = JSON`. | Anpassungen ohne Code-Deploy; Transparenz. |
| **Quiz-Session Cleanup** | Geplanten Job/Stored Procedure für `quiz_sessions.status = 'abandoned'` + verwaiste `user_answers` einführen. | Datenbank sauber halten, bessere Statistiken. |
| **`user_answers` Schema** | Legacy-Spalten endgültig konsolidieren (`selected_answer_id`, Verzicht auf `answer_ids`-JSON). Dokumentation anpassen. | Vermeidet Verwirrung, erleichtert Abfragen. |
| **Audit Trail** | `reward_points_audit` aktiv nutzen (Trigger in `award_quiz_rewards`). | Nachvollziehbarkeit von Punkteänderungen. |
| **Indizes prüfen** | Spezifische Indizes auf `user_answers.quiz_session_id` + `is_correct` für schnelle Auswertung. | Performance bei großen Datenmengen. |

## 2. Code & Architektur

| Bereich | Empfehlung | Nutzen |
|---------|------------|--------|
| **Zentraler Service** | `QuizService` (oder ähnlicher Manager) einführen: Start, Beenden, Ergebnisberechnung, Rewards. | Reduziert Code-Duplikate, klarere Verantwortlichkeiten. |
| **Ergebnisberechnung** | `ResultsCalculator` als Single Source of Truth nutzen (statt Berechnung in `quizes_done.php`, `quiz_details.php`). | Konsistente Zahlen, leichteres Testing. |
| **Multiple Choice Teilpunkte** | Optionale Teilpunkte einführen (`points * (korrekte Auswahl / gesamt korrekt) - falsche Auswahl Penalty`). | Feingranulare Bewertung, motivierender. |
| **Error Handling** | Einheitliche Fehlerbehandlungsschicht (z. B. `QuizException`). | Bessere Nutzer-Feedbacks, Logging zentral. |
| **Logging** | `statistics_logger.php` in Service integrieren oder ersetzen; Feature-Flag via Setting. | Vermeidet doppelte conditionals in jedem Skript. |

## 3. Workflow & UI

| Bereich | Empfehlung | Nutzen |
|---------|------------|--------|
| **Quiz-Startseite** | Klarere Optionen: „Fortsetzen“, „Neues Quiz“, „Historie“ als eigenständige Karten. | Bessere UX. |
| **Quiz-Abbruch** | Bestätigungsdialog + Hinweis „Session wird verworfen“. | Verhindert unbeabsichtigte Datenverluste. |
| **Review-Modus** | Optionaler „Feedback“-Modus (`quiz_review.php`) zusammenführen mit `quiz_details.php` (Tabs). | Weniger Dateien, einheitliche Darstellung. |
| **Statistik-Visualisierung** | KPI-Karten in `quizes_done.php` mit Zielwerten (z. B. Ziel-Bestehensquote). | Motivation, Transparenz. |

## 4. Admin-Bereich

| Bereich | Empfehlung | Nutzen |
|---------|------------|--------|
| **Settings erweitern** | - Reward-Schwellen (JSON)<br>- Teilpunkte aktivieren (Boolean)<br>- Zeitlimit pro Lernfeld (Mapping)<br>- Auto-Approval für Moderatoren | Volle Konfigurierbarkeit, weniger Code-Anpassungen. |
| **Quiz-Statistikseite** | Dashboard mit Filters (Zeitraum, Lernfeld), Export CSV/Excel. | Admin-Controlling, Reporting. |
| **Session-Management** | Liste aller Sessions (Status, Punkte, Zeit). Aktionen: „Abgebrochene löschen“, „Details ansehen“. | Aufräumen, Support-Fälle leichter bearbeitbar. |
| **Fragenverwaltung** | Bulk-Operationen (Mass Approval, Punkte anpassen), Filter (Lernfeld, Schwierigkeit). | Effizientere Moderation. |

## 5. Prozesse & Tests

| Thema | Empfehlung | Nutzen |
|-------|------------|--------|
| **Automatisierte Tests** | PHPUnit-Tests für `AnswerProcessor`, `award_quiz_rewards`, `ResultsCalculator`. | Stabilität, verhindert Regressionen. |
| **Datenmigrationen** | Skript zur Korrektur historischer Daten (`user_answers`, `quiz_sessions.total_score`). | Konsistente Basis für neue Features. |
| **Monitoring** | Fehler/Timeouts im Quiz (z. B. Zeitüberschreitungen) in Admin-Logs visualisieren. | Frühzeitiges Erkennen von Problemen. |

---

## 6. Priorisierung (Vorschlag)

1. **Kurzfristig:**  
   - Belohnungslogik konfigurierbar machen.  
   - `ResultsCalculator` zentral einsetzen.  
   - `quiz_details.php`-Bug (korrekte Antworten) beheben.

2. **Mittelfristig:**  
   - Session-Cleanup + Admin-Verwaltung.  
   - Service-Layer einführen.  
   - Statistik-/Review-Seiten konsolidieren.

3. **Langfristig:**  
   - Teilpunkte & erweiterte Auswertungen.  
   - Automatisierte Tests / CI.  
   - Tiefere UX-Optimierungen (Gamification, Ziele).

> **Hinweis:** Diese Liste dient als Grundlage für Phase 3 (Admin-Funktionen) und spätere Implementierungsphasen.


