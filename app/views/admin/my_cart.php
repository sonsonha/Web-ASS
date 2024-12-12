<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Cart</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/public/assets/css/cart.css">
</head>
<body class="custom-colorss">
    <!-- Include Header -->
    <?php include __DIR__ . '/../layouts/header.php'; ?> <!-- Updated -->

    <div class="container my-5">
        <h1 class="text-center mb-5">My Carts</h1>

        <!-- Cart Items Section -->
        <div id="cart-items" class="row g-4">
            <!-- Cart items will be dynamically populated -->
        </div>
        <button id="toggle-select-all" class="btn btn-primary">Select All</button>

        <!-- Coins Left Section -->
        <div class="coins-section mb-4">
            <div class="p-3 rounded bg-dark d-flex justify-content-between align-items-center">
                <h3 class="text-warning mb-0">Coins Left: <span id="user-coins">0</span></h3>
                <button id="add-coins" class="btn btn-warning">Add Coins</button>
            </div>
        </div>

        <!-- Total Payment Section -->
        <div class="total-payment-section mt-5">
            <div class="p-3 rounded bg-dark d-flex justify-content-between align-items-center">
                <h3 class="text-success mb-0">Total Payment: <span id="total-amount">$0.00</span></h3>
                
            </div>
        </div>

        <!-- Buy Now Section -->
        <div class="text-center mt-4">
            <button id="buy-now" class="btn btn-success btn-lg" disabled>Buy Now</button>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Lấy user ID
        const userId = localStorage.getItem('id');

        // Hàm để lấy số coins
        function fetchCoins() {
            fetch(`http://localhost/api/get_coins.php?id=${userId}`)
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        document.getElementById('user-coins').textContent = data.coins;
                    } else {
                        alert('Failed to load coins');
                    }
                })
                .catch(error => {
                    console.error('Error fetching coins:', error);
                    alert('Error fetching coins');
                });
        }

        // Sự kiện cho nút Add Coins
        document.getElementById('add-coins').addEventListener('click', function() {
            // Điều hướng đến trang Add Coins
            window.location.href = 'add_coins'; // Cập nhật đường dẫn thực tế của bạn
        });

        // Gọi hàm fetchCoins khi trang được tải
        fetchCoins();
    });


    </script>

    <!-- Include Header -->
    <?php include __DIR__ . '/../layouts/footer.php'; ?> <!-- Updated -->

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Cart JS -->
    <script src="/public/assets/js/my_cart.js"></script>
</body>
</html>

<style>
    .custom-colorss{
        background-color: #1b2838 !important;
        color: white;
    }
</style>
