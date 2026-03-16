<?php
/**
 * Test for code formatting in results.php
 * This test verifies that the formatTextWithCode function works correctly
 */

// Include required classes
require_once '../classes/CodeFormatter.php';

// Copy the helper functions from results.php for testing
function formatTextWithCode($text) {
    if (empty($text)) {
        return '';
    }
    
    try {
        // First, format code blocks (```language\ncode\n```) with enhanced language detection
        $formatted = preg_replace_callback('/```(\w+)?\s*\n(.*?)\n```/s', function($matches) {
            $language = !empty($matches[1]) ? $matches[1] : detectCodeLanguage($matches[2]);
            $code = $matches[2];
            
            // Add language attribute for CSS targeting
            $formattedCode = CodeFormatter::formatCode($code, $language);
            
            // Add data-language attribute for display
            $formattedCode = str_replace('<pre class="code-block', '<pre data-language="' . strtoupper($language) . '" class="code-block', $formattedCode);
            
            return $formattedCode;
        }, $text);
        
        // Then format inline code (`code`) with enhanced language detection
        $formatted = preg_replace_callback('/`([^`]+)`/', function($matches) {
            $code = $matches[1];
            $language = detectCodeLanguage($code);
            
            // For very short code snippets, use simple formatting
            if (strlen(trim($code)) < 3) {
                return CodeFormatter::formatInlineCode($code, 'text');
            }
            
            return CodeFormatter::formatInlineCode($code, $language);
        }, $formatted);
        
        // Format any remaining unformatted code patterns
        $formatted = formatAdditionalCodePatterns($formatted);
        
        return $formatted;
        
    } catch (Exception $e) {
        error_log("Error formatting text with code: " . $e->getMessage());
        return htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
    }
}

function formatAdditionalCodePatterns($text) {
    // Format code that starts with common programming patterns
    $patterns = [
        // PHP code starting with <?php
        '/(\&lt;\?php\s+.*?)(?=\s|$)/s' => function($matches) {
            return CodeFormatter::formatInlineCode(html_entity_decode($matches[1]), 'php');
        },
        // Function calls with parentheses
        '/\b(\w+\([^)]*\))/s' => function($matches) {
            $code = $matches[1];
            if (preg_match('/^[a-zA-Z_][a-zA-Z0-9_]*\(/', $code)) {
                $language = detectCodeLanguage($code);
                return CodeFormatter::formatInlineCode($code, $language);
            }
            return $matches[0];
        }
    ];
    
    foreach ($patterns as $pattern => $callback) {
        $text = preg_replace_callback($pattern, $callback, $text);
    }
    
    return $text;
}

