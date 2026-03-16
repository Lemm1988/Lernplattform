<!-- Automatisch erstellt: 2025-11-13 -->

# Datenbankstruktur – Quizsystem

## Überblick

Die Quizfunktion stützt sich auf mehrere Kern- und Ergänzungstabellen. Dieses Dokument fasst den aktuellen Stand (laut `Datenbankstruktur.txt` und `dbs14381483.sql`, Stand 13.11.2025) zusammen.

```
users ──┬──────────────┐
        │              │
        ▼              ▼
quiz_sessions ──── user_quiz_rewards
        │
        ▼
user_answers ── user_answer_selections
        ▲
        │
questions ─── answer_options
        ▲
        │
learning_fields
```

Zusätzlich: `settings`, `reward_points_audit`, diverse Audit-/Log-Tabellen.

---

## 1. Kern-Tabellen

### 1.1 `questions`
- **Zweck:** Stellt einzelne Quizfragen bereit.
- **Wichtige Spalten:**  
  `question_type (single|multiple)`, `points`, `difficulty`, `is_approved`, optionale `code_example`, `code_language`, `image_path`.
- **Beziehungen:**  
  `learning_field_id → learning_fields.id`, `created_by → users.id`.
- **Indexes:**  
  u. a. `idx_questions_learning_field_approved` (Kombination aus Lernfeld & Freigabestatus), `idx_question_type`.
- **Bemerkungen:**  
  Punktwerte werden zentral über `admin/settings.php` (Bulk-Update) gepflegt. Genehmigung (`is_approved`) entscheidet, ob eine Frage selektiert werden kann.

### 1.2 `answer_options`
- **Zweck:** Antwortmöglichkeiten zu einer Frage.
- **Wichtige Spalten:**  
  `is_correct` (Mehrere TRUE für Multiple Choice), `sort_order`.
- **Beziehungen:**  
  `question_id → questions.id` (ON DELETE CASCADE).
- **Indexes:**  
  `question_id`.

### 1.3 `quiz_sessions`
- **Zweck:** Einzelne Quiz-Durchläufe eines Users.
- **Wichtige Spalten:**  
  `total_questions`, `answered_questions`, `total_score`, `max_score`, `status (started|paused|completed|abandoned)`, `time_limit`, `questions_json`.
- **Beziehungen:**  
  `user_id → users.id`, `learning_field_id → learning_fields.id`.
- **Indexes:**  
  `idx_quiz_sessions_user_completed` (User + Completed-Datum), `user_id`, `learning_field_id`.
- **Bemerkungen:**  
  `questions_json` speichert Reihenfolge/ID-Liste; `time_limit` (Sekunden) wird aus Settings geladen.

### 1.4 `user_answers`
- **Zweck:** Einzelne Antworten eines Users in einer Session.
- **Spaltenvarianten (laut SQL-Dump):**  
  - neues Feld `selected_answer_id` (statt `answer_id`).  
  - `is_correct`, `points_earned`, `answered_at`.
- **Beziehungen:**  
  `quiz_session_id → quiz_sessions.id`, `question_id → questions.id`, `selected_answer_id → answer_options.id`.  
  Für Multiple Choice: Verweis auf `user_answer_selections`.
- **Indexes:**  
  `unique_session_question` (Session+Frage), `selected_answer_id`.

### 1.5 `user_answer_selections`
- **Zweck:** Detailtabelle für Multiple-Choice-Antworten (mehrfach gewählte Optionen).
- **Beziehungen:**  
  `user_answer_id → user_answers.id`, `selected_answer_id → answer_options.id`.
- **Bemerkungen:**  
  Erzwingt eindeutige Kombination pro Auswahl (`unique_selection`).

### 1.6 `user_quiz_rewards`
- **Zweck:** IT-Coins / Belohnungspunkte pro Quiz.
- **Schlüsselspalten:**  
  `user_id`, `quiz_session_id`, `points_earned`, `success_percentage`, optional `learning_field_id`.
