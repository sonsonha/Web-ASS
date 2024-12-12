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
                    <p class="text-light">Rating: ${game.rating} | ${game.discount || "No Discount"} | <span class="text-white">${game.final_price}</span></p>
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
            button.addEventListener("click", async (e) => {
                e.stopPropagation(); 
                const gameId = button.getAttribute("data-id");
                await handleCartAction(gameId);
            });
        });

        document.querySelectorAll(".buy-now").forEach((button) => {
            button.addEventListener("click", async (e) => {
                e.stopPropagation(); 
                const gameId = button.getAttribute("data-id");
                await handlePurchaseAction(gameId);
            });
        });

        document.querySelectorAll(".play-free").forEach((button) => {
            button.addEventListener("click", (e) => {
                e.stopPropagation(); 
                const gameId = button.getAttribute("data-id");
                window.location.href = `/app/views/games/detail.php?id=${gameId}`;
            });
        });

        document.querySelectorAll(".edit-game").forEach((button) => {
            button.addEventListener("click", (e) => {
                e.stopPropagation();
                const gameId = button.getAttribute("data-id");
                openEditGameModal(gameId);
            });
        });
    };

    // Function to handle actions for cart and purchase
    const handleCartAction = async (gameId) => {
        try {
            const response = await fetch("http://localhost/test_api/store_api/add_to_cart.php", {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify({ user_id: userId, game_id: gameId }),
            });
            const data = await response.json();
            alert(data.success ? "Game added to cart successfully!" : "Failed to add game to cart.");
        } catch (error) {
            console.error("Error adding game to cart:", error);
        }
    };

    const handlePurchaseAction = async (gameId) => {
        try {
            const response = await fetch("http://localhost/test_api/store_api/buy_game.php", {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify({ user_id: userId, game_id: gameId }),
            });
            const data = await response.json();
            alert(data.success ? "Game purchased successfully!" : "Failed to purchase the game.");
            if (data.success) window.location.reload();
        } catch (error) {
            console.error("Error purchasing game:", error);
        }
    };

    // Open edit game modal (Admin functionality)
    const openEditGameModal = (gameId) => {
        alert(`Open edit modal for game ID: ${gameId}`); // Implementation for editing game
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
            const cardElement = document.createElement("div");
            cardElement.className = "col-md-3 mb-3";
            cardElement.innerHTML = `
                <div class="card h-100">
                    <img src="${game.avt}" class="card-img-top" alt="${game.game_name}">
                    <div class="card-body text-center bg-dark">
                        <h5 class="card-title text-white">${game.game_name}</h5>
                        <p class="text-white mb-1">Downloads: ${game.downloads}</p>
                        <p class="text-warning mb-1">Rating: ${game.rating}</p>
                        <p class="text-muted mb-1">
                            ${game.discount > 0 ? `<s>${game.price}</s>` : `${game.price}`}
                        </p>
                        ${game.discount > 0 ? `<p class="text-danger mb-1">Discount: ${game.discount}%</p>` : ''}
                        <p class="text-success mb-1">Final Price: ${game.final_price}</p>
                        <div class="d-flex justify-content-center">
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

    // Fetch and render Categories
    const carouselWrapper = document.getElementById("carouselWrapper");
    const prevButton = document.getElementById("prevButton");
    const nextButton = document.getElementById("nextButton");
    let currentIndex = 0;
    const cardsPerPage = 4;

    // Fetch categories from the back-end
    let categories = [];
    try {
        const response = await fetch("/../api/get_all_categories.php");
        // const response = await fetch("/../test_api/store_api/fetch_categories.php"); debug purpose
        if (!response.ok) throw new Error("Failed to fetch categories");
        categories = await response.json();
    } catch (error) {
        console.error("Error fetching categories:", error);
        return; // Stop execution if there's an error
    }

    // Function to render category cards
    const renderCategoryCards = () => {
        carouselWrapper.innerHTML = ""; // Clear the current cards
    
        for (let i = 0; i < cardsPerPage; i++) {
            const cardIndex = (currentIndex + i) % categories.length;
            const category = categories[cardIndex];
    
            if (!category || !category.name || !category.image) {
                console.warn("Incomplete category data:", category);
                continue; // Skip this iteration if data is incomplete
            }
    
            const cardElement = document.createElement("div");
            cardElement.className = "col-md-3 mb-3";
            cardElement.innerHTML = `
                <div class="card h-100 category-card" data-category="${category.name}">
                    <img src="${category.image}" class="card-img-top" alt="${category.name}">
                    <div class="card-body text-center bg-dark">
                        <h5 class="card-title">${category.name}</h5>
                    </div>
                </div>
            `;
            carouselWrapper.appendChild(cardElement);
    
            cardElement.querySelector('.category-card').addEventListener('click', () => {
                window.location.href = `/zerostress-game-store/category/${category.name}`;
            });
        }
    };

    // Event listeners for navigation buttons
    prevButton.addEventListener("click", () => {
        currentIndex = (currentIndex - cardsPerPage + categories.length) % categories.length;
        renderCategoryCards();
    });

    nextButton.addEventListener("click", () => {
        currentIndex = (currentIndex + cardsPerPage) % categories.length;
        renderCategoryCards();
    });

    // Initial render for categories
    renderCategoryCards();

    // Handle search bar
    const searchInput = document.getElementById('searchInput');
    searchInput.addEventListener('keydown', (event) => {
        if (event.key === 'Enter') {
            event.preventDefault();
            const query = searchInput.value.trim();
            if (query) {
                window.location.href = `/search?query=${encodeURIComponent(query)}`;
            }
        }
    });
});