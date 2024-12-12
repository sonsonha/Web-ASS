<?php
require_once '../../config/database.php'; 
require_once '../../app/controllers/GameController.php'; 

// Khởi tạo đối tượng GameController
$gameController = new GameController($db);

// Lấy danh sách tất cả các thể loại (genre) kèm ảnh đại diện ngẫu nhiên
$gameController->getAllCategories();
?>
