<!-- Automatisch erstellt: 2025-11-13 -->

# Quiz-Workflow – Von Start bis Auswertung

Dieses Dokument beschreibt den aktuellen Ablauf (Stand 13.11.2025) basierend auf den Dateien in `quiz/`, den Klassen in `classes/` sowie Hilfsfunktionen in `includes/functions.php`.

---

## 1. Übersicht

```
start_quiz.php
   │  (bestehende Session?) ──► quiz_session.php
   │                                   │
   │                                   ▼
   └─► quiz_session.php ──► user_answers / user_answer_selections
                                       │
                                       ▼
                                   Abschluss
                                       │
                                       ▼
                              quizes_done.php
                                       │
                                       ├─► award_quiz_rewards()
                                       └─► quiz_details.php / quiz_review.php
```

---

## 2. Phase „Quiz-Start“ (`quiz/start_quiz.php`)

### 2.1 Vorbereitung
- Lädt systemweite Einstellungen über `get_setting`:
  - `quiz_questions_count`, `quiz_time_limit`, `passing_score_percentage`, `points_per_question`.
- Prüft, ob eine laufende Session (`status IN ('started','paused')`) existiert und bietet Fortsetzung/Abbruch.
- Listet verfügbare Lernfelder (`learning_fields`, nur `is_active = 1` und mit genehmigten Fragen).

### 2.2 Neues Quiz starten
1. **Validierung**:
   - Lernfeld-ID Pflicht (außer „Alle“).
   - Fragenanzahl zwischen 10 und 100.
   - Verfügbarkeit ausreichender Fragen (nur `questions.is_approved = 1`).
2. **Fragenauswahl**:
   - Zufällige ID-Liste (`questions_json`), wahlweise gefiltert nach Lernfeld.
3. **Session-Anlage**:
   ```sql
   INSERT INTO quiz_sessions
     (user_id, learning_field_id, total_questions, max_score, started_at, questions_json)
   ```
   - `max_score` = Summe aller Punkte der ausgewählten Fragen.
4. **Logging**:
   - `log_user_activity(user_id, 'quiz_started', ...)`.
   - Optional `includes/statistics_logger.php` für erweiterte Statistiken.
5. **Weiterleitung** nach `quiz_session.php`.

### 2.3 Abbruch
- Aktion `abort_quiz`: setzt `quiz_sessions.status = 'abandoned'` + Logging.

---

## 3. Phase „Quiz-Durchführung“ (`quiz/quiz_session.php`)

### 3.1 Session-Prüfung
- Sicherheitschecks: Session existiert, gehört dem User, Status `started`.
- Lädt `questions_json` und ermittelt nächste unbeantwortete Frage (Vergleich mit `user_answers`).

### 3.2 Zeitlimit
- `quiz_time_limit` (Sekunden) via Setting.
- Prüft Restzeit; bei Ablauf: Status `completed`, `completed_at = NOW()` → Redirect Ergebnissseite.

### 3.3 Fragen-Rendering
- Lädt Frage + `answer_options`.
- Nutzt Klassen:
  - `QuestionRenderer` (`classes/QuestionRenderer.php`) für HTML-Ausgabe (Single/Multiple Choice).
  - `CodeFormatter` für Markdown-Codeblöcke.
- Unterstützt optionale `code_example`, `image_path`.

### 3.4 Antwortverarbeitung
- POST-Handler nutzt `classes/AnswerProcessor.php` (`processAnswer()`):
  - Validiert Auswahl (z. B. Anzahl Checkboxen).
  - Speichert in `user_answers` (`selected_answer_id`, `is_correct`, `points_earned`).
  - Bei Multiple Choice zusätzlich `user_answer_selections`.
  - Aktualisiert `quiz_sessions.answered_questions`, `total_score`.
- Aktionen:
  - `next_question`: lädt folgende Frage.
  - `skip_question`: abhängig von Einstellungen (derzeit standardmäßig deaktiviert/auskommentiert – prüfen).

### 3.5 Abschlussbedingungen
- Wenn `answered_questions >= total_questions` oder keine offenen Fragen → `status = 'completed'`, `completed_at = NOW()`.
- Logging (`log_quiz_completion()` falls verfügbar).
- Redirect zu `quizes_done.php`.

---

## 4. Phase „Ergebnisübersicht“ (`quiz/quizes_done.php`)

