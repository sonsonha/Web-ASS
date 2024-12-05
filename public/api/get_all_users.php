<?php
require_once '../../config/database.php';  // Kết nối cơ sở dữ liệu
require_once '../../app/controllers/AdminController.php';

// Khởi tạo UserController và gọi API getAllUsers
$userController = new AdminController($db);
$userController->getAllUsers();
?>
