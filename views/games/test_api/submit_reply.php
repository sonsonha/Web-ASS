<?php
header('Content-Type: application/json');

$input = json_decode(file_get_contents('php://input'), true);

$gameId = $input['game_id'] ?? null;
$reviewUsername = $input['review_username'] ?? null;
$userId = $input['user_id'] ?? null;
$replyMessage = $input['reply_message'] ?? null;

if (!$gameId || !$reviewUsername || !$userId || !$replyMessage) {
    echo json_encode(['success' => false, 'error' => 'Invalid input data.']);
    exit;
}

// Simulated saving reply to a database (append to a review for demonstration purposes)
$reviewIndex = array_search($reviewUsername, array_column($reviews[$gameId], 'username'));

if ($reviewIndex !== false) {
    $reviews[$gameId][$reviewIndex]['replies'][] = [
        'user_id' => $userId,
        'message' => $replyMessage,
        'timestamp' => date('Y-m-d H:i:s'),
    ];
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'error' => 'Review not found.']);
}
