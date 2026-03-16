# Quiz-System - Architektur

**Letzte Aktualisierung:** 27. Januar 2025

---

## 📋 Übersicht

Dieses Dokument beschreibt die System-Architektur des Quiz-Systems.

---

## 🏗️ Architektur-Übersicht

```
┌─────────────────────────────────────────────────────────────┐
│                    Frontend Layer                           │
├─────────────────────────────────────────────────────────────┤
│  quiz/start_quiz.php      │  Quiz starten                  │
│  quiz/quiz_session.php    │  Quiz durchführen              │
│  quiz/quiz_details.php    │  Ergebnisse anzeigen           │
│  quiz/quizes_done.php     │  Quiz-Übersicht                │
└─────────────────────────────────────────────────────────────┘
                            ↓
┌─────────────────────────────────────────────────────────────┐
│                    Business Logic Layer                     │
├─────────────────────────────────────────────────────────────┤
│  classes/AnswerProcessor.php      │  Antwort-Verarbeitung   │
│  classes/ResultsCalculator.php    │  Ergebnis-Berechnung    │
│  classes/QuestionRenderer.php     │  Frage-Darstellung      │
│  classes/CodeFormatter.php        │  Code-Formatierung      │
└─────────────────────────────────────────────────────────────┘
                            ↓
┌─────────────────────────────────────────────────────────────┐
│                    Data Access Layer                        │
├─────────────────────────────────────────────────────────────┤
│  includes/functions.php    │  Hilfsfunktionen               │
│  config.php                │  DB-Verbindung                 │
└─────────────────────────────────────────────────────────────┘
                            ↓
┌─────────────────────────────────────────────────────────────┐
│                    Database Layer                           │
├─────────────────────────────────────────────────────────────┤
│  questions              │  answer_options                  │
│  quiz_sessions          │  user_answers                    │
│  user_answer_selections │  user_quiz_rewards               │
│  learning_fields        │  users                           │
└─────────────────────────────────────────────────────────────┘
```

---

## 🔄 Datenfluss

### Quiz-Start
```
User → start_quiz.php
    → Fragen auswählen
    → quiz_sessions INSERT
    → quiz_session.php
```

### Quiz-Durchführung
```
User → quiz_session.php
    → Frage anzeigen (QuestionRenderer)
    → Antwort verarbeiten (AnswerProcessor)
    → user_answers INSERT
    → quiz_sessions UPDATE (total_score)
    → Nächste Frage oder Beenden
```

### Quiz-Abschluss
```
quiz_session.php
    → Quiz beenden
    → award_quiz_rewards() (functions.php)
    → user_quiz_rewards INSERT
    → users UPDATE (reward_points)
    → quiz_details.php
    → ResultsCalculator.calculateResults()
    → Ergebnisse anzeigen
```

---

## 📦 Komponenten

### Frontend-Komponenten

#### `quiz/start_quiz.php`
- Lernfeld-Auswahl
- Quiz-Session-Erstellung
- Statistiken anzeigen

#### `quiz/quiz_session.php`
- Frage-Anzeige
- Antwort-Verarbeitung
- Zeitlimit-Überwachung

#### `quiz/quiz_details.php`
- Detaillierte Ergebnisse
- Frage-für-Frage-Anzeige
- Farbcodierung (grün/gelb/rot)

#### `quiz/quizes_done.php`
- Quiz-Übersicht
- Statistiken
- IT-Coins-Anzeige

---

### Backend-Komponenten

#### `classes/AnswerProcessor.php`
- Antwort-Verarbeitung
- Punktesystem
- Teilpunkte-Berechnung

#### `classes/ResultsCalculator.php`
- Ergebnis-Berechnung
- Prozent-Berechnung
- Frage-Ergebnisse

#### `classes/QuestionRenderer.php`
- HTML-Generierung
- Single/Multiple-Choice-Rendering

#### `classes/CodeFormatter.php`
- Code-Formatierung
- Syntax-Highlighting

---

### Datenbank-Komponenten

#### Quiz-Tabellen
- `questions` - Fragen
- `answer_options` - Antwortmöglichkeiten
- `quiz_sessions` - Sessions
- `user_answers` - Antworten
- `user_answer_selections` - Multiple-Choice-Auswahlen
- `user_quiz_rewards` - IT-Coins
- `learning_fields` - Lernfelder

---

## 🔗 Weitere Dokumentation

- **Workflow:** [03_Workflow.md](03_Workflow.md)
- **Berechnungen:** [04_Berechnungen.md](04_Berechnungen.md)
- **Klassen:** [07_Klassen.md](07_Klassen.md)
- **Datenbank:** `../04_Datenbank/02_Quiz-Tabellen.md`

---

**Ende der Architektur-Dokumentation**

