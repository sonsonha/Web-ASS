document.addEventListener('DOMContentLoaded', () => {
    const userId = '1'; // Example user ID (replace with actual logic)

    // const urlParams = new URLSearchParams(window.location.search);
    // const gameId = urlParams.get('id'); // Retrieve the id from the query string

    // const pathParts = window.location.pathname.split('/');
    // const gameId = pathParts[pathParts.length - 2];

    console.log('Game ID:', gameId);

    if (!gameId) {
        console.error('No game ID provided in the URL.');
        return;
    }

    if (!userId) {
        console.error('No user ID found.');
        return;
    }

    // Fetch game details and user information
    fetch('/../test_api/games_api/fetch_game_details.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ user_id: userId, game_id: gameId }),
    })
        .then((response) => {
            if (!response.ok) throw new Error(`HTTP error! Status: ${response.status}`);
            return response.json();
        })
        .then((data) => {
            const { game, reviews, user } = data;
            populateGameDetails(game, user);
            populateReviews(reviews, user, game);
            setupReviewSection(game, user);
            setupThumbnails(gameID);
            fetchPopularArticles(user);
        })
        .catch((error) => console.error('Error fetching game details:', error));
    
        // Function to fetch and display the thumbnails
        function setupThumbnails(gameId) {

            // Fetch the thumbnails data
            fetch('/../api/get_thumbnails.php', {
                method: 'POST',
                headers: { 'content-Type': 'application/json' },
                body: JSON.stringify({ game_id: gameId })
            })
            .then((response) => {
                if (!response.ok) throw new Error('Failed to fetch thumbnails');
                return response.json();
            })
            .then((data) => {
                if (data.status === 'success' && data.data) {
                    const thumbnailsContainer = document.getElementById('thumbnails');
                }
            })
            const thumbnailsContainer = document.getElementById('thumbnails');
            const mainDisplayImage = document.getElementById('imageDisplay');
            const iframeContainer = document.getElementById('videoIframeContainer'); // Container for YouTube iframe
        
            let currentIndex = 0;
            let autoSlideTimeout;
            let videoPlaying = false; // To track if the video is playing
            let videoIframe = null; // To store the iframe element
        
            // Populate thumbnails
            thumbnails.forEach((thumbnail, index) => {
                const thumbnailElement = document.createElement('div');
                thumbnailElement.className = 'thumbnail';
                thumbnailElement.dataset.index = index;
        
                if (thumbnail.type === 'image') {
                    const img = document.createElement('img');
                    img.src = thumbnail.src;
                    thumbnailElement.appendChild(img);
                } else if (thumbnail.type === 'video') {
                    // YouTube video thumbnail (use the thumbnail image for YouTube)
                    const img = document.createElement('img');
                    img.src = `https://img.youtube.com/vi/${getYouTubeVideoId(thumbnail.src)}/0.jpg`;
                    thumbnailElement.appendChild(img);
                }
        
                // Click event for thumbnails
                thumbnailElement.addEventListener('click', () => {
                    currentIndex = index; // Update index for clicked thumbnail
                    clearTimeout(autoSlideTimeout); // Pause auto-slide
                    displayMedia(index, thumbnails, false);
                    startAutoSlide(); // Resume auto-slide after interaction
                });
        
                thumbnailsContainer.appendChild(thumbnailElement);
            });
        
            // Display selected media
            function displayMedia(index, thumbnails, auto = false) {
                const selectedThumbnail = thumbnails[index];
        
                if (selectedThumbnail.type === 'image') {
                    // Hide video and show image
                    iframeContainer.style.display = 'none';
                    mainDisplayImage.style.display = 'block';
                    mainDisplayImage.src = selectedThumbnail.src;
                    if (auto) scheduleNextSlide(5000); // Wait 5 seconds for images
                } else if (selectedThumbnail.type === 'video') {
                    // Hide image and show YouTube video iframe
                    mainDisplayImage.style.display = 'none';
                    iframeContainer.style.display = 'block';
        
                    const youtubeId = getYouTubeVideoId(selectedThumbnail.src);
                    videoIframe = document.createElement('iframe');
                    videoIframe.src = `https://www.youtube.com/embed/${youtubeId}?autoplay=0&mute=1`; // Mute initially to comply with autoplay policies
                    videoIframe.frameBorder = "0";
                    videoIframe.allow = "accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture";
                    videoIframe.allowFullscreen = true;
        
                    iframeContainer.innerHTML = ''; // Clear any previous iframe
                    iframeContainer.appendChild(videoIframe);
        
                    // Handle video play/pause behavior
                    videoIframe.addEventListener('click', () => {
                        if (!videoPlaying) {
                            videoIframe.src = `https://www.youtube.com/embed/${youtubeId}?autoplay=1`; // Play video on click
                            videoPlaying = true;
                            pauseAutoSlide(); // Pause auto-slide when video is playing
                        } else {
                            videoIframe.src = `https://www.youtube.com/embed/${youtubeId}?autoplay=0`; // Pause video on click
                            videoPlaying = false;
                            resumeAutoSlide(); // Resume auto-slide when video is paused
                        }
                    });
        
                    // Ensure auto-slide waits for video to finish or pause
                    videoIframe.onload = function() {
                        // Watch for video end or pause
                        videoIframe.contentWindow.addEventListener('pause', () => {
                            videoPlaying = false;
                            resumeAutoSlide(); // Resume auto-slide when paused
                        });
        
                        videoIframe.contentWindow.addEventListener('ended', () => {
                            videoPlaying = false;
                            resumeAutoSlide(); // Resume auto-slide when video ends
                        });
                    };
                }
            }
        
            // Pause auto-slide
            function pauseAutoSlide() {
                clearTimeout(autoSlideTimeout); // Stop the auto-slide
            }
        
            // Resume auto-slide
            function resumeAutoSlide() {
                scheduleNextSlide(5000); // Continue with auto-slide
            }
        
            // Schedule the next slide
            function scheduleNextSlide(delay = 0) {
                clearTimeout(autoSlideTimeout);
                autoSlideTimeout = setTimeout(() => {
                    currentIndex = (currentIndex + 1) % thumbnails.length;
                    displayMedia(currentIndex, thumbnails, true);
                }, delay);
            }
        
            // Auto-slide function
            function startAutoSlide() {
                displayMedia(currentIndex, thumbnails, true);
            }
        
            // Start auto-slide
            startAutoSlide();
        
            // Utility function to extract YouTube video ID from the URL
            function getYouTubeVideoId(url) {
                const regExp = /^https?:\/\/(?:www\.)?(?:youtube\.com\/(?:[^\/\n\s]+\/\S+\/|(?:v|e(?:mbed)?)\/|\S*?[?&]v=)|youtu\.be\/)([a-zA-Z0-9_-]{11})$/;
                const match = url.match(regExp);
                return match && match[1];
            }
        }
});

