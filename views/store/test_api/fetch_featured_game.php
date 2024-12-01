<?php
header('Content-Type: application/json');

$featuredGame = [
    'title' => 'STALKER 2: Heart of Chornobyl',
    'description' => 'Discover the vast Chornobyl Exclusion Zone full of dangerous enemies, deadly anomalies, and powerful artifacts.',
    'price' => '1,319,000₫',
    'backgroundImage' => '/assets/images/stalker-bg.jpg'
];

echo json_encode($featuredGame);
