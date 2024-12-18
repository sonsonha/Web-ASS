<?php
class AdminModel {
    private $db;

    // Constructor nhận đối tượng PDO từ database.php
    public function __construct($db) {
        $this->db = $db;
    }

    // Lấy thông tin của một user theo username
    public function getUserInfo($username) {
        $query = "SELECT u.account_id, u.coins, t.username, t.email, u.status
            FROM user u
            JOIN tai_khoan t ON u.id = t.id
            WHERE t.username = :username";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(":username", $username, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Lấy danh sách tất cả user
    public function getAllUsers() {
        $query = "SELECT u.account_id, u.coins, t.username, t.email, u.status
                  FROM user u
                  JOIN tai_khoan t ON u.account_id = t.id
                  WHERE t.role = 'User'";
    
        $stmt = $this->db->prepare($query);
        
        $stmt->execute();
    
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    
    public function toggleUserStatus($username) {
        $query = "SELECT status FROM user WHERE account_id IN (SELECT id FROM tai_khoan WHERE username = :username)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(":username", $username, PDO::PARAM_STR);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $currentStatus = $stmt->fetchColumn();

            $newStatus = ($currentStatus == 1) ? 0 : 1;

            $updateQuery = "UPDATE user SET status = :newStatus WHERE account_id IN (SELECT id FROM tai_khoan WHERE username = :username)";
            $updateStmt = $this->db->prepare($updateQuery);
            $updateStmt->bindParam(":newStatus", $newStatus, PDO::PARAM_INT);
            $updateStmt->bindParam(":username", $username, PDO::PARAM_STR);

            return $updateStmt->execute();
        } else {
            return false; 
        }
    }

    public function updateUsername($oldUsername, $newUsername) {
        $query = "SELECT id FROM tai_khoan WHERE username = :newUsername";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(":newUsername", $newUsername, PDO::PARAM_STR);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return false; 
        }

        $query = "UPDATE tai_khoan SET username = :newUsername WHERE username = :oldUsername";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(":newUsername", $newUsername, PDO::PARAM_STR);
        $stmt->bindParam(":oldUsername", $oldUsername, PDO::PARAM_STR);

        return $stmt->execute(); 
    }

    public function deleteUser($username) {
        $this->db->beginTransaction();
    
        try {
            $query1 = "DELETE FROM user WHERE id IN (SELECT id FROM tai_khoan WHERE username = :username)";
            $stmt1 = $this->db->prepare($query1);
            $stmt1->bindParam(":username", $username, PDO::PARAM_STR);
            $stmt1->execute();
    
            if ($stmt1->rowCount() === 0) {
                throw new Exception("No rows affected in user table");
            }
    
            $query2 = "DELETE FROM tai_khoan WHERE username = :username";
            $stmt2 = $this->db->prepare($query2);
            $stmt2->bindParam(":username", $username, PDO::PARAM_STR);
            $stmt2->execute();
    
            if ($stmt2->rowCount() === 0) {
                throw new Exception("No rows affected in tai_khoan table");
            }
    
            $this->db->commit();
            return true;
        } catch (Exception $e) {
            $this->db->rollBack();
            echo json_encode([
                'status' => 'error',
                'message' => 'Failed to delete user: ' . $e->getMessage()
            ]);
            return false;
        }
    }

    public function getAdminInfo($username) {
        $query = "
            SELECT username, avatar
            FROM tai_khoan
            WHERE username = :username AND role = 'Admin'
        ";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    public function reportError($user_id, $game_id, $error_description) {
        $query = "INSERT INTO bao_loi (user_id, game_id, error_description) 
                  VALUES (:user_id, :game_id, :error_description)";
        $stmt = $this->db->prepare($query);

        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->bindParam(':game_id', $game_id, PDO::PARAM_INT);
        $stmt->bindParam(':error_description', $error_description, PDO::PARAM_STR);

        return $stmt->execute();
    }
    
    public function deleteErrorReport($id) {
        $query = "DELETE FROM bao_loi WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
    
        return $stmt->execute();
    }

    public function addArticle($article_data) {
        $query = "INSERT INTO bai_bao (description, image_url, title) 
                  VALUES (:description, :image_url, :title)";

        $stmt = $this->db->prepare($query);

        $stmt->bindParam(':description', $article_data['description']);
        $stmt->bindParam(':image_url', $article_data['image_url']);
        $stmt->bindParam(':title', $article_data['title']);

        try {
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error adding article: " . $e->getMessage());
            return false;
        }
    }

    public function editArticle($article_data) {
        $query = "UPDATE bai_bao 
                  SET description = :description, 
                      image_url = :image_url, 
                      title = :title 
                  WHERE id = :id";

        $stmt = $this->db->prepare($query);

        $stmt->bindParam(':description', $article_data['description']);
        $stmt->bindParam(':image_url', $article_data['image_url']);
        $stmt->bindParam(':title', $article_data['title']);
        $stmt->bindParam(':id', $article_data['id'], PDO::PARAM_INT);

        try {
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error updating article: " . $e->getMessage());
            return false;
        }
    }
}
?>
