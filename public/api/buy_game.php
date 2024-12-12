<?php
require_once '../../config/database.php';
require_once '../../app/controllers/GameController.php';

$data = json_decode(file_get_contents('php://input'), true);

$userController = new GameController($db);
$userController->buyGames($data);

?>