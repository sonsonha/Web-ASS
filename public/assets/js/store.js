document.addEventListener("DOMContentLoaded", async () => {
    const userId = localStorage.getItem('id');
    const role = localStorage.getItem('role') || 'Guest';

    if (typeof Swiper === 'undefined') {
        console.error("Swiper is not loaded.");
        return; // Exit early if Swiper is not defined
    }

    // Initialize Swiper Carousel
    const initSwiperCarousel = async () => {
        const swiperWrapper = document.getElementById("swiperWrapper");
        const thumbnails = document.getElementById("thumbnails");
    
        let games = [];
        try {
            const response = await fetch("/../api/get_carousels_game.php"); 
            const responseData = await response.json();
            
            console.log("Fetched game data:", responseData);
    
            if (!response.ok || responseData.status !== 'success') {
                throw new Error("Failed to fetch game data");
            }
    
            games = responseData.data; // Ensure you are accessing .data which is the array
    
            if (!Array.isArray(games)) {
                throw new Error("Data format error: Expected an array but got: " + typeof games);
            }
    
        } catch (error) {
            console.error("Error fetching game data:", error);
            return;
        }
    
        const topRatedGames = games.sort((a, b) => b.rating - a.rating).slice(0, 5);
    
        swiperWrapper.innerHTML = ""; // Clear existing slides
        thumbnails.innerHTML = ""; // Clear existing thumbnails
    
        topRatedGames.forEach((game, index) => {
            const slide = document.createElement("div");
            slide.className = "swiper-slide";
            slide.innerHTML = `
                <img src="${game.avt}" alt="${game.game_name}">
                <div class="carousel-caption gradient-bg p-3 rounded">
                    <h5 class="text-white">${game.game_name}</h5>
                    <p class="text-light">Rating: ${game.rating} | Discount: ${game.discount ? game.discount + "%" : "No Discount"} | <span class="text-white">${game.price} coins</span></p>
                    ${renderCarouselButtons(game, role)}
                </div>
            `;
            swiperWrapper.appendChild(slide);
    
            slide.addEventListener("click", () => {
                window.location.href = `/zerostress-game-store/${game.genres[0]}/${game.id}/${encodeURIComponent(game.game_name.replace(/ /g, "_"))}`;
            });
    
            const thumbnail = document.createElement("div");
            thumbnail.className = "thumbnail d-flex align-items-center gap-2";
            thumbnail.innerHTML = `
                <img src="${game.avt}" alt="${game.game_name}">
                <p class="text-white mb-0">${game.game_name}</p>
            `;
            thumbnails.appendChild(thumbnail);
    
            thumbnail.addEventListener("click", () => {
                swiper.slideTo(index); // Navigate to the corresponding slide
            });
        });
    
        const swiper = new Swiper("#gameSwiper", {
            loop: true,
            spaceBetween: 10,
            slidesPerView: 1,
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            autoplay: {
                delay: 5000,
            },
        });
    
        attachCarouselButtonListeners();
    };
    const renderCarouselButtons = (game, role) => {
        return role === 'Admin'
            ? `<button class="btn btn-warning edit-game" data-id="${game.id}">Edit Game</button>`
            : game.is_free
                ? `<button class="btn btn-info play-free" data-id="${game.id}">Play for Free</button>`
                : `<button class="btn btn-info buy-now" data-id="${game.id}">Buy Now</button>
                   <button class="btn btn-outline-light add-to-cart" data-id="${game.id}">Add to Cart</button>`;
    };

    const attachCarouselButtonListeners = () => {
        document.querySelectorAll(".add-to-cart").forEach((button) => {
            button.replaceWith(button.cloneNode(true)); // Xóa tất cả các event cũ
        });
    
        document.querySelectorAll(".buy-now").forEach((button) => {
            button.replaceWith(button.cloneNode(true)); // Xóa tất cả các event cũ
        });
    
        document.querySelectorAll(".add-to-cart").forEach((button) => {
            button.addEventListener("click", async (e) => {
                e.stopPropagation();
                const gameId = button.getAttribute("data-id");
                await handleAddToCart(gameId);
            });
        });
    
        document.querySelectorAll(".buy-now").forEach((button) => {
            button.addEventListener("click", async (e) => {
                e.stopPropagation();
                const gameId = button.getAttribute("data-id");
                const userId = localStorage.getItem("id");
                const requestBody = {
                    account_id: parseInt(userId),
                    game_ids: [parseInt(gameId)],
                };
                await handleBuyNow(requestBody);
            });
        });
    };
    

    // Function to handle actions for cart and purchase
    const handleAddToCart = async (userId, gameId) => {
        try {
            const response = await fetch("/../api/buy_game.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify({
                    account_id: userId,
                    game_id: gameId
                }),
            });
            const data = await response.json();
    
            if (data.status === 'success') {
                alert('Game added to cart successfully!');
            } else {
                alert('Failed to add game to cart.');   
            }
        } catch (error) {
            console.error("Error adding game to cart:", error);
        }
    };

        // Function to handle actions for cart and purchase
        const handleBuyNow = async (requestBody) => {
            try {
                const response = await fetch("/../api/buy_game.php", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                    },
                    body: JSON.stringify(requestBody), // Send the correct data structure
                });
    
                console.log('requestBody:', requestBody);
    
                const data = await response.json();
    
                if (data.status === "success") {
                    alert("Game(s) purchased successfully!");
                } else {
                    alert(data.message); // Show the error message returned from the server
                }
            } catch (error) {
                console.error("Error purchasing game(s):", error);
                alert("An error occurred while processing your purchase. Please try again later.");
            } finally {
                // Re-enable the button after the request is finished, regardless of success or failure
                button.disabled = false;
            }
        };

    // Initialize swiper carousel
    await initSwiperCarousel();

    const renderGameSection = async (apiUrl, wrapperId) => {    
        const wrapper = document.getElementById(wrapperId);
        let games = [];
    
        try {
            const response = await fetch(apiUrl);
            const responseData = await response.json();
            
            console.log("API Response Data:", responseData);
    
            if (!response.ok || responseData.status !== 'success') throw new Error(`Failed to fetch games from ${apiUrl}`);
    
            games = responseData.data; // Extract the data array
            
            if (!Array.isArray(games)) {
                console.error("Expected an array of games, got:", games);
                throw new Error("Data format error: Expected an array");
            }
    
        } catch (error) {
            console.error("Error fetching games:", error);
            return;
        }
    
        wrapper.innerHTML = ""; // Clear existing cards
    
        games.forEach((game) => {
            const final_price = game.discount > 0
            ? Math.floor(game.price - (game.price * game.discount / 100))
            : Math.floor(game.price);
            const cardElement = document.createElement("div");
            cardElement.className = "col-md-3 mb-3";
            cardElement.innerHTML = `
                <div class="card h-100">
                    <img src="${game.avt}" class="card-img-top" alt="${game.game_name}">
                    <div class="card-body">
                        <h5 class="card-title">${game.game_name}</h5>
                        <p class="card-text"> <span class="cus-color">Downloads: </span>${game.downloads}</p>
                        <p class="card-text"><span class="cus-color">Rating: </span><span class="text-warning">${game.rating}</span></p>
                        <p class="card-text"><span class="cus-color">Price: </span><span>${game.discount > 0 ? `<s>${game.price} coins</s> ${final_price} coins` : `${game.price} coins`} </span></p>
                        ${game.discount > 0 ? `<p class="card-text discount-rate"><span class="cus-color">Discount: </span>${game.discount}%</p>` : ''}
                        <div class="card-actions d-flex justify-content-center">
                            ${renderCarouselButtons(game, role)}
                        </div>
                    </div>
                </div>
            `;
            wrapper.appendChild(cardElement);
        });
    
        attachCarouselButtonListeners();
    };

    // Fetch and render each game section
    await renderGameSection("/../api/get_trending_game.php", "trendingGamesWrapper");
    await renderGameSection("/../api/get_new_release_game.php", "newReleasesWrapper");
    await renderGameSection("/../api/get_top_rate_game.php", "topRateWrapper");

});


