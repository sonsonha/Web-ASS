<?php
require_once '../../config/database.php';
require_once '../../app/controllers/GameController.php';

$game_data = json_decode(file_get_contents("php://input"), true);

if (!empty($game_data['game_id'])) {
    $gameController = new GameController($db);
    $gameController->updateGame();
} else {
    echo json_encode([
        'status' => 'error',
        'message' => 'Game ID parameter is missing'
    ]);
}

?>
