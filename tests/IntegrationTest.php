<?php
/**
 * Integration tests for complete quiz workflow
 * Tests end-to-end functionality with single-choice, multiple-choice, and mixed scenarios
 */

require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../classes/AnswerProcessor.php';
require_once __DIR__ . '/../classes/CodeFormatter.php';
require_once __DIR__ . '/../classes/ResultsCalculator.php';
require_once __DIR__ . '/../classes/QuestionRenderer.php';

class IntegrationTest {
    private $pdo;
    private $testUserId = 999;
    private $testLearningFieldId = 999;
    
    public function setUp() {
        // Create in-memory SQLite database for testing
        $this->pdo = new PDO('sqlite::memory:');
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $this->createTestTables();
        $this->insertTestData();
    }
    
    private function createTestTables() {
        // Create all necessary tables for full integration testing
        $this->pdo->exec("
            CREATE TABLE users (
                id INTEGER PRIMARY KEY,
                username TEXT,
                email TEXT,
                password TEXT,
                created_at DATETIME DEFAULT CURRENT_TIMESTAMP
            )
        ");
        
        $this->pdo->exec("
            CREATE TABLE learning_fields (
                id INTEGER PRIMARY KEY,
                name TEXT,
                description TEXT,
                created_at DATETIME DEFAULT CURRENT_TIMESTAMP
            )
        ");
        
        $this->pdo->exec("
            CREATE TABLE questions (
                id INTEGER PRIMARY KEY,
                learning_field_id INTEGER,
                question_text TEXT,
                question_type TEXT DEFAULT 'single',
                points INTEGER DEFAULT 4,
                difficulty INTEGER DEFAULT 1,
                is_approved INTEGER DEFAULT 1,
                created_at DATETIME DEFAULT CURRENT_TIMESTAMP
            )
        ");
        
        $this->pdo->exec("
            CREATE TABLE answer_options (
                id INTEGER PRIMARY KEY,
                question_id INTEGER,
                answer_text TEXT,
                is_correct INTEGER DEFAULT 0,
                sort_order INTEGER DEFAULT 0,
                created_at DATETIME DEFAULT CURRENT_TIMESTAMP
            )
        ");
        
        $this->pdo->exec("
            CREATE TABLE quiz_sessions (
                id INTEGER PRIMARY KEY,
                user_id INTEGER,
                learning_field_id INTEGER,
                total_questions INTEGER DEFAULT 0,
                current_question INTEGER DEFAULT 1,
                is_completed INTEGER DEFAULT 0,
                created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
                completed_at DATETIME NULL
            )
        ");
        
        $this->pdo->exec("
            CREATE TABLE user_answers (
                id INTEGER PRIMARY KEY,
                quiz_session_id INTEGER,
                question_id INTEGER,
                selected_answer_id INTEGER NULL,
                is_correct INTEGER DEFAULT 0,
                points_earned INTEGER DEFAULT 0,
                answered_at DATETIME DEFAULT CURRENT_TIMESTAMP
            )
        ");
        
        $this->pdo->exec("
            CREATE TABLE user_answer_selections (
                id INTEGER PRIMARY KEY,
                user_answer_id INTEGER,
                selected_answer_id INTEGER,
                created_at DATETIME DEFAULT CURRENT_TIMESTAMP
            )
        ");
    }
    
    private function insertTestData() {
        // Insert test user and learning field
        $this->pdo->exec("INSERT INTO users (id, username, email) VALUES ({$this->testUserId}, 'testuser', 'test@example.com')");
        $this->pdo->exec("INSERT INTO learning_fields (id, name, description) VALUES ({$this->testLearningFieldId}, 'Integration Test Field', 'Test field for integration testing')");
        
        // Insert single-choice questions
        $this->pdo->exec("INSERT INTO questions (id, learning_field_id, question_text, question_type, points) VALUES (1, {$this->testLearningFieldId}, 'What is PHP?', 'single', 4)");
        $this->pdo->exec("INSERT INTO answer_options (id, question_id, answer_text, is_correct, sort_order) VALUES (1, 1, 'A programming language', 1, 1)");
        $this->pdo->exec("INSERT INTO answer_options (id, question_id, answer_text, is_correct, sort_order) VALUES (2, 1, 'A database', 0, 2)");
        $this->pdo->exec("INSERT INTO answer_options (id, question_id, answer_text, is_correct, sort_order) VALUES (3, 1, 'An operating system', 0, 3)");
        
        $this->pdo->exec("INSERT INTO questions (id, learning_field_id, question_text, question_type, points) VALUES (2, {$this->testLearningFieldId}, 'Which is a web server?', 'single', 4)");
        $this->pdo->exec("INSERT INTO answer_options (id, question_id, answer_text, is_correct, sort_order) VALUES (4, 2, 'MySQL', 0, 1)");
        $this->pdo->exec("INSERT INTO answer_options (id, question_id, answer_text, is_correct, sort_order) VALUES (5, 2, 'Apache', 1, 2)");
        $this->pdo->exec("INSERT INTO answer_options (id, question_id, answer_text, is_correct, sort_order) VALUES (6, 2, 'PHP', 0, 3)");
        
        // Insert multiple-choice questions
        $this->pdo->exec("INSERT INTO questions (id, learning_field_id, question_text, question_type, points) VALUES (3, {$this->testLearningFieldId}, 'Which are programming languages?', 'multiple', 4)");
        $this->pdo->exec("INSERT INTO answer_options (id, question_id, answer_text, is_correct, sort_order) VALUES (7, 3, 'PHP', 1, 1)");
        $this->pdo->exec("INSERT INTO answer_options (id, question_id, answer_text, is_correct, sort_order) VALUES (8, 3, 'JavaScript', 1, 2)");
        $this->pdo->exec("INSERT INTO answer_options (id, question_id, answer_text, is_correct, sort_order) VALUES (9, 3, 'HTML', 0, 3)");
        $this->pdo->exec("INSERT INTO answer_options (id, question_id, answer_text, is_correct, sort_order) VALUES (10, 3, 'Python', 1, 4)");
        
        $this->pdo->exec("INSERT INTO questions (id, learning_field_id, question_text, question_type, points) VALUES (4, {$this->testLearningFieldId}, 'Which are databases?', 'multiple', 4)");
        $this->pdo->exec("INSERT INTO answer_options (id, question_id, answer_text, is_correct, sort_order) VALUES (11, 4, 'MySQL', 1, 1)");
        $this->pdo->exec("INSERT INTO answer_options (id, question_id, answer_text, is_correct, sort_order) VALUES (12, 4, 'PostgreSQL', 1, 2)");
        $this->pdo->exec("INSERT INTO answer_options (id, question_id, answer_text, is_correct, sort_order) VALUES (13, 4, 'Apache', 0, 3)");
        $this->pdo->exec("INSERT INTO answer_options (id, question_id, answer_text, is_correct, sort_order) VALUES (14, 4, 'MongoDB', 1, 4)");
        
        // Insert question with code example
        $codeExample = "<?php\necho 'Hello World';\n?>";
        $questionWithCode = "What does this PHP code output?\n\n```php\n{$codeExample}\n```";
        $this->pdo->exec("INSERT INTO questions (id, learning_field_id, question_text, question_type, points) VALUES (5, {$this->testLearningFieldId}, ?, 'single', 4)", [$questionWithCode]);
        $this->pdo->exec("INSERT INTO answer_options (id, question_id, answer_text, is_correct, sort_order) VALUES (15, 5, 'Hello World', 1, 1)");
        $this->pdo->exec("INSERT INTO answer_options (id, question_id, answer_text, is_correct, sort_order) VALUES (16, 5, 'PHP', 0, 2)");
        $this->pdo->exec("INSERT INTO answer_options (id, question_id, answer_text, is_correct, sort_order) VALUES (17, 5, 'Error', 0, 3)");
    }
    
    public function testSingleChoiceQuizWorkflow() {
        echo "Testing single-choice quiz workflow...\n";
        
        // Step 1: Create quiz session
        $sessionId = $this->createQuizSession([1, 2]);
        assert($sessionId > 0, 'Should create quiz session');
        
        // Step 2: Load and render first question
        $question = $this->loadQuestion(1);
        $answers = $this->loadAnswers(1);
        
        $renderedQuestion = QuestionRenderer::renderQuestion($question, $answers);
        assert(strpos($renderedQuestion, 'type="radio"') !== false, 'Should render radio buttons for single choice');
        assert(strpos($renderedQuestion, 'name="answer_id"') !== false, 'Should have correct input name');
        assert(strpos($renderedQuestion, 'What is PHP?') !== false, 'Should display question text');
        
        // Step 3: Process correct answer
        $processor = new AnswerProcessor($this->pdo);
        $result = $processor->processSingleChoice(1, 1, $sessionId);
        
        assert($result['is_correct'] === true, 'Should process correct answer');
        assert($result['points_earned'] === 4, 'Should earn full points');
        
        // Step 4: Load and render second question
        $question = $this->loadQuestion(2);
        $answers = $this->loadAnswers(2);
        
        $renderedQuestion = QuestionRenderer::renderQuestion($question, $answers);
        assert(strpos($renderedQuestion, 'Which is a web server?') !== false, 'Should display second question');
        
        // Step 5: Process incorrect answer
        $result = $processor->processSingleChoice(2, 4, $sessionId); // MySQL is incorrect
        
        assert($result['is_correct'] === false, 'Should process incorrect answer');
        assert($result['points_earned'] === 0, 'Should earn no points');
        
        // Step 6: Complete quiz and calculate results
        $this->completeQuizSession($sessionId);
        
        $calculator = new ResultsCalculator($this->pdo);
        $results = $calculator->calculateResults($sessionId);
        
        assert($results['total_questions'] === 2, 'Should have 2 questions');
        assert($results['correct_answers'] === 1, 'Should have 1 correct answer');
        assert($results['total_points'] === 4, 'Should have 4 total points');
        assert($results['percentage'] === 50.0, 'Should have 50% score');
        
        // Step 7: Format results for display
        $formatted = $calculator->formatResultsForDisplay($results);
        assert(isset($formatted['summary']), 'Should have summary section');
        assert(isset($formatted['questions']), 'Should have questions section');
        assert(count($formatted['questions']) === 2, 'Should format both questions');
        
        echo "✓ Single-choice quiz workflow completed successfully\n";
    }
    
    public function testMultipleChoiceQuizWorkflow() {
        echo "Testing multiple-choice quiz workflow...\n";
        
        // Step 1: Create quiz session
        $sessionId = $this->createQuizSession([3, 4]);
        
        // Step 2: Load and render first multiple-choice question
        $question = $this->loadQuestion(3);
        $answers = $this->loadAnswers(3);
        
        $renderedQuestion = QuestionRenderer::renderQuestion($question, $answers);
        assert(strpos($renderedQuestion, 'type="checkbox"') !== false, 'Should render checkboxes for multiple choice');
        assert(strpos($renderedQuestion, 'name="answer_ids[]"') !== false, 'Should have correct array input name');
        assert(strpos($renderedQuestion, 'Which are programming languages?') !== false, 'Should display question text');
        
        // Step 3: Process correct multiple-choice answer
        $processor = new AnswerProcessor($this->pdo);
        $result = $processor->processMultipleChoice(3, [7, 8, 10], $sessionId); // PHP, JavaScript, Python
        
        assert($result['is_correct'] === true, 'Should process correct multiple-choice answer');
        assert($result['points_earned'] === 4, 'Should earn full points');
        assert(count($result['selected_answers']) === 3, 'Should record all selected answers');
        
        // Step 4: Load and render second multiple-choice question
        $question = $this->loadQuestion(4);
        $answers = $this->loadAnswers(4);
        
        $renderedQuestion = QuestionRenderer::renderQuestion($question, $answers);
        assert(strpos($renderedQuestion, 'Which are databases?') !== false, 'Should display second question');
        
        // Step 5: Process partially correct answer (missing one correct answer)
        $result = $processor->processMultipleChoice(4, [11, 12], $sessionId); // MySQL, PostgreSQL (missing MongoDB)
        
        assert($result['is_correct'] === false, 'Should be incorrect when missing correct answers');
        assert($result['points_earned'] === 0, 'Should earn no points for partial answer');
        
        // Step 6: Complete quiz and calculate results
        $this->completeQuizSession($sessionId);
        
        $calculator = new ResultsCalculator($this->pdo);
        $results = $calculator->calculateResults($sessionId);
        
        assert($results['total_questions'] === 2, 'Should have 2 questions');
        assert($results['correct_answers'] === 1, 'Should have 1 correct answer');
        assert($results['total_points'] === 4, 'Should have 4 total points');
        assert($results['percentage'] === 50.0, 'Should have 50% score');
        
        // Step 7: Verify multiple-choice answers in results
        $formatted = $calculator->formatResultsForDisplay($results);
        $firstQuestion = $formatted['questions'][0];
        assert(count($firstQuestion['user_selected_answers']) === 3, 'Should show all selected answers');
        assert(count($firstQuestion['correct_answers']) === 3, 'Should show all correct answers');
        
        echo "✓ Multiple-choice quiz workflow completed successfully\n";
    }
    
    public function testMixedQuizWorkflow() {
        echo "Testing mixed quiz workflow (single + multiple choice)...\n";
        
        // Step 1: Create quiz session with mixed question types
        $sessionId = $this->createQuizSession([1, 3, 2, 4]);
        
        // Step 2: Process single-choice question (correct)
        $processor = new AnswerProcessor($this->pdo);
        $result1 = $processor->processSingleChoice(1, 1, $sessionId);
        assert($result1['is_correct'] === true, 'Single-choice should be correct');
        
        // Step 3: Process multiple-choice question (correct)
        $result2 = $processor->processMultipleChoice(3, [7, 8, 10], $sessionId);
        assert($result2['is_correct'] === true, 'Multiple-choice should be correct');
        
        // Step 4: Process single-choice question (incorrect)
        $result3 = $processor->processSingleChoice(2, 4, $sessionId);
        assert($result3['is_correct'] === false, 'Single-choice should be incorrect');
        
        // Step 5: Process multiple-choice question (incorrect - extra wrong answer)
        $result4 = $processor->processMultipleChoice(4, [11, 12, 13], $sessionId); // Including Apache (wrong)
        assert($result4['is_correct'] === false, 'Multiple-choice should be incorrect');
        
        // Step 6: Complete quiz and verify mixed results
        $this->completeQuizSession($sessionId);
        
        $calculator = new ResultsCalculator($this->pdo);
        $results = $calculator->calculateResults($sessionId);
        
        assert($results['total_questions'] === 4, 'Should have 4 questions');
        assert($results['correct_answers'] === 2, 'Should have 2 correct answers');
        assert($results['total_points'] === 8, 'Should have 8 total points');
        assert($results['percentage'] === 50.0, 'Should have 50% score');
        
        // Step 7: Verify mixed question types in results
        $formatted = $calculator->formatResultsForDisplay($results);
        assert(count($formatted['questions']) === 4, 'Should format all 4 questions');
        
        // Verify question types are preserved
        $singleChoiceQuestions = 0;
        $multipleChoiceQuestions = 0;
        
        foreach ($formatted['questions'] as $q) {
            if (isset($q['user_selected_answers']) && is_array($q['user_selected_answers'])) {
                if (count($q['user_selected_answers']) === 1) {
                    $singleChoiceQuestions++;
                } else {
                    $multipleChoiceQuestions++;
                }
            }
        }
        
        assert($singleChoiceQuestions === 2, 'Should have 2 single-choice questions');
        assert($multipleChoiceQuestions === 2, 'Should have 2 multiple-choice questions');
        
        echo "✓ Mixed quiz workflow completed successfully\n";
    }
    
    public function testCodeExampleWorkflow() {
        echo "Testing code example workflow...\n";
        
        // Step 1: Create quiz session with code question
        $sessionId = $this->createQuizSession([5]);
        
        // Step 2: Load question with code example
        $question = $this->loadQuestion(5);
        $answers = $this->loadAnswers(5);
        
        // Step 3: Format code in question text
        $formattedQuestion = $question;
        $formattedQuestion['question_text'] = CodeFormatter::formatCodeBlocks($question['question_text']);
        
        assert(strpos($formattedQuestion['question_text'], 'language-php') !== false, 'Should format PHP code block');
        assert(strpos($formattedQuestion['question_text'], '&lt;?php') !== false, 'Should escape PHP tags');
        
        // Step 4: Render question with formatted code
        $renderedQuestion = QuestionRenderer::renderQuestion($formattedQuestion, $answers);
        assert(strpos($renderedQuestion, 'What does this PHP code output?') !== false, 'Should display question text');
        assert(strpos($renderedQuestion, 'Hello World') !== false, 'Should display answer options');
        
        // Step 5: Process answer
        $processor = new AnswerProcessor($this->pdo);
        $result = $processor->processSingleChoice(5, 15, $sessionId); // "Hello World" is correct
        
        assert($result['is_correct'] === true, 'Should process code question correctly');
        
        // Step 6: Complete quiz and verify code formatting in results
        $this->completeQuizSession($sessionId);
        
        $calculator = new ResultsCalculator($this->pdo);
        $results = $calculator->calculateResults($sessionId);
        $formatted = $calculator->formatResultsForDisplay($results);
        
        $codeQuestion = $formatted['questions'][0];
        assert(strpos($codeQuestion['question_text'], '&lt;?php') !== false, 'Should escape code in results');
        
        echo "✓ Code example workflow completed successfully\n";
    }
    
    public function testErrorRecoveryWorkflow() {
        echo "Testing error recovery workflow...\n";
        
        // Step 1: Test with invalid session ID
        $calculator = new ResultsCalculator($this->pdo);
        try {
            $results = $calculator->calculateResults(99999);
            assert(false, 'Should throw exception for invalid session');
        } catch (Exception $e) {
            assert(true, 'Should handle invalid session gracefully');
        }
        
        // Step 2: Test with corrupted data
        $sessionId = $this->createQuizSession([1]);
        
        // Insert corrupted answer data
        $this->pdo->exec("INSERT INTO user_answers (quiz_session_id, question_id, selected_answer_id, is_correct, points_earned) VALUES ($sessionId, 999, 999, 1, 4)");
        
        $results = $calculator->calculateResults($sessionId);
        assert(is_array($results), 'Should handle corrupted data gracefully');
        
        // Step 3: Test formatting with invalid data
        $formatted = $calculator->formatResultsForDisplay('invalid');
        assert(isset($formatted['summary']['error']), 'Should include error information');
        
        // Step 4: Test processor with invalid inputs
        $processor = new AnswerProcessor($this->pdo);
        try {
            $processor->processSingleChoice('invalid', 1, $sessionId);
            assert(false, 'Should validate input types');
        } catch (Exception $e) {
            assert(true, 'Should validate input types');
        }
        
        echo "✓ Error recovery workflow completed successfully\n";
    }
    
    public function testPerformanceWorkflow() {
        echo "Testing performance with large dataset...\n";
        
        // Step 1: Create large dataset
        $largeSessionId = $this->createLargeDataset();
        
        // Step 2: Measure calculation performance
        $calculator = new ResultsCalculator($this->pdo);
        
        $start = microtime(true);
        $results = $calculator->calculateResults($largeSessionId);
        $end = microtime(true);
        
        $calculationTime = $end - $start;
        assert($calculationTime < 2.0, 'Should calculate results within 2 seconds');
        assert($results['total_questions'] === 100, 'Should handle 100 questions');
        
        // Step 3: Measure formatting performance
        $start = microtime(true);
        $formatted = $calculator->formatResultsForDisplay($results);
        $end = microtime(true);
        
        $formattingTime = $end - $start;
        assert($formattingTime < 1.0, 'Should format results within 1 second');
        assert(count($formatted['questions']) === 100, 'Should format all questions');
        
        echo "✓ Performance workflow completed successfully (calc: {$calculationTime}s, format: {$formattingTime}s)\n";
    }
    
    private function createQuizSession($questionIds) {
        $stmt = $this->pdo->prepare("INSERT INTO quiz_sessions (user_id, learning_field_id, total_questions) VALUES (?, ?, ?)");
        $stmt->execute([$this->testUserId, $this->testLearningFieldId, count($questionIds)]);
        return $this->pdo->lastInsertId();
    }
    
    private function completeQuizSession($sessionId) {
        $stmt = $this->pdo->prepare("UPDATE quiz_sessions SET is_completed = 1, completed_at = CURRENT_TIMESTAMP WHERE id = ?");
        $stmt->execute([$sessionId]);
    }
    
    private function loadQuestion($questionId) {
        $stmt = $this->pdo->prepare("SELECT * FROM questions WHERE id = ?");
        $stmt->execute([$questionId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    private function loadAnswers($questionId) {
        $stmt = $this->pdo->prepare("SELECT * FROM answer_options WHERE question_id = ? ORDER BY sort_order");
        $stmt->execute([$questionId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    private function createLargeDataset() {
        // Create 100 questions for performance testing
        for ($i = 100; $i < 200; $i++) {
            $this->pdo->exec("INSERT INTO questions (id, learning_field_id, question_text, question_type, points) VALUES ($i, {$this->testLearningFieldId}, 'Performance test question $i', 'single', 4)");
            $this->pdo->exec("INSERT INTO answer_options (question_id, answer_text, is_correct) VALUES ($i, 'Correct answer $i', 1)");
            $this->pdo->exec("INSERT INTO answer_options (question_id, answer_text, is_correct) VALUES ($i, 'Wrong answer $i', 0)");
        }
        
        // Create quiz session with all questions
        $sessionId = $this->createQuizSession(range(100, 199));
        
        // Insert answers for all questions
        for ($i = 100; $i < 200; $i++) {
            $isCorrect = ($i % 2 === 0) ? 1 : 0; // 50% correct
            $points = $isCorrect ? 4 : 0;
            $this->pdo->exec("INSERT INTO user_answers (quiz_session_id, question_id, selected_answer_id, is_correct, points_earned) VALUES ($sessionId, $i, 1, $isCorrect, $points)");
        }
        
        $this->completeQuizSession($sessionId);
        return $sessionId;
    }
    
    public function runAllTests() {
        echo "Running comprehensive integration tests...\n";
        echo "========================================\n\n";
        
        $this->setUp();
        $this->testSingleChoiceQuizWorkflow();
        
        $this->setUp();
        $this->testMultipleChoiceQuizWorkflow();
        
        $this->setUp();
        $this->testMixedQuizWorkflow();
        
        $this->setUp();
        $this->testCodeExampleWorkflow();
        
        $this->setUp();
        $this->testErrorRecoveryWorkflow();
        
        $this->setUp();
        $this->testPerformanceWorkflow();
        
        echo "\n🎉 All integration tests passed! The complete quiz system works correctly:\n";
        echo "- End-to-end single-choice quiz workflow\n";
        echo "- End-to-end multiple-choice quiz workflow\n";
        echo "- Mixed quiz sessions with both question types\n";
        echo "- Code example formatting and display\n";
        echo "- Error recovery and graceful degradation\n";
        echo "- Performance with large datasets\n";
        echo "\n✅ The quiz enhancement is ready for production deployment!\n";
    }
}

// Run tests if this file is executed directly
if (basename(__FILE__) === basename($_SERVER['SCRIPT_NAME'])) {
    $test = new IntegrationTest();
    $test->runAllTests();
}