<?php include(__DIR__ . '/../templates/header.php'); ?>

<style>
    body {
        background-color: black;
        color: white;
    }

    .btn-nav {
        margin-right: 10px;
        margin-top: 10px;
    }

    .content-section {
        display: none;
        /* Mặc định ẩn tất cả */
    }

    .content-section.active {
        display: block;
        /* Hiển thị nội dung đang được chọn */
    }

    .table-dark th,
    .table-dark td {
        color: white;
    }
</style>

<div class="container mt-0">
    <div class="mt-0">
        <a href="#" class="nav-link text-light d-inline-block" onclick="showSection('manageUsers')">Manage Users</a>
        <a href="#" class="nav-link text-light d-inline-block" onclick="showSection('manageContacts')">Manage Contacts</a>
        <a href="#" class="nav-link text-light d-inline-block" onclick="showSection('manageProducts')">Manage Products</a>
    </div>

    <?php include(__DIR__ . '/managerpage/manage_users.php'); ?>
    
    <?php include(__DIR__ . '/managerpage/manage_contacts.php'); ?>
    <?php include(__DIR__ . '/managerpage/manage_products.php'); ?>
</div>

<script>
    // Hiển thị phần nội dung theo nút được nhấn
    function showSection(sectionId) {
        const sections = document.querySelectorAll('.content-section');
        sections.forEach(section => {
            section.classList.remove('active'); // Ẩn tất cả
        });

        const activeSection = document.getElementById(sectionId);
        activeSection.classList.add('active'); // Hiển thị phần được chọn
    }
</script>