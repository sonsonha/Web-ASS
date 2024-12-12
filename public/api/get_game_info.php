<?php
require_once '../../config/database.php';
require_once '../../app/controllers/GameController.php';

$data = json_decode(file_get_contents("php://input"), true);

$id = isset($_GET['id']) ? $_GET['id'] : null;
if ($id) {
    $userController = new GameController($db);
    $userController->getGameInfo($id);
} else {
    echo json_encode([
        'status' => 'error',
        'message' => 'Missing required parameter: id'
    ]);
}
?>