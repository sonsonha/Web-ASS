<?php
class ArticleModel {
    private $db;

    // Constructor nhận đối tượng PDO từ database.php
    public function __construct($db) {
        $this->db = $db;
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

    public function deleteArticle($article_id) {
        $query = "DELETE FROM bai_bao WHERE id = :id";

        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $article_id, PDO::PARAM_INT);

        try {
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error deleting article: " . $e->getMessage());
            return false;
        }
    }

    public function checkArticleExists($article_id) {
        $sql = "SELECT COUNT(*) FROM bai_bao WHERE id = :article_id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':article_id', $article_id, PDO::PARAM_INT);
        $stmt->execute();
        $count = $stmt->fetchColumn();

        return $count > 0; 
    }

    public function getAllArticles() {
        $query = "SELECT id, description, image_url, title 
                  FROM bai_bao";

        $stmt = $this->db->prepare($query);
        
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    
}
?>
