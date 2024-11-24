document.addEventListener("DOMContentLoaded", async () => {
    const cardsPerPage = 4; // Number of cards to show at a time
    let currentIndex = 0; // Start index for the current view

    const carouselWrapper = document.getElementById("carouselWrapper");
    const prevButton = document.getElementById("prevButton");
    const nextButton = document.getElementById("nextButton");

    // Fetch categories from the back-end
    let categories = [];
    try {
        const response = await fetch("test_api/fetch_categories.php");
        if (!response.ok) throw new Error("Failed to fetch categories");
        categories = await response.json();
    } catch (error) {
        console.error("Error fetching categories:", error);
        return; // Stop execution if there's an error
    }

    // Function to render cards
    const renderCards = () => {
        // Clear the current cards
        carouselWrapper.innerHTML = "";

        // Determine which cards to display
        for (let i = 0; i < cardsPerPage; i++) {
            const cardIndex = (currentIndex + i) % categories.length; // Loop around if we exceed the array length
            const category = categories[cardIndex];

            // Create card element
            const cardElement = document.createElement("div");
            cardElement.className = "col-md-3"; // 3 columns per card
            cardElement.innerHTML = `
                <div class="card h-100 category-card" data-category="${category.slug}">
                    <img src="${category.image}" class="card-img-top" alt="${category.name}">
                    <div class="card-body text-center bg-dark">
                        <h5 class="card-title">${category.name}</h5>
                    </div>
                </div>
                `;
            carouselWrapper.appendChild(cardElement);   

            cardElement.querySelector('.category-card').addEventListener('click', () => {
                window.location.href = `/app/views/store/category.php?category=${category.slug}`;
            });
        }
    };

    // Event listeners for navigation buttons
    prevButton.addEventListener("click", () => {
        // Move backwards by the number of cards per page
        currentIndex = (currentIndex - cardsPerPage + categories.length) % categories.length;
        renderCards();
    });

    nextButton.addEventListener("click", () => {
        // Move forward by the number of cards per page
        currentIndex = (currentIndex + cardsPerPage) % categories.length;
        renderCards();
    });

    // Initial render
    renderCards();
});

