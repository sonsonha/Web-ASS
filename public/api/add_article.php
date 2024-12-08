<?php
require_once '../../config/database.php'; 
require_once '../../app/controllers/ArticleController.php'; 

$data = json_decode(file_get_contents("php://input"));

if (!empty($data->description) && !empty($data->image_url) && !empty($data->title)) {
    $article_data = [
        'description' => $data->description,
        'image_url' => $data->image_url,
        'title' => $data->title
    ];

    $articleController = new ArticleController($db);
    $articleController->addArticle($article_data);

} else {
    echo json_encode([
        'status' => 'error',
        'message' => 'Missing required parameters'
    ]);
}
?>
