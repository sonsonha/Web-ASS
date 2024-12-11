<?php
require_once '../../config/database.php';
require_once '../../app/controllers/UserController.php';

$data = json_decode(file_get_contents('php://input'), true);    

$id = isset($_GET['id']) ? $_GET['id'] : null;

if ($id) {
    $userController = new UserController($db);
    $userController->getUserInfo($id);
} else {
    echo json_encode([
        'status' => 'error',
        'message' => 'Username parameter is missing'
    ]);
}
?>
