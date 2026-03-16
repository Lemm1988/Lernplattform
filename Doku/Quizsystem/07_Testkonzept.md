<!-- Automatisch erstellt: 2025-11-13 -->

# Testkonzept – Quizsystem

## 1. Zielsetzung

Sicherstellen, dass der aktuelle Stand des Quizsystems (nach den Anpassungen vom 13.11.2025) stabil ist und die neuen Admin-Funktionen korrekt arbeiten. Tests werden vorerst manuell durchgeführt; automatisierte Tests folgen in einer späteren Phase.

---

## 2. Testumgebung

- **Server:** Entwicklungsumgebung (lokal)
- **Browser:** Chrome (aktuell), Firefox (aktuell)
- **Benutzerrollen:** admin, moderator, student
- **Datenbasis:** aktuelle Datenbank (`dbs14381483.sql`) nach Einspielen der Änderungen

---

## 3. Testübersicht

| Nr. | Bereich | Beschreibung | Benutzer | Erwartetes Ergebnis |
|-----|---------|--------------|----------|----------------------|
| F1 | Quiz-Start | Neues Quiz starten (Lernfeld + global) | student | Session wird erstellt, Weiterleitung zu `quiz_session.php` |
| F2 | Quiz-Durchführung | Single-Choice Antwort abgeben | student | `answered_questions` + `total_score` werden korrekt erhöht |
| F3 | Quiz-Durchführung | Multiple-Choice mit teilweiser Auswahl | student | Ergebnis entspricht „alles oder nichts“ (bis Teilpunkte implementiert) |
| F4 | Zeitlimit | Quiz über Zeitlimit hinaus laufen lassen | student | Session wird abgeschlossen, Hinweis auf Timeout |
| F5 | Ergebnisübersicht | `quizes_done.php` anzeigen | student | KPIs (Ø Score, Bestehensquote) entsprechen `passing_score_percentage` |
| F6 | Detailansicht | `quiz_details.php` für abgeschlossene Session | student | Ergebnisse stammen aus `ResultsCalculator`, richtige Hervorhebung |
| A1 | Admin-Settings | Belohnungsschwellen (JSON) ändern | admin | Einstellungen werden validiert, gespeichert, Log-Eintrag erstellt |
| A2 | Admin-Settings | Teilpunkte-Toggle aktivieren/deaktivieren | admin | Wert wird gespeichert (noch ohne Effekt), Sichtbarer Hinweis |
| A3 | Quiz-Statistiken | Zeitraumfilter anwenden | admin | KPIs passen sich an, Passrate = Settings-Schwelle |
| A4 | Quiz-Sessions | Filter (Status, Benutzer) anwenden | admin | Tabelle zeigt passende Sessions, Limit Hinweis sichtbar |
| A5 | Quiz-Sessions | Abgebrochene Session löschen | admin | Session + Antworten + Rewards werden entfernt |
| A6 | Quiz-Sessions | Cleanup „abandoned“ ausführen | admin | Sessions älter als X Tage werden entfernt, Erfolgsmeldung |
| DB1 | Datenbank | `reward_thresholds_json` und weitere Settings vorhanden | admin | Einträge in `settings`-Tabelle korrekt, JSON formatierter Wert |
| DB2 | Datenbank | `user_answers` Einträge für Multiple Choice haben Selektionsdaten | admin | `user_answer_selections` enthält passende Datensätze |

---

## 4. Regressionstests (Ausschnitt)

1. Quiz-Abschluss vergibt IT-Coins (`user_quiz_rewards`, `users.reward_points`).
2. Dashboard (Admin) zeigt keine Fehler nach Entfernen von Sessions.
3. Frageverwaltung (`admin/question_management.php`) weiterhin nutzbar (neue Settings beeinflussen dies nicht).

---

## 5. Testdaten & Vorbereitung

- Mindestens ein genehmigtes Quiz je Lernfeld mit 5+ Fragen (Single & Multiple Choice).
- Test-Benutzer: `student_demo`, `moderator_demo`, `admin_demo`.
- Optional: SQL-Skript zum Anlegen einer abgebrochenen Session (Status `abandoned`).

Beispiel für abgebrochene Session:
```sql
INSERT INTO quiz_sessions (user_id, learning_field_id, total_questions, answered_questions, total_score, max_score, status, started_at)
VALUES (1, NULL, 10, 3, 4, 20, 'abandoned', NOW() - INTERVAL 90 DAY);
```

---

## 6. Dokumentation der Testergebnisse

- Testergebnisse in `docs/quiz-tests-YYYYMMDD.md` erfassen (Pass/Fail, Kommentare).
- Auffälligkeiten sofort in `docs/quiz-bugs.md` dokumentieren.

---

## 7. Nächste Schritte

1. Automatisierte PHPUnit-Tests für `AnswerProcessor`, `ResultsCalculator`, `award_quiz_rewards`.
2. Browser-basierte E2E-Tests (z. B. Cypress) für kritische Benutzerflows.
3. Monitoring-Hooks (z. B. Fehlerzählung bei `quiz_session.php`) aktivieren, sobald verfügbar.

> **Status:** Testplan erstellt. Manuelle Tests sollten vor dem nächsten Release durchgeführt und dokumentiert werden.


