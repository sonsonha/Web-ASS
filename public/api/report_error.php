<?php
require_once '../../config/database.php';  
require_once '../../app/controllers/AdminController.php';

$data = json_decode(file_get_contents("php://input"));

if (isset($data->user_id) && isset($data->game_id) && isset($data->error_description)) {
    $user_id = $data->user_id;
    $game_id = $data->game_id;
    $error_description = $data->error_description;

    $userController = new AdminController($db);
    $userController->reportError($user_id, $game_id, $error_description);
} else {
    echo json_encode([
        'status' => 'error',
        'message' => 'Missing parameters'
    ]);
}
?>
