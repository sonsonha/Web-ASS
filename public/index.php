<?php
// A simple router for serving static pages

$requestUri = $_SERVER['REQUEST_URI'];

echo $requestUri;

if ($requestUri === '/' || $requestUri === '/index.php') {
    include '../app/views/home/home.php';
} elseif ($requestUri === '/    ') {
    include '../app/views/products/list.php';
} else {
    http_response_code(404);
    include '../app/views/errors/404.php';
}
?>
