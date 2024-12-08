<?php
require_once '../../config/database.php'; 
require_once '../../app/controllers/GameController.php';

$data = json_decode(file_get_contents("php://input"), true);

if (!empty($data['game_id'])) {
    $thumbnailController = new GameController($db);
    $thumbnailController->getThumbnails($data['game_id']);
} else {
    echo json_encode([
        'status' => 'error',
        'message' => 'Missing or invalid game ID'
    ]);
}
?>
