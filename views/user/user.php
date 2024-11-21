<?php include(__DIR__ . '/../templates/header.php'); ?>

<div class="container mt-5">
    <h1>User Profile</h1>
    <div class="row">
        <!-- Avatar và thông tin người dùng -->
        <div class="col-md-4">
            <img src="avatar.jpg" class="img-thumbnail mb-3" alt="User Avatar">
            <button class="btn btn-dark btn-block">Change Avatar</button>
        </div>
        <div class="col-md-8">
            <h3>Username: <span>player1</span></h3>
            <p>In-game Name: PlayerOne</p>
            <p>Reputation Points: 85</p>
            <p>Total Points: 1200</p>
        </div>
    </div>

    <!-- Danh sách game đã mua -->
    <h3 class="mt-5">Purchased Games</h3>
    <ul class="list-group mb-3">
        <li class="list-group-item">Game Title 1</li>
        <li class="list-group-item">Game Title 2</li>
        <!-- Repeat for more games -->
    </ul>

    <!-- Giỏ hàng -->
    <h3>Shopping Cart</h3>
    <ul class="list-group">
        <li class="list-group-item d-flex justify-content-between align-items-center">
            Game Title 3
            <button class="btn btn-danger btn-sm">Remove</button>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">
            Game Title 4
            <button class="btn btn-danger btn-sm">Remove</button>
        </li>
        <!-- Repeat for more items -->
    </ul>
</div>


