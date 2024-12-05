<?php
header('Content-Type: application/json');

// Decode JSON input
$input = json_decode(file_get_contents('php://input'), true);
$user_id = $input['user_id'] ?? null;

if (!$user_id) {
    http_response_code(400);
    echo json_encode(['error' => 'User ID is required']);
    exit;
}

// Simulated database response for the user
$users = [
    [
        'id' => 1,
        'name' => 'John Doe',
        'email' => 'johndoe@example.com',
        'avatar' => 'assets/images/game1.webp',
        'coins' => 120,
        'game-own' => [5, 2, 3],
    ],
    [
        'id' => 2,
        'name' => 'Marfin',
        'email' => 'Maf@example.com',
        'avatar' => 'assets/images/avatar2.jpg',
        'coins' => 300,
        'game-own' => [1, 4, 5],
    ],
];

$user = array_values(array_filter($users, fn($u) => $u['id'] == $user_id))[0] ?? null;

if (!$user) {
    http_response_code(404);
    echo json_encode(['error' => 'User not found']);
    exit;
}

echo json_encode($user);
?>
