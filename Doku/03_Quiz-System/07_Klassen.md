# Quiz-System - PHP-Klassen

**Letzte Aktualisierung:** 27. Januar 2025

---

## 📋 Übersicht

Das Quiz-System verwendet 4 PHP-Klassen zur Verarbeitung und Darstellung von Quiz-Inhalten.

---

## 1. AnswerProcessor

**Datei:** `classes/AnswerProcessor.php`

**Zweck:** Verarbeitet und validiert Quiz-Antworten

### Methoden

#### `processAnswer($questionId, $questionType, $selectedAnswers, $quizSessionId)`
**Zweck:** Hauptmethode zur Verarbeitung von Antworten  
**Parameter:**
- `$questionId` (int) - Frage-ID
- `$questionType` (string) - 'single' oder 'multiple'
- `$selectedAnswers` (mixed) - Antwort-ID oder Array von Antwort-IDs
- `$quizSessionId` (int) - Quiz-Session-ID

**Rückgabe:** Array mit `is_correct`, `points_earned`, `selected_answers`

**Verwendung:**
```php
$processor = new AnswerProcessor($pdo);
$result = $processor->processAnswer($questionId, 'multiple', [1, 2, 3], $sessionId);
```

---

#### `processSingleChoice($questionId, $selectedAnswer, $quizSessionId)`
**Zweck:** Verarbeitet Single-Choice-Antworten

**Logik:**
1. Antwort-Option aus DB laden
2. Prüfen ob `is_correct = 1`
3. Punkte vergeben: `questions.points` wenn richtig, sonst 0
4. In `user_answers` speichern

**Rückgabe:**
```php
[
    'is_correct' => true/false,
    'points_earned' => 0.0 oder questions.points,
    'selected_answers' => [$selectedAnswer]
]
```

---

#### `processMultipleChoice($questionId, $selectedAnswers, $quizSessionId)`
**Zweck:** Verarbeitet Multiple-Choice-Antworten

**Logik:**
1. Alle Antwort-Optionen laden
2. Richtige Antworten identifizieren
3. `evaluateMultipleChoiceWithPartialCredit()` aufrufen
4. In `user_answers` speichern (selected_answer_id = NULL)
5. In `user_answer_selections` speichern (alle Auswahlen)

**Rückgabe:**
```php
[
    'is_correct' => true/false,
    'points_earned' => 0.0, 0.5 * max_points, oder max_points,
    'selected_answers' => [1, 2, 3],
    'correct_answers' => [1, 2]
]
```

---

#### `evaluateMultipleChoiceWithPartialCredit($selectedAnswers, $correctAnswers, $answerMap, $maxPoints)`
**Zweck:** Berechnet Punkte für Multiple-Choice mit Teilpunkten

**Logik:**
```php
// 1. Zähle richtige und falsche Auswahlen
$correctSelected = Anzahl richtige Antworten in $selectedAnswers
$incorrectSelected = Anzahl falsche Antworten in $selectedAnswers

// 2. Alle richtigen + keine falschen = 100% Punkte
if ($correctSelected === $totalCorrect && $incorrectSelected === 0) {
    return ['is_correct' => true, 'points' => $maxPoints];
}

// 3. Keine richtige = 0% Punkte
if ($correctSelected === 0) {
    return ['is_correct' => false, 'points' => 0.0];
}

// 4. Teilweise richtig = 50% Punkte
return ['is_correct' => false, 'points' => round($maxPoints * 0.5, 2)];
```

**Wichtig:** Gibt `float` zurück (nicht `int`) für Teilpunkte

---

#### `saveUserAnswer($quizSessionId, $questionId, $selectedAnswerId, $isCorrect, $points)`
**Zweck:** Speichert Antwort in `user_answers`

**Parameter:**
- `$selectedAnswerId` - NULL bei Multiple-Choice

**SQL:**
```sql
INSERT INTO user_answers 
(quiz_session_id, question_id, selected_answer_id, is_correct, points_earned, answered_at)
VALUES (?, ?, ?, ?, ?, NOW())
```

---

#### `saveUserAnswerSelections($userAnswerId, $selectedAnswers)`
**Zweck:** Speichert Multiple-Choice-Auswahlen in `user_answer_selections`

**SQL:**
```sql
INSERT INTO user_answer_selections (user_answer_id, selected_answer_id)
VALUES (?, ?)
```

---

## 2. ResultsCalculator

**Datei:** `classes/ResultsCalculator.php`

**Zweck:** Berechnet und formatiert Quiz-Ergebnisse

### Methoden

#### `calculateResults($quizSessionId)`
**Zweck:** Berechnet umfassende Ergebnisse für eine Quiz-Session

**Schritte:**
1. Session-Info laden
2. Frage-IDs aus `questions_json` extrahieren
3. `max_possible_points` berechnen (Summe aller `questions.points`)
4. Alle User-Antworten laden
5. Für jede Frage in `questions_json`:
   - Ergebnis verarbeiten (oder 0 Punkte wenn nicht beantwortet)
