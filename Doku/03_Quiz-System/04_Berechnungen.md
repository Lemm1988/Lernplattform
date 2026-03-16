# Quiz-System - Berechnungen

**Letzte Aktualisierung:** 27. Januar 2025

---

## 📊 Übersicht

Dieses Dokument beschreibt alle Berechnungen im Quiz-System: Punktesystem, Auswertungen, IT-Coins, Statistiken.

---

## 1. Punktesystem

### 1.1 Single-Choice-Fragen

**Datei:** `classes/AnswerProcessor.php` → `processSingleChoice()`

**Berechnung:**
```php
// Korrekte Antwort: volle Punkte (questions.points)
// Falsche Antwort: 0 Punkte
$points = $isCorrect ? (float)$question['points'] : 0.0;
```

**Speicherung:**
- `user_answers.points_earned` = erreichte Punkte (DECIMAL(5,2))
- `user_answers.is_correct` = 1 wenn richtig, 0 wenn falsch

---

### 1.2 Multiple-Choice-Fragen

**Datei:** `classes/AnswerProcessor.php` → `evaluateMultipleChoiceWithPartialCredit()`

**Berechnung:**
```php
// 1. Alle richtigen Antworten auswählen + keine falschen = 100% Punkte
if ($correctSelected === $totalCorrect && $incorrectSelected === 0) {
    return ['is_correct' => true, 'points' => (float)$maxPoints];
}

// 2. Keine richtige Antwort = 0% Punkte
if ($correctSelected === 0) {
    return ['is_correct' => false, 'points' => 0.0];
}

// 3. Teilweise richtig = 50% Punkte
return ['is_correct' => false, 'points' => round((float)$maxPoints * 0.5, 2)];
```

**Beispiel:**
- Frage hat 1 Punkt
- 2 richtige Antworten, 1 falsche Antwort
- Benutzer wählt: 1 richtige + 1 falsche
- Ergebnis: 0.5 Punkte (50%)

**Speicherung:**
- `user_answers.points_earned` = erreichte Punkte (DECIMAL(5,2), z.B. 0.5)
- `user_answers.is_correct` = 0 (auch bei Teilpunkten)
- `user_answer_selections` = alle ausgewählten Antworten

---

## 2. Quiz-Session-Berechnungen

### 2.1 Max Score (Maximale Punkte)

**Datei:** `quiz/start_quiz.php` (Zeile ~130)

**Berechnung:**
```php
// Summe aller questions.points für alle Fragen im Quiz
$max_points_stmt = $pdo->prepare("
    SELECT SUM(points) 
    FROM questions 
    WHERE id IN ($placeholders)
");
$max_score = (float)$max_points_stmt->fetchColumn();
```

**Speicherung:**
- `quiz_sessions.max_score` = DECIMAL(10,2)

---

### 2.2 Total Score (Erreichte Punkte)

**Datei:** `quiz/quiz_session.php` (bei Quiz-Abschluss)

**Berechnung:**
```php
// Summe aller points_earned aus user_answers
$total_score = SUM(user_answers.points_earned) 
WHERE quiz_session_id = ?
```

**Speicherung:**
- `quiz_sessions.total_score` = DECIMAL(10,2)
- Wird bei jeder Antwort aktualisiert

**Update-Logik:**
```php
// Nach jeder Antwort:
$update_stmt = $pdo->prepare("
    UPDATE quiz_sessions 
    SET total_score = (
        SELECT COALESCE(SUM(points_earned), 0) 
        FROM user_answers 
        WHERE quiz_session_id = ?
    ),
    answered_questions = (
        SELECT COUNT(*) 
        FROM user_answers 
        WHERE quiz_session_id = ?
    )
    WHERE id = ?
");
```

---

### 2.3 Erfolgsquote (Percentage)

**Datei:** `quiz/quiz_details.php`, `quiz/quizes_done.php`

**Berechnung:**
```php
$percentage = ($total_score / $max_score) * 100;
```

**Beispiel:**
- `total_score` = 12.5 (inkl. Teilpunkte)
- `max_score` = 20.0
- `percentage` = 62.5%

**Wichtig:**
- Verwendet `quiz_sessions.total_score` und `quiz_sessions.max_score`
- Unterstützt Dezimalwerte (z.B. 0.5 Punkte)