function fetchPopularArticles (user) {
    // Fetch the articles data
    fetch('/../test_api/games_api/fetch_popular_articles.php')
    .then(response => {
        if (!response.ok) {
            throw new Error(`HTTP error! Status: ${response.status}`);
        }
        return response.json(); // Parse the response as JSON
    })
    .then(data => {
        // Check if data is an array
        if (Array.isArray(data)) {
            console.log('Fetched Articles:', data); // Log the fetched data
            const articlesContainer = document.getElementById('popular-articles');
            // Loop through each article and create a card
            data.forEach(article => {   
                const articleCard = document.createElement('div');
                articleCard.classList.add('card', 'mb-3');
                articleCard.style.width = '18rem'; // Adjust the size of the card

                articleCard.innerHTML = `
                    <img src="${article.image}" class="card-img-top" alt="${article.title}">
                    <div class="card-body">
                        <h5 class="card-title">${article.title}</h5>
                        <p class="card-text">${article.description}</p>
                        <a href="${article.link}" class="btn btn-primary" target="_blank">Read More</a>
                    </div>
                `;

                // Add the card to the container
                articlesContainer.appendChild(articleCard);
                // Add click event for the edit button (only for Admin)
                if (user.role === 'Admin') {
                    const toggleButton = document.createElement('button');
                    toggleButton.className = `btn btn-outline-info edit-article-btn`;
                    toggleButton.textContent = 'Edit Article';
                    articleCard.appendChild(toggleButton);
                    const editBtn = articleCard.querySelector('.edit-article-btn'); 
                    editBtn.addEventListener('click', () => {
                        openEditModal(article); // Open the modal with the article's data
                });
        }
            });
        } else {
            console.error('Expected an array, but got:', data);
        }
    })
    .catch(error => {
        console.error('Error fetching articles:', error);
    });
}

