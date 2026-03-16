<?php
/**
 * Unit tests for ResultsCalculator class
 */

require_once __DIR__ . '/../classes/ResultsCalculator.php';

class ResultsCalculatorTest {
    private $pdo;
    private $calculator;
    
    public function setUp() {
        // Create in-memory SQLite database for testing
        $this->pdo = new PDO('sqlite::memory:');
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        // Create test tables
        $this->createTestTables();
        $this->insertTestData();
        
        $this->calculator = new ResultsCalculator($this->pdo);
    }
    
    private function createTestTables() {
        $this->pdo->exec("
            CREATE TABLE users (
                id INTEGER PRIMARY KEY,
                username TEXT
            )
        ");
        
        $this->pdo->exec("
            CREATE TABLE learning_fields (
                id INTEGER PRIMARY KEY,
                name TEXT
            )
        ");
        
        $this->pdo->exec("
            CREATE TABLE questions (
                id INTEGER PRIMARY KEY,
                question_text TEXT,
                question_type TEXT DEFAULT 'single',
                points INTEGER DEFAULT 4
            )
        ");
        
        $this->pdo->exec("
            CREATE TABLE answer_options (
                id INTEGER PRIMARY KEY,
                question_id INTEGER,
                answer_text TEXT,
                is_correct INTEGER DEFAULT 0,
                sort_order INTEGER DEFAULT 0
            )
        ");
        
        $this->pdo->exec("
            CREATE TABLE quiz_sessions (
                id INTEGER PRIMARY KEY,
                user_id INTEGER,
                learning_field_id INTEGER,
                created_at DATETIME DEFAULT CURRENT_TIMESTAMP
            )
        ");
        
        $this->pdo->exec("
            CREATE TABLE user_answers (
                id INTEGER PRIMARY KEY,
                quiz_session_id INTEGER,
                question_id INTEGER,
                selected_answer_id INTEGER,
                is_correct INTEGER DEFAULT 0,
                points_earned INTEGER DEFAULT 0,
                answered_at DATETIME DEFAULT CURRENT_TIMESTAMP
            )
        ");
        
        $this->pdo->exec("
            CREATE TABLE user_answer_selections (
                id INTEGER PRIMARY KEY,
                user_answer_id INTEGER,
                selected_answer_id INTEGER
            )
        ");
    }
    
    private function insertTestData() {
        // Insert test user and learning field
        $this->pdo->exec("INSERT INTO users (id, username) VALUES (1, 'testuser')");
        $this->pdo->exec("INSERT INTO learning_fields (id, name) VALUES (1, 'Test Field')");
        
        // Insert test questions
        $this->pdo->exec("INSERT INTO questions (id, question_text, question_type, points) VALUES (1, 'Single choice question?', 'single', 4)");
        $this->pdo->exec("INSERT INTO questions (id, question_text, question_type, points) VALUES (2, 'Multiple choice question?', 'multiple', 4)");
        
        // Insert answer options for single choice question
        $this->pdo->exec("INSERT INTO answer_options (id, question_id, answer_text, is_correct, sort_order) VALUES (1, 1, 'Wrong answer', 0, 1)");
        $this->pdo->exec("INSERT INTO answer_options (id, question_id, answer_text, is_correct, sort_order) VALUES (2, 1, 'Correct answer', 1, 2)");
        $this->pdo->exec("INSERT INTO answer_options (id, question_id, answer_text, is_correct, sort_order) VALUES (3, 1, 'Another wrong', 0, 3)");
        
        // Insert answer options for multiple choice question
        $this->pdo->exec("INSERT INTO answer_options (id, question_id, answer_text, is_correct, sort_order) VALUES (4, 2, 'Correct option 1', 1, 1)");
        $this->pdo->exec("INSERT INTO answer_options (id, question_id, answer_text, is_correct, sort_order) VALUES (5, 2, 'Wrong option', 0, 2)");
        $this->pdo->exec("INSERT INTO answer_options (id, question_id, answer_text, is_correct, sort_order) VALUES (6, 2, 'Correct option 2', 1, 3)");
        
        // Insert test quiz session
        $this->pdo->exec("INSERT INTO quiz_sessions (id, user_id, learning_field_id) VALUES (1, 1, 1)");
        
        // Insert test user answers
        $this->pdo->exec("INSERT INTO user_answers (id, quiz_session_id, question_id, selected_answer_id, is_correct, points_earned) VALUES (1, 1, 1, 2, 1, 4)");
        $this->pdo->exec("INSERT INTO user_answers (id, quiz_session_id, question_id, selected_answer_id, is_correct, points_earned) VALUES (2, 1, 2, NULL, 1, 4)");
        
        // Insert multiple choice selections
        $this->pdo->exec("INSERT INTO user_answer_selections (user_answer_id, selected_answer_id) VALUES (2, 4)");
        $this->pdo->exec("INSERT INTO user_answer_selections (user_answer_id, selected_answer_id) VALUES (2, 6)");
    }
    
    public function testGetCorrectAnswersSingleChoice() {
        $correctAnswers = $this->calculator->getCorrectAnswersSingleChoice(1);
        
        assert(count($correctAnswers) === 1, 'Should return one correct answer');
        assert($correctAnswers[0]['id'] == 2, 'Should return correct answer ID');
        assert($correctAnswers[0]['answer_text'] === 'Correct answer', 'Should return correct answer text');
        assert($correctAnswers[0]['is_correct'] == 1, 'Should be marked as correct');
        
        echo "✓ testGetCorrectAnswersSingleChoice passed\n";
    }
    
    public function testGetCorrectAnswersMultipleChoice() {
        $correctAnswers = $this->calculator->getCorrectAnswersMultipleChoice(2);
        
        assert(count($correctAnswers) === 2, 'Should return two correct answers');
        assert($correctAnswers[0]['id'] == 4, 'Should return first correct answer');
        assert($correctAnswers[1]['id'] == 6, 'Should return second correct answer');
        
        echo "✓ testGetCorrectAnswersMultipleChoice passed\n";
    }
    
    public function testGetUserSelectedAnswersSingle() {
        $selectedAnswers = $this->calculator->getUserSelectedAnswers(1, 'single');
        
        assert(count($selectedAnswers) === 1, 'Should return one selected answer');
        assert($selectedAnswers[0]['id'] == 2, 'Should return selected answer ID');
        assert($selectedAnswers[0]['is_correct'] == 1, 'Selected answer should be correct');
        
        echo "✓ testGetUserSelectedAnswersSingle passed\n";
    }
    
    public function testGetUserSelectedAnswersMultiple() {
        $selectedAnswers = $this->calculator->getUserSelectedAnswers(2, 'multiple');
        
        assert(count($selectedAnswers) === 2, 'Should return two selected answers');
        assert($selectedAnswers[0]['id'] == 4, 'Should return first selected answer');
        assert($selectedAnswers[1]['id'] == 6, 'Should return second selected answer');
        
        echo "✓ testGetUserSelectedAnswersMultiple passed\n";
    }
    
    public function testCalculateResults() {
        $results = $this->calculator->calculateResults(1);
        
        assert($results['total_questions'] === 2, 'Should have 2 questions');
        assert($results['correct_answers'] === 2, 'Should have 2 correct answers');
        assert($results['total_points'] === 8, 'Should have 8 total points');
        assert($results['max_possible_points'] === 8, 'Should have 8 max possible points');
        assert($results['percentage'] === 100.0, 'Should have 100% score');
        assert(count($results['questions']) === 2, 'Should have 2 question results');
        
        echo "✓ testCalculateResults passed\n";
    }
    
    public function testFormatResultsForDisplay() {
        $rawResults = $this->calculator->calculateResults(1);
        $formatted = $this->calculator->formatResultsForDisplay($rawResults);
        
        assert(isset($formatted['summary']), 'Should have summary section');
        assert(isset($formatted['questions']), 'Should have questions section');
        assert($formatted['summary']['passed'] === true, 'Should show as passed');
        assert(count($formatted['questions']) === 2, 'Should format 2 questions');
        
        // Check HTML escaping
        $firstQuestion = $formatted['questions'][0];
        assert(strpos($firstQuestion['question_text'], '<') === false, 'Should escape HTML in question text');
        
        echo "✓ testFormatResultsForDisplay passed\n";
    }
    
    public function testErrorHandlingMissingQuestion() {
        try {
            $this->calculator->getCorrectAnswersSingleChoice(999);
            assert(false, 'Should throw exception for missing question');
        } catch (Exception $e) {
            assert(strpos($e->getMessage(), 'No correct answers found') !== false, 'Should have appropriate error message');
        }
        
        echo "✓ testErrorHandlingMissingQuestion passed\n";
    }
    
    public function testErrorHandlingInvalidInput() {
        try {
            $this->calculator->calculateResults('invalid');
            assert(false, 'Should throw exception for invalid input');
        } catch (InvalidArgumentException $e) {
            assert(strpos($e->getMessage(), 'must be numeric') !== false, 'Should validate input type');
        }
        
        echo "✓ testErrorHandlingInvalidInput passed\n";
    }
    
    public function testErrorHandlingMissingSession() {
        try {
            $this->calculator->calculateResults(999);
            assert(false, 'Should throw exception for missing session');
        } catch (Exception $e) {
            assert(strpos($e->getMessage(), 'Quiz session not found') !== false, 'Should handle missing session');
        }
        
        echo "✓ testErrorHandlingMissingSession passed\n";
    }
    
    public function testFormatResultsErrorHandling() {
        // Test with invalid input
        $formatted = $this->calculator->formatResultsForDisplay('invalid');
        
        assert(isset($formatted['summary']['error']), 'Should include error in summary');
        assert($formatted['summary']['total_questions'] === 0, 'Should have safe defaults');
        assert(count($formatted['questions']) === 0, 'Should have empty questions array');
        
        echo "✓ testFormatResultsErrorHandling passed\n";
    }
    
    public function runAllTests() {
        echo "Running ResultsCalculator tests...\n";
        
        $this->setUp();
        $this->testGetCorrectAnswersSingleChoice();
        
        $this->setUp();
        $this->testGetCorrectAnswersMultipleChoice();
        
        $this->setUp();
        $this->testGetUserSelectedAnswersSingle();
        
        $this->setUp();
        $this->testGetUserSelectedAnswersMultiple();
        
        $this->setUp();
        $this->testCalculateResults();
        
        $this->setUp();
        $this->testFormatResultsForDisplay();
        
        $this->setUp();
        $this->testErrorHandlingMissingQuestion();
        
        $this->setUp();
        $this->testErrorHandlingInvalidInput();
        
        $this->setUp();
        $this->testErrorHandlingMissingSession();
        
        $this->setUp();
        $this->testFormatResultsErrorHandling();
        
        echo "All ResultsCalculator tests passed! ✓\n";
    }
}

// Run tests if this file is executed directly
if (basename(__FILE__) === basename($_SERVER['SCRIPT_NAME'])) {
    $test = new ResultsCalculatorTest();
    $test->runAllTests();
}