<!-- Automatisch erstellt: 2025-11-13 -->

# Komponenten-Analyse – Klassen & zentrale Funktionen

## 1. Klassen (`/classes`)

### 1.1 `QuestionRenderer`
- **Aufgabe:** HTML-Rendering für Fragen/Antwortoptionen.
- **Kernmethoden:**
  - `renderQuestion($question, $answers)` – leitet zu `renderSingleChoice` bzw. `renderMultipleChoice`.
  - `getInputName()` / `getInputType()` – Hilfen für Formulare.
- **Besonderheiten:**  
  - Nutzt reines HTML-Escaping für Texte (kein Markdown).  
  - Unterstützt optional `image_path` (Anzeige erfolgt in den Templates).
- **Potenzial:**  
  - Erweiterbar für weitere Fragetypen (z. B. Freitext).  
  - Styling aktuell Bootstrap-orientiert.

### 1.2 `AnswerProcessor`
- **Aufgabe:** Validierung, Auswertung und Speicherung von Antworten.
- **Workflow:**
  1. Ermittelt korrekte Antworten (`answer_options`) + Punkte (`questions.points`).
  2. Speichert Ergebnisse in `user_answers` (Single) bzw. `user_answers` + `user_answer_selections` (Multiple).
  3. Gibt Ergebnis-Array zurück (`is_correct`, `points_earned`, `selected_answers`).
- **Fehlerbehandlung:** wirft Exceptions bei Invalid/DB-Fehlern.
- **Bemerkungen:**  
  - Punktenlogik (alles oder nichts).  
  - Keine Teilpunkte bei Multiple Choice → Kandidat für Verbesserung.

### 1.3 `CodeFormatter`
- **Aufgabe:** Sicheres Rendern von Codebeispielen/Inline-Code.
- **Funktionen:**  
  - `formatCode()` – erzeugt `<pre><code>` Blöcke mit optionalen Optionen (Line-Numbers etc.).  
  - `formatInlineCode()` – Inline-Code.  
  - `formatCodeBlocks()` – Markdown-ähnliche ```language```-Blöcke erkennen und rendern.  
  - `sanitizeCodeForStorage()` – für Frageverwaltung.
- **Potenzial:**  
  - Erweiterung der `supportedLanguages`.  
  - Integration in Frage-Erstellungsprozesse (Admin).

### 1.4 `ResultsCalculator`
- **Aufgabe:** Aggregiert Detailergebnisse für eine Session.
- **Status:**  
  - Berechnet Summen/Prozentwerte, liefert strukturierte Arrays.  
  - Wird aktuell nur punktuell verwendet (Detailansichten).  
  - Enthält Hilfsfunktionen für „korrekte Antworten“ (Single/Multiple).
- **Potenzial:**  
  - Könnte zentral für alle Ergebnisberechnungen genutzt werden (Prevent Duplicate Logic).  
  - Anpassung an neue DB-Felder (`selected_answer_id` etc.) prüfen.

---

## 2. Zentrale Funktionen (`includes/functions.php`)

### 2.1 Belohnungssystem
- `calculate_reward_points($percentage)`  
  - Schwellen: `<60 → 0`, `60-69 → 1`, `70-79 → 2`, `80-89 → 3`, `≥90 → 5`.  
  - Fester Aufbau → Kandidat für Settings.
- `award_quiz_rewards($user_id, $quiz_session_id)`  
  - Prüft Session (Status `completed`).  
  - Verhindert Doppelvergaben (`user_quiz_rewards` Unique).  
  - Aktualisiert `users.reward_points` & `users.total_quizzes_passed`.  
  - Rückgabe enthält Endmeldung („IT-Coins erhalten / keine Punkte“).
- `get_user_reward_points($user_id)`  
  - Liest aktuellen Stand (Rewards, Anzahl bestandener Quizzes).

### 2.2 Statistikfunktionen (Auszug)
- `get_quiz_stats()` – Gesamtanzahl/letzte 7 Tage.
- `get_detailed_quiz_statistics($start, $end)` – Auswertungen nach Zeitraum.
- `get_quiz_trends($start, $end)` – Tägliche Verlaufsgrafik.
- Diverse Helper für Admin-Dashboard (`admin/dashboard.php`).

### 2.3 Logging / Utility
- `log_user_activity()` – generisch.  
- `log_event()` – für Admin/Moderator-Events.  
- Optionales `includes/statistics_logger.php` (falls vorhanden) für erweiterte Telemetrie.

---

## 3. Weitere relevante Skripte

| Datei                      | Rolle                                                                 |
|---------------------------|-----------------------------------------------------------------------|
| `quiz/quizes_done.php`    | Übersicht, Statistiken, Trigger für `award_quiz_rewards`.             |
| `quiz/quiz_details.php`   | Detailansicht; nutzt `CodeFormatter`, zeigt Antwortverläufe.          |
| `quiz/quiz_review.php`    | Interaktives Review (erneuter Durchlauf ohne Bewertung).              |
| `quiz/quiz_session.php`   | Kern der Durchführung; orchestriert `AnswerProcessor`.                |
| `users/frage_einreichen.php` | User kann Fragen einreichen (gehen in `questions` mit `is_approved=0`). |
| `admin/question_management.php` | Genehmigung / Erstellung / Bearbeitung von Fragen.            |
| `admin/answer_management.php`   | Verwaltung einzelner Antwortoptionen.                        |

---

## 4. Offene Punkte / Beobachtungen

1. **Mehrfachberechnung von Ergebnissen**  
   - `quiz_details.php`, `quizes_done.php`, `ResultsCalculator` berechnen ähnliche Werte getrennt.  
   - Empfehlung: zentrale Nutzung von `ResultsCalculator` (oder neue Service-Klasse).

2. **Multiple Choice Bewertung**  
   - Aktuell „alles oder nichts“. Kein Teilpunkte-Schema vorhanden.  
   - `AnswerProcessor::evaluateMultipleChoiceCorrectness()` kann erweitert werden.

3. **Fehlende Konfigurierbarkeit**  
   - Schwellenwerte für IT-Coins (`calculate_reward_points`).  
   - Zeitlimit pro Lernfeld / pro Quiz (derzeit global).

4. **Unused/Legacy Code**  
   - `ResultsCalculator` scheint selten verwendet → prüfen, ob modernisiert oder ersetzt werden soll.  
   - `classes/CodeFormatter` wird teilweise direkt in Templates genutzt (z. B. `quiz_details.php`).  
   - `statistics_logger.php` optional – Verfügbarkeit/Ladepfad prüfen.

5. **Error Handling**  
   - Exceptions werden teilweise nicht abgefangen (z. B. `AnswerProcessor` im Controller).  
   - Logging (error_log) verstreut.

---

## 5. Empfehlungen (Vorschau Phase 2)

1. **Service-Layer** etablieren:
   - z. B. `QuizService` zur Bündelung von Session-/Antwortlogik.
2. **Konfiguration erweitern:**
   - Admin-Settings für Belohnungsschwellen, Zeitlimit pro Lernfeld, Teilpunkte.
3. **Konsolidierte Ergebnisberechnung:**
   - `ResultsCalculator` (oder neues Modul) für alle Statistiken verwenden.
4. **Dokumentation verlinken:**
   - Dieses Dokument mit `02_Quiz-Workflow` & `01_Datenbankstruktur` referenzieren.

> **Status:** Klassen & Schlüssel-Funktionen analysiert. Basis für nächste To-dos (Inkonsistenzen & Vereinfachung).


