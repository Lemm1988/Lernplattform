# Quiz-System - Workflow

**Letzte Aktualisierung:** 27. Januar 2025

---

## 📋 Übersicht

Dieses Dokument beschreibt den kompletten Workflow eines Quiz-Durchlaufs von Start bis Auswertung.

---

## 🔄 Kompletter Quiz-Workflow

### Phase 1: Quiz starten

**Datei:** `quiz/start_quiz.php`

**Schritte:**
1. **Lernfeld auswählen**
   - Verfügbare Lernfelder laden (nur mit genehmigten Fragen)
   - Anzahl Fragen pro Lernfeld anzeigen

2. **Quiz-Session erstellen**
   ```php
   // Fragen zufällig auswählen
   SELECT id FROM questions 
   WHERE learning_field_id = ? AND is_approved = 1 
   ORDER BY RAND() 
   LIMIT ?
   ```

3. **Max Score berechnen**
   ```php
   SELECT SUM(points) FROM questions WHERE id IN (...)
   ```

4. **Session in Datenbank speichern**
   ```sql
   INSERT INTO quiz_sessions 
   (user_id, learning_field_id, total_questions, max_score, 
    time_limit, questions_json, status, started_at)
   VALUES (?, ?, ?, ?, ?, ?, 'started', NOW())
   ```

5. **Weiterleitung zu Quiz-Session**
   ```php
   header('Location: /quiz/quiz_session.php?session_id=' . $session_id);
   ```

---

### Phase 2: Quiz durchführen

**Datei:** `quiz/quiz_session.php`

**Schritte:**

1. **Session laden und validieren**
   - Session existiert?
   - Gehört Session dem Benutzer?
   - Status = 'started'?

2. **Nächste Frage bestimmen**
   ```php
   // Alle beantworteten Fragen
   SELECT question_id FROM user_answers WHERE quiz_session_id = ?
   
   // Nächste unbeantwortete Frage aus questions_json
   foreach ($question_ids as $qid) {
       if (!in_array($qid, $answered_ids)) {
           $next_question_id = $qid;
           break;
       }
   }
   ```

3. **Frage anzeigen**
   - Frage laden aus `questions`
   - Antwortmöglichkeiten laden aus `answer_options`
   - Codebeispiel formatieren (falls vorhanden)
   - HTML rendern (Single/Multiple-Choice)

4. **Antwort verarbeiten (POST)**
   ```php
   // Single-Choice
   $answerProcessor->processSingleChoice($questionId, $selectedAnswer, $sessionId);
   
   // Multiple-Choice
   $answerProcessor->processMultipleChoice($questionId, $selectedAnswers, $sessionId);
   ```

5. **Punkte speichern**
   ```sql
   INSERT INTO user_answers 
   (quiz_session_id, question_id, selected_answer_id, 
    is_correct, points_earned, answered_at)
   VALUES (?, ?, ?, ?, ?, NOW())
   ```

6. **Session aktualisieren**
   ```sql
   UPDATE quiz_sessions 
   SET total_score = (SELECT SUM(points_earned) FROM user_answers WHERE quiz_session_id = ?),
       answered_questions = (SELECT COUNT(*) FROM user_answers WHERE quiz_session_id = ?)
   WHERE id = ?
   ```

7. **Zeitlimit prüfen**
   ```php
   if ($now > $started_at + $time_limit) {
       // Quiz beenden
   }
   ```

8. **Weiterleitung**
   - Zur nächsten Frage (Schritt 2)
   - Oder Quiz beenden (wenn alle Fragen beantwortet)

---

### Phase 3: Quiz beenden

**Datei:** `quiz/quiz_session.php` (Zeile ~53)

**Schritte:**

1. **Quiz-Status auf 'completed' setzen**
   ```sql
   UPDATE quiz_sessions 
   SET status = 'completed', completed_at = NOW() 
   WHERE id = ?
   ```

2. **Statistik-Logging**
   ```php
   log_quiz_completion($user_id, $session_id, $total_score, $max_score);
   ```

3. **Weiterleitung zu Ergebnissen**
   ```php
   header('Location: /quiz/quizes_done.php?session_id=' . $session_id);
   ```

---

### Phase 4: Ergebnisse anzeigen

**Datei:** `quiz/quizes_done.php`

**Schritte:**

1. **Session laden**
   ```sql
   SELECT * FROM quiz_sessions WHERE id = ? AND user_id = ?
   ```

2. **IT-Coins vergeben** (falls noch nicht geschehen)
   ```php
   award_quiz_rewards($user_id, $session_id);
   ```

3. **Statistiken berechnen**
   - Gesamtanzahl Quizzes
   - Bestandene Quizzes
   - Durchschnittliche Bestehensquote
   - Gesamtpunkte
   - IT-Coins gesamt

4. **Weiterleitung zu Details**
   ```php
   header('Location: /quiz/quiz_details.php?session_id=' . $session_id);
   ```

---

### Phase 5: Detaillierte Ergebnisse

**Datei:** `quiz/quiz_details.php`

**Schritte:**

1. **ResultsCalculator verwenden**
   ```php
   $calculator = new ResultsCalculator($pdo);
   $results = $calculator->calculateResults($session_id);
   ```

2. **Ergebnisse anzeigen**
   - Gesamtpunkte und Prozent
   - Jede Frage mit Status (richtig/falsch/teilweise)
   - Korrekte Antworten anzeigen
   - Erreichte Punkte pro Frage

3. **Farbcodierung**
   - Grün: Vollständig richtig
   - Gelb: Teilweise richtig (0 < points < max_points)
   - Rot: Falsch (0 Punkte)

---

## 🔄 Datenfluss-Diagramm

```
User wählt Lernfeld
    ↓
start_quiz.php
    ↓
Quiz-Session erstellen
    ↓
questions_json generieren
    ↓
max_score berechnen
    ↓
quiz_sessions INSERT
    ↓
quiz_session.php (Schleife)
    ↓
Frage anzeigen
    ↓
User antwortet
    ↓
AnswerProcessor.processAnswer()
    ↓
user_answers INSERT
    ↓
user_answer_selections INSERT (bei Multiple-Choice)
    ↓
quiz_sessions UPDATE (total_score, answered_questions)
    ↓
Nächste Frage oder Beenden
    ↓
Quiz beenden
    ↓
award_quiz_rewards()
    ↓
user_quiz_rewards INSERT
    ↓
users UPDATE (reward_points, total_quizzes_passed)
    ↓
quiz_details.php
    ↓
ResultsCalculator.calculateResults()
    ↓
Ergebnisse anzeigen
```

---

## 📊 Datenbank-Updates während des Workflows

### Bei Quiz-Start:
- `quiz_sessions` INSERT (1 Zeile)

### Bei jeder Antwort:
- `user_answers` INSERT (1 Zeile)
- `user_answer_selections` INSERT (N Zeilen bei Multiple-Choice)
- `quiz_sessions` UPDATE (total_score, answered_questions)

### Bei Quiz-Abschluss:
- `quiz_sessions` UPDATE (status = 'completed', completed_at)
- `user_quiz_rewards` INSERT (1 Zeile)
- `users` UPDATE (reward_points, total_quizzes_passed)
- `reward_points_audit` INSERT (1 Zeile)
- `user_progress` UPDATE (Lernfortschritt)

---

## 🔗 Weitere Dokumentation

- **Berechnungen:** [04_Berechnungen.md](04_Berechnungen.md)
- **Klassen:** [07_Klassen.md](07_Klassen.md)
- **Frontend:** [05_Frontend.md](05_Frontend.md)

---

**Ende der Workflow-Dokumentation**

