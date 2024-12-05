<?php
require_once '../../config/database.php';
require_once '../../app/controllers/GameController.php';

// Lấy dữ liệu game từ body của yêu cầu POST
$game_data = json_decode(file_get_contents("php://input"), true);

if ($game_data && isset($game_data['game_id'])) {
    // Khởi tạo GameController và gọi API updateGame
    $gameController = new GameController($db);
    $gameController->updateGame();
} else {
    echo json_encode([
        'status' => 'error',
        'message' => 'Game ID parameter is missing'
    ]);
}
?>
