<nav class="navbar navbarON navbar-expand-lg navbar-dark shadow-sm mb-4 py-3">
    <div class="container-fluid">
        <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarNav"
            aria-controls="navbarNav"
            aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>   
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" href="store">
                        <i class="fa-solid fa-gamepad"></i> Home
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a
                        class="nav-link dropdown-toggle"
                        href="#"
                        id="categoriesDropdown"
                        role="button"
                        data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Categories
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="categoriesDropdown">
                        <!-- Dropdown items will be populated dynamically -->
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">News</a>
                </li>
            </ul>

            <form class="d-flex" role="search" id="searchForm">
                <input
                    class="form-control rounded-pill search-input"
                    type="search"
                    placeholder="Search games"
                    aria-label="Search"
                    id="searchInput" />
            </form>
        </div>
    </div>
</nav>


<style>
    .navbarON {
        background-color: #1b2838;
        border-radius: 50px;
    }
</style>

<script>
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