- **Indexes:**  
  `unique_user_quiz` (verhindert doppelte Einträge je User-Session).
- **Beziehung:**  
  `quiz_session_id → quiz_sessions.id`.
- **Bemerkungen:**  
  Gekoppelt mit `users.reward_points` und `users.total_quizzes_passed`.

### 1.7 `users`
- **Relevante Quiz-Spalten:**  
  `reward_points`, `total_quizzes_passed`.
- **Indexes:**  
  `idx_users_reward_points`, `idx_users_total_quizzes_passed`.

---

## 2. Ergänzende Tabellen

| Tabelle                | Funktion                                                       | Hinweise                                               |
|------------------------|----------------------------------------------------------------|--------------------------------------------------------|
| `settings`             | Systemweite Konfiguration (`quiz_time_limit`, `quiz_questions_count`, `passing_score_percentage`, `points_per_question`, …) | Im Admin-Bereich editierbar.                           |
| `learning_fields`      | Lernfeld-Katalog, beeinflusst Frage/Pausen Auswahl             | `specialization`, `is_active`, `sort_order`.           |
| `reward_points_audit`  | Audit-Log für Punkteänderungen                                 | Optionales `quiz_session_id`, `admin_user_id`.         |
| `user_progress`        | Aggregierte Lernfortschrittswerte                              | Nutzt `best_score`, `completion_percentage`.           |
| `log_entries`, `user_activity_logs`, `user_logs` | Audits & Logging für Aktionen                        | Zur Nachvollziehbarkeit adminseitiger Aktionen.        |

---

## 3. Beziehungen (Auszug)

- **Fragen & Antworten:** `questions (1) ── (n) answer_options`.
- **Session & Fragen:**  
  - JSON-Liste (`questions_json`).  
  - Per Antwort: `quiz_sessions (1) ── (n) user_answers`.
- **Multiple Choice:** `user_answers (1) ── (n) user_answer_selections`.
- **Belohnungen:** `quiz_sessions (1) ── (1) user_quiz_rewards`.
- **Benutzerfortschritt:** `users (1) ── (n) quiz_sessions`, `users (1) ── (1) user_progress pro Lernfeld`.

---

## 4. Identifizierte Besonderheiten / Hinweise

1. **Punktebasierte Bewertung:**  
   - Fragen speichern `points`.  
   - `quiz_sessions.max_score` sollte Summe aller Punkte sein (Prüfung erforderlich).

2. **Bestehensgrenze:**  
   - Globale Einstellung `passing_score_percentage`.  
   - Bisherige Inkonsistenzen in Code (Teilweise 60 %-Fixwert) wurden angepasst.

3. **Antwortmodell:**  
   - `selected_answer_id` für Single Choice.  
   - `user_answer_selections` für Multiple Choice (ermöglicht beliebig viele Auswahloptionen).

4. **Belohnungssystem:**  
   - `user_quiz_rewards` + `users.reward_points`.  
   - Audit über `reward_points_audit` empfehlenswert zu prüfen.

5. **Cleanup-Funktionen:**  
   - `quiz_sessions.status` enthält `abandoned`, Cleanup-Mechanismus prüfen (Cron?).

---

## 5. Nächste Schritte (Phase 1)

1. Validieren, ob alle hier genannten Tabellen in `dbs14381483.sql` übereinstimmen (speziell Constraints).  
2. Prüfen, wie `max_score`, `total_score`, `points_earned` gefüllt werden (Analyse der Business-Logik).  
3. Abgleichen mit Migrationen (`migrations/`) auf noch nicht ausgeführte Strukturen.  
4. Ergänzen von Diagrammen/Beziehungsübersichten (optional in `Doku/Quizsystem/01_Datenbankstruktur.drawio`).

> **Status:** Dokument initial erstellt. Weitere Details folgen nach vertiefter Analyse und Querprüfung.


