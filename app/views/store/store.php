<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Store - Browse Categories</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="/public/assets/css/store.css">
</head>
<body>
    <?php include '../layouts/header.php'; ?> <!-- Include shared header -->

    <main class="container mt-4">
        <!-- Browse by Category Section -->
        <section class="categories mb-5">
            <h2 class="text-white mb-4">Browse by Category</h2>
            <div class="row g-3">
                <div class="col-md-3">
                    <div class="category-card text-center">
                        <img src="/public/assets/images/yes.webp" alt="Racing" class="img-fluid rounded">
                        <div class="category-overlay">
                            <h5 class="text-white">RACING</h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="category-card text-center">
                        <img src="/public/assets/images/game1.webp" alt="Strategy" class="img-fluid rounded">
                        <div class="category-overlay">
                            <h5 class="text-white">STRATEGY</h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="category-card text-center">
                        <img src="/public/assets/images/game3.webp" alt="Story-Rich" class="img-fluid rounded">
                        <div class="category-overlay">
                            <h5 class="text-white">STORY-RICH</h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="category-card text-center">
                        <img src="/public/assets/images/game6.webp" alt="Anime" class="img-fluid rounded">
                        <div class="category-overlay">
                            <h5 class="text-white">ANIME</h5>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Game Cards Section -->
        <section class="game-cards">
            <h2 class="text-white mb-4">Games</h2>
            <div class="row g-3">
                <div class="col-md-4">
                    <div class="card h-100">
                        <img src="/public/assets/images/game3.webp" class="card-img-top" alt="Game 1">
                        <div class="card-body text-center">
                            <h5 class="card-title">Game Title 1</h5>
                            <p class="card-text text-success">Price: 100,000đ</p>
                            <a href="#" class="btn btn-primary">View Details</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100">
                        <img src="/public/assets/images/game6.webp" class="card-img-top" alt="Game 2">
                        <div class="card-body text-center">
                            <h5 class="card-title">Game Title 2</h5>
                            <p class="card-text text-success">Price: 150,000đ</p>
                            <a href="#" class="btn btn-primary">View Details</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100">
                        <img src="/public/assets/images/yes.webp" class="card-img-top" alt="Game 3">
                        <div class="card-body text-center">
                            <h5 class="card-title">Game Title 3</h5>
                            <p class="card-text text-success">Price: 200,000đ</p>
                            <a href="#" class="btn btn-primary">View Details</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <?php include '../layouts/footer.php'; ?> <!-- Include shared footer -->

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
