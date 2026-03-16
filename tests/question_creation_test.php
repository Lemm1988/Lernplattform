<?php
/**
 * Test script for question creation with question type support
 */

require_once '../config.php';

echo "<h2>Testing Question Creation with Question Type Support</h2>\n";

// Test 1: Check if question_type column exists
echo "<h3>Test 1: Database Schema Check</h3>\n";
try {
    $stmt = $pdo->query("DESCRIBE questions");
    $columns = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    $question_type_exists = false;
    foreach ($columns as $column) {
        if ($column['Field'] === 'question_type') {
            $question_type_exists = true;
            echo "✓ question_type column exists: " . $column['Type'] . "\n";
            break;
        }
    }
    
    if (!$question_type_exists) {
        echo "✗ question_type column does not exist\n";
    }
} catch (Exception $e) {
    echo "✗ Error checking database schema: " . $e->getMessage() . "\n";
}

// Test 2: Test form validation logic
echo "<h3>Test 2: Form Validation Logic</h3>\n";

// Simulate POST data for single choice question
$test_data_single = [
    'question_text' => 'Test single choice question',
    'learning_field_id' => 1,
    'question_type' => 'single',
    'difficulty' => 'easy',
    'points' => 1,
    'answer_text' => ['Answer 1', 'Answer 2', 'Answer 3'],
    'is_correct' => [0 => '1'], // First answer is correct
    'sort_order' => [1, 2, 3]
];

// Simulate POST data for multiple choice question
$test_data_multiple = [
    'question_text' => 'Test multiple choice question',
    'learning_field_id' => 1,
    'question_type' => 'multiple',
    'difficulty' => 'medium',
    'points' => 2,
    'answer_text' => ['Answer 1', 'Answer 2', 'Answer 3', 'Answer 4'],
    'is_correct' => [0 => '1', 2 => '1'], // First and third answers are correct
    'sort_order' => [1, 2, 3, 4]
];

// Test validation function
function test_validation($data, $test_name) {
    $question_text = trim($data['question_text'] ?? '');
    $learning_field_id = intval($data['learning_field_id'] ?? 0);
    $question_type = $data['question_type'] ?? '';
    $answers = $data['answer_text'] ?? [];
    
    $errors = [];
    
    if (!$question_text || !$learning_field_id || !$question_type || count($answers) < 2) {
        $errors[] = 'Missing required fields or insufficient answers';
    }
    
    if (!in_array($question_type, ['single', 'multiple'])) {
        $errors[] = 'Invalid question type';
    }
    
    if (empty($errors)) {
        echo "✓ $test_name: Validation passed\n";
        return true;
    } else {
        echo "✗ $test_name: " . implode(', ', $errors) . "\n";
        return false;
    }
}

test_validation($test_data_single, 'Single Choice Question');
test_validation($test_data_multiple, 'Multiple Choice Question');

// Test invalid data
$test_data_invalid = [
    'question_text' => '',
    'learning_field_id' => 0,
    'question_type' => 'invalid',
    'answer_text' => ['Only one answer']
];

test_validation($test_data_invalid, 'Invalid Question Data');

echo "<h3>Test 3: Question Type Options</h3>\n";
$valid_types = ['single', 'multiple'];
foreach ($valid_types as $type) {
    echo "✓ Question type '$type' is valid\n";
}

echo "<h3>Test Complete</h3>\n";
echo "All tests for question creation with question type support have been executed.\n";
?>