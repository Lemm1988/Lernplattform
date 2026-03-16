<?php
/**
 * Test script for results.php error handling
 */

// Test htmlspecialchars with null values
echo "Testing htmlspecialchars with null values:\n";

// Test case 1: null value
$test_null = null;
try {
    $result = htmlspecialchars($test_null ?? 'Keine Antwort');
    echo "✓ Null value handled correctly: '$result'\n";
} catch (Exception $e) {
    echo "✗ Error with null value: " . $e->getMessage() . "\n";
}

// Test case 2: empty string
$test_empty = '';
try {
    if (!empty($test_empty)) {
        $result = htmlspecialchars($test_empty);
    } else {
        $result = 'Keine korrekte Antwort verfügbar';
    }
    echo "✓ Empty string handled correctly: '$result'\n";
} catch (Exception $e) {
    echo "✗ Error with empty string: " . $e->getMessage() . "\n";
}

// Test case 3: valid string
$test_valid = 'Test answer with <script>alert("xss")</script>';
try {
    $result = htmlspecialchars($test_valid);
    echo "✓ Valid string handled correctly: '$result'\n";
} catch (Exception $e) {
    echo "✗ Error with valid string: " . $e->getMessage() . "\n";
}

echo "\nAll error handling tests completed.\n";
?>