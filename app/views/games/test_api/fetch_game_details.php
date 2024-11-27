<?php
// fetch_game_details.php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


$input = json_decode(file_get_contents('php://input'), true);

// Extract `user_id` and `game_id` from the request
$userId = $input['user_id'] ?? null;
$gameId = $input['game_id'] ?? null;

$users = [
    [
        'id' => '1',
        'username' => 'Gamer123',   
        'avatar' => '/public/assets/images/avatar1.jpg',
        'role' => 'user',
        'game-own' => [1, 4, 5],
    ],
    [
        'id' => '2',
        'username' => 'PlayerXYZ',
        'avatar' => '/public/assets/images/avatar2.jpg',
        'role' => 'user',
        'game-own' => [2, 3],
    ],
    [
        'id' => '3',
        'username' => 'yasuo',
        'avatar' => '/public/assets/images/avatar3.jpg',
        'role' => 'user',
        'game-own' => [1, 2, 3, 4, 5],
    ],
    [
        'id' => '4',
        'username' => 'admin',
        'avatar' => '/public/assets/images/avatar4.jpg',
        'role' => 'admin',
        'game-own' => [],
    ],
    [
        'id' => '5',
        'username' => 'guest',
        'avatar' => '/public/assets/images/avatar5.jpg',
        'role' => 'guest',
        'game-own' => [],
    ],
];
// Simulated game data and reviews
$reviews = [
    1 => [
        [
            'username' => 'Gamer123',
            'avatar' => '/public/assets/images/avatar1.jpg',
            'rating' => 1,
            'show' => true,
            'message' => 'Bad!',
        ],
        [
            'username' => 'PlayerXYZ',
            'avatar' => '/public/assets/images/avatar2.jpg',
            'rating' => 4,
            'show' => false,
            'message' => 'Great game but could use more content.',
            'likes' => 5,
            'dislikes' => 1,
        ],
        [
            'username' => 'yasuo',
            'avatar' => '/public/assets/images/avatar2.jpg',
            'rating' => 5,
            'show' => true,
            'message' => 'Great game but could use more content.',
            'likes' => 5,
            'dislikes' => 1,
        ],
    ],
    2 => [
        [
            'username' => 'Panda',
            'avatar' => '/public/assets/images/avatar1.jpg',
            'rating' => 1,
            'show' => true,
            'message' => 'Bad!',
        ],
        [
            'username' => 'Mens',
            'avatar' => '/public/assets/images/avatar2.jpg',
            'rating' => 4,
            'show' => false,
            'message' => 'Great game but could use more content.',
            'likes' => 5,
            'dislikes' => 1,
        ],
    ],
    3 => [
        [
            'username' => 'poes',
            'avatar' => '/public/assets/images/avatar1.jpg',
            'rating' => 1,
            'show' => true,
            'message' => 'Bad!',
        ],
    ],
];

