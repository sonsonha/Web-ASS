<?php
require_once '../../config/database.php';  
require_once '../../app/controllers/ReviewController.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    $userId = isset($data['user_id']) ? $data['user_id'] : null;
    $gameId = isset($data['game_id']) ? $data['game_id'] : null;
    $score = isset($data['score']) ? $data['score'] : null;
    $comment = isset($data['comment']) ? $data['comment'] : null;

    if ($userId && $gameId && $score && ($score >= 1 && $score <= 5)) {
        $reviewController = new ReviewController($db);
        $result = $reviewController->submitReview($userId, $gameId, $score, $comment);
        
        if ($result) {
            echo json_encode([
                'status' => 'success',
                'message' => 'Review submitted successfully'
            ]);
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'Failed to submit review'
            ]);
        }
    } else {
        echo json_encode([
            'status' => 'error',
            'message' => 'Invalid input or score out of range'
        ]);
    }
} else {
    echo json_encode([
        'status' => 'error',
        'message' => 'Invalid request method'
    ]);
}
?>
