<?php
/**
 * Unit tests for CodeFormatter class
 */

require_once __DIR__ . '/../classes/CodeFormatter.php';

class CodeFormatterTest {
    
    public function testFormatCodeBasic() {
        $code = '<?php echo "Hello World"; ?>';
        $result = CodeFormatter::formatCode($code, 'php');
        
        // Should contain escaped HTML
        assert(strpos($result, '&lt;?php') !== false, 'Should escape PHP tags');
        assert(strpos($result, 'language-php') !== false, 'Should include language class');
        assert(strpos($result, '<pre class=') !== false, 'Should wrap in pre tag');
        assert(strpos($result, '<code>') !== false, 'Should wrap in code tag');
        
        echo "✓ testFormatCodeBasic passed\n";
    }
    
    public function testXSSProtection() {
        $maliciousCode = '<script>alert("XSS")</script>';
        $result = CodeFormatter::formatCode($maliciousCode, 'javascript');
        
        // Should not contain executable script tags
        assert(strpos($result, '<script>') === false, 'Should not contain script tags');
        assert(strpos($result, '&lt;script&gt;') !== false, 'Should escape script tags');
        
        echo "✓ testXSSProtection passed\n";
    }
    
    public function testInlineCodeFormatting() {
        $code = 'console.log("test")';
        $result = CodeFormatter::formatInlineCode($code, 'javascript');
        
        assert(strpos($result, 'inline-code') !== false, 'Should have inline-code class');
        assert(strpos($result, 'language-javascript') !== false, 'Should have language class');
        assert(strpos($result, '<code class=') !== false, 'Should use code tag');
        
        echo "✓ testInlineCodeFormatting passed\n";
    }
    
    public function testLineNumbers() {
        $code = "line 1\nline 2\nline 3";
        $result = CodeFormatter::formatCode($code, 'text', ['line_numbers' => true]);
        
        assert(strpos($result, 'line-numbers') !== false, 'Should have line-numbers class');
        assert(strpos($result, 'line-number') !== false, 'Should contain line number spans');
        
        echo "✓ testLineNumbers passed\n";
    }
    
    public function testCodeBlockExtraction() {
        $text = "Some text\n```php\n<?php echo 'test'; ?>\n```\nMore text";
        $result = CodeFormatter::formatCodeBlocks($text);
        
        assert(strpos($result, 'language-php') !== false, 'Should format PHP code block');
        assert(strpos($result, '&lt;?php') !== false, 'Should escape PHP in code block');
        assert(strpos($result, 'Some text') !== false, 'Should preserve surrounding text');
        
        echo "✓ testCodeBlockExtraction passed\n";
    }
    
    public function testSanitizeCodeForStorage() {
        $dirtyCode = "<script>alert('xss')</script>\r\n<?php echo 'test'; ?>\r\n";
        $result = CodeFormatter::sanitizeCodeForStorage($dirtyCode);
        
        assert(strpos($result, '<script>') === false, 'Should strip HTML tags');
        assert(strpos($result, "\r") === false, 'Should normalize line endings');
        assert(strpos($result, "<?php echo 'test'; ?>") !== false, 'Should preserve valid code');
        
        echo "✓ testSanitizeCodeForStorage passed\n";
    }
    
    public function testMaxLengthValidation() {
        $longCode = str_repeat('a', 10001);
        
        try {
            CodeFormatter::sanitizeCodeForStorage($longCode, 10000);
            assert(false, 'Should throw exception for code exceeding max length');
        } catch (InvalidArgumentException $e) {
            assert(strpos($e->getMessage(), 'exceeds maximum length') !== false, 'Should have appropriate error message');
        }
        
        echo "✓ testMaxLengthValidation passed\n";
    }
    
    public function testIsCodeSafe() {
        $safeCode = '<?php echo "Hello World"; ?>';
        $unsafeCode1 = '<script>alert("xss")</script>';
        $unsafeCode2 = '<img src="x" onclick="alert(1)">';
        $unsafeCode3 = 'javascript:alert(1)';
        
        assert(CodeFormatter::isCodeSafe($safeCode) === true, 'Safe code should pass');
        assert(CodeFormatter::isCodeSafe($unsafeCode1) === false, 'Script tags should fail');
        assert(CodeFormatter::isCodeSafe($unsafeCode2) === false, 'Event handlers should fail');
        assert(CodeFormatter::isCodeSafe($unsafeCode3) === false, 'JavaScript URLs should fail');
        
        echo "✓ testIsCodeSafe passed\n";
    }
    
    public function testUnsupportedLanguage() {
        $code = 'some code';
        $result = CodeFormatter::formatCode($code, 'unsupported-lang');
        
        assert(strpos($result, 'language-text') !== false, 'Should fallback to text for unsupported language');
        
        echo "✓ testUnsupportedLanguage passed\n";
    }
    
    public function testInvalidInputHandling() {
        try {
            CodeFormatter::formatCode(null, 'php');
            assert(false, 'Should throw exception for null code');
        } catch (InvalidArgumentException $e) {
            echo "✓ testInvalidInputHandling (null code) passed\n";
        }
        
        try {
            CodeFormatter::formatCode('code', 123);
            assert(false, 'Should throw exception for non-string language');
        } catch (InvalidArgumentException $e) {
            echo "✓ testInvalidInputHandling (invalid language) passed\n";
        }
    }
    
    public function testCSSGeneration() {
        $defaultCSS = CodeFormatter::generateCSS();
        $darkCSS = CodeFormatter::generateCSS('dark');
        
        assert(strpos($defaultCSS, '.code-block') !== false, 'Should contain code-block styles');
        assert(strpos($defaultCSS, '.inline-code') !== false, 'Should contain inline-code styles');
        assert(strpos($darkCSS, '#2d3748') !== false, 'Dark theme should have dark colors');
        
        echo "✓ testCSSGeneration passed\n";
    }
    
    public function testGetSupportedLanguages() {
        $languages = CodeFormatter::getSupportedLanguages();
        
        assert(is_array($languages), 'Should return array');
        assert(in_array('php', $languages), 'Should include PHP');
        assert(in_array('javascript', $languages), 'Should include JavaScript');
        assert(count($languages) > 0, 'Should have supported languages');
        
        echo "✓ testGetSupportedLanguages passed\n";
    }
    
    public function runAllTests() {
        echo "Running CodeFormatter tests...\n";
        
        $this->testFormatCodeBasic();
        $this->testXSSProtection();
        $this->testInlineCodeFormatting();
        $this->testLineNumbers();
        $this->testCodeBlockExtraction();
        $this->testSanitizeCodeForStorage();
        $this->testMaxLengthValidation();
        $this->testIsCodeSafe();
        $this->testUnsupportedLanguage();
        $this->testInvalidInputHandling();
        $this->testCSSGeneration();
        $this->testGetSupportedLanguages();
        
        echo "All CodeFormatter tests passed! ✓\n";
    }
}

// Run tests if this file is executed directly
if (basename(__FILE__) === basename($_SERVER['SCRIPT_NAME'])) {
    $test = new CodeFormatterTest();
    $test->runAllTests();
}