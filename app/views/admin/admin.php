<?php include __DIR__ . '/../layouts/header.php'; ?> <!-- Updated -->

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


<style>
    body {
        background-color: #1b2838 !important  ;
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

    /* Căn giữa và làm cho các nút dính nhau */
    .btn-group .btn {
        margin: 0;
        border-radius: 0;
        font-size: 16px;
        font-weight: bold;
        text-align: center;
        padding: 10px 20px;
        color: #f8f9fa; /* Màu chữ */
        background-color: #343a40; /* Màu nền mặc định */
        border: 1px solid #495057; /* Màu viền */
        transition: all 0.3s ease;
    }

    .btn-group .btn.active {
        background-color: #79a5d4 ;
        color: #fff;
        font-weight: bold;
        box-shadow: inset 0 0 5px rgba(0, 0, 0, 0.3);
    }

    .btn-group .btn:not(.active):hover {
        background-color: #79a5d4;
        color: #fff;
        transform: translateY(-1px);
    }


    .btn:hover {
        background-color: #007bff;
        color: white;
        transform: translateY(-2px);
    }

    .d-flex.gap-3 a {
        margin-bottom: 50px; /* Khoảng cách giữa các nút */
    }

</style>

<div class="container mt-4 text-center">
    <div class="btn-group d-inline-block" role="group" aria-label="Admin Navigation">
        <button class="btn btn-primary active" id="manageUsersBtn" onclick="showSection('manageUsers', this)">Manage Users</button>
        <button class="btn btn-primary" id="manageContactsBtn" onclick="showSection('manageContacts', this)">Manage Contacts</button>
        <button class="btn btn-primary" id="manageEventBtn" onclick="showSection('manageEvent', this)">Manage Event</button>
        <button class="btn btn-primary" id="manageProductsBtn" onclick="showSection('manageProducts', this)">Manage Products</button>
    </div>

    <?php include(__DIR__ . '/managerpage/manage_users.php'); ?>
    
    <?php include(__DIR__ . '/managerpage/manage_contacts.php'); ?>
    <?php include(__DIR__ . '/managerpage/manage_event.php'); ?>
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

    function showSection(sectionId, btn) {
        const sections = document.querySelectorAll('.content-section');
        const buttons = document.querySelectorAll('.btn-group .btn');

        // Ẩn tất cả các phần nội dung
        sections.forEach(section => section.classList.remove('active'));

        // Hiển thị phần được chọn
        document.getElementById(sectionId).classList.add('active');

        // Xóa trạng thái "active" khỏi tất cả các nút
        buttons.forEach(button => button.classList.remove('active'));

        // Thêm trạng thái "active" vào nút được nhấn
        btn.classList.add('active');
    }

</script>