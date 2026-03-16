# Datenbank - Quiz-Tabellen (Detailliert)

**Basierend auf:** `dbs14381483.sql`  
**Letzte Aktualisierung:** 27. Januar 2025

---

## 📊 Übersicht

Das Quiz-System verwendet 7 Haupttabellen zur Verwaltung von Fragen, Antworten, Sessions und Belohnungen.

---

## 1. `questions` - Quiz-Fragen

**Zweck:** Speichert alle Quiz-Fragen

### Spalten

| Spalte | Typ | Null | Default | Beschreibung |
|--------|-----|------|---------|--------------|
| `id` | INT | Nein | - | Primärschlüssel |
| `learning_field_id` | INT | Nein | - | FK zu `learning_fields.id` |
| `question_text` | TEXT | Nein | - | Fragetext |
| `code_example` | TEXT | Ja | NULL | Codebeispiel (optional) |
| `code_language` | VARCHAR(20) | Ja | NULL | Programmiersprache (z.B. "php", "java") |
| `image_path` | VARCHAR(255) | Ja | NULL | Pfad zu Bild (optional) |
| `question_type` | ENUM | Nein | 'single' | 'single' oder 'multiple' |
| `points` | TINYINT | Nein | 4 | Punkte pro Frage (1-10) |
| `difficulty` | ENUM | Nein | 'medium' | 'easy', 'medium', 'hard' |
| `is_approved` | TINYINT(1) | Nein | 0 | Genehmigt (1) oder nicht (0) |
| `created_by` | INT | Ja | NULL | FK zu `users.id` (wer hat Frage erstellt) |
| `created_at` | TIMESTAMP | Ja | CURRENT_TIMESTAMP | Erstellungsdatum |
| `updated_at` | TIMESTAMP | Ja | CURRENT_TIMESTAMP | Letzte Aktualisierung |

### Indizes

- PRIMARY KEY (`id`)
- KEY `learning_field_id` (`learning_field_id`)

### Beziehungen

- `learning_field_id` → `learning_fields.id`
- `created_by` → `users.id`

### Wichtige Queries

```sql
-- Fragen für Quiz auswählen
SELECT id FROM questions 
WHERE learning_field_id = ? AND is_approved = 1 
ORDER BY RAND() 
LIMIT ?

-- Max Score berechnen
SELECT SUM(points) FROM questions WHERE id IN (...)
```

---

## 2. `answer_options` - Antwortmöglichkeiten

**Zweck:** Antwortmöglichkeiten zu Fragen

### Spalten

| Spalte | Typ | Null | Default | Beschreibung |
|--------|-----|------|---------|--------------|
| `id` | INT | Nein | - | Primärschlüssel |
| `question_id` | INT | Nein | - | FK zu `questions.id` |
| `answer_text` | TEXT | Nein | - | Antworttext |
| `is_correct` | TINYINT(1) | Nein | 0 | Richtig (1) oder falsch (0) |
| `sort_order` | TINYINT | Nein | 0 | Sortierreihenfolge |
| `created_at` | TIMESTAMP | Ja | CURRENT_TIMESTAMP | Erstellungsdatum |
| `updated_at` | TIMESTAMP | Ja | CURRENT_TIMESTAMP | Letzte Aktualisierung |

### Indizes

- PRIMARY KEY (`id`)
- KEY `question_id` (`question_id`)

### Beziehungen

- `question_id` → `questions.id` (ON DELETE CASCADE)

### Wichtige Queries

```sql
-- Antwortmöglichkeiten laden
SELECT * FROM answer_options 
WHERE question_id = ? 
ORDER BY sort_order ASC, id ASC

-- Richtige Antworten (Single-Choice)
SELECT id FROM answer_options 
WHERE question_id = ? AND is_correct = 1

-- Richtige Antworten (Multiple-Choice)
SELECT id FROM answer_options 
WHERE question_id = ? AND is_correct = 1
```

---

## 3. `quiz_sessions` - Quiz-Durchläufe

**Zweck:** Einzelne Quiz-Durchläufe eines Benutzers

### Spalten

| Spalte | Typ | Null | Default | Beschreibung |
|--------|-----|------|---------|--------------|
| `id` | INT | Nein | - | Primärschlüssel |
| `user_id` | INT | Nein | - | FK zu `users.id` |
| `learning_field_id` | INT | Ja | NULL | FK zu `learning_fields.id` |
| `total_questions` | INT | Nein | 60 | Anzahl Fragen im Quiz |
| `answered_questions` | INT | Nein | 0 | Anzahl beantworteter Fragen |
| `total_score` | DECIMAL(10,2) | Nein | 0.00 | Erreichte Punkte (inkl. Teilpunkte) |
| `max_score` | DECIMAL(10,2) | Nein | 0.00 | Maximale Punkte |
| `status` | ENUM | Nein | 'started' | 'started', 'paused', 'completed', 'abandoned' |
| `started_at` | TIMESTAMP | Ja | CURRENT_TIMESTAMP | Startzeitpunkt |
| `completed_at` | TIMESTAMP | Ja | NULL | Abschlusszeitpunkt |
| `time_limit` | INT | Nein | 7200 | Zeitlimit in Sekunden |
| `questions_json` | TEXT | Ja | NULL | JSON-Array mit Frage-IDs |

