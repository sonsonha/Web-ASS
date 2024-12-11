<?php
require_once '../../config/database.php';
require_once '../../app/controllers/UserController.php';

$data = json_decode(file_get_contents('php://input'), true);

$userController = new UserController($db);
$userController-> createUser($data);
?>