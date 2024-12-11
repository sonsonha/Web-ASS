<?php
require_once '../../config/database.php';
require_once '../../app/controllers/UserController.php';

$data = json_decode(file_get_contents('php://input'), true);

$userController = new UserController($db);

if (isset($data['action']) && $data['action'] === 'login') {
  $userController->loginUser($data);
} else {
  echo json_encode(['status' => 'error', 'message' => 'Invalid request.']);
}
?>