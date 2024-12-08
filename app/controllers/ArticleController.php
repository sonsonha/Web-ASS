<?php
require_once '../../app/models/ArticleModel.php';

class ArticleController {
    private $articleModel;
    
    public function __construct($db) {
        $this->articleModel = new ArticleModel($db);
    }
    public function addArticle() {
        header('Content-Type: application/json');

        $article_data = json_decode(file_get_contents("php://input"), true);

        if (!empty($article_data['description']) && !empty($article_data['image_url']) && !empty($article_data['title'])) {
            $result = $this->articleModel->addArticle($article_data);

            if ($result) {
                echo json_encode([
                    'status' => 'success',
                    'message' => 'Article added successfully'
                ]);
            } else {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Failed to add article'
                ]);
            }
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'Invalid input data. All fields are required.'
            ]);
        }
    }
    public function editArticle($article_data) {
        header('Content-Type: application/json');

        if (!empty($article_data['id']) && !empty($article_data['description']) && !empty($article_data['image_url']) && !empty($article_data['title'])) {
            $result = $this->articleModel->editArticle($article_data);

            if ($result) {
                echo json_encode([
                    'status' => 'success',
                    'message' => 'Article updated successfully'
                ]);
            } else {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Failed to update article'
                ]);
            }
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'Invalid input data. All fields are required.'
            ]);
        }
    }

    public function deleteArticle($article_id) {
        header('Content-Type: application/json');

        if (!empty($article_id)) {
            $result = $this->articleModel->deleteArticle($article_id);

            if ($result) {
                echo json_encode([
                    'status' => 'success',
                    'message' => 'Article deleted successfully'
                ]);
            } else {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Failed to delete article'
                ]);
            }
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'Invalid article ID'
            ]);
        }
    }
}
?>
