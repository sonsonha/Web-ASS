<?php
$page = isset($_GET['page']) ? $_GET['page'] : 'store';

// Define paths
$base_path = "views/";
$directories = [
    "about" => "about/",
    "admin" => "admin/",
    "auth" => "auth/",
    "error" => "error/",
    "store" => "store/",
    "support" => "support/",
    "user" => "user/",
    "cart" => "cart/",
    "detail" => "detail/",
];

// Search handling
if ($page === 'search') {
    require_once "controllers/SearchController.php";
    $query = isset($_GET['q']) ? filter_var($_GET['q'], FILTER_SANITIZE_STRING) : '';
    $controller = new SearchController();
    $controller->search($query);
    exit;
}

// Detail handling
if ($page === 'item' && isset($_GET['id'])) {
    $id = intval($_GET['id']);
    require_once "controllers/DetailController.php";
    $controller = new DetailController();
    $controller->detail($id);
    exit;
}

// Include the requested page
$file_found = false;
foreach ($directories as $dir) {
    $full_path = $base_path . $dir . $page . ".php";
    if (file_exists($full_path)) {
        include($full_path);
        $file_found = true;
        break;
    }
}

if (!$file_found) {
    include($base_path . "error/404.php");
}
