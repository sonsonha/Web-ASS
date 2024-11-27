<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Game Detail</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="/public/assets/css/game-detail.css">
</head>
<body>
    <!-- Include Header -->
    <?php include __DIR__ . '/../layouts/header.php'; ?> <!-- Updated -->

    <main class="container my-5">

        <?php include __DIR__ . '/../layouts/nav_bar.php'; ?> <!-- Updated -->
        
        <!-- Breadcrumb Navigation -->
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb bg-dark text-white p-3 rounded">
                <li class="breadcrumb-item"><a href="/home">Home</a></li>
                <li class="breadcrumb-item"><a href="/store/store.php">Store</a></li>
                <li class="breadcrumb-item"><a href="/categories/strategy.php">Strategy</a></li>
                <li class="breadcrumb-item active" aria-current="page" id="game-breadcrumb">Game Name</li>
            </ol>
        </nav>

        <!-- Main Title -->
        <h1 class="text-white" id="game-title">Game Name</h1>

        <div class="row">
            <!-- Left Content -->
            <div class="col-md-8">
                <!-- Display Area -->
                <!-- <div class="display-area">
                    <video id="mainDisplay" controls style="display: none;">
                        <source id="videoSource" src="" type="video/mp4">
                    </video>
                    <img id="imageDisplay" src="/public/assets/images/feature1.jpg" alt="Game Display">
                </div> -->

                <div class="display-area">
                    <video id="mainDisplay" controls>
                        <source id="videoSource" src="" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                    <img id="imageDisplay" src="/public/assets/images/feature1.jpg" alt="Game Display">
                </div>


                <!-- Thumbnail Carousel -->
                <div class="thumbnail-carousel-container">
                    <!-- <button class="thumbnail-nav prev">&lt;</button> -->
                    <div class="thumbnail-carousel mt-3 d-flex gap-2" id="thumbnails">
                        <!-- Thumbnails populated dynamically -->
                    </div>
                    <!-- <button class="thumbnail-nav next">&gt;</button> -->
                </div>


                <!-- Add to Cart Section -->
                <!-- <section class="purchase-section bg-dark text-white p-4 rounded my-4">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h4 id="buy-game-title">Buy Game Name</h4>
                            <p id="pricing-info">
                                <span class="text-success" id="discount-info">Discount Info</span> 
                                <span class="text-decoration-line-through" id="original-price">Original Price</span> 
                                <span class="text-success" id="final-price">Price After Discount</span>
                            </p>
                        </div>
                        <button class="btn btn-success add-to-cart-btn" id="add-to-cart-btn">
                            Add to Cart
                        </button>
                    </div>
                </section> -->

                <section class="purchase-section bg-dark text-white p-4 rounded my-4">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h4 id="buy-game-title">Buy Game Name</h4>
                            <div class="d-flex align-items-center gap-3">
                                <div id="discount-badge" class="badge bg-danger d-none">
                                    <span id="discount-percentage"></span>% OFF
                                </div>
                                <p id="pricing-info" class="mb-0">
                                    <span class="text-decoration-line-through text-muted" id="original-price"></span>
                                    <span class="text-success ms-2" id="final-price"></span>
                                </p>
                            </div>
                        </div>
                        <button class="btn btn-success add-to-cart-btn" id="add-to-cart-btn">
                            Add to Cart
                        </button>
                    </div>
                </section>


                <!-- Game Introduction -->
                <section class="bg-dark text-white p-4 rounded my-4">
                    <h2>Introduction</h2>
                    <p id="game-introduction">Game Introduction goes here...</p>
                </section>

                <!-- About the Game -->
                <section class="bg-dark text-white p-4 rounded my-4">
                    <h2>About the Game</h2>
                    <p id="about-game">Game description goes here...</p>
                </section>

                <!-- System Requirements -->
                <section class="bg-dark text-white p-4 rounded my-4">
                    <h2>System Requirements</h2>
                    <div class="row">
                        <!-- Minimum Requirements -->
                        <div class="col-md-6">
                            <h4>Minimum</h4>
                            <ul id="minimum-req">
                                <!-- Populated dynamically -->
                            </ul>
                        </div>
                        <!-- Recommended Requirements -->
                        <div class="col-md-6">
                            <h4>Recommended</h4>
                            <ul id="recommended-req">
                                <!-- Populated dynamically -->
                            </ul>
                        </div>
                    </div>
                </section>
            </div>

            <!-- Right Sidebar -->
            <div class="col-md-4">
                <div class="bg-dark text-white p-4 rounded">
                    <img id="game-thumbnail" src="" alt="Game Thumbnail" class="img-detail">
                    <!-- <p id="game-description">Game Introduction</p> -->
                    <p><strong>Release Date:</strong> <span id="release-date">Unknown</span></p>
                    <!-- <p><strong>Reviews:</strong> <span id="reviews-count">Unknown</span></p> -->
                    <p><strong>Average Rating:</strong> <span id="reviews-count"></span></p>
                    <!-- <div id="average-rating-stars" class="rating-stars"></div> -->
                    <p><strong>Price:</strong> <span class="text-success" id="game-price">Unknown</span></p>
                    <p><strong>Publisher:</strong> <span class="text-success" id="publisher">Unknown</span></p>
                </div>
            </div>
        </div>

        <!-- Customer Reviews -->
        <section class="bg-dark text-white p-4 rounded my-4" id="reviews-section">
            <h2>Customer Reviews</h2>
            <div id="reviews-container">
                <!-- Reviews populated dynamically -->
            </div>
        </section>

        <!-- Add Review Form -->

        <section id="review-form-section" class="bg-dark text-white p-4 rounded my-4">
            <h4>Leave a Review</h4>
            <form id="reviewForm">
                <input type="hidden" name="game_id" id="game_id">
                <div class="mb-3">
                    <label for="rating" class="form-label">Rating</label>
                    <div id="star-rating" class="d-flex gap-1">
                        <!-- Stars will be dynamically created -->
                    </div>
                    <input type="hidden" name="rating" id="rating" value="0">
                </div>
                <div class="mb-3">
                    <label for="message" class="form-label">Your Review</label>
                    <textarea name="message" id="message" rows="3" class="form-control"></textarea>
                </div>
                <button type="submit" class="btn btn-success">Review</button>
            </form>
        </section>

    </main> 

    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content bg-dark text-white">
                <div class="modal-header">
                    <h5 class="modal-title" id="loginModalLabel">Sign In Required</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="loginModalBody">
                    <p>Please sign in to take this action.</p>
                </div>
                <div class="modal-footer">
                    <a href="/app/views/auth/login.php" class="btn btn-primary">Sign In</a>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Include Footer -->

    <?php include __DIR__ . '/../layouts/footer.php'; ?> <!-- Updated -->
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Custom JS -->
    <script src="/public/assets/js/game-detail.js"></script>
</body>
</html>
