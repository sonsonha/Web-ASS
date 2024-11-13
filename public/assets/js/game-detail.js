

document.addEventListener('DOMContentLoaded', () => {
    fetch('fetch_game_details.php') // Fetch game, reviews, and user data
        .then(response => response.json())
        .then(data => {
            const { game, reviews, user } = data;
            populateGameDetails(game);
            populateReviews(reviews);
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
        toggleButton.className = 'btn btn-warning';
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
    if (game.comments_disabled) {
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

// function populateGameDetails(game) {
//     if (!game) {
//         console.error('Game data is missing.');
//         return;
//     }
//     document.querySelector('h1').textContent = game.title;
//     document.querySelector('.breadcrumb-item.active').textContent = game.title;
//     document.getElementById('game-title').textContent = game.title;
//     document.getElementById('game-introduction').textContent = game.introduction || 'No introduction available.';
//     document.getElementById('about-game').textContent = game.about || 'No description available.';
//     document.getElementById('game-price').textContent = game.price || 'Unknown price';
// }

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
function populateReviews(reviews) {
    const reviewsContainer = document.getElementById('reviews-container');
    reviewsContainer.innerHTML = '';

    if (!reviews || reviews.length === 0) {
        reviewsContainer.innerHTML = '<p>No reviews yet. Be the first to review!</p>';
        return;
    }

    reviews.forEach((review) => {
        const reviewHTML = `
            <div class="review mb-4">
                <div class="d-flex align-items-center mb-2">
                    <img src="${review.avatar}" alt="${review.username}" class="rounded-circle" width="50">
                    <div class="ms-3">
                        <h5>${review.username}</h5>
                        <span class="text-warning">${'⭐'.repeat(review.rating)}</span>
                    </div>
                </div>
                <p>${review.message}</p>
            </div>`;
        reviewsContainer.innerHTML += reviewHTML;
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

// Fetch game data and reviews when the page loads
// document.addEventListener('DOMContentLoaded', () => {
//     fetch('fetch_game_details.php') // Replace with the correct endpoint
//         .then(response => {
//             if (!response.ok) {
//                 throw new Error(`HTTP error! Status: ${response.status}`);
//             }
//             return response.json();
//         })
//         .then(data => {
//             populateGameDetails(data.game);
//             populateReviews(data.reviews);
//             user
//         })
//         .catch(error => console.error('Error fetching game details:', error));
// });

// // Populate game details dynamically
// function populateGameDetails(game) {
//     if (!game) {
//         console.error('Game data is missing.');
//         return;
//     }

//     // Update title and breadcrumb
//     document.querySelector('h1').textContent = game.title;
//     document.querySelector('.breadcrumb-item.active').textContent = game.title;

//     // Update pricing section
//     const purchaseSection = document.querySelector('.purchase-section');
//     if (purchaseSection) {
//         purchaseSection.querySelector('h4').textContent = `Buy ${game.title}`;
//         purchaseSection.querySelector('#discount-info').textContent = game.discount;
//         purchaseSection.querySelector('#original-price').textContent = game.original_price;
//         purchaseSection.querySelector('#final-price').textContent = game.price;
//     }

//     // Update introduction and about sections
//     document.getElementById('game-introduction').textContent = game.introduction || 'Introduction not available.';
//     document.getElementById('about-game').textContent = game.about || 'Description not available.';

//     // Populate system requirements
//     const systemReq = game.system_requirements || {};
//     populateSystemRequirements(systemReq);
// }

// // Populate system requirements dynamically
// function populateSystemRequirements(systemReq) {
//     const minReq = document.getElementById('minimum-req');
//     const recReq = document.getElementById('recommended-req');

//     if (minReq) minReq.innerHTML = '';
//     if (recReq) recReq.innerHTML = '';

//     if (systemReq.minimum && minReq) {
//         Object.entries(systemReq.minimum).forEach(([key, value]) => {
//             minReq.innerHTML += `<li><strong>${key}:</strong> ${value}</li>`;
//         });
//     }

//     if (systemReq.recommended && recReq) {
//         Object.entries(systemReq.recommended).forEach(([key, value]) => {
//             recReq.innerHTML += `<li><strong>${key}:</strong> ${value}</li>`;
//         });
//     }
// }

// // Populate reviews dynamically
// function populateReviews(reviews) {
//     const reviewsContainer = document.getElementById('reviews-container');
//     if (!reviewsContainer) {
//         console.error('Element with id "reviews-container" not found.');
//         return;
//     }

//     // Clear existing reviews
//     reviewsContainer.innerHTML = '';

//     if (!reviews || reviews.length === 0) {
//         reviewsContainer.innerHTML = '<p>No reviews yet. Be the first to review!</p>';
//         return;
//     }

//     // Populate reviews
//     reviews.forEach(review => {
//         reviewsContainer.innerHTML += `
//             <div class="review mb-4">
//                 <div class="d-flex align-items-center mb-2">
//                     <img src="${review.avatar}" alt="${review.username}" class="rounded-circle" width="50">
//                     <div class="ms-3">
//                         <h5 class="mb-0">${review.username}</h5>
//                         <span class="text-warning">${'⭐'.repeat(review.rating)}</span>
//                     </div>
//                 </div>
//                 <p class="mb-2">${review.message}</p>
//                 <div class="d-flex gap-3 mt-2">
//                     <button class="btn btn-sm btn-outline-success">👍 ${review.likes}</button>
//                     <button class="btn btn-sm btn-outline-danger">👎 ${review.dislikes}</button>
//                 </div>
//             </div>`;
//     });
// }
