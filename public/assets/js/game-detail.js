document.addEventListener("DOMContentLoaded", function () {
    const thumbnails = document.querySelectorAll(".thumbnail");
    const mainDisplay = document.getElementById("mainDisplay");
    const imageDisplay = document.getElementById("imageDisplay");
    const videoSource = document.getElementById("videoSource");

    thumbnails.forEach(thumbnail => {
        thumbnail.addEventListener("click", function () {
            const type = this.getAttribute("data-type");
            if (type === "image") {
                // Display image
                mainDisplay.style.display = "none";
                imageDisplay.style.display = "block";
                imageDisplay.src = this.src;
            } else if (type === "video") {
                // Display video
                imageDisplay.style.display = "none";
                mainDisplay.style.display = "block";
                videoSource.src = this.getAttribute("data-src");
                mainDisplay.load(); // Reload the video source
                mainDisplay.play(); // Auto-play the video
            }
        });
    });
});


document.addEventListener("DOMContentLoaded", function () {
    const modal = new bootstrap.Modal(document.getElementById("loginModal"));

    // Check for buttons with the 'data-bs-toggle' and trigger modal
    document.querySelectorAll("[data-bs-toggle='modal']").forEach(button => {
        button.addEventListener("click", function (event) {
            modal.show();
        });
    });
});

document.addEventListener("DOMContentLoaded", function () {
    // Handle Like/Dislike toggling
    document.querySelectorAll(".like-btn, .dislike-btn").forEach((button) => {
        let toggled = false; // Track if the button has been toggled

        button.addEventListener("click", function () {
            const reviewId = this.getAttribute("data-review-id");
            const action = this.classList.contains("like-btn") ? "likes" : "dislikes";

            // Determine if the count should increase or decrease
            const updateAction = toggled ? "decrease" : "increase";

            fetch("/api/like_dislike.php", {
                method: "POST",
                headers: { "Content-Type": "application/x-www-form-urlencoded" },
                body: `review_id=${reviewId}&action=${action}&update_action=${updateAction}`,
            })
                .then((response) => response.json())
                .then((data) => {
                    if (data.success) {
                        const countSpan = this.textContent.match(/\d+/)[0];
                        const newCount = toggled
                            ? parseInt(countSpan) - 1
                            : parseInt(countSpan) + 1;

                        this.textContent = this.textContent.replace(/\d+/, newCount);
                        toggled = !toggled; // Toggle the state
                    } else {
                        alert(data.message || "Failed to update like/dislike.");
                    }
                })
                .catch((err) => console.error(err));
        });
    });
});


document.querySelectorAll(".comment-form").forEach((form) => {
    form.addEventListener("submit", function (e) {
        e.preventDefault();

        const userId = this.getAttribute("data-user-id"); // Get user ID from form attribute
        const gameId = this.querySelector("#game_id").value; // Get game ID from hidden input
        const reviewId = this.getAttribute("data-review-id"); // Get review ID if applicable
        const message = this.querySelector("textarea").value;
        const rating = this.querySelector("#rating").value;

        if (message.trim() && rating) {
            fetch("/api/add_comment.php", {
                method: "POST",
                headers: { "Content-Type": "application/x-www-form-urlencoded" },
                body: `user_id=${userId}&game_id=${gameId}&review_id=${reviewId}&message=${encodeURIComponent(message)}&rating=${rating}`,
            })
                .then((response) => response.json())
                .then((data) => {
                    if (data.success) {
                        const commentSection = this.closest(".review").querySelector(".comments");
                        const newComment = document.createElement("div");
                        newComment.className = "comment mb-2";
                        newComment.innerHTML = `
                            <strong>${data.username || "You"}:</strong> ${message}
                            <span class="text-warning">
                                ${"⭐".repeat(rating)}
                            </span>
                        `;
                        commentSection.appendChild(newComment);
                        this.querySelector("textarea").value = "";
                        this.querySelector("#rating").value = "";
                    } else {
                        alert(data.message || "Failed to add comment.");
                    }
                })
                .catch((err) => console.error(err));
        } else {
            alert("Comment and rating cannot be empty.");
        }
    });
});



document.addEventListener("DOMContentLoaded", function () {
    const reviewForm = document.getElementById("reviewForm");
    const reviewsContainer = document.querySelector(".reviews-container");

    reviewForm.addEventListener("submit", function (e) {
        e.preventDefault();

        const gameId = document.getElementById("game_id").value;
        const rating = document.getElementById("rating").value;
        const message = document.getElementById("message").value;

        fetch("/api/submit_review.php", {
            method: "POST",
            headers: { "Content-Type": "application/x-www-form-urlencoded" },
            body: `game_id=${gameId}&rating=${rating}&message=${encodeURIComponent(message)}`,
        })
            .then((response) => response.json())
            .then((data) => {
                if (data.success) {
                    const newReview = `
                        <div class="review mb-4">
                            <div class="d-flex align-items-center mb-2">
                                <img src="${data.review.avatar}" alt="Avatar" class="rounded-circle" width="50">
                                <div class="ms-3">
                                    <h5 class="mb-0">${data.review.username}</h5>
                                    <span class="text-warning">
                                        ${"⭐".repeat(data.review.rating)}
                                    </span>
                                </div>
                            </div>
                            <p class="mb-2">${data.review.message}</p>
                            <div class="d-flex gap-3 mt-2">
                                <button class="btn btn-sm btn-outline-success">👍 0</button>
                                <button class="btn btn-sm btn-outline-danger">👎 0</button>
                            </div>
                        </div>`;
                    reviewsContainer.innerHTML += newReview;
                    reviewForm.reset(); 
                } else {
                    alert(data.message || "Failed to submit the review.");
                }
            })
            .catch((err) => console.error("Error:", err));
    });
});

document.querySelectorAll(".hide-btn").forEach((button) => {
    button.addEventListener("click", function () {
        const messageId = this.getAttribute("data-message-id"); // Message id is random from back-end. When the message sent, it will random their idMessage
        const action = this.textContent.trim() === "Hide" ? "hide" : "unhide";

        fetch("/api/hide_message.php", {
            method: "POST",
            headers: { "Content-Type": "application/x-www-form-urlencoded" },
            body: `message_id=${messageId}&action=${action}`,
        })
            .then((response) => response.json())
            .then((data) => {
                if (data.success) {
                    this.textContent = action === "hide" ? "Unhide" : "Hide";
                } else {
                    alert(data.message || "Failed to update the message visibility.");
                }
            })
            .catch((err) => console.error("Error:", err));
    });
});

document.addEventListener("DOMContentLoaded", function () {
    const addToCartButton = document.querySelector(".add-to-cart-btn");

    addToCartButton.addEventListener("click", function () {
        const userId = this.getAttribute("data-user-id");
        const gameId = this.getAttribute("data-game-id");
        const price = this.getAttribute("data-price");

        if (!userId) {
            alert("Please log in to add items to your cart.");
            return;
        }

        fetch("/api/add_to_cart.php", {
            method: "POST",
            headers: { "Content-Type": "application/x-www-form-urlencoded" },
            body: `user_id=${userId}&game_id=${gameId}&price=${price}`,
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert("Item added to cart successfully!");
            } else {
                alert(data.message || "Failed to add item to cart.");
            }
        })
        .catch(error => console.error("Error:", error));
    });
});
