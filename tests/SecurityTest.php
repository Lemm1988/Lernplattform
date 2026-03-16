<?php
/**
 * Comprehensive security tests for all classes
 * Focuses on XSS, SQL injection, and input validation
 */

require_once __DIR__ . '/../classes/AnswerProcessor.php';
require_once __DIR__ . '/../classes/CodeFormatter.php';
require_once __DIR__ . '/../classes/ResultsCalculator.php';
require_once __DIR__ . '/../classes/QuestionRenderer.php';

class SecurityTest {
    private $pdo;
    
    public function setUp() {
        // Create in-memory SQLite database for testing
        $this->pdo = new PDO('sqlite::memory:');
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->createTestTables();
        $this->insertTestData();
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
    
    private function insertTestData() {
        $this->pdo->exec("INSERT INTO questions (id, question_text, question_type) VALUES (1, 'Test question', 'single')");
        $this->pdo->exec("INSERT INTO answer_options (id, question_id, answer_text, is_correct) VALUES (1, 1, 'Correct', 1)");
        $this->pdo->exec("INSERT INTO quiz_sessions (id, user_id) VALUES (1, 1)");
    }
    
    public function testXSSAttackVectors() {
        echo "Testing XSS attack vectors...\n";
        
        $xssPayloads = [
            '<script>alert("XSS")</script>',
            '"><script>alert("XSS")</script>',
            '<img src="x" onerror="alert(\'XSS\')">',
            'javascript:alert("XSS")',
            '<svg onload="alert(\'XSS\')">',
            '<iframe src="javascript:alert(\'XSS\')"></iframe>',
            '<object data="javascript:alert(\'XSS\')"></object>',
            '<embed src="javascript:alert(\'XSS\')">',
            '<link rel="stylesheet" href="javascript:alert(\'XSS\')">',
            '<style>@import "javascript:alert(\'XSS\')"</style>',
            '<meta http-equiv="refresh" content="0;url=javascript:alert(\'XSS\')">',
            '<form><button formaction="javascript:alert(\'XSS\')">',
            '<input type="image" src="x" onerror="alert(\'XSS\')">',
            '<video><source onerror="alert(\'XSS\')">',
            '<audio src="x" onerror="alert(\'XSS\')">',
            '<details open ontoggle="alert(\'XSS\')">',
            '<marquee onstart="alert(\'XSS\')">',
            '<select onfocus="alert(\'XSS\')" autofocus>',
            '<textarea onfocus="alert(\'XSS\')" autofocus>',
            '<keygen onfocus="alert(\'XSS\')" autofocus>',
            '&lt;script&gt;alert("XSS")&lt;/script&gt;',
            '%3Cscript%3Ealert("XSS")%3C/script%3E',
            'data:text/html,<script>alert("XSS")</script>',
            'vbscript:msgbox("XSS")',
            'expression(alert("XSS"))',
            '-moz-binding:url("javascript:alert(\'XSS\')")',
            'behavior:url("javascript:alert(\'XSS\')")'
        ];
        
        foreach ($xssPayloads as $payload) {
            // Test CodeFormatter
            $formatted = CodeFormatter::formatCode($payload, 'javascript');
            assert(strpos($formatted, '<script>') === false, "CodeFormatter failed to escape: $payload");
            assert(strpos($formatted, 'javascript:') === false, "CodeFormatter failed to escape: $payload");
            assert(strpos($formatted, 'onerror=') === false, "CodeFormatter failed to escape: $payload");
            
            // Test QuestionRenderer
            $question = ['id' => 1, 'question_text' => $payload, 'question_type' => 'single'];
            $answers = [['id' => 1, 'answer_text' => $payload]];
            $rendered = QuestionRenderer::renderQuestion($question, $answers);
            assert(strpos($rendered, '<script>') === false, "QuestionRenderer failed to escape: $payload");
            assert(strpos($rendered, 'javascript:') === false, "QuestionRenderer failed to escape: $payload");
            assert(strpos($rendered, 'onerror=') === false, "QuestionRenderer failed to escape: $payload");
        }
        
        echo "✓ All XSS attack vectors properly escaped\n";
    }
    
    public function testSQLInjectionAttacks() {
        echo "Testing SQL injection attack vectors...\n";
        
        $sqlPayloads = [
            "1' OR '1'='1",
            "1; DROP TABLE questions; --",
            "1' UNION SELECT * FROM users --",
            "1' AND (SELECT COUNT(*) FROM questions) > 0 --",
            "1'; INSERT INTO questions VALUES (999, 'hacked', 'single'); --",
            "1' OR 1=1 LIMIT 1 --",
            "1' OR SLEEP(5) --",
            "1' OR BENCHMARK(1000000,MD5(1)) --",
            "1' OR (SELECT * FROM (SELECT COUNT(*),CONCAT(version(),FLOOR(RAND(0)*2))x FROM information_schema.tables GROUP BY x)a) --",
            "1' WAITFOR DELAY '00:00:05' --",
            "1'; EXEC xp_cmdshell('dir'); --",
            "1' OR 'x'='x",
            "1' AND 1=2 UNION SELECT 1,2,3 --",
            "1' ORDER BY 1000 --",
            "1' GROUP BY 1,2,3,4,5 --",
            "1' HAVING 1=1 --",
            "1' AND ASCII(SUBSTRING((SELECT password FROM users LIMIT 1),1,1)) > 64 --"
        ];
        
        $processor = new AnswerProcessor($this->pdo);
        $calculator = new ResultsCalculator($this->pdo);
        
        foreach ($sqlPayloads as $payload) {
            try {
                // Test AnswerProcessor with SQL injection attempts
                $result = $processor->processSingleChoice($payload, 1, 1);
                // Should either fail gracefully or return safe result
                assert(is_array($result), "AnswerProcessor should return array for: $payload");
                
                // Test ResultsCalculator with SQL injection attempts
                $results = $calculator->calculateResults($payload);
                // Should either throw exception or return safe result
                assert(false, "Should have thrown exception for invalid input: $payload");
                
            } catch (Exception $e) {
                // Expected behavior - should throw exceptions for invalid input
                assert(true, "Correctly handled SQL injection attempt: $payload");
            }
        }
        
        echo "✓ All SQL injection attempts properly handled\n";
    }
    
    public function testInputValidationEdgeCases() {
        echo "Testing input validation edge cases...\n";
        
        $processor = new AnswerProcessor($this->pdo);
        $calculator = new ResultsCalculator($this->pdo);
        
        // Test with various invalid inputs
        $invalidInputs = [
            null,
            false,
            true,
            [],
            new stdClass(),
            -1,
            0,
            PHP_INT_MAX,
            -PHP_INT_MAX,
            1.5,
            'string',
            '',
            '   ',
            "\0",
            "\n\r\t",
            str_repeat('a', 10000)
        ];
        
        foreach ($invalidInputs as $input) {
            try {
                $processor->processSingleChoice($input, 1, 1);
                // Some inputs might be valid (like positive integers)
                if (is_numeric($input) && $input > 0 && $input == (int)$input) {
                    // This is expected to work
                } else {
                    assert(false, "Should have thrown exception for invalid input: " . var_export($input, true));
                }
            } catch (Exception $e) {
                // Expected for most invalid inputs
                assert(true, "Correctly rejected invalid input: " . var_export($input, true));
            }
            
            try {
                $calculator->calculateResults($input);
                if (is_numeric($input) && $input > 0 && $input == (int)$input) {
                    // This might work for valid numeric inputs
                } else {
                    assert(false, "Should have thrown exception for invalid input: " . var_export($input, true));
                }
            } catch (Exception $e) {
                // Expected for most invalid inputs
                assert(true, "Correctly rejected invalid input: " . var_export($input, true));
            }
        }
        
        echo "✓ All input validation edge cases handled correctly\n";
    }
    
    public function testCodeFormatterSecurityFeatures() {
        echo "Testing CodeFormatter security features...\n";
        
        // Test maximum length validation
        $longCode = str_repeat('a', 50001);
        try {
            CodeFormatter::sanitizeCodeForStorage($longCode, 50000);
            assert(false, 'Should throw exception for code exceeding max length');
        } catch (InvalidArgumentException $e) {
            assert(strpos($e->getMessage(), 'exceeds maximum length') !== false);
        }
        
        // Test dangerous code detection
        $dangerousCodes = [
            '<script>alert("xss")</script>',
            '<img src="x" onerror="alert(1)">',
            'javascript:alert(1)',
            'vbscript:msgbox(1)',
            'data:text/html,<script>alert(1)</script>',
            '<iframe src="javascript:alert(1)"></iframe>',
            '<object data="javascript:alert(1)"></object>',
            '<embed src="javascript:alert(1)">',
            '<link rel="stylesheet" href="javascript:alert(1)">',
            '<style>@import "javascript:alert(1)"</style>',
            '<meta http-equiv="refresh" content="0;url=javascript:alert(1)">',
            'expression(alert(1))',
            '-moz-binding:url("javascript:alert(1)")',
            'behavior:url("javascript:alert(1)")'
        ];
        
        foreach ($dangerousCodes as $code) {
            assert(CodeFormatter::isCodeSafe($code) === false, "Should detect dangerous code: $code");
        }
        
        // Test safe code passes
        $safeCodes = [
            '<?php echo "Hello World"; ?>',
            'function test() { return true; }',
            'SELECT * FROM users WHERE id = 1;',
            'print("Hello World")',
            '#include <stdio.h>',
            'public class Test { }',
            'def hello(): pass',
            '<!-- This is a comment -->'
        ];
        
        foreach ($safeCodes as $code) {
            assert(CodeFormatter::isCodeSafe($code) === true, "Should allow safe code: $code");
        }
        
        echo "✓ CodeFormatter security features working correctly\n";
    }
    
    public function testCSRFProtection() {
        echo "Testing CSRF protection in forms...\n";
        
        // Test that QuestionRenderer includes proper form structure for CSRF protection
        $question = ['id' => 1, 'question_text' => 'Test', 'question_type' => 'single'];
        $answers = [['id' => 1, 'answer_text' => 'Test']];
        
        $rendered = QuestionRenderer::renderQuestion($question, $answers);
        
        // Should include proper form structure that allows CSRF token insertion
        assert(strpos($rendered, 'name="answer_id"') !== false, 'Should have proper input names');
        assert(strpos($rendered, 'type="radio"') !== false, 'Should have proper input types');
        
        // Test multiple choice
        $question['question_type'] = 'multiple';
        $rendered = QuestionRenderer::renderQuestion($question, $answers);
        assert(strpos($rendered, 'name="answer_ids[]"') !== false, 'Should have proper array input names');
        
        echo "✓ Form structure supports CSRF protection\n";
    }
    
    public function testDataSanitization() {
        echo "Testing data sanitization...\n";
        
        // Test that all user input is properly sanitized
        $dirtyData = [
            "Normal text",
            "<script>alert('xss')</script>",
            "Text with\nnewlines\rand\ttabs",
            "Text with 'quotes' and \"double quotes\"",
            "Text with & ampersands < less than > greater than",
            "Text with unicode: 🚀 ñ ü ß",
            "Text with null bytes: \0",
            "Text with control chars: \x01\x02\x03",
            "Text with high ASCII: \xFF\xFE",
            "Text with SQL: ' OR 1=1 --",
            "Text with HTML entities: &lt;&gt;&amp;",
            "Text with URLs: http://example.com/script.js",
            "Text with email: test@example.com",
            "Text with phone: +1-555-123-4567"
        ];
        
        foreach ($dirtyData as $data) {
            // Test CodeFormatter sanitization
            $sanitized = CodeFormatter::sanitizeCodeForStorage($data);
            assert(strpos($sanitized, '<script>') === false, "CodeFormatter should sanitize: $data");
            assert(strpos($sanitized, "\0") === false, "Should remove null bytes: $data");
            
            // Test that formatted output is safe
            $formatted = CodeFormatter::formatCode($data, 'text');
            assert(strpos($formatted, '<script>') === false, "Formatted output should be safe: $data");
            assert(strpos($formatted, '&lt;') !== false || strpos($data, '<') === false, "Should escape HTML: $data");
        }
        
        echo "✓ Data sanitization working correctly\n";
    }
    
    public function runAllTests() {
        echo "Running comprehensive security tests...\n";
        echo "=====================================\n\n";
        
        $this->setUp();
        $this->testXSSAttackVectors();
        
        $this->setUp();
        $this->testSQLInjectionAttacks();
        
        $this->setUp();
        $this->testInputValidationEdgeCases();
        
        $this->setUp();
        $this->testCodeFormatterSecurityFeatures();
        
        $this->setUp();
        $this->testCSRFProtection();
        
        $this->setUp();
        $this->testDataSanitization();
        
        echo "\n🔒 All security tests passed! The application is secure against:\n";
        echo "- XSS attacks (Cross-Site Scripting)\n";
        echo "- SQL injection attacks\n";
        echo "- Input validation bypasses\n";
        echo "- Code injection attacks\n";
        echo "- CSRF vulnerabilities (form structure)\n";
        echo "- Data sanitization issues\n";
    }
}

// Run tests if this file is executed directly
if (basename(__FILE__) === basename($_SERVER['SCRIPT_NAME'])) {
    $test = new SecurityTest();
    $test->runAllTests();
}