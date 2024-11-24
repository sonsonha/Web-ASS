<?php
// delete_review.php

$data = json_decode(file_get_contents('php://input'), true);
$reviewId = $data['id'];

// Simulate deleting the review from the database
$response = [
    'success' => true,
    'message' => 'Review deleted successfully.'
];

// Return JSON response
header('Content-Type: application/json');
echo json_encode($response);
?>
