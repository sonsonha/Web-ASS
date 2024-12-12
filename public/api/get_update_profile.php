<?php
require_once '../../config/database.php';
require_once '../../app/controllers/UserController.php';

$data = json_decode(file_get_contents('php://input'), true);

if (!isset($data['id'], $data['fullName'], $data['phone'], $data['url_link'], $data['birth'])) {
    echo json_encode([
        'status' => 'error',
        'message' => 'One or more parameters are missing'
    ]);
    exit();
}

$id = $data['id'];
$fullName = $data['fullName'];
$phone = $data['phone'];
$url_link = $data['url_link'];
$birth = $data['birth'];


if ($id) {
  $userController = new UserController($db);
  $userController-> updateProfile($id, $fullName, $phone, $url_link, $birth);
} else {
  echo json_encode([
      'status' => 'error',
      'message' => 'Username is not found'
  ]);
}
?>