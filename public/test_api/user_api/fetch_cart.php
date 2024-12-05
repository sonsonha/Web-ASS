<?php
header('Content-Type: application/json');

// Simulated cart data
$input = json_decode(file_get_contents('php://input'), true);
$user_id = $input['user_id'] ?? null;

if (!$user_id) {
    http_response_code(400);
    echo json_encode(['error' => 'User ID is required']);
    exit;
}

// Example cart data
$cart_items = [
    [
        'id' => 1,
        'title' => 'Game 1',
        'price' => 49.99,
        'thumbnail' => 'assets/images/game1.webp',
    ],
    [
        'id' => 2,
        'title' => 'Game 2',
        'price' => 29.99,
        'thumbnail' => 'assets/images/game2.webp',
    ],
    [
        'id' => 3,
        'title' => 'Game 3',
        'price' => 59.99,
        'thumbnail' => 'assets/images/game3.webp',
    ],
];

echo json_encode($cart_items);
?>
