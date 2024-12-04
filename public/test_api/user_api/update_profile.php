<?php
header('Content-Type: application/json');

$input = json_decode(file_get_contents('php://input'), true);

$user_id = $input['user_id'] ?? null;
$username = $input['username'] ?? null;
$email = $input['email'] ?? null;

if (!$user_id || !$username || !$email) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid input.']);
    exit;
}

// Simulate database update
// Assume success if all fields are valid
echo json_encode(['success' => true]);
?>
