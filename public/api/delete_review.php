<?php
require_once '../../config/database.php';
require_once '../../app/controllers/ReviewController.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    if (isset($data['id'])) {
        $reviewController = new ReviewController($db);
        $reviewController->deleteReview($data['id']);
    } else {
        echo json_encode([
            'status' => 'error',
            'message' => 'ID is required'
        ]);
    }
} else {
    echo json_encode([
        'status' => 'error',
        'message' => 'Invalid request method'
    ]);
}

?>

