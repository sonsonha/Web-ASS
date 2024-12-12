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
        /* Current Header Navbar Styles */
        .custom-navbar {
            padding: 0.5rem 1rem;
            background-color: #212121 !important;
        }
    
        .custom-logo {
            height: 40px;
        }
    
        .custom-nav-link {
            color: #f8f9fa;
        }
    
        .custom-nav-link:hover {
            color: #007bff;
        }
    
        .custom-dropdown-menu {
            background-color: #212121 !important; 
            border: none !important; 
            box-shadow: none !important; 
            color: #f8f9fa !important; 
        }
    
        .custom-dropdown-menu .dropdown-item {
            color: #f8f9fa !important; 
        }
    
        .custom-dropdown-menu .dropdown-item:hover {
            background-color: #343a40 !important; 
            color: #fff !important; 
        }
    
        .custom-avatar {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            object-fit: cover;
        }
    
        .custom-dropdown-toggle {
            background-color: transparent !important; 
            border: none !important; 
            color: #f8f9fa !important; 
            display: flex;
            align-items: center;
        }
    
        .custom-dropdown-toggle:hover,
        .custom-dropdown-toggle:focus {
            background-color: transparent !important;
            box-shadow: none !important;
        }
    
        #username {
            flex-grow: 1;
            overflow: hidden;
            text-overflow: ellipsis;
            margin-bottom: 0; /* Ensure no margin at the bottom */
        }
    
        #userMenu {
            display: flex;
            align-items: center;
        }
    
        #userMenu img {
            width: 30px;
            height: 30px;
        }
    
        #role-check {
            font-size: 0.9em;
            color: #e9e93a;
            margin: 0; /* Ensure no margin */
        }
    
        /* Aligning avatar and role */
        .user-dropdown .btn {
            display: flex;
            align-items: center;
        }
    
        /* Responsive adjustments */
        @media (max-width: 768px) {
            .custom-avatar {
                width: 25px;
                height: 25px;
            }
    
            #username {
                display: none; 
            }
    
            .custom-nav-link {
                padding: 0.5rem 1rem; 
            }
    
            .custom-navbar-collapse {
                background-color: #212121;
            }
        }
    </style>
</head>
<body>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand d-flex align-items-center" href="http://localhost/zerostress-game-store">
            <img src="/assets/images/ZeroStress.jpg" alt="Logo" class="me-2" style="height: 40px;">
            <span>ZeroStress</span>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="zerostress-game-store">Store</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="categoriesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Categories
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="categoriesDropdown">
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="http://localhost/support">Support</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="http://localhost/about">About</a>
                </li>
            </ul>

            <form class="d-flex me-3" role="search">
                <input class="form-control rounded-pill" type="search" placeholder="Search games" aria-label="Search">
            </form>

            <div class="d-flex align-items-center">
                <a href="my_cart" class="btn btn-link text-light me-3 cart-btn">
                    <i class="fas fa-shopping-cart"></i>
                </a>

                <div class="dropdown user-dropdown">
                    <button class="btn text-light d-flex align-items-center" type="button" id="userMenu" data-bs-toggle="dropdown" aria-expanded="false" style="background: none; border: none;">
                        <img src="/assets/images/default-avatar.jpg" alt="User Avatar" class="custom-avatar me-2">
                        <div class="d-flex flex-column">
                            <span id="username">Username</span>
                            <span id="role-check">Guest</span>
                        </div>
                    </button>

                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userMenu">
                        <li><a class="dropdown-item admin-role" href="admin">Manage</a></li>
                        <li><a class="dropdown-item" href="http://localhost/profile">Profile</a></li>
                        <li><a class="dropdown-item" href="http://localhost/change_password">Change Password</a></li>
                        <li><a class="dropdown-item" id="logoutLink" href="logout">Logout</a></li>
                    </ul>
                </div>

                <a href="login" id="loginLink" class="btn btn-link small">
                    <i class="fas fa-sign-in-alt"> Login</i>
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

    // Fetch user info (avatar and username) from the API
    const userId = 17; // Example user ID
    const cartButton = document.querySelector('.cart-btn');
    const usernameElement = document.getElementById("username");
    const avatarElement = document.querySelector('.custom-avatar');
    const roleElement = document.getElementById("role-check");

    try {
        const userResponse = await fetch(`/../api/get_shoping_cart.php?id=${userId}`);
        const userData = await userResponse.json();

        if (userData.status === 'success') {
            const user = userData.data;
            usernameElement.textContent = user.username;
            avatarElement.src = user.avatar || "/assets/images/default-avatar.jpg"; // Default avatar if none provided
            roleElement.textContent = user.role || "User"; // Assuming you have a role in the API response, or you can use localStorage or other logic for this
        } else {
            console.error("Error fetching user data:", userData.message);
        }
    } catch (error) {
        console.error("Error fetching user info:", error);
        usernameElement.textContent = "Guest"; // Fallback to Guest
        avatarElement.src = "/assets/images/default-avatar.jpg"; // Default avatar in case of error
        roleElement.textContent = "Guest"; // Fallback role
    }

    const role = localStorage.getItem("role") ? localStorage.getItem("role") : "Guest";
    console.log(role);

    if (role === "Admin" || role === "Guest") {
        cartButton.style.display = "none";
    }

    if (role === "User") {
        document.querySelector('.admin-role').style.display = "none";
    }

    // Handle login/logout visibility based on role
    if (role === "Guest") {
        document.getElementById("loginLink").style.display = "block";
        document.querySelector('.user-dropdown').style.display = "none";
    } else {
        document.getElementById("loginLink").style.display = "none";
    }

    // Handle logout
    const logoutLink = document.querySelector('.dropdown-item[href="logout"]');
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
