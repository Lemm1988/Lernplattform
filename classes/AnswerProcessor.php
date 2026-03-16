<?php
/**
 * AnswerProcessor - Handles processing and validation of quiz answers
 * Supports both single-choice and multiple-choice question types
 */

require_once __DIR__ . '/CodeFormatter.php';

class AnswerProcessor {
    private $pdo;
    private $enablePartialPoints = false;
    
    public function __construct($pdo) {
        $this->pdo = $pdo;
        if (function_exists('get_setting')) {
            $this->enablePartialPoints = get_setting('enable_partial_points', '0') === '1';
        }
    }
    
    /**
     * Process answer based on question type
     * 
     * @param int $questionId The question ID
     * @param string $questionType 'single' or 'multiple'
     * @param mixed $selectedAnswers Single answer ID or array of answer IDs
     * @param int $quizSessionId The quiz session ID
     * @return array Result with score and correctness
     */
    public function processAnswer($questionId, $questionType, $selectedAnswers, $quizSessionId) {
        if ($questionType === 'multiple') {
            return $this->processMultipleChoice($questionId, $selectedAnswers, $quizSessionId);
        }
        return $this->processSingleChoice($questionId, $selectedAnswers, $quizSessionId);
    }
    
    /**
     * Process single-choice question answer
     * 
     * @param int $questionId The question ID
     * @param int $selectedAnswer The selected answer ID
     * @param int $quizSessionId The quiz session ID
     * @return array Result with score and correctness
     */
    public function processSingleChoice($questionId, $selectedAnswer, $quizSessionId) {
        // Validate input
        if (!is_numeric($selectedAnswer) || !is_numeric($questionId) || !is_numeric($quizSessionId)) {
            throw new InvalidArgumentException('Invalid input parameters');
        }
        
        try {
            // Get correct answer and question points
            $stmt = $this->pdo->prepare("
                SELECT ao.is_correct, q.points 
                FROM answer_options ao 
                JOIN questions q ON q.id = ao.question_id 
                WHERE ao.id = ? AND ao.question_id = ?
            ");
            $stmt->execute([$selectedAnswer, $questionId]);
            $result = $stmt->fetch();
            
            if (!$result) {
                throw new Exception('Invalid answer option for question');
            }
            
            $isCorrect = (bool)$result['is_correct'];
            // WICHTIG: points als float behandeln für Konsistenz
            $points = $isCorrect ? (float)$result['points'] : 0.0;
            
            // Save user answer
            $this->saveUserAnswer($quizSessionId, $questionId, $selectedAnswer, $isCorrect, $points);
            
            return [
                'is_correct' => $isCorrect,
                'points_earned' => $points,
                'selected_answers' => [$selectedAnswer]
            ];
            
        } catch (PDOException $e) {
            throw new Exception('Database error processing single choice answer: ' . $e->getMessage());
        }
    }
    
    /**
     * Process multiple-choice question answer
     * 
     * @param int $questionId The question ID
     * @param array $selectedAnswers Array of selected answer IDs
     * @param int $quizSessionId The quiz session ID
     * @return array Result with score and correctness
     */
    public function processMultipleChoice($questionId, $selectedAnswers, $quizSessionId) {
        // Validate input
        if (!is_array($selectedAnswers) || !is_numeric($questionId) || !is_numeric($quizSessionId)) {
            throw new InvalidArgumentException('Invalid input parameters');
        }
        
        // Sanitize selected answers
        $selectedAnswers = array_filter(array_map('intval', $selectedAnswers));
        
        if (empty($selectedAnswers)) {
            throw new InvalidArgumentException('No answers selected');
        }
        
        try {
            // Get all correct answers for this question
            $stmt = $this->pdo->prepare("
                SELECT id, is_correct 
                FROM answer_options 
                WHERE question_id = ?
            ");
            $stmt->execute([$questionId]);
            $allAnswers = $stmt->fetchAll();
            
            if (empty($allAnswers)) {
                throw new Exception('No answer options found for question');
            }
            
            // Get question points
            $stmt = $this->pdo->prepare("SELECT points FROM questions WHERE id = ?");
            $stmt->execute([$questionId]);
            $questionData = $stmt->fetch();
            
            if (!$questionData) {
                throw new Exception('Question not found');
            }
            
            // WICHTIG: points als float behandeln für Teilpunkte (z.B. 0.5)
            $maxPoints = (float)$questionData['points'];
            
            // Determine correct answers
            $correctAnswerIds = [];
            $answerMap = [];
            
            foreach ($allAnswers as $answer) {
                $answerMap[$answer['id']] = (bool)$answer['is_correct'];
                if ($answer['is_correct']) {
                    $correctAnswerIds[] = $answer['id'];
                }
            }
            
            // Validate selected answers exist for this question
            foreach ($selectedAnswers as $answerId) {
                if (!isset($answerMap[$answerId])) {
                    throw new Exception('Invalid answer option selected');
                }
            }
            
            // Calculate correctness and points with partial credit
            $evaluation = $this->evaluateMultipleChoiceWithPartialCredit($selectedAnswers, $correctAnswerIds, $answerMap, $maxPoints);
            $isCorrect = $evaluation['is_correct'];
            $points = $evaluation['points'];
            
            // Save user answer (null for selected_answer_id in multiple choice)
            $userAnswerId = $this->saveUserAnswer($quizSessionId, $questionId, null, $isCorrect, $points);
            
            // Save individual selections
            $this->saveUserAnswerSelections($userAnswerId, $selectedAnswers);
            
            return [
                'is_correct' => $isCorrect,
                'points_earned' => $points,
                'selected_answers' => $selectedAnswers,
                'correct_answers' => $correctAnswerIds
            ];
            
        } catch (PDOException $e) {
            throw new Exception('Database error processing multiple choice answer: ' . $e->getMessage());
        }
    }
    
    /**
     * Evaluate if multiple choice selection is correct
     * All correct answers must be selected and no incorrect answers
     * 
     * @param array $selectedAnswers User's selected answer IDs
     * @param array $correctAnswers Correct answer IDs
     * @param array $answerMap Map of answer ID to correctness
     * @return bool True if completely correct
     */
    private function evaluateMultipleChoiceCorrectness($selectedAnswers, $correctAnswers, $answerMap) {
        // Check if all correct answers are selected
        foreach ($correctAnswers as $correctId) {
            if (!in_array($correctId, $selectedAnswers)) {
                return false;
            }
        }
        
        // Check if any incorrect answers are selected
        foreach ($selectedAnswers as $selectedId) {
            if (!$answerMap[$selectedId]) {
                return false;
            }
        }
        
        return true;
    }
    
    /**
     * Evaluate multiple choice with partial credit
     * - 100% points if all correct answers selected and no incorrect answers
     * - 50% points if some correct answers selected but not all, or some incorrect answers selected
     * - 0% points if no correct answers selected
     * 
     * @param array $selectedAnswers User's selected answer IDs
     * @param array $correctAnswers Correct answer IDs
     * @param array $answerMap Map of answer ID to correctness
     * @param int $maxPoints Maximum points for this question
     * @return array ['is_correct' => bool, 'points' => int]
     */
    private function evaluateMultipleChoiceWithPartialCredit($selectedAnswers, $correctAnswers, $answerMap, $maxPoints) {
        // WICHTIG: maxPoints als float behandeln
        $maxPoints = (float)$maxPoints;
        
        if (empty($selectedAnswers)) {
            return ['is_correct' => false, 'points' => 0.0];
        }
        
        // Count correct and incorrect selections
        $correctSelected = 0;
        $incorrectSelected = 0;
        
        foreach ($selectedAnswers as $selectedId) {
            if (isset($answerMap[$selectedId])) {
                if ($answerMap[$selectedId]) {
                    $correctSelected++;
                } else {
                    $incorrectSelected++;
                }
            }
        }
        
        $totalCorrect = count($correctAnswers);
        
        // Perfect answer: all correct selected, no incorrect selected
        if ($correctSelected === $totalCorrect && $incorrectSelected === 0) {
            return ['is_correct' => true, 'points' => (float)$maxPoints];
        }
        
        // No correct answers selected
        if ($correctSelected === 0) {
            return ['is_correct' => false, 'points' => 0.0];
        }
        
        // Teilpunkte deaktiviert -> nur volle Punktzahl bei perfekter Antwort
        if (!$this->enablePartialPoints) {
            return ['is_correct' => false, 'points' => 0.0];
        }
        
        // Partial credit: some correct answers selected (50% of points)
        // WICHTIG: Als float zurückgeben, nicht als int, damit 0.5 Punkte erhalten bleiben
        return ['is_correct' => false, 'points' => round((float)$maxPoints * 0.5, 2)];
    }
    
    /**
     * Save user answer to database
     * 
     * @param int $quizSessionId Quiz session ID 
     * @param int $questionId Question ID
     * @param int|null $selectedAnswerId Selected answer ID (null for multiple choice)
     * @param bool $isCorrect Whether answer is correct
     * @param int $points Points earned
     * @return int User answer ID
     */
    private function saveUserAnswer($quizSessionId, $questionId, $selectedAnswerId, $isCorrect, $points) {
        // Stellt sicher, dass $points als float behandelt wird, um spätere Inkonsistenzen zu vermeiden
        $points = (float)$points;
        
        $stmt = $this->pdo->prepare("
            INSERT INTO user_answers (quiz_session_id, question_id, selected_answer_id, is_correct, points_earned, answered_at)
            VALUES (?, ?, ?, ?, ?, NOW())
        ");
        $stmt->execute([$quizSessionId, $questionId, $selectedAnswerId, $isCorrect ? 1 : 0, $points]);
        
        return $this->pdo->lastInsertId();
    }
    
    /**
     * Save multiple choice selections to user_answer_selections table
     * 
     * @param int $userAnswerId User answer ID
     * @param array $selectedAnswers Array of selected answer IDs
     */
    private function saveUserAnswerSelections($userAnswerId, $selectedAnswers) {
        $stmt = $this->pdo->prepare("
            INSERT INTO user_answer_selections (user_answer_id, selected_answer_id)
            VALUES (?, ?)
        ");
        
        foreach ($selectedAnswers as $answerId) {
            $stmt->execute([$userAnswerId, $answerId]);
        }
    }
    
    /**
     * Validate answer selection for a question
     * 
     * @param int $questionId Question ID
     * @param mixed $selectedAnswers Single answer ID or array of answer IDs
     * @param string $questionType 'single' or 'multiple'
     * @return bool True if valid
     */
    public function validateAnswerSelection($questionId, $selectedAnswers, $questionType) {
        try {
            if ($questionType === 'single') {
                return is_numeric($selectedAnswers) && $selectedAnswers > 0;
            } else {
                return is_array($selectedAnswers) && 
                       !empty($selectedAnswers) && 
                       count(array_filter($selectedAnswers, 'is_numeric')) === count($selectedAnswers);
            }
        } catch (Exception $e) {
            return false;
        }
    }
}