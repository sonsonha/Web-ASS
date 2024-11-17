const userId = '1'; // Example user ID
const gameId = 1;   // Example game ID

document.addEventListener('DOMContentLoaded', () => {
    fetch('fetch_game_details.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ user_id: userId, game_id: gameId })
    })
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! Status: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            console.log('Fetched Data:', data); // Debug the data
            const { game, reviews, user } = data;
            populateGameDetails(game);
            populateReviews(reviews, user);
            setupReviewSection(game, user);
        })
        .catch(error => console.error('Error fetching game details:', error));
});


// Set up the review section based on user role and game ownership
function setupReviewSection(game, user) {
    const reviewFormSection = document.getElementById('review-form-section');
    const reviewsSection = document.getElementById('reviews-section');
    const noReviewsMessage = document.getElementById('no-reviews-message');

    // Admin Role
    if (user.role === 'admin') {
        reviewFormSection.style.display = 'none'; // Hide review form
        const toggleButton = document.createElement('button');
        toggleButton.className = 'btn btn-danger';
        toggleButton.textContent = 'Enable/Disable Comments';
        reviewsSection.appendChild(toggleButton);

        // Handle comment toggle (placeholder logic)
        toggleButton.addEventListener('click', () => {
            // Add backend call to toggle comments
            alert('Toggle comments logic here.');
        });
        return;
    }

    // Check if comments are disabled
    if (!game.enable_comments) {
        reviewFormSection.innerHTML = '<p class="text-danger">The comments are disabled!</p>';
        return;
    }

    // Guest Role
    if (user.role === 'guest') {
        const submitButton = document.querySelector('#reviewForm button[type="submit"]');
        submitButton.addEventListener('click', (e) => {
            e.preventDefault();
            showLoginAlert(); // Show login modal
        });
        return;
    }

    // User Role
    if (user.role === 'user') {
        if (!user['game-own'].includes(game.id)) {
            // User doesn't own the game
            reviewFormSection.innerHTML = '<p class="text-warning">You must purchase the game to leave a review.</p>';
        }
    }
}

// Populate game details dynamically
function populateGameDetails(game) {
    if (!game) {
        console.error('Game data is missing.');
        return;
    }

    // Update title and breadcrumb
    document.querySelector('h1').textContent = game.title;
    document.querySelector('.breadcrumb-item.active').textContent = game.title;

    // Update pricing section
    const purchaseSection = document.querySelector('.purchase-section');
    if (purchaseSection) {
        purchaseSection.querySelector('h4').textContent = `Buy ${game.title}`;
        purchaseSection.querySelector('#discount-info').textContent = game.discount;
        purchaseSection.querySelector('#original-price').textContent = game.original_price;
        purchaseSection.querySelector('#final-price').textContent = game.price;
    }

    // Update introduction and about sections
    document.getElementById('game-introduction').textContent = game.introduction || 'Introduction not available.';
    document.getElementById('about-game').textContent = game.about || 'Description not available.';

    // Populate system requirements
    const systemReq = game.system_requirements || {};
    populateSystemRequirements(systemReq);
}

// Populate system requirements dynamically
function populateSystemRequirements(systemReq) {
    const minReq = document.getElementById('minimum-req');
    const recReq = document.getElementById('recommended-req');

    if (minReq) minReq.innerHTML = '';
    if (recReq) recReq.innerHTML = '';

    if (systemReq.minimum && minReq) {
        Object.entries(systemReq.minimum).forEach(([key, value]) => {
            minReq.innerHTML += `<li><strong>${key}:</strong> ${value}</li>`;
        });
    }

    if (systemReq.recommended && recReq) {
        Object.entries(systemReq.recommended).forEach(([key, value]) => {
            recReq.innerHTML += `<li><strong>${key}:</strong> ${value}</li>`;
        });
    }
}

// Populate reviews dynamically
function populateReviews(reviews, user) {
    const reviewsContainer = document.getElementById('reviews-container');
    reviewsContainer.innerHTML = '';

    if (!reviews || reviews.length === 0) {
        reviewsContainer.innerHTML = '<p>No reviews yet. Be the first to review!</p>';
        return;
    }

    reviews.forEach((review) => {
        // Add a class to blur hidden comments for admin
        const hiddenClass = !review.show ? 'blurred' : '';

        // Only show reviews disabled in admin role
        const reviewHTML = user.role === 'admin' || review.show ? ` 
            <div class="review mb-4 ${hiddenClass}">
                <div class="d-flex align-items-center mb-2">
                    <img src="${review.avatar}" alt="${review.username}" class="rounded-circle" width="50">
                    <div class="ms-3">
                        <h5>${review.username}</h5>
                        <span class="text-warning">${'⭐'.repeat(review.rating)}</span>
                    </div>
                </div>
                <p>${review.message}</p>
                ${user.role === 'admin' ? `
                    <div class="d-flex gap-2 mt-2">
                        <button class="btn btn-sm btn-outline-primary toggle-visibility-btn" data-id="${review.id}" data-show="${review.show}">
                            ${review.show ? 'Hide' : 'Unhide'}
                        </button>
                        <button class="btn btn-sm btn-outline-danger delete-review-btn" data-id="${review.id}">
                            Delete
                        </button>
                    </div>` : ''}
            </div>` : '';
        reviewsContainer.innerHTML += reviewHTML;
    });

    if (user.role === 'admin') {
        setupAdminReviewButtons(game); // Attach event listeners for admin actions
    }
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
            fetch('update_review_visibility.php', {
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
            fetch('delete_review.php', {
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
function showLoginAlert() {
    const modal = document.createElement('div');
    modal.className = 'modal fade';
    modal.innerHTML = `
        <div class="modal-dialog">
            <div class="modal-content bg-dark text-white">
                <div class="modal-header">
                    <h5 class="modal-title">Sign In Required</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Please sign in to take this action.</p>
                </div>
                <div class="modal-footer">
                    <a href="/login.php" class="btn btn-primary">Sign In</a>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>`;
    document.body.appendChild(modal);
    const modalInstance = new bootstrap.Modal(modal);
    modalInstance.show();
}
