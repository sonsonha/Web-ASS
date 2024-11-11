<?php
session_start();

$requestUri = $_SERVER['REQUEST_URI'];

// Category routing
if (preg_match('/\/category\/(.+)/', $requestUri, $matches)) {
    $category = ucfirst($matches[1]); // Get category name
    $categoryFile = "../app/views/categories/$category.php";
    if (file_exists($categoryFile)) {
        include $categoryFile;
    } else {
        http_response_code(404);
        include '../app/views/errors/404.php';
    }
} else {
    // Other routes
    include '../app/views/home.php';
}
