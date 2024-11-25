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
<body>
    <!-- Include Header -->
    <?php include '../layouts/header.php'; ?>

    <div class="container my-5">
        <h1 class="text-center mb-5">My Cart</h1>

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

    <!-- Include Footer -->
    <?php include '../layouts/footer.php'; ?>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Cart JS -->
    <script src="/public/assets/js/my_cart.js"></script>
</body>
</html>
