<?php
/**
 * Integration test for code formatting in results.php
 */

// Include the helper functions from results.php
require_once '../classes/CodeFormatter.php';

// Copy the helper functions from results.php for testing
function formatTextWithCode($text) {
    if (empty($text)) {
        return '';
    }
    
    try {
        $formatted = CodeFormatter::formatCodeBlocks($text);
        
        $formatted = preg_replace_callback('/`([^`]+)`/', function($matches) {
            $code = $matches[1];
            $language = detectCodeLanguage($code);
            return CodeFormatter::formatInlineCode($code, $language);
        }, $formatted);
        
        return $formatted;
        
    } catch (Exception $e) {
        error_log("Error formatting text with code: " . $e->getMessage());
        return htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
    }
}

function detectCodeLanguage($code) {
    if (preg_match('/^\s*<\?php|^\s*\$\w+|echo\s+|print\s+/', $code)) {
        return 'php';
    }
    
    if (preg_match('/function\s*\(|var\s+\w+|let\s+\w+|const\s+\w+|console\.log/', $code)) {
        return 'javascript';
    }
    
    if (preg_match('/public\s+class|System\.out\.println|import\s+java\./', $code)) {
        return 'java';
    }
    
    if (preg_match('/def\s+\w+|import\s+\w+|print\s*\(|if\s+__name__/', $code)) {
        return 'python';
    }
    
    if (preg_match('/SELECT\s+|INSERT\s+INTO|UPDATE\s+|DELETE\s+FROM/i', $code)) {
        return 'sql';
    }
    
    if (preg_match('/<\w+[^>]*>|<\/\w+>/', $code)) {
        return 'html';
    }
    
    if (preg_match('/\w+\s*:\s*[^;]+;|\w+\s*\{/', $code)) {
        return 'css';
    }
    
    return 'text';
}

echo "Testing code formatting integration for results display:\n\n";

// Test 1: Question with PHP code block
$phpQuestion = "Was ist die Ausgabe dieses PHP-Codes?\n\n```php\n<?php\necho 'Hello World';\n?>\n```";
echo "Test 1 - PHP code block formatting:\n";
$result1 = formatTextWithCode($phpQuestion);
echo "✓ Contains code-block class: " . (strpos($result1, 'code-block') !== false ? 'Yes' : 'No') . "\n";
echo "✓ Contains language-php class: " . (strpos($result1, 'language-php') !== false ? 'Yes' : 'No') . "\n";
echo "✓ HTML escaped: " . (strpos($result1, '&lt;?php') !== false ? 'Yes' : 'No') . "\n\n";

// Test 2: Inline code detection
$inlineTests = [
    'echo "hello"' => 'php',
    'console.log("test")' => 'javascript', 
    'System.out.println("test")' => 'java',
    'print("hello")' => 'python',
    'SELECT * FROM users' => 'sql',
    '<div>content</div>' => 'html',
    'color: red;' => 'css',
    'regular text' => 'text'
];

echo "Test 2 - Language detection:\n";
foreach ($inlineTests as $code => $expectedLang) {
    $detectedLang = detectCodeLanguage($code);
    $status = ($detectedLang === $expectedLang) ? '✓' : '✗';
    echo "$status '$code' -> detected: $detectedLang, expected: $expectedLang\n";
}
echo "\n";

// Test 3: Mixed content
$mixedContent = "This function `echo 'test'` outputs text.\n\nHere's the full code:\n\n```php\n<?php\necho 'Hello World';\n?>\n```\n\nAnd inline: `console.log('js')`.";
echo "Test 3 - Mixed content formatting:\n";
$result3 = formatTextWithCode($mixedContent);
echo "✓ Contains both inline and block code: " . 
     (strpos($result3, 'inline-code') !== false && strpos($result3, 'code-block') !== false ? 'Yes' : 'No') . "\n";
echo "✓ Multiple languages detected: " . 
     (strpos($result3, 'language-php') !== false && strpos($result3, 'language-javascript') !== false ? 'Yes' : 'No') . "\n\n";

// Test 4: XSS protection
$xssTest = "Malicious code: `<script>alert('xss')</script>` and block:\n\n```javascript\nalert('hack');\n<script>evil()</script>\n```";
echo "Test 4 - XSS protection:\n";
$result4 = formatTextWithCode($xssTest);
echo "✓ No unescaped <script> tags: " . (strpos($result4, '<script>') === false ? 'Yes' : 'No') . "\n";
echo "✓ Contains escaped &lt;script&gt;: " . (strpos($result4, '&lt;script&gt;') !== false ? 'Yes' : 'No') . "\n\n";

// Test 5: Error handling
echo "Test 5 - Error handling:\n";
$result5 = formatTextWithCode(null);
echo "✓ Handles null input: " . (empty($result5) ? 'Yes' : 'No') . "\n";

$result6 = formatTextWithCode('');
echo "✓ Handles empty string: " . (empty($result6) ? 'Yes' : 'No') . "\n";

echo "\nAll integration tests completed.\n";
?>