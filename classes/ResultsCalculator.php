<?php
/**
 * ResultsCalculator - Calculates and formats quiz results
 * Handles both single-choice and multiple-choice questions
 */

require_once __DIR__ . '/CodeFormatter.php';

class ResultsCalculator {
    private $pdo;
    
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    
    /**
     * Calculate comprehensive results for a quiz session
     * 
     * @param int $quizSessionId Quiz session ID
     * @return array Detailed results including scores and answers
     */
    public function calculateResults($quizSessionId) {
        if (!is_numeric($quizSessionId)) {
            throw new InvalidArgumentException('Quiz session ID must be numeric');
        }
        
        try {
            // Get quiz session info
            $sessionInfo = $this->getQuizSessionInfo($quizSessionId);
            if (!$sessionInfo) {
                throw new Exception('Quiz session not found');
            }
            
            // Get question IDs from questions_json
            $question_ids = [];
            if (!empty($sessionInfo['questions_json'])) {
                $decoded = json_decode($sessionInfo['questions_json'], true);
                if (is_array($decoded)) {
                    $question_ids = $decoded;
                }
            }
            
            // Calculate total questions and max possible points from ALL questions in the quiz
            $total_questions = count($question_ids);
            $max_possible_points = 0;
            
            if (!empty($question_ids)) {
                $placeholders = str_repeat('?,', count($question_ids) - 1) . '?';
                $max_points_stmt = $this->pdo->prepare("SELECT SUM(points) FROM questions WHERE id IN ($placeholders)");
                $max_points_stmt->execute($question_ids);
                $max_possible_points = (int)($max_points_stmt->fetchColumn() ?: 0);
            }
            
            // Get all user answers for this session
            $userAnswers = $this->getUserAnswers($quizSessionId);
            
            // Create a map of question_id => userAnswer for quick lookup
            $userAnswersMap = [];
            foreach ($userAnswers as $userAnswer) {
                $userAnswersMap[$userAnswer['question_id']] = $userAnswer;
            }
            
            // Calculate detailed results
            $results = [
                'session_info' => $sessionInfo,
                'total_questions' => $total_questions,
                'correct_answers' => 0,
                'total_points' => 0,
                'max_possible_points' => $max_possible_points,
                'percentage' => 0,
                'questions' => []
            ];
            
            // Process each question in the quiz (in order from questions_json)
            foreach ($question_ids as $questionId) {
                if (isset($userAnswersMap[$questionId])) {
                    // Question was answered
                    $userAnswer = $userAnswersMap[$questionId];
                    $questionResult = $this->processQuestionResult($userAnswer);
                    $results['questions'][] = $questionResult;
                    
                    if ($questionResult['is_correct']) {
                        $results['correct_answers']++;
                    }
                    
                    $results['total_points'] += $questionResult['points_earned'];
                } else {
                    // Question was not answered - create a result with 0 points
                    $question_stmt = $this->pdo->prepare("
                        SELECT id, question_text, image_path, 
                               COALESCE(question_type, 'single') as question_type, 
                               points as max_points
                        FROM questions 
                        WHERE id = ?
                    ");
                    $question_stmt->execute([$questionId]);
                    $question = $question_stmt->fetch();
                    
                    if ($question) {
                        $results['questions'][] = [
                            'question_id' => $questionId,
                            'question_text' => $question['question_text'],
                            'question_type' => $question['question_type'],
                            'is_correct' => false,
                            'points_earned' => 0,
                            'max_points' => (int)$question['max_points'],
                            'correct_answers' => [],
                            'selected_answers' => [],
                            'all_answers' => []
                        ];
                    }
                }
            }
            
            // Calculate percentage based on actual max_possible_points
            if ($results['max_possible_points'] > 0) {
                $results['percentage'] = round(($results['total_points'] / $results['max_possible_points']) * 100, 2);
            }
            
            return $results;
            
        } catch (PDOException $e) {
            throw new Exception('Database error calculating results: ' . $e->getMessage());
        }
    }
    
    /**
     * Get all correct answers for a single-choice question
     * 
     * @param int $questionId Question ID
     * @return array Correct answer information
     */
    public function getCorrectAnswersSingleChoice($questionId) {
        if (!is_numeric($questionId)) {
            throw new InvalidArgumentException('Question ID must be numeric');
        }
        
        try {
            $stmt = $this->pdo->prepare("
                SELECT ao.id, ao.answer_text, ao.is_correct
                FROM answer_options ao
                WHERE ao.question_id = ? AND ao.is_correct = 1
                ORDER BY ao.sort_order, ao.id
            ");
            $stmt->execute([$questionId]);
            $correctAnswers = $stmt->fetchAll();
            
            if (empty($correctAnswers)) {
                throw new Exception("No correct answers found for question {$questionId}");
            }
            
            return $correctAnswers;
            
        } catch (PDOException $e) {
            throw new Exception('Database error fetching correct answers: ' . $e->getMessage());
        }
    }
    
    /**
     * Get all correct answers for a multiple-choice question
     * 
     * @param int $questionId Question ID
     * @return array All correct answer information
     */
    public function getCorrectAnswersMultipleChoice($questionId) {
        if (!is_numeric($questionId)) {
            throw new InvalidArgumentException('Question ID must be numeric');
        }
        
        try {
            $stmt = $this->pdo->prepare("
                SELECT ao.id, ao.answer_text, ao.is_correct
                FROM answer_options ao
                WHERE ao.question_id = ? AND ao.is_correct = 1
                ORDER BY ao.sort_order, ao.id
            ");
            $stmt->execute([$questionId]);
            $correctAnswers = $stmt->fetchAll();
            
            if (empty($correctAnswers)) {
                throw new Exception("No correct answers found for multiple-choice question {$questionId}");
            }
            
            return $correctAnswers;
            
        } catch (PDOException $e) {
            throw new Exception('Database error fetching multiple-choice correct answers: ' . $e->getMessage());
        }
    }
    
    /**
     * Get user's selected answers for a question
     * 
     * @param int $userAnswerId User answer ID
     * @param string $questionType Question type ('single' or 'multiple')
     * @return array Selected answer information
     */
    public function getUserSelectedAnswers($userAnswerId, $questionType) {
        if (!is_numeric($userAnswerId)) {
            throw new InvalidArgumentException('User answer ID must be numeric');
        }
        
        try {
            if ($questionType === 'single') {
                return $this->getUserSelectedAnswersSingle($userAnswerId);
            } else {
                return $this->getUserSelectedAnswersMultiple($userAnswerId);
            }
        } catch (PDOException $e) {
            throw new Exception('Database error fetching user selected answers: ' . $e->getMessage());
        }
    }
    
    /**
     * Format results for display with error handling
     * 
     * @param array $results Raw results from calculateResults
     * @return array Formatted results ready for display
     */
    public function formatResultsForDisplay($results) {
        if (!is_array($results)) {
            throw new InvalidArgumentException('Results must be an array');
        }
        
        try {
            $passing_percentage = (float)get_setting('passing_score_percentage', PASSING_SCORE_PERCENTAGE);
            if ($passing_percentage <= 0) {
                $passing_percentage = 60;
            }
            $formatted = [
                'summary' => [
                    'total_questions' => $results['total_questions'] ?? 0,
                    'correct_answers' => $results['correct_answers'] ?? 0,
                    'total_points' => $results['total_points'] ?? 0,
                    'max_possible_points' => $results['max_possible_points'] ?? 0,
                    'percentage' => $results['percentage'] ?? 0,
                    'passed' => ($results['percentage'] ?? 0) >= $passing_percentage
                ],
                'questions' => []
            ];
            
            foreach ($results['questions'] ?? [] as $question) {
                $formatted['questions'][] = $this->formatQuestionForDisplay($question);
            }
            
            return $formatted;
            
        } catch (Exception $e) {
            // Return safe fallback if formatting fails
            return [
                'summary' => [
                    'total_questions' => 0,
                    'correct_answers' => 0,
                    'total_points' => 0,
                    'max_possible_points' => 0,
                    'percentage' => 0,
                    'passed' => false,
                    'error' => 'Error formatting results: ' . $e->getMessage()
                ],
                'questions' => []
            ];
        }
    }
    
    /**
     * Get quiz session information
     * 
     * @param int $quizSessionId Quiz session ID
     * @return array|null Session information
     */
    private function getQuizSessionInfo($quizSessionId) {
        try {
            $stmt = $this->pdo->prepare("
                SELECT qs.*, u.username, lf.title as learning_field_name
                FROM quiz_sessions qs
                LEFT JOIN users u ON qs.user_id = u.id
                LEFT JOIN learning_fields lf ON qs.learning_field_id = lf.id
                WHERE qs.id = ?
            ");
            $stmt->execute([$quizSessionId]);
            return $stmt->fetch();
        } catch (PDOException $e) {
            error_log("Error getting quiz session info: " . $e->getMessage());
            return null;
        }
    }
    
    /**
     * Get all user answers for a quiz session
     * 
     * @param int $quizSessionId Quiz session ID
     * @return array User answers with question information
     */
    private function getUserAnswers($quizSessionId) {
        try {
            // Get unique user answers (in case of duplicates, take the latest one)
            $stmt = $this->pdo->prepare("
                SELECT ua.id,
                       ua.quiz_session_id,
                       ua.question_id,
                       ua.selected_answer_id,
                       ua.is_correct,
                       ua.points_earned,  -- Explizit aus user_answers laden (DECIMAL für Teilpunkte)
                       ua.answered_at,
                       q.question_text,
                       q.image_path,
                       COALESCE(q.question_type, 'single') as question_type, 
                       q.points as max_points
                FROM user_answers ua
                JOIN questions q ON ua.question_id = q.id
                WHERE ua.quiz_session_id = ?
                AND ua.id IN (
                    SELECT MAX(id) 
                    FROM user_answers 
                    WHERE quiz_session_id = ? 
                    GROUP BY question_id
                )
                ORDER BY ua.id
            ");
            $stmt->execute([$quizSessionId, $quizSessionId]);
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            error_log("Error getting user answers: " . $e->getMessage());
            return [];
        }
    }
    
    /**
     * Process individual question result
     * 
     * @param array $userAnswer User answer data
     * @return array Processed question result
     */
    private function processQuestionResult($userAnswer) {
        try {
            $questionId = $userAnswer['question_id'];
            $questionType = $userAnswer['question_type'];
            $userAnswerId = $userAnswer['id'];
            
            // Get correct answers
            if ($questionType === 'single') {
                $correctAnswers = $this->getCorrectAnswersSingleChoice($questionId);
            } else {
                $correctAnswers = $this->getCorrectAnswersMultipleChoice($questionId);
            }
            
            // Get user's selected answers
            $selectedAnswers = $this->getUserSelectedAnswers($userAnswerId, $questionType);
            
            // Get all answer options for context
            $allAnswers = $this->getAllAnswerOptions($questionId);
            
            // WICHTIG: points_earned explizit aus user_answers laden und als float behandeln
            // PDO gibt DECIMAL-Werte möglicherweise als String zurück, daher explizite Konvertierung
            $points_earned = (float)$userAnswer['points_earned'];
            $max_points = (float)$userAnswer['max_points'];
            
            // Prüfe ob teilweise richtig (0 < points_earned < max_points)
            // WICHTIG: Basierend auf points_earned, nicht auf is_correct!
            // Bei Multiple-Choice mit Teilpunkten kann is_correct = 0 sein, aber points_earned = 0.5
            $is_partially_correct = ($points_earned > 0 && $points_earned < $max_points);
            
            // is_correct basierend auf Punkten neu bestimmen (für Anzeige)
            // Wenn points_earned >= max_points, dann vollständig richtig
            $is_fully_correct = ($max_points > 0 && $points_earned >= $max_points);
            
            return [
                'question_id' => $questionId,
                'question_text' => $userAnswer['question_text'],
                'question_type' => $questionType,
                'image_path' => $userAnswer['image_path'] ?? null,
                'is_correct' => $is_fully_correct,  // Basierend auf Punkten, nicht DB-Wert
                'is_partially_correct' => $is_partially_correct,
                'points_earned' => $points_earned,  // float für Dezimalwerte (z.B. 0.5)
                'max_points' => $max_points,        // float für Dezimalwerte
                'correct_answers' => $correctAnswers,
                'selected_answers' => $selectedAnswers,
                'all_answers' => $allAnswers
            ];
            
        } catch (Exception $e) {
            // Return safe fallback for this question
            return [
                'question_id' => $userAnswer['question_id'] ?? 0,
                'question_text' => $userAnswer['question_text'] ?? 'Question text unavailable',
                'question_type' => $userAnswer['question_type'] ?? 'single',
                'image_path' => $userAnswer['image_path'] ?? null,
                'is_correct' => false,
                'points_earned' => 0,
                'max_points' => $userAnswer['max_points'] ?? 0,
                'correct_answers' => [],
                'selected_answers' => [],
                'all_answers' => [],
                'error' => 'Error processing question: ' . $e->getMessage()
            ];
        }
    }
    
    /**
     * Get user's selected answers for single-choice question
     * 
     * @param int $userAnswerId User answer ID
     * @return array Selected answer information
     */
    private function getUserSelectedAnswersSingle($userAnswerId) {
        try {
            $stmt = $this->pdo->prepare("
                SELECT ao.id, ao.answer_text, ao.is_correct
                FROM user_answers ua
                JOIN answer_options ao ON ua.selected_answer_id = ao.id
                WHERE ua.id = ? AND ua.selected_answer_id IS NOT NULL
            ");
            $stmt->execute([$userAnswerId]);
            $result = $stmt->fetch();
            
            return $result ? [$result] : [];
        } catch (PDOException $e) {
            error_log("Error getting single choice selection: " . $e->getMessage());
            return [];
        }
    }
    
    /**
     * Get user's selected answers for multiple-choice question
     * 
     * @param int $userAnswerId User answer ID
     * @return array Selected answer information
     */
    private function getUserSelectedAnswersMultiple($userAnswerId) {
        try {
            // Check if user_answer_selections table exists and has data
            $stmt = $this->pdo->prepare("
                SELECT ao.id, ao.answer_text, ao.is_correct
                FROM user_answer_selections uas
                JOIN answer_options ao ON uas.selected_answer_id = ao.id
                WHERE uas.user_answer_id = ?
                ORDER BY ao.sort_order, ao.id
            ");
            $stmt->execute([$userAnswerId]);
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            error_log("Error getting multiple choice selections: " . $e->getMessage());
            // Fallback: return empty array for multiple choice questions without selections
            return [];
        }
    }
    
    /**
     * Get all answer options for a question
     * 
     * @param int $questionId Question ID
     * @return array All answer options
     */
    private function getAllAnswerOptions($questionId) {
        $stmt = $this->pdo->prepare("
            SELECT id, answer_text, is_correct
            FROM answer_options
            WHERE question_id = ?
            ORDER BY sort_order, id
        ");
        $stmt->execute([$questionId]);
        return $stmt->fetchAll();
    }
    
    /**
     * Format individual question for display
     * 
     * @param array $question Question result data
     * @return array Formatted question data
     */
    private function formatQuestionForDisplay($question) {
        return [
            'question_id' => $question['question_id'],
            'question_text' => formatTextWithCode($question['question_text']),
            'question_type' => $question['question_type'],
            'image_path' => $question['image_path'] ?? null,
            'is_correct' => $question['is_correct'],
            'points_earned' => $question['points_earned'],
            'max_points' => $question['max_points'],
            'status_class' => $question['is_correct'] ? 'correct' : 'incorrect',
            'status_text' => $question['is_correct'] ? 'Richtig' : 'Falsch',
            'correct_answers' => array_map(function($answer) {
                return [
                    'id' => $answer['id'],
                    'text' => formatTextWithCode($answer['answer_text']),
                    'is_correct' => (bool)$answer['is_correct']
                ];
            }, $question['correct_answers']),
            'selected_answers' => array_map(function($answer) {
                return [
                    'id' => $answer['id'],
                    'text' => formatTextWithCode($answer['answer_text']),
                    'is_correct' => (bool)$answer['is_correct']
                ];
            }, $question['selected_answers']),
            'error' => $question['error'] ?? null
        ];
    }
}