<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Game Detail</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="/../assets/css/game-detail.css">
</head>
<body>
    <!-- Include Header -->
    <?php include __DIR__ . '/../layouts/header.php'; ?> <!-- Updated -->

    <main class="container my-5">

        <!-- Main Title -->
        <h1 class="text-white" id="game-title">Game Name</h1>

        <div class="row">
            <!-- Left Content -->
            <div class="col-md-8">
                <!-- Display Area -->
                <div class="display-area">
                    <video id="mainDisplay" controls style="display: noneav;">
                        <source id="videoSource" src="" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                    <img id="imageDisplay" src="assets/images/feature1.jpg" alt="Game Display">
                    <div id="videoIframeContainer" style="display: none;">
                        <!-- YouTube iframe will be dynamically added here -->
                    </div>
                </div>


                <!-- Thumbnail Carousel -->
                <div class="thumbnail-carousel-container">
                    <div class="thumbnail-carousel mt-3 d-flex gap-2" id="thumbnails">
                        <!-- Thumbnails populated dynamically -->
                    </div>
                </div>

                <!-- Add to Cart Section -->
                <section class="purchase-section bg-dark text-white p-4 rounded my-4">
                    <div class="d-flex flex-column flex-md-row align-items-center justify-content-between">
                        <div>
                            <h4 id="buy-game-title">Buy Game Name</h4>
                            <div class="d-flex align-items-center gap-3">
                                <div id="discount-badge" class="badge bg-danger d-none">
                                    <span id="discount-percentage"></span>% OFF
                                </div>
                                <p id="pricing-info" class="mb-0">
                                    <span class="text-decoration-line-through text-muted" id="original-price"></span>
                                    <span class="text-warning ms-2" id="final-price"></span>
                                </p>
                            </div>
                        </div>
                        <button class="btn btn-success add-to-cart-btn mt-3 mt-md-0" id="add-to-cart-btn">
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

                <!-- Customer Reviews -->
                <section class="bg-dark text-white p-4 rounded my-4" id="reviews-section">
                    <h2>Reviews</h2>
                    <div id="reviews-container">
                        <!-- Reviews populated dynamically -->
                    </div>
                </section>

                <!-- <section class="bg-dark text-white p-4 rounded my-4"> -->
                    <section id="review-form-section" class="bg-dark text-white p-4 rounded my-4">
                        <h4>Leave a Review</h4>
                        <form id="reviewForm">
                            <input type="hidden" name="game_id" id="game_id">
                            <div class="mb-3">
                                <div id="star-rating" class="d-flex gap-1">
                                    
                                </div>
                                <input type="hidden" name="rating" id="rating" value="0">
                            </div>
                            <div class="mb-3">
                                <!-- <label for="message" class="form-label">Your Review</label> -->
                                <textarea name="message" id="message" rows="3" class="form-control"></textarea>
                            </div>
                            <button type="submit" class="btn btn-success">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-send" viewBox="0 0 16 16">
                                <path d="M15.854.146a.5.5 0 0 1 .11.54l-5.819 14.547a.75.75 0 0 1-1.329.124l-3.178-4.995L.643 7.184a.75.75 0 0 1 .124-1.33L15.314.037a.5.5 0 0 1 .54.11ZM6.636 10.07l2.761 4.338L14.13 2.576zm6.787-8.201L1.591 6.602l4.339 2.76z"/>
                                </svg>
                            </button>
                        </form>
                    </section>
                <!-- </section> -->

            </div>

            <!-- Right Sidebar -->
            <div class="col-md-4">
                <div class="bg-dark text-white p-4 rounded">
                    <img id="game-thumbnail" src="https://i.ytimg.com/vi_webp/y1Rx-Bbht5E/maxresdefault.webp" alt="Game Thumbnail" class="img-detail">
                    <p><strong>Release Date:</strong> <span id="release-date">Unknown</span></p>
                    <p><strong>Average Rating:</strong> <span id="reviews-count"></span></p>
                    <p><strong>Price:</strong> <span class="text-success" id="game-price">Unknown</span></p>
                    <p><strong>Publisher:</strong> <span class="text-success" id="publisher">Unknown</span></p>

                    <!-- Dynamically generate and display genres as clickable links -->
                    <p><strong>Genres:</strong> 
                        <span id="genres">
                            <!-- Genres will be populated here -->
                        </span>
                    </p>
                </div>

                <!-- Popular Articles Section -->
                <div id="popular-articles" class="d-flex flex-wrap gap-3 mt-4">
                    <!-- Articles will be populated here -->
                </div>
            </div>
        </div>

        <!-- Modal for editing the article -->
        <div class="modal fade" id="editArticleModal" tabindex="-1" aria-labelledby="editArticleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editArticleModalLabel">Edit Article</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="editArticleForm">
                            <div class="mb-3">
                                <label for="editImage" class="form-label">Image URL</label>
                                <input type="text" class="form-control" id="editImage" required>
                            </div>
                            <div class="mb-3">
                                <label for="editTitle" class="form-label">Title</label>
                                <input type="text" class="form-control" id="editTitle" required>
                            </div>
                            <div class="mb-3">
                                <label for="editDescription" class="form-label">Description</label>
                                <textarea class="form-control" id="editDescription" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>




        <!-- Add Review Form -->

        <!-- <section id="review-form-section" class="bg-dark text-white p-4 rounded my-4">
            <h4>Leave a Review</h4>
            <form id="reviewForm">
                <input type="hidden" name="game_id" id="game_id">
                <div class="mb-3">
                    <label for="rating" class="form-label">Rating</label>
                    <div id="star-rating" class="d-flex gap-1">
                        
                    </div>
                    <input type="hidden" name="rating" id="rating" value="0">
                </div>
                <div class="mb-3">
                    <label for="message" class="form-label">Your Review</label>
                    <textarea name="message" id="message" rows="3" class="form-control"></textarea>
                </div>
                <button type="submit" class="btn btn-success">Review</button>
            </form>
        </section> -->

    </main>
    
    <div class="modal fade" id="editArticleModal" tabindex="-1" aria-labelledby="editArticleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editArticleModalLabel">Edit Article</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editArticleForm">
                        <div class="mb-3">
                            <label for="editImage" class="form-label">Image URL</label>
                            <input type="text" class="form-control" id="editImage" required>
                        </div>
                        <div class="mb-3">
                            <label for="editTitle" class="form-label">Title</label>
                            <input type="text" class="form-control" id="editTitle" required>
                        </div>
                        <div class="mb-3">
                            <label for="editDescription" class="form-label">Description</label>
                            <textarea class="form-control" id="editDescription" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>



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
    <script src="/../assets/js/game-detail.js"></script>
</body>
</html>
