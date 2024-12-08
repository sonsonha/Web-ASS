<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/../assets/css/user_profile.css">
</head>
<body>
    <!-- Include Header -->
    <?php include __DIR__ . '/../layouts/header.php'; ?> <!-- Updated -->

    <main class="container my-5">
        <h1 class="text-center text-white mb-4">Users Profile</h1>
        <div class="row justify-content-center">
            <!-- User Information -->
            <div class="col-md-6 p-4 rounded" style="background-color: #1b2838;">
                <div class="text-center mb-3">
                    <img id="user-avatar" src="/public/assets/images/default-avatar.png" alt="User Avatar" class="rounded-circle" width="150">
                    <button id="change-picture-btn" class="btn btn-outline-light btn-sm mt-3">Edit_profile</button>
                </div>
                <div class="text-center mb-3">
                    <h3 id="user-name">User Name</h3>
                </div>
                <div class="text">
                    <p><strong>Username:</strong> <span id="user-email">Jhondoe123</span></p>
                </div>
                <div class="mb-3 text">
                    <p><strong>Email:</strong> <span id="user-email">example@example.com</span></p>
                </div>
            </div>
        </div>

        <!-- Games Owned Section -->
        <section class="mt-5">
            <h2 class="text-white mb-4">Games Owned</h2>
            <div id="games-owned" class="row g-4">
                <!-- Games will be dynamically populated -->
            </div>
        </section>
    </main>

    <!-- Include Footer -->
    <?php include __DIR__ . '/../layouts/footer.php'; ?> <!-- Updated -->

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Profile JS -->
    <script src="/../assets/js/user_profile.js"></script>
</body>
</html>
