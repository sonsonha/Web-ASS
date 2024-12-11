<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Game Store - Admin</title>
    <!-- <link rel="stylesheet" href="/assets/css/style.css"> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <style>
        /* Header Navbar */
        .custom-navbar {
            padding: 0.5rem 1rem;
            background-color: #212121 !important; /* Màu tối hơn */
        }

        .custom-logo {
            height: 40px; /* Giảm chiều cao logo */
        }

        .custom-nav-link {
            color: #f8f9fa;
        }

        .custom-nav-link:hover {
            color: #007bff;
        }

        .custom-dropdown-menu {
            background-color: #212121 !important; /* Màu nền trùng với header */
            border: none !important; /* Loại bỏ đường viền */
            box-shadow: none !important; /* Loại bỏ bóng đổ */
            color: #f8f9fa !important; /* Đảm bảo màu chữ phù hợp */
        }

        .custom-dropdown-menu .dropdown-item {
            color: #f8f9fa !important; /* Màu chữ phù hợp */
        }

        .custom-dropdown-menu .dropdown-item:hover {
            background-color: #343a40 !important; /* Màu nền khi hover */
            color: #fff !important; /* Màu chữ khi hover */
        }

        .custom-avatar {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            object-fit: cover;
        }

        .custom-dropdown-toggle {
            background-color: transparent !important; /* Xóa màu nền */
            border: none !important; /* Xóa đường viền */
            color: #f8f9fa !important; /* Màu chữ đồng nhất */
            display: flex; /* Đảm bảo hình ảnh và văn bản canh giữa */
            align-items: center;
        }

        .custom-dropdown-toggle:hover,
        .custom-dropdown-toggle:focus {
            background-color: transparent !important;
            box-shadow: none !important;
        }

        .custom-navbar {
            background-color: #212121 !important;
        }

        #username {
            flex-grow: 1;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        #userMenu {
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    #userMenu img {
        width: 30px;
        height: 30px;
    }

    #userMenu #username {
        margin-bottom: 0;
    }

    #role-check {
        font-size: 0.9em; /* Điều chỉnh kích thước chữ nếu cần */
        color: #e9e93a; /* Tông màu nhẹ hơn */
        margin-top: 5px;
    }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .custom-avatar {
                width: 25px;
                height: 25px;
            }

            #username {
                display: none; /* Ẩn tên người dùng trên thiết bị nhỏ */
            }

            .custom-nav-link {
                padding: 0.5rem 1rem; /* Điều chỉnh khoảng cách */
            }

            .custom-navbar-collapse {
                background-color: #212121; /* Màu nền cho menu khi thu nhỏ */
            }
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <!-- Logo -->
        <a class="navbar-brand d-flex align-items-center" href="zerostress-game-store">
            <img src="/assets/images/ZeroStress.jpg" alt="Logo" class="me-2" style="height: 40px;">
            <span>ZeroStress</span>
        </a>

        <!-- Toggler for small screens -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <!-- Main Navigation -->
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="zerostress-game-store">Store</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="categoriesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Categories
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="categoriesDropdown">
                        <!-- Categories will be dynamically populated -->
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="support">Support</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="about">About</a>
                </li>
            </ul>

            <!-- Search Bar -->
            <form class="d-flex me-3" role="search">
                <input class="form-control rounded-pill" type="search" placeholder="Search games" aria-label="Search">
            </form>

            <!-- User and Cart Section -->
            <div class="d-flex align-items-center">
                <!-- Cart -->
                <a href="my_cart" class="btn btn-link text-light me-3 cart-btn">
                    <i class="fas fa-shopping-cart"></i>
                </a>

                <!-- User Avatar and Dropdown -->
                <div class="dropdown user-dropdown">
                    <button class="btn text-light d-flex align-items-center flex-column" type="button" id="userMenu" data-bs-toggle="dropdown" aria-expanded="false" style="background: none; border: none;">
                        <div class="d-flex align-items-center">
                            <img src="/assets/images/default-avatar.jpg" alt="User Avatar" class="rounded-circle me-2" style="width: 30px; height: 30px;">
                            <span id="username">Username</span>
                        </div>
                        <div>
                            <span id="role-check">Guest</span>
                        </div>
                    </button>

                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userMenu">
                        <li><a class="dropdown-item admin-role" href="admin">Manage</a></li>
                        <li><a class="dropdown-item" href="profile">Profile</a></li>
                        <li><a class="dropdown-item" href="change_password">Change Password</a></li>
                        <li><a class="dropdown-item" id="logoutLink" href="logout">Logout</a></li>
                    </ul>
                </div>

                <a href="login" id="loginLink" class="btn btn-link small">
                    <i class="fas fa-sign-in-alt"> Login</i> <!-- Biểu tượng login -->
                </a>

            </div>
        </div>
    </div>
</nav>


<script>
    document.addEventListener("DOMContentLoaded", async () => {
        // Fetch and populate categories dynamically
        const categoriesDropdown = document.getElementById("categoriesDropdown").nextElementSibling;
        try {
            const response = await fetch("http://localhost/test_api/store_api/fetch_categories.php");
            if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);

            const categories = await response.json();
            categoriesDropdown.innerHTML = "";

            if (categories.length > 0) {
                categories.forEach((category) => {
                    const li = document.createElement("li");
                    li.innerHTML = `<a class="dropdown-item" href="category.php?category=${category.slug}">${category.name}</a>`;
                    categoriesDropdown.appendChild(li);
                });
            } else {
                categoriesDropdown.innerHTML = `<li><span class="dropdown-item">No categories available</span></li>`;
            }
        } catch (error) {
            console.error("Error fetching categories: ", error);
            categoriesDropdown.innerHTML = `<li><span class="dropdown-item text-danger">Error loading categories</span></li>`;
        }

        // Set username dynamically

        const cartButton = document.querySelector('.cart-btn');

        const usernameElement = document.getElementById("username");

        usernameElement.textContent = localStorage.getItem("username") || "Gamer";  

        const role = localStorage.getItem("role") ? localStorage.getItem("role") : "Guest";

        console.log(role);   

        if (role === "Admin" || role === "Guest") {
            cartButton.style.display = "none";
        }

        if (role === "User") {
            document.querySelector('.admin-role').style.display = "none";
        }

        console.log(localStorage.getItem("id"));

        // if (role === "Admin" || role === "user") {
        //     document.getElementById("loginLink").style.display = "none";
        // }

        if (role === "Admin") {
            document.getElementById("role-check").textContent = "Admin";
        } else {
            document.getElementById("role-check").textContent = "User";
        }


        if (role === "Guest") {
            document.getElementById("loginLink").style.display = "block";
            document.querySelector('.user-dropdown').style.display = "none";
        } else {
            document.getElementById("loginLink").style.display = "none";
        }

        // Handle logout
        const logoutLink = document.querySelector('.dropdown-item[href="logout"]'); // Adjust selector to match logout link
        if (logoutLink) {
            logoutLink.addEventListener('click', (event) => {
                event.preventDefault(); // Prevent default link behavior
                localStorage.clear(); // Clear localStorage
                alert('Logout successful!');
                window.location.href = 'login'; // Redirect to login page
            });
        }
    });
</script>

</body>
</html>
