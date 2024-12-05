<?php
require_once '../../config/database.php';
require_once '../../app/controllers/AdminController.php';

$error_data = json_decode(file_get_contents("php://input"), true);

if ($error_data && isset($error_data['id'])) {
    $baoLoiController = new AdminController($db);
    $baoLoiController->deleteErrorReport();
} else {
    echo json_encode([
        'status' => 'error',
        'message' => 'Error report ID is missing'
    ]);
}
?>
