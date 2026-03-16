<?php

require_once __DIR__ . '/../classes/QuestionRenderer.php';

/**
 * Integration tests for QuestionRenderer class
 */
class QuestionRendererTest
{
    private $testResults = [];

    public function runAllTests()
    {
        echo "Running QuestionRenderer Tests...\n";
        echo "================================\n";

        $this->testRenderSingleChoiceQuestion();
        $this->testRenderMultipleChoiceQuestion();
        $this->testRenderQuestionWithoutType();
        $this->testRenderQuestionWithEmptyAnswers();
        $this->testXSSProtection();
        $this->testAccessibilityAttributes();
        $this->testInputNameGeneration();
        $this->testInputTypeGeneration();
        $this->testRequiresSelection();

        $this->printResults();
    }

    private function testRenderSingleChoiceQuestion()
    {
        $question = [
            'id' => 1,
            'question_text' => 'What is PHP?',
            'question_type' => 'single'
        ];

        $answers = [
            ['id' => 1, 'answer_text' => 'A programming language'],
            ['id' => 2, 'answer_text' => 'A database'],
            ['id' => 3, 'answer_text' => 'An operating system']
        ];

        $html = QuestionRenderer::renderQuestion($question, $answers);

        // Check for radio buttons
        $hasRadio = strpos($html, 'type="radio"') !== false;
        $hasCorrectName = strpos($html, 'name="answer_id"') !== false;
        $hasRequired = strpos($html, 'required') !== false;
        $hasAccessibility = strpos($html, 'aria-describedby="question-text"') !== false;

        $this->testResults[] = [
            'test' => 'Render Single Choice Question',
            'passed' => $hasRadio && $hasCorrectName && $hasRequired && $hasAccessibility,
            'details' => "Radio: $hasRadio, Name: $hasCorrectName, Required: $hasRequired, Accessibility: $hasAccessibility"
        ];
    }

    private function testRenderMultipleChoiceQuestion()
    {
        $question = [
            'id' => 2,
            'question_text' => 'Which are programming languages?',
            'question_type' => 'multiple'
        ];

        $answers = [
            ['id' => 4, 'answer_text' => 'PHP'],
            ['id' => 5, 'answer_text' => 'JavaScript'],
            ['id' => 6, 'answer_text' => 'HTML']
        ];

        $html = QuestionRenderer::renderQuestion($question, $answers);

        // Check for checkboxes
        $hasCheckbox = strpos($html, 'type="checkbox"') !== false;
        $hasCorrectName = strpos($html, 'name="answer_ids[]"') !== false;
        $hasAccessibility = strpos($html, 'aria-describedby="question-text"') !== false;
        $noRequired = strpos($html, 'required') === false; // Multiple choice shouldn't have required on individual checkboxes

        $this->testResults[] = [
            'test' => 'Render Multiple Choice Question',
            'passed' => $hasCheckbox && $hasCorrectName && $hasAccessibility && $noRequired,
            'details' => "Checkbox: $hasCheckbox, Name: $hasCorrectName, Accessibility: $hasAccessibility, No Required: $noRequired"
        ];
    }

    private function testRenderQuestionWithoutType()
    {
        $question = [
            'id' => 3,
            'question_text' => 'Default question without type'
        ];

        $answers = [
            ['id' => 7, 'answer_text' => 'Answer 1'],
            ['id' => 8, 'answer_text' => 'Answer 2']
        ];

        $html = QuestionRenderer::renderQuestion($question, $answers);

        // Should default to single choice (radio)
        $hasRadio = strpos($html, 'type="radio"') !== false;
        $hasCorrectName = strpos($html, 'name="answer_id"') !== false;

        $this->testResults[] = [
            'test' => 'Render Question Without Type (Backward Compatibility)',
            'passed' => $hasRadio && $hasCorrectName,
            'details' => "Defaults to radio buttons for backward compatibility"
        ];
    }

    private function testRenderQuestionWithEmptyAnswers()
    {
        $question = [
            'id' => 4,
            'question_text' => 'Question with no answers',
            'question_type' => 'single'
        ];

        $answers = [];

        $html = QuestionRenderer::renderQuestion($question, $answers);

        // Should return empty string or handle gracefully
        $isEmpty = trim($html) === '';

        $this->testResults[] = [
            'test' => 'Render Question With Empty Answers',
            'passed' => $isEmpty,
            'details' => "Handles empty answers array gracefully"
        ];
    }

