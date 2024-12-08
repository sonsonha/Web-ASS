<?php
require_once __DIR__ . '/../models/ReviewModel.php';
class ReviewController {
    private $reviewModel;

    public function __construct($db) {
        $this->reviewModel = new ReviewModel($db);
    }

    public function submitReview($userId, $gameId, $score, $comment) {
        header('Content-Type: application/json');
    
    
        if ($this->reviewModel->submitReview($userId, $gameId, $score, $comment)) {
            echo json_encode([
                'status' => 'success',
                'message' => 'Review submitted successfully'
            ]);
            exit; 
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'Failed to submit review'
            ]);
            exit;
        }
    }
    

    // Phương thức xóa review
    public function deleteReview($id) {
        header('Content-Type: application/json');
        if ($this->reviewModel->deleteReview($id)) {
            echo json_encode([
                'status' => 'success',
                'message' => 'Review deleted successfully'
            ]);
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'Failed to delete review'
            ]);
        }
    }

    public function toggleReviewStatus($reviewId) {
        header('Content-Type: application/json');
        $result = $this->reviewModel->toggleReviewStatus($reviewId);

        if ($result) {
            echo json_encode([
                'status' => 'success',
                'message' => 'Review status has been toggled successfully'
            ]);
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'Failed to toggle review status'
            ]);
        }
    }



    
}

?>
