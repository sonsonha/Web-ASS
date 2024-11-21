<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Game Store - Admin</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</head>

<body>
    <!-- Navbar -->
    <div class="text-right text-white" style="background-color: black; height: 3vh; font-size: 0.6rem; line-height: 1vh; padding-right: 20px;">
        <a href="login" id="loginLink" class="btn btn-link text-white small" style="margin-top: -6px;">Login☢️</a>
        <!-- <a href="register" id="registerLink" class="btn btn-link text-white small" style="margin-top: -6px;">Register</a> -->
        <a href="logout" id="logoutLink" class="btn btn-link text-white small" style="display: none;">Logout☣️</a>
    </div>





    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="home">Game Store</a>
        <!-- Nút mở/đóng khi trên màn hình nhỏ -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Các mục điều hướng -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <div class="navbar-nav">
                <a class="nav-link" href="home">Home</a>
                <a class="nav-link" href="store">Store</a>
                <a class="nav-link" id="adminLink" href="admin">Admin</a>
                <a class="nav-link" id="userLink" href="user">User</a>
                <a class="nav-link" href="about">About</a>
            </div>
            <!-- Ô tìm kiếm ở bên phải trên màn hình lớn -->
            <form id="searchForm" class="form-inline ml-auto mt-2 mt-lg-0" action="search" method="get">
                <input id="searchInput" class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="query">
            </form>

            <script>
                const role = localStorage.getItem('role') || 'guest'; // Nếu không có role thì mặc định là guest

                // Lấy các phần tử admin và user
                const adminLink = document.getElementById('adminLink');
                const userLink = document.getElementById('userLink');

                // Ẩn/Hiển thị các mục dựa vào role
                if (role === 'guest') {
                    adminLink.style.display = 'none';
                    userLink.style.display = 'none';
                } else if (role === 'user') {
                    adminLink.style.display = 'none';
                } else if (role === 'admin') {
                    userLink.style.display = 'none';
                }
                document.getElementById("searchInput").addEventListener("keydown", function(event) {
                    if (event.key === "Enter") {
                        event.preventDefault(); // Ngăn việc submit mặc định để thực hiện thủ công
                        document.getElementById("searchForm").submit();
                    }
                });



                document.addEventListener('DOMContentLoaded', () => {
                    // Kiểm tra trạng thái đăng nhập
                    const role = localStorage.getItem('role'); // Lấy role từ localStorage
                    const loginLink = document.getElementById('loginLink');
                    // const registerLink = document.getElementById('registerLink');
                    const logoutLink = document.getElementById('logoutLink');

                    // Nếu đã đăng nhập, hiển thị Logout và ẩn Login/Register
                    if (role && role !== 'guest') {
                        loginLink.style.display = 'none';
                        // registerLink.style.display = 'none';
                        logoutLink.style.display = 'inline';
                    }

                    // Xử lý sự kiện Logout
                    logoutLink.addEventListener('click', async (event) => {
                        event.preventDefault(); // Ngăn chặn hành động mặc định của liên kết

                        try {
                            // Gọi API Logout (nếu cần)
                            const response = await fetch('http://localhost:8080/logout', {
                                method: 'GET',
                                headers: {
                                    'Content-Type': 'application/json',
                                    Authorization: `Bearer ${localStorage.getItem('accessToken')}`,
                                },
                            });

                            if (response.ok) {
                                alert('Logout successful!');
                                localStorage.clear();
                                window.location.href = 'login';
                            } else {
                                alert('Failed to logout. Please try again.');
                            }
                        } catch (error) {
                            console.error('Error:', error);
                            alert('An error occurred while logging out.');
                        }


                    });
                });
            </script>

        </div>
    </nav>