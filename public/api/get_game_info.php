<?php
require_once '../../config/database.php';
require_once '../../app/controllers/GameController.php';

$data = json_decode(file_get_contents("php://input"), true);

if (!empty($data['id'])) {
    $game_id = (int)$data['id'];

    $gameController = new GameController($db);

    $gameController->getGameInfo($game_id);
} else {
    echo json_encode([
        'status' => 'error',
        'message' => 'Missing required parameter: id'
    ]);
}
?>