document.addEventListener("DOMContentLoaded", async () => {
    const carouselWrapper = document.getElementById("carouselWrapper");
    const prevButton = document.getElementById("prevButton");
    const nextButton = document.getElementById("nextButton");
    let currentIndex = 0;
    const cardsPerPage = 4;

    let categories = [];
    try {
        const response = await fetch("/../api/get_all_categories.php");
        
        if (!response.ok) throw new Error("Failed to fetch categories");

        const responseData = await response.json();

        if (responseData.status !== 'success') {
            throw new Error("API did not return a successful status");
        }

        categories = responseData.data;
    } catch (error) {
        console.error("Error fetching categories:", error);
        return;
    }

    const renderCategoryCards = () => {
        carouselWrapper.innerHTML = "";

        for (let i = 0; i < cardsPerPage; i++) {
            if (categories.length === 0) return;

            const cardIndex = (currentIndex + i) % categories.length;
            const category = categories[cardIndex];

            if (!category || !category.genre || !category.thumbnail_url) {
                console.warn("Incomplete category data:", category);
                continue;
            }

            const cardElement = document.createElement("div");
            cardElement.className = "col-md-3 mb-3";
            cardElement.innerHTML = `
                <div class="card h-100 category-card" data-category="${encodeURIComponent(category.genre)}">
                    <img src="${category.thumbnail_url}" class="card-img-top" alt="${category.genre}">
                    <div class="card-body text-center bg-dark">
                        <h5 class="card-title">${category.genre}</h5>
                    </div>
                </div>
            `;
            carouselWrapper.appendChild(cardElement);

            // Register event listener for card click
            cardElement.querySelector('.category-card').addEventListener('click', () => {
                window.location.href = `/zerostress-game-store/category/${category.genre}`;
            });
        }
    };

    // Button existence and assignment
    if (prevButton && nextButton) {
        prevButton.addEventListener("click", () => {
            currentIndex = (currentIndex - cardsPerPage + categories.length) % categories.length;
            renderCategoryCards();
        });

        nextButton.addEventListener("click", () => {
            currentIndex = (currentIndex + cardsPerPage) % categories.length;
            renderCategoryCards();
        });
    } else {
        console.error("Navigation buttons for categories are missing.");
    }

    // Initial Rendering
    renderCategoryCards();
});

