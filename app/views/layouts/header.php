<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Game Store - Admin</title>
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</head>

<body>
    <style>
        .navavatar {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            object-fit: cover;
            background-color: #ccc;
            /* Màu nền khi không có ảnh */
        }
    </style>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: black;height: 4.5rem;">
        <img src="/assets/images/ZeroStress.jpg" style="height: 50px;" href="home">
        <!-- Nút mở/đóng khi trên màn hình nhỏ -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Các mục điều hướng -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <div class="navbar-nav">
                <a class="navlink" href="store">Store</a>
                <a class="navlink" href="support" id="supportLink">Support</a>
                <a class="navlink" href="about">About</a>
                <!-- <a class="navlink" id="adminLink" href="admin">Admin</a>
                <a class="navlink" id="userLink" href="user">User</a> -->

            </div>
            <div class="navbar-auth">

                <a href="cart" id="cartLink" class="btn btn-link small" style="display: none;color:azure">
                    <i class="fas fa-shopping-cart"></i>
                </a>
                <a class="navlink" id="adminLink" href="admin" style="display: none">
                    <img id="adminAvatar" src="" class="navavatar">
                </a>
                <a class="navlink" id="userLink" href="profile" style="display: none">
                    <img id="userAvatar" src="" class="navavatar">
                </a>
                <!-- <a href="login" id="loginLink" class="btn btn-link small">Login</a>
                <a href="logout" id="logoutLink" class="btn btn-link small" style="display: none;">Logout</a> -->
                <a href="login" id="loginLink" class="btn btn-link small">
                    <i class="fas fa-sign-in-alt"> Login</i> <!-- Biểu tượng login -->
                </a>
                <a href="logout" id="logoutLink" class="btn btn-link small" style="display: none;">
                    <i class="fas fa-sign-out-alt"></i> <!-- Biểu tượng logout -->
                </a>

            </div>

            <script>
                // Kiểm tra vai trò và điều chỉnh menu
                const role = localStorage.getItem('role') || 'guest'; // Mặc định là guest nếu không có role

                document.addEventListener('DOMContentLoaded', () => {
                    const adminLink = document.getElementById('adminLink');
                    const userLink = document.getElementById('userLink');
                    const loginLink = document.getElementById('loginLink');
                    const logoutLink = document.getElementById('logoutLink');
                    const cartLink = document.getElementById('cartLink'); // Nút giỏ hàng
                    const supportLink = document.getElementById('supportLink');
                    // Hiển thị hoặc ẩn liên kết dựa trên vai trò
                    if (role === 'guest') {
                        adminLink.style.display = 'none';
                        userLink.style.display = 'none';
                        cartLink.style.display = 'none';
                    } else if (role === 'user') {
                        adminLink.style.display = 'none';
                        userLink.style.display = 'inline';
                        cartLink.style.display = 'inline';
                        supportLink.style.display = 'inline';
                    } else if (role === 'admin') {
                        userLink.style.display = 'none';
                        cartLink.style.display = 'none';
                        adminLink.style.display = 'inline';
                        supportLink.style.display = 'none';
                    }

                    // Quản lý trạng thái đăng nhập
                    if (role && role !== 'guest') {
                        loginLink.style.display = 'none';
                        logoutLink.style.display = 'inline';
                    } else {
                        loginLink.style.display = 'inline';
                        logoutLink.style.display = 'none';
                    }

                    // Xử lý sự kiện Logout
                    logoutLink.addEventListener('click', (event) => {
                        event.preventDefault(); // Ngăn chặn hành động mặc định

                        // Mô phỏng logout thành công
                        setTimeout(() => {
                            alert('Logout successful!');
                            localStorage.clear(); // Xóa dữ liệu trong localStorage
                            window.location.href = 'login'; // Chuyển hướng về trang login
                        }, 500); // Mô phỏng độ trễ API
                    });

                    // Đánh dấu liên kết đang hoạt động
                    const currentPath = window.location.pathname; // Lấy đường dẫn hiện tại
                    const navLinks = document.querySelectorAll('.navlink');

                    navLinks.forEach((link) => {
                        if (link.getAttribute('href') === currentPath) {
                            link.classList.add('active'); // Thêm class active vào liên kết hiện tại
                        }
                    });
                });
            </script>

            <!-- 
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
                document.addEventListener("DOMContentLoaded", function() {
                    const currentPath = window.location.pathname; // Get the current URL path
                    const navLinks = document.querySelectorAll(".navlink");

                    navLinks.forEach(link => {
                        if (link.getAttribute("href") === currentPath) {
                            link.classList.add("active"); // Add the 'active' class to the current link
                        }
                    });
                });
            </script> -->

        </div>
    </nav>