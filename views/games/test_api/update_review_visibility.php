<?php
// update_review_visibility.php

$data = json_decode(file_get_contents('php://input'), true);
$reviewId = $data['id'];
$show = $data['show'];

// Simulate updating the database
$response = [
    'success' => true,
    'message' => 'Review visibility updated.'
];

// Return JSON response
header('Content-Type: application/json');
echo json_encode($response);
?>