$games = [
    [
        'id' => 1,
        'title' => 'Age of Mythology ',
        'enable_comments' => true,
        'release_date' => 'September 5, 2024',
        'trending' => false,
        'reviews' => 3,
        'background_image' => '/public/assets/images/aom-bg.jpg',
        'description' => 'From the creators of the award-winning Age of Empires franchise...',
        'price' => '360,000đ',
        'original_price' => '450,000đ',
        'discount' => '20%',
        'developer' => 'World\'s Edge, Forgotten Empires',
        'publisher' => 'Xbox Game Studios',
        'genres' => ['Strategy', 'RTS', 'Mythology', 'Action RTS', 'Fantasy'],
        'background' => '/public/assets/images/aom-bg.jpg',
        'thumbnails' => [
            ['type' => 'image', 'src' => '/public/assets/images/game1.webp'],
            ['type' => 'image', 'src' => '/public/assets/images/game2.webp'],
            ['type' => 'image', 'src' => '/public/assets/images/game3.webp'],
            ['type' => 'video', 'src' => '/public/assets/videos/video1.mp4'],
            ['type' => 'image', 'src' => '/public/assets/images/game2.webp'],
            ['type' => 'video', 'src' => '/public/assets/videos/game2.mp4'],
            ['type' => 'image', 'src' => '/public/assets/images/game2.webp'],
        ],
        'introduction' => 'Age of Mythology: Retold is a modern reimagining of the classic RTS game that blends historical elements with mythology.',
        'about' => 'Step into a world of gods, monsters, and legendary heroes. Play through campaigns inspired by ancient mythology or battle with friends in multiplayer modes.',
        'system_requirements' => [
            'minimum' => [
                'OS' => 'Windows 10 (64-bit)',
                'Processor' => 'Intel Core i5-4460 / AMD Ryzen 3 1200',
                'Memory' => '8 GB RAM',
                'Graphics' => 'NVIDIA GTX 760 / AMD Radeon HD 7870',
                'DirectX' => 'Version 11',
                'Storage' => '50 GB available space',
            ],
            'recommended' => [
                'OS' => 'Windows 10 (64-bit)',
                'Processor' => 'Intel Core i7-8700K / AMD Ryzen 5 3600',
                'Memory' => '16 GB RAM',
                'Graphics' => 'NVIDIA GTX 1070 / AMD RX Vega 56',
                'DirectX' => 'Version 11',
                'Storage' => '50 GB available space',
            ]
        ],
    ],
    [
        'id' => 2,
        'title' => 'Leage of Legends',
        'enable_comments' => false,
        'release_date' => 'September 30, 2024',
        'trending' => false,
        'reviews' => 5,
        'background_image' => '/public/assets/images/aom-bg.jpg',
        'description' => 'From the creators of the award-winning Age of Empires franchise...',
        'price' => '8000,000đ',
        'original_price' => '450,0000đ',
        'discount' => '20%',
        'developer' => 'World\'s Edge, Forgotten Empires',
        'publisher' => 'Xbox Game Studios',
        'genres' => ['Strategy', 'RTS', 'Mythology', 'Fantasy'],
        'background' => '/public/assets/images/aom-bg.jpg',
        'thumbnails' => [
            ['type' => 'image', 'src' => '/public/assets/images/game1.webp'],
            ['type' => 'image', 'src' => '/public/assets/images/game2.webp'],
            ['type' => 'image', 'src' => '/public/assets/images/game3.webp'],
            ['type' => 'video', 'src' => '/public/assets/videos/game1.mp4'],
            ['type' => 'video', 'src' => '/public/assets/videos/game2.mp4']
        ],
        'introduction' => 'Leage of Legends: Retold is a modern reimagining of the classic RTS game that blends historical elements with mythology.',
        'about' => 'Step into a world of gods, monsters, and legendary heroes. Play through campaigns inspired by ancient mythology or battle with friends in multiplayer modes.',
        'system_requirements' => [
            'minimum' => [
                'OS' => 'Windows 10 (64-bit)',
                'Processor' => 'Intel Core i5-4460 / AMD Ryzen 3 1200',
                'Memory' => '8 GB RAM',
                'Graphics' => 'NVIDIA GTX 760 / AMD Radeon HD 7870',
                'DirectX' => 'Version 11',
                'Storage' => '50 GB available space',
            ],
            'recommended' => [
                'OS' => 'Windows 10 (64-bit)',
                'Processor' => 'Intel Core i7-8700K / AMD Ryzen 5 3600',
                'Memory' => '16 GB RAM',
                'Graphics' => 'NVIDIA GTX 1070 / AMD RX Vega 56',
                'DirectX' => 'Version 11',
                'Storage' => '50 GB available space',
            ]
        ],
    ]
];

// Validate inputs
if ($userId === null || $gameId === null) {
    http_response_code(400); // Bad request
    echo json_encode(['error' => 'User ID and Game ID are required']);
    exit;
}

// Find user and game data
$user = array_values(array_filter($users, fn($u) => $u['id'] === $userId))[0] ?? null;
$game = array_values(array_filter($games, fn($g) => $g['id'] == $gameId))[0] ?? null;
// $user = array_values(array_filter($user, fn($u) => $u['id'] === $userId))[0] ?? null;
// $game = array_values(array_filter($game, fn($g) => $g['id'] == $gameId))[0] ?? null;

// Check if data exists
if (!$user || !$game) {
    http_response_code(404); // Not found
    echo json_encode(['error' => 'User or Game not found']);
    exit;
}

// Get reviews for the game
$gameReviews = $reviews[$gameId] ?? [];

// Prepare the response
$response = [
    'game' => $game,
    'reviews' => $gameReviews,
    'user' => $user,
];

// Return as JSON
header('Content-Type: application/json');
echo json_encode($response);

// Simulate fetching data based on game ID
// $response = [
//     'game' => $game,
//     'reviews' => $reviews[$game['id']] ?? [],
//     'user' => $user,
// ];

// // Return as JSON
// header('Content-Type: application/json');
// echo json_encode($response);
