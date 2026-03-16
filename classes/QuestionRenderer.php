<?php

/**
 * QuestionRenderer class for dynamic question display
 * Handles rendering of both single-choice and multiple-choice questions
 */

require_once __DIR__ . '/CodeFormatter.php';
class QuestionRenderer
{
    /**
     * Render a question based on its type
     * 
     * @param array $question Question data with question_type field
     * @param array $answers Array of answer options
     * @return string HTML output for the question
     */
    public static function renderQuestion($question, $answers)
    {
        if (!isset($question['question_type'])) {
            // Default to single choice for backward compatibility
            $question['question_type'] = 'single';
        }

        if ($question['question_type'] === 'multiple') {
            return self::renderMultipleChoice($question, $answers);
        }
        
        return self::renderSingleChoice($question, $answers);
    }

    /**
     * Render single-choice question with radio buttons
     * 
     * @param array $question Question data
     * @param array $answers Array of answer options
     * @return string HTML output
     */
    public static function renderSingleChoice($question, $answers)
    {
        $html = '';
        
        foreach ($answers as $answer) {
            $answerId = htmlspecialchars($answer['id'], ENT_QUOTES, 'UTF-8');
            // Fix: Use proper HTML escaping for answer text instead of formatTextWithCode
            $answerText = htmlspecialchars($answer['answer_text'], ENT_QUOTES, 'UTF-8');
            
            $html .= '<div class="form-check mb-3">' . "\n";
            $html .= '    <input class="form-check-input" type="radio" name="answer_id" ';
            $html .= 'id="answer' . $answerId . '" value="' . $answerId . '" required ';
            $html .= 'aria-describedby="question-text">' . "\n";
            $html .= '    <label class="form-check-label" for="answer' . $answerId . '">' . "\n";
            $html .= '        ' . $answerText . "\n";
            $html .= '    </label>' . "\n";
            $html .= '</div>' . "\n";
        }
        
        return $html;
    }

    /**
     * Render multiple-choice question with checkboxes
     * 
     * @param array $question Question data
     * @param array $answers Array of answer options
     * @return string HTML output
     */
    public static function renderMultipleChoice($question, $answers)
    {
        $html = '';
        
        foreach ($answers as $answer) {
            $answerId = htmlspecialchars($answer['id'], ENT_QUOTES, 'UTF-8');
            // Fix: Use proper HTML escaping for answer text instead of formatTextWithCode
            $answerText = htmlspecialchars($answer['answer_text'], ENT_QUOTES, 'UTF-8');
            
            $html .= '<div class="form-check mb-3">' . "\n";
            $html .= '    <input class="form-check-input" type="checkbox" name="answer_ids[]" ';
            $html .= 'id="answer' . $answerId . '" value="' . $answerId . '" ';
            $html .= 'aria-describedby="question-text">' . "\n";
            $html .= '    <label class="form-check-label" for="answer' . $answerId . '">' . "\n";
            $html .= '        ' . $answerText . "\n";
            $html .= '    </label>' . "\n";
            $html .= '</div>' . "\n";
        }
        
        return $html;
    }

    /**
     * Get the appropriate input name for the question type
     * 
     * @param string $questionType The question type ('single' or 'multiple')
     * @return string The input name to use in forms
     */
    public static function getInputName($questionType)
    {
        return $questionType === 'multiple' ? 'answer_ids[]' : 'answer_id';
    }

    /**
     * Get the appropriate input type for the question type
     * 
     * @param string $questionType The question type ('single' or 'multiple')
     * @return string The input type ('radio' or 'checkbox')
     */
    public static function getInputType($questionType)
    {
        return $questionType === 'multiple' ? 'checkbox' : 'radio';
    }

    /**
     * Check if a question type requires at least one selection
     * 
     * @param string $questionType The question type
     * @return bool True if at least one selection is required
     */
    public static function requiresSelection($questionType)
    {
        // Both single and multiple choice require at least one selection
        return true;
    }
}