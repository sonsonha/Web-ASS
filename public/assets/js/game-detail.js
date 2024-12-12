document.addEventListener('DOMContentLoaded', () => {
    const gameId = new URLSearchParams(window.location.search).get('id'); // Get the gameId from URL query string

    if (!gameId) {
        console.error('No game ID provided in the URL.');
        return;
    }

    // Fetch game details and populate the page
    fetchGameDetails(gameId);

    function fetchGameDetails(gameId) {
        fetch(`/../api/get_game_info.php?id=${gameId}`)
            .then((response) => response.json())
            .then((data) => {
                if (data.status === 'success' && data.data) {
                    const game = data.data;
                    const user = getUser(); // Simulate fetching current user info
                    populateGameDetails(game, user);
                } else {
                    console.error('Error fetching game details:', data.message);
                }
            })
            .catch((error) => {
                console.error('Error fetching game details:', error);
            });
    }

    function populateGameDetails(game, user) {
        if (!game) {
            console.error('Game data is missing.');
            return;
        }

        // Update game details
        document.getElementById('game-title').textContent = game.game_name || 'Unknown';
        document.getElementById('buy-game-title').textContent = `Buy ${game.game_name}`;
        document.getElementById('game-thumbnail').src = game.avt || '';
        document.getElementById('release-date').textContent = game.release_date || 'Unknown';
        document.getElementById('publisher').textContent = game.publisher || 'Unknown';

        // Genres
        const genresContainer = document.getElementById('genres');
        genresContainer.innerHTML = '';
        game.genre.split(',').forEach(genre => {
            const genreLink = document.createElement('a');
            genreLink.href = `/app/views/store/category.php?category=${encodeURIComponent(genre.trim())}`;
            genreLink.textContent = genre.trim();
            genreLink.classList.add('genre-link');
            genresContainer.appendChild(genreLink);

            const separator = document.createElement('span');
            separator.textContent = ' | ';
            genresContainer.appendChild(separator);
        });

        // Prices and Discounts
        const discountBadge = document.getElementById('discount-badge');
        const discountPercentage = document.getElementById('discount-percentage');
        const originalPrice = document.getElementById('original-price');
        const finalPrice = document.getElementById('final-price');

        if (game.discount && parseFloat(game.discount) > 0) {
            discountPercentage.textContent = game.discount;
            discountBadge.classList.remove('d-none');
            originalPrice.textContent = `${game.price} coins`;
            finalPrice.textContent = `${(parseFloat(game.price) - parseFloat(game.discount)).toFixed(2)} coins`;
        } else {
            discountBadge.classList.add('d-none');
            originalPrice.textContent = '';
            finalPrice.textContent = `${game.price} coins`;
        }

        // Add to Cart / Download
        const addToCartButton = document.getElementById('add-to-cart-btn');
        if ((user['game-own'].includes(game.id) || game.is_free) && user.role === 'User') {
            addToCartButton.textContent = 'Download Now';
            addToCartButton.classList.replace('btn-success', 'btn-primary');
        } else {
            addToCartButton.textContent = 'Add to Cart';
            addToCartButton.addEventListener('click', () => {
                if (user.role === 'Guest') {
                    showLoginAlert('addToCart');
                    return;
                }
                addToCart(user.id, game.id);
            });
        }

        // Introduction and Description
        document.getElementById('game-introduction').textContent = game.introduction || 'Introduction not available.';
        document.getElementById('about-game').textContent = game.description || 'Description not available.';

        // System Requirements
        populateSystemRequirements({
            minimum: {
                OS: game.minOS,
                Processor: game.minProcessor,
                Memory: game.minMemory,
                Graphics: game.minGraphics,
                Storage: game.minStorage,
            },
            recommended: {
                OS: game.recOS,
                Processor: game.recProcessor,
                Memory: game.recMemory,
                Graphics: game.recGraphics,
                Storage: game.recStorage,
            },
        });
    }

    function populateSystemRequirements(systemReq) {
        const minReq = document.getElementById('minimum-req');
        const recReq = document.getElementById('recommended-req');

        minReq.innerHTML = '';
        recReq.innerHTML = '';

        Object.entries(systemReq.minimum || {}).forEach(([key, value]) => {
            minReq.innerHTML += `<li><strong>${key}:</strong> ${value || 'N/A'}</li>`;
        });

        Object.entries(systemReq.recommended || {}).forEach(([key, value]) => {
            recReq.innerHTML += `<li><strong>${key}:</strong> ${value || 'N/A'}</li>`;
        });
    }

    function getUser() {
        // Simulate fetching user data
        return {
            id: 1,
            role: 'User',
            'game-own': [2], // Example owned games
        };
    }

    function addToCart(userId, gameId) {
        fetch('/../test_api/games_api/add_to_cart.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ user_id: userId, game_id: gameId }),
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Game added to cart successfully!');
                } else {
                    alert('Failed to add game to cart.');
                }
            })
            .catch(error => console.error('Error adding game to cart:', error));
    }

    function showLoginAlert(action) {
        alert(`Please log in to ${action}`);
    }
});


