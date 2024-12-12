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

            games = responseData.data; 
            if (!Array.isArray(games)) {
                throw new Error("Data format error: Expected an array but got: " + typeof games);
            }
    
        } catch (error) {
            console.error("Error fetching game data:", error);
            return;
        }
    
        const topRatedGames = games.sort((a, b) => b.rating - a.rating).slice(0, 5);
    
        swiperWrapper.innerHTML = ""; 
        thumbnails.innerHTML = ""; 
    
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
                swiper.slideTo(index); 
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

        // Attach all button event listeners
        attachButtonListeners();
    };

       const renderCarouselButtons = (game, role) => {
        return role === 'Admin'
            ? `<button class="btn btn-warning edit-game" data-id="${game.id}">Edit Game</button>`
            : game.is_free
                ? `<button class="btn btn-info play-free" data-id="${game.id}">Play for Free</button>`
                : `<button class="btn btn-info buy-now" data-id="${game.id}">Buy Now</button>
                   <button class="btn btn-outline-light add-to-cart" data-id="${game.id}">Add to Cart</button>`;
    };

    // Function to attach event listeners for buttons
    const attachButtonListeners = () => {
        // Handle Add to Cart button
        document.querySelectorAll(".add-to-cart").forEach((button) => {
            button.addEventListener("click", async (e) => {
                e.stopPropagation();
                const gameId = button.getAttribute("data-id");
                await handleAddToCart(gameId);
            });
        });

        // Handle Buy Now button
        document.querySelectorAll(".buy-now").forEach((button) => {
            button.addEventListener("click", async (e) => {
                e.stopPropagation(); 
                const gameId = button.getAttribute("data-id");
                const userId = localStorage.getItem("id"); // Get user ID from localStorage

                // Ensure gameIds is an array
                let gameIds = [parseInt(gameId, 10)];

                // Prepare request body
                const requestBody = {
                    account_id: parseInt(userId),
                    game_ids: gameIds
                };

                // Disable the button to prevent multiple clicks
                button.disabled = true;

                try {
                    const response = await fetch("/../api/buy_game.php", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                        },
                        body: JSON.stringify(requestBody), 
                    });

                    const data = await response.json();

                    if (data.status === "success") {
                        alert("Game(s) purchased successfully!");
                    } else {
                        alert(data.message); 
                    }
                } catch (error) {
                    console.error("Error purchasing game(s):", error);
                    alert("An error occurred while processing your purchase. Please try again later.");
                } finally {
                    // Re-enable the button after the request is finished
                    button.disabled = false;
                }

                console.log(gameIds);  
            });
        });

        // Handle Play Free button
        document.querySelectorAll(".play-free").forEach((button) => {
            button.addEventListener("click", (e) => {
                e.stopPropagation(); 
                const gameId = button.getAttribute("data-id");
                window.location.href = `/app/views/games/detail.php?id=${gameId}`;
            });
        });

        // Handle Edit Game button
        document.querySelectorAll(".edit-game").forEach((button) => {
            button.addEventListener("click", (e) => {
                e.stopPropagation();
                const gameId = button.getAttribute("data-id");
                openEditGameModal(gameId);
            });
        });
    };

    // Handle Add to Cart functionality
    const handleAddToCart = async (gameId) => {
        try {
            const response = await fetch("/../api/add_to_cart.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify({ game_id: gameId }),
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

    // Open Edit Modal
    async function openEditGameModal(gameId) {
        try {
            const response = await fetch(`/../api/get_game_info.php?id=${gameId}`);
            const data = await response.json();

            if (data.status === 'success') {
                const game = data.data;
                currentGameId = gameId; 

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

                const modal = new bootstrap.Modal(document.getElementById('editGameModal'));
                modal.show();
            } else {
                alert('Failed to load game information');
            }
        } catch (error) {
            console.error('Error fetching game data:', error);
        }
    }

    initSwiperCarousel();