document.addEventListener("DOMContentLoaded", async () => {
    const swiperWrapper = document.getElementById("swiperWrapper");
    const thumbnails = document.getElementById("thumbnails");

    let games = [];

    // Fetch games from the backend
    try {
        const response = await fetch("test_api/fetch_carousel_games.php");
        if (!response.ok) throw new Error("Failed to fetch game data");
        games = await response.json();
    } catch (error) {
        console.error("Error fetching game data:", error);
        return;
    }

    // Sort games by rating in descending order and pick the top 5
    const topRatedGames = games
        .sort((a, b) => b.rating - a.rating)
        .slice(0, 5);

    // Function to render the carousel
    const renderCarousel = () => {
        swiperWrapper.innerHTML = ""; // Clear existing slides
        thumbnails.innerHTML = ""; // Clear existing thumbnails

        topRatedGames.forEach((game, index) => {
            // Swiper slide
            const slide = document.createElement("div");
            slide.className = "swiper-slide";
            slide.innerHTML = `
                <img src="${game.image}" alt="${game.title}">
                <div class="carousel-caption gradient-bg p-3 rounded">
                    <h5 class="text-white">${game.title}</h5>
                    <p class="text-light">Rating: ${game.rating} | ${game.discount || "No Discount"} | <span class="text-success">${game.final_price}</span></p>
                    <button class="btn btn-info">${game.is_free ? "Play for Free" : "Buy Now"}</button>
                    <button class="btn btn-outline-light">Add to Cart</button>
                </div>  
            `;
            swiperWrapper.appendChild(slide);

            // Thumbnail
            const thumbnail = document.createElement("div");
            thumbnail.className = "thumbnail d-flex align-items-center gap-2";
            thumbnail.innerHTML = `
                <img src="${game.image}" alt="${game.title}">
                <p class="text-white mb-0">${game.title}</p>
            `;
            thumbnails.appendChild(thumbnail);

            // Thumbnail click event
            thumbnail.addEventListener("click", () => {
                swiper.slideTo(index); // Navigate to the corresponding slide
            });
        });

        // Initialize Swiper
        new Swiper("#gameSwiper", {
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
    };

    // Render the carousel
    renderCarousel();
});

document.addEventListener("DOMContentLoaded", async () => {
    const newReleasesWrapper = document.getElementById("newReleasesWrapper");
    const newPrevButton = document.getElementById("newPrevButton");
    const newNextButton = document.getElementById("newNextButton");

    const cardsPerPage = 4; // Number of cards to show at a time
    let currentIndex = 0; // Start index for the current view

    let newReleases = [];

    // Fetch new releases from the backend
    try {
        const response = await fetch("test_api/fetch_new_releases.php");
        if (!response.ok) throw new Error("Failed to fetch new releases");
        newReleases = await response.json();
    } catch (error) {
        console.error("Error fetching new releases:", error);   
        return;
    }

    // Function to render new releases cards
    const renderNewReleases = () => {
        newReleasesWrapper.innerHTML = ""; // Clear the current cards

        // Determine which cards to display
        for (let i = 0; i < cardsPerPage; i++) {
            const cardIndex = (currentIndex + i) % newReleases.length; // Loop around if exceeding array length
            const game = newReleases[cardIndex];

            const cardElement = document.createElement("div");
            cardElement.className = "col-md-3"; // 3 columns per card
            cardElement.innerHTML = `
                <div class="card h-100">
                    <img src="${game.image}" class="card-img-top" alt="${game.title}">
                    <div class="card-body text-center bg-dark">
                        <h5 class="card-title">${game.title}</h5>
                        <p class="text-success">${game.final_price}</p>
                        ${
                            game.discount
                                ? `<p class="text-danger">-${game.discount}</p>`
                                : ""
                        }
                        <button class="btn btn-info">View</button>
                    </div>
                </div>
            `;
            newReleasesWrapper.appendChild(cardElement);
        }
    };

    // Event listeners for navigation buttons
    newPrevButton.addEventListener("click", () => {
        currentIndex = (currentIndex - cardsPerPage + newReleases.length) % newReleases.length;
        renderNewReleases();
    });

    newNextButton.addEventListener("click", () => {
        currentIndex = (currentIndex + cardsPerPage) % newReleases.length;
        renderNewReleases();
    });

    // Initial render
    renderNewReleases();
});

document.addEventListener("DOMContentLoaded", async () => {
    const trendingGamesWrapper = document.getElementById("trendingGamesWrapper");
    const trendingPrevButton = document.getElementById("trendingPrevButton");
    const trendingNextButton = document.getElementById("trendingNextButton");

    const cardsPerPage = 4; // Number of cards to show at a time
    let currentIndex = 0; // Start index for the current view

    let trendingGames = [];

    // Fetch trending games from the backend
    try {
        const response = await fetch("test_api/fetch_trending_games.php");
        if (!response.ok) throw new Error("Failed to fetch trending games");
        trendingGames = await response.json();
    } catch (error) {
        console.error("Error fetching trending games:", error);
        return;
    }

    // Function to render trending games cards
    const renderTrendingGames = () => {
        trendingGamesWrapper.innerHTML = ""; // Clear the current cards

        // Determine which cards to display
        for (let i = 0; i < cardsPerPage; i++) {
            const cardIndex = (currentIndex + i) % trendingGames.length; // Loop around if exceeding array length
            const game = trendingGames[cardIndex];

            const cardElement = document.createElement("div");
            cardElement.className = "col-md-3"; // 3 columns per card
            cardElement.innerHTML = `
                <div class="card h-100">
                    <img src="${game.image}" class="card-img-top" alt="${game.title}">
                    <div class="card-body text-center bg-dark">
                        <h5 class="card-title">${game.title}</h5>
                        <p class="text-success">${game.final_price}</p>
                        ${
                            game.discount
                                ? `<p class="text-danger">-${game.discount}</p>`
                                : ""
                        }
                        <button class="btn btn-info">View</button>
                    </div>
                </div>
            `;
            trendingGamesWrapper.appendChild(cardElement);
        }
    };

    // Event listeners for navigation buttons
    trendingPrevButton.addEventListener("click", () => {
        currentIndex = (currentIndex - cardsPerPage + trendingGames.length) % trendingGames.length;
        renderTrendingGames();
    });

    trendingNextButton.addEventListener("click", () => {
        currentIndex = (currentIndex + cardsPerPage) % trendingGames.length;
        renderTrendingGames();
    });

    // Initial render
    renderTrendingGames();
});


document.addEventListener('DOMContentLoaded', () => {
    const searchInput = document.getElementById('searchInput');
    const searchForm = document.getElementById('searchForm');

    // Add a keydown event listener to the input
    searchInput.addEventListener('keydown', (event) => {
        if (event.key === 'Enter') { // Check if the Enter key is pressed
            event.preventDefault(); // Prevent the default form submission behavior
            const query = searchInput.value.trim(); // Get the search query
            if (query) {
                console.log('Search for:', query); // Replace with your search logic
                // Example: Redirect to a search results page or call an API
                window.location.href = `/search?query=${encodeURIComponent(query)}`;
            }
        }
    });
});

document.addEventListener("DOMContentLoaded", async () => {
    const topRateWrapper = document.getElementById("topRateWrapper");
    const topRatePrevButton = document.getElementById("topRatePrevButton");
    const topRateNextButton = document.getElementById("topRateNextButton");

    const cardsPerPage = 4; // Number of cards to show at a time
    let currentIndex = 0; // Start index for the current view

    let topRateGames = [];

    // Fetch top-rated games from the backend
    try {
        const response = await fetch("test_api/fetch_top_rate_games.php");
        if (!response.ok) throw new Error("Failed to fetch top-rated games");
        topRateGames = await response.json();
    } catch (error) {
        console.error("Error fetching top-rated games:", error);
        return;
    }

    // Function to render top-rated ( > 4.5 stars) games cards
    const renderTopRateGames = () => {
        topRateWrapper.innerHTML = ""; // Clear the current cards

        // Determine which cards to display
        for (let i = 0; i < cardsPerPage; i++) {
            const cardIndex = (currentIndex + i) % topRateGames.length; // Loop around if exceeding array length
            const game = topRateGames[cardIndex];

            const cardElement = document.createElement("div");
            cardElement.className = "col-md-3"; // 3 columns per card
            cardElement.innerHTML = `
                <div class="card h-100">
                    <img src="${game.image}" class="card-img-top" alt="${game.title}">
                    <div class="card-body text-center bg-dark">
                        <h5 class="card-title">${game.title}</h5>
                        <p class="text-success">${game.final_price}</p>
                        ${
                            game.discount
                                ? `<p class="text-danger">-${game.discount}</p>`
                                : ""
                        }
                        <p class="text-warning">Rating: ${game.rating}</p>
                        <button class="btn btn-info">View</button>
                    </div>
                </div>
            `;
            topRateWrapper.appendChild(cardElement);
        }
    };

    // Event listeners for navigation buttons
    topRatePrevButton.addEventListener("click", () => {
        currentIndex = (currentIndex - cardsPerPage + topRateGames.length) % topRateGames.length;
        renderTopRateGames();
    });

    topRateNextButton.addEventListener("click", () => {
        currentIndex = (currentIndex + cardsPerPage) % topRateGames.length;
        renderTopRateGames();
    });

    // Initial render
    renderTopRateGames();
});
