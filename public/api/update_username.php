<?php
require_once '../../config/database.php';  
require_once '../../app/controllers/AdminController.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    $oldUsername = isset($data['oldUsername']) ? $data['oldUsername'] : null;
    $newUsername = isset($data['newUsername']) ? $data['newUsername'] : null;

    if ($oldUsername && $newUsername) {
        $adminController = new AdminController($db);
        $adminController->updateUsername($oldUsername, $newUsername);
    } else {
        echo json_encode([
            'status' => 'error',
            'message' => 'Both oldUsername and newUsername parameters are required'
        ]);
    }
} else {
    echo json_encode([
        'status' => 'error',
        'message' => 'Invalid request method'
    ]);
}
?>
