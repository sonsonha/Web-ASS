<?php
header('Content-Type: application/json');

// Decode the JSON input
$input = json_decode(file_get_contents('php://input'), true);
$game_ids = $input['game_ids'] ?? null;

// Check if game_ids is provided and is an array
if (!$game_ids || !is_array($game_ids)) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid or missing game_ids']);
    exit;
}

// Simulated database of all games
$all_games = [
    ['id' => 1, 'title' => 'Game One', 'thumbnail' => '/public/assets/images/game1.webp', 'price' => '$10'],
    ['id' => 2, 'title' => 'Game Two', 'thumbnail' => '/public/assets/images/game2.webp', 'price' => '$15'],
    ['id' => 3, 'title' => 'Game Three', 'thumbnail' => '/public/assets/images/game3.webp', 'price' => '$20'],
    ['id' => 4, 'title' => 'Game Four', 'thumbnail' => '/public/assets/images/game4.webp', 'price' => '$25'],
    ['id' => 5, 'title' => 'Game Five', 'thumbnail' => '/public/assets/images/game5.webp', 'price' => '$30'],
];

// Filter games based on the provided game_ids
$games = array_filter($all_games, fn($game) => in_array($game['id'], $game_ids));

// Respond with the filtered games
echo json_encode(array_values($games));
?>