// Handle Like/Dislike Logic
function handleLikeDislike(user, gameId, review, action, likeBtn, dislikeBtn) {
    if (user.role === 'guest') {
        showLoginAlert('like');
        return;
    }

    const isLike = action === 'like';
    const oppositeAction = isLike ? 'dislike' : 'like';
    const targetBtn = isLike ? likeBtn : dislikeBtn;
    const oppositeBtn = isLike ? dislikeBtn : likeBtn;
    const targetCount = targetBtn.querySelector(isLike ? '.like-count' : '.dislike-count');
    const oppositeCount = oppositeBtn.querySelector(isLike ? '.dislike-count' : '.like-count');

    const currentCount = parseInt(targetCount.textContent, 10);
    const oppositeCurrentCount = parseInt(oppositeCount.textContent, 10);

    const isActive = targetBtn.classList.contains('active');
    const oppositeActive = oppositeBtn.classList.contains('active');

    // Update UI
    if (isActive) {
        targetBtn.classList.remove('active');
        targetCount.textContent = currentCount - 1;
    } else {
        targetBtn.classList.add('active');
        targetCount.textContent = currentCount + 1;

        if (oppositeActive) {
            oppositeBtn.classList.remove('active');
            oppositeCount.textContent = oppositeCurrentCount - 1;
        }
    }

    // Call API
    fetch('/../test_api/games_api/update_like_dislike.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({
            game_id: gameId,
            review_id: review.id,
            user_id: user.id,
            action,
        }),
    })
        .then((response) => response.json())
        .then((data) => {
            if (!data.success) {
                alert('Failed to update like/dislike.');
            }
        })
        .catch((error) => console.error('Error updating like/dislike:', error));
}


function setupAdminReviewButtons(game) {
    // Toggle visibility
    document.querySelectorAll('.toggle-visibility-btn').forEach((button) => {
        button.addEventListener('click', (e) => {
            const reviewIndex = e.target.getAttribute('data-id'); // Review index in the JSON array
            const gameId = game.id; // Pass game ID from argument
            const currentShow = e.target.getAttribute('data-show') === 'true'; // Current visibility status
            const newShow = !currentShow; // Toggle visibility status

            // Send toggle visibility request to the backend
            fetch('/../test_api/games_api/update_review_visibility.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({
                    game_id: gameId,
                    review_index: reviewIndex, // Index of the review in the reviews array
                    show: newShow // New visibility status
                }),
            })
                .then((response) => response.json())
                .then((data) => {
                    if (data.success) {
                        // Update the UI
                        e.target.textContent = newShow ? 'Hide' : 'Unhide';
                        e.target.setAttribute('data-show', newShow);
                        const reviewElement = e.target.closest('.review');
                        if (newShow) {
                            reviewElement.classList.remove('blurred');
                        } else {
                            reviewElement.classList.add('blurred');
                        }
                    } else {
                        alert('Failed to update visibility.');
                    }
                })
                .catch((error) =>
                    console.error('Error updating visibility:', error)
                );
        });
    });

    // Delete review
    document.querySelectorAll('.delete-review-btn').forEach((button) => {
        button.addEventListener('click', (e) => {
            const reviewIndex = e.target.getAttribute('data-id'); // Review index in the JSON array
            const gameId = game.id; // Pass game ID from argument

            if (!confirm('Are you sure you want to delete this review?')) return;

            // Send delete request to the backend
            fetch('/../test_api/games_api/test_api/delete_review.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({
                    game_id: gameId, // Game ID to identify the game
                    review_index: reviewIndex // Index of the review to delete
                }),
            })
                .then((response) => response.json())
                .then((data) => {
                    if (data.success) {
                        // Remove the review from the DOM
                        e.target.closest('.review').remove();
                    } else {
                        alert('Failed to delete review.');
                    }
                })
                .catch((error) =>
                    console.error('Error deleting review:', error)
                );
        });
    });
}

