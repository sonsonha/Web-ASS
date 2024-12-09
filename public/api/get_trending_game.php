<?php
require_once '../../config/database.php';
require_once '../../app/controllers/StoreController.php';

$storeController = new StoreController($db);
$storeController->getTrendingGame();
?>
