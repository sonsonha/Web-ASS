<?php
require_once '../../config/database.php';  // Kết nối cơ sở dữ liệu
require_once '../../app/controllers/AdminController.php';

$data = json_decode(file_get_contents('php://input'), true);

$username = isset($data['username']) ? $data['username'] : null;

if ($username) {

    $userController = new AdminController($db);
    $userController->getAdminInfo($username);
} else {
    echo json_encode([
        'status' => 'error',
        'message' => 'Username parameter is missing'
    ]);
}
?>