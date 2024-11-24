<?php
header('Content-Type: application/json');

$input = json_decode(file_get_contents('php://input'), true);
$user_id = $input['user_id'] ?? null;
$new_coins = $input['new_coins'] ?? null;
$game_ids = $input['game_ids'] ?? null;

if (!$user_id || $new_coins === null || !$game_ids) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid request data']);
    exit;
}

// Simulated database update
$success = true; // Simulate success or failure

if ($success) {
    echo json_encode(['success' => true, 'new_coins' => $new_coins]);
} else {
    echo json_encode(['success' => false, 'message' => 'Purchase failed']);
}
?>
