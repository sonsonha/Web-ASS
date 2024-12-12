<?php
require_once '../../config/database.php';

require_once '../../app/controllers/GameController.php';

$gameController = new GameController($db);

$gameController->getAllCategories();
?>