### Indizes

- PRIMARY KEY (`id`)
- KEY `user_id` (`user_id`)
- KEY `learning_field_id` (`learning_field_id`)

### Beziehungen

- `user_id` → `users.id`
- `learning_field_id` → `learning_fields.id`

### Wichtige Queries

```sql
-- Session erstellen
INSERT INTO quiz_sessions 
(user_id, learning_field_id, total_questions, max_score, 
 time_limit, questions_json, status, started_at)
VALUES (?, ?, ?, ?, ?, ?, 'started', NOW())

-- Session aktualisieren (nach Antwort)
UPDATE quiz_sessions 
SET total_score = (SELECT SUM(points_earned) FROM user_answers WHERE quiz_session_id = ?),
    answered_questions = (SELECT COUNT(*) FROM user_answers WHERE quiz_session_id = ?)
WHERE id = ?

-- Quiz beenden
UPDATE quiz_sessions 
SET status = 'completed', completed_at = NOW() 
WHERE id = ?
```

---

## 4. `user_answers` - Benutzer-Antworten

**Zweck:** Einzelne Antworten eines Benutzers in einer Session

### Spalten

| Spalte | Typ | Null | Default | Beschreibung |
|--------|-----|------|---------|--------------|
| `id` | INT | Nein | - | Primärschlüssel |
| `quiz_session_id` | INT | Nein | - | FK zu `quiz_sessions.id` |
| `question_id` | INT | Nein | - | FK zu `questions.id` |
| `selected_answer_id` | INT | Ja | NULL | FK zu `answer_options.id` (nur Single-Choice) |
| `is_correct` | TINYINT(1) | Ja | NULL | Vollständig richtig (1) oder nicht (0) |
| `points_earned` | DECIMAL(5,2) | Nein | 0.00 | Erreichte Punkte (0, 0.5, 1, etc.) |
| `answered_at` | TIMESTAMP | Ja | CURRENT_TIMESTAMP | Antwortzeitpunkt |

### Indizes

- PRIMARY KEY (`id`)
- UNIQUE KEY `unique_session_question` (`quiz_session_id`, `question_id`)
- KEY `selected_answer_id` (`selected_answer_id`)

### Beziehungen

- `quiz_session_id` → `quiz_sessions.id`
- `question_id` → `questions.id`
- `selected_answer_id` → `answer_options.id` (nur Single-Choice)

### Wichtige Queries

```sql
-- Antwort speichern (Single-Choice)
INSERT INTO user_answers 
(quiz_session_id, question_id, selected_answer_id, is_correct, points_earned, answered_at)
VALUES (?, ?, ?, ?, ?, NOW())

-- Antwort speichern (Multiple-Choice)
INSERT INTO user_answers 
(quiz_session_id, question_id, selected_answer_id, is_correct, points_earned, answered_at)
VALUES (?, ?, NULL, ?, ?, NOW())

-- Punkte für Session berechnen
SELECT SUM(points_earned) FROM user_answers WHERE quiz_session_id = ?

-- Korrekte Antworten zählen
SELECT COUNT(*) FROM user_answers 
WHERE quiz_session_id = ? AND is_correct = 1
```

---

## 5. `user_answer_selections` - Multiple-Choice-Auswahlen

**Zweck:** Detailtabelle für Multiple-Choice-Antworten (mehrfach gewählte Optionen)

### Spalten

| Spalte | Typ | Null | Default | Beschreibung |
|--------|-----|------|---------|--------------|
| `id` | INT | Nein | - | Primärschlüssel |
| `user_answer_id` | INT | Nein | - | FK zu `user_answers.id` |
| `selected_answer_id` | INT | Nein | - | FK zu `answer_options.id` |
| `created_at` | TIMESTAMP | Ja | CURRENT_TIMESTAMP | Erstellungsdatum |

### Indizes

- PRIMARY KEY (`id`)
- UNIQUE KEY `unique_selection` (`user_answer_id`, `selected_answer_id`)

### Beziehungen

- `user_answer_id` → `user_answers.id`
- `selected_answer_id` → `answer_options.id`

### Wichtige Queries

```sql
-- Auswahlen speichern
INSERT INTO user_answer_selections (user_answer_id, selected_answer_id)
VALUES (?, ?)

-- Auswahlen laden
SELECT selected_answer_id FROM user_answer_selections 
WHERE user_answer_id = ?
```

