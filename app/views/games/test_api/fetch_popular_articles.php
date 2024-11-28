<?php
// Example test data (replace this with actual database logic if needed)
$popular_articles = [
    [
        'id' => 1,
        'image' => '/public/assets/images/game3.webp',
        'title' => 'Game 1: The Adventure Begins',
        'description' => 'This is the first popular game article about an epic adventure.',
        'link' => '/article/1',
    ],
    [
        'id' => 2,
        'image' => '/public/assets/images/game3.webp',
        'title' => 'Game 2: Mystery Unfolded',
        'description' => 'Dive into the mystery of Game 2, where every decision counts.',
        'link' => '/article/2',
    ],
    [
        'id' => 3,
        'image' => '/public/assets/images/game3.webp',
        'title' => 'Game 3: The Final Showdown',
        'description' => 'Prepare for the ultimate battle in Game 3, the final chapter of the series.',
        'link' => '/article/3',
    ],
];

// Return the test data as JSON
header('Content-Type: application/json');
echo json_encode($popular_articles);
?>
