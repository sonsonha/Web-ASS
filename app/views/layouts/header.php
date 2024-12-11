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

        .custom-dropdown-menu {
            z-index: 1050 !important; /* Đảm bảo dropdown luôn trên các thành phần khác */
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

        .custom-dropdown-menu .custom-dropdown-item {
            color: #f8f9fa !important; /* Màu chữ phù hợp */
        }

        .custom-dropdown-menu .custom-dropdown-item:hover {
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
            padding: 0 !important; /* Loại bỏ khoảng cách thừa */
            margin: 0 !important; /* Loại bỏ khoảng cách thừa */
            display: flex; /* Đảm bảo hình ảnh và văn bản canh giữa */
            align-items: center;
        }

        .custom-dropdown-toggle:hover,
        .custom-dropdown-toggle:focus {
            background-color: transparent !important; /* Đảm bảo không đổi màu khi hover */
            box-shadow: none !important; /* Xóa hiệu ứng khi focus */
        }

        .custom-avatar {
            margin-right: 8px; /* Khoảng cách giữa avatar và tên */
        }

        /* .custom-navbar {
            background-color: #212121 !important; 
        } */


        #username {
            flex-grow: 1;
            overflow: hidden;
            text-overflow: ellipsis;
        }

/* Header Navbar */
.custom-navbar {
    padding: 0.5rem 1rem;
    background-color: #212121 !important; /* Màu tối hơn */
}

.search-wrapper {
    width: 100%;
}

.search-input {
    width: 100%;
    display: none;
}

.custom-navbar-collapse {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

/* Style khi màn hình nhỏ */
@media (max-width: 768px) {
    .custom-navbar {
        padding: 0.5rem;
    }

    .custom-logo {
        height: 30px;
    }

    #searchWrapper {
        width: 100%;
    }

    /* Ẩn các phần ngoài search */
    .custom-navbar-nav {
        display: none;
    }

    #searchInput {
        width: 100%;
    }

    .search-input {
        display: block;
    }

    #cartLink, #userDropdown {
        display: block;
    }

    /* Khi người dùng nhấn vào icon tìm kiếm, input chiếm toàn bộ width */
    .search-wrapper.show {
        display: block;
    }
}

