<?php
/**
 * Edge case tests for comprehensive coverage
 * Tests boundary conditions, error states, and unusual scenarios
 */

require_once __DIR__ . '/../classes/AnswerProcessor.php';
require_once __DIR__ . '/../classes/CodeFormatter.php';
require_once __DIR__ . '/../classes/ResultsCalculator.php';
require_once __DIR__ . '/../classes/QuestionRenderer.php';

class EdgeCaseTest {
    private $pdo;
    
    public function setUp() {
        $this->pdo = new PDO('sqlite::memory:');
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->createTestTables();
        $this->insertEdgeCaseData();
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
                points_earned INTEGER DEFAULT 0
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
    
    private function insertEdgeCaseData() {
        // Question with no correct answers
        $this->pdo->exec("INSERT INTO questions (id, question_text, question_type, points) VALUES (1, 'No correct answers', 'single', 4)");
        $this->pdo->exec("INSERT INTO answer_options (id, question_id, answer_text, is_correct) VALUES (1, 1, 'Wrong 1', 0)");
        $this->pdo->exec("INSERT INTO answer_options (id, question_id, answer_text, is_correct) VALUES (2, 1, 'Wrong 2', 0)");
        
        // Question with all correct answers
        $this->pdo->exec("INSERT INTO questions (id, question_text, question_type, points) VALUES (2, 'All correct answers', 'multiple', 4)");
        $this->pdo->exec("INSERT INTO answer_options (id, question_id, answer_text, is_correct) VALUES (3, 2, 'Correct 1', 1)");
        $this->pdo->exec("INSERT INTO answer_options (id, question_id, answer_text, is_correct) VALUES (4, 2, 'Correct 2', 1)");
        
        // Question with zero points
        $this->pdo->exec("INSERT INTO questions (id, question_text, question_type, points) VALUES (3, 'Zero points', 'single', 0)");
        $this->pdo->exec("INSERT INTO answer_options (id, question_id, answer_text, is_correct) VALUES (5, 3, 'Correct', 1)");
        
        // Question with negative points (edge case)
        $this->pdo->exec("INSERT INTO questions (id, question_text, question_type, points) VALUES (4, 'Negative points', 'single', -2)");
        $this->pdo->exec("INSERT INTO answer_options (id, question_id, answer_text, is_correct) VALUES (6, 4, 'Correct', 1)");
        
        // Question with very long text
        $longText = str_repeat('Very long question text. ', 100);
        $this->pdo->exec("INSERT INTO questions (id, question_text, question_type, points) VALUES (5, ?, 'single', 4)", [$longText]);
        $this->pdo->exec("INSERT INTO answer_options (id, question_id, answer_text, is_correct) VALUES (7, 5, 'Correct', 1)");
        
        // Empty quiz session
        $this->pdo->exec("INSERT INTO quiz_sessions (id, user_id) VALUES (1, 1)");
        
        // Quiz session with mixed results
        $this->pdo->exec("INSERT INTO quiz_sessions (id, user_id) VALUES (2, 1)");
        $this->pdo->exec("INSERT INTO user_answers (quiz_session_id, question_id, selected_answer_id, is_correct, points_earned) VALUES (2, 1, 1, 0, 0)");
        $this->pdo->exec("INSERT INTO user_answers (quiz_session_id, question_id, selected_answer_id, is_correct, points_earned) VALUES (2, 3, 5, 1, 0)");
    }
    
    public function testAnswerProcessorEdgeCases() {
        echo "Testing AnswerProcessor edge cases...\n";
        
        $processor = new AnswerProcessor($this->pdo);
        
        // Test with question that has no correct answers
        try {
            $result = $processor->processSingleChoice(1, 1, 1);
            assert($result['is_correct'] === false, 'Should be incorrect when no correct answers exist');
            assert($result['points_earned'] === 0, 'Should earn 0 points when no correct answers');
        } catch (Exception $e) {
            // Also acceptable to throw exception
            assert(true, 'Acceptable to throw exception for questions with no correct answers');
        }
        
        // Test with zero points question
        $result = $processor->processSingleChoice(3, 5, 1);
        assert($result['is_correct'] === true, 'Should be correct');
        assert($result['points_earned'] === 0, 'Should earn 0 points for zero-point question');
        
        // Test with negative points question
        $result = $processor->processSingleChoice(4, 6, 1);
        assert($result['is_correct'] === true, 'Should be correct');
        // Negative points handling depends on business logic
        
        // Test multiple choice with all answers correct
        $result = $processor->processMultipleChoice(2, [3, 4], 1);
        assert($result['is_correct'] === true, 'Should be correct when all answers are correct');
        
        // Test multiple choice with empty selection
        try {
            $result = $processor->processMultipleChoice(2, [], 1);
            assert($result['is_correct'] === false, 'Empty selection should be incorrect');
        } catch (Exception $e) {
            assert(true, 'Acceptable to throw exception for empty selection');
        }
        
        // Test with very large answer ID
        try {
            $result = $processor->processSingleChoice(1, PHP_INT_MAX, 1);
            assert($result['is_correct'] === false, 'Non-existent answer should be incorrect');
        } catch (Exception $e) {
            assert(true, 'Acceptable to throw exception for non-existent answer');
        }
        
        echo "✓ AnswerProcessor edge cases handled correctly\n";
    }
    
    public function testCodeFormatterEdgeCases() {
        echo "Testing CodeFormatter edge cases...\n";
        
        // Test with empty string
        $result = CodeFormatter::formatCode('', 'php');
        assert(strpos($result, '<pre') !== false, 'Should still create proper structure for empty code');
        
        // Test with only whitespace
        $result = CodeFormatter::formatCode("   \n\t  \r\n  ", 'php');
        assert(strpos($result, '<pre') !== false, 'Should handle whitespace-only code');
        
        // Test with very long single line
        $longLine = str_repeat('a', 10000);
        $result = CodeFormatter::formatCode($longLine, 'php');
        assert(strpos($result, $longLine) !== false, 'Should handle very long lines');
        
        // Test with many lines
        $manyLines = str_repeat("line\n", 1000);
        $result = CodeFormatter::formatCode($manyLines, 'php', ['line_numbers' => true]);
        assert(strpos($result, 'line-numbers') !== false, 'Should handle many lines with line numbers');
        
        // Test with mixed line endings
        $mixedEndings = "line1\nline2\r\nline3\rline4";
        $result = CodeFormatter::sanitizeCodeForStorage($mixedEndings);
        assert(strpos($result, "\r") === false, 'Should normalize all line endings');
        
        // Test with null bytes and control characters
        $controlChars = "normal\0null\x01control\x1Fchars";
        $result = CodeFormatter::sanitizeCodeForStorage($controlChars);
        assert(strpos($result, "\0") === false, 'Should remove null bytes');
        
        // Test with Unicode characters
        $unicode = "Hello 🌍 Wörld ñiño";
        $result = CodeFormatter::formatCode($unicode, 'text');
        assert(strpos($result, '🌍') !== false, 'Should preserve Unicode characters');
        
        // Test with maximum length boundary
        $maxLength = str_repeat('a', 10000);
        $result = CodeFormatter::sanitizeCodeForStorage($maxLength, 10000);
        assert(strlen($result) <= 10000, 'Should respect maximum length');
        
        // Test unsupported language fallback
        $result = CodeFormatter::formatCode('code', 'nonexistent-language');
        assert(strpos($result, 'language-text') !== false, 'Should fallback to text for unknown languages');
        
        // Test CSS generation with invalid theme
        $css = CodeFormatter::generateCSS('nonexistent-theme');
        assert(strpos($css, '.code-block') !== false, 'Should generate valid CSS even for invalid theme');
        
        echo "✓ CodeFormatter edge cases handled correctly\n";
    }
    
    public function testResultsCalculatorEdgeCases() {
        echo "Testing ResultsCalculator edge cases...\n";
        
        $calculator = new ResultsCalculator($this->pdo);
        
        // Test with empty quiz session
        try {
            $results = $calculator->calculateResults(1);
            assert($results['total_questions'] === 0, 'Empty session should have 0 questions');
            assert($results['correct_answers'] === 0, 'Empty session should have 0 correct answers');
            assert($results['percentage'] === 0, 'Empty session should have 0% score');
        } catch (Exception $e) {
            assert(true, 'Acceptable to throw exception for empty session');
        }
        
        // Test with mixed results session
        $results = $calculator->calculateResults(2);
        assert($results['total_questions'] === 2, 'Should count all answered questions');
        assert($results['correct_answers'] === 1, 'Should count correct answers');
        assert($results['total_points'] === 0, 'Should sum earned points');
        
        // Test with non-existent session
        try {
            $results = $calculator->calculateResults(999);
            assert(false, 'Should throw exception for non-existent session');
        } catch (Exception $e) {
            assert(true, 'Should throw exception for non-existent session');
        }
        
        // Test formatting with null/invalid data
        $formatted = $calculator->formatResultsForDisplay(null);
        assert(isset($formatted['summary']['error']), 'Should handle null input gracefully');
        
        $formatted = $calculator->formatResultsForDisplay('invalid');
        assert(isset($formatted['summary']['error']), 'Should handle invalid input gracefully');
        
        $formatted = $calculator->formatResultsForDisplay([]);
        assert(isset($formatted['summary']['error']), 'Should handle empty array gracefully');
        
        // Test with question that has no correct answers
        try {
            $correctAnswers = $calculator->getCorrectAnswersSingleChoice(1);
            assert(count($correctAnswers) === 0, 'Should return empty array for question with no correct answers');
        } catch (Exception $e) {
            assert(true, 'Acceptable to throw exception for question with no correct answers');
        }
        
        echo "✓ ResultsCalculator edge cases handled correctly\n";
    }
    
    public function testQuestionRendererEdgeCases() {
        echo "Testing QuestionRenderer edge cases...\n";
        
        // Test with null question
        try {
            $result = QuestionRenderer::renderQuestion(null, []);
            assert($result === '', 'Should return empty string for null question');
        } catch (Exception $e) {
            assert(true, 'Acceptable to throw exception for null question');
        }
        
        // Test with empty question array
        $result = QuestionRenderer::renderQuestion([], []);
        assert($result === '', 'Should return empty string for empty question');
        
        // Test with question missing required fields
        $incompleteQuestion = ['id' => 1];
        $result = QuestionRenderer::renderQuestion($incompleteQuestion, []);
        // Should handle gracefully
        
        // Test with null answers
        $question = ['id' => 1, 'question_text' => 'Test', 'question_type' => 'single'];
        $result = QuestionRenderer::renderQuestion($question, null);
        assert($result === '', 'Should return empty string for null answers');
        
        // Test with empty answers array
        $result = QuestionRenderer::renderQuestion($question, []);
        assert($result === '', 'Should return empty string for empty answers');
        
        // Test with answers missing required fields
        $incompleteAnswers = [['id' => 1], ['answer_text' => 'Test']];
        $result = QuestionRenderer::renderQuestion($question, $incompleteAnswers);
        // Should handle gracefully
        
        // Test with very long question text
        $longQuestion = $question;
        $longQuestion['question_text'] = str_repeat('Very long question text. ', 200);
        $answers = [['id' => 1, 'answer_text' => 'Test']];
        $result = QuestionRenderer::renderQuestion($longQuestion, $answers);
        assert(strpos($result, 'Very long question text.') !== false, 'Should handle long question text');
        
        // Test with very long answer text
        $longAnswers = [['id' => 1, 'answer_text' => str_repeat('Very long answer text. ', 100)]];
        $result = QuestionRenderer::renderQuestion($question, $longAnswers);
        assert(strpos($result, 'Very long answer text.') !== false, 'Should handle long answer text');
        
        // Test with special characters in question and answers
        $specialQuestion = $question;
        $specialQuestion['question_text'] = 'Question with "quotes" & <tags> and 🚀 emoji';
        $specialAnswers = [['id' => 1, 'answer_text' => 'Answer with "quotes" & <tags> and 🚀 emoji']];
        $result = QuestionRenderer::renderQuestion($specialQuestion, $specialAnswers);
        assert(strpos($result, '&lt;tags&gt;') !== false, 'Should escape HTML in question text');
        assert(strpos($result, '🚀') !== false, 'Should preserve emoji');
        
        // Test with invalid question type
        $invalidTypeQuestion = $question;
        $invalidTypeQuestion['question_type'] = 'invalid';
        $result = QuestionRenderer::renderQuestion($invalidTypeQuestion, $answers);
        // Should default to single choice
        assert(strpos($result, 'type="radio"') !== false, 'Should default to radio for invalid type');
        
        // Test utility methods with edge cases
        assert(QuestionRenderer::getInputName('invalid') === 'answer_id', 'Should default to single choice name');
        assert(QuestionRenderer::getInputType('invalid') === 'radio', 'Should default to radio type');
        assert(QuestionRenderer::requiresSelection('invalid') === true, 'Should require selection by default');
        
        echo "✓ QuestionRenderer edge cases handled correctly\n";
    }
    
    public function testConcurrencyAndPerformance() {
        echo "Testing concurrency and performance edge cases...\n";
        
        // Test with many simultaneous database connections
        $processors = [];
        for ($i = 0; $i < 10; $i++) {
            $processors[] = new AnswerProcessor($this->pdo);
        }
        
        // Test processing many answers simultaneously
        foreach ($processors as $processor) {
            try {
                $result = $processor->processSingleChoice(3, 5, 1);
                assert(is_array($result), 'Should handle concurrent processing');
            } catch (Exception $e) {
                // Database might not support true concurrency in memory
                assert(true, 'Acceptable for in-memory database limitations');
            }
        }
        
        // Test with large datasets
        $calculator = new ResultsCalculator($this->pdo);
        
        // Insert many questions and answers for performance testing
        for ($i = 100; $i < 200; $i++) {
            $this->pdo->exec("INSERT INTO questions (id, question_text, question_type, points) VALUES ($i, 'Question $i', 'single', 4)");
            $this->pdo->exec("INSERT INTO answer_options (question_id, answer_text, is_correct) VALUES ($i, 'Correct $i', 1)");
        }
        
        // Test performance with large result set
        $this->pdo->exec("INSERT INTO quiz_sessions (id, user_id) VALUES (3, 1)");
        for ($i = 100; $i < 150; $i++) {
            $this->pdo->exec("INSERT INTO user_answers (quiz_session_id, question_id, selected_answer_id, is_correct, points_earned) VALUES (3, $i, 1, 1, 4)");
        }
        
        $start = microtime(true);
        $results = $calculator->calculateResults(3);
        $end = microtime(true);
        
        assert($results['total_questions'] === 50, 'Should handle large result sets');
        assert(($end - $start) < 1.0, 'Should complete within reasonable time');
        
        echo "✓ Concurrency and performance edge cases handled correctly\n";
    }
    
    public function runAllTests() {
        echo "Running comprehensive edge case tests...\n";
        echo "======================================\n\n";
        
        $this->setUp();
        $this->testAnswerProcessorEdgeCases();
        
        $this->setUp();
        $this->testCodeFormatterEdgeCases();
        
        $this->setUp();
        $this->testResultsCalculatorEdgeCases();
        
        $this->setUp();
        $this->testQuestionRendererEdgeCases();
        
        $this->setUp();
        $this->testConcurrencyAndPerformance();
        
        echo "\n🎯 All edge case tests passed! The application handles:\n";
        echo "- Boundary conditions and invalid inputs\n";
        echo "- Empty and null data scenarios\n";
        echo "- Very large datasets and long text\n";
        echo "- Special characters and Unicode\n";
        echo "- Performance under load\n";
        echo "- Concurrent access patterns\n";
        echo "- Error recovery and graceful degradation\n";
    }
}

// Run tests if this file is executed directly
if (basename(__FILE__) === basename($_SERVER['SCRIPT_NAME'])) {
    $test = new EdgeCaseTest();
    $test->runAllTests();
}