    private function testXSSProtection()
    {
        $question = [
            'id' => 5,
            'question_text' => 'XSS Test Question',
            'question_type' => 'single'
        ];

        $answers = [
            ['id' => 9, 'answer_text' => '<script>alert("XSS")</script>'],
            ['id' => 10, 'answer_text' => '"><img src=x onerror=alert("XSS")>']
        ];

        $html = QuestionRenderer::renderQuestion($question, $answers);

        // Check that dangerous content is escaped
        $hasScript = strpos($html, '<script>') !== false;
        $hasImgTag = strpos($html, '<img') !== false;
        $hasEscapedContent = strpos($html, '&lt;script&gt;') !== false || strpos($html, '&quot;&gt;') !== false;

        $this->testResults[] = [
            'test' => 'XSS Protection',
            'passed' => !$hasScript && !$hasImgTag && $hasEscapedContent,
            'details' => "Script blocked: " . (!$hasScript ? 'Yes' : 'No') . ", Content escaped: " . ($hasEscapedContent ? 'Yes' : 'No')
        ];
    }

    private function testAccessibilityAttributes()
    {
        $question = [
            'id' => 6,
            'question_text' => 'Accessibility test',
            'question_type' => 'single'
        ];

        $answers = [
            ['id' => 11, 'answer_text' => 'Option 1']
        ];

        $html = QuestionRenderer::renderQuestion($question, $answers);

        // Check for proper accessibility attributes
        $hasAriaDescribedBy = strpos($html, 'aria-describedby="question-text"') !== false;
        $hasProperLabels = strpos($html, 'for="answer11"') !== false;
        $hasMatchingIds = strpos($html, 'id="answer11"') !== false;

        $this->testResults[] = [
            'test' => 'Accessibility Attributes',
            'passed' => $hasAriaDescribedBy && $hasProperLabels && $hasMatchingIds,
            'details' => "ARIA: $hasAriaDescribedBy, Labels: $hasProperLabels, IDs: $hasMatchingIds"
        ];
    }

    private function testInputNameGeneration()
    {
        $singleName = QuestionRenderer::getInputName('single');
        $multipleName = QuestionRenderer::getInputName('multiple');

        $singleCorrect = $singleName === 'answer_id';
        $multipleCorrect = $multipleName === 'answer_ids[]';

        $this->testResults[] = [
            'test' => 'Input Name Generation',
            'passed' => $singleCorrect && $multipleCorrect,
            'details' => "Single: '$singleName', Multiple: '$multipleName'"
        ];
    }

    private function testInputTypeGeneration()
    {
        $singleType = QuestionRenderer::getInputType('single');
        $multipleType = QuestionRenderer::getInputType('multiple');

        $singleCorrect = $singleType === 'radio';
        $multipleCorrect = $multipleType === 'checkbox';

        $this->testResults[] = [
            'test' => 'Input Type Generation',
            'passed' => $singleCorrect && $multipleCorrect,
            'details' => "Single: '$singleType', Multiple: '$multipleType'"
        ];
    }

    private function testRequiresSelection()
    {
        $singleRequires = QuestionRenderer::requiresSelection('single');
        $multipleRequires = QuestionRenderer::requiresSelection('multiple');

        $bothTrue = $singleRequires && $multipleRequires;

        $this->testResults[] = [
            'test' => 'Requires Selection Logic',
            'passed' => $bothTrue,
            'details' => "Both question types require selection"
        ];
    }

    private function printResults()
    {
        echo "\nTest Results:\n";
        echo "=============\n";

        $passed = 0;
        $total = count($this->testResults);

        foreach ($this->testResults as $result) {
            $status = $result['passed'] ? '✓ PASS' : '✗ FAIL';
            echo sprintf("%-40s %s\n", $result['test'], $status);
            if (!$result['passed'] || isset($result['details'])) {
                echo "  Details: " . $result['details'] . "\n";
            }
            if ($result['passed']) {
                $passed++;
            }
        }

        echo "\nSummary: $passed/$total tests passed\n";
        
        if ($passed === $total) {
            echo "All tests passed! ✓\n";
        } else {
            echo "Some tests failed! ✗\n";
        }
    }
}

// Run tests if this file is executed directly
if (basename(__FILE__) === basename($_SERVER['SCRIPT_NAME'])) {
    $test = new QuestionRendererTest();
    $test->runAllTests();
}