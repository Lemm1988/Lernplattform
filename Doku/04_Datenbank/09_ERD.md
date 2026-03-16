# Datenbank - Entity-Relationship-Diagramm (ERD)

**Basierend auf:** `dbs14381483.sql`  
**Letzte Aktualisierung:** 27. Januar 2025

---

## 📊 ERD (Mermaid)

```mermaid
erDiagram
    users ||--o{ quiz_sessions : "hat"
    users ||--o{ user_answers : "antwortet"
    users ||--o{ user_quiz_rewards : "erhält"
    users ||--o{ questions : "erstellt"
    users ||--o{ contact_messages : "sendet"
    users ||--o{ news_articles : "schreibt"
    
    learning_fields ||--o{ questions : "enthält"
    learning_fields ||--o{ quiz_sessions : "für"
    learning_fields ||--o{ user_quiz_rewards : "in"
    
    questions ||--o{ answer_options : "hat"
    questions ||--o{ user_answers : "wird beantwortet"
    
    quiz_sessions ||--o{ user_answers : "enthält"
    quiz_sessions ||--|| user_quiz_rewards : "belohnt"
    
    user_answers ||--o{ user_answer_selections : "hat (MC)"
    answer_options ||--o{ user_answer_selections : "wird ausgewählt"
    
    news_articles ||--o{ news_article_tags : "hat"
    news_tags ||--o{ news_article_tags : "zu"
    news_categories ||--o{ news_articles : "kategorisiert"
    
    users {
        int id PK
        string username UK
        string email UK
        string password_hash
        enum role
        int reward_points
        int total_quizzes_passed
    }
    
    learning_fields {
        int id PK
        string lf_number UK
        string title
        enum specialization
        int sort_order
        bool is_active
    }
    
    questions {
        int id PK
        int learning_field_id FK
        text question_text
        enum question_type
        tinyint points
        enum difficulty
        bool is_approved
        int created_by FK
    }
    
    answer_options {
        int id PK
        int question_id FK
        text answer_text
        bool is_correct
        tinyint sort_order
    }
    
    quiz_sessions {
        int id PK
        int user_id FK
        int learning_field_id FK
        int total_questions
        int answered_questions
        decimal total_score
        decimal max_score
        enum status
        int time_limit
        text questions_json
    }
    
    user_answers {
        int id PK
        int quiz_session_id FK
        int question_id FK
        int selected_answer_id FK
        bool is_correct
        decimal points_earned
    }
    
    user_answer_selections {
        int id PK
        int user_answer_id FK
        int selected_answer_id FK
    }
    
    user_quiz_rewards {
        int id PK
        int user_id FK
        int quiz_session_id FK
        int learning_field_id FK
        int points_earned
        decimal success_percentage
    }
```

---

## 🔗 Wichtige Beziehungen

### Quiz-System

```
users (1) ──< (N) quiz_sessions
quiz_sessions (1) ──< (N) user_answers
user_answers (1) ──< (N) user_answer_selections [nur Multiple-Choice]
questions (1) ──< (N) answer_options
questions (1) ──< (N) user_answers
learning_fields (1) ──< (N) questions
learning_fields (1) ──< (N) quiz_sessions
quiz_sessions (1) ──< (1) user_quiz_rewards
```

### News-System

```
users (1) ──< (N) news_articles
news_categories (1) ──< (N) news_articles
news_articles (N) ──< (N) news_tags [via news_article_tags]
```

---

## 📊 Kardinalitäten

| Beziehung | Kardinalität | Beschreibung |
|-----------|--------------|--------------|
| `users` → `quiz_sessions` | 1:N | Ein User kann mehrere Quiz-Sessions haben |
| `quiz_sessions` → `user_answers` | 1:N | Eine Session hat mehrere Antworten |
| `questions` → `answer_options` | 1:N | Eine Frage hat mehrere Antwortmöglichkeiten |
| `user_answers` → `user_answer_selections` | 1:N | Eine Antwort kann mehrere Auswahlen haben (MC) |
| `quiz_sessions` → `user_quiz_rewards` | 1:1 | Eine Session hat genau eine Belohnung |

---

## 🔗 Weitere Dokumentation

- **Tabellen-Übersicht:** [01_Tabellen-Uebersicht.md](01_Tabellen-Uebersicht.md)
- **Beziehungen:** [07_Beziehungen.md](07_Beziehungen.md)
- **Quiz-Tabellen:** [02_Quiz-Tabellen.md](02_Quiz-Tabellen.md)

---

**Ende der ERD-Dokumentation**

