<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Game Store - Admin</title>
    <link rel="stylesheet" href="Model/css/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <!-- Navbar -->
    <div class="login-register-bar">
        <a href="?page=login" class="btn btn-link">Login</a>
        <a href="?page=register" class="btn btn-link">Register</a>
    </div>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="?page=home">Game Store</a>
        <div class="navbar-nav">
            <a class="nav-link" href="?page=home">Home</a>
            <a class="nav-link" href="?page=store">Store</a>
            <a class="nav-link" href="?page=admin">Admin</a>
            <a class="nav-link" href="?page=user">User</a>
            <a class="nav-link" href="?page=about">About</a>
        </div>
        
        <!-- Ô tìm kiếm ở bên phải -->
        <form class="form-inline ml-auto" action="?page=search" method="get">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="query">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
    </nav>