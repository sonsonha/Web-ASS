<?php
header('Content-Type: application/json');

// Simulated categories from the back-end
$categories = [
    ['name' => 'Racing', 'image' => '/assets/images/yes.webp', 'slug' => 'Racing'],
    ['name' => 'Strategy', 'image' => '/assets/images/game1.webp', 'slug' => 'Strategy'],
    ['name' => 'Story-Rich', 'image' => '/assets/images/game3.webp', 'slug' => 'Story-Rich'],
    ['name' => 'Anime', 'image' => '/assets/images/game6.webp', 'slug' => 'Anime'],
    ['name' => 'Action', 'image' => '/assets/images/action.webp', 'slug' => 'Action'],
    ['name' => 'Adventure', 'image' => '/assets/images/adventure.webp', 'slug' => 'Adventure'],
];

echo json_encode($categories);
?>
