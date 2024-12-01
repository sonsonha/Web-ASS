<?php
header('Content-Type: application/json');

// Decode the JSON input
$input = json_decode(file_get_contents('php://input'), true);
$user_id = $input['user_id'] ?? null;
$game_id = $input['game_id'] ?? null;

if (!$user_id || !$game_id) {
    http_response_code(400);
    echo json_encode(['error' => 'User ID and Game ID are required']);
    exit;
}

// Simulate database operation
// Here you would remove the item from the database or session cart
$success = true; // Assume the operation is successful

if ($success) {
    echo json_encode(['success' => true]);
} else {
    http_response_code(500);
    echo json_encode(['error' => 'Failed to remove item from the cart']);
}
?>