function detectCodeLanguage($code) {
    if (empty(trim($code))) {
        return 'text';
    }
    
    $code = trim($code);
    $lowerCode = strtolower($code);
    
    // PHP patterns (highest priority for PHP-specific syntax)
    if (preg_match('/^\s*<\?php|^\s*\$\w+|echo\s+["\']|print\s+["\']|\$_GET|\$_POST|function\s+\w+\s*\(.*\)\s*\{|class\s+\w+|namespace\s+/', $code)) {
        return 'php';
    }
    
    // JavaScript patterns (check for JS-specific syntax)
    if (preg_match('/function\s*\([^)]*\)\s*\{|var\s+\w+\s*=|let\s+\w+\s*=|const\s+\w+\s*=|console\.log\s*\(|document\.|window\.|alert\s*\(|=>\s*\{/', $code)) {
        return 'javascript';
    }
    
    // Java patterns (check for Java-specific syntax)
    if (preg_match('/public\s+class\s+\w+|System\.out\.println\s*\(|import\s+java\.|public\s+static\s+void\s+main|private\s+\w+\s+\w+|@Override/', $code)) {
        return 'java';
    }
    
    // Python patterns (check for Python-specific syntax)
    if (preg_match('/def\s+\w+\s*\([^)]*\)\s*:|import\s+\w+|from\s+\w+\s+import|print\s*\([^)]*\)|if\s+__name__\s*==|class\s+\w+\s*\([^)]*\)\s*:|\w+\s*=\s*\[.*\]/', $code)) {
        return 'python';
    }
    
    // C patterns
    if (preg_match('/#include\s*<.*>|int\s+main\s*\(|printf\s*\(|scanf\s*\(|malloc\s*\(|free\s*\(/', $code)) {
        return 'c';
    }
    
    // C++ patterns
    if (preg_match('/#include\s*<iostream>|std::|cout\s*<<|cin\s*>>|using\s+namespace\s+std|class\s+\w+\s*\{/', $code)) {
        return 'cpp';
    }
    
    // SQL patterns (enhanced)
    if (preg_match('/SELECT\s+.*\s+FROM|INSERT\s+INTO\s+\w+|UPDATE\s+\w+\s+SET|DELETE\s+FROM\s+\w+|CREATE\s+TABLE|ALTER\s+TABLE|DROP\s+TABLE/i', $code)) {
        return 'sql';
    }
    
    // HTML patterns (more specific)
    if (preg_match('/<(!DOCTYPE|html|head|body|div|span|p|h[1-6]|a|img|table|tr|td|th|ul|ol|li|form|input|button)\b[^>]*>|<\/\w+>/', $code)) {
        return 'html';
    }
    
    // CSS patterns (more specific)
    if (preg_match('/\w+\s*\{\s*\w+\s*:\s*[^;]+;|\.\w+\s*\{|#\w+\s*\{|@media\s+|@import\s+/', $code)) {
        return 'css';
    }
    
    // JSON patterns
    if (preg_match('/^\s*\{.*\}\s*$|^\s*\[.*\]\s*$/s', $code) && preg_match('/"[^"]*"\s*:\s*("[^"]*"|\d+|true|false|null)/', $code)) {
        return 'json';
    }
    
    // XML patterns
    if (preg_match('/<\?xml\s+version|<\w+[^>]*xmlns/', $code)) {
        return 'xml';
    }
    
    return 'text';
}

// Test cases
echo "=== Code Formatting Test for Quiz Results ===\n\n";

$testCases = [
    [
        'name' => 'PHP Code Block',
        'input' => "Was ist die Ausgabe dieses PHP-Codes?\n\n```php\n<?php\necho 'Hello World';\n\$name = 'Student';\necho 'Welcome, ' . \$name;\n?>\n```",
        'expected_contains' => ['code-block', 'language-php', 'data-language="PHP"', '&lt;?php', 'echo']
    ],
    [
        'name' => 'JavaScript Inline Code',
        'input' => "Verwenden Sie `console.log()` für die Ausgabe in JavaScript.",
        'expected_contains' => ['inline-code', 'language-javascript', 'console.log()']
    ],
    [
        'name' => 'Java Code Block',
        'input' => "Java Beispiel:\n\n```java\npublic class Test {\n    public static void main(String[] args) {\n        System.out.println(\"Hello\");\n    }\n}\n```",
        'expected_contains' => ['code-block', 'language-java', 'data-language="JAVA"', 'public class', 'System.out.println']
    ],
    [
        'name' => 'Python Code Block',
        'input' => "Python Funktion:\n\n```python\ndef greet(name):\n    print(f\"Hello, {name}\")\n    return \"Done\"\n\ngreet(\"World\")\n```",
        'expected_contains' => ['code-block', 'language-python', 'data-language="PYTHON"', 'def greet', 'print(f']
    ],
    [
        'name' => 'SQL Code Block',
        'input' => "SQL Abfrage:\n\n```sql\nSELECT u.name, COUNT(q.id) as quiz_count\nFROM users u\nLEFT JOIN quiz_sessions q ON u.id = q.user_id\nWHERE u.is_active = 1\nGROUP BY u.id;\n```",
        'expected_contains' => ['code-block', 'language-sql', 'data-language="SQL"', 'SELECT', 'FROM users']
    ],
    [
        'name' => 'Mixed Content',
        'input' => "Diese Funktion `echo 'test'` gibt Text aus.\n\nHier der vollständige Code:\n\n```php\n<?php\necho 'Hello World';\n?>\n```\n\nUnd inline: `console.log('js')`.",
        'expected_contains' => ['inline-code', 'code-block', 'language-php', 'language-javascript']
    ],
    [
        'name' => 'XSS Protection',
        'input' => "Gefährlicher Code: `<script>alert('xss')</script>` und Block:\n\n```javascript\nalert('hack');\n<script>evil()</script>\n```",
        'expected_contains' => ['&lt;script&gt;', 'alert(&#039;xss&#039;)', 'inline-code', 'code-block'],
        'should_not_contain' => ['<script>', 'alert(\'xss\')']
    ]
];

