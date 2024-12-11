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
    .navbar {
        padding: 0.5rem 1rem;
    }

    .nav-link {
        color: #f8f9fa;
    }

    .nav-link:hover {
        color: #007bff;
    }

    .dropdown-menu {
        min-width: auto;
    }


    .dropdown-toggle {
        color: #f8f9fa; /* Màu chữ sáng cho dễ nhìn */
    }

    .dropdown-toggle:hover {
        color: #007bff; /* Màu chữ khi hover */
    }

    /* Nếu muốn thay đổi màu chữ cho các mục trong dropdown */
    .dropdown-item {
        color: #333; /* Màu chữ cho các mục trong dropdown */
    }

    .dropdown-item:hover {
        background-color: #007bff; /* Màu nền khi hover các mục */
        color: white; /* Màu chữ khi hover */
    }

    .navavatar {
        width: 30px;
        height: 30px;
        border-radius: 50%;
        object-fit: cover;
        background-color: #ccc;
    }

    @media (max-width: 768px) {
        .navavatar {
            width: 25px;
            height: 25px;
        }

        #username {
            display: none; /* Ẩn tên user trên màn hình nhỏ */
        }
    }   
</style>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="height: 4.5rem;">
    <div class="container-fluid">
        <!-- Logo -->
        <a class="navbar-brand" href="home">
            <img src="/assets/images/ZeroStress.jpg" alt="Logo" style="height: 50px;">
        </a>

        <!-- Toggler for small screens -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar Links -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="zerostress-game-store">Store</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="support" id="supportLink">Support</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="about">About</a>
                </li>
            </ul>

            <!-- Authentication and Cart -->
            <div class="d-flex align-items-center">
                <!-- Cart -->
                <a href="my_cart" id="cartLink" class="btn btn-link text-light me-3 d-none">
                    <i class="fas fa-shopping-cart"></i>
                </a>

                <!-- Dropdown for User/Admin -->
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="userMenu" data-bs-toggle="dropdown" aria-expanded="false">
                        <img id="userAvatar" src="/assets/images/default-avatar.png" class="navavatar me-2">
                        <span id="username">Username</span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userMenu">
                        <li><a class="dropdown-item" href="profile">Profile</a></li>
                        <li><a class="dropdown-item" href="change_password">Change password</a></li>
                        <li><a class="dropdown-item" href="logout">Log out</a></li>
                    </ul>
                </div>

                <!-- Login/Logout -->
                <a href="login" id="loginLink" class="btn btn-outline-light ms-3">
                    <i class="fas fa-sign-in-alt"></i> Login
                </a>
                <a href="logout" id="logoutLink" class="btn btn-outline-danger ms-3 d-none">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
            </div>
        </div>
    </div>
</nav>

    <script>
    // Kiểm tra vai trò và điều chỉnh menu
    const role = localStorage.getItem('role') || 'guest'; // Mặc định là guest nếu không có role

    document.addEventListener('DOMContentLoaded', () => {
    const adminLink = document.getElementById('adminLink');
    const userLink = document.getElementById('userLink');
    const loginLink = document.getElementById('loginLink');
    const logoutLink = document.getElementById('logoutLink');
    const cartLink = document.getElementById('cartLink');
    const username = document.getElementById('username');

    // Set username dynamically
    username.textContent = localStorage.getItem('username') || 'Guest';

    // Role-based visibility
    if (role === 'guest') {
        adminLink.style.display = 'none';
        userLink.style.display = 'none';
        cartLink.style.display = 'none';
    } else if (role === 'user') {
        adminLink.style.display = 'none';
        userLink.style.display = 'inline';
        cartLink.style.display = 'inline';
    } else if (role === 'admin') {
        adminLink.style.display = 'inline';
        userLink.style.display = 'none';
        cartLink.style.display = 'none';
    }

    // Manage login/logout links
    if (role && role !== 'guest') {
        loginLink.style.display = 'none';
        logoutLink.style.display = 'inline';
    } else {
        loginLink.style.display = 'inline';
        logoutLink.style.display = 'none';
    }

    // Logout event
    // logoutLink.addEventListener('click', (event) => {
    //     event.preventDefault();
    //     localStorage.clear();
    //     alert('Logout successful!');
    //     window.location.href = 'login';
    // });

    logoutLink.addEventListener('click', (event) => {
        event.preventDefault(); // Ngăn chặn hành động mặc định

        // Mô phỏng logout thành công
        setTimeout(() => {
            alert('Logout successful!');
            localStorage.clear(); // Xóa dữ liệu trong localStorage
            window.location.href = 'login'; // Chuyển hướng về trang login
        }, 500); // Mô phỏng độ trễ API
    });
});

        // Đánh dấu liên kết đang hoạt động
        const currentPath = window.location.pathname; // Lấy đường dẫn hiện tại
        const navLinks = document.querySelectorAll('.navlink');

        navLinks.forEach((link) => {
            if (link.getAttribute('href') === currentPath) {
                link.classList.add('active'); // Thêm class active vào liên kết hiện tại
            }
        });
            </script>


