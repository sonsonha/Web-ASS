<?php
require_once '../../config/database.php';  // Kết nối cơ sở dữ liệu
require_once '../../app/controllers/AdminController.php';

// Kiểm tra phương thức yêu cầu
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Lấy dữ liệu JSON từ body
    $data = json_decode(file_get_contents('php://input'), true);

    // Lấy username từ dữ liệu JSON
    $username = isset($data['username']) ? $data['username'] : null;

    if ($username) {
        // Khởi tạo UserController và gọi API banUser
        $userController = new AdminController($db);
        $userController->banUser($username);
    } else {
        echo json_encode([
            'status' => 'error',
            'message' => 'Username parameter is missing'
        ]);
    }
} else {
    echo json_encode([
        'status' => 'error',
        'message' => 'Invalid request method'
    ]);
}
?>
