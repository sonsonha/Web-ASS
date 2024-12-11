<?php
require_once '../../config/database.php';
require_once '../../app/controllers/UserController.php';


$userController = new UserController($db);
$userController->getIdBySession();
?>