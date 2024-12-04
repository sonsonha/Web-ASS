<?php
header('Content-Type: application/json');

// Simulated categories from the back-end
$categories = [
    ['name' => 'Racing', 'image' => '/public/assets/images/yes.webp', 'slug' => 'Racing'],
    ['name' => 'Strategy', 'image' => '/public/assets/images/game1.webp', 'slug' => 'Strategy'],
    ['name' => 'Story-Rich', 'image' => '/public/assets/images/game3.webp', 'slug' => 'Story-Rich'],
    ['name' => 'Anime', 'image' => '/public/assets/images/game6.webp', 'slug' => 'Anime'],
    ['name' => 'Action', 'image' => '/public/assets/images/action.webp', 'slug' => 'Action'],
    ['name' => 'Adventure', 'image' => '/public/assets/images/adventure.webp', 'slug' => 'Adventure'],
];

echo json_encode($categories);
?>
