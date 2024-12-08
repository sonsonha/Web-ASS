<?php
require_once '../../config/database.php'; 
require_once '../../app/controllers/ArticleController.php'; 

$data = json_decode(file_get_contents("php://input"), true);

if (!empty($data['id'])) {
    $articleController = new ArticleController($db);
    $articleController->deleteArticle($data['id']);
} else {
    echo json_encode([
        'status' => 'error',
        'message' => 'Missing or invalid article ID'
    ]);
}
?>