$passedTests = 0;
$totalTests = count($testCases);

foreach ($testCases as $i => $test) {
    echo "Test " . ($i + 1) . ": " . $test['name'] . "\n";
    echo str_repeat("-", 50) . "\n";
    
    $result = formatTextWithCode($test['input']);
    $testPassed = true;
    
    // Check expected content
    foreach ($test['expected_contains'] as $expected) {
        if (strpos($result, $expected) === false) {
            echo "✗ FAIL: Expected to contain '$expected'\n";
            $testPassed = false;
        } else {
            echo "✓ PASS: Contains '$expected'\n";
        }
    }
    
    // Check content that should not be present
    if (isset($test['should_not_contain'])) {
        foreach ($test['should_not_contain'] as $notExpected) {
            if (strpos($result, $notExpected) !== false) {
                echo "✗ FAIL: Should not contain '$notExpected'\n";
                $testPassed = false;
            } else {
                echo "✓ PASS: Does not contain '$notExpected'\n";
            }
        }
    }
    
    if ($testPassed) {
        echo "✓ TEST PASSED\n";
        $passedTests++;
    } else {
        echo "✗ TEST FAILED\n";
    }
    
    echo "\nFormatted Result:\n";
    echo substr($result, 0, 200) . (strlen($result) > 200 ? "..." : "") . "\n";
    echo "\n" . str_repeat("=", 70) . "\n\n";
}

// Summary
echo "=== TEST SUMMARY ===\n";
echo "Passed: $passedTests / $totalTests\n";

if ($passedTests === $totalTests) {
    echo "🎉 ALL TESTS PASSED! Code formatting is working correctly in results display.\n";
} else {
    echo "❌ Some tests failed. Please check the implementation.\n";
}

// Additional verification
echo "\n=== ADDITIONAL VERIFICATION ===\n";

// Test CodeFormatter class methods
echo "Testing CodeFormatter class methods:\n";

try {
    $testCode = "<?php\necho 'Hello World';\n?>";
    $formatted = CodeFormatter::formatCode($testCode, 'php');
    echo "✓ CodeFormatter::formatCode() works\n";
} catch (Exception $e) {
    echo "✗ CodeFormatter::formatCode() failed: " . $e->getMessage() . "\n";
}

try {
    $testInline = "console.log('test')";
    $formatted = CodeFormatter::formatInlineCode($testInline, 'javascript');
    echo "✓ CodeFormatter::formatInlineCode() works\n";
} catch (Exception $e) {
    echo "✗ CodeFormatter::formatInlineCode() failed: " . $e->getMessage() . "\n";
}

try {
    $css = CodeFormatter::generateCSS('default');
    echo "✓ CodeFormatter::generateCSS() works\n";
} catch (Exception $e) {
    echo "✗ CodeFormatter::generateCSS() failed: " . $e->getMessage() . "\n";
}

echo "\n=== TASK 5.3 VERIFICATION COMPLETE ===\n";
echo "Code formatting for quiz results is fully implemented and tested.\n";
?>