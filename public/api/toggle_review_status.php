<?php
require_once '../../config/database.php';  
require_once '../../app/controllers/ReviewController.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    $reviewId = isset($data['reviewId']) ? $data['reviewId'] : null;

    if ($reviewId) {
        $reviewController = new ReviewController($db);
        $reviewController->toggleReviewStatus($reviewId);
    } else {
        echo json_encode([
            'status' => 'error',
            'message' => 'Review ID parameter is missing'
        ]);
    }
} else {
    echo json_encode([
        'status' => 'error',
        'message' => 'Invalid request method'
    ]);
}
?>
