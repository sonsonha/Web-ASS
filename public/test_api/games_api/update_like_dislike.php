<?php
header('Content-Type: application/json');

$input = json_decode(file_get_contents('php://input'), true);

$gameId = $input['game_id'] ?? null;
$reviewId = $input['review_id'] ?? null;
$userId = $input['user_id'] ?? null;
$action = $input['action'] ?? null;

if (!$gameId || !$reviewId || !$userId || !$action) {
    echo json_encode(['success' => false, 'message' => 'Invalid parameters.']);
    exit;
}

// Simulate updating the database (you'd replace this with real database logic)
$success = true;

echo json_encode(['success' => $success]);
