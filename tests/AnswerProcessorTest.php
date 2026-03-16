<?php
/**
 * Unit tests for AnswerProcessor class
 */

require_once __DIR__ . '/../classes/AnswerProcessor.php';

class AnswerProcessorTest {
    private $pdo;
    private $processor;
    
    public function setUp() {
        // Create in-memory SQLite database for testing
        $this->pdo = new PDO('sqlite::memory:');
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        // Create test tables
        $this->createTestTables();
        $this->insertTestData();
        
        $this->processor = new AnswerProcessor($this->pdo);
    }
    
    private function createTestTables() {
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
                is_correct INTEGER DEFAULT 0
            )
        ");
        
        $this->pdo->exec("
            CREATE TABLE quiz_sessions (
                id INTEGER PRIMARY KEY,
                user_id INTEGER,
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
        // Insert test questions
        $this->pdo->exec("INSERT INTO questions (id, question_text, question_type, points) VALUES (1, 'Single choice question?', 'single', 4)");
        $this->pdo->exec("INSERT INTO questions (id, question_text, question_type, points) VALUES (2, 'Multiple choice question?', 'multiple', 4)");
        
        // Insert answer options for single choice question
        $this->pdo->exec("INSERT INTO answer_options (id, question_id, answer_text, is_correct) VALUES (1, 1, 'Wrong answer', 0)");
        $this->pdo->exec("INSERT INTO answer_options (id, question_id, answer_text, is_correct) VALUES (2, 1, 'Correct answer', 1)");
        $this->pdo->exec("INSERT INTO answer_options (id, question_id, answer_text, is_correct) VALUES (3, 1, 'Another wrong', 0)");
        
        // Insert answer options for multiple choice question
        $this->pdo->exec("INSERT INTO answer_options (id, question_id, answer_text, is_correct) VALUES (4, 2, 'Correct option 1', 1)");
        $this->pdo->exec("INSERT INTO answer_options (id, question_id, answer_text, is_correct) VALUES (5, 2, 'Wrong option', 0)");
        $this->pdo->exec("INSERT INTO answer_options (id, question_id, answer_text, is_correct) VALUES (6, 2, 'Correct option 2', 1)");
        $this->pdo->exec("INSERT INTO answer_options (id, question_id, answer_text, is_correct) VALUES (7, 2, 'Another wrong', 0)");
        
        // Insert test quiz session
        $this->pdo->exec("INSERT INTO quiz_sessions (id, user_id) VALUES (1, 1)");
    }
    
    public function testProcessSingleChoiceCorrect() {
        $result = $this->processor->processSingleChoice(1, 2, 1);
        
        assert($result['is_correct'] === true, 'Should be correct');
        assert($result['points_earned'] === 4, 'Should earn 4 points');
        assert($result['selected_answers'] === [2], 'Should return selected answer');
        
        echo "✓ testProcessSingleChoiceCorrect passed\n";
    }
    
    public function testProcessSingleChoiceIncorrect() {
        $result = $this->processor->processSingleChoice(1, 1, 1);
        
        assert($result['is_correct'] === false, 'Should be incorrect');
        assert($result['points_earned'] === 0, 'Should earn 0 points');
        assert($result['selected_answers'] === [1], 'Should return selected answer');
        
        echo "✓ testProcessSingleChoiceIncorrect passed\n";
    }
    
    public function testProcessMultipleChoiceCorrect() {
        $result = $this->processor->processMultipleChoice(2, [4, 6], 1);
        
        assert($result['is_correct'] === true, 'Should be correct');
        assert($result['points_earned'] === 4, 'Should earn 4 points');
        assert($result['selected_answers'] === [4, 6], 'Should return selected answers');
        assert($result['correct_answers'] === [4, 6], 'Should return correct answers');
        
        echo "✓ testProcessMultipleChoiceCorrect passed\n";
    }
    
    public function testProcessMultipleChoiceIncorrectMissing() {
        // Missing one correct answer
        $result = $this->processor->processMultipleChoice(2, [4], 1);
        
        assert($result['is_correct'] === false, 'Should be incorrect when missing correct answer');
        assert($result['points_earned'] === 0, 'Should earn 0 points');
        
        echo "✓ testProcessMultipleChoiceIncorrectMissing passed\n";
    }
    
    public function testProcessMultipleChoiceIncorrectExtra() {
        // Including wrong answer
        $result = $this->processor->processMultipleChoice(2, [4, 5, 6], 1);
        
        assert($result['is_correct'] === false, 'Should be incorrect when including wrong answer');
        assert($result['points_earned'] === 0, 'Should earn 0 points');
        
        echo "✓ testProcessMultipleChoiceIncorrectExtra passed\n";
    }
    
    public function testValidateAnswerSelectionSingle() {
        assert($this->processor->validateAnswerSelection(1, 2, 'single') === true, 'Valid single choice should pass');
        assert($this->processor->validateAnswerSelection(1, 'invalid', 'single') === false, 'Invalid single choice should fail');
        assert($this->processor->validateAnswerSelection(1, 0, 'single') === false, 'Zero ID should fail');
        
        echo "✓ testValidateAnswerSelectionSingle passed\n";
    }
    
    public function testValidateAnswerSelectionMultiple() {
        assert($this->processor->validateAnswerSelection(2, [4, 6], 'multiple') === true, 'Valid multiple choice should pass');
        assert($this->processor->validateAnswerSelection(2, [], 'multiple') === false, 'Empty array should fail');
        assert($this->processor->validateAnswerSelection(2, 'not_array', 'multiple') === false, 'Non-array should fail');
        assert($this->processor->validateAnswerSelection(2, [4, 'invalid'], 'multiple') === false, 'Mixed valid/invalid should fail');
        
        echo "✓ testValidateAnswerSelectionMultiple passed\n";
    }
    
    public function testInvalidInputHandling() {
        try {
            $this->processor->processSingleChoice('invalid', 2, 1);
            assert(false, 'Should throw exception for invalid question ID');
        } catch (InvalidArgumentException $e) {
            echo "✓ testInvalidInputHandling (single choice) passed\n";
        }
        
        try {
            $this->processor->processMultipleChoice(2, 'not_array', 1);
            assert(false, 'Should throw exception for non-array input');
        } catch (InvalidArgumentException $e) {
            echo "✓ testInvalidInputHandling (multiple choice) passed\n";
        }
    }
    
    public function runAllTests() {
        echo "Running AnswerProcessor tests...\n";
        
        $this->setUp();
        $this->testProcessSingleChoiceCorrect();
        
        $this->setUp();
        $this->testProcessSingleChoiceIncorrect();
        
        $this->setUp();
        $this->testProcessMultipleChoiceCorrect();
        
        $this->setUp();
        $this->testProcessMultipleChoiceIncorrectMissing();
        
        $this->setUp();
        $this->testProcessMultipleChoiceIncorrectExtra();
        
        $this->setUp();
        $this->testValidateAnswerSelectionSingle();
        
        $this->setUp();
        $this->testValidateAnswerSelectionMultiple();
        
        $this->setUp();
        $this->testInvalidInputHandling();
        
        echo "All AnswerProcessor tests passed! ✓\n";
    }
}

// Run tests if this file is executed directly
if (basename(__FILE__) === basename($_SERVER['SCRIPT_NAME'])) {
    $test = new AnswerProcessorTest();
    $test->runAllTests();
}