function openEditModal(article) {
    // Populate the modal with article data
    document.getElementById('editImage').value = article.image;
    document.getElementById('editTitle').value = article.title;
    document.getElementById('editDescription').value = article.description;

    // Store the article ID for updating
    const editArticleForm = document.getElementById('editArticleForm');
    editArticleForm.onsubmit = function (e) {
        e.preventDefault();

        const updatedArticle = {
            id: article.id,
            image: document.getElementById('editImage').value,
            title: document.getElementById('editTitle').value,
            description: document.getElementById('editDescription').value
        };

        // Send the updated data to the back-end
        fetch('/../test_api/games_api/update_article.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(updatedArticle)
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Article updated successfully!');
                location.reload(); // Reload the page to reflect changes
            } else {
                alert('Failed to update the article.');
            }
        })
        .catch(error => console.error('Error updating article:', error));
    };

    // Show the modal
    new bootstrap.Modal(document.getElementById('editArticleModal')).show();
}

function populateGameDetails(game, user) {
    if (!game) {
        console.error('Game data is missing.');
        return;
    }

    // Update the breadcrumb and game title
    document.querySelector('.breadcrumb-item.active').textContent = game.title;
    document.getElementById('game-title').textContent = game.title || 'Unknown';
    document.getElementById('buy-game-title').textContent = `Buy ${game.title}`;

    document.getElementById('game-thumbnail').src = game.background_image || '';
    document.getElementById('release-date').textContent = game.release_date || 'Unknown';
    document.getElementById('publisher').textContent = game.publisher || 'Unknown';

    // Update genres - make genres clickable
    const genresContainer = document.getElementById('genres');
    genresContainer.innerHTML = ''; // Clear any existing genres
    game.genres.forEach(genre => {
        const genreLink = document.createElement('a');
        genreLink.href = `/app/views/store/category.php?category=${encodeURIComponent(genre)}`;  // Link to the category page
        genreLink.textContent = genre;
        genreLink.classList.add('genre-link');
        genresContainer.appendChild(genreLink);
        
        // Optionally, add spacing between genre links
        const separator = document.createElement('span');
        separator.textContent = ' | ';
        genresContainer.appendChild(separator);
    });

    // Discount badge logic
    const discountBadge = document.getElementById('discount-badge');
    const discountPercentage = document.getElementById('discount-percentage');
    
    const originalPrice = document.getElementById('original-price');
    const finalPrice = document.getElementById('final-price');

    if (game.discount) {
        discountPercentage.textContent = game.discount;
        discountBadge.classList.remove('d-none');
        originalPrice.textContent = `${game.original_price} coins`;
        if (!user['game-own'].includes(game.id)) {
            finalPrice.textContent = `${game.price} coins`; // Show price in coins
        }
        else {
            finalPrice.textContent = user.role == 'user' ? 'Owned' : `${game.price} coins`; // Show price in coins
        }
    } else {
        discountBadge.classList.add('d-none');
        originalPrice.textContent = ''; // Hide original price if no discount
        finalPrice.textContent = `${game.price} coins`; // Show price in coins
    }

    // Add to Cart or download button logic
    const addToCartButton = document.getElementById('add-to-cart-btn');
    if ((user['game-own'].includes(game.id) || game.is_free) && user.role === 'user') {
        addToCartButton.textContent = `Download Now`;
        addToCartButton.classList.replace('btn-success', 'btn-primary');
        // addToCartButton.addEventListener('click', () => {
        //     window.location.href = `/app/views/games/test_api/download.php?game_id=${game.id}`;
        // });
    } else {
        addToCartButton.textContent = 'Add to Cart';
        addToCartButton.addEventListener('click', () => {
            if (user.role === 'guest') {
                showLoginAlert('addToCart'); // Show login modal
                return;
            }
            addToCart(userId, game.id);
        });
    }

    // Update introduction and about sections
    document.getElementById('game-introduction').textContent = game.introduction || 'Introduction not available.';
    document.getElementById('about-game').textContent = game.about || 'Description not available.';

    // Populate system requirements
    const systemReq = game.system_requirements || {};
    populateSystemRequirements(systemReq);
}

