<?php
header('Content-Type: application/json');

$input = json_decode(file_get_contents('php://input'), true);
$category = $input['category'] ?? null;

if (!$category) {
    http_response_code(400);
    echo json_encode(['error' => 'Category is required']);
    exit;
}

// Simulated games for demonstration
$games = [
    [
        'id' => 1,
        'title' => 'Age of Mythology',
        'background' => '/public/assets/images/game9.webp',
        'background_image' => '/public/assets/images/game1.webp',
        'release_date' => 'September 5, 2024',
        'reviews' => 3906,
        'price' => '360,000đ',
        'discount' => '20%',
        'tags' => ['Strategy', 'RTS', 'Fantasy'],
    ],
    [
        'id' => 2,
        'title' => 'League of Legends',
        'background' => '/public/assets/images/game5.webp',
        'background_image' => '/public/assets/images/game2.webp',
        'release_date' => 'October 15, 2024',
        'reviews' => 5056,
        'price' => 'Free',
        'discount' => null,
        'tags' => ['PvP', 'Strategy', 'Fantasy'],
    ],
    [
        'id' => 3,
        'title' => 'Maneater',
        'background' => '/public/assets/images/game9.webp',
        'background_image' => '/public/assets/images/game1.webp',
        'release_date' => 'September 5, 2024',
        'reviews' => 3906,
        'price' => '360,000đ',
        'discount' => '20%',
        'tags' => ['Strategy', 'RTS', 'Fantasy'],
    ],
    [
        'id' => 4,
        'title' => 'Canjura',
        'background' => '/public/assets/images/game5.webp',
        'background_image' => '/public/assets/images/game2.webp',
        'release_date' => 'October 15, 2024',
        'reviews' => 5056,
        'price' => 'Free',
        'discount' => null,
        'tags' => ['PvP', 'Strategy', 'Fantasy'],
    ],
    [
        'id' => 5,
        'title' => 'Honkai Impact 3rd',
        'background' => '/public/assets/images/game9.webp',
        'background_image' => '/public/assets/images/game1.webp',
        'release_date' => 'September 5, 2024',
        'reviews' => 3906,
        'price' => '360,000đ',
        'discount' => '20%',
        'tags' => ['Strategy', 'RTS', 'Fantasy'],
    ],
    [
        'id' => 6,
        'title' => 'Ion Fury',
        'background' => '/public/assets/images/game5.webp',
        'background_image' => '/public/assets/images/game2.webp',
        'release_date' => 'October 15, 2024',
        'reviews' => 5056,
        'price' => 'Free',
        'discount' => null,
        'tags' => ['PvP', 'Strategy', 'Fantasy'],
    ],
    // Add more games as needed
];

// Filter games by category
$filteredGames = array_filter($games, function ($game) use ($category) {
    return in_array($category, $game['tags']); // Match category with game tags
});

// Select 5 random games
$randomGames = array_slice($filteredGames, 0, 5);

echo json_encode(array_values($randomGames));
?>