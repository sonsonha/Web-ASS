<?php
require_once '../../config/database.php'; 
require_once '../../app/controllers/ArticleController.php'; 

$data = json_decode(file_get_contents("php://input"), true);

if (!empty($data['id']) && !empty($data['description']) && !empty($data['image_url']) && !empty($data['title'])) {
    $articleController = new ArticleController($db);
    $articleController->editArticle($data);
} else {
    // Trường hợp thiếu tham số
    echo json_encode([
        'status' => 'error',
        'message' => 'Missing or invalid parameters'
    ]);
}
?>