function addToCart(userId, gameId) {
    fetch('/../test_api/games_api/add_to_cart.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ user_id: userId, game_id: gameId }),
    })
        .then((response) => response.json())
        .then((data) => {
            if (data.success) {
                alert('Game added to cart successfully!');
            } else {
                alert('Failed to add game to cart.');
            }
        })
        .catch((error) => console.error('Error adding game to cart:', error));
}

// Set up the review section based on user role and game ownership
function setupReviewSection(game, user) {
    const reviewFormSection = document.getElementById('review-form-section');
    const reviewsSection = document.getElementById('reviews-section');
    // const noReviewsMessage = document.getElementById('no-reviews-message');

    // Admin Role
    if (user.role === 'Admin') {
        reviewFormSection.style.display = 'none'; // Hide review form
        const toggleButton = document.createElement('button');
        const hiddenClass = game.enable_comments ? 'btn-danger' : 'btn-success';
        toggleButton.className = `btn ${hiddenClass}`;
        toggleButton.textContent = game.enable_comments ? 'Disable Comments' : 'Enable Comments';
        reviewsSection.appendChild(toggleButton);

        // Handle comment toggle (placeholder logic)
        toggleButton.addEventListener('click', () => {
            fetch('/../test_api/games_api/toggle_comments.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ game_id: game.id, enable_comments: !game.enable_comments})
            })
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
            showLoginAlert('review'); // Show login modal
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
function populateReviews(reviews, user, game) {
    const reviewsContainer = document.getElementById('reviews-container');
    reviewsContainer.innerHTML = '';

    if (!reviews || reviews.length === 0) {
        reviewsContainer.innerHTML = '<p>No reviews yet. Be the first to review!</p>';
        return;
    }

    reviews.forEach((review, index) => {
        const hiddenClass = !review.show ? 'blurred' : ''; 

        const reviewHTML = user.role === 'Admin' || review.show ? `
            <div class="review mb-4 ${hiddenClass}">
                <div class="d-flex align-items-start">
                    <img src="${review.avatar}" alt="${review.username}" class="rounded-circle me-3" width="50">
                    <div class="ms-3">
                        <div class="review-username">${review.username}</div>
                        <span class="text-warning">${'⭐'.repeat(review.rating)}</span>
                        <div class="review-message">${review.message}</div>

                        <div class="d-flex mt-2">
                            <button class="btn btn-sm like-btn ${review.userLiked ? 'active' : ''}" data-review-index="${index}" data-action="like">
                                👍 <span class="like-count text-white">${review.likes || 0}</span>
                            </button>
                            <button class="btn btn-sm dislike-btn ${review.userDisliked ? 'active' : ''}" data-review-index="${index}" data-action="dislike">
                                👎 <span class="dislike-count text-white">${review.dislikes || 0}</span>
                            </button>
                        </div>

                        <!-- Admin controls on reviews -->
                        ${user.role === 'Admin' ? `
                        <div class="d-flex mt-2">
                            <button class="btn btn-sm btn-outline-primary toggle-visibility-btn" data-id="${review.id}" data-show="${review.show}">${review.show ? 'Hide' : 'Unhide'}</button>
                            <button class="btn btn-sm btn-outline-danger delete-review-btn" data-id="${review.id}">Delete</button>
                        </div>` : ``}
                    </div>
                </div>
            </div>
        ` : '';

        const reviewElement = document.createElement('div');
        reviewElement.innerHTML = reviewHTML;
        reviewsContainer.appendChild(reviewElement);

        // Like/Dislike Event Listeners
        const likeBtn = reviewElement.querySelector('.like-btn');
        const dislikeBtn = reviewElement.querySelector('.dislike-btn');

        if (likeBtn) {
            likeBtn.addEventListener('click', () => handleLikeDislike(user, game.id, review, 'like', likeBtn, dislikeBtn));
        }
        if (dislikeBtn) {
            dislikeBtn.addEventListener('click', () => handleLikeDislike(user, game.id, review, 'dislike', likeBtn, dislikeBtn));
        }
    });

    document.getElementById('game-price').textContent = game.price || 'Unknown';
    document.getElementById('release-date').textContent = game.release_date || 'Unknown';
    document.getElementById('reviews-count').textContent = `${game.rating}/5⭐` || 'N/A'; // Add average rating
}

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
