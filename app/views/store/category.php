<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category Games Name</title> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="/public/assets/css/category.css">
</head>
<body>
    <?php include '../layouts/header.php'; ?> <!-- Include shared header -->

    <main>
        <!-- Trending Games Carousel -->
        <section class="trending-carousel" id="trendingCarousel" style="background-image: url('/public/assets/images/game9.webp'); background-size: cover; background-position: center;">
                <div class="carousel-header text-center text-white">
                    <h1>Category Game Name</h1>
                </div>
                <div id="gameCarousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <!-- Slides dynamically populated here -->
                    </div>

                    <!-- Carousel Controls -->
                    <button class="carousel-control-prev" type="button" data-bs-target="#gameCarousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#gameCarousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
        </section>

        <div class="container text-center">
            <div class="row">
                <div class="col">
                </div>
                <div class="col-12">
                    <?php include '../layouts/nav_bar.php'; ?> <!-- Include shared nav bar -->
                </div>
                <div class="col">
                </div>
            </div>
        </div>

        <!-- Trending Games Section -->
        <section class="trending-games container mt-5">
            <h2 class="text-white mb-4">Trending Games</h2>
            <div id="trendingGamesContainer" class="row g-4">
                <!-- Trending game cards will be dynamically populated here -->
            </div>
        </section>


        <!-- Game List Section -->
        <section class="game-cards container mt-5">
            <h2 id="category-title" class="text-white mb-4"></h2>
            <div id="gameCardsContainer">
                <!-- Rows of game cards will be dynamically added here -->
            </div>
        </section>

    </main>

    <?php include '../layouts/footer.php'; ?> <!-- Include shared footer -->

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Custom JS -->
    <script src="/public/assets/js/category.js"></script>
</body>
</html>
