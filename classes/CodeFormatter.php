<?php
/**
 * CodeFormatter - Safely formats and displays code examples in quiz questions
 * Provides XSS protection and syntax highlighting support
 */

class CodeFormatter {
    
    /**
     * Supported programming languages for syntax highlighting
     */
    private static $supportedLanguages = [
        'php', 'javascript', 'java', 'python', 'c', 'cpp', 'html', 'css', 'sql', 'json', 'xml'
    ];
    
    /**
     * Format code with HTML escaping and syntax highlighting
     * 
     * @param string $code Raw code content
     * @param string $language Programming language for syntax highlighting
     * @param array $options Additional formatting options
     * @return string Safely formatted HTML
     */
    public static function formatCode($code, $language = 'php', $options = []) {
        // Input validation
        if (!is_string($code)) {
            throw new InvalidArgumentException('Code must be a string');
        }
        
        if (!is_string($language)) {
            throw new InvalidArgumentException('Language must be a string');
        }
        
        // Sanitize language parameter
        $language = strtolower(trim($language));
        if (!in_array($language, self::$supportedLanguages)) {
            $language = 'text'; // Fallback to plain text
        }
        
        // XSS Protection: HTML escape the code (decode first to avoid double-encoding)
        $decodedCode = html_entity_decode($code, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $escapedCode = htmlspecialchars($decodedCode, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        
        // Default options
        $defaultOptions = [
            'line_numbers' => false,
            'highlight_lines' => [],
            'max_height' => null,
            'theme' => 'default'
        ];
        
        $options = array_merge($defaultOptions, $options);
        
        // Build CSS classes
        $cssClasses = ['code-block', "language-{$language}"];
        
        if ($options['line_numbers']) {
            $cssClasses[] = 'line-numbers';
        }
        
        if ($options['theme'] !== 'default') {
            $cssClasses[] = "theme-{$options['theme']}";
        }
        
        $classAttribute = 'class="' . implode(' ', $cssClasses) . '"';
        
        // Build style attribute if needed
        $styleAttribute = '';
        if ($options['max_height']) {
            $maxHeight = (int)$options['max_height'];
            $styleAttribute = " style=\"max-height: {$maxHeight}px; overflow-y: auto;\"";
        }
        
        // Format with line numbers if requested
        if ($options['line_numbers']) {
            $escapedCode = self::addLineNumbers($escapedCode, $options['highlight_lines']);
        }
        
        // Wrap in pre/code tags with proper attributes
        return "<pre {$classAttribute}{$styleAttribute}><code>{$escapedCode}</code></pre>";
    }
    
    /**
     * Format inline code (shorter code snippets within text)
     * 
     * @param string $code Raw code content
     * @param string $language Programming language
     * @return string Safely formatted inline HTML
     */
    public static function formatInlineCode($code, $language = 'php') {
        // Input validation and XSS protection
        if (!is_string($code)) {
            throw new InvalidArgumentException('Code must be a string');
        }
        
        $language = strtolower(trim($language));
        if (!in_array($language, self::$supportedLanguages)) {
            $language = 'text';
        }
        
        // XSS Protection: HTML escape the code (decode first to avoid double-encoding)
        $decodedCode = html_entity_decode($code, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $escapedCode = htmlspecialchars($decodedCode, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        
        return "<code class=\"inline-code language-{$language}\">{$escapedCode}</code>";
    }
    
    /**
     * Add line numbers to code
     * 
     * @param string $escapedCode Already HTML-escaped code
     * @param array $highlightLines Array of line numbers to highlight
     * @return string Code with line numbers
     */
    private static function addLineNumbers($escapedCode, $highlightLines = []) {
        $lines = explode("\n", $escapedCode);
        $numberedLines = [];
        
        foreach ($lines as $index => $line) {
            $lineNumber = $index + 1;
            $highlightClass = in_array($lineNumber, $highlightLines) ? ' class="highlight"' : '';
            $numberedLines[] = "<span class=\"line-number\"{$highlightClass}>{$lineNumber}</span>{$line}";
        }
        
        return implode("\n", $numberedLines);
    }
    
    /**
     * Extract and format code blocks from question text
     * Finds code blocks marked with ```language and formats them
     * 
     * @param string $text Question text that may contain code blocks
     * @return string Text with formatted code blocks
     */
    public static function formatCodeBlocks($text) {
        if (!is_string($text)) {
            return $text;
        }
        
        // Pattern to match code blocks: ```language\ncode\n```
        $pattern = '/```(\w+)?\s*\n(.*?)\n```/s';
        
        return preg_replace_callback($pattern, function($matches) {
            $language = !empty($matches[1]) ? $matches[1] : 'text';
            $code = $matches[2];
            
            return self::formatCode($code, $language);
        }, $text);
    }
    
    /**
     * Validate and sanitize code input for storage
     * 
     * @param string $code Raw code input
     * @param int $maxLength Maximum allowed length
     * @return string Sanitized code ready for database storage
     */
    public static function sanitizeCodeForStorage($code, $maxLength = 10000) {
        if (!is_string($code)) {
            throw new InvalidArgumentException('Code must be a string');
        }
        
        // Remove any existing HTML tags (in case someone tries to inject)
        $code = strip_tags($code);
        
        // Normalize line endings
        $code = str_replace(["\r\n", "\r"], "\n", $code);
        
        // Trim excessive whitespace but preserve code structure
        $code = trim($code);
        
        // Enforce length limit
        if (strlen($code) > $maxLength) {
            throw new InvalidArgumentException("Code exceeds maximum length of {$maxLength} characters");
        }
        
        return $code;
    }
    
    /**
     * Generate CSS for syntax highlighting and code formatting
     * 
     * @param string $theme Theme name (default, dark, light)
     * @return string CSS rules for code formatting
     */
    public static function generateCSS($theme = 'default') {
        $baseCSS = "
        .code-block {
            background-color: #f8f9fa;
            border: 1px solid #e9ecef;
            border-radius: 4px;
            padding: 1rem;
            margin: 1rem 0;
            font-family: 'Courier New', Consolas, monospace;
            font-size: 0.9em;
            line-height: 1.4;
            overflow-x: auto;
        }
        
        .code-block code {
            background: none;
            padding: 0;
            border: none;
        }
        
        .inline-code {
            background-color: #f1f3f4;
            padding: 0.2em 0.4em;
            border-radius: 3px;
            font-family: 'Courier New', Consolas, monospace;
            font-size: 0.9em;
        }
        
        .line-numbers .line-number {
            display: inline-block;
            width: 3em;
            text-align: right;
            margin-right: 1em;
            color: #6c757d;
            user-select: none;
        }
        
        .line-numbers .line-number.highlight {
            background-color: #fff3cd;
            color: #856404;
        }
        ";
        
        switch ($theme) {
            case 'dark':
                $baseCSS .= "
                .code-block {
                    background-color: #2d3748;
                    border-color: #4a5568;
                    color: #e2e8f0;
                }
                
                .inline-code {
                    background-color: #4a5568;
                    color: #e2e8f0;
                }
                ";
                break;
                
            case 'light':
                $baseCSS .= "
                .code-block {
                    background-color: #ffffff;
                    border-color: #d1d5db;
                    color: #374151;
                }
                ";
                break;
        }
        
        return $baseCSS;
    }
    
    /**
     * Check if a string contains potentially malicious code
     * 
     * @param string $code Code to check
     * @return bool True if code appears safe
     */
    public static function isCodeSafe($code) {
        if (!is_string($code)) {
            return false;
        }
        
        // Check for common XSS patterns
        $dangerousPatterns = [
            '/<script\b[^<]*(?:(?!<\/script>)<[^<]*)*<\/script>/mi',
            '/javascript:/i',
            '/on\w+\s*=/i', // onclick, onload, etc.
            '/<iframe\b/i',
            '/<object\b/i',
            '/<embed\b/i',
            '/<form\b/i'
        ];
        
        foreach ($dangerousPatterns as $pattern) {
            if (preg_match($pattern, $code)) {
                return false;
            }
        }
        
        return true;
    }
    
    /**
     * Get list of supported programming languages
     * 
     * @return array List of supported language codes
     */
    public static function getSupportedLanguages() {
        return self::$supportedLanguages;
    }
}