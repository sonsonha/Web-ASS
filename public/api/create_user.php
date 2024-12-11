<?php
// require_once '../../config/database.php';
require_once '../../app/controllers/UserController.php';

require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../models/UserModel.php';
// require_once __DIR__ . '/../controllers/UserController.php';


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


$data = json_decode(file_get_contents('php://input'), true);




$userController = new UserController($db);
$userController-> createUser($data);
?>