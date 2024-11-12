<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($game['title']) ? $game['title'] : 'Game Detail'; ?> - Game Detail</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="/public/assets/css/game-detail.css">
</head>
<body>
    <?php include '../layouts/header.php'; ?>

    <main class="container my-5">
        <!-- Breadcrumb Navigation -->
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb bg-dark text-white p-3 rounded">
                <li class="breadcrumb-item"><a href="/home">Home</a></li>
                <li class="breadcrumb-item"><a href="/app/views/store/store.php">Store</a></li>
                <li class="breadcrumb-item"><a href="/app/views/categories/strategy.php">Strategy</a></li>
                <li class="breadcrumb-item active" aria-current="page"><?php echo isset($game['title']) ? $game['title'] : 'Unknown Game'; ?></li>
            </ol>
        </nav>

        <!-- Main Title -->
        <h1 class="text-white"><?php echo isset($game['title']) ? $game['title'] : 'Game Title'; ?></h1>
        
        <div class="row">
            <!-- Left Content -->
            <div class="col-md-8">
                <!-- Display Area -->
                <div class="display-area">
                    <video id="mainDisplay" controls style="display: none;">
                        <source id="videoSource" src="" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                    <img id="imageDisplay" src="<?php echo isset($game['thumbnails'][0]['src']) ? $game['thumbnails'][0]['src'] : '/public/assets/images/placeholder.jpg'; ?>" alt="Display Image">
                </div>

                <!-- Thumbnails -->
                <div class="thumbnail-carousel mt-3 d-flex gap-2">
                    <?php if (isset($game['thumbnails'])): ?>
                        <?php foreach ($game['thumbnails'] as $thumbnail): ?>
                            <?php if ($thumbnail['type'] === 'image'): ?>
                                <img src="<?php echo $thumbnail['src']; ?>" data-type="image" class="img-thumbnail thumbnail" alt="Screenshot">
                            <?php elseif ($thumbnail['type'] === 'video'): ?>
                                <img src="<?php echo $thumbnail['thumbnail']; ?>" data-type="video" data-src="<?php echo $thumbnail['src']; ?>" class="img-thumbnail thumbnail" alt="Video">
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p class="text-white">No media available.</p>
                    <?php endif; ?>
                </div>

                <!-- Add to Cart Section -->
                <section class="purchase-section bg-dark text-white p-4 rounded my-4">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h4>Buy <?php echo isset($game['title']) ? $game['title'] : 'this game'; ?></h4>
                            <p>
                                <?php if (isset($game['discount'])): ?>
                                    <span class="text-success">-<?php echo $game['discount']; ?></span> 
                                    <span class="text-decoration-line-through"><?php echo $game['original_price']; ?></span>
                                <?php else: ?>
                                    <span class="text-muted">No discounts available</span>
                                <?php endif; ?>
                                <span class="text-success"><?php echo isset($game['price']) ? $game['price'] : 'TBD'; ?></span>
                            </p>
                        </div>
                        <button class="btn btn-success">Add to Cart</button>
                    </div>
                </section>

                <!-- Game Introduction -->
                <section class="bg-dark text-white p-4 rounded my-4">
                    <h2>Introduction</h2>
                    <p><?php echo isset($game['introduction']) ? $game['introduction'] : 'No introduction available for this game.'; ?></p>
                </section>

                <!-- About the Game -->
                <section class="bg-dark text-white p-4 rounded my-4">
                    <h2>About the Game</h2>
                    <p><?php echo isset($game['about']) ? $game['about'] : 'No information available about this game.'; ?></p>
                </section>

                <!-- System Requirements -->
                <section class="bg-dark text-white p-4 rounded my-4">
                    <h2>System Requirements</h2>
                    <div class="row">
                        <!-- Minimum Requirements -->
                        <div class="col-md-6">
                            <h4>Minimum</h4>
                            <?php if (isset($game['system_requirements']['minimum'])): ?>
                                <ul>
                                    <?php foreach ($game['system_requirements']['minimum'] as $key => $value): ?>
                                        <li><strong><?php echo $key; ?>:</strong> <?php echo $value; ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php else: ?>
                                <p class="text-muted">No minimum requirements available.</p>
                            <?php endif; ?>
                        </div>
                        <!-- Recommended Requirements -->
                        <div class="col-md-6">
                            <h4>Recommended</h4>
                            <?php if (isset($game['system_requirements']['recommended'])): ?>
                                <ul>
                                    <?php foreach ($game['system_requirements']['recommended'] as $key => $value): ?>
                                        <li><strong><?php echo $key; ?>:</strong> <?php echo $value; ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php else: ?>
                                <p class="text-muted">No recommended requirements available.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </section>
            </div>

            <!-- Right Sidebar -->  
            <div class="col-md-4">
                <div class="bg-dark text-white p-4 rounded">
                    <img src="/public/assets/images/game1.webp" data-type="image" class="img-detail" alt="Screenshot">
                    <p><?php echo isset($game['introduction']) ? $game['introduction'] : 'TBD'; ?></p>
                    <p><strong>Release Date:</strong> <?php echo isset($game['release_date']) ? $game['release_date'] : 'TBD'; ?></p>
                    <p><strong>Reviews:</strong> <?php echo isset($game['reviews']) ? $game['reviews'] : 'No reviews yet'; ?></p>
                    <p><strong>Price:</strong> <span class="text-success"><?php echo isset($game['price']) ? $game['price'] : 'TBD'; ?></span></p>
                    <p><strong>Publisher:</strong> <span class="text-success"><?php echo isset($game['publisher']) ? $game['publisher'] : 'TBD'; ?></span></p>

                    <!-- Average Rating -->
                    <p><strong>Average Rating:</strong> 
                        <?php echo isset($averageRating) ? str_repeat('⭐', $averageRating) : 'Not rated yet'; ?>
                    </p>
                </div>
            </div>

        </div>

        <?php if ($userRole === 'admin'): ?>
            <div class="mb-4">
                <h4>Admin Controls</h4>
                <form action="/toggle_comments.php" method="POST">
                    <input type="hidden" name="game_id" value="<?php echo $game['id']; ?>">
                    <button type="submit" class="btn btn-<?php echo $commentsEnabled ? 'danger' : 'success'; ?>">
                        <?php echo $commentsEnabled ? 'Disable Comments' : 'Enable Comments'; ?>
                    </button>
                </form>
            </div>
        <?php endif; ?>


        <!-- Customer Reviews Section -->
        <section class="bg-dark text-white p-4 rounded my-4">
            <h2>Customer Reviews for "<?php echo $game['title']; ?>"</h2>

            <?php if (!$commentsEnabled): ?>
                <p class="text-warning">Comments are currently disabled by the admin.</p>
            <?php else: ?>
                <!-- Display Reviews -->
                <?php if (isset($reviews[$game['id']]) && count($reviews[$game['id']]) > 0): ?>
                    <?php foreach ($reviews[$game['id']] as $review): ?>
                        <div class="review mb-4">
                            <div class="d-flex align-items-center mb-2">
                                <img src="<?php echo $review['avatar']; ?>" alt="Avatar" class="rounded-circle" width="50">
                                <div class="ms-3">
                                    <h5 class="mb-0"><?php echo $review['username']; ?></h5>
                                    <span class="text-warning">
                                        <?php echo str_repeat('⭐', $review['rating']); ?>
                                    </span>
                                </div>
                            </div>
                            <p class="mb-2"><?php echo $review['message']; ?></p>

                            <!-- Comments Section -->
                            <?php if (isset($review['comments'])): ?>
                                <div class="comments ms-5">
                                    <?php foreach ($review['comments'] as $comment): ?>
                                        <div class="comment mb-2">
                                            <strong><?php echo $comment['username']; ?>:</strong> <?php echo $comment['message']; ?>

                                            <!-- Admin Options -->
                                            <?php if ($userRole === 'admin'): ?>
                                                <div class="mt-2">
                                                    <button class="btn btn-sm btn-outline-danger">Delete</button>
                                                    <button class="btn btn-sm btn-outline-secondary">Hide</button>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>

                            <!-- Reply and Like/Dislike Buttons -->
                            <div class="d-flex gap-3 mt-2">
                                <button class="btn btn-sm btn-outline-primary">Reply</button>
                                <button class="btn btn-sm btn-outline-success">👍 <?php echo $review['likes']; ?></button>
                                <button class="btn btn-sm btn-outline-danger">👎 <?php echo $review['dislikes']; ?></button>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No reviews yet. Be the first to review!</p>
                <?php endif; ?>

                <!-- Add a Review Form -->
                <?php if ($userRole === 'user' && $userHasBoughtGame): ?>
                    <form action="/submit_review.php" method="POST" class="mt-4">
                        <h4>Leave a Review</h4>
                        <input type="hidden" name="game_id" value="<?php echo $game['id']; ?>"> <!-- Pass Game ID -->
                        <div class="mb-3">
                            <label for="rating" class="form-label">Rating</label>
                            <select name="rating" id="rating" class="form-select">
                                <option value="5">⭐⭐⭐⭐⭐</option>
                                <option value="4">⭐⭐⭐⭐</option>
                                <option value="3">⭐⭐⭐</option>
                                <option value="2">⭐⭐</option>
                                <option value="1">⭐</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="message" class="form-label">Your Review</label>
                            <textarea name="message" id="message" rows="3" class="form-control" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-success">Submit Review</button>
                    </form>
                <?php elseif ($userRole === 'user' && !$userHasBoughtGame): ?>
                    <p class="text-warning">You must purchase this game to leave a review.</p>
                <?php elseif ($userRole === 'admin'): ?>
                    <p class="text-info">Admins cannot leave reviews but can manage comments.</p>
                <?php endif; ?>
            <?php endif; ?>
        </section>



    </main>
    <?php include '../layouts/footer.php'; ?>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Custom JS -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const thumbnails = document.querySelectorAll(".thumbnail");
            const mainDisplay = document.getElementById("mainDisplay");
            const imageDisplay = document.getElementById("imageDisplay");
            const videoSource = document.getElementById("videoSource");

            thumbnails.forEach(thumbnail => {
                thumbnail.addEventListener("click", function () {
                    const type = this.getAttribute("data-type");
                    if (type === "image") {
                        mainDisplay.style.display = "none";
                        imageDisplay.style.display = "block";
                        imageDisplay.src = this.src;
                    } else if (type === "video") {
                        imageDisplay.style.display = "none";
                        mainDisplay.style.display = "block";
                        videoSource.src = this.getAttribute("data-src");
                        mainDisplay.load();
                        mainDisplay.play();
                    }
                });
            });
        });
    </script>

</body>
</html>