---

## 3. Bestehensquote

### 3.1 Bestanden/Nicht Bestanden

**Datei:** `quiz/quizes_done.php`, `quiz/start_quiz.php`

**Berechnung:**
```php
$passing_score_percentage = (int)get_setting('passing_score_percentage', 60);
$is_passed = ($percentage >= $passing_score_percentage);
```

**Standard:** 60% (konfigurierbar in `admin/settings.php`)

---

### 3.2 Bestehensquote (Pass Rate)

**Datei:** `quiz/quizes_done.php`

**Berechnung:**
```php
$passed_quizzes = COUNT(*) 
WHERE (total_score / max_score * 100) >= passing_score_percentage;

$pass_rate = ($passed_quizzes / $total_quizzes) * 100;
```

---

## 4. IT-Coins Belohnungssystem

### 4.1 Erfolgsquote für IT-Coins

**Datei:** `includes/functions.php` → `award_quiz_rewards()`

**Berechnung:**
```php
// Erfolgsquote basierend auf Punkten (nicht Anzahl richtiger Antworten)
$success_percentage = ($total_points_earned / $max_score) * 100;
```

**Wichtig:**
- Verwendet `total_points_earned` (Summe aus `user_answers.points_earned`)
- Berücksichtigt Teilpunkte (z.B. 0.5 Punkte)

---

### 4.2 IT-Coins-Vergabe

**Datei:** `includes/functions.php` → `calculate_reward_points()`

**Tabelle:**
| Erfolgsquote | IT-Coins |
|--------------|----------|
| < 60% | 0 (nicht bestanden) |
| 60-69% | 1 |
| 70-79% | 3 |
| 80-89% | 5 |
| 90-99% | 8 |
| 100% | 10 |

**Code:**
```php
function calculate_reward_points($success_percentage) {
    if ($success_percentage < 60) {
        return 0;
    } elseif ($success_percentage >= 60 && $success_percentage < 70) {
        return 1;
    } elseif ($success_percentage >= 70 && $success_percentage < 80) {
        return 3;
    } elseif ($success_percentage >= 80 && $success_percentage < 90) {
        return 5;
    } elseif ($success_percentage >= 90 && $success_percentage < 100) {
        return 8;
    } else { // 100%
        return 10;
    }
}
```

---

### 4.3 IT-Coins-Speicherung

**Datei:** `includes/functions.php` → `award_quiz_rewards()`

**Schritte:**
1. Eintrag in `user_quiz_rewards`:
   ```sql
   INSERT INTO user_quiz_rewards 
   (user_id, quiz_session_id, learning_field_id, points_earned, success_percentage)
   VALUES (?, ?, ?, ?, ?)
   ```

2. User-Punkte aktualisieren:
   ```sql
   UPDATE users 
   SET reward_points = reward_points + ?, 
       total_quizzes_passed = total_quizzes_passed + 1 
   WHERE id = ?
   ```

3. Audit-Log:
   ```sql
   INSERT INTO reward_points_audit 
   (user_id, points_change, reason, quiz_session_id)
   VALUES (?, ?, ?, ?)
   ```

---

## 5. Statistiken

### 5.1 Durchschnittliche Bestehensquote

**Datei:** `quiz/quizes_done.php`

**Berechnung:**
```php
$sum_percentage = 0;
foreach ($completed_quizzes as $quiz) {
    $percentage = ($quiz['total_score'] / $quiz['max_score']) * 100;
    $sum_percentage += $percentage;
}
$average_percentage = $sum_percentage / count($completed_quizzes);
```

---

### 5.2 Bestehensquote (in start_quiz.php)

**Datei:** `quiz/start_quiz.php`

**Berechnung:**
```php
$best_score = MAX((total_score / max_score * 100))
WHERE user_id = ? AND status = 'completed' AND max_score > 0;
```

**Anzeige:** Als Prozentwert (z.B. "85%")

---

### 5.3 Gesamtpunkte

**Datei:** `quiz/quizes_done.php`

**Berechnung:**
```php
$total_quiz_points = SUM(user_answers.points_earned)
WHERE quiz_session_id IN (alle abgeschlossenen Sessions);
```

**Formatierung:**
- Dezimalwerte bis 2 Stellen (z.B. "12,5" statt "12,50")
- Funktion: `formatNumber($number, 2)`

