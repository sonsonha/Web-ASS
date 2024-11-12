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

        <!-- abc -->



        <!-- abc -->


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
                                    <span class="text-warning"><?php echo str_repeat('⭐', $review['rating']); ?></span>
                                </div>
                                <?php if ($userRole === 'admin'): ?>
                                            <div class="mt-2">
                                                <button class="btn btn-sm btn-outline-danger">Delete</button>
                                                <button class="btn btn-sm btn-outline-secondary">Hide</button>
                                            </div>
                                <?php endif; ?>
                            </div>
                            <p class="mb-2"><?php echo $review['message']; ?></p>
                            <div class="d-flex gap-3 mt-2">
                                <button class="btn btn-sm btn-outline-success" <?php echo $userRole === 'guest' ? 'data-bs-toggle="modal" data-bs-target="#loginAlertModal"' : ''; ?> 
                                data-review-id="<?php echo isset($review['id']) ? $review['id'] : 0; ?>">
                                👍 <?php echo isset($review['likes']) ? $review['likes'] : 0; ?>
                            </button>
                                <button class="btn btn-sm btn-outline-danger" <?php echo $userRole === 'guest' ? 'data-bs-toggle="modal" data-bs-target="#loginAlertModal"' : ''; ?> 
                                data-review-id="<?php echo isset($review['id']) ? $review['id'] : 0; ?>">
                                👎 <?php echo isset($review['dislikes']) ? $review['dislikes'] : 0; ?>
                            </button>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No reviews yet. Be the first to review!</p>
                <?php endif; ?>

                <!-- Add a Review Form -->
                <?php if ($userRole === 'guest'): ?>
                    <p class="text-warning">Please sign in to leave a review.</p>
                    <button class="btn btn-primary">
                        <a href="/login.php" class="btn btn-primary">Sign In</a>
                    </button>
                <?php elseif ($userRole === 'user' && $userHasBoughtGame): ?>
                    <form id="reviewForm" class="mt-4">
                        <h4>Leave a Review</h4>
                        <input type="hidden" name="game_id" id="game_id" value="<?php echo $game['id']; ?>"> <!-- Pass Game ID -->
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
                    <p class="text-info">Admins role.</p>
                <?php endif; ?>
            <?php endif; ?>
        </section>


    <!-- Login Alert Modal -->
    <div class="modal fade" id="loginAlertModal" tabindex="-1" aria-labelledby="loginAlertModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content bg-dark text-white">
                <div class="modal-header">
                    <h5 class="modal-title" id="loginAlertModalLabel">Sign In Required</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>You must log in to take this action bruhhh</p>
                </div>
                <div class="modal-footer">
                    <a href="/login.php" class="btn btn-primary">Sign In</a>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>