6. Prozent berechnen: `(total_points / max_possible_points) * 100`

**Rückgabe:**
```php
[
    'session_info' => [...],
    'total_questions' => 20,
    'correct_answers' => 15,
    'total_points' => 17.5,
    'max_possible_points' => 20,
    'percentage' => 87.5,
    'questions' => [
        [
            'question_id' => 123,
            'question_text' => '...',
            'is_correct' => true,
            'points_earned' => 1.0,
            'max_points' => 1,
            'is_partially_correct' => false,
            ...
        ],
        ...
    ]
]
```

---

#### `getUserAnswers($quizSessionId)`
**Zweck:** Lädt alle User-Antworten für eine Session

**Wichtig:** 
- Wählt nur die neueste Antwort pro Frage (MAX(id) GROUP BY question_id)
- Lädt `points_earned` und `max_points` explizit als `float`

**SQL:**
```sql
SELECT ua.*, q.points as max_points, q.question_type
FROM user_answers ua
JOIN questions q ON ua.question_id = q.id
WHERE ua.quiz_session_id = ?
AND ua.id IN (
    SELECT MAX(id) FROM user_answers 
    WHERE quiz_session_id = ? 
    GROUP BY question_id
)
```

---

#### `processQuestionResult($userAnswer)`
**Zweck:** Verarbeitet Ergebnis einer einzelnen Frage

**Logik:**
1. Richtige Antworten laden (Single/Multiple-Choice)
2. User-Auswahlen laden
3. `points_earned` und `max_points` als `float` behandeln
4. `is_partially_correct` bestimmen: `0 < points_earned < max_points`
5. `is_fully_correct` bestimmen: `points_earned >= max_points`

**Rückgabe:**
```php
[
    'question_id' => 123,
    'question_text' => '...',
    'is_correct' => false,
    'is_fully_correct' => false,
    'is_partially_correct' => true,
    'points_earned' => 0.5,
    'max_points' => 1.0,
    'correct_answers' => [...],
    'selected_answers' => [...],
    'all_answers' => [...]
]
```

---

## 3. QuestionRenderer

**Datei:** `classes/QuestionRenderer.php`

**Zweck:** Rendert Fragen als HTML

### Methoden

#### `renderQuestion($question, $answers)`
**Zweck:** Hauptmethode zur Darstellung von Fragen

**Logik:**
- Prüft `question_type`
- Ruft `renderSingleChoice()` oder `renderMultipleChoice()` auf

---

#### `renderSingleChoice($question, $answers)`
**Zweck:** Rendert Single-Choice-Frage mit Radio-Buttons

**HTML:**
```html
<div class="form-check mb-3">
    <input class="form-check-input" type="radio" name="answer_id" 
           id="answer123" value="123" required>
    <label class="form-check-label" for="answer123">
        Antworttext
    </label>
</div>
```

---

#### `renderMultipleChoice($question, $answers)`
**Zweck:** Rendert Multiple-Choice-Frage mit Checkboxes

**HTML:**
```html
<div class="form-check mb-3">
    <input class="form-check-input" type="checkbox" name="answer_ids[]" 
           id="answer123" value="123">
    <label class="form-check-label" for="answer123">
        Antworttext
    </label>
</div>
```

---

#### `getInputName($questionType)`
**Zweck:** Gibt den korrekten Input-Namen zurück

**Rückgabe:**
- Single-Choice: `'answer_id'`
- Multiple-Choice: `'answer_ids[]'`

---

## 4. CodeFormatter

**Datei:** `classes/CodeFormatter.php`

**Zweck:** Formatiert Codebeispiele in Fragen

### Methoden

#### `formatCode($code, $language)`
**Zweck:** Formatiert Code mit Syntax-Highlighting

**Verwendung:**
- Wird in `QuestionRenderer` verwendet
- Unterstützt verschiedene Programmiersprachen

---

## 🔗 Verwendung im Workflow

### Quiz-Session (quiz_session.php)

```php
// Frage anzeigen
$renderer = new QuestionRenderer();
$html = $renderer->renderQuestion($question, $answers);

// Antwort verarbeiten
$processor = new AnswerProcessor($pdo);
$result = $processor->processAnswer($questionId, $questionType, $selectedAnswers, $sessionId);
```

### Quiz-Details (quiz_details.php)

```php
// Ergebnisse berechnen
$calculator = new ResultsCalculator($pdo);
$results = $calculator->calculateResults($sessionId);

// Anzeigen
foreach ($results['questions'] as $question) {
    // Status: richtig/falsch/teilweise
    // Punkte anzeigen
}
```

---

## 🔗 Weitere Dokumentation

- **Workflow:** [03_Workflow.md](03_Workflow.md)
- **Berechnungen:** [04_Berechnungen.md](04_Berechnungen.md)
- **Backend:** [06_Backend.md](06_Backend.md)

---

**Ende der Klassen-Dokumentation**