### 4.1 Übersichtsseite
- Lädt alle abgeschlossenen Sessions des Users (`status = 'completed'`).
- Berechnet pro Quiz:
  - `total_questions` aus `questions_json`.
  - `correct_answers` via `user_answers`.
  - `quiz_points_earned` (Summe `questions.points` für richtige Antworten).
  - IT-Coins (`user_quiz_rewards`).
  - Prozentwert = `total_score / max_score * 100`.
- Aggregierte Statistiken:
  - Anzahl Quizzes, Bestehensquote (konfigurierbar), Ø-Score, Gesamtpunkte, IT-Coins.

### 4.2 Belohnungen
- Bei Aufruf mit `session_id`: `award_quiz_rewards(user_id, session_id)` vergibt IT-Coins (falls noch nicht erfolgt).
  - Aktualisiert `users.reward_points`, `users.total_quizzes_passed`.
  - Trägt Datensatz in `user_quiz_rewards` ein.

### 4.3 Detail/Review
- `quiz_details.php`: Zeigt vollständige Auswertung inkl. Antwortoptionen, User-Auswahl, Punkte pro Frage.
- `quiz_review.php`: Interaktives Review (Fragen erneut ansehen, Feedback).

---

## 5. Klassen und Hilfsfunktionen (Kurzüberblick)

| Komponente                    | Datei                                | Aufgabe                                                   |
|-------------------------------|--------------------------------------|-----------------------------------------------------------|
| `QuestionRenderer`            | `classes/QuestionRenderer.php`       | HTML-Rendering für Single/Multiple Choice, inkl. Styling. |
| `AnswerProcessor`             | `classes/AnswerProcessor.php`        | Validierung, Auswertung, Speichern in DB.                 |
| `CodeFormatter`               | `classes/CodeFormatter.php`          | Sichere Code- und Markdown-Ausgabe.                       |
| `ResultsCalculator`           | `classes/ResultsCalculator.php`      | (Aktuell begrenzt genutzt) Berechnung aggregierter Werte. |
| `award_quiz_rewards()`        | `includes/functions.php` (ab Zeile ~2360) | Vergibt IT-Coins, schreibt `user_quiz_rewards`.      |
| `calculate_reward_points()`   | `includes/functions.php`             | Punkte-Logik je Prozentkorridor.                          |
| `get_user_reward_points()`    | `includes/functions.php`             | Liest aktuelle Reward-Daten für Dashboard.                |

---

## 6. Abhängigkeiten & Settings

| Setting-Key                 | Wirkung                                    |
|-----------------------------|--------------------------------------------|
| `quiz_questions_count`      | Default-Fragenanzahl pro Quiz              |
| `quiz_time_limit`           | Zeitlimit in Sekunden                      |
| `points_per_question`       | Bulk-Update für `questions.points`         |
| `passing_score_percentage`  | Bestehensgrenze (verwendet in allen Statistiken) |
| `inactive_cleanup_*`        | Automatisches Löschen inaktiver Benutzer   |

Belohnungssystem konfiguriert aktuell über feste Schwellen in `calculate_reward_points()`. (=> Kandidat für Settings-Erweiterung.)

---

## 7. Identifizierte Beobachtungen (für Phase 2)

1. **Berechnungen:**  
   - `quiz_details.php` interpretiert `total_score` als „korrekte Antworten“ (mögliche Inkonsistenz).
   - Mehrfachberechnung von Punkten/Prozentwerten an verschiedenen Stellen.

2. **Session Cleanup:**  
   - `abandoned` Sessions bleiben bestehen; Cron/Cleanup prüfen.

3. **Klassen-Nutzung:**  
   - `ResultsCalculator` scheint kaum genutzt – Potenzial zur Zentralisierung.

4. **Review-Logik:**  
   - `quiz_review.php` sollte mit `user_answer_selections` konsistente Anzeige gewährleisten (prüfen).

---

## 8. Nächste Schritte

1. Tiefergehende Analyse der Klassen (`Phase 1.3`).  
2. Prüfen der Inkonsistenzen (Punkte vs. korrekte Antworten).  
3. Dokumentation erweitern (UML/Sequenzdiagramm optional).  
4. Vorbereitung auf Vereinfachung/Refactoring (Phase 2 & 3).

> **Status:** Workflow dokumentiert und analysiert. Ergebnisse dienen als Grundlage für weitere Phasen.


