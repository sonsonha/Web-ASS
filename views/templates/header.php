<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Game Store - Admin</title>
    <link rel="stylesheet" href="Model/css/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</head>

<body>
    <!-- Navbar -->
    <div class="login-register-bar text-right text-white" style="background-color: black; height: 4vh; font-size: 0.8rem; line-height: 2vh;">
        <a href="?page=login" class="btn btn-link text-white small">Login</a>
        <a href="?page=register" class="btn btn-link text-white small">Register</a>
    </div>




    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="?page=home">Game Store</a>
        <!-- Nút mở/đóng khi trên màn hình nhỏ -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Các mục điều hướng -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <div class="navbar-nav">
                <a class="nav-link" href="?page=home">Home</a>
                <a class="nav-link" href="?page=store">Store</a>
                <a class="nav-link" href="?page=admin">Admin</a>
                <a class="nav-link" href="?page=user">User</a>
                <a class="nav-link" href="?page=about">About</a>
            </div>
            <!-- Ô tìm kiếm ở bên phải trên màn hình lớn -->
            <form id="searchForm" class="form-inline ml-auto mt-2 mt-lg-0" action="?page=search" method="get">
                <input id="searchInput" class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="query">
            </form>

            <script>
                document.getElementById("searchInput").addEventListener("keydown", function(event) {
                    if (event.key === "Enter") {
                        event.preventDefault(); // Ngăn việc submit mặc định để thực hiện thủ công
                        document.getElementById("searchForm").submit();
                    }
                });
            </script>

        </div>
    </nav>