// Open the Edit Modal
async function openEditGameModal(gameId) {
    try {
        const response = await fetch(`/../api/get_game_info.php?id=${gameId}`);
        const data = await response.json();

        console.log("dataaaa: ", data);

        if (data.status === 'success') {
            const game = data.data;

            currentGameId = gameId; // Store the current game ID globally

            document.getElementById('gameName').value = game.game_name || '';
            document.getElementById('publisher').value = game.publisher || '';
            document.getElementById('genre').value = game.genre || '';
            document.getElementById('price').value = game.price || 0;
            document.getElementById('discount').value = game.discount || 0;
            document.getElementById('downloads').value = game.downloads || 0;
            document.getElementById('releaseDate').value = game.release_date || '';
            document.getElementById('description').value = game.description || '';
            document.getElementById('avt').value = game.avt || '';
            document.getElementById('background').value = game.background || '';
            document.getElementById('introduction').value = game.introduction || '';
            document.getElementById('rating').value = game.rating || 0;
            document.getElementById('downloadLink').value = game.download_link || '';
            document.getElementById('recOS').value = game.recOS || '';
            document.getElementById('recProcessor').value = game.recProcessor || '';
            document.getElementById('recMemory').value = game.recMemory || '';
            document.getElementById('recGraphics').value = game.recGraphics || '';
            document.getElementById('recDirectX').value = game.recDirectX || '';
            document.getElementById('recStorage').value = game.recStorage || '';
            document.getElementById('minOS').value = game.minOS || '';
            document.getElementById('minProcessor').value = game.minProcessor || '';
            document.getElementById('minMemory').value = game.minMemory || '';
            document.getElementById('minGraphics').value = game.minGraphics || '';
            document.getElementById('minDirectX').value = game.minDirectX || '';
            document.getElementById('minStorage').value = game.minStorage || '';

            // Show modal
            document.getElementById('editGameModal').style.display = 'block';
            document.getElementById('modalBackdrop').style.display = 'block';
        } else {
            console.error('Failed to fetch game details: ', data.message);
        }
    } catch (error) {
        console.error('Error fetching game details:', error);
    }
}

// Closing the modal
function closeEditGameModal() {
    document.getElementById('editGameModal').style.display = 'none';
    document.getElementById('modalBackdrop').style.display = 'none';
}

// Update the game details when clicking "Save Changes"
async function updateGame() {
    const gameData = {
        game_id: currentGameId, // Use the stored game ID
        game_name: document.getElementById('gameName').value,
        publisher: document.getElementById('publisher').value,
        genre: document.getElementById('genre').value,
        price: document.getElementById('price').value,
        discount: document.getElementById('discount').value,
        downloads: document.getElementById('downloads').value,
        release_date: document.getElementById('releaseDate').value,
        description: document.getElementById('description').value,
        avt: document.getElementById('avt').value,
        background: document.getElementById('background').value,
        introduction: document.getElementById('introduction').value,
        rating: document.getElementById('rating').value,
        download_link: document.getElementById('downloadLink').value,
        recOS: document.getElementById('recOS').value,
        recProcessor: document.getElementById('recProcessor').value,
        recMemory: document.getElementById('recMemory').value,
        recGraphics: document.getElementById('recGraphics').value,
        recDirectX: document.getElementById('recDirectX').value,
        recStorage: document.getElementById('recStorage').value,
        minOS: document.getElementById('minOS').value,
        minProcessor: document.getElementById('minProcessor').value,
        minMemory: document.getElementById('minMemory').value,
        minGraphics: document.getElementById('minGraphics').value,
        minDirectX: document.getElementById('minDirectX').value,
        minStorage: document.getElementById('minStorage').value,
    };

    try {
        const response = await fetch('/../api/update_game.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(gameData)
        });

        const result = await response.json();
        if (result.status === 'success') {
            // console.log('Game updated successfully!');
            alert('Game updated successfully!');

            window.location.reload();
            
            closeEditGameModal();
            // Optionally, refresh the page or update the UI to reflect changes
        } else {
            console.error('Failed to update game:', result.message);
        }
    } catch (error) {
        console.error('Error updating game:', error);
    }
}