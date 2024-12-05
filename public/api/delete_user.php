<?php
require_once '../../config/database.php';  
require_once '../../app/controllers/AdminController.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    $username = isset($data['username']) ? $data['username'] : null;

    if ($username) {
        $userController = new AdminController($db);
        $userController->deleteUser($username);
    } else {
        echo json_encode([
            'status' => 'error',
            'message' => 'Username parameter is required'
        ]);
    }
} else {
    echo json_encode([
        'status' => 'error',
        'message' => 'Invalid request method'
    ]);
}
?>
