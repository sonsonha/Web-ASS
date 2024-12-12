<?php
require_once '../../config/database.php';

require_once '../../app/controllers/ArticleController.php';

$articleController = new ArticleController($db);

$articleController->getAllArticles();
?>
