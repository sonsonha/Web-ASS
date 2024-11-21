<?php
// Set the default page
$page = isset($_GET['page']) ? $_GET['page'] : 'home';

// Sanitize the page variable
$page = basename($page);

// Define the path to the main views folder
$base_path = "views/";

// Define the paths to specific directories under "views"
$directories = [
    "about" => "about/",
    "admin" => "admin/",
    "auth" => "auth/",
    "error" => "error/",
    "home" => "home/",
    "store" => "store/",
    "user" => "user/"
];

// Loop through the directories to find the requested page
$file_found = false;
foreach ($directories as $dir) {
    $full_path = $base_path . $dir . $page . ".php";
    if (file_exists($full_path)) {
        include($full_path);
        $file_found = true;
        break;
    }
}

// If file not found, include the 404 page
if (!$file_found) {
    include($base_path . "error/404.php");
}
?>
