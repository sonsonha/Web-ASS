<?php
header('Content-Type: application/json');

// Simulated data for carousel games
$games = [
    [
        'id' => 1,
        'title' => 'Age of Empires IKKKV',
        'image' => 'assets/images/game1.webp',
        'price' => '450,000đ',
        'trending' => false,
        'new_release' => true,
        'rating' => 4.5,
        'discount' => '20%',
        'final_price' => '360,000đ',
        'is_free' => false,
    ],
    [
        'id' => 2,
        'title' => 'Civilization VI',
        'image' => 'assets/images/game2.webp',
        'price' => 'Free',
        'trending' => true,
        'new_release' => true,
        'rating' => 4,
        'discount' => '0%',
        'final_price' => '0',
        'is_free' => true,
    ],
    [   
        'id' => 3,
        'title' => 'The Witcher 3',
        'image' => 'assets/images/game3.webp',
        'price' => '600,000đ',
        'trending' => false,
        'new_release' => true,
        'rating' => 4.6,
        'discount' => '50%',
        'final_price' => '300,000đ',
        'is_free' => false,
    ],
    [
        'id' => 4,
        'title' => 'Red Dead Redemption 2',
        'image' => 'assets/images/game4.webp',
        'price' => '1,000,000đ',
        'trending' => true,
        'new_release' => true,
        'rating' => 4.9,
        'discount' => '25%',
        'final_price' => '750,000đ',
        'is_free' => false,
    ],
    [
        'id' => 5,
        'title' => 'Valorant',
        'image' => 'assets/images/game5.webp',
        'price' => 'Free',
        'trending' => true,
        'new_release' => true,
        'rating' => 4.3,
        'discount' => '0%',
        'final_price' => '0',
        'is_free' => true,
    ],
    [
        'id' => 3,
        'title' => 'The Witcher 3',
        'image' => 'assets/images/game3.webp',
        'price' => '600,000đ',
        'trending' => false,
        'new_release' => true,
        'rating' => 3.9,
        'discount' => '50%',
        'final_price' => '300,000đ',
        'is_free' => false,
    ],
    [
        'id' => 4,
        'title' => 'Red Dead Redemption 2',
        'image' => 'assets/images/game4.webp',
        'price' => '1,000,000đ',
        'trending' => true,
        'new_release' => true,
        'rating' => 4.8,
        'discount' => '25%',
        'final_price' => '750,000đ',
        'is_free' => false,
    ],
    [
        'id' => 5,
        'title' => 'Valorant',
        'image' => 'assets/images/game5.webp',
        'price' => 'Free',
        'trending' => false,
        'new_release' => true,
        'rating' => 4.2,
        'discount' => '0%',
        'final_price' => '0',
        'is_free' => true,
    ],
];

echo json_encode($games);