---

## 6. `user_quiz_rewards` - IT-Coins Belohnungen

**Zweck:** IT-Coins pro Quiz-Session

### Spalten

| Spalte | Typ | Null | Default | Beschreibung |
|--------|-----|------|---------|--------------|
| `id` | INT | Nein | - | Primärschlüssel |
| `user_id` | INT | Nein | - | FK zu `users.id` |
| `quiz_session_id` | INT | Nein | - | FK zu `quiz_sessions.id` |
| `learning_field_id` | INT | Ja | NULL | FK zu `learning_fields.id` |
| `points_earned` | INT | Nein | 0 | IT-Coins (1-10) |
| `success_percentage` | DECIMAL(5,2) | Ja | NULL | Erfolgsquote (0-100) |
| `created_at` | TIMESTAMP | Ja | CURRENT_TIMESTAMP | Erstellungsdatum |

### Indizes

- PRIMARY KEY (`id`)
- UNIQUE KEY `unique_user_quiz` (`user_id`, `quiz_session_id`)

### Beziehungen

- `user_id` → `users.id`
- `quiz_session_id` → `quiz_sessions.id`
- `learning_field_id` → `learning_fields.id`

### Wichtige Queries

```sql
-- Belohnung speichern
INSERT INTO user_quiz_rewards 
(user_id, quiz_session_id, learning_field_id, points_earned, success_percentage)
VALUES (?, ?, ?, ?, ?)

-- IT-Coins für Quiz laden
SELECT points_earned FROM user_quiz_rewards 
WHERE quiz_session_id = ?
```

---

## 7. `learning_fields` - Lernfelder

**Zweck:** Organisiert Fragen in thematische Bereiche

### Spalten

| Spalte | Typ | Null | Default | Beschreibung |
|--------|-----|------|---------|--------------|
| `id` | INT | Nein | - | Primärschlüssel |
| `lf_number` | VARCHAR(10) | Nein | - | Lernfeld-Nummer (z.B. "LF 1") |
| `title` | VARCHAR(255) | Nein | - | Titel |
| `description` | TEXT | Ja | NULL | Beschreibung |
| `specialization` | ENUM | Nein | 'all' | 'all', 'anwendungsentwicklung', 'systemintegration', etc. |
| `sort_order` | INT | Nein | 0 | Sortierreihenfolge |
| `is_active` | TINYINT(1) | Nein | 1 | Aktiv (1) oder nicht (0) |

### Indizes

- PRIMARY KEY (`id`)
- UNIQUE KEY `lf_number` (`lf_number`)

### Beziehungen

- `questions.learning_field_id` → `learning_fields.id`

### Wichtige Queries

```sql
-- Verfügbare Lernfelder laden
SELECT lf.*, COUNT(q.id) as question_count
FROM learning_fields lf
LEFT JOIN questions q ON lf.id = q.learning_field_id AND q.is_approved = 1
WHERE lf.is_active = 1
GROUP BY lf.id
HAVING question_count > 0
ORDER BY lf.sort_order
```

---

## 🔗 Datenfluss

```
learning_fields
    ↓
questions (learning_field_id)
    ↓
answer_options (question_id)
    ↓
quiz_sessions (user_id, learning_field_id)
    ↓
user_answers (quiz_session_id, question_id, selected_answer_id)
    ↓
user_answer_selections (user_answer_id, selected_answer_id) [nur Multiple-Choice]
    ↓
user_quiz_rewards (quiz_session_id, user_id)
    ↓
users (reward_points, total_quizzes_passed)
```

---

## 📊 Wichtige Beziehungen

### Foreign Keys

- `questions.learning_field_id` → `learning_fields.id`
- `answer_options.question_id` → `questions.id`
- `quiz_sessions.user_id` → `users.id`
- `quiz_sessions.learning_field_id` → `learning_fields.id`
- `user_answers.quiz_session_id` → `quiz_sessions.id`
- `user_answers.question_id` → `questions.id`
- `user_answers.selected_answer_id` → `answer_options.id` (nur Single-Choice)
- `user_answer_selections.user_answer_id` → `user_answers.id`
- `user_answer_selections.selected_answer_id` → `answer_options.id`
- `user_quiz_rewards.user_id` → `users.id`
- `user_quiz_rewards.quiz_session_id` → `quiz_sessions.id`

---

## 🔗 Weitere Dokumentation

- **Tabellen-Übersicht:** [01_Tabellen-Uebersicht.md](01_Tabellen-Uebersicht.md)
- **Beziehungen:** [07_Beziehungen.md](07_Beziehungen.md)
- **ERD:** [09_ERD.md](09_ERD.md)
- **Quiz-System:** `../03_Quiz-System/`

---

**Ende der Quiz-Tabellen-Dokumentation**

