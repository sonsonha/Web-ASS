<?php
require_once '../../config/database.php';
require_once '../../app/controllers/UserController.php';

$data = json_decode(file_get_contents("php://input"), true);

if ($data) {
    $userController = new UserController($db);
    $userController->addCoins($data);
} else {
    echo json_encode([
        'status' => 'error',
        'message' => 'Missing required parameter: coins'
    ]);
}
?>