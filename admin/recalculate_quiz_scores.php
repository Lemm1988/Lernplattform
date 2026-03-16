<?php
/**
 * Admin: Quiz-Punkte neu berechnen
 * 
 * Berechnet abgeschlossene Quizzes neu, um Teilpunkte für Multiple-Choice-Fragen
 * korrekt zu berücksichtigen und Inkonsistenzen zu beheben.
 */

require_once '../config.php';
if (!function_exists('sync_user_reward_totals')) {
    require_once __DIR__ . '/../includes/functions.php';
}
require_admin();
check_admin_access();

$page_title = 'Quiz-Verwaltung & Neuberechnung';
$error = '';
$success = '';
$results = [];
$edit_session = null;
$edit_questions = [];
$search_results = [];
$active_tab = $_GET['tab'] ?? 'recalculate';

// Lade verfügbare Quiz-Sessions für Dropdown
$sessions_stmt = $pdo->prepare("
    SELECT 
        qs.id,
        qs.user_id,
        qs.status,
        qs.total_score,
        qs.max_score,
        qs.completed_at,
        u.username,
        lf.title as learning_field_title,
        lf.lf_number
    FROM quiz_sessions qs
    LEFT JOIN users u ON qs.user_id = u.id
    LEFT JOIN learning_fields lf ON qs.learning_field_id = lf.id
    WHERE qs.status = 'completed'
    ORDER BY qs.completed_at DESC, qs.id DESC
    LIMIT 100
");
$sessions_stmt->execute();
$available_sessions = $sessions_stmt->fetchAll(PDO::FETCH_ASSOC);

// Handler für Quiz-Bearbeitung
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    if (!verify_csrf_token($_POST['csrf_token'] ?? '')) {
        $error = 'Ungültiger Sicherheitstoken.';
    } else {
        $action = $_POST['action'];
        
        // Quiz-Suche nach Session ID
        if ($action === 'search_session') {
            $search_session_id = (int)($_POST['search_session_id'] ?? 0);
            if ($search_session_id > 0) {
                $stmt = $pdo->prepare("
                    SELECT qs.*, u.username, u.email, lf.title as learning_field_title, lf.lf_number
                    FROM quiz_sessions qs
                    LEFT JOIN users u ON qs.user_id = u.id
                    LEFT JOIN learning_fields lf ON qs.learning_field_id = lf.id
                    WHERE qs.id = ?
                ");
                $stmt->execute([$search_session_id]);
                $search_results = $stmt->fetchAll(PDO::FETCH_ASSOC);
                if (empty($search_results)) {
                    $error = "Keine Quiz-Session mit ID #{$search_session_id} gefunden.";
                } else {
                    $active_tab = 'search';
                }
            }
        }
        
        // Quiz-Suche nach User
        elseif ($action === 'search_user') {
            $search_user = trim($_POST['search_user'] ?? '');
            if (!empty($search_user)) {
                $stmt = $pdo->prepare("
                    SELECT qs.*, u.username, u.email, lf.title as learning_field_title, lf.lf_number
                    FROM quiz_sessions qs
                    LEFT JOIN users u ON qs.user_id = u.id
                    LEFT JOIN learning_fields lf ON qs.learning_field_id = lf.id
                    WHERE (u.username LIKE ? OR u.email LIKE ?)
                    ORDER BY qs.completed_at DESC, qs.id DESC
                    LIMIT 50
                ");
                $search_term = "%{$search_user}%";
                $stmt->execute([$search_term, $search_term]);
                $search_results = $stmt->fetchAll(PDO::FETCH_ASSOC);
                if (empty($search_results)) {
                    $error = "Keine Quizzes für Benutzer '{$search_user}' gefunden.";
                } else {
                    $active_tab = 'search';
                }
            }
        }
        
        // Quiz-Details laden für Bearbeitung
        elseif ($action === 'edit_quiz' && isset($_POST['edit_session_id'])) {
            $edit_session_id = (int)$_POST['edit_session_id'];
            $stmt = $pdo->prepare("
                SELECT qs.*, u.username, u.email, lf.title as learning_field_title, lf.lf_number
                FROM quiz_sessions qs
                LEFT JOIN users u ON qs.user_id = u.id
                LEFT JOIN learning_fields lf ON qs.learning_field_id = lf.id
                WHERE qs.id = ?
            ");
            $stmt->execute([$edit_session_id]);
            $edit_session = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($edit_session) {
                // Lade alle Fragen mit Antworten
                $question_ids = json_decode($edit_session['questions_json'], true);
                if (is_array($question_ids)) {
                    foreach ($question_ids as $qid) {
                        $q_stmt = $pdo->prepare("
                            SELECT q.*, 
                                   ua.id as user_answer_id,
                                   ua.selected_answer_id,
                                   ua.is_correct,
                                   ua.points_earned
                            FROM questions q
                            LEFT JOIN user_answers ua ON q.id = ua.question_id 
                                AND ua.quiz_session_id = ?
                                AND ua.id IN (
                                    SELECT MAX(id) 
                                    FROM user_answers 
                                    WHERE quiz_session_id = ? AND question_id = q.id
                                )
                            WHERE q.id = ?
                        ");
                        $q_stmt->execute([$edit_session_id, $edit_session_id, $qid]);
                        $question = $q_stmt->fetch(PDO::FETCH_ASSOC);
                        
                        if ($question) {
                            // Lade Antwortoptionen
                            $ao_stmt = $pdo->prepare("SELECT * FROM answer_options WHERE question_id = ? ORDER BY sort_order, id");
                            $ao_stmt->execute([$qid]);
                            $question['answer_options'] = $ao_stmt->fetchAll(PDO::FETCH_ASSOC);
                            
                            // Lade User-Selections für Multiple-Choice
                            if ($question['question_type'] === 'multiple' && $question['user_answer_id']) {
                                $sel_stmt = $pdo->prepare("SELECT selected_answer_id FROM user_answer_selections WHERE user_answer_id = ?");
                                $sel_stmt->execute([$question['user_answer_id']]);
                                $question['selected_ids'] = $sel_stmt->fetchAll(PDO::FETCH_COLUMN);
                            } else {
                                $question['selected_ids'] = [];
                            }
                            
                            $edit_questions[] = $question;
                        }
                    }
                }
                $active_tab = 'edit';
            } else {
                $error = "Quiz-Session nicht gefunden.";
            }
        }
        
        // Punkte für einzelne Frage speichern (nur Punkte, ohne Auswahl zu ändern)
        elseif ($action === 'update_question_points' && isset($_POST['user_answer_id']) && isset($_POST['points'])) {
            $user_answer_id = (int)$_POST['user_answer_id'];
            $points = (float)$_POST['points'];
            $session_id = (int)$_POST['session_id'];
            
            // Update points_earned
            $stmt = $pdo->prepare("UPDATE user_answers SET points_earned = ? WHERE id = ?");
            $stmt->execute([$points, $user_answer_id]);
            
            // Recalculate total_score für Session
            $stmt = $pdo->prepare("
                SELECT SUM(points_earned) as total
                FROM user_answers
                WHERE quiz_session_id = ?
                AND id IN (
                    SELECT MAX(id) 
                    FROM user_answers 
                    WHERE quiz_session_id = ? 
                    GROUP BY question_id
                )
            ");
            $stmt->execute([$session_id, $session_id]);
            $new_total = (float)($stmt->fetchColumn() ?: 0);
            
            // Update quiz_sessions
            $stmt = $pdo->prepare("SELECT max_score FROM quiz_sessions WHERE id = ?");
            $stmt->execute([$session_id]);
            $max_score = (float)($stmt->fetchColumn() ?: 0);
            
            if ($new_total > $max_score) {
                $new_total = $max_score;
            }
            
            $stmt = $pdo->prepare("UPDATE quiz_sessions SET total_score = ? WHERE id = ?");
            $stmt->execute([$new_total, $session_id]);
            
            $success = "Punkte für Frage aktualisiert. Gesamtpunkte: " . number_format($new_total, 2, ',', '.');
            
            // Reload edit data
            $_POST['action'] = 'edit_quiz';
            $_POST['edit_session_id'] = $session_id;
            // Re-execute edit_quiz handler
            $edit_session_id = $session_id;
            $stmt = $pdo->prepare("
                SELECT qs.*, u.username, u.email, lf.title as learning_field_title, lf.lf_number
                FROM quiz_sessions qs
                LEFT JOIN users u ON qs.user_id = u.id
                LEFT JOIN learning_fields lf ON qs.learning_field_id = lf.id
                WHERE qs.id = ?
            ");
            $stmt->execute([$edit_session_id]);
            $edit_session = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($edit_session) {
                $question_ids = json_decode($edit_session['questions_json'], true);
                $edit_questions = [];
                if (is_array($question_ids)) {
                    foreach ($question_ids as $qid) {
                        $q_stmt = $pdo->prepare("
                            SELECT q.*, 
                                   ua.id as user_answer_id,
                                   ua.selected_answer_id,
                                   ua.is_correct,
                                   ua.points_earned
                            FROM questions q
                            LEFT JOIN user_answers ua ON q.id = ua.question_id 
                                AND ua.quiz_session_id = ?
                                AND ua.id IN (
                                    SELECT MAX(id) 
                                    FROM user_answers 
                                    WHERE quiz_session_id = ? AND question_id = q.id
                                )
                            WHERE q.id = ?
                        ");
                        $q_stmt->execute([$edit_session_id, $edit_session_id, $qid]);
                        $question = $q_stmt->fetch(PDO::FETCH_ASSOC);
                        
                        if ($question) {
                            $ao_stmt = $pdo->prepare("SELECT * FROM answer_options WHERE question_id = ? ORDER BY sort_order, id");
                            $ao_stmt->execute([$qid]);
                            $question['answer_options'] = $ao_stmt->fetchAll(PDO::FETCH_ASSOC);
                            
                            if ($question['question_type'] === 'multiple' && $question['user_answer_id']) {
                                $sel_stmt = $pdo->prepare("SELECT selected_answer_id FROM user_answer_selections WHERE user_answer_id = ?");
                                $sel_stmt->execute([$question['user_answer_id']]);
                                $question['selected_ids'] = $sel_stmt->fetchAll(PDO::FETCH_COLUMN);
                            } else {
                                $question['selected_ids'] = [];
                            }
                            
                            $edit_questions[] = $question;
                        }
                    }
                }
            }
            $active_tab = 'edit';
        }
        
        // User-Auswahl für Frage ändern
        elseif ($action === 'update_question_selection') {
            $user_answer_id = (int)$_POST['user_answer_id'];
            $session_id = (int)$_POST['session_id'];
            $question_id = (int)$_POST['question_id'];
            $question_type = $_POST['question_type'] ?? 'single';
            $selected_ids = $_POST['selected_ids'] ?? [];
            
            if ($question_type === 'multiple') {
                // Multiple-Choice: Lösche alte Selections und füge neue hinzu
                $pdo->beginTransaction();
                try {
                    // Lösche alte Selections
                    $del_stmt = $pdo->prepare("DELETE FROM user_answer_selections WHERE user_answer_id = ?");
                    $del_stmt->execute([$user_answer_id]);
                    
                    // Füge neue Selections hinzu
                    if (!empty($selected_ids) && is_array($selected_ids)) {
                        $ins_stmt = $pdo->prepare("INSERT INTO user_answer_selections (user_answer_id, selected_answer_id) VALUES (?, ?)");
                        foreach ($selected_ids as $sel_id) {
                            $ins_stmt->execute([$user_answer_id, (int)$sel_id]);
                        }
                    }
                    
                    // Berechne neue Punkte
                    $ao_stmt = $pdo->prepare("SELECT id, is_correct FROM answer_options WHERE question_id = ?");
                    $ao_stmt->execute([$question_id]);
                    $all_answers = $ao_stmt->fetchAll(PDO::FETCH_ASSOC);
                    
                    $answerMap = [];
                    $correctAnswerIds = [];
                    foreach ($all_answers as $answer) {
                        $answerMap[$answer['id']] = (bool)$answer['is_correct'];
                        if ($answer['is_correct']) {
                            $correctAnswerIds[] = $answer['id'];
                        }
                    }
                    
                    $q_stmt = $pdo->prepare("SELECT points FROM questions WHERE id = ?");
                    $q_stmt->execute([$question_id]);
                    $max_points = (float)($q_stmt->fetchColumn() ?: 0);
                    
                    $correctSelected = 0;
                    $incorrectSelected = 0;
                    foreach ($selected_ids as $sel_id) {
                        if (isset($answerMap[$sel_id])) {
                            if ($answerMap[$sel_id]) {
                                $correctSelected++;
                            } else {
                                $incorrectSelected++;
                            }
                        }
                    }
                    
                    $totalCorrect = count($correctAnswerIds);
                    if ($correctSelected === $totalCorrect && $incorrectSelected === 0) {
                        $new_points = $max_points;
                        $is_correct = 1;
                    } elseif ($correctSelected === 0) {
                        $new_points = 0.0;
                        $is_correct = 0;
                    } else {
                        $new_points = round($max_points * 0.5, 2);
                        $is_correct = 0;
                    }
                    
                    // Update user_answers
                    $upd_stmt = $pdo->prepare("UPDATE user_answers SET points_earned = ?, is_correct = ? WHERE id = ?");
                    $upd_stmt->execute([$new_points, $is_correct, $user_answer_id]);
                    
                    $pdo->commit();
                    $success = "Auswahl für Frage aktualisiert.";
                } catch (Exception $e) {
                    $pdo->rollBack();
                    $error = "Fehler beim Aktualisieren: " . $e->getMessage();
                }
            } else {
                // Single-Choice
                $selected_id = (int)($_POST['selected_id'] ?? 0);
                if ($selected_id > 0) {
                    $ao_stmt = $pdo->prepare("SELECT is_correct FROM answer_options WHERE id = ?");
                    $ao_stmt->execute([$selected_id]);
                    $is_correct = (bool)($ao_stmt->fetchColumn() ?: 0);
                    
                    $q_stmt = $pdo->prepare("SELECT points FROM questions WHERE id = ?");
                    $q_stmt->execute([$question_id]);
                    $max_points = (float)($q_stmt->fetchColumn() ?: 0);
                    
                    $new_points = $is_correct ? $max_points : 0.0;
                    
                    $upd_stmt = $pdo->prepare("UPDATE user_answers SET selected_answer_id = ?, points_earned = ?, is_correct = ? WHERE id = ?");
                    $upd_stmt->execute([$selected_id, $new_points, $is_correct ? 1 : 0, $user_answer_id]);
                    
                    $success = "Auswahl für Frage aktualisiert.";
                }
            }
            
            // Recalculate total_score
            $stmt = $pdo->prepare("
                SELECT SUM(points_earned) as total
                FROM user_answers
                WHERE quiz_session_id = ?
                AND id IN (
                    SELECT MAX(id) 
                    FROM user_answers 
                    WHERE quiz_session_id = ? 
                    GROUP BY question_id
                )
            ");
            $stmt->execute([$session_id, $session_id]);
            $new_total = (float)($stmt->fetchColumn() ?: 0);
            
            $stmt = $pdo->prepare("SELECT max_score FROM quiz_sessions WHERE id = ?");
            $stmt->execute([$session_id]);
            $max_score = (float)($stmt->fetchColumn() ?: 0);
            
            if ($new_total > $max_score) {
                $new_total = $max_score;
            }
            
            $stmt = $pdo->prepare("UPDATE quiz_sessions SET total_score = ? WHERE id = ?");
            $stmt->execute([$new_total, $session_id]);
            
            // Reload edit data
            $_POST['action'] = 'edit_quiz';
            $_POST['edit_session_id'] = $session_id;
            $edit_session_id = $session_id;
            $stmt = $pdo->prepare("
                SELECT qs.*, u.username, u.email, lf.title as learning_field_title, lf.lf_number
                FROM quiz_sessions qs
                LEFT JOIN users u ON qs.user_id = u.id
                LEFT JOIN learning_fields lf ON qs.learning_field_id = lf.id
                WHERE qs.id = ?
            ");
            $stmt->execute([$edit_session_id]);
            $edit_session = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($edit_session) {
                $question_ids = json_decode($edit_session['questions_json'], true);
                $edit_questions = [];
                if (is_array($question_ids)) {
                    foreach ($question_ids as $qid) {
                        $q_stmt = $pdo->prepare("
                            SELECT q.*, 
                                   ua.id as user_answer_id,
                                   ua.selected_answer_id,
                                   ua.is_correct,
                                   ua.points_earned
                            FROM questions q
                            LEFT JOIN user_answers ua ON q.id = ua.question_id 
                                AND ua.quiz_session_id = ?
                                AND ua.id IN (
                                    SELECT MAX(id) 
                                    FROM user_answers 
                                    WHERE quiz_session_id = ? AND question_id = q.id
                                )
                            WHERE q.id = ?
                        ");
                        $q_stmt->execute([$edit_session_id, $edit_session_id, $qid]);
                        $question = $q_stmt->fetch(PDO::FETCH_ASSOC);
                        
                        if ($question) {
                            $ao_stmt = $pdo->prepare("SELECT * FROM answer_options WHERE question_id = ? ORDER BY sort_order, id");
                            $ao_stmt->execute([$qid]);
                            $question['answer_options'] = $ao_stmt->fetchAll(PDO::FETCH_ASSOC);
                            
                            if ($question['question_type'] === 'multiple' && $question['user_answer_id']) {
                                $sel_stmt = $pdo->prepare("SELECT selected_answer_id FROM user_answer_selections WHERE user_answer_id = ?");
                                $sel_stmt->execute([$question['user_answer_id']]);
                                $question['selected_ids'] = $sel_stmt->fetchAll(PDO::FETCH_COLUMN);
                            } else {
                                $question['selected_ids'] = [];
                            }
                            
                            $edit_questions[] = $question;
                        }
                    }
                }
            }
            $active_tab = 'edit';
        }
        
        // User einer Session ändern
        elseif ($action === 'change_user' && isset($_POST['session_id']) && isset($_POST['new_user_id'])) {
            $session_id = (int)$_POST['session_id'];
            $new_user_id = (int)$_POST['new_user_id'];
            
            if ($new_user_id > 0) {
                $pdo->beginTransaction();
                try {
                    // Update quiz_sessions
                    $stmt = $pdo->prepare("UPDATE quiz_sessions SET user_id = ? WHERE id = ?");
                    $stmt->execute([$new_user_id, $session_id]);
                    
                    // Update user_answers (falls nötig - normalerweise bleibt quiz_session_id gleich)
                    // user_answers hat keinen direkten user_id Bezug, daher keine Änderung nötig
                    
                    $pdo->commit();
                    $success = "User für Quiz-Session #{$session_id} geändert.";
                    
                    // Reload
                    $_POST['action'] = 'edit_quiz';
                    $_POST['edit_session_id'] = $session_id;
                    $edit_session_id = $session_id;
                    $stmt = $pdo->prepare("
                        SELECT qs.*, u.username, u.email, lf.title as learning_field_title, lf.lf_number
                        FROM quiz_sessions qs
                        LEFT JOIN users u ON qs.user_id = u.id
                        LEFT JOIN learning_fields lf ON qs.learning_field_id = lf.id
                        WHERE qs.id = ?
                    ");
                    $stmt->execute([$edit_session_id]);
                    $edit_session = $stmt->fetch(PDO::FETCH_ASSOC);
                    
                    if ($edit_session) {
                        $question_ids = json_decode($edit_session['questions_json'], true);
                        $edit_questions = [];
                        if (is_array($question_ids)) {
                            foreach ($question_ids as $qid) {
                                $q_stmt = $pdo->prepare("
                                    SELECT q.*, 
                                           ua.id as user_answer_id,
                                           ua.selected_answer_id,
                                           ua.is_correct,
                                           ua.points_earned
                                    FROM questions q
                                    LEFT JOIN user_answers ua ON q.id = ua.question_id 
                                        AND ua.quiz_session_id = ?
                                        AND ua.id IN (
                                            SELECT MAX(id) 
                                            FROM user_answers 
                                            WHERE quiz_session_id = ? AND question_id = q.id
                                        )
                                    WHERE q.id = ?
                                ");
                                $q_stmt->execute([$edit_session_id, $edit_session_id, $qid]);
                                $question = $q_stmt->fetch(PDO::FETCH_ASSOC);
                                
                                if ($question) {
                                    $ao_stmt = $pdo->prepare("SELECT * FROM answer_options WHERE question_id = ? ORDER BY sort_order, id");
                                    $ao_stmt->execute([$qid]);
                                    $question['answer_options'] = $ao_stmt->fetchAll(PDO::FETCH_ASSOC);
                                    
                                    if ($question['question_type'] === 'multiple' && $question['user_answer_id']) {
                                        $sel_stmt = $pdo->prepare("SELECT selected_answer_id FROM user_answer_selections WHERE user_answer_id = ?");
                                        $sel_stmt->execute([$question['user_answer_id']]);
                                        $question['selected_ids'] = $sel_stmt->fetchAll(PDO::FETCH_COLUMN);
                                    } else {
                                        $question['selected_ids'] = [];
                                    }
                                    
                                    $edit_questions[] = $question;
                                }
                            }
                        }
                    }
                    $active_tab = 'edit';
                } catch (Exception $e) {
                    $pdo->rollBack();
                    $error = "Fehler beim Ändern des Users: " . $e->getMessage();
                }
            }
        }
    }
}

// Verarbeite Formular-Submit für Neuberechnung
if ($_SERVER['REQUEST_METHOD'] === 'POST' && (!isset($_POST['action']) || $_POST['action'] === 'recalculate')) {
    if (!verify_csrf_token($_POST['csrf_token'] ?? '')) {
        $error = 'Ungültiger Sicherheitstoken.';
    } else {
        $recalculate_type = $_POST['recalculate_type'] ?? '';
        
        if ($recalculate_type === 'all') {
            // Alle abgeschlossenen Sessions laden
            $stmt = $pdo->prepare("
                SELECT id 
                FROM quiz_sessions 
                WHERE status = 'completed'
                ORDER BY id DESC
            ");
            $stmt->execute();
            $sessions = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } elseif ($recalculate_type === 'single' && isset($_POST['session_id'])) {
            $session_id = (int)$_POST['session_id'];
            if ($session_id > 0) {
                $sessions = [['id' => $session_id]];
            } else {
                $error = 'Bitte wählen Sie eine gültige Quiz-Session aus.';
                $sessions = [];
            }
        } else {
            $error = 'Bitte wählen Sie eine Berechnungsoption aus.';
            $sessions = [];
        }
        
        if (empty($error) && !empty($sessions)) {
            $recalculated = 0;
            $errors = 0;
            $results = [];
            $rewards_awarded = 0;
            $rewards_updated = 0;
            $rewards_skipped = 0;
            $reward_errors = 0;
            $users_to_sync = [];
            
            $reward_fetch_stmt = $pdo->prepare("SELECT id, user_id, points_earned FROM user_quiz_rewards WHERE quiz_session_id = ?");
            $reward_update_stmt = $pdo->prepare("
                UPDATE user_quiz_rewards 
                SET learning_field_id = ?, points_earned = ?, success_percentage = ?, completion_date = ? 
                WHERE id = ?
            ");
            
            foreach ($sessions as $session) {
                $session_id = $session['id'];
                
                try {
                    // Session-Info laden
                    $stmt = $pdo->prepare("SELECT * FROM quiz_sessions WHERE id = ?");
                    $stmt->execute([$session_id]);
                    $session_data = $stmt->fetch(PDO::FETCH_ASSOC);
                    
                    if (!$session_data) {
                        $results[] = [
                            'session_id' => $session_id,
                            'status' => 'error',
                            'message' => 'Session nicht gefunden'
                        ];
                        $errors++;
                        continue;
                    }
                    
                    $old_total_score = (float)$session_data['total_score'];
                    $old_max_score = (float)$session_data['max_score'];
                    
                    // Fragen aus JSON laden
                    $question_ids = json_decode($session_data['questions_json'], true);
                    if (!is_array($question_ids) || empty($question_ids)) {
                        $results[] = [
                            'session_id' => $session_id,
                            'status' => 'error',
                            'message' => 'Keine Fragen gefunden'
                        ];
                        $errors++;
                        continue;
                    }
                    
                    // Alle User-Answers für diese Session laden
                    $stmt = $pdo->prepare("
                        SELECT ua.*, q.question_type, q.points as question_points
                        FROM user_answers ua
                        JOIN questions q ON ua.question_id = q.id
                        WHERE ua.quiz_session_id = ?
                        AND ua.id IN (
                            SELECT MAX(id) 
                            FROM user_answers 
                            WHERE quiz_session_id = ? 
                            GROUP BY question_id
                        )
                    ");
                    $stmt->execute([$session_id, $session_id]);
                    $user_answers = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    
                    $new_total_score = 0.0;
                    $new_max_score = 0.0;
                    
                    // Berechne neue Punkte für jede Frage
                    foreach ($question_ids as $question_id) {
                        // Frage-Info laden
                        $q_stmt = $pdo->prepare("SELECT points, question_type FROM questions WHERE id = ?");
                        $q_stmt->execute([$question_id]);
                        $question = $q_stmt->fetch(PDO::FETCH_ASSOC);
                        
                        if (!$question) {
                            continue;
                        }
                        
                        $max_points = (float)$question['points'];
                        $new_max_score += $max_points;
                        
                        // Finde User-Answer für diese Frage
                        $user_answer = null;
                        foreach ($user_answers as $ua) {
                            if ($ua['question_id'] == $question_id) {
                                $user_answer = $ua;
                                break;
                            }
                        }
                        
                        if ($user_answer) {
                            // Neuberechnung der Punkte für BEIDE Fragetypen
                            if ($question['question_type'] === 'multiple') {
                                // Lade alle Antwortoptionen
                                $ao_stmt = $pdo->prepare("
                                    SELECT id, is_correct 
                                    FROM answer_options 
                                    WHERE question_id = ?
                                ");
                                $ao_stmt->execute([$question_id]);
                                $all_answers = $ao_stmt->fetchAll(PDO::FETCH_ASSOC);
                                
                                // Erstelle Answer-Map
                                $answerMap = [];
                                $correctAnswerIds = [];
                                foreach ($all_answers as $answer) {
                                    $answerMap[$answer['id']] = (bool)$answer['is_correct'];
                                    if ($answer['is_correct']) {
                                        $correctAnswerIds[] = $answer['id'];
                                    }
                                }
                                
                                // Lade User-Selections
                                $sel_stmt = $pdo->prepare("
                                    SELECT selected_answer_id 
                                    FROM user_answer_selections 
                                    WHERE user_answer_id = ?
                                ");
                                $sel_stmt->execute([$user_answer['id']]);
                                $selected_ids = $sel_stmt->fetchAll(PDO::FETCH_COLUMN);
                                
                                // Berechne neue Punkte
                                if (empty($selected_ids)) {
                                    $new_points = 0.0;
                                } else {
                                    $correctSelected = 0;
                                    $incorrectSelected = 0;
                                    
                                    foreach ($selected_ids as $selected_id) {
                                        if (isset($answerMap[$selected_id])) {
                                            if ($answerMap[$selected_id]) {
                                                $correctSelected++;
                                            } else {
                                                $incorrectSelected++;
                                            }
                                        }
                                    }
                                    
                                    $totalCorrect = count($correctAnswerIds);
                                    
                                    if ($correctSelected === $totalCorrect && $incorrectSelected === 0) {
                                        // Vollständig richtig
                                        $new_points = $max_points;
                                    } elseif ($correctSelected === 0) {
                                        // Keine richtige Antwort
                                        $new_points = 0.0;
                                    } else {
                                        // Teilweise richtig: 50% der Punkte
                                        $new_points = round($max_points * 0.5, 2);
                                    }
                                }
                                
                                // Update user_answers.points_earned
                                $update_stmt = $pdo->prepare("
                                    UPDATE user_answers 
                                    SET points_earned = ? 
                                    WHERE id = ?
                                ");
                                $update_stmt->execute([$new_points, $user_answer['id']]);
                                
                                $new_total_score += $new_points;
                            } else {
                                // Single-Choice: Neu berechnen basierend auf is_correct und aktueller Frage-Punktzahl
                                // WICHTIG: Verwende NICHT den alten points_earned Wert, sondern berechne neu!
                                $is_correct = (bool)$user_answer['is_correct'];
                                $new_points = $is_correct ? $max_points : 0.0;
                                
                                // Update user_answers.points_earned
                                $update_stmt = $pdo->prepare("
                                    UPDATE user_answers 
                                    SET points_earned = ? 
                                    WHERE id = ?
                                ");
                                $update_stmt->execute([$new_points, $user_answer['id']]);
                                
                                $new_total_score += $new_points;
                            }
                        }
                        // Wenn Frage nicht beantwortet wurde, wird nichts addiert (0 Punkte)
                    }
                    
                    // Validierung: Prüfe ob new_total_score größer als new_max_score ist
                    if ($new_total_score > $new_max_score) {
                        error_log("WARNING Session $session_id: new_total_score ($new_total_score) > new_max_score ($new_max_score)");
                        error_log("Questions in quiz: " . count($question_ids));
                        error_log("User answers found: " . count($user_answers));
                        // Korrigiere: total_score kann nicht größer als max_score sein
                        $new_total_score = $new_max_score;
                    }
                    
                    // Update quiz_sessions
                    $update_session_stmt = $pdo->prepare("
                        UPDATE quiz_sessions 
                        SET total_score = ?, max_score = ? 
                        WHERE id = ?
                    ");
                    $update_session_stmt->execute([$new_total_score, $new_max_score, $session_id]);
                    
                    // IT-Coins berechnen und nachtragen
                    $reward_status = 'skipped';
                    $reward_message = 'Erfolgsquote < 60%';
                    $success_percentage = $new_max_score > 0 ? ($new_total_score / $new_max_score) * 100 : 0;
                    $calculated_reward_points = calculate_reward_points($success_percentage);
                    $users_to_sync[$session_data['user_id']] = true;
                    $rewardRow = null;
                    $reward_fetch_stmt->execute([$session_id]);
                    $rewardRow = $reward_fetch_stmt->fetch(PDO::FETCH_ASSOC);
                    
                    if ($calculated_reward_points > 0) {
                        $completion_date = $session_data['completed_at'] ?: date('Y-m-d H:i:s');
                        
                        if ($rewardRow) {
                            $reward_update_stmt->execute([
                                $session_data['learning_field_id'],
                                $calculated_reward_points,
                                $success_percentage,
                                $completion_date,
                                $rewardRow['id']
                            ]);
                            $reward_status = 'updated';
                            $reward_message = 'IT-Coins aktualisiert';
                            $rewards_updated++;
                        } else {
                            try {
                                insert_user_quiz_reward_entry(
                                    $session_data['user_id'],
                                    $session_id,
                                    $session_data['learning_field_id'],
                                    $calculated_reward_points,
                                    $success_percentage,
                                    $completion_date
                                );
                                $reward_status = 'awarded';
                                $reward_message = 'IT-Coins vergeben';
                                $rewards_awarded++;
                            } catch (Exception $insertException) {
                                $reward_status = 'error';
                                $reward_message = $insertException->getMessage();
                                $reward_errors++;
                            }
                        }
                    } else {
                        if ($rewardRow) {
                            // Kein erneutes Löschen; Eintrag bleibt als Historie erhalten
                            $reward_status = 'skipped';
                            $reward_message = 'Keine IT-Coins (Quote < 60%)';
                        } else {
                            $rewards_skipped++;
                        }
                    }
                    
                    $results[] = [
                        'session_id' => $session_id,
                        'status' => 'success',
                        'old_total' => $old_total_score,
                        'new_total' => $new_total_score,
                        'old_max' => $old_max_score,
                        'new_max' => $new_max_score,
                        'changed' => abs($old_total_score - $new_total_score) > 0.01,
                        'reward_status' => $reward_status,
                        'reward_message' => $reward_message,
                        'calculated_reward_points' => $calculated_reward_points,
                        'success_percentage' => $success_percentage
                    ];
                    
                    $recalculated++;
                    
                    // Logging
                    log_user_activity(
                        $_SESSION['user_id'], 
                        'quiz_recalculated', 
                        "Recalculated quiz session {$session_id}: {$old_total_score} → {$new_total_score} points"
                    );
                    
                } catch (Exception $e) {
                    $results[] = [
                        'session_id' => $session_id,
                        'status' => 'error',
                        'message' => $e->getMessage()
                    ];
                    $errors++;
                    error_log("Error recalculating quiz session {$session_id}: " . $e->getMessage());
                }
            }
            
            // Benutzerpunkte mit aggregierten Werten synchronisieren
            foreach (array_keys($users_to_sync) as $user_id) {
                try {
                    sync_user_reward_totals($user_id);
                } catch (Exception $syncException) {
                    $reward_errors++;
                    error_log("Reward sync failed for user {$user_id}: " . $syncException->getMessage());
                }
            }
            
            if ($recalculated > 0) {
                $success = "$recalculated Quiz-Session(s) erfolgreich neu berechnet.";
                if ($rewards_awarded > 0) {
                    $success .= " $rewards_awarded fehlende IT-Coins vergeben.";
                }
                if ($rewards_updated > 0) {
                    $success .= " $rewards_updated vorhandene IT-Coins aktualisiert.";
                }
                if ($reward_errors > 0) {
                    $success .= " $reward_errors Fehler bei der IT-Coins-Verarbeitung.";
                }
                if ($errors > 0) {
                    $success .= " $errors Fehler aufgetreten.";
                }
            } elseif ($errors > 0) {
                $error = "$errors Fehler beim Neuberechnen.";
            }
        }
    }
}

include '../includes/header.php';
include '../includes/admin_layout_start.php';
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-4 col-lg-3">
        </div>
        <div class="col-md-8 col-lg-9">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">
                    <i class="bi bi-calculator me-2"></i>
                    Quiz-Verwaltung & Neuberechnung
                </h1>
            </div>

            <!-- Tabs Navigation -->
            <ul class="nav nav-tabs mb-4" id="quizTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link <?= $active_tab === 'recalculate' ? 'active' : '' ?>" id="recalculate-tab" data-bs-toggle="tab" data-bs-target="#recalculate" type="button" role="tab">
                        <i class="bi bi-calculator me-2"></i>Neuberechnung
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link <?= $active_tab === 'search' ? 'active' : '' ?>" id="search-tab" data-bs-toggle="tab" data-bs-target="#search" type="button" role="tab">
                        <i class="bi bi-search me-2"></i>Quiz-Suche
                    </button>
                </li>
                <?php if ($edit_session): ?>
                <li class="nav-item" role="presentation">
                    <button class="nav-link <?= $active_tab === 'edit' ? 'active' : '' ?>" id="edit-tab" data-bs-toggle="tab" data-bs-target="#edit" type="button" role="tab">
                        <i class="bi bi-pencil me-2"></i>Quiz bearbeiten
                    </button>
                </li>
                <?php endif; ?>
            </ul>

            <!-- Tab Content -->
            <div class="tab-content" id="quizTabsContent">

                <?php if ($error): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="bi bi-exclamation-triangle me-2"></i>
                        <?= htmlspecialchars($error) ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>

                <?php if ($success): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="bi bi-check-circle me-2"></i>
                        <?= htmlspecialchars($success) ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>

                <!-- Tab: Neuberechnung -->
                <div class="tab-pane fade <?= $active_tab === 'recalculate' ? 'show active' : '' ?>" id="recalculate" role="tabpanel">

            <div class="alert alert-danger border-danger mb-4">
                <h5 class="alert-heading">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                    WICHTIGE WARNUNG: Datenüberschreibung
                </h5>
                <hr>
                <p class="mb-2">
                    <strong>Diese Funktion überschreibt ALLE Quiz-Daten und kann nicht rückgängig gemacht werden!</strong>
                </p>
                <ul class="mb-2">
                    <li><strong>Quiz-Punkte:</strong> Alle Punkte werden basierend auf den aktuellen Frage-Einstellungen neu berechnet</li>
                    <li><strong>IT-Coins:</strong> Werden basierend auf den neuen Punkten neu berechnet und können sich ändern</li>
                    <li><strong>User-Statistiken:</strong> Werden basierend auf den neuen Punkten aktualisiert</li>
                </ul>
                <p class="mb-0">
                    <strong>Besonders wichtig:</strong> Wenn während eines Punkte-Events (z.B. 4 Punkte pro Frage) Quizzes absolviert wurden, 
                    werden diese bei der Neuberechnung mit der aktuellen Standard-Punktzahl (z.B. 1 Punkt pro Frage) neu berechnet. 
                    Die ursprünglich vergebenen Event-Punkte gehen verloren!
                </p>
            </div>

            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">
                        <i class="bi bi-info-circle me-2"></i>
                        Neuberechnung von Quiz-Punkten
                    </h5>
                </div>
                <div class="card-body">
                    <p class="text-muted">
                        Diese Funktion berechnet abgeschlossene Quizzes neu, um:
                    </p>
                    <ul class="text-muted">
                        <li>Teilpunkte für Multiple-Choice-Fragen korrekt zu berücksichtigen (50% bei teilweise richtigen Antworten)</li>
                        <li>Inkonsistenzen zu beheben, die durch Änderungen an Fragen oder Antworten entstanden sind</li>
                        <li>Dezimalpunkte korrekt zu speichern und anzuzeigen</li>
                    </ul>
                    <div class="alert alert-warning">
                        <i class="bi bi-exclamation-triangle me-2"></i>
                        <strong>Hinweis:</strong> Die Neuberechnung kann bei vielen Quizzes einige Zeit in Anspruch nehmen.
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="bi bi-gear me-2"></i>
                        Berechnungsoptionen
                    </h5>
                </div>
                <div class="card-body">
                    <form method="POST" id="recalculateForm">
                        <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                        
                        <div class="mb-4">
                            <label class="form-label fw-bold">Berechnungsart wählen:</label>
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="radio" name="recalculate_type" id="type_all" value="all" checked>
                                <label class="form-check-label" for="type_all">
                                    <strong>Alle abgeschlossenen Quizzes neu berechnen</strong>
                                    <small class="text-muted d-block">Berechnet alle Quiz-Sessions mit Status "completed" neu</small>
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="recalculate_type" id="type_single" value="single">
                                <label class="form-check-label" for="type_single">
                                    <strong>Bestimmtes Quiz neu berechnen</strong>
                                    <small class="text-muted d-block">Wählen Sie eine spezifische Quiz-Session aus</small>
                                </label>
                            </div>
                        </div>

                        <div class="mb-4" id="session_select_container" style="display: none;">
                            <label for="session_id" class="form-label fw-bold">Quiz-Session auswählen:</label>
                            <select class="form-select" id="session_id" name="session_id">
                                <option value="">-- Bitte wählen --</option>
                                <?php foreach ($available_sessions as $session): ?>
                                    <option value="<?= $session['id'] ?>">
                                        Session #<?= $session['id'] ?> - 
                                        <?= htmlspecialchars($session['username'] ?? 'Unbekannt') ?> - 
                                        <?= $session['learning_field_title'] ? htmlspecialchars($session['lf_number'] . ' - ' . $session['learning_field_title']) : 'Allgemeines Quiz' ?> - 
                                        <?= $session['completed_at'] ? date('d.m.Y H:i', strtotime($session['completed_at'])) : 'N/A' ?>
                                        (<?= number_format($session['total_score'], 2, ',', '.') ?> / <?= number_format($session['max_score'], 2, ',', '.') ?> Punkte)
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button type="submit" class="btn btn-primary" id="submitBtn">
                                <i class="bi bi-calculator me-2"></i>
                                Neuberechnung starten
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <?php if (!empty($results)): ?>
                <div class="card mt-4">
                    <div class="card-header">
                        <h5 class="mb-0">
                            <i class="bi bi-list-check me-2"></i>
                            Berechnungsergebnisse
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-sm table-hover">
                                <thead>
                                    <tr>
                                        <th>Session ID</th>
                                        <th>Status</th>
                                        <th>Alte Punkte</th>
                                        <th>Neue Punkte</th>
                                        <th>Max. Punkte</th>
                                        <th>Änderung</th>
                                        <th>IT-Coins</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($results as $result): ?>
                                        <tr>
                                            <td>#<?= $result['session_id'] ?></td>
                                            <td>
                                                <?php if ($result['status'] === 'success'): ?>
                                                    <span class="badge bg-success">
                                                        <i class="bi bi-check-circle me-1"></i>Erfolg
                                                    </span>
                                                <?php else: ?>
                                                    <span class="badge bg-danger">
                                                        <i class="bi bi-x-circle me-1"></i>Fehler
                                                    </span>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <?php if ($result['status'] === 'success'): ?>
                                                    <?= number_format($result['old_total'], 2, ',', '.') ?>
                                                <?php else: ?>
                                                    <span class="text-muted">-</span>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <?php if ($result['status'] === 'success'): ?>
                                                    <strong><?= number_format($result['new_total'], 2, ',', '.') ?></strong>
                                                <?php else: ?>
                                                    <span class="text-danger"><?= htmlspecialchars($result['message'] ?? 'Unbekannter Fehler') ?></span>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <?php if ($result['status'] === 'success'): ?>
                                                    <?= number_format($result['new_max'], 2, ',', '.') ?>
                                                <?php else: ?>
                                                    <span class="text-muted">-</span>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <?php if ($result['status'] === 'success' && isset($result['changed'])): ?>
                                                    <?php if ($result['changed']): ?>
                                                        <span class="badge bg-warning text-dark">
                                                            <i class="bi bi-arrow-right me-1"></i>
                                                            <?= number_format($result['new_total'] - $result['old_total'], 2, ',', '.') ?>
                                                        </span>
                                                    <?php else: ?>
                                                        <span class="text-muted">Keine Änderung</span>
                                                    <?php endif; ?>
                                                <?php else: ?>
                                                    <span class="text-muted">-</span>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <?php if (!empty($result['reward_status'])): ?>
                                                    <?php if ($result['reward_status'] === 'awarded'): ?>
                                                        <span class="badge bg-success">
                                                            <i class="bi bi-trophy-fill me-1"></i>
                                                            <?= htmlspecialchars($result['reward_message'] ?? 'IT-Coins vergeben') ?>
                                                        </span>
                                                    <?php elseif ($result['reward_status'] === 'error'): ?>
                                                        <span class="badge bg-danger">
                                                            <i class="bi bi-x-circle me-1"></i>
                                                            <?= htmlspecialchars($result['reward_message'] ?? 'Fehler') ?>
                                                        </span>
                                                    <?php else: ?>
                                                        <span class="badge bg-secondary">
                                                            <i class="bi bi-arrow-repeat me-1"></i>
                                                            <?= htmlspecialchars($result['reward_message'] ?? 'Keine Aktion') ?>
                                                        </span>
                                                    <?php endif; ?>
                                                <?php else: ?>
                                                    <span class="text-muted">-</span>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
                </div>
                <!-- End Tab: Neuberechnung -->

                <!-- Tab: Quiz-Suche -->
                <div class="tab-pane fade <?= $active_tab === 'search' ? 'show active' : '' ?>" id="search" role="tabpanel">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0"><i class="bi bi-hash me-2"></i>Suche nach Session ID</h5>
                                </div>
                                <div class="card-body">
                                    <form method="POST">
                                        <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                                        <input type="hidden" name="action" value="search_session">
                                        <div class="mb-3">
                                            <label for="search_session_id" class="form-label">Session ID:</label>
                                            <input type="number" class="form-control" id="search_session_id" name="search_session_id" required min="1">
                                        </div>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="bi bi-search me-2"></i>Suchen
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mb-0"><i class="bi bi-person me-2"></i>Suche nach User</h5>
                                </div>
                                <div class="card-body">
                                    <form method="POST">
                                        <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                                        <input type="hidden" name="action" value="search_user">
                                        <div class="mb-3">
                                            <label for="search_user" class="form-label">Username oder E-Mail:</label>
                                            <input type="text" class="form-control" id="search_user" name="search_user" required>
                                        </div>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="bi bi-search me-2"></i>Suchen
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php if (!empty($search_results)): ?>
                        <div class="card">
                            <div class="card-header">
                                <h5 class="mb-0"><i class="bi bi-list-ul me-2"></i>Suchergebnisse (<?= count($search_results) ?>)</h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>Session ID</th>
                                                <th>User</th>
                                                <th>Lernfeld</th>
                                                <th>Status</th>
                                                <th>Punkte</th>
                                                <th>Abgeschlossen</th>
                                                <th>Aktionen</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($search_results as $result): ?>
                                                <tr>
                                                    <td><strong>#<?= $result['id'] ?></strong></td>
                                                    <td><?= htmlspecialchars($result['username'] ?? 'Unbekannt') ?><br><small class="text-muted"><?= htmlspecialchars($result['email'] ?? '') ?></small></td>
                                                    <td><?= $result['learning_field_title'] ? htmlspecialchars($result['lf_number'] . ' - ' . $result['learning_field_title']) : 'Allgemein' ?></td>
                                                    <td><span class="badge bg-<?= $result['status'] === 'completed' ? 'success' : 'warning' ?>"><?= htmlspecialchars($result['status']) ?></span></td>
                                                    <td><?= number_format($result['total_score'], 2, ',', '.') ?> / <?= number_format($result['max_score'], 2, ',', '.') ?></td>
                                                    <td><?= $result['completed_at'] ? date('d.m.Y H:i', strtotime($result['completed_at'])) : '-' ?></td>
                                                    <td>
                                                        <form method="POST" style="display: inline;">
                                                            <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                                                            <input type="hidden" name="action" value="edit_quiz">
                                                            <input type="hidden" name="edit_session_id" value="<?= $result['id'] ?>">
                                                            <button type="submit" class="btn btn-sm btn-primary">
                                                                <i class="bi bi-pencil me-1"></i>Bearbeiten
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
                <!-- End Tab: Quiz-Suche -->

                <!-- Tab: Quiz bearbeiten -->
                <?php if ($edit_session): ?>
                <div class="tab-pane fade <?= $active_tab === 'edit' ? 'show active' : '' ?>" id="edit" role="tabpanel">
                    <div class="card mb-4">
                        <div class="card-header bg-info text-white">
                            <h5 class="mb-0">
                                <i class="bi bi-info-circle me-2"></i>
                                Quiz-Session #<?= $edit_session['id'] ?>
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <p><strong>User:</strong> <?= htmlspecialchars($edit_session['username'] ?? 'Unbekannt') ?> (<?= htmlspecialchars($edit_session['email'] ?? '') ?>)</p>
                                    <p><strong>Lernfeld:</strong> <?= $edit_session['learning_field_title'] ? htmlspecialchars($edit_session['lf_number'] . ' - ' . $edit_session['learning_field_title']) : 'Allgemein' ?></p>
                                    <p><strong>Status:</strong> <span class="badge bg-<?= $edit_session['status'] === 'completed' ? 'success' : 'warning' ?>"><?= htmlspecialchars($edit_session['status']) ?></span></p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Punkte:</strong> <?= number_format($edit_session['total_score'], 2, ',', '.') ?> / <?= number_format($edit_session['max_score'], 2, ',', '.') ?></p>
                                    <p><strong>Prozent:</strong> <?= $edit_session['max_score'] > 0 ? number_format(($edit_session['total_score'] / $edit_session['max_score']) * 100, 2, ',', '.') : 0 ?>%</p>
                                    <p><strong>Abgeschlossen:</strong> <?= $edit_session['completed_at'] ? date('d.m.Y H:i', strtotime($edit_session['completed_at'])) : '-' ?></p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <form method="POST" class="d-inline">
                                        <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                                        <input type="hidden" name="action" value="change_user">
                                        <input type="hidden" name="session_id" value="<?= $edit_session['id'] ?>">
                                        <div class="input-group">
                                            <label class="input-group-text">User ändern:</label>
                                            <select class="form-select" name="new_user_id" required>
                                                <option value="">-- User wählen --</option>
                                                <?php
                                                $users_stmt = $pdo->query("SELECT id, username, email FROM users ORDER BY username");
                                                foreach ($users_stmt->fetchAll() as $user):
                                                ?>
                                                    <option value="<?= $user['id'] ?>" <?= $user['id'] == $edit_session['user_id'] ? 'selected' : '' ?>>
                                                        <?= htmlspecialchars($user['username']) ?> (<?= htmlspecialchars($user['email']) ?>)
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                            <button type="submit" class="btn btn-warning">
                                                <i class="bi bi-person-check me-1"></i>Ändern
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0"><i class="bi bi-question-circle me-2"></i>Fragen bearbeiten</h5>
                        </div>
                        <div class="card-body">
                            <?php foreach ($edit_questions as $index => $question): ?>
                                <div class="card mb-3">
                                    <div class="card-header d-flex justify-content-between align-items-center">
                                        <span><strong>Frage <?= $index + 1 ?>:</strong> <?= htmlspecialchars($question['question_text']) ?></span>
                                        <span class="badge bg-<?= $question['question_type'] === 'multiple' ? 'info' : 'primary' ?>">
                                            <?= $question['question_type'] === 'multiple' ? 'Multiple Choice' : 'Single Choice' ?>
                                        </span>
                                    </div>
                                    <div class="card-body">
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <strong>Antwortoptionen:</strong>
                                                <ul class="list-group mt-2">
                                                    <?php foreach ($question['answer_options'] as $option): ?>
                                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                                            <span>
                                                                <?= htmlspecialchars($option['answer_text'] ?? '') ?>
                                                                <?php if ($option['is_correct'] ?? false): ?>
                                                                    <span class="badge bg-success ms-2">Richtig</span>
                                                                <?php endif; ?>
                                                            </span>
                                                            <?php if ($question['question_type'] === 'multiple'): ?>
                                                                <input type="checkbox" 
                                                                       class="form-check-input question-<?= $question['id'] ?>-selection" 
                                                                       value="<?= $option['id'] ?>"
                                                                       <?= in_array($option['id'], $question['selected_ids'] ?? []) ? 'checked' : '' ?>>
                                                            <?php else: ?>
                                                                <input type="radio" 
                                                                       class="form-check-input question-<?= $question['id'] ?>-selection" 
                                                                       name="question_<?= $question['id'] ?>_selection"
                                                                       value="<?= $option['id'] ?>"
                                                                       <?= $question['selected_answer_id'] == $option['id'] ? 'checked' : '' ?>>
                                                            <?php endif; ?>
                                                        </li>
                                                    <?php endforeach; ?>
                                                </ul>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label"><strong>Punkte manuell setzen:</strong></label>
                                                    <form method="POST" class="d-inline">
                                                        <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                                                        <input type="hidden" name="action" value="update_question_points">
                                                        <input type="hidden" name="session_id" value="<?= $edit_session['id'] ?>">
                                                        <input type="hidden" name="user_answer_id" value="<?= $question['user_answer_id'] ?? 0 ?>">
                                                        <div class="input-group">
                                                            <input type="number" 
                                                                   class="form-control" 
                                                                   name="points" 
                                                                   id="points_<?= $question['id'] ?>"
                                                                   value="<?= number_format($question['points_earned'] ?? 0, 2, '.', '') ?>" 
                                                                   step="0.01" 
                                                                   min="0" 
                                                                   max="<?= $question['points'] ?>">
                                                            <span class="input-group-text">/ <?= $question['points'] ?></span>
                                                            <button type="submit" class="btn btn-sm btn-warning">
                                                                <i class="bi bi-save me-1"></i>Punkte speichern
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="mb-2">
                                                    <label class="form-label"><strong>Auswahl ändern:</strong></label>
                                                    <form method="POST" onsubmit="return collectSelections(<?= $question['id'] ?>, '<?= $question['question_type'] ?>', this)">
                                                        <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                                                        <input type="hidden" name="action" value="update_question_selection">
                                                        <input type="hidden" name="session_id" value="<?= $edit_session['id'] ?>">
                                                        <input type="hidden" name="question_id" value="<?= $question['id'] ?>">
                                                        <input type="hidden" name="question_type" value="<?= $question['question_type'] ?>">
                                                        <input type="hidden" name="user_answer_id" value="<?= $question['user_answer_id'] ?? 0 ?>">
                                                        <div id="selected_ids_<?= $question['id'] ?>"></div>
                                                        <button type="submit" class="btn btn-sm btn-primary">
                                                            <i class="bi bi-save me-1"></i>Auswahl speichern
                                                        </button>
                                                    </form>
                                                </div>
                                                <div>
                                                    <strong>Aktuelle Punkte:</strong> 
                                                    <span class="badge bg-<?= ($question['points_earned'] ?? 0) >= $question['points'] ? 'success' : (($question['points_earned'] ?? 0) > 0 ? 'warning' : 'danger') ?>">
                                                        <?= number_format($question['points_earned'] ?? 0, 2, ',', '.') ?> / <?= $question['points'] ?>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
                <!-- End Tab: Quiz bearbeiten -->
            </div>
            <!-- End Tab Content -->
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const typeAll = document.getElementById('type_all');
    const typeSingle = document.getElementById('type_single');
    const sessionSelectContainer = document.getElementById('session_select_container');
    const sessionSelect = document.getElementById('session_id');
    const form = document.getElementById('recalculateForm');
    const submitBtn = document.getElementById('submitBtn');
    
    // Toggle Session-Auswahl basierend auf Radio-Button
    function toggleSessionSelect() {
        if (typeSingle.checked) {
            sessionSelectContainer.style.display = 'block';
            sessionSelect.required = true;
        } else {
            sessionSelectContainer.style.display = 'none';
            sessionSelect.required = false;
        }
    }
    
    typeAll.addEventListener('change', toggleSessionSelect);
    typeSingle.addEventListener('change', toggleSessionSelect);
    
    // Form-Submit mit Bestätigung
    form.addEventListener('submit', function(e) {
        if (typeAll.checked) {
            if (!confirm('Möchten Sie wirklich ALLE abgeschlossenen Quizzes neu berechnen? Dies kann einige Zeit in Anspruch nehmen.')) {
                e.preventDefault();
                return false;
            }
        } else {
            if (!sessionSelect.value) {
                e.preventDefault();
                alert('Bitte wählen Sie eine Quiz-Session aus.');
                return false;
            }
            if (!confirm('Möchten Sie diese Quiz-Session wirklich neu berechnen?')) {
                e.preventDefault();
                return false;
            }
        }
        
        // Button deaktivieren während Verarbeitung
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Berechne...';
    });
    
    // Funktion zum Sammeln der Auswahl für Multiple-Choice-Fragen
    window.collectSelections = function(questionId, questionType, form) {
        const selectedIds = [];
        
        if (questionType === 'multiple') {
            const checkboxes = document.querySelectorAll('.question-' + questionId + '-selection:checked');
            checkboxes.forEach(function(cb) {
                selectedIds.push(cb.value);
            });
        } else {
            const radio = document.querySelector('.question-' + questionId + '-selection:checked');
            if (radio) {
                selectedIds.push(radio.value);
            }
        }
        
        // Erstelle versteckte Inputs für selected_ids
        const hiddenDiv = document.getElementById('selected_ids_' + questionId);
        hiddenDiv.innerHTML = '';
        
        if (questionType === 'multiple') {
            selectedIds.forEach(function(id) {
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'selected_ids[]';
                input.value = id;
                hiddenDiv.appendChild(input);
            });
        } else {
            if (selectedIds.length > 0) {
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'selected_id';
                input.value = selectedIds[0];
                hiddenDiv.appendChild(input);
            }
        }
        
        return true;
    };
});
</script>

<?php
include '../includes/admin_layout_end.php';
include '../includes/footer.php';
?>

