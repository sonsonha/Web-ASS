<?php
class ReviewModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function submitReview($userId, $gameId, $score, $comment) {
        $sql = "INSERT INTO danh_gia (user_id, game_id, score, comment) 
                VALUES (:user_id, :game_id, :score, :comment)";

        $stmt = $this->db->prepare($sql);

        $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $stmt->bindParam(':game_id', $gameId, PDO::PARAM_INT);
        $stmt->bindParam(':score', $score, PDO::PARAM_INT);
        $stmt->bindParam(':comment', $comment, PDO::PARAM_STR);

        if ($stmt->execute()) {
            return true; 
        } else {
            return false; 
        }
    }

    public function deleteReview($id) {
        try {
            $sql = "DELETE FROM danh_gia WHERE id = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function toggleReviewStatus($reviewId) {
        $query = "SELECT status FROM danh_gia WHERE id = :reviewId";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(":reviewId", $reviewId, PDO::PARAM_INT);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $currentStatus = $stmt->fetchColumn();

            $newStatus = ($currentStatus == 1) ? 0 : 1;

            $updateQuery = "UPDATE danh_gia SET status = :newStatus WHERE id = :reviewId";
            $updateStmt = $this->db->prepare($updateQuery);
            $updateStmt->bindParam(":newStatus", $newStatus, PDO::PARAM_INT);
            $updateStmt->bindParam(":reviewId", $reviewId, PDO::PARAM_INT);

            return $updateStmt->execute();
        } else {
            return false;
        }
    }
}

?>