---

### 5.4 Korrekte Antworten

**Datei:** `quiz/quizes_done.php`

**Berechnung:**
```php
// Anzahl Fragen mit is_correct = 1
$correct_answers = COUNT(*)
FROM user_answers
WHERE quiz_session_id = ? AND is_correct = 1;
```

**Wichtig:**
- Zählt nur vollständig richtige Antworten
- Teilweise richtige Multiple-Choice (0.5 Punkte) zählen nicht als "korrekt"

---

## 6. Zeitlimit

### 6.1 Zeitlimit-Berechnung

**Datei:** `quiz/quiz_session.php`

**Berechnung:**
```php
$quiz_time_limit = get_setting('quiz_time_limit', 7200); // Sekunden
$started_at = strtotime($session['started_at']);
$now = time();
$time_left = max(0, $started_at + $quiz_time_limit - $now);
```

**Speicherung:**
- `quiz_sessions.time_limit` = Sekunden (INT)
- `quiz_sessions.started_at` = Startzeitpunkt (TIMESTAMP)

---

### 6.2 Auto-Submit bei Zeitende

**Datei:** `quiz/quiz_session.php`

**Logik:**
```php
if ($quiz_time_limit > 0 && $now > $started_at + $quiz_time_limit) {
    // Quiz automatisch beenden
    UPDATE quiz_sessions 
    SET status = 'completed', completed_at = NOW() 
    WHERE id = ?;
}
```

---

## 7. Neuberechnung (Recalculation)

### 7.1 Neuberechnung von Quiz-Punkten

**Datei:** `admin/Recalculate_Quiz_Scores.php`

**Zweck:** Korrigiert Punkte für alte Quizzes (z.B. vor Teilpunkte-Implementierung)

**Prozess:**
1. Alle `user_answers` für eine Session laden
2. Für jede Antwort:
   - Single-Choice: Neu prüfen ob `is_correct`
   - Multiple-Choice: Neu berechnen mit `evaluateMultipleChoiceWithPartialCredit()`
3. `points_earned` aktualisieren
4. `quiz_sessions.total_score` neu berechnen

**Wichtig:**
- ⚠️ Überschreibt IT-Coins und Statistiken
- ⚠️ Event-spezifische Punkte können verloren gehen

---

## 8. Formatierung

### 8.1 Dezimalwerte anzeigen

**Datei:** `quiz/quiz_details.php`, `quiz/quizes_done.php`

**Funktion:**
```php
function formatNumber($number, $decimals = 2) {
    $number = (float)$number;
    $formatted = number_format($number, $decimals, ',', '.');
    // Entferne unnötige Nullen: "12,50" → "12,5", "12,00" → "12"
    if (strpos($formatted, ',') !== false) {
        $formatted = rtrim($formatted, '0');
        $formatted = rtrim($formatted, ',');
    }
    return $formatted;
}
```

**Beispiele:**
- 12.5 → "12,5"
- 12.0 → "12"
- 0.5 → "0,5"

---

## 9. Validierungen

### 9.1 Total Score darf Max Score nicht überschreiten

**Datei:** `admin/Recalculate_Quiz_Scores.php`, `quiz/quiz_session.php`

**Validierung:**
```php
if ($new_total_score > $new_max_score) {
    $new_total_score = $new_max_score; // Cap auf max_score
}
```

---

## 10. Zusammenfassung

### Wichtige Formeln

| Berechnung | Formel | Datei |
|------------|--------|-------|
| **Erfolgsquote** | `(total_score / max_score) * 100` | `quiz_details.php` |
| **Bestanden** | `percentage >= passing_score_percentage` | `quizes_done.php` |
| **IT-Coins** | `calculate_reward_points(percentage)` | `functions.php` |
| **Teilpunkte MC** | `max_points * 0.5` | `AnswerProcessor.php` |
| **Durchschnitt** | `SUM(percentages) / COUNT(quizzes)` | `quizes_done.php` |

---

## 🔗 Weitere Dokumentation

- **Workflow:** [03_Workflow.md](03_Workflow.md)
- **Klassen:** [07_Klassen.md](07_Klassen.md)
- **Datenbank:** `../04_Datenbank/02_Quiz-Tabellen.md`

---

**Ende der Berechnungs-Dokumentation**

