<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Strategy Games</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="/public/assets/css/category.css">
</head>
<body>
    <?php include '../layouts/header.php'; ?> <!-- Include shared header -->

    <main>
    <!-- Trending Games Carousel -->
    <section class="trending-carousel" id="trendingCarousel">
            <div class="carousel-header text-center text-white">
                <h1>Strategy</h1>
            </div>
        <div id="gameCarousel" class="carousel slide" data-bs-ride="carousel">
            <!-- Category Name -->


            <!-- Carousel Items -->
            <div class="carousel-inner">
                <div class="carousel-item active" data-bg="/public/assets/images/game9.webp">
                    <div class="carousel-content">
                        <img src="/public/assets/images/game1.webp" class="game-image" alt="Game 1">
                        <div class="game-details">
                            <h2>Liar's Bar</h2>
                            <p>Release date: Oct 2, 2024</p>
                            <p class="text-success">Very Positive | 12,906 User Reviews</p>
                            <div class="tags">
                                <span>Casual</span>
                                <span>Multiplayer</span>
                                <span>Strategy</span>
                                <span>Simulation</span>
                            </div>
                            <p>Price: 102,000đ</p>
                        </div>
                    </div>
                </div>
                <div class="carousel-item" data-bg="/public/assets/images/game5.webp">
                    <div class="carousel-content">
                        <img src="/public/assets/images/game3.webp" class="game-image" alt="Game 2">
                        <div class="game-details">
                            <h2>Another Game</h2>
                            <p>Release date: Sep 15, 2024</p>
                            <p class="text-success">Mostly Positive | 8,506 User Reviews</p>
                            <div class="tags">
                                <span>Adventure</span>
                                <span>PvP</span>
                                <span>Co-op</span>
                                <span>3D</span>
                            </div>
                            <p>Price: 85,000đ</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Carousel Controls -->
            <button class="carousel-control-prev" type="button" data-bs-target="#gameCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#gameCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
            </button>
        </div>
    </section>

    <!-- Game List Section -->
    <section class="game-cards container mt-5">
        <h2 class="text-white mb-4">Popular Strategy Games</h2>
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <!-- Game Card Example -->
            <div class="col">
                <div class="card game-card">
                    <img src="/public/assets/images/game2.webp" class="card-img-top" alt="Game 1">
                    <div class="card-body">
                        <h5 class="card-title">Game Title 1</h5>
                        <p class="price text-success">Price: <span>195,000đ</span></p>
                    </div>
                    <div class="discount-label">-25%</div>
                </div>
            </div>
            <div class="col">
                <div class="card game-card">
                    <img src="/public/assets/images/game3.webp" class="card-img-top" alt="Game 2">
                    <div class="card-body">
                        <h5 class="card-title">Game Title 2</h5>
                        <p class="price text-success">Price: <span>1,061,500đ</span></p>
                    </div>
                    <div class="discount-label">-50%</div>
                </div>
            </div>
            <div class="col">
                <div class="card game-card">
                    <img src="/public/assets/images/game4.webp" class="card-img-top" alt="Game 3">
                    <div class="card-body">
                        <h5 class="card-title">Game Title 3</h5>
                        <p class="price text-success">Price: <span>498,000đ</span></p>
                    </div>
                    <div class="prepurchase-label">Prepurchase</div>
                </div>
            </div>
            <!-- Add more game cards dynamically -->
        </div>
        <div class="text-center mt-4">
            <button class="btn btn-primary show-more">Show More</button>
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