/* Style khi màn hình lớn */
@media (min-width: 768px) {
    .search-input {
        display: none;
    }
}



        /* Style for navbar */
        .navbarON {
            background-color: #1b2838;
            border-radius: 50px;
        }

        /* Style riêng cho trang admin */
        /* body {
            background-color: black;
            color: white;
        } */

        /* .btn-nav {
            margin-right: 10px;
            margin-top: 10px;
        } */

        /* .content-section {
            display: none;
        }

        .content-section.active {
            display: block;
        } */

        .table-dark th,
        .table-dark td {
            color: white;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
   <!-- Navbar -->
    <nav class="custom-navbar navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <!-- Logo and Store Name -->
            <a class="custom-navbar-brand navbar-brand" href="zerostress-game-store">
                <img src="/assets/images/ZeroStress.jpg" alt="Logo" class="custom-logo">
                <!-- <p>ZeroStress-Store</p> -->
            </a>

            <!-- Toggler for small screens -->
            <button class="custom-navbar-toggler navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="custom-navbar-toggler-icon navbar-toggler-icon"></span>
            </button>

            <!-- Navbar Links -->
            <div class="custom-navbar-collapse collapse navbar-collapse" id="navbarNav">
                <ul class="custom-navbar-nav navbar-nav me-auto">
                    <li class="custom-nav-item nav-item">
                        <a class="custom-nav-link nav-link" href="zerostress-game-store">Store</a>
                    </li>
                    <li class="custom-nav-item nav-item">
                        <a class="custom-nav-link nav-link" href="support" id="supportLink">Support</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="categoriesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Categories</a>
                        <ul class="dropdown-menu" aria-labelledby="categoriesDropdown">
                            <!-- Dropdown items will be populated dynamically -->
                        </ul>
                    </li>
                    <li class="custom-nav-item nav-item">
                        <a class="custom-nav-link nav-link" href="about">About</a>
                    </li>
                </ul>

                <!-- Search and Cart -->
                <div class="custom-auth d-flex align-items-center">
                    <!-- Search Bar -->
                    <div class="search-wrapper" id="searchWrapper" style="display: none;">
                        <input class="form-control rounded-pill search-input" type="search" placeholder="Search games" aria-label="Search" id="searchInput" />
                    </div>
                    
                    <!-- Cart -->
                    <a href="my_cart" id="cartLink" class="custom-cart btn btn-link text-light me-3" style="display: none;">
                        <i class="fas fa-shopping-cart"></i>
                    </a>

                    <!-- User Dropdown -->
                    <div class="custom-dropdown dropdown" id="userDropdown" style="display: none;">
                        <button class="custom-dropdown-toggle btn btn-secondary dropdown-toggle" type="button" id="userMenu" data-bs-toggle="dropdown" aria-expanded="false">
                            <img id="userAvatar" src="/assets/images/default-avatar.jpg" class="custom-avatar navavatar me-2">
                            <span id="username">Username</span>
                        </button>
                        <ul class="custom-dropdown-menu dropdown-menu dropdown-menu-end" aria-labelledby="userMenu">
                            <li><a class="custom-dropdown-item dropdown-item" href="profile" id="profileLink">Profile</a></li>
                            <li id="adminManage" style="display: none;"><a class="custom-dropdown-item dropdown-item" href="/admin">Manage</a></li>
                            <li><a class="custom-dropdown-item dropdown-item" href="change_password">Change password</a></li>
                            <li><a class="custom-dropdown-item dropdown-item" href="logout" id="logoutLink">Log out</a></li>
                        </ul>
                    </div>

                    <!-- Login/Logout -->
                    <a href="login" id="loginLink" class="custom-login btn btn-outline-light ms-3" style="display: none;">
                        <i class="fas fa-sign-in-alt"></i> Login
                    </a>
                    <a href="logout" id="logoutLink" class="custom-logout btn btn-outline-danger ms-3" style="display: none;">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a>

                    <!-- Search Icon -->
                    <button class="btn btn-link text-light ms-3" id="searchToggle">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <script>
    document.addEventListener('DOMContentLoaded', () => {
        const role = localStorage.getItem('role') || 'guest';
        const loginLink = document.getElementById('loginLink');
        const logoutLink = document.getElementById('logoutLink');
        const cartLink = document.getElementById('cartLink');
        const userDropdown = document.getElementById('userDropdown');
        const username = document.getElementById('username');
        const profileLink = document.getElementById('profileLink');
        const adminManage = document.getElementById('adminManage');

        username.textContent = localStorage.getItem('username') || 'Guest';

        if (role === 'user' || role === 'admin') {
            userDropdown.style.display = 'inline';
        }


        if (role === 'guest') {
            loginLink.style.display = 'inline';
            cartLink.style.display = 'none';
            userDropdown.style.display = 'none';
            logoutLink.style.display = 'none';
        } else if (role === 'user') {
            loginLink.style.display = 'none';
            cartLink.style.display = 'block';
            userDropdown.style.display = 'inline';
            logoutLink.style.display = 'inline';
            adminManage.style.display = 'none';
        } else if (role === 'admin') {
            loginLink.style.display = 'none';
            cartLink.style.display = 'none';
            userDropdown.style.display = 'inline';
            logoutLink.style.display = 'inline';
            adminManage.style.display = 'block';
        }

        logoutLink.addEventListener('click', (event) => {
            event.preventDefault();
            localStorage.clear();
            alert('Logout successful!');
            window.location.href = 'login';
        });
    });

    document.querySelector('.custom-dropdown-toggle').addEventListener('click', () => {
        const dropdown = new bootstrap.Dropdown(document.getElementById('userMenu'));
        dropdown.show();
    });

    document.addEventListener("DOMContentLoaded", async () => {
        const categoriesDropdown = document.getElementById("categoriesDropdown");
        const dropdownMenu = categoriesDropdown.nextElementSibling; // Lấy phần tử dropdown-menu tương ứng

        try {
            // Lấy danh mục từ backend
            const response = await fetch("http://localhost/test_api/store_api/fetch_categories.php");
            if (!response.ok) throw new Error("Failed to fetch categories");
            const categories = await response.json();

            // Xóa các mục dropdown cũ (nếu có)
            dropdownMenu.innerHTML = "";
            console.log(categories); // Kiểm tra dữ liệu categories

            // Kiểm tra nếu có danh mục
            if (categories && categories.length > 0) {
                categories.forEach((category) => {
                    const dropdownItem = document.createElement("li");
                    dropdownItem.innerHTML = `
                    <a class="dropdown-item" href="category.php?category=${category.slug}">
                        ${category.name}
                    </a>`;
                    dropdownMenu.appendChild(dropdownItem);
                });
            } else {
                dropdownMenu.innerHTML = "<li>No categories available</li>";
            }

        } catch (error) {
            console.error("Error fetching categories:", error);
        }
    });

    </script>
</body>
</html>
