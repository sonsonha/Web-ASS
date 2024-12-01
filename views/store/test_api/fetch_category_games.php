<?php
header('Content-Type: application/json');

$input = json_decode(file_get_contents('php://input'), true);
$category = $input['category'] ?? null;
$page = $input['page'] ?? 1; // Current page number
$limit = 10; // Number of games per page
$offset = ($page - 1) * $limit;

if (!$category) {
    http_response_code(400);
    echo json_encode(['error' => 'Category is required']);
    exit;
}

// Simulated games for demonstration
$games = [
    [
        'id' => 1,
        'title' => 'Age of Opl',
        'background_image' => '/assets/images/game1.webp',
        'background' => '/assets/images/game5.webp',
        'trending' => true,
        'price' => '360,000đ',
        'discount' => '20%',
        'tags' => ['OIN', 'RTS'],
    ],
    [
        'id' => 1   ,
        'title' => 'League of Legendssssss',
        'background_image' => '/assets/images/game2.webp',
        'background' => '/assets/images/game5.webp',
        'price' => 'Free',
        'trending' => true,
        'discount' => null,
        'tags' => ['Strategy', 'PvP'],
    ],
    [
        'id' => 1,
        'title' => 'Age of Mythology',
        'background_image' => '/assets/images/game1.webp',
        'background' => '/assets/images/game5.webp',
        'trending' => true,
        'price' => '360,000đ',
        'discount' => '20%',
        'tags' => ['Strategy', 'RTS'],
    ],
    [
        'id' => 2,
        'title' => 'League of Legends',
        'background_image' => '/assets/images/game2.webp',
        'background' => '/assets/images/game5.webp',
        'price' => 'Free',
        'trending' => true,
        'discount' => null,
        'tags' => ['Strategy', 'PvP'],
    ],
    [
        'id' => 1,
        'title' => 'Age of Mythology',
        'background_image' => '/assets/images/game1.webp',
        'background' => '/assets/images/game5.webp',
        'trending' => false,
        'price' => '360,000đ',
        'discount' => '20%',
        'tags' => ['Strategy', 'RTS'],
    ],
    [
        'id' => 2,
        'title' => 'League of Legends',
        'background_image' => '/assets/images/game2.webp',
        'background' => '/assets/images/game5.webp',
        'price' => 'Free',
        'trending' => false,
        'discount' => null,
        'tags' => ['Strategy', 'PvP'],
    ],
    [
        'id' => 1,
        'title' => 'Age of Mythology',
        'background_image' => '/assets/images/game1.webp',
        'background' => '/assets/images/game5.webp',
        'trending' => false,
        'price' => '360,000đ',
        'discount' => '20%',
        'tags' => ['Strategy', 'RTS'],
    ],
    [
        'id' => 2,
        'title' => 'League of Legends',
        'background_image' => '/assets/images/game2.webp',
        'background' => '/assets/images/game5.webp',
        'price' => 'Free',
        'trending' => false,
        'discount' => null,
        'tags' => ['Strategy', 'PvP'],
    ],
    [
        'id' => 1,
        'title' => 'Age of Mythology',
        'background_image' => '/assets/images/game1.webp',
        'background' => '/assets/images/game5.webp',
        'trending' => false,
        'price' => '360,000đ',
        'discount' => '20%',
        'tags' => ['Strategy', 'RTS'],
    ],
    [
        'id' => 2,
        'title' => 'League of Legends',
        'background_image' => '/assets/images/game2.webp',
        'background' => '/assets/images/game5.webp',
        'price' => 'Free',
        'trending' => false,
        'discount' => null,
        'tags' => ['Strategy', 'PvP'],
    ],
    [
        'id' => 2,
        'title' => 'League of Legends',
        'background_image' => '/assets/images/game2.webp',
        'background' => '/assets/images/game5.webp',
        'price' => 'Free',
        'trending' => false,
        'discount' => null,
        'tags' => ['Strategy', 'PvP'],
    ],
    // Add more games here
];

// Filter trending games for the carousel
$trendingGames = array_filter($games, fn($game) => $game['trending'] === true);

// Filter games by category for the popular games section
$filteredGames = array_filter($games, function ($game) use ($category) {
    return in_array($category, $game['tags']);
});

// Paginate games for popular games
$paginatedGames = array_slice($filteredGames, $offset, $limit);

// Prepare response
$response = [
    'trending' => array_values($trendingGames), // Trending games for the carousel
    'popular' => array_values($paginatedGames), // Paginated popular games
];

echo json_encode($response);
