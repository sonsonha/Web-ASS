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
    <?php include __DIR__ . '/../layouts/header.php'; ?> <!-- Updated -->

    <div class="row justify-content-center">
        <!-- User Information -->
        <div class="col-md-6 p-4 rounded" style="background-color: #1b2838;">
            <div class="text-center mb-3">
                <img id="user-avatar" src="/public/assets/images/default-avatar.png" alt="User Avatar" class="rounded-circle" width="150">
                <input type="file" id="profile-picture" class="form-control mt-2 d-none">
                <button id="change-picture-btn" class="btn btn-outline-light btn-sm mt-2">Change Picture</button>
            </div>
            <form id="edit-profile-form">
                <div class="mb-3 text-center">
                    <input type="text" id="edit-username" class="form-control text-center bg-dark text-white" placeholder="Username" value="User Name">
                </div>
                <div class="mb-3">
                    <label for="edit-email">Email:</label>
                    <input type="email" id="edit-email" class="form-control bg-dark text-white" placeholder="Email" value="example@example.com">
                </div>
                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-success">Save Changes</button>
                    <button id="change-password-btn" type="button" class="btn btn-warning">Change Password</button>
                </div>
            </form>
        </div>
    </div>


    <!-- Include Footer -->
    <?php include __DIR__ . '/../layouts/footer.php'; ?> <!-- Updated -->

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Cart JS -->
    <script src="/public/assets/js/my_cart.js"></script>
</body>
</html>