// Show login alert modal for guests
function showLoginAlert(action) {
    const modalTitle = document.getElementById('loginModalLabel');
    const modalBody = document.getElementById('loginModalBody');
    
    // Update content based on the action
    if (action === 'addToCart') {
        modalTitle.textContent = 'Sign In Required';
        modalBody.innerHTML = '<p>Please sign in to buy the game.</p>';
    } else if (action === 'review') {
        modalTitle.textContent = 'Sign In Required';
        modalBody.innerHTML = '<p>Please sign in to leave a review.</p>';
    } 
    // Show the modal
    const modal = new bootstrap.Modal(document.getElementById('loginModal'));
    modal.show();
}


// Star rating system
// Star rating system and Review Submission
document.addEventListener('DOMContentLoaded', () => {
    // Initialize the star rating system
    const starRatingContainer = document.getElementById('star-rating');
    const ratingInput = document.getElementById('rating');
    const reviewForm = document.getElementById('reviewForm');
    const messageInput = document.getElementById('message');
    const gameId = document.getElementById('game_id').value; // Hidden input for game ID

    if (starRatingContainer && ratingInput) {
        const totalStars = 5;

        // Create stars dynamically
        for (let i = 1; i <= totalStars; i++) {
            const star = document.createElement('span');
            star.classList.add('star');
            star.setAttribute('data-value', i);
            star.innerHTML = '★'; // Solid star
            starRatingContainer.appendChild(star);

            // Add hover and click event listeners
            star.addEventListener('mouseover', () => highlightStars(i));
            star.addEventListener('mouseout', resetStars);
            star.addEventListener('click', () => selectRating(i));
        }
    }

    // Highlight stars on hover
    function highlightStars(count) {
        const stars = starRatingContainer.querySelectorAll('.star');
        stars.forEach((star, index) => {
            star.style.color = index < count ? '#ffc107' : '#333'; // Yellow for hovered stars
        });
    }

    // Reset stars when not hovering
    function resetStars() {
        const selectedRating = parseInt(ratingInput.value, 10);
        const stars = starRatingContainer.querySelectorAll('.star');
        stars.forEach((star, index) => {
            star.style.color = index < selectedRating ? '#ffc107' : '#333'; // Yellow for selected, black for unselected
        });
    }

    // Select a rating
    function selectRating(count) {
        ratingInput.value = count; // Set the selected rating value
        highlightStars(count); // Persist the selection visually
    }

    // Handle review submission
    if (reviewForm) {
        reviewForm.addEventListener('submit', (e) => {
            e.preventDefault(); // Prevent form submission
            const rating = parseInt(ratingInput.value, 10);
            const message = messageInput.value.trim();

            if (!rating) {
                alert('Please select a star rating!');
                return;
            }

            const defaultMessages = {
                5: 'Very Good!',
                4: 'Good',
                3: 'Average',
                2: 'Poor',
                1: 'Very Bad!!!',
            };

            const reviewMessage = message || defaultMessages[rating];

            // Send data to the backend
            fetch('/../test_api/games_api/submit_review.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({
                    game_id: gameId,
                    rating,
                    message: reviewMessage,
                }),
            })
                .then((response) => response.json())
                .then((data) => {
                    if (data.success) {
                        alert('Review submitted successfully!');
                        location.reload(); // Reload the page to show the new review
                    } else {
                        alert('Failed to submit review. Please try again.');
                    }
                })
                .catch((error) => console.error('Error submitting review:', error));
        });
    }
});
