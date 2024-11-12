<?php
$game = [
    'id' => 1,
    "title" => "Age of Mythology: Retold",
    "release_date" => "September 5, 2024",
    "reviews" => "Very Positive (10,483 Reviews)",
    "background_image" => "/public/assets/images/aom-bg.jpg",
    "description" => "From the creators of the award-winning Age of Empires franchise...",
    "price" => "360,000đ",
    "original_price" => "450,000đ",
    "discount" => "20%",
    "developer" => "World's Edge, Forgotten Empires",
    "publisher" => "Xbox Game Studios",
    "tags" => ["Strategy", "RTS", "Mythology", "Action RTS", "Fantasy"],
    "thumbnails" => [
        ["type" => "image", "src" => "/public/assets/images/game1.webp"],
        ["type" => "image", "src" => "/public/assets/images/game2.webp"],
        ["type" => "image", "src" => "/public/assets/images/game3.webp"],
        ["type" => "video", "src" => "/public/assets/videos/game1.mp4", "thumbnail" => "/public/assets/images/thumbnail-video1.jpg"],
        ["type" => "video", "src" => "/public/assets/videos/game2.mp4", "thumbnail" => "/public/assets/images/thumbnail-video2.jpg"]
    ],
    "introduction" => "Age of Mythology: Retold is a modern reimagining of the classic RTS game that blends historical elements with mythology.",
    "about" => "Step into a world of gods, monsters, and legendary heroes. Play through campaigns inspired by ancient mythology or battle with friends in multiplayer modes.",
    "system_requirements" => [
        "minimum" => [
            "OS" => "Windows 10 (64-bit)",
            "Processor" => "Intel Core i5-4460 / AMD Ryzen 3 1200",
            "Memory" => "8 GB RAM",
            "Graphics" => "NVIDIA GTX 760 / AMD Radeon HD 7870",
            "DirectX" => "Version 11",
            "Storage" => "50 GB available space"
        ],
        "recommended" => [
            "OS" => "Windows 10 (64-bit)",
            "Processor" => "Intel Core i7-8700K / AMD Ryzen 5 3600",
            "Memory" => "16 GB RAM",
            "Graphics" => "NVIDIA GTX 1070 / AMD RX Vega 56",
            "DirectX" => "Version 11",
            "Storage" => "50 GB available space"
        ]
    ]
];
$userRole = 'admin'; // Switch to 'user' for testing user role
$userHasBoughtGame = false; // Set to true for testing purchase status
$commentsEnabled = true;

$reviews = [
    1 => [ // Game ID
        [
            'username' => 'Gamer123',
            'avatar' => '/public/assets/images/avatar1.jpg',
            'rating' => 5,
            'message' => 'Amazing game with incredible graphics!',
            'likes' => 10,
            'dislikes' => 2,
            'comments' => [
                ['username' => 'User1', 'message' => 'Totally agree!', 'likes' => 3, 'dislikes' => 1],
                ['username' => 'User2', 'message' => 'Not my favorite.', 'likes' => 2, 'dislikes' => 2],
            ],
        ],
        [
            'username' => 'PlayerXYZ',
            'avatar' => '/public/assets/images/avatar2.jpg',
            'rating' => 4,
            'message' => 'Great game but could use more content.',
            'likes' => 5,
            'dislikes' => 1,
            'comments' => [],
        ]
    ]
];



$averageRating = 4.5; // Example calculation based on review data.
$userHasBoughtGame = true; // Set to true for testing the "Add Review" form.


include 'detail.php';
