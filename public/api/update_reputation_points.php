<?php
require_once '../../config/database.php';  // Kết nối cơ sở dữ liệu
require_once '../../app/controllers/AdminController.php';

$data = json_decode(file_get_contents("php://input"));

if (!isset($data->username) || !isset($data->reputation_points)) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Username and reputation_points parameters are required'
    ]);
    exit;
}

$username = $data->username;
$newReputationPoints = $data->reputation_points;

$userController = new AdminController($db);
$userController->updateReputationPoints($username, $newReputationPoints);
?>
