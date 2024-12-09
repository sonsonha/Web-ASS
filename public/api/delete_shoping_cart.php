<?php
require_once '../../config/database.php';
require_once '../../app/controllers/UserController.php';

// Giải mã dữ liệu JSON từ body
$data = json_decode(file_get_contents('php://input'), true);

$userId = isset($data['user_id']) ? $data['user_id'] : null;
$gameId = isset($data['game_id']) ? $data['game_id'] : null;

if ($userId && $gameId) {
    $userController = new UserController($db);
    $success = $userController->deleteShoppingCart($userId, $gameId);
} else {
    echo json_encode([
        'status' => 'error',
        'message' => 'User ID or Game ID is missing'
    ]);
}
?>