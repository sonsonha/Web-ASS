<?php
require_once '../../config/database.php';  // Kết nối cơ sở dữ liệu
require_once '../../app/controllers/AdminController.php';

$data = json_decode(file_get_contents('php://input'), true);

// Kiểm tra xem có giá trị username không
$username = isset($data['username']) ? $data['username'] : null;

if ($username) {
    // Khởi tạo UserController và gọi API getUserInfo
    $userController = new AdminController($db);
    $userController->getUserInfo($username);  // Truyền tham số username vào đây
} else {
    echo json_encode([
        'status' => 'error',
        'message' => 'Username parameter is missing'
    ]